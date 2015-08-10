<?php

namespace app\modules\user\controllers;

use Yii;
use frontend\models\SignupForm;
use frontend\models\UpdateInfo;
use common\models\User;
use common\models\Role;
use common\controllers\FrontendController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DefaultController extends FrontendController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $role = new Role();
        $condition = [];
        if ($role->isAdmin) {
            $position = $role->getPosition();
            $ids = User::getByRole($position, Yii::$app->user->id);
            $condition = ['in', 'id', $ids];
        } else if ($role->isAdministrator) {
            $condition = ['!=', 'id', Yii::$app->user->id];
        }

        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where($condition),
            'pagination' => [
                'pageSize' => Yii::$app->params['page_size'],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new SignupForm();
        $parseData['model'] = $model;

        // get user types
        $types = $model->_types;

        $role = new Role();
        if ($role->isAdmin) {
            foreach ($types as $key => $value) {
                if ($value['value'] == User::TYPE_ADMIN) unset($types[$key]);
            }
        }

        $parseData['types'] = $model->_prepareDataSelect($types, 'value', 'label');

        $post = Yii::$app->request->post();
        if ($post) {
            $model->load(Yii::$app->request->post());

            if ($model->validate()) {
                $model->signup();

                return $this->redirect(['index']);
            } else {
                $parseData['errors'] = $model->getErrors();
            }
        }

        return $this->render('create', $parseData);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $parseData['model'] = $model;

        // get user types
        $parseData['types'] = $model->_prepareDataSelect($model->_types, 'value', 'label');

        $post = Yii::$app->request->post();
        if ($post) {
            $model->load(Yii::$app->request->post());

            if ($model->validate()) {
                $model->updateInfo($id);

                return $this->redirect(['index']);
            } else {
                $parseData['errors'] = $model->getErrors();
            }
        }

        return $this->render('update', $parseData);
    }

    public function actionDelete($id)
    {
        $this->checkPermission($id);

        Yii::$app->db->createCommand()
            ->delete('user', ['id' => $id])
            ->execute();

        return $this->redirect(['index']);
    }

    private function checkPermission($id) {
        $role = new Role();
        if ($role->isAdmin) {
            $position = $role->getPosition();
            $ids = User::getByRole($position, Yii::$app->user->id);

            if (!in_array($id, $ids)) {
                $this->permissionDeny();
            }
        }
    }

    protected function findModel($id)
    {
        $this->checkPermission($id);

        if (($user = User::findOne($id)) !== null) {
            $model = new UpdateInfo();
            $model->id = $user->id;
            $model->username = $user->username;
            $model->password = $user->password_hash;
            $model->fullname = $user->fullname;
            $model->mobile = $user->mobile;
            $model->email = $user->email;
            $model->type = $user->type;
            $model->created_at = $user->created_at;
            $model->updated_at = $user->updated_at;
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

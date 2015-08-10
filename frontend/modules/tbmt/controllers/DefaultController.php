<?php

namespace frontend\modules\tbmt\controllers;

use Yii;
use frontend\modules\tbmt\models\Tbmt;
use frontend\modules\tbmt\models\TbmtSearch;
use common\controllers\FrontendController;
use arturoliveira\ExcelView;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Tbmt model.
 */
class DefaultController extends FrontendController
{
    public $layout = '//main';

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

    /**
     * Lists all Tbmt models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbmtSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tbmt model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tbmt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tbmt();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tbmt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tbmt model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tbmt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tbmt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tbmt::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Export data to Excel file
     */
    public function actionExport()
    {
        $builder = $this->buildQuery(true);
        $query = $builder['query'];

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        ExcelView::widget([
            'dataProvider' => $dataProvider,
            'fullExportType' => 'xlsx',

            'grid_mode' => 'export',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'station_name',
                    'header' => 'Tên trạm',
                ],
                [
                    'attribute' => 'message',
                    'header' => 'Nội dung',
                ],
                [
                    'attribute' => 'warning_date',
                    'header' => 'Thời gian',
                ],
            ],
        ]);
    }

    private function buildQuery()
    {
        $parseData = [];
        $query = new Query();
        $query->select(['warning.message AS message', 'station.name AS station_name', 'DATE_FORMAT(FROM_UNIXTIME(warning.warning_time), "%d/%m/%Y %H:%i:%s") AS warning_date'])
            ->from('warning')
            ->leftJoin('station', 'station.id = warning.station_id')
            ->where([]);

        // filter by center
        $center = Yii::$app->request->get('center');
        if ($center > 0) {
            $query->andWhere(['station.center_id' => $center]);
        }

        // filter by time points
        $getBy = Yii::$app->request->get('get_by');
        if ($getBy) {
            if ($getBy == 'today') {
                $timePoints = Convert::currentTimePoints();
            } else if ($getBy == 'week') {
                $timePoints = Convert::currentWeekTimePoints();
            } else if ($getBy == 'month') {
                $timePoints = Convert::currentMonthTimePoints();
            }
            $query->andWhere(['>=', 'warning.warning_time', $timePoints['start']]);
            $query->andWhere(['<=', 'warning.warning_time', $timePoints['end']]);
        }

        $query->orderBy('warning_time DESC');

        return [
            'query' => $query,
            'parseData' => $parseData,
        ];
    }
}

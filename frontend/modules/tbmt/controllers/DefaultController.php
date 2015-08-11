<?php

namespace frontend\modules\tbmt\controllers;

use Yii;
use frontend\modules\tbmt\models\Tbmt;
use frontend\modules\tbmt\models\TbmtSearch;
use common\controllers\FrontendController;
use arturoliveira\ExcelView;
use yii\data\ActiveDataProvider;
use yii\helpers\BaseVarDumper;
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
        $searchModel = new TbmtSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        ExcelView::widget([
            'dataProvider' => $dataProvider,
            'fullExportType' => 'xlsx',
            'grid_mode' => 'export',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'so_tbmt',
                    'header' => 'Số TBMT',
                ],
                [
                    'attribute' => 'category',
                    'header' => 'Danh mục',
                ],
                [
                    'attribute' => 'loai_tb',
                    'header' => 'Loại thông báo',
                ],
                [
                    'attribute' => 'linh_vuc',
                    'header' => 'Lĩnh vực',
                ],
                [
                    'attribute' => 'hinh_thuc_tb',
                    'header' => 'Hình thức thông báo',
                ],
                [
                    'attribute' => 'goi_thau',
                    'header' => 'Gói thầu',
                ],
                [
                    'attribute' => 'thuoc_du_an',
                    'header' => 'Dự án',
                ],
                [
                    'attribute' => 'nguon_von',
                    'header' => 'Nguồn vốn',
                ],
                [
                    'attribute' => 'ben_mt',
                    'header' => 'Bên mời thầu',
                ],
                [
                    'attribute' => 'hinh_thuc_lua_chon',
                    'header' => 'Hình thức lựa chọn',
                ],
                [
                    'attribute' => 'tg_ban_hs_tu',
                    'header' => 'Thời gian bán HS từ',
                ],
                [
                    'attribute' => 'tg_ban_hs_den',
                    'header' => 'Thời gian bán HS đến',
                ],
                [
                    'attribute' => 'dia_diem',
                    'header' => 'Địa điểm',
                ],
                [
                    'attribute' => 'gia_ban',
                    'header' => 'Giá bán',
                ],
                [
                    'attribute' => 'han_cuoi_nhan_hs',
                    'header' => 'Hạn cuối nhận HS',
                ],
                [
                    'attribute' => 'thoi_diem_dang_tai',
                    'header' => 'Thời điểm đăng tải',
                ],
                [
                    'attribute' => 'thoi_diem_dong_thau',
                    'header' => 'Thời điểm đóng thầu',
                ],
                [
                    'attribute' => 'hinh_thuc_du_thau',
                    'header' => 'Hình thức dự thầu',
                ],
            ],
        ]);
    }

}

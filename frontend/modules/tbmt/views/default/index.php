<?php
use common\components\helpers\Label;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\tbmt\models\TbmtSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Thông báo mời thầu';
if (isset($_GET['category']))
    $this->title .= ' - ' . Label::mscCategory($_GET['category']);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbmt-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'so_tbmt',
                'format'    => 'html',
                'value'     => function($model) {
                    return Html::a($model->so_tbmt, '/tbmt/default/view?id='.$model->id);
                },
                'options'   => [
                    'width' => '15%',
                ],
            ],
            [
                'attribute' => 'category',
                'filter'    => false,
                'value'     => function($model) {
                    return Label::mscCategory($model->category);
                },
            ],
            [
                'attribute' => 'ben_mt',
            ],
            [
                'attribute' => 'goi_thau',
            ],
            [
                'attribute' => 'thoi_diem_dang_tai',
                'value'     => function($model) {
                    if ($model->thoi_diem_dang_tai > 0)
                        return date('d/m/Y H:i', $model->thoi_diem_dang_tai);
                    return null;
                },
                'filter'    => false,
                'options'   => [
                    'width' => '11%'
                ],
            ],
            [
                'attribute' => 'thoi_diem_dong_thau',
                'value'     => function($model) {
                    if ($model->thoi_diem_dong_thau > 0) {
                        return date('d/m/Y H:i', $model->thoi_diem_dong_thau);
                    }
                    return null;
                },
                'filter'    => false,
                'options'   => [
                    'width' => '11%'
                ],
            ],
            [
                'attribute' => 'hinh_thuc_du_thau',
                'filter'    => false,
            ]
        ],
    ]); ?>

</div>

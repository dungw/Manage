<?php
use common\components\helpers\Label;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\tbmt\models\TbmtSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Thông báo mời thầu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbmt-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'filter'    => false,
            ],
            'so_tbmt',
            [
                'attribute' => 'category',
                'filter'    => false,
                'value'     => function($model) {
                    return Label::mscCategory($model->category);
                },
            ],
            [
                'attribute' => 'loai_tb',
                'filter'    => false,
            ],
            [
                'attribute' => 'linh_vuc',
                'filter'    => false,
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\tbmt\models\TbmtSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbmts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbmt-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
            'category',
            'loai_tb',
            'linh_vuc',
            // 'hinh_thuc_tb',
            // 'goi_thau:ntext',
            // 'thuoc_du_an:ntext',
            // 'nguon_von',
            // 'ben_mt',
            // 'hinh_thuc_lua_chon',
            // 'tg_ban_hs_tu',
            // 'tg_ban_hs_den',
            // 'dia_diem:ntext',
            // 'gia_ban',
            // 'han_cuoi_nhan_hs',
            // 'hs_moi_thau',
            // 'temp_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {edit} {delete}',
            ],
        ],
    ]); ?>

</div>

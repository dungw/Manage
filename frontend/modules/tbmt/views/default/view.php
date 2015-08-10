<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tbmt\models\Tbmt */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbmts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbmt-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'so_tbmt',
            'category',
            'loai_tb',
            'linh_vuc',
            'hinh_thuc_tb',
            'goi_thau:ntext',
            'thuoc_du_an:ntext',
            'nguon_von',
            'ben_mt',
            'hinh_thuc_lua_chon',
            'tg_ban_hs_tu',
            'tg_ban_hs_den',
            'dia_diem:ntext',
            'gia_ban',
            'han_cuoi_nhan_hs',
            'hs_moi_thau',
            'temp_id',
        ],
    ]) ?>

</div>

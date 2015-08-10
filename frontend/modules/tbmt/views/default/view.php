<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\helpers\Label;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tbmt\models\Tbmt */

$this->title = $model->so_tbmt;
$this->params['breadcrumbs'][] = ['label' => 'Thông báo mời thầu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbmt-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'so_tbmt',
            [
                'attribute' => 'category',
                'value'     => Label::mscCategory($model->category),
            ],
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
            'thoi_diem_dang_tai',
            'thoi_diem_dong_thau',
            'hinh_thuc_du_thau',
        ],
    ]) ?>

</div>

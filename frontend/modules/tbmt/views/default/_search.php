<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tbmt\models\TbmtSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbmt-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'so_tbmt') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'loai_tb') ?>

    <?= $form->field($model, 'linh_vuc') ?>

    <?php // echo $form->field($model, 'hinh_thuc_tb') ?>

    <?php // echo $form->field($model, 'goi_thau') ?>

    <?php // echo $form->field($model, 'thuoc_du_an') ?>

    <?php // echo $form->field($model, 'nguon_von') ?>

    <?php // echo $form->field($model, 'ben_mt') ?>

    <?php // echo $form->field($model, 'hinh_thuc_lua_chon') ?>

    <?php // echo $form->field($model, 'tg_ban_hs_tu') ?>

    <?php // echo $form->field($model, 'tg_ban_hs_den') ?>

    <?php // echo $form->field($model, 'dia_diem') ?>

    <?php // echo $form->field($model, 'gia_ban') ?>

    <?php // echo $form->field($model, 'han_cuoi_nhan_hs') ?>

    <?php // echo $form->field($model, 'hs_moi_thau') ?>

    <?php // echo $form->field($model, 'temp_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

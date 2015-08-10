<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tbmt\models\Tbmt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbmt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'so_tbmt')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'category')->textInput() ?>

    <?= $form->field($model, 'loai_tb')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'linh_vuc')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'hinh_thuc_tb')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'goi_thau')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'thuoc_du_an')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nguon_von')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'ben_mt')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'hinh_thuc_lua_chon')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'tg_ban_hs_tu')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'tg_ban_hs_den')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'dia_diem')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gia_ban')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'han_cuoi_nhan_hs')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'hs_moi_thau')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'temp_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

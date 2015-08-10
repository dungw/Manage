<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\helpers\Show;

$attributeLabels = $model->attributeLabels();
?>

<div class="station-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 20]) ?>

    <?= Show::activeDropDownList($model, 'center_id', $attributeLabels, $centers, ['class' => 'form-select'], $errors) ?>

    <?= Show::activeDropDownList($model, 'area_id', $attributeLabels, $areas, ['class' => 'form-select'], $errors) ?>

    <?= Show::activeDropDownList($model, 'type', $attributeLabels, $types, ['class' => 'form-select'], $errors) ?>

    <?= Show::multiSelect('equipments', $equipmentIds, $equipments, 'id', 'name', $attributeLabels, ['style' => 'height: 150px;']) ?>

    <?= Show::multiSelect('power_equipments', $powerEquipmentIds, $powerEquipments, 'id', 'name', $attributeLabels) ?>

    <?= Show::multiSelect('dc_equipments', $dcEquipmentIds, $dcEquipments, 'id', 'name', $attributeLabels) ?>

    <?= $form->field($model, 'staff')->textInput() ?>

    <?= $form->field($model, 'firmware')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'picture_url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'video_url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'longtitude')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'port')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'picture_warning_numb')->textInput() ?>

    <?= $form->field($model, 'addition')->textarea(['rows' => 6]) ?>

    <?= Show::submitButton($model) ?>

    <?php ActiveForm::end(); ?>

</div>

<?php
use \Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\User;
use common\components\helpers\Show;

// get action
$action = Yii::$app->controller->action->id;

$labels = $model->attributeLabels();
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 20]) ?>

    <?= Show::activeDropDownList($model, 'type', $labels, $types, [], $errors) ?>

    <div class="form-group">
        <?= Html::submitButton(($action == 'create') ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Thêm mới người dùng';
$this->params['breadcrumbs'][] = ['label' => 'DS Người dùng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'types' => $types,
        'errors' => isset($errors) ? $errors : [],
    ]) ?>

</div>

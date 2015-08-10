<?php

use yii\helpers\Html;

$this->title = 'Cập nhật thông tin: ' . ' ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'DS Người dùng', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="user-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'types' => $types,
        'errors' => isset($errors) ? $errors : [],
    ]) ?>

</div>

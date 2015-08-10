<?php

use yii\helpers\Html;

$this->title = 'Cập nhật trạm: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'DS trạm', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="station-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model'             => $model,
        'areas'             => $areas,
        'centers'           => $centers,
        'types'             => $types,
        'equipments'        => $equipments,
        'equipmentIds'      => $equipmentIds,
        'powerEquipments'   => $powerEquipments,
        'powerEquipmentIds' => $powerEquipmentIds,
        'dcEquipments'      => $dcEquipments,
        'dcEquipmentIds'    => $dcEquipmentIds,
        'errors'            => isset($errors) ? $errors : [],
    ]) ?>

</div>

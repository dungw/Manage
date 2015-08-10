<?php

use yii\helpers\Html;

$this->title = 'Thêm mới trạm';
$this->params['breadcrumbs'][] = ['label' => 'DS Trạm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="station-create">

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

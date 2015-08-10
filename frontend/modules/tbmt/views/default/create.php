<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\tbmt\models\Tbmt */

$this->title = 'Create Tbmt';
$this->params['breadcrumbs'][] = ['label' => 'Tbmts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbmt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

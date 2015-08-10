<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'DS Người dùng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'fullname',
            'mobile',
            'email:email',
            [
                'attribute' => 'created_at',
                'value' => date('d/m/Y H:i', $model->created_at)
            ],
            [
                'attribute' => 'updated_at',
                'value' => date('d/m/Y H:i', $model->updated_at)
            ],
            [
                'attribute' => 'type',
                'value' => $model->getType($model->type),
            ],
        ],
    ]) ?>

</div>

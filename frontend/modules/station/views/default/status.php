<?php
use common\models\StationStatus;
use common\components\helpers\Convert;
use common\components\helpers\Show;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Thống kê trạng thái trạm '. $model->name;
$this->params['breadcrumbs'][] = ['label' => 'DS Trạm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="station-status">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'request_string',
            [
                'attribute' => 'time_update',
                'value' => function($model) {
                        return date('d/m/Y H:i', $model->time_update);
                    },
            ],
            [
                'attribute' => 'received',
                'format' => 'html',
                'value' => function($model) {
                        $emotion = ($model->received == StationStatus::STATUS_RECEIVED) ? 'good' : 'great';
                        return Show::decorateString($model->getStatus($model->received), $emotion);
                    },
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($model) {
                        $emotion = ($model->status == StationStatus::STATUS_OK) ? 'good' : 'bad';
                        return Show::decorateString($model->getStatusConnect($model->status), $emotion);
                    },
            ],
        ],
    ]); ?>

</div>
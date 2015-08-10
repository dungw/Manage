<?php
use common\models\Area;
use common\models\Center;
use common\models\Station;
use common\components\helpers\Show;

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Danh sách trạm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="station-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'options' => [
                    'width' => '6%',
                ],
            ],
            'code',
            'name',
            [
                'attribute' => 'center_id',
                'format' => 'text',
                'value' => function($model) {
                        $center = Center::findOne($model->center_id);
                        if ($center) {
                            return $center->name;
                        }
                        return null;
                    },
            ],
            [
                'attribute' => 'area_id',
                'format' => 'text',
                'value' => function($model) {
                        $area = Area::findOne($model->area_id);
                        if ($area) {
                            return $area->name;
                        }
                        return null;
                    },
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($model) {
                        if ($model->status == Station::STATUS_CONNECTED) $html = Show::decorateString($model->getStatus($model->status), 'good');
                        if ($model->status == Station::STATUS_LOST) $html = Show::decorateString($model->getStatus($model->status), 'bad');
                        return $html;
                    }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'width' => '10%',
                ],
            ],
        ],
    ]); ?>

</div>

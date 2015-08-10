<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\SignupForm;
use common\models\User;

$this->title = 'Danh sách người dùng';
$this->params['breadcrumbs'][] = $this->title;

$signupForm = new SignupForm();
$labels = $signupForm->attributeLabels();
?>
<div class="user-index">

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

            [
                'attribute' => 'username',
                'label' => $labels['username'],
            ],
            [
                'attribute' => 'fullname',
                'label' => $labels['fullname'],
            ],
            [
                'attribute' => 'mobile',
                'label' => $labels['mobile'],
            ],
            'email:email',
            [
                'attribute' => 'type',
                'label' => 'Cấp độ',
                'format' => 'text',
                'value' => function($model) {
                        $signupForm = new SignupForm();
                        $value = $signupForm->getType($model->type);
                        return $value;
                    },
            ],
            [
                'attribute' => 'created_by',
                'label' => 'Người tạo',
                'format' => 'text',
                'value' => function($model) {
                        $createdBy = User::findOne($model->created_by);
                        return $createdBy['username'];
                    },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'options' => [
                    'width' => '10%',
                ],
            ],
        ],
    ]); ?>

</div>

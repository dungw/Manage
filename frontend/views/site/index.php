<?php
$this->title = Yii::$app->params['brandName'] . ' ' . Yii::$app->params['projectName'];

?>

<div class="site-index">

    <div class="body-content">

        <!-- latest warning -->
<!--        --><?//= $this->render('warning', ['warnings' => $warnings]) ?>

        <!-- stations -->
<!--        --><?//= $this->render('station', ['dataProvider' => $stationProvider, 'searchModel' => $searchModel]) ?>

        <!-- station locator -->
<!--        <div class="row" align="center">-->
<!--            <a type="button" target="_blank" href="--><?//= Yii::$app->params['baseUrl'] . 'site/map' ?><!--" class="btn btn-primary">Xem bản đồ</a>-->
<!--        </div>-->

    </div>

</div>

<?php

?>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="<?=Yii::$app->homeUrl . 'js/storelocator/handlebars-1.0.0.js'?>"></script>
<script src="<?=Yii::$app->homeUrl . 'js/storelocator/jquery.storelocator.js'?>"></script>

<?php $this->registerCssFile(Yii::$app->homeUrl . 'css/storelocator/map.css') ?>

<div class="row">

    <div class="col-sm-12">
        <div class="panel panel-primary" id="panel-map">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="glyphicon glyphicon-map-marker"></i><span style="margin-right: 10px;">Bản đồ trạm</span>
                </h4>
            </div>
        </div>

        <div id="map-container">
            <div id="loc-list">
                <ul id="list"></ul>
            </div>
            <div id="map"></div>
        </div>
    </div>

</div>

<script type="text/javascript">
    jQuery(function ($) {
        $('#map-container').storeLocator({
            'dataLocation': '/locations/<?= Yii::$app->user->id . '.json' ?>'
        });
    });
</script>
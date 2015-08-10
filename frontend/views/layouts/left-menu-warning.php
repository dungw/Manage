<?php
/**
 * Created by PhpStorm.
 * User: JFog
 * Date: 7/16/2015
 * Time: 12:33 AM
 */

use common\components\helpers\Show;
use common\components\helpers\Convert;
use common\models\Area;
use common\models\Center;
use common\models\Station;

$areaList = Area::find()->all();
$centerList = Center::find()->all();
$query = Station::find()
    ->select('id, name')
    ->where([]);

if (isset($_GET['area']) && $_GET['area'] > 0) {
    $query->andWhere(['area_id' => $_GET['area']]);
}

if (isset($_GET['center']) && $_GET['center'] > 0) {
    $query->andWhere(['center_id' => $_GET['center']]);
}

$collections = $query->all();
$stationList[] = ['id' => '0', 'name' => 'Chọn trạm'];
if (!empty($collections)) {
    foreach ($collections as $col) {
        $stationList[] = ['id' => $col['id'], 'name' => $col['name']];
    }
}
//print '<pre>'; print_r($stationList); die;
?>
<!-- Filter -->
<form role="form" style="display: block; margin-bottom: 10px;" action="" method="get">
    <div class="filter-item" style="margin-top: 30px;">
        <?=Show::datePicker('from_date', (isset($_GET['from_date']) ? Convert::date2date($_GET['from_date'], 'd/m/Y', 'm/d/Y') : ''), 'Start date')?>
    </div>
    <div class="filter-item">
        <?=Show::datePicker('to_date', (isset($_GET['to_date']) ? Convert::date2date($_GET['to_date'], 'd/m/Y', 'm/d/Y') : ''), 'End date')?>
    </div>
    <div class="filter-item">
        <select onchange="filter();" name="area" id="filter-area">
            <option value="0">- Chọn tỉnh thành -</option>
            <?php
            if (isset($areaList)) {
                foreach ($areaList as $area) {
                    $selected = '';
                    if (isset($_GET['area']) && $_GET['area'] == $area['id']) {
                        $selected = 'selected="selected"';
                    }
                    ?>
                    <option <?= $selected ?> value="<?= $area->id ?>"><?= $area->name ?></option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
    <div class="filter-item">
        <select onchange="filter()" name="center" id="filter-center">
            <option value="0">- Chọn trung tâm -</option>
            <?php
            if (isset($centerList)) {
                foreach ($centerList as $center) {
                    $selected = '';
                    if (isset($_GET['center']) && $_GET['center'] == $center['id']) {
                        $selected = 'selected="selected"';
                    }
                    ?>
                    <option <?= $selected ?> value="<?= $center->id ?>"><?= $center->name ?></option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
    <div class="filter-item">
        <?= Show::multiSelect('station', isset($_GET['station']) ? $_GET['station'] : [], $stationList, 'id', 'name', '', ['class' => 'stations', 'style' => 'height: 300px;']) ?>
    </div>
    <div class="filter-item">
        <button type="submit" class="btn btn-primary btn-xs">Tìm kiếm</button>
    </div>
</form>
<style type="text/css">
    .filter-item {
        margin-bottom: 15px;
    }
    .filter-item input, .filter-item select {
        padding: 2px 5px;
        width: 90%;
    }
</style>
<script type="text/javascript">
    function filter()
    {
        var center = parseInt($('#filter-center').val());
        var area = parseInt($('#filter-area').val());
        $.ajax({
            type: 'post',
            url: '/warning/default/ajax-filter',
            data: {
                center: center,
                area: area
            },
            success: function(json) {
                if (json != '') {
                    data = $.parseJSON(json);
                    if (data['html'] != '') {
                        $('.stations').html(data['html']);

                    }
                }
            }
        })
    }
</script>

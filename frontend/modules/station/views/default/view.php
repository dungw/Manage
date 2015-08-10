<?php
use common\models\EquipmentStatus;
use common\models\DcEquipmentStatus;
use common\models\SensorStatus;
use common\models\Sensor;
use common\models\Message;
use common\models\Station;
use common\components\helpers\Show;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'DS Trạm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// url change configure
$changeUrl = Yii::$app->homeUrl . 'station/default/change-station-part';
?>
<script src="<?=Yii::$app->homeUrl . 'js/jquery-crontab-equipment.js'?>"></script>

<input type="hidden" id="station_id" value="<?=$model->id?>">

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title panel-equipment">
            <i class="glyphicon glyphicon-book"></i><?php echo $model->name ?> (<?php echo $model->code ?>)
        </h4>
    </div>
</div>


<table class="detail-view table table-hover table-bordered">
    <tr class="info">
        <th colspan="4">Giám sát cảm biến</th>
    </tr>
    <tr>
        <th width="3%">#</th>
        <th width="20%">Cảm biến</th>
        <th width="22%">Tình trạng</th>
        <th width="55%">Camera</th>
    </tr>

    <?php
    if (!empty($model->sensor_status)) {
        $no = 1;
        $countSensor = count($model->sensor_status);
        foreach ($model->sensor_status as $status) {
            $value = $status['value'];
            $label = $value;
            if ($status['type'] == Sensor::TYPE_VALUE) {
                continue;
            } else if ($status['type'] == Sensor::TYPE_CONFIGURE) {
                $message = Message::getMessageBySensor($status['sensor_id'], $value);
                $label = ($value == 0) ? Show::decorateString($message, 'bad') : Show::decorateString($message, 'good');
            }
            ?>
            <tr>
                <th style="text-align: center"><?=$no?></th>
                <td>
                    <div class="kv-attribute"><?= $status['name']?></div>
                </td>
                <td>
                    <div class="kv-attribute" id="sensor-<?=$status['sensor_id']?>-status"><?=$label?></div>
                </td>
                <?php
                if ($no == 1) {
                    if ($model->video_url != '') {
                        $camera = Show::cameraIp($model->video_url);
                    } else {
                        $camera = Show::fakeCameraIp($model->picture_url, 1000);
                    }
                    ?>
                    <td rowspan="<?=$countSensor?>">
                        <?=$camera?>
                    </td>
                    <?php
                }
                ?>
            </tr>
            <?php
            $no++;
        }
    }
    ?>
</table>

<table class="detail-view table table-hover table-bordered">
    <tr class="info">
        <th colspan="4">Trạng thái</th>
    </tr>

    <?php
    $no = 1;
    if (!empty($model->sensor_status)) {

        foreach ($model->sensor_status as $status) {
            $value = $status['value'];
            $label = $value;
            $labelButton = '';
            if ($status['type'] == Sensor::TYPE_VALUE) {
                if ($status['sensor_id'] == Sensor::ID_SECURITY) {
                    $label = Sensor::getSecurityStatus($value);
                    if ($value == Sensor::SECURITY_ON) {
                        $label = Show::decorateString($label, 'good');
                        $labelButton = '<a href="'. $changeUrl .'?part=security&station_id='. $model->id .'&status='. Sensor::SECURITY_OFF .'" type="button" class="btn btn-primary btn-xs">Tắt báo động</a>';
                    }
                    if ($value == Sensor::SECURITY_OFF) {
                        $label = Show::decorateString($label, 'bad');
                        $labelButton = '<a href="'. $changeUrl .'?part=security&station_id='. $model->id .'&status='. Sensor::SECURITY_ON .'" type="button" class="btn btn-primary btn-xs">Bật báo động</a>';
                    }
                }
            } else continue;

            if ($no == 1) {
                $connectStatus = $model->getStatus($model->status);
                if ($model->status == Station::STATUS_CONNECTED) {
                    $connectStatus = Show::decorateString($connectStatus, 'good');
                } else if ($model->status == Station::STATUS_LOST) {
                    $connectStatus = Show::decorateString($connectStatus, 'bad');
                }
                ?>
                <tr>
                    <th width="5%" style="text-align: center"><?=$no?></th>
                    <td width="45%">
                        <div class="kv-attribute">Tình trạng kết nối</div>
                    </td>
                    <td width="25%">
                        <div class="kv-attribute" id="connect-status"><?=$connectStatus?></div>
                    </td>
                    <td></td>
                </tr>
                <?php
                $no++;
            }
            ?>
            <tr>
                <th width="5%" style="text-align: center"><?=$no?></th>
                <td width="45%">
                    <div class="kv-attribute"><?=$status['name']?></div>
                </td>
                <td>
                    <div class="kv-attribute" id="sensor-<?=$status['sensor_id']?>-status"><?=$label?></div>
                </td>
                <td>
                    <div id="sensor-<?=$status['sensor_id']?>-button"><?= isset($labelButton) ? $labelButton : '' ?></div>
                </td>
            </tr>
            <?php
            $no++;
        }
    }
    ?>

</table>

<table class="detail-view table table-hover table-bordered" style="margin-bottom: 0px;">
    <tr class="info">
        <th colspan="3">Giám sát thiết bị</th>
        <th>
            <a href="http://<?=$model->ip?>:<?=$model->port?>" target="_blank" type="button" class="btn btn-primary btn-xs">Link đến thiết bị</a>
        </th>
    </tr>
    <?php
    $sc = Yii::$app->session->getFlash('update_success');
    if (isset($sc)) {
        ?>
        <tr>
            <td colspan="5"><?=Show::decorateString(Yii::$app->session->getFlash('update_success'), 'good')?></td>
        </tr>
        <?php
    }
    ?>
    <tr>
        <th width="5%">#</th>
        <th width="45%">Tên thiết bị</th>
        <th width="25%">Tình trạng</th>
        <th width="">Thiết lập</th>
    </tr>

    <?php
    if (isset($equipments) && !empty($equipments)) {
        $no = 1;
        $equipNum = count($equipments);
        foreach ($equipments as $equipment) {
            $hrefOn = $changeUrl . '?part=equip&id='. $equipment['id'] .'&station_id='. $model->id .'&status='. EquipmentStatus::STATUS_ON .'&configure='. EquipmentStatus::CONFIGURE_MANUAL;
            $hrefOff = $changeUrl . '?part=equip&id='. $equipment['id'] .'&station_id='. $model->id .'&status='. EquipmentStatus::STATUS_OFF .'&configure='. EquipmentStatus::CONFIGURE_MANUAL;
            $hrefAuto = $changeUrl . '?part=equip&id='. $equipment['id'] .'&station_id='. $model->id .'&configure='. EquipmentStatus::CONFIGURE_AUTO .'&status='. $equipment['status'];
            ?>
            <tr>
                <th style="text-align: center"><?=$no?></th>
                <td>
                    <div class="kv-attribute"><?=$equipment['name']?></div>
                </td>
                <td>
                    <div class="kv-attribute"><?=EquipmentStatus::getStatus($equipment['status'])?></div>
                </td>
                <td>
                    <div id="equip-<?=$equipment['id']?>" class="kv-attribute">
                        <?php
                        $underOn = 0;
                        $underOff = 0;
                        $underAuto = 0;
                        if ($equipment['configure'] == EquipmentStatus::CONFIGURE_AUTO) $underAuto = 1;
                        if ($equipment['configure'] == EquipmentStatus::CONFIGURE_MANUAL && $equipment['status'] == EquipmentStatus::STATUS_ON) $underOn = 1;
                        if ($equipment['configure'] == EquipmentStatus::CONFIGURE_MANUAL && $equipment['status'] == EquipmentStatus::STATUS_OFF) $underOff = 1;
                        ?>
                        <a id="equip-<?=$equipment['id']?>-on" class="<?=(isset($underOn) && $underOn == 1) ? 'text-underline' : ''?>" href="<?=(isset($underOn) && $underOn == 1) ? '#' : $hrefOn?>">Bật</a>  /
                        <a id="equip-<?=$equipment['id']?>-off" class="<?=(isset($underOff) && $underOff == 1) ? 'text-underline' : ''?>" href="<?=(isset($underOff) && $underOff == 1) ? '#' : $hrefOff?>">Tắt</a>  /
                        <a id="equip-<?=$equipment['id']?>-auto" class="<?=(isset($underAuto) && $underAuto == 1) ? 'text-underline' : ''?>" href="<?=(isset($underAuto) && $underAuto == 1) ? '#' : $hrefAuto?>">Tự động</a>
                    </div>
                </td>
            </tr>
            <?php

            $no++;
        }
    }
    ?>

</table>

<?php if (!empty($model->dc_equip_ids)) { ?>
<table class="detail-view table table-hover table-bordered">
    <tr>
        <th width="5%">#</th>
        <th width="45%">Thiết bị</th>
        <th width="25%">Dòng điện</th>
        <th>Điện áp</th>
    </tr>
    <tr>
        <td rowspan="<?=count($model->dc_equip_ids)?>" style="vertical-align: middle; text-align: center">Tủ DC</td>
        <?php
        if (!empty($model->dc_equip_status)) {
            foreach ($model->dc_equip_status as $equipStatus) {
                ?>
                <td>
                    <div class="kv-attribute"><?=$equipStatus['name']?></div>
                </td>
                <td id="dc-<?=$equipStatus['equipment_id']?>-amperage">
                    <div class="kv-attribute"><?= $equipStatus['amperage'] . '&nbsp;' . $equipStatus['unit_amperage'] ?></div>
                </td>
                <td id="dc-<?=$equipStatus['equipment_id']?>-voltage">
                    <div class="kv-attribute"><?= $equipStatus['voltage'] . '&nbsp;' . $equipStatus['unit_voltage'] ?></div>
                </td>
                </tr>
                <?php
            }
        }
        ?>
</table>
<?php } ?>

<table class="detail-view table table-hover table-bordered">
    <tr class="info">
        <th colspan="3">Giám sát hệ thống nguồn điện</th>
    </tr>
    <tr>
        <th width="5%">#</th>
        <th width="40%">Hạng mục</th>
        <th width="45%">Thông số</th>
    </tr>
    <?php
    if (isset($powerEquipments) && !empty($powerEquipments)) {
        $no = 1;
        foreach ($powerEquipments as $e) {
            ?>
            <tr>
                <th style="text-align: center"><?=$no?></th>
                <td>
                    <div class="kv-attribute"><?=$e['name']?></div>
                </td>
                <td>
                    <div class="kv-attribute" id="power-<?=$e['item_id']?>-status"><?=$e['status']?></div>
                </td>
            </tr>
            <?php
            $no++;
        }
    }
    ?>
</table>

<table class="detail-view table table-hover table-bordered">
    <tr class="info">
        <th colspan="2">Thông tin trạm</th>
    </tr>
    <tr>
        <td width="50%">
            <div class="kv-attribute">
                <b>Trung tâm: </b><span><?php echo isset($model->center->name) ? $model->center->name : '' ?></span>
            </div>
        </td>
        <td width="50%">
            <div class="kv-attribute">
                <b>Khu vực: </b><span><?php echo isset($model->area->name) ? $model->area->name : '' ?></span>
            </div>
        </td>
    </tr>
    <tr>
        <td width="50%">
            <div class="kv-attribute">
                <b>Người trực: </b><span><?php echo $model->staff ?></span>
            </div>
        </td>
        <td width="50%">
            <div class="kv-attribute">
                <b>Điện thoại: </b><span><?php echo $model->phone ?></span>
            </div>
        </td>
    </tr>
    <tr>
        <td width="50%">
            <div class="kv-attribute">
                <b>Email: </b><span><?php echo $model->email ?></span>
            </div>
        </td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="kv-attribute">
                <b>Thông tin thêm: </b><span><?php echo $model->addition ?></span>
            </div>
        </td>
    </tr>
</table>
<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\Station;
use common\models\StationStatus;

class UpdateController extends Controller {

    const LIMIT_DURATION = 90;

    public function actionIndex() {
        $stations = Station::find()->all();
        if (!empty($stations)) {
            foreach ($stations as $station) {
                $lastTime = 0;
                $lastStatus = StationStatus::find()
                    ->where([
                        'station_id' => $station['id'],
                        'received' => StationStatus::STATUS_RECEIVED,
                        'status' => StationStatus::STATUS_OK
                    ])
                    ->orderBy('time_update DESC')
                    ->one();

                if ($lastStatus) {
                    $lastTime = $lastStatus['time_update'];
                }

                $currentTime = time();
                if ($lastTime > 0 && $lastTime >= ($currentTime - self::LIMIT_DURATION)) {
                    $status = Station::STATUS_CONNECTED;
                } else {
                    $status = Station::STATUS_LOST;
                }

                if ($status != $station['status']) {
                    Yii::$app->db->createCommand()
                        ->update('station', ['status' => $status, 'updated_at' => time()], ['id' => $station['id']])
                        ->execute();
                }

            }
        }
    }

    public function actionMap() {

    }

}
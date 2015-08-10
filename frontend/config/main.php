<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'homeUrl' => '/',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Ho_Chi_Minh',
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'station' => ['class' => 'frontend\modules\station\Station'],
        'area' => ['class' => 'frontend\modules\area\Area'],
        'center' => ['class' => 'frontend\modules\center\Center'],
        'staff' => ['class' => 'frontend\modules\staff\Staff'],
        'equipment' => ['class' => 'frontend\modules\equipment\Equipment'],
        'message' => ['class' => 'frontend\modules\message\Message'],
        'user' => ['class' => 'frontend\modules\user\User'],
        'power' => ['class' => 'frontend\modules\power\Power'],
        'warning' => ['class' => 'frontend\modules\warning\Warning'],
        'statistic' => ['class' => 'frontend\modules\statistic\Statistic'],
        'sensor' => ['class' => 'frontend\modules\sensor\Sensor'],
        'cronjob' => ['class' => 'frontend\modules\cronjob\Cronjob'],
        'station_type' => ['class' => 'frontend\modules\station_type\StationType'],
        'dc_equipment' => ['class' => 'frontend\modules\dc_equipment\DcEquipment'],
        'tbmt' => ['class' => 'frontend\modules\tbmt\Tbmt'],
        'gridview' => [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'authTimeout' => 5,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'baseUrl' => '',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

            ],
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_HTML,
            'charset' => 'UTF-8',
        ],
    ],
    'params' => $params,
];
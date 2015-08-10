<?php
namespace console\controllers;

use yii\console\Controller;
use console\models\SocketServer;
use common\models\Setting;

//turn off all error reporting
error_reporting(0);

class ServerController extends Controller {

    public $ip = '';
    public $port = '';
    public $maxClient = 100000;

    public function actionIndex() {
        if ($this->_setInfo()) {
            $server = new SocketServer($this->ip, $this->port);
            $server->max_clients = $this->maxClient;
            $server->hook("INPUT", "handle_input");
            $server->infinite_loop();
        } else {
            echo 'Server IP & Port has not been configured. Please configure server ip & server port'; die;
        }
    }

    private function _setInfo()
    {
        $setting = Setting::getSetting();
        if ($setting && $setting->server_ip != '' && $setting->server_port != '') {
            $this->ip = $setting->server_ip;
            $this->port = $setting->server_port;
            return true;
        }
        return false;
    }
}
<?php
namespace common\modules;

use \Yii;
use frontend\models\SignupForm;
use yii\base\Module;

class Base extends Module {

    // controller namespace
    public $controllerNamespace = '';

    // left menu items
    public $menus = [];

    // init function
    public function init() {
        parent::init();

        // custom initialization code goes here

    }

}
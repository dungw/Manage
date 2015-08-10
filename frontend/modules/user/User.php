<?php

namespace frontend\modules\user;

use common\modules\Base;

class User extends Base
{
    public $controllerNamespace = 'app\modules\user\controllers';
    public $menus = [
        ['label' => 'Thêm mới người dùng', 'url' => '/user/default/create'],
    ];

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

<?php

namespace frontend\modules\station;

use common\modules\Base;

class Station extends Base
{
    public $controllerNamespace = 'app\modules\station\controllers';

    public $menus = [
        ['label' => 'Thêm mới trạm', 'url' => '/station/default/create'],
    ];

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

<?php
namespace frontend\modules\tbmt;

use common\modules\Base;

class Tbmt extends Base
{
    public $controllerNamespace = 'frontend\modules\tbmt\controllers';

    public $menus = [
        ['label' => 'Thêm mới TBMT', 'url' => '/tbmt/default/create'],
    ];

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

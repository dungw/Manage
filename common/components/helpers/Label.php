<?php
/**
 * Created by PhpStorm.
 * User: JFog
 * Date: 8/11/2015
 * Time: 1:38 AM
 */
namespace common\components\helpers;

use common\models\enum\MscCategory;

class Label {

    public static function mscCategory($category)
    {
        switch ($category) {
            case MscCategory::HANG_HOA : return 'Hàng hóa';
            case MscCategory::XAY_LAP : return 'Xây lắp';
            case MscCategory::HON_HOP : return 'Hỗn hợp';
            case MscCategory::TU_VAN : return 'Tư vấn';
            case MscCategory::PHI_TU_VAN : return 'Phi tư vấn';
        }
    }

}
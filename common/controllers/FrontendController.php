<?php
namespace common\controllers;

use Yii;
use common\controllers\BaseController;
use common\models\Role;
use yii\helpers\Url;
use frontend\models\SignupForm;

class FrontendController extends BaseController {

    // position of user
    public $position;

    public function init() {
        $controllerId = $this->id;

        if (Yii::$app->user->isGuest && $controllerId != 'site') {
            $this->doLogin();
        }

        // set global language
        Yii::$app->language = 'vi';
    }

    public function beforeAction($action) {

        // check role
        if (!Yii::$app->user->isGuest) {
            $role = new Role();

            if (!$role->hasRole($action)) {
                $this->permissionDeny();
            }
        }

        return parent::beforeAction($action);
    }

    public function permissionDeny() {
        throw new \yii\web\HttpException(550, Yii::t('yii', 'Bạn không có quyền sử dụng tính năng này'));
    }

    public function doLogin() {
        $url = Url::toRoute(['/site/login']);
        $this->redirect($url);
    }

}

<?php
namespace common\models;

use Yii;
use yii\base\Model;
use frontend\models\SignupForm;

class Role extends Model {
    const POSITION_ADMINISTRATOR = 'administrator';
    const POSITION_ADMIN = 'admin';
    const POSITION_OBSERVER = 'observer';
    const POSITION_GUEST = 'guest';
    const ALL_MODULE = 'all';
    const ALL_FUNCTION = 'all';

    // position
    public $position;

    // is administrator or not
    public $isAdministrator = false;

    // is admin or not
    public $isAdmin = false;

    // is observer or not
    public $isObserver = false;

    public function getRoles() {
        return [
            self::POSITION_ADMINISTRATOR => [self::ALL_MODULE],
            self::POSITION_ADMIN => [
                'station'   => self::ALL_FUNCTION,
                'user'      => self::ALL_FUNCTION,
                'warning'   => self::ALL_FUNCTION,
                'statistic' => self::ALL_FUNCTION,
                'cronjob'   => self::ALL_FUNCTION,
            ],
            self::POSITION_OBSERVER => [
                'station' => ['index', 'view', 'status', 'update-status', 'cron-equipment-status'],
                'warning' => self::ALL_FUNCTION,
                'statistic' => self::ALL_FUNCTION,
                'cronjob'   => self::ALL_FUNCTION,
            ],
            self::POSITION_GUEST => [],
        ];
    }

    public function init() {
        $this->setPosition();
    }

    public function getRole($position) {
        $roles = $this->getRoles();
        return isset($roles[$position]) ? $roles[$position] : [];
    }

    public function getPosition() {
        return $this->position;
    }

    public function setPosition() {
        if (!Yii::$app->user->isGuest) {
            $userType = Yii::$app->user->getIdentity()->type;
            if ($userType == SignupForm::LEVEL_ADMINISTRATOR) {
                $this->position = self::POSITION_ADMINISTRATOR;
                $this->isAdministrator = true;
            }
            else if ($userType == SignupForm::LEVEL_ADMIN) {
                $this->position = self::POSITION_ADMIN;
                $this->isAdmin = true;
            }
            else if ($userType == SignupForm::LEVEL_OBSERVER) {
                $this->position = self::POSITION_OBSERVER;
                $this->isObserver = true;
            }

        } else {
            $this->position = self::POSITION_GUEST;
        }

    }

    public function hasRole($action) {

        // get action id
        $actionId = $action->id;

        // get module id
        $moduleId = $action->controller->module->id;

        // get controller id
        $controllerId = $action->controller->id;

        // get roles
        $roles = $this->getRole($this->position);

        // if controller id is site
        if ($controllerId != 'site') {
            // if value of module role is all
            if (isset($roles[0]) && $roles[0] == self::ALL_MODULE) {
                return true;
            } else {

                $moduleIds = array_keys($roles);

                // if module belong list module roles
                if (in_array($moduleId, $moduleIds)) {

                    // if value of function role is all
                    if (is_string($roles[$moduleId]) && $roles[$moduleId] == self::ALL_FUNCTION) return true;
                    if (is_array($roles[$moduleId])) {
                        if (in_array($actionId, $roles[$moduleId])) return true;
                    }

                } else {
                    return false;
                }
            }
        } else {
            return true;
        }

        return false;
    }
}
<?php
namespace frontend\models;

use Yii;
use common\models\User;
use frontend\models\SignupForm;

class UpdateInfo extends SignupForm
{
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['type', 'required', 'message' => 'Bạn chưa chọn cấp độ người dùng'],

            ['mobile', 'string', 'max' => 20],

            ['fullname', 'string', 'max' => 255],
        ];
    }

    public function updateInfo($id) {
        if ($this->validate()) {
            $user = User::findOne($id);
            $user->username = $this->username;
            $user->fullname = $this->fullname;
            $user->email = $this->email;
            $user->mobile = $this->mobile;
            $user->type = $this->type;
            $user->updated_at = time();
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }
    }
}

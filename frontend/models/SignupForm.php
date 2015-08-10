<?php
namespace frontend\models;

use Yii;
use common\models\Base;
use common\models\User;

class SignupForm extends Base
{
    const LEVEL_ADMINISTRATOR = 10;
    const LEVEL_ADMIN = 2;
    const LEVEL_OBSERVER = 1;

    public $username;
    public $email;
    public $password;

    public $_types = [
        ['label' => 'Quản trị viên', 'value' => self::LEVEL_ADMIN],
        ['label' => 'Quan sát viên', 'value' => self::LEVEL_OBSERVER],
    ];

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Tên đăng nhập đã tồn tại.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Email đã tồn tại.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['type', 'required', 'message' => 'Bạn chưa chọn cấp độ người dùng'],

            ['mobile', 'string', 'max' => 20],

            ['fullname', 'string', 'max' => 255],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->fullname = $this->fullname;
            $user->mobile = $this->mobile;
            $user->email = $this->email;
            $user->type = $this->type;
            $user->created_at = time();
            $user->created_by = Yii::$app->user->id;

            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    public static function _prepareDataSelect($collections, $key, $value) {
        $data[null] = 'Chọn cấp độ người dùng';
        return parent::_prepareDataSelect($collections, $key, $value, $data);
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Tên đăng nhập',
            'fullname' => 'Họ tên',
            'password' => 'Mật khẩu',
            'email' => 'Email',
            'mobile' => 'Số điện thoại',
            'type' => 'Cấp độ người dùng',
            'created_at' => 'Khởi tạo',
            'updated_at' => 'Cập nhật',
        ];
    }

    public function getType($type) {
        foreach ($this->_types as $t) {
            if ($t['value'] == $type) return $t['label'];
        }
        return null;
    }
}

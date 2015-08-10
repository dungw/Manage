<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\models\enum\MscCategory;
use common\models\Role;

// get role
$role = new Role();

// get current controller
$module = $this->context->module->id;
$controller = $this->context->id;
$action = $this->context->action->id;
$category = Yii::$app->request->get('category');

if (!Yii::$app->user->isGuest) {
    NavBar::begin([
        'brandLabel' => "Manage",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];

    // statistic menus
    $menuItems[] = [
        'label'     => 'TB mời thầu',
        'active'    => ($module == 'tbmt'),
        'items' => [
            ['label' => 'Hàng hóa', 'url' => ['/tbmt/default/index?category='.MscCategory::HANG_HOA], 'active' => ($module == 'tbmt' && $category == MscCategory::HANG_HOA)],
            ['label' => 'Xây lắp', 'url' => ['/tbmt/default/index?category='.MscCategory::XAY_LAP], 'active' => ($module == 'tbmt' && $category == MscCategory::XAY_LAP)],
            ['label' => 'Tư vấn', 'url' => ['/tbmt/default/index?category='.MscCategory::TU_VAN], 'active' => ($module == 'tbmt' && $category == MscCategory::TU_VAN)],
            ['label' => 'Hỗn hợp', 'url' => ['/tbmt/default/index?category='.MscCategory::HON_HOP], 'active' => ($module == 'tbmt' && $category == MscCategory::HON_HOP)],
            ['label' => 'Phi tư vấn', 'url' => ['/tbmt/default/index?category='.MscCategory::PHI_TU_VAN], 'active' => ($module == 'tbmt' && $category == MscCategory::PHI_TU_VAN)],
        ]
    ];
    $menuItems[] = [
        'label' => 'TB mời thầu - QT',
        'active'    => ($module == 'tbmtqt'),
        'items' => [
            ['label' => 'Hàng hóa', 'url' => ['/tbmtqt/default/index?category='.MscCategory::HANG_HOA], 'active' => ($module == 'tbmtqt' && $category == MscCategory::HANG_HOA)],
            ['label' => 'Xây lắp', 'url' => ['/tbmtqt/default/index?category='.MscCategory::XAY_LAP], 'active' => ($module == 'tbmtqt' && $category == MscCategory::XAY_LAP)],
            ['label' => 'Tư vấn', 'url' => ['/tbmtqt/default/index?category='.MscCategory::TU_VAN], 'active' => ($module == 'tbmtqt' && $category == MscCategory::TU_VAN)],
            ['label' => 'Hỗn hợp', 'url' => ['/tbmtqt/default/index?category='.MscCategory::HON_HOP], 'active' => ($module == 'tbmtqt' && $category == MscCategory::HON_HOP)],
            ['label' => 'Phi tư vấn', 'url' => ['/tbmtqt/default/index?category='.MscCategory::PHI_TU_VAN], 'active' => ($module == 'tbmtqt' && $category == MscCategory::PHI_TU_VAN)],
        ]
    ];
    $menuItems[] = [
        'label' => 'KQĐT - Trực tiếp',
        'active'    => ($module == 'kqdttt'),
        'items' => [
            ['label' => 'Hàng hóa', 'url' => ['/kqdttt/default/index?category='.MscCategory::HANG_HOA], 'active' => ($module == 'kqdttt' && $category == MscCategory::HANG_HOA)],
            ['label' => 'Xây lắp', 'url' => ['/kqdttt/default/index?category='.MscCategory::XAY_LAP], 'active' => ($module == 'kqdttt' && $category == MscCategory::XAY_LAP)],
            ['label' => 'Tư vấn', 'url' => ['/kqdttt/default/index?category='.MscCategory::TU_VAN], 'active' => ($module == 'kqdttt' && $category == MscCategory::TU_VAN)],
            ['label' => 'Hỗn hợp', 'url' => ['/kqdttt/default/index?category='.MscCategory::HON_HOP], 'active' => ($module == 'kqdttt' && $category == MscCategory::HON_HOP)],
            ['label' => 'Phi tư vấn', 'url' => ['/kqdttt/default/index?category='.MscCategory::PHI_TU_VAN], 'active' => ($module == 'kqdttt' && $category == MscCategory::PHI_TU_VAN)],
        ]
    ];

    // add by position
    /*if ($role->isAdministrator) {
        $menuItems[] = [
            'label' => 'Cài đặt',
            'items' => [
                ['label' => 'Trung tâm', 'url' => ['/center/default/index'], 'active' => ($module == 'center')],
                ['label' => 'Tỉnh thành', 'url' => ['/area/default/index'], 'active' => ($module == 'area')],
                ['label' => 'Thiết bị', 'url' => ['/equipment/default/index'], 'active' => ($module == 'equipment')],
                ['label' => 'Thiết bị nguồn điện', 'url' => ['/power/default/index'], 'active' => ($module == 'power')],
                ['label' => 'Thiết bị tủ DC', 'url' => ['/dc_equipment/default/index'], 'active' => ($module == 'dc_equipment')],
                ['label' => 'Thông báo', 'url' => ['/message/default/index'], 'active' => ($module == 'message')],
                ['label' => 'Cảm biến', 'url' => ['/sensor/default/index'], 'active' => ($module == 'sensor')],
                ['label' => 'Loại trạm', 'url' => ['/station_type/default/index'], 'active' => ($module == 'station_type')],
                ['label' => 'Người dùng', 'url' => ['/user/default/index'], 'active' => ($module == 'user')],
                ['label' => 'Cài đặt chung', 'url' => ['/site/setting'], 'active' => ($controller === 'site' && $action == 'setting')],
            ]
        ];
    }
    else if ($role->isAdmin) {
        $menuItems[] = [
            'label' => 'Cài đặt',
            'items' => [
                ['label' => 'Người dùng', 'url' => ['/user/default/index'], 'active' => ($module == 'user')],
            ]
        ];
    }*/

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
}
?>
<div id="latest-warning-block"></div>

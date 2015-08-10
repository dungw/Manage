<?php
use yii\helpers\Html;

$module = $this->context->module->id;
$action = $this->context->action->id;
$menus = $this->context->module->menus;
$route = $this->context->route;

//index warning
if ($module == 'warning' && $action == 'index') {
    include 'left-menu-warning.php';
} else {
    foreach ($menus as $i => $menu) {
        $temp = explode('?', $menu['url']);
        $menus[$i]['active'] = strpos(trim($temp[0]), $route) ? 1 : 0;
    }
    $this->params['nav-items'] = $menus;
    ?>
    <div id="manager-menu" class="list-group">
        <?php
        foreach ($menus as $menu) {
            $label = Html::tag('i', '', ['class' => 'glyphicon glyphicon-chevron-right pull-right']) .
                Html::tag('span', Html::encode($menu['label']), []);
            $active = $menu['active'] ? ' active' : '';
            echo Html::a($label, $menu['url'], [
                'class' => 'list-group-item' . $active,
            ]);
        }
        ?>
    </div>
<?php
}



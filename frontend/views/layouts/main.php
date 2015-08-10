<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php $this->registerCssFile(Yii::$app->homeUrl . 'css/custom-styles.css') ?>
    <?php $this->registerCssFile(Yii::$app->homeUrl . 'js/dialog/css/jquery.dialogbox.css') ?>
    <?php $this->registerCssFile(Yii::$app->homeUrl . 'css/magnific-popup.css') ?>

    <script src="<?= Yii::$app->homeUrl . 'js/jquery-1.10.1.min.js' ?>"></script>
    <script src="<?= Yii::$app->homeUrl . 'js/dialog/js/jquery.dialogBox.js' ?>"></script>
    <script src="<?= Yii::$app->homeUrl . 'js/jquery.magnific-popup.js'?>"></script>

    <?php if ($this->context->id == 'site' && $this->context->action->id == 'index') { ?>
        <script src="<?= Yii::$app->homeUrl . 'js/jquery-crontab-warning.js' ?>"></script>
    <?php } else { ?>
        <script src="<?= Yii::$app->homeUrl . 'js/global-crontab-warning.js' ?>"></script>
    <?php } ?>

</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">

    <?php echo $this->render('top-menu') ?>

    <div class="container">
        <?php
        if (!Yii::$app->user->isGuest) {
            echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);
        }
        ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <b>&copy; <?= date('Y') . '. ' . Yii::$app->params['brandName'] ?></b>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

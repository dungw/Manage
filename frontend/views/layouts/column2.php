<?php
use yii\widgets\Menu;

$this->beginContent('@frontend/views/layouts/main.php');
?>

    <div class="container">

        <div class="col-sm-2">
            <?php echo $this->render('left-menu') ?>
        </div>

        <div id="content" class="col-sm-10">
            <?php echo $content; ?>
        </div>

    </div>
<?php $this->endContent(); ?>
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Lỗi này xảy ra trong quá trình Server xử lý yêu cầu của bạn.
    </p>
    <p>
        Hãy liên hệ với người quản trị để hiểu rõ hơn. Xin cảm ơn.
    </p>

</div>

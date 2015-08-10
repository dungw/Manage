<?php
use common\components\helpers\Show;

$this->title = Yii::$app->params['brandName'] . ' ' . Yii::$app->params['projectName'];
?>

<div class="site-index">

    <div class="body-content" align="center">

        <form action="" method="post">

            <div class="hidden-block">
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>">
            </div>

            <table class="table table-striped table-bordered" style="width: 50% !important;">
                <?php
                $msg = Yii::$app->session->getFlash('update_success');
                if ($msg) {
                ?>
                <tr>
                    <td colspan="2"><?= Show::successMessage($msg) ?></td>
                </tr>
                <?php
                }
                ?>
                <tr>
                    <td width="30%"><span>IP Server</span></td>
                    <td>
                        <input class="form-control" type="text" name="server_ip" value="<?=$model->server_ip?>">
                    </td>
                </tr>
                <tr>
                    <td><span>Port Server</span></td>
                    <td>
                        <input class="form-control" type="text" name="server_port" value="<?=$model->server_port?>">
                    </td>
                </tr>
                <tr>
                    <td><span>Mật khẩu root</span></td>
                    <td>
                        <input class="form-control" type="password" name="password_root" value="******">
                        <?= isset($errors['password']) ? Show::errorBlock($errors['password']) : '' ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </td>
                </tr>
            </table>

        </form>

    </div>

</div>

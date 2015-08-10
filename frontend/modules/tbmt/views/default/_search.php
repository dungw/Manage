<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css" />

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<div class="tbmt-search" style="overflow: hidden;">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <table class="tbl-search" width="100%">
        <tr>
            <td width="30%">
                <div class="form-group">
                    <label>Khoảng thời gian</label>
                    <input type="text" name="date-range" class="form-control" value="<?= isset($_GET['date-range']) ? $_GET['date-range'] : null ?>" placeholder="Chọn ngày..." />
                </div>
            </td>
            <td width="20%">
                <div class="form-group">
                    <label>Thời gian</label>
                    <select name="date-type" class="form-control">
                        <option <?= (isset($_GET['date-type']) && $_GET['date-type'] == 'thoi_diem_dang_tai') ? 'selected="selected"' : '' ?> value="thoi_diem_dang_tai">Thời điểm đăng tải</option>
                        <option <?= (isset($_GET['date-type']) && $_GET['date-type'] == 'thoi_diem_dong_thau') ? 'selected="selected"' : '' ?> value="thoi_diem_dong_thau">Thời điểm đóng thầu</option>
                    </select>
                </div>
            </td>
            <td width="50%">
                <div class="form-group">
                    <label>Export</label><br>
                    <a href="" class="btn btn-success btn-xs">Export hôm nay</a>
                    <a href="" class="btn btn-success btn-xs">Export tuần này</a>
                    <a href="" class="btn btn-success btn-xs">Export tháng này</a>
                </div>
            </td>
        </tr>
    </table>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-xs']) ?>
        <a href="" class="btn btn-success btn-xs">Export</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    jQuery(function($) {
        $('input[name="date-range"]').daterangepicker({
            locale: {
                format: 'MM/DD/YYYY'
            }
        });
    });
</script>
<style type="text/css">
    .tbl-search {

    }
    .tbl-search td {
        padding: 1px 5px;
    }
</style>

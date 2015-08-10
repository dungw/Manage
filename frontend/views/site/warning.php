<?php
use common\models\Warning;
use common\components\helpers\Show;
?>

<div class="row">

    <div class="col-sm-12 scrolling div-warning">
        <div class="panel panel-primary" id="panel-warning">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="glyphicon glyphicon-alert"></i><span style="margin-right: 10px;">Cảnh báo mới nhất</span>
                </h4>
            </div>
        </div>

        <table id="warning-table" class="detail-view table table-hover table-bordered" style="margin-bottom: 0px;">
            <tr class="warning-heading">
                <th width="15%">Trạm</th>
                <th width="10%">Khu vực</th>
                <th width="10%">Trung tâm</th>
                <th>Nội dung</th>
                <th width="10%">Thời gian</th>
                <th width="14%"></th>
            </tr>

            <?php
            if (isset($warnings) && !empty($warnings)) {
                print Show::warnings($warnings, false);
            }
            ?>

        </table>
    </div>

</div>

<script type="text/javascript">
    jQuery(function ($) {

        $(document).on('click', '.do-read', function() {
            var warning = $(this).parent().parent().parent().parent();
            var id = warning.attr('id');
            var stationHref = warning.attr('station-href');

            $.ajax({
                'method' : 'post',
                'url' : '/warning/default/read',
                'data' : {
                    'warning_id' : id,
                    '<?=Yii::$app->request->csrfParam?>' : '<?=Yii::$app->request->csrfToken?>'
                },
                'beforeSend' : function() {
                    warning.find('td').css('background-color', 'white !important');
                },
                'success' : function(data) {
                    warning.removeClass('unread');
                    warning.addClass('read');
                }
            });
        });

        $('.gallery').each(function() {
            $(this).magnificPopup({
                delegate: 'button',
                type: 'image',
                gallery: {
                    enabled:true
                }
            });
        });
    });
</script>

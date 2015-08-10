<?php
namespace common\components\helpers;

use \Yii;
use yii\helpers\BaseHtml;
use yii\helpers\BaseVarDumper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use common\models\Warning;
use common\components\helpers\Convert;

class Show extends BaseHtml
{

    public static function submitButton($model) {
        $html = '<div class="form-group">';
        $html .= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        $html .= '</div>';
        return $html;
    }

    public static function jsWarningAction() {
        $html = '<script stype="text/javascript">';
        $html .= "jQuery(function ($) {
            $('.do-read').click(function() {
                var warning = $(this).parent().parent().parent().parent();
                var id = warning.attr('id');
                var stationHref = warning.attr('station-href');

                $.ajax({
                    'method' : 'post',
                    'url' : '/warning/default/read',
                    'data' : {
                        'warning_id' : id,
                        '". Yii::$app->request->csrfParam ."' : '". Yii::$app->request->csrfToken ."'
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
        });";

        $html .= '</script>';
        return $html;
    }

    public static function warnings($warnings, $loadJs = true) {
        $html = '';
        if (isset($warnings) && !empty($warnings)) {

            foreach ($warnings as $warning) {

                // read or unread
                $class = 'read';
                $buttonClass = '';
                if ($warning['read'] == Warning::STATUS_UNREAD) {
                    $class = 'unread';
                    $buttonClass = 'do-read';
                }

                // gallery
                $gallery = '<div class="gallery">';
                if (!empty($warning['pics'])) {
                    $no = 1;
                    foreach ($warning['pics'] as $pic) {
                        $hide = 1;
                        if ($no == 1) {
                            $hide = 0;
                        }
                        $style = ($hide) ? 'display: none;' : '';
                        $path = Yii::$app->params['baseUrl'] . 'uploads/' . $pic['picture'];
                        $gallery .= '<button style="' . $style . '" class="btn btn-warning btn-xs '. $buttonClass .'" href="' . $path . '">Xem ảnh</button>';
                        $no++;
                    }
                } else {
                    $gallery .= self::decorateString('<span>Lỗi camera</span>', 'bad');
                }

                // station href
                $stationHref = Yii::$app->homeUrl . 'station/default/view?id=' . $warning['station_id'];

                // view station button
                $gallery .= '<a href="'. $stationHref .'" target="_blank" style="float: right" class="btn btn-success btn-xs '. $buttonClass .' view-picture">Chi tiết trạm</a>';
                $gallery .= '</div>';
                $html .= '<tr class="warning '. $class .'" id="'. $warning['id'] .'" station-href="'. $stationHref .'">';
                $html .= '<td><div class="kv-attribute">'. $warning['station_name'] .'</div></td>';
                $html .= '<td><div class="kv-attribute">'. $warning['area_name'] .'</div></td>';
                $html .= '<td><div class="kv-attribute">'. $warning['center_name'] .'</div></td>';
                $html .= '<td><div class="kv-attribute">'. $warning['message'] .'</div></td>';
                $html .= '<td><div class="kv-attribute">'. date('d/m/Y H:i', $warning['warning_time']) .'</div></td>';
                $html .= '<td><div class="kv-attribute">'. $gallery .'</div></td>';
                $html .= '</tr>';

            }
        }

        return $html;
    }

    public static function warningsTable($warnings, $loadJs = true) {
        $html = '';
        if (isset($warnings) && !empty($warnings)) {

            $html .= '<table id="warning-table" class="detail-view table table-hover table-bordered" style="margin-bottom: 0px;">';
            $html .= '<tr class="warning-heading">';
            $html .= '<th width="15%">Trạm</th>';
            $html .= '<th width="13%">Khu vực</th>';
            $html .= '<th width="13%">Trung tâm</th>';
            $html .= '<th>Nội dung</th>';
            $html .= '<th width="15%">Thời gian</th>';
            $html .= '<th width="18%"></th>';
            $html .= '</tr>';

            foreach ($warnings as $warning) {

                // read or unread
                $class = 'read';
                $buttonClass = '';
                if ($warning['read'] == Warning::STATUS_UNREAD) {
                    $class = 'unread';
                    $buttonClass = 'do-read';
                }

                // gallery
                $gallery = '<div class="gallery">';
                if (!empty($warning['pics'])) {
                    $no = 1;
                    foreach ($warning['pics'] as $pic) {
                        $hide = 1;
                        if ($no == 1) {
                            $hide = 0;
                        }
                        $style = ($hide) ? 'display: none;' : '';
                        $path = Yii::$app->params['baseUrl'] . 'uploads/' . $pic['picture'];
                        $gallery .= '<button style="' . $style . '" class="btn btn-warning btn-xs '. $buttonClass .'" href="' . $path . '">Xem ảnh</button>';
                        $no++;
                    }
                } else {
                    $gallery .= self::decorateString('<span>Lỗi camera</span>', 'bad');
                }

                // station href
                $stationHref = Yii::$app->homeUrl . 'station/default/view?id=' . $warning['station_id'];

                // view station button
                $gallery .= '<a href="'. $stationHref .'" target="_blank" style="float: right" class="btn btn-success btn-xs '. $buttonClass .' view-picture">Chi tiết trạm</a>';
                $gallery .= '</div>';
                $html .= '<tr class="warning '. $class .'" id="'. $warning['id'] .'" station-href="'. $stationHref .'">';
                $html .= '<td><div class="kv-attribute">'. $warning['station_name'] .'</div></td>';
                $html .= '<td><div class="kv-attribute">'. $warning['area_name'] .'</div></td>';
                $html .= '<td><div class="kv-attribute">'. $warning['center_name'] .'</div></td>';
                $html .= '<td><div class="kv-attribute">'. $warning['message'] .'</div></td>';
                $html .= '<td><div class="kv-attribute">'. date('d/m/Y H:i', $warning['warning_time']) .'</div></td>';
                $html .= '<td><div class="kv-attribute">'. $gallery .'</div></td>';
                $html .= '</tr>';

            }
            $html .= '</table>';
        }

        return $html;
    }

    public static function datePicker($name, $value, $placeholder = 'dd / mm / yyyy')
    {
        $html = DatePicker::widget([
            'name' => $name,
            'value' => $value,
            'language' => 'vi',
            'dateFormat' => 'dd/MM/yyyy',
            'options' => [
                'placeholder' => $placeholder,
            ],
        ]);
        return $html;
    }

    public static function decorateString($string, $emotion)
    {
        $color = Yii::$app->params['color_of_' . $emotion];
        return '<span style="color: ' . $color . '">' . $string . '</span>';
    }

    public static function successMessage($msg)
    {
        return '<span style="color: #00BB00">' . $msg . '</span>';
    }

    public static function errorBlock($errors)
    {
        $html = [];
        if (is_array($errors) && !empty($errors)) {
            foreach ($errors as $error) {
                $html[] = '<div class="help-block"><span class="error-color">' . $error . '</span></div>';
            }
        }
        return implode('', $html);
    }

    public static function activeDropDownList($model, $attribute, $labels, $items, $options = [], $errors = [])
    {
        $options = empty($options) ? ['class' => 'form-select'] : $options;
        $html = '<div class="form-group">';
        $html .= '<label class="control-label">' . (isset($labels[$attribute]) ? $labels[$attribute] : '') . '</label><br>';
        $html .= parent::activeDropDownList($model, $attribute, $items, $options);
        $html .= self::errorBlock(isset($errors[$attribute]) ? $errors[$attribute] : []);
        $html .= '</div>';
        return $html;
    }

    public static function multiSelect($attribute, $needle, $haystack, $key, $value, $labels, $options = [])
    {
        $newOptions = ['class' => 'form-listbox', 'multiple' => true];
        if (!empty($options)) $newOptions = array_merge($newOptions, $options);
        $sorted = array();
        if (!empty($haystack)) {
            foreach ($haystack as $object) {
                if (is_object($object)) {
                    if (isset($object->$key) && $object->$value) {
                        $sorted[$object->$key] = $object->$value;
                    }
                } elseif (is_array($object)) {
                    if (isset($object[$key]) && $object[$value]) {
                        $sorted[$object[$key]] = $object[$value];
                    }
                }
            }
        }
        $html = '<div class="form-group">';
        $html .= '<label class="control-label">' . (isset($labels[$attribute]) ? $labels[$attribute] : '') . '</label><br>';
        $html .= BaseHtml::listBox($attribute, $needle, $sorted, $newOptions);
        $html .= '</div>';
        return $html;
    }

    public static function input($type = '', $model, $attribute, $labels, $options = [], $errors = [])
    {
        $type = ($type == '') ? 'text' : $type;

        if (empty($options)) $options = ['class' => 'form-control'];
        $value = (is_object($model) && isset($model->$attribute)) ? $model->attribute : '';
        $html = '<div class="form-group">';
        $html .= '<label class="control-label">' . (isset($labels[$attribute]) ? $labels[$attribute] : '') . '</label><br>';
        $html .= parent::input($type, $attribute, $value, $options);
        $html .= self::errorBlock(isset($errors[$attribute]) ? $errors[$attribute] : []);
        $html .= '</div>';
        return $html;
    }

    public static function cameraIp($url, $options = [])
    {
        $default = ['style="width: 100%"'];
        $final = empty($options) ? $default : array_merge($options, $default);
        $html = '<img src="' . $url . '" ' . implode(' ', $final) . '>';
        return $html;
    }

    public static function fakeCameraIp($url, $refresh = 1000, $options = [])
    {
        $id = 'camera';
        $default = ['style="width: 100%"'];
        $final = empty($options) ? $default : array_merge($options, $default);
        $html  = '<img id="'. $id .'" src="' . $url . '" ' . implode(' ', $final) . '>';
        $html .= '<script type="text/javascript">
                    function refresh(node) {
                        var times = ' . $refresh . ';
                        (function startRefresh() {
                            var address;
                            if(node.src.indexOf(\'?\')>-1)
                                address = node.src.split(\'?\')[0];
                            else
                                address = node.src;
                            node.src = address+"?time="+new Date().getTime();
                            setTimeout(startRefresh,times);
                        })();
                    }
                    jQuery(document).ready(function() {
                        var node = document.getElementById(\'' . $id . '\');
                        refresh(node);
                    });
                </script>';

        return $html;
    }
}
var SECURITY_SENSOR_ID = 1;
var SECURITY_OFF = 0;
var SECURITY_OFF_LABEL = 'Đang tắt';
var SECURITY_OFF_CHANGE_LABEL = 'Bật báo động';
var SECURITY_ON = 1;
var SECURITY_ON_LABEL = 'Đang bật';
var SECURITY_ON_CHANGE_LABEL = 'Tắt báo động';
var CONNECTED = 1;
var CONNECTED_LABEL = 'Đang kết nối';
var DISCONNECT = 0;
var DISCONNECT_LABEL = 'Mất kết nối';
var PANEL = '.panel-equipment';
var TIME_LOOP_STATION = 60;
var LOADING_IMAGE = '<img class="loading" src="/images/loading.gif" />';
var CONFIGURE_AUTO = 0;
var CONFIGURE_MANUAL = 1;
var STATUS_ON = 1;
var STATUS_OFF = 0;
var CHANGE_URL = '/station/default/change-station-part';

jQuery(document).ready(function() {
    setInterval(updateDetails, TIME_LOOP_STATION * 1000);

    /**
     * Function to update equipment status
     */
    function updateDetails() {
        var station_id = $('#station_id').val();
        $.ajax({
            type: 'post',
            url: '/station/default/cron-detail-status',
            data: {
                station_id: station_id
            },
            beforeSend: function() {
                $(PANEL).append(LOADING_IMAGE);
            },
            success: function(json) {
                $(PANEL).find('.loading').remove();

                var data = $.parseJSON(json);
                var status_equipment = data['equipment'];
                var status_connect = data['connect'];
                var status_sensor = data['sensor'];
                var status_power = data['power'];
                var status_dc = data['dc'];

                // execute equipment status
                for (var i=0; i<status_equipment.length; i++) {
                    var prefix = '#equip-'+status_equipment[i]['id'];
                    var hrefAuto = '/station/default/change-station-part?part=equip&id=' + status_equipment[i]['id'] + '&station_id=' + station_id + '&status=' + status_equipment[i]['status'] + '&configure=' + CONFIGURE_AUTO;
                    var hrefOn = '/station/default/change-station-part?part=equip&id=' + status_equipment[i]['id'] + '&station_id=' + station_id + '&status=' + STATUS_ON + '&configure=' + CONFIGURE_MANUAL;
                    var hrefOff = '/station/default/change-station-part?part=equip&id=' + status_equipment[i]['id'] + '&station_id=' + station_id + '&status=' + STATUS_OFF + '&configure=' + CONFIGURE_MANUAL;

                    if (status_equipment[i]['configure'] == CONFIGURE_AUTO) {
                        makeup(prefix+'-auto');
                        cleanMakeup(prefix+'-on', hrefOn);
                        cleanMakeup(prefix+'-off', hrefOff);
                    } else if (status_equipment[i]['configure'] == CONFIGURE_MANUAL && status_equipment[i]['status'] == STATUS_ON) {
                        makeup(prefix+'-on');
                        cleanMakeup(prefix+'-auto', hrefAuto);
                        cleanMakeup(prefix+'-off', hrefOff);
                    } else if (status_equipment[i]['configure'] == CONFIGURE_MANUAL && status_equipment[i]['status'] == STATUS_OFF) {
                        makeup(prefix+'-off');
                        cleanMakeup(prefix+'-auto', hrefAuto);
                        cleanMakeup(prefix+'-on', hrefOn);
                    }
                }

                // execute dc status
                if ($.isArray(status_dc)) {
                    for (var i=0; i<status_dc.length; i++) {
                        var prefix = '#dc-' + status_dc[i]['equipment_id'];
                        $(prefix + '-amperage').html(status_dc[i]['amperage'] + '&nbsp;' + status_dc[i]['unit_amperage']);
                        $(prefix + '-voltage').html(status_dc[i]['voltage'] + '&nbsp;' + status_dc[i]['unit_voltage']);
                    }
                }

                // execute sensor status
                for (var i=0; i<status_sensor.length; i++) {

                    var prefix = '#sensor-' + status_sensor[i]['sensor_id'];
                    var label = '';
                    var button = '';
                    var button_href = '';

                    // this is security mode
                    if (status_sensor[i]['type'] == 2) {
                        if (status_sensor[i]['sensor_id'] == SECURITY_SENSOR_ID) {

                            if (status_sensor[i]['value'] == SECURITY_ON) {
                                label = decorateString(SECURITY_ON_LABEL, 'good');
                                button_href = CHANGE_URL + '?part=security&station_id=' + station_id + '&status=' + SECURITY_OFF;
                                button = '<a type="button" class="btn btn-primary btn-xs" href="' + button_href + '">' + SECURITY_ON_CHANGE_LABEL + '</a>';
                            }
                            if (status_sensor[i]['value'] == SECURITY_OFF) {
                                label = decorateString(SECURITY_OFF_LABEL, 'bad');
                                button_href = CHANGE_URL + '?part=security&station_id=' + station_id + '&status=' + SECURITY_ON;
                                button = '<a type="button" class="btn btn-primary btn-xs" href="' + button_href + '">' + SECURITY_OFF_CHANGE_LABEL + '</a>';
                            }

                            $(prefix + '-status').html(label);
                            $(prefix + '-button').html(button);
                        } else {
                            $(prefix + '-status').html(status_sensor[i]['value']);
                        }
                    }
                    // this is other sensor
                    else {
                        getMessageBySensor(status_sensor[i]['sensor_id'], status_sensor[i]['value'], prefix);

                    }

                }

                // execute power status
                for (var i=0; i<status_power.length; i++) {
                    var prefix = '#power-' + status_power[i]['item_id'];
                    $(prefix + '-status').html(status_power[i]['status']);
                }

                // execute connect status
                if (status_connect == CONNECTED) {
                    connectLabel = decorateString(CONNECTED_LABEL, 'good');
                }
                if (status_connect == DISCONNECT) {
                    connectLabel = decorateString(DISCONNECT_LABEL, 'bad');
                }
                $('#connect-status').html(connectLabel);

            }
        });
    }

    function makeup(id) {
        var obj = $(id);
        var currentClass = $(obj).attr('class');
        if (currentClass != 'text-underline') {
            $(obj).removeAttr('class');
            $(obj).addClass('text-underline');
            $(obj).attr('href', '#');
        }
    }

    function cleanMakeup(id, href) {
        var obj = $(id);
        $(obj).removeAttr('class');
        $(obj).attr('href', href);
    }

    function decorateString(str, emotion) {
        if (emotion == 'good') {
            return '<span style="color: #00BB00">'+ str +'</span>';
        }
        if (emotion == 'bad') {
            return '<span style="color: #FF0000">'+ str +'</span>';
        }
    }

    function getMessageBySensor(sensorID, sensorValue, prefix) {
        $.ajax({
            type: 'post',
            url: '/message/default/get-message',
            data: {
                sensor_id: sensorID,
                sensor_value: sensorValue
            },
            success: function(data) {
                if (sensorValue == 0) {
                    label = '<span style="color: #FF0000">'+ data +'</span>';
                }
                if (sensorValue == 1) {
                    label = '<span style="color: #00BB00">'+ data +'</span>';
                }
                $(prefix + '-status').html(label);
            }
        });
    }
});


/**
 * Created by JFog on 6/9/15.
 */
var TIME_LOOP = 30;
var ALARM_SOUND = '/sound/alarm.mp3';

jQuery(document).ready(function($) {

    // run after each TIME_LOOP(s)
    setInterval(findUnreadWarning, TIME_LOOP * 1000);

    function findUnreadWarning() {
        $.ajax({
            url: '/warning/default/cron-unread',
            type: 'post',
            data: {

            },
            beforeSend: function() {
                // do something before send
            },
            success: function(json) {
                var data = $.parseJSON(json);
                if (data['html']) {

                    if ($('#latest-warning-block').hasClass('show')) {

                    } else {

                        // open popup
                        $('#latest-warning-block').dialogBox({
                            type: 'correct',  //three type:'normal'(default),'correct','error',
                            width: 1000,
                            height: 400,
                            hasMask: true,
                            autoHide: false,
                            time: 3000,
                            effect: 'fall',
                            title: 'Cảnh báo mới',
                            content: data['html']
                        });

                        // turn on alarm sound
                        playSound();

                        // gallery
                        $('.gallery').each(function() {
                            $(this).magnificPopup({
                                delegate: 'button',
                                type: 'image',
                                gallery: {
                                    enabled:true
                                }
                            });
                        });

                    }

                }
            }
        });
    }

    function playSound() {
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', ALARM_SOUND);
        audioElement.setAttribute('autoplay', 'autoplay');
        audioElement.play();
    }

    $(document).on('click', '.do-read', function() {
        var warning = $(this).parent().parent().parent().parent();
        var id = warning.attr('id');
        var stationHref = warning.attr('station-href');

        $.ajax({
            'method' : 'post',
            'url' : '/warning/default/read',
            'data' : {
                'warning_id' : id
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

});

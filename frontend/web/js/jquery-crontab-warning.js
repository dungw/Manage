const TIME_LOOP = 10;
const WARNING_PANEL = '#panel-warning';
const WARNING_TABLE = '#warning-table';
const WARNING_TABLE_HEADING = '.warning-heading';
const WARNING_TABLE_ELEMENT = '.warning';
const WARNING_READ_ELEMENT = '.read';
const WARNING_UNREAD_ELEMENT = '.unread';
const WARNING_NUMB = 5;
const LOADING_IMAGE = '<img class="loading" src="/images/loading.gif" />';
const ALARM_SOUND = '/sound/alarm.mp3';

jQuery(document).ready(function($) {
    // run update warning
    setInterval(updateWarning, TIME_LOOP * 1000);

    // check unread
    checkUnread();

    function updateWarning() {
        var time = new Date().getTime() / 1000;
        time = parseInt(time);
        $.ajax({
            url: '/warning/default/cron-latest',
            type: 'post',
            data: {
                time_loop: TIME_LOOP,
                current_time: time
            },
            beforeSend: function() {
                $(WARNING_PANEL).find('.panel-title').append(LOADING_IMAGE);
            },
            success: function(json) {
                var data = $.parseJSON(json);
                var numbElement = $(WARNING_TABLE).find(WARNING_TABLE_ELEMENT).length;
                var numbElementNew = parseInt(data['count']);

                // remove loading image
                $(WARNING_PANEL).find('.loading').remove();

                if (numbElementNew > 0) {
                    // remove old elements
                    if (numbElementNew >= WARNING_NUMB) {
                        $(WARNING_TABLE).find(WARNING_READ_ELEMENT).remove();
                    } else {
                        for (var i=1; i<=numbElementNew; i++) {
                            $(WARNING_TABLE + ' ' + WARNING_READ_ELEMENT + ':last-child').remove();
                        }
                    }

                    // append new elements
                    $(WARNING_TABLE_HEADING).after(data['html']);

                    // gallery
                    recallPopup();

                    // play sound
                    playSound();

                } else {
                    // check unread warnings
                    checkUnread();
                }
            }
        });
    }

    // function that check if there are some unread warning
    function checkUnread() {
        var countUnread = $(WARNING_TABLE).find(WARNING_UNREAD_ELEMENT).length;
        if (countUnread >= 1) {
            playSound();
        }
    }

    // play sound function
    function playSound() {
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', ALARM_SOUND);
        audioElement.setAttribute('autoplay', 'autoplay');
        audioElement.play();
    }

    //recall popup
    function recallPopup() {
        $('.gallery').each(function() {
            $(this).magnificPopup({
                delegate: 'button',
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    }
});



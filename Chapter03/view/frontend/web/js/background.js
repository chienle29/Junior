define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
        'use strict';
        var click = 1;
        return Component.extend({
            defaults: {
                template: 'Junior_Chapter03/background',
            },

            colorAnimate: function () {
                if (click === 1) {
                    $('.option').addClass('animate-remove').removeClass('animate-add');
                    click = 2;
                } else {
                    $('.option').addClass('animate-add').removeClass('animate-remove');
                    click = 1;
                }

            },

            loadBackground: function () {
                var value = Object.values(this.data);
                var text = "";
                for (var i = 0; i < value.length; i++) {
                    var color = value[i]['color_code'];
                    text += '<div class="same-color" data-color="'+value[i]['color_code']+'" style="background-color: '+value[i]['color_code']+'" data-bind="event: { click: function(data, event) { setBackground(1, data, event) } }" id="'+value[i]['color']+'"></div>';
                }
                $('.color-contain').html(text);
            },

            setBackground: function (a,data,event) {
                var current = event.currentTarget;
                var value = $(current).attr('data-color');
                $('body').css('backgroundColor',value);
            },


        });
    }
);

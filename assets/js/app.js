/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import '../css/app.scss';
import getNiceMessage from './main';
import $ from 'jquery';
import 'bootstrap';
import Swiper from "swiper";

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';
var Application = {};
Application.login = {
    init : function() {
        $(window).resize(function() {
            Application.module.loginSlider.AdjustWindow($('[data-module="loginSlider"]'));
        });
    }

};

Application.module = {

    init: function () {
        // Automatic module execute by data, example: <div data-module="nameFunction">...</div>
        $('[data-module]').each(function (index, module) {
            var key = $(module).data('module');
            if (typeof Application.module[key] != 'undefined') {
                Application.module[key].init($(module));
                $(module).addClass('module-js-init')
            }
        });
    },

    loginSlider : {
        init : function($module) {
            this.AdjustWindow($module);
            this.initSwiper($module);
            this.getmouseWheel();
        },

        TransitionisActive : false,

        getmouseWheel : function(){
            var supportsWheel = false;
            function DoSomething (e) {
                if(!Application.module.loginSlider.TransitionisActive){
                    /* Check whether the wheel event is supported. */
                    if (e.type == "wheel") supportsWheel = true;
                    else if (supportsWheel) return;

                    /* Determine the direction of the scroll (< 0 → up, > 0 → down). */
                    var delta = ((e.deltaY || -e.wheelDelta || e.detail) >> 10) || 1;

                    var HomeSwiperInstance = $('.swiper-container')[0].swiper;
                    if(delta == -1){
                        HomeSwiperInstance.slidePrev();
                    }else if(delta == 1){
                        HomeSwiperInstance.slideNext();
                    }
                }
            }

            /* Add the event listeners for each event. */
            document.addEventListener('wheel', DoSomething);
            document.addEventListener('mousewheel', DoSomething);
            document.addEventListener('DOMMouseScroll', DoSomething);
        },

        AdjustWindow : function($module){
            var ClientWindowHeight = window.innerHeight,
                 ClientWindowWidth = window.innerWidth;



          $.each($module.find('.swiper-slide'),function(idx, el){
              console.log($(el).find("div").first());
                $(el).find(".bg").css("height",ClientWindowHeight);
                $(el).find(".bg").css("width",ClientWindowWidth);
          });

            $('.swiper-container').first().css("height",ClientWindowHeight);
            $('.swiper-container').first().css("width",ClientWindowWidth);

        },
        initSwiper : function($module) {
            new Swiper($module.find('.swiper-container'), {
                direction: 'vertical',
                speed:1000,
                parallax:true,
                height: Application.module.loginSlider.ClientWindowHeight,
                width: Application.module.loginSlider.ClientWindowWidth,
                pagination: {
                    el: $module.find('.swiper-pagination'),
                    clickable: true,
                },
                on : {
                    slideChangeTransitionStart : function(){
                        if(!Application.module.loginSlider.TransitionisActive){
                            Application.module.loginSlider.TransitionisActive = true;
                        }
                    },
                    slideChangeTransitionEnd : function(){
                        if(Application.module.loginSlider.TransitionisActive){
                            Application.module.loginSlider.TransitionisActive = false;
                        }
                    }
                }
            });
        }
    }
};

Application.core = function() {
    $.each(Application, function(key, val) {
        if (Application[key].hasOwnProperty('init'))
            if (typeof Application[key].init == 'function')
                Application[key].init();
    });
};

$(document).ready(Application.core);

console.log(getNiceMessage(50));

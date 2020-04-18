import $ from "jquery";
import Swiper from "swiper";


export default function(){

  var Application = {};

  Application.login = {
    init : function() {
      var self = this
      $(window).resize(function() {
        console.log("epp");
        self.loginSlider.AdjustWindow($('[data-module="loginSlider"]'));
      });
      self.loginSlider.init($('[data-module="loginSlider"]'));
      self.signUp.init();
      self.login.logIn();
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
          if(!Application.login.loginSlider.TransitionisActive){
            if (e.type == "wheel") supportsWheel = true;
            else if (supportsWheel) return;
            var delta = ((e.deltaY || -e.wheelDelta || e.detail) >> 10) || 1;
            var HomeSwiperInstance = $('.swiper-container')[0].swiper;
            if(delta == -1){
              HomeSwiperInstance.slidePrev();
            }else if(delta == 1){
              HomeSwiperInstance.slideNext();
            }
          }
        }
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
          height: Application.login.loginSlider.ClientWindowHeight,
          width: Application.login.loginSlider.ClientWindowWidth,
          pagination: {
            el: $module.find('.swiper-pagination'),
            clickable: true,
          },
          on : {
            slideChangeTransitionStart : function(){
              if(!Application.login.loginSlider.TransitionisActive){
                Application.login.loginSlider.TransitionisActive = true;
              }
            },
            slideChangeTransitionEnd : function(){
              if(Application.login.loginSlider.TransitionisActive){
                Application.login.loginSlider.TransitionisActive = false;
              }
            }
          }
        });
      }
    },
    signUp : {
        init : function(){

          $("#generateUser").on("submit",function(e){

            e.preventDefault();

            var fd = new FormData(document.getElementById("generateUser"));
            fd.append("CustomField", "This is some extra data");
            $.ajax({
              url: $(this).attr("action"),
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false,
            }).done(function(data) {

            });


          });
        },
        logIn : {
          init: function () {
            $("#LoginForm").on("submit", function (e) {
              e.preventDefault();
              this.tryToLogIn();
            });
          },
          tryToLogIn: function (user, password) {

              $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: {"email":"polcerdan@gmail.com","password":"123"},
                processData: false,  // tell jQuery not to process the data
                contentType: false,
              }).done(function(data) {
                console.log(data);
              });
          }


        }

    }

  };

  return Application;
};
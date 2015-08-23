// JavaScript Document
            $(document).ready(function(){
                
                $('#yii-debug-toolbar').hide();

// To initially run the function:
//$(window).resize();

            /*$('.userText').hide();         
                   var userNames = $("#userName").val();
               $("#nextBtn").on('click',function(){
                if( userNames.length >= 10 && userNames.length != '')  {    
                $('.userText').show().html('').append( "<img src='images/pf.jpg' alt='profile Image' /> <label class='userLabel'> " +userNames+ "@gmail.com</label>" );
                $('#userDisplay, #nextBtn').hide()
                $('#passDisplay').show()
                    }else
                    {
                        $('.userText').html('')
                    }

                }); */
                
                $('#nextBtn').on('click', function (){
                var texted=$("#userName").val();
                                if (texted.length >= 10 && texted.length !=''){
                                                $('.userText').html('').append('<img src="images/pf.jpg" alt="profile Image" />&nbsp;' + texted + '@gmail.com').css('text-transform','capitalize');
                                                $('#userDisplay, #nextBtn').hide()
                                                $('#passDisplay').show()
                                                return false
                                } else{
                                                $('.userText').html('');
                                                return true
                                }
                });
                 $("#userName, #passWord").each(function(){ 
                        var phvalue = $(this).attr("placeholder");  
                        $(this).before( "<label class='dynaLabel displayNone'>" +phvalue+ "</label>" );
                        $('#userName, #passWord').keyup(function() {
                          if ( this.value != ''){
                             $(this).prev('.dynaLabel').css('display','inline-block').addClass('animateLabel fadeInUpLabel').show()
                             }
                              else {
                                $(this).prev('.dynaLabel').hide();
                                  }
                         });
                 });

                });
      


      $(function(){
    jQuery.fn.center = function ()
    {
        this.css("position","absolute");
        this.css("top", ($(window).height() / 2) - (this.outerHeight() / 2));
        this.css("left", ($(window).width() / 2) - (this.outerWidth() / 2));
        return this;
    }
   
    $('#contentArea').center();
    $('.bg-sky-effect').css({'height':$('#contentArea').height()+110,'position':'absolute'});
    $(window).resize(function(){
       $('#contentArea').center();
       $('.bg-sky-effect').css('height',$('#contentArea').height()+110);
    });
}); 
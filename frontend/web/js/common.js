// JavaScript Document
			$(document).ready(function(){
				
				$(window).resize(function(){
					$('.concept-container').css({
						position:'absolute',
						//left: ($(window).width() - $('.className').outerWidth())/2,
						top: ($(window).height() - $('.mediBg').outerHeight())/2
					});
					$('.register-container').css({
						position:'absolute',
						width:'100%',
						//left: ($(window).width() - $('.className').outerWidth())/2,
						top: ($(window).height() - $('.mediBg').outerHeight())/2,
						});
						$('.bg-sky-effect').css({
							height:($(window).height()- $('.mediBg').outerHeight())/1.2
						});
				})

// To initially run the function:
$(window).resize();

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

				});	*/
				
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
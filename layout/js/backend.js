
/* Function to visable & hidden Placeholder for input-text*/ 
$(function(){
    'use strict';

// Trigger The SelectBoxit

$("select").selectBoxIt({
    autoWidth:false
});


        $('[placeholder]').focus(function(){
            $(this).attr('data-text', $(this).attr('placeholder'));
            $(this).attr('placeholder','');
             }).blur(function(){
            $(this).attr('placeholder',$(this).attr('data-text'));                                       
                                                              });
//function to make "asterisk-*"
             $('.any-type').after('<span class="any-ty">*</span>');
             $('#pass-asterisk').after('<span id="pass-ast">*</span>');
            });
//function to make "show or hide password button"         
           $(document).ready(function() {

            $("#icon-click").click(function(){
                
                var input = $("#pass");
                if(input.attr("type") === "password"){
                    input.attr("type","text");
                    $("#icon").toggleClass("fas fa-eye-slash");
                } else {
                    input.attr("type","password");
                    $("#icon").toggleClass("fas fa-eye");
                }

            });
//Confirmation Message On Button 

$('.confirm').click(function(){
   return confirm('Are You Sure?');
});

// Category View Option

$('.cat h3').click(function(){

        $(this).next('.full-view').fadeToggle(100);
});

$('.option span').click(function(){

    $(this).addClass('active').siblings('span').removeClass('active');

    if ($(this).data('view') === 'full') {

        $('.cat .full-view').fadeIn(200)

    }else {

        $('.cat .full-view').fadeOut(200)
    }

});
           }); 

(function ($) {
    "use strict";


    /*==================================================================
    [ Validate ]*/
    $('#form_create').submit(function(e) {
        e.preventDefault();
    });

    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });

    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }


})(jQuery);
$(document).ready(function () {
  $('#login_form_admin').click(function () {
    var $form = $('#form_create');
    data = $form.serialize();
    $.ajax({
      url: '/dpanel/login',
      method: 'post',
      data: data,
      cache : false,
      success: function (data) {
        if (data == 'account finded') {
            window.location.assign('/dpanel/dashboard');
        }else if(data == 'wrong'){
          alert('username or password wrong');
        }
        // console.log(data);
      }
    });
  });
});

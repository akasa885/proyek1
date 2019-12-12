$(function(){
 $(".datepicker").datepicker({
     format: 'dd-mm-yyyy',
     autoclose: true,
     todayHighlight: true,
 });

 var name = $('#i_rehab').val();
 if(name === "tat"){
   $(document).on('click','.form-check-input',function() {
       var abc = $(this).closest(".form-check-input").attr("id");
       var lastChar = abc.substr(abc.length - 1); // => "1"
       $('#'+abc).change(function () {
                 if (this.checked) {
                    $("#input_gram_"+lastChar).prop("disabled", false);
                 }else{
                   $("#input_gram_"+lastChar).prop("disabled", true);
                   $("#input_gram_"+lastChar).val(0);
                 }
           });
     });
 }
});

$(document).on('click','#refresh',function(){
  $.ajax({
     type:'GET',
     url:'/refreshcaptcha',
     success:function(data){
        $(".captcha span").html(data.captcha);
     }
  });
});
// window.setInterval(function(){
//   cek_isi();
// }, 5000);
$(document).ready(function() {
  $('#tipe_R').submit(function(e) {
      e.preventDefault();
  });
  $('#type_send').click(function () {
    var $form = $('#tipe_R');
    data = $form.serialize();
    $.ajax({
      type: 'GET',
      url: '/jenis-pengajuan',
      data: data,
      cache: false,
      success:function (data) {
        window.location.assign('/bnn/serv/3/'+data);
      }
    });
  });

  var form_name = $('#identiti').val();
  if (form_name === "pengaduan") {
      alert("Selamat Datang");
      $('#change_h').toggleClass('form-auto-add');
    } else if (form_name === "skhpn") {
      alert("Selamat Datang");
      $('#change_h').addClass('form-s-add');
    } else if (form_name === "sosialisasi") {
      alert("Selamat Datang");
    } else if (form_name === "rehab") {
      alert("Selamat Datang");
      $('#change_h').addClass('form-s-add');
    }else{
      $('#change_h').removeClass('paral-form');
    }
});

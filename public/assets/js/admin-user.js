var name_del ="";
var txt_html = '';


$(".datepicker").datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true,
});

$(document).ready(function() {
  txt_html = $('#view_result').html();
  $("#del_button_user button").on('click',function () {
    $('#DeleteModal').modal('show');
    name_del = $(this).attr("name");
  });

  setInterval(timestamp, 1000);
  setInterval(check_sess, 1000);

  $('#user-input-add').on('click', function () {
    $('#InputModal').modal('show');
  });
  $('#user-in-delete').on('click', function () {
    var cde = $('#del_button_user button' ).val();
    var mol = name_del.length % 2;
    if( mol == 1){
        var lastChar = name_del.substr(name_del.length - 1); // => "1"
    }else if ( mol == 0) {
      var lastChar = name_del.substr(name_del.length - 2); // => "1"
    }
    if (cde == '1') {
      $.ajax({
        type: "get",
        url: "/dpanel/delete/agama",
        data: {id : lastChar},
        cache: false,
        success: function (data) {
          if(data == 'deleted'){
            location.reload();
          }
        }
      });
    } else if (cde == '2') {
      $.ajax({
        type: "get",
        url: "/dpanel/delete/job",
        data: {id : lastChar},
        cache: false,
        success: function (data) {
          if(data == 'deleted'){
            location.reload();
          }
        }
      });
    } else if (cde == '3') {
      $.ajax({
        type: "get",
        url: "/dpanel/delete/narkoba",
        data: {id : lastChar},
        cache: false,
        success: function (data) {
          if(data == 'deleted'){
            location.reload();
          }
        }
      });
    }else if (cde == '4') {
      $.ajax({
        type: "get",
        url: "/dpanel/delete/suku",
        data: {id : lastChar},
        cache: false,
        success: function (data) {
          if(data == 'deleted'){
            location.reload();
          }
        }
      });
    }else if (cde == '7') {

    }else if (cde == '8') {
      $.ajax({
        type: "get",
        url: "/dpanel/delete/pegawai",
        data: {id : lastChar},
        cache: false,
        success: function (data) {
          if(data == 'deleted'){
            location.reload();
          }
        }
      });
    }else if (cde == '9') {
      $.ajax({
        type: "get",
        url: "/dpanel/delete/user",
        data: {id : lastChar},
        cache: false,
        success: function (data) {
          if(data == 'deleted'){
            location.reload();
          }
        }
      });
    }
  });

  $('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
    $('#user_create_button').prop("disabled", false);
  } else{
    $('#message').html('Not Matching').css('color', 'red');
    $('#user_create_button').prop("disabled", true);
  }
  });

  $('#form_create').submit(function(e) {
      e.preventDefault();
  });
  $()
  $('#user_create_button').click(function () {
    var $form = $('#form_create');
    data = $form.serialize();
    $.ajax({
      type: 'post',
      url: '/dpanel/create/user',
      data: data,
      cache: false,
      success:function (data) {
        if(data.errors)
        {
          jQuery.each(data.errors, function(key, value){
                          jQuery('.alert-danger').show();
                          jQuery('.alert-danger').append('<p>'+value+'</p>');
                        });
        }else {
          $('.alert-danger').hide();
          alert("Akun Berhasil Dibuat!");
          location.reload();
        }
      }
    });
  });

  $('#job_create_button').click(function () {
    var $form = $('#form_create');
    data = $form.serialize();
    $.ajax({
      type: 'post',
      url: '/dpanel/create/job',
      data: data,
      cache: false,
      success:function (data) {
        if(data.errors)
        {
          jQuery.each(data.errors, function(key, value){
                          jQuery('.alert-danger').show();
                          jQuery('.alert-danger').append('<p>'+value+'</p>');
                        });
        }else {
          $('.alert-danger').hide();
          alert("Pekerjaan Berhasil Dibuat!");
          location.reload();
        }
      }
    });
  });

  $('#narcotic_create_button').click(function () {
    var $form = $('#form_create');
    data = $form.serialize();
    $.ajax({
      type: 'post',
      url: '/dpanel/create/narkoba',
      data: data,
      cache: false,
      success:function (data) {
        if(data.errors)
        {
          jQuery.each(data.errors, function(key, value){
                          jQuery('.alert-danger').show();
                          jQuery('.alert-danger').append('<p>'+value+'</p>');
                        });
        }else {
          $('.alert-danger').hide();
          alert("Narkoba Berhasil Dibuat!");
          location.reload();
        }
      }
    });
  });

  $('#agama_create_button').click(function () {
    var $form = $('#form_create');
    data = $form.serialize();
    $.ajax({
      type: 'post',
      url: '/dpanel/create/agama',
      data: data,
      cache: false,
      success:function (data) {
        if(data.errors)
        {
          jQuery.each(data.errors, function(key, value){
                          jQuery('.alert-danger').show();
                          jQuery('.alert-danger').append('<p>'+value+'</p>');
                        });
        }else {
          $('.alert-danger').hide();
          alert("Agama baru berhasil ditambahkan!");
          location.reload();
        }
      }
    });
  });

  $('#suku_create_button').click(function () {
    var $form = $('#form_create');
    data = $form.serialize();
    $.ajax({
      type: 'post',
      url: '/dpanel/create/suku',
      data: data,
      cache: false,
      success:function (data) {
        if(data.errors)
        {
          jQuery.each(data.errors, function(key, value){
                          jQuery('.alert-danger').show();
                          jQuery('.alert-danger').append('<p>'+value+'</p>');
                        });
        }else {
          $('.alert-danger').hide();
          alert("Suku baru berhasil ditambahkan!");
          location.reload();
        }
      }
    });
  });

  $('form#form_create').submit(function (e) {
    // $('#form_create').submit(function (e) {
    //   var formData = new FormData(this);
    // });
    // data = $form.serialize();
    var formData = new FormData(this);
    $.ajax({
      type: 'post',
      url: '/pegawai/form/tambah',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (data) {
        $('.alert-danger').hide();
        if(data.errors)
        {
          jQuery.each(data.errors, function(key, value){
                          jQuery('.alert-danger').show();
                          jQuery('.alert-danger').append('<p>'+value+'</p>');
                        });
        }else {
          $('.alert-danger').hide();
          alert(data+" Pegawai berhasil ditambahkan!");
          location.reload();
        }
        console.log(data);
      }
    });
  });

  $('#pilihan_pegawai').change(function () {
    var pegawaiView = $(this).children("option:selected").val();
    if (pegawaiView == 'asessor') {
      location.href = '/dpanel/pegawai/?pilihan=asessor';
    }else if (pegawaiView == 'sosialisasi') {
      location.href = '/dpanel/pegawai/?pilihan=sosialisasi';
    }
  });

  $('#pegawai_all').click(function () {
    location.href = '/dpanel/pegawai/?pilihan=all'
    // $(this).addClass('active');
  });

  $('#pilihan_tampil').change(function () {
    var selectedview = $(this).children("option:selected").val();
    if(selectedview == 'tat'){
      location.href = '/dpanel/serv/rehab/report/?pilihan=tat';
    }else if (selectedview == 'publik') {
      location.href = '/dpanel/serv/rehab/report/?pilihan=publik';
    }
  });

  $('#reg_num').keyup(function () {
    var txt = $(this).val();
    var selectedview = $('#pilihan_tampil').children("option:selected").val();
    var cari_no = $('#title_tabel').html();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    if(cari_no == 'Daftar Pasien SKHPN'){
      var tampil = 'skhpn';
      if (txt != '') {
        $.ajax({
          url: '/dpanel/serv/skhpn/report/reg_src',
          method: 'post',
          data:{search:txt, view:tampil},
          dataType:'text',
          success: function (data) {
              $('#view_result').html(data);
          }

        });
      }else {
        $('#view_result').html('');
        $('#view_result').html(txt_html);
      }
    }else if (cari_no == 'Daftar Permintaan') {
      if (txt != '') {
        var tampil = 'sosio';
        $.ajax({
          url: '/dpanel/serv/sosialisasi/report/reg_src',
          method: 'post',
          data:{search:txt, view:tampil},
          dataType:'text',
          success: function (data) {
              $('#view_result').html(data);
          }

        });
      }else{
        $('#view_result').html('');
        $('#view_result').html(txt_html);
      }
    }else{
      if (txt != '') {
        $.ajax({
          url: '/dpanel/serv/rehab/report/reg_src',
          method: 'post',
          data:{search:txt, view:selectedview},
          dataType:'text',
          success: function (data) {
              $('#view_result').html(data);
          }

        });
      }else {
        $('#view_result').html('');
        $('#view_result').html(txt_html);
      }
    }
  });

  // $('#print_pdf_rehab').click(function () {
  //   var num = $('#print_pdf_rehab').val();
  //   var selectedview = $('#pilihan_tampil').children("option:selected").val();
  //   if (selectedview == 'tat') {
  //     location.href = "/dpanel/rehab/report/pdf/tat/"+num;
  //   }else if (selectedview == 'publik') {
  //     location.href = "/dpanel/rehab/report/pdf/pbl/"+num;
  //   }
  // });

  $('#link_save').click(function () {
    var ig = $('#ig_link').val();
    var fb = $('#fb_link').val();
    var ytb = $('#ytb_link').val();
    var web = $('#web_link').val();
    var all = ig+'<>'+fb+'<>'+ytb+'<>'+web;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    if (ig == '' || fb == '' || ytb == '' || web == '') {
      $('#alert_link').html('Harap Mengisi Kolom');
    }else{
      $.ajax({
        url: '/dpanel/link/store',
        method: 'post',
        data: {links: all},
        cache: false,
        success: function (data) {
            alert('Berhasil di simpan');
            location.reload();
        }
      });
    }
  });
      // $('.dropdown-menu #view_skhpn').on('click',function () {
      //   var kode = $(this).closest('.dropdown-menu').children("input:hidden").attr('id');
      //   $.ajax({
      //     url: '/skhpn/data/list',
      //     method: 'get',
      //     cache: false,
      //     data: {kode:kode},
      //     success: function (data) {
      //       $('#InputModal').modal('show');
      //       $('#view_data_response').html(data);
      //       // alert(data);
      //     }
      //   });
      // });
      $('#skhpn_update_button').on('click',function () {
        var $form = $('#form_edit');
        data = $form.serialize();
        $.ajax({
          type: 'get',
          url: '/skhpn/update/store',
          data: data,
          cache: false,
          success:function (data) {
            if(data.errors)
            {
              jQuery.each(data.errors, function(key, value){
                              jQuery('.alert-danger').show();
                              jQuery('.alert-danger').append('<p>'+value+'</p>');
                            });
            }else {
              $('.alert-danger').hide();
              alert("Perubahan disimpan");
              location.reload();
              // alert(data);
            }
          }
        });
      });

      $('#cari_for_form').on('click',function () {
        var selectedview = $('#pilihan_tampil').children("option:selected").val();
        if (selectedview == 'tat') {
          selectedview = '1';
        }else{
          selectedview = '2';
        }
        var id = $('#reg_num').val();
        var target = $('#cari_for_form').attr('target');
        var start = $('#start_tgl').val();
        var last = $('#last_tgl').val();
        var result = '';
        var no = 1;
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        if (target == '2'){
          $.ajax({
            url: '/dpanel/sosialisasi/search',
            method: 'post',
            cache: false,
            type: 'json',
            data: {tgl_start:start,tgl_last:last},
            success: function (data) {
              if (data.hasil) {
                $('#view_result').html('');
                jQuery.each(data.hasil, function(key, value){
                                result += '<tr>';
                                result += '<td>'+value.kode_sos+'</td>';
                                result += '<td>'+value.nama_pengada+'</td>';
                                result += '<td>'+value.tgl_pengada+'</td>';
                                result += '<td>'+value.nama_pj+'</td>';
                                result += '<td>'+value.nomor_hp_pj+'</td>';
                                result += '<td>'+value.nama+'</td>';
                                result += '<td>'+value.created_at+'</td>';
                                result += '<td><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>';
                                result += '<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu"><input type="hidden" name="kode" id="'+value.kode_sos+'">';
                                result += '<button type="button" tabindex="0" class="dropdown-item" id="view_skhpn" onclick="lihat_sosio('+'\''+value.kode_sos+'\''+')">Edit</button>';
                                result += '  <div id="del_button_user"><button type="button" tabindex="0" class="dropdown-item" name="button{{ $row->id }}" value="7">Delete</button></div>';
                                no ++;
                              });
              }
              jQuery('#view_result').append(result);
            }
          });

        }else if (target == '3') {
          $.ajax({
            url: '/dpanel/rehab/search/'+selectedview,
            method: 'post',
            cache: false,
            type: 'json',
            data: {id:id,tgl_start:start,tgl_last:last},
            success: function (data) {
              if(data.hasil){
                $('#view_result').html('');
                if (selectedview == '1') {
                  jQuery.each(data.hasil,function (key, value) {
                    result += '<tr>';
                    result += '<td>'+no+'</td>';
                    result += '<td>'+value.kode_registrasi+'</td>';
                    result += '<td>'+value.instansi_pengaju+'</td>';
                    result += '<td>'+value.nama_penyidik+'</td>';
                    result += '<td>'+value.nama_tersangka+'</td>';
                    result += '<td>'+value.created_at+'</td>';
                    result += '<td>';
                    result += '<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button><div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu"><button type="button" tabindex="0" class="dropdown-item" id="view_rehab" onclick="lihat_rehab('+'\''+value.kode_registrasi+'\''+')">Edit</button><button type="button" id="print_pdf_rehab" tabindex="0" class="dropdown-item" onclick="print_pdf('+'\''+value.kode_registrasi+'\''+')">Print</button><button type="button" tabindex="0" class="dropdown-item">Delete</button></div>';
                    result += '</td>';
                    no++;
                  });
                }else {
                  jQuery.each(data.hasil,function (key, value) {
                    result += '<tr>';
                    result += '<td>'+no+'</td>';
                    result += '<td>'+value.kode_registrasi+'</td>';
                    result += '<td>'+value.nik_ktp+'</td>';
                    result += '<td>'+value.nama_ibu+'</td>';
                    result += '<td>'+value.nama_lengkap+'</td>';
                    result += '<td>'+value.created_at+'</td>';
                    result += '<td>';
                    result += '<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button><div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu"><button type="button" tabindex="0" class="dropdown-item" id="view_rehab" onclick="lihat_rehab('+'\''+value.kode_registrasi+'\''+')">Edit</button><button type="button" id="print_pdf_rehab" tabindex="0" class="dropdown-item" onclick="print_pdf('+'\''+value.kode_registrasi+'\''+')">Print</button><button type="button" tabindex="0" class="dropdown-item">Delete</button></div>';
                    result += '</td>';
                    no++;
                  });
                }
              }
            }
          });
        }else if (target == '4') {
          $.ajax({
            url: '/dpanel/skhpn/search',
            method: 'post',
            cache: false,
            type: 'json',
            data: {id:id,tgl_start:start,tgl_last:last},
            success: function (data) {
              if (data.hasil) {
                $('#view_result').html('');
                jQuery.each(data.hasil, function(key, value){
                                result += '<tr>';
                                result += '<td>'+no+'</td>';
                                result += '<td>'+value.kode_registrasi+'</td>';
                                result += '<td>'+value.nama_lengkap+'</td>';
                                result += '<td>'+value.tanggal_lahir+'</td>';
                                result += '<td>'+value.gender+'</td>';
                                result += '<td>'+value.pekerjaan+'</td>';
                                if (value.status == '1') {
                                  result += '<td>Registered</td>';
                                }else if (value.status == '2') {
                                  result += '<td>Medical Checked</td>';
                                }
                                result += '<td>'+value.created_at+'</td>';
                                result += '<td><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>';
                                result += '<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu"><input type="hidden" name="kode" id="'+value.kode_registrasi+'">';
                                result += '<button type="button" tabindex="0" class="dropdown-item" id="view_skhpn" onclick="lihat_skhpn('+'\''+value.kode_registrasi+'\''+')">Edit</button>';
                                if (value.status == '1') {
                                  result += '<button type="button" id="cek_medis" tabindex="0" class="dropdown-item" onclick="medical_check('+'\''+value.kode_registrasi+'\''+')">Medical Test</button>';
                                }else if (value.status == '2') {
                                  result += '<button type="button" id="print_pdf_skhpn" tabindex="0" class="dropdown-item" onclick="print_pdf('+'\''+value.kode_registrasi+'\''+')">Print</button>';
                                }
                                result += '  <button type="button" tabindex="0" class="dropdown-item">Delete</button>';
                                no ++;
                              });
              }
              jQuery('#view_result').append(result);
            }
          });
        }
      });

      $('#logout_button').click(function () {
        $.ajax({
          url:'/dpanel/user/logout',
          method: 'get',
          cache: false,
          success: function (data) {
            if (data == 'forgeted') {
              window.location.assign('/dpanel');
            }
          }
        });
      });

      $('#hint-input-add').click(function () {
        var target = $('#hint-input-add').attr('target');
        var code = '';
        alert(target);
        if (target == '1') {
          code = 'PEG';
        }else if (target == '2') {
          code = 'SOS';
        }else if (target == '3') {
          code = 'RHB';
        }else if (target == '4') {
          code = 'SKH';
        }else if (target == '5') {
          code = 'URM';
        }
        $.ajax({

        });
      });

      $('[data-dismiss=modal]').on('click', function (e) {
        var $t = $(this),
            target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

      $(target)
        .find("input[type=text],input[type=number],textarea")
           .val('')
           .end()
        .find("select")
          .prop('selectedIndex',0)
          .end()
        .find("input[type=checkbox], input[type=radio]")
           .prop("checked", "")
           .end();
      })

});

function notSpaceFirst(e,val) {
  var len = val.value.length;
  if (len < 2) {
    if (e.which == 32) {
      $('#message').html('do not input space first!');
      val.value = '';
    }else{
      $('#message').html('');
      $('#alert_link').html('');
    }
  }
}

function day_check(val) {
  var month = $('#birth_month').val();
  var len = val.value.length;
  var amoun = val.value;
  if (len > 2) {
    val.value = val.value.substring(0, 2);
  }
  if (amoun > 31) {
    val.value = '31';
  }
  if(month == 2){
    if (amoun > 29) {
      val.value = '29';
    }
  }
}

function month_check(val) {
  var day = $('#birth_day').val();
  var len = val.value.length;
  var amoun = val.value;
  if (len > 2) {
    val.value = val.value.substring(0, 2);
  }
  if (amoun > 12) {
    val.value = '12';
  }
  if (amoun == 2) {
    if (day > 29) {
      $('#birth_day').val('29');
    }
  }
}

function countChar(val) {
        var len = val.value.length;
        if (len > 500) {
          val.value = val.value.substring(0, 500);
        } else {
          $('#count').text(len+'/500');
        }
}

function check_sess() {
  // $.ajax({
  //   url: '/sess/check/dash',
  //   success: function (data) {
  //     if (data != 'checked') {
  //       alert('Your Authentication Ended !');
  //       window.location.assign('/dpanel/');
  //     }
  //   }
  // });
}

function timestamp() {
  $.ajax({
        url: '/time/clock',
        success: function(data) {
            $('#timestamp').val(data);
        },
    });
}

function lihat_sosio(reg) {

}

function edit_pegawai(reg) {

}

function medical_check(reg) {
  window.location.assign('/dpanel/skhpn/klinik/'+reg);
}

function print_pdf(reg) {
  var sector = reg.substr(0,3);
  if (sector == 'REG') {
    location.href = "/dpanel/rehab/report/pdf/skhpn/"+reg;
  }else if (sector == 'TAT') {
    location.href = "/dpanel/rehab/report/pdf/tat/"+reg;
  }else if (sector == 'PBL') {
    location.href = "/dpanel/rehab/report/pdf/pbl/"+reg;
  }
  alert(sector);
}

function lihat_rehab(reg) {
var selectedview = $('#pilihan_tampil').children("option:selected").val();
  if (selectedview == 'tat') {
    $.ajax({
      url: '/dpanel/rehab/data/tat',
      method: 'get',
      cache: false,
      data: {kode:reg},
      success: function (data) {
        $('#InputModal').modal('show');
        $('#view_data_response').html(data);
      }
    });
  }else if (selectedview == 'publik') {
    $.ajax({
      url: '/dpanel/rehab/data/tat',
      method: 'get',
      cache: false,
      data: {kode:reg},
      success: function (data) {
        $('#InputModal').modal('show');
        $('#view_data_response').html(data);
      }
    });
  }
}

function lihat_skhpn(reg) {
  var kode = reg;
  $.ajax({
    url: '/skhpn/data/list',
    method: 'get',
    cache: false,
    data: {kode:kode},
    success: function (data) {
      $('#InputModal').modal('show');
      $('#view_data_response').html(data);
      // alert(data);
    }
  });


}

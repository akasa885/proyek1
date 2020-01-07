<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
//Route::get('/bnn','HomeController@index');
Route::get('/bnn/profil','HomeController@profil');
Route::get('/bnn/serv/{id}','PendaftaranController@index');
Route::get('/bnn/serv/3/{choice}','RehabilitasiController@rehab_form');
// Route::get('/captcha'.'CapController');
Route::get('/coba-cap',function ()
{
  return view('coba');
});

//form all start

//coba captcha
Route::get('createcaptcha', 'CaptchaController@create');
Route::post('captcha', 'CaptchaController@captchaValidate');
//coba captcha

Route::get('refreshcaptcha', 'CaptchaController@refreshCaptcha');
Route::get('jenis-pengajuan', 'RehabilitasiController@type');

Route::post('/rehab/tat','RehabilitasiController@proses_tat');
Route::post('/rehab/publik','RehabilitasiController@proses_publik');
Route::get('/cons/choice/','RehabilitasiController@pilih_konselor');
Route::get('/pendaftaran-berhasil/rehab/{reg}','RehabilitasiController@terkonfirmasi');
Route::post('/proses/pengaduan','PengaduanController@insert');
Route::post('/proses/skhpn','SkhpnController@Svalidate');
Route::get('/serv/4/berhasil/{no_reg}','SkhpnController@sukses');
//form all end

Route::get('/time/clock','Admin_mainController@waktupukul');
Route::get('/sess/check/{page}','Admin_mainController@sessionceklog');

//admin menu
Route::get('/dpanel','Admin_mainController@loginview');
Route::post('/dpanel/login','Admin_mainController@logincek');
Route::get('/dpanel/user/logout','Admin_mainController@logoutcek');
Route::get('/dpanel/dashboard','Admin_mainController@dashview');
Route::get('/dpanel/user-setting','Admin_mainController@userlist');
Route::get('/dpanel/form/agama','Admin_mainController@agamalist');
Route::get('/dpanel/form/job','Admin_mainController@joblist');
Route::get('/dpanel/form/narkoba','Admin_mainController@narkobalist');
Route::get('/dpanel/form/suku','Admin_mainController@sukulist');

//rehab
// Route::get('/dpanel/rehab/data/tat','Admin_mainController@tatlist');
// Route::get('/dpanel/rehab/data/publik','Admin_mainController@publiklist');
Route::get('/dpanel/serv/rehab/report','Admin_mainController@rehablist');
Route::get('/dpanel/serv/skhpn/report','Admin_mainController@skhpnlist');
Route::post('/dpanel/rehab/search/{type}','Admin_mainController@rehabSearch');
Route::post('/dpanel/skhpn/search','Admin_mainController@skhpnSearch');
Route::post('/dpanel/serv/skhpn/report/reg_src','Admin_mainController@srcreg');
Route::get('/dpanel/skhpn/klinik/{id}','Admin_mainController@klinikTampil');
Route::post('/skhpn/medical/store','Admin_mainController@skhpnstore');
Route::post('/dpanel/serv/rehab/report/reg_src','Admin_mainController@srcreg');
Route::get('/dpanel/pegawai/','Admin_mainController@pegawai_list');
Route::post('/pegawai/form/tambah','Admin_mainController@createPegawai');
//create
Route::post('/dpanel/link/store','Admin_mainController@storelink');
Route::post('/dpanel/create/user','Admin_mainController@usercreate');
Route::post('/dpanel/create/job','Admin_mainController@jobcreate');
Route::post('/dpanel/create/narkoba','Admin_mainController@narkobacreate');
Route::post('/dpanel/create/agama','Admin_mainController@agamacreate');
Route::post('/dpanel/create/suku','Admin_mainController@sukucreate');
//delete
Route::get('/dpanel/delete/job','Admin_mainController@jobdel');
Route::get('/dpanel/delete/narkoba','Admin_mainController@narkobadel');
Route::get('/dpanel/delete/agama','Admin_mainController@agamadel');
Route::get('/dpanel/delete/suku','Admin_mainController@sukudel');
Route::get('/dpanel/delete/user','Admin_mainController@userdel');
Route::get('/dpanel/delete/pegawai','Admin_mainController@delPegawai');

//update
Route::get('/skhpn/data/list','Admin_mainController@skhpnView');
Route::get('/skhpn/update/store','Admin_mainController@skhpnDataUpdate');

//pdf/dpanel/rehab/report/pdf/skhpn/{}
// Route::get('/dpanel/rehab/report/pdf/skhpn/{skhpn}','createpdf@skhpnbuatPDF');
Route::get('/dpanel/rehab/report/pdf/tat/{tat_num}','createpdf@tatbuatPDF');
Route::get('/dpanel/rehab/report/pdf/pbl/{pbl_num}','createpdf@publikbuatPDF');
//admin menu

//hint
Route::get('/dpanel/hint/setting/1','Admin_mainController@hint_pengaduan');
Route::get('/dpanel/hint/setting/2','Admin_mainController@hint_sosialisasi');
Route::get('/dpanel/hint/setting/3','Admin_mainController@hint_rehab');
Route::get('/dpanel/hint/setting/4','Admin_mainController@hint_skhpn');
//hint

//coba
Route::get('file-upload', 'FileUploadController@fileUpload')->name('file.upload');
Route::post('file-upload', 'FileUploadController@fileUploadPost')->name('file.upload.post');

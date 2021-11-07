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

Route::get('/', function () {
	return redirect(route('login'));
});

Auth::routes();

// dibawah ini dibutuhkan akses autitentifikasi
Route::group(['middleware' => 'auth'], function () { 

	Route::group(['middleware' => ['role:admin']], function () {
		Route::resource('/jadwal','JadwalController');
		Route::get('/jadwal/{id}/create-tanggal','JadwalController@createTanggal');
		Route::post('/jadwal/store-tanggal','JadwalController@storeTanggal');
		Route::get('/jadwal/{id}/create-jadwal-tutorial','JadwalTutorialDetailController@create');
		Route::post('/jadwal/store-jadwal-tutorial','JadwalTutorialDetailController@store');
		Route::delete('/jadwal/{id}/delete-jadwal-tutorial','JadwalTutorialDetailController@destroy');
		Route::get('/jadwal/{jadwalid}/{id}/edit-jadwal-tutorial','JadwalTutorialDetailController@edit');
		Route::patch('/jadwal/{id}/update-jadwal-tutorial','JadwalTutorialDetailController@update');

	// data master
		Route::resource('master/jurusan', 'RefJurusanController');
		Route::get('master/jurusan/{id}/delete', 'RefJurusanController@delete');
		Route::resource('master/fakultas', 'RefFakultasController');
		Route::get('master/fakultas/{id}/delete', 'RefFakultasController@delete');
		Route::resource('master/lokasi', 'LokasiTutorialController');
		Route::get('master/lokasi/{lokasi}/delete', 'LokasiTutorialController@delete');	
		Route::resource('master/matakuliah', 'MataKuliahController');
		Route::get('master/matakuliah/{matakuliah}/delete', 'MataKuliahController@delete');
		Route::resource('master/kelas', 'KelasController');
		Route::get('master/kelas/{kela}/delete', 'KelasController@delete');
		Route::resource('master/tutor', 'TutorController');
		Route::get('master/tutor/{tutor}/delete', 'TutorController@delete');
		Route::get('master/tutor/{tutor}/evaluasi', 'TutorController@evaluasi');
		Route::patch('master/tutor/{tutor}/update-evaluasi', 'TutorController@updateEvaluasi');
		Route::resource('master/tutor-pendidikan', 'TutorPendidikanController');
		Route::get('master/tutor-pendidikan/{tutor_pendidikan}/delete', 'TutorPendidikanController@delete');
		Route::resource('master/mahasiswa', 'MahasiswaController');
		Route::resource('master/keterangan-layanan', 'KeteranganLayananController');
	});

	Route::get('/', 'HomeController@index');
	Route::group(['middleware' => ['role:mahasiswa']], function () {
		Route::post('/store/jadwal-mahasiswa', 'MahasiswaController@storeJadwalMhs');
		Route::get('jadwal-tutorial-mahasiswa', 'MahasiswaController@jadwal');
		Route::get('jadwal-tutorial-mahasiswa/{mahasiswa}/edit', 'MahasiswaController@editJadwal');
		Route::get('jadwal-tutorial-mahasiswa/{mahasiswa}/detail', 'MahasiswaController@showJadwal');
		Route::put('jadwal-tutorial-mahasiswa/{mahasiswa}/update', 'MahasiswaController@updateJadwal');
		Route::post('jadwal-tutorial-mahasiswa/{mahasiswa}/destroyJadwal', 'MahasiswaController@destroyJadwal');
	});
});
	Route::view('login-page','login');
	Route::view('master','layouts.app_master');

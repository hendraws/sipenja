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
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('/jadwal','JadwalController');
	Route::get('/jadwal/{id}/create-tanggal','JadwalController@createTanggal');
	Route::post('/jadwal/store-tanggal','JadwalController@storeTanggal');
	Route::get('/jadwal/{id}/create-jadwal-tutorial','JadwalController@createJadwalTutorial');
	Route::post('/jadwal/store-jadwal-tutorial','JadwalController@storeJadwalTutorial');

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
	Route::resource('master/tutor-pendidikan', 'TutorPendidikanController');
	Route::get('master/tutor-pendidikan/{tutor_pendidikan}/delete', 'TutorPendidikanController@delete');
});
Route::view('login-page','login');
Route::view('master','layouts.app_master');

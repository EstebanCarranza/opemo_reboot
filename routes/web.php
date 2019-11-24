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

Route::any('/errors/{error_message?}', function($error_message = "Algo anda mal :(") {
    return view("pages.errors")->with('error_message',$error_message);
});




//</------------------------------------ FORMS ------------------------------------\>
Route::get('/login',        function(){return view('forms.login');});
Route::get('/signup',       function(){return view('forms.signup');});
Route::get('/contact',      function(){return view('forms.contact');});
Route::get('/reclam',       function(){return view('forms.reclam');});
//Route::get('/profile-edit', function(){return view('forms.profile-edit');});
//<\------------------------------------ FORMS ------------------------------------/>
//</------------------------------------ INFO -------------------------------------\>
Route::get('/privacity',            function(){return view('info.privacity');});
Route::get('/termcon',              function(){return view('info.terminos-condiciones');});
Route::get('/frequent-questions',   function(){return view('info.frecuent-questions');});
Route::get('/report-users',         function(){return view('info.report-users');});
//<\------------------------------------ INFO -------------------------------------/>
Route::any('/test',                 function(){return view('test');});
//</------------------------------------ ACTIONS ------------------------------------\>
Route::match(['get','post'],'/send-reclam', function(){return view('pages.dashboard');});
Route::match(['get','post'],'/send-login',  function(){return view('pages.dashboard');});
Route::match(['get','post'],'/send-signup', function(){return view('pages.dashboard');});
Route::match(['get','post'],'/send-contact', function(){return view('pages.dashboard');});
//<\------------------------------------ ACTIONS ------------------------------------/>
//</------------------------------------ CONTROL-PANEL ---------------------------------\>
//Route::get('/my-profile',               function(){return view('perfil.show');});

Route::get('/my-recovery-objects',      function(){return view('pages.dashboard');});



Route::get('/descartar',          function(){return view('pages.answers');});

//<\------------------------------------ CONTROL-PANEL ---------------------------------/>
//</------------------------------------ EDITS -----------------------------------------\>
Route::get('/edit-publication',          function(){return view('forms.edit-publication');});
//Route::get('/results',                   function($cardTitle = 'Resultados de busqueda', $login = true){return view('pages.results')->with('cardTitle',$cardTitle);});
//<\------------------------------------ EDITS -----------------------------------------/>

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/',                    'testimonioController');
Route::resource('dashboard',            'dashboardController');
Route::resource('/publication-list',    'publicacionController');
Route::resource('/ubications',          'ubicacionController');
Route::resource('/profile',             'perfilController');
Route::resource('Ciudad',               'ciudadController');
Route::resource('testimonio',           'testimonioController');
Route::resource('/razonReporte',        'razonReporteController');
Route::resource('/comentario',          'comentarioController');
Route::resource('/reclamo',             'publicacionReclamadaController');
Route::resource('/publication-reports', 'publicacionReportadaController');
Route::resource('/results',             'busquedaController');
Route::resource('/messages',            'publicacionReclamadaController');
Route::resource('/puntuacion',            'puntuacionController');


Route::get('/search', 'busquedaController@getResults');
//Helpers
Route::get('/image/publication/',       'helperImageController@getPublicationPhoto');
Route::get('/image/ubication/',         'helperImageController@getUbicationPhoto');
Route::get('/image/profile/avatar/',    'helperImageController@getProfileAvatarPhoto');
Route::get('/image/profile/cover/',     'helperImageController@getProfileCoverPhoto');

Route::get('/data/ubication/',          'helperDataController@getUbicationsForUser');
Route::get('/data/ubication/all',       'helperDataController@getUbications');
Route::get('/data/comments/',           'helperDataController@getCommentList');
Route::get('/data/reports/list/',       'helperDataController@getPuReLi');
Route::get('/data/message/list/',       'helperDataController@getPuMeLi');
Route::get('/bloquear/publicacion',     'helperDataController@bloquearPublicacionReportada');
Route::get('/reclam/delete',            'helperDataController@deleteReclam');
Route::get('/puntuacion-total',         'helperDataController@getPuntuacion');
Route::get('/enviar-correo',            'helperDataController@enviarCorreo');
Route::get('/testimonios',            'helperDataController@getTestimonio');

Route::post('/seguir',                  'seguirController@seguir');
Route::get('/seguidores',               'seguirController@getSeguidoresList');
Route::get('/seguidos',                 'seguirController@getSiguiendoList');
Route::get('/my-publications',          'publicacionController@indexMyPublications');
Route::get('/my-ubications',            'ubicacionController@indexMyUbications');




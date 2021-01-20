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

/*Llamadas al controlador Auth*/
Route::get('login', 'AuthController@showLogin'); // Mostrar login
Route::post('login', 'AuthController@postLogin'); // Verificar datos
Route::get('logout', 'AuthController@logOut'); // Finalizar sesión

Auth::routes();

/*Rutas privadas solo para usuarios autenticados*/
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', function () {
        return view('layouts/inicio');
    });

    //Catalogo Arrendador
    Route::resource('catalogos/arrendador', 'Backend\LessorController');
    Route::put('catalogos/arrendador/{arrendador}', 'Backend\LessorController@activar');
    Route::post('catalogos/arrendador/telefono/{arrendador}', 'Backend\LessorController@addTelefono');
    Route::post('catalogos/arrendador/email/{arrendador}', 'Backend\LessorController@addEmail');
    Route::post('catalogos/arrendador/banco/{arrendador}', 'Backend\LessorController@addBanco');
    Route::delete('catalogos/arrendador/telefono/{arrendador}', 'Backend\LessorController@deleteTelefono');
    Route::delete('catalogos/arrendador/email/{arrendador}', 'Backend\LessorController@deleteEmail');
    Route::delete('catalogos/arrendador/banco/{arrendador}', 'Backend\LessorController@deleteBanco');

    //Catalogo Arrendatarios
    Route::resource('catalogos/arrendatario', 'Backend\LesseesController');
    Route::patch('catalogos/arrendatario/{arrendatario}', 'Backend\LesseesController@toggleStatus')->name('arrendatario.toggle');
    Route::post('catalogos/arrendatario/telefono/{arrendatario}', 'Backend\LesseesController@addTelefono');
    Route::post('catalogos/arrendatario/telefonofiador/{arrendatario}', 'Backend\LesseesController@addTelefonoFiador');
    Route::post('catalogos/arrendatario/email/{arrendatario}', 'Backend\LesseesController@addEmail');
    Route::delete('catalogos/arrendatario/telefono/{arrendatario}', 'Backend\LesseesController@deleteTelefono');
    Route::delete('catalogos/arrendatario/email/{arrendatario}', 'Backend\LesseesController@deleteEmail');
    Route::post('catalogos/arrendatario/telefonofiador/{arrendatario}', 'Backend\LesseesController@deleteTelefonoFiador');

    //Catalogo Propiedades(Fincas)
    Route::patch('catalogos/fincas/{finca}', 'Backend\PropertiesController@updatePatch')->name('finca.patch');
    Route::resource('catalogos/finca', 'Backend\PropertiesController');
    Route::put('catalogos/finca/{finca}', 'Backend\PropertiesController@activar');
    Route::post('catalogos/finca/propiedad', 'Backend\PropertiesController@propiedad');
    Route::get('catalogos/finca/arrendador', 'Backend\PropertiesController@arrendador');

    //Catalogo Tipo de Propiedad
    Route::resource('subcatalogos/tipo-propiedad', 'Backend\TipoPropiedadController');
    Route::put('subcatalogos/tipo-propiedad{propiedad}', 'Backend\TipoPropiedadController@activar');

    //Catalogo Tipo de Incidente
    Route::resource('subcatalogos/tipo-incidente', 'Backend\TipoIncidenteController');
    Route::put('subcatalogos/tipo-incidente{incidente}', 'Backend\TipoIncidenteController@activar');

    //Catalogo Tipo de Mantenimiento
    Route::resource('subcatalogos/tipo-mantenimiento', 'Backend\TipoMantenimientoController');
    Route::put('subcatalogos/tipo-mantenimiento{mantenimiento}', 'Backend\TipoMantenimientoController@activar');

    //Contrato o Convenio
    Route::resource('contrato', 'Backend\ContractsController');
    Route::put('contrato/{contrato}', 'Backend\ContractsController@activar');

    //Recibos Automaticos
    Route::get('recibos-automaticos', 'Backend\RecibosAutomaticosController@index')->name('tickets.index');//Devuelve la vista
    Route::get('recibos-automaticos/pdf', 'Backend\RecibosAutomaticosController@generar');//Genera PDF
    Route::post('recibos-automaticos/registro', 'Backend\RecibosAutomaticosController@registroRecibo');//Registro de Recibos
    Route::get('control-pago/recibo/{contrato}', 'Backend\RecibosAutomaticosController@vistaRecibo');//Vista de Recibos
    Route::get('recibos-automaticos/{arrendador}', 'Backend\RecibosAutomaticosController@contrato');//Muestra los contratos
    Route::post('recibos-automaticos/revision', 'Backend\RecibosAutomaticosController@filtroArrendatario');//Filtro Arrendatario
    Route::put('control-pago/recibo/{registro}/actualizar', 'Backend\RecibosAutomaticosController@actualizarRecibo');//Actualiza el recibo
    Route::get('control-pago', 'Backend\ControPagoController@index');
    Route::get('control-pago/recibo/imp/{contrato}', 'Backend\RecibosAutomaticosController@controlImp');//Imprimir control de pago
    Route::post('recibos-automaticos/parcial', 'Backend\RecibosAutomaticosController@reciboParcial');//Recibo Parcial

    //Reportes
    Route::get('reportes', 'Backend\ReportesController@index');
    Route::post('reportes/pdf', 'Backend\ReportesController@generarReporte');

    //Incidentes
    Route::resource('incidentes', 'Backend\CatIncidentesController');
    Route::put('incidentes{incidente}', 'Backend\CatIncidentesController@activar');
    Route::post('incidentes/tipoincidente', 'Backend\CatIncidentesController@tipoIncidente');

    //Usuarios
    Route::resource('seguridad/usuarios', 'Backend\UsuarioController');
    Route::put('seguridad/usuarios{usuario}', 'Backend\UsuarioController@activar');

    //Mantenimiento
    Route::resource('mantenimiento', 'Backend\MantenimientoController');
    Route::put('mantenimientos{mantenimiento}', 'Backend\MantenimientoController@activar');
    Route::post('mantenimientos/tipomantenimiento', 'Backend\MantenimientoController@tipoMantenimiento');

    //Liquidaciones
    Route::resource('liquidaciones', 'Backend\LiquidacionController');
    Route::post('liquidaciones/finca', 'Backend\LiquidacionController@getFinca');

    //Configuración
    Route::resource('configuracion', 'Backend\ConfiguracionController');
});

use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Log;


Route::get('mail/send', function (){
    Mail::to('luis@mindtec.com.mx')->send(new WelcomeMail(auth()->user()));
    return response()->json('Se envio el correo', 200);
});





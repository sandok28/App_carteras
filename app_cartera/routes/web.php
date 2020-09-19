<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Vistas de las devoluciones////////////////

Route::get('/devoluciones','DemoStivensController@inicio');
Route::get('/devoluciones/formulario_devoluciones_crear','DemoStivensController@formulario_devoluciones_crear');
Route::post('/devoluciones','DemoStivensController@devoluciones_crear');


//Vistas del administrador////////////////
Route::get('/administrador', 'AdministradorController@panel_central_administrador');
Route::get('/usuariosadmin/formulario_usuarios_crear','Usuarioscontroller@formulario_usuariosadmin_crear');
Route::post('/usuariosadmin','Usuarioscontroller@usuarios_crear');
Route::get('/usuariosadmin/{usuario_id}/formulario_usuariosadmin_actualizar','Usuarioscontroller@formulario_usuariosadmin_actualizar');
Route::PUT('/usuariosadmin/{usuario_id}','Usuarioscontroller@usuariosadmin_actualizar');

Route::get('/usuariosadmin/desactivar/{usuario}', 'UsuariosController@desActivarUsuarioAdministrador')->name('usuarios.desActivarUsuario');
Route::get('/usuariosadmin/activar/{usuario}', 'UsuariosController@activarUsuarioAdministrador')->name('usuarios.activarUsuario');
          
//Empresas/////////////////////////

//Route::resource('empresas','EmpresaController')->except(['show']);;

Route::get('/empresas','Empresascontroller@inicio');
Route::get('/empresas/formulario_empresas_crear','Empresascontroller@formulario_empresas_crear');
Route::post('/empresas','Empresascontroller@empresas_crear');
Route::get('/empresas/{empresa_id}/formulario_empresas_actualizar','Empresascontroller@formulario_empresas_actualizar');
Route::PUT('/empresas/{empresa_id}','Empresascontroller@empresas_actualizar');

Route::get('/empresas/desactivar/{empresa}', 'EmpresasController@desActivarEmpresa')->name('empresas.desActivarEmpresa');
Route::get('/empresas/activar/{empresa}', 'EmpresasController@activarEmpresa')->name('empresas.activarEmpresa');
//Carteras/////////////////////////

Route::get('/carteras','Carterascontroller@inicio');
Route::get('/carteras/formulario_carteras_crear','Carterascontroller@formulario_carteras_crear');
Route::post('/carteras','Carterascontroller@carteras_crear');
Route::get('/carteras/{cartera_id}/formulario_carteras_actualizar','Carterascontroller@formulario_carteras_actualizar');
Route::PUT('/carteras/{cartera_id}','Carterascontroller@carteras_actualizar');

Route::get('/carteras/desactivar/{cartera}', 'CarterasController@desActivarCartera')->name('carteras.desActivarCartera');
Route::get('/carteras/activar/{cartera}', 'CarterasController@activarCartera')->name('carteras.activarCartera');


// Usuarios////////////////////////

Route::get('/usuarios','Usuarioscontroller@inicio');
Route::get('/usuarios/formulario_usuarios_crear','Usuarioscontroller@formulario_usuarios_crear');
Route::post('/usuarios','Usuarioscontroller@usuarios_crear');
Route::get('/usuarios/{usuario_id}/formulario_usuarios_actualizar','Usuarioscontroller@formulario_usuarios_actualizar');
Route::PUT('/usuarios/{usuario_id}','Usuarioscontroller@usuarios_actualizar');

Route::get('/usuarios/desactivar/{usuario}', 'UsuariosController@desActivarUsuario')->name('usuarios.desActivarUsuario');
Route::get('/usuarios/activar/{usuario}', 'UsuariosController@activarUsuario')->name('usuarios.activarUsuario');
          
// Productos////////////////////////
//Route::resource('productos','ProductosController');
Route::get('/productos','ProductosController@inicio');
Route::get('/productos/formulario_productos_crear','ProductosController@formulario_productos_crear');
Route::post('/productos','ProductosController@productos_crear');
Route::get('/productos/{producto_id}/formulario_productos_actualizar','ProductosController@formulario_productos_actualizar');
Route::PUT('/productos/{producto_id}','ProductosController@productos_actualizar');

Route::get('/productos/desactivar/{producto}', 'ProductosController@desActivarProducto')->name('productos.desActivarProducto');
Route::get('/productos/activar/{producto}', 'ProductosController@activarProducto')->name('productos.activarProducto');














//rutas de las vistas del administrador de la aplicacion
//Route::get('/administrador/empresas', 'AdministradorController@empresas')->name('administrador.empresas.vista');
//Route::get('/administrador/empresas/{empresa_id}/carteras', 'AdministradorController@administradorEmpresaCartera')->name('administrador.empresas.carteras.vista');
//Route::get('/administrador/empresas/{empresa_id}/carteras/create', 'CarterasController@create')->name('administrador.empresas.carteras.crear');

//Route::get('/administrador/empresas/{empresa_id}/carteras/edit', 'AdministradorController@administradorEmpresaCarteraedit')->name('administrador.empresas.carteras.editar');

//rutas de las vistas del administrador de la empresa
//Route::get('/adminempresa/carteras', 'EmpresaController@vistacarterasempresa')->name('empresas.carteras');

//Route::get('/adminempresa/productos', 'EmpresaController@vistaproductosempresa')->name('empresas.productos');



//Route::put('/empresas/{empresa_id}/carteras', 'EmpresaController@guardar')->name('guardar.empresas.carteras');


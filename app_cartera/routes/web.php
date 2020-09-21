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



//Vistas del administrador
Route::get('/administrador', 'AdministradorController@panel_central_administrador');


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
Route::get('/usuarios/{usuario_id}/formulario_empresas_actualizar','Usuarioscontroller@formulario_usuarios_actualizar');
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



Route::get('/novedades','DemoIvanController@inicio');
Route::get('/novedades/formulario_novedades_crear','DemoIvanController@formulario_novedades_crear');
Route::post('/novedades','DemoIvanController@novedades_crear');
Route::get('/novedades/{novedad_id}/formulario_novedades_actualizar','DemoIvanController@formulario_novedades_actualizar');
Route::PUT('/novedades/{novedad_id}','DemoIvanController@noveadades_actualizar');



Route::get('/bonos','DemoIvanController@inicio2');
Route::get('/bonos/formulario_bonos_crear','DemoIvanController@formulario_bonos_crear');
Route::post('/bonos','DemoIvanController@bonos_crear');
Route::get('/bonos/{bono_id}/formulario_bonos_actualizar','DemoIvanController@formulario_bonos_actualizar');
Route::PUT('/bonos/{bono_id}','DemoIvanController@bonos_actualizar');





Route::get('/listanegras','DemoIvanController@inicio3');
Route::get('/listanegras/formulario_listanegras_crear','DemoIvanController@formulario_listanegras_crear');
Route::post('/listanegras','DemoIvanController@listanegras_crear');
Route::get('/listanegras/{listanegras_id}/formulario_listanegras_actualizar','DemoIvanController@formulario_listanegras_actualizar');
Route::PUT('/listanegras/{listanegras_id}','DemoIvanController@listanegras_actualizar');

Route::get('/listanegras/desactivar/{cliente}', 'DemoIvanController@desActivarLista')->name('listanegras.activarLista');
Route::get('/listanegras/activar/{cliente}', 'DemoIvanController@activarLista')->name('listanegras.desActivarLista');


//rutas de las vistas del administrador de la aplicacion
//Route::get('/administrador/empresas', 'AdministradorController@empresas')->name('administrador.empresas.vista');
//Route::get('/administrador/empresas/{empresa_id}/carteras', 'AdministradorController@administradorEmpresaCartera')->name('administrador.empresas.carteras.vista');
//Route::get('/administrador/empresas/{empresa_id}/carteras/create', 'CarterasController@create')->name('administrador.empresas.carteras.crear');

//Route::get('/administrador/empresas/{empresa_id}/carteras/edit', 'AdministradorController@administradorEmpresaCarteraedit')->name('administrador.empresas.carteras.editar');

//rutas de las vistas del administrador de la empresa
//Route::get('/adminempresa/carteras', 'EmpresaController@vistacarterasempresa')->name('empresas.carteras');

//Route::get('/adminempresa/productos', 'EmpresaController@vistaproductosempresa')->name('empresas.productos');



//Route::put('/empresas/{empresa_id}/carteras', 'EmpresaController@guardar')->name('guardar.empresas.carteras');


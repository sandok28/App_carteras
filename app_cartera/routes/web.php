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


//Vistas del administrador
Route::get('/administrador', 'AdministradorController@panel_central_administrador');


Route::get('/usuariosadmin/desactivar/{usuario}', 'UsuariosController@desActivarUsuarioAdministrador')->name('usuarios.desActivarUsuario');
Route::get('/usuariosadmin/activar/{usuario}', 'UsuariosController@activarUsuarioAdministrador')->name('usuarios.activarUsuario');


//-> Administrador
Route::get('/administrador/administrador_empresas', 'AdministradorController@administrador_empresas')->name('administrador.administrador_empresas');
Route::get('/administrador/administrador_usuarios', 'AdministradorController@administrador_usuarios')->name('administrador.administrador_usuarios');

//-->Arministrador - empresas
Route::get('/administrador/administrador_empresas/formulario_empresas_crear','Empresascontroller@formulario_empresas_crear')->name('administrador.administrador_empresas.formulario_empresas_crear');
Route::post('/administrador/administrador_empresas/empresas_crear','Empresascontroller@empresas_crear')->name('administrador.administrador_empresas.empresas_crear');
Route::get('/administrador/administrador_empresas/{empresa_id}/formulario_empresas_actualizar','Empresascontroller@formulario_empresas_actualizar')->name('administrador.administrador_empresas.formulario_empresas_actualizar');
Route::PUT('/administrador/administrador_empresas/{empresa_id}','Empresascontroller@empresas_actualizar')->name('administrador.administrador_empresas.empresas_actualizar');

Route::get('/administrador/administrador_empresas/empresas_desactivar/{empresa}', 'EmpresasController@empresas_desactivar')->name('administrador.administrador_empresas.empresas_desactivar');
Route::get('/administrador/administrador_empresas/empresas_activar/{empresa}', 'EmpresasController@empresas_activar')->name('administrador.administrador_empresas.empresas_activar');

//--> Administrador - usurarios administradores
Route::get('/administrador/administrador_usuarios/formulario_usuarios_crear','AdministradorController@formulario_usuarios_crear')->name('administrador.administrador_usuarios.formulario_usuarios_crear');
Route::post('/administrador/administrador_usuarios/usuarios_crear','AdministradorController@usuarios_crear')->name('administrador.administrador_usuarios.usuarios_crear');
Route::get('/administrador/administrador_usuarios/{usuario_id}/formulario_usuarios_actualizar','AdministradorController@formulario_usuarios_actualizar')->name('administrador.administrador_usuarios.formulario_usuarios_actualizar');
Route::put('/administrador/administrador_usuarios/{usuario}','AdministradorController@usuarios_actualizar')->name('administrador.administrador_usuarios.usuarios_actualizar');

Route::get('/administrador/administrador_usuarios/usuarios_desactivar/{usuario}', 'AdministradorController@usuarios_desactivar')->name('administrador.administrador_usuarios.usuarios_desactivar');
Route::get('/administrador/administrador_usuarios/usuarios_activar/{usuario}', 'AdministradorController@usuarios_activar')->name('administrador.administrador_usuarios.usuarios_activar');

//---> Administradpr - empresas - carteras
Route::get('/administrador/administrador_carteras/{empresa_id}', 'AdministradorController@administrador_carteras')->name('administrador.administrador_carteras');
Route::get('/administrador/administrador_carteras/{empresa_id}/formulario_carteras_crear','AdministradorController@formulario_carteras_crear')->name('administrador.administrador_carteras.formulario_carteras_crear');
Route::post('/administrador/administrador_carteras/carteras_crear','AdministradorController@carteras_crear')->name('administrador.administrador_carteras.carteras_crear');
Route::get('/administrador/administrador_carteras/{empresa_id}/{cartera_id}/formulario_carteras_actualizar','AdministradorController@formulario_carteras_actualizar')->name('administrador.administrador_carteras.formulario_carteras_actualizar');
Route::put('/administrador/administrador_carteras/{cartera}','AdministradorController@carteras_actualizar')->name('administrador.administrador_carteras.carteras_actualizar');




////
Route::get('/usuariosadmin/formulario_usuarios_crear','Usuarioscontroller@formulario_usuariosadmin_crear');
Route::post('/usuariosadmin','Usuarioscontroller@usuarios_crear');
Route::get('/usuariosadmin/{usuario_id}/formulario_usuariosadmin_actualizar','Usuarioscontroller@formulario_usuariosadmin_actualizar');
Route::PUT('/usuariosadmin/{usuario_id}','Usuarioscontroller@usuariosadmin_actualizar');

Route::get('/usuariosadmin/desactivar/{usuario}', 'UsuariosController@desActivarUsuarioAdministrador')->name('usuarios.desActivarUsuario');
Route::get('/usuariosadmin/activar/{usuario}', 'UsuariosController@activarUsuarioAdministrador')->name('usuarios.activarUsuario');
          
//Empresas/////////////////////////

//Route::resource('empresas','EmpresaController')->except(['show']);;

//Route::get('/empresas','Empresascontroller@inicio');

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


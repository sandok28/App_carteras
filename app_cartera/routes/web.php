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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Vistas de las devoluciones////////////////

Route::get('/devoluciones','DemoStivensController@inicio');
Route::get('/devoluciones/formulario_devoluciones_crear','DemoStivensController@formulario_devoluciones_crear');
Route::post('/devoluciones','DemoStivensController@devoluciones_crear');

//Vistas del cliente////////////////  

Route::get('/clientes', 'DemoStivensController@inicio_cliente');
Route::get('/clientes/formulario_cliente_crear','DemoStivensController@formulario_clientes_crear');
Route::get('/clientes/{cliente_id}/formulario_cliente_actualizar','DemoStivensController@formulario_cliente_actualizar');
Route::PUT('/clientes/{cliente_id}','DemoStivensController@cliente_actualizar');

Route::get('/cliente/desactivar/{cliente}', 'DemoStivensController@desActivarUsuarioAdministrador')->name('usuarios.desActivarUsuario');
Route::get('/cliente/activar/{cliente}', 'DemoStivensController@activarUsuarioAdministrador')->name('usuarios.activarUsuario');


//Vistas del administrador
Route::get('/administrador', 'AdministradorController@panel_central_administrador');

Route::get('/usuariosadmin/desactivar/{usuario}', 'UsuariosController@desActivarUsuarioAdministrador')->name('usuarios.desActivarUsuario');
Route::get('/usuariosadmin/activar/{usuario}', 'UsuariosController@activarUsuarioAdministrador')->name('usuarios.activarUsuario');

/////->Gestionempresa - carteras

Route::get('/empresa/carteras', 'GestionEmpresasController@empresa_carteras')->name('empresa.empresa_carteras');
Route::get('/empresa/carteras/{cartera_id}/formulario_cartera_actualizar','GestionEmpresasController@formulario_carteras_actualizar')->name('empresa.empresa_carteras.formulario_cartera_actualizar');
Route::PUT('/empresa/carteras/{cartera_id}','GestionEmpresasController@carteras_actualizar')->name('empresa.empresa_cartera.empresa_cartera_actualizar');

/////->Gestionempresa - bodeguistas

Route::get('/empresa/bodeguistas','GestionEmpresasController@lista_bodeguistas')->name('empresa.bodeguistas');
Route::get('/empresa/bodeguistas/formulario_bodeguistas_crear','GestionEmpresasController@formulario_bodeguistas_crear')->name('empresa.bodeguistas.formulario_bodeguistas_crear');
Route::post('/empresa/bodeguistas/bodeguistas_crear','GestionEmpresasController@bodeguistas_crear')->name('empresa.bodeguistas.bodeguistas_crear');
Route::get('/empresa/bodeguistas/{usuario_id}/formulario_bodeguistas_actualizar','GestionEmpresasController@formulario_bodeguistas_actualizar')->name('empresa.bodeguistas.formulario.bodeguistas_actualizar');
Route::PUT('/empresa/bodeguistas/{usuario_id}','GestionEmpresasController@bodeguistas_actualizar')->name('empresa.bodeguistas.bodeguistas_actualizar');

Route::get('/empresa/bodeguistas/bodeguistas_desactivar/{usuario}', 'GestionEmpresasController@usuarios4_desactivar')->name('empresa.empresa_usuarios.usuarios_desactivar');
Route::get('/empresa/bodeguistas/bodeguistas_activar/{usuario}', 'GestionEmpresasController@usuarios4_activar')->name('administrador.empresa_usuarios.usuarios_activar');

Route::get('/empresa/bodeguistas/{usuario_id}/formulario_correo_bodeguistas_actualizar','GestionEmpresasController@formulario_correo_bodeguistas_actualizar')->name('empresa.bodeguistas.formulario_correo_bodeguistas_actualizar');
Route::PUT('/empresa/bodeguistas/{usuario_id}/correo_bodeguistas_actualizar','GestionEmpresasController@correo_bodeguistas_actualizar')->name('empresa.bodeguistas.correo_bodeguistas_actualizar');

/////->Gestionempresa - carteristas


Route::get('/empresa/carteristas','GestionEmpresasController@lista_carteristas')->name('empresa.empresa_carteristas');
Route::get('/empresa/carteristas/formulario_carteristas_crear','GestionEmpresasController@formulario_carteristas_crear')->name('empresa.empresa_carteristas.formulario_carteristas_crear');
Route::post('/empresa/carteristas/carteristas_crear','GestionEmpresasController@carteristas_crear')->name('empresa.empresa_carteristas.empresa_carteristas_crear');
Route::get('/empresa/carteristas/{usuario_id}/formulario_carteristas_actualizar','GestionEmpresasController@formulario_carteristas_actualizar')->name('empresa.empresa_carteristas.formulario.carteristas_actualizar');
Route::PUT('/empresa/carteristas/{usuario_id}','GestionEmpresasController@carteristas_actualizar')->name('empresa.empresa_carteristas.empresa.carteristas_actualizar');

Route::get('/empresa/empresa_carterista/carterista_desactivar/{usuario}', 'GestionEmpresasController@usuarios_desactivar')->name('empresa.empresa_usuarios.usuarios_desactivar');
Route::get('/empresa/empresa_carterista/carterista_activar/{usuario}', 'GestionEmpresasController@usuarios_activar')->name('administrador.empresa_usuarios.usuarios_activar');

Route::get('/empresa/carteristas/{usuario_id}/formulario_correo_carterista_actualizar','GestionEmpresasController@formulario_correo_carterista_actualizar')->name('empresa.carterista.formulario_correo_carterista_actualizar');
Route::PUT('/empresa/carteristas/{usuario_id}/correo_carterista_actualizar','GestionEmpresasController@correo_carterista_actualizar')->name('empresa.carterista.correo_carterista_actualizar');

/////->Gestionempresa - productos

Route::get('/empresa/productos','GestionEmpresasController@lista_productos')->name('empresa.empresa_productos');
Route::get('/empresa/productos/formulario_productos_crear','GestionEmpresasController@formulario_productos_crear')->name('empresa.empresa_productos.formulario_productos_crear');
Route::post('/empresa/productos/productos_crear','GestionEmpresasController@productos_crear')->name('empresa.empresa_productos.empresa_productos_crear');
Route::get('/empresa/productos/{producto_id}/formulario_productos_actualizar','GestionEmpresasController@formulario_productos_actualizar')->name('empresa.empresa_productos.formulario.productos_actualizar');
Route::PUT('/empresa/productos/{producto_id}','GestionEmpresasController@productos_actualizar')->name('empresa.empresa_productos.empresa.productos_actualizar');

/////->Gestionempresa - clientes

Route::get('/empresa/carteras/{cartera_id}/clientes','GestionEmpresasController@lista_clientes')->name('empresa.empresa_carteras_clientes');
Route::get('/empresa/carteras/clientes/{cliente_id}/formulario_cliente_actualizar','GestionEmpresasController@formulario_cliente_actualizar')->name('empresa.empresa_clientes.formulario.clientes_actualizar');
Route::PUT('/empresa/empresa_carteras/clientes/{cliente_id}/cliente_actualizar','GestionEmpresasController@cliente_actualizar')->name('empresa.empresa_cartera_clientes.empresa.cartera_clientes_actualizar');

/////->Gestionempresa - lista negra

Route::get('/empresa/listanegra','GestionEmpresasController@lista_negra_clientes')->name('empresa.listanegra');

Route::get('/empresa/listanegra/{cliente_id}/formulario_cliente_listanegra_actualizar','GestionEmpresasController@formulario_cliente_listanegra_actualizar')->name('formulario_cliente_listanegra.actualizar');
Route::PUT('/empresa/listanegras/{cliente_id}','GestionEmpresasController@cliente_listanegra_actualizar')->name('cliente_listanegra.actualizar');

Route::get('/empresa/listanegra/confirmar/{cliente_id}', 'GestionEmpresasController@cliente_listanegraP_confirmar')->name('empresa.listanegra.confirmar');

/////->Gestionempresa - lista inactivos

Route::get('/empresa/listainactivos','GestionEmpresasController@lista_inactivos_clientes')->name('empresa.listainactivos');
Route::get('/empresa/listainactivos/{cliente_id}/formulario_cliente_listainactivos_actualizar','GestionEmpresasController@formulario_cliente_listainactivos_actualizar')->name('formulario.listainactivos.actualizar');
Route::PUT('/empresa/listainactivos/{cliente_id}','GestionEmpresasController@cliente_listainactivos_actualizar')->name('cliente_listainactivos.actualizar');

/////->Gestionempresa - bonos

Route::get('/empresa/bonos/{cartera_id}','GestionEmpresasController@bonos')->name('empresa.bonos');

/////->Gestionempresa - novedades

Route::get('/empresa/novedades/{cartera_id}','GestionEmpresasController@novedades')->name('empresa.novedades');

//-> Administrador
Route::get('/administrador/empresas', 'AdministradorController@administrador_empresas')->name('administrador.administrador_empresas');
Route::get('/administrador/usuarios', 'AdministradorController@administrador_usuarios')->name('administrador.administrador_usuarios');

//-->Administrador - empresas
Route::get('/administrador/empresas/formulario_empresas_crear','EmpresasController@formulario_empresas_crear')->name('administrador.administrador_empresas.formulario_empresas_crear');
Route::post('/administrador/administrador_empresas/empresas_crear','EmpresasController@empresas_crear')->name('administrador.administrador_empresas.empresas_crear');
Route::get('/administrador/empresas/{empresa_id}/formulario_empresas_actualizar','EmpresasController@formulario_empresas_actualizar')->name('administrador.administrador_empresas.formulario_empresas_actualizar');
Route::PUT('/administrador/administrador_empresas/{empresa_id}','EmpresasController@empresas_actualizar')->name('administrador.administrador_empresas.empresas_actualizar');

Route::get('/administrador/administrador_empresas/empresas_desactivar/{empresa}', 'EmpresasController@empresas_desactivar')->name('administrador.administrador_empresas.empresas_desactivar');
Route::get('/administrador/administrador_empresas/empresas_activar/{empresa}', 'EmpresasController@empresas_activar')->name('administrador.administrador_empresas.empresas_activar');

//--> Administrador - usurarios administradores
Route::get('/administrador/usuarios/formulario_usuarios_crear','AdministradorController@formulario_usuarios_crear')->name('administrador.administrador_usuarios.formulario_usuarios_crear');
Route::post('/administrador/administrador_usuarios/usuarios_crear','AdministradorController@usuarios_crear')->name('administrador.administrador_usuarios.usuarios_crear');
Route::get('/administrador/usuarios/{usuario_id}/formulario_usuarios_actualizar','AdministradorController@formulario_usuarios_actualizar')->name('administrador.administrador_usuarios.formulario_usuarios_actualizar');
Route::put('/administrador/administrador_usuarios/{usuario}','AdministradorController@usuarios_actualizar')->name('administrador.administrador_usuarios.usuarios_actualizar');

Route::get('/administrador/administrador_usuarios/usuarios_desactivar/{usuario}', 'AdministradorController@usuarios_desactivar')->name('administrador.administrador_usuarios.usuarios_desactivar');
Route::get('/administrador/administrador_usuarios/usuarios_activar/{usuario}', 'AdministradorController@usuarios_activar')->name('administrador.administrador_usuarios.usuarios_activar');

Route::get('/administrador/usuarios/{usuario_id}/formulario_correo_usuarios_actualizar','AdministradorController@formulario_correo_usuarios_actualizar')->name('administrador.usuarios.formulario_correo_usuarios_actualizar');
Route::PUT('/administrador/usuarios/{usuario_id}/correo_usuarios_actualizar','AdministradorController@correo_usuarios_actualizar')->name('empresa.usuarios.correo_usuarios_actualizar');

//---> Administrador - empresas - carteras
Route::get('/administrador/empresas/{empresa_id}/carteras', 'AdministradorController@administrador_carteras')->name('administrador.administrador_carteras');
Route::get('/administrador/empresas/{empresa_id}/formulario_carteras_crear','AdministradorController@formulario_carteras_crear')->name('administrador.administrador_carteras.formulario_carteras_crear');
Route::post('/administrador/administrador_carteras/carteras_crear','AdministradorController@carteras_crear')->name('administrador.administrador_carteras.carteras_crear');
Route::get('/administrador/empresas/{empresa_id}/carteras/{cartera_id}/formulario_carteras_actualizar','AdministradorController@formulario_carteras_actualizar')->name('administrador.administrador_carteras.formulario_carteras_actualizar');
Route::put('/administrador/administrador_carteras/{cartera}','AdministradorController@carteras_actualizar')->name('administrador.administrador_carteras.carteras_actualizar');

Route::get('/administrador/administrador_carteras/carteras_desactivar/{cartera_id}', 'AdministradorController@carteras_desactivar')->name('administrador.administrador_carteras.carteras_desactivar');
Route::get('/administrador/administrador_carteras/carteras_activar/{cartera_id}', 'AdministradorController@carteras_activar')->name('administrador.administrador_carteras.carteras_activar');

//////////Vistas de bodega//////////

Route::get('/bodega','GestionBodegaController@panel_central_bodega')->name('bodega');
Route::get('/bodega/cartera/{cartera_id}/formulario_cargar_cartera','GestionBodegaController@formulario_cargar_cartera')->name('bodega.formulario_cargar_cartera');
Route::post('/bodega/cartera/{cartera_id}/cargar_cartera','GestionBodegaController@cargar_cartera')->name('bodega.cargar_cartera');

Route::get('/bodega/cartera/{cartera_id}/informacion_carga_cartera','GestionBodegaController@informacion_carga_cartera')->name('bodega.informacion_carga_cartera');
Route::get('/bodega/cartera/{cartera_id}/formulario_recargar_cartera','GestionBodegaController@formulario_recargar_cartera')->name('bodega.formulario_recargar_cartera');
Route::get('/bodega/cartera/{cartera_id}/formulario_descargar_cartera','GestionBodegaController@formulario_descargar_cartera')->name('bodega.formulario_descargar_cartera');
Route::post('/bodega/cargarcartera/{cartera_id}/recargar_cartera','GestionBodegaController@recargar_cartera')->name('bodega.recargar_cartera');
Route::post('/bodega/cargarcartera/{cartera_id}/descargar_cartera','GestionBodegaController@descargar_cartera')->name('bodega.descargar_cartera');

Route::get('/bodega/{cartera_id}/cierre_cartera','GestionBodegaController@cierre_dia_cartera')->name('bodega.cierre_cartera');

//Carteristas
Route::get('/carterista','CarteristasController@panel_central_carteristas')->name('carterista');

//-->carteristas - crear clientes
Route::get('/carterista/clientes/formulario_clientes_crear', 'CarteristasController@formulario_clientes_crear')->name('carterista.clientes.formulario_clientes_crear');
Route::post('/carterista/clientes/clientes_crear','CarteristasController@clientes_crear')->name('carterista.clientes.clientes_crear');

//-->carteristas - ordenar clientes
Route::get('/carterista/clientes/formulario_clientes_ordenar', 'CarteristasController@formulario_clientes_ordenar')->name('carterista.clientes.formulario_clientes_ordenar');
Route::post('/carterista/clientes/clientes_ordenar','CarteristasController@clientes_ordenar')->name('carterista.clientes.clientes_ordenar');


//-->carteristas - Venta a clientes
Route::get('/carterista/gestion_cliente_cartera/{cliente_id}','CarteristasController@gestion_cliente_cartera')->name('carterista.gestion_cliente_cartera');

Route::get('/carterista/cliente/{cliente_id}/venta', 'CarteristasController@formulario_cliente_venta')->name('carterista.cliente.formulario_cliente_venta');
Route::post('/carterista/cliente/{cliente_id}/pagar', 'CarteristasController@formulario_cliente_pagar')->name('carterista.cliente.formulario_cliente_pagar');
Route::get('/carterista/cliente/{cliente_id}/formulario_pagar', 'CarteristasController@formulario_pagar')->name('carterista.cliente.formulario_pagar');
Route::post('/carterista/cliente/{cliente_id}/recaudo', 'CarteristasController@recaudo')->name('carterista.cliente.recaudo');

//Carterista - cliente - reportar lista negra
Route::get('/carterista/cliente/{cliente_id}/formulario_reportar_lista_negra', 'CarteristasController@formulario_reportar_lista_negra')->name('carterista.cliente.formulario_reportar_lista_negra');
Route::post('/carterista/cliente/{cliente_id}/reportar_lista_negra', 'CarteristasController@reportar_lista_negra')->name('carterista.cliente.reportar_lista_negra');



//Carterista - bonos
Route::get('/carterista/bono/formulario_bono_crear','CarteristasController@formulario_bono_crear')->name('carterista.bono.formulario_bono_crear');
Route::post('/carterista/bono/bono_crear','CarteristasController@bono_crear')->name('carterista.bono.bono_crear');

//Carterista - novedades
Route::get('/carterista/novedad/formulario_novedad_crear','CarteristasController@formulario_novedad_crear')->name('carterista.novedad.formulario_novedad_crear');
Route::post('/carterista/novedad/novedad_crear','CarteristasController@novedad_crear')->name('carterista.novedad.novedad_crear');


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









Route::get('/listanegras/formulario_listanegras_crear','DemoIvanController@formulario_listanegras_crear');
Route::post('/listanegras','DemoIvanController@listanegras_crear');
Route::get('/listanegras/{listanegras_id}/formulario_listanegras_actualizar','DemoIvanController@formulario_listanegras_actualizar');
Route::PUT('/listanegras/{listanegras_id}','DemoIvanController@listanegras_actualizar');

Route::get('/listanegras/desactivar/{cliente}', 'DemoIvanController@desActivarLista')->name('listanegras.activarLista');
Route::get('/listanegras/activar/{cliente}', 'DemoIvanController@activarLista')->name('listanegras.desActivarLista');











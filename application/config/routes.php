<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
/* Controlador por defecto */
$route['default_controller'] = 'login';

/* Formulario de Login */
$route['login'] = 'login/login';
$route['dologin'] = 'login/doLogin';
$route['logout'] = 'login/logout';

/* Programacion en general */
$route['usuarios'] = 'main/usuarios';
$route['parametros'] = 'main/parametros';
$route['logistica'] = 'main/logistica';
$route['citas'] = 'main/citas';
$route['main/curl'] = 'main/curl';
$route['main/ruccurl'] = 'main/ruccurl';
$route['main/upload'] = 'main/upload';
/* Cambiar perfil del usuario */
$route['main/perfil'] = 'main/perfil';
$route['main/cambiapass'] = 'main/password';
$route['main/provincias'] = 'main/provincias';
$route['main/distritos'] = 'main/distritos';
$route['main/cargarLatLng'] = 'main/cargarLatLng';

/* Usuarios */
$route['usuarios/usuarios'] = 'main/usuarios';
$route['usuarios/nuevousuario'] = 'usuarios/main/nuevo';
$route['usuarios/lista']['get'] = 'usuarios/main/listaUsuarios';
$route['usuarios/nuevo'] = 'usuarios/main/nuevo';
$route['usuarios/editar'] = 'usuarios/main/nuevo';
$route['usuarios/registrar'] = 'usuarios/main/registrar';
$route['usuarios/habilitar'] = 'usuarios/main/habilitar';
$route['usuarios/reset'] = 'usuarios/main/resetear';
$route['usuarios/permisos'] = 'usuarios/main/permisosUsuario';
$route['usuarios/permisos/asignar'] = 'usuarios/main/asignarPermisos';

/* Parametros */
$route['parametros/empresas'] = 'parametros/empresas';
$route['parametros/empresas/lista'] = 'parametros/listaempresas';
$route['parametros/empresas/nuevo'] = 'parametros/nuevo';
$route['parametros/regempresa'] = 'parametros/regempresa';
$route['parametros/empresas/editar'] = 'parametros/editempresa';
$route['parametros/empresas/anular'] = 'parametros/anular';
$route['parametros/centros'] = 'parametros/centros';

/* Logistica */
$route['logistica/proveedores'] = 'logistica/proveedores';
$route['logistica/proveedores/lista'] = 'logistica/listaproveedores';
$route['logistica/proveedores/nuevo'] = 'logistica/nuevo';
$route['logistica/regproveedor'] = 'logistica/regproveedor';
$route['logistica/proveedores/editar'] = 'logistica/editproveedor';
$route['logistica/proveedores/anular'] = 'logistica/anular';
$route['logistica/bienes'] = 'logistica/bienes';
$route['logistica/bienes/lista'] = 'logistica/listabienes';
$route['logistica/bienes/nuevo'] = 'logistica/nuevobienes';
$route['logistica/regbienes'] = 'logistica/regbienes';
$route['logistica/bienes/editar'] = 'logistica/editbienes';
$route['logistica/bienes/anular'] = 'logistica/anular';
$route['logistica/servicios'] = 'logistica/servicios';
$route['logistica/servicios/lista'] = 'logistica/listaservicios';
$route['logistica/servicios/nuevo'] = 'logistica/nuevoservicios';
$route['logistica/regservicios'] = 'logistica/regservicios';
$route['logistica/servicios/editar'] = 'logistica/editservicios';
$route['logistica/servicios/anular'] = 'logistica/anular';

/* Modulo de citas */
$route['citas/pacientes'] = 'citas/formpaciente';
$route['citas/consultorios'] = 'citas/formconsultorio';
$route['citas/medicos'] = 'citas/formmedico';
$route['citas/citas'] = 'citas/calendario';

/**/
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

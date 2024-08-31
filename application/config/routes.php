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
$route['parametros/curlajax'] = 'main/dniajax';

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
$route['logistica/gentrada'] = 'logistica/entrada';
$route['logistica/gentrada/lista'] = 'logistica/listaingresos';
$route['logistica/gentrada/nuevo'] = 'logistica/formingresos';
$route['logistica/gentrada/editar'] = 'logistica/editingresos';
$route['logistica/gsalida'] = 'logistica/salida';
$route['logistica/gsalida/lista'] = 'logistica/listasalidas';
$route['logistica/gsalida/nuevo'] = 'logistica/formsalidas';
$route['logistica/gsalida/editar'] = 'logistica/editsalidas';
$route['logistica/ocompra'] = 'logistica/oc';
$route['logistica/ocompra/lista'] = 'logistica/listaoc';
$route['logistica/ocompra/nuevo'] = 'logistica/ocform';
$route['logistica/ocompra/editar'] = 'logistica/editoc';
$route['logistica/oservicio'] = 'logistica/oc';
$route['logistica/oservicio/lista'] = 'logistica/listaos';
$route['logistica/oservicio/nuevo'] = 'logistica/ocform';
$route['logistica/oservicio/editar'] = 'logistica/editos';

$route['logistica/findalmacenes'] = 'logistica/findalmacenes';
$route['logistica/buscaproveedor'] = 'logistica/listaProvServer';
$route['logistica/articulosguias'] = 'logistica/listaarticulosguias';
$route['logistica/buscaarticulos'] = 'logistica/listaArtServer';

/* Modulo de citas */
$route['citas/pacientes'] = 'citas/pacientes';
$route['citas/pacientes/nuevo'] = 'citas/formpaciente';
$route['citas/pacientes/editar'] = 'citas/editarpaciente';
$route['citas/pacientes/anular'] = 'citas/anular';
$route['citas/pacientes/lista'] = 'citas/listapacientes';
$route['citas/pacientes/regpaciente'] = 'citas/regpaciente';
$route['citas/consultorios'] = 'citas/consultorios';
$route['citas/consultorios/nuevo'] = 'citas/formconsultorio';
$route['citas/consultorios/editar'] = 'citas/editarconsultorio';
$route['citas/consultorios/anular'] = 'citas/anular';
$route['citas/consultorios/lista'] = 'citas/listaconsultorios';
$route['citas/consultorios/regconsultorio'] = 'citas/regconsultorio';
$route['citas/medicos'] = 'citas/medicos';
$route['citas/medicos/nuevo'] = 'citas/formmedico';
$route['citas/medicos/editar'] = 'citas/editarmedico';
$route['citas/medicos/anular'] = 'citas/anular';
$route['citas/medicos/lista'] = 'citas/listamedicos';
$route['citas/medicos/regmedico'] = 'citas/regmedico';
$route['citas/turnos'] = 'citas/turnos';
$route['citas/turnos/nuevo'] = 'citas/formturnos';
$route['citas/turnos/lista'] = 'citas/listaturnos';
$route['citas/turnos/consultorios'] = 'citas/findconsultorios';
$route['citas/turnos/regturno'] = 'citas/regturno';
$route['citas/turnos/anular'] = 'citas/anular';
$route['citas/citas'] = 'main/citas';
$route['citas/citasprof'] = 'citas/citasprof';
$route['citas/citas/nuevo'] = 'citas/calendario';
$route['citas/citas/lista'] = 'citas/listacitas';
$route['citas/citas/buscarpacientes'] = 'citas/listaPacServer';
$route['citas/citas/asignapaciente'] = 'citas/asignarpaciente';
$route['citas/citas/desasignar'] = 'citas/despaciente';
$route['citas/citas/cerrar'] = 'citas/cerrar';
$route['citas/turnos/detalle'] = 'citas/detalle_turno';
$route['citas/turnos/regdetalle'] = 'citas/regdetalle';
$route['citas/historia'] = 'citas/historia';
$route['citas/historia/lista'] = 'citas/listahistorias';
$route['citas/historia/anular'] = 'citas/anular';
$route['citas/historia/nuevo'] = 'citas/formhistoria';
$route['citas/historia/reghistoria'] = 'citas/reghistoria';
$route['citas/historia/regdetalle'] = 'citas/reghistdetalle';
$route['citas/historia/listacie'] = 'citas/listaCIE';
$route['citas/historia/regatencion'] = 'citas/regatencion';
$route['citas/historia/listadiagnostico'] = 'citas/listadiagnostico';
$route['citas/historia/regdiagnostico'] = 'citas/regdiagnostico';
$route['citas/historia/listaprocedimientos'] = 'citas/listaprocedimientos';
$route['citas/historia/listaproc'] = 'citas/listaprocserver';
$route['citas/historia/regprocedimiento'] = 'citas/regprocedimiento';
$route['citas/historia/listaauxiliares'] = 'citas/listaauxserver';
$route['citas/historia/regexamenes'] = 'citas/regexamenes';
$route['citas/historia/listaindicaciones'] = 'citas/listaindicaciones';
$route['citas/historia/listaart'] = 'citas/listaartserver';
$route['citas/historia/regindicaciones'] = 'citas/regindicaciones';
$route['citas/historia/datosreceta'] = 'citas/datosreceta';
$route['citas/historia/datosorden'] = 'citas/datosorden';
$route['citas/historia/regreceta'] = 'citas/regreceta';
$route['citas/historia/regorden'] = 'citas/regorden';
$route['citas/historia/imprimereceta'] = 'pdf/recetapdf';
$route['citas/historia/imprimeorden'] = 'pdf/ordenpdf';
$route['citas/adicional'] = 'citas/citaadicional';
$route['citas/regadicional'] = 'citas/regadicional';
$route['citas/procedimientos'] = 'citas/procedimientos';
$route['citas/procedimientos/lista'] = 'citas/lprocedimientos';
$route['citas/procedimientos/nuevo'] = 'citas/nuevoprocedimiento';
$route['citas/procedimientos/editar'] = 'citas/editarprocedimiento';
$route['citas/procedimientos/anular'] = 'citas/anular';
$route['citas/procedimientos/regprocedimiento'] = 'citas/rprocedimientos';
$route['citas/historia/ver'] = 'pdf/verhistoria';

/**/
$route['404_override'] = 'main/error';
$route['translate_uri_dashes'] = FALSE;

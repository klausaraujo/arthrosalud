<!-- Desactivar cache del navegador 
<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="<?=base_url()?>/public/images/favicon.jpg"/>
<link rel="icon" href="<?=base_url()?>/public/images/favicon.jpg" type="image/x-icon">
<link rel="stylesheet" href="<?=base_url()?>/public/css/bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>/public/datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/css/typography.css">
<link rel="stylesheet" href="<?=base_url()?>/public/css/style.css">
<link rel="stylesheet" href="<?=base_url()?>/public/css/responsive.css">
<link rel="stylesheet" href="<?=base_url()?>/public/css/fontawesome.css">
<link rel="stylesheet" href="<?=base_url()?>/public/assets/css/fontawesome.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/assets/css/brands.css">
<link rel="stylesheet" href="<?=base_url()?>/public/assets/css/solid.css">
<style>
/* Colores personalizados*/
.wrapper, .sidebar-scrollbar, .sign-in-page .sign-in-page-bg::after, .bg-sabogal, .btn-sabogal, .iq-card-body-elements {
	background: rgba(239, 149, 47, 1); background: -moz-linear-gradient(left, rgba(239, 149, 47, 1) 0%, rgba(239, 149, 47, 1) 100%); background: -webkit-gradient(left top, right top, color-stop(0%, rgba(239, 149, 47, 1)), color-stop(100%, rgba(239, 149, 47, 1))); background: -webkit-linear-gradient(left, rgba(239, 149, 47, 1) 0%, rgba(239, 149, 47, 1) 100%); background: -o-linear-gradient(left, rgba(239, 149, 47, 1) 0%, rgba(239, 149, 47, 1) 100%); background: -ms-linear-gradient(left, rgba(239, 149, 47, 1) 0%, rgba(239, 149, 47, 1) 100%); background: linear-gradient(to right, rgba(239, 149, 47, 1) 0%, rgba(239, 149, 47, 1) 100%); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ef952f', endColorstr='#ef952f', GradientType=1);
}
.btn-sabogal{ color: #ffffff; }
.iq-card-body-elements{ height : 230px; border-radius:20px; padding-top: 15px; text-align: center!important; }

@media(max-width: 1299px){
	body.sidebar-main .iq-sidebar {
		width: 260px; left: 0; z-index: 999;
		background: rgba(239, 149, 47, 1);
		background: -moz-linear-gradient(left, rgba(239, 149, 47, 1) 0%, rgba(81,209,246,1) 100%);
		background: -webkit-gradient(left top, right top, color-stop(0%, rgba(239, 149, 47, 1)), color-stop(100%, rgba(239, 149, 47, 1)));
		background: -webkit-linear-gradient(left, rgba(239, 149, 47, 1) 100%) 0%, rgba(239, 149, 47, 1) 100%);
		background: -o-linear-gradient(left, rgba(239, 149, 47, 1) 0%, rgba(239, 149, 47, 1) 100%);
		background: -ms-linear-gradient(left, rgba(239, 149, 47, 1) 0%, rgba(239, 149, 47, 1) 100%);
		background: linear-gradient(to right, rgba(239, 149, 47, 1) 0%, rgba(239, 149, 47, 1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0096d2', endColorstr='#51d1f6', GradientType=1);
	}
	*::-moz-selection { background: rgba(239, 149, 47, 0.8); color: #fff; text-shadow: none; }
	::-moz-selection { background: rgba(239, 149, 47, 0.8); color: #fff; text-shadow: none; }
	::selection { background: rgba(239, 149, 47, 0.8); color: #fff; text-shadow: none; }
}
*::-moz-selection { background: rgba(239, 149, 47, 0.8); color: #fff; text-shadow: none; }
::-moz-selection { background: rgba(239, 149, 47, 0.8); color: #fff; text-shadow: none; }
::selection { background: rgba(239, 149, 47, 0.8); color: #fff; text-shadow: none; }

.btn { padding: 0.3rem 0.7rem 0.3rem 0.7rem; }
label, .btn, .pagination, .form-control, .nav-pills .nav-item.nav-link, a, li, span { font-size: 12.5px }
.btnTable{ -webkit-transition-duration: 0.4s;transition-duration: 0.4s;margin-right:5px;padding:1.5px;border-radius:5px;box-shadow:3px 3px 2px 0 rgb(1 0 2 / 50%); color: #fff; }
.btnTable:hover{ color: #000 }
.btnDesactivar{ color: green; /*border: 1px solid darkgrey*/ } .btnDesactivar:hover{ color: red; /*border: 1px solid darkgreen*/ }
.btnActivar{ color: red; /*border: 1px solid darkgrey*/ } .btnActivar:hover{ color: green; /*border: 1px solid darkred*/ }
</style>
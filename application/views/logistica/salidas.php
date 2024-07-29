						<div class="col-12 card px-0 my-3">
							<div class="card-body">
								<h4 class="">Lista de Egresos</h4>
								<hr>
								<div class="float-right"><a href="<?=base_url()?>logistica/gsalida/nuevo" class="btn btn-sabogal">Nueva Salida</a></div>
							</div>
							<div class="row justify-content-center py-2">								<?if($this->session->flashdata('claseMsg')){?><div class="alert <?=$this->session->flashdata('claseMsg')?> py-1 px-5 msg fade show" role="alert">									<div class="iq-alert-text"><?=$this->session->flashdata('flashMessage')?></div>								</div><?}?>
								<div class="msg"></div>							</div>							<div class="container-fluid">								<div class="row"> <!--class="table-responsive" -->									<div class="col-12 mx-auto" style="overflow-x:auto">									<!--<div class="col-sm-12 mx-auto" style="overflow-x:scroll"><!--align-items-center text-center-->										<!--<table id="tablaProveedores" class="table table-striped dt-responsive table-bordered display nowrap table-hover mb-0 mx-auto"></table>-->										<!--<table id="tablaProveedores" class="table table-striped table-hover table-bordered mx-auto"></table>-->										<table id="tablaSalidas" class="table table-striped table-hover table-bordered mb-0 mx-auto" style="width:100%"></table>									</div>								</div>							</div>						</div>
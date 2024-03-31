		<? $usuario = json_decode($this->session->userdata('user')); ?>
		<div class="iq-sidebar">
            <div class="iq-sidebar-logo d-flex justify-content-between">
				<a href="<?=base_url()?>"><img src="<?=base_url()?>public/images/logo-white.png" class="img-fluid" alt=""></a>
				<div class="iq-menu-bt-sidebar">
                    <div class="iq-menu-bt align-self-center">
                        <div class="wrapper-menu">
							<div class="main-circle"><i class="ri-more-fill"></i></div>
							<div class="hover-circle"><i class="ri-more-2-fill"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sidebar-scrollbar">
				<nav class="iq-sidebar-menu">
					<ul id="iq-sidebar-toggle" class="iq-menu">
						<li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Panel de Navegaci&oacute;n</span></li>
						<li class="<?=$this->uri->segment(1) == '' ? 'active main-active': ''; ?>" >
							<a href="<?=base_url()?>" class="iq-waves-effect"><i class="ri-home-8-fill"></i><span>Inicio</span></a>
						</li>
				<? 
						$idmodulo = '';
						foreach($usuario->modulosid as $row): if($this->uri->segment(1) === $row->url){ $idmodulo = $row->idmodulo; break; } endforeach;
						
						if($idmodulo == ''){
							foreach($usuario->modulos as $row): ?>
						<li>
							<a href="<?=base_url().$row->url?>" class="iq-waves-effect"><i class="<?=$row->mini?>" aria-hidden="true"></i><span><?=$row->menu?></span></a>
						</li>
				<?			endforeach;
						}else{
							// Area del bucle del menu
							foreach($usuario->menus as $row):
								if($row->idmodulo === $idmodulo){
				?>
						<li>
				<?
									if($row->nivel === '0'){
				?>
							<a href="<?=base_url().$this->uri->segment(1).'/'.$row->url?>" class="iq-waves-effect"><i class="<?=$row->icono?>"></i><span><?=$row->descripcion?></span></a>
				<?					}else{	?>
						<!-- Area de submenus -->
							<a href="#submenu_<?=$row->idmenu?>" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="<?=$row->icono?>"></i><span><?=$row->descripcion?></span><i class="ri-arrow-right-s-line iq-arrow-right"></i>
							</a>
							<ul id="submenu_<?=$row->idmenu?>" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
				<?						foreach($usuario->submenus as $row2):
											if($row->idmenu === $row2->idmenu){
				?>
								<li>
									<a href="<?=base_url().$this->uri->segment(1).'/'.$row2->url?>" style="color:#117428" >
										<i class="<?=$row2->icono?>"></i><?=$row2->descripcion?>
									</a>
								</li>
				<?							}
										endforeach;
				?>	
							</ul>
						<!-- Fin del Area de submenus -->
				<?					}
				?>
						</li>
				<?
								}
							endforeach;
						}
				?>
						<!-- Fin del area del bucle del menu -->
                    </ul>
				</nav>
				<div class="p-3"></div>
            </div>
        </div>
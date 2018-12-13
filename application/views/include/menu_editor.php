<section>
<?php
    $CI =& get_instance();
    $CI->load->library('session');
    $CI->load->model('Articulo_model');
    $data_usuario=$CI->session->userdata('userdata');
    $email_select=$data_usuario['email_usuario'];
    $est1 = $CI->Articulo_model-> autor_direct($email_select);
    $datos=$est1->result();
    $nombre="";
    if(isset($est1)){
        $nombre=$datos[0]->nombre." ".$datos[0]->apellido_1;
    }
   
 ?>
        <!-- Left Sidebar -->
		<?php 	$user_data = $this->session->userdata('userdata');	?>
        <aside id="leftsidebar" class="sidebar" style="margin-top: 85px;">
            <!-- User Info -->
            <div class="user-info">
           
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $nombre; ?></div>
                    <div class="email"><?php echo $email_select; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
					
						<?php
                  
                ?>
							    
                            <li role="seperator" class="divider"></li>
							<li><a href="<?php echo base_url(); ?>index.php/Login/pass" class=" waves-effect waves-block"><i class="material-icons">refresh</i> Cambiar<br><center>Password</center></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Login/cerrar_sesion" class=" waves-effect waves-block"><i class="material-icons">input</i> Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu scroll-menu-2x">
                <ul class="list">
                    <li class="header">Acciones Editor</li>
                    <li class="active">
                        <a href="<?php echo base_url(); ?>index.php/System/editor">
                            <i class="material-icons">home</i>
                            <span>Home Editor</span>
                        </a>
                    </li>
                   
                     
                    <li >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Estado del Artículo</span>
                        </a>
                     
                        <ul class="ml-menu">
							<li><a  href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_recibidos">Recibido</a></li>
                			<li><a  href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_noasignados">No Asignado</a></li>
			    			<li><a  href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_asignados">Asignado</a></li>
							<li><a  href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_revisados">Revisado</a></li>
                			<li><a  href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_rechazado_editor">Rechazado</a></li>
                			<li><a  href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_espera_final"><?php echo lang('ME_Espera Version Final');?></a></li>
                        </ul>
                    </li>
            
              
            
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_copy</i>
                            <span><?php echo lang('ME_revista');?></span>
                        </a>
                        <ul class="ml-menu">
							<li><a  href="<?php echo base_url(); ?>index.php/System/editor_magazine">Revistas Publicadas</a></li>
							<li><a  href="<?php echo base_url(); ?>index.php/System/newm"><?php echo lang('ME_asignar articulo');?></a></li>

                        </ul>
                    </li>
                    
                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle">
											<i class="material-icons">insert_chart</i>
                                            <span>Informes</span>
                                        </a>
										<ul class="ml-menu">
                                            <li>
                                                <a href="<?php echo base_url(); ?>index.php/Articulo_editor/informe_recibido">
                                                    <span>Artículos Recibidos</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url(); ?>index.php/Articulo_editor/informe_aceptado">
                                                    <span>Artículos Aceptados</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url(); ?>index.php/Articulo_editor/informe_rechazado">
                                                    <span>Artículos Rechazados</span>
                                                </a>
                                            </li>
											<li>
                                                <a href="<?php echo base_url(); ?>index.php/Articulo_editor/informe_espera">
                                                    <span>Artículos Espera versión final</span>
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="<?php echo base_url(); ?>index.php/Articulo_editor/informe_paginado">
                                                    <span>Artículos Convertidos</span>
                                                </a>
                                            </li>
											<li>
                                                <a href="<?php echo base_url(); ?>index.php/Articulo_editor/informe_publicado">
                                                    <span>Artículos Publicados</span>
                                                </a>
                                            </li>
                                            
                                    	</ul>
                                        
                            </li>
					<li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">unarchive</i>
                            <span>Configuración</span>
                        </a>
                        <ul class="ml-menu">
                           
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
									<i class="material-icons">http</i>
                                    <span>Página Principal</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php/System/editor_modificar_politica_editorial">
                                            <span><?php echo lang('vmc_politicas editorial');?></span>
                                        </a>
                                    </li>
									<li>
                                        <a href="<?php echo base_url(); ?>index.php/System/editor_modificar_sobre_nosotros" >
                                            <span><?php echo lang('vmc_sobre nosotros');?></span>
                                        </a>
                                       
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_imagen">
                                            <span><?php echo lang('vmc_logo del sistema');?></span>
                                        </a>
                                        
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_titulo">
                                            <span>Titulo de Revista</span>
                                        </a>
                                        
                                    </li>
								
                                </ul>
							</li>

							<li>
                                        <a href="javascript:void(0);" class="menu-toggle">
											<i class="material-icons">mail</i>
                                            <span>Mensajes</span>
                                        </a>
										<ul class="ml-menu">
                                            <li>
                                                <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_mensaje_r">
                                                    <span>Artículo recibido</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_mensaje_as">
                                                    <span>Artículo Asignado</span>
                                                </a>
                                            </li>
											<li>
                                                <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_mensaje_a">
                                                    <span>Artículo Aceptado</span>
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_mensaje_ac">
                                                    <span>Artículo Aceptado con Comentarios</span>
                                                </a>
                                            </li>
											<li>
                                                <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_mensaje_p">
                                                    <span>Artículo Publicado</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_mensaje_re">
                                                    <span>Artículo Rechazado</span>
                                                </a>
                                            </li>
                                    	</ul>
                                        
                            </li>

									
                        	
							<li>
                                        <a href="javascript:void(0);" class="menu-toggle">
											<i class="material-icons">storage</i>
                                            <span>Datos</span>
                                        </a>
										<ul class="ml-menu">
                                            <li>
                                                <a href="<?php echo base_url(); ?>index.php/System/editor_crud_campos">
                                                    <span>Editar Areas de Investigación</span>
                                                </a>
                                            </li>
											<li>
                                                <a href="<?php echo base_url(); ?>index.php/System/editor_crud_temas">
                                                    <span>Editar Temas</span>
                                                </a>
                                            </li>
											<li>
                                                <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_datos_r">
                                                    <span><?php echo lang('vmc_datos_revista');?></span>
                                                </a>
                                            </li>
                                    	</ul>
                                        
                            </li>
									
                        </ul>
                    </li>
					
					<li>
                        <a href="<?php echo base_url(); ?>index.php/System/dar_alta_revisor">
                            <i class="material-icons">check</i>
                            <span>Aceptación de revisores</span>
                        </a>
                    </li>

					<li>
                        <a href="<?php echo base_url(); ?>index.php/System/cambiar_configuracion">
                            <i class="material-icons">settings_applications</i>
                            <span>Parametros <br> de Control</span>
                        </a>
                    </li>

                </ul>
            </div>
         
        </aside>

</section>




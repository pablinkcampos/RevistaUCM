<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min_spanish.js"></script>


	<div class="content-wrap">
		<div class="container clearfix">
			<div class="postcontent nobottommargin col_last">
				<div id="posts" class="events small-thumbs">
					<div class="col-md-12">
						<div class="col-md-12">
							<br>
							<h3 style="color: grey;">
								<?php  echo lang('aallav_informacion articulo'); ?>
							</h3>

						</div>
						<div class="col-md-4"></div>
					</div>

					<div class="col-md-12">
						<div class="col-md-12">
							<table class="table" style="width:100%; text-align: right;">
								<?php foreach ($datos->result() as $row): ?>
								<?php
								
								$id_revista        =   $row->ID;
								$titulo_revista    =   $row->titulo_revista;
					            $email_autor          =   $row->email_autor;
					            $tema          =   $row->tema;
					            $estado         =   $row->estado;

					            $palabras_claves   =   $row->palabras_claves;
					            $abstract          =   $row->abstract;

					            $archivo           =   $row->archivo;
					            $comentarios       =   $row->com_autor;
					            $fecha_ultima_upd  =   $row->fecha_ultima_upd ;

					            $fecha_ingreso     =   $row->fecha_ingreso;
								// $email_revisor_1		   =   $row->email_revisor_1;
								// $email_revisor_2		   =   $row->email_revisor_2;
								// $email_revisor_3		   =   $row->email_revisor_3;
								// $comentario_revisor_1		   =   $row->comentario_revisor_1;
								// $comentario_revisor_2		   =   $row->comentario_revisor_2;
								// $comentario_revisor_3		   =   $row->comentario_revisor_3;
								// $comentarios_editor		   =   $row->comentarios_editor;
								// $fecha_timeout		   =   $row->fecha_timeout;

					            //Imprimir





					            // echo "<tr>";
					            // echo "<th style='text-align: right;' style='text-align: right;'>".lang("aallav_id-articulo").":</th>";
					            // echo "<td >".$id_revista."</td>";
					            // echo "</tr>";

								echo "
                                    
								<tr>";
								echo "
								
								<th style='text-align: left;'>".lang("allanav_titulo articulo").":</th>";
								echo "
								
								<td style='text-align: left;' >".$titulo_revista."</td>";
								echo "
								
								</tr>";
								
								
								
								$CI =& get_instance();
								$CI->load->model('Articulo_model');
								
								//Autor
								echo "
								
								<tr>";
								echo "
								
								<th style='text-align: left;'>".lang("allanav_autor").":</th>";
								
								
								   echo "
								
								<td style='text-align: left;'>";
								   echo $email_autor;
								
								   echo "</td>";
								
								echo "
								
								</tr>";
								
								//Campo de investigacion
								echo "
								
								<tr>";
								echo "
								
								<th style='text-align: left;'>".lang("allanav_campo de investigacion").":</th>";
								
								   echo "
								
								<td style='text-align: left;'>";
								   echo $tema;
								   echo "</td>";
								
								echo "
								
								</tr>";
								
								//Estado
								echo "
								
								<tr>";
								echo "
								
								<th style='text-align: left;'>".lang("allanav_estado").":</th>";
								
								
								   echo "
								
								<td style='text-align: left;'>";
								   echo $row->estado;
								   echo "</td>";
								
								echo "
								
								</tr>";
								
								echo "
								
								<tr>";
								echo "
								
								<th style='text-align: left;'>".lang("allanav_palabras claves").":</th>";
								echo "
								
								<td style='text-align: left;'>".$palabras_claves."</td>";
								echo "
								
								</tr>";
								
								echo "
								
								<tr>";
								echo "
								
								<th style='text-align: left;'>".lang("allanav_abstract").":</th>";
								echo "
								
								<td  style='text-align: justify;'>".$abstract."</td>";
								echo "
								
								</tr>";
								
								echo "
								
								<tr>";
								echo "
								
								<th style='text-align: left;'>".lang("allanav_archivo:")."</th>";
								echo "
								
								<td style='text-align: left;'>
								<a href='".base_url()."uploads/".$archivo."'>".$archivo."</a>
								</td>";
								echo "
								
								</tr>";
								
								echo "
								
								<tr>";
								
								
								echo "
								
								<tr>";
								echo "
								
								<th style='text-align: left;'>".lang("allanav_fecha ultima actualizacion").":</th>";
								echo "
								
								<td style='text-align: left;'>".$fecha_ultima_upd."</td>";
								echo "
								
								</tr>";
								
								echo "
								
								<tr>";
								echo "
								
								<th style='text-align: left;'>".lang("allanav_fecha ingreso articulo").":</th>";
								echo "
								
								<td style='text-align: left;'>".$fecha_ingreso."</td>";
								echo "
								
								</tr>";
								if($comentarios==""){
									echo "
									
									<th style='text-align: left;'>".lang("allanav_comentarios").":</th>";
									echo "
									
									<td style='text-align: left;'>-</td>";
									echo "
									
									</tr>";
								}else{
									echo "
									
									<th style='text-align: justify;'>".lang("allanav_comentarios").":</th>";
									echo "
									
									<td >".$comentarios."</td>";
									echo "
									
									</tr> <br>";
									
								}
								



							?>
									<?php endforeach ?>
							</table>
						</div>
						<div class="col-md-4"></div>
					</div>

					<div class="form-group">
						<div class="col-md-offset-3 col-md-7">
							<form action="<?php echo base_url();?>index.php/articulo_editor/all_articulos_recibidos">
								<input type="submit" class="button button-3d button-mini button-rounded button-blue btn-block" value="<?php echo lang('aallav_regresar'); ?>"
								/>
							</form>
						</div>
					</div>
				</div>


			</div>

		
						<?php
                     $this->load->view('include/menu_editor');
                    ?>
		
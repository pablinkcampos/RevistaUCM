<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap-filestyle.min.js"> </script>
<script type="text/javascript">
	$(":userfile").filestyle();
</script>

<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min_spanish.js"></script>


<div class="content-wrap">
	<div class="container clearfix">
		<?php if($datos){ ?>
		<?php foreach ($datos->result() as $row): ?>
			<?php

			$id_revista        =   $row->ID;
			$titulo_revista    =   $row->titulo_revista;
			$version           =   $row->version;
			$email_autor          =   $row->email_autor;
			$id_campo          =   $row->id_campo;
			$id_estado         =   $row->id_estado;

			$palabras_claves   =   $row->palabras_claves;
			$abstract          =   $row->abstract;

			$archivo           =   $row->archivo;
			$comentarios       =   $row->comentarios;
			$fecha_ultima_upd  =   $row->fecha_ultima_upd ;

			$fecha_ingreso     =   $row->fecha_ingreso;
			$email_revisor_1		   =   $row->email_revisor_1;
			$email_revisor_2		   =   $row->email_revisor_2;
			$email_revisor_3		   =   $row->email_revisor_3;
			$comentarios_editor		   =   $row->comentarios_editor;
			$fecha_timeout		   	   =   $row->fecha_timeout;
			?>
			



		<div class="sidebar nobottommargin clearfix">
			<div class="sidebar-widgets-wrap">
				<div class="widget clearfix">
					<?php
					$this->load->view('include/menu_autor');
					?>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="col-md-12">
				<br>
				<h3 style = "color: black;"><?php echo lang('amamob_enviar artticulo modidificado ob');?></h3>
				<hr>
			</div>

			<div class="col-md-6">
				<label><?php echo lang('amamob_fecha limite');?>:</label>
				<br>
				<?php echo $fecha_timeout; ?>
				<br>
				<br>
			</div>
			<div class="col-md-6">
				<label><?php echo lang('amamob_fecha actual');?>:</label>
				<br>
				<?php echo $fecha_actual; ?>
				<br>
				<br>
			</div>


			<div class="col-md-12">
				<label><br>Comentario Editor:</label>
				<br>
				<?php echo $comentarios_editor; ?>
				<br>
				<br>
			</div>

			<div class="col-md-12">
				<?php echo form_open_multipart('index.php/Articulo_autor/mis_articulos_mod_ob/'.$id_revista);?>


					<div class="form-group">

						<label for="exampleInputFile"><?php echo lang('amamob_subir archivo');?>:</label>
                                                <input type="file" name = "userfile" accept=".doc, .docx" data-buttonText="<?php echo lang('amamob_seleccionar');?>" class="filestyle" id="exampleInputFile" aria-describedby="fileHelp" required="True">
						<small id="fileHelp" class="form-text text-muted"><?php echo lang('amamob_archivo de extension');?> .<?php echo strtolower($extension);?>, Max: 5MB</small>
					</div>
					<div class="form-group">

						<div class="col-md-offset-2 col-md-9">

							<input type="submit" class="button button-3d button-mini button-rounded button-green btn-block" value="<?php echo lang('amamob_subir');?>" />

						</div>
					</div>
				</form>
			</div>
			<div class="col-md-12">

				<div class="form-group">

					<div class="col-md-offset-2 col-md-9">
						<form action="<?php echo base_url();?>index.php/Articulo_autor/mis_articulos">
							<input type="submit" class="button button-3d button-mini button-rounded button-blue btn-block" value="<?php echo lang('amamob_regresar');?>" />
						</form>
					</div>

				</div>
			</div>
		</div>
		
		<?php endforeach ?>
		<?php } ?>
	</div>
</div>



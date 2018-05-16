<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php
echo base_url();
?>js/jquery.dataTables.min_spanish.js"></script>
<script type="text/javascript" src="<?php
echo base_url();
?>vendors/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(document)
	.ready(function()
	{
		$('#articulos tfoot th')
			.each(function()
			{
				var title = $(
						this)
					.text();
				$(this)
					.html(
						'<input type="text" style="width: 100%; text-align: left;" placeholder="Filtrar" />'
					);
			});
		var table = $('#a')
			.DataTable();
		// Apply the search
	});
</script>
<div class="col-md-12">
	<div class="col-md-12">
		<br>
		<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#infoArticulo" aria-expanded="false" aria-controls="infoArticulo">
			<?php echo lang( 'allarvv_informacion articulo' ); ?>
		</button>
	</div>
	<div class="col-md-4"></div>
</div>
<div class="col-md-12">
	<div class="collapse" id="infoArticulo">
		<div class="card card-body-fluid">
			<div class="col-md-12">
				<table class="table" style="width:100%; text-align: right;">
					<?php foreach ( $datos->result() as $row ): ?>
					<?php $id_revista=$row->ID; $titulo_revista = $row->titulo_revista; $email_autor = $row->email_autor; $tema = $row->tema; $estado = $row->estado; $id_estado = $row->id_estado; $palabras_claves = $row->palabras_claves; $abstract = $row->abstract; $archivo = $row->archivo; $comentarios = $row->com_autor; $fecha_ultima_upd = $row->fecha_ultima_upd; $fecha_asignacion = $row->fecha_asr; $fecha_cal = $row->fecha_cal; $fecha_calf = $row->fecha_calf; $fecha_ingreso = $row->fecha_ingreso; $n_rev1 = $row->rev_1; $n_rev2 = $row->rev_2; $n_rev3 = $row->rev_3; $id_rev1 = $row->id_rev1; $id_rev2 = $row->id_rev2; $id_rev3 = $row->id_rev3; $cal_rev1 = $row->cal_rev1; $cal_rev2 = $row->cal_rev2; $cal_rev3 = $row->cal_rev3; $com_rev1 = $row->com_rev1; $com_rev2 = $row->com_rev2; $com_rev3 = $row->com_rev3; $fecha_final = $row->fecha_timeout; echo "
					<tr>"; echo "
						<th style='text-align: right;'>" . lang( "allarvv_titulo articulo" ) . ":
						</th>"; echo "
						<td>" . $titulo_revista . "</td>"; echo "
					</tr>"; $CI =& get_instance(); $CI->load->model( 'Articulo_model' ); echo "
					<tr>"; echo "
						<th style='text-align: right;'>" . lang( "allarvv_autor" ) . ":</th>"; echo "
						<td>"; echo $email_autor; echo "
						</td>"; echo "</tr>"; echo "
					<tr>"; echo "
						<th style='text-align: right;'>" . lang( "allarvv_campo de investigacion" ) . ":
						</th>"; echo "
						<td>"; echo $tema; echo "
						</td>"; echo "
					</tr>"; echo "
					<tr>"; echo "
						<th style='text-align: right;'>" . lang( "allarvv_estado" ) . ":</th>"; echo "
						<td>"; echo $row->estado; echo "
						</td>"; echo "</tr>"; echo "
					<tr>"; echo "
						<th style='text-align: right;'>" . lang( "allarvv_abstract" ) . ":</th>"; echo "
						<td style='text-align: justify;'>" . $abstract . "</td>"; echo "</tr>"; echo "
					<tr>"; echo "
						<th style='text-align: right;'>" . lang( "allarvv_archivo:" ) . "</th>"; echo "
						<td><a href='" . base_url() . "uploads/" . $archivo . "'>" . $archivo . "</a>
						</td>"; echo "</tr>"; echo "
					<tr>"; if ( $comentarios == "" ) { echo "
						<th style='text-align: right;'>" . lang( "allarvv_comentarios" ) . ":</th>"; echo "
						<td>-</td>"; echo "</tr>"; } else { echo "
					<th style='text-align: right;'>" . lang( "allarvv_comentarios" ) . ":</th>"; echo "
					<td>" . $comentarios . "</td>"; echo "</tr>"; } echo "
					<tr>"; echo "
						<th style='text-align: right;'>" . lang( "allarvv_fecha ultima actualizacion" ) . ":</th>"; echo "
						<td>" . $fecha_ultima_upd . "
						</td>"; echo "
					</tr>"; echo "
					<tr>"; echo "
						<th style='text-align: right;'>" . lang( "allarvv_fecha ingreso articulo" ) . ":
						</th>"; echo "
						<td>" . $fecha_ingreso . "</td>"; echo "
					</tr>"; ?>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal_correcion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Corrección Articulo</h4>
				</div>
				<form name="form_art" class="form-horizontal" action="<?php echo base_url();?>index.php/Articulo_autor/editar_articulo/<?php echo $id_revista; ?>" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
					<div class="form-group col-md-12">
						<div style="text-align: right;" class="col-md-3">
							<label class="control-label" for="text">
								<?php echo lang( 'aa_titulo' ); ?> (*):</label>
						</div>
						<div class="col-md-9">
							<input type="text" class="form-control" name="titulo_articulo" value="<?php echo $titulo_revista;?>" id="titulo_articulo" placeholder="<?php echo lang( 'aa_ingrese titulo' ); ?>" required="True">
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="form-group">
							<div style="text-align: right;" class="col-md-3">
								<label for="abstract">
									<?php echo lang( 'aa_abstract' ); ?> (*):</label>
							</div>
							<div class="col-md-9">
								<textarea class="ckeditor" name="abstract" id="abstract" rows="20" cols="80" value="" required="true">
									<?php echo $abstract; ?>
								</textarea>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="form-group">
							<div style="text-align: right;" class="col-md-3">
								<label for="text">
									<?php echo lang( 'aa_palabras claves' ); ?> (*):</label>
							</div>
							<div class="col-md-9">
								<input type="text" maxlength="80" value="<?php echo $palabras_claves;?>" class="form-control" name="palabras_claves" id="palabras_claves" placeholder="<?php echo lang( 'aa_ingrese palabras claves' );?>" required="required">
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="form-group">
							<div style="text-align: right;" class="col-md-3">
								<label for="fecha_ingreso">Plazo de Reenvio (*):
								</label>
							</div>
							<div class="col-md-9">
								<input type="text" maxlength="80" value="<?php echo date("d-m-y",strtotime($fecha_final));?>" name="fecha_ingreso" id="fecha_ingreso" disabled="disabled">
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="form-group">
							<div style="text-align: right;" class="col-md-3">
								<label for="exampleInputFile">
									<?php echo lang( 'aa_subir archivo' ); ?> (*):</label>
							</div>
							<div class="col-md-9">
								<input type="file" name="userfile" accept=".doc, .docx" class="filestyle" id="exampleInputFile" required="required" data-buttonText="<i class='material-icons' style='font-size:20px;vertical-align:bottom'>file_upload</i> <?php echo lang( 'aa_seleccionar' );?>">
								<small id="fileHelp" class="form-text text-muted"><?php echo lang( 'aa_archivos de extension' );?> .doc o .docx. Max: 5MB</small>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="form-group">
							<div style="text-align: right;" class="col-md-3">
								<label for="comentarios">Detalle de Correcciones:
								</label>
							</div>
							<div class="col-md-9">
								<textarea class="form-control" name="comentarios" id="comentarios" rows="3">
									<?php if ( isset( $_POST[ 'comentarios'] ) ) echo $_POST[ 'comentarios']; ?>
								</textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-2 col-md-7">
							<br>
							<br>
							<button type="submit" name="upload" id="upload" class="button button-3d button-mini button-rounded button-green btn-block">
								<?php echo lang( 'aa_ingresar articulo' ); ?>
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_peticion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Petición al Editor</h4>
				</div>
				<form name="form_art" class="form-horizontal" action="<?php echo base_url();?>index.php/Articulo_autor/peticion_articulo/<?php echo $id_revista; ?>" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
					
					<div class="form-group col-md-12">
						<div class="form-group">
							<div style="text-align: right;" class="col-md-3">
								<label for="peticion">Petición al Editor:
								</label>
							</div>
							<div class="col-md-9">
								<textarea class="form-control" name="peticion" id="peticion" rows="3">
									
								</textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-2 col-md-7">
							<br>
							<br>
							<button type="submit" name="upload" id="upload" class="button button-3d button-mini button-rounded button-green btn-block">
								Enviar Petición
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<table id="articulos" class="table" width="100%" cellspacing="0">
	<thead>
		<tr>
			<th align="left" ;>
				ID-Artículo
			</th>
			<th align="left" ;>
				Estado
			</th>
			<?php 
				if ( $id_estado==3 ) { 
				echo "<th style='text-align: left;'>Fecha Asignación</th>"; 
				echo "<th style='text-align: left;'>Revisores</th>"; 
				} elseif ( $id_estado==14 ) { 
					echo "<th style='text-align: left;'>Fecha Revisión</th>"; 
					echo "<th style='text-align: left;'>Revisores</th>"; 
					echo "<th style='text-align: left;'>Recomendaciones</th>"; 
				} elseif ( $id_estado==5 || $id_estado==4 || $id_estado==6 ) { 
					echo "<th style='text-align: left;'>Fecha Calificación</th>"; 
					echo "<th style='text-align: left;'>Revisores</th>"; 
					echo "<th style='text-align: left;'>Recomendaciones</th>"; 
					echo "<th style='text-align: left;'>Recomendacion Editor</th>"; 
					echo "<th style='text-align: left;'>Acciones</th>"; } ?>
		</tr>
	</thead>
	<tbody>
		<div id='form1'>
			<?php 
				if ( $id_estado==3 ) { 
					echo "<tr>"; 
					echo "<td>"; echo $id_revista; echo "</td>"; 
					echo "<td>"; echo $estado; echo "</td>"; 
					echo "<td>"; echo $fecha_asignacion; echo "</td>"; 
					echo "<td>"; 
					if ( $id_rev1 !=0 ) { 
						echo $id_rev1 . "<br>"; 
					} 
					if ( $id_rev2 !=0 ) { 
						echo $id_rev2 . "<br>"; 
					} 
					if ( $id_rev3 !=0 ) { 
						echo $id_rev3 . "<br>"; 
					} "</td>"; echo "<td>"; 
					if ( $id_rev1 !=0 ) { 
						echo $com_rev1 . "<br>"; 
					} 
					if ( $id_rev2 !=0 ) { 
						echo $com_rev2 . "<br>"; 
					} 
					if ( $id_rev3 !=0 ) { 
						echo $com_rev3 . "<br>"; 
					} 
					echo "</td>"; 
					echo "</tr>"; 
				} elseif ( $id_estado==14 ) { 
					echo "<tr>"; 
					echo "<td>"; echo $id_revista; echo "</td>"; 
					echo "<td>"; echo $estado; echo "</td>"; 
					echo "<td>"; echo $fecha_cal; echo "</td>"; 
					echo "<td>"; 
					if ( $id_rev1 !=0 ) { 
						echo $id_rev1 . "<br>"; 
					} 
					if ( $id_rev2 !=0 ) { 
						echo $id_rev2 . "<br>"; 
					} if ( $id_rev3 !=0 ) { 
						echo $id_rev3 . "<br>"; 
					} "</td>"; echo "<td>"; 
					if ( $id_rev1 !=0 ) { 
						echo $com_rev1 . "<br>"; 
					} 
					if ( $id_rev2 !=0 ) { 
						echo $com_rev2 . "<br>"; 
					} if ( $id_rev3 !=0 ) { 
						echo $com_rev3 . "<br>"; 
					} "</td>"; 
					echo "</tr>"; 
					} elseif ( $id_estado==5 || $id_estado==4 || $id_estado==6 ) { 
						echo "<tr>"; echo "<td>"; echo $id_revista; echo "</td>"; echo "<td>"; echo $estado; echo "</td>"; echo "<td>"; echo $fecha_calf; echo "</td>"; echo "<td>"; 
						if ( $id_rev1 !=0 ) { echo $id_rev1 . "<br>"; } if ( $id_rev2 !=0 ) { echo $id_rev2 . "<br>"; } if ( $id_rev3 !=0 ) { echo $id_rev3 . "<br>"; } "</td>"; echo "<td>"; 
						if ( $id_rev1 !=0 ) { echo $com_rev1 . "<br>"; } if ( $id_rev2 !=0 ) { echo $com_rev2 . "<br>"; } if ( $id_rev3 !=0 ) { echo $com_rev3 . "<br>"; } "</td>"; echo "<td>"; echo $comentarios; echo "</td>"; 
						if ( $id_estado==6 && date("d-m-y",strtotime($fecha_final)) >= date( 'd-m-y' ) ) { 
							echo "<td>"; echo "<a data-toggle='modal' data-target='#modal_correcion'><center><i class='material-icons' style='font-size:40px;'>autorenew</i></center></span></center></span></a>"; echo "</td>"; 
						} elseif ( $id_estado==4 || date("d-m-y",strtotime($fecha_final)) < date( 'd-m-y' ) || $id_estado== 9) { 
							echo "<td>"; echo "<a data-toggle='modal' data-target='#modal_peticion'><center><i class='material-icons' style='font-size:40px;'>assignment_ind</i></center></span></center></span></a>"; echo "</td>"; 
						} echo "</tr>"; } ?>
			
		</div>
	</tbody>
</table>
<div class="container-fluid">
	<div class="content-wrap">
		<div class="container-fluid">
			<div class="form-group">
				<div class="pull-right" style="position: fixed;left:80%;top:68.3%;">
					<form action="<?php echo base_url();?>index.php/System">
						<input type="submit" class="button button-3d button-mini button-rounded button-blue btn-block" value="<?php echo lang( 'allarvv_regresar' );?>" />
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
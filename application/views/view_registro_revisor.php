<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div class="clearfix">

		<!-- Page Title
		============================================= -->
		<section id="page-title" style = "background-color: #3f51b5;">

			<div class="container clearfix">
				<h1 style = "color:#fff"><?php echo lang('vrr_registro de revisor');?></h1>
				<span style = "color:#fff"><?php echo lang('vrr_part1');?><br>
          <?php echo lang('vrr_part2');?></span>
				<ol class="breadcrumb">
					<li><a style = "color:#fff" href="<?php echo base_url(); ?>index.php/Login"><?php echo lang('vrr_inicio');?></a></li>
					<li><a style = "color:#fff" href="#"><?php echo lang('vrr_registro');?></a></li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<!-- Post Content
					============================================= -->
					<div class="postcontent nobottommargin clearfix">
						<form name = "form_autor" class="form-horizontal"  action="<?php echo base_url();?>index.php/Registro_revisor" method="post" enctype="multipart/form-data">
						<h3 style = "color: #3f51b5;"><?php echo lang('vrr_informacion personal');?></h3>
						<hr>
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="dato1"><?php echo lang('vrr_nombre');?>:</label>
					    <div class="col-sm-10">
								<?php if (form_error('nombre')) echo '<div class="alert alert-danger">' . form_error('nombre') . '</div>'; ?>
					      <input type="text" name = "nombre" class="form-control" id="nombre" value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>" placeholder="<?php echo lang('vrr_ingresar nombre');?>">
					    </div>
					  </div>
						<div class="form-group">
					    <label class="control-label col-sm-2" for="dato2"><?php echo lang('vrr_apellido paterno');?>:</label>
					    <div class="col-sm-10">
								<?php if (form_error('apellido1')) echo '<div class="alert alert-danger">' . form_error('apellido1') . '</div>'; ?>
					      <input type="text" name="apellido1" class="form-control" id="apellido1" value="<?php if (isset($_POST['apellido1'])) echo $_POST['apellido1'];?>" placeholder="<?php echo lang('vrr_ingresar apellido paterno');?>">
					    </div>
					  </div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="dato3"><?php echo lang('vrr_apellido materno');?>:</label>
							<div class="col-sm-10">
								<?php if (form_error('apellido2')) echo '<div class="alert alert-danger">' . form_error('apellido2') . '</div>'; ?>
								<input type="text" name="apellido2" class="form-control" id="apellido2" value="<?php if (isset($_POST['apellido2'])) echo $_POST['apellido2'];?>" placeholder="<?php echo lang('vrr_ingresar apellido materno');?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="dato3"><?php echo lang('vrr_titulo academico');?>:</label>
							<div class="col-sm-10">
								<?php if (form_error('titulo')) echo '<div class="alert alert-danger">' . form_error('titulo') . '</div>'; ?>
								<input type="text" name="titulo" class="form-control" id="titulo" value="<?php if (isset($_POST['titulo'])) echo $_POST['titulo'];?>" placeholder="<?php echo lang('vrr_ingresar titulo academico');?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="dato4"><?php echo lang('vrr_organizacion');?>:</label>
							<div class="col-sm-10">
								<?php if (form_error('organizacion')) echo '<div class="alert alert-danger">' . form_error('organizacion') . '</div>'; ?>
								<input type="text" name="organizacion" class="form-control" id="organizacion" value="<?php if (isset($_POST['organizacion'])) echo $_POST['organizacion'];?>" placeholder="<?php echo lang('vrr_ingresar organizacion');?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="dato5"><?php echo lang('vrr_telefono');?>:</label>
							<div class="col-sm-10">
								<?php if (form_error('telefono')) echo '<div class="alert alert-danger">' . form_error('telefono') . '</div>'; ?>
								<input type="text" name="telefono" class="form-control" id="telefono" value="<?php if (isset($_POST['telefono'])) echo $_POST['telefono'];?>" placeholder="<?php echo lang('vrr_ingresar telefono');?>">
							</div>
						</div>
						<br>

						<?php
							$areas = $this->Model_for_login->get_areas();
							if ($areas)
							{

								echo '<h3 style = "color: #3f51b5;">'.'Áreas de especialidad'.'</h3>';
								echo '<hr>';
								if ($mensaje_error != "Seleccionado") echo '<div class="alert alert-danger">' . $mensaje_error . '</div>';

								foreach ($areas->result() as $row){
									$seleccionado = '';
									if (isset($_POST['c'. $row->id_campo]))
									{
										$seleccionado = 'checked';
									}

									echo '<label class="checkbox">';
									echo '<input '.$seleccionado.' type="checkbox" name= "c'. $row->id_campo .'" id= "c'. $row->id_campo .'" value='.$row->id_campo.'>' . $row->nombre_campo;
									echo '</label>';
								}
							}
						 ?>
						<br><br>

						<h3 style = "color: #3f51b5;"><?php echo lang('vrr_biografia');?></h3>
						<hr>
						<div class="form-group">
							<label class="control-label col-sm-2" for="dato7"><?php echo lang('vrr_biografia');?>:</label>
							<div class="col-sm-10">
								<?php if (form_error('biog')) echo '<div class="alert alert-danger">' . form_error('biog') . '</div>'; ?>
								<textarea class="form-control" name = "biog" id = "biog" placeholder="<?php echo lang('vrr_ingresar biografia');?>" rows="3"><?php if (isset($_POST['biog'])) echo $_POST['biog'];?></textarea>
							</div>
						</div>
						<h3 style = "color: #3f51b5;"><?php echo lang('vrr_informacion de cuenta');?></h3>
						<hr>
						<div class="form-group">
							<label class="control-label col-sm-2" for="dato10"><?php echo lang('vrr_correo');?>:</label>
							<div class="col-sm-10">
								<?php if (form_error('correo')) echo '<div class="alert alert-danger">' . form_error('correo') . '</div>'; ?>
								<input type="text" name="correo" class="form-control" id="correo" value="<?php if (isset($_POST['correo'])) echo $_POST['correo'];?>" placeholder="<?php echo lang('vrr_ingresar correo electronico');?>">
							</div>
						</div>
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="pwd"><?php echo lang('vrr_contrasenia');?>:</label>
					    <div class="col-sm-10">
								<?php if (form_error('clave1')) echo '<div class="alert alert-danger">' . form_error('clave1') . '</div>'; ?>
					      <input type="password" name="clave1" class="form-control" id="pwd1" value="<?php if (isset($_POST['clave1'])) echo $_POST['clave1'];?>" placeholder="<?php echo lang('vrr_ingresar contrasenia');?>">
					    </div>
					  </div>
						<div class="form-group">
					    <label class="control-label col-sm-2" for="pwd"><?php echo lang('vrr_reingresar contrasenia');?>:</label>
					    <div class="col-sm-10">
					      <input type="password" name="clave2" class="form-control" id="pwd2" value="<?php if (isset($_POST['clave2'])) echo $_POST['clave2'];?>" placeholder="<?php echo lang('vrr_vuelva a ingresar contrasenia');?>">
					    </div>
					  </div>
						<br>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="button button-3d button-mini button-rounded button-green btn-block"><?php echo lang('vrr_registrar');?></button>
					    </div>
					  </div>
					</form>


					</div><!-- .postcontent end -->

					<!-- Sidebar
					============================================= -->
					<div class="sidebar nobottommargin col_last clearfix">
						<div class="sidebar-widgets-wrap">

							<div class="widget widget_links clearfix">

								<h4><?php echo lang('vrr_links');?></h4>
								<ul>
									<a href="<?php echo base_url(); ?>index.php/Login" class="button button-mini button-3d button-circle button-teal"></i><?php echo lang('vrr_pagina principal');?></a>
									<a href="<?php echo base_url(); ?>index.php/Login/login" class="button button-mini button-3d button-circle button-teal"></i><?php echo lang('vrr_inicio de sesion');?></a>
                </ul>

							</div>

						</div>
					</div><!-- .sidebar end -->

				</div>

			</div>

		</section><!-- #content end -->


	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>
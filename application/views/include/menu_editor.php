<h4><?php echo lang('ME_acciones editor');?></h4>
<div id="post-list-footer">

<nav>
    <ul class="nav">
	   
		<li><a  class="button button-mini button-3d button-teal col_full" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><?php echo lang('ME_articulos');?></a>
			<ul class="nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
				<li><a class="button button-mini button-3d button-teal" href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_recibidos"><?php echo lang('ME_recibidos');?></a></li>
				<!-- <li><a class="button button-mini button-3d button-teal" href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_asignados">><?php echo lang('ME_asignados');?></a></li>
				<li><a class="button button-mini button-3d button-teal" href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_revisados"><?php echo lang('ME_Revisados');?></a></li>
                <li><a class="button button-mini button-3d button-teal" href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_plazo_vencido"><?php echo lang('ME_Plazo vencido');?></a></a></li>
                <li><a class="button button-mini button-3d button-teal" href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_rechazado_editor"><?php echo lang('ME_Rechazado por Editor');?></a></li>
                <li><a class="button button-mini button-3d button-teal" href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_rechazado_editor"><?php echo lang('ME_Rechazado por Revisor');?></a></li>
                <li><a class="button button-mini button-3d button-teal" href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_espera_final"><?php echo lang('ME_Espera Version Final');?></a></li>
                <li><a class="button button-mini button-3d button-teal" href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos_vencido"><?php echo lang('ME_Aceptado Con Plazo Vencido');?></a></li> -->
			</ul>
		</li>
	</ul>

    <ul class="nav">
	   
		<li><a  class="button button-mini button-3d button-teal col_full" id="btn-2" data-toggle="collapse" data-target="#submenu2" aria-expanded="false"><?php echo lang('ME_revista');?></a>
			<ul class="nav collapse" id="submenu2" role="menu" aria-labelledby="btn-2">
				<li><a class="button button-mini button-3d button-teal" href="<?php echo base_url(); ?>index.php/System/editor_magazine"><?php echo lang('ME_revistas');?></a></li>
				<li><a class="button button-mini button-3d button-teal" href="#"><?php echo lang('ME_Publicar_revista');?></a></li>
				<li><a class="button button-mini button-3d button-teal" href="#"><?php echo lang('ME_asignar articulo');?>A</a></li>
                <li><a class="button button-mini button-3d button-teal" href="#"><?php echo lang('ME_revistas');?></a></li>

			</ul>
		</li>
	</ul>
</nav>
    <a href="<?php echo base_url(); ?>index.php/System/editor" class="button button-mini button-3d button-teal col_full"></i><?php echo lang('ME_mi inicio editor');?></a>
    <a href="<?php echo base_url(); ?>index.php/Articulo_editor/all_articulos" class="button button-mini button-3d button-teal col_full"></i><?php echo lang('ME_todos los articulos');?></a>
    <a href="<?php echo base_url(); ?>index.php/Articulo_editor/asignar_revisores" class="button button-mini button-3d button-teal col_full"></i><?php echo lang('ME_asignar revisores');?></a>
    <a href="<?php echo base_url(); ?>index.php/Articulo_editor/comentarios_de_revisores" class="button button-mini button-3d button-teal col_full"></i><?php echo lang('ME_comentarios de revisores');?></a>
    <a href="<?php echo base_url(); ?>index.php/Articulo_editor/revisar_version_final" class="button button-mini button-3d button-teal col_full"></i><?php echo lang('ME_revisar version final');?></a>
    <a href="<?php echo base_url(); ?>index.php/Articulo_editor/timeout" class="button button-mini button-3d button-teal col_full"></i><?php echo lang('ME_articulos en timeout');?></a>
    <a href="<?php echo base_url(); ?>index.php/System/editor_contenido" class="button button-mini button-3d button-teal col_full"></i><?php echo lang('ME_modificar contenido');?></a>
    <a href="<?php echo base_url(); ?>index.php/System/editor_magazine" class="button button-mini button-3d button-teal col_full"></i><?php echo lang('ME_revistas');?></a>
    <a href="<?php echo base_url(); ?>index.php/System/dar_alta_revisor" class="button button-mini button-3d button-teal col_full"></i><?php echo lang('ME_opcion');?></a>
    <a href="<?php echo base_url(); ?>index.php/System/cambiar_configuracion" class="button button-mini button-3d button-teal col_full"></i><?php echo lang('ME_configuracion');?></a>
</div>

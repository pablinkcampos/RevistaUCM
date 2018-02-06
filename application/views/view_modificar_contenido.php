<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrap">
    <div class="container clearfix">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
                <div class="entry clearfix">
                    <div class="entry-title">
                        <h2><?php echo lang('vmc_seleccione lo que desea modificar o agregar');?></h2>
                    </div><br>
                </div>
                <a href="<?php echo base_url(); ?>index.php/System/editor_modificar_sobre_nosotros" class="button button-3d button-rounded button-blue center"><?php echo lang('vmc_sobre nosotros');?></a>
                <a href="<?php echo base_url(); ?>index.php/System/editor_modificar_politica_editorial" class="button button-3d button-rounded button-green center"><?php echo lang('vmc_politicas editorial');?></a>
                <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_imagen" class="button button-3d button-rounded button-red center"><?php echo lang('vmc_logo del sistema');?></a>
                <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_plantilla" class="button button-3d button-rounded button-yellow center"><?php echo lang('vmc_estructura base');?></a>
                <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_plantilla" class="button button-3d button-rounded button-blue center"><?php echo lang('vmc_Mensaje recepcion de articulos');?></a>
                <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_mensaje_a" class="button button-3d button-rounded button-red center"><?php echo lang('vmc_Mensaje aceptacion de articulo');?></a>
                <a href="<?php echo base_url(); ?>index.php/System/editor_crud_campos" class="button button-3d button-rounded button-brown center">Editar Campos de Investigación</a>
                <a href="<?php echo base_url(); ?>index.php/System/editor_cambia_plantilla" class="button button-3d button-rounded button-blue center"><?php echo lang('vmc_Mensaje publicacion efectiva');?></a>
            </div>

        </div>

        <div class="sidebar nobottommargin clearfix">
            <div class="sidebar-widgets-wrap">
                <div class="widget clearfix">
                    <?php
                     $this->load->view('include/menu_editor');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

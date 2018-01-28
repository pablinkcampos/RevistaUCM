<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-filestyle.min.js"></script>
<script type="text/javascript">
    $(":userfile").filestyle();
    $(":userfile").filestyle('icon');
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/bs-select.js"></script>
<div class="content-wrap">
    <div class="container clearfix">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
                <div class="entry clearfix col-lg-12">
                    <div class="entry-title"><h3>Editar revista</h3></div>
                </div>
                <div class="clearfix col-lg-12">
                    <form class="form-horizontal col-lg-9" action="<?php echo base_url(); ?>index.php/System/editar_revista?revista=<?php echo $id_revista; ?>" method="POST" enctype="multipart/form-data">
                        <?php
                          $datos = $this->Articulo_Model->obtener_magazine_info($id_revista);
                          $titulo = null;
                          $fecha = null;
                          $palabras = null;

                          if ($datos)
                          {
                            $titulo = $datos->titulo_revista;
                            $fecha = $datos->fecha_publicacion;
                            $palabras = $datos->palabras_editor;
                          }
                          else
                          {
                            redirect('index.php/System/editor_magazine');
                          }
                         ?>
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vne_titulo revista');?></label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="t_rev" value="<?php echo $titulo; ?>" id="t_rev" placeholder="<?php echo lang('vne_ingrese titulo');?>" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" >
                            </div>
                        </div>
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vne_fecha edicion');?></label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="f_rev" value="<?php echo $fecha; ?>" id="f_rev" placeholder="<?php echo lang('vne_ejemplo');?>" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" >
                            </div>
                        </div>
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vne_palabras del editor');?></label>
                            </div>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="p_edit" id="p_edit" value="<?php echo $palabras; ?>" placeholder="<?php echo lang('vne_descripcion');?>." rows="2" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" ><?php echo $palabras; ?></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-7">
                                <br><br>
                                <button type="submit" name="go" class="button button-3d button button-circle btn-block">Guardar cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
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

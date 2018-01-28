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
                    <div class="entry-title"><h3><?php echo lang('vne_nueva revista');?> </h3></div>
                </div>
                <div class="clearfix col-lg-12">
                    <form class="form-horizontal col-lg-9" action="<?php echo base_url(); ?>index.php/System/termino" method="POST" enctype="multipart/form-data">
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vne_articulos');?></label>
                            </div>
                            <?php
                             $ids = $this->Articulo_Model->get_8();
                             echo '<div class="col-lg-9">
                                <select class="selectpicker" multiple name="art[]" >';
                             if ($ids) {
                                 foreach ($ids as $row) {
                                     echo'<option value="' . $row->ID . '" data-subtext="Paginas: ' . $row->pagina_inicio . ' -- ' . $row->pagina_fin . '">' . $row->titulo . '</option>';
                                 }
                             }
                             echo'</select>
                            </div>';
                            ?>
                        </div>
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vne_titulo revista');?></label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="t_rev" value="<?php if (isset($_POST['t_rev'])) echo $_POST['t_rev']; ?>" id="t_art" placeholder="<?php echo lang('vne_ingrese titulo');?>" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" >
                            </div>
                        </div>
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vne_fecha edicion');?></label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="f_rev" value="<?php if (isset($_POST['f_rev'])) echo $_POST['f_rev']; ?>" id="t_aut" placeholder="<?php echo lang('vne_ejemplo');?>" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" >
                            </div>
                        </div>                        
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vne_palabras del editor');?></label>
                            </div>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="p_edit" id="abstract" value="<?php if (isset($_POST['p_edit'])) echo $_POST['p_edit']; ?>" placeholder="<?php echo lang('vne_descripcion');?>." rows="2" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" ></textarea>
                            </div>
                        </div>

                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label for="final_file"><?php echo lang('vne_imagen de revista');?></label>
                            </div>
                            <div class="col-lg-9">
                                <input type="file" name = "file_rev" accept="image/*" class="filestyle" id="exampleInputFile" required="required" aria-describedby="fileHelp" data-buttonText="<i class='material-icons' style='font-size:20px;vertical-align:bottom'>file_upload</i> <?php echo lang('aa_seleccionar'); ?> ">
                                <small id="fileHelp" class="form-text text-muted"><?php echo lang('vne_formato admitido');?> <b>(.jpg  .png)</b></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-7">
                                <br><br>
                                <button type="submit" name="go" class="button button-3d button button-rounded button-green btn-block"><?php echo lang('vne_crear');?></button>
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
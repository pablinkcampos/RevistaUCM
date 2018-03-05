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
                    <div class="entry-title"><h3>Configuariones Generales</h3></div>
                </div>
                <div class="clearfix col-lg-12">
                    <form class="form-horizontal col-lg-9" action="<?php echo base_url(); ?>index.php/System/agregar_configuracion" method="POST" enctype="multipart/form-data">
                       
                          
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vc_diamaxarti');?></label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="max_dia_asig_art" value="" id="max_dia_asig_art" placeholder="<?php echo lang('vc_diamaxartip');?>" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" >
                            </div>
                        </div>
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vc_canmaxrevi');?></label>
                            </div>
                            <div class="col-lg-9">
                                <input type="number" max=3 min=1 class="form-control" name="max_revi_art" value="" id="max_revi_art" placeholder="<?php echo lang('vc_canmaxrevip');?>" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" >
                            </div>
                        </div>
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vc_diamax');?></label>
                            </div>
                            <div class="col-lg-9">
                                <input type="number" max=30 min=1 class="form-control" name="max_dia_res_art" value="" id="max_dia_res_art" placeholder="<?php echo lang('vc_diamaxp');?>" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" >
                            </div>
                        </div>

                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vc_diamaxri');?></label>
                            </div>
                            <div class="col-lg-9">
                                <input type="number" max=30 min=1 class="form-control" name="max_dia_edi_rev_art" value="" id="max_dia_edi_rev_art" placeholder="<?php echo lang('vc_diamaxri');?>" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" >
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

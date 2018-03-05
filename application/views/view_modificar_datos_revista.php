<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <script type="text/javascript" src="<?php echo base_url(); ?>vendors/ckeditor/ckeditor.js"></script>

<div class="content-wrap">
    <div class="container clearfix">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
                <div class="entry clearfix col-lg-12">
                    <div class="entry-title"><h3><?php echo lang("vmdr_Modificar");?></h3></div>
                </div>
                <div class="clearfix col-lg-12">
                    <form class="form-horizontal col-lg-9" action="<?php echo base_url(); ?>index.php/System/modifica_datos_revista" method="POST" enctype="multipart/form-data">
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="ta_e"><?php echo lang("vmdr_editor");?>:</label>
                            </div>                        
                            <div class="col-lg-12">
                                <textarea class="ckeditor" name="ta_e" id="ta_e" rows="20" cols="100" required="true"><?php echo  $editor->texto; ?></textarea>
             
                            </div>
                        </div>
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang("vmdr_coEditor");?>:</label>
                            </div>                        
                            <div class="col-lg-12">
                                <textarea class="ckeditor" name="ta_ce" id="ta_ce" rows="20" cols="100" required="true"><?php echo  $coeditor->texto; ?></textarea>
             
                            </div>
                        </div>

                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang("vmdr_comite_ea");?>:</label>
                            </div>                        
                            <div class="col-lg-12">
                                <textarea class="ckeditor" name="ta_cea" id="ta_cea" rows="20" cols="100" required="true"><?php echo  $comite_editor_asesor->texto; ?></textarea>
             
                            </div>
                        </div>

                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang("vmdr_comite");?>:</label>
                            </div>                        
                            <div class="col-lg-12">
                                <textarea class="ckeditor" name="ta_coe" id="ta_coe" rows="20" cols="100" required="true"><?php echo  $comite_editor->texto; ?></textarea>
             
                            </div>
                        </div>
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang("vmdr_produccion_editorial");?>:</label>
                            </div>                        
                            <div class="col-lg-12">
                                <textarea class="ckeditor" name="ta_pe" id="ta_pe" rows="20" cols="100" required="true"><?php echo  $produccion_editorial->texto; ?></textarea>
             
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-7">
                                <br><br>
                                <button type="submit" name="go" class="button button-3d button button-rounded button-green btn-block"><?php echo lang("vmma_modificar");?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

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

<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrap">
    <div class="container clearfix">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
                <div class="entry clearfix col-lg-12">
                    <div class="entry-title"><h3><?php echo lang("vmma_modificar_mensaje");?></h3></div>
                </div>
                <div class="clearfix col-lg-12">
                    <form class="form-horizontal col-lg-9" action="<?php echo base_url(); ?>index.php/System/modifica_mensaje_aceptacion" method="POST" enctype="multipart/form-data">
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"<?php echo lang("vmma_ingrese_texto");?></label>
                            </div>                        
                            <div class="col-lg-9">
                                <class="ckeditor" name="ta_ma" id="ta_ma" rows="10" cols="80" required="true"><?php echo  $texto->texto; ?></textarea>
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

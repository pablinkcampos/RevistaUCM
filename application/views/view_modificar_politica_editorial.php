<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
  <script>
  tinymce.init({
    selector: '#t_com_2'
  });
  </script>
  
<div class="content-wrap">
    <div class="container clearfix">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
                <div class="entry clearfix col-lg-12">
                    <div class="entry-title"><h3><?php echo lang("vmpe_modificar politicas");?></h3></div>
                </div>
                <div class="clearfix col-lg-12">
                    <form class="form-horizontal col-lg-12" action="<?php echo base_url(); ?>index.php/System/modifica_politicas" method="POST" enctype="multipart/form-data">
                        <div class="form-group col_full">                      
                            <div class="col-lg-12">
                                <textarea class="form-control" id="t_com_2" name="t_com_2" id="abstract"rows="6" required="true"><?php echo  $texto->texto; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-7">
                                <br><br>
                                <button type="submit" name="go" class="button button-3d button button-rounded button-green btn-block"><?php echo lang("vmpe_modificar");?></button>
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

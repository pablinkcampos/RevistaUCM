<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php //echo $id_usuario; echo $nombre_usuario; echo $email_usuario; echo $id_rol;            ?>

<?php
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />

<?php endforeach; ?>
<?php foreach($js_files as $file): ?>

    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<style type="text/css">
    .row{
        width: 80%;
    }
    .modal-backdrop{
        display: none;
    }
</style>



<div class="content-wrap">
    <div class="container clearfix">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">

                      <div class="col-md-12">
                          <br>
                          <h3 style = "color: black;">Editar Campos de Investigación</h3>
                          <hr>
                      </div>

                 <?php echo $output; ?>

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

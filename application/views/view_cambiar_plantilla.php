<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php //echo $id_usuario; echo $nombre_usuario; echo $email_usuario; echo $id_rol;            ?>
<script type="text/javascript">
    function validate_logo() {
        var s = 0;

        var user = document.forms["logo-form"]["file_base"].value;
        if (user === null || user.length < 3 || /^\s+$/.test(user)) {
            s++;
            var title = <?php echo json_encode(lang("tswal_debe seleccionar un archivo antes de enviar"), JSON_HEX_TAG);?>;
            swal(title, "", "warning");
        }

        if (s > 0) {
            return false;
        }
    }
 </script>
<div class="content-wrap">
    <div class="container clearfix">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
                <div class="entry clearfix">
                    <div class="entry-image">
                        <a href="<?php echo base_url(); ?>img/pdf.png" data-lightbox="image"><img class="image_fade" src="<?php echo base_url(); ?>img/pdf.png" alt="Estructura Base"></a>
                    </div>
                    <div class="entry-title">
                        <h2><?php echo lang('vcp_cambia estructura base para articulos');?></h2>
                    </div>
                    <div class="entry-content">
                        <p><?php echo lang('vcp_texto');?>.</p>
                        <div class="col-lg-7">
                            <form name= "logo-form" class="nobottommargin" action="<?php echo base_url(); ?>index.php/System/insert_base" method="post" enctype="multipart/form-data" onsubmit="return validate_logo()">
                                <div class="col-lg-9">
                                    <input type="file" name="file_base"/><?php echo lang('vcp_formato aceptado');?>: PDF
                                </div>
                                <div class=" col-lg-2">
                                    <button class="button button-3d button-green nomargin" name="base-form-submit" value="logo"><?php echo lang('vcp_cambiar');?></button>
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

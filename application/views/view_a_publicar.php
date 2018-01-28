<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-filestyle.min.js"></script>
<script type="text/javascript">
    $(":userfile").filestyle();
    $(":userfile").filestyle('icon');
</script>

<script type="text/javascript">
    function validate_num() {
        var s = 0;

        var user = document.forms["form_23"]["p_ini"].value;
        var user2 = document.forms["form_23"]["p_fin"].value;
        for (i = 0; i < user.length; i++) {
            if (!(((user.charAt(i) >= "0") && (user.charAt(i) <= "9")))) {
                s++;
                swal("Número incorrecto", "Solo se permiten números.", "warning");
                break;
            }
        }
        for (i = 0; i < user2.length; i++) {
            if (!(((user2.charAt(i) >= "0") && (user2.charAt(i) <= "9")))) {
                s++;
                swal("Número incorrecto", "Solo se permiten números.", "warning");
                break;
            }
        }
        if (user2 <== user) {
            s++;
            swal("Números de páginas incorrectos.", "", "warning");
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
                <?php
                $info = $this->Articulo_Model->obtener_info_articulo2($articulo_id);
                if ($info)
                {

                }
                else
                {
                  redirect('index.php/System/editor');
                }

                ?>
                <div class="col-lg-9"><h3><?php echo lang('vap_paginar articulo'); ?>:</h3><h4><?php echo $info->titulo_revista ?></h4>

                </div>
                <div class="col-lg-3">
                    <a Download href="<?php echo base_url() . 'uploads/' . $info->archivo ?>" class="button right button-3d button button-rounded button-blue"><?php echo lang('vap_descargar articulo'); ?></a>
                </div>
                <hr>
                <form class="form-horizontal col-lg-9" name="form_23" action="<?php echo base_url(); ?>index.php/Articulo_autor/responder_solicitud" method="POST" onsubmit="return validate_num()" enctype="multipart/form-data">
                    <div class="form-group col_full">
                        <div style="text-align: right;" class="col-lg-4">
                            <label class="control-label" for="text"><?php echo lang('vap_pagina inicial'); ?></label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="p_ini" id="p_ini" value="<?php if (isset($_POST['p_ini'])) echo $_POST['p_ini']; ?>" placeholder="<?php echo lang('vap_ingrese numero de pagina inicial'); ?>">
                        </div>
                    </div>
                    <div class="form-group col_full">
                        <div style="text-align: right;" class="col-lg-4">
                            <label class="control-label" for="text"><?php echo lang('vap_pagina final'); ?></label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="p_fin" id="p_fin" value="<?php if (isset($_POST['p_fin'])) echo $_POST['p_fin']; ?>" placeholder="<?php echo lang('vap_ingrese numero de pagina final'); ?>">
                        </div>
                    </div>
                    <div class="form-group col_full">
                        <div style="text-align: right;" class="col-lg-4">
                            <label for="final_file"><?php echo lang('vap_subir archivo'); ?></label>
                        </div>
                        <div class="col-lg-8">
                            <input type="file" name = "final_file" accept=".pdf" class="filestyle" id="exampleInputFile" required="required" aria-describedby="fileHelp" data-buttonText="<i class='material-icons' style='font-size:20px;vertical-align:bottom'>file_upload</i> <?php echo lang('aa_seleccionar'); ?> ">
                            <small id="fileHelp" class="form-text text-muted"><?php echo lang('vap_formato admitido'); ?> <b>(.pdf)</b></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="hidden" value="<?php echo $articulo_id ?>" name="t_id">
                        <div class="col-lg-offset-2 col-lg-7">
                            <br><br>
                            <button type="submit" name="exit" class="button button-3d button button-rounded button-green btn-block"><?php echo lang('vap_enviar'); ?></button>
                        </div>
                    </div>
                </form>

                <div class="col-lg-3 clearfix">
                    <p><b><?php echo lang('vap_importante'); ?>:</b> <br> <?php echo lang('vap_part1'); ?>.<br> <?php echo lang('vap_part2'); ?><br><br></p>
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

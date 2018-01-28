<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 $CI = & get_instance();
 $CI->load->library('session');
 $CI->load->model('Articulo_model');
 $data_usuario = $CI->session->userdata('userdata');
 $email_select = $data_usuario['email_usuario'];
 $est1 = $CI->Articulo_model->autor_direct($email_select);
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/form_valid.js"></script>
<script type="text/javascript">
    $(":userfile").filestyle();
    $(":userfile").filestyle('icon');
</script>

<div class="content-wrap">
    <div class="container clearfix">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs col-md-9">
                <h3 style = "color: black;"><?php echo lang('aa_ingrese informacion de articulo'); ?></h3>
                <hr>
                <form name = "form_art" class="form-horizontal"  action="<?php echo base_url();?>index.php/Articulo_autor/ingresar_articulo" method="post" onsubmit="return validateForm()"  enctype="multipart/form-data">
                    <?php 
                    if($fail){
                        echo '<p align="center" style="color: red;"><big><b>'.$fail.'</big></b></p><br>';
                    }
                    ?>
                    <div class="form-group col-md-12">
                        <div style="text-align: right;" class="col-md-3">
                            <label class="control-label" for="text"><?php echo lang('aa_titulo'); ?> (*):</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="titulo_articulo" value="<?php if (isset($_POST['titulo_articulo'])) echo $_POST['titulo_articulo']; ?>" id="titulo_articulo" placeholder="<?php echo lang('aa_ingrese titulo'); ?>" required="True">
                        </div>
                    </div>
              

                    <div class="form-group col-md-12">
                    <?php if ($campo) { ?>
                        <div class="form-group">
                            <div style="text-align: right;" class="col-md-3">
                                <label for="area_aplicable"><?php echo lang('aa_area aplicable'); ?> (*):</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" name="area_aplicable" id="area_aplicable" required="required">
                                    
                                    <?php
                                    foreach ($campo->result() as $row) {
                                        if ($row->id_campo == $_SESSION["area_aplicable"]) {
                                            $string = ' selected="selected" ';
                                        } else {
                                            $string = "";
                                        }
                                        echo '<option value="' . $row->id_campo . '" ' . $string . '>' . $row->nombre_campo . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    <?php
                        } else {
                            echo "<label for='area_aplicable'>" . lang("aallav_no hay areas aplicables") . "</label>";
                            echo "<select class='form-control' name='area_aplicable' id='area_aplicable' required='required'></select>";
                        }
                    ?>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <div style="text-align: right;" class="col-md-3">
                                <label for="text"><?php echo lang('aa_palabras claves'); ?> (*):</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" value="<?php if (isset($_POST['palabras_claves'])) echo $_POST['palabras_claves']; ?>" class="form-control" name="palabras_claves" id="palabras_claves" placeholder="<?php echo lang('aa_ingrese palabras claves'); ?>" required="required">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <div style="text-align: right;" class="col-md-3">
                                <label for="abstract"><?php echo lang('aa_abstract'); ?> (*):</label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control"  name="abstract" id="abstract" rows="3" required="required" placeholder="<?php echo lang('aa_ingrese abstract'); ?>"><?php if (isset($_POST['abstract'])) echo $_POST['abstract']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <div style="text-align: right;" class="col-md-3">
                                <label for="autor_principal"><?php echo lang('aa_autor_prinicipal') . ' (*)'; ?>:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" value="<?php echo $est1->nombre . " " . $est1->apellido_1 . " " . $est1->apellido_2; ?>" class="form-control" name="autor_principal" id="autor_principal">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <div style="text-align: right;" class="col-md-3">
                                <label for="autor_add1"><?php echo lang('aa_autor_adicional'); ?>:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" value="<?php if (isset($_POST['autor_add_1'])) echo $_POST['autor_add_1'];?>" class="form-control" name="autor_add_1" id="autor_add_1" placeholder="<?php echo lang('aa_ingrese autor adicional'); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <div style="text-align: right;" class="col-md-3">
                                <label for="autor_add2"><?php echo lang('aa_autor_adicional'); ?>:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" value="<?php  if (isset($_POST['autor_add_2'])) echo $_POST['autor_add_2'];  ?>" class="form-control" name="autor_add_2" id="autor_add_2" placeholder="<?php echo lang('aa_ingrese autor adicional'); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <div style="text-align: right;" class="col-md-3">
                                <label for="autor_add3"><?php echo lang('aa_autor_adicional'); ?>:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" value="<?php  if (isset($_POST['autor_add_3'])) echo $_POST['autor_add_3']; ?>" class="form-control" name="autor_add_3" id="autor_add_3" placeholder="<?php echo lang('aa_ingrese autor adicional'); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <div style="text-align: right;" class="col-md-3">
                                <label for="exampleInputFile"><?php echo lang('aa_subir archivo'); ?> (*):</label>
                            </div>
                            <div class="col-md-9">
                                <input type="file" name = "userfile" accept=".doc, .docx" class="filestyle" id="exampleInputFile" required="required" data-buttonText="<i class='material-icons' style='font-size:20px;vertical-align:bottom'>file_upload</i> <?php echo lang('aa_seleccionar'); ?> ">
                                <small id="fileHelp" class="form-text text-muted"><?php echo lang('aa_archivos de extension'); ?> .doc o .docx. Max: 5MB</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <div style="text-align: right;" class="col-md-3">
                                <label for="comentarios"><?php echo lang('aa_comentarios adicionales'); ?>:</label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" name="comentarios" id="comentarios" rows="3"><?php  if (isset($_POST['comentarios'])) echo $_POST['comentarios']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-7">
                            <br><br>
                            <button type="submit" name = "upload" id = "upload" class="button button-3d button-mini button-rounded button-green btn-block"><?php echo lang('aa_ingresar articulo'); ?></button>
                        </div>
                    </div>
  
                </form>
            </div>
            
            <div class="col-md-3">
                <br><br><br><br><?php echo lang('vap_part3'); ?>.<br><?php echo lang('vap_part4'); ?>: "<b>Moisés Flores E.</b>" <?php echo lang('vap_part5'); ?>.</p>
            </div>
            
        </div>
        
        <div class="sidebar nobottommargin clearfix">
            <div class="sidebar-widgets-wrap">
                <div class="widget clearfix">
                    <?php
                     $this->load->view('include/menu_autor');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

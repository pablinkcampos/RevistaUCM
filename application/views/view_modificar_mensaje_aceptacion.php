<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid  " style="margin-top: 200px;">
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <div class="card" style="min-width:600px;left:-30px;">
                <div class="header bg-blue">
                      
                          <h3>Mensaje aviso artículo aceptado</h3>
                        
                   
                </div>
                <center>
                <div class="row">
                   
                <form class="form-horizontal col-lg-12 col-md-12 col-sm-12 col-xs-12" action="<?php echo base_url(); ?>index.php/System/modifica_mensaje_aceptacion" method="POST" enctype="multipart/form-data">
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <label class="control-label" for="text"><?php echo lang("vmma_ingrese_texto");?></label>
                            </div>                        
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                <textarea class="ckeditor" name="ta_ma" id="ta_ma" rows="20" cols="100" required="true"><?php echo  $texto->texto; ?></textarea>
             
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-7">
                                <br><br>
                                <button type="submit" name="go" class="btn btn-success waves-effect"><?php echo lang("vmma_modificar");?></button>
                            </div>
                        </div>
                    </form>
                </div>
                </center>
            </div>
            
        </div>
    </div>




                <div class="widget clearfix">
                    <?php
                     $this->load->view('include/menu_editor');
                    ?>
                </div>

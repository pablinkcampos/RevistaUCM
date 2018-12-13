<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid  " style="margin-top: 200px;">
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <div class="card" style="min-width:600px;left:-30px;">
                <div class="header bg-blue">
                      
                          <h3>Parametros de Control</h3>
                        
                   
                </div>
                <center>
                <div class="row">
                   
                <form class="form-horizontal col-lg-12 col-md-12 col-sm-12 col-xs-12" action="<?php echo base_url(); ?>index.php/System/agregar_configuracion" method="POST" enctype="multipart/form-data">

                          
                       <div class="form-group col_full">
                           <div style="text-align: left;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                               <label class="control-label" for="text"><?php echo lang('vc_diamaxarti');?></label>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                               <input type="text" class="form-control" name="max_dia_asig_art" value="<?php echo $datos->max_dia_asig_art;?>" id="max_dia_asig_art" placeholder="<?php echo lang('vc_diamaxartip');?>" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" >
                           </div>
                       </div>
                       <div class="form-group col_full">
                           <div style="text-align: left;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                               <label class="control-label" for="text"><?php echo lang('vc_canmaxrevi');?></label>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                               <input type="number" max=3 min=1 class="form-control" name="max_revi_art" value="<?php echo $datos->max_revi_art;?>" id="max_revi_art" placeholder="<?php echo lang('vc_canmaxrevip');?>" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" >
                           </div>
                       </div>
                       <div class="form-group col_full">
                           <div style="text-align: left;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                               <label class="control-label" for="text"><?php echo lang('vc_diamax');?></label>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                               <input type="number" max=30 min=1 class="form-control" name="max_dia_res_art" value="<?php echo $datos->max_dia_res_art;?>" id="max_dia_res_art" placeholder="<?php echo lang('vc_diamaxp');?>" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" >
                           </div>
                       </div>

                       <div class="form-group col_full">
                           <div style="text-align: left;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                               <label class="control-label" for="text"><?php echo lang('vc_diamaxri');?></label>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                               <input type="number" max=30 min=1 class="form-control" name="max_dia_edi_rev_art" value="<?php echo $datos->max_dia_edi_rev_art;?>" id="max_dia_edi_rev_art" placeholder="<?php echo lang('vc_diamaxri');?>" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" >
                           </div>
                       </div>

                        <div class="form-group col_full">
                           <div style="text-align: left;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                               <label class="control-label" for="text">Máxima Cantidad de días para reenviar un artículo aceptado</label>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                               <input type="number" max=30 min=1 class="form-control" name="max_dia_reev_art" value="<?php echo $datos->max_dia_reev_art;?>" id="max_dia_reev_art" placeholder="Ingrese días para reenviar un artículo" required="True" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido");?>')" oninput="setCustomValidity('')" >
                           </div>
                       </div>
                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-7">
    
                                <button  style="margin:10px" type="submit" name="go" class="btn btn-success waves-effect"><?php echo lang("vmma_modificar");?></button>
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
       

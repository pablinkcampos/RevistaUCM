<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>



<div  class="container-fluid  " style="margin-top: 200px;">
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <div class="card">
                <div class="header bg-blue">
                      
                    <h3>Editar revista</h3>
                        
                   
                </div>
                <center>
                <div class="row">
                   
                <form class="form-horizontal col-lg-9" action="<?php echo base_url(); ?>index.php/System/editar_revista?revista=<?php echo $id_revista; ?>" method="POST" enctype="multipart/form-data">
                        <?php
                          $datos = $this->Articulo_Model->obtener_magazine_info($id_revista);
                          $titulo = null;
                          $fecha = null;
                          $palabras = null;

                          if ($datos)
                          {
                            $titulo = $datos->titulo_revista;
                            $fecha = $datos->fecha_publicacion;
                            $palabras = $datos->palabras_editor;
                          }
                          else
                          {
                            redirect('index.php/System/editor_magazine');
                          }
                         ?>
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vne_titulo revista');?></label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="t_rev" value="<?php echo $titulo; ?>" id="t_rev" placeholder="<?php echo lang('vne_ingrese titulo');?>" required="requerid"  >
                            </div>
                        </div>
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vne_fecha edicion');?></label>
                            </div>
                            <div class="col-lg-9">
                            <input  type="text" class="datepicker form-control" name="f_rev"  value="<?php echo $fecha; ?>"  placeholder="<?php echo lang('vne_fecha edicion');?>" required="requerid">
                            </div>
                        </div>
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3">
                                <label class="control-label" for="text"><?php echo lang('vne_palabras del editor');?></label>
                            </div>
                            <div class="col-lg-9">
                                <textarea class="ckeditor" name="p_edit" id="p_edit" value="<?php echo $palabras; ?>" placeholder="<?php echo lang('vne_descripcion');?>." rows="2" required="requerid"  ><?php echo $palabras; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-7">
                                <br><br>
                                <button type="submit" name="go" class="btn btn-success waves-effect">Guardar Cambios</button>
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

 <script>


    $(document).ready(function() {
  
        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'DD-MM-YYYY',
            clearButton: true,
            weekStart: 1,
            time: false,
            minDate: new Date(),
        });
    });
</script>
          

 



<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

<div class="container-fluid  " style="margin-top: 200px;">
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
            <div class="card" style="min-width:600px;left:-30px;">
                <div class="header">
                    <h3><?php echo lang('vne_nueva revista');?> </h3>
                   
                </div>
                <div class="row">
                   
                <form class="form-horizontal col-lg-12 col-md-12 col-sm-12 col-xs-12" action="<?php echo base_url(); ?>index.php/System/nueva_revista" method="POST" enctype="multipart/form-data">
                        <div class="body">
                            <div style="text-align: right;" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <label class="control-label" for="text"><?php echo lang('vne_articulos');?></label>
                            </div>
                            <a href='#' id='select-all'>Sel. Todos</a>
                            <a href='#' id='deselect-all'>Des. Todos</a>
                            <a href='#' id='select-100'>Sel. 10 art.</a>
                            <a href='#' id='deselect-100'>Des. 10 art.</a>


                            <?php
                             $ids = $this->Articulo_Model->get_8();
                             $temas = $this->Model_for_login->get_temas();
                          
                        
                             echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <select id="articulos" class="ms"  multiple="multiple" name="art[]" >';
                                echo'<option  disabled >seleccione articulos disponibles</option>';
                                
                             if ($ids) {
                                foreach ($temas->result() as $tema) {
                                    
                                    
                                    
                                   
                                    
                                 foreach ($ids as $row) {
                                     if($tema->id_tema == $row->id_tema){
                                        echo '<optgroup label="'.$tema->nombre.'">';
                                        echo'<option value="' . $row->ID . '">' . $row->titulo . '</option>';
                                     }
                                     echo'</optgroup>';
                                 }
                                
                                }
                             }
                             echo'</select>
                            </div>';
                            ?>
                       
                        </div>
                    
                        
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <label class="control-label" for="text"><?php echo lang('vne_titulo revista');?></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" name="t_rev" value="<?php if (isset($_POST['t_rev'])) echo $_POST['t_rev']; ?>" id="t_art" placeholder="<?php echo lang('vne_ingrese titulo');?>" required="requerid" >
                            </div>
                        </div>
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <label class="control-label" for="text"><?php echo lang('vne_fecha edicion');?></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="datepicker form-control" name="f_rev"  value="<?php if (isset($_POST['f_rev'])) echo $_POST['f_rev']; ?>"  placeholder="<?php echo lang('vne_fecha edicion');?>" required="requerid">
                        
                            </div>
                        </div>                        
                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <label class="control-label" for="text"><?php echo lang('vne_palabras del editor');?></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                <textarea class="ckeditor" name="p_edit" id="abstract" value="<?php if (isset($_POST['p_edit'])) echo $_POST['p_edit']; ?>" placeholder="<?php echo lang('vne_descripcion');?>." rows="2" required="requerid"  ></textarea>
                            </div>
                        </div>

                        <div class="form-group col_full">
                            <div style="text-align: right;" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <label for="final_file"><?php echo lang('vne_imagen de revista');?></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                <input type="file" name = "file_rev" accept="image/*" class="filestyle" id="exampleInputFile" required="required" aria-describedby="fileHelp" data-buttonText="<i class='material-icons' style='font-size:20px;vertical-align:bottom'>file_upload</i> <?php echo lang('aa_seleccionar'); ?> ">
                                <small id="fileHelp" class="form-text text-muted"><?php echo lang('vne_formato admitido');?> <b>(.jpg  .png)</b></small>
                            </div>
                        </div>

                        <div class="form-group">
                          <center>
                            <div style="text-align: right;" class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4 col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <br><br>
                                <button type="submit" name="go" style="margin:4%" class="btn bg-green btn-block waves-effect"><?php echo lang('vne_crear');?></button>
                            </div>
                           </center>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

 <script type="text/javascript">

  $(document).ready(function () {
    $('#articulos').multiSelect();

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false,
        minDate: new Date(),
       
    });


$('#select-all').click(function(){
$('#articulos').multiSelect('select_all');
return false;
});
$('#deselect-all').click(function(){
$('#articulos').multiSelect('deselect_all');
return false;
});
$('#select-100').click(function(){
$('#articulos').multiSelect('select', ['elem_0', 'elem_1', 'elem_10']);
return false;
});
$('#deselect-100').click(function(){
$('#articulos').multiSelect('deselect', ['elem_0', 'elem_1', 'elem_10']);
return false;
});


      
    });
  // run pre selected options

          
  </script>



                <div class="widget clearfix">
                    <?php
                     $this->load->view('include/menu_editor');
                    ?>
                </div>
    
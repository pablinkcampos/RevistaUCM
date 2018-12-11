<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 $info = $this->Articulo_Model->obtener_info_articulo2($articulo_id);
                if ($info)
                {

                }
                else
                {
                  redirect('index.php/System/editor');
                }
?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

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





<div class="container-fluid  " style="margin-top: 200px;">
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <div class="card" style="min-width:538px;">
                <div class="header bg-blue">
                      
                    <h3>Subir PDF: <?php echo $info->titulo_revista ?></h3>
                        
                   
                </div>
                <div class="body">
                            <div id="wizard_vertical">
                                <h2>Descargar Artículo</h2>
                                <section>
                                    <div  style="align='left';"  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <a Download href="<?php echo base_url() . 'uploads/' . $info->archivo ?>" class="btn btn-block waves-effect"><i class='material-icons' style='font-size:25px;'>file_download</i><?php echo lang('vap_descargar articulo'); ?></a>
                                    </div>
                                  
                                   
                                   
                                </section>

                                <h2>Subir y Convertir Artículo .docx</h2>
                                <section>
                                    <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" action="https://v2.convertapi.com/docx/to/pdf?Secret=zLxh3oGBDrQ9kSwI&download=attachment" method="post" enctype="multipart/form-data">
                   
                                       
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <input type="file" name="File" type="file" accept=".docx" required="required"/>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" >
                                            

                                                <button class="btn btn-block-info bg-blue waves-effect" type="submit">Convertir</button>
                                        

                                        </div>
                  
                  
                                    </form>
                                </section>

                                <h2>Subir Artículo PDF</h2>
                                <section>
                                    <form class="form-horizontal col-lg-12 col-md-12 col-sm-12 col-xs-12" name="form_23" action="<?php echo base_url(); ?>index.php/Articulo_autor/responder_solicitud" method="POST" onsubmit="return validate_num()" enctype="multipart/form-data">
                
                                        <div class="form-group col_full">
                                           <input type="hidden" value="<?php echo $articulo_id ?>" name="t_id" />   
                                       </div>

                                   
                                        
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                               <input type="file" name = "final_file" accept=".pdf" class="filestyle" id="exampleInputFile" required="required" aria-describedby="fileHelp" data-buttonText="<i class='material-icons' style='font-size:20px;vertical-align:bottom'>file_upload</i> <?php echo lang('aa_seleccionar'); ?> ">
                                               <small id="fileHelp" class="form-text text-muted"><?php echo lang('vap_formato admitido'); ?> <b>(.pdf)</b></small>
                                           </div>
                                    

                                          
                                               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

                                                   <button  type="submit" name="exit" class="btn btn-success waves-effect">subir PDF</button>
                                               </div>
                                           

                                    </form>
                                </section>

                                
                            </div>
                        </div>
               
            </div>
            
        </div>
    </div>




                    <?php
                     $this->load->view('include/menu_editor');
                    ?>
                </div>




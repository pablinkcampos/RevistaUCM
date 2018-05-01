<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>



<div class="content-wrap">
    <div class="container clearfix">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
            <div class="col-md-12">
               <div class="col-md-12">
                  <br>
                  <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#infoArticulo" aria-expanded="false" aria-controls="infoArticulo">
                  <?php  echo lang('allanav_informacion articulo'); ?>
                  </button>
               </div>
               <div class="col-md-4"></div>
            </div>
            

           <div class="collapse" id="infoArticulo">
            <div class="card card-body">
                <div class="col-md-12">

                  <table class="table" style="width:100%; text-align: right;">
                       
                          
                          <?php if($datos){ ?>
                            <?php foreach ($datos->result() as $row): ?>
                           <?php
                              $id_revista        =   $row->ID;
                              $titulo_revista    =   $row->titulo_revista;
                                       $email_autor          =   $row->email_autor;
                                       $tema          =   $row->tema;
                                       $estado         =   $row->estado;
                              
                                       $palabras_claves   =   $row->palabras_claves;
                                       $abstract          =   $row->abstract;
                              
                                       $archivo           =   $row->archivo;
                                       $comentarios       =   $row->com_autor;
                                       $fecha_ultima_upd  =   $row->fecha_ultima_upd ;
                              
                                       $fecha_ingreso     =   $row->fecha_ingreso;
									   $id_rev1 = $row->id_rev1;
									   $id_rev2 = $row->id_rev2;
									   $id_rev3 = $row->id_rev3;
									   $cal_rev1 = $row->cal_rev1; 
									   $cal_rev2 = $row->cal_rev2; 
									   $cal_rev3 = $row->cal_rev3;
								
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allanav_titulo articulo").":</th>";
                                       echo "<td>".$titulo_revista."</td>";
                                       echo "</tr>";
                              
                              
                              
                                       $CI =& get_instance();
                                       $CI->load->model('Articulo_model');
                              
                                       //Autor
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allanav_autor").":</th>";
                                     
                              
                                           echo "<td>";
                                           echo $email_autor;
                                       
                                           echo "</td>";
                              
                                       echo "</tr>";
                              
                                       //Campo de investigacion
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allanav_campo de investigacion").":</th>";
                                 
                                           echo "<td>";
                                           echo $tema;
                                           echo "</td>";
                                       
                                       echo "</tr>";
                              
                                       //Estado
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allanav_estado").":</th>";
                              
                                  
                                           echo "<td>";
                                           echo $row->estado;
                                           echo "</td>";
                                      
                                       echo "</tr>";
                              
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allanav_palabras claves").":</th>";
                                       echo "<td>".$palabras_claves."</td>";
                                       echo "</tr>";
                              
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allanav_abstract").":</th>";
                                       echo "<td style='text-align: justify;'>".$abstract."</td>";
                                       echo "</tr>";
                              
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allanav_archivo:")."</th>";
                                       echo "<td><a href='".base_url()."uploads/".$archivo."'>".$archivo."</a></td>";
                                       echo "</tr>";
                              
                                       echo "<tr>";
                                       if($comentarios==""){
                                       	echo "<th style='text-align: right;'>".lang("allanav_comentarios").":</th>";
                                        echo "<td>-</td>";
                                        echo "</tr>";
                                       }else{
                                       	echo "<th style='text-align: right;'>".lang("allanav_comentarios").":</th>";
                                        echo "<td>".$comentarios."</td>";
                                        echo "</tr>";
                              
                                       }
                              
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allanav_fecha ultima actualizacion").":</th>";
                                       echo "<td>".$fecha_ultima_upd."</td>";
                                       echo "</tr>";
                              
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allanav_fecha ingreso articulo").":</th>";
                                       echo "<td>".$fecha_ingreso."</td>";
                                       echo "</tr>";
                              
                              
                              
                              ?>
                               <div class="col-md-12">
                          
                            <div class="col-md-4"></div>
                        </div>

                        
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                           <?php endforeach ?>
                                <?php
                              } ?>
                  						
                         
                      </table>
                  </div>
                  </div>
                  </div>
                  <div class="col-md-12">
                            <div class="col-md-12">
                                <form method="POST" action="<?php echo base_url(); ?>index.php/articulo_revisor/articulos_asignados_comentar/<?php echo $id_revista; ?>">
                                    
                                    <div class="form-group">
                                        <label for="comment"><?php echo lang('aaac_comentario'); ?></label>
                                        <textarea class="form-control" rows="10" id="comentario" name="comentario"  oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido"); ?>')" oninput="setCustomValidity('')"><?php echo $comentario; ?></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                  
                                    <div class="form-group">
                                        <div style="text-align: right;" class="col-md-3">
                                        <label for="calificacion"><?php echo lang('aaac_calificacion'); ?> (*):</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="form-control" name="calificacion" id="calificacion" >
                                                <option value="">Selecciona Calificación</option>
                                                <option value="0">Rechazado</option>
                                                <option value="1">Rechazado con duda</option>
                                                <option value="4">Aceptado con Detalles</option>
                                                <option value="5">Aceptado</option>
                                
                                            </select>
                                        </div>
                  </div>
           
              </div>


                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-md-6">
                                            <input type="submit" class="button button-3d button-mini button-rounded button-green btn-block" value="<?php echo lang('aaac_comentar'); ?>" />
                                        </div>
                                    </div>

                                </form>
                                <br><br>

                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-6">
                                        <form method="POST" action="<?php echo base_url(); ?>index.php/articulo_revisor/articulos_asignados">
                                            <input type="submit" class="button button-3d button-mini button-rounded button-blue btn-block" value="<?php echo lang('aaac_regresar'); ?>" />
                                        </form>
                                    </div>
                                </div>

                            </div>
                  <div class="col-md-2"></div>
              </div>
            </div>


        </div>

        <div class="sidebar nobottommargin clearfix">
            <div class="sidebar-widgets-wrap">
                <div class="widget clearfix">
                    <?php
                    $this->load->view('include/menu_revisor');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
<link href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min_spanish.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        
        var table =   $('#articulos').DataTable();
 
    // Apply the search
        
      
    });
</script>

<script language="javascript">
   $(document).ready(function(){
	$("input[name=asignar]").click(function(e){
		
   
   	// Cogemos el elemento actual
   	var elemento=this;
   	var contador=0;
   
   	// Recorremos todos los checkbox para contar los que estan seleccionados
   	$("input[type=checkbox]").each(function(){
   		if($(this).is(":checked"))
   			contador++;
   	});
   
   	var cantidadMaxima=3;
   
   	// Comprovamos si supera la cantidad máxima indicada
   	if(contador == 0)
   	{
		e.preventDefault();
   		$("#alerta2").show(3000);
   		// Desmarcamos el ultimo elemento
   		$(elemento).prop('checked', false);
   		contador--;
   		$("#alerta2").hide(5000);
   	}
   	else{
   		$("#alerta").hide(1000);
   	}
   
   
   	
   });
   });
   	
</script>
<div class="content-wrap">
   <div class="container clearfix">
      <div class="postcontent nobottommargin col_last">
         <div id="posts" class="events small-thumbs">
            <div class="col-md-12">
               <div class="col-md-12">
                  <br>
                  <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#infoArticulo" aria-expanded="false" aria-controls="infoArticulo">
                  <?php  echo lang('allarvv_informacion articulo'); ?>
                  </button>
               </div>
               <div class="col-md-4"></div>
            </div>
            <div class="col-md-12">
               <div class="collapse" id="infoArticulo">
                  <div class="card card-body">
                     <div class="col-md-12">
                        <table class="table" style="width:100%; text-align: right;">
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
									   $id_rev1 = $row->n_rev1;
									   $id_rev2 = $row->n_rev2;
									   $id_rev3 = $row->n_rev3;
									   $cal_rev1 = $row->cal_rev1; 
									   $cal_rev2 = $row->cal_rev2; 
									   $cal_rev3 = $row->cal_rev3;
									   $com_rev1 = $row->com_rev1;
									   $com_rev2 = $row->com_rev2;
									   $com_rev3 = $row->com_rev3;

								
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allarvv_titulo articulo").":</th>";
                                       echo "<td>".$titulo_revista."</td>";
                                       echo "</tr>";
                              
                              
                              
                                       $CI =& get_instance();
                                       $CI->load->model('Articulo_model');
                              
                                       //Autor
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allarvv_autor").":</th>";
                                     
                              
                                           echo "<td>";
                                           echo $email_autor;
                                       
                                           echo "</td>";
                              
                                       echo "</tr>";
                              
                                       //Campo de investigacion
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allarvv_campo de investigacion").":</th>";
                                 
                                           echo "<td>";
                                           echo $tema;
                                           echo "</td>";
                                       
                                       echo "</tr>";
                              
                                       //Estado
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allarvv_estado").":</th>";
                              
                                  
                                           echo "<td>";
                                           echo $row->estado;
                                           echo "</td>";
                                      
                                       echo "</tr>";
                              
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allarvv_palabras claves").":</th>";
                                       echo "<td>".$palabras_claves."</td>";
                                       echo "</tr>";
                              
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allarvv_abstract").":</th>";
                                       echo "<td style='text-align: justify;'>".$abstract."</td>";
                                       echo "</tr>";
                              
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allarvv_archivo:")."</th>";
                                       echo "<td><a href='".base_url()."uploads/".$archivo."'>".$archivo."</a></td>";
                                       echo "</tr>";
                              
                                       echo "<tr>";
                                       if($comentarios==""){
                                       	echo "<th style='text-align: right;'>".lang("allarvv_comentarios").":</th>";
                                        echo "<td>-</td>";
                                        echo "</tr>";
                                       }else{
                                       	echo "<th style='text-align: right;'>".lang("allarvv_comentarios").":</th>";
                                        echo "<td>".$comentarios."</td>";
                                        echo "</tr>";
                              
                                       }
                              
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allarvv_fecha ultima actualizacion").":</th>";
                                       echo "<td>".$fecha_ultima_upd."</td>";
                                       echo "</tr>";
                              
                                       echo "<tr>";
                                       echo "<th style='text-align: right;'>".lang("allarvv_fecha ingreso articulo").":</th>";
                                       echo "<td>".$fecha_ingreso."</td>";
                                       echo "</tr>";
                              
                              
                              
                              ?>
                           <?php endforeach ?>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="col-md-4"></div>
               <div class="col-md-12">
                  <div  id="alerta" style="display: none;">
                     <div  class="alert alert-danger" role="alert">
                        <strong>Alerta!</strong> Solo puede asignar un máximo de 3 revisores <a href="#" class="alert-link"></a>.
                     </div>
                  </div>
				  <div  id="alerta2" style="display: none;">
                     <div  class="alert alert-danger" role="alert">
                        <strong>Alerta!</strong> Debe seleccionar una opción <a href="#" class="alert-link"></a>.
                     </div>
                  </div>
                  
                     <table id="articulos" class="display" width="100%" cellspacing="0">
                        <thead>
                           <tr>
     
                              <th align="left";>
                                 
                                 <?php echo lang('allarvv_revisor'); ?>
                                
                              </th>
                              <th align="left";>
                                
                                 <?php echo lang('allarvv_calificacion'); ?>
                                 
                              </th>
                              <th align="left";>
                                
                                 <?php echo lang('allarvv_comentarios'); ?>
                                 
                              </th>
                              <th align="left";>
                                
                                 reset calificación
                                
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <div id='form1'>
                            
                              <?php
                             
                                 
								
								 if($id_rev1 != "" && $cal_rev1 !=3 ){
									echo "<tr>";
										echo "<td>"; echo $id_rev1; echo "</td>";
										echo "<td>"; echo $cal_rev1; echo "</td>";
                                        echo "<td>"; echo $com_rev1; echo "</td>";
                                        echo "<td>"; echo "<a href='".base_url()."index.php/articulo_editor/resetear_calificacion/".$id_revista."_".$id_rev1."'><center><i class='material-icons' style='font-size:40px;'>replay</i></center></center></a>"; echo "</td>";
									echo "</tr>";
								 }
								 if($id_rev2 != "" && $cal_rev2 !=3 ){
									echo "<tr>";
										echo "<td>"; echo $id_rev2; echo "</td>";
										echo "<td>"; echo $cal_rev2; echo "</td>";
                                        echo "<td>"; echo $com_rev2; echo "</td>";
                                        echo "<td>"; echo "<a href='".base_url()."index.php/articulo_editor/resetear_calificacion/".$id_revista."_".$id_rev2."'><center><i class='material-icons' style='font-size:40px;'>replay</i></center></center></a>"; echo "</td>";
									echo "</tr>";
								 }
								 if($id_rev3 != "" && $cal_rev3 !=3 ){
									echo "<tr>";
										echo "<td>"; echo $id_rev3; echo "</td>";
										echo "<td>"; echo $cal_rev3; echo "</td>";
                                        echo "<td>"; echo $com_rev3; echo "</td>";
                                        echo "<td>"; echo "<a href='".base_url()."index.php/articulo_editor/resetear_calificacion/".$id_revista."_".$id_rev3."'><center><i class='material-icons' style='font-size:40px;'>replay</i></center></center></a>"; echo "</td>";
									echo "</tr>";
								 }
					
                               
                                 
                                 ?>
                            
                              <?php
                                  ?>
                           </div>
                        </tbody>
						
                     </table>
                    
				
                
				  
               </div>
			   <div class="form-group">
               <div class="pull-right" style="position: fixed;left:80%;top:68.3%;">
			   	 <form action="<?php echo base_url();?>index.php/articulo_editor/all_articulos_asignados">
					 
                     <input  type="submit" class="button button-3d button-mini button-rounded button-blue btn-block"  value="<?php echo lang('allarvv_aceptar'); ?>"
                        />
                  </form>
                  <form action="<?php echo base_url();?>index.php/articulo_editor/all_articulos_revisados">
					 
                     <input  type="submit" class="button button-3d button-mini button-rounded button-blue btn-block"  value="<?php echo lang('allarvv_regresar'); ?>"
                        />
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
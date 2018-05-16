<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min_spanish.js"></script>

<script type="text/javascript">
        $(document).ready(function () {

            $('#articulos').DataTable({
             

            });
        });
</script>
<script language="javascript">
   $(document).ready(function(){
   
   
   
   // Evento que se ejecuta al pulsar en un checkbox
   $("input[type=checkbox]").change(function(){
   
   	// Cogemos el elemento actual
   	var elemento=this;
   	var contador=0;
   
   	// Recorremos todos los checkbox para contar los que estan seleccionados
   	$("input[type=checkbox]").each(function(){
   		if($(this).is(":checked"))
   			contador++;
   	});
   
   	var cantidadMaxima=3
   
   	// Comprovamos si supera la cantidad máxima indicada
   	if(contador>cantidadMaxima)
   	{
   		$("#alerta").show(3000);
   		// Desmarcamos el ultimo elemento
   		$(elemento).prop('checked', false);
   		contador--;
   		$("#alerta").hide(5000);
   	}
   	else{
   		$("#alerta").hide(1000);
   	}
   
   
   	
   });
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
                  <?php  echo lang('allanav_informacion articulo'); ?>
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
                        <strong>Alerta!</strong> Debe asignar al menos un revisor <a href="#" class="alert-link"></a>.
                     </div>
                  </div>
                  
				  <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/articulo_editor/reasignar_revisores_editor/<?php echo $id_revista; ?>" method="POST">
                     <table id="articulos" class="display" width="100%" cellspacing="0">
                        <thead>
                           <tr>
                              <th align="center";>
                                 &nbsp;&nbsp;
                              </th>
                              <th align="left";>
                                 &nbsp;
                                 <?php echo lang('allanav_nombre'); ?>
                                 &nbsp;
                              </th>
                              <th align="left";>
                                 &nbsp;
                                 <?php echo lang('allanav_academico'); ?>
                                 &nbsp;
                              </th>
                              <th align="left";>
                                 &nbsp;
                                 <?php echo lang('allanav_cantidad'); ?>
                                 &nbsp;
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <div id='form1'>
                              <?php if($revisores){ 
                                
                                 ?>
                              <?php foreach ($revisores->result() as $row): ?>
                              <?php
                                 $id_revisor = $row->ID;
                                 $nombre_r = $row->nombre;
                                 $academico = $row->titulo_academico;
                                 $tema_r = $row->tema;
                                 $cantidad_a = $row->cantidad;
                                 
								 echo "<tr>";
								 if($id_revisor == $id_rev1 && $cal_rev1 !=3 || $id_revisor == $id_rev2 && $cal_rev2 !=3 || $id_revisor == $id_rev3 && $cal_rev3 != 3){
									echo "<td>"; echo "<input type='checkbox' name='revisor[]' value='".$id_revisor."' checked=true disabled=true />"; echo "</td>";
								}
								 else{
									if($id_revisor == $id_rev1 || $id_revisor == $id_rev2 || $id_revisor == $id_rev3){
										echo "<td>"; echo "<input type='checkbox' name='revisor[]' value='".$id_revisor."' checked=true />"; echo "</td>";
									}
									else{
										echo "<td>"; echo "<input type='checkbox' name='revisor[]' value='".$id_revisor."' />"; echo "</td>";
									}
								 }
                                 
                                 echo "<td align='left'>"; echo $nombre_r; echo "</td>";
                                 echo "<td align='left'>"; echo $academico; echo "</td>";
                                 echo "<td align='center'>";echo $cantidad_a;echo "</td>";
                                 echo "</tr>";
                               
                                 
                                 ?>
                              <?php endforeach ?>
                              <?php
                                 } ?>
                           </div>
                        </tbody>
						<div class="pull-right" style="position:fixed;left:91%;top:60%;">
                        	<br><br>
                        	<input name="asignar" type="submit" class="button button-3d button-mini button-rounded button-green btn-block"  value="<?php echo lang('allanav_asignar'); ?>" />
                     	</div>
                     </table>
                    
				
                  </form>
				  
               </div>
			   <div class="form-group">
               <div class="pull-right" style="position: fixed;left:80%;top:68.3%;">
                  <form action="<?php echo base_url();?>index.php/articulo_editor/all_articulos_asignados">
                     <input  type="submit" class="button button-3d button-mini button-rounded button-blue btn-block" onclick="minimo()" value="<?php echo lang('allanav_regresar'); ?>"
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
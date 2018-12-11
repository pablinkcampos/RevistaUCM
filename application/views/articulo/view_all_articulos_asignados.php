<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<link href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css" rel="stylesheet">

<script type="text/javascript">
    $(document).ready(function () {
        $('#articulos tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" style="width: 100%; text-align: left;" placeholder="Filtrar" />' );
        } );
        
        

            var table = $('#articulos').DataTable( {
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],    
            language: {
            processing:     "Procesando ...",
            search:         "Buscar:",
            lengthMenu:    "Mostrar _MENU_ Elementos",
            info:           "Visualización del elemento _START_ de _END_ en _TOTAL_ elementos",
            infoEmpty:      "Mostrar 0 elemento 0 en 0 elementos",
            infoFiltered:   "(filtro de  _MAX_ en total)",
            infoPostFix:    "",
            loadingRecords: "Cargando ...",
            zeroRecords:    "No hay datos disponibles en la tabla",
            emptyTable:     "No hay datos disponibles en la tabla",
            paginate: {
                first:      "Primero",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Último"
            },
            aria: {
                sortAscending:  ": activar para ordenar la columna en orden ascendente",
                sortDescending: ": active para ordenar la columna en orden descendente"
            }
            }
            } );
           
 
    // Apply the search
        table.columns().every( function () {
            var that = this;
 
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );

      
    });
</script>


  <section class="content">
        <div class="container-fluid" style="margin-top: 200px;">
          

             <!-- Basic Table -->
           <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" style="min-width:600px;left:-30px;">
                        <div class="header">
                            
                            <h2>
                                <?php echo lang('allaa_articulo_asignado'); ?>
                            </h2><br>
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">
                            <a data-toggle='modal' data-target='#modal_alerta'><button  type="button" class="btn bg-red waves-effect ">
                                    <i class="material-icons">report_problem</i> Alertar a Revisores atrasados.
                            </button></a>
                           </div>
                        </div>
                        <div class="body table-responsive">
                        
                        <table  class="table cell-border dataTable js-exportable" id="articulos" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            
                                <th width="2%">
                                   ID
                                </th>
                                <th width="2%">
                                    Versión
                                </th>
                                <th width="2%">
                                    Fecha limite
                                </th>
                                <th>
                                    <?php echo lang('aar_tema'); ?>
                                </th>
                                
                                <th>
                                    <?php echo lang('allaa_titulo articulo'); ?>
                                </th>
                                <th width="2%">
                                    <?php echo lang('allaa_estado'); ?>
                                </th>
                                <th>
                                    <?php echo lang('allaa_autor'); ?>
                                </th>
                                <th width="2%">
                                    <?php echo lang('allaa_calificados'); ?>
                                </th>
                                <th width="2%">
                                    <?php echo lang('aaa_ver'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($datos){ ?>
                            <?php $revisores_pendientes=""; 
                            foreach ($datos->result() as $row): ?>
                            <?php

                                $id_revista = $row->ID;
                                $titulo_revista = substr($row->titulo_revista, 0, 60);
                                $email_autor = $row->email_autor;
                                $estado = $row->estado;
                                $tema = $row->tema;
                                $version = $row->versiona;
                                $fecha_ingreso = date("d-m-y",strtotime($row->fecha_ingreso));
                                $asignados = $row->total_asig;
                                $calificados = $row->total_rev;
                                $fecha_asignacion = $row->fecha_asignacion;
                                $fecha_vencimiento = $row->fecha_vencimiento;
                                $date1 = new DateTime($fecha_asignacion);
                                $date2 = new DateTime($fecha_vencimiento);
                               
                                $now = new DateTIme('now');
                                $diff = $date1->diff($date2);
                                $diff2 = $now->diff($date1);
                                $dife = intval($diff2->days);
                                $limite = intval($diff->days);
                               

                                
                                  
                                    //calcula el tiempo que deberia ser asignado y asigna un color
                                    echo "<tr>";
                                    if($dife < $limite/2  ){
                                       
                                        echo "<td style='border-left: 6px solid green;'>";
                                    }
                                    else{
                                        if( $dife < $limite ){
                                            
                                            echo "<td style='border-left: 6px solid orange;'>";
                                        }
                                        else{
                                           //se definen los articulos que tienen el plazo vencido.
                                            $rev1= $row->rev1;
                                            $rev2= $row->rev2;
                                            $rev3= $row->rev3;
                                            $cal1 = $row->cal1;
                                            $cal2 = $row->cal2;
                                            $cal3 = $row->cal3;
                                          
                                            
                                           
                                            
                            
                                            if($rev1 != 0 && $cal1==3){
                                                
                                                if($revisores_pendientes != ""){
                                                    $revisores_pendientes .=",";
                                                }
                                                $revisores_pendientes .=$row->rev_1;
                                                
                                            }
                                            if($rev2 != 0 && $cal2==3){
                                                
                                                if($revisores_pendientes != ""){
                                                    $revisores_pendientes .=",";
                                                }
                                                
                                                $revisores_pendientes .=$row->rev_2;
                                                
                                            }
                                            if($rev3 != 0 && $cal3==3){
                                                
                                                if($revisores_pendientes != ""){
                                                    $revisores_pendientes .=",";
                                                }
                                                $revisores_pendientes .=$row->rev_3;
                                               
                                            }

                    
                                            echo "<td style='border-left: 6px solid red;'>";
                                        }
                                    }
                                         echo $id_revista; echo "</td>";
                                         echo "<td>"; echo $version; echo "</td>";
                                        echo "<td>"; echo date("d-m-y",strtotime($fecha_vencimiento)); echo "</td>";
                                        echo "<td>"; echo $tema; echo "</td>";
                                      
                  					    echo "<td>"; echo $titulo_revista; echo "</td>";

                                              echo "<td>";
                                              echo $estado;
                                              echo "</td>";
                                         

                                              echo "<td>";
                                              echo $email_autor;
                                             
                                              echo "</td>";
                                              echo "<td>";
                                              echo $calificados."/".$asignados;
                                              echo "</td>";
                  						
                  						    echo "<td>"; echo "<a href='".base_url()."index.php/articulo_editor/all_articulos_asignados_ver/".$id_revista."'><center><i class='material-icons' style='font-size:25px;'>zoom_in</i></center></center></a>"; echo "</td>";


                  					echo "</tr>";
                  				?>
                                <?php endforeach ?>
                                <?php
                              } ?>
                        </tbody>
                         <!-- filtros -->
                        <tfoot>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    version
                                </th>
                                <th>
                                    <?php echo lang('allaa_fecha ingreso articulo'); ?>
                                </th>
                                <th>
                                    <?php echo lang('aar_tema'); ?>
                                </th>
                                
                               
                                <th>
                                    <?php echo lang('allaa_titulo articulo'); ?>
                                </th>
                                <th>
                                    <?php echo lang('allaa_estado'); ?>
                                </th>
                                <th>
                                    <?php echo lang('allaa_autor'); ?>
                                </th>
                                <th>
                                    <?php echo lang('allaa_calificados'); ?>
                                </th>
                                <th style="display:none;">
                                    
                                </th>
                              
                            </tr>
                        </tfoot>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Table -->
            <!-- Striped Rows -->
            <div class="modal fade" id="modal_alerta" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Información Importante!</h4>
                        </div>
                        <div class="modal-body">
                        <h4 class="modal-title" >¿Esta seguro de enviar un mensaje de alerta a todos los revisores atrasados?</h4>
						<form name="form_art" class="form-horizontal" action="<?php echo base_url();?>index.php/Articulo_editor/alertar_revisores" method="post"  enctype="multipart/form-data">
					
							<div class="form-group col-md-12">
								<div class="form-group">
                                <input type="hidden" value="<?php echo $revisores_pendientes ?>" name="rv_p" /> 
							</div>
							<div class="form-group">
                                <center>
								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
									
									<button type="submit" style="margin:20px;" name="upload" id="upload" class="btn bg-green btn-block btn-lg waves-effect">
										Aceptar
									</button>
                                </div>
                                </center>
							</div>
						</form>
                        </div>
                        <div class="modal-footer">
                          
                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Cerrar</button>
                            
                        </div>
                    </div>
                </div>
            
  
    </section>

    
              <!-- menu -->
   


          
                            <?php
                     $this->load->view('include/menu_editor');
                    ?>
             
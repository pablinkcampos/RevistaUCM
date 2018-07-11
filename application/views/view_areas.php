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
        <div class="container-fluid" style="margin-top: 200px;"250px;"150px;">
          
            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            
                  
                            <h3 style = "color: black;">Áreas de Investigación</h3>
                            <a href="System/editor_crud_temas" class="btn btn-primary waves-effect">Ir a Temas</a>
                            <a data-toggle='modal' data-target='#modal_crear'><center><i class='material-icons' style='font-size:25px; color:green'>add_circle</i>añadir área</center></span></center></span></a>
                        
                        </div>
                        
                       <div class="modal fade" id="modal_crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                               <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                   <div class="modal-header">
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                     <h4 class="modal-title" id="myModalLabel">Inserción área</h4>
                                   </div>
                                   <div class="modal-body">
                              	<form name="form_art" class="form-horizontal" action="<?php echo base_url();?>index.php/Articulo_editor/insert_area" method="post" enctype="multipart/form-data">
                              <div class="form-group col-md-12">
                                  <div style="text-align: right;" class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                      <label  for="text">
                                         Nombre Área (*):</label>
                                  </div>	
                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">								
                                  <div class="form-line">
                                      <input type="text" class="form-control" name="nombre"  id="nombre" placeholder="Ingrese nombre de área" required="True">
                                  </div>
                                  </div>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">								
                                  <div class="form-line">
                                        <button type="submit" name="upload" id="upload" class="btn btn-success waves-effect">Ingresar</button>
                                  </div>
                                  
                              </div>
                              
                              </form>
                                   </div>
                                   <div class="modal-footer">
                                     <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            
                                   </div>
                                 </div>
                               </div>
                             </div>
                        
                        <div class="body table-responsive">
                        
                        
                        <table id="articulos" class="table table-bordered " width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th width="2%">ID</th>
                                  <th> Nombre de Área</th>
                                  <th width="2%"> Eliminar</th>
                                  <th width="2%"> Editar</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php
                          $datos = $this->Articulo_Model->campos_investigacion();
                          $i = 0;
                          if($datos){ ?>
                          	<?php foreach ($datos->result() as $row): ?>
                  				<?php
                                    $id = $row->id_campo;
                  					$nombre	= $row->nombre_campo;
                                    $i = $i + 1;

                                    echo "<tr>";
                                        echo "<td>"; echo $id; echo "</td>";
                  						echo "<td>"; echo $nombre; echo "</td>";
                              
                              $url_eliminar = base_url()."index.php/Articulo_editor/eliminar_area/".$id;
                              echo "<td>"; echo "<a data-toggle='modal' data-target='#modal_eliminar".$i."'><center><i class='material-icons' style='font-size:25px;color:red'>delete_forever</i></center></span></center></span></a>";  echo "</td>";

                              echo '<div class="modal fade" id="modal_eliminar'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
                              echo '  <div class="modal-dialog" role="document">';
                              echo '    <div class="modal-content">';
                              echo '      <div class="modal-header">';
                              echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                              echo '        <h4 class="modal-title" id="myModalLabel">Confirmación de eliminación</h4>';
                              echo '      </div>';
                              echo '      <div class="modal-body">';
                              echo ' ¿Está seguro que desea eliminar esta área?';
                              echo '      </div>';
                              echo '      <div class="modal-footer">';
                              echo '        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
                              echo '        <a href="' . $url_eliminar . '" "#" class="btn btn-danger" role="button">Eliminar</a>';
                              echo '      </div>';
                              echo '    </div>';
                              echo '  </div>';
                              echo '</div>';

                              $url_editar = base_url()."index.php/Articulo_editor/editar_area/".$id;
                              echo "<td>"; echo "<a data-toggle='modal' data-target='#modal_editar".$i."'><center><i class='material-icons' style='font-size:25px;color:orange'>create</i></center></span></center></span></a>";  echo "</td>";

                              echo '<div class="modal fade" id="modal_editar'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
                              echo '  <div class="modal-dialog" role="document">';
                              echo '    <div class="modal-content">';
                              echo '      <div class="modal-header">';
                              echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                              echo '        <h4 class="modal-title" id="myModalLabel">Confirmación de eliminación</h4>';
                              echo '      </div>';
                              echo '      <div class="modal-body">';
                              echo ' 	<form name="form_art" class="form-horizontal" action="'.$url_editar.'" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                              <div class="form-group col-md-12">
                                  <div style="text-align: right;" class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                      <label  for="text">
                                         Nombre Área (*):</label>
                                  </div>	
                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">								
                                  <div class="form-line">
                                      <input type="text" class="form-control" name="nombre"  id="nombre" value="'.$nombre.'" placeholder="Ingrese nombre de área" required="True">
                                  </div>
                                  </div>
                              </div>
                              <button type="submit" name="upload" id="upload" class="btn btn-success waves-effect">Editar</button>
                              </form>';
                              echo '      </div>';
                              echo '      <div class="modal-footer">';
                              echo '        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
                              echo '      </div>';
                              echo '    </div>';
                              echo '  </div>';
                              echo '</div>';

                  					echo "</tr>";
                  				?>
                  			<?php endforeach ?>

                              <?php
                              } ?>
                          </tbody>
                          <tfoot>
                            <tr>
                                <th>
                                   ID
                                </th>
                                <th>
                                    <?php echo lang('aaa_fecha ingreso'); ?>
                                </th>
                                <th style="display:none;">
                                    
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
  
    </section>
              <!-- menu -->
   <div class="container-fluid  " style="margin-top: 200px;"250px;"300px;">
	<div class="row">


            <div class="col-md-3">
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
    </div>




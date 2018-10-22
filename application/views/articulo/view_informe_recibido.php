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
                    <div class="card">
                        <div class="header">
                            
                            <h2>
                                Informe Artículos Recibidos
                            </h2>
                            
                        </div>
                        <h2 class="card-inside-title" style="margin:20px">Filtros</h2>
                            <div class="header row clearfix">
                            <center>
                            <form name="form_art" class="form-horizontal" action="<?php echo base_url();?>index.php/Articulo_editor/informe_recibido_filtro" method="post"  enctype="multipart/form-data">
                                <div class="col-sm-4" style="margin:20px"> 
                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" >Fecha Inicial</label>
                                        <div class="form-line">
                                            <input type="text" class="datepicker form-control" name="f_ini" value="<?php if (isset($_POST['f_ini'])) echo $_POST['f_ini']; else echo date("d-m-Y",strtotime(date("Y-m-d")."- 30 days"));  ?>"  placeholder="fecha de inicio" required="requerid">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="margin:20px" >
                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" >Fecha Final</label>
                                        <div class="form-line">
                                            <input type="text" class="datepicker form-control" name="f_ter" value="<?php if (isset($_POST['f_ter'])) echo $_POST['f_ter']; else echo date("d-m-Y"); ?>"  placeholder="fecha de termino" required="requerid">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                      
                                        <button type="submit" style="margin:20px;" name="upload" id="upload" class="btn bg-green btn-block  waves-effect">
										    filtrar
									    </button>
                                      
                                    </div>
                                </div>
							    
						    </form>
                            </center>
                        </div>
                       
                        <div class="body table-responsive">
                        
                        <table  class="table cell-border dataTable js-exportable" id="articulos" class="display" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            
                                <th >
                                  País
                                </th>
                                <th >
                                  Area
                                </th>
                                <th width="2%">
                                    Cantidad
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($informe){ ?>
                            <?php 
                            foreach ($informe->result() as $row): ?>
                            <?php

                                $nombre = $row->nombre;
                                $tema= $row->area;
                                $cantidad = $row->cantidad;
                         
                               
                         
                               

                                
                                  
                                    //calcula el tiempo que deberia ser asignado y asigna un color
                                    echo "<tr>";
                                    
                                         echo "<td>"; echo $nombre; echo "</td>";
                                
                                        echo "<td>"; echo $tema; echo "</td>";
                                      
                  					    echo "<td>"; echo $cantidad; echo "</td>";

                                 
                  						
                  						    


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
                                    Pais
                                </th>
                                <th>
                                    Area
                                </th>
                                <th>
                                   cantidad
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
    <section class="content">
        <div class="container-fluid" style="margin-top:-80px;">

            <!-- Real-Time Chart -->
            
            <div class="row clearfix">
                <!-- Pie Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Gráfico de áreas</h2>
                          
                        </div>
                        <div class="body">
                            <div id="pie_chart" class="flot-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Pie Chart -->
                <!-- Bar Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Gráfico de países</h2>
                           
                        </div>
                        <div class="body">
                            <div id="pais_chart" class="flot-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar Chart -->
            </div>
        </div>
    </section>

    
              <!-- menu -->
   <script>
   $(function () {
    var pieChartData = []; 
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    <?php 
                            $i=0;
                            foreach ($informe_area->result() as $row): ?>
                            <?php

                               
                                $area= $row->area;
                                $cantidad = $row->cantidad;
                                echo $cantidad;
                                ?>
                               
                                pieChartData[ <?php echo $i ?>] = {
                                    label: '<?php echo $area.": ".$cantidad ?>',
                                    data: <?php echo $cantidad ?>,
                                    color: getRandomColor()
                                }
                              

                                <?php   $i++; endforeach ?>
    //PIE CHART ==========================================================================================
  
    

    
    $.plot('#pie_chart', pieChartData, {
        series: {
            pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 3 / 4,
                    formatter: labelFormatter,
                    background: {
                        opacity: 0.5
                    }
                }
            }
        },
        legend: {
            show: false
        }
    });
    function labelFormatter(label, series) {
        return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
    }
    //====================================================================================================
});
   </script>

 <script>
   $(function () {
    var pieChartData = []; 
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    <?php 
                            $i=0;
                            foreach ($informe_pais->result() as $row): ?>
                            <?php

                               
                                $nombre= $row->nombre;
                                $cantidad = $row->cantidad;
                                
                                ?>
                               
                                pieChartData[ <?php echo $i ?>] = {
                                    label: '<?php echo $nombre.": ".$cantidad ?>',
                                    data: <?php echo $cantidad ?>,
                                    color: getRandomColor()
                                }
                              

                                <?php   $i++; endforeach ?>
    //PIE CHART ==========================================================================================
  
    

    
    $.plot('#pais_chart', pieChartData, {
        series: {
            pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 3 / 4,
                    formatter: labelFormatter,
                    background: {
                        opacity: 0.5
                    }
                }
            }
        },
        legend: {
            show: false
        }
    });
    function labelFormatter(label, series) {
        return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
    }
    //====================================================================================================
});
   </script>


          
                            <?php
                     $this->load->view('include/menu_editor');
                    ?>
             
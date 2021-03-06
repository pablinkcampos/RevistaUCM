<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js></script>
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
             <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="card" style="min-width:600px;left:-30px;">
                        <div class="header">
                            
                            <h2>
                                Informe Artículos publicados
                            </h2>
                            
                        </div>
                        <h2 class="card-inside-title" style="margin:20px">Filtros</h2>
                            <div class="header row clearfix">
                            <center>
                            <form name="form_art" class="form-horizontal" action="<?php echo base_url();?>index.php/Articulo_editor/informe_publicado_filtro" method="post"  enctype="multipart/form-data">
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
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      
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
                                  Tema
                                </th>
                                <th >
                                  Revista
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
                                $tema= $row->tema;
                                $titulo= $row->revista;
                                $cantidad = $row->cantidad;
                         
                               
                         
                               

                                
                                  
                                    //calcula el tiempo que deberia ser asignado y asigna un color
                                    echo "<tr>";
                                    
                                         echo "<td>"; echo $nombre; echo "</td>";
                                
                                        echo "<td>"; echo $tema; echo "</td>";
                                        echo "<td>"; echo $titulo; echo "</td>";
                                      
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
                                    Tema
                                </th>
                                <th>
                                    Revista
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="min-width:600px;left:-30px;">
                    <div class="card">
                        <div class="header">
                            <h2>Gráfico de Temas</h2>
                          
                        </div>
                        <div class="body">
                            <canvas id="areaPie" width="600" height="400"></canvas>
                           
                        </div>
                    </div>
                </div>
                <!-- #END# Pie Chart -->
                <!-- Bar Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card" style="min-width:600px;left:-30px;">
                        <div class="header">
                            <h2>Gráfico de países</h2>
                           
                        </div>
                        <div class="body">
                            <canvas id="paisPie" width="600" height="400"></canvas>
                            
                        </div>
                    </div>
                </div>
                <!-- #END# Bar Chart -->
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid" style="margin-top:-80px;">

            <!-- Real-Time Chart -->
            
            <div class="row clearfix">
                <!-- Pie Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card" style="min-width:600px;left:-30px;">
                        <div class="header">
                            <h2>Gráfico de Revistas</h2>
                           
                        </div>
                        <div class="body">
                            <canvas id="revistaPie" width="600" height="400"></canvas>
                            
                        </div>
                    </div>
                </div>
                <!-- #END# Pie Chart -->
                <!-- Bar Chart -->
                
            </div>
        </div>
    </section>

    
              <!-- menu -->
<script>
   $(function () {
    var pieChartData = []; 
    var datos =[];
    var colores = [];
    var label = [];
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
                            foreach ($informe_tema->result() as $row): ?>
                            <?php

                               
                                $area= $row->tema;
                                $cantidad = $row->cantidad;
                                echo $cantidad;
                                ?>
                               
                                pieChartData[ <?php echo $i ?>] = {
                                    label: '<?php echo $area.": ".$cantidad ?>',
                                    data: <?php echo $cantidad ?>,
                                    color: getRandomColor()
                                },
                                
                                datos[<?php echo $i ?>] = <?php echo $cantidad ?>;
                                label[<?php echo $i ?>] = '<?php echo $area.": ".$cantidad ?>';
                                colores[<?php echo $i ?>] = getRandomColor();
                                <?php   $i++; endforeach ?>
    //PIE CHART ==========================================================================================
    var Areacanvas = document.getElementById("areaPie");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 14;


var config = {
  type: 'doughnut',
  data: {
    datasets: [{
      data:datos,
      backgroundColor: colores,
   
    }],
    labels: label
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom',
    },
    title: {
      display: false,
      text: 'pie'
    },
    animation: {
      animateScale: true,
      animateRotate: true
    },
    tooltips: {
      callbacks: {
        label: function(tooltipItem, data) {
        	var dataset = data.datasets[tooltipItem.datasetIndex];
          var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
            return previousValue + currentValue;
          });
          var currentValue = dataset.data[tooltipItem.index];
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return data.labels[tooltipItem.index] + " ( " +precentage + "%"+" )";
        }
      }
    }
  }
};

window.pie = new Chart(Areacanvas, config); {
};                             
    

    

    //====================================================================================================
});
</script>
<script>
   $(function () {
    var pieChartData = []; 
    var datos =[];
    var colores = [];
    var label = [];
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
                                datos[<?php echo $i ?>] = <?php echo $cantidad ?>;
                                label[<?php echo $i ?>] = '<?php echo $nombre.": ".$cantidad ?>';
                                colores[<?php echo $i ?>] = getRandomColor();

                              

                                <?php   $i++; endforeach ?>
    //PIE CHART ==========================================================================================

    

        var Areacanvas = document.getElementById("paisPie");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 10;


var config = {
  type: 'doughnut',
  data: {
    datasets: [{
      data:datos,
      backgroundColor: colores,
   
    }],
    labels: label
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom',
    },
    title: {
      display: false,
      text: 'pie'
    },
    animation: {
      animateScale: true,
      animateRotate: true
    },
    tooltips: {
      callbacks: {
        label: function(tooltipItem, data) {
        	var dataset = data.datasets[tooltipItem.datasetIndex];
          var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
            return previousValue + currentValue;
          });
          var currentValue = dataset.data[tooltipItem.index];
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return data.labels[tooltipItem.index] + " ( " +precentage + "%"+" )";
        }
      }
    }
  }
};

window.pie = new Chart(Areacanvas, config); {
};  
});
</script>

<script>
   $(function () {
    var pieChartData = []; 
    var datos =[];
    var colores = [];
    var label = [];
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
                            foreach ($informe_revista->result() as $row): ?>
                            <?php

                               
                                $nombre= $row->revista;
                                $cantidad = $row->cantidad;
                                
                                ?>
                               
                                pieChartData[ <?php echo $i ?>] = {
                                    label: '<?php echo $nombre.": ".$cantidad ?>',
                                    data: <?php echo $cantidad ?>,
                                    color: getRandomColor()
                                }
                                datos[<?php echo $i ?>] = <?php echo $cantidad ?>;
                                label[<?php echo $i ?>] = '<?php echo $nombre.": ".$cantidad ?>';
                                colores[<?php echo $i ?>] = getRandomColor();

                              

                                <?php   $i++; endforeach ?>
    //PIE CHART ==========================================================================================

    

        var Areacanvas = document.getElementById("revistaPie");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 10;


var config = {
  type: 'doughnut',
  data: {
    datasets: [{
      data:datos,
      backgroundColor: colores,
   
    }],
    labels: label
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom',
    },
    title: {
      display: false,
      text: 'pie'
    },
    animation: {
      animateScale: true,
      animateRotate: true
    },
    tooltips: {
      callbacks: {
        label: function(tooltipItem, data) {
        	var dataset = data.datasets[tooltipItem.datasetIndex];
          var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
            return previousValue + currentValue;
          });
          var currentValue = dataset.data[tooltipItem.index];
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return data.labels[tooltipItem.index] + " ( " +precentage + "%"+" )";
        }
      }
    }
  }
};

window.pie = new Chart(Areacanvas, config); {
};    
});
   </script>



          
                            <?php
                     $this->load->view('include/menu_editor');
                    ?>
             
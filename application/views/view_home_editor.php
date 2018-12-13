<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript">
    $(document).ready(function () {

        
        

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
       

      
    });
</script>
<div class="container-fluid  " style="margin-top: 200px;">
       
    
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
                <?php

                 function obtenerFechaEnLetra($fecha) {
                     $dia = conocerDiaSemanaFecha($fecha);
                     $num = date("j", strtotime($fecha));
                     $anno = date("Y", strtotime($fecha));
                     $mes = array(lang('enero'), lang('febrero'), lang('marzo'), lang('abril'), lang('mayo'), lang('junio'), lang('julio'), lang('agosto'), lang('septiembre'), lang('octubre'), lang('noviembre'), lang('diciembre'));
                     $mes = $mes[(date('m', strtotime($fecha)) * 1) - 1];
                     return $dia . ', ' . $num . lang('vhe_de') . $mes . lang('vhe_del') . $anno;
                 }

                 function conocerDiaSemanaFecha($fecha)
               {
                   $dias = array(lang('domingo'), lang('lunes'), lang('martes'), lang('miercoles'), lang('jueves'), lang('viernes'), lang('sabado'));
                   $dia = $dias[date('w', strtotime($fecha))];
                   return $dia;
               }

                 // Parametros
                 $group_no = 0;
                 $content_per_page = 5;
                 $user_data = $this->session->userdata('userdata');
                 $datas = $this->input->get('page');

                 $num1 = 7;
                 $num2 = 13;

                 $filas = $this->Articulo_Model->count_obtener_articulos_listos($num1, $num2);

                 $cant_group = 0;
                 if ($filas) {
                     $cant_group_aux = ceil(($filas->cantidad ) / $content_per_page);
                     $cant_group = $cant_group_aux;

                     if ($filas->cantidad == 0) {
                        echo ' <div class="card" style="min-width:538px;">';
                   
                 
                        echo '<div class="header">';
                  
                        echo ' <center>    <h2>' ;
               
                        echo '</div></center>';
     
                        echo '<div class="body">';
                        
                        
                    
                        echo '<div class="col-lg-12 col-md-12  col-sm-12 col-xs-12">
                            <center>
                            <h2>'.lang("vhe_no existen articulos aun").'.</h2>
                            </center>
                            </div>';
                            echo '<div class="col-lg-12 col-md-12  col-sm-12 col-xs-12" >
                            <center>
                            <a href="'.base_url().'index.php/System/articulos_por_convertir" class="btn btn-primary waves-effect">Artículos por Convertir</a>
                            <a href="'.base_url().'index.php/System/articulos_convertidos" class="btn btn-success waves-effect">'.lang("vhe_articulos listos").'</a>
                            </center>
                            </div>';
     
                            echo '</div>';
                         echo '<div class="entry clearfix">
                         
                          </div>';
                     }
                 }

                 if ($datas) {
                     if ($group_no < $cant_group) {
                         $group_no = $datas;
                     }
                 }
                 //Ruta archivos
                 $ruta = 'uploads';


                 $start = ceil($group_no * $content_per_page);

                 $consulta = $this->Articulo_Model->obtener_articulos_limit_listos($start, $content_per_page, $num1, $num2);
                 if ($consulta && $filas) {
                    echo ' <div class="card" style="min-width:538px;">';
                   
                 
                    echo '<div class="header">';
              
                    echo ' <center>    <h2>' ;
           
                    echo '</div></center>';
 
                    echo '<div class="body">';
                    
                    
                
                    echo '<div class="col-lg-12 col-md-12  col-sm-12 col-xs-12">
                        <center>
                        <h2>'.lang("vhe_articulos disponibles").'.</h2>
                        </center>
                        </div>';
                        echo '<div class="col-lg-12 col-md-12">
                        <center>
                        <a href="'.base_url().'index.php/System/articulos_por_convertir" class="btn btn-primary waves-effect">artículos por Convertir</a>
                        <a href="'.base_url().'index.php/System/articulos_convertidos" class="btn btn-success waves-effect">'.lang("vhe_articulos listos").'</a>
                        </center>
                        </div>';
 
                        echo '</div>';
                     echo '<div class="row fluid">';
                     
                      
                     
                    foreach ($consulta as $row) {
                        echo ' <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
                                <div class="card" style="min-width:538px;">
                                    <div class="icon">
                                        <i class="material-icons col-blue">bookmark</i><b>'.substr($row->titulo_revista, 0, 30) .'...</b>
                                       
                                    </div>
                                   
                                           
                                            
                                            <div class="body">';
                                                
                                               
                                                
                           
                       
                         $as = $row->id_estado;
                         if($as == 7 || $as == 5){
                            echo '            <li><span class="label label-info">Falta Convertir a pdf</span></li>';
                            echo '            <li><i class="icon-time"></i>  ' . obtenerFechaEnLetra($row->fecha_ultima_upd) . '</li>';
                            echo '        </ul>';
                            echo '            <form name="input" action="' . base_url() . 'index.php/System/editor_pagina" method="post">';
                            echo '            <input type="hidden" value="' . $row->ID . '" name="articulo_id" />';
                            echo '            <input type="hidden" value="' . $row->email_autor . '" name="email_autors" />';
                            echo '            <center><button class="submit btn btn-primary waves-effect center">Convertir artículo</button>';
                            echo '          </center></form>';
                         }else if($as == 13){
                            echo '            <li><span class="label label-success">'.lang("vla_listo para revista").'</span></li>';
                            $dat = $this->Articulo_Model->get_fecha_last($row->ID);
                            echo '            <li><i class="icon-time"></i>  ' . obtenerFechaEnLetra($dat->fecha_ultima_upd) . '</li>';
                     
                            echo '        </ul>';
                            echo '            <form name="input" action="' . base_url() . 'index.php/System/editor_pagina" method="post">';
                            echo '            <input type="hidden" value="' . $row->ID . '" name="articulo_id" />';
                            echo '            <center><button class="submit btn btn-primary waves-effect center">Volver a Convertir</button>';
                            echo '          </center></form>';
                         }
                         echo '    </div>';
                         echo '</div>
                            </center>
                            </div>';
     
                            
                       

                         
                    }
                 }
                ?>

            </div>

            <?php
             echo '<ul class="pager nomargin">';
             if ($group_no == 0 && $group_no + 1 < $cant_group) {
                 $next = $group_no + 1;
                 echo '<li class="next"><a href="' . base_url() . 'index.php/System/editor?page=' . $next . '">'.lang("vhe_siguiente").' &rarr;</a></li>';
             } else if ($group_no + 1 == $cant_group && $group_no > 0) {
                 $back = $group_no - 1;
                 echo '<li class="previous"><a href="' . base_url() . 'index.php/System/editor?page=' . $back . '">&larr; '.lang("vhe_anterior").'</a></li>';
             } else if ($group_no + 1 < $cant_group) {
                 $next = $group_no + 1;
                 echo '<li class="next"><a href="' . base_url() . 'index.php/System/editor?page=' . $next . '">'.lang("vhe_siguiente").' &rarr;</a></li>';
                 $back = $group_no - 1;
                 echo '<li class="previous"><a href="' . base_url() . 'index.php/System/editor?page=' . $back . '">&larr; '.lang("vhe_anterior").'</a></li>';
             }
             echo '</ul>';
            ?>

        </div>
      
           
                    <?php
                     $this->load->view('include/menu_editor');
                    ?>
        


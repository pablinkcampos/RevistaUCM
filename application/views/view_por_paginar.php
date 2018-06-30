<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php //echo $id_usuario; echo $nombre_usuario; echo $email_usuario; echo $id_rol;           ?>
<div class="container-fluid  " style="margin-top: 100px;">
       
    
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
                     return $dia.', '.$num.lang('vpp_de').$mes.lang('vpp_del').$anno;
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
                 $num2 = 1000;

                 $filas = $this->Articulo_Model->count_obtener_articulos_listos($num1, $num2);
                 $cant_group = 0;
                 if ($filas) {
                     $cant_group_aux = ceil($filas->cantidad / $content_per_page);
                     $cant_group = $cant_group_aux;

                     if ($filas->cantidad == 0) {
                        echo ' <div class="card">';
                   
                 
                        echo '<div class="header">';
                  
                        echo ' <center>    <h2>' ;
               
                        echo '</div></center>';
     
                        echo '<div class="body">';
                        
                        
                    
                        echo '<div class="col-lg-12 col-md-12">
                            <center>
                            <h2>'.lang("vhe_no existen articulos aun").'.</h2>
                            </center>
                            </div>';
                            echo '<div class="col-lg-12 col-md-12">
                            <center>
                            <a href="'.base_url().'index.php/System/editor_ve7" class="btn btn-primary waves-effect">Artículos por formatear</a>
                            <a href="'.base_url().'index.php/System/editor_ve13" class="btn btn-success waves-effect">'.lang("vhe_articulos listos").'</a>
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
                        echo ' <div class="card">';
                   
                 
                        echo '<div class="header">';
              
                        echo ' <center>    <h2>' ;
           
                        echo '</div></center>';
 
                        echo '<div class="body">';
                    
                    
                
                        echo '<div class="col-lg-12 col-md-12">
                        <center>
                        <h2>'.lang("vhe_articulos disponibles").'.</h2>
                        </center>
                        </div>';
                        echo '<div class="col-lg-12 col-md-12">
                        <center>
                        <a href="'.base_url().'index.php/System/editor_ve7" class="btn btn-primary waves-effect">artículos por formatear</a>
                        <a href="'.base_url().'index.php/System/editor_ve13" class="btn btn-success waves-effect">'.lang("vhe_articulos listos").'</a>
                        </center>
                        </div>';
 
                        echo '</div>';
                        echo '<div class="row fluid">';
                     
                      
                     
                    foreach ($consulta as $row) {
                        echo ' <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
                                <div class="card">
                                    <div class="icon">
                                        <i class="material-icons col-blue">bookmark</i><b>'.substr($row->titulo_revista, 0, 30).'.</b>
                                       
                                    </div>
                                   
                                           
                                            
                                            <div class="body">';
                                                
                                               
                                                
                           
                       
                         $as = $row->id_estado;
                         if($as == 7 || $as == 5){
                            echo '            <li><span class="label label-info">falta formatear a pdf</span></li>';
                            echo '            <li><i class="icon-time"></i> '.lang("vhe_actualizado el").' ' . obtenerFechaEnLetra($row->fecha_ultima_upd) . '</li>';
                            echo '        </ul>';
                            echo '            <form name="input" action="' . base_url() . 'index.php/System/editor_pagina" method="post">';
                            echo '            <input type="hidden" value="' . $row->ID . '" name="articulo_id" />';
                            echo '            <input type="hidden" value="' . $row->email_autor . '" name="email_autors" />';
                            echo '            <center><button class="submit btn btn-primary waves-effect center">formater artículo</button>';
                            echo '          </center></form>';
                         }
                        }
                    }
                ?>

            </div>

            <?php
             echo '<ul class="pager nomargin">';
             if ($group_no == 0 && $group_no + 1 < $cant_group) {
                 $next = $group_no + 1;
                 echo '<li class="next"><a href="' . base_url() . 'index.php/System/editor_ve7?page=' . $next . '">'.lang("vpp_siguiente").' &rarr;</a></li>';
             } else if ($group_no + 1 == $cant_group && $group_no > 0) {
                 $back = $group_no - 1;
                 echo '<li class="previous"><a href="' . base_url() . 'index.php/System/editor_ve7?page=' . $back . '">&larr; '.lang("vpp_anterior").'</a></li>';
             } else if ($group_no + 1 < $cant_group) {
                 $next = $group_no + 1;
                 echo '<li class="next"><a href="' . base_url() . 'index.php/System/editor_ve7?page=' . $next . '">'.lang("vpp_siguiente").' &rarr;</a></li>';
                 $back = $group_no - 1;
                 echo '<li class="previous"><a href="' . base_url() . 'index.php/System/editor_ve7?page=' . $back . '">&larr; '.lang("vpp_anterior").'</a></li>';
             }
             echo '</ul>';
            ?>

        </div>

                <div class="widget clearfix">
                    <?php
                     $this->load->view('include/menu_editor');
                    ?>
                </div>
            
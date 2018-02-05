<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php //echo $id_usuario; echo $nombre_usuario; echo $email_usuario; echo $id_rol;           ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bs-select.js"></script>
<div class="content-wrap">
    <div class="container clearfix">
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
                         echo '<div class="entry clearfix">
                             <div class="col-lg-10">
                                    <div class="entry-title">
                                        <h2>'.lang("vhe_no existen articulos aun").'.</h2>
                            </div>
                                    <a href="'.base_url().'index.php/System/editor_ve7" class="button button-3d button-rounded button-mini button-teal center">'.lang("vhe_articulos por paginar").'</a>
                                    <a href="'.base_url().'index.php/System/editor_ve13" class="button button-3d button-rounded button-mini button-green center">'.lang("vhe_articulos listos").'</a>
                             </div>
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
                     echo '<div class="entry clearfix">
                             <div class="col-lg-10">
                                <div class="entry-title">
                                    <h2>'.lang("vhe_articulos disponibles").'</h2>
                                </div>
                                    <a href="'.base_url().'index.php/System/editor_ve7" class="button button-3d button-rounded button-mini button-teal center">'.lang("vhe_articulos por paginar").'</a>
                                    <a href="'.base_url().'index.php/System/editor_ve13" class="button button-3d button-rounded button-mini button-green center">'.lang("vhe_articulos listos").'</a>
                             </div>
                           </div>';

                    foreach ($consulta as $row) {
                         echo '<div class="entry clearfix">';
                         echo '    <div class="clearfix">';
                         echo '        <div class="entry-title">';
                         echo '            <h2>' . $row->titulo_revista . '</h2>';
                         echo '        </div>';
                         echo '        <ul class="entry-meta clearfix">';
                         $as = $row->id_estado;
                         if($as == 7 || $as == 5){
                            echo '            <li><span class="label label-info">'.lang("vhe_falta paginar").'</span></li>';
                            echo '            <li><i class="icon-time"></i> '.lang("vhe_actualizado el").' ' . obtenerFechaEnLetra($row->fecha_ultima_upd) . '</li>';
                            echo '        </ul>';
                            echo '            <form name="input" action="' . base_url() . 'index.php/System/editor_pagina" method="post">';
                            echo '            <input type="hidden" value="' . $row->ID . '" name="articulo_id" />';
                            echo '            <input type="hidden" value="' . $row->email_autor . '" name="email_autors" />';
                            echo '            <center><button class="submit button button-3d button-rounded button-mini button-teal center">'.lang("vhe_paginar articulo").'</button>';
                            echo '          </center></form>';
                         }else if($as == 13){
                            echo '            <li><span class="label label-success">'.lang("vla_listo para revista").'</span></li>';
                            $dat = $this->Articulo_Model->get_fecha_last($row->ID);
                            echo '            <li><i class="icon-time"></i> '.lang("vla_actualizado el").' ' . obtenerFechaEnLetra($dat->fecha_ultima_upd) . '</li>';
                            $dat = $this->Articulo_Model->get_pagina_ini($row->ID);
                            $dat2 = $this->Articulo_Model->get_pagina_fin($row->ID);
                            echo '            <li><i class="icon-time"></i> '.lang("vla_pagina inicial").':<big><b>' . $dat->pagina_inicio . '</b></big>   ---   '.lang("vla_pagina final").': <big><b>'.$dat2->pagina_fin.'</b></big></li>';
                            echo '        </ul>';
                            echo '            <form name="input" action="' . base_url() . 'index.php/System/editor_pagina" method="post">';
                            echo '            <input type="hidden" value="' . $row->ID . '" name="articulo_id" />';
                            echo '            <center><button class="submit button button-3d button-rounded button-mini button-blue center">Volver a paginar</button>';
                            echo '          </center></form>';
                         }
                         echo '    </div>';
                         echo '</div>';
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
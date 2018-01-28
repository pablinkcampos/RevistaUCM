<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php //echo $id_usuario; echo $nombre_usuario; echo $email_usuario; echo $id_rol;           ?>
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
                         echo '<div class="entry clearfix">
                             <div class="col-lg-10">
                                <div class="entry-title">
                                    <h2>'.lang("vpp_no existen articulos por paginar").'.</h2>
                                </div>
                                    <a href="'.base_url().'index.php/System/editor_ve7" class="button button-3d button-rounded button-mini button-teal center">'.lang("vpp_articulos por paginar").'</a>
                                    <a href="'.base_url().'index.php/System/editor_ve13" class="button button-3d button-rounded button-mini button-green center">'.lang("vpp_articulos listos").'</a>
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
                             <div class="col-lg-8">
                                <div class="entry-title">
                                    <h2>'.lang("vpp_articulos por paginar").'</h2>
                                </div>
                                    <a href="'.base_url().'index.php/System/editor_ve7" class="button button-3d button-rounded button-mini button-teal center">'.lang("vpp_articulos por paginar").'</a>
                                    <a href="'.base_url().'index.php/System/editor_ve13" class="button button-3d button-rounded button-mini button-green center">'.lang("vpp_articulos listos").'</a>
                             </div>
                           </div>';

                    foreach ($consulta as $row) {
                         echo '<div class="entry clearfix">';
                         echo '        <div class="entry-title">';
                         echo '            <h2>' . $row->titulo_revista . '</h2>';
                         echo '        </div>';
                         echo '        <ul class="entry-meta clearfix">';
                         $as = $row->id_estado;
                         if($as == 5 || $as == 7){
                            echo '            <li><span class="label label-info">'.lang("vpp_falta paginar").'</span></li>';
                         }else if($as == 8){
                            echo '            <li><span class="label label-success">'.lang("vpp_listo para revista").'</span></li>';
                         }
                         echo '            <li><i class="icon-time"></i> '.lang("vpp_actualizado el").' ' . obtenerFechaEnLetra($row->fecha_ultima_upd) . '</li>';
                         echo '        </ul>';
                         echo '            <form name="input" action="' . base_url() . 'index.php/System/editor_pagina" method="post">';
                         echo '            <input type="hidden" value="' . $row->ID . '" name="articulo_id" />';
                         echo '            <input type="hidden" value="' . $row->email_autor . '" name="email_autors" />';
                         echo '            <center><button class="submit button button-3d button-rounded button-mini button-teal center">'.lang("vpp_paginar articulo").'</button>';
                         echo '          </center></form>';
                         echo '</div>';
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

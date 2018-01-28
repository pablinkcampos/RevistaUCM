<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php //echo $id_usuario; echo $nombre_usuario; echo $email_usuario; echo $id_rol;        ?>


<div class="content-wrap">
    <div class="container clearfix">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
              <?php
                function obtenerFechaEnLetra($fecha)
                {
                   $dia= conocerDiaSemanaFecha($fecha);
                   $num = date("j", strtotime($fecha));
                   $anno = date("Y", strtotime($fecha));
                   $mes = array(lang('enero'), lang('febrero'), lang('marzo'), lang('abril'), lang('mayo'), lang('junio'), lang('julio'), lang('agosto'), lang('septiembre'), lang('octubre'), lang('noviembre'), lang('diciembre'));
                   $mes = $mes[(date('m', strtotime($fecha))*1)-1];
                   return $dia.', '.$num.lang('vhr_de').$mes.lang('vhr_del').$anno;
               }

               function conocerDiaSemanaFecha($fecha)
               {
                   $dias = array(lang('domingo'), lang('lunes'), lang('martes'), lang('miercoles'), lang('jueves'), lang('viernes'), lang('sabado'));
                   $dia = $dias[date('w', strtotime($fecha))];
                   return $dia;
               }
                // Parametros
                $group_no = 0;
                $content_per_page = 3;
                $user_data = $this->session->userdata('userdata');
                $email_autor=$user_data['email_usuario'];


                // Datos get
                $datas = $this->input->get('page');

                // Cantidad de grupos en total
                $filas = $this->Articulo_Model->count_articulos_asignados($email_autor);

                $cant_group = 0;
                if ($filas)
                {
                  $cant_group_aux = ceil($filas->cantidad/$content_per_page);
                  $cant_group = $cant_group_aux;

                  if ($filas->cantidad == 0)
                  {
                    echo '<div class="entry clearfix">
                              <div class="entry-title">
                                  <h2>'.lang("vhr_no tienes articulos asignados").'.</h2>
                              </div>
                         </div><br><br><br><br><br><br><br>';
                  }
                }

                if ($datas)
                {
                  if ($group_no < $cant_group)
                  {
                    $group_no = $datas;
                  }
                }
                //Ruta archivos
                $ruta = 'uploads';


                $start = ceil($group_no * $content_per_page);

                $consulta = $this->Articulo_Model->articulos_asignados_limit($email_autor, $start, $content_per_page);
                if ($consulta && $filas)
                {
                    foreach ($consulta as $row) {
                        $salida_estado = $this->Articulo_Model->obtener_estado_nombre($row->id_estado);
                        if ($salida_estado)
                        {
                          echo '<div class="entry clearfix">';
                          echo '    <div class="entry-c">';
                          echo '        <div class="entry-title">';
                          echo '            <h2>'. $row->titulo_revista .'</h2>';
                          echo '        </div>';
                          echo '        <ul class="entry-meta clearfix">';
                          echo '            <li><span class="label label-success">'. $salida_estado->nombre_estado . '</span></li>';
                          echo '            <li><i class="icon-time"></i> '.lang("vhr_actualizado el").''. obtenerFechaEnLetra($row->fecha_ultima_upd) .'</li>';
                          echo '        </ul>';
                          echo '        <div class="entry-content">';
                          echo '            <div style="text-align: justify"><p> '. $row->abstract . '</p> </div>';
                          echo '            <form name="input" action="'.base_url().'index.php/System/revisor" method="post">';
                          echo '            <a href="'. base_url() . $ruta .'/'. $row->archivo.'" class="button button-3d button-mini button-rounded button-blue">'.lang("vhr_ver articulo").'</a>';
                          echo '            <input type="hidden" value="'. $row->ID .'" name="articulo_id" />';
                          echo '            ';
                          echo '          </form>';
                          echo '        </div>';
                          echo '    </div>';
                          echo '</div>';
                        }
                      }
                }

               ?>

            </div>

            <!-- Pagination
            ============================================= -->
            <?php
              echo '<ul class="pager nomargin">';
                if ($group_no == 0 && $group_no + 1 < $cant_group)
                {
                  $next = $group_no + 1;
                  echo '<li class="next"><a href="'.base_url().'index.php/System/revisor?page=' . $next . '">'.lang("vhr_siguiente").' &rarr;</a></li>';
                }
                else if ($group_no + 1 == $cant_group && $group_no > 0)
                {
                  $back = $group_no - 1;
                  echo '<li class="previous"><a href="'.base_url().'index.php/System/revisor?page=' . $back . '">&larr; '.lang("vhr_anterior").'</a></li>';
                }
                else if ($group_no + 1 < $cant_group)
                {
                  $next = $group_no + 1;
                  echo '<li class="next"><a href="'.base_url().'index.php/System/revisor?page=' . $next . '">'.lang("vhr_siguiente").' &rarr;</a></li>';
                  $back = $group_no - 1;
                  echo '<li class="previous"><a href="'.base_url().'index.php/System/revisor?page=' . $back . '">&larr; '.lang("vhr_anterior").'</a></li>';
                }
              echo '</ul>';
             ?>

        </div>

        <div class="sidebar nobottommargin clearfix">
            <div class="sidebar-widgets-wrap">
                <div class="widget clearfix">
                    <?php
                     $this->load->view('include/menu_revisor');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

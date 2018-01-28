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
                   return $dia.', '.$num.lang('vha_de').$mes.lang('vha_del').$anno;
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
                $filas = $this->Articulo_Model->count_obtener_articulos($email_autor);

                $cant_group = 0;
                if ($filas)
                {
                  $cant_group_aux = ceil($filas->cantidad/$content_per_page);
                  $cant_group = $cant_group_aux;

                  if ($filas->cantidad == 0)
                  {
                    echo '<div class="entry clearfix">
                              <div class="entry-title">
                                  <h2>'.lang("vha_no tienes articulos").'</h2>
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

                $consulta = $this->Articulo_Model->obtener_articulos_limit($email_autor, $start, $content_per_page);
                if ($consulta && $filas)
                {
                  $i = 0;
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
                          echo '            <li><i class="icon-time"></i> '.lang("vha_actualizado el").' '. obtenerFechaEnLetra($row->fecha_ultima_upd) .'</li>';
                          echo '        </ul>';
                          echo '        <div class="entry-content">';
                          echo '            <div style="text-align: justify"><p> '. $row->abstract .'</div>';
                          echo '                </p>';

                          echo '            <form name="input" action="'.base_url().'index.php/System/autor" method="post">';
                          echo '            <a href="'. base_url() . $ruta .'/'. $row->archivo.'" class="button button-3d button-mini button-rounded button-blue">'.lang("vha_ver articulo").'</a>';
                          echo '            <input type="hidden" value="'. $row->ID .'" name="articulo_id" />';
                          // Se puede borrar si esta en espera (1), rechazado (4), rechazado por tiempo (9)
                          if ($row->id_estado == 1 || $row->id_estado == 4 || $row->id_estado == 9)
                          {
                            $i = $i + 1;
                            //echo '            <button class="submit button button-3d button-mini button-rounded button-red">'.lang("vha_eliminar articulo").'</button>';
                            $url = base_url()."index.php/Articulo_autor/eliminar_articulo?a=".md5($row->ID . 'a1ds4345f5xcjdfnp147');

                            echo "<td>"; echo "<a class = 'button button-3d button-mini button-rounded button-red' data-toggle='modal' data-target='#modal_aprobar".$i."'>Eliminar artículo<center></center></span></center></span></a>";  echo "</td>";

                            echo '<div class="modal fade" id="modal_aprobar'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
                            echo '  <div class="modal-dialog" role="document">';
                            echo '    <div class="modal-content">';
                            echo '      <div class="modal-header">';
                            echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                            echo '        <h4 class="modal-title" id="myModalLabel">Confirmación de eliminación</h4>';
                            echo '      </div>';
                            echo '      <div class="modal-body">';
                            echo ' ¿Está seguro que desea eliminar el artículo?';
                            echo '      </div>';
                            echo '      <div class="modal-footer">';
                            echo '        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
                            echo '        <a href="' . $url . '" "#" class="btn btn-danger" role="button">Eliminar'.'</a>';
                            echo '      </div>';
                            echo '    </div>';
                            echo '  </div>';
                            echo '</div>';
                          }


                          if($row->id_estado==1)
                          echo '            <a href="'. base_url() . 'index.php/System/mod_articulo/'.$row->ID.'" class="button button-3d button-mini button-rounded button-green">'.lang("vha_modificar articulo").'</a>';



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
                  echo '<li class="next"><a href="'.base_url().'index.php/System/autor?page=' . $next . '">'.lang("vha_siguiente").' &rarr;</a></li>';
                }
                else if ($group_no + 1 == $cant_group && $group_no > 0)
                {
                  $back = $group_no - 1;
                  echo '<li class="previous"><a href="'.base_url().'index.php/System/autor?page=' . $back . '">&larr; '.lang("vha_anterior").'</a></li>';
                }
                else if ($group_no + 1 < $cant_group)
                {
                  $next = $group_no + 1;
                  echo '<li class="next"><a href="'.base_url().'index.php/System/autor?page=' . $next . '">'.lang("vha_siguiente").' &rarr;</a></li>';
                  $back = $group_no - 1;
                  echo '<li class="previous"><a href="'.base_url().'index.php/System/autor?page=' . $back . '">&larr; '.lang("vha_anterior").'</a></li>';
                }
              echo '</ul>';
             ?>

        </div>

        <div class="sidebar nobottommargin clearfix">
            <div class="sidebar-widgets-wrap">
                <div class="widget clearfix">
                    <?php
                     $this->load->view('include/menu_autor');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

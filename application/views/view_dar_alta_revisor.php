<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min_spanish.js"></script>


<script type="text/javascript">
$(document).ready(function() {

    $('#articulos').DataTable({
      "language": {

          "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/<?php echo ucwords($this->session->userdata('lang')['route']);?>.json"
      },
      "order": [[ 1, "desc" ]]

    });
} );
</script>
<!--
<script>
$(function() {

    setTimeout(function() {
        $(".successMessage").animate({ height: 'toggle', opacity: 'toggle' }, 1000);
    }, 3000);

});
-->
</script>

<div class="content-wrap">
    <div class="container clearfix">

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
        <div class="col-md-9">

              <div class="col-md-12">
                      <div class="col-md-12">
                          <br>
                          <h3 style = "color: black;"><?php echo lang('aar_asignar ingresar revisores al sistema'); ?></h3>
                          <hr>
                      </div>
                  <div class="col-md-2"></div>
              </div>

              <div class="col-md-12">
                  <div class="col-md-12">


                  <table id="articulos" class="display" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th> Nombre</th>
                                  <th> Correo</th>
                                  <th> Título</th>
                                  <th> Organización</th>
                                  <th>Teléfono</th>
                                  <th>Biografía</th>
                                  <th>Aceptar</th>
                                  <th>Rechazar</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php
                          $datos = $this->Articulo_Model->obtener_postulantes_editor();
                          $i = 0;
                          if($datos){ ?>
                          	<?php foreach ($datos->result() as $row): ?>
                  				<?php
                            $id = $row->id_revisor;
                  					$nombre	=	$row->nombre . ' ' . $row->apellido_1 .' '. $row->apellido_1;
                            $correo = $row->correo;
                            $titulo = $row->titulo_academico;
                            $organizacion = $row->organizacion;
                            $telefono = $row->telefono;
                            $biografia = $row->biografia;
                            $i = $i + 1;

                  					echo "<tr>";
                  						echo "<td>"; echo $nombre; echo "</td>";
                              echo "<td>"; echo $correo; echo "</td>";
                              echo "<td>"; echo $titulo; echo "</td>";
                              echo "<td>"; echo $organizacion; echo "</td>";
                              echo "<td>"; echo $telefono; echo "</td>";
                              echo "<td>"; echo $biografia; echo "</td>";


                              $url = base_url()."index.php/articulo_editor/aceptar_revisor/".md5($correo .'ox');

                              echo "<td>"; echo "<a data-toggle='modal' data-target='#modal_aprobar".$i."'><center><i class='material-icons' style='font-size:40px;'>assignment_ind</i></center></span></center></span></a>";  echo "</td>";

                              echo '<div class="modal fade" id="modal_aprobar'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
                              echo '  <div class="modal-dialog" role="document">';
                              echo '    <div class="modal-content">';
                              echo '      <div class="modal-header">';
                              echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                              echo '        <h4 class="modal-title" id="myModalLabel">Confirmación de aceptación</h4>';
                              echo '      </div>';
                              echo '      <div class="modal-body">';
                              echo ' ¿Está seguro que desea aceptar el ingreso de este nuevo revisor?';
                              echo '      </div>';
                              echo '      <div class="modal-footer">';
                              echo '        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
                              echo '        <a href="' . $url . '" "#" class="btn btn-success" role="button">Aceptar</a>';
                              echo '      </div>';
                              echo '    </div>';
                              echo '  </div>';
                              echo '</div>';


                              $url_rechazar = base_url()."index.php/articulo_editor/rechazar_revisor/".md5($correo .'ox');
                              echo "<td>"; echo "<a data-toggle='modal' data-target='#modal_rechazar".$i."'><center><i class='material-icons' style='font-size:40px;color:red'>delete_forever</i></center></span></center></span></a>";  echo "</td>";

                              echo '<div class="modal fade" id="modal_rechazar'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
                              echo '  <div class="modal-dialog" role="document">';
                              echo '    <div class="modal-content">';
                              echo '      <div class="modal-header">';
                              echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                              echo '        <h4 class="modal-title" id="myModalLabel">Confirmación de rechazo</h4>';
                              echo '      </div>';
                              echo '      <div class="modal-body">';
                              echo ' ¿Está seguro que desea rechazar el ingreso de este nuevo revisor?';
                              echo '      </div>';
                              echo '      <div class="modal-footer">';
                              echo '        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
                              echo '        <a href="' . $url_rechazar . '" "#" class="btn btn-danger" role="button">Rechazar</a>';
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
                      </table>
                  </div>
                  <div class="col-md-2"></div>
              </div>
            </div>


        </div>
</div>
</div>

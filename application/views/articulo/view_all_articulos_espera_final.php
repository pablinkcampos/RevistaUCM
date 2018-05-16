<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
<link href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min_spanish.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bs-select.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#articulos tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" style="width: 100%; text-align: left;" placeholder="Filtrar" />' );
        } );
        
        var table =   $('#articulos').DataTable({
            "language": {

                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/<?php echo ucwords($this->session->userdata('lang')['route']); ?>.json"
            },
            "order": [[1, "desc"]]

        });
 
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
                        <h3 style="color: black;">
                            Artículos en Espera versión Final
                            <hr>
                    </div>
                </div>

                <div class="col-md-12">
                    <table id="articulos" class="display" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                   ID
                                </th>
                                <th>
                                    Fecha plazo de reenvio 
                                </th>
                                <th>
                                    <?php echo lang('aar_tema'); ?>
                                </th>
                                <th>
                                    <?php echo lang('allarv_titulo articulo'); ?>
                                </th>
                                <th>
                                    <?php echo lang('allarv_estado'); ?>
                                </th>
                                <th>
                                    <?php echo lang('allarv_autor'); ?>
                                </th>
                                <th>
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($datos){ 
                                $i = 0 ?>
                            <?php foreach ($datos->result() as $row): ?>
                            <?php

                                $id_revista = $row->ID;
                                $titulo_revista = $row->titulo_revista;
                                $email_autor = $row->email_autor;
                                $estado = $row->estado;
                                $tema = $row->tema;
                                $fecha = $row->fecha_timeout;
                                $e_post = $row->e_post;
                                $peticion = $row->peticion;
                                $fecha_reenvio = NULL;
                                if($fecha != NULL){
                                    $fecha_reenvio = date("d-m-y",strtotime($fecha));
                                }
                                
                                $fecha_calf = $row->fecha_calf;
                                $date1 = new DateTime($fecha_calf);
                                $date2 = new DateTime($fecha);
                                $now = new DateTIme('now');
                                $diff = $date1->diff($date2);
                                $diff2 = $date2->diff($now);
                                $dife = intval($diff2->days);
                                $limite = intval($diff->days);
                                $i = $i + 1;
                                
                              $url = base_url()."index.php/articulo_editor/extender_plazo/".$id_revista;

                              

                              echo '<div class="modal fade" id="modal_aprobar'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
                              echo '  <div class="modal-dialog" role="document">';
                              echo '    <div class="modal-content">';
                              echo '      <div class="modal-header">';
                              echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                              echo '        <h4 class="modal-title" id="myModalLabel">Confirmación de extensión Plazo</h4>';
                              echo '      </div>';
                              echo '      <div class="modal-body">';
                              echo ' <h4>'.$peticion.'</h4>';
                              echo ' ¿Está seguro que desea aceptar el plazo extendido?';
                              echo '      </div>';
                              echo '      <div class="modal-footer">';
                              echo '        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
                              echo '        <a href="' . $url . '" "#" class="btn btn-success" role="button">Aceptar</a>';
                              echo '      </div>';
                              echo '    </div>';
                              echo '  </div>';
                              echo '</div>';


                              $url_rechazar = base_url()."index.php/articulo_editor/rechazar_articulo/".$id_revista;
                              

                              echo '<div class="modal fade" id="modal_rechazar'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
                              echo '  <div class="modal-dialog" role="document">';
                              echo '    <div class="modal-content">';
                              echo '      <div class="modal-header">';
                              echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                              echo '        <h4 class="modal-title" id="myModalLabel">Confirmación de rechazo</h4>';
                              echo '      </div>';
                              echo '      <div class="modal-body">';
                              echo ' ¿Está seguro que desea rechazar este artículo?';
                              echo '      </div>';
                              echo '      <div class="modal-footer">';
                              echo '        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
                              echo '        <a href="' . $url_rechazar . '" "#" class="btn btn-danger" role="button">Rechazar</a>';
                              echo '      </div>';
                              echo '    </div>';
                              echo '  </div>';
                              echo '</div>';
                                
                                  

                                    echo "<tr>";
                                    if($dife > $limite/2 ){
                                       
                                        echo "<td style='border-left: 6px solid green;'>";
                                    }
                                    else{
                                        if($dife < $limite/2 && $dife > 0 ){
                                            
                                            echo "<td style='border-left: 6px solid orange;'>";
                                        }
                                        else{
                                           
                                            echo "<td style='border-left: 6px solid red;'>";
                                        }
                                    }
                                        echo $id_revista; echo "</td>";
                                        echo "<td>"; echo $fecha_reenvio; echo "</td>";
                                        echo "<td>"; echo $tema; echo "</td>";
                  					    echo "<td>"; echo $titulo_revista; echo "</td>";

                                              echo "<td>";
                                              echo $estado;
                                              echo "</td>";
                                         

                                              echo "<td>";
                                              echo $email_autor;
                                             
                                              echo "</td>";
                                              
                  						if($e_post == 1){
                                            echo "<td>"; echo "<a data-toggle='modal' data-target='#modal_aprobar".$i."'><center><i class='material-icons' style='font-size:40px;'>assignment_ind</i></center></span></center></span></a>";  echo "</td>";
                                        }
                                              
                                              echo "<td>"; echo "<a data-toggle='modal' data-target='#modal_rechazar".$i."'><center><i class='material-icons' style='font-size:40px;color:red'>delete_forever</i></center></span></center></span></a>";  echo "</td>";


                  					echo "</tr>";
                  				?>
                                <?php endforeach ?>
                                <?php
                              } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>
                                    <?php echo lang('aaa_fecha ingreso'); ?>
                                </th>
                                <th>
                                    <?php echo lang('aar_tema'); ?>
                                </th>
                                <th>
                                    <?php echo lang('aaa_titulo'); ?>
                                </th>
                                <th>
                                    <?php echo lang('aaa_estado'); ?>
                                </th>
                                <th>
                                    <?php echo lang('aaa_autor'); ?>
                                </th>
                               
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>


        </div>
    </div>
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
                            <?php echo lang('allarv_articulo_revisado'); ?>
                            <hr>
                    </div>
                </div>

                <div class="col-md-12">
                    <table id="articulos" class="display" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    <?php echo lang('allarv_fecha ingreso articulo'); ?>
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
                                    <?php echo lang('aaa_ver'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($datos){ ?>
                            <?php foreach ($datos->result() as $row): ?>
                            <?php

                                $id_revista = $row->ID;
                                $titulo_revista = $row->titulo_revista;
                                $email_autor = $row->email_autor;
                                $estado = $row->estado;
                                $tema = $row->tema;
                                $fecha_ingreso = $row->fecha_ingreso;
                                $fecha_revision = $row->fecha_revision;
                                $fecha_vencimiento = $row->fecha_vencimiento;
                                $date1 = new DateTime($fecha_revision);
                                $date2 = new DateTime($fecha_vencimiento);
                                $now = new DateTIme('now');
                                $diff = $date1->diff($date2);
                                $diff2 = $date2->diff($now);
                                $dife = intval($diff2->days);
                                $limite = intval($diff->days);
                                
                                  

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
                                     
                                        echo $fecha_ingreso; echo "</td>";
                                        echo "<td>"; echo $tema; echo "</td>";
                  					    echo "<td>"; echo $titulo_revista; echo "</td>";

                                              echo "<td>";
                                              echo $estado;
                                              echo "</td>";
                                         

                                              echo "<td>";
                                              echo $email_autor;
                                             
                                              echo "</td>";
                                              
                  						
                  						    echo "<td>"; echo "<a href='".base_url()."index.php/articulo_editor/all_articulos_revisados_ver/".$id_revista."'><center><i class='material-icons' style='font-size:40px;'>zoom_in</i></center></center></a>"; echo "</td>";


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
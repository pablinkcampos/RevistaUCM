<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min_spanish.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

        $('#articulos').DataTable({
            "language": {

                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/<?php echo ucwords($this->session->userdata('lang')['route']); ?>.json"
            },
            "order": [[0, "desc"]]

        });
    });
</script>

<script>
    $(function () {

        setTimeout(function () {
            $(".successMessage").animate({height: 'toggle', opacity: 'toggle'}, 1000);
        }, 3000);

    });

</script>

<div class="content col-md-12 ">
    <div class="container clearfix">
        <div>

            <div class="col-md-12">
                <br>
                <h3 style = "color: black;"><?php echo lang('vb_buscar en todos los articulos'); ?></h3>
                <hr>

                <table id="articulos" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><?php echo lang('vb_titulo'); ?></th>
                            <th><?php echo lang('vb_autor'); ?></th>
                            <th><?php echo lang('vb_archivo'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($datos) { ?>
                            <?php foreach ($datos->result() as $row): ?>
                                <?php
                                $ID = $row->ID_articulo;
                                $id_revista = $row->ID;
                                $titulo_revista = $row->titulo;
                                $archivo = $row->file_papper;

                                $info_paper = $this->Articulo_Model->obtener_info_articulo2($ID);

                                if ($info_paper) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $info_paper->titulo_revista;
                                    echo "</td>";

                                    $CI = & get_instance();
                                    $CI->load->model('Articulo_model');

                                    echo "<td>";
                                    echo $info_paper->autor_1;
                                    echo "</td>";

                                    echo "<td>";
                                    echo "<a Download href='" . base_url() . "uploads/" . $archivo . "'><center><i class='material-icons' style='font-size:40px;'>file_download</i></center>";
                                    echo "</td>";

                                    echo "</tr>";
                                }
                                ?>
                            <?php endforeach ?>

                            <?php }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

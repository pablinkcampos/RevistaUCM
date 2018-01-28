<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

<div class="content-wrap">
    <div class="container clearfix">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">

                <?php if ($datos) { ?>
                    <?php foreach ($datos->result() as $row): ?>
                        <?php
                        $id_revista = $row->ID;
                        $titulo_revista = $row->titulo_revista;
                        $email_revisor_1 = $row->email_revisor_1;
                        $email_revisor_2 = $row->email_revisor_2;
                        $email_revisor_3 = $row->email_revisor_3;
                        ?>



                        <div class="col-md-12">
                            <div class="col-md-12">
                                <br>
                                <h3 style = "color: black;"><?php echo lang('aaac_editar articulo'); ?></h3>
                                <hr>
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-12">
                                <form method="POST" action="<?php echo base_url(); ?>index.php/articulo_revisor/articulos_asignados_comentar/<?php echo $id_revista; ?>">
                                    <div class="form-group">
                                        <label for="text"><?php echo lang('aaac_titulo revista'); ?></label>
                                        <input type="text" class="form-control" id="titulo_revista" value="<?php echo $titulo_revista; ?>" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment"><?php echo lang('aaac_comentario'); ?></label>
                                        <textarea class="form-control" rows="10" id="comentario" name="comentario" required="required" oninvalid="setCustomValidity('<?php echo lang("fv_campo requerido"); ?>')" oninput="setCustomValidity('')"><?php echo $comentario; ?></textarea>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-md-6">
                                            <input type="submit" class="button button-3d button-mini button-rounded button-green btn-block" value="<?php echo lang('aaac_comentar'); ?>" />
                                        </div>
                                    </div>

                                </form>
                                <br><br>

                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-6">
                                        <form method="POST" action="<?php echo base_url(); ?>index.php/articulo_revisor/articulos_asignados">
                                            <input type="submit" class="button button-3d button-mini button-rounded button-blue btn-block" value="<?php echo lang('aaac_regresar'); ?>" />
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php } ?>

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

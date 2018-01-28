<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrap">
    <div class="container clearfix">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
                <div class="entry clearfix col-lg-12">
                    <div class="col-lg-9"><h2><?php echo lang('vrev_revistas ucm');?> </h2>

                    </div>
                    <div class="col-lg-3">
                        <a href="<?php echo base_url(); ?>index.php/System/newm" class="button right button-3d button button-rounded button-green"><?php echo lang('vrev_nueva revista');?></a>
                    </div>

                </div>
                <?php
                    $ids = $this->Articulo_Model->obtener_magazine_titulo();
                    if($ids){

                            foreach($ids->result() as $row)   {
                                echo '<div class="entry clearfix col-lg-6">';
                                echo     '<div class="entry-title">';
                                echo         '<h2><a href="'.base_url().'index.php/Home_principal/publicacion?revista=' . $row->ID . '">'.$row->titulo_revista.'</a></h2>';
                                echo    '</div>';
                                echo     '<ul class="entry-meta clearfix">';
                                echo        '<li><i class="icon-calendar3"></i>'.$row->fecha_publicacion.'</li>';
                                $num = $this->Articulo_Model->count_magaziness($row->ID);
                                echo        '<li><a href="'.base_url().'index.php/Home_principal/publicacion?revista=' . $row->ID . '"><i class="icon-comments"></i>'.$num->cantidad.' '.lang("vrev_articulos").'</a></li>';
                                echo   '</ul>';
                                echo '<a class="button button-small button-3d button-circle" href="'.base_url().'index.php/System/editar?revista=' . $row->ID . '">Editar datos de revista</a>';
                                echo '</div>';
                            }

                    }else{
                                echo '<div class="entry clearfix col-lg-6">';
                                echo     '<div class="entry-title">';
                                echo         '<h2>'.lang("vrev_no hay revistas creadas aun").'.</h2>';
                                echo    '</div>';
                                echo '</div>';
                    }
                ?>
            </div>
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

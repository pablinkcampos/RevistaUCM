<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>



<div class="container-fluid  " style="margin-top: 200px;">
	<div class="row">
        <div class="postcontent nobottommargin col_last">
            <div id="posts" class="events small-thumbs">
                <div class="entry clearfix col-lg-12">
                    <div class="col-lg-9"><h2><?php echo lang('vrev_revistas ucm');?> </h2>

                    </div>
                    <a href="<?php echo base_url(); ?>index.php/System/newm" ><button type="button"  class="btn bg-green waves-effect">
                                    <i class="material-icons">note_add</i>
                                    <span><?php echo lang('vrev_nueva revista');?></span>
                    </button></a>
                    

                </div>
                <?php
                    $ids = $this->Articulo_Model->obtener_magazine_titulo();
                    function obtenerFechaEnLetra($fecha)
                    {
                       $dia= conocerDiaSemanaFecha($fecha);
                       $num = date("j", strtotime($fecha));
                       $anno = date("Y", strtotime($fecha));
                       $mes = array(lang('enero'), lang('febrero'), lang('marzo'), lang('abril'), lang('mayo'), lang('junio'), lang('julio'), lang('agosto'), lang('septiembre'), lang('octubre'), lang('noviembre'), lang('diciembre'));
                       $mes = $mes[(date('m', strtotime($fecha))*1)-1];
                       return $dia.', '.$num.lang('vnes_de').$mes.lang('vnes_del').$anno;
                   }
    
                   function conocerDiaSemanaFecha($fecha)
                   {
                       $dias = array(lang('domingo'), lang('lunes'), lang('martes'), lang('miercoles'), lang('jueves'), lang('viernes'), lang('sabado'));
                       $dia = $dias[date('w', strtotime($fecha))];
                       return $dia;
                   }
                    if($ids){

                            foreach($ids->result() as $row)   {
                                $num = $this->Articulo_Model->count_magaziness($row->ID);
                                echo ' <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="icon">
                                        <i class="material-icons col-blue">bookmark</i>
                                    </div>
                                    <div class="header">
                                 
                                        <h2>
                                        <a href="'.base_url().'index.php/Home_principal/publicacion?revista=' . $row->ID . '">'.substr($row->titulo_revista, 0, 30).'</a>
                                        </h2>
                                    </div>

                                           
                                            
                                            <div class="body">
                                                
                                                <div class="text"> <i class="material-icons">event_available</i>'.obtenerFechaEnLetra($row->fecha_publicacion).'</div>
                                                <div class="text"><a href="'.base_url().'index.php/Home_principal/publicacion?revista=' . $row->ID . '"><i class="icon-comments"></i>'.$num->cantidad.' '.lang("vrev_articulos").'</a></div>
                                                <a href="'.base_url().'index.php/System/editar?revista=' . $row->ID . '" ><button type="button"  class="btn bg-amber waves-effect">
                                                <i class="material-icons">create</i>
                                                <span>Editar Revista</span>
                                                
                                            </div>
                                </div>
                                </div>';
                    
                  
                                            
                                        
                              
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


                <div class="widget clearfix">
                    <?php
                     $this->load->view('include/menu_editor');
                    ?>
                </div>
 
<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php //echo $id_usuario; echo $nombre_usuario; echo $email_usuario; echo $id_rol;        ?>

<style>

body {
background:#fff;
}

.bookWrap {
margin:25px auto;
height:346px;
width:230px;

position:relative;

-webkit-perspective: 1200px;
   -moz-perspective: 1200px;
        perspective: 1200px;
}

.book {
background:#000;
height:346px;
width:230px;
position:absolute;
left:16px;
top:0;

-webkit-transform-style: preserve-3d;
   -moz-transform-style: preserve-3d;
        transform-style: preserve-3d;

-webkit-transition: -webkit-transform .5s ease 0s;
   -moz-transition: -moz-transform .5s ease 0s;
        transition: transform .5s ease 0s;

-webkit-border-radius: 0 7px 7px 0;
   -moz-border-radius: 0 7px 7px 0;
        border-radius: 0 7px 7px 0;

-webkit-perspective: 1200px;
   -moz-perspective: 1200px;
        perspective: 1200px;
}

.bookIntro {
-webkit-transform: rotateY(30deg);
   -moz-transform: rotateY(30deg);
        transform: rotateY(30deg);
}

.cover {
position:absolute;
left:0;
top:0;

height: 100%;
width: 230px;

max-width: 230px;
max-height: 346px;

-webkit-backface-visibility: hidden;
   -moz-backface-visibility: hidden;
        backface-visibility: hidden;

-webkit-border-radius: 0 4px 4px 0;
   -moz-border-radius: 0 4px 4px 0;
        border-radius: 0 4px 4px 0;

-webkit-transition: -webkit-transform .5s ease 0s, width .5s ease 0s;
   -moz-transition: -moz-transform .5s ease 0s, width .5s ease 0s;
          transition: transform .5s ease 0s, width .5s ease 0s;

-webkit-transform-origin: 0;
   -moz-transform-origin: 0;
        transform-origin: 0;
}

.cover:hover {
width:210px;

-webkit-transform: rotateY(-20deg);
   -moz-transform: rotateY(-20deg);
        transform: rotateY(-20deg);
}

.spine {
background:black;
width: 40px;
height: 344px;
position: absolute;
top: 0;
left:0;


-webkit-transform: rotateY(90deg);
   -moz-transform: rotateY(90deg);
        transform: rotateY(90deg);

-webkit-transform-origin: 0;
   -moz-transform-origin: 0;
        transform-origin: 0;
}








</style>

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
                   return $dia.', '.$num.lang('vnes_de').$mes.lang('vnes_del').$anno;
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


                // Datos get
                $datas = $this->input->get('page');

                // Cantidad de grupos en total
                $filas = $this->Articulo_Model->count_magazine();

                $cant_group = 0;
                if ($filas)
                {
                  $cant_group_aux = ceil($filas->cantidad/$content_per_page);
                  $cant_group = $cant_group_aux;

                  if ($filas->cantidad == 0)
                  {
                    echo '<div class="entry clearfix">
                              <div class="entry-title">
                                  <h2>'.lang("vnes_no tienes articulos").'</h2>
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

                $consulta = $this->Articulo_Model->obtener_magazines_limit($start, $content_per_page);
                if ($consulta)
                {
                    foreach ($consulta as $row) {
                          echo '<div class="entry clearfix">';
                          echo '    <div class="entry-c">';
                          echo '        <div class="entry-title">';
                          echo '            <h2>'. $row->titulo_revista .' <i>('. $row->fecha_publicacion .')'.' </h2>';
                          echo '        </div>';
                          echo '        <ul class="entry-meta clearfix">';
                          echo '            <li><i class="icon-time"></i> '.lang("vnes_creada el").' '. obtenerFechaEnLetra($row->fecha_creacion) .'</li>';
                          echo '        </ul>';
                          echo '        <div class="entry-content">';
                          //echo '            <div style="text-align: justify"><p> '. $row->abstract .'</div>';
                          if ($row->logo_revista)
                          {
                            echo '<center>';
                            echo'<div class="bookWrap">
                            		<div class="book">
                            			<a href="'.base_url().'index.php/Home_principal/publicacion?revista=' . $row->ID . '" class="nobg"><img class="cover"
                                    src="'.  base_url() .'img/'. $row->logo_revista .'"></a>
                            			<div class="spine"></div>
                            		</div>
                            	</div>';
                            echo '</center>';
                          }
                          echo '                </p>';
                          echo '            <form name="input" action="'.base_url().'index.php/Home_principal/numeros" method="post">';
                          echo '            <center>';
                          echo '            <div class="col-sm-offset-3 col-sm-6"><a href="'.base_url().'index.php/Home_principal/publicacion?revista=' . $row->ID . '" class="button button-3d button-mini button-rounded button-blue btn-block">Ir a revista</a></div>';
                          echo '            <center>';
                          echo '            <input type="hidden" value="'. $row->ID .'" name="articulo_id" />';
                          echo '          </form>';
                          echo '        </div>';
                          echo '    </div>';
                          echo '</div>';
                    }
                }
                else
                {
                  echo '<center>';
                  echo '<h3>'.lang("vnes_pronto tendremos nuevas publicaciones").'</h3>';
                  echo '<center>';
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
                  echo '<li class="next"><a href="'.base_url().'index.php/Home_principal/numeros?page=' . $next . '">'.lang("vnes_siguiente").' &rarr;</a></li>';
                }
                else if ($group_no + 1 == $cant_group && $group_no > 0)
                {
                  $back = $group_no - 1;
                  echo '<li class="previous"><a href="'.base_url().'index.php/Home_principal/numeros?page=' . $back . '">&larr; '.lang("vnes_anterior").'</a></li>';
                }
                else if ($group_no + 1 < $cant_group)
                {
                  $next = $group_no + 1;
                  echo '<li class="next"><a href="'.base_url().'index.php/Home_principal/numeros?page=' . $next . '">'.lang("vnes_siguiente").' &rarr;</a></li>';
                  $back = $group_no - 1;
                  echo '<li class="previous"><a href="'.base_url().'index.php/Home_principal/numeros?page=' . $back . '">&larr; '.lang("vnes_anterior").'</a></li>';
                }
              echo '</ul>';
             ?>

        </div>

        <div class="sidebar nobottommargin clearfix">
            <div class="sidebar-widgets-wrap">
                <div class="widget clearfix">
                        <a href="<?php echo base_url(); ?>img/img_num_publi.jpg" data-lightbox="image"><img class="image_fade" src="<?php echo base_url(); ?>img/img_num_publi.JPG" alt="Publicación efectiva"></a>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

$(document).ready(function() {

// Pause just a moment
setTimeout(function() {

  var $book = $('.book');

  // Apply the intro classes that will
  // appear to turn the book,
  // revealing its spine
  $book.addClass('bookIntro');

  // pause another moment, then turn back
  setTimeout(function() {
    $book.removeClass('bookIntro');
  }, 3000);


}, 1000);


});
</script>

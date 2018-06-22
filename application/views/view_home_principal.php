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
<br>

  <div class="container-fluid  " style="margin-top: 100px;">
       
       <!-- Portfolio Single Content
       ============================================= -->
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         
           <br>
           <?php
            $id_get = $this->input->get('revista');

            $logo = false;
            $resultado = $this->Articulo_Model->count_magazine();

            if ($resultado->cantidad > 0) {
                if ($id_get) {

                    $max_id = $id_get;
                    $magazine = $this->Articulo_Model->get_magazine($max_id);
                    $articulos_en_revista = $this->Articulo_Model->obtener_articulos_en_revista($max_id);
                } else {
                    $max_id = $this->Articulo_Model->get_max_id_magazine();
                    $magazine = $this->Articulo_Model->get_magazine($max_id->numero);

                    $articulos_en_revista = $this->Articulo_Model->obtener_articulos_en_revista($max_id->numero);
                }
               if ($magazine) {
                   if ($magazine->logo_revista) {
                       $logo = true;
                   }
                   
                  
                       
                   echo ' <div class="card">';
                   
                 
                   echo '<div class="header">';
             
                   echo ' <center>    <h2>' . $magazine->titulo_revista;
                   echo '        <br>' . $magazine->fecha_publicacion . '</h2>';
                   echo '</center></div>';

                   echo '<div class="row-fluid">';
                   if ($logo ) {
                       echo '
                               <div class=" col-lg-12 col-md-12">
                               <div class=" col-lg-3 col-md-3">
               
                                         <a href="#" class="nobg"><div class="bookWrap">
                                           <div class="book">
                                             <a href="' . base_url() . 'index.php/Home_principal/publicacion?revista=' . $id_get . '" class="nobg"><img class="cover"
                                               src="' . base_url() . 'img/' . $magazine->logo_revista . '"></a>
                                             
                                           </div>
                                         </a>
                                   
                               </div>
                               </div>
                               
                           ';
                   }
                   
               
                 


                   $row = null;
                   if ($articulos_en_revista) { 
                    echo '<div class="col-lg-9 col-md-9">';
                  echo '<table id="articulos" class="table" width="100%" cellspacing="0">
                    <thead>
                       <tr>
                          <th align="left";>
                             Titulo
                          </th>
                          <th align="left";>
                             &nbsp;
                              Tema
                             &nbsp;
                          </th>
                          <th  width="2%" align="center";>
                             &nbsp;
                              Ver
                             &nbsp;
                          </th>
                          <th  width="2%" align="center";>
                             &nbsp;
                             Descarga
                             &nbsp;
                          </th>
                          
                       </tr>
                    </thead>
                    <tbody>';?>
                        
                    <?php 
                    $i=0;
                    foreach ($articulos_en_revista->result() as $row) {
                        $datos =  $this->Articulo_Model->articulo_ver($row->ID_articulo);
                        foreach ($datos->result() as $row2): 
                            
                              
                                    $titulo_revista    =   $row2->titulo_revista;
                                    $autor         =   $row2->n_autor;
                                    $autor2       =   $row2->n_autor2;
                                    $autor3         =   $row2->n_autor3;
                                    $autor4         =   $row2->n_autor4;
                                    $autor5         =   $row2->n_autor5;
                                    $tema          =   $row2->tema;
                                    $palabras_claves   =   $row2->palabras_claves;
                                    $abstract          =   $row2->abstract;
                                    $fecha_ultima_upd  =   $row2->fecha_ultima_upd ;
                                    $institucion  =   $row2->institucion ;
                        endforeach ;
                        $i = $i + 1;                     

                       

                     
                      
                      


                             echo "<tr>";
                              
                           
                                echo "<td>"; echo $row->titulo; echo '</td>';
                                echo "<td>"; echo $tema; echo '</td>';
                                echo "<td>"; echo "<a data-toggle='modal' data-target='#modal_info".$i."'><center><i class='material-icons' style='font-size:25px;'>assignment_ind</i></center></span></center></span></a>";  echo "</td>";
                                echo "<td>";echo '  <a href=' . base_url() . 'uploads/' . $row->file_papper . '><i class="material-icons" style="font-size:25px;">file_download</i></a><a href = ' . base_url() . 'uploads/' . $row->file_papper . '></a>';echo "</td>";
                           
                             
                             echo '<div class="modal fade" id="modal_info'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
                             echo '  <div class="modal-dialog" role="document">';
                             echo '    <div class="modal-content">';
                             echo '      <div class="modal-header">';
                             echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                             echo '        <h4 class="modal-title" id="myModalLabel">Información Articulo</h4>';
                             echo '      </div>';
                             echo '      <div class="modal-body ">';
                             echo '        <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">';
                             echo '           <div class="panel panel-primary">';
                             echo '              <div class="panel-heading" role="tab" id="headingOne_1">';
                             echo '                   <h4 class="panel-title">';
                             echo '                      <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_1">';
                             echo                            lang('allanav_informacion articulo');
                             echo '                      </a>';
                             echo '                   </h4>';
                             echo '              </div>';
                             echo '              <div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">';
                             echo '                 <div class="panel-body">';
                             echo "                      <br>";
                             echo "                        <b style='text-align: left;'>".lang("allanav_titulo articulo").":</b>";
                             echo "                        <b align='right'>".$titulo_revista."</b>";
                             echo "                      </br>";                                                                                                                                
                             echo "                      <br>";
                             echo "                         <b style='text-align: left;'>".lang("allanav_autor").":</b>";
                             echo "                         <b align='right'>"; echo $autor; echo '<br>'; echo $autor2; echo '<br>'; echo $autor3; echo '<br>'; echo $autor4; echo '<br>'; echo $autor5; echo "</b>";
                             echo "                      </br>";
                             echo "                      <br>";
                             echo "                          <b style='text-align: left;'>".lang("allanav_campo de investigacion").":</b>";
                             echo "                          <b  text-align: right>";echo $tema;echo "</b>";
                             echo "                      </br>";
                             echo "                      <br>";
                             echo "                          <b style='text-align: left;'>".lang("allanav_palabras claves").":</b>";
                             echo "                          <b  text-align: right>";echo $palabras_claves;echo "</b>";
                             echo "                      </br>";
                             echo "                      <br>";
                             echo "                          <b style='text-align: left;'>Institución:</b>";
                             echo "                          <b text-align: right>";echo $institucion;echo "</b>";
                             echo "                      </br>";
                             echo "                      <br>";
                             echo "                          <b style='text-align: left;'>".lang("allanav_abstract").":</b>";
                             echo "                          <b text-align: justify>";echo $abstract;echo "</b>";
                             echo "                      </br>";
                             echo "                      <br>";
                             echo "                          <b style='text-align: left;'>".lang("allanav_fecha ultima actualizacion").":</b>";
                             echo "                          <b text-align: right>";echo $fecha_ultima_upd;echo "</b>";
                             echo "                      </br>";

                             echo '                  </div>';
                             echo '                 </div>';
                             echo '               </div>';
                             echo '             </div>';
                             echo '            </div>';
                             echo '      <div class="modal-footer">';
                             echo '        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
                             echo '      </div>';
                             echo '     </div>';
                             echo '    </div>';
                             echo '  </div>';
                             echo '</div>';
                             echo "</tr>";
                             
                             
                                 } 
                          
                        
                       
                    echo '</tbody>
                        </table>
                    </div>';
                    echo '<div class="col-lg-9 col-md-9">
                      
                    <p><b>' . lang("vhp_palabras del editor") . ':</b><b>' . $magazine->palabras_editor . '</b></p>
                   
                   </div>
                    
                 </div>
                 </div>
                 </div>'; ?>
                 <?php
                   } else {
                       echo '<h4>' . lang("vres_no hay articulos asociados") . '</h4>';
                   }
               } else {
                   echo '<br><br>';
                   echo '<h3> ' . lang("vres_revista solicitada no se encuentra disponible") . '.</h3>';
                   echo '<br><br><br><br><br>';
               }
           } else {
               echo '<br><br>';
               echo '<h3>' . lang("vres_bienvenidos a nuestra plataforma de revistas") . '</h3>';
           }
           ?>
      
    
      


 






<script type="text/javascript">

    $(document).ready(function () {

        // Pause just a moment
        setTimeout(function () {

            var $book = $('.book');

            // Apply the intro classes that will
            // appear to turn the book,
            // revealing its spine
            $book.addClass('bookIntro');

            // pause another moment, then turn back
            setTimeout(function () {
                $book.removeClass('bookIntro');
            }, 3000);


        }, 1000);


    });
</script>

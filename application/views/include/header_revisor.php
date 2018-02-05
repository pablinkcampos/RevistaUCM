<?php
    $CI =& get_instance();
    $CI->load->library('session');
    $CI->load->model('Articulo_model');
    $data_usuario=$CI->session->userdata('userdata');
    $email_select=$data_usuario['email_usuario'];
    $est1 = $CI->Articulo_model->revisor_direct($email_select);
    foreach ($est1->result() as $row){
        $nombre=$row->nombre." ".$row->apellido_1." ".$row->apellido_2;
    }
 ?>
<body class="stretched">
    <div class="clearfix">
        <div id="top-bar">
            <div class="container clearfix">
                <div class="col_half nobottommargin hidden-xs">
                    <p class="nobottommargin"><strong><?php echo lang('HR_bienvenido revisor');?>:</strong> <?php echo $nombre; ?> </p>
                </div>
                <?php
                $user_data = $this->session->userdata('userdata');
                if($user_data['id_rol2'] != NULL || $user_data['id_rol3'] != NULL){
                    if(($user_data['id_rol2'] == 1 && $user_data['id_rol3'] == NULL) || ($user_data['id_rol3'] == 1 && $user_data['id_rol2'] == NULL)){
                        echo '<div class="col_half nobottommargin hidden-xs">';
                        echo '    <p class="nobottommargin"><strong>Cambiar a menú:</strong> <a href="'.base_url().'index.php/System/revisor" style="color: #000080;">Revisor</a>  / <a href="'.base_url().'index.php/System/editor" style="color: #000080;">Editor</a></p>';
                        echo '</div>';
                    }elseif(($user_data['id_rol2'] == 3 && $user_data['id_rol3'] == NULL) || ($user_data['id_rol3'] == 3 && $user_data['id_rol2'] == NULL)){
                        echo '<div class="col_half nobottommargin hidden-xs">';
                        echo '    <p class="nobottommargin"><strong>Cambiar a menú:</strong> <a href="'.base_url().'index.php/System/revisor" style="color: #000080;">Revisor</a>  / <a href="'.base_url().'index.php/System/autor" style="color: #000080;">Autor</a></p>';
                        echo '</div>';
                    }elseif(($user_data['id_rol2'] == 1 && $user_data['id_rol3'] == 3) || ($user_data['id_rol2'] == 3 && $user_data['id_rol3'] == 1)){
                        echo '<div class="col_half nobottommargin hidden-xs">';
                        echo '    <p class="nobottommargin"><strong>Cambiar a menú:</strong> <a href="'.base_url().'index.php/System/revisor" style="color: #000080;">Revisor</a>  / <a href="'.base_url().'index.php/System/autor" style="color: #000080;">Autor</a>  / <a href="'.base_url().'index.php/System/editor" style="color: #000080;">Editor</a></p>';
                        echo '</div>';
                    }elseif(($user_data['id_rol'] == 3 && $user_data['id_rol2'] == 2 && $user_data['id_rol3'] == NULL) || ($user_data['id_rol'] == 3 && $user_data['id_rol3'] == 2 && $user_data['id_rol2'] == NULL)){
                        echo '<div class="col_half nobottommargin hidden-xs">';
                        echo '    <p class="nobottommargin"><strong>Cambiar a menú:</strong> <a href="'.base_url().'index.php/System/autor" style="color: #000080;">Autor</a>  / <a href="'.base_url().'index.php/System/revisor" style="color: #000080;">Revisor</a></p>';
                        echo '</div>';
                    }elseif(($user_data['id_rol'] == 3 && $user_data['id_rol2'] == 1 && $user_data['id_rol3'] == NULL) || ($user_data['id_rol'] == 3 && $user_data['id_rol3'] == 1 && $user_data['id_rol2'] == NULL)){
                        echo '<div class="col_half nobottommargin hidden-xs">';
                        echo '    <p class="nobottommargin"><strong>Cambiar a menú:</strong> <a href="'.base_url().'index.php/System/autor" style="color: #000080;">Autor</a>  / <a href="'.base_url().'index.php/System/editor" style="color: #000080;">Editor</a></p>';
                        echo '</div>';
                    }elseif(($user_data['id_rol'] == 3 && $user_data['id_rol2'] == 2 && $user_data['id_rol3'] == 1) || ($user_data['id_rol'] == 3 && $user_data['id_rol3'] == 2 && $user_data['id_rol2'] == 1)){
                        echo '<div class="col_half nobottommargin hidden-xs">';
                        echo '    <p class="nobottommargin"><strong>Cambiar a menú:</strong> <a href="'.base_url().'index.php/System/autor" style="color: #000080;">Autor</a>  / <a href="'.base_url().'index.php/System/revisor" style="color: #000080;">Revisor</a>  / <a href="'.base_url().'index.php/System/editor" style="color: #000080;">Editor</a></p>';
                        echo '</div>';
                    }elseif(($user_data['id_rol'] == 1 && $user_data['id_rol2'] == 2 && $user_data['id_rol3'] == NULL) || ($user_data['id_rol'] == 1 && $user_data['id_rol3'] == 2 && $user_data['id_rol2'] == NULL)){
                        echo '<div class="col_half nobottommargin hidden-xs">';
                        echo '    <p class="nobottommargin"><strong>Cambiar a menú:</strong> <a href="'.base_url().'index.php/System/editor" style="color: #000080;">Editor</a>  / <a href="'.base_url().'index.php/System/revisor" style="color: #000080;">Revisor</a></p>';
                        echo '</div>';
                    }elseif(($user_data['id_rol'] == 1 && $user_data['id_rol2'] == 3 && $user_data['id_rol3'] == NULL) || ($user_data['id_rol'] == 1 && $user_data['id_rol3'] == 3 && $user_data['id_rol2'] == NULL)){
                        echo '<div class="col_half nobottommargin hidden-xs">';
                        echo '    <p class="nobottommargin"><strong>Cambiar a menú:</strong> <a href="'.base_url().'index.php/System/editor" style="color: #000080;">Editor</a>  / <a href="'.base_url().'index.php/System/autor" style="color: #000080;">Autor</a></p>';
                        echo '</div>';
                    }elseif(($user_data['id_rol'] == 1 && $user_data['id_rol2'] == 2 && $user_data['id_rol3'] == 3) || ($user_data['id_rol'] == 1 && $user_data['id_rol3'] == 2 && $user_data['id_rol2'] == 3)){
                        echo '<div class="col_half nobottommargin hidden-xs">';
                        echo '    <p class="nobottommargin"><strong>Cambiar a menú:</strong> <a href="'.base_url().'index.php/System/editor" style="color: #000080;">Editor</a>  / <a href="'.base_url().'index.php/System/revisor" style="color: #000080;">Revisor</a>  / <a href="'.base_url().'index.php/System/autor" style="color: #000080;">Autor</a></p>';
                        echo '</div>';
                    }
                }
                ?>
                <?php $this->load->view('include/selector_idioma');?>
            </div>
        </div>

        <header id="header">
            <div class="container clearfix">
                <div id="logo">
                    <a href="<?php echo base_url(); ?>" class="standard-logo" data-dark-logo="<?php echo base_url(); ?>img/logo-dark.png"><img src="<?php echo base_url(); ?>img/logo.png" alt="UCM Logo"></a>
                </div>

                <ul class="header-extras">
                  <?php
                    if($user_data['id_rol2'] == NULL )
                    {
                      echo '<li>
                          <a href='. base_url(). 'index.php/Registro_revisor_a_autor'.'>
                          <i class="i-medium i-circled i-bordered icon-thumbs-up2 nomargin"></i>
                          <div class="he-text">
                              '.lang("HR_registro").'
                              <span>'.lang("HR_autor").'</span>
                          </div>
                          </li>
                          </a>';
                    }
                   ?>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Login/pass">
                            <i class="i-medium i-circled i-bordered icon-thumbs-up2 nomargin"></i>
                            <div class="he-text">
                                Cambiar
                                <span>Password</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Login/cerrar_sesion">
                        <i class="i-medium i-circled i-bordered icon-truck2 nomargin"></i>
                        <div class="he-text">
                            <?php echo lang('HR_cerrar sesion');?>
                            <span><?php echo lang('HR_adios');?></span>
                        </div>
                        </a>
                    </li>
                </ul>

            </div>

            <div id="header-wrap">
                <nav id="primary-menu" class="style-2">
                    <div class="container clearfix" style="background-color: #F2F2F2">
                        <div id="primary-menu-trigger"style="background-color: #F2F2F2"><i class="icon-reorder"></i></div>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>"><div><?php echo lang('HR_pagina de inicio');?></div></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Home_principal/nosotros"><div><?php echo lang('HR_sobre nosotros');?></div></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Home_principal/politica"><div><?php echo lang('HR_politica editorial');?></div></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Home_principal/numeros"><div><?php echo lang('HR_numeros publicados');?></div></a></li>

                        </ul>
                        <!--
                        <div id="top-search">
                            <a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
                            <form action="search.html" method="get">
                                <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter..">
                            </form>
                        </div>
                        -->
                    </div>
                </nav>
            </div>
        </header>
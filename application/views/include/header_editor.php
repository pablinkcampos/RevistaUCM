<body class="stretched">
    <div class="clearfix">
        <div id="top-bar">
            <div class="container clearfix">
                <?php
                 $user_data = $this->session->userdata('userdata');
                 if ($user_data['id_rol2'] != NULL || $user_data['id_rol3'] != NULL) {
                     if (($user_data['id_rol2'] == 2 && $user_data['id_rol3'] == NULL) || ($user_data['id_rol3'] == 2 && $user_data['id_rol2'] == NULL)) {
                         echo '<div class="col_half nobottommargin hidden-xs">';
                         echo '    <p class="nobottommargin"><strong>Cambiar a menú: </strong> <a href="' . base_url() . 'index.php/System/editor" style="color: #000080;">Editor</a>  / <a href="' . base_url() . 'index.php/System/revisor" style="color: #000080;">Revisor</a></p>';
                         echo '</div>';
                     } elseif (($user_data['id_rol2'] == 3 && $user_data['id_rol3'] == NULL) || ($user_data['id_rol3'] == 3 && $user_data['id_rol2'] == NULL)) {
                         echo '<div class="col_half nobottommargin hidden-xs">';
                         echo '    <p class="nobottommargin"><strong>Cambiar a menú: </strong> <a href="' . base_url() . 'index.php/System/editor" style="color: #000080;">Editor</a>  / <a href="' . base_url() . 'index.php/System/autor" style="color: #000080;">Autor</a></p>';
                         echo '</div>';
                     } elseif (($user_data['id_rol2'] == 3 && $user_data['id_rol3'] == 2) || ($user_data['id_rol2'] == 2 && $user_data['id_rol3'] == 3)) {
                         echo '<div class="col_half nobottommargin hidden-xs">';
                         echo '    <p class="nobottommargin"><strong>Cambiar a menú: </strong> <a href="' . base_url() . 'index.php/System/editor" style="color: #000080;">Editor</a>  / <a href="' . base_url() . 'index.php/System/revisor" style="color: #000080;">Revisor</a>  / <a href="' . base_url() . 'index.php/System/autor" style="color: #000080;">Autor</a></p>';
                         echo '</div>';
                     } elseif (($user_data['id_rol'] == 3 && $user_data['id_rol2'] == 2 && $user_data['id_rol3'] == NULL) || ($user_data['id_rol'] == 3 && $user_data['id_rol3'] == 2 && $user_data['id_rol2'] == NULL)) {
                         echo '<div class="col_half nobottommargin hidden-xs">';
                         echo '    <p class="nobottommargin"><strong>Cambiar a menú: </strong> <a href="' . base_url() . 'index.php/System/autor" style="color: #000080;">Autor</a>  / <a href="' . base_url() . 'index.php/System/revisor" style="color: #000080;">Revisor</a></p>';
                         echo '</div>';
                     } elseif (($user_data['id_rol'] == 3 && $user_data['id_rol2'] == 1 && $user_data['id_rol3'] == NULL) || ($user_data['id_rol'] == 3 && $user_data['id_rol3'] == 1 && $user_data['id_rol2'] == NULL)) {
                         echo '<div class="col_half nobottommargin hidden-xs">';
                         echo '    <p class="nobottommargin"><strong>Cambiar a menú: </strong> <a href="' . base_url() . 'index.php/System/autor" style="color: #000080;">Autor</a>  / <a href="' . base_url() . 'index.php/System/editor" style="color: #000080;">Editor</a></p>';
                         echo '</div>';
                     } elseif (($user_data['id_rol'] == 3 && $user_data['id_rol2'] == 2 && $user_data['id_rol3'] == 1) || ($user_data['id_rol'] == 3 && $user_data['id_rol3'] == 2 && $user_data['id_rol2'] == 1)) {
                         echo '<div class="col_half nobottommargin hidden-xs">';
                         echo '    <p class="nobottommargin"><strong>Cambiar a menú: </strong> <a href="' . base_url() . 'index.php/System/autor" style="color: #000080;">Autor</a>  / <a href="' . base_url() . 'index.php/System/revisor" style="color: #000080;">Revisor</a>  / <a href="' . base_url() . 'index.php/System/editor" style="color: #000080;">Editor</a></p>';
                         echo '</div>';
                     } elseif (($user_data['id_rol'] == 2 && $user_data['id_rol2'] == 1 && $user_data['id_rol3'] == NULL) || ($user_data['id_rol'] == 2 && $user_data['id_rol3'] == 1 && $user_data['id_rol2'] == NULL)) {
                         echo '<div class="col_half nobottommargin hidden-xs">';
                         echo '    <p class="nobottommargin"><strong>Cambiar a menú: </strong> <a href="' . base_url() . 'index.php/System/revisor" style="color: #000080;">Revisor</a>  / <a href="' . base_url() . 'index.php/System/editor" style="color: #000080;">Editor</a></p>';
                         echo '</div>';
                     } elseif (($user_data['id_rol'] == 2 && $user_data['id_rol2'] == 3 && $user_data['id_rol3'] == NULL) || ($user_data['id_rol'] == 2 && $user_data['id_rol3'] == 3 && $user_data['id_rol2'] == NULL)) {
                         echo '<div class="col_half nobottommargin hidden-xs">';
                         echo '    <p class="nobottommargin"><strong>Cambiar a menú: </strong> <a href="' . base_url() . 'index.php/System/revisor" style="color: #000080;">Revisor</a>  / <a href="' . base_url() . 'index.php/System/autor" style="color: #000080;">Autor</a></p>';
                         echo '</div>';
                     } elseif (($user_data['id_rol'] == 2 && $user_data['id_rol2'] == 1 && $user_data['id_rol3'] == 3) || ($user_data['id_rol'] == 2 && $user_data['id_rol3'] == 1 && $user_data['id_rol2'] == 3)) {
                         echo '<div class="col_half nobottommargin hidden-xs">';
                         echo '    <p class="nobottommargin"><strong>Cambiar a menú: </strong> <a href="' . base_url() . 'index.php/System/revisor" style="color: #000080;">Revisor</a>  / <a href="' . base_url() . 'index.php/System/revisor" style="color: #000080;">Revisor</a>  / <a href="' . base_url() . 'index.php/System/autor" style="color: #000080;">Autor</a></p>';
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
                    <!--<li>
                        <a href="#">
                            <i class="i-medium i-circled i-bordered icon-thumbs-up2 nomargin"></i>

                            <div class="he-text">
                                <?php echo lang('HE_configuraciones'); ?>
                                <span><?php echo lang('HE_generales'); ?></span>
                            </div>
                        </a>
                    </li>
                    -->
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
                                <?php echo lang('HE_cerrar sesion'); ?>
                                <span><?php echo lang('HE_adios'); ?></span>
                            </div>
                        </a>
                    </li>
                    <!--
                    <li>
                        <i class="i-medium i-circled i-bordered icon-undo nomargin"></i>
                        <div class="he-text">
                            Anexo
                            <span>Anexo</span>
                        </div>
                    </li>
                    -->
                </ul>

            </div>

            <div id="header-wrap">
                <nav id="primary-menu" class="style-2">
                    <div class="container clearfix" style="background-color: #F2F2F2">
                        <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>index.php/System/editor"><div> <?php echo lang('HE_pagina de inicio'); ?> </div></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Home_principal/nosotros"><div> <?php echo lang('HE_sobre nosotros'); ?></div></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Home_principal/politica"><div> <?php echo lang('HE_politica editorial'); ?></div></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Home_principal/numeros"><div> <?php echo lang('HE_numeros publicados'); ?></div></a></li>

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

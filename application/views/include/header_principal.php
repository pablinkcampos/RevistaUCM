<body class="stretched">
    <div class="clearfix">
        <div id="top-bar">
            <div id="google_translate_element"></div>
            <div class="container clearfix">
                <?php $this->load->view('include/selector_idioma');?>
            </div>
        </div>

        <header id="header" class="sticky-style-2">
            <div class="container clearfix">
                <div id="logo">

                    <img src="<?php echo base_url(); ?>img/logo.png" alt="UCM Logo">
                </div>

                <ul class="header-extras">
                    <li>
                        <?php
                          $consult = $this->Articulo_Model->count_articulos_total_publicados();

                          if ($consult)
                          {
                            $cantidad_articulos = $consult->total;
                            if ($cantidad_articulos > 0)
                            {
                              echo '
                              <a href="'.base_url().'index.php/home_principal/buscar">
                                  <i class="i-medium i-circled i-bordered icon-thumbs-up2 nomargin"></i>

                                  <div class="he-text"> '.lang('HP_buscar') .'
                                      <span> '. lang('HP_articulos'). '</span>
                                  </div>
                              </a>';
                            }
                          }



                         ?>

                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/articulo_autor/login_articulo">
                            <i class="i-medium i-circled i-bordered icon-thumbs-up2 nomargin"></i>

                            <div class="he-text">
                                Consultar
                                <span>Mi artículo</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/articulo_autor/art">
                            <i class="i-medium i-circled i-bordered icon-thumbs-up2 nomargin"></i>

                            <div class="he-text">
                                <?php echo lang('HP_envio'); ?>
                                <span><?php echo lang('HP_articulo'); ?></span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/registro_revisor">
                            <i class="i-medium i-circled i-bordered icon-thumbs-up2 nomargin"></i>

                            <div class="he-text">
                                <?php echo lang('HP_cadastro'); ?>
                                <span><?php echo lang('HP_revisor'); ?></span>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>index.php/registro_lector">
                            <i class="i-medium i-circled i-bordered icon-thumbs-up2 nomargin"></i>

                            <div class="he-text">
                                <?php echo lang('HP_registro'); ?>
                                <span><?php echo lang('HP_lector'); ?></span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Login/login">
                            <i class="i-medium i-circled i-bordered icon-truck2 nomargin"></i>

                            <div class="he-text">
                                <?php echo lang('HP_inicia sesion'); ?>
                                
                            </div>
                        </a>
                    </li>
                </ul>

            </div>


            <div id="header-wrap">
                <nav id="primary-menu" class="style-3">
                    <div class="collapse navbar-collapse" style="background-color: #F2F2F2">
                        <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
                        <ul  class="navbar-nav mr-auto">
                            <li class="nav-item active"><a href="<?php echo base_url(); ?>"><div> <?php echo lang('HP_pagina de inicio'); ?> </div></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Home_principal/nosotros"><div> <?php echo lang('HP_sobre nosotros'); ?></div></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Home_principal/politica"><div> <?php echo lang('HP_politica editorial'); ?></div></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Home_principal/numeros"><div> <?php echo lang('HP_Publicación efectiva'); ?></div></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Home_principal/cuerpo_editorial"><div> <?php echo lang('HP_Cuerpo editorial'); ?></div></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Home_principal/plantilla"><div> <?php echo lang('HP_base'); ?></div></a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

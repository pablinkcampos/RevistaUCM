<style type="text/css">
.centrar-imagen {

}

.centrar-imagen img {
    width: 50%; /* Siempre que la resolución de pantalla sea inferior que el ancho de la imagen, ocupará el 100% */
    max-width: 500px; /* Definimos el ancho máximo; el ancho de la imagen original, para evitar que siga ampliándose cuando la resolución de pantalla sea superior a éste */
    height: auto; /* Dejamos que el navegador muestre automáticamente el alto siempre proporcional al ancho de la imagen */
    min-width: 200px;



html,body{
margin:100px;
height:10%;
}
</style>
<style type="text/css">
 
 .modal-backdrop{
     display: none;
 }
 .sidebar{
    
     height: 100%
 }
 i{
     font-size:30px;
 }
</style>

<body class="theme-blue">

  
  <nav class="navbar" >
        <div class="container-fluid" style="margin-top:0px;">
            <div class="navbar-header" style="margin-top:0px; ">
                <div class="row">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="true"></a>
                <a href="javascript:void(0);" class="bars" style="padding-right:40px;"></a>
                </div>
                
                <a href="<?php echo base_url(); ?>index.php">

                <img src="<?php echo base_url(); ?>img/logo.png" alt="UCM Logo" height="50px" style="padding-left:40px; ">
                </a>
            </div>
          
               
                        <?php
                          $consult = $this->Articulo_Model->count_articulos_total_publicados();

                          if ($consult)
                          {
                            $cantidad_articulos = ($consult->total);
                            
                          }
                         ?>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="<?php echo base_url(); ?>index.php/home_principal/buscar" data-toggle="tooltip" data-placement="bottom" title="Buscar artículo"><i class="material-icons">search</i> <span class="label-count"><?php echo $cantidad_articulos ?></span></a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/articulo_autor/login_articulo" data-toggle="tooltip" data-placement="bottom" title="Consultar mi artículo"><i class="material-icons">assignment_ind</i> </a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/articulo_autor/art" data-toggle="tooltip" data-placement="bottom" title="Ingresar artículo"><i class="material-icons">note_add</i> </a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/registro_revisor" data-toggle="tooltip" data-placement="bottom" title="Cadrastro revisor"><i class="material-icons">how_to_reg</i> </a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/registro_lector" data-toggle="tooltip" data-placement="bottom" title="Registro lector"><i class="material-icons">local_library</i> </a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/Login/login" data-toggle="tooltip" data-placement="bottom" title="Iniciar sesión"><i class="material-icons">person</i> </a></li>
                    <!-- #END# Call Search -->
                
    
                  
                </ul>
            </div>
            <?php $titulo = $this->Articulo_Model->obtener_contenido("titulo_revista");  ?>
            <b   style="font-size:14px; color:white" ><?php echo $titulo->texto; ?></b>
            <ol class="breadcrumb breadcrumb-bg-cyan align-center">
                    <li><a href="<?php echo base_url(); ?>"><i class="material-icons">home</i> Home</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/Home_principal/nosotros"><i class="material-icons">library_books</i>Nosotros</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/Home_principal/politica"><i class="material-icons">library_books</i>Politica editorial</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/Home_principal/numeros"><i class="material-icons">library_books</i>Publicacion efectiva</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/Home_principal/cuerpo_editorial"><i class="material-icons">library_books</i>Cuerpo editorial</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/Home_principal/guia_autor"><i class="material-icons">library_books</i>Guía autor</a></li>            
            </ol>
            
        </div>
       
    </nav>
  
    <!-- #Top Bar -->

     

 

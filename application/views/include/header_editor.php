<style type="text/css">
.centrar-imagen {
    margin-top:0px;
}

.centrar-imagen img {
    width: 53%; /* Siempre que la resolución de pantalla sea inferior que el ancho de la imagen, ocupará el 100% */
    max-width: 500px; /* Definimos el ancho máximo; el ancho de la imagen original, para evitar que siga ampliándose cuando la resolución de pantalla sea superior a éste */
    height: 100px; /* Dejamos que el navegador muestre automáticamente el alto siempre proporcional al ancho de la imagen */
    min-width: 200px;
    margin-top:0px;


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

<body class="theme-blue theme-blue ls-closed">

  
    <nav class="navbar" >
        <div class="container-fluid" style="margin-top:0px; ">
            <div class="navbar-header" style="margin-top:0px;">
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
                            $cantidad_articulos = ($consult->total)+1;
                          }
                         ?>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
    
                    
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
                    <li><a href="<?php echo base_url(); ?>index.php/Home_principal/guia_editor"><i class="material-icons">library_books</i>Guía Editor</a></li>            
            </ol>
            
        </div>
       
    </nav>


    

     
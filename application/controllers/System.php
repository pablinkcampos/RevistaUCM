<?php

 defined('BASEPATH') OR exit('No direct script access allowed');

 class System extends MY_Controller {

     function __construct() {
         parent::__construct();
         $this->load->model('Articulo_Model');
         $this->load->model('Configuracion_Model');
         $this->load->model('Model_for_login');
         $this->load->library('grocery_CRUD');
     }

     public function cambiar_lang() {
         $res = $this->cambiar_lenguaje_core();
         die(json_encode($res));
     }

     public function dar_alta_revisor() {
       $this->load->view('include/head');
       $this->load->view('include/header_editor');
       $this->load->view('view_dar_alta_revisor');
       $this->load->view('include/footer');
     }

     public function cambiar_configuracion() {
        $data["datos"]=$this->Configuracion_Model->consulta_ultima_configuracion();
        $this->load->view('include/head');
        $this->load->view('include/header_editor');
        $this->load->view('view_configuracion',$data);
        $this->load->view('include/footer');
     }
     //agregar configuracion parametros
     public function agregar_configuracion() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            if (isset($_POST['go'])) {
                $form['max_dia_asig_art'] = $this->input->post('max_dia_asig_art');
                $form['max_revi_art'] = $this->input->post('max_revi_art');
                $form['max_dia_res_art'] = $this->input->post('max_dia_res_art');
                $form['max_dia_edi_rev_art'] = $this->input->post('max_dia_edi_rev_art');
                $form['max_dia_reev_art'] = $this->input->post('max_dia_reev_art');

                if ($this->Configuracion_Model->insert_configuracion($form) == true) {
                    $aviso = array('title' => '¡configuración creada!',
                    'text' => 'Ha creado una nueva configuración del sistema',
                    'tipoaviso' => 'success',
                    'windowlocation' => base_url() . "index.php/"
                );
                $this->load->view('include/aviso', $aviso);
                $this->load->view('include/footer_esencial');
                } else {
                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function () { swal("Opsss... ocurrio un error","","error");';
                    echo '}, 350);</script>';
                    $this->load->view('include/head');
                    $this->load->view('include/header_editor');
                    $this->load->view('view_home_editor');
                    $this->load->view('include/footer');
                }
                    
            } else {
                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function () { swal("problema al enviar informacion","warning");';
                    echo '}, 350);</script>';

                    $this->load->view('include/head');
                    $this->load->view('include/header_editor');
                    $this->load->view('view_newm');
                    $this->load->view('include/footer');
            }
        }    
        else {
            $aviso = array('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    
    }
    //modificar articulo.
     public function mod_articulo($id_articulo){
        $data["campo"] = $this->Articulo_Model->campos_investigacion();
        $data["datos"] = $this->Articulo_Model->articulo($id_articulo);

        $this->form_validation->set_rules('titulo_revista', 'Título Artículo', 'required');
        $this->form_validation->set_rules('palabras_claves', 'Palabras Claves', 'required');
        $this->form_validation->set_rules('abstract', 'Abstract', 'required');
        $this->form_validation->set_rules('autor_1', 'Autor artículo', 'required');


        $this->form_validation->set_message('required', lang("fv_debes ingresar el campo"));

        if ($this->form_validation->run() == FALSE) {
          $var_test = $this->input->post('titulo_revista');
          if (isset($var_test)) {

             $title2 = json_encode(lang('tswal_datos incorrectos'), JSON_HEX_TAG);
             $text2 = json_encode(lang('cswal_ingrese todos los campos en el formato requerido'), JSON_HEX_TAG);
             echo
                 "<script type='text/javascript'>
                 setTimeout(function () {
                   var title = {$title2};
                   var text = {$text2};
                   swal(title,text, 'warning');
                 }, 350);
                 </script>";
          }
          $this->load->view('include/head');
          $this->load->view('include/header_autor');
          $this->load->view('articulo/view_mod_articulo', $data);
          $this->load->view('include/footer');
        }
        else
        {
          if ($this->input->server('REQUEST_METHOD') == 'POST') {
              $titulo_revista = $this->input->post('titulo_revista');
              $area_aplicable = $this->input->post('area_aplicable');
              $palabras_claves =$this->input->post('palabras_claves');
              $abstract =$this->input->post('abstract');

              $autor_1 =$this->input->post('autor_1');
              $autor_2 =$this->input->post('autor_2');
              $autor_3 =$this->input->post('autor_3');
              $autor_4 =$this->input->post('autor_4');

              $comentarios =$this->input->post('comentarios');
              $datos = array(
                  "ID" => $id_articulo,
                  "titulo_revista" => $titulo_revista,
                  "id_campo" => $area_aplicable,
                  "palabras_claves" => $palabras_claves,
                  "abstract" => $abstract,
                  "autor_1" => $autor_1,
                  "autor_2" => $autor_2,
                  "autor_3" => $autor_3,
                  "autor_4" => $autor_4,
                  "comentarios" => $comentarios
                  );
              if($this->Articulo_Model->actualizar_articulo($datos)){
                  $this->Articulo_Model->incrementar_version($id_articulo);
                  $aviso =array ('title' => "Modificación realizada",
                            'text' => "Su artículo ha sido modificado exitosamente",
                            'tipoaviso'=>'success',
                            'windowlocation'=> base_url()."index.php/System/autor"
                            );
                          $this->load->view('include/aviso',$aviso);
              }else{
                  $aviso =array ('title' => "No hubieron cambios",
                            'text' => "Su artículo no ha sido modificado",
                            'tipoaviso'=>'warning',
                            'windowlocation'=> base_url()."index.php/System/autor"
                            );
                          $this->load->view('include/aviso',$aviso);
              }
          }else{
              $this->load->view('include/head');
               $this->load->view('include/header_autor');
               $this->load->view('articulo/view_mod_articulo',$data);
               $this->load->view('include/footer');
          }
        }

     }

     public function revisor() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '2' || $user_data['id_rol2'] == '2' || $user_data['id_rol3'] == '2') {

            //  $this->Articulo_Model->actualizar_articulos_timeout__aceptado_y_sin_modificar_opcional();
            //  $this->Articulo_Model->actualizar_articulos_timeout__aceptado_con_comentarios_y_sin_modificar_obligatorio();

             $this->load->view('include/head');
             $this->load->view('include/header_revisor');
             $this->load->view('view_home_revisor');
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function autor() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '3' || $user_data['id_rol2'] == '3' || $user_data['id_rol3'] == '3') {
             //$user_data = $this->session->userdata('userdata');
             $this->Articulo_Model->actualizar_articulos_timeout__aceptado_y_sin_modificar_opcional();
             $this->Articulo_Model->actualizar_articulos_timeout__aceptado_con_comentarios_y_sin_modificar_obligatorio();

             $this->load->view('include/head');
             $this->load->view('include/header_autor');
             $this->load->view('view_home_autor');
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function editor() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             //$user_data = $this->session->userdata('userdata');
             $this->Articulo_Model->actualizar_articulos_timeout__aceptado_y_sin_modificar_opcional();
             $this->Articulo_Model->actualizar_articulos_timeout__aceptado_con_comentarios_y_sin_modificar_obligatorio();

             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $this->load->view('view_home_editor');
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function editor_cambia_imagen() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {

             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $this->load->view('view_cambiar_imagenes');
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function editor_cambia_titulo() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {

            $this->load->view('include/head');
            $this->load->view('include/header_editor');
            $data["texto"] = $this->Articulo_Model->obtener_contenido("titulo_revista");
            $this->load->view('view_modificar_titulo', $data);
            $this->load->view('include/footer');
        } else {
            $aviso = array('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }

     public function editor_cambia_mensaje_a() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $this->load->view('include/head');
            $this->load->view('include/header_editor');
            $data["texto"] = $this->Articulo_Model->obtener_contenido("mensaje aceptacion");
            $this->load->view('view_modificar_mensaje_aceptacion', $data);
            $this->load->view('include/footer');
        } else {
            $aviso = array('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }

    public function editor_cambia_mensaje_ac() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $this->load->view('include/head');
            $this->load->view('include/header_editor');
            $data["texto"] = $this->Articulo_Model->obtener_contenido("mensaje aceptado com");
            $this->load->view('view_modificar_mensaje_aceptacion_com', $data);
            $this->load->view('include/footer');
        } else {
            $aviso = array('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }

    public function editor_cambia_datos_r() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $this->load->view('include/head');
            $this->load->view('include/header_editor');
            $data["editor"] = $this->Articulo_Model->obtener_contenido("editor");
            $data["coeditor"] = $this->Articulo_Model->obtener_contenido("coeditor");
            $data["comite_editor"] = $this->Articulo_Model->obtener_contenido("comite editor");
            $data["comite_editor_asesor"] = $this->Articulo_Model->obtener_contenido("comite editor asesor");
            $data["produccion_editorial"] = $this->Articulo_Model->obtener_contenido("produccion editorial");
            $this->load->view('view_modificar_datos_revista', $data);
            $this->load->view('include/footer');
        } else {
            $aviso = array('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }


    public function editor_cambia_mensaje_r() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $this->load->view('include/head');
            $this->load->view('include/header_editor');
            $data["texto"] = $this->Articulo_Model->obtener_contenido("mensaje recepcion");
            $this->load->view('view_modificar_mensaje_recepcion', $data);
            $this->load->view('include/footer');
        } else {
            $aviso = array('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }

    public function editor_cambia_mensaje_re() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $this->load->view('include/head');
            $this->load->view('include/header_editor');
            $data["texto"] = $this->Articulo_Model->obtener_contenido("mensaje rechazo");
            $this->load->view('view_modificar_mensaje_rechazo', $data);
            $this->load->view('include/footer');
        } else {
            $aviso = array('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }

    public function editor_cambia_mensaje_as() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $this->load->view('include/head');
            $this->load->view('include/header_editor');
            $data["texto"] = $this->Articulo_Model->obtener_contenido("mensaje asignado");
            $this->load->view('view_modificar_mensaje_asignado', $data);
            $this->load->view('include/footer');
        } else {
            $aviso = array('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }

    public function editor_cambia_mensaje_p() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $this->load->view('include/head');
            $this->load->view('include/header_editor');
            $data["texto"] = $this->Articulo_Model->obtener_contenido("mensaje publicacion");
            $this->load->view('view_modificar_mensaje_publicacion', $data);
            $this->load->view('include/footer');
        } else {
            $aviso = array('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }
     public function insert_logo() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             if (isset($_POST['logo-form-submit'])) {
                 $formatos = array('.jpg', '.jpeg', '.png', '.tiff', '.JPG', '.JPEG', '.PNG', '.TIFF');
                 $nombrearchivo = $_FILES['file_logo']['name'];
                 $ext = '.' . pathinfo($nombrearchivo, PATHINFO_EXTENSION);
                 $nombretemparchivo = $_FILES['file_logo']['tmp_name'];
                 if (in_array($ext, $formatos)) {
                     if (move_uploaded_file($nombretemparchivo, "img/logo.png") == true) {
                        $path ="img/logo.png";
                        $resize = array(717, 150);
                        $img_size = getimagesize($path);
                        $lienzo = imagecreatetruecolor( $resize[0], $resize[1]);//Crea el fondo donde se colocará la imagen
                        imagealphablending($lienzo, false);
                        imagesavealpha($lienzo,true);
                        $func_images = array(
                            '.jpeg' => array('imagecreatefromjpeg', 'imagejpeg'),
                            '.jpg' => array('imagecreatefromjpeg', 'imagejpeg'),
                            '.png' => array('imagecreatefrompng', 'imagepng'),
                            '.gif' => array('imagecreatefromgif', 'imagegif')
                        );

                        $img = call_user_func($func_images[$ext][0], $path);
                        $transparent = imagecolorallocatealpha($lienzo, 255, 255, 255, 127);
                        imagefilledrectangle($lienzo, 0, 0, $resize[0], $resize[1], $transparent);
                        imagecopyresampled($lienzo, $img, 0, 0, 0, 0, $resize[0], $resize[1],$img_size[0], $img_size[1]);//Copia y cambia el tamaño de parte de una imagen redimensionándola
                
                        call_user_func($func_images[$ext][1], $lienzo, $path);

                        $aviso = array('title' => '¡Logo cambiado!',
                            'text' => 'Hecho.',
                            'tipoaviso' => 'success',
                            'windowlocation' => base_url() . "index.php/System/editor"
                        );
                        $this->load->view('include/aviso', $aviso);
                        $this->load->view('include/footer_esencial');
                     } else {
                        $aviso = array('title' => '¡Opsss... Algo salió mal!',
                            'text' => 'No se puedo cambiar el logo.',
                            'tipoaviso' => 'success',
                            'windowlocation' => base_url() . "index.php/System/editor"
                        );
                        $this->load->view('include/aviso', $aviso);
                        $this->load->view('include/footer_esencial');
                     }
                 } else {
                     echo '<script type="text/javascript">';
                     echo 'setTimeout(function () { swal("Formato no Admitido","Formatos aceptados: Jpeg, Png, Jpg y Tiff","warning");';
                     echo '}, 350);</script>';

                     $this->load->view('include/head');
                     $this->load->view('include/header_editor');
                     $this->load->view('view_cambiar_imagenes');
                     $this->load->view('include/footer');
                 }
             }
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function insert_imagen_revista() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             if (isset($_POST['revista-form-submit'])) {
                 $formatos = array('.jpg', '.jpeg', '.png', '.tiff', '.JPG', '.JPEG', '.PNG', '.TIFF');
                 $nombrearchivo = $_FILES['file_revista']['name'];
                 $ext = '.' . pathinfo($nombrearchivo, PATHINFO_EXTENSION);
                 $nombretemparchivo = $_FILES['file_revista']['tmp_name'];
                 if (in_array($ext, $formatos)) {
                     if (move_uploaded_file($nombretemparchivo, "img/revista.jpg") == true) {
                         echo '<script type="text/javascript">';
                         echo 'setTimeout(function () { swal("Imagen cambiada","","success");';
                         echo '}, 350);</script>';

                         $this->load->view('include/head');
                         $this->load->view('include/header_editor');
                         $this->load->view('view_home_editor');
                         $this->load->view('include/footer');
                     } else {
                         echo '<script type="text/javascript">';
                         echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta mas tarde. De persistir favor contactarnos.","error");';
                         echo '}, 350);</script>';

                         $this->load->view('include/head');
                         $this->load->view('include/header_editor');
                         $this->load->view('view_home_editor');
                         $this->load->view('include/footer');
                     }
                 } else {
                     echo '<script type="text/javascript">';
                     echo 'setTimeout(function () { swal("Formato no Admitido","Formatos aceptados: Jpeg, Png, Jpg y Tiff","warning");';
                     echo '}, 350);</script>';

                     $this->load->view('include/head');
                     $this->load->view('include/header_editor');
                     $this->load->view('view_cambiar_imagenes');
                     $this->load->view('include/footer');
                 }
             }
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function editor_nueva_revista() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             $data['articulos'] = $this->Articulo_Model->obtener_articulos_edicion();

             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $this->load->view('view_nueva_revista', $data);
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }
     
     public function editor_crud_campos(){


        $this->load->view('include/head');
        $this->load->view('include/header_editor');
        $this->load->view('view_areas');
        $this->load->view('include/footer');

     }
     public function editor_crud_temas(){
        $data["campo"] = $this->Articulo_Model->campos_investigacion();
        $this->load->view('include/head');
        $this->load->view('include/header_editor');
        $this->load->view('view_temas',$data);
        $this->load->view('include/footer');

     }
     public function editor_contenido() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $this->load->view('view_home_editor');
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function editor_modificar_sobre_nosotros() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $data["texto"] = $this->Articulo_Model->obtener_contenido("nosotros");
             $this->load->view('view_modificar_sobre_nosotros', $data);
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function editor_modificar_politica_editorial() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $data["texto"] = $this->Articulo_Model->obtener_contenido("politicas");
             $this->load->view('view_modificar_politica_editorial', $data);
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function editor_modificar_numeros_publicados() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $this->load->view('view_modificar_numeros_publicaciones');
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function editor_success() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             $form_datos['ID_articulo'] = $this->input->post('articulo_id');
             $form_datos['titulo'] = $this->input->post('titulos');
             $form_dat['id_estado'] = 12;

             if ($this->Articulo_Model->solicitar_paginacion($form_datos) == true) {
                 if ($this->Articulo_Model->actualizar_a_respondiendo($form_dat, $form_datos['ID_articulo']) == true) {
                     echo '<script type="text/javascript">';
                     echo 'setTimeout(function () { swal("Solicitud enviada","Le informaremos al autor que debe paginar su artículo.","success");';
                     echo '}, 350);</script>';

                     $this->load->view('include/head');
                     $this->load->view('include/header_editor');
                     $this->load->view('view_home_editor');
                     $this->load->view('include/footer');
                 } else {
                     echo '<script type="text/javascript">';
                     echo 'setTimeout(function () { swal("Opsss... Algo salió mal","Algo dejó de funcionar, intente mas tarde.","error");';
                     echo '}, 350);</script>';

                     $this->load->view('include/head');
                     $this->load->view('include/header_editor');
                     $this->load->view('view_home_editor');
                     $this->load->view('include/footer');

                     //eliminacion de tupla insertada anteriormente
                     $this->Articulo_Model->eliminar_paginacion_fallo($form_datos['ID_articulo'], $form_datos['titulo']);
                 }
             } else {
                 echo '<script type="text/javascript">';
                 echo 'setTimeout(function () { swal("Opsss... Algo salió mal","Algo dejo de funcionar, intente mas tarde.","error");';
                 echo '}, 350);</script>';

                 $this->load->view('include/head');
                 $this->load->view('include/header_editor');
                 $this->load->view('view_home_editor');
                 $this->load->view('include/footer');
             }
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function editor_mail() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {

             $correo = $this->input->post('email_autors');
             $id_articulo = $this->input->post('articulo_id');
             $form['id_estado'] = 12;
             $this->Articulo_Model->actualizar_a_respondiendo($form, $id_articulo);
             $subject = "Articulo seleccionado para revista";
             $mensaje = '<html>' .
                     '<body><h4>Su artículo ha sido seleccionado para pertenerccer a la revista de publicaciones UCM. Se le solicita ingrese a la plataforma para completar el proceso.</h4><br>' .
                     '</body>' .
                     '</html>';
             $mensaje.= "<b>Enviado desde wwww.publicacionesucm.cl</b><br>";
             $headers = "From: avisos@mPublicacionesucm.cl \r\n";
             $headers.= 'Bcc: moises.intech@gmail.com' . "\r\n";
             $headers.= 'Content-type: text/html; charset=utf-8' . "\r\n";

             if (mail($correo, $subject, $mensaje, $headers)) {
                 echo '<script type="text/javascript">';
                 echo 'setTimeout(function () { swal("Comentario enviado","Se ha enviado su comentario a al correo del autor","success");';
                 echo '}, 350);</script>';

                 $this->load->view('include/head');
                 $this->load->view('include/header_editor');
                 $this->load->view('view_home_editor');
                 $this->load->view('include/footer');
             } else {
                 echo '<script type="text/javascript">';
                 echo 'setTimeout(function () { swal("Opsss... Algo dejó de funcionar","No se pudo enviar el comentario al autor, intente más tarde.","error");';
                 echo '}, 350);</script>';

                 $this->load->view('include/head');
                 $this->load->view('include/header_editor');
                 $this->load->view('view_home_editor');
                 $this->load->view('include/footer');
             }
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     function editor_publicar() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             $form_datos['ID_articulo'] = $this->input->post('articulo_id');
             $correo = $this->input->post('email_autors');

             $form_dat['id_estado'] = 8;

             if ($this->Articulo_Model->actualizar_a_publicado($form_dat, $form_datos['ID_articulo']) == true) {
                $mensaje_publicado = $this->Articulo_Model->obtener_contenido("mensaje publicacion");
                $msj=$mensaje_publicado->texto;
                 $subject = "Articulo publicado en revista UCM";
                 $mensaje = '<html>' .
                         '<body><h4>'.$msj.'</h4><br>' .
                         '</body>' .
                         '</html>';
                 $mensaje.= "<b>Enviado desde wwww.publicacionesucm.cl</b><br>";
                 $headers = "From: avisos@mPublicacionesucm.cl \r\n";
                 $headers.= 'Bcc: autorucm@gmail.com' . "\r\n";
                 $headers.= 'Content-type: text/html; charset=utf-8' . "\r\n";

                 if (mail($correo, $subject, $mensaje, $headers)) {
                    $correos = $this->Articulo_Model->obtener_email_lector($form_datos['ID_articulo']);
                    $i=0;
                    $correo='';
                    foreach($correos as $co){
                        if($i==0){
                            $correo = $co->email;
                        }
                        else{
                            $correo = $correo.','.$co->email;
                        }
                        $i++;

                    }
                    $subject = "Articulo publicado en revista UCM";
                    $mensaje = '<html>' .
                         '<body><h4>Se ha publicado un artículo en la revista de tu interes, por favor revisa la página.</h4><br>' .
                         '</body>' .
                         '</html>';
                    $mensaje.= "<b>Enviado desde wwww.publicacionesucm.cl</b><br>";
                    $headers = "From: avisos@mPublicacionesucm.cl \r\n";
                    $headers.= 'Bcc: autorucm@gmail.com' . "\r\n";
                    $headers.= 'Content-type: text/html; charset=utf-8' . "\r\n";
                    mail($correo, $subject, $mensaje, $headers);
                     echo '<script type="text/javascript">';
                     echo 'setTimeout(function () { swal("Articulo publicado","Se ha agregado el artículo a la revista.","success");';
                     echo '}, 350);</script>';

                     $this->load->view('include/head');
                     $this->load->view('include/header_editor');
                     $this->load->view('view_home_editor');
                     $this->load->view('include/footer');
                 } else {
                     echo '<script type="text/javascript">';
                     echo 'setTimeout(function () { swal("Articulo Publicado","Se ha agregado el artículo a la revista, pero no se envió el mail de aviso al autor.","info");';
                     echo '}, 350);</script>';

                     $this->load->view('include/head');
                     $this->load->view('include/header_editor');
                     $this->load->view('view_home_editor');
                     $this->load->view('include/footer');
                 }
             } else {
                 echo '<script type="text/javascript">';
                 echo 'setTimeout(function () { swal("Opsss... Algo salió mal","Algo dejo de funcionar, intente mas tarde.","error");';
                 echo '}, 350);</script>';

                 $this->load->view('include/head');
                 $this->load->view('include/header_editor');
                 $this->load->view('view_home_editor');
                 $this->load->view('include/footer');
             }
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function editor_magazine() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $this->load->view('view_revistas');
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function editar() {
         $id_revista = $this->input->get('revista');
         $data['id_revista'] = $id_revista;

         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $this->load->view('view_editar_revista', $data);
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function newm() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $this->load->view('view_newm');
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function insert_revista() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             if (isset($_POST['go'])) {
                 $formatos = array('.jpg', '.jpeg', '.png', '.tiff', '.JPG', '.JPEG', '.PNG', '.TIFF');
                 $nombrearchivo = $_FILES['image_revista']['name'];
                 $ext = '.' . pathinfo($nombrearchivo, PATHINFO_EXTENSION);
                 $nombretemparchivo = $_FILES['image_revista']['tmp_name'];
                 if (in_array($ext, $formatos)) {
                     if (move_uploaded_file($nombretemparchivo, "img/logo.png") == true) {
                         $form['titulo_revista'] = $this->input->post('t_rev');
                         $f_t=$this->input->post('f_rev');
                         $date = new DateTime($f_t);
                         $fecha_p = date_format($date, ("Y-m-d")); 
                         $form['fecha_publicacion'] = $fecha_p;
                         $form['logo_revista'] = $name_rev;

                         if ($this->Articulo_Model->in_rev($form) == true) {
                            $aviso = array('title' => '¡Revista creada!',
                                'text' => 'Ha creado una revista',
                                'tipoaviso' => 'success',
                                'windowlocation' => base_url() . "index.php/System/editor_magazine"
                            );
                            $this->load->view('include/aviso', $aviso);
                            $this->load->view('include/footer_esencial');
                         } else {
                             echo '<script type="text/javascript">';
                             echo 'setTimeout(function () { swal("Opsss... ocurrio un error","","error");';
                             echo '}, 350);</script>';
                             $this->load->view('include/head');
                             $this->load->view('include/header_editor');
                             $this->load->view('view_home_editor');
                             $this->load->view('include/footer');
                         }
                     } else {
                         echo '<script type="text/javascript">';
                         echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta mas tarde. De persistir favor contactarnos.","error");';
                         echo '}, 350);</script>';

                         $this->load->view('include/head');
                         $this->load->view('include/header_editor');
                         $this->load->view('view_home_editor');
                         $this->load->view('include/footer');
                     }
                 } else {
                     echo '<script type="text/javascript">';
                     echo 'setTimeout(function () { swal("Formato no Admitido","Formatos aceptados: Jpeg, Png, Jpg y Tiff","warning");';
                     echo '}, 350);</script>';

                     $this->load->view('include/head');
                     $this->load->view('include/header_editor');
                     $this->load->view('view_newm');
                     $this->load->view('include/footer');
                 }
             }
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function editor_cambia_plantilla() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {

             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $this->load->view('view_cambiar_plantilla');
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function insert_base() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             if (isset($_POST['base-form-submit'])) {
                 $formatos = array('.pdf', '.PDF');
                 $nombrearchivo = $_FILES['file_base']['name'];
                 $ext = '.' . pathinfo($nombrearchivo, PATHINFO_EXTENSION);
                 $nombretemparchivo = $_FILES['file_base']['tmp_name'];
                 if (in_array($ext, $formatos)) {
                     if (move_uploaded_file($nombretemparchivo, "uploads/base.pdf") == true) {
                        $aviso = array('title' => '¡Estructura base cambiada!',
                            'text' => 'Ha cambiado la estructura base disponible para los autores.',
                            'tipoaviso' => 'success',
                            'windowlocation' => base_url() . "index.php/System/editor"
                        );
                        $this->load->view('include/aviso', $aviso);
                        $this->load->view('include/footer_esencial');
                     } else {
                         echo '<script type="text/javascript">';
                         echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta mas tarde. De persistir favor contactarnos.","error");';
                         echo '}, 350);</script>';

                         $this->load->view('include/head');
                         $this->load->view('include/header_editor');
                         $this->load->view('view_home_editor');
                         $this->load->view('include/footer');
                     }
                 } else {
                     echo '<script type="text/javascript">';
                     echo 'setTimeout(function () { swal("Formato no Admitido","Formatos aceptado: PDF","warning");';
                     echo '}, 350);</script>';

                     $this->load->view('include/head');
                     $this->load->view('include/header_editor');
                     $this->load->view('view_cambiar_plantilla');
                     $this->load->view('include/footer');
                 }
             }
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function articulos_por_convertir() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {

             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $this->load->view('view_por_convertir');
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function articulos_convertidos() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {

             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $this->load->view('view_listos_add');
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function editor_pagina() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {

             $id = $this->input->post('articulo_id');

             $data['articulo_id'] = $id;
             $this->load->view('include/head');
             $this->load->view('include/header_editor');
             $this->load->view('view_a_publicar', $data);
             $this->load->view('include/footer');
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }
     //creacion de una nueva revista.
     public function nueva_revista() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {

             if (isset($_POST['go'])) {
                 $formatos = array('.jpg', '.png', '.JPG', '.PNG');
                 $ran = rand(10000, 99999);
                 $nombrearchivo = $_FILES['file_rev']['name'];
                 $ext = '.' . pathinfo($nombrearchivo, PATHINFO_EXTENSION);
                 $nombretemparchivo = $_FILES['file_rev']['tmp_name'];
                 $nombrearchivos = preg_replace('[^ A-Za-z0-9_-ñÑ]', '', $nombrearchivo);
                 $nombrearchivos = str_replace(' ', '', $nombrearchivos);
                 $nombrearchivos.=$ext;
                 $ran.=$nombrearchivos;

                 if (in_array($ext, $formatos)) {
                     if (move_uploaded_file($nombretemparchivo, "img/$ran") == true) {

                         $form_rev['titulo_revista'] = $this->input->post('t_rev');
                         $form_rev['fecha_publicacion'] = $this->input->post('f_rev');
                         $form_rev['logo_revista'] = $ran;
                         $form_rev['palabras_editor'] = $this->input->post('p_edit');

                         if ($this->Articulo_Model->in_rev($form_rev) == true) {

                            $id_rev = $this->Articulo_Model->get_id_rev($form_rev['titulo_revista'], $form_rev['fecha_publicacion'], $form_rev['palabras_editor']);
                            $id = $id_rev->ID;

                            if (isset($_POST['art'])) {
                                foreach ($_POST['art'] as $value) {

                                    $foorm['ID_magazine'] = $id;
                                    $id_revista = $this->Articulo_Model->get_id_revista_final($value);
                                    $frm['id_estado'] = 8;
                                    $arty = $id_revista->ID_articulo;
                                    $this->Articulo_Model->actualizar_a_publicado($frm, $arty);
                                    $this->Articulo_Model->up_art($value, $foorm);
                                }
                            }
                                $aviso = array('title' => '¡Revista creada y publicada!',
                                    'text' => 'Ha creado y publicado una nueva revista',
                                    'tipoaviso' => 'success',
                                    'windowlocation' => base_url() . "index.php/System/editor"
                                );
                                $this->load->view('include/aviso', $aviso);
                                $this->load->view('include/footer_esencial');
                         } else {
                             echo '<script type="text/javascript">';
                             echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta más tarde.","error");';
                             echo '}, 350);</script>';

                             $this->load->view('include/head');
                             $this->load->view('include/header_editor');
                             $this->load->view('view_home_editor');
                             $this->load->view('include/footer');
                         }
                     } else {
                         echo '<script type="text/javascript">';
                         echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta más tarde.","error");';
                         echo '}, 350);</script>';

                         $this->load->view('include/head');
                         $this->load->view('include/header_editor');
                         $this->load->view('view_home_editor');
                         $this->load->view('include/footer');
                     }
                 } else {
                     echo '<script type="text/javascript">';
                     echo 'setTimeout(function () { swal("Formato no admitido","Formatos aceptado: JPG - PNG","warning");';
                     echo '}, 350);</script>';

                     $this->load->view('include/head');
                     $this->load->view('include/header_editor');
                     $this->load->view('view_newm');
                     $this->load->view('include/footer');
                 }
             }
         } else {
             $aviso = array('title' => lang("tswal_acceso denegado"),
                 'text' => lang("cswal_acceso denegado"),
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

    public function modifica_nosotros() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             $data['texto_espanol'] = $this->input->post('t_com');
             $nosotros = "nosotros";
                     if ($this->Articulo_Model->upd_contenido($nosotros, $data) == true) {
                        $aviso = array('title' => '¡Información cambiada!',
                            'text' => 'Hecho.',
                            'tipoaviso' => 'success',
                            'windowlocation' => base_url() 
                        );
                        $this->load->view('include/aviso', $aviso);
                        $this->load->view('include/footer_esencial');
                     } else {
                         echo '<script type="text/javascript">';
                         echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta más tarde.","error");';
                         echo '}, 350);</script>';

                         $this->load->view('include/head');
                         $this->load->view('include/header_editor');
                         $this->load->view('view_home_editor');
                         $this->load->view('include/footer');
                     }
         } else {
             $aviso = array('title' => 'Acceso denegado',
                 'text' => 'Acceso denegado',
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() 
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function modifica_titulo() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $data['texto_espanol'] = $this->input->post('t_rev');
            $nosotros = "titulo_revista";
                    if ($this->Articulo_Model->upd_contenido($nosotros, $data) == true) {
                       $aviso = array('title' => '¡Información cambiada!',
                           'text' => 'Hecho.',
                           'tipoaviso' => 'success',
                           'windowlocation' => base_url() 
                       );
                       $this->load->view('include/aviso', $aviso);
                       $this->load->view('include/footer_esencial');
                    } else {
                        echo '<script type="text/javascript">';
                        echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta más tarde.","error");';
                        echo '}, 350);</script>';

                        $this->load->view('include/head');
                        $this->load->view('include/header_editor');
                        $this->load->view('view_home_editor');
                        $this->load->view('include/footer');
                    }
        } else {
            $aviso = array('title' => 'Acceso denegado',
                'text' => 'Acceso denegado',
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }
    public function modifica_politicas() {
         $user_data = $this->session->userdata('userdata');
         if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
             $data['texto_espanol'] = $this->input->post('t_com_2');
             $nosotros = "politicas";
                     if ($this->Articulo_Model->upd_contenido($nosotros, $data) == true) {
                        $aviso = array('title' => '¡Información cambiada!',
                            'text' => 'Hecho.',
                            'tipoaviso' => 'success',
                            'windowlocation' => base_url() 
                        );
                        $this->load->view('include/aviso', $aviso);
                        $this->load->view('include/footer_esencial');
                     } else {
                         echo '<script type="text/javascript">';
                         echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta más tarde.","error");';
                         echo '}, 350);</script>';

                         $this->load->view('include/head');
                         $this->load->view('include/header_editor');
                         $this->load->view('view_home_editor');
                         $this->load->view('include/footer');
                     }
         } else {
             $aviso = array('title' => 'Acceso denegado',
                 'text' => 'Acceso denegado',
                 'tipoaviso' => 'error',
                 'windowlocation' => base_url() . "index.php/"
             );
             $this->load->view('include/aviso', $aviso);
         }
     }

     public function modifica_mensaje_aceptacion() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $data['texto_espanol'] = $this->input->post('ta_ma');
            $nosotros = "mensaje aceptacion";
                    if ($this->Articulo_Model->upd_contenido($nosotros, $data) == true) {
                       $aviso = array('title' => '¡Información cambiada!',
                           'text' => 'Hecho.',
                           'tipoaviso' => 'success',
                           'windowlocation' => base_url()
                       );
                       $this->load->view('include/aviso', $aviso);
                       $this->load->view('include/footer_esencial');
                    } else {
                        echo '<script type="text/javascript">';
                        echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta más tarde.","error");';
                        echo '}, 350);</script>';

                        $this->load->view('include/head');
                        $this->load->view('include/header_editor');
                        $this->load->view('view_home_editor');
                        $this->load->view('include/footer');
                    }
        } else {
            $aviso = array('title' => 'Acceso denegado',
                'text' => 'Acceso denegado',
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }
    public function modifica_mensaje_aceptacion_com() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $data['texto_espanol'] = $this->input->post('ta_ma');
            $nosotros = "mensaje aceptado com";
                    if ($this->Articulo_Model->upd_contenido($nosotros, $data) == true) {
                       $aviso = array('title' => '¡Información cambiada!',
                           'text' => 'Hecho.',
                           'tipoaviso' => 'success',
                           'windowlocation' => base_url() 
                       );
                       $this->load->view('include/aviso', $aviso);
                       $this->load->view('include/footer_esencial');
                    } else {
                        echo '<script type="text/javascript">';
                        echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta más tarde.","error");';
                        echo '}, 350);</script>';

                        $this->load->view('include/head');
                        $this->load->view('include/header_editor');
                        $this->load->view('view_home_editor');
                        $this->load->view('include/footer');
                    }
        } else {
            $aviso = array('title' => 'Acceso denegado',
                'text' => 'Acceso denegado',
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }

    public function modifica_mensaje_rechazo() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $data['texto_espanol'] = $this->input->post('ta_mr');
            $nosotros = "mensaje rechazo";
                    if ($this->Articulo_Model->upd_contenido($nosotros, $data) == true) {
                       $aviso = array('title' => '¡Información cambiada!',
                           'text' => 'Hecho.',
                           'tipoaviso' => 'success',
                           'windowlocation' => base_url() . "index.php/"
                       );
                       $this->load->view('include/aviso', $aviso);
                       $this->load->view('include/footer_esencial');
                    } else {
                        echo '<script type="text/javascript">';
                        echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta más tarde.","error");';
                        echo '}, 350);</script>';

                        $this->load->view('include/head');
                        $this->load->view('include/header_editor');
                        $this->load->view('view_home_editor');
                        $this->load->view('include/footer');
                    }
        } else {
            $aviso = array('title' => 'Acceso denegado',
                'text' => 'Acceso denegado',
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }

    public function modifica_mensaje_asignacion() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $data['texto_espanol'] = $this->input->post('ta_ma');
            $nosotros = "mensaje asignado";
                    if ($this->Articulo_Model->upd_contenido($nosotros, $data) == true) {
                       $aviso = array('title' => '¡Información cambiada!',
                           'text' => 'Hecho.',
                           'tipoaviso' => 'success',
                           'windowlocation' => base_url() . "index.php/"
                       );
                       $this->load->view('include/aviso', $aviso);
                       $this->load->view('include/footer_esencial');
                    } else {
                        echo '<script type="text/javascript">';
                        echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta más tarde.","error");';
                        echo '}, 350);</script>';

                        $this->load->view('include/head');
                        $this->load->view('include/header_editor');
                        $this->load->view('view_home_editor');
                        $this->load->view('include/footer');
                    }
        } else {
            $aviso = array('title' => 'Acceso denegado',
                'text' => 'Acceso denegado',
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }

    public function modifica_datos_revista() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $data['texto_espanol'] = $this->input->post('ta_e');
            $nosotros = "editor";
            $ok=$this->Articulo_Model->upd_contenido($nosotros, $data);
           
            $data['texto_espanol'] = $this->input->post('ta_ce');
            $nosotros = "coeditor";
            $ok= $this->Articulo_Model->upd_contenido($nosotros, $data);
           

            $data['texto_espanol'] = $this->input->post('ta_cea');
            $nosotros = "comite editor asesor";
            $this->Articulo_Model->upd_contenido($nosotros, $data);
            
            $data['texto_espanol'] = $this->input->post('ta_coe');
            $nosotros = "comite editor";
            $ok=$this->Articulo_Model->upd_contenido($nosotros, $data);
            
            $data['texto_espanol'] = $this->input->post('ta_pe');
            $nosotros = "produccion editorial";
            $ok=$this->Articulo_Model->upd_contenido($nosotros, $data);
            $ok = true;

                    if ($ok == true) {
                       $aviso = array('title' => '¡Información cambiada!',
                           'text' => 'Hecho.',
                           'tipoaviso' => 'success',
                           'windowlocation' => base_url() 
                       );
                       $this->load->view('include/aviso', $aviso);
                       $this->load->view('include/footer_esencial');
                    } else {
                        echo '<script type="text/javascript">';
                        echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta más tarde.","error");';
                        echo '}, 350);</script>';

                        $this->load->view('include/head');
                        $this->load->view('include/header_editor');
                        $this->load->view('view_home_editor');
                        $this->load->view('include/footer');
                    }
        } else {
            $aviso = array('title' => 'Acceso denegado',
                'text' => 'Acceso denegado',
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }

    public function modifica_mensaje_recepcion() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $data['texto_espanol'] = $this->input->post('ta_mr');
            $nosotros = "mensaje recepcion";
                    if ($this->Articulo_Model->upd_contenido($nosotros, $data) == true) {
                       $aviso = array('title' => '¡Información cambiada!',
                           'text' => 'Hecho.',
                           'tipoaviso' => 'success',
                           'windowlocation' => base_url() 
                       );
                       $this->load->view('include/aviso', $aviso);
                       $this->load->view('include/footer_esencial');
                    } else {
                        echo '<script type="text/javascript">';
                        echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta más tarde.","error");';
                        echo '}, 350);</script>';

                        $this->load->view('include/head');
                        $this->load->view('include/header_editor');
                        $this->load->view('view_home_editor');
                        $this->load->view('include/footer');
                    }
        } else {
            $aviso = array('title' => 'Acceso denegado',
                'text' => 'Acceso denegado',
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }


    public function modifica_mensaje_publicacion() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $data['texto_espanol'] = $this->input->post('ta_mp');
            $nosotros = "mensaje publicacion";
                    if ($this->Articulo_Model->upd_contenido($nosotros, $data) == true) {
                       $aviso = array('title' => '¡Información cambiada!',
                           'text' => 'Hecho.',
                           'tipoaviso' => 'success',
                           'windowlocation' => base_url() 
                       );
                       $this->load->view('include/aviso', $aviso);
                       $this->load->view('include/footer_esencial');
                    } else {
                        echo '<script type="text/javascript">';
                        echo 'setTimeout(function () { swal("Opsss... ocurrio un error","Intenta más tarde.","error");';
                        echo '}, 350);</script>';

                        $this->load->view('include/head');
                        $this->load->view('include/header_editor');
                        $this->load->view('view_home_editor');
                        $this->load->view('include/footer');
                    }
        } else {
            $aviso = array('title' => 'Acceso denegado',
                'text' => 'Acceso denegado',
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }
     //editar_revusta
     public function editar_revista() {
       $this->load->view('include/head');
       $this->load->view('include/header_editor');
       $id_revista = $this->input->get('revista');
       $data['id_revista'] = $id_revista;



   
         $formulario['titulo_revista'] = $this->input->post('t_rev');
         $f_t=$this->input->post('f_rev');
         $date = new DateTime($f_t);
         $fecha_p = date_format($date, ("Y-m-d")); 
         $formulario['fecha_publicacion'] = $fecha_p;
         $formulario['palabras_editor'] = $this->input->post('p_edit');
         $formulario['ID'] = $id_revista;

         $resp = $this->Articulo_Model->actualizar_revista($formulario);

         if ($resp)
         {
           echo '<script>
            setTimeout(function() {
              swal({
                title: "Actualización correcta",
                text: "La revista fue editada.",
                type: "success"
              }, function() {
               window.location = "System/editor_magazine";
             });
           }, 400);
           </script>';
           $this->load->view('view_revistas');
           $this->load->view('include/footer');
         }
         else
         {
           echo '<script>
            setTimeout(function() {
              swal({
                title: "No hubieron cambios",
                text: "No fueron modificados los datos de la revista.",
                type: "info"
              }, function() {
               window.location = "System/editor_magazine";
             });
           }, 400);
           </script>';
         }
         $this->load->view('view_editar_revista', $data);
         $this->load->view('include/footer');
       
     }
 }

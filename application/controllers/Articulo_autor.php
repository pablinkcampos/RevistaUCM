<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Articulo_autor extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Articulo_Model');
        $this->load->helper(array('form', 'url'));
        $this->load->helper("file");
        $this->load->helper('text');
        $this->load->library('form_validation');
    }

    public function index() {
        $aviso = array('title' => lang("tswal_acceso denegado"),
            'text' => lang("cswal_acceso denegado"),
            'tipoaviso' => 'error',
            'windowlocation' => base_url() . "index.php/"
        );
        $this->load->view('include/aviso', $aviso);
    }

    //Mis Artículos
    public function mis_articulos() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '3' || $user_data['id_rol2'] == '3' || $user_data['id_rol3'] == '3') {
            $email_autor = $user_data["email_usuario"];
            $data['datos'] = $this->Articulo_Model->mis_articulos($email_autor);

            $this->load->view('include/head');
            $this->load->view('include/header_autor');
            $this->load->view('articulo/view_mis_articulos', $data);
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

    public function mis_articulos_ver($id_revista) {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '3' || $user_data['id_rol2'] == '3' || $user_data['id_rol3'] == '3') {

            $email_autor = $user_data["email_usuario"];
            $data['datos'] = $this->Articulo_Model->articulo($id_revista);

            $this->load->view('include/head');
            $this->load->view('include/header_autor');
            $this->load->view('articulo/view_mis_articulos_ver', $data);
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

    public function mis_articulos_mod_op($id_revista) {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '3' || $user_data['id_rol2'] == '3' || $user_data['id_rol3'] == '3') {

            //------------------
            //Acceso permitido por estado
            $acceso['data'] = $this->Articulo_Model->articulo($id_revista);
            if ($acceso['data']) {
                foreach ($acceso['data']->result() as $row) {
                    $estado_articulo = $row->id_estado;
                    if ($estado_articulo != 5)
                        redirect('index.php/Articulo_autor/mis_articulos');
                }
            }else {
                redirect('index.php/Articulo_autor/mis_articulos');
            }
            //-------------------


            $email_autor = $user_data["email_usuario"];
            $estado = 5;
            $datos = array(
                'ID' => $id_revista,
                'email_autor' => $email_autor,
                'id_estado' => $estado
            );

            $data['datos'] = $this->Articulo_Model->articulos_incluir_mod($datos);
            $data['fecha_actual'] = date('Y-m-d H:i:s');

            if ($this->input->server('REQUEST_METHOD') != 'POST') {
                foreach ($data['datos']->result() as $row) {
                    $archivo_old = $row->archivo;
                }
                $nombre_articulo = $archivo_old;
                $extension = strtolower(substr($nombre_articulo, strpos($nombre_articulo, ".") + 1));
                $data['extension'] = $extension;
                $this->load->view('include/head');
                $this->load->view('include/header_autor');
                $this->load->view('articulo/view_mis_articulos_mod_op', $data);
                $this->load->view('include/footer');
            } else {
                if ($data['datos']) {
                    foreach ($data['datos']->result() as $row) {
                        $archivo_old = $row->archivo;
                        $fecha = $row->fecha_timeout;
                    }
                    $now = date('Y-m-d H:i:s');
                    $nombre_articulo = $archivo_old;
                    $extension = strtolower(substr($nombre_articulo, strpos($nombre_articulo, ".") + 1));

                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = $extension;
                    $config['file_name'] = $nombre_articulo;
                    $config['max_size'] = 5120; //5 mb
                    $config['overwrite'] = TRUE;

                    $this->load->library('upload', $config);
                    $file = $this->upload->do_upload('userfile');

                    if (!$file) {
                        //fecha pasó límite
                        if ($fecha < $now) {
                            $aviso = array('title' => lang("tswal_fecha limite"),
                                'text' => lang("cswal_ha caducado la fecha"),
                                'tipoaviso' => 'error',
                                'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                            );
                            $this->load->view('include/aviso', $aviso);
                        } else {
                            //Error de archivo
                            $aviso = array('title' => lang("tswal_error"),
                                'text' => lang("cswal_archivo no subido"),
                                'tipoaviso' => 'error',
                                'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                            );
                            $this->load->view('include/aviso', $aviso);
                        }
                    } else {
                        //fecha pasó límite
                        if ($fecha < $now) {
                            $aviso = array('title' => lang("tswal_fecha limite"),
                                'text' => lang("cswal_ha caducado la fecha"),
                                'tipoaviso' => 'error',
                                'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                            );
                            $this->load->view('include/aviso', $aviso);
                        } else {
                            //Formulario enviado con éxito
                            $file_data = $this->upload->data();
                            if ($file_data) {
                                $datos_update = array(
                                    'ID' => $id_revista,
                                    'id_estado' => 10
                                );
                                $datos_update = $this->Articulo_Model->actualizar_articulo_estado($datos_update);
                                if ($datos_update) {
                                    $aviso = array('title' => lang("tswal_subido"),
                                        'text' => lang("cswal_archivo subido con exito"),
                                        'tipoaviso' => 'success',
                                        'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                                    );
                                    $this->Articulo_Model->incrementar_version($id_revista);
                                    //Enviar correo electrónico(archivo reemplazado con éxito(modificiones opcionales para usuario))
                                    $this->load->view('include/aviso', $aviso);
                                } else {
                                    $aviso = array('title' => lang("tswal_error"),
                                        'text' => lang("cswal_bd error"),
                                        'tipoaviso' => 'error',
                                        'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                                    );
                                    $this->load->view('include/aviso', $aviso);
                                }
                            } else {
                                //Error de archivo
                                $aviso = array('title' => lang("tswal_error"),
                                    'text' => lang("cswal_articulo no subido"),
                                    'tipoaviso' => 'error',
                                    'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                                );
                                $this->load->view('include/aviso', $aviso);
                            }
                        }
                    }
                } else {
                    $aviso = array('title' => lang("tswal_error"),
                        'text' => lang("cswal_no data"),
                        'tipoaviso' => 'error',
                        'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                    );
                    $this->load->view('include/aviso', $aviso);
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

    public function mis_articulos_mod_ob($id_revista) {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '3' || $user_data['id_rol2'] == '3' || $user_data['id_rol3'] == '3') {



            //------------------
            //Acceso permitido por estado
            $acceso['data'] = $this->Articulo_Model->articulo($id_revista);
            if ($acceso['data']) {
                foreach ($acceso['data']->result() as $row) {
                    $estado_articulo = $row->id_estado;
                    if ($estado_articulo != 6)
                        redirect('index.php/Articulo_autor/mis_articulos');
                }
            }else {
                redirect('index.php/Articulo_autor/mis_articulos');
            }
            //-------------------

            $email_autor = $user_data["email_usuario"];
            $estado = 6;
            $datos = array(
                'ID' => $id_revista,
                'email_autor' => $email_autor,
                'id_estado' => $estado
            );

            $data['datos'] = $this->Articulo_Model->articulos_incluir_mod($datos);
            $data['fecha_actual'] = date('Y-m-d H:i:s');

            if ($this->input->server('REQUEST_METHOD') != 'POST') {

                foreach ($data['datos']->result() as $row) {
                    $archivo_old = $row->archivo;
                }
                $nombre_articulo = $archivo_old;
                $extension = strtoupper(substr($nombre_articulo, strpos($nombre_articulo, ".") + 1));
                $data['extension'] = $extension;
                $this->load->view('include/head');
                $this->load->view('include/header_autor');
                $this->load->view('articulo/view_mis_articulos_mod_ob', $data);
                $this->load->view('include/footer');
            } else {
                if ($data['datos']) {
                    foreach ($data['datos']->result() as $row) {
                        $archivo_old = $row->archivo;
                        $fecha = $row->fecha_timeout;
                    }
                    $now = date('Y-m-d H:i:s');
                    $nombre_articulo = $archivo_old;
                    $extension = strtolower(substr($nombre_articulo, strpos($nombre_articulo, ".") + 1));

                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = $extension;
                    $config['file_name'] = $nombre_articulo;
                    $config['max_size'] = 5120; //5 mb
                    $config['overwrite'] = TRUE;

                    $this->load->library('upload', $config);
                    $file = $this->upload->do_upload('userfile');

                    if (!$file) {
                        //fecha pasó límite
                        if ($fecha < $now) {
                            $aviso = array('title' => lang("tswal_fecha limite"),
                                'text' => lang("cswal_ha caducado la fecha"),
                                'tipoaviso' => 'error',
                                'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                            );
                            $this->load->view('include/aviso', $aviso);
                        } else {
                            //Error de archivo
                            $aviso = array('title' => lang("tswal_error"),
                                'text' => lang("cswal_articulo no subido"),
                                'tipoaviso' => 'error',
                                'windowlocation' => $id_revista
                            );
                            $this->load->view('include/aviso', $aviso);
                        }
                    } else {
                        //fecha pasó límite
                        if ($fecha < $now) {
                            $aviso = array('title' => lang("tswal_fecha limite"),
                                'text' => lang("cswal_ha caducado la fecha"),
                                'tipoaviso' => 'error',
                                'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                            );
                            $this->load->view('include/aviso', $aviso);
                        } else {
                            //Formulario enviado con éxito
                            $file_data = $this->upload->data();
                            if ($file_data) {

                                $datos_update = array(
                                    'ID' => $id_revista,
                                    'id_estado' => 10
                                );
                                $datos_update = $this->Articulo_Model->actualizar_articulo_estado($datos_update);
                                if ($datos_update) {
                                    $this->Articulo_Model->incrementar_version($id_revista);
                                    $aviso = array('title' => lang("tswal_subido"),
                                        'text' => lang("cswal_archivo subido con exito"),
                                        'tipoaviso' => 'success',
                                        'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                                    );
                                    //Enviar correo electrónico(archivo reemplazado con éxito(modificiones obligatorias para usuario))
                                    $this->load->view('include/aviso', $aviso);
                                } else {
                                    //Error de archivo
                                    $aviso = array('title' => lang("tswal_error"),
                                        'text' => lang("cswal_bd error"),
                                        'tipoaviso' => 'error',
                                        'windowlocation' => $id_revista
                                    );
                                    $this->load->view('include/aviso', $aviso);
                                }
                            } else {
                                //Error de archivo
                                $aviso = array('title' => lang("tswal_error"),
                                    'text' => lang("cswal_error upload file data"),
                                    'tipoaviso' => 'error',
                                    'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                                );
                                $this->load->view('include/aviso', $aviso);
                            }
                        }
                    }
                } else {
                    $aviso = array('title' => lang("tswal_error"),
                        'text' => lang("cswal_no data"),
                        'tipoaviso' => 'error',
                        'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                    );
                    $this->load->view('include/aviso', $aviso);
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

    //Incluir Modificaciones
    public function incluir_modificaciones() {

        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '3' || $user_data['id_rol2'] == '3' || $user_data['id_rol3'] == '3') {


            $data['datos'] = $this->Articulo_Model->articulos();
            if ($data['datos']) {
                $this->load->view('include/head');
                $this->load->view('include/header_autor');
                $this->load->view('articulo/view_comentarios_de_revisores', $data);
                $this->load->view('include/footer');
            } else {
                $aviso = array('title' => lang("tswal_error"),
                    'text' => lang("cswal_no data"),
                    'tipoaviso' => 'error',
                    'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                );
                $this->load->view('include/aviso', $aviso);
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

    
    public function art(){
        $data["campo"] = $this->Articulo_Model->campos_investigacion();
        $data['fail'] = "";
        
        $this->load->view('include/head');
        $this->load->view('include/header_autor');
        $this->load->view('articulo/view_articulo', $data);
        $this->load->view('include/footer');
    }
    
    //Ingresasr Artículo
    public function ingresar_articulo() {
        $user_data = $this->session->userdata('userdata');

        if ($user_data['id_rol'] == '3' || $user_data['id_rol2'] == '3' || $user_data['id_rol3'] == '3') {
            if (isset($_POST['upload'])) {
                if ($_FILES['userfile']['name'] == NULL) {
                    $aviso = array('title' => 'Archivo no subido',
                        'text' => "No existe archivo",
                        'tipoaviso' => 'error',
                        'windowlocation' => base_url() . "index.php/articulo_autor/mis_articulos"
                    );
                    $this->load->view('include/aviso', $aviso);
                } else {
                    $formatos = array('.doc', '.DOC', '.docx', '.DOCX');
                    $nombrearchivo = $_FILES['userfile']['name'];
                    $ext = '.' . pathinfo($nombrearchivo, PATHINFO_EXTENSION);
                    $nombretemparchivo = $_FILES['userfile']['tmp_name'];

                    $data['titulo_revista'] = $this->input->post('titulo_articulo');
                    $data['id_campo'] = $this->input->post('area_aplicable');
                    $data['palabras_claves'] = $this->input->post('palabras_claves');
                    $data['abstract'] = $this->input->post('abstract');
                    $data['autor_1'] = $this->input->post('autor_principal');
                    $data['autor_2'] = $this->input->post('autor_add_1');
                    $data['autor_3'] = $this->input->post('autor_add_2');
                    $data['autor_4'] = $this->input->post('autor_add_3');

                    $data['comentarios'] = $this->input->post('comentarios');
                    $data['version'] = 1;
                    $data['id_estado'] = 1;
                    $data['email_autor'] = $user_data["email_usuario"];
                    
                    $nombre_articulo = $data['titulo_revista'] . $data['email_autor']. date('Y-m-d_H_i_s');
                    $nombre_articulo .= $ext;
                    $nombre_articulo = str_replace(' ', '_', $nombre_articulo);
                    $data['archivo'] = $nombre_articulo;
                    
                    if (in_array($ext, $formatos)) {
                        if ($_FILES['userfile']['size'] <= 5120000) {
                            if (move_uploaded_file($nombretemparchivo, "uploads/$nombre_articulo") == true) {
                                if ($this->Articulo_Model->agregar_articulo($data) == true) {
                                    $subject = "Articulo recibido Revista UCM";
                                    $mensaje = '<html>' .
                                            '<body><h4>Hola <br><br>Hemos recibido tu artículo. Será sometido a un proceso de evaluación. Te avisaremos cuando hayamos terminado.</h4><br>' .
                                            '</body>' .
                                            '</html>';
                                    $mensaje .= "<b>Saludos</br><br>";
                                    $mensaje .= "<b>Equipo Revista UCM</b><br>";
                                    $headers = "From: RevistaUCM@ucm.cl \r\n";
                                    $headers .= 'Bcc: servicios.intech@gmail.com' . "\r\n";
                                    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

                                    mail($user_data["email_usuario"], $subject, $mensaje, $headers);


                                    $aviso = array('title' => lang("tswal_subido"),
                                        'text' => lang("cswal_archivo subido con exito"),
                                        'tipoaviso' => 'success',
                                        'windowlocation' => base_url() . "index.php/System/autor"
                                    );
                                    $this->load->view('include/aviso', $aviso);
                                }
                            }
                        } else {
                            echo '<script type="text/javascript">';
                            echo 'setTimeout(function () { swal("Tamaño no soportado","Archivo no subido.","error");';
                            echo '}, 350);</script>';

                            $data["campo"] = $this->Articulo_Model->campos_investigacion();
                            $data["fail"] = "Tamaño no soportado";

                            $this->load->view('include/head');
                            $this->load->view('include/header_autor');
                            $this->load->view('articulo/view_articulo', $data);
                            $this->load->view('include/footer');
                            
                            /*
                            $aviso = array('title' => 'Tamaño no soportado',
                                'text' => lang("cswal_archivo no subido"),
                                'tipoaviso' => 'error',
                                'windowlocation' => base_url() . "index.php/Articulo_autor/art"
                            );
                            $this->load->view('include/aviso', $aviso);
                             
                             */
                        }
                    } else {
                        $aviso = array('title' => 'Formato no soportado',
                            'text' => lang("cswal_archivo no subido"),
                            'tipoaviso' => 'error',
                            'windowlocation' => base_url() . "index.php/Articulo_autor/art"
                        );
                        $this->load->view('include/aviso', $aviso);
                    }
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

    public function eliminar_articulo() {

        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '3' || $user_data['id_rol2'] == '3' || $user_data['id_rol3'] == '3') {

            $this->load->view('include/head');
            $id_articulo = $this->input->get('a');
            if ($this->Articulo_Model->eliminar_articulo_clave($id_articulo)) {
                $aviso = array('title' => lang("tswal_eliminado"),
                    'text' => lang("cswal_articulo borrado correctamente de la plataforma"),
                    'tipoaviso' => 'success',
                    'windowlocation' => base_url() . "index.php/System/autor"
                );
                $this->load->view('include/aviso', $aviso);
            } else {
                $aviso = array('title' => lang("tswal_error"),
                    'text' => lang("cswal_archivo no eliminado"),
                    'tipoaviso' => 'error',
                    'windowlocation' => base_url() . "index.php/System/autor"
                );
                $this->load->view('include/aviso', $aviso);
            }
            $this->load->view('view_color');
            $this->load->view('include/footer_esencial');
        } else {
            $aviso = array('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso' => 'error',
                'windowlocation' => base_url() . "index.php/"
            );
            $this->load->view('include/aviso', $aviso);
        }
    }

    public function a_publicar() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '3' || $user_data['id_rol2'] == '3' || $user_data['id_rol3'] == '3') {


            $this->load->view('include/head');
            $this->load->view('include/header_autor');
            $this->load->view('view_a_publicar');
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

    public function responder_solicitud() {
        $user_data = $this->session->userdata('userdata');
        if ($user_data['id_rol'] == '1' || $user_data['id_rol2'] == '1' || $user_data['id_rol3'] == '1') {
            $id_art = $this->input->post('t_id');
            $titulo_art = '';
            $consulta = $this->Articulo_Model->obtener_info_articulo($id_art);
            if ($consulta) {
                $titulo_art = $consulta->titulo_revista;
            }
            $form_up['titulo'] = $titulo_art;
            $form_up['pagina_inicio'] = $this->input->post('p_ini');
            $form_up['pagina_fin'] = $this->input->post('p_fin');
            $form_up['ID_articulo'] = $id_art;
            $form_up['ID_magazine'] = 9999;
            $formi['id_estado'] = 7;

            $this->Articulo_Model->drop_final_magazine($id_art);
            $this->Articulo_Model->actualizar_a_publicado($formi, $id_art);

            if (isset($_POST['exit'])) {
                if ($_FILES['final_file']['name'] != null) {
                    $formatos = array('.pdf', '.PDF');
                    $nombrearchivo = $_FILES['final_file']['name'];
                    $ext = '.' . pathinfo($nombrearchivo, PATHINFO_EXTENSION);
                    $nombretemparchivo = $_FILES['final_file']['tmp_name'];

                    $archivo = $this->Articulo_Model->obtener_arhivo($id_art);
                    $fotm_dat['id_estado'] = 13;

                    if (in_array($ext, $formatos)) {
                        $nombrearchivo = $archivo->archivo;
                        $nombrearchivo .= $ext;
                        $form_up['file_papper'] = $nombrearchivo;
                        if (move_uploaded_file($nombretemparchivo, "uploads/$nombrearchivo") == true) {
                            if ($this->Articulo_Model->insert_articulo_final_magazine($form_up) == true) {
                                if ($this->Articulo_Model->actualizar_a_respondido($fotm_dat, $id_art) == true) {


                                    $title2 = json_encode(lang('tswal_archivo recibido'), JSON_HEX_TAG);
                                    $text2 = json_encode(lang('cswal_ahora puede añadirlo a una nueva revista'), JSON_HEX_TAG);
                                    echo
                                    "<script type='text/javascript'>
                                        setTimeout(function () {
                                          var title = {$title2};
                                          var text = {$text2};
                                          swal(title,text, 'success');
                                        }, 350);
                                        </script>";

                                    $this->load->view('include/head');
                                    $this->load->view('include/header_editor');
                                    $this->load->view('view_home_editor');
                                    $this->load->view('include/footer');
                                } else {
                                    $title2 = json_encode(lang('tswal_ocurrio un error 1'), JSON_HEX_TAG);
                                    $text2 = json_encode(lang('cswal_intenta mas tarde'), JSON_HEX_TAG);
                                    echo
                                    "<script type='text/javascript'>
                                        setTimeout(function () {
                                          var title = {$title2};
                                          var text = {$text2};
                                          swal(title,text, 'warning');
                                        }, 350);
                                        </script>";

                                    $this->load->view('include/head');
                                    $this->load->view('include/header_editor');
                                    $this->load->view('view_home_editor');
                                    $this->load->view('include/footer');
                                }
                            } else {
                                $title2 = json_encode(lang('tswal_ocurrio un error 2'), JSON_HEX_TAG);
                                $text2 = json_encode(lang('cswal_intenta mas tarde'), JSON_HEX_TAG);
                                echo
                                "<script type='text/javascript'>
                                        setTimeout(function () {
                                          var title = {$title2};
                                          var text = {$text2};
                                          swal(title,text, 'warning');
                                        }, 350);
                                        </script>";

                                $this->load->view('include/head');
                                $this->load->view('include/header_editor');
                                $this->load->view('view_home_editor');
                                $this->load->view('include/footer');
                            }
                        } else {
                            $title2 = json_encode(lang('tswal_ocurrio un error con tu archivo'), JSON_HEX_TAG);
                            $text2 = json_encode(lang('cswal_intenta mas tarde'), JSON_HEX_TAG);
                            echo
                            "<script type='text/javascript'>
                                setTimeout(function () {
                                    var title = {$title2};
                                    var text = {$text2};
                                    swal(title,text, 'warning');
                                }, 350);
                                </script>";

                            $this->load->view('include/head');
                            $this->load->view('include/header_editor');
                            $this->load->view('view_home_editor');
                            $this->load->view('include/footer');
                        }
                    }
                } else {
                    $title2 = json_encode(lang('tswal_formato no admitido'), JSON_HEX_TAG);
                    $text2 = json_encode(lang('cswal_formato aceptado pdf'), JSON_HEX_TAG);
                    echo
                    "<script type='text/javascript'>
                        setTimeout(function () {
                            var title = {$title2};
                            var text = {$text2};
                            swal(title,text, 'warning');
                        }, 350);
                        </script>";

                    $this->load->view('include/head');
                    $this->load->view('include/header_editor');
                    $this->load->view('view_por_paginar');
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

}

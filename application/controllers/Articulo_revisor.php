<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Articulo_revisor extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Articulo_Model');
        $this->load->helper(array('form', 'url'));
        $this->load->helper("file");
    }

    public function index() {
        $aviso =array ('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso'=>'error',
                'windowlocation'=> base_url()."index.php/" 
                );
            $this->load->view('include/aviso',$aviso);
    }

    //Asignar_revisores

    public function articulos_asignados() {
        $user_data = $this->session->userdata('userdata');
        if($user_data['id_rol']=='2'||$user_data['id_rol2']=='2'||$user_data['id_rol3']=='2'){


            $email_autor=$user_data['email_usuario'];
            $datos = $this->Articulo_Model->id_revisor_email($email_autor);
            if($datos){
                
                $id_revisor = $datos->ID;
            }
            else{
                $id_revisor = -1;
            }
        

            $data['datos'] = $this->Articulo_Model->articulos_asignados_por_id($id_revisor);
           
            $this->load->view('include/head');
            $this->load->view('include/header_revisor');
            $this->load->view('articulo/view_articulos_asignados',$data); 
            $this->load->view('include/footer');

        }else{
            $aviso =array ('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso'=>'error',
                'windowlocation'=> base_url()."index.php/" 
                );
            $this->load->view('include/aviso',$aviso);
        }
        
    }


    public function articulos_asignados_ver($id_revista) {
        $user_data = $this->session->userdata('userdata');
        if($user_data['id_rol']=='2'||$user_data['id_rol2']=='2'||$user_data['id_rol3']=='2'){

            $data['datos'] = $this->Articulo_Model->articulo_ver($id_revista);

            $this->load->view('include/head');
            $this->load->view('include/header_revisor');
            $this->load->view('articulo/view_articulos_asignados_ver',$data); 
            $this->load->view('include/footer');

        }else{
            $aviso =array ('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso'=>'error',
                'windowlocation'=> base_url()."index.php/" 
                );
            $this->load->view('include/aviso',$aviso);
        }
        
    }

    public function articulos_asignados_comentar($id_revista) {
        $user_data = $this->session->userdata('userdata');
        if($user_data['id_rol']=='2'||$user_data['id_rol2']=='2'||$user_data['id_rol3']=='2'){

            $data['datos'] = $this->Articulo_Model->articulo_ver($id_revista);
            $email_revisor=$user_data['email_usuario'];
            $datos = $this->Articulo_Model->id_revisor_email($email_revisor);
            if($datos){
                
                $id_revisor = $datos->ID;
            }
            else{
                $id_revisor = -1;
            }

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $user_data = $this->session->userdata('userdata');
                $email_autor=$user_data['email_usuario'];
                $comentario   = $this->input->post('comentario');
                $calificacion   = $this->input->post('calificacion');
                print_r($calificacion);


                $datos          = array(
                    'id_revista'        => $id_revista,
                    'id_revisor'     => $id_revisor,
                    'comentario'        => $comentario

                    );

                $revisores=$this->Articulo_Model->que_revisor_soy($datos);

                foreach ($revisores->result() as $row) {
                    $rev1=$row->id_revisor_1;
                    $rev2=$row->id_revisor_2;
                    $rev3=$row->id_revisor_3;
                }

                if($rev1==$id_revisor){
                    $datos          = array(
                        'ID'        => $id_revista,
                        'calificaRev1'     => $calificacion,
                        'comentario_revisor_1'        => $comentario
    
                    );
                    if($this->Articulo_Model->actualizar_articulo_estado($datos)){
                 
                        $aviso =array ('title' => lang("tswal_comentario subido con exito"),
                            'text' => lang("cswal_comentario actualizado"),
                            'tipoaviso'=>'success',
                            'windowlocation'=> base_url()."index.php/articulo_revisor/articulos_asignados"    
                            );
                        $this->load->view('include/aviso',$aviso);
                    }else{
                        $aviso =array ('title' => lang("tswal_error"),
                            'text'=>'Error: Comentario no actualizado',
                            'tipoaviso'=>'error',
                            'windowlocation'=> base_url()."index.php/articulo_revisor/articulos_asignados"    
                            );
                        $this->load->view('include/aviso',$aviso);
                    }
                }
                if($rev2==$id_revisor){
                    $datos          = array(
                        'ID'        => $id_revista,
                        'calificaRev2'     => $calificacion,
                        'comentario_revisor_2'        => $comentario
    
                    );
                    if($this->Articulo_Model->actualizar_articulo_estado($datos)){
                        $aviso =array ('title' => lang("tswal_comentario subido con exito"),
                            'text' => lang("cswal_comentario actualizado"),
                            'tipoaviso'=>'success',
                            'windowlocation'=> base_url()."index.php/articulo_revisor/articulos_asignados"    
                            );
                        $this->load->view('include/aviso',$aviso);
                    }else{
                        $aviso =array ('title' => lang("tswal_error"),
                            'text'=>'Error: Comentario no actualizado',
                            'tipoaviso'=>'error',
                            'windowlocation'=> base_url()."index.php/articulo_revisor/articulos_asignados"    
                            );
                        $this->load->view('include/aviso',$aviso);
                    }
                }
                if($rev3==$id_revisor){
                    $datos          = array(
                        'ID'        => $id_revista,
                        'calificaRev3'     => $calificacion,
                        'comentario_revisor_3'        => $comentario
    
                    );
                    if($this->Articulo_Model->actualizar_articulo_estado($datos)){
                        $aviso =array ('title' => lang("tswal_comentario subido con exito"),
                            'text' => lang("cswal_comentario actualizado"),
                            'tipoaviso'=>'success',
                            'windowlocation'=> base_url()."index.php/articulo_revisor/articulos_asignados"    
                            );
                        $this->load->view('include/aviso',$aviso);
                    }else{
                        $aviso =array ('title' => lang("tswal_error"),
                            'text'=>'Error: Comentario no actualizado',
                            'tipoaviso'=>'error',
                            'windowlocation'=> base_url()."index.php/articulo_revisor/articulos_asignados"    
                            );
                        $this->load->view('include/aviso',$aviso);
                    }
                }

            }else{
                $user_data = $this->session->userdata('userdata');
                $email_revisor=$user_data['email_usuario'];

                $datos          = array(
                    'id_revista'        => $id_revista,
                    'id_revisor'     => $id_revisor,
                    );

                $revisores=$this->Articulo_Model->que_revisor_soy($datos);

                foreach ($revisores->result() as $row) {
                    $rev1=$row->id_revisor_1;
                    $rev2=$row->id_revisor_2;
                    $rev3=$row->id_revisor_3;
                }

                $revisor_numero=0;
                if($rev1==$id_revisor){
                    $revisor_numero=1;
                }
                if($rev2==$id_revisor){
                    $revisor_numero=2;
                }
                if($rev3==$id_revisor){
                    $revisor_numero=3;
                }
                $comentario="";
                foreach ($data['datos']->result() as $row) {
                    if($revisor_numero==1){
                        $comentario=$row->com_rev1;
                    }
                    if($revisor_numero==2){
                        $comentario=$row->com_rev2;
                    }
                    if($revisor_numero==3){
                        $comentario=$row->com_rev3;
                    }  
                }
                $data['comentario']=$comentario;
                

                $this->load->view('include/head');
                $this->load->view('include/header_revisor');
                $this->load->view('articulo/view_articulos_asignados_comentar',$data); 
                $this->load->view('include/footer');
            }
        }else{
            $aviso =array ('title' => lang("tswal_acceso denegado"),
                'text' => lang("cswal_acceso denegado"),
                'tipoaviso'=>'error',
                'windowlocation'=> base_url()."index.php/" 
                );
            $this->load->view('include/aviso',$aviso);
        }
    }
    
}


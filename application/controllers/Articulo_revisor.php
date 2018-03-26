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


            $id_revisor=$user_data['ID'];

            $data['datos'] = $this->Articulo_Model->articulos_asignados($id_revisor);

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

            $data['datos'] = $this->Articulo_Model->articulo($id_revista);

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

            $data['datos'] = $this->Articulo_Model->articulo($id_revista);
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $user_data = $this->session->userdata('userdata');
                $email_revisor=$user_data['email_usuario'];
                $comentario   = $this->input->post('comentario');


                $datos          = array(
                    'id_revista'        => $id_revista,
                    'email_revisor'     => $email_revisor,
                    'comentario'        => $comentario

                    );

                $revisores=$this->Articulo_Model->que_revisor_soy($datos);

                foreach ($revisores->result() as $row) {
                    $rev1=$row->email_revisor_1;
                    $rev2=$row->email_revisor_2;
                    $rev3=$row->email_revisor_3;
                }

                if($rev1==$datos["email_revisor"]){
                    if($this->Articulo_Model->update_comentario_revisor_1($datos)){
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
                if($rev2==$datos["email_revisor"]){
                    if($this->Articulo_Model->update_comentario_revisor_2($datos)){
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
                if($rev3==$datos["email_revisor"]){
                    if($this->Articulo_Model->update_comentario_revisor_3($datos)){
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
                    'email_revisor'     => $email_revisor,
                    );

                $revisores=$this->Articulo_Model->que_revisor_soy($datos);

                foreach ($revisores->result() as $row) {
                    $rev1=$row->email_revisor_1;
                    $rev2=$row->email_revisor_2;
                    $rev3=$row->email_revisor_3;
                }

                $revisor_numero=0;
                if($rev1==$datos["email_revisor"]){
                    $revisor_numero=1;
                }
                if($rev2==$datos["email_revisor"]){
                    $revisor_numero=2;
                }
                if($rev3==$datos["email_revisor"]){
                    $revisor_numero=3;
                }
                $comentario="";
                foreach ($data['datos']->result() as $row) {
                    if($revisor_numero==1){
                        $comentario=$row->comentario_revisor_1;
                    }
                    if($revisor_numero==2){
                        $comentario=$row->comentario_revisor_2;
                    }
                    if($revisor_numero==3){
                        $comentario=$row->comentario_revisor_3;
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


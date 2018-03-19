<?php

class Articulo_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set("America/Santiago");
    }

    function incrementar_version($id_articulo) {
        $query = $this->db->query("UPDATE revista SET version = version + 1 WHERE ID = ?", array($id_articulo));
    }

    function count_magazine() {
        $query = $this->db->query("SELECT COUNT(*) as cantidad FROM magazines");

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function getnamee($ID) {
        $query = $this->db->query("SELECT autor_1, autor_2, autor_3, autor_4 FROM revista WHERE ID = ?", array($ID));
        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    function getTemas($ID) {
        $query = $this->db->select('*');
        $query = $this->db->from('temas');
        $query = $this->db->where('nombre_campo', $ID);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function actualizar_login_revisor_a_valido($correo_revisor) {
        $query1 = $this->db->query("UPDATE login SET rol_fk = 2 WHERE rol_fk = 555 AND md5(CONCAT(correo, 'ox')) = ?", array($correo_revisor));

        $query2 = $this->db->query("UPDATE login SET rol2_fk = 2 WHERE rol2_fk = 555 AND md5(CONCAT(correo, 'ox')) = ?", array($correo_revisor));

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function actualizar_login_revisor_a_borrado($correo_revisor) {
        $query1 = $this->db->query("UPDATE login SET rol_fk = 777 WHERE  rol_fk = 555 AND md5(CONCAT(correo, 'ox')) = ?", array($correo_revisor));
        $query1 = $this->db->query("UPDATE login SET rol2_fk = 777 WHERE  rol2_fk = 555 AND md5(CONCAT(correo, 'ox')) = ?", array($correo_revisor));

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function obtener_postulantes_editor() {
        $query = $this->db->query("SELECT *, r.ID as id_revisor FROM `login` l, `revisor` r WHERE l.correo = r.email AND (l.rol_fk = 555 OR l.rol2_fk = 555)");

        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    function count_articulos_total_publicados() {
        $query = $this->db->query("SELECT COUNT(*) as total FROM revista
                                  WHERE id_estado = 8");

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function get_magazine($ID) {
        $query = $this->db->select('*');
        $query = $this->db->from('magazines');
        $query = $this->db->where('ID', $ID);

        $query = $this->db->get();
        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function obtener_magazines_limit($start, $content_per_page) {
        $query = $this->db->select('*');
        $query = $this->db->from('magazines');
        $query = $this->db->order_by('ID', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $resultado = $query->result();
            $data_row = array_slice($resultado, $start, $content_per_page);

            return $data_row;
        } else {
            return false;
        }
    }

    function get_all_magazine() {
        $query = $this->db->select('*');
        $query = $this->db->from('magazines');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function get_max_id_magazine() {
        $query = $this->db->select('MAX(ID) as numero');
        $query = $this->db->from('magazines');

        $query = $this->db->get();
        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function actualizar_articulos_timeout__aceptado_y_sin_modificar_opcional() {
        // Estado 5: Aceptado sin comentarios
        // Estado 7: Edicion
        $query = $this->db->query("UPDATE revista SET id_estado=7 WHERE id_estado = 5 AND DATE(fecha_timeout) < CURDATE()");

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function actualizar_articulos_timeout__aceptado_con_comentarios_y_sin_modificar_obligatorio() {
        // Estado 6: Aceptado con comentarios
        // Estado 9: Rechazado por TimeOut
        $query = $this->db->query("UPDATE revista SET id_estado=9 WHERE id_estado = 6 AND DATE(fecha_timeout) < CURDATE()");

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Borrar Articulo
    function eliminar_articulo_clave($ID) {
        $query = $this->db->query("DELETE FROM revista WHERE md5(CONCAT(ID, 'a1ds4345f5xcjdfnp147')) = ?", array($ID));

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Articulos para paginas
    function obtener_articulos_limit($correo, $start, $content_per_page) {
        $query = $this->db->query("SELECT * FROM revista WHERE email_autor = ?", array($correo));

        if ($query->num_rows() > 0) {
            $resultado = $query->result();
            $data_row = array_slice($resultado, $start, $content_per_page);

            return $data_row;
        } else {
            return false;
        }
    }

    function articulos_asignados_limit($email, $start, $content_per_page) {
        $query = $this->db->select('*');
        $query = $this->db->from('revista');
        $query = $this->db->where('email_revisor_1', $email);
        $query = $this->db->or_where('email_revisor_2', $email);
        $query = $this->db->or_where('email_revisor_3', $email);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $resultado = $query->result();
            $data_row = array_slice($resultado, $start, $content_per_page);

            return $data_row;
        } else {
            return false;
        }
    }

    function count_articulos_asignados($email) {
        $query = $this->db->select('COUNT(*) as cantidad');
        $query = $this->db->from('revista');
        $query = $this->db->where('email_revisor_1', $email);
        $query = $this->db->or_where('email_revisor_2', $email);
        $query = $this->db->or_where('email_revisor_3', $email);

        $query = $this->db->get();
        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function obtener_estado_nombre($id_estado) {
        $query = $this->db->query("SELECT nombre_estado FROM estado WHERE id_estado = ? ", array($id_estado));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function getmail($ID) {
        $query = $this->db->query("SELECT email_autor FROM revista WHERE ID = ? ", array($ID));
        $result = $query->row();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function count_obtener_articulos($correo) {
        $query = $this->db->query("SELECT COUNT(*) as cantidad FROM revista WHERE email_autor = ?", array($correo));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function articulos_asignados($email) {
        $query = $this->db->select('*');
        $query = $this->db->from('revista');
        $query = $this->db->where('email_revisor_1', $email);
        $query = $this->db->or_where('email_revisor_2', $email);
        $query = $this->db->or_where('email_revisor_3', $email);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function actualizar_articulo_revisores($datos) {

        $this->db->where('ID', $datos['ID']);
        $this->db->update('revista', $datos);

        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function actualizar_articulo_estado($datos) {

        $this->db->where('ID', $datos['ID']);
        $this->db->update('revista', $datos);

        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function que_revisor_soy($datos) {

        $query = $this->db->select('email_revisor_1,email_revisor_2,email_revisor_3');
        $query = $this->db->from('revista');
        $query = $this->db->where('ID', $datos["id_revista"]);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function update_comentario_revisor_1($datos) {

        $datos_upd = array(
            'comentario_revisor_1' => $datos["comentario"]
        );
        $this->db->where('ID', $datos['id_revista']);
        $this->db->update('revista', $datos_upd);

        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update_comentario_revisor_2($datos) {

        $datos_upd = array(
            'comentario_revisor_2' => $datos["comentario"]
        );
        $this->db->where('ID', $datos['id_revista']);
        $this->db->update('revista', $datos_upd);

        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update_comentario_revisor_3($datos) {

        $datos_upd = array(
            'comentario_revisor_3' => $datos["comentario"]
        );
        $this->db->where('ID', $datos['id_revista']);
        $this->db->update('revista', $datos_upd);

        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //campo(s) de investigacion
    function campos_investigacion() {
        $query = $this->db->select('*');
        $query = $this->db->from('campo_investigacion');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function campo_investigacion($ID) {
        $query = $this->db->select('*');
        $query = $this->db->from('campo_investigacion');
        $query = $this->db->where('id_campo', $ID);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    //articulo(s)
    function articulos() {
        $query = $this->db->select('*');
        $query = $this->db->from('revista');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $resultado = $query->result();
            return $resultado;
        } else {
            return FALSE;
        }
    }

    function articulos_buscar_home_principal() {
        $query = $this->db->select('*');
        $query = $this->db->from('final_magazine');
        $query = $this->db->where('ID_magazine != 9999');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function mis_articulos($email_autor) {
        $query = $this->db->select('*');
        $query = $this->db->from('revista');
        $query = $this->db->where('email_autor', $email_autor);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function articulos_estado_10_11() {
        $query = $this->db->select('*');
        $query = $this->db->from('revista');
        $query = $this->db->where('id_estado', 10);
        $query = $this->db->or_where('id_estado', 11);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function articulos_estado_1_3() {
        $query = $this->db->select('*');
        $query = $this->db->from('revista');
        $query = $this->db->where('id_estado', 1);
        $query = $this->db->or_where('id_estado', 3);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function articulos_por_estado($estado) {
        $query = $this->db->select('*');
        $query = $this->db->from('revista');
        $query = $this->db->where('id_estado', $estado);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function eliminar_articulo($id) {

        $query = $this->db->where('ID', $id);
        $query = $this->db->delete('revista');

        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function articulo($id) {
        $query = $this->db->select('*');
        $query = $this->db->from('revista');
        $query = $this->db->where('ID', $id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function articulo_ver($id) {
        $query = $this->db->query("SELECT r.ID as ID, e.nombre_estado as estado, r.titulo_revista as titulo_revista, r.abstract as abstract, r.palabras_claves as palabras_claves, r.archivo as archivo , t.nombre as tema, r.fecha_ingreso as fecha_ingreso, r.email_autor as email_autor , r.autor_1 as n_autor, r.email_add1 as email_a2, r.autor_2 as n_autor2, r.email_add2 as email_a3,r.autor_3 as n_autor3,r.email_add3 as email_a4 ,r.autor_4 as n_autor4,r.email_add4 as email_a5,r.autor_5 as n_autor5, r.email_add5 as email_a6,r.autor_6 as n_autor6,re.email as rev_1,re2.email as rev_2,re3.email as rev_3, r.comentarios as com_autor, r.comentario_revisor_1 as com_rev1, r.comentario_revisor_2 as com_rev2, r.comentario_revisor_3 as com_rev3, 	r.comentarios_editor as com_edit, r.pais as pais, r.institucion as institucion,p.estado as e_post, r.VerificacionTextoFecha as vertf, r.VerificacionTexto as vert, r.calificaRev1 as cal_rev1, r.calificaRev2 as cal_rev2, r.calificaRev3 as cal_rev3, r.fechaCalificaRev as fecha_cal, r.fechaCalificaFinal as fecha_calf, r.calificaFinal as cal_f, r.fechaReenvioarticulo as fecha_ra, r.Fecha_asig_revision as fecha_asr   FROM revista as r INNER JOIN post as p ON r.id_post = p.id INNER JOIN temas as t ON r.id_tema = t.id_tema INNER JOIN estado as e ON r.id_estado = e.id_estado INNER JOIN revisor as re ON r.id_revisor_1 = re.ID INNER JOIN revisor as re2 ON r.id_revisor_2 = re2.ID INNER JOIN revisor as re3 ON r.id_revisor_3 = re3.ID WHERE r.ID = "+$id+"");
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }



    function articulos_recibidos() {
        $query = $this->db->query("SELECT r.ID as ID, e.nombre_estado as estado, r.titulo_revista as titulo_revista, r.abstract as abstract, r.palabras_claves, r.archivo, t.nombre as tema, r.fecha_ingreso as fecha_ingreso, r.email_autor as email_autor , r.autor_1, r.email_add1, r.autor_2, r.email_add2,r.autor_3,r.email_add3,r.autor_4,r.email_add4,r.autor_5, r.email_add5,r.autor_6 FROM revista as r INNER JOIN temas as t ON r.id_tema = t.id_tema INNER JOIN estado as e ON r.id_estado = e.id_estado WHERE r.id_estado = 1 AND r.id_revisor_1 = 0 AND r.id_revisor_2 = 0 AND r.id_revisor_3 = 0 ORDER by r.fecha_ingreso, t.nombre");
        if ($query) {
            return $query;
        } else {
            return false;
        }
       
    }

    function articulos_incluir_mod($datos) {
        $query = $this->db->select('*');
        $query = $this->db->from('revista');
        $query = $this->db->where('ID', $datos['ID']);
        $query = $this->db->where('email_autor', $datos['email_autor']);
        $query = $this->db->where('id_estado', $datos['id_estado']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function articulos_incluir_mod_ob($datos) {
        $query = $this->db->select('*');
        $query = $this->db->from('revista');
        $query = $this->db->where('ID', $datos['ID']);
        $query = $this->db->where('email_autor', $datos['email_autor']);
        $query = $this->db->where('id_estado', $datos['id_estado']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function revisores_de_articulo($id_revista) {
        $query = $this->db->select('email_revisor_1,email_revisor_2,email_revisor_3');
        $query = $this->db->from('revista');
        $query = $this->db->where('ID', $id_revista);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function revisores_de_articulo_validos($id_revista) {
        $query = $this->db->select('email_revisor_1,email_revisor_2,email_revisor_3');
        $query = $this->db->from('revista');
        $query = $this->db->where('ID', $id_revista);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function actualizar_comentario($datos) {
        $this->db->where('ID', $datos['ID']);
        $this->db->update('revista', $datos);

        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function actualizar_articulo($datos) {
        $this->db->where('ID', $datos['ID']);
        $this->db->update('revista', $datos);

        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //agregar articulo
    function agregar_articulo($data) {
        $query = $this->db->insert('revista', $data);

        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    function agregar_post($data) {
        $query = $this->db->insert('post', $data);

        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    //revisor(es)
    function revisores() {
        $query = $this->db->select('*');
        $query = $this->db->from('revisor');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }


    function revisores_validos() {
      $query = $this->db->query("SELECT * FROM `login` l, `revisor` r WHERE (l.correo = r.email AND (l.rol_fk = 2 OR l.rol2_fk = 2) AND l.correo NOT IN ((SELECT email_autor FROM revista) ))");

      if ($query) {
          return $query;
      } else {
          return false;
      }
    }



    function revisores_campos($email) {
        $query = $this->db->query("
            SELECT r.`email` as `email`,c.`nombre_campo` as `nombre_campo`
            FROM `campo_revisor` cr
            inner join `revisor` r on r.`ID`= cr.`id_revisor`
            inner join `campo_investigacion` c on c.`id_campo`= cr.`id_campo`
            where r.`email`='" . $email . "'");

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function revisor($email) {
        $query = $this->db->select('revisor.*');
        $query = $this->db->from('revisor');
        $query = $this->db->join('login', 'revisor.email = login.correo');
        $query = $this->db->where('login.correo', $email);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function revisor_direct($email) {
        $query = $this->db->select('*');
        $query = $this->db->from('revisor');
        $query = $this->db->where('email', $email);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function autor_direct($email) {
        $query = $this->db->select('*');
        $query = $this->db->from('usuario');
        $query = $this->db->where('email', $email);

        $query = $this->db->get();

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    //autor(es)
    function autores() {
        $query = $this->db->select('*');
        $query = $this->db->from('usuario');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function autor($email) {
        $query = $this->db->select('usuario.*');
        $query = $this->db->from('usuario');
        $query = $this->db->join('login', 'usuario.email = login.correo');
        $query = $this->db->where('login.correo', $email);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    //estado(s)
    function estados() {
        $query = $this->db->select('*');
        $query = $this->db->from('estado');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function estado($ID) {
        $query = $this->db->select('*');
        $query = $this->db->from('estado');
        $query = $this->db->where('id_estado', $ID);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function obtener_articulos_edicion() {
        $query = $this->db->query("SELECT ID FROM revista WHERE id_estado = 7");
        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function obtener_info_articulo($ID) {
        $query = $this->db->query("SELECT * FROM revista WHERE ID = ?", array($ID));
        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function obtener_articulos_en_revista($ID_revista) {
        $query = $this->db->select('*');
        $query = $this->db->from('final_magazine');
        $query = $this->db->where('ID_magazine', $ID_revista);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    function obtener_contenido($nombre) {
        $query = $this->db->query("SELECT texto_espanol as texto FROM contenidos WHERE contenido = ?", array($nombre));
        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function count_obtener_articulos_listos($id, $id2) {
        // 5 estado aceptado sin comentarios
        $query = $this->db->query("SELECT COUNT(*) as cantidad FROM revista WHERE id_estado IN (?,?,?)", array($id, $id2, 5));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function obtener_articulos_limit_listos($start, $content_per_page, $id, $id2) {
        // 5 estado aceptado sin comentarios
        $query = $this->db->query("SELECT * FROM revista WHERE id_estado IN (?,?, ?)", array($id, $id2, 5));

        if ($query->num_rows() > 0) {
            $resultado = $query->result();
            $data_row = array_slice($resultado, $start, $content_per_page);

            return $data_row;
        } else {
            return false;
        }
    }

    function solicitar_paginacion($formulario) {
        $this->db->insert('final_magazine', $formulario);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function actualizar_a_respondiendo($form, $id_articulo) {
        $this->db->where('ID', $id_articulo);
        $this->db->update('revista', $form);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function actualizar_a_publicado($form, $id_articulo) {
        $this->db->where('ID', $id_articulo);
        $this->db->update('revista', $form);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function consulta_articulo_listo_autor($id_articulo) {
        $query = $this->db->query("SELECT * FROM revista WHERE email_autor = ? and id_estado = 12", array($id_articulo));

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert_articulo_final_magazine($form) {
        $query = $this->db->insert('final_magazine', $form);

        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function eliminar_paginacion_fallo($id) {
        $this->db->query("DELETE FROM final_magazine WHERE final_magazine.ID = ?", array($id));
    }

    function consulta_datos_publicar($email) {
        $query = $this->db->query("SELECT ID, archivo FROM revista WHERE email_autor = ? and id_estado = 12 limit 1", array($email));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function info_final_magazine($id) {
        $query = $this->db->query("SELECT titulo, pagina_inicio, pagina_fin, file_papper FROM final_magazine WHERE id_articulo = ?", array($id));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function obtener_arhivo($id) {
        $query = $this->db->query("SELECT archivo FROM revista WHERE ID = ?", array($id));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function actualizar_a_respondido($form, $id_articulo) {
        $this->db->where('ID', $id_articulo);
        $this->db->update('revista', $form);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function obtener_magazine_titulo() {
        $query = $this->db->query("SELECT * FROM magazines");

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function obtener_magazine_info($id) {
        $query = $this->db->query("SELECT * FROM magazines WHERE ID = ?", array($id));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function count_magaziness($id) {
        $query = $this->db->query("SELECT COUNT(*) as cantidad FROM final_magazine WHERE ID_magazine = ?", array($id));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function obtener_info_articulo2($ID) {
        $query = $this->db->query("SELECT * FROM revista WHERE ID = ?", array($ID));
        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function get_pagina_ini($id) {
        $query = $this->db->query("SELECT pagina_inicio FROM final_magazine WHERE ID_articulo = ?", array($id));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function get_pagina_fin($id) {
        $query = $this->db->query("SELECT pagina_fin FROM final_magazine WHERE ID_articulo = ?", array($id));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function get_fecha_last($id) {
        $query = $this->db->query("SELECT fecha_ultima_upd FROM revista WHERE ID = ?", array($id));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function get_8() {
        $query = $this->db->query("SELECT * FROM final_magazine WHERE ID_magazine = 9999 ORDER BY pagina_inicio");

        $result = $query->result();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function in_rev($data) {
        $query = $this->db->insert('magazines', $data);

        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function count_obtener_articulos_listos2() {
        $query = $this->db->query("SELECT COUNT(*) as cantidad FROM final_magazine WHERE ID_magazine = 9999");

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function obtener_articulos_limit_listos2($start, $content_per_page) {
        $query = $this->db->query("SELECT * FROM final_magazine WHERE ID_magazine = 9999");

        if ($query->num_rows() > 0) {
            $resultado = $query->result();
            $data_row = array_slice($resultado, $start, $content_per_page);

            return $data_row;
        } else {
            return false;
        }
    }

    function up_art($id, $form) {

        $this->db->where('ID', $id);
        $this->db->update('final_magazine', $form);

        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_id_rev($a, $b) {
        $query = $this->db->query("SELECT ID FROM magazines WHERE titulo_revista = ? and fecha_publicacion = ?", array($a, $b));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function drop_final_magazine($id) {
        $this->db->query("DELETE FROM final_magazine WHERE final_magazine.ID_articulo = ?", array($id));
    }

    function inf_final_magazine($id) {
        $query = $this->db->query("SELECT titulo, autor_1, autor_2, autor_3, autor_4 FROM final_magazine WHERE id_articulo = ?", array($id));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function get_id_revista_final($id) {
        $query = $this->db->query("SELECT ID_articulo FROM final_magazine WHERE ID = ?", array($id));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function upd_contenido($id, $form) {
        $this->db->where('contenido', $id);
        $this->db->update('contenidos', $form);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function actualizar_revista($datos)
    {
      $query = $this->db->query("UPDATE magazines SET titulo_revista = ?, fecha_publicacion = ?, palabras_editor = ?  WHERE ID = ?", array($datos['titulo'], $datos['fecha'], $datos['palabras'], $datos['ID']));

      if ($this->db->affected_rows() > 0) {
          return true;
      } else {
          return false;
      }
    }

    function get_mail_hash($hash) {
        $query = $this->db->query("SELECT login.correo FROM login WHERE md5(CONCAT(login.correo, 'ox')) = ?", array($hash));

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }


}

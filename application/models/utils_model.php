<?php

//birds_model.php (Array of Objects)
class Utils_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function get_cliente($q) {
        $this->db->select('*');
        $this->db->like('nombre_rzn_social', strtoupper($q));
        $query = $this->db->get('cliente');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['label'] = strtoupper(htmlentities(stripslashes($row['nombre_rzn_social'])));
                $new_row['value'] = htmlentities(stripslashes($row['rut']));
                $row_set[] = $new_row; //build an array
            }
            return json_encode($row_set); //format the array into json data
        }
    }

    function get_contacto($q) {
        $this->db->select('*');
        $this->db->where('rut_cliente', $q);
        $query = $this->db->get('contacto');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['label'] = strtoupper(htmlentities(stripslashes($row['nombre'])));
                $new_row['value'] = htmlentities(stripslashes($row['id_contacto']));
                $row_set[] = $new_row; //build an array
            }
            return json_encode($row_set); //format the array into json data
        }
    }

    function get_despachador() {

        $this->db->select('*');
        $this->db->like('perfil', 'despachador');
        $this->db->or_like('perfil', 'administrador');

        $query = $this->db->get('usuario');


        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['label'] = htmlentities(stripslashes($row['nombre']));
                $new_row['value'] = htmlentities(stripslashes($row['id']));
                $row_set[] = $new_row; //build an array
            }
            return json_encode($row_set); //format the array into json data
        }
    }

    function get_usuario() {

        $this->db->select('*');
        $this->db->like('perfil', 'despachador');
        $this->db->or_like('perfil', 'administrador');
        $this->db->or_like('perfil', 'oficina');

        $query = $this->db->get('usuario');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['label'] = htmlentities(stripslashes($row['nombre']));
                $new_row['value'] = htmlentities(stripslashes($row['id']));
                $row_set[] = $new_row; //build an array
            }
            return json_encode($row_set); //format the array into json data
        }
    }

    function get_pedidosDespachador($q) {
//        select * 
//        from pedido pe, contacto co, cliente cl, despacho des
//where pe.estado = 'despacho' and pe.rut_contacto_cliente = co.rut_contacto
//and co.rut_cliente = cl.rut and des.id_pedido = pe.id 	and des.id_despachador = '1'
//order by pe.id

        $this->db->select('*');
        $this->db->from('pedido pe');
        $this->db->join('contacto co', 'pe.id_contacto_cliente = co.id_contacto');
        $this->db->join('cliente cl', 'co.rut_cliente = cl.rut');
        $this->db->join('despacho des', 'des.id_pedido = pe.id');
        $this->db->where('des.id_despachador', $q);
        $this->db->where('pe.estado', 'despacho');
        $query = $this->db->get();

        
       
//        return $query->result();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['label'] = htmlentities(stripslashes("ID: " . $row['id'] . " Cliente: " . $row['nombre_rzn_social'] . " -- Contacto: ". $row['nombre'] ." -- Fecha Pedido:" . substr($row['fecha_pedido'], 0, 10)));
                $new_row['value'] = htmlentities(stripslashes($row['id']));
                $row_set[] = $new_row; //build an array
            }
            return json_encode($row_set); //format the array into json data
        }
    }

    function get_last_pedido() {
        $this->db->select('*');

        $query = $this->db->get('pedido_seq');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $valor = htmlentities(stripslashes($row['last_value']));
            }
            return $valor + 1; //se agrega 1 para ver valor real
        }
    }
    function get_last_pedidoOficina() {
        $this->db->select('*');

        $query = $this->db->get('ventas_oficina_seq');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $valor = htmlentities(stripslashes($row['last_value']));
            }
            return $valor + 1; //se agrega 1 para ver valor real
        }
    }
    

    function get_cliente_existe($rutdv1) {

        $this->db->select('*');
        $this->db->from('cliente ');
        $this->db->where('rut', $rutdv1);

        $query = $this->db->get();
//echo $query;
        if ($query->num_rows() > 0) {
            return "false"; //se agrega 1 para ver valor real
        } else {
            return "true";
        }
    }

    function get_contacto_existe($rutdv1) {

        $this->db->select('*');
        $this->db->from('contacto ');
        $this->db->where('rut_contacto', $rutdv1);

        $query = $this->db->get();
//echo $query;
        if ($query->num_rows() > 0) {
            return "false"; //se agrega 1 para ver valor real
        } else {
            return "true";
        }
    }
    function get_infoPedido($id) {
        
        $query = $this->db->query("select * 
                                    from pedido pe, pedido_producto pepro, producto pro 
                                    where pe.id = pepro.id_pedido and pepro.id_producto = pro.id
                                    and pe.id =  ".$id);
        
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['nombre'] = htmlentities(stripslashes( $row['nombre']));
                $new_row['cantidad'] = htmlentities(stripslashes($row['cantidad']));
                $new_row['precio'] = htmlentities(stripslashes($row['precio_unidad']));
                $new_row['descripcion'] = htmlentities(stripslashes($row['descripcion']));
                $new_row['comentario'] = htmlentities(stripslashes($row['comentario']));


                $row_set[] = $new_row; //build an array
            }
            return json_encode($row_set); //format the array into json data
        }
    }
    function get_estadisticasVendaDevolucion($fechaInicio,$fechaFinal){
        $sql = "select sum(cantidad_devuelta) suma "
                . "from devolucion_envase en, pedido pe "
                . "where en.id_producto =1 and "
                . "en.id_pedido = pe.id and "
                . "en.fecha_devolucion  between date('$fechaInicio') and date('$fechaFinal')";
        $sqlVenta= "select sum(cantidad) suma "
                . "from pedido pe, pedido_producto pro "
                . "where pe.id = pro.id_pedido and pro.id_producto = 1 and "
                . "fecha_pedido between date('$fechaInicio') and date('$fechaFinal')";
        
        
        try {
            $query = $this->db->query($sql);
            
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $new_row['sumaDevolucion'] = htmlentities(stripslashes( $row['suma']));
                }
            }
            $query2 = $this->db->query($sqlVenta);
             if ($query2->num_rows() > 0) {
                foreach ($query2->result_array() as $row) {
                    $new_row['sumaVenta'] = htmlentities(stripslashes( $row['suma']));
                }
            }
            $row_set[] = $new_row; //build an array
            return json_encode($row_set); //format the array into json data

        } catch (Exception $e) {
            return false;
        }
    }
}

<?php

class Servicios_model_select extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->model('utils_model');
    }

    function mostrarDatos($nombre_fun) {

        if ($nombre_fun == 'verCotizaciones') {

            $query = $this->db->query('SELECT * FROM solicitud_cotizacion order by id desc');

            return $query;
        }
        if ($nombre_fun == 'ventasOficina') {
            $query = $this->db->query("select id_venta,to_char(fecha,'DD-MM-YYYY - HH24:mi') as fecha ,nombre,detalle from ventas_oficina v, usuario u where v.id_usuario = u.id");
            return $query;
        }
        
        if ($nombre_fun == 'verPedidos') {

            $query = $this->db->query("select pe.id,nombre_rzn_social,rut,dv, to_char(fecha_pedido,'DD-MM-YYYY') fecha_pedido, to_char(fecha_estimada,'DD-MM-YYYY') fecha_estimada, estado "
                . "from cliente cl, contacto co, pedido pe "
                . "where cl.rut = co.rut_cliente and co.id_contacto = pe.id_contacto_cliente");
            return $query;
        }
        if ($nombre_fun == 'verFacturas') {
            $nomEmpresa = $this->input->post("nomEmpresa");
            if ($nomEmpresa != '') {
                $query = $this->db->query("select cli.nombre_rzn_social,
                cli.rut, cli.dv,con.nombre,pdd.id, to_char(pdd.fecha_pedido,'DD-MM-YYYY - HH24:mi') as fecha_pedido,
                to_char(pdd.fecha_entrega,'DD-MM-YYYY - HH24:mi') as fecha_entrega,pdd.factura, pdd.guia,pdd.estado_pago
        from pedido pdd, contacto con, cliente cli
        where pdd.id_contacto_cliente = con.id_contacto and
        cli.rut = con.rut_cliente 
        and pdd.factura != 0
        and cli.rut =" . $nomEmpresa);
            } else {
                $query = $this->db->query("select cli.nombre_rzn_social,
                cli.rut, cli.dv,con.nombre,pdd.id, to_char(pdd.fecha_pedido,'DD-MM-YYYY - HH24:mi') as fecha_pedido,
                to_char(pdd.fecha_entrega,'DD-MM-YYYY - HH24:mi') as fecha_entrega,pdd.factura, pdd.guia,pdd.estado_pago
        from pedido pdd, contacto con, cliente cli
        where pdd.id_contacto_cliente = con.id_contacto 
        and pdd.factura != 0
        and cli.rut = con.rut_cliente ");
            }

            return $query;
        }
        if ($nombre_fun == 'verGuias') {
            $nomEmpresa = $this->input->post("nomEmpresa");
            if ($nomEmpresa != '') {
                $query = $this->db->query("select cli.nombre_rzn_social,
                cli.rut, cli.dv,con.nombre,pdd.id, to_char(pdd.fecha_pedido,'DD-MM-YYYY - HH24:mi') as fecha_pedido,
                to_char(pdd.fecha_entrega,'DD-MM-YYYY - HH24:mi') as fecha_entrega,pdd.factura, pdd.guia,pdd.estado_pago
        from pedido pdd, contacto con, cliente cli
        where pdd.id_contacto_cliente = con.id_contacto and
        cli.rut = con.rut_cliente 
        and pdd.guia != 0
        and cli.rut =" . $nomEmpresa);
            } else {
                $query = $this->db->query("select cli.nombre_rzn_social,
                cli.rut, cli.dv,con.nombre,pdd.id, to_char(pdd.fecha_pedido,'DD-MM-YYYY - HH24:mi') as fecha_pedido,
                to_char(pdd.fecha_entrega,'DD-MM-YYYY - HH24:mi') as fecha_entrega,pdd.factura, pdd.guia,pdd.estado_pago
        from pedido pdd, contacto con, cliente cli
        where pdd.id_contacto_cliente = con.id_contacto 
        and pdd.guia != 0
        and cli.rut = con.rut_cliente ");
            }

            return $query;
        }


        if ($nombre_fun == 'verEnvasesDevueltos') {

            $query = $this->db->query("select id_pedido, cantidad_devuelta, to_char(fecha_devolucion,'DD-MM-YYYY - HH24:mi') fecha_devolucion , comentarios, factura, guia, comentario, nombre "
                . "from devolucion_envase en, pedido pe, contacto co "
                . "where en.id_pedido = pe.id and pe.id_contacto_cliente = co.id_contacto");
            return $query;
        }
        if ($nombre_fun == 'verListaCliente') {

            $query = $this->db->query("select * "
                . " from cliente ");
            return $query;
        }
        
    }

}

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
        if ($nombre_fun == 'verPedidos') {

            $query = $this->db->query("select pe.id,nombre_rzn_social,rut,dv, to_char(fecha_pedido,'DD-MM-YYYY') fecha_pedido, to_char(fecha_estimada,'DD-MM-YYYY') fecha_estimada,
                cantidad, id_producto ,pr.nombre, detalle , estado
                from cliente cl, contacto co, pedido pe, pedido_producto pp, producto pr
                where cl.rut = co.rut_cliente and co.rut_contacto = pe.rut_contacto_cliente and pe.id = pp.id_pedido and pp.id_producto = pr.id
                order by id_pedido, fecha_pedido");


            return $query;
        }
        if ($nombre_fun == 'verEnvasesDevueltos') {
//            realiza diferencia de envases 
//        select (pp.cantidad - (select sum(pde.cantidad_devuelta) from pedido_producto pp, pago_devolucion_envase pde, pedido pdd, contacto cont where pp.id_pedido = pde.id_pedido and pp.id_pedido=pdd.id and pdd.rut_contacto_cliente = cont.rut_contacto and cont.rut_cliente = 6457478)) as pendiente_devolucion from pedido_producto pp, pago_devolucion_envase pde, pedido pdd, contacto cont where pp.id_pedido = pde.id_pedido and pp.id_pedido=pdd.id and pdd.rut_contacto_cliente = cont.rut_contacto and cont.rut_cliente = 6457478 group by pp.id_pedido,pp.id_producto, cantidad;
        }
        
        
        }

}

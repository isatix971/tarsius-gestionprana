<?php

class Servicios_model_insert extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->model('utils_model');
        $this->load->model('envio_correos');
        $this->load->library('email');

    }

    function almacenar($nombre_fun) {

        if ($nombre_fun == 'almacenarCliente') {

            $nomEmpresa = strtoupper($this->input->post('nomEmpresa'));
            $rutEmpresa = $this->input->post('rutEmpresa');
            $giro = strtoupper($this->input->post('giro'));
            $telefono = $this->input->post('telefono');
            $calle = strtoupper($this->input->post('calle'));
            $numero = $this->input->post('numero');
            $depto = $this->input->post('depto');
            $ciudad = strtoupper($this->input->post('ciudad'));
            $nombreContacto = strtoupper($this->input->post('nombreContacto'));
            $correoContacto = strtoupper($this->input->post('correoContacto'));
            $rutContacto = $this->input->post('rutContacto');
            $telefonoContacto = $this->input->post('telefonoContacto');


            $rut1 = str_replace(".", "", $rutEmpresa);
            $rutdv1 = explode('-', $rut1);


            $sql = "INSERT INTO cliente(rut,dv,nombre_rzn_social,giro,telefono) "
                    . "VALUES (" . $rutdv1[0] . ",'" . $rutdv1[1] . "','" . $nomEmpresa . "','" . $giro . "'," . $telefono . ")";
//            
            $this->db->query($sql);

            $rut2 = str_replace(".", "", $rutContacto);
            $rutdv2 = explode('-', $rut2);

            if ($rutContacto!=""){
                $sql = "INSERT INTO contacto (nombre,correo,contrasena,rut_cliente,rut_contacto,dv_contacto,telefono,id_contacto)"
                    . "VALUES ('$nombreContacto','$correoContacto','contrasena',$rutdv1[0],$rutdv2[0],'$rutdv2[1]',$telefonoContacto,nextval('id_contacto_seq'))";
            }
            else {
                $sql = "INSERT INTO contacto (nombre,correo,contrasena,rut_cliente,telefono,id_contacto)"
                               . "VALUES ('$nombreContacto','$correoContacto','contrasena',$rutdv1[0],$telefonoContacto,nextval('id_contacto_seq'))";
            }
            $this->db->query($sql);

            $sql = "INSERT INTO direccion (rut_cliente,calle,numero,casa_depto,comuna,ciudad)"
                    . "VALUES (" . $rutdv1[0] . ",'" . $calle . "','" . $numero . "','" . $depto . "','" . $ciudad . "','" . $ciudad . "')";

            try {
                $result = $this->db->query($sql);
                if (!$result) {
                    throw new Exception('error in query');
                    return false;
                }

                return 'Cliente almacenado con exito!';
            } catch (Exception $e) {
                return false;
            }
        }
        if ($nombre_fun == 'almacenarContactoCliente') {

            $rutEmpresa = strtoupper($this->input->post("nomEmpresa"));
            $nombreContacto = strtoupper($this->input->post("nombreContacto"));
            $correoContacto = strtoupper($this->input->post("correoContacto"));
            $rutContacto = $this->input->post("rutContacto");
            $telefonoContacto = $this->input->post("telefonoContacto");


            $rut2 = str_replace(".", "", $rutContacto);
            $rutdv2 = explode('-', $rut2);
            if ($rutContacto!=""){
                $sql = "INSERT INTO contacto (nombre,correo,contrasena,rut_cliente,rut_contacto,dv_contacto,telefono,id_contacto)"
                    . "VALUES ('$nombreContacto','$correoContacto','contrasena',$rutEmpresa,$rutdv2[0],'$rutdv2[1]',$telefonoContacto,nextval('id_contacto_seq'))";
            }
            else {
                $sql = "INSERT INTO contacto (nombre,correo,contrasena,rut_cliente,telefono,id_contacto)"
                               . "VALUES ('$nombreContacto','$correoContacto','contrasena',$rutEmpresa,$telefonoContacto,nextval('id_contacto_seq'))";
             }
            try {
                $result = $this->db->query($sql);
                if (!$result) {
                    throw new Exception('error in query');
                    return false;
                }

                return 'Contacto almacenado con exito!';
            } catch (Exception $e) {
                return false;
            }
        }
        if ($nombre_fun == 'almacenarDireccionCliente') {
            
            
            $rutEmpresa = $this->input->post('rutEmpresa');
            $giro = strtoupper($this->input->post('giro'));
            $telefono = $this->input->post('telefono');
            $calle = strtoupper($this->input->post('calle'));
            $numero = $this->input->post('numero');
            $depto = $this->input->post('depto');
            $ciudad = strtoupper($this->input->post('ciudad'));
            
            $rut1 = str_replace(".", "", $rutEmpresa);
            $rutdv1 = explode('-', $rut1);
            
            $sql = "INSERT INTO direccion (rut_cliente,calle,numero,casa_depto,comuna,ciudad)"
                    . "VALUES (" . $rutdv1[0] . ",'" . $calle . "'," . $numero . ",'" . $depto . "','" . $ciudad . "','" . $ciudad . "')";
            
            try {
                $result = $this->db->query($sql);
                if (!$result) {
                    throw new Exception('error in query');
                    return false;
                }

                return 'Contacto almacenado con exito!';
            } catch (Exception $e) {
                return false;
            }
            
        }


        if ($nombre_fun == 'almacenarPedido') {
            $nomEmpresa = $this->input->post("nomEmpresa");
            $idContacto = $this->input->post("contactoCliente");
            $cantidadProducto = $this->input->post("b20");
            $maquinaCantidad = $this->input->post("mqfc");
            $dispensadorCantidad = $this->input->post("dispensador");
            $maquinaDetalle = $this->input->post("mqfcDetalle");
            $fechaEstimada = $this->input->post("fechaEstimada");
            $comentario = $this->input->post("comentario");

            $nfactura = 0;

            $nguia = 0;
            
            //valores por defecto que pueden ser modificados para botellon b20
            $idProducto = 1;
            $valorProducto = 2400;
            
            $estado = "pendiente";

            $sql = "INSERT INTO pedido (id,id_contacto_cliente,fecha_pedido,fecha_estimada,fecha_entrega,factura,guia,estado,estado_pago,comentario)"
                    . "VALUES (nextval('pedido_seq')," . $idContacto . ",now(),'" . $fechaEstimada . "',null,$nfactura,$nguia,'$estado',null,'$comentario')";

            $result_seq = $this->utils_model->get_last_pedido();
            $sql2 = "INSERT INTO pedido_producto (id_pedido,precio_unidad,cantidad,id_producto,detalle)"
                    . "VALUES ($result_seq,$valorProducto,$cantidadProducto,$idProducto,' ')";
            try {
                $result = $this->db->query($sql);
                if (!$result) {
                    throw new Exception('error in query');
                    return false;
                }
                if($cantidadProducto!= ''){
                    $result = $this->db->query($sql2);
                }
                if (!$result) {
                    throw new Exception('error in query');
                    return false;
                }
                if ($maquinaCantidad != '') {
                    $idProducto = 2;
                    $valorProducto = 100000;
                    $sql3 = "INSERT INTO pedido_producto (id_pedido,precio_unidad,cantidad,id_producto,detalle)"
                            . "VALUES ($result_seq,$valorProducto,$maquinaCantidad,$idProducto,'$maquinaDetalle')";
                    $result = $this->db->query($sql3);
                    if (!$result) {
                        throw new Exception('error in query');
                        return false;
                    }
                }
                if ($dispensadorCantidad != '') {
                    $idProducto = 3;
                    $valorProducto = 5000;
                    $sql3 = "INSERT INTO pedido_producto (id_pedido,precio_unidad,cantidad,id_producto,detalle)"
                            . "VALUES ($result_seq,$valorProducto,$dispensadorCantidad,$idProducto,' ')";
                    $result = $this->db->query($sql3);
                    if (!$result) {
                        throw new Exception('error in query');
                        return false;
                    }
                }

                return "Pedido almacenado";
            } catch (Exception $e) {
                return false;
            }
        }

        if ($nombre_fun == 'almacenarUsuario') {

            $nombreContacto = $this->input->post("nombreContacto");
            $correoContacto = $this->input->post("correoContacto");
            $clave = $this->input->post("clave");
            $perfil = $this->input->post("perfil");


            $sql = "INSERT INTO usuario (id,nombre,correo,clave,perfil)
                VALUES (nextval('usuarios_id_seq'::regclass),'$nombreContacto','$correoContacto','$clave'"
                    . ",'$perfil')";
            try {
                $result = $this->db->query($sql);
                if (!$result) {
                    throw new Exception('error in query');
                    return false;
                }

                return 'Usuario almacenado con exito!';
            } catch (Exception $e) {
                return false;
            }
        }

        if ($nombre_fun == 'almacenarDespacho') {

            $idDespacho = $this->input->post("idDespacho");
            $b20devueltos = $this->input->post("b20devueltos");
            $comentarios = $this->input->post("comentarios");
            $estadopago = $this->input->post("estadopago");
//            id de producto es 1 que corresponde a los botellones de 20L

            $sql = "INSERT INTO devolucion_envase (id,id_pedido,id_producto,cantidad_devuelta,fecha_devolucion,comentarios,estado_pago)
                    VALUES (nextval('devolucion_envase_seq'::regclass),$idDespacho,1,$b20devueltos,now(),'$comentarios'"
                    . ",'null')";
            $sql_update = "UPDATE pedido SET fecha_entrega=now(), estado='entregado',estado_pago = '$estadopago' WHERE id='$idDespacho'";

            $sqlcorreo= "select correo from pedido pe, contacto co where co.id_contacto = pe.id_contacto_cliente and pe.id = '$idDespacho'";
            
            try {
                $result = $this->db->query($sql);
                $result_update = $this->db->query($sql_update);
                
                $correo = "fail@correo.cl";
                foreach ($this->db->query($sqlcorreo)->result() as $row)
                {
                        $correo= $row->correo;
                }
                $this->envio_correos->envio_correo_cierre_despacho($correo,$idDespacho,$b20devueltos);
              
                if (!$result) {
                    throw new Exception('error in query');
                    return false;
                }
                if (!$result_update) {
                    throw new Exception('error in query');
                    return false;
                }

                return 'Pedido finalizado correctamente';
            } catch (Exception $e) {
                return false;
            }
        }

        if ($nombre_fun == 'almacenarStockManana') {

            $b20vacios  = $this->input->post("envVacios");
            $b20llenos = $this->input->post("envLLenos");

            $idLLenador = 1;
            
            $sql = "INSERT INTO stock_llenado (id_llenador,manana_tarde,llenos,vacios,fecha,llenado_diario) "
                    . "VALUES ($idLLenador,'manana',$b20llenos,$b20vacios,now(),0)";

            try {
                $result = $this->db->query($sql);

                if (!$result) {
                    throw new Exception('error in query');
                    return false;
                }
                

                return 'Stock almacenado correctamente';
            } catch (Exception $e) {
                return false;
            }
        }
        if ($nombre_fun == 'almacenarStockTarde') {

            $b20vacios  = $this->input->post("envVacios");
            $b20llenos = $this->input->post("envLLenos");
            $llenado = $this->input->post("llenado");

            $idLLenador = 1;
            
            $sql = "INSERT INTO stock_llenado (id_llenador,manana_tarde,llenos,vacios,fecha,llenado_diario) "
                    . "VALUES ($idLLenador,'tarde',$b20llenos,$b20vacios,now(),$llenado)";

            try {
                $result = $this->db->query($sql);

                if (!$result) {
                    throw new Exception('error in query');
                    return false;
                }
                

                return 'Stock almacenado correctamente';
            } catch (Exception $e) {
                return false;
            }
        }
        if ($nombre_fun == 'almacenarCargaDescarga') {

            $b20vacios  = $this->input->post("envVacios");
            $b20llenos = $this->input->post("envLLenos");
            $usuario = $this->input->post("usuario");

            $idLLenador = 1;
            $id_producto =1;
            
//            $sql = "INSERT INTO car (id_llenador,manana_tarde,llenos,vacios,fecha,llenado_diario) "
//                    . "VALUES ($idLLenador,'tarde',$b20llenos,$b20vacios,now(),$llenado)";
            
            $sql = "INSERT INTO carga_descarga (fecha,id_llenador,id_usuario,id_producto,llenos,vacios)"
                    . "VALUES (now(),$idLLenador,$usuario,$id_producto,$b20llenos,$b20vacios)";

            try {
                $result = $this->db->query($sql);

                if (!$result) {
                    throw new Exception('error in query');
                    return false;
                }
                

                return 'Stock almacenado correctamente';
            } catch (Exception $e) {
                return false;
            }
        }
        if ($nombre_fun == 'almacenarVentaOficina') {

            $b20  = $this->input->post("b20");
            $b12  = $this->input->post("b12");
            $dispensador = $this->input->post("dispensador");
            $envaseB20 = $this->input->post("envaseB20");
            $detalle = $this->input->post("detalle");
            $usuario = $_SESSION["id"];

            if(empty($detalle)){
                $detalle = " ";
            }
            $sqlVenta = "INSERT INTO ventas_oficina (id_venta,fecha,id_usuario,tipo,detalle) "
            . "VALUES (nextval('ventas_oficina_seq'::regclass),now(),$usuario,'recarga','$detalle')";
            try {
                    $result = $this->db->query($sqlVenta);

                    if (!$result) {
                        throw new Exception('error in query');
                        return false;
                    }
                }
                catch (Exception $e) {
                    return false;
                }
            $result_seq = $this->utils_model->get_last_pedidoOficina();

            if(isset($b20)&&!empty($b20)){
                $sqlProducto1 = "INSERT INTO ventas_oficina_detalle (id_venta,id_producto,cantidad) VALUES ($result_seq,1,$b20)";
            
                try {
                    $result = $this->db->query($sqlProducto1);

                    if (!$result) {
                        throw new Exception('error in query');
                        return false;
                    }
                }
                catch (Exception $e) {
                    return false;
                }
            }
           
            if(isset($b12)&&!empty($b12)){
                $sqlProducto2 = "INSERT INTO ventas_oficina_detalle (id_venta,id_producto,cantidad) VALUES ($result_seq,4,$b12)";
                try {
                    $result = $this->db->query($sqlProducto2);

                    if (!$result) {
                        throw new Exception('error in query');
                        return false;
                    }
                }
                catch (Exception $e) {
                    return false;
                }
            }
            if(isset($dispensador)&&!empty($dispensador)){
                $sqlProducto3 = "INSERT INTO ventas_oficina_detalle (id_venta,id_producto,cantidad) VALUES ($result_seq,3,$dispensador)";
                try {
                    $result = $this->db->query($sqlProducto3);

                    if (!$result) {
                        throw new Exception('error in query');
                        return false;
                    }
                }
                catch (Exception $e) {
                    return false;
                }
            }
             if(isset($envaseB20)&&!empty($envaseB20)){
                $sqlProducto4 = "INSERT INTO ventas_oficina_detalle (id_venta,id_producto,cantidad) VALUES ($result_seq,5,$envaseB20)";
                try {
                    $result = $this->db->query($sqlProducto4);

                    if (!$result) {
                        throw new Exception('error in query');
                        return false;
                    }
                }
                catch (Exception $e) {
                    return false;
                }
            }
            setlocale(LC_TIME,"es_ES");
            return "<div class='alert alert-danger alert-dismissable'"
            . "<i class='fa fa-camera-retro'>VENTA REGISTRADA hoy: ".strftime(" %A las %H:%M")."</i>   <br> Se registro la venta de: </br></div>"
            . "Recarga de Bidones de 20 Litros - <label class='alert-danger'>$b20</label> </br>"
            . "Recarga de Bidones de 12 Litros - <label class='alert-danger'>$b12</label> </br>"
            . "Venta de Dispensador Plastico - <label class='alert-danger'>$dispensador</label> </br>"
            . "Venta de Bidones de 20 Litros - <label class='alert-danger'>$envaseB20</label> </br></br></br>"
            . "<a type='button'  "
            . "href='".base_url()."index.php/main?select=ventasOficina'class='btn btn-info btn-block'>INGRESAS NUEVA VENTA</a>";
            

         
        }
        //envia mensaje 
        if ($nombre_fun == 'envioCotizacion') {

//            este metodo se debe completar para almacenar una cotizacion realizada.

            return "Solicitud o cotizacion realizada";
        }
    }

}

?>

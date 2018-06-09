<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Envio_correos extends CI_Model {

    
     function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('email');

    }

    function get_id_usuario_conectado(){
        return $_SESSION["correo"];
    }
    
    
    function envio_correo_cierre_despacho($correo,$idDespacho,$b20devueltos){
        
                $this->email->from('ventas@aguaprana.cl', 'Ventas Prana despacho ');
                
                $this->email->to($correo);
                $this->email->subject('Agua Purificada Despacho Recepcionado: '.$idDespacho);
                $mensaje = 'Estimado(a) Cliente,' . "\r\n";
                $mensaje .= 'se informa que su despacho ha sido recepcionado:' . "\r\n\r\n\n";
                $mensaje .= 'El despachador ha informado que el total de ENVASES VACIOS DEVUELTOS SON: '.$b20devueltos. "\r\n\n";
                $mensaje .= 'Si la informacion esta erronea escribir a paulavergara@aguaprana.cl con el numero de despacho: '.$idDespacho . "\n";
                $mensaje .= 'Para realizar pedido escribir a ventas@aguaprana.cl adjuntando cotización.' . "\r\n";
                $mensaje .= 'Para temas de facturacion escribir a facturacion@aguaprana.cl' . "\r\n\r\n\r\n";
                $mensaje .= 'Saludos cordiales' . "\r\n";

                $this->email->message($mensaje);
                
                try {
                    $this->email->send();
                } catch (Exception $ex) {
                    
                }
                
                $this->email->to("paulavergara@aguaprana.cl");
                $this->email->subject('Agua Purificada Despacho Recepcionado: '.$idDespacho);
                $this->email->send();
                
                $this->email->to($_SESSION["correo"]);
                $this->email->subject('Despacho Recepcionado: '.$idDespacho);
                $this->email->send();
    }
    
    
    
}
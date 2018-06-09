<?Php

//birds.php
class Utils extends CI_Controller {

    function __construct() {
        parent::__construct();


        $this->load->helper('url');
        $this->load->model('utils_model');
    }

    function index() {
        $this->load->view('prueba');
    }

    function get_clientes() {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            echo $this->utils_model->get_cliente($q);
        }
    }

    function get_contactos() {
        if (isset($_POST['id'])) {
            $q = $_POST['id'];
            echo $this->utils_model->get_contacto($q);
        }
    }
    function get_info_contactos() {
        if (isset($_POST['id'])) {
            $q = $_POST['id'];
            echo $this->utils_model->get_info_contactos($q);
        }
    }
    

    function get_despachadores() {

        echo $this->utils_model->get_despachador();
    }
        function get_usuarios() {

        echo $this->utils_model->get_usuario();
    }

    function get_pedidosDespachador() {

        if (isset($_POST['id'])) {
//            echo $_GET['term'];
            $q = strtolower($_POST['id']);
            echo $this->utils_model->get_pedidosDespachador($q);
        }
    }
    
    function get_rut_cliente_almacenado() {
        if (isset($_POST['rut'])) {
//            echo $_GET['term'];
            $q = $_POST['rut'];

            $rut1 = str_replace(".", "", $q );
            $rutdv1 = explode('-', $rut1);
        }
        echo $this->utils_model->get_cliente_existe($rutdv1[0]);
    }
    function get_rut_contacto_almacenado() {
        if (isset($_POST['rut'])) {
//            echo $_GET['term'];
            $q = $_POST['rut'];

            $rut1 = str_replace(".", "", $q );
            $rutdv1 = explode('-', $rut1);
        }
        echo $this->utils_model->get_contacto_existe($rutdv1[0]);
    }
    
    function get_infoPedido() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        echo $this->utils_model->get_infoPedido($id);
    }
    function show() {
        $this->load->view('prueba'); //envío al usuario a la pag. de autenticación 
    }
    
    function get_estadisticasVendaDevolucion(){
        $mes= date("m");
        $ano = date("Y");
        $mes2= $mes +1;

        $fechaInicio = $ano."-".$mes."-01";
        $fechaFinal = $ano."-".$mes2."-01";
        echo $this->utils_model->get_estadisticasVendaDevolucion($fechaInicio,$fechaFinal);
        
    }
    

}

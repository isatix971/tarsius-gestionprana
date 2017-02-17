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

    function get_despachadores() {

        echo $this->utils_model->get_despachador();
    }



    function get_pedidosDespachador() {

        if (isset($_POST['id'])) {
//            echo $_GET['term'];
            $q = strtolower($_POST['id']);
            echo $this->utils_model->get_pedidosDespachador($q);
        }
    }

    function show() {
        $this->load->view('prueba'); //envío al usuario a la pag. de autenticación 
    }

}

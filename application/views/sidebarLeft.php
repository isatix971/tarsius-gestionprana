<nav class="sidebar sidebar-left">
    <h5 class="sidebar-header">Navigación</h5>
    <ul class="nav nav-pills nav-stacked">

        <li class="nav-dropdown">
            <a href="#" title="Maps">
                <i class="icon-pointer"></i> Herramientas
            </a>
            <ul class="nav-sub">
                <li><a href="<?= base_url();?>index.php/main?select=verCotizaciones">Solicitudes de cotizaciones</a>
                </li>
                <li><a href="<?= base_url();?>index.php/main?op=cotizador">Cotizador</a>
                </li>
                <li><a href="<?= base_url();?>index.php/main?op=agregarusuario">Agregar Usuarios</a>
                </li>
                
                <li><a href="http://www.sii.cl/factura_electronica/factura_sii/factura_sii.htm">Facturas Electronicas</a>
                </li>
                
            </ul>
             
            
           
        </li>
        <li class="nav-dropdown">
            <a href="#" title="Maps">
                <i class="icon-user"></i> Clientes
            </a>
            <ul class="nav-sub">

                <li><a href="<?= base_url();?>index.php/main?op=agregarcliente">Agregar Clientes</a>
                </li>
                <li><a href="<?= base_url();?>index.php/main?op=contactoCliente">Agregar Contacto Clientes</a>
                </li>
            </ul>
        </li>
        <li class="nav-dropdown">
            <a href="#" title="Maps">
                <i class="fa fa-truck"></i> Pedidos
            </a>
            <ul class="nav-sub">
                <li><a href="<?= base_url();?>index.php/main?op=pedido">Realizar Pedidos</a>
                </li>
                <li><a href="<?= base_url();?>index.php/main?select=verPedidos">Estado Pedidos</a>
                </li>
            </ul>
        </li>
        <li class="nav-dropdown">
            <a href="#" title="Maps">
                <i class="fa fa-truck"></i> Facturas/Guias
            </a>
            <ul class="nav-sub">
                <li><a href="<?= base_url();?>index.php/main?op=verFacturas">Ver Facturas</a>
                </li>
                <li><a href="<?= base_url();?>index.php/main?select=verGuias">Ver Guias</a>
                </li>
                

            </ul>
        </li>
        <li class="nav-dropdown">
            <a href="#" title="Maps">
                <i class="fa fa-shopping-cart"></i> Finalizar Pedidos
            </a>
            <ul class="nav-sub">
                <li><a href="<?= base_url();?>index.php/main?op=entregaDespacho">Entregar Pedido</a>
                </li>
<!--                <li><a href="<?= base_url();?>index.php/main?op=buscarcliente">Estado Pedidos</a>
                </li>-->
<!--                <li><a href="<?= base_url();?>index.php/main?op=agregarcliente"> Clientes</a>
                </li>-->

            </ul>
        </li>

    </ul>
</nav>
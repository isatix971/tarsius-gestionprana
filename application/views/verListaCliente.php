<section class="main-content-wrapper">
    <section id="main-content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Clientes almacenados</h3>

                    </div>
                    <div class="panel-body">
                        

                        <?php
//rut	dv	nombre_rzn_social	giro	telefono                        
if (isset($resultado)) {
                            echo "<table id='clientesAlmacenados' class='table  table-bordered' cellspacing='0' width='100%'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Nombre o razon social</th>";
                            echo "<th>Giro</th>";
                            echo "<th>Telefono</th>";
                            echo "<th>Rut</th>";
                            echo "<th>Opcion</th>";

                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            foreach ($resultado->result_array() as $row):
//nombre_rzn_social	rut	dv	nombre	id	fecha_pedido	fecha_entrega	factura	guia	estado_pago
                                echo "<td>" . $row['nombre_rzn_social'] . "</td>";
                                echo "<td>" . $row['giro'] . "</td>";
                                echo "<td>" . $row['telefono'] . "</td>";
                                echo "<td>" . $row['rut'] . "-" . $row['dv'] . "</td>";
                                echo "<td><div class='btn-group'><button onClick='verContactos(" . $row['rut'] . "," . $row['dv'] . ")'  type='button' class='btn btn-primary' data-toggle='modal' data-target='#infoContactos'>Contactos</button>";
                                //echo "<button onClick='editarCliente(" . $row['rut'] . ")'  type='button' class='btn btn-info' data-toggle='modal' data-target='#infoDespacho'>Editar</button>";
                                echo "</div></td>";
                                echo "</tr>";
                            endforeach;
                            echo "</tbody>";
                            echo "</table>";
                        }
                        ?>

                    </div>
                </div>

            </div>

    </section>
</section>


<div class="modal fade" id="infoContactos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>
<script>
    $(document).ready(function () {
        $('#clientesAlmacenados').dataTable({
            "order": [[ 0, "desc" ]]
        });
    });
    
    
    function verContactos(rutCliente,dv) {
        html = "";
        html += "<div class='modal-dialog'>";
        html += "<div class='modal-content'>";
        html += "<div class='modal-header'>";
        html += "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
        html += "<h4 class='modal-title' id='myModalLabel'>Informacion de Contacto de Cliente rut: "+rutCliente+"-"+dv+"  </h4>";
        html += "</div>";
        html += "<div class='modal-body' id='infoContactos'>";
                
        
        html += "<form class='form-horizontal' role='form'>";
        html += "<div class='form-group has-warning'>";

       // html += "<label class='col-sm-3 control-label'>ID Pedido:  </label>";
        html += "<div class='col-sm-10'>";

        html += "<table   id = 'tablaInfo' name = 'tablaInfo' class = 'table  table-bordered dataTable no-footer' >";
        html += "</table>";
        html += "</div>";
        html += "</div>";
        html += "</form>";
        

        html += "</div>";
        html += "<div class='modal-footer'>";
        html += "<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>";
        html += "</div>";
        html += "</div>";
        $('#infoContactos').empty();
        $('#infoContactos').append(html);
        rescatarInfo(rutCliente);
    }
    
    
    function rescatarInfo(id ) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('utils/get_info_contactos'); ?>",
            data: {id: id }
        })
                .done(function (respuesta) {
                    var objetos = jQuery.parseJSON(respuesta);

                    var tabla   = document.getElementById('tablaInfo');
                    var tblBody = document.createElement("tbody");

                    var hilera = document.createElement("tr");
                    var celda1 = document.createElement("td");
                    var celda2 = document.createElement("td");
                    var celda3 = document.createElement("td");
                    var celda4 = document.createElement("td");

                    var nombre = document.createTextNode("NOMBRE");
                    var correo = document.createTextNode("CORREO");
                    var telefono = document.createTextNode("TELEFONO");
                    var opciones = document.createTextNode("OPCIONES");

                    celda1.appendChild(nombre);
                    celda2.appendChild(correo);
                    celda3.appendChild(telefono);
                    celda4.appendChild(opciones);

                    hilera.appendChild(celda1);
                    hilera.appendChild(celda2);
                    hilera.appendChild(celda3);
                    hilera.appendChild(celda4);

                    tblBody.appendChild(hilera);
                    
                    for (var i = 0; i < objetos.length; i++) {
                        var hilera = document.createElement("tr");
                        var celda1 = document.createElement("td");
                        var celda2 = document.createElement("td");
                        var celda3 = document.createElement("td");
                        var celda4 = document.createElement("td");
                        
                        var nombre = document.createTextNode(objetos[i].nombre);
                        var correo = document.createTextNode(objetos[i].correo);
                        var telefono = document.createTextNode(objetos[i].telefono);
                        html = "";
                        html += "<button onClick='editarCliente(" + objetos[i].id + ")'  type='button' ";
                        html += "class='btn btn-info' data-toggle='modal' data-target='#infoDespacho'>Editar</button>";
                        var boton = document.createElement(html);

                        celda1.appendChild(nombre);
                        celda2.appendChild(correo);
                        celda3.appendChild(telefono);
                        celda4.appendChild(boton);
                        
                        hilera.appendChild(celda1);
                        hilera.appendChild(celda2);
                        hilera.appendChild(celda3);
                        hilera.appendChild(celda4);
                       
                        tblBody.appendChild(hilera);    
                        
                    }                    
                    //document.getElementById('comentario').innerHTML = "Comentaios: "+comentarioResponse+"<br><br>";

                    tabla.appendChild(tblBody);
                    
                });
    }
</script>
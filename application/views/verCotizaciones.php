<section class="main-content-wrapper">
    <section id="main-content">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cotizaciones solicitadas</h3>
                        <div class="actions pull-right">
                            <i class="fa fa-chevron-down"></i>
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
                        echo "<table id='cotizaciones' class='table table-striped table-bordered' cellspacing='0' width='100%'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>id</th>";
                        echo "<th>nombre</th>";
                        echo "<th>correo</th>";
                        echo "<th>telefono</th>";
                        echo "<th>fecha</th>";
                        echo "<th>mensaje</th>";
                        echo "<th>accion</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        foreach ($resultado->result_array() as $row):
                            $idMensaje = $row['id'];
                            echo "<tr id='id_" . $row['id'] . "'>";
                            echo "<td > " . $row['id'] . "</td>";
                            echo "<td>" . $row['nombre'] . "</td>";
                            echo "<td>" . $row['correo'] . "</td>";
                            echo "<td>" . $row['telefono'] . "</td>"; //esto genera un link con el mismo nombre.
//                            echo "</form>";
                            echo "<td>" . substr($row['fecha'], 0, 10) . "</td>";
                            echo "<td>";


                            echo $row['mensaje'];
                            echo "</td>";
                            echo "<td class='col-md-3'>";
                            echo "<div class='btn-group'>";

                            echo "<button onClick='crearCotizacion(";
                            echo $row['id'];
                            echo ")' type='button' class='btn btn-primary'>Enviar</button>";

                            echo "<button onClick='eliminarCotizacion(" . $row['id'] . ")' type='button' class='btn btn-danger'>Eliminar</button>";
                            echo "</div>";

                            echo "</td>";
                            echo "</tr>";
                        endforeach;
                        echo "</tbody>";
                        echo "</table>";
                        ?>




                    </div>
                </div>
            </div>
        </div>

    </section>
</section>
<script>
    $(document).ready(function () {
        $('#cotizaciones').dataTable();
    });



    function eliminarCotizacion(id) {

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('main?delete=deleteCotizacion'); ?>",
            data: {idcotizacion: id}
        })
                .done(function (respuesta) {

                    if (respuesta == 'ok') {
                        alertify.success("cotizacion eliminada");
                        location.reload();

                    } else {
                        alertify.error("ocurrio un error (Ecot01)");

                    }

                });
    }
    function crearCotizacion(id) {

        var data=[];
                var i = 0;
        $("#id_" + id + " td").each(function (index) {

            data[i] = $(this).text();
            i++;
        });
//        alert(data);
        $.post( "http://www.isatix.org/tarsius/index.php/main?select=cotizador",
    {
        name: "Donald Duck",
        city: "Duckburg"
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
    });

    }

</script>
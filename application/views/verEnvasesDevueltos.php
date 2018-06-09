<section class="main-content-wrapper">
    <section id="main-content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ver Devoluciones por pedido</h3>

                    </div>
                    <div class="panel-body">
                        

                        <?php
                        //id_pedido, cantidad_devuelta,	fecha_devolucion,	comentarios, factura, guia, comentario, nombre
                        if (isset($resultado)) {
                            echo "<table id='devolucionesEnvases' class='table  table-bordered' cellspacing='0' width='100%'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Id Pedido</th>";
                            echo "<th>Cantida Devuelta B20</th>";
                            echo "<th>fecha_devolucion</th>";
                            echo "<th>Factura</th>";
                            echo "<th>Guia</th>";
                            echo "<th>Nombre Contacto</th>";
                            echo "<th>Comentarios</th>";
                            

                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            foreach ($resultado->result_array() as $row):
//nombre_rzn_social	rut	dv	nombre	id	fecha_pedido	fecha_entrega	factura	guia	estado_pago
                                echo "<td>" . $row['id_pedido'] . "</td>";
                                echo "<td>" . $row['cantidad_devuelta'] . "</td>";
                                echo "<td>" . $row['fecha_devolucion'] . "</td>";
                                echo "<td>" . $row['factura'] . "</td>";
                                echo "<td>" . $row['guia'] . "</td>";
                                echo "<td>" . $row['nombre'] . "</td>";
                                echo "<td>" . $row['comentarios'] . "<br>-- -- --<br>". $row['comentario'] . "</td>";

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
<script>
    $(document).ready(function () {
        $('#devolucionesEnvases').dataTable({
            "order": [[ 0, "desc" ]]
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#ventasOficina').dataTable({
            "order": [[ 0, "desc" ]]
        });
    });
    function buscarPedidosDespacho() {

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('utils/get_pedidosDespachador'); ?>",
            data: {id: <?php echo $_SESSION["id"]; ?>}
        })
                .done(function (respuesta) {
                    var objetos = jQuery.parseJSON(respuesta);

//                    console.log(respuesta);

                    select = document.getElementById('idDespacho');
                    $('#idDespacho').empty();

                    for (var i = 0; i < objetos.length; i++) {

                        var opt = document.createElement('option');
                        opt.value = objetos[i].value;
                        opt.innerHTML = objetos[i].label;
                        select.appendChild(opt);
                    }
                });
    }

</script>
<section class="main-content-wrapper">
    <section id="main-content">
        <div class="row">
            <div class="col-md-12">
                
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Venta Oficina</h3>

                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal form-border" method="post" action="<?php echo base_url(); ?>index.php/main/?fun=almacenarVentaOficina">
                           

                            <div class="form-group">
                                <label class="col-sm-2 control-label">DETALLES</label>
                            </div>
                             <div class="form-group has-success">
                                <label class="col-sm-3 control-label">Bidones 20 L recarga</label>
                                <div class="col-sm-6">
                                    <input type="number" placeholder="Ingrese Cantidad" id="b20" name="b20"  class="form-control ">
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="col-sm-3 control-label">Bidones 12 L recarga</label>
                                <div class="col-sm-6">
                                    <input type="number" placeholder="Ingrese Cantidad" id="b20" name="b12"  class="form-control ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dispensador Plastico</label>
                                <div class="col-sm-6">
                                    <input type="number" placeholder="Ingrese Cantidad" id="dispensador" name="dispensador" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label class="col-sm-3 control-label">Envase bidon 20 litros</label>
                                <div class="col-sm-6">
                                    <input type="number" placeholder="Ingrese Cantidad" id="envaseB20" name="envaseB20" class="form-control ">
                                </div>
                            </div>
 
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Detalles - Observaciones</label>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Ingrese Observacion" id="detalle" name="detalle" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-8 col-sm-10">
                                    <input class="btn btn-primary" type="submit" value="Registrar Venta" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
               
                
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Venta Oficina</h3>
                    </div>
                    <div >
                        <div class="panel-body">
                        <?php
                        echo "<table id='ventasOficina' data-sort-name='id_venta' data-sort-order='desc' data-locale='es-CL' class='table  table-bordered' cellspacing='0' width='100%'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th data-field='id_venta' data-sortable='true' >N. de Venta</th>";
                        echo "<th>Fecha Pedido</th>";
                        echo "<th>Vendedor</th>";
                        echo "<th>Detalle</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

             
                        foreach ($resultado->result_array() as $row):
                            echo "<td>" . $row['id_venta'] . "</td>";
                            echo "<td>" . $row['fecha'] . "</td>";
                            echo "<td>" . $row['nombre'] . "</td>";
                            echo "<td>" . $row['detalle'] . "</td>";
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


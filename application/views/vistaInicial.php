
<script>
    //jquery

    $(function () {

        buscarEstadisticas();
        

    });
    function buscarEstadisticas() {

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('utils/get_estadisticasVendaDevolucion'); ?>",
            data: {id: <?php echo $_SESSION["id"]; ?>}
        })
                .done(function (respuesta) {
                    var objetos = jQuery.parseJSON(respuesta);

//                    console.log(respuesta);

                    document.getElementById("devueltos").dataset.to = objetos[0].sumaDevolucion;

                    document.getElementById("vendidos").dataset.to= objetos[0].sumaVenta;
                    app.timer();
                    
                });
    }
</script>
<section class="main-content-wrapper">
            <section id="main-content">
                <!--tiles start-->
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="dashboard-tile detail tile-turquoise">
                            <div class="content">
                                <h1 id="vendidos" class="text-left timer" data-from="0" data-to="" data-speed="2500"> </h1>
                                <p>Bidones vendidos en el mes</p>
                            </div>
                            <div class="icon"><i class="fa fa-tint"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="dashboard-tile detail tile-red">
                            <div class="content">
                                <h1 id="devueltos" class="text-left timer" data-from="0" data-to="0" data-speed="2500"> </h1>
                                <p>Envases devueltos en el mes</p>
                            </div>
                            <div class="icon"><i class="fa fa-truck"></i>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-md-6 col-sm-6">
                        <div class="dashboard-tile detail tile-blue">
                            <div class="content">
                                <h1 class="text-left timer" data-from="0" data-to="32" data-speed="2500"> </h1>
                                <p>New Messages</p>
                            </div>
                            <div class="icon"><i class="fa fa fa-envelope"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="dashboard-tile detail tile-purple">
                            <div class="content">
                                <h1 class="text-left timer" data-to="105" data-speed="2500"> </h1>
                                <p>New Sales</p>
                            </div>
                            <div class="icon"><i class="fa fa-bar-chart-o"></i>
                            </div>
                        </div>
                    </div>-->
                </div>

                <!--ToDo start
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">To do list</h3>
                                <div class="actions pull-right">
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="new-todo" type="text" class="form-control" placeholder="What needs to be done?">
                                            <section id='main'>
                                                <ul id='todo-list'></ul>
                                            </section>
                                        </div>
                                        <div class="form-group">
                                            <button id="todo-enter" class="btn btn-primary pull-right">Submit</button>
                                            <div id='todo-count'></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-solid-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Weather</h3>
                                <div class="actions pull-right">
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="text-center small-thin uppercase">Today</h3>
                                        <div class="text-center">
                                            <canvas id="clear-day" width="110" height="110"></canvas>
                                            <h4>62°C</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="text-center small-thin uppercase">Tonight</h3>
                                        <div class="text-center">
                                            <canvas id="partly-cloudy-night" width="110" height="110"></canvas>
                                            <h4>44°C</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>

                ToDo end-->
            </section>
        </section>

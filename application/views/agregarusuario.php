
<section class="main-content-wrapper">
    <section id="main-content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ingreso de Usuario</h3>

                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal form-border" method="post" action="<?php echo base_url(); ?>index.php/main/?fun=almacenarUsuario">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nombre</label>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Ingrese Nombre" required="" id="nombreContacto" name="nombreContacto" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Correo</label>
                                <div class="col-sm-6">
                                    <input type="email" placeholder="Ingrese Correo" required="" id="correoContacto" name="correoContacto" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Clave</label>
                                <div class="col-sm-6">
                                    <input  type="password" placeholder="Ingrese Clave" required="" id="clave" name="clave" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Perfil</label>
                                <div class="col-sm-6">
                                    <div class="radio">

                                        <input class="icheck" value="1" type="checkbox"  id="checkadmin" name="checkadmin">
                                        <label>Administrador</label>
                                    </div>
                                    <div class="radio">

                                        <input class="icheck" value="2" type="checkbox"  id="checkdespa" name="checkdespa">
                                        <label>Despachador</label>
                                    </div>
                                    <div class="radio">

                                        <input class="icheck" value="3" type="checkbox" id="checksecre" name="checksecre">
                                        <label>Oficina</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-8 col-sm-10">
                                    <input class="btn btn-primary" type="submit" value="Enviar" >
                                    <!--                                    <button type="" class="btn btn-primary" onclick="validar()">Enviar</button>-->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </section>
</section>


<?php
    include_once('../../repository/paises.php');
    $country = new Pais();
    $country_data = $country->getData();
?>
<div class="container mb-4">
    <!-- header -->
    <div class="mt-1">
        <h2 class="p-4 mr-4 mt-0" style="color: #333333">
            <a href="#" class="link-header">Empresa</a> | <a href="#" class="link-header"> Persona </a>
        </h2>
        <hr class="hr-header">
    </div>

    <div class="row mt-2">
        <div class="col-12 col-lg-12 col-md-12">
            <h3 class="text-center">
                Para ventas corporativas (Empresas)
            </h3>
            <hr>
        </div>
    </div>
    <div class="row mt-4">
        <h4>Ingresar datos de la Empresa</h4>
        <div class="col-12 col-lg-12 col-md-12 mb-4">
            <form>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">Empresa*</label>
                        <input type="text" class="form-control col-6" id="empresa" name="empresa" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">RUC o equivalente*</label>
                        <input type="text" class="form-control col-6" id="ruc" name="ruc" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">Dirección de la empresa*</label>
                        <input type="text" class="form-control col-6" id="dni" name="dir_empresa" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">Rubro o actividad*</label>
                        <input type="text" class="form-control col-6" id="rubro" name="rubro" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Contacto
                            contable/tesorería/facturación*</label>
                        <input type="text" class="form-control col-6" id="contacto" name="contacto" required>
                    </div>
                    <div class="mb-3 col-lg-6">

                        <label  class="form-label">Pais</label>
                        <select class="form-select form-control" aria-label="Default select example" name="pais" id="pais" required>
                            <option selected value="null">Seleccione una opción del menu</option>
                            <?php foreach ($country_data as $pais) { ?>
                            <option value="<?php echo $pais['id']?>" ><?php echo $pais['nombre']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <hr>
                <h4>Datos del Registrador</h4>
                <div class="row">
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label  class="form-label">Nombres*</label>
                            <input type="text" class="form-control col-6" id="re_nombres" name="re_nombres" required>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label  class="form-label">Apellidos*</label>
                            <input type="text" class="form-control col-6" id="re_apellidos" name="re_apellidos" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Documento de identificación*</label>
                        <input type="text" class="form-control col-6" id="re_dni" name="re_dni" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Correo*</label>
                        <input type="email" class="form-control col-6" id="re_correo" name="email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Cargo*</label>
                        <input type="text" class="form-control col-6" id="re_cargo" name="re_cargo" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Celular*</label>
                        <input type="email" class="form-control col-6" id="re_celular" name="re_celular" required>
                    </div>
                </div>
                <hr>
                <h4>Participantes</h4>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Cantidad de inscripciones a comprar*</label>
                        <input type="number" class="form-control col-6" id="cant_inc" name="cant_inc" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Total*</label>
                        <input type="number" class="form-control col-6" id="total" name="total" required>
                        <div id="emailHelp" class="form-text text-danger">US$58.00 por participante inc. IGV</div>
                    </div>
                </div>
                <h4>Ingresar datos del participante</h4>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Nombres*</label>
                        <input type="text" class="form-control col-6" id="part_nombres" name="part_nombres" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Apellidos*</label>
                        <input type="text" class="form-control col-6" id="part_apellidos" name="part_apellidos" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Dni*</label>
                        <input type="text" class="form-control col-6" id="re_dni" name="part_dni" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Correo*</label>
                        <input type="email" class="form-control col-6" id="part_correo" name="email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Ciudad*</label>
                        <input type="text" class="form-control col-6" id="part_ciudad" name="part_ciudad" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Cargo*</label>
                        <input type="email" class="form-control col-6" id="part_cargo" name="part_cargo" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-check mt-4">
                            <input class="form-check-input mt-2" type="checkbox" value="" id="part_invitado" name="part_invitado">
                            <label class="form-check-label mt-1" for="flexCheckDefault">
                                Invitado
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label  class="form-label">Empresa*</label>
                        <input type="email" class="form-control col-6" id="part_empresa" name="part_empresa" required>
                    </div>
                </div>
                <hr>
                <h4>Ingresar datos de inscritos por cantidad indicada</h4>
                <div class="row">
                    <div class="mb-3 col-lg-12">
                        <input type="text" class="form-control col-6" id="cant_inscritos" name="cant_inscritos" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-siguiente float-end" type="button" id="deposito">Deposito en cuenta</button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-siguiente">Con Tarjeta de Crédito</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <div class="mb-4"></div>
</div>

<script type="text/javascript">
    /*
    jQuery(document).ready(function () {
        jQuery('.paises').select2();
    });*/
</script>

<?php
require_once __DIR__."/../../repository/person.php";
require_once __DIR__."/../../dto/PersonDTO.php";
$error = '';
$success='';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = '';
    $persona = new Person();
    try {
        $personaDTO = new PersonDTO();
        $personaDTO->setName($_POST['nombres']);
        $personaDTO->setLastName($_POST['apellidos']);
        $personaDTO->setDocumentNumber($_POST['dni']);
        $personaDTO->setEmail($_POST['email']);
        $personaDTO->setPhoneNumer($_POST['celular']);
        $save = $persona->postCreatePerson($personaDTO);
        if($save && $save['error'] == 'false'){
            $error = '';
            $success = $save['message'];
        }else{
            $error = $save['message'];
        }
    }catch (Exception $e){
        echo $e;
    }

}
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
            <?php if($error) {?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
            <?php } ?>

            <?php if($success) {?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success ?>
                </div>
            <?php } ?>
            <hr>
        </div>
    </div>
    <div class="row mt-4">
        <h4>Ingresar los datos del participante</h4>
        <div class="col-12 col-lg-12 col-md-12 mb-4">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Nombres*</label>
                        <input type="text" class="form-control col-6" id="nombres" name="nombres" required value="jose gregorio">
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">Apellidos*</label>
                        <input type="text" class="form-control col-6" id="apellidos" name="apellidos" required value="lopez arias">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">Dni*</label>
                        <input type="text" class="form-control col-6" id="dni" name="dni" required value="12315464">
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">Correo*</label>
                        <input type="email" class="form-control col-6" id="correo" name="email" required value="lopezajoseg@gmail.com">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label" required>Ciudad</label>
                        <select class="form-select" aria-label="Default select example" name="tipo" id="tipo">
                            <option selected>Seleccione una opción del menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Centro de estudios*</label>
                        <input type="text" class="form-control col-6" id="centro" name="centro" required value="universidad">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Código de estudiante*</label>
                        <input type="text" class="form-control col-6" id="codigo_estudiante" name="codigo_estudiante" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Celular*</label>
                        <input type="number" class="form-control col-6" id="celular" name="celular" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Total</label>
                        <input type="number" class="form-control col-6" id="total" name="total">
                        <div id="emailHelp" class="form-text text-danger">US$30.00 inc IGV</div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-siguiente float-end" type="submit">Con Tarjeta de Crédito</button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-siguiente" type="submit">Con Tarjeta de Crédito</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <div class="mb-4"></div>
</div>

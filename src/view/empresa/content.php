<?php
require_once __DIR__ . "/../../repository/person.php";
require_once __DIR__ . "/../../dto/PersonDTO.php";
require_once __DIR__ . "/../../repository/paises.php";
require_once __DIR__ . "/../../repository/company.php";
require_once __DIR__ . "/../../dto/CompanyDTO.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = '';
    $company = new Company();
    try {
        $companyDTO = new CompanyDTO();
        $companyDTO->setName($_POST['name']);
        $companyDTO->setAddress($_POST['address']);
        $companyDTO->setDocumentNumber($_POST['ruc']);
        $companyDTO->setParticipantsNumber($_POST['participants_number']);
        $companyDTO->setIdDocumentType('2');
        $companyDTO->setTotal($_POST['total']);
        $companyDTO->setActivity($_POST['activity']);
        $companyDTO->setIdCountry($_POST['country']);
        $companyDTO->setBilling($_POST['billing']);

        $save = $company->postCreateCompany($companyDTO);


        if ($save && $save['error'] == 'false') {

            $persona = new Person();
            $personaDTO = new PersonDTO();
            $personaDTO->setName($_POST['re_nombres']);
            $personaDTO->setLastName($_POST['re_apellidos']);
            $personaDTO->setDocumentNumber($_POST['re_dni']);
            $personaDTO->setEmail($_POST['re_correo']);
            $personaDTO->setPhoneNumer($_POST['re_celular']);
            $personaDTO->setPosition($_POST['position']);
            $personaDTO->setIdDocumentType('2');
            $personaDTO->setTotal(0);

            $save = $persona->postCreatePerson($personaDTO);

            if ($save && $save['error'] == 'false') {
                $findPerson = $persona->getPersonDocumentNumber($_POST['re_dni'], $_POST['re_correo']);
                $findCompany = $company->getCompanyDocumentNumber($_POST['ruc']);
                var_dump($findCompany["id"]);
                var_dump($findPerson["id"]);
                $save = $company->postCreateRelCompanyPerson($findCompany["id"], $findPerson["id"]);
                var_dump($save);
                $error = '';
                //   $success = $save['message'];
            } else {
                $error = $save['message'];
            }
            var_dump($save);
        } else {
            $error = $save['message'];
        }
    } catch (Exception $e) {
        echo $e;
    }
}
$pais = new Pais;
$paises = $pais->getData();
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
        </div>
    </div>
    <div class="row mt-4">
        <h4>Empresa AVEM</h4>
        <hr>
        <div class="col-12 col-lg-12 col-md-12 mb-4">
            <h4>Ingrese los datos de la empresa</h4>
            <form method="post" id="form-empresa" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="name" class="form-label">Empresa*</label>
                        <input type="text" value="lopezajosegmail.com" class="form-control col-6" id="name" name="name" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="ruc" class="form-label">RUC o equivalente*</label>
                        <input type="text" value="lopezajosegmail.com" class="form-control col-6" id="ruc" name="ruc" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="address" class="form-label">Dirección de la empresa*</label>
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="address" name="address" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="activity" class="form-label">Rubro o actividad*</label>
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="activity" name="activity" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="billing" class="form-label">Contacto
                            contable/tesorería/facturación*</label>
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="billing" name="billing" required>
                    </div>
                    <div class="mb-3 col-lg-6">

                        <label for="country" class="form-label">Pais</label>
                        <select value="2" class="form-select" aria-label="Default select example" name="country" id="country" required>
                            <option selected value="null">Seleccione una opción del menu</option>
                            <?php foreach ($paises as &$value) { ?>
                                <option value="<?php echo $value["id"] ?>"><?php echo $value["name"] ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                </div>
                <hr>
                <h4>Datos del Registrador</h4>
                <div class="row">
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="re_nombres" class="form-label">Nombres*</label>
                            <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="re_nombres" name="re_nombres" required>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="re_apellidos" class="form-label">Apellidos*</label>
                            <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="re_apellidos" name="re_apellidos" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="re_dni" class="form-label">Documento de identificación*</label>
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="re_dni" name="re_dni" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="re_correo" class="form-label">Correo*</label>
                        <input type="email" value="lopezajoseg@gmail.com" class="form-control col-6" id="re_correo" name="email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="position" class="form-label">Cargo*</label>
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="position" name="position" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Celular*</label>
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="re_celular" name="re_celular" required>
                    </div>
                </div>
                <hr>
                <h4>Participantes</h4>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="participants_number" class="form-label">Cantidad de inscripciones a comprar*</label>
                        <input type="number" value="11" class="form-control col-6" id="participants_number" name="participants_number" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="total" class="form-label">Total*</label>
                        <input type="number" value="22" class="form-control col-6" id="total" name="total" required>
                        <div id="emailHelp" class="form-text text-danger">US$50.00 por participante inc. IGV</div>
                    </div>
                </div>
                <hr>
                <h4>Datos del participante</h4>
                <div class="row">
                    <div class="mb-6 col-lg-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Documento de Identidad</th>
                                    <th scope="col">
                                    <td><button type="button" id="addPerson" class="btn btn-danger">Agregar</button></td>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="bodyWorkers">

                            </tbody>
                        </table>
                    </div>
                </div>
                <!--     <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Nombres*</label>
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="part_nombres" name="part_nombres" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Apellidos*</label>
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="part_apellidos" name="part_apellidos" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Dni*</label>
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="re_dni" name="part_dni" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Correo*</label>
                        <input type="email" value="lopezajoseg@gmail.com" class="form-control col-6" id="part_correo" name="email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Ciudad*</label>
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="part_ciudad" name="part_ciudad" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Cargo*</label>
                        <input type="email"  value="lopezajoseg@gmail.com" class="form-control col-6" id="part_cargo" name="part_cargo" required>
                    </div>
                </div>-->
                <h4>Ingresar datos de inscritos por cantidad indicada</h4>
                <div class="row">
                    <div class="mb-3 col-lg-12">
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="cant_inscritos" name="cant_inscritos" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-siguiente float-end" data-target="#exampleModalCenter" type="submit">Deposito en cuenta</button>
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


<div class="modal fade" id="modalPerson" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ingresar datos del participante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="personNew">
                    <div class="mb-3">
                        <label for="part_nombres" class="form-label">Nombres*</label>
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="part_nombres" name="part_nombres" required>
                    </div>
                    <div class="mb-3">
                        <label for="part_apellidos" class="form-label">Apellidos*</label>
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="part_apellidos" name="part_apellidos" required>
                    </div>
                    <div class="mb-3">
                        <label for="part_dni" class="form-label">Dni*</label>
                        <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="part_dni" name="part_dni" required>
                    </div>
                    <div class="mb-3">
                        <label for="part_correo" class="form-label">Correo*</label>
                        <input type="email" value="lopezajoseg@gmail.com" class="form-control col-6" id="part_correo" name="part_correo" required>
                        <div>
                            <div class="mb-3">
                                <label for="part_ciudad" class="form-label">Ciudad*</label>
                                <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="part_ciudad" name="part_ciudad" required>
                            </div>
                            <div class="mb-3">
                                <label for="part_cargo" class="form-label">Cargo*</label>
                                <input type="text" value="lopezajoseg@gmail.com" class="form-control col-6" id="part_cargo" name="part_cargo" required>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="guardarParticipante">Enviar</button>
                            </div>
                </form>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
    let workers = [];

    function setTable() {
        var bodyWorkers = document.getElementById('bodyWorkers');
        let table = "";
        workers.forEach(element => {
            table += "<tr><td>" + element.name + "</td><td>" + element.lastName + "</td><td>" + element.dni + "</td><td><button type='button' id='" + element.dni + "' class='btn btn-danger'>Eliminar</button></td><tr>";



        });
        bodyWorkers.innerHTML = table;

        workers.forEach(element => {
            var deleteWork = document.getElementById(element.dni);
            deleteWork.addEventListener('click', click => {
                console.log(element.dni)
                workers = workers.filter(worker => worker.dni != element.dni);
                setTable();
            });

        });


    }


    var addPersonModal = new bootstrap.Modal(document.getElementById("modalPerson"), {});
    var addPerson = document.getElementById('addPerson');

    addPerson.onclick = (e) => {
        e.preventDefault();
        console.log(addPersonModal);
        addPersonModal.show();
    }
    let guardar = document.getElementById('guardarParticipante');
    guardar.addEventListener("click", () => {
        let name = document.getElementById('part_nombres').value;
        let lastName = document.getElementById('part_apellidos').value;
        let dni = document.getElementById('part_dni').value;
        let email = document.getElementById('part_correo').value;
        let city = document.getElementById('part_ciudad').value;
        let position = document.getElementById('part_cargo').value;
        workers.push({
            "name": name,
            "lastName": lastName,
            "dni": dni,
            "email": email,
            "city": city,
            "position": position

        });
        setTable();
    });

    var myModal = new bootstrap.Modal(document.getElementById("exampleModalCenter"), {});

    var form = document.getElementById('form-empresa');

    form.onsubmit = (e) => {
        e.preventDefault();
        console.log(myModal);
        myModal.show();
    }
</script>
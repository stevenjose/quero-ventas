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
    <?php require_once __DIR__ . "/../header_title.php"; ?>

    <div class="row mt-2">
        <div class="col-12 col-lg-12 col-md-12">
            <h3 class="text-center">
                Para ventas corporativas (Empresas)
            </h3>
        </div>
    </div>
    <div class="row mt-4">
        <h4>Asociados APA</h4>
        <hr>
        <div class="col-12 col-lg-12 col-md-12 mb-4">
            <h4>Ingrese los datos de la empresa</h4>
            <form method="post" id="form-empresa" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="name" class="form-label">Empresa*</label>
                        <input type="text" class="form-control col-6" id="name" name="name" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="ruc" class="form-label">RUC o equivalente*</label>
                        <input type="text" value="<?php echo $_GET["ruc"] ?>" class="form-control col-6" id="ruc" name="ruc" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="address" class="form-label">Dirección de la empresa*</label>
                        <input type="text" class="form-control col-6" id="address" name="address" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="activity" class="form-label">Rubro o actividad</label>
                        <input type="text" class="form-control col-6" id="activity" name="activity">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="billing" class="form-label">Contacto
                            contable/tesorería/facturación</label>
                        <input type="text" class="form-control col-6" id="billing" name="billing">
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="email_contable" class="form-label">Correo de Contacto contable</label>
                        <input type="email_contable" class="form-control col-6" id="email_contable" name="email_contable">
                    </div>
                </div>
                <div class="row">

                    <div class="mb-3 col-lg-6">

                        <label for="country" class="form-label">Pais</label>
                        <select class="form-select" aria-label="Default select example" name="country" id="country" required>
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
                            <input type="text" class="form-control col-6" id="re_nombres" name="re_nombres" required>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="re_apellidos" class="form-label">Apellidos*</label>
                            <input type="text" class="form-control col-6" id="re_apellidos" name="re_apellidos" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="re_dni" class="form-label">Documento de identificación*</label>
                        <input type="text" class="form-control col-6" id="re_dni" name="re_dni" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="re_correo" class="form-label">Correo*</label>
                        <input type="email" class="form-control col-6" id="re_correo" name="email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="position" class="form-label">Cargo*</label>
                        <input type="text" class="form-control col-6" id="position" name="position" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Celular*</label>
                        <input type="text" class="form-control col-6" id="re_celular" name="re_celular" required>
                    </div>
                </div>
                <hr>
                <h4>Participantes</h4>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="participants_number" class="form-label">Cantidad de inscripciones a comprar*</label>
                        <input type="number" class="form-control col-6" id="participants_number" name="participants_number" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="total" class="form-label">Total*</label>
                        <input type="number" class="form-control col-6" id="total" name="total" disabled>
                        <div id="emailHelp" class="form-text text-danger">US$40.00 por participante inc. IGV</div>
                    </div>
                </div>
                <hr>
                <h4>Datos del participante</h4>
                <div class="row">
                    <div class="mb-6 col-lg-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Documento de Identidad</th>
                                    <th scope="col">
                                    <td><button type="button" id="addPerson" class="btn btn-danger">Agregar participante</button></td>
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
                <!-- <h4>Ingresar datos de inscritos por cantidad indicada</h4>
                <div class="row">
                    <div class="mb-3 col-lg-12">
                        <input type="text" class="form-control col-6" id="cant_inscritos" name="cant_inscritos" required>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-2">
                        <button class="btn btn-siguiente" type="submit">Deposito en cuenta</button>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-siguiente" type="button" id="diferido">Pago Diferido</button>
                    </div>
                    <!--  <div class="col-lg-2">
                        <button class="btn btn-siguiente" type="button" id="tdd_payment">Con Tarjeta de Crédito</button>
                    </div>
                    <div class="col-lg-3"></div>
                     <div class="col-lg-6">
                        <button class="btn btn-siguiente" type="button" id="transaction">Probar transacción</button>
                    </div>-->
                </div>
            </form>
        </div>

    </div>
    <div class="mb-4"></div>
</div>

<!--Modal pagos-->
<div class="modal fade" id="tddPayment" tabindex="-1" aria-labelledby="tddPaymentHe" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tddPaymentHe">Tarjeta de Crédito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="payment" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Número de tarjeta*:</label>
                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Año*:</label>
                        <input type="text" pattern="\d*" maxlength="4" class="form-control" id="anio_tdd" name="anio_tdd"></input>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Mes*:</label>
                                <input type="text" pattern="\d*" maxlength="1" class="form-control" id="mes_tdd" name="mes_tdd"></input>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">CVV*:</label>
                                <input type="password" pattern="\d*" maxlength="3" class="form-control" id="cvv_tdd" name="cvv_tdd"></input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Nombres*:</label>
                                <input type="text" maxlength="50" class="form-control" id="nombres_tdd" name="nombres_tdd"></input>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Apellidos*:</label>
                                <input type="text" maxlength="50" class="form-control" id="apellidos_tdd" name="apellidos_tdd"></input>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Correo*:</label>
                        <input type="email" email class="form-control" id="email_tdd" name="email_tdd"></input>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="pagar">Pagar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<<!--div class="modal fade" id="modalPayment" tabindex="-1" aria-labelledby="modalPaymentHe">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPaymentHe">Deposito en cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-lg-12 col-md-12">
                        Datos de cuentas Bancarias Asociación Peruana de Avicultura
                    </div>
                    <div class="col-12 col-lg-12 col-md-12">
                        BBVA Dólares: 125 25648 2683356 542
                    </div>
                    <div class="col-12 col-lg-12 col-md-12">
                        CCI BBVA Dólares: 125 25648 2683356 542
                    </div>
                </div>
                <form id="payment" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Entidad Bancaria*:</label>
                        <input type="text" class="form-control" id="entidad_bancaria" name="entidad_bancaria" required>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Número de operación*:</label>
                        <input type="number" class="form-control" id="reference" name="reference"></input>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Adjuntar Voucher*:</label>
                        <input type="file" class="form-control" id="num_voucher" name="num_voucher"></input>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="guardar">Enviar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
    </div>-->

    <!--Modal deposito -->
    <?php require_once __DIR__ . "/../modal-payment-deposit.php"; ?>
    <!--End Modal deposito -->
    <!--Modal deposito Success-->
    <?php require_once __DIR__ . "/../modal-payment-deposit-success.php"; ?>
    <!--Modal end deposito Success-->

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
                            <input type="text" class="form-control col-6" id="part_nombres" name="part_nombres" required>
                        </div>
                        <div class="mb-3">
                            <label for="part_apellidos" class="form-label">Apellidos*</label>
                            <input type="text" class="form-control col-6" id="part_apellidos" name="part_apellidos" required>
                        </div>
                        <div class="mb-3">
                            <label for="part_dni" class="form-label">Dni*</label>
                            <input type="text" class="form-control col-6" id="part_dni" name="part_dni" required>
                            <input type="hidden" id="part_dni_old" name="part_dni_old">
                        </div>
                        <div class="mb-3">
                            <label for="part_correo" class="form-label">Correo*</label>
                            <input type="email" class="form-control col-6" id="part_correo" name="part_correo" required>
                            <input type="hidden" id="part_correo_old" name="part_correo_old">
                            <div>
                                <div class="mb-3">
                                    <label for="part_ciudad" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control col-6" id="part_ciudad" name="part_ciudad">
                                </div>
                                <div class="mb-3">
                                    <label for="part_cargo" class="form-label">Cargo</label>
                                    <input type="text" class="form-control col-6" id="part_cargo" name="part_cargo">

                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input mt-2" type="checkbox" value="true" id="part_invitado" name="part_invitado">
                                    <label class="form-check-label mt-1" for="flexCheckDefault">
                                        Otra empresa
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label for="part_empresa" id="part_empresa_label" class="form-label">Empresa*</label>
                                    <input type="text" class="form-control col-6" id="part_empresa" name="part_empresa" required>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" id="guardarParticipante">Agregar participante</button>
                                    <button type="button" class="btn btn-primary" id="editarParticipante">Editar participante</button>
                                </div>
                    </form>

                </div>

            </div>
        </div>
    </div>



    <script>
        /*var transaction = document.getElementById('transaction');
    transaction.addEventListener('click', async ()=>{
        const response = await fetch('../../controllers/payment_tdd_company.php',{
            method: 'POST',
            body: new URLSearchParams({
                'num_tdd': document.getElementById('cardNumber').value,
                'names': document.getElementById('nombres_tdd').value ? document.getElementById('nombres_tdd').value : 'Jose' ,
                'last_name': document.getElementById('apellidos_tdd').value,
                'email': document.getElementById('email_tdd'),
                'num_transaction':'123131312123',
                'name': document.getElementById('name').value,
                'address': document.getElementById('address').value,
                'ruc': document.getElementById('ruc').value,
                'participants_number': document.getElementById('participants_number').value,
                'documentType': '2',
                'total':document.getElementById('total').value,
                'activity': document.getElementById('activity').value,
                'country': document.getElementById('country').value,
                'billing': document.getElementById('billing').value
            })
        });
        if(response.status == 200){
            const resp = await response.json();
            console.log(resp);
            if(resp.error == "false"){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Se crea el pago exitosamente!',
                    showConfirmButton: false,
                    timer: 2500
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Error al crear pago o persona por favor validar el pago manualmente',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
        }else{
            Swal.fire({
                title: 'Error!',
                text: 'Se produjo un error comuníquese con el administrador!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
        }

    });*/
        $('#editarParticipante').hide();
        $('#guardarParticipante').show();
        if (!document.getElementById('part_invitado').checked) {
            $("#part_empresa").hide();
            $("#part_empresa_label").hide();
        }

        var partInvitadoCheck = document.getElementById('part_invitado');
        partInvitadoCheck.addEventListener("change", (e) => {
            if (!document.getElementById('part_invitado').checked) {
                $("#part_empresa").hide();
                $("#part_empresa_label").hide();
            } else {
                $("#part_empresa").show();
                $("#part_empresa_label").show();
            }
        });



        var participantsNumber = document.getElementById('participants_number');
        participantsNumber.addEventListener("change", (e) => {
            document.getElementById('total').value = participantsNumber.value * 40.00;
        });
        let workers = [];

        function setTable() {
            var bodyWorkers = document.getElementById('bodyWorkers');
            let table = "";
            var i = 1;
            workers.forEach(element => {
                table += "<tr><td>" + i + "</td><td>" + element.name + "</td><td>" + element.lastName + "</td><td>" + element.dni + "</td><td><button type='button' id='" + element.dni + "' class='btn btn-danger'>Eliminar</button></td><td> <button type='button' id='" + element.dni + "_editar' class='btn btn-danger'>Editar</button></td><tr>";
                i++;
            });
            bodyWorkers.innerHTML = table;

            workers.forEach(element => {
                var deleteWork = document.getElementById(element.dni);
                deleteWork.addEventListener('click', click => {
                    console.log(element.dni)
                    workers = workers.filter(worker => worker.dni != element.dni);
                    setTable();
                });

                var editWork = document.getElementById(element.dni + '_editar');
                editWork.addEventListener('click', click => {
                    console.log(element.dni)
                    let updateWork = workers.filter(worker => worker.dni == element.dni);

                    console.log(updateWork);
                    setUpdateWorker(updateWork)
                    setTable();
                });

            });


        }

        function setUpdateWorker(worker) {
            document.getElementById('part_nombres').value = worker[0].name;
            document.getElementById('part_apellidos').value = worker[0].lastName;
            document.getElementById('part_dni').value = worker[0].dni;
            document.getElementById('part_dni_old').value = worker[0].dni;
            document.getElementById('part_correo_old').value = worker[0].email;
            document.getElementById('part_correo').value = worker[0].email;
            document.getElementById('part_ciudad').value = worker[0].city;
            document.getElementById('part_cargo').value = worker[0].position;
            document.getElementById('part_empresa').value = worker[0].empresa;
            document.getElementById('part_invitado').checked = worker[0].invitado;
            $('#editarParticipante').show();
            $('#guardarParticipante').hide();
           
            var updatePerson = new bootstrap.Modal(document.getElementById("modalPerson"), {});
            
            updatePerson.show();
           
           
        }


        var addPersonModal = new bootstrap.Modal(document.getElementById("modalPerson"), {});
        var addPerson = document.getElementById('addPerson');
        var myModalPayment = new bootstrap.Modal(document.getElementById("tddPayment"), {});
        //var paymentTdd = document.getElementById('tdd_payment');
        var diferido = document.getElementById('diferido');
        var personNew = $("#personNew");
        addPerson.onclick = (e) => {
            e.preventDefault();
            $('#editarParticipante').hide();
            $('#guardarParticipante').show();
                personNew[0].reset()
                $('.btn-close').click();
            addPersonModal.show();
        }
        
        personNew.validate();
        let guardar = document.getElementById('guardarParticipante');
        guardar.addEventListener("click", () => {
            if (!document.getElementById('part_invitado').checked) {
                $("#part_empresa").hide();
                $("#part_empresa_label").hide();
            } else {
                $("#part_empresa").show();
                $("#part_empresa_label").show();
            }


            let name = document.getElementById('part_nombres').value;
            let lastName = document.getElementById('part_apellidos').value;
            let dni = document.getElementById('part_dni').value;
            let email = document.getElementById('part_correo').value;
            let city = document.getElementById('part_ciudad').value;
            let position = document.getElementById('part_cargo').value;
            let empresa = document.getElementById('part_empresa').value;
            let invitado = document.getElementById('part_invitado').checked;
            if (workers.filter(element => element.dni == dni).length > 0) {
                Swal.fire({
                    title: 'Error!',
                    text: 'El Documento de identidad ya existe',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            } else if (!personNew.valid()) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error en los datos del participante',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            } else {
                workers.push({
                    "name": name,
                    "lastName": lastName,
                    "dni": dni,
                    "email": email,
                    "city": city,
                    "position": position,
                    "empresa": empresa,
                    "invitado": invitado

                });
                console.log(workers);
                setTable();
                personNew[0].reset()
                $('.btn-close').click();
                
            }

        });
        let editarPar = document.getElementById('editarParticipante');
        editarPar.addEventListener("click", () => {
            if (!document.getElementById('part_invitado').checked) {
                $("#part_empresa").hide();
                $("#part_empresa_label").hide();
            } else {
                $("#part_empresa").show();
                $("#part_empresa_label").show();
            }


            let name = document.getElementById('part_nombres').value;
            let lastName = document.getElementById('part_apellidos').value;
            let dni = document.getElementById('part_dni').value;
            let email = document.getElementById('part_correo').value;
            let dni_old = document.getElementById('part_dni_old').value;
            let email_old = document.getElementById('part_correo_old').value;
            let city = document.getElementById('part_ciudad').value;
            let position = document.getElementById('part_cargo').value;
            let empresa = document.getElementById('part_empresa').value;
            let invitado = document.getElementById('part_invitado').checked;
            let valid = true;
            
            if (dni != dni_old) {
                if (workers.filter(element => element.dni == dni).length > 0) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'El Documento de identidad ya existe',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });

                    valid = false;
                }
            }

            if (email != email_old) {
                if (workers.filter(element => element.email == email).length > 0) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'El Email ya existe',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });

                    valid = false;
                }
            }

            if (!personNew.valid()) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error en los datos del participante',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            } else if (valid == true) {
                console.log(workers);
                workers = workers.filter(w => w.dni != dni_old);
                workers.push({
                    "name": name,
                    "lastName": lastName,
                    "dni": dni,
                    "email": email,
                    "city": city,
                    "position": position,
                    "empresa": empresa,
                    "invitado": invitado

                });
                setTable();
                addPersonModal.hide();
                personNew[0].reset()
                $('.btn-close').click();
            }
            $('#editarParticipante').hide();
            $('#guardarParticipante').show();
        });


        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
        var modalPaymentDepositSuccess = new bootstrap.Modal(document.getElementById("modalPaymentDepositSuccess"));
        document.getElementById('total_modal').innerText = document.getElementById('total').value;

        document.getElementById('total').addEventListener('change', () => {
            document.getElementById('total_modal').innerText = document.getElementById('total').value;
        });

        var form = document.getElementById('form-empresa');

        var formCompany = $("#form-empresa");
        formCompany.validate();
        form.onsubmit = (e) => {
            e.preventDefault();
            if (!formCompany.valid()) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error en los datos de la empresa',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            } else {
                myModal.show();
            }
        }



        let guardarFrom = document.getElementById('guardar');
        guardarFrom.addEventListener("click", () => {
            let bank = document.getElementById('entidad_bancaria').value;
            let reference = document.getElementById('reference').value;
            let num_voucher = document.getElementById('num_voucher').value;
            console.log('NUM VOUCHER', num_voucher);
            if (bank && reference && num_voucher) {
                console.log('crear company');
                companyCreate(bank, reference, num_voucher, false);
            } else {
                if (!bank) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Entidad bancaria es requerida',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
                if (!reference) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Número de operación',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }

                if (!num_voucher) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Voucher bancaria es requerido',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            }
        });


        const companyCreate = async (bank, reference, num_voucher, diferido) => {

            const response = await fetch('../../controllers/company.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'name': document.getElementById('name').value,
                    'address': document.getElementById('address').value,
                    'ruc': document.getElementById('ruc').value,
                    'participants_number': document.getElementById('participants_number').value,
                    'activity': document.getElementById('activity').value,
                    'country': document.getElementById('country').value,
                    'billing': document.getElementById('billing').value,
                    'total': document.getElementById('total').value,
                    'documentType': '3',
                    're_nombres': document.getElementById('re_nombres').value,
                    're_apellidos': document.getElementById('re_apellidos').value,
                    're_dni': document.getElementById('re_dni').value,
                    're_correo': document.getElementById('re_correo').value,
                    're_celular': document.getElementById('re_celular').value,
                    'position': document.getElementById('position').value,
                    'email_contable': document.getElementById('email_contable').value,

                    'workers': JSON.stringify(workers)
                })

            });

            console.log('no hay error', response);
            const resp = await response.json();
            console.log('no hay error', resp);
            if (resp && resp['success'] == "false") {
                myModal.hide();
                Swal.fire({
                    title: 'Error!',
                    text: resp['error'],
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
                console.error('Error', resp);
            } else {
                console.log('no hay error', resp);
                if (!diferido) {
                    const fileInput = document.querySelector('#num_voucher');
                    console.log(fileInput.files[0].name);
                    let payload = {
                        entidad_bancaria: document.getElementById('entidad_bancaria').value,
                        reference: document.getElementById('reference').value,
                        voucher: fileInput.files[0].name,
                        ruc: document.getElementById('ruc').value
                    };
                    const formData = new FormData();
                    formData.append("json", JSON.stringify(payload));
                    formData.append('file', fileInput.files[0]);

                    const payment = await fetch('../../controllers/payment.php', {
                        method: 'POST',
                        body: formData
                    });

                }
                let headers = new Headers();
                headers.append('Accept', 'application/json');
                headers.append('Content-Type', 'application/json');
                const response = await fetch('../mail.php', {
                    method: 'POST',
                    headers: headers,
                    body: JSON.stringify({
                        name: document.getElementById('re_nombres').value,
                        email: document.getElementById('re_correo').value,
                        participantes: workers
                    })
                });

                var formpayment = $("#payment");
                formpayment[0].reset()
                modalPaymentDepositSuccess.show();
                formCompany[0].reset()
                workers = [];
                document.getElementById('bodyWorkers').innerHTML = '';
                myModal.hide();
            }


        }
        diferido.addEventListener("click", (e) => {
            console.log('Click')
            e.preventDefault();
            if (!formCompany.valid()) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error en los datos de la empresa',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            } else {
                console.log('Modal pagos');
                companyCreate(null, null, null, true);
            }
        });
        // Pagos
        /*   paymentTdd.addEventListener("click", (e) => {
               console.log('Click')
               e.preventDefault();
               if (!formCompany.valid()) {
                   Swal.fire({
                       title: 'Error!',
                       text: 'Error en los datos de la empresa',
                       icon: 'error',
                       showConfirmButton: false,
                       timer: 2500
                   });
               } else {
                   console.log('Modal pagos');
                   myModalPayment.show();
               }
           });*/


        var btnPagar = document.getElementById('pagar');
        btnPagar.addEventListener("click", async (e) => {
            if (validatePayment()) {
                console.log('paso buscar token');
                const tokenApi = await token();
                let headers = new Headers();
                headers.append('Authorization', 'Bearer ' + tokenApi);

                const response = await fetch('https://apiprod.vnforapps.com/api.security/v1/security', {
                    method: 'POST',
                    headers: headers
                });

                if (response.status == 401) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Ocurrio un error intente de nuevo!',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
                if (response.status == 400) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Ocurrio un error intente de nuevo!',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
                if (response.status == 406) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Ocurrio un error intente de nuevo!',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
                if (response.status == 500) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Ocurrio un error intente de nuevo!',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
                if (response.status == 200) {
                    const response = await fetch('../../controllers/payment_tdd_company.php', {
                        method: 'POST',
                        body: new URLSearchParams({
                            'num_tdd': document.getElementById('cardNumber').value,
                            'names': document.getElementById('nombres_tdd').value ? document.getElementById('nombres_tdd').value : 'Jose',
                            'last_name': document.getElementById('apellidos_tdd').value,
                            'email': document.getElementById('email_tdd'),
                            'num_transaction': '123131312123',
                            'name': document.getElementById('name').value,
                            'address': document.getElementById('address').value,
                            'ruc': document.getElementById('ruc').value,
                            'participants_number': document.getElementById('participants_number').value,
                            'documentType': '2',
                            'total': document.getElementById('total').value,
                            'activity': document.getElementById('activity').value,
                            'country': document.getElementById('country').value,
                            'billing': document.getElementById('billing').value
                        })
                    });
                    if (response.status == 200) {
                        const resp = await response.json();
                        console.log(resp);
                        if (resp.error == "false") {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Se crea el pago exitosamente!',
                                showConfirmButton: false,
                                timer: 2500
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Error al crear pago o persona por favor validar el pago manualmente',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2500
                            });
                        }
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Se produjo un error comuníquese con el administrador!',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                }
            }
        });

        function validatePayment() {
            if (document.getElementById('cardNumber').value == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Por favor ingrese el numero de la tarjeta!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
                return false;
            }
            if (document.getElementById('anio_tdd').value == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Por favor ingrese el año de vencimiento de la tarjeta!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
                return false;
            }
            if (document.getElementById('mes_tdd').value == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Por favor ingrese el mes de vencimiento de la tarjeta!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
                return false;
            }
            if (document.getElementById('cvv_tdd').value == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Por favor ingrese código secreto CVV!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
                return false;
            }
            if (document.getElementById('nombres_tdd').value == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Por favor ingrese los nombres!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
                return false;
            }
            if (document.getElementById('apellidos_tdd').value == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Por favor ingrese los apellidos!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
                return false;
            }
            if (document.getElementById('email_tdd').value == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Por favor ingrese el email!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
                return false;
            }
            return (true);
        }

        //token

        const token = async () => {
            let username = 'diego.velarde@apa.org.pe';
            let password = 'C!@q4d0B';
            let headers = new Headers();
            let resp = '';
            headers.append('Authorization', 'Basic ' + btoa(username + ":" + password));
            headers.append('Accept', 'application/json');
            headers.append('Content-Type', 'application/json');
            const response = await fetch('https://apiprod.vnforapps.com/api.security/v1/security', {
                method: 'GET',
                headers: headers
            });
            if (response.ok) {
                return resp = await response.text();
            }
        }
    </script>
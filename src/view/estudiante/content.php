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
            <form method="post" id="form-estudiante" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
                        <input type="email" class="form-control col-6" id="email" name="email" required value="lopezajoseg@gmail.com">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label" required>Ciudad</label>
                        <input type="text" class="form-control col-6" id="city" name="city" required value="Caracas">
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Centro de estudios*</label>
                        <input type="text" class="form-control col-6" id="centro" name="centro" required value="universidad">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Código de estudiante*</label>
                        <input type="text" class="form-control col-6" id="codigo_estudiante" name="codigo_estudiante" required value="0002251">
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Celular*</label>
                        <input type="number" class="form-control col-6" id="celular" name="celular" required value="042415966">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Total</label>
                        <input type="number" class="form-control col-6" id="total" name="total" required>
                        <div id="emailHelp" class="form-text text-danger">US$30.00 inc IGV</div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-siguiente float-end" type="submit">Deposito en cuenta</button>
                    </div>
                    <!--<div class="col-lg-6">
                        <button class="btn btn-siguiente" type="submit">Con Tarjeta de Crédito</button>
                    </div>-->
                </div>
            </form>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deposito en cuenta</h5>
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="guardar">Enviar</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="mb-4"></div>
</div>

<script>


    var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
    var form = document.getElementById('form-estudiante');

    form.onsubmit = (e) => {
        e.preventDefault();
        myModal.show();
    }


    let guardar = document.getElementById('guardar');
    guardar.addEventListener("click", ()=>{
        let bank = document.getElementById('entidad_bancaria').value;
        let reference = document.getElementById('reference').value;
        let num_voucher = document.getElementById('num_voucher').value;
        console.log('NUM VOUCHER',num_voucher);
        if(bank && reference && num_voucher){
            console.log('crear persona');
            personCreate(bank, reference, num_voucher);
        }else{
            if(!bank){
                Swal.fire({
                    title: 'Error!',
                    text: 'Entidad bancaria es requerida',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
            if(!reference){
                Swal.fire({
                    title: 'Error!',
                    text: 'Número de operación',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            }

            if(!num_voucher){
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





    const personCreate = async (bank, reference, num_voucher) => {

        const response = await fetch('../../controllers/person.php', {
            method: 'POST',
            body: new URLSearchParams({
                'nombres': document.getElementById('nombres').value,
                'apellidos': document.getElementById('apellidos').value,
                'dni': document.getElementById('dni').value,
                'email': document.getElementById('email').value,
                'city' : document.getElementById('city').value,
                'celular':document.getElementById('celular').value,
                'total': document.getElementById('total').value,
                'bank' : bank,
                'reference': reference,
                'num_voucher': num_voucher
            })
        });
        const resp = await response.json();

        if(resp && resp['success'] == "false"){
            myModal.hide();
            Swal.fire({
                title: 'Error!',
                text: resp['error'],
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            console.error('Error', resp);
        }else{
            console.log('no hay error', resp);
            const fileInput = document.querySelector('#num_voucher');
            console.log(fileInput.files[0].name);
            let payload = {
                entidad_bancaria: document.getElementById('entidad_bancaria').value,
                reference: document.getElementById('reference').value,
                voucher: fileInput.files[0].name,
                email: document.getElementById('email').value
            };
            const formData = new FormData();
            formData.append( "json", JSON.stringify( payload));
            formData.append('file', fileInput.files[0]);

            const payment = await fetch('../../controllers/payment.php', {
                method: 'POST',
                body:formData
            });

            console.log(payment);

            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Estudiante creado!',
                showConfirmButton: false,
                timer: 2500
            });
            myModal.hide();
        }


    }
</script>

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
        $personaDTO->setTotal($_POST['total']);
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
if( $_SERVER["REQUEST_METHOD"] == "GET"){
    $error = '';
}
?>
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>

<div class="container mb-4">
    <!-- header -->
    <?php require_once __DIR__."/../header_title.php"; ?>

    <div class="row mt-2">
        <div class="col-12 col-lg-12 col-md-12">
            <h3 class="text-center">
                Para ventas a Estudiantes
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
        <div class="col-12 col-lg-12 col-md-12 mb-4">
            <form method="post" id="form-estudiante" name="formEstudiante" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Nombres*</label>
                        <input type="text" class="form-control col-6" id="nombres" name="nombres" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">Apellidos*</label>
                        <input type="text" class="form-control col-6" id="apellidos" name="apellidos" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">Dni*</label>
                        <input type="text" class="form-control col-6" id="dni" name="dni" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">Correo*</label>
                        <input type="email" class="form-control col-6" id="email" name="email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label" required>Ciudad</label>
                        <input type="text" class="form-control col-6" id="city" name="city" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Centro de estudios*</label>
                        <input type="text" class="form-control col-6" id="centro" name="centro" required >
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="codigo_estudiante" class="form-label">C??digo de estudiante*</label>
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
                        <input type="number" class="form-control col-6" id="total" name="total" value="30" disabled>
                        <div id="emailHelp" class="form-text text-danger">US$30.00 inc IGV</div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button class="btn btn-siguiente" type="submit">Deposito en cuenta</button>
                    </div>
                  <!--  <div class="col-lg-6">
                        <button class="btn btn-siguiente" type="button" id="tdd_payment">Con Tarjeta de Cr??dito</button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-siguiente" type="button" id="transaction">Probar transacci??n</button>
                    </div>-->
                </div>
            </form>
        </div>
        <!--Modal deposito -->
        <?php require_once __DIR__ . "/../modal-payment-deposit.php"; ?>
        <!--End Modal deposito -->
        <!--Modal deposito Success-->
        <?php require_once __DIR__ . "/../modal-payment-deposit-success.php"; ?>
        <!--Modal end deposito Success-->
    </div>
    <div class="mb-4"></div>
    <div class="modal fade" id="tddPayment" tabindex="-1" aria-labelledby="tddPayment" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tarjeta de Cr??dito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center mt-2">
                    <span class="text-center img-fluid">
                        <img src="../../asssets/img/avem.png" />
                    </span>
                </div>
                <div class="modal-body">
                    <form id="payment" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">N??mero de tarjeta*:</label>
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">A??o*:</label>
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
</div>

<script>

    /*var transaction = document.getElementById('transaction');
    transaction.addEventListener('click', async ()=>{

    });*/
    console.log('Modal');
    document.getElementById('total_modal').innerText = document.getElementById('total').value;

    document.getElementById('total').addEventListener('change', ()=>{
        document.getElementById('total_modal').innerText = document.getElementById('total').value;
    });

    var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
    var myModalPayment = new bootstrap.Modal(document.getElementById("tddPayment"));
    var modalPaymentDepositSuccess = new bootstrap.Modal(document.getElementById("modalPaymentDepositSuccess"));


    var form = document.getElementById('form-estudiante');

    form.onsubmit = (e) => {
        e.preventDefault();
        myModal.show();
    }

   /* var paymentTdd = document.getElementById('tdd_payment');
    paymentTdd.addEventListener("click",(e)=>{
        console.log('Click')
        e.preventDefault();
        if (validate()){
            myModalPayment.show();
        };

    });*/

    var btnPagar = document.getElementById('pagar');
    btnPagar.addEventListener("click",async (e)=> {
        if( validatePayment()){
            console.log('paso buscar token');
            const tokenApi = await token();
            let headers = new Headers();
            headers.append('Authorization', 'Bearer ' + tokenApi);

            const response = await fetch('https://apiprod.vnforapps.com/api.security/v1/security',{
                method: 'POST',
                headers: headers
            });

            if(response.status == 401){
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un error intente de nuevo!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
            if(response.status == 400){
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un error intente de nuevo!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
            if(response.status == 406){
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un error intente de nuevo!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
            if(response.status == 500){
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un error intente de nuevo!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
            if(response.status == 200){

                const response = await fetch('../../controllers/payment_tdd.php',{
                    method: 'POST',
                    body: new URLSearchParams({
                        'num_tdd': document.getElementById('cardNumber').value,
                        'names': document.getElementById('nombres_tdd').value,
                        'last_name': document.getElementById('apellidos_tdd').value,
                        'email': document.getElementById('email_tdd'),
                        'num_transaction':'123131312123',
                        'person_nombres': document.getElementById('nombres').value,
                        'person_apellidos': document.getElementById('apellidos').value,
                        'person_dni': document.getElementById('dni').value,
                        'person_email': document.getElementById('email').value,
                        'person_city' : document.getElementById('city').value,
                        'person_celular':document.getElementById('celular').value,
                        'person_total': document.getElementById('total').value
                    })
                });
                const resp = await response.json();
                console.log(resp);
                if(resp.error == false){
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
            }
        }
    });

    function validate() {

        if( document.getElementById('nombres').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese los nombres!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }
        if( document.getElementById('apellidos').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese los apellidos!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }
        if( document.getElementById('dni').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese el DNI!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }
        if( document.getElementById('email').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese el email!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }
        if( document.getElementById('city').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese la Ciudad!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }
        if( document.getElementById('centro').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese el Centro!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }

        if( document.getElementById('codigo_estudiante').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese el C??digo del Estudiante!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }

        if( document.getElementById('celular').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese el celular!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }

        if( document.getElementById('total').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese el total!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }

        return( true );
    }

    function validatePayment() {
        if( document.getElementById('cardNumber').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese el numero de la tarjeta!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }
        if( document.getElementById('anio_tdd').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese el a??o de vencimiento de la tarjeta!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }
        if( document.getElementById('mes_tdd').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese el mes de vencimiento de la tarjeta!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }
        if( document.getElementById('cvv_tdd').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese c??digo secreto CVV!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }
        if( document.getElementById('nombres_tdd').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese los nombres!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }
        if( document.getElementById('apellidos_tdd').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese los apellidos!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }
        if( document.getElementById('email_tdd').value == "" ) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor ingrese el email!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return false;
        }
        return( true );
    }

    let validarVoucher = (archivo)=>{
        let extension = archivo.substring(archivo.lastIndexOf('.'),archivo.length);
        if(document.getElementById('num_voucher').getAttribute("accept").split(',').indexOf(extension) < 0) {
            return {"error": true, "message":'Archivo inv??lido. No se permite la extensi??n ' + extension};
        }
            return {"error": false,"message":""};
    }

    let guardar = document.getElementById('guardar');

    guardar.addEventListener("click", ()=>{
        let bank = document.getElementById('entidad_bancaria').value;
        let reference = document.getElementById('reference').value;
        let voucher = document.getElementById('num_voucher');
        let num_voucher = voucher.value;
        let validador = validarVoucher(num_voucher);

        if(validador.error == true){
            Swal.fire({
                title: 'Error!',
                text: 'Archivo inv??lido. No se permite la extensi??n ' + validador.message,
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
            return;
        }

        if(bank && reference && num_voucher){
            console.log('crear persona');
            $("#guardar").prop('disabled', true);
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
                    text: 'N??mero de operaci??n',
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



    const token = async () =>{
        let username = 'diego.velarde@apa.org.pe';
        let password = 'C!@q4d0B';
        let headers = new Headers();
        let resp = '';
        headers.append('Authorization', 'Basic ' + btoa(username + ":" + password));
        headers.append('Accept','application/json');
        headers.append('Content-Type','application/json');
        const response = await fetch('https://apiprod.vnforapps.com/api.security/v1/security',{
            method: 'GET',
            headers: headers
        });
        if(response.ok){
            return resp = await response.text();
        }
    }

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
                'codigo_estudiante': document.getElementById('codigo_estudiante').value,
        'centro': document.getElementById('centro').value,
                'bank' : bank,
                'reference': reference,
                'num_voucher': num_voucher
            })
        });
        const resp = await response.json();
        console.log(resp);
        id = resp["id"];
        if(resp && resp['id'] == null){
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
            const fileInput = document.querySelector('#num_voucher');
            let payload = {
                entidad_bancaria: document.getElementById('entidad_bancaria').value,
                reference: document.getElementById('reference').value,
                voucher: fileInput.files[0].name,
                id: id,
                isperson: true
            };
            const formData = new FormData();
            formData.append( "json", JSON.stringify( payload));
            formData.append('file', fileInput.files[0]);

            const payment = await fetch('../../controllers/payment.php', {
                method: 'POST',
                body:formData
            });
            //const tokenResp = token();
            modalPaymentDepositSuccess.show();
            myModal.hide();
            
            let headers = new Headers();
            headers.append('Accept', 'application/json');
            headers.append('Content-Type', 'application/json');
            const response = await fetch('../mail.php', {
                method: 'POST',
                headers: headers,
                body: JSON.stringify({name: document.getElementById('nombres').value,email: document.getElementById('email').value ,isEstudiante:true, participantes : []})
            });
            form.reset();
            const resp = await response.json();
            console.log(resp);
            await new Promise(r => setTimeout(r, 3000));
            window.location.href = "https://registroempresas.avemperu.com";

            
        }


    }

    const personCreatePayment = async () =>{
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
                'codigo_estudiante': document.getElementById('codigo_estudiante').value,
        'centro': document.getElementById('centro').value,
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
            console.log('Se env??a al api del pago');
        }
    }
</script>

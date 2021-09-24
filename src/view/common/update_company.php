
<div class="loader"></div>
<style>

.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('images/pageLoader.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
<script> 
$(window).load(function() {
    $(".loader").fadeOut("hide");
});


const companyUpdate = async (bank, reference, num_voucher) => {
    
    


const response = await fetch('../../controllers/updateCompany.php', {
    method: 'POST',
    body: new URLSearchParams({
        'id': document.getElementById('id_company').value,
        'name': document.getElementById('name').value,
        'address': document.getElementById('address').value,
        'ruc': document.getElementById('ruc').value,
        'participants_number': document.getElementById('participants_number').value,
        'activity': document.getElementById('activity').value,
        'country': document.getElementById('country').value,
        'billing': document.getElementById('billing').value,
        'total': document.getElementById('total').value,
        'documentType': '2',
        'email_contable':document.getElementById('email_contable').value,
        're_nombres': document.getElementById('re_nombres').value,
        're_apellidos': document.getElementById('re_apellidos').value,
        're_dni': document.getElementById('re_dni').value,
        're_correo': document.getElementById('re_correo').value,
        're_celular': document.getElementById('re_celular').value,
        'position': document.getElementById('position').value,
        'id_representante': document.getElementById('id_representante').value,
        'bank': bank,
        'reference': reference,
        'num_voucher': num_voucher,
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
    if(reference) {
    console.log('no hay error', resp);
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
        body: JSON.stringify({name: document.getElementById('re_nombres').value,email: document.getElementById('re_correo').value , participantes : workers})
    });
  
    var formpayment = $("#payment");
    formpayment[0].reset()

    modalPaymentDepositSuccess.show();
    myModal.hide();
    

    
}


}
</script>
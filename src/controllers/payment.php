<?php
require_once __DIR__."/../repository/person.php";
require_once __DIR__."/../../db/conexion.php";
$target_path = __DIR__."/";

$person = json_decode($_POST['json'], TRUE);
$email = $person['email'];
$archivo = $_FILES['file'];
echo json_encode([ 'error' => 'false', 'success'=>'Se guardo exitosamente']);
$repository = new Person();
$persona = $repository->getPersonCorreo($email);
/*Subir la imagen en la uploads*/

$target_path = $target_path . basename( $_FILES['file']['name']);
$resultado = move_uploaded_file($archivo["tmp_name"], __DIR__.'/../../uploads/'."ID".$persona['id'].'-'.$archivo["name"]);

/* Buscar la persona creado por el correo */


if($persona){

    $bank = $person['entidad_bancaria'];
    $reference= $person['reference'];
    $voucher = $person['voucher'];
    $persona_id = $persona['id'];

    $sql="INSERT INTO payment (bank,reference,voucher,person_id) VALUES('$bank','$reference','$voucher','$persona_id')";

    try {
        $save = $repository->postCreatePayment($sql);
        return json_encode([ 'error' => 'false', 'success'=>'Se guardo exitosamente ']);
    }catch (Exception $e){
        return json_encode([ 'error' => 'true', 'success'=>'Error al guardar en la bd ']);
    }

}
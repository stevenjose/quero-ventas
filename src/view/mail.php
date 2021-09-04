<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require_once __DIR__.'/../../vendor/autoload.php';

class Email
{
    private $mail;
    private $mensaje;
    
    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->Host = 'smtp.gmail.com';  // Indicamos los servidores SMTP
        $this->mail->isSMTP();                                            //Send using SMTP
        //$this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $this->mail->SMTPAuth = true;                               // Habilitamos la autenticación SMTP
        $this->mail->Username = 'lopezajoseg@gmail.com';                 // SMTP username
        $this->mail->Password = 'zjpjkzwijwkvnhht';                           // SMTP password
        $this->mail->SMTPSecure = 'tls';                            // Habilitar encriptación TLS o SSL
        $this->mail->Port = 587;
        $this->mail->SMTPSecure = 'tls';
        /** Incluir destinatarios. El nombre es opcional * */
        $this->mail->addAddress('lopezajoseg@gmail.com');
        //Recipients
        $this->mail->setFrom('jeanquero@gmail.com', 'AVEM');
        $this->mail->addAddress('jeanquero@gmail.com', 'Jean Quero');     //Add a recipient
        $this->mail->addReplyTo('lopezajoseg@gmail.com', 'Information');
        //Content
        $this->mail->isHTML(true);
    
    }

    public function send($name, $participantes, $cant_participantes, $colaborador)
    {

        $this->mensaje = '
        <html>
        <body style="color: #333333;
                padding-left: 20%;
                padding-right: 20%;">
        
        <div class="img-log">
            <img class="log" src="https://firebasestorage.googleapis.com/v0/b/hosting-2cadf.appspot.com/o/avem.png?alt=media&token=3494d193-0ea4-45d7-a263-8560b16efe9a" style="display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;"/>
        </div>
        <div>
            <h3>Estimado(a)</h3>
            '. $name .'
        </div>
        <div>
            <h3>Presente. -</h3>
        </div>
        
        <div>
            <h3>De nuestra mayor consideraci&oacute;n:</h3>
            <br>
            <p>
                Expres&aacute;ndole nuestro nas cordial saludo, no es grato confirmar su participaci&oacute;n '
                .$cant_participantes.' ' .$colaborador. '.
            </p>
            <p>';

            $this->mensaje .= $cant_participantes > 1 ?  $this->participantes($cant_participantes, $participantes) : ''; 
            
            
            $this->mensaje .= '
            </p>
            <p style="text-align: justify;">
                Te recordamos que el <b>Congreso de Peruano de Avicultura AVEW 2021</b> es un evento de alcance internacional que
                congregara a la comunidad av&iacute;cola en pleno y que se realizara, a trav&eacute;s de nuestra moderna plataforma 100%
                digital, los dias <b>4, 5, 6 y 7 de octubre</b>, convirti&eacute;ndose as&iacute; en el epicentro de conocimiento e innovaci&oacute;n del
                sector.
            </p>
            <p style="text-align: justify;">
                Asimismo, le comunicamos que, en caso de hacer cambios o no cuente con los datos completos de sus invitados, debe concretarlo
                antes del mi&eacute;rcoles 29 de septiembre al correo avem.inscripciones@apa.org.pe.
            </p>
            <p style="text-align: justify;">
                Sin, otro particular, agradeciendo desde su atenci&oacute;n a la presente, nos despedimos. Cordialmente.
            </p>
            <p>
                <b>COMIT&Eacute; DE ORGANIZADOR AVEM 2021</b>
            </p>
        </div>
        </body>
        </html>
        ';
        try {
            $this->mail->Subject = 'Congreso de Peruano de Avicultura AVEW 2021';
            $this->mail->Body    = $this->mensaje;
            $this->mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }

    public function participantes($cant_participantes, $participantes) {
        if($cant_participantes > 1) {
            $part = "<ul>";
            foreach ($participantes as $key => $value) {
               $part .= "<li> ".$value. "</li>";
            }
            $part .= "</ul>";
            return $part;
        };
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"),true);
    $name = $data["name"];
    $participantes = $data['participantes'];
    $cant_participantes = count($participantes) == 0 ? 1 : count($participantes);
    $colaborador = count($participantes) > 0 ? 'colaboradores' : 'colaborador';
    // Probar envio
    $email = new Email();
    $email->send($name, $participantes, $cant_participantes, $colaborador);
    echo json_encode(['message' => 'Se envia el correo al participante correctamente', 'success' => 'true']);
}

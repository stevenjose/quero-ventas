<?php require_once __DIR__."/../../repository/inicio_page.php"; ?>
<?php
$inicio = new Inicio;
$document_type = $inicio->getDocumentType();
$user = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // if (!empty($_POST["documentNumber"]) && !empty($_POST["tipo"])) {
    if (!empty($_POST["tipo"]))
     if($_POST["tipo"] == "4"){
         echo "<script>window.location.href='./src/view/estudiante/index.php';</script>";
       //header('Location: ./src/view/estudiante/index.php');
     }else if($_POST["tipo"] == "1") {
      //   echo "window.location.href='./src/view/regular/index.php?ruc="+$_POST["documentNumber"];
        echo "<script>window.location.href='./src/view/regular/index.php?ruc=".$_POST["documentNumber"]."';</script>";
    //   header('Location: ./src/view/regular/index.php'); 
     } else if($_POST["tipo"] == "2") {
        echo "<script>window.location.href='./src/view/empresa/index.php?ruc=".$_POST["documentNumber"]."';</script>";
       //header('Location: ./src/view/empresa/index.php'); 
     } else if($_POST["tipo"] == "3") {
      echo "<script>window.location.href='./src/view/asociados/index.php?ruc=".$_POST["documentNumber"]."';</script>";
      // header('Location: ./src/view/asociados/index.php'); 
     } 
       exit();    
      
    }
?>



<div class="container">
<div class="mt-2">
    <h2 class="p-4 mr-4 mt-1" style="color: #333333">
        <a href="#" class="link-header">Corporativas</a> | <a href="https://avemperu.com/es/avem-peru/register" target="_blank" class="link-header"> Individuales </a>
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
        <div class="col-12 col-lg-12 col-md-12 mb-4">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="row">
                    <div class="mb-3 col-lg-4">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select require class="form-select" aria-label="Default select example" name="tipo" id="tipo">
                            <?php foreach ($document_type as &$value) {
                                if($value["name"] == "REGULAR"){ ?>
                                    <option selected value="<?php  echo $value["id"] ?>">
                                        <?php  echo $value["name"] ?>
                                    </option>
                             <?php } ?>
                            <?php if($value["name"] != "REGULAR"){ ?>
                                <option value="<?php  echo $value["id"] ?>"><?php  echo $value["name"] ?></option>
                            <?php } ?>
                            <?php  }?>
                        </select>
                    </div>
                    <div class="mb-3 col-lg-4" id="div-ruc">
                        <label for="documentNumber" class="form-label">Número de RUC*</label>
                        <input type="text" class="form-control col-6" id="documentNumber" name="documentNumber" required aria-describedby="emailHelp">
                    </div>
                    <div class="col-lg-4 mt-4" style="">
                        <button type="submit" class="btn btn-siguiente">Siguiente</button>
                    </div>
                </div>
            </form>
        </div>
        <hr class="mt-4">
        <div class="row">
            <div class="col-12 col-lg-12 col-md-12">
                <h3 CLASS="text-center">
                    TARIFARIO
                </h3>
            </div>
            <div class="col-12">
                <table class="table table table-striped table-bordered table-inicio" style="border-top-right-radius: 15px;">
                    <thead>
                    <tr class="tbl" style="border-radius-topright: 15px" >
                        <th scope="col">TIPO</th>
                        <th scope="col">INDIVIDUAL</th>
                        <th scope="col">COPERATIVO**</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="background-color: brown; color: white">
                        <td>PREVENTA*</td>
                        <td>US$ 65.00</td>
                        <td>US$ 58.00</td>
                    </tr>
                    <tr>
                        <td>REGULAR </td>
                        <td>US$ 80.00</td>
                        <td>US$ 72.00</td>
                        
                    </tr>
                    <tr>
                        
                    <td>EMPRESA AVEM </td>
                        <td>US$ 50.00</td>
                        
                    </tr>
                    <tr>
                        
                    <td>ASOCIADOS Y COLABORADORES APA</td>
                        <td>US$ 40.00</td>
                        
                    </tr>
                    <tr>
                        
                    <td>ESTUDIANTE</td>
                        <td>US$ 30.00</td>
                        
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <span class="color-tag">PRECIO INCLUIDO IGV</span>
            </div>
            <div class="col-12 precios-content">
                <span class="tag-content"> *Precio de preventa hasta el 19/09/21, no aplica para empresas AVEM, Asociados APA y estudiantes</span><br>
                <span class="tag-content"> **Mínimo 5 inscripciones.</span>
            </div>
        </div>
    </div>
</div>
<script>
    console.log('Inicio');

    document.getElementById('tipo').addEventListener("change", (e)=>{
        console.log('cambio');
        if(e.target.value == 4){
            document.getElementById('documentNumber').removeAttribute("required");
            document.getElementById('div-ruc').style.visibility= "hidden"
        }else{
            document.getElementById('documentNumber').setAttribute("required","true");
            document.getElementById('div-ruc').style.visibility= "visible"
        }
        console.log(e.target.value);
    });

    if(document.getElementById('tipo').value == 4){
        document.getElementById('documentNumber').removeAttribute("required");
        document.getElementById('div-ruc').style.visibility= "hidden"
    }else{
        document.getElementById('documentNumber').setAttribute("required","true");
        document.getElementById('div-ruc').style.visibility= "visible";
    }

</script>

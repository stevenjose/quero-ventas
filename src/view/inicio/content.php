<?php require_once __DIR__."/../../repository/inicio_page.php"; ?>

<?php 

$inicio = new Inicio; 

$document_type = $inicio->getDocumentType();
$user = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST["documentNumber"]) && !empty($_POST["tipo"])) {
    $user = $inicio->getUser($_POST["tipo"],$_POST["documentNumber"]);
  }
}



?>



<div class="container">
    <!-- header -->
    <div class="mt-2">
        <h2 class="p-4 mr-4 mt-1" style="color: #333333">
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
        <div class="col-12 col-lg-12 col-md-12 mb-4">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="row">
                    <div class="mb-3 col-lg-4">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select require class="form-select" aria-label="Default select example" name="tipo" id="tipo">
                            <option selected>Open this select menu</option>
                            <?php foreach ($document_type as &$value) { ?>
                            <option value="<?php  echo $value["id"] ?>"><?php  echo $value["name"] ?></option>
                            <?php  }?>
                        </select>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="documentNumber" class="form-label">Número de RUC*</label>
                        <input type="text" class="form-control col-6" id="documentNumber" name="documentNumber" require aria-describedby="emailHelp">
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
                        <th scope="col">#</th>
                        <th scope="col">TIPO</th>
                        <th scope="col">INDIVIDUAL</th>
                        <th scope="col">COPERATIVO</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="background-color: brown; color: white">
                        <th scope="row">1</th>
                        <td>PREVENTA*</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><?php  
                        if($user != null)
                             echo $user[0]["name"] 
                        
                        ?></td>
                        <td colspan="2"><?php  
                        if($user != null)
                             echo $user[0]["total"] 
                        
                        ?></td>
                        
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        
                        
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

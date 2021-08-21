<div class="container" style="">
    <!-- header -->
    <div class="mt-2">
        <?php require('./header.php'); ?>
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
            <form>
                <div class="row">
                    <div class="mb-3 col-lg-4">
                        <label for="exampleInputEmail1" class="form-label">Tipo</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="exampleInputEmail1" class="form-label">Número de RUC*</label>
                        <input type="email" class="form-control col-6" id="exampleInputEmail1" aria-describedby="emailHelp">
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
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="background-color: brown; color: white">
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
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

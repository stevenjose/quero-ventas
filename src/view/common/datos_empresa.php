<div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="name" class="form-label">Empresa*</label>
                        <input type="text" value="<?php echo $companyData["name"]?>" class="form-control col-6" id="name" name="name" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="ruc" class="form-label">RUC o equivalente*</label>
                        <input type="text" value="<?php echo $_GET["ruc"]?>" class="form-control col-6" id="ruc" name="ruc" required>
                    </div>
                </div>
                <input type="hidden" name="id_company" id="id_company" value="<?php echo $companyData["id"] ?>"/>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="address" class="form-label">Dirección de la empresa*</label>
                        <input type="text" value="<?php echo $companyData["address"]?>" class="form-control col-6" id="address" name="address" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="activity" class="form-label">Rubro o actividad</label>
                        <input type="text" value="<?php echo $companyData["activity"]?>" class="form-control col-6" id="activity" name="activity">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="billing" class="form-label">Contacto
                            contable/tesorería/facturación</label>
                        <input type="text" value="<?php echo $companyData["billing"]?>"  class="form-control col-6" id="billing" name="billing">
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="email_contable" class="form-label">Correo de Contacto contable</label>
                        <input type="email_contable" value="<?php echo $companyData["email_contable"]?>" class="form-control col-6" id="email_contable" name="email_contable">
                    </div>
                </div>
                <div class="row">
                    
                    <div class="mb-3 col-lg-6">

                        <label for="country" class="form-label">Pais</label>
                        <select class="form-select" aria-label="Default select example" value="<?php echo $companyData["id_county"]?>" name="country" id="country" required>
                            <option>Seleccione una opción del menu</option>
                            <?php foreach ($paises as &$value) { ?>
                                <option value="<?php echo $value["id"] ?>" <?php if ($companyData["id_county"] == $value["id"]) echo ' selected'; ?>><?php echo $value["name"] ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                </div>
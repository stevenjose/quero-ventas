<div class="row">
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="re_nombres" class="form-label">Nombres*</label>
                            <input type="text" value="<?php if($representante != null) echo $representante['name']?>" class="form-control col-6" id="re_nombres" name="re_nombres" required>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="re_apellidos" class="form-label">Apellidos*</label>
                            <input type="text" value="<?php if($representante != null) echo $representante['last_name']?>" class="form-control col-6" id="re_apellidos" name="re_apellidos" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="re_dni" class="form-label">DNI, CE, CI*</label>
                        <input type="text" value="<?php if($representante != null) echo $representante['document_number']?>"  class="form-control col-6" id="re_dni" name="re_dni" required>
                    </div>
                    <input type="hidden" name="id_representante" id="id_representante"  value="<?php if($representante != null) echo $representante['id']?>" />
                    <div class="mb-3 col-lg-6">
                        <label for="re_correo" class="form-label">Correo*</label>
                        <input type="email" value="<?php if($representante != null) echo $representante['email']?>" class="form-control col-6" id="re_correo" name="email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="position" class="form-label">Cargo*</label>
                        <input type="text" value="<?php if($representante != null) echo $representante['position']?>" class="form-control col-6" id="position" name="position" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="re_celular" class="form-label">Celular*</label>
                        <input type="text" value="<?php if($representante != null) echo $representante['phone_number']?>" class="form-control col-6" id="re_celular" name="re_celular" required>
                    </div>
                </div>
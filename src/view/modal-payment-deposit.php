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
                        INTERBANK Dólares: 417-3001348928
                    </div>
                    <div class="col-12 col-lg-12 col-md-12">
                        CCI INTERBANK Dólares: 003-417-3001348928-39
                    </div>
                </div>
                <form id="payment" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="entidad_bancaria" class="col-form-label">Entidad Bancaria*:</label>
                       <!-- <select class="form-control" id="entidad_bancaria" name="entidad_bancaria">
                            <option value="BBVA" selected>BBVA</option>
                        </select>-->
                        <input type="text" class="form-control" id="entidad_bancaria" name="entidad_bancaria" />
                    </div>
                    <div class="mb-3">
                        <label for="reference" class="col-form-label">Número de operación*:</label>
                        <input type="number" class="form-control" id="reference" name="reference" />
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Adjuntar Voucher*:</label>
                        <input type="file" class="form-control" accept=".jpg,.png,.pdf" id="num_voucher" name="num_voucher" />
                        <div id="emailHelp" class="form-text text-danger">Cargar imagen en formato jpg, png,pdf. Peso máximo 5mb  </div>
                    </div>
                    <h4>Total: US$ <span id="total_modal"></span> inc. Igv </h4>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="guardar">Enviar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
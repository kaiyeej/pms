<form method='POST' id='frm_submit'>
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><span class='ion-compose'></span> Add Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[client_id]">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Name</label>
                            <input type="text" class="form-control input-item" placeholder="Client name" name="input[client_name]" id="client_name" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Contact #</label>
                            <input type="number" class="form-control input-item" placeholder="Contact number" name="input[client_contact_num]" id="client_contact_num" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>E-mail</label>
                            <input type="text" class="form-control input-item" placeholder="E-mail" autocomplete="off" name="input[client_email]" id="client_email" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Address</label>
                            <textarea class="form-control input-item" class="form-control input-item" placeholder="Address" name="input[client_address]" id="client_address" autocomplete="off"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Remarks</label>
                            <textarea class="form-control input-item" class="form-control input-item" placeholder="Remarks" name="input[client_remarks]" id="client_remarks" autocomplete="off"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
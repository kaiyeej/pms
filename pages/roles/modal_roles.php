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
                    <input type="hidden" id="hidden_id" name="input[roles_id]">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Role</label>
                            <input type="text" class="form-control input-item" placeholder="Role name" name="input[role_name]" id="role_name" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Remarks</label>
                            <textarea class="form-control input-item" class="form-control input-item" placeholder="Remarks" name="input[remarks]" id="remarks" autocomplete="off"></textarea>
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
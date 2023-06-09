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
                    <input type="hidden" id="hidden_id" name="input[project_material_id]">
                    <div class="form-row">
                        <div class="form-group col-md-12" style="margin-bottom: 0px;">
                            <div class="custom-control custom-checkbox" style="float: right;">
                                <input type="checkbox" value="P" class="custom-control-input input-item" name="input[status]" id="status">
                                <label class="custom-control-label " for="status" style="color:#6777ef;font-weight:bold;"> Paid</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Project Material</label>
                            <input type="text" class="form-control input-item" name="input[project_material]" id="project_material" placeholder="Project material" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Project</label>
                            <select class="form-control input-item select2" name="input[project_id]" id="project_id" style="width:100%" required></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Amount</label>
                            <input type="number" class="form-control input-item" name="input[project_material_amount]" id="project_material_amount" step="0.1" placeholder="Project material amount" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Remarks</label>
                            <textarea class="form-control" class="form-control input-item" placeholder="Remarks" name="input[remarks]" id="remarks"></textarea>
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
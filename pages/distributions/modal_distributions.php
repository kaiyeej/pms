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
                    <input type="hidden" id="hidden_id" name="input[cash_distribution_id]">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Project</label>
                            <select class="form-control input-item select2" onchange="getMembers()" name="input[project_id]" id="project_id" style="width:100%" autocomplete="off" required></select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Member</label>
                            <select class="form-control form-control-sm input-item select2" name="input[project_member_id]" id="project_member_id" style="width:100%;" autocomplete="off" required></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Amount</label>
                            <input type="number" step="0.1" class="form-control input-item" placeholder="Distribution amount" name="input[amount]" id="amount" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date</label>
                            <input type="date" class="form-control input-item"] name="input[distribution_date]" id="distribution_date" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Remarks</label>
                            <textarea class="form-control" class="form-control input-item" placeholder="Distribution remarks" name="input[cash_distribution_remarks]" id="cash_distribution_remarks" autocomplete="off"></textarea>
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
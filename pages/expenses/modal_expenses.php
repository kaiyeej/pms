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
                    <input type="hidden" id="hidden_id" name="input[expense_id]">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Expense Category</label>
                            <select class="form-control input-item select2" name="input[expense_category_id]" id="expense_category_id" style="width:100%" required></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Expense Amount</label>
                            <input type="number" class="form-control input-item" name="input[expense_amount]" id="expense_amount" step="0.1" placeholder="Expense amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date</label>
                            <input type="date" class="form-control input-item" name="input[expense_date]" id="expense_date" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea class="form-control" class="form-control input-item" placeholder="Expense description" name="input[expense_desc]" id="expense_desc"></textarea>
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
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
                	<input type="hidden" id="hidden_id" name="input[quotation_id]">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Client</label>

                            <select class="form-control input-item select2" name="input[client_id]" id="client_id" style="width:100%" required></select>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea class="form-control" class="form-control input-item" placeholder="Description" name="input[quotation_description]" id="quotation_description" autocomplete="off"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Quote Date</label>
                            <input type="date" class="form-control input-item" name="input[quotation_date]" id="quotation_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Valid Until</label>
                            <input type="date" class="form-control input-item" name="input[quotation_valid_until]" id="quotation_valid_until" required>
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


<div class="modal fade" id="modalEntry2" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row alert alert-info alert-has-icon" style="padding-left: 0px;padding-right:0px;font-size: small;border: 1px dashed;">
                        <div class="col-3">
                            <div><b>Client:</b> <span id="client_name_label" class="label-item"></span></div>
                            <div><b>Quote Date:</b> <span id="quotation_date_label" class="label-item"></span></div>
                            <div><b>Valid Until:</b> <span id="quotation_valid_until_label" class="label-item"></span></div>
                            <div><b>Description:</b> <span id="quotation_description_label" class="label-item"></span></div>
                        </div>
                        <div class="col-3">
                           
                        </div>
                        <div class="col-6">
                            <ul class="nav justify-content-end">
                                <li class="nav-item">
                                    <a id="menu-edit-transaction" class="nav-link" href="#" style="font-size: small;"><i class='ti ti-pencil'></i> Edit Quotation</a>
                                </li>
                                <li class="nav-item" style="display: none;">
                                    <a id="menu-finish-transaction" class="nav-link" href="#" style="font-size: small;"><i class='ti ti-check'></i> Finish Transaction</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-dismiss="modal" style="font-size: small;"><i class='ti ti-close'></i> Close</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-body" style="padding-top: 0px;">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4" id="col-item">
                                <form method='POST' id='frm_submit_2'>
                                    <input type="hidden" id="hidden_id_2" name="input[quotation_id]">

                                    <div class="form-group row">
                                        <div class="col">
                                            <label><strong>Description</strong></label>
                                            <textarea class="form-control" class="form-control input-item" placeholder="Quotation description" name="input[quotation_detail_description]" id="quotation_detail_description" required></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <label><strong>Unit</strong></label>
                                            <input type="text" class="form-control input-item" name="input[quotation_detail_unit]" id="quotation_detail_unit" required>
                                        </div>
                                        <div class="col">
                                            <label><strong>Amount</strong></label>
                                            <input type="number" class="form-control input-item" name="input[quotation_detail_amount]" id="quotation_detail_amount" required>
                                        </div>
                                    </div>
                                    
                                    <div class='btn-group' style="float: right;">
                                        <button type="submit" class="btn btn-info" id="btn_submit_2">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6" id="col-list">
                                <div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">
                                    <button type="button" onclick="deleteQuoteDetails()" id="btn_delete_qd" class="btn btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped" id="dt_entries_2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2" onchange="checkAll(this, 'dt_id_2')">
                                                        <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </th>
                                                <th>Desciption</th>
                                                <th>Unit</th>
                                                <th>Amount</th>
                                                <th>Date Added</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
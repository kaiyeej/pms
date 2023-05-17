<form method='POST' id='frm_submit' class="users">
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><span class='ion-compose'></span> Add Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[project_id]">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Project</label>
                            <input type="text" class="form-control input-item" placeholder="Project name" name="input[project_name]" id="project_name" autocomplete="off" required>
                        </div>
                         <div class="form-group col-md-6">
                            <label>Quotation</label>
                            <select class="form-control input-item select2" name="input[quotation_id]" id="quotation_id" style="width:100%"></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Client</label>
                            <!-- <select class="form-control select2 input-item" id="client_id" name="input[client_id]" style="width:100%;" required>
                            </select> -->
                            <select class="form-control input-item select2" name="input[client_id]" id="client_id" style="width:100%" required></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Fee</label>
                            <input type="number" step="0.1" class="form-control input-item" placeholder="Project fee" name="input[project_fee]" id="project_fee" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Description</label>
                            <textarea class="form-control" class="form-control input-item" placeholder="Project description" name="input[project_desc]" id="project_desc" autocomplete="off"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Remarks</label>
                            <textarea class="form-control" class="form-control input-item" placeholder="Project remarks" name="input[project_remarks]" id="project_remarks" autocomplete="off"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date Started</label>
                            <input type="date" class="form-control input-item" name="input[date_started]" id="date_started" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Delivery Date</label>
                            <input type="date" class="form-control input-item" name="input[delivery_date]" id="delivery_date" required>
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
                            <div><b>Project Name:</b> <span id="project_name_label" class="label-item"></span></div>
                            <div><b>Client:</b> <span id="client_name_label" class="label-item"></span></div>
                            <div><b>Date Started:</b> <span id="date_started_label" class="label-item"></span></div>
                            <div><b>Delivery Date:</b> <span id="delivery_date_label" class="label-item"></span></div>
                        </div>
                        <div class="col-3">
                            <div><b>Quotation:</b> <span id="quotation_id_label" class="label-item"></span></div>
                            <div><b>Project Fee:</b> <span id="project_fee_label" class="label-item"></span></div>
                            <div><b>Description:</b> <span id="project_desc_label" class="label-item"></span></div>
                            <div><b>Remarks:</b> <span id="project_remarks_label" class="label-item"></span></div>
                        </div>
                        <div class="col-6">
                            <ul class="nav justify-content-end">
                                <li class="nav-item">
                                    <a id="menu-edit-transaction" class="nav-link" href="#" style="font-size: small;"><i class='ti ti-pencil'></i> Edit Project</a>
                                </li>
                                <li class="nav-item">
                                    <a id="menu-finish-transaction" class="nav-link" href="#" style="font-size: small;"><i class='ti ti-check'></i> Finish Transaction</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-dismiss="modal" style="font-size: small;"><i class='ti ti-close'></i> Close</a>
                                </li>
                                <!--<li class="nav-item">
                                <a class="nav-link disabled" href="#">Disabled</a>
                            </li>-->
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-body" style="padding-top: 0px;">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                             <li class="nav-item">
                                <a class="nav-link active show" id="members-tab3" data-toggle="tab" href="#members3" role="tab" aria-controls="members" aria-selected="true">Members</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tasks-tab3" data-toggle="tab" href="#tasks3" role="tab" aria-controls="tasks" aria-selected="false">Tasks</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="materials-tab3" data-toggle="tab" href="#materials3" role="tab" aria-controls="materials" aria-selected="false">Materials</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="issues-tab3" data-toggle="tab" href="#issues3" role="tab" aria-controls="issues" aria-selected="false">Issues</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade active show" id="members3" role="tabpanel" aria-labelledby="members-tab3">
                                <div class="row">
                                    <div class="col-4" id="col-item">
                                        <form method='POST' id='frm_submit_2'>
                                            <input type="hidden" id="hidden_id_2" name="input[project_id]">

                                            <div class="form-group row">
                                                <div class="col">
                                                    <label><strong>Member</strong></label>
                                                    <div>
                                                        <select class="form-control form-control-sm select2" name="input[user_id]" id="user_id" style="width:100%;" required></select>
                                                    </div>
                                                </div>

                                                 <div class="col">
                                                    <label><strong>Role</strong></label>
                                                    <div>
                                                        <select class="form-control form-control-sm select2" name="input[roles_id]" id="roles_id" style="width:100%;" required></select>
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="form-group row">
                                                <div class="col">
                                                    <label><strong>Remaining project fee</strong></label>
                                                    <input type="text" class="form-control input-item" name="input[remaining_project_fee]" id="remaining_project_fee" readonly>
                                                    <input type="hidden" class="form-control input-item" name="input[project_fee_]" id="project_fee_" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col">
                                                    <label><strong>Expected Salary</strong></label>
                                                    <input type="text" class="form-control input-item" name="input[expected_salary]" id="expected_salary" required>
                                                </div>
                                                <div class="col">
                                                    <label><strong>%</strong></label>
                                                    <input type="text" class="form-control input-item" name="input[percentage]" id="percentage" onkeyup="getExpectedSalaryByPercentage()">
                                                </div>
                                            </div>

                                            <div class='btn-group' style="float: right;">
                                                <button type="submit" class="btn btn-info" id="btn_submit_2">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-8" id="col-list">
                                        <div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">
                                            <button type="button" onclick="deleteMember()" id="btn_delete_member" class="btn btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Delete</button>
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
                                                        <th>Member</th>
                                                        <th>Role</th>
                                                        <th>Expected Salary</th>
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

                            <div class="tab-pane fade" id="tasks3" role="tabpanel" aria-labelledby="tasks-tab3">
                                <div class="row">
                                    <div class="col-4" id="col-item">
                                        <form method='POST' id='frm_submit_3'>
                                            <input type="hidden" id="hidden_id_3" name="input[project_id]">

                                            <div class="form-group row">
                                                <div class="col">
                                                    <label><strong>Member</strong></label>
                                                    <div>
                                                        <select class="form-control form-control-sm select2" name="input[project_member_id]" id="project_member_id" style="width:100%;" required></select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label><strong>Date Started</strong></label>
                                                    <input type="date" class="form-control input-item" name="input[date_started]" id="task_date_started" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label><strong>Task</strong></label>
                                                    <textarea class="form-control" class="form-control input-item" placeholder="Task description" name="input[task_desc]" id="task_desc" required></textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group row">
                                                <div class="col">
                                                    <label><strong>Date Started</strong></label>
                                                    <input type="date" class="form-control input-item" name="input[date_started]" id="date_started" required>
                                                </div>
                                            </div> -->
                                            <div class='btn-group' style="float: right;">
                                                <button type="submit" class="btn btn-info" id="btn_submit_3">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-8" id="col-list">
                                        <div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">
                                            <button type="button" onclick="finishTask()" id="btn_finish_task" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i> Finish</button>
                                            <button type="button" onclick="deleteTask()" id="btn_delete_task" class="btn btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="dt_entries_3" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-3" onchange="checkAll(this, 'dt_id_3')">
                                                                <label for="checkbox-3" class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                        <th>Member</th>
                                                        <th>Task</th>
                                                        <th>Status</th>
                                                        <th>Date Started</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="materials3" role="tabpanel" aria-labelledby="materials-tab3">
                                <div class="row">
                                    <div class="col-4" id="col-item">
                                        <form method='POST' id='frm_submit_4'>
                                            <input type="hidden" id="hidden_id_4" name="input[project_id]">

                                            <div class="form-group row">
                                                <div class="col">
                                                    <div class="custom-control custom-checkbox" style="float: right;">
                                                        <input type="checkbox" value="P" class="custom-control-input input-item" name="input[status]" id="status">
                                                        <label class="custom-control-label " for="status" style="color:#6777ef;font-weight:bold;"> Paid</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col">
                                                    <label>Project Material</label>
                                                    <input type="text" class="form-control input-item" name="input[project_material]" id="project_material" placeholder="Project material" required>
                                                </div>

                                                <div class="col">
                                                    <label>Amount</label>
                                                    <input type="number" class="form-control input-item" name="input[project_material_amount]" id="project_material_amount" step="0.1" placeholder="Project material amount" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col">
                                                    <label>Remarks</label>
                                                    <textarea class="form-control" class="form-control input-item" placeholder="Remarks" name="input[remarks]" id="remarks"></textarea>
                                                </div>
                                            </div>
                                            <div class='btn-group' style="float: right;">
                                                <button type="submit" class="btn btn-info" id="btn_submit_4">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-8" id="col-list">
                                        <div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">
                                            <button type="button" onclick="paidMaterial()" id="btn_paid_material" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i> Paid</button>
                                            <button type="button" onclick="deleteMaterial()" id="btn_delete_material" class="btn btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="dt_entries_4" width="100%" cellspacing="0">
                                                <thead class="">
                                                    <tr>
                                                        <th style="width:10px;">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-4" onchange="checkAll(this, 'dt_id_4')">
                                                                <label for="checkbox-4" class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                        <th>Material</th>
                                                        <th>Amount</th>
                                                        <th>Remarks</th>
                                                        <th>Status</th>
                                                        <th>Date Added</th>
                                                        <th>Date Modified</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="issues3" role="tabpanel" aria-labelledby="issues-tab3">
                                <div class="row">
                                    <div class="col-4" id="col-item">
                                        <form method='POST' id='frm_submit_5'>
                                            <input type="hidden" id="hidden_id_5" name="input[project_id]">

                                            <div class="form-group row">
                                                <div class="col">
                                                    <label><strong>Member</strong></label>
                                                    <div>
                                                        <select class="form-control form-control-sm select2" name="input[project_member_id]" id="project_member_id_2" style="width:100%;" required></select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label><strong>Date Started</strong></label>
                                                    <input type="date" class="form-control input-item" name="input[date_started_2]" id="task_date_started_2" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label><strong>Issue</strong></label>
                                                    <textarea class="form-control" class="form-control input-item" placeholder="Issue description" name="input[task_desc_2]" id="task_desc_2" required></textarea>
                                                </div>
                                            </div>

                                            <div class='btn-group' style="float: right;">
                                                <button type="submit" class="btn btn-info" id="btn_submit_5">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-8" id="col-list">
                                        <div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">
                                            <button type="button" onclick="finishIssue()" id="btn_finish_issue" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i> Finish</button>
                                            <button type="button" onclick="deleteIssue()" id="btn_delete_issue" class="btn btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="dt_entries_5" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-5" onchange="checkAll(this, 'dt_id_5')">
                                                                <label for="checkbox-5" class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                        <th>Member</th>
                                                        <th>Issue</th>
                                                        <th>Status</th>
                                                        <th>Date Started</th>
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
    </div>
</div>
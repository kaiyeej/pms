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
                    <input type="hidden" id="hidden_id" name="input[user_id]">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Name</label>
                            <input type="text" class="form-control input-item" placeholder="Full name" name="input[user_fullname]" id="user_fullname" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Contact #</label>
                            <input type="text" class="form-control input-item" placeholder="Contact number" name="input[user_contact_number]" id="user_contact_number"  autocomplete="off"required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Designation</label>
                            <input type="text" class="form-control input-item" placeholder="Designation" name="input[designation]" id="designation" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Address</label>
                            <textarea class="form-control" class="form-control input-item" placeholder="Address" name="input[user_address]" id="user_address" autocomplete="off"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Category</label>
                            <select class="form-control select2 input-item" id="user_category" name="input[user_category]" style="width:100%;" srequired>
                                <option value="">Please Select</option>
                                <option value="A">Admin</option>
                                <option value="S">Staff</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Username</label>
                            <input type="text" class="form-control input-item" placeholder="Username" name="input[username]" id="username" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-12" id="div_pass">
                            <label>Password</label>
                            <input type="password" class="form-control input-item" placeholder="Password" name="input[password]" id="password" autocomplete="off" required>
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
<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Transactions</a></div>
            <div class="breadcrumb-item">Users</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon bg-secondary" style="border: 1px dashed gray;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Users</div>
                Manage users here.
            </div>
            <div>
                <a href="#" class="btn btn-icon icon-left btn-primary" onclick="addUser()"><i class="fas fa-plus"></i> Add</a>
                <a href="#" class="btn btn-icon icon-left btn-danger" onclick='deleteEntry()'><i class="fas fa-trash"></i> Delete</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dt_entries" class="table table-striped">
                                <thead class="">
                                    <tr>
                                        <th style="width:10px;">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1" onchange="checkAll(this, 'dt_id')">
                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Contact #</th>
                                        <th>Username</th>
                                        <th>Date Added</th>
                                        <th>Date Modified</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include "modal_users.php"; ?>
<script type="text/javascript">
    function addUser(){
        $("#div_pass").show();
        $("#password").prop('required',true);
        addModal();
    }
    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-bs' + row.user_id + '" value=' + row.user_id + '><label for="checkbox-b' + row.user_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><a href='#' class='button-custom-style' onclick='getUserEntry(" + row.user_id + ")'><span class='fa fa-edit'></span></a></center>";
                    }
                },
                {
                    "data": "user_fullname"
                },
                {
                    "data": "designation"
                },
                {
                    "data": "user_contact_number"
                },
                {
                    "data": "username"
                },
                {
                    "data": "date_added"
                },
                {
                    "data": "date_modified"
                }
            ]
        });
    }

    function getUserEntry(id){
        getEntryDetails(id);
        $("#div_pass").hide();
        $("#password").prop('required',false);
    }

    $(document).ready(function() {
        getEntries();
    });
</script>
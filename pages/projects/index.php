<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Transactions</a></div>
            <div class="breadcrumb-item">Projects</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon" style="background:#DEFCF9;border: 1px dashed #3C84AB;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Projects</div>
                Manage projects here.
            </div>
            <div>
                <a href="#" class="btn btn-icon icon-left btn-primary" onclick="addModal()"><i class="fas fa-plus"></i> Add</a>
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
                                        <th>Project</th>
                                        <th>Quotation</th>
                                        <th>Client</th>
                                        <th>Total</th>
                                        <th>Progress</th>
                                        <th>Status</th>
                                        <th>Delivery Date</th>
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
<?php include "modal_projects.php"; ?>
<script type="text/javascript">
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
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.project_id + '" value=' + row.project_id + '><label for="checkbox-b' + row.project_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-sm btn-info' onclick='getEntryDetails2(" + row.project_id + ")'><span class='fa fa-edit'></span></button></center>";
                    }
                },
                {
                    "data": "project_name"
                },
                {
                    "data": "quotation_id"
                },
                {
                    "data": "client_name"
                },
                {
                    "data": "project_total"
                },
                {

                    "mRender": function(data, type, row) {
                        return '<div class="progress" data-height="4" data-toggle="tooltip" title="'+row.progress+'%" data-original-title="'+row.progress+'%" style="height: 4px;"><div class="progress-bar bg-success" data-width="'+row.progress+'%" style="width: '+row.progress+'%;"></div></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return row.status == "C" ? "<span class='badge badge-danger'>Canceled</span>" : row.status == "F" ? "<span class='badge badge-success'>Completed</span>" : "<span class='badge badge-warning'>On-going</span>";
                    }
                },
                {
                    "data": "delivery_date"
                },
                {
                    "data": "date_modified"
                }
            ]
        });
    }

    function getEntries3() {

        var hidden_id_3 = $("#hidden_id_3").val();
        var param = "project_id = '" + hidden_id_3 + "'";

        $("#dt_entries_3").DataTable().destroy();
        $("#dt_entries_3").DataTable({
            "processing": true,
            "order": [
                [3, 'desc']
            ],
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show_task",
                "dataSrc": "data",
                "type": "POST",
                "data": {
                    input: {
                        param: param
                    }
                }
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id_3" id="checkbox-b' + row.task_id + '" value=' + row.task_id + '><label for="checkbox-b' + row.task_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "data": "member"
                },
                {
                    "data": "task_desc"
                },
                {
                    "mRender": function(data, type, row) {
                        return row.status == "F" ? "<div class='badge badge-success'>Finished</div>" : "<div class='badge badge-light'>Todo</div>";
                    }
                },
                {
                    "data": "date_started"
                },
            ]
        });
    }

    function getEntries2() {

        var hidden_id_2 = $("#hidden_id_2").val();
        var param = "project_id = '" + hidden_id_2 + "'";
        getRemainingProjectFee(hidden_id_2);
        getSelectOption('ProjectMembers', 'project_member_id', 'user_fullname', 'project_id="' + hidden_id_2 + '"');
        $("#dt_entries_2").DataTable().destroy();
        $("#dt_entries_2").DataTable({
            "processing": true,
            "order": [
                [3, 'desc']
            ],
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show_detail",
                "dataSrc": "data",
                "type": "POST",
                "data": {
                    input: {
                        param: param
                    }
                }
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id_2" id="checkbox-b' + row.project_member_id + '" value=' + row.project_member_id + '><label for="checkbox-b' + row.project_member_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "data": "member"
                },
                {
                    "data": "role"
                },
                {
                    "mRender": function(data, type, row) {
                        return '<input type="number" class="form-control input-item" id="textbox-expected-salary-new'+row.project_member_id+'" value='+row.expected_salary+' onchange="updateExpectedSalary('+row.project_member_id+')"><input type="hidden" id="textbox-expected-salary-old'+row.project_member_id+'" value='+row.expected_salary+'>';
                    }
                },
                {
                    "data": "date_added"
                },
            ]
        });
    }


    function getEntries4() {

        var hidden_id_4 = $("#hidden_id_4").val();
        var param = "project_id = '" + hidden_id_4 + "'";
   
        $("#dt_entries_4").DataTable().destroy();
        $("#dt_entries_4").DataTable({
            "processing": true,
            "order": [
                [3, 'desc']
            ],
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show_materials",
                "dataSrc": "data",
                "type": "POST",
                "data": {
                    input: {
                        param: param
                    }
                }
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id_4" id="checkbox-b' + row.project_material_id + '" value=' + row.project_material_id + '><label for="checkbox-b' + row.project_material_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "data": "project_material"
                },
                {
                    "data": "project_material_amount"
                },
                {
                    "data": "remarks"
                },
                {
                    "mRender": function(data, type, row) {
                        return row.status == "P" ? "Paid" : "" ;
                    }
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

    $("#frm_submit_3").submit(function(e) {
        e.preventDefault();

        $("#btn_submit_3").prop('disabled', true);
        $("#btn_submit_3").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=add_task",
            data: $("#frm_submit_3").serialize(),
            success: function(data) {
                getEntries3();
                var json = JSON.parse(data);
                if (json.data == 1) {
                    success_add();
                    document.getElementById("frm_submit_3").reset();
                    $('.select2').select2().trigger('change');
                } else if (json.data == 2) {
                    entry_already_exists();
                } else if (json.data == 3) {
                    amount_is_greater();
                } else {
                    failed_query(json);
                    $("#modalEntry2").modal('hide');
                }
                $("#btn_submit_3").prop('disabled', false);
                $("#btn_submit_3").html("Submit");
            }
        });
    });


    $("#frm_submit_4").submit(function(e) {
        e.preventDefault();

        $("#btn_submit_4").prop('disabled', true);
        $("#btn_submit_4").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=add_material",
            data: $("#frm_submit_4").serialize(),
            success: function(data) {
                getEntries4();
                var json = JSON.parse(data);
                if (json.data == 1) {
                    success_add();
                    document.getElementById("frm_submit_4").reset();
                    $('.select2').select2().trigger('change');
                } else if (json.data == 2) {
                    entry_already_exists();
                } else {
                    failed_query(json);
                    $("#modalEntry2").modal('hide');
                }
                $("#btn_submit_4").prop('disabled', false);
                $("#btn_submit_4").html("Submit");
            }
        });
    });

    function finishTask() {

        var count_checked = $("input[name='dt_id_3']:checked").length;

        if (count_checked > 0) {

            $("#btn_finish_task").prop("disabled", true);
            $("#btn_finish_task").html("<span class='fa fa-spinner fa-spin'></span>");
            swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover these entries!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var checkedValues = $("input[name='dt_id_3']:checked").map(function() {
                            return this.value;
                        }).get();

                        $.ajax({
                            type: "POST",
                            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=finishTask",
                            data: {
                                input: {
                                    ids: checkedValues
                                }
                            },
                            success: function(data) {
                                getEntries3();
                                var json = JSON.parse(data);
                                console.log(json);
                                if (json.data == 1) {
                                    swal("Success!", "Successfully finished task!", "success");
                                } else {
                                    failed_query(json);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                errorLogger('Error:', textStatus, errorThrown);
                            }
                        });
                    } else {
                        swal("Cancelled", "Entries are safe :)", "error");
                    }
                    $("#btn_finish_task").prop('disabled', false);
                    $("#btn_finish_task").html('<i class = "fas fa-check"> </i> Finish');
                });
        } else {
            swal("Cannot proceed!", "Please select entries to finish!", "warning");
        }
    }

    function paidMaterial() {

        var count_checked = $("input[name='dt_id_4']:checked").length;

        if (count_checked > 0) {

            $("#btn_paid_material").prop("disabled", true);
            $("#btn_paid_material").html("<span class='fa fa-spinner fa-spin'></span>");
            swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover these entries!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var checkedValues = $("input[name='dt_id_4']:checked").map(function() {
                            return this.value;
                        }).get();

                        $.ajax({
                            type: "POST",
                            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=paidMaterial",
                            data: {
                                input: {
                                    ids: checkedValues
                                }
                            },
                            success: function(data) {
                                getEntries4();
                                var json = JSON.parse(data);
                                console.log(json);
                                if (json.data == 1) {
                                    swal("Success!", "Successfully paid material!", "success");
                                } else {
                                    failed_query(json);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                errorLogger('Error:', textStatus, errorThrown);
                            }
                        });
                    } else {
                        swal("Cancelled", "Entries are safe :)", "error");
                    }
                    $("#btn_paid_material").prop('disabled', false);
                    $("#btn_paid_material").html('<i class = "fas fa-check"> </i> Finish');
                });
        } else {
            swal("Cannot proceed!", "Please select entries to finish!", "warning");
        }
    }

    function deleteTask() {

        var count_checked = $("input[name='dt_id_3']:checked").length;

        if (count_checked > 0) {

            $("#btn_delete_task").prop("disabled", true);
            $("#btn_delete_task").html("<span class='fa fa-spinner fa-spin'></span>");
            swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover these entries!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var checkedValues = $("input[name='dt_id_3']:checked").map(function() {
                            return this.value;
                        }).get();

                        $.ajax({
                            type: "POST",
                            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=deleteTask",
                            data: {
                                input: {
                                    ids: checkedValues
                                }
                            },
                            success: function(  data) {
                                getEntries3();
                                var json = JSON.parse(data);
                                console.log(json);
                                if (json.data == 1) {
                                    swal("Success!", "Successfully deleted task!", "success");
                                } else {
                                    failed_query(json);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                errorLogger('Error:', textStatus, errorThrown);
                            }
                        });
                    } else {
                        swal("Cancelled", "Entries are safe :)", "error");
                    }
                    $("#btn_delete_task").prop('disabled', false);
                    $("#btn_delete_task").html('<i class = "fas fa-trash"> </i> Delete');
                });
        } else {
            swal("Cannot proceed!", "Please select entries to delete!", "warning");
        }
    }

    function deleteMember() {
        var count_checked = $("input[name='dt_id_2']:checked").length;

        if (count_checked > 0) {

            $("#btn_delete_member").prop("disabled", true);
            $("#btn_delete_member").html("<span class='fa fa-spinner fa-spin'></span>");
            swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover these entries!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var checkedValues = $("input[name='dt_id_2']:checked").map(function() {
                            return this.value;
                        }).get();

                        $.ajax({
                            type: "POST",
                            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=deleteMember",
                            data: {
                                input: {
                                    ids: checkedValues
                                }
                            },
                            success: function(data) {
                                getEntries2();
                                var json = JSON.parse(data);
                                console.log(json);
                                if (json.data == 1) {
                                    swal("Success!", "Successfully deleted member!", "success");
                                } else {
                                    failed_query(json);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                errorLogger('Error:', textStatus, errorThrown);
                            }
                        });
                    } else {
                        swal("Cancelled", "Entries are safe :)", "error");
                    }
                    $("#btn_delete_member").prop('disabled', false);
                    $("#btn_delete_member").html('<i class = "fas fa-trash"> </i> Delete');
                });
        } else {
            swal("Cannot proceed!", "Please select entries to delete!", "warning");
        }
    }

    function deleteMaterial(){
        var count_checked = $("input[name='dt_id_4']:checked").length;

        if (count_checked > 0) {

            $("#btn_delete_material").prop("disabled", true);
            $("#btn_delete_material").html("<span class='fa fa-spinner fa-spin'></span>");
            swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover these entries!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var checkedValues = $("input[name='dt_id_4']:checked").map(function() {
                            return this.value;
                        }).get();

                        $.ajax({
                            type: "POST",
                            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=deleteMaterial",
                            data: {
                                input: {
                                    ids: checkedValues
                                }
                            },
                            success: function(data) {
                                getEntries4();
                                var json = JSON.parse(data);
                                console.log(json);
                                if (json.data == 1) {
                                    swal("Success!", "Successfully deleted material!", "success");
                                } else {
                                    failed_query(json);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                errorLogger('Error:', textStatus, errorThrown);
                            }
                        });
                    } else {
                        swal("Cancelled", "Entries are safe :)", "error");
                    }
                    $("#btn_delete_material").prop('disabled', false);
                    $("#btn_delete_material").html('<i class = "fas fa-trash"> </i> Delete');
                });
        } else {
            swal("Cannot proceed!", "Please select entries to delete!", "warning");
        }
    }

    function getRemainingProjectFee(id) {
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=view",
            data: {
              input: {
                id: id
              }
            },
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;
                $("#remaining_project_fee").val(json.remaining_project_fee);
                $("#project_fee_").val(json.project_fee);
            }
        });
    }

    function getExpectedSalaryByPercentage(){
        var project_fee_view = $("#project_fee_").val()*1;
        var percentage = $("#percentage").val()*1;
        var percentage_  = (percentage/100)*1;
        var total = project_fee_view*percentage_;
        var result = percentage==0?0:total;
        $("#expected_salary").val(result);
    }

    function updateExpectedSalary(project_member_id){
        var remaining_project_fee   = $("#remaining_project_fee").val()*1;
        var expected_salary_old     = $("#textbox-expected-salary-old"+project_member_id).val()*1;
        var expected_salary_new     = $("#textbox-expected-salary-new"+project_member_id).val()*1;
        
        var remaining_project_fee = remaining_project_fee+expected_salary_old;

        if(expected_salary_new>remaining_project_fee){ //OVER 
            amount_is_greater();
            $("#textbox-expected-salary-new"+project_member_id).val(expected_salary_old);
        }else{

            $.ajax({
                type: "POST",
                url: "controllers/sql.php?c=" + route_settings.class_name + "&q=update_expected_salary",
                data: {
                  input: {
                    id: project_member_id,
                    expected_salary:expected_salary_new
                  }
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json.data == 1) {
                       success_update();
                       getEntries2();
                    }else{
                        failed_query(json);
                    }
                }
            });
        }
    }

    $(document).ready(function() {
        getEntries();
        getSelectOption('Clients', 'client_id', 'client_name');
        getSelectOption('Roles', 'roles_id', 'role_name');
        getSelectOption('Users', 'user_id', 'user_fullname');
        getSelectOption('Quotations', 'quotation_id', 'quotation_id');
    });
</script>
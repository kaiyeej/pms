<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Transactions</a></div>
            <div class="breadcrumb-item">Clients</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon bg-secondary" style="border: 1px dashed gray;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Distributions</div>
                Manage distributions here.
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
                                        <th>Member</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Remarks</th>
                                        <th>Date Added</th>
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
<?php include "modal_distributions.php"; ?>
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
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.cash_distribution_id + '" value=' + row.cash_distribution_id + '><label for="checkbox-b' + row.cash_distribution_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><a href='#' class='button-custom-style' onclick='getEntryDetails(" + row.cash_distribution_id + ")'><span class='fa fa-edit'></span></a></center>";
                    }
                },
                {
                    "data": "project"
                },
                {
                    "data": "member"
                },
                {
                    "data": "distribution_date"
                },
                {
                    "data": "total"
                },
                {
                    "data": "cash_distribution_remarks"
                },
                {
                    "data": "date_modified"
                }
            ]
        });
    }

    function getEntries2(project_id){
        var param = "project_id = '" + project_id + "'";
        $("#dt_entries_2").DataTable().destroy();
        $("#dt_entries_2").DataTable({
            "processing": true,
            "order": [
                [3, 'desc']
            ],
            footerCallback: function (row, data, start, end, display) {
            var api = this.api();
 
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
 
            //footer
            $(api.column(1).footer()).html(api.column(1).data().reduce(function (a, b) {return intVal(a) + intVal(b);}, 0));
            $(api.column(2).footer()).html(api.column(2).data().reduce(function (a, b) {return intVal(a) + intVal(b);}, 0));
            $(api.column(3).footer()).html(api.column(3).data().reduce(function (a, b) {return intVal(a) + intVal(b);}, 0));
        },
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
                    "data": "member"
                },
                {
                    "data": "expected_salary"
                },
                {
                    "data": "received"
                },
                {
                    "data": "balance"
                },
            ]
        });
    }

    function getMembers(){
        var project_id = $("#project_id").val();
        getSelectOption('ProjectMembers', 'project_member_id', 'user_fullname', 'project_id="' + project_id + '"');
        getEntries2(project_id);
    }

    $(document).ready(function() {
        getEntries();
        getSelectOption('Projects', 'project_id', 'project_name');
    });
</script>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <input type="hidden" id="hidden_session_user_id" value="<?=$_SESSION['user']['id']?>">
        <div class="col-sm-4">
            <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                    <i class="fa fa-users" style="font-size: 25px;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Clients</h4>
                    </div>
                    <div class="card-body">
                        <?= $Homepage->dashboard_counters('client'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                    <i class="fa fa-folder" style="font-size: 25px;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Projects</h4>
                    </div>
                    <div class="card-body">
                        <?= $Homepage->dashboard_counters('project'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                    <i class="fa fa-users" style="font-size: 25px;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Suppliers</h4>
                    </div>
                    <div class="card-body">
                        <?= $Homepage->dashboard_counters('supplier'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

    <div class="row">
        <div class="card col-lg-12" style="padding: 0px;">
            <div class="card-header">
                 <h5 style="color:black;">Unfinished project tasks and isssues</h5>
            </div>
            <div class="card-body">
                <div class="row" id="task_and_issue_list"></div>
            </div>
        </div>
    </div>

   
</section>

<script type="text/javascript">
function task_and_issue_list(){
    var hidden_session_user_id = $("#hidden_session_user_id").val();
    $.ajax({
        type: "POST",
        url: "controllers/sql.php?c=" + route_settings.class_name + "&q=task_and_issue_list",
         data: {
          input: {
            user_id: hidden_session_user_id
          }
        },
        success: function(data) {
            var jsonParse = JSON.parse(data);
            const json = jsonParse.data;
            $("#task_and_issue_list").html(json);
        }
    });
}

$(document).ready(function() {
    task_and_issue_list();
});
</script>
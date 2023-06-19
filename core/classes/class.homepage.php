<?php

class Homepage extends Connection
{
  

    public function dashboard_counters($data)
    {
        if($data=="client"){
            $fetch = $this->select("tbl_clients", "count(client_id) as count");
            $result = $fetch->fetch_assoc()['count'];
        }else if($data=="project"){
            $fetch = $this->select("tbl_projects", "count(project_id) as count");
            $result = $fetch->fetch_assoc()['count'];
        }else if($data=="supplier"){
            $fetch = $this->select("tbl_suppliers", "count(supplier_id) as count");
            $result = $fetch->fetch_assoc()['count'];
        }else{
            $result = "";
        }
        

        return $result;
    }

    public function task_and_issue_list(){

        $user_id    = isset($this->inputs['user_id']) ? $this->inputs['user_id'] : null;
        $header     ="";
        $body       = "";
        $counter    = 1;
        $result     = $this->select('tbl_project_members', '*',"user_id='$user_id' ORDER BY date_added DESC");
        while ($row = $result->fetch_assoc()) {
            $show_active    = $counter==1?"active show":"";
            $active         = $counter==1?"active":"";
            $aria_selected  = $counter==1?"true":"false";

            $fetch_project = $this->select("tbl_projects", "*","project_id='$row[project_id]'");
            $project_row = $fetch_project->fetch_assoc();

            $header.= '<a class="list-group-item list-group-item-action '.$active.'" id="list-'.$row['project_member_id'].'-list" data-toggle="list" href="#list-'.$row['project_member_id'].'" role="tab" aria-selected="'.$aria_selected.'"><strong>'.$project_row['project_name'].'</strong></a>';

            $body_content_data_task    = "";
            $body_content_data_issue   = "";
            $fetch_tasks = $this->select('tbl_tasks', '*',"project_id='$row[project_id]' AND (status='' OR status='S') AND project_member_id='$user_id'");
            while ($task_row = $fetch_tasks->fetch_assoc()) {
                if($task_row['task_type']=="T"){ //TASK
                    $body_content_data_task .= "<span class='fa fa-circle' style='font-size: 8px;'></span> ".$task_row['task_desc']."<br>";
                }else if($task_row['task_type']=="I"){ //ISSUE
                    $body_content_data_issue .= "<span class='fa fa-circle' style='font-size: 8px;'></span> ".$task_row['task_desc']."<br>";
                }
            }

            $body_content_data_task_ = $body_content_data_task==""?"NO DATA FOUND":$body_content_data_task;

            $body_content_data_issue_ = $body_content_data_issue==""?"NO DATA FOUND":$body_content_data_issue;
                                    

            $body_content = "<div class='row'>
                                <div class='col-sm-6'>
                                    <div class='card' style='border: solid 1px #ccc;border-radius:3px;'>
                                        <div class='card-header' style='border: solid 1px #bebebe;padding: 10px 10px;min-height: 0px;background: #ccd3d8;color:black;'>
                                        <strong>Tasks:</strong>
                                        </div>
                                        <div class='card-body'><p class='card-text'>".$body_content_data_task_."</p></div>
                                    </div>
                                </div>
                                <div class='col-sm-6'>
                                    <div class='card' style='border: solid 1px #ccc;border-radius:3px;'>
                                        <div class='card-header' style='border: solid 1px #bebebe;padding: 10px 10px;min-height: 0px;background: #ccd3d8;color:black;'>
                                        <strong>Issues:</strong>
                                        </div>
                                        <div class='card-body'><p class='card-text'>".$body_content_data_issue_."</p></div>
                                    </div>
                                </div>
                            </div>";


            $body.= '<div class="tab-pane fade '.$show_active.'" id="list-'.$row['project_member_id'].'" role="tabpanel" aria-labelledby="list-'.$row['project_member_id'].'-list">'.$body_content.'</div>';

            $counter++;
        }


        $return = '<div class="col-4" style="overflow-y: scroll; height:400px;"><div class="list-group" id="list-tab" role="tablist">'.$header.'</div></div><div class="col-8"><div class="tab-content" id="nav-tabContent">'.$body.'</div></div>';

        


        return $return;
    }

}

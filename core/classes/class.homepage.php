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

}

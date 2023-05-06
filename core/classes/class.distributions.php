<?php

class Distributions extends Connection
{
    private $table = 'tbl_cash_distributions';
    public $pk = 'cash_distribution_id';
    public $name = 'project_id';

    public function add()
    {

        $project_id = $this->inputs[$this->name];
        $project_member_id = $this->inputs['project_member_id'];
        $balance = $this->get_balance($project_id,$project_member_id,0);

        if($balance<$this->inputs['amount']){
            return 3;
        }else{
            $form = array(
                $this->name                 => $this->clean($project_id),
                'project_member_id'         => $project_member_id,
                'amount'                    => $this->inputs['amount'],
                'cash_distribution_remarks' => $this->inputs['cash_distribution_remarks'],
                'distribution_date'         => $this->inputs['distribution_date'],
            );
            return $this->insert($this->table, $form);
        }  
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $project_id = $this->inputs[$this->name];
        $project_member_id = $this->inputs['project_member_id'];
        $balance = $this->get_balance($project_id,$project_member_id,$primary_id);

        if($balance<$this->inputs['amount']){
            return 3;
        }else{
            $form = array(
                $this->name                 => $this->clean($project_id),
                'project_member_id'         => $project_member_id,
                'amount'                    => $this->inputs['amount'],
                'cash_distribution_remarks' => $this->inputs['cash_distribution_remarks'],
                'distribution_date'         => $this->inputs['distribution_date'],
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

    public function show()
    {
        $rows = array();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $Project = new Projects();
        $Users = new Users();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['project'] = $Project->name($row['project_id']);
            $row['member'] = $Users->fullname($row['project_member_id']);
            $row['total'] = number_format($row['amount'], 2);
            $rows[] = $row;
        }
        return $rows;
    }

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        return $result->fetch_assoc();
    }

    public function show_detail(){
        $Users = new Users();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select("tbl_project_members", '*', $param);
        while ($row = $result->fetch_assoc()) {

            $get_received_cash = $this->get_received_cash($row['project_id'],$row['user_id'],0);

            $row['member']          = $Users->fullname($row['user_id']);
            $row['expected_salary'] = number_format($row['expected_salary'],2);
            $row['received']        = number_format($get_received_cash,2);
            $row['balance']         = number_format($row['expected_salary']-$get_received_cash,2);
            
            $rows[] = $row;
        }
        return $rows;
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, $this->name, "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row[$this->name];
    }

    public function delete_entry()
    {
        $id = $this->inputs['id'];

        return $this->delete($this->table, "$this->pk = $id");
    }

    public function get_received_cash($project_id,$user_id,$cash_distribution_id){
        $dont_include = $cash_distribution_id==0?"":"AND cash_distribution_id != '$cash_distribution_id'";

        $fetch = $this->select($this->table, "SUM(amount) AS received", "project_id = '$project_id' AND project_member_id='$user_id' $dont_include");
        $result = $fetch->fetch_assoc();

        return $result['received'];
    }


    public function get_balance($project_id,$project_member_id,$cash_distribution_id){
        $get_received_cash = $this->get_received_cash($project_id,$project_member_id,$cash_distribution_id);

        $fetch_expected_salary = $this->select("tbl_project_members", "expected_salary AS expected_salary", "project_id = '$project_id' AND user_id='$project_member_id'");
        $get_expected_salary = $fetch_expected_salary->fetch_assoc();

        $balance = $get_expected_salary['expected_salary']-$get_received_cash;

        return $balance;
    }
}

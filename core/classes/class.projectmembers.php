<?php

class ProjectMembers extends Connection
{
    private $table = 'tbl_project_members';
    public $pk = 'project_member_id';
    public $name = 'project_id';

    public function show()
    {
        $rows = array();
        $Users = new Users;
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['user_fullname'] = $Users->fullname($row['user_id']);
            $row['project_member_id'] = $row['user_id'];
            $rows[] = $row;
        }
        return $rows;
    }

}

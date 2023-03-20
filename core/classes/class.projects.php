<?php

class Projects extends Connection
{
    private $table = 'tbl_projects';
    public $pk = 'project_id';
    public $name = 'project_name';

    private $table_detail = 'tbl_project_members';
    public $pk2 = 'project_member_id';
    public $fk_det = 'user_id';

    public function add()
    {
        $project_name = $this->clean($this->inputs[$this->name]);
        $is_exist = $this->select($this->table, $this->pk, "project_name = '$project_name'");
        if ($is_exist->num_rows > 0) {
            return -2;
        } else {
            $form = array(
                $this->name             => $this->clean($this->inputs[$this->name]),
                'client_id'             => $this->inputs['client_id'],
                'project_desc'          => $this->inputs['project_desc'],
                'project_fee'           => $this->inputs['project_fee'],
                'project_remarks'       => $this->inputs['project_remarks'],
                'delivery_date'         => $this->inputs['delivery_date'],
                'date_started'          => $this->inputs['date_started'],
                // 'date_finished'         => $this->inputs['date_finished'],
            );
            return $this->insertIfNotExist($this->table, $form, '', 'Y');
        }
    }

    public function add_detail()
    {
        $primary_id = $this->inputs[$this->pk];
        $fk_det     = $this->inputs[$this->fk_det];

        $form = array(
            $this->pk => $this->inputs[$this->pk],
            $this->fk_det => $fk_det,
            'roles_id' => $this->inputs['roles_id']
        );

        return $this->insertIfNotExist($this->table_detail, $form, "$this->pk = '$primary_id' AND $this->fk_det = '$fk_det'");
    }

    public function add_task()
    {
        $primary_id = $this->inputs[$this->pk];
        $task_desc = $this->inputs['task_desc'];
        $form = array(
            $this->pk => $this->inputs[$this->pk],
            'project_member_id' => $this->inputs['project_member_id'],
            'date_started' => $this->inputs['date_started'],
            'task_desc' => $task_desc,
        );

        return $this->insertIfNotExist('tbl_tasks', $form, "$this->pk = '$primary_id' AND task_desc = '$task_desc'");
    }


    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $project_name = $this->clean($this->inputs[$this->name]);
        $is_exist = $this->select($this->table, $this->pk, "project_name = '$project_name' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                $this->name             => $this->clean($this->inputs[$this->name]),
                'client_id'        => $this->inputs['client_id'],
                'project_desc'        => $this->inputs['project_desc'],
                'project_fee'    => $this->inputs['project_fee']
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

    public function show()
    {
        $rows = array();
        $Clients = new Clients;
        $Payment = new Payment;
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['client_name'] = $Clients->name($row['client_id']);
            $row['project_total'] = number_format($Payment->total_paid($row['project_id']), 2)."/".number_format($row['project_fee'], 2);
            $row['progress'] = $this->task_progress($row['project_id']);
            $rows[] = $row;
        }
        return $rows;
    }

    public function show_detail()
    {
        $Users = new Users();
        $Roles = new Roles();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table_detail, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['member'] = $Users->fullname($row['user_id']);
            $row['role'] = $Roles->name($row['roles_id']);
            $rows[] = $row;
        }
        return $rows;
    }

    public function show_task()
    {
        $Users = new Users();
        $Roles = new Roles();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select("tbl_tasks", '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['member'] = $Users->fullname($row['project_member_id']);
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function view()
    {
        $primary_id = $this->inputs['id'];
        $Clients = new Clients;
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        $row['client_name'] = $Clients->name($row['client_id']);
        $row['project_fee'] = number_format($row['project_fee'], 2);
        return $row;
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function finish()
    {
        $primary_id = $this->inputs['id'];
        $form = array(
            'status'    => 'F',
        );
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function finishTask()
    {
        $ids = implode(",", $this->inputs['ids']);
        $form = array(
            'status'    => 'F',
            'date_finished' => $this->getCurrentDate(),
        );
        return $this->update('tbl_tasks', $form, "task_id IN($ids)");
    }

    
    public function deleteTask()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete('tbl_tasks',"task_id IN($ids)");
    }

    public function deleteMember()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table_detail, "$this->pk2 IN($ids)");
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

    public function task_progress($primary_id)
    {
        $task = $this->select('tbl_tasks', "count(task_id) as total", "$this->pk = '$primary_id'");
        $total_task = $task->fetch_assoc();

        $finished = $this->select('tbl_tasks', "count(task_id) as total", "$this->pk = '$primary_id' AND status ='F'");
        $total_finished = $finished->fetch_assoc();

        $total = ($total_finished['total']/$total_task['total'])*100;

        return $total;
    }
}

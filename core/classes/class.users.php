<?php

class Users extends Connection
{
    private $table = 'tbl_users';
    private $pk = 'user_id';
    private $name = 'username';

    public function add()
    {
        $username = $this->clean($this->inputs['username']);
        $is_exist = $this->select($this->table, $this->pk, "username = '$username'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $pass = $this->inputs['password'];
            $form = array(
                'user_fullname' => $this->inputs['user_fullname'],
                'designation' => $this->inputs['designation'],
                'user_contact_number' => $this->inputs['user_contact_number'],
                'user_address' => $this->inputs['user_address'],
                'user_category' => $this->inputs['user_category'],
                'username' => $this->inputs['username'],
                'password' => md5($pass)
            );
            return $this->insert($this->table, $form);
        }
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $username = $this->clean($this->inputs['username']);
        $is_exist = $this->select($this->table, $this->pk, "username = '$username' AND  $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'user_fullname' => $this->inputs['user_fullname'],
                'designation' => $this->inputs['designation'],
                'user_contact_number' => $this->inputs['user_contact_number'],
                'user_address' => $this->inputs['user_address'],
                'user_category' => $this->inputs['user_category'],
                'username' => $this->inputs['username'],
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }


    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function approved()
    {
        $form = array(
            'status' => "A"
        );

        $ids = implode(",", $this->inputs['ids']);
        foreach ((array) $this->inputs['ids'] as $user_id) {
            $this->sendNotif($user_id, 'Congratulations!', 'Your account was successfully verified.');
        }

        return $this->update($this->table, $form, "$this->pk IN($ids)");
    }

    public function delete_entry()
    {
        $id = $this->inputs['id'];

        return $this->delete($this->table, "$this->pk = $id");
    }

    public function show()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
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

    public static function name($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, $self->name, "$self->pk  = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row[$self->name];
    }

    public static function category($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, 'user_category', "$self->pk  = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['user_category'] == "A" ? "Admin" : ($row['user_category'] == "C" ? "Conductor" : "Passenger");
    }

    public static function fullname($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, 'user_fullname', "$self->pk  = '$primary_id'");

        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            return $row[0];
        } else {
            return "---";
        }
    }

    public static function number($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, 'user_contact_num', "$self->pk  = '$primary_id'");
        $row = $result->fetch_array();
        return $row[0];
    }

    public static function dataRow($primary_id, $field = "*")
    {
        $self = new self;
        $result = $self->select($self->table, $field, "$self->pk  = '$primary_id'");
        $row = $result->fetch_array();
        return $row[$field];
    }

    public function login()
    {

        $username = $this->inputs['username'];
        $password = $this->inputs['password'];

        $result = $this->select($this->table, "*", "username = '$username' AND password = md5('$password')");
        $row = $result->fetch_assoc();

        if ($row) {

            if($row['user_category'] == "A"){
                $cat = "Admin";
            }else{
                $cat = "User";
            }

            $_SESSION['pms_status'] = "in";
            $_SESSION['user']['id'] = $row['user_id'];
            $_SESSION['user']['category'] = $row['user_category'];

            $res = 1;
        } else {
            $res = 0;
        }

        // return $row[$this->name];

        return $res;
    }
    
    public function logout()
    {
        session_destroy();
        return 1;
    }
}

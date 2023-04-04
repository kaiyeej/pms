<?php

class ProjectMaterials extends Connection
{
    private $table = 'tbl_project_materials';
    public $pk = 'project_material_id';
    public $name = 'project_material';

    public function add()
    {
        if(isset($this->inputs['status'])){
            $status = $this->inputs['status'];
        }else{
            $status = 'S';
        }

        $form = array(
            $this->name                 => $this->clean($this->inputs[$this->name]),
            'project_id'                => $this->inputs['project_id'],
            'project_material_amount'   => $this->inputs['project_material_amount'],
            'remarks'                   => $this->inputs['remarks'],
            'status '                   => $status,
        );
        return $this->insert($this->table, $form);
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        if(isset($this->inputs['status'])){
            $status = $this->inputs['status'];
        }else{
            $status = 'S';
        }
        
        $form = array(
            $this->name                 => $this->clean($this->inputs[$this->name]),
            'project_id'                => $this->inputs['project_id'],
            'project_material_amount'   => $this->inputs['project_material_amount'],
            'remarks'                   => $this->inputs['remarks'],
            'status '                   => $status,
        );
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function show()
    {
        $rows = array();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $Projects = new Projects();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['project'] = $Projects->name($row['project_id']);
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

}

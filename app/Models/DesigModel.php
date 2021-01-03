<?php

namespace App\Models;

use CodeIgniter\Model;

class DesigModel extends Model
{
    protected $table = 'designation_tbl';
    protected $primaryKey = 'desg_id';
    protected $allowedFields = ['designation_name', 'description', 'weight', 'status'];

    protected $validationRules    = [
        'designation_name'     => 'required',
        'description'     => 'required',
        'weight'     => 'required',
        'status'     => 'required'
    ];

    protected $validationMessages = [
        'designation_name'        => ['required' => 'Designation Name must enter'],
        'description'        => ['required' => 'description must enter'],
        'weight'        => ['required' => 'weight must enter'],
        'status'        => ['required' => 'status must enter']
    ];

    public function getdataid($id = null)
    {
        return $this->asArray()
            ->where(['desg_id' => $id])
            ->first();
    }

    public function getData()
    {
        $query = $this->db->query('SELECT desg_id, designation_name, description, 
            weight, status FROM designation_tbl order by desg_id desc');
        return $query->getResultArray();
    }

    function getcsvData()
    {
        $query = $this->db->query('SELECT * FROM designation_tbl order by desg_id');
        return $query->getResultArray();
    }

    // check whole row in database
    public function name_checker($name)
    {
        // will check whole row in database
        $query = $this->db->table($this->table)->getWhere($name); 
        return $query->getResult();
    }

    public function insertData($data)
    {
        $query = $this->db->table($this->table)->insert($data);
    }

    public function updateData($data, $id)
    {

        $desg = $this->db->table($this->table)
            ->where('desg_id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        // $id fetch Id from user table
        $builder = $this->db->table($this->table)
            ->where('desg_id', $id)
            ->delete();
    }
}

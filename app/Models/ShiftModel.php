<?php

namespace App\Models;


use CodeIgniter\Model;

class ShiftModel extends Model
{
    protected $table = 'shift_tbl';
    protected $primaryKey = 'shift_id';
    protected $allowedFields = ['shift_name', 'description', 'login_start', 
                        'login_end','login_grace','logout','status'];

    protected $validationRules    = [
        'shift_name'     => 'required',
        'description'     => 'required',
        'login_start'     => 'required',
        'login_end'     => 'required',
        'login_grace'     => 'required',
        'logout'     => 'required',
        'status'     => 'required'
    ];

    protected $validationMessages = [
        'shift_name'        => ['required' => 'shift name must enter'],
        'description'        => ['required' => 'description must enter'],
        'login_start'        => ['required' => 'login start must enter'],
        'login_end'        => ['required' => 'login end must enter'],
        'login_grace'        => ['required' => 'login_grace must enter'],
        'logout'        => ['required' => 'logout must enter'],
        'status'        => ['required' => 'status must enter']
    ];

    public function getdataid($id = null)
    {
        return $this->asArray()
            ->where(['shift_id' => $id])
            ->first();
    }

    public function getData()
    {
        //    new code
        $query = $this->db->query('SELECT shift_id, shift_name, description, login_start, login_end, login_grace, logout, status FROM shift_tbl order by shift_id desc');
        return $query->getResultArray();
        //        
        //  another style
        //        $query = $this->db->table('department_tbl')->get();
        //        return $query->getResultArray();
    }

    public function getcsvData(){
        $query = $this->db->query('SELECT * FROM shift_tbl order by shift_id');
        return $query->getResultArray();
    }

    public function insertData($data)
    {
        $query = $this->db->table($this->table)->insert($data);
    }

    public function updateData($data, $id)
        {
                // $this->db->table($this->table)->update($data, $where);
                // $db  = \Config\Database::connect();
                $role = $this->db->table($this->table)
                    ->where('shift_id', $id)
                    ->update($data);
        }

    public function deleteData($id)
    {
        // $id fetch Id from user table
        // $db  = \Config\Database::connect();
        $builder = $this->db->table($this->table)
            ->where('shift_id', $id)
            ->delete();
    }
}

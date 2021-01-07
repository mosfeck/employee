<?php

namespace App\Models;


use CodeIgniter\Model;

class DepartModel extends Model
{
    protected $table = 'department_tbl';
    protected $primaryKey = 'dept_id';
    protected $allowedFields = ['department_name', 'description', 'status'];

    protected $validationRules    = [
        'department_name'     => 'required',
        'description'     => 'required',
        'status'     => 'required'
    ];

    protected $validationMessages = [
        'department_name'        => ['required' => 'Department Name must enter'],
        'description'        => ['required' => 'description must enter'],
        'status'        => ['required' => 'status must enter']
    ];

    public function getdataid($id = null)
    {
        //    new code with query builder
        
        $db = \Config\Database::connect();
        $builder = $db->table($this->table)
                    ->where('dept_id',$id);
        $result =  $builder->get();           
        if(count($result->getResultArray())>0)
        {
            return $result->getRowArray();
        }else{
            return false;
        }

        // // auto query result
        // return $this->asArray()
        //     ->where(['dept_id' => $id])
        //     ->first();
    }

    // display all data
    public function getData()
    {
        //    new code with query builder

        $db = \Config\Database::connect();
        $builder = $db->table($this->table)
                    ->select('dept_id,department_name,description,status')
                    ->orderBy('dept_id','DESC');
        $result =  $builder->get();           
        if(count($result->getResultArray())>0)
        {
            return $result->getResultArray();
        }else{
            return false;
        }
        // // query based
        // $sql = "SELECT dept_id, department_name, description, status 
        //     FROM department_tbl order by dept_id desc";
        // // $query = $this->db->query('SELECT dept_id, department_name, description, status FROM department_tbl order by dept_id desc');
        // $query = $this->db->query($sql);
        // return $query->getResultArray();

        

        // check before display
        // print_r($query->getResultArray());
        // get 1 row
        // return $query->getRow();

        //        
        //  another style
        //        $query = $this->db->table('department_tbl')->get();
        //        return $query->getResultArray();

        //        
        //another style 2 not working

        //        $builder = $db->table('department_tbl');
        //        $query = $builder->get();
        //        return $query;
        //        
        //        
        //        //another style 3 not working
        //        $query = $this->db->select('dept_id,department_name,description,status')
        //                ->get('department_tbl');
        //        return $query->getResultArray();
        //
        //
        ////  //another style 4 not working
        ////        $db = \Config\Database::connect();
        //        $db = db_connect();
        //        $builder->select('dept_id,department_name,description,status');
        ////        $builder = $db->table('department_tbl');
        //        $query = $builder->from('department_tbl')->get();
        //        return $query->getResultArray();
        //        return  $builder->get();
    }

    public function getcsvData()
    {
        $query = $this->db->query('SELECT * FROM department_tbl order by dept_id');
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
        $db  = \Config\Database::connect();
        $builder = $db->table($this->table)
            ->insert($data);
        if ($db->affectedRows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateData($data, $id)
    {

        $db  = \Config\Database::connect();
        $builder = $this->db->table($this->table)
            ->where('dept_id', $id)
            ->update($data);
        if ($db->affectedRows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('department_tbl');
        $builder->where('dept_id', $id);
        $builder->delete();
        if ($db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
        // $id fetch Id from user table
        // $db  = \Config\Database::connect();
        // $builder = $this->db->table($this->table)
        //     ->where('dept_id', $id)
        //     ->delete();
    }
}

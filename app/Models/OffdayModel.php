<?php

namespace App\Models;


use CodeIgniter\Model;

class OffdayModel extends Model
{
    protected $table = 'offday_tbl';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'title_type', 'cur_date', 'status'];

    protected $validationRules    = [
        'title'     => 'required',
        'title_type'     => 'required',
        'cur_date'     => 'required',
        'status'     => 'required'
    ];

    protected $validationMessages = [
        'title'        => ['required' => 'title must enter'],
        'title_type'        => ['required' => 'title type must enter'],
        'cur_date'        => ['required' => 'current date must enter'],
        'status'        => ['required' => 'status must enter']
    ];

    public function getdataid($id = null)
    {
        return $this->asArray()
            ->where(['id' => $id])
            ->first();
    }

    public function getData()
    {
        //    new code

        $query = $this->db->query('SELECT id, title, title_type, cur_date, status FROM offday_tbl order by id desc');
        return $query->getResultArray();
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

    public function getcsvData(){
        $query = $this->db->query('SELECT * FROM offday_tbl order by id');
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
                    ->where('id', $id)
                    ->update($data);
        }

    public function deleteData($id)
    {
        // $id fetch Id from user table
        // $db  = \Config\Database::connect();
        $builder = $this->db->table($this->table)
            ->where('id', $id)
            ->delete();
    }
}

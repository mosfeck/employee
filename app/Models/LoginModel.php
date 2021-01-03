<?php
namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model {
    protected $table = 'employee_tbl';
    protected $primaryKey = 'employee_id';
    protected $allowedFields = [
        'employee_id','first_name','password' 
    ];
    
    public function getEmployee($data){
        $query = $this->db->table($this->table)->getWhere($data);
        return $query->getResult();
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
        // public function __construct() {
        //         $db = \Config\Database::connect();
        // }
        protected $table = 'user_role_tbl';
        protected $primaryKey = 'role_id';
        protected $allowedFields = ['role_name', 'description', 'status'];

        protected $validationRules    = [
                'role_name'     => 'required',
                'description'     => 'required',
                'status'     => 'required'
        ];

        protected $validationMessages = [
                'role_name'        => ['required' => 'Role Name must enter'],
                'description'        => ['required' => 'description must enter'],
                'status'        => ['required' => 'status must enter']
        ];

        public function getdataid($id = null)
        {
                return $this->asArray()
                        ->where(['role_id' => $id])
                        ->first();
        }

        public function getData()
        {
                $query = $this->db->query('SELECT role_id, role_name, 
                                        description, status FROM user_role_tbl 
                                        order by role_id desc');
                return $query->getResultArray();
        }

        function getcsvData()
        {
                $query = $this->db->query('SELECT * FROM user_role_tbl 
                                        order by role_id');
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
                // $db = \Config\Database::connect();
                $query = $this->db->table($this->table)->insert($data);
                // return $query;
        }

        public function deleteData($id)
        {
                // $deleteDataId fetch Id from user table
                $db  = \Config\Database::connect();
                $builder = $db->table('user_role_tbl');
                $builder->where('role_id', $id);
                $builder->delete();
                // if ($builder) {
                //         // $message = "Record Successfully Deleted";
                //         // echo view('roles/role-view', ['Delete' => $message]);
                //         // return redirect()->to(base_url('RoleControl'));
                // }
        }



        public function updateData($data, $id)
        {
                // $db = \Config\Database::connect();
                // $this->db->table($this->table)->update($data, $where);
                $db  = \Config\Database::connect();
                $role = $db->table('user_role_tbl');
                // $data = [
                //         'role_name' => $formArray['role_name'],
                //         'description'  => $formArray['description'],
                //         'status'  => $formArray['status']
                // ];
                $role->where('role_id', $id);
                $role->update($data);
        }

        // Insert data Functiion
        // public function insertData($FormArray)
        // {
        //         $db  = \Config\Database::connect();
        //         $role = $db->table('user_role_tbl');
        //         $data = [
        //                 'role_name' => $FormArray['role_name'],
        //                 'description'  => $FormArray['description'],
        //                 'status'  => $FormArray['status']
        //         ];
        //         $role->insert($data);
        //         // return redirect()->to(base_url('RoleControl'));
        //         $message = "Your Record Successfully Insert";
        //         return view('roles/role-view', ['Insert' => $message]);
        //         /* $sql = "INSERT INTO users (Name, Last_Name) VALUES (".$db->escape($Formarray['name']).", ".$db->escape($Formarray['last']).")";
        //         $db->query($sql);*/
        // }

        //Update data
        // public function updateData($formArray, $id)
        // {
        //         //validation If Post data Are blank then not Update data
        //         // if (!empty($formArray)) {
        //                 $db  = \Config\Database::connect();

        //                 $role = $db->table('user_role_tbl');
        //                 // validation If Post Name and last name will be blank then shown Errorin else part 
        //                 if ($formArray['role_name'] !== "" || $formArray['description'] !== "" || $formArray['status'] !== "") {
        //                         $data = [
        //                                 'role_name' => $formArray['role_name'],
        //                                 'description'  => $formArray['description'],
        //                                 'status'  => $formArray['status']
        //                         ];
        //                         // $role->where('role_id', $id);
        //                         $role->update($id, $data);
        //                         // print_r($role);
        //                         $message = "Record Successfully Updated";
        //                         echo view('roles/role_view', ['Edit' => $message]);
        //                 } else {
        //                         echo 'Empty data can not be updated';
        //                 }
        //         // }
        // }
}

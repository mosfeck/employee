<?php

namespace App\Controllers;

// use CodeIgniter\Controller;
use App\Models\EmployeeModel;



class EmployeeControl extends BaseController
{
    protected $session;
    protected $validation;

    var $target_dir;
    var $file_name;
    var $target_file;
    // var $data = array();

    public function __construct()
    {
        $this->model = new EmployeeModel();
        $this->session = \Config\Services::session();
        $this->validation =  \Config\Services::validation();
        helper(['form', 'url']);

        
    }

    public function index()
    {
        //        helper(['form', 'url']);
        //        
        // echo view('templates/header');

        //        $data['employees'] = $this->model->orderBy('employee_id', 'DESC')->findAll();

        $data['employees'] = $this->model->get_employee();
        //        print_r($data['employees']);exit;

        return view('employees/employee_view', $data);
        // return redirect()->to(base_url('LoginControl/getUser'));
    }

    public function create()
    {
        $depart['departments'] = $this->model->get_department2();
        //      print_r($depart['departments']);exit;
        $depart['designations'] = $this->model->get_designation2();
        $depart['roles'] = $this->model->get_role2();

        return view('employees/employee-create-view_1', $depart);
    }

    public function export()
    {
        $file_name = 'Employee_details_' . date('d-m-Y') . '.csv';
        // print_r($file_name);exit;
        // add header
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");


        // get data 
        $data = $this->model->getcsvData();
        // print_r($data['exportData']);exit;

        // file creation 
        $file = fopen('php://output', 'w');


        // $header = array("Department id","Department name", "description","status");
        // print_r($header);exit;
        // fputcsv($file, $header);
        foreach ($data as $value) {
            $csv = fputcsv($file, $value);
        }
        // $csv->move(WRITEPATH.'uploads');
        fclose($file);
        exit;
        $message = "Record Exported Successfully";
        // return redirect()->to( base_url('EmployeeControl') )->with('msg', $message);
        $this->session->setFlashdata('update', '<div class="alert alert-success text-center">Record Exported Successfully!</div>');
        return redirect()->to(base_url('EmployeeControl'));
    }

    // add or update
    public function createOrUpdate()
    {
        $this->target_dir = "uploads/";
        $this->file_name = basename($_FILES["avatar"]["name"]);
        $this->target_file = $this->target_dir . $this->file_name;

        // check whether the method is post
        if ($this->request->getMethod() !== 'post') {
            return redirect('index');
        }

        $id = $this->request->getVar('employee_id');

        //file validation
        $validated = $this->validate([
            'avatar' => [
                'uploaded[avatar]',
                'mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[avatar,4096]',
            ],
        ]);

        $message = "Record Updated Successfully";

        $data = [
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'password' => md5($this->request->getVar('password')),
            'mobile' => $this->request->getVar('mobile'),
            'email' => $this->request->getVar('email'),
            'address' => $this->request->getVar('address'),
            'gender' => $this->request->getVar('gender'),
            // 'photo' => $this->request->getFile('avatar'),
            'photo' => $this->file_name,
            'dept_id' => $this->request->getVar('dept_id'),
            'desg_id' => $this->request->getVar('desg_id'),
            'role_id' => $this->request->getVar('role_id'),
            'status' => $this->request->getVar('status')
        ];

        if(empty($id))
        {
            if (!$validated) {
                echo view('employees/employee-create-view_1',  ['validation' => $this->validator]);
            } else {
                $save = $this->model->insertData($data);
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $this->target_file);
                return redirect()->route('Employees/create')->with('msg', $message);
            }
        }
        else
        {
            if (empty($this->file_name)) {

                $data = [
                    'first_name' => $this->request->getVar('first_name'),
                    'last_name' => $this->request->getVar('last_name'),
                    // 'password' => md5($this->request->getVar('password')),
                    'mobile' => $this->request->getVar('mobile'),
                    'email' => $this->request->getVar('email'),
                    'address' => $this->request->getVar('address'),
                    'gender' => $this->request->getVar('gender'),
                    // 'photo' => $this->request->getFile('avatar'),
                    // 'photo' => $this->file_name,
                    'dept_id' => $this->request->getVar('dept_id'),
                    'desg_id' => $this->request->getVar('desg_id'),
                    'role_id' => $this->request->getVar('role_id'),
                    'status' => $this->request->getVar('status')
                ];

                $save = $this->model->updateData($data, $id);
            }else{
            $data = [
                'first_name' => $this->request->getVar('first_name'),
                'last_name' => $this->request->getVar('last_name'),
                // 'password' => md5($this->request->getVar('password')),
                'mobile' => $this->request->getVar('mobile'),
                'email' => $this->request->getVar('email'),
                'address' => $this->request->getVar('address'),
                'gender' => $this->request->getVar('gender'),
                // 'photo' => $this->request->getFile('avatar'),
                'photo' => $this->file_name,
                'dept_id' => $this->request->getVar('dept_id'),
                'desg_id' => $this->request->getVar('desg_id'),
                'role_id' => $this->request->getVar('role_id'),
                'status' => $this->request->getVar('status')
            ];
            $save = $this->model->updateData($data, $id);
            move_uploaded_file($_FILES["avatar"]["tmp_name"], $this->target_file);
        }

            $this->session->setFlashdata('update', '<div class="alert alert-success text-center">Record Updated Successfully!</div>');
            return redirect()->route('Employees');
        }
    }

    public function store()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect('index');
        }

        $validated = $this->validate([
            'avatar' => [
                'uploaded[avatar]',
                'mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[avatar,4096]',
            ],
        ]);

        $data = [
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'password' => md5($this->request->getVar('password')),
            'mobile' => $this->request->getVar('mobile'),
            'email' => $this->request->getVar('email'),
            'address' => $this->request->getVar('address'),
            'gender' => $this->request->getVar('gender'),
            // 'photo' => $this->request->getFile('avatar'),
            'photo' => $this->file_name,
            'dept_id' => $this->request->getVar('dept_id'),
            'desg_id' => $this->request->getVar('desg_id'),
            'role_id' => $this->request->getVar('role_id'),
            'status' => $this->request->getVar('status')
        ];





        // if ($this->model->insertData($data) === false) {
        //     return view('employees/employee-create-view_1', ['errors' => $this->model->errors()]);
        if (!$validated) {
            echo view('employees/employee-create-view_1',  ['validation' => $this->validator]);
        } else {
            $save = $this->model->insertData($data);
            // $save = $this->model->insert($data);
            // $message = "Record Updated Successfully";
            // print_r($message);exit;
            // echo view('employees/employee-create-view_1', ['Insert' => $message]);
            move_uploaded_file($_FILES["avatar"]["tmp_name"], $this->target_file);
            // $avatar = $this->request->getFile('avatar');
            // $avatar->move(WRITEPATH . 'uploads');
            // $this->session->setFlashdata('update', '<div class="alert alert-success text-center">Record Updated Successfully !</div>');
            // return redirect()->to(base_url('EmployeeControl'));
            // return redirect()->route('EmployeeControl');
            $message = "Record Successfully Updated";
            return redirect()->to(base_url('EmployeeControl/create'))->with('msg', $message);
        }
    }

    // public function cancel()
    // {
    //     return redirect()->route('Employees');
    // }

    public function edit($id = null)
    {
        $data['employees'] = $this->model->getdataid($id);
        //        print_r($data['employees']);exit;
        //        $data['employees'] = $this->model->where('employee_id', $id)->first();
        $data['departments'] = $this->model->get_department2();
        $data['designations'] = $this->model->get_designation2();
        $data['roles'] = $this->model->get_role2();

        // $data['empdept'] = $this->model->get_employee_id($id);
        //        print_r($data['empdept']);exit;
        return view('employees/employee-edit-view_1', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('employee_id');

        if ($_FILES["avatar"]["name"] == 0) {
            

            $data = [
                'first_name' => $this->request->getVar('first_name'),
                'last_name' => $this->request->getVar('last_name'),
                // 'password' => md5($this->request->getVar('password')),
                'mobile' => $this->request->getVar('mobile'),
                'email' => $this->request->getVar('email'),
                'address' => $this->request->getVar('address'),
                'gender' => $this->request->getVar('gender'),
                // 'photo' => $this->request->getFile('avatar'),
                // 'photo' => $this->file_name,
                'dept_id' => $this->request->getVar('dept_id'),
                'desg_id' => $this->request->getVar('desg_id'),
                'role_id' => $this->request->getVar('role_id'),
                'status' => $this->request->getVar('status')
            ];

            // $save = $this->model->update($id, $data);
            $save = $this->model->updateData($data, $id);
        } 
            // $id = $this->request->getVar('employee_id');
            
            $data = [
                'first_name' => $this->request->getVar('first_name'),
                'last_name' => $this->request->getVar('last_name'),
                // 'password' => md5($this->request->getVar('password')),
                'mobile' => $this->request->getVar('mobile'),
                'email' => $this->request->getVar('email'),
                'address' => $this->request->getVar('address'),
                'gender' => $this->request->getVar('gender'),
                // 'photo' => $this->request->getFile('avatar'),
                'photo' => $this->file_name,
                'dept_id' => $this->request->getVar('dept_id'),
                'desg_id' => $this->request->getVar('desg_id'),
                'role_id' => $this->request->getVar('role_id'),
                'status' => $this->request->getVar('status')
            ];

            // $save = $this->model->update($id, $data);
            $save = $this->model->updateData($data, $id);
            move_uploaded_file($_FILES["avatar"]["tmp_name"], $this->target_file);
        
        // $message = "Record Successfully Updated";
        // echo view('employees/employee-edit-view_1', ['Edit' => $message]);
        $this->session->setFlashdata('update', '<div class="alert alert-success text-center">Record Updated Successfully!</div>');
        return redirect()->to(base_url('EmployeeControl'));
    }

    public function delete($id = null)
    {
        // $data['employees'] = $this->model->where('employee_id', $id)->delete();
        $data['employees'] = $this->model->deleteData($id);
        return redirect()->route('Employees');
    }
}

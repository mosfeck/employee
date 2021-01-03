<?php

namespace App\Controllers;

// use CodeIgniter\Controller;
use App\Models\RoleModel;
use CodeIgniter\Validation\Validation;


class RoleControl extends BaseController
{

    public function __construct()
    {
        $this->model = new RoleModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        // echo view('templates/header');
        // $data['roles'] = $this->model->orderBy('role_id', 'DESC')->findAll();
        $data['roles'] = $this->model->getData();
        return view('roles/role_view', $data);
    }

    public function create()
    {
        return view('roles/role-create-view');
    }

    public function export()
    {
        $file_name = 'Role_details_' . date('d-m-Y') . '.csv';
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
        // $this->session->setFlashdata('update', '<div class="alert alert-success text-center">Record Exported Successfully!</div>');
        return redirect()->to(base_url('RoleControl'))->with('msg', $message);
    }

    // add or update
    public function createOrUpdate()
    {
        $id = $this->request->getVar('role_id');
        $role['role_name'] = $this->request->getPost("role_name");
        
        $data = [
            'role_name' => $this->request->getVar('role_name'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
        ];
        
        $message = "Record Updated Successfully";
        $roleResult = $this->model->name_checker($role);

        if(empty($id))
        {
            if (count($roleResult) > 0) {
                $message = "Duplicate Role name. Please use another name";
                // echo view('roles/role-create-view', ['Insert' => $message]);
                return redirect()->route('Roles/create')->withInput()->with('Insert', $message);
            } else {
                $save = $this->model->insertData($data);
                return redirect()->route('Roles/create')->with('msg', $message);
            }
        }
        else
        {
            $this->model->updateData($data, $id);
            return redirect()->route('Roles')->with('msg', $message);
        }
    }

    public function store()
    {
        // new validation
        $validation =  \Config\Services::validation();


        // $validationRules = ([
        //     'role_name' => 'required',
        //     'description' => 'required',
        //     'status' => 'required'
        // ]);

        // $validationMessages = ['role_name'=>'role_name is not filled','description'=>'description is not Filled','status'=>'status is not Filled'];

        // $validationMessages = [ 'role_name'  => [
        //             'required' => 'role_name is not filled'
        //     ]];


        // if (!$this->validate([])) {
        //     // $errors = $validation->getErrors();
        //     // $validation->getRuleGroup($role);
        //     return view('roles/role-create-view', ['validation' => $this->validation]);
        // } else {
        //     $data = [
        //         'role_name' => $this->request->getVar('role_name'),
        //         'description' => $this->request->getVar('description'),
        //         'status' => $this->request->getVar('status'),
        //     ];
        //     // $validation->run($data, $role);
        //     $save = $this->model->insert($data);
        //     return redirect()->to(base_url('RoleControl'));
        // }
        // another version
        // if ($this->request->getVar('role_name') !== "" || $this->request->getVar('description') !== "" || $this->request->getVar('status') !== "") {
        $role['role_name'] = $this->request->getPost("role_name");

        $data = [
            'role_name' => $this->request->getVar('role_name'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
        ];

        $roleResult = $this->model->name_checker($role);

        if (count($roleResult) > 0) {
            $message = "Duplicate Role name. Please use another name";
            echo view('roles/role-create-view', ['Insert' => $message]);
        } else {
            $save = $this->model->insertData($data);
            $message = "Record Updated Successfully";
            return redirect()->to(base_url('RoleControl/create'))->with('msg', $message);
        }

        //original code
        // if ($this->model->insertData($data) === false) {
        //     return view('roles/role-create-view', ['errors' => $this->model->errors()]);
        // } 
        // else {
        // $save = $this->model->insert($data);

        // echo  view('Success',['Insert'=>$message]);
        // return redirect()->to(base_url('RoleControl'));

        // echo view('roles/role-create-view', ['Insert' => $message]);
        // $message = "Record Updated Successfully";
        // return redirect()->to( base_url('RoleControl/create') )->with('msg', $message);

        // echo json_encode(array("status" => TRUE));
        // }
        // }
        // else {
        //     $message = "Record can not insert Empty";
        //         echo view('roles/role-create-view', ['Insert' => $message]);
        //     // echo 'Data Not insert Empty';
        // }
        // old code

        // $data = [
        //     'role_name' => $this->request->getVar('role_name'),
        //     'description' => $this->request->getVar('description'),
        //     'status' => $this->request->getVar('status'),
        // ];

        // $save = $this->model->insert($data);
        // // $this->session->set_flashdata('msg','<div class="alert alert-success">Updated Successfully</div>');

        // return redirect()->to(base_url('RoleControl'));
    }

    // public function cancel()
    // {
    //     return redirect()->route('Roles');
    // }

    public function edit($id = null)
    {

        // $data['roles'] = $this->model->where('role_id', $id)->first();
        $data['roles'] = $this->model->getdataid($id);
        return view('roles/role-edit-view', $data);
    }

    public function update()
    {
        // if ($this->request->getVar('role_name') !== "" && $this->request->getVar('description') !== "" && $this->request->getVar('status') !== "") {
        // $role['role_name'] = $this->request->getPost("role_name");
        $id = $this->request->getVar('role_id');

        $data = [
            'role_name' => $this->request->getVar('role_name'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status')
        ];

        // $roleResult = $this->model->name_checker($role);

        // if (count($roleResult) > 0) {
        //     $message = "Duplicate Role name. Please use another name";
        //     echo view('roles/role-edit-view', ['Insert' => $message]);
        // } else {
            $this->model->updateData($data, $id);
            $message = "Record Updated Successfully";
            return redirect()->to(base_url('RoleControl'))->with('msg', $message);
            // echo view('roles/role-edit-view', ['Edit' => $message]);
        // }
        // } 
        // else {
        //     $message = "Empty record cannot update";
        //     echo view('roles/role-edit-view', ['Edit' => $message]);
        //     // return view('roles/role-edit-view', ['errors' => $this->model->errors()]);
        // }

        // return redirect()->to(base_url('RoleControl'));
    }

    public function delete($id = null)
    {
        // $data['roles'] = $this->model->where('role_id', $id)->delete();
        $data['roles'] = $this->model->deleteData($id);
        $message = "Record Deleted Successfully";
        return redirect()->route('Roles')->with('msg', $message);
    }
}

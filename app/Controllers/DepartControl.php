<?php

namespace App\Controllers;

// use CodeIgniter\Controller;
use App\Models\DepartModel;
// use CodeIgniter\CLI\Console;

class DepartControl extends BaseController
{

    public function __construct()
    {
        $this->model = new DepartModel();

        // $DepartModel = new DepartModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        // echo view('templates/header');
        //        $data['departs'] = $this->model->orderBy('dept_id', 'DESC')->findAll();
        $data['departs'] = $this->model->getData();
        //        print_r($data['departs']);exit;
        return view('departments/depart_view', $data);
    }

    public function create()
    {
        return view('departments/depart-create-view');
    }

    public function export()
    {

        // $path = 'php://output';
        // // print_r($path);exit;
        // $file = new \CodeIgniter\Files\File($path);
        // print_r($file);exit;

        $file_name = 'Department_details_' . date('d-m-Y') . '.csv';
        // print_r($file_name);exit;
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");


        // get data 
        // $student_data = $this->export_csv_model->fetch_data();
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

        // // Write CSV rows to it.
        // if ($file->isWritable()) {
        //     $csv = $file->openFile('w');

        //     foreach ($data as $row) {
        //         $csv->fputcsv($row);
        //         // print_r($csv);exit;
        //     }

        // }
        // $file->move(WRITEPATH.'uploads');
    }

    // add or update
    public function createOrUpdate()
    {
        $id = $this->request->getVar('dept_id');
        $depart['department_name'] = $this->request->getPost("department_name");

        $val = $this->validate([
            'department_name' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'department_name' => $this->request->getVar('department_name'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
        ];

        $message = "Record Updated Successfully";

        $departResult = $this->model->name_checker($depart);

        if (!$val) {
            return redirect()->route('Departs/create')->withInput()->with('validation', $this->validator);
        } else {
            if (empty($id)) {
                if (count($departResult) > 0) {
                    $message = "Duplicate Department name. Please use another name";
                    // echo view('departments/depart-create-view', ['Insert' => $message]);
                    return redirect()->route('Departs/create')->withInput()->with('Insert', $message);
                } else {
                    $save = $this->model->insertData($data);
                    // $message = "Record Updated Successfully";
                    return redirect()->route('Departs/create')->with('msg', $message);
                }
            } else {
                $save = $this->model->updateData($data, $id);
                return redirect()->route('Departs')->with('msg', $message);
            }
        }
    }

    public function store()
    {
        // validation check
        //        helper(['form', 'url']);

        // $val = $this->validate([
        //     'department_name' => 'required',
        //     'description' => 'required',
        //     'status'  => 'required',
        // ]);

        //        $model = new ContactModel();
        //        $this->model = new DepartModel();

        // $val =$this->model->errors();
        $depart['department_name'] = $this->request->getPost("department_name");

        $data = [
            'department_name' => $this->request->getVar('department_name'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
        ];

        $departResult = $this->model->name_checker($depart);

        if (count($departResult) > 0) {
            $message = "Duplicate Department name. Please use another name";
            echo view('departments/depart-create-view', ['Insert' => $message]);
            // return redirect()->to(base_url('DepartControl/create'))->with('msg', $message);
        } else {
            $save = $this->model->insertData($data);
            $message = "Record Updated Successfully";
            return redirect()->to(base_url('DepartControl/create'))->with('msg', $message);
        }
        // if (!$val)
        // {
        //     return view('departments/depart-create-view', ['errors' => $this->model->errors()]);
        // }

        // original code
        // if ($this->model->insertData($data) === false) {
        //     return view('departments/depart-create-view', ['errors' => $this->model->errors()]);
        // } else {
        //     //    $save = $this->model->insertData($data);
        //     $message = "Record Updated Successfully";
        //     // echo view('departments/depart-create-view', ['Insert' => $message]);
        //     return redirect()->to(base_url('DepartControl/create'))->with('msg', $message);  
        // }

    }


    // public function cancel()
    // {
    //     // return redirect()->to(base_url('DepartControl'));
    //     return redirect()->route('Departs');
    // }

    public function edit($id = null)
    {
        $data['departs'] = $this->model->getdataid($id);
        return view('departments/depart-edit-view', $data);
    }

    public function update()
    {
        // $depart['department_name'] = $this->request->getPost("department_name");
        $id = $this->request->getVar('dept_id');

        $data = [
            'department_name' => $this->request->getVar('department_name'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
        ];

        // $departResult = $this->model->name_checker($depart);

        // if (count($departResult) > 0) {
        //     $message = "Duplicate Department name. Please use another name";
        //     echo view('departments/depart-edit-view', ['Insert' => $message]);
        // } else {
        $save = $this->model->updateData($data, $id);
        $message = "Record Successfully Updated";
        // echo view('departments/depart-edit-view', ['Edit' => $message]);
        return redirect()->to(base_url('DepartControl'))->with('msg', $message);
        // }
    }


    public function delete($id = null)
    {
        $data['departs'] = $this->model->deleteData($id);
        $message = "Record deleted successfully";
        return redirect()->route('Departs')->with('msg', $message);
    }
}

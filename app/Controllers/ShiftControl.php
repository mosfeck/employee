<?php

namespace App\Controllers;

// use CodeIgniter\Controller;
use App\Models\ShiftModel;
use CodeIgniter\CLI\Console;

class ShiftControl extends BaseController
{

    public function __construct()
    {
        $this->model = new ShiftModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        // echo view('templates/header');
        
        $data['shifts'] = $this->model->getData();
        //print_r($data['offdays']);exit;
        return view('shifts/shift_view', $data);
    }

    public function create()
    {
        return view('shifts/shift-create-view');
    }

    public function export()
    {
        
        $file_name = 'Shift_details_' . date('d-m-Y') . '.csv';
        // print_r($file_name);exit;
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
    }

    // add or update
    public function createOrUpdate()
    {
        $id = $this->request->getVar('shift_id');

        $data = [
            'shift_name' => $this->request->getVar('shift_name'),
            'description' => $this->request->getVar('description'),
            'login_start' => $this->request->getVar('login_start'),
            'login_end' => $this->request->getVar('login_end'),
            'login_grace' => $this->request->getVar('login_grace'),
            'logout' => $this->request->getVar('logout'),
            'status' => $this->request->getVar('status')
        ];

        $message = "Record Updated Successfully";

        if(empty($id))
        {
            if ($this->model->insertData($data) === false) {
                return view('shifts/shift-create-view', ['errors' => $this->model->errors()]);
            } 
            else {
                return redirect()->route('Shifts/create')->with('msg', $message);
            }
        }
        else
        {
            $save = $this->model->updateData($data, $id);
            return redirect()->route('Shifts')->with('msg', $message);
        }
    }

    // public function store()
    // {
    //     $data = [
    //         'shift_name' => $this->request->getVar('shift_name'),
    //         'description' => $this->request->getVar('description'),
    //         'login_start' => $this->request->getVar('login_start'),
    //         'login_end' => $this->request->getVar('login_end'),
    //         'login_grace' => $this->request->getVar('login_grace'),
    //         'logout' => $this->request->getVar('logout'),
    //         'status' => $this->request->getVar('status')
    //     ];

    //     if ($this->model->insertData($data) === false) {
    //         return view('shifts/shift-create-view', ['errors' => $this->model->errors()]);
    //     } else {
    //         //    $save = $this->model->insertData($data);
    //         $message = "Record Updated Successfully";
    //         // echo view('offdays/offday-create-view', ['Insert' => $message]);
    //         return redirect()->to( base_url('ShiftControl/create') )->with('msg', $message);
    //     }
    // }

    // public function cancel()
    // {
    //     return redirect()->to(base_url('ShiftControl'));
    // }

    public function edit($id = null)
    {

        $data['shifts'] = $this->model->getdataid($id);
        return view('shifts/shift-edit-view', $data);
    }

    // public function update()
    // {
    //     $id = $this->request->getVar('shift_id');

    //     $data = [
    //         'shift_name' => $this->request->getVar('shift_name'),
    //         'description' => $this->request->getVar('description'),
    //         'login_start' => $this->request->getVar('login_start'),
    //         'login_end' => $this->request->getVar('login_end'),
    //         'login_grace' => $this->request->getVar('login_grace'),
    //         'logout' => $this->request->getVar('logout'),
    //         'status' => $this->request->getVar('status')
    //     ];

    //     $save = $this->model->updateData($data, $id);
    //     $message = "Record Successfully Updated";
    //     // echo view('offdays/offday-edit-view', ['Edit' => $message]);
    //     // $this->session->setFlashdata('update', '<div class="alert alert-success text-center">Record Updated Successfully !</div>');
    //     return redirect()->to(base_url('ShiftControl'))->with('msg', $message);
    // }

    public function delete($id = null)
    {
        $data['shifts'] = $this->model->deleteData($id);
        $message = "Record Deleted successfully ";
        return redirect()->route('Shifts')->with('msg', $message);
    }
}

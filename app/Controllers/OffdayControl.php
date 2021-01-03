<?php

namespace App\Controllers;

// use CodeIgniter\Controller;
use App\Models\OffdayModel;
use CodeIgniter\CLI\Console;

class OffdayControl extends BaseController
{

    public function __construct()
    {
        $this->model = new OffdayModel();

        //        $DepartModel = new DepartModel();
        helper(['form', 'url']);

        
    }

    public function index()
    {
        // echo view('templates/header');
        
        $data['offdays'] = $this->model->getData();
        //print_r($data['offdays']);exit;
        return view('offdays/offday_view', $data);
    }

    public function create()
    {
        $options['statdrop'] = array(
            'Offday' => 'Offday'
            // 'No' => 'No',
            // 'Yes' => 'Yes'
        );
        return view('offdays/offday-create-view', $options);
        // return view('offdays/offday-create-view');
    }

    public function export()
    {
        
        // $path = 'php://output';
        // // print_r($path);exit;
        // $file = new \CodeIgniter\Files\File($path);
        // print_r($file);exit;

        $file_name = 'Offday_details_' . date('d-m-Y') . '.csv';
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
        $id = $this->request->getVar('id');
        $data = [
            'title' => $this->request->getVar('title'),
            'title_type' => $this->request->getVar('title_type'),
            'cur_date' => $this->request->getVar('cur_date'),
            'status' => $this->request->getVar('status')
        ];
        $message = "Record Updated Successfully";

        if(empty($id))
        {
            if ($this->model->insertData($data) === false) {
                return view('offdays/offday-create-view', ['errors' => $this->model->errors()]);
            } else {
                //    $save = $this->model->insertData($data);
                // $message = "Record Updated Successfully";
                // echo view('offdays/offday-create-view', ['Insert' => $message]);
                return redirect()->route('Offdays/create')->with('msg', $message);
            }
        }
        else
        {
            $save = $this->model->updateData($data, $id);
            return redirect()->route('Offdays')->with('msg', $message);
        }
    }

    public function store()
    {
        $data = [
            'title' => $this->request->getVar('title'),
            'title_type' => $this->request->getVar('title_type'),
            'cur_date' => $this->request->getVar('cur_date'),
            'status' => $this->request->getVar('status')
        ];

        if ($this->model->insertData($data) === false) {
            return view('offdays/offday-create-view', ['errors' => $this->model->errors()]);
        } else {
            //    $save = $this->model->insertData($data);
            $message = "Record Updated Successfully";
            // echo view('offdays/offday-create-view', ['Insert' => $message]);
            return redirect()->to( base_url('OffdayControl/create') )->with('msg', $message);
        }
    }

    // public function cancel()
    // {
    //     return redirect()->route('Offdays');
    // }

    public function edit($id = null)
    {

        $data['offdays'] = $this->model->getdataid($id);
        return view('offdays/offday-edit-view', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $data = [
            'title' => $this->request->getVar('title'),
            'title_type' => $this->request->getVar('title_type'),
            'cur_date' => $this->request->getVar('cur_date'),
            'status' => $this->request->getVar('status')
        ];

        $save = $this->model->updateData($data, $id);
        $message = "Record Successfully Updated";
        // echo view('offdays/offday-edit-view', ['Edit' => $message]);
        // $this->session->setFlashdata('update', '<div class="alert alert-success text-center">Record Updated Successfully !</div>');
        return redirect()->to(base_url('OffdayControl'))->with('msg', $message);
    }

    public function delete($id = null)
    {
        $data['offdays'] = $this->model->deleteData($id);
        $message = "Record Deleted successfully ";
        return redirect()->route('Offdays')->with('msg', $message);
    }
}

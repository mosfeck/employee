<?php

namespace App\Controllers;

// use CodeIgniter\Controller;
use App\Models\DesigModel;

class DesigControl extends BaseController
{

    public function __construct()
    {
        $this->model = new DesigModel();
        helper(['form', 'url']);
        //        $weights = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20);
        //        $arrlength = count($weights);
    }

    public function index()
    {
        // echo view('templates/header');
        // $data['desigs'] = $this->model->orderBy('desg_id', 'DESC')->findAll();
        $data['desigs'] = $this->model->getData();
        return view('designations/desig_view', $data);
    }

    public function create()
    {
        return view('designations/desig-create-view');
    }

    public function export()
    {
        $file_name = 'Designation_details_' . date('d-m-Y') . '.csv';
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
        return redirect()->to(base_url('DesignControl'))->with('msg', $message);
    }

    public function createOrUpdate()
    {
        $id = $this->request->getVar('desg_id');
        $desig['designation_name'] = $this->request->getPost("designation_name");

        $data = [
            'designation_name' => $this->request->getVar('designation_name'),
            'description' => $this->request->getVar('description'),
            'weight' => $this->request->getVar('weight'),
            'status' => $this->request->getVar('status'),
        ];

        $message = "Record Updated Successfully";

        $desigResult = $this->model->name_checker($desig);

        if(empty($id))
        {
            if (count($desigResult) > 0) {
                $message = "Duplicate Designation name. Please use another name";
                // echo view('designations/desig-create-view', ['Insert' => $message]);
                return redirect()->route('Desigs/create')->withInput()->with('Insert', $message);
            } else {
                $save = $this->model->insertData($data);
                // $message = "Record Updated Successfully";
                return redirect()->route('Desigs/create')->with('msg', $message);
            }
        }
        else
        {
            $save = $this->model->updateData($data, $id);
            return redirect()->route('Desigs')->with('msg', $message);
        }
    }

    public function store()
    {
        $desig['designation_name'] = $this->request->getPost("designation_name");

        $data = [
            'designation_name' => $this->request->getVar('designation_name'),
            'description' => $this->request->getVar('description'),
            'weight' => $this->request->getVar('weight'),
            'status' => $this->request->getVar('status'),
        ];

        $desigResult = $this->model->name_checker($desig);

        if (count($desigResult) > 0) {
            $message = "Duplicate Designation name. Please use another name";
            echo view('designations/desig-create-view', ['Insert' => $message]);
        } else {
            $save = $this->model->insertData($data);
            $message = "Record Updated Successfully";
            return redirect()->to(base_url('DesigControl/create'))->with('msg', $message);
        }

        // original code
        // if ($this->model->insertData($data) === false) {
        //     return view('designations/desig-create-view', ['errors' => $this->model->errors()]);
        // } 
        // else {
        //     $message = "Record Updated Successfully";
        //     // echo view('designations/desig-create-view', ['Insert' => $message]);
        //     return redirect()->to( base_url('DesigControl/create') )->with('msg', $message);
        //     // echo json_encode(array("status" => TRUE));
        // }


        // return redirect()->to(base_url('DesigControl'));
    }

    // public function cancel()
    // {
    //     return redirect()->route('Desigs');
    // }

    public function edit($id = null)
    {
        //        $data['desigs'] = $this->model->where('desg_id', $id)->first();
        $data['desigs'] = $this->model->getdataid($id);
        return view('designations/desig-edit-view', $data);
    }

    public function update()
    {
        // $desig['designation_name'] = $this->request->getPost("designation_name");
        $id = $this->request->getVar('desg_id');

        $data = [
            'designation_name' => $this->request->getVar('designation_name'),
            'description' => $this->request->getVar('description'),
            'weight' => $this->request->getVar('weight'),
            'status' => $this->request->getVar('status'),
        ];

        // $desigResult = $this->model->name_checker($desig);

        // if (count($desigResult) > 0) {
        //     $message = "Duplicate Designation name. Please use another name";
        //     echo view('designations/desig-edit-view', ['Insert' => $message]);
        // } else {
            $save = $this->model->updateData($data, $id);
            $message = "Record Updated Successfully";
            return redirect()->to(base_url('DesigControl'))->with('msg', $message);
            // echo view('designations/desig-edit-view', ['Edit' => $message]);
            // return redirect()->to(base_url('DesigControl'));
        // }
    }

    public function delete($id = null)
    {
        // $data['desigs'] = $this->model->where('desg_id', $id)->delete();
        $data['desigs'] = $this->model->deleteData($id);
        $message = "Record Deleted successfully";
        return redirect()->route('Desigs')->with('msg', $message);
    }
}

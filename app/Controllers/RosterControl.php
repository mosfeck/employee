<?php

namespace App\Controllers;

// use CodeIgniter\Controller;
use App\Models\RosterModel;


class RosterControl extends BaseController
{

    public function __construct()
    {
        $this->model = new RosterModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        // echo view('templates/header');
        
        $data['rosters'] = $this->model->getData();
        //print_r($data['offdays']);exit;
        return view('rosters/roster_view', $data);
    }

    public function create()
    {
         $data['departs'] = $this->model->get_department();
        // print_r($data['departs']);

         $data['shifts'] = $this->model->get_shift();
        // print_r($data['shifts']);

        // echo $dept_id = $this->request->getVar('dept_id');
        // print_r($dept_id);
        // echo $data = $this->model->get_emp_name($dept_id);
        // print_r($data);

        return view('rosters/roster-create-view', $data);
    }

    public function get_employee_name(){
        // $dept_id = $this->request->getGetPost('dept_id');
        // $dept_id = 7;
        // $data = [
        //     'dept_id' => $this->request->getVar('dept_id')
        // ];
        // $dept_id = $this->$_POST['dept_id'];
        // $dept_id = set_value('dept_id');

        // $data['departs'] = $this->model->get_department();

        $dept_id = $this->request->getPostGet('dept_id');
        // print_r($dept_id);
        $data = $this->model->get_emp_name($dept_id);
        // print_r($data);
        echo json_encode($data);
        // return view('empshifts/empshift-create-view', $data);
    }

    public function export()
    { 
        $file_name = 'Roster_details_' . date('d-m-Y') . '.csv';
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
        $id = $this->request->getVar('roster_id');
        $data = [
            'dept_id' => $this->request->getVar('dept_id'),
            'employee_id' => $this->request->getVar('employee_id'),
            'shift_id' => $this->request->getVar('shift_id'),
            'roster_date' => $this->request->getVar('roster_date'),
            'status' => $this->request->getVar('status')
        ];
        $message = "Record Successfully Updated";

        if(empty($id))
        {
            if ($this->model->insertData($data) === false) {
                return view('rosters/roster-create-view', ['errors' => $this->model->errors()]);
            } else {
                return redirect()->route('Rosters/create')->with('msg', $message);
            }
        }
        else
        {
            $save = $this->model->updateData($data, $id);
            return redirect()->route('Rosters')->with('msg', $message);
        }
    }

    public function store()
    {
        $data = [
            'dept_id' => $this->request->getVar('dept_id'),
            'employee_id' => $this->request->getVar('employee_id'),
            'shift_id' => $this->request->getVar('shift_id'),
            'roster_date' => $this->request->getVar('roster_date'),
            'status' => $this->request->getVar('status')
        ];

        if ($this->model->insertData($data) === false) {
            return view('rosters/roster-create-view', ['errors' => $this->model->errors()]);
        } else {
            $message = "Record Updated Successfully";
            return redirect()->to( base_url('RosterControl/create') )->with('msg', $message);
        }
    }

    public function cancel()
    {
        return redirect()->route('Rosters');
    }

    public function edit($id = null)
    {
        $data['departs'] = $this->model->get_department();
        $data['shifts'] = $this->model->get_shift();
        $data['rosters'] = $this->model->getdataid($id);
        return view('rosters/roster-edit-view', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('roster_id');

        $data = [
            'dept_id' => $this->request->getVar('dept_id'),
            'employee_id' => $this->request->getVar('employee_id'),
            'shift_id' => $this->request->getVar('shift_id'),
            'roster_date' => $this->request->getVar('roster_date'),
            'status' => $this->request->getVar('status')
        ];

        $save = $this->model->updateData($data, $id);
        $message = "Record Successfully Updated";
        return redirect()->to(base_url('RosterControl'))->with('msg', $message);
    }

    public function delete($id = null)
    {
        $data['rosters'] = $this->model->deleteData($id);
        $message = "Record Deleted successfully";
        return redirect()->route('Rosters')->with('msg', $message);
    }
}

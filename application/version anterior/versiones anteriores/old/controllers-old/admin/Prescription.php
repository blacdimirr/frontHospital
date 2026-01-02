<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Prescription extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->config->load("payroll");
        $this->load->library('Enc_lib');
        $this->marital_status = $this->config->item('marital_status');
        $this->payment_mode   = $this->config->item('payment_mode');
        $this->blood_group    = $this->config->item('bloodgroup');
        $this->load->model('prefix_model');
        // 
        $this->load->library('Customlib');
        $this->load->helper('customfield_helper');
        $this->load->helper('custom');
        // 
        $this->opd_prefix = $this->prefix_model->getByCategory(array('DAR-FO'))[0]->prefix;
        $this->load->model('finding_model');
    }

    public function printPrescription()
    {
        $visitid               = $this->input->get('visitid');
        $data["print_details"] = $this->printing_model->getheaderfooter('opdpre');
        $result                = $this->prescription_model->getPrescriptionByVisitID($visitid);

        $result_custom         = $this->patient_model->getopdvisitDetailsbyvisitid($visitid);
        $data["result_custom"] = $result_custom;
        $data['fields'] = $this->customfield_model->get_custom_fields('opd', '', '', '', '');

        $data["result"]        = $result;

        $data["id"]     = $visitid;
        $data["opd_id"] = $result->opd_detail_id;
        $data["camas"] = $this->patient_model->get_case_reference_id($result->case_reference_id);

        $page           = $this->load->view('admin/patient/prescription', $data, true);
        // $page           = $this->load->view('admin/patient/_printprescription', $data, true);
        echo json_encode(array('status' => 1, 'page' => $page));
    }

    public function printHojaInterconsulta()
    {
        $opd_details_id               = $this->input->post('opd_details_id');
        $visitid               = $this->input->get('visitid');
        $visit_id               = $this->input->get('visit_id');

        // $data["print_details"] = $this->printing_model->getheaderfooter('opdpre');
        $result                = $this->prescription_model->getPrescriptionByVisitInterconsultaID($visitid);
        $data["result"]        = $result;
        $data["patient"]        = $result;
        $data['patientCustom'] = $this->patient_model->getpatientsByArray(array($result->id))[0];
        
        $data["id"]     = $visitid;
        $data["opd_id"] = $result->opd_detail_id;
        

        $page           = $this->load->view('admin/patient/_print_formulario_interconsulta', $data, true);
        echo json_encode(array('status' => 1, 'page' => $page));
    }
    public function printHojaIngreso()
    {
        $opd_details_id               = $this->input->post('opd_details_id');
        $visitid               = $this->input->get('visitid');
        $visit_id               = $this->input->get('visit_id');

        // $data["print_details"] = $this->printing_model->getheaderfooter('opdpre');
        $result                = $this->prescription_model->getPrescriptionByVisitHojaIngresoID($visitid);
        $data["result"]        = $result;
        $data["patient"]        = $result;
        $data['patientCustom'] = $this->patient_model->getpatientsByArray(array($result->id))[0];
        
        $data["id"]     = $visitid;
        $data["opd_id"] = $result->opd_detail_id;
        

        $page           = $this->load->view('admin/patient/hoja_ingreso_print', $data, true);
        echo json_encode(array('status' => 1, 'page' => $page));
    }

    public function getPrescription($visitid)
    {
        $result                = $this->prescription_model->getPrescriptionByVisitID($visitid);
        $data["result"]        = $result;

        $result_custom         = $this->patient_model->getopdvisitDetailsbyvisitid($visitid);
        $data["result_custom"] = $result_custom;

        $data["print_details"] = $this->printing_model->getheaderfooter('opdpre');
        $data["id"]            = $visitid;
        $data["opd_id"]        = $result->opd_detail_id;
        if (isset($_POST['print'])) {
            $data["print"] = 'yes';
        } else {
            $data["print"] = 'no';
        }

        // print_r($result->case_reference_id);
        // die();

        // $result                        = $this->patient_model->getopdvisitDetailsbyvisitid($visitid);
        // $data['custom_fields_value'] = display_custom_fields('opd', $result->opd_detail_id);
        $data['fields'] = $this->customfield_model->get_custom_fields('opd', '', '', '', '');

        $data["camas"] = $this->patient_model->get_case_reference_id($result->case_reference_id);

        // $this->load->view("admin/patient/prescription-old", $data);
        $this->load->view("admin/patient/prescription", $data);
    }

    public function editopdHojaIngreso($visitid)
    {
        $result                = $this->prescription_model->getPrescriptionByVisitHojaIngresoID($visitid);
        $data["result"]        = $result;
        $data["patient"]        = $result;        
        
        $data['patientCustom'] = $this->patient_model->getpatientsByArray(array($result->id))[0];
        
        $result_custom         = $this->patient_model->getopdvisitDetailsbyvisitid($visitid);
        $data["result_custom"] = $result_custom;
        
        $data["print_details"] = $this->printing_model->getheaderfooter('opdpre');
        $data["id"]            = $visitid;
        // $data["opd_id"]        = $result->opd_detail_id;
        
        if (isset($_POST['print'])) {
            $data["print"] = 'yes';
        } else {
            $data["print"] = 'no';
        }

        // print_r($visitid);
        // die();

        $data['fields'] = $this->customfield_model->get_custom_fields('opd', '', '', '', '');

        $data["camas"] = $this->patient_model->get_case_reference_id($result->case_reference_id);

        $page = $this->load->view('admin/patient/_edd_hoja_ingreso', $data, true); 
        echo json_encode(array('status' => 1, 'page' => $page));
    }

    public function editopdFomrularioInterconsulta($visitid)
    {
        $result                = $this->prescription_model->getPrescriptionByVisitInterconsultaID($visitid);
        $data["result"]        = $result;
        $data["patient"]        = $result;        
        
        $data['patientCustom'] = $this->patient_model->getpatientsByArray(array($result->id))[0];
        
        $result_custom         = $this->patient_model->getopdvisitDetailsbyvisitid($visitid);
        $data["result_custom"] = $result_custom;
        
        $data["print_details"] = $this->printing_model->getheaderfooter('opdpre');
        $data["id"]            = $visitid;
        $data["formulario_interconsulta_id"]        = $result->formulario_interconsulta_id;
        
        if (isset($_POST['print'])) {
            $data["print"] = 'yes';
        } else {
            $data["print"] = 'no';
        }

        // print_r($visitid);
        // die();

        $data['fields'] = $this->customfield_model->get_custom_fields('opd', '', '', '', '');

        $data["camas"] = $this->patient_model->get_case_reference_id($result->case_reference_id);

        $page = $this->load->view('admin/patient/_edit_formulario_interconsulta', $data, true); 
        echo json_encode(array('status' => 1, 'page' => $page));
    }

    public function getPrescriptionmanual($visitid)
    {
        $result                   = $this->prescription_model->getmanual($visitid);
        $opddata                  = $this->patient_model->getopdvisitDetailsbyvisitid($visitid);
        $opdid                    = $opddata['opdid'];
        $data['blood_group_name'] = $opddata['blood_group_name'];
        $data["print_details"]    = $this->printing_model->getheaderfooter('opdpre');
        $data["result"]           = $result;
        $data["visitid"]          = $visitid;
        $data["opdid"]            = $opdid;

        if (isset($_POST['print'])) {
            $data["print"] = 'yes';
        } else {
            $data["print"] = 'no';
        }

        $data['opd_prefix'] = $this->opd_prefix;

        $this->load->view("admin/patient/prescriptionmanual", $data);
    }

    public function getIPDPrescription()
    {
        $prescription_id       = $this->input->post('prescription_id');
        $result                = $this->prescription_model->getPrescriptionByTable($prescription_id, 'ipd_prescription');
        $data["print_details"] = $this->printing_model->getheaderfooter('ipdpres');
        $data["result"]        = $result;

        if (isset($_POST['print'])) {
            $data["print"] = 'yes';
        } else {
            $data["print"] = 'no';
        }

        $page = $this->load->view('admin/patient/ipdprescription', $data, true);
        echo json_encode(array('status' => 1, 'page' => $page));

    }

    public function printIPDPrescription()
    {
        $prescription_id = $this->input->post('prescription_id');
        $result          = $this->prescription_model->getPrescriptionByTable($prescription_id, 'ipd_prescription');

        $data["print_details"] = $this->printing_model->getheaderfooter('ipdpres');
        $data["result"]        = $result;

        if (isset($_POST['print'])) {
            $data["print"] = 'yes';
        } else {
            $data["print"] = 'no';
        }

        $page = $this->load->view('admin/patient/_printIpdPrescription', $data, true);
        echo json_encode(array('status' => 1, 'page' => $page));

    }

    public function editPrescription($visitid)
    {
        $data['medicineCategory']  = $this->medicine_category_model->getMedicineCategory();
        $data['medicineName']      = $this->pharmacy_model->getMedicineName();
        $data['dosage']            = $this->medicine_dosage_model->getMedicineDosage();
        $result                    = $this->prescription_model->getvisit($visitid);
        $data['prescription_note'] = $this->prescription_model->prescription_note($visitid);
        $prescription_list         = $this->prescription_model->getPrescriptionByOPD($visitid);

        $data['roles']                  = $this->role_model->get();
        $pathology                      = $this->pathology_model->getPathology();
        $data['pathology']              = $pathology;
        $radiology                      = $this->radio_model->getRadiology();
        $data['radiology']              = $radiology;
        $prescription_test              = $this->prescription_model->getPrescriptiontestopd($result["presid"]);
        $data['prescription_test']      = $prescription_test;
        $pathology_list                 = $prescription_test['pathology_data'];
        $radiology_list                 = $prescription_test['radiology_data'];
        $data['prescription_pathology'] = $pathology_list;
        $data['prescription_radiology'] = $radiology_list;
        $data["result"]                 = $result;
        $data["id"]                     = $result['visit_id'];
        $data["opd_id"]                 = $result['opd_details_id'];
        $data["prescription_list"]      = $prescription_list;

        $this->load->view("admin/patient/edit_prescription", $data);
    }

    public function addipdPrescription()
    {
        $ipd_id                    = $this->input->post('ipd_id');
        $data['medicineCategory']  = $this->medicine_category_model->getMedicineCategory();
        $data['intervaldosage']    = $this->medicine_dosage_model->getIntervalDosage();
        $data['durationdosage']    = $this->medicine_dosage_model->getDurationDosage();
        $data['medicineName']      = $this->pharmacy_model->getMedicineName();
        $data['dosage']            = $this->medicine_dosage_model->getMedicineDosage();
        $data['roles']             = $this->role_model->get();
        $pathology                 = $this->pathology_model->getPathology();
        $data['pathology']         = $pathology;
        $radiology                 = $this->radio_model->getRadiology();
        $data['radiology']         = $radiology;
        $data['ipd_id']            = $ipd_id;
        $findingresult             = $this->finding_model->getfindingcategory();
        $data['findingresult']     = $findingresult;
        $data['priscribe_list']    = $this->patient_model->getDoctorsipd($ipd_id);
        $consultant_doctor         = $this->patient_model->get_patientidbyIpdId($ipd_id);
        $data['consultant_doctor'] = $consultant_doctor;

        $page = $this->load->view('admin/patient/_addipdprescription', $data, true);
        echo json_encode(array('status' => 1, 'page' => $page));
    }

    public function addopdPrescription()
    {
        $data['visit_details_id'] = $this->input->post('visit_detail_id');
        $data['medicineCategory'] = $this->medicine_category_model->getMedicineCategory();
        $data['intervaldosage']   = $this->medicine_dosage_model->getIntervalDosage();
        $data['durationdosage']   = $this->medicine_dosage_model->getDurationDosage();
        $data['medicineName']     = $this->pharmacy_model->getMedicineName();
        $data['dosage']           = $this->medicine_dosage_model->getMedicineDosage();
        $data['roles']            = $this->role_model->get();
        $pathology                = $this->pathology_model->getPathology();
        $data['pathology']        = $pathology;
        $radiology                = $this->radio_model->getRadiology();
        $data['radiology']        = $radiology;
        $findingresult            = $this->finding_model->getfindingcategory();
        $data['findingtype']      = $findingresult;
        $page                     = $this->load->view('admin/patient/_addopdprescription', $data, true); 
        echo json_encode(array('status' => 1, 'page' => $page));
    }

    public function addOrdenMedica()
    {
        $data['visit_details_id'] = $this->input->post('visit_detail_id');
        $data['medicineCategory'] = $this->medicine_category_model->getMedicineCategory();
        $data['intervaldosage']   = $this->medicine_dosage_model->getIntervalDosage();
        $data['durationdosage']   = $this->medicine_dosage_model->getDurationDosage();
        $data['medicineName']     = $this->pharmacy_model->getMedicineName();
        $data['dosage']           = $this->medicine_dosage_model->getMedicineDosage();
        $data['roles']            = $this->role_model->get();
        $pathology                = $this->pathology_model->getPathology();
        $data['pathology']        = $pathology;
        $radiology                = $this->radio_model->getRadiology();
        $data['radiology']        = $radiology;
        $findingresult            = $this->finding_model->getfindingcategory();
        $data['findingtype']      = $findingresult;
        $page                     = $this->load->view('admin/patient/_add_orden_medica', $data, true); 
        echo json_encode(array('status' => 1, 'page' => $page));
    }

    public function addhojaIngreso()
    {
        $data['visit_details_id'] = $this->input->post('visit_detail_id');
        $data['case_reference_id'] = $this->input->post('case_reference_id');
        $data['patient_id'] = $this->input->post('patientid');
        $data['medicineCategory'] = $this->medicine_category_model->getMedicineCategory();
        $data['intervaldosage']   = $this->medicine_dosage_model->getIntervalDosage();
        $data['durationdosage']   = $this->medicine_dosage_model->getDurationDosage();
        $data['medicineName']     = $this->pharmacy_model->getMedicineName();
        $data['dosage']           = $this->medicine_dosage_model->getMedicineDosage();
        $data['roles']            = $this->role_model->get();
        $pathology                = $this->pathology_model->getPathology();
        $data['pathology']        = $pathology;
        $radiology                = $this->radio_model->getRadiology();
        $data['radiology']        = $radiology;
        $findingresult            = $this->finding_model->getfindingcategory();
        $data['findingtype']      = $findingresult;

        $data['patient'] = $this->patient_model->getDetailsopdByCaseId($data['case_reference_id']);
        $data['patientCustom'] = $this->patient_model->getpatientsByArray(array($data['patient_id']))[0];
        // $data['patient'] = $this->patient_model->getpatientbyid($data['patient_id']);

        // print_r($data['patientCustom']->{'Lisatdo de ARS'});
        // die();

        $page                     = $this->load->view('admin/patient/_add_hoja_ingreso', $data, true); 
        echo json_encode(array('status' => 1, 'page' => $page));
    }

    public function addInterconsultation()
    {
        $data['visit_details_id'] = $this->input->post('visit_detail_id');
        $data['case_reference_id'] = $this->input->post('case_reference_id');
        $data['patient_id'] = $this->input->post('patientid');
        $data['medicineCategory'] = $this->medicine_category_model->getMedicineCategory();
        $data['intervaldosage']   = $this->medicine_dosage_model->getIntervalDosage();
        $data['durationdosage']   = $this->medicine_dosage_model->getDurationDosage();
        $data['medicineName']     = $this->pharmacy_model->getMedicineName();
        $data['dosage']           = $this->medicine_dosage_model->getMedicineDosage();
        $data['roles']            = $this->role_model->get();
        $pathology                = $this->pathology_model->getPathology();
        $data['pathology']        = $pathology;
        $radiology                = $this->radio_model->getRadiology();
        $data['radiology']        = $radiology;
        $findingresult            = $this->finding_model->getfindingcategory();
        $data['findingtype']      = $findingresult;

        $data['patient'] = $this->patient_model->getDetailsopdByCaseId($data['case_reference_id']);
        $data['patientCustom'] = $this->patient_model->getpatientsByArray(array($data['patient_id']))[0];
        // $data['patient'] = $this->patient_model->getpatientbyid($data['patient_id']);

        // print_r($data['patientCustom']->{'Lisatdo de ARS'});
        // die();

        $page                     = $this->load->view('admin/patient/_add_formulario_interconsulta', $data, true); 
        echo json_encode(array('status' => 1, 'page' => $page));
    }

    public function editipdPrescription()
    {
        $prescription_id          = $this->input->post('prescription_id');
        $result                   = $this->prescription_model->getPrescriptionByTable($prescription_id, 'ipd_prescription');
        $data['medicineCategory'] = $this->medicine_category_model->getMedicineCategory();
        $data['intervaldosage']   = $this->medicine_dosage_model->getIntervalDosage();
        $data['durationdosage']   = $this->medicine_dosage_model->getDurationDosage();
        $data['medicineName']     = $this->pharmacy_model->getMedicineName();
        $data['dosage']           = $this->medicine_dosage_model->getMedicineDosage();
        $data['roles']            = $this->role_model->get();
        $pathology                = $this->pathology_model->getPathology();
        $data['pathology']        = $pathology;
        $radiology                = $this->radio_model->getRadiology();
        $data['radiology']        = $radiology;
        $data["result"]           = $result;
        $data["prescription_id"]  = $prescription_id;
        $findingresult            = $this->finding_model->getfindingcategory();
        $data['findingresult']    = $findingresult;
        $priscribe_list           = $this->patient_model->getDoctorsipd($result->ipd_id);
        $doctor_name              = $result->name . " " . $result->surname . "(" . $result->employee_id . ")";

        $consultant_doctorarray[] = array('id' => $result->cons_doctor, 'name' => $doctor_name);
        foreach ($priscribe_list as $key => $value) {
            $consultant_doctorarray[] = array('id' => $value['consult_doctor'], 'name' => $value['ipd_doctorname'] . " " . $value['ipd_doctorsurname'] . "(" . $value['employee_id'] . ")");
        }
        $data['priscribe_list'] = $consultant_doctorarray;

        $page = $this->load->view('admin/patient/_editipdprescription', $data, true);
        echo json_encode(array('status' => 1, 'page' => $page));
    }

    public function editopdPrescription()
    {
        $prescription_id = $this->input->post('prescription_id');
        $result          = $this->prescription_model->getPrescriptionByTable($prescription_id, 'opd_prescription');
        
        $data['medicineCategory'] = $this->medicine_category_model->getMedicineCategory();

        $data['intervaldosage']   = $this->medicine_dosage_model->getIntervalDosage();
        $data['durationdosage']   = $this->medicine_dosage_model->getDurationDosage();
        $data['medicineName']     = $this->pharmacy_model->getMedicineName();
        $data['dosage']           = $this->medicine_dosage_model->getMedicineDosage();
        $data['roles']            = $this->role_model->get();
        $pathology                = $this->pathology_model->getPathology();
        $data['pathology']        = $pathology;
        $radiology                = $this->radio_model->getRadiology();
        $data['radiology']        = $radiology;
        $data["result"]           = $result;
        $data["prescription_id"]  = $prescription_id;
        $findingresult            = $this->finding_model->getfindingcategory();
        $data['findingresult']    = $findingresult;

        $data['custom_fields_value'] = display_custom_fields('opd', $result->opd_details_id);

        $page = $this->load->view('admin/patient/_editopdprescription', $data, true);
        echo json_encode(array('status' => 1, 'page' => $page));
    }

    public function deleteopdPrescription($prescription_id)
    {

        $this->prescription_model->deleteopdPrescription($prescription_id);
        $json = array('status' => 'success', 'error' => '', 'msg' => $this->lang->line('delete_message'));
        echo json_encode($json);
    }

    public function deleteipdPrescription($id)
    {
        if (!empty($id)) {
            $this->prescription_model->deleteipdPrescription($id);
            $json = array('status' => 'success', 'error' => '', 'msg' => $this->lang->line('delete_message'));
            echo json_encode($json);
        }
    }

}

<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Itempurchasingprocess extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('datatables');
        $this->config->load("payroll");
        $this->search_type = $this->config->item('search_type');

        require_once 'application\libraries\api\inventario_external.php';
        require_once 'application\libraries\icd-api\classes\response.class.php';
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('issue_item', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Inventory');
        $this->session->set_userdata('sub_menu', 'itempurchasingprocess/index');
        $data['title']       = $this->lang->line('add_purchasing_process');
        $data['title_list']  = $this->lang->line('recent_purchasing_process');
        $roles               = $this->role_model->get();
        $data['roles']       = $roles;

        $itemstore        = $this->itemstore_model->get();
        $data['itemstorelist'] = $itemstore;

        $itemcategory = $this->getCategorias();
        $responses = json_decode($itemcategory, true);
        $productos = $responses['data']['data'];
        $data['itemcatlist'] = $productos;

        $itemSuplidores = $this->getSuplidores();
        $responses = json_decode($itemSuplidores, true);
        $suplidores = $responses['data']['supplier'];
        $data['itemSuplidores'] = $suplidores;

        // print_r($suplidores);
        // die();

        $this->load->view('layout/header', $data);
        $this->load->view('admin/itempurchasingprocess/itemList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function getCategorias()
    {
        $response = new Response();

        $url = 'https://account.ardan.com.do/api/categories';

        $inventario_api_client = new INVENTARIO_API_Client($url);
        $response->set(1, $inventario_api_client->get());

        return $response->encode();
    }

    public function getOneProduct($sku)
    {
        $response = new Response();

        $url = 'https://account.ardan.com.do/api/product/' . $sku;

        $inventario_api_client = new INVENTARIO_API_Client($url);
        $response->set(1, $inventario_api_client->get());

        return $response->encode();
    }
    
    public function getDetalleCompra($vendor_id,$order_number)
    {
        $response = new Response();

        $url = 'https://account.ardan.com.do/api/compras?vendor_id='.$vendor_id.'&order_number='.$order_number;

        $inventario_api_client = new INVENTARIO_API_Client($url);
        $response->set(1, $inventario_api_client->get());

        return $response->encode();
    }

    public function getItemByCategory()
    {
        $response = new Response();

        $url = 'https://account.ardan.com.do/api/products';

        $categoria_id = $_GET['item_category_id'];

        $inventario_api_client = new INVENTARIO_API_Client($url);
        $response->set(1, $inventario_api_client->get());

        $productos = json_decode($response->encode(), true);

        $array_productos = array();

        foreach ($productos['data']['data'] as $key => $value) {
            if ($value['category_id'] == $categoria_id) {
                array_push($array_productos, $value);
            }
        }

        echo json_encode($array_productos);
    }

    public function getSuplidores()
    {
        $response = new Response();

        $url = 'https://account.ardan.com.do/api/get-suplidores';

        $inventario_api_client = new INVENTARIO_API_Client($url);
        $response->set(1, $inventario_api_client->get());

        return $response->encode();
    }

    public function getissueitemdatatable()
    {
        $dt_response = $this->itemissue_model->get_ordenes_compra();

        $dt_response = json_decode($dt_response);
        $dt_data     = array();
        if (!empty($dt_response->data)) {
            foreach ($dt_response->data as $key => $value) {

                $row = array();
                //====================================

                if ($value->received_date == "0000-00-00") {
                    $return_date = "";
                } else {
                    $return_date = $this->customlib->YYYYMMDDTodateFormat($value->received_date);
                }

                $action = "<div class='rowoptionview rowview-mt-19'>";
                $link   = "<a href='#' class='detail_popover'  data-toggle='popover' title=''>";
                // $div    = "<div class='fee_detail_popover' style='display: none'>";

                if ($value->note == "") {
                    $text = "<p class='text text-danger'>" . $this->lang->line('no_description') . "</p>";
                } else {
                    $text = "<p class='text text-danger'>" . $this->lang->line('description') . "</p>";
                }

                // if ($value->is_returned == 1) {
                //     $status = "<span  class='label label-danger item_remove'  data-item='" . $value->id . "' data-category='" . $value->item_category . "' data-item_name='" . $value->item_name . "' data-quantity='" . $value->quantity . "' data-sku='" . $value->sku . "' data-toggle='modal' data-target='#confirm-update' title=''>" . $this->lang->line('click_to_return') . "</span>";
                // } else {
                //     $status = "<span class='label label-success'>" . $this->lang->line('returned') . "</span>";
                // }

                if ($this->rbac->hasPrivilege('issue_item', 'can_delete')) {
                    $action .= "<a href='#' onclick='print_record(" . $value->id . ")' class='btn btn-default btn-xs'  data-toggle='tooltip' title='" . $this->lang->line('print') . "'><i class='fa fa-print'></i></a>";
                    $action .= "<a href='#' onclick='delete_record(" . $value->id . ")' class='btn btn-default btn-xs'  data-toggle='tooltip' title='" . $this->lang->line('delete') . "'><i class='fa fa-trash'></i></a>";
                }

                //==============================
                // $row[]     = $link . $value->item_name_api . '</a>' . $div . $text . "</div>" . $action;
                // $row[]     = $value->item_category;
                $row[]     = $value->received_date. $action;
                // $row[]     = $this->customlib->YYYYMMDDTodateFormat($value->received_date);
                $row[]     = $value->suplidores;
                $row[]     = $value->staff_name . " " . $value->staff_surname;
                $row[]     = $value->note;
                // $row[]     = $status;
                $row[]     = "";
                $dt_data[] = $row;
            }
        }
        $json_data = array(
            "draw"            => intval($dt_response->draw),
            "recordsTotal"    => intval($dt_response->recordsTotal),
            "recordsFiltered" => intval($dt_response->recordsFiltered),
            "data"            => $dt_data,
        );
        echo json_encode($json_data);
    }

    public function create()
    {
        $this->session->set_userdata('top_menu', 'Inventory');
        $this->session->set_userdata('sub_menu', 'issueitem/index');
        $data['title']       = $this->lang->line('add_issue_item');
        $data['title_list']  = $this->lang->line('recent_issue_items');
        $roles               = $this->role_model->get();
        $data['roles']       = $roles;
        $itemcategory        = $this->itemcategory_model->get();
        $data['itemcatlist'] = $itemcategory;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/issueitem/issueitemCreate', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('suplidores', $this->lang->line('user_type'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('purchasing_process', $this->lang->line('issue_to'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('received_quantity[]', $this->lang->line('purchasing_process_detail'), 'required|trim|xss_clean');
        
        if ($this->form_validation->run() == false) {
            $data = array(
                'suplidores'     => form_error('suplidores'),
                'purchasing_process'         => form_error('purchasing_process'),
                'received_quantity[]'         => form_error('received_quantity[]')
            );

            $array = array('status' => 'fail', 'error' => $data);
        } else {
            $return_date = "";
            $date        = date('Y-m-d H:i:s');
            // $return_date = $this->customlib->dateFormatToYYYYMMDD($date);
            $suplidores = $this->input->post('suplidores'); 
            $suplidores = json_decode($suplidores); 
            $suplidores = $suplidores->name; 
            $purchasing_process = $this->input->post('purchasing_process'); 

            // print_r($suplidores ) ;
            // die();

            $data = array(
                'suplidores'         => $suplidores,
                'orden_compra' => $purchasing_process,
                'received_date'      => $date,
                'note'               => $this->input->post('note'),
                'generated_by'       => $this->customlib->getStaffID(),
            );
           
            $item_purchasing_process_id = $this->itemissue_model->add_ordenes_compra($data);

            foreach ($this->input->post('received_quantity') as $key => $item) {
                $data = array(
                    'orden_compra_id'       => $item_purchasing_process_id,
                    'item_name' => $this->input->post('received_name')[$key],
                    'sku'          => $this->input->post('received_sku')[$key],
                    'unit'          => $this->input->post('received_unit')[$key],
                    'quantity'         => $this->input->post('received_quantity')[$key]
                );
                $this->itemissue_model->add_ordenes_compra_detalle($data);
            }

            foreach ($this->input->post('received_quantity') as $key => $item) {                
                $sku = $this->input->post('received_sku')[$key]; 
                $quantity = $this->input->post('received_quantity')[$key];

                if ($quantity > 0 && is_int($quantity)){
                    $up = $this->updateOrdenCompra($suplidores,$purchasing_process,$sku, $quantity);
                }                
            }

            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));

            // $response = new Response();
            // $sku = $this->input->post('sku');

            // $url = 'https://account.ardan.com.do/api/update_product_bySku/' . $sku . '/update';

            // $data = [
            //     'quantity' => $this->input->post('quantity'),
            // ];

            // $jsonData = json_encode($data);

            // $inventario_api_client = new INVENTARIO_API_Client($url);
            // $response->set(1, $inventario_api_client->postData($jsonData));

            // $productos = json_decode($response->encode(), true);
        }
        echo json_encode($array);
    }

    public function get_item_issue_details(){

        $item_issue_id = $this->input->get("item_issue_id");

        $result['details'] = ($this->itemissue_model->get_item_issue_details($item_issue_id));
        echo json_encode($result);
    }

    public function get_details_compra(){

        $vendor_id = $this->input->get("vendor_id");
        $order_number = $this->input->get("order_number");

        $result = $this->getDetalleCompra($vendor_id,$order_number);
        echo $result;
    }

    public function updateProduct($sku, $quantity)
    {
        $response = new Response();

        $url = 'https://account.ardan.com.do/api/update_product_bySku/' . $sku . '/update';

        $data = [
            'quantity' => $quantity,
        ];

        $jsonData = json_encode($data);


        $inventario_api_client = new INVENTARIO_API_Client($url);
        $response->set(1, $inventario_api_client->postData($jsonData));

        $productos = json_decode($response->encode(), true);
    }

    public function updateOrdenCompra($vendor_id,$order_number,$sku, $quantity)
    {
        $response = new Response();

        $url = 'https://account.ardan.com.do/api/update-compras?vendor_id='.$vendor_id.'&order_number='.$order_number.'&product_sku='.$sku.'&received_quantity='.$quantity;

        $inventario_api_client = new INVENTARIO_API_Client($url);
        $response->set(1, $inventario_api_client->get());

        return $response->encode();

        // $data = [
        //     'quantity' => $quantity,
        // ];

        // $jsonData = json_encode($data);

        // $inventario_api_client = new INVENTARIO_API_Client($url);
        // $response->set(1, $inventario_api_client->postData($jsonData));

        // $productos = json_decode($response->encode(), true);
    }

    public function check_available_quantity()
    {
        $quantities = $this->input->post('item_id_');

        $item_ids = $this->input->post('quantity');

        $array_error = array();

        foreach ($quantities as $key => $item) {
            $value = json_decode($item_ids[$key]);
            $json = json_decode($item);

            if (json_last_error() !== JSON_ERROR_NONE || !isset($json->quantity)) {
                $this->form_validation->set_message('check_available_quantity', $this->lang->line('invalid_item_data'));
                return false;
            }

            if ($value > $json->quantity) {
                array_push($array_error, 
                    array('error'=>$this->form_validation->set_message('check_available_quantity', $this->lang->line('available_quantity'). " : " .  $value. ", " .$json->name ))
                );
                return false;
            }
        }
        return true;
    }

    public function delete($id)
    {
        $data['title'] = 'Delete';
        $data = array(
            'id' => $id,
            'is_deleted' => 1
        );
        $this->itemissue_model->remove_orden_compra($data);
        redirect('admin/issueitem');
    }

    public function get_print($id){
        $data = array();

        $print_details         = $this->printing_model->get('', 'opd');
        $data['print_details'] = $print_details;

        $detalle = $this->itemissue_model->get_ordenes_compra_detalle($id);

        $data['suplidor'] = $detalle[0]['suplidores'];
        $data['compra_orden'] = $detalle[0]['orden_compra'];
        $data['responsable'] = $detalle[0]['staff_name'].' '.$detalle[0]['staff_surname'];
        $data['received_date'] = $detalle[0]['received_date'];
        // $data['_id'] = $detalle[0]['_id'];
        $data['_id'] = generarSecuencia($detalle[0]['_id']);

        $data['products'] = $detalle;

        $page           = $this->load->view('admin/itempurchasingprocess/_printbill.php', $data, true);
        echo json_encode(array('status' => 1, 'page' => $page));
    }

    public function getUser()
    {

        $usertype     = $this->input->post('usertype');
        $result_final = array();
        $result       = array();
        if ($usertype != "") {
            $result = $this->staff_model->getEmployeeByRoleID($usertype);
        }

        $result_final = array('usertype' => $usertype, 'result' => $result);
        echo json_encode($result_final);
    }

    public function returnItem()
    {
        $item_issue_quantity = $this->input->post('item_issue_quantity');
        $note_issue = $this->input->post('note_issue');
        $item_issue_sku = $this->input->post('item_issue_sku');
        $item_issue_id = $this->input->post('item_issue_id')[0];        

        // if ($issue_id != "") {
            foreach ($item_issue_sku as $key => $value) {
                if (!empty($value)) {
                    if (!empty($item_issue_quantity[$key])){

                        $itemSku = $this->getOneProduct($value);
                        $responses = json_decode($itemSku, true);
                        $producto = $responses['data']['data'];
                        // $data['itemcatlist'] = $producto->quantity;
        
                        $devuelto = $producto[0]['quantity'] + $item_issue_quantity[$key];
        
                        $up = $this->updateProduct($value, $devuelto);

                        $data = array(
                            'item_issue_id'  => $item_issue_id,
                            // 'return_date' => date('Y-m-d'),
                            'is_returned' => 1,
                            'sku' => $value,                            
                            'return_date' => date('Y-m-d'),
                            'quantity'    => $item_issue_quantity[$key],
                            'note_issue' => $note_issue[$key],
                        );

                        $this->itemissue_model->add_details($data);
                        // print_r($producto[0]['quantity'] );
                        // die();
                    }
                }
            }


            // print_r($devuelto);
            // die();
        // }
        // print_r($data);
        // die();

        $result_final = array('status' => 'pass', 'message' => "Item retrun successfully");
        echo json_encode($result_final);
    }

    public function checkvalidation()
    {
        $search = $this->input->post('search');
        $this->form_validation->set_rules('search_type', $this->lang->line('search_type'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $msg = array(
                'search_type' => form_error('search_type'),
            );
            $json_array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $param = array(
                'search_type' => $this->input->post('search_type'),

                'date_from'   => $this->input->post('date_from'),
                'date_to'     => $this->input->post('date_to'),
            );

            $json_array = array('status' => 'success', 'error' => '', 'param' => $param, 'message' => $this->lang->line('success_message'));
        }
        echo json_encode($json_array);
    }
}

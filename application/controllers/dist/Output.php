<?php
defined('BASEPATH') or exit('No direct script access allowed');

class output extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('dist/orders_model');
        $this->load->model('api/api_model');
        $this->load->view("public/layout");	 	
    }

    public function list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = $this->orders_model->get_all_sub_data();      

        // $data_array = json_decode(json_encode($data->result()), true);

        // $data_sub_list_name = array_keys($data_array[0]);

        $data_list = [] ;

        // foreach($data_array as $k => $r) {
        //     foreach($data_sub_list_name as $value) {
        //         $data_list[$k][] = $r[$value];   
        //     }
        // }
        // $data_list[$k] = [$data_list];
        // $this->db->select('order_num,trans_num,product_name,
        // order_subscript,order_status,order_subscript_num,shipping_total,shipping_cycle,
        // start_date,end_date');

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $data_r = [];
        foreach($data->result() as $r) {
            $data_r[] = array(
                $r->order_num,
                $r->trans_num,
                $r->product_name,
                $r->order_subscript,
                $r->order_status,
                $r->order_subscript_num,
                $r->shipping_total,
                $r->shipping_cycle,
                $r->start_date,
                $r->end_date,
                'operating'
            );
        }
        // echo '<pre>';
        // print_r($data_list);
        // echo '</pre>';
        // echo '_rr';
        $output = array(
            "draw" => $draw,
            "start"=> $start,
            "length"=> $length,
            "recordsTotal" => $data->num_rows(),
            "recordsFiltered" => $data->num_rows(),
            // "data" => $data_list,
            "data" => $data_r,
        );           

        echo json_encode($output);
        exit();      
    }
}

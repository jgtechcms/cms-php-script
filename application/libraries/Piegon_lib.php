<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Piegon_lib {
	
	var $CI;
	var $market_name;
	var $vendor_name;
	var $password;
	
	var $test_mode = false;//true;
	var $test_url = array(
							'service_check' => 'http://test.gopigeon.biz/ecom-api/v3/check-serviceability',
							'place_order'	=> 'http://test.gopigeon.biz/ecom-api/v3/place-order',
							'pickup_req'	=> 'http://test.gopigeon.biz/ecom-api/v3/acknowledge-order',
							'track'			=> 'http://test.gopigeon.biz/ecom-api/v3/track/shipments',
							'cancel'		=> 'http://test.gopigeon.biz/ecom-api/v3/cancel-order'
					);
	var $live_url = array(
							'service_check' => 'http://gopigeon.biz/ecom-api/v3/check-serviceability',
							'place_order'	=> 'http://gopigeon.biz/ecom-api/v3/place-order',
							'pickup_req'	=> 'http://gopigeon.biz/ecom-api/v3/acknowledge-order',
							'track'			=> 'http://gopigeon.biz/ecom-api/v3/track/shipments',
							'cancel'		=> 'http://gopigeon.biz/ecom-api/v3/cancel-order'
					);
	
	var $shipping_service_request_data;
	var $shipping_service_response_data;
	var $shipping_order_response_data;
	
	var $shipping_pickup_response_data;
	var $shipping_track_response_data;
	var $shipping_cancel_response_data;
	
	var $response_data;
	
	var $from_address = 'B-40, Second Floor, sector-9';
	var $from_city = 'Noida';
	var $from_state = 'Uttar Pradesh';
	var $from_pin_code = '201301';
	var $from_name = 'Dazzleiton';
	//p.no: +919811211534, +919810624923
	var $from_phone = '+919811211534';
	var $from_email = 'info@dazzleiton.com';
	
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
		$this->CI->load->helper('form');
		
		$this->db = $this->CI->db;
		
		$this->market_name = 'aplyindia';
		$this->vendor_name = 'aplyindia';
		$this->password = 'aplyindia';
	}

	function process_shipping_rate($data = '')
	{
		$request_data = $this->_get_request_data($data);
		
		$shipping_detail = $this->_process_curl($request_data);
		
		$this->shipping_service_response_data = $shipping_detail;
		
		return $shipping_detail;
		
	}

	function process_place_order($data = '')
	{
		$request_data = $this->_get_order_request_data($data);
		
		$shipping_detail = $this->_process_curl($request_data, 'place_order');
		
		$this->shipping_order_response_data = $shipping_detail;
		
		if($this->is_success_order()) {
			$this->add_log($data);
		}
		
		return $shipping_detail;
		
	}

	function process_pickup_request($data = '')
	{
		$request_data = $this->_get_pickup_request_data($data);
		
		$shipping_detail = $this->_process_curl($request_data, 'pickup_req');
		
		$this->shipping_pickup_response_data = $shipping_detail;
		
		return $shipping_detail;
		
	}

	function process_track_order($data = '')
	{
		$request_data = $this->_get_order_request_data($data);
		
		$shipping_detail = $this->_process_curl($request_data, 'track');
		
		$this->shipping_track_response_data = $shipping_detail;
		
		return $shipping_detail;
		
	}

	function process_cancel_order($data = '')
	{
		$request_data = $this->_get_pickup_request_data($data); // same data of pickup request
		
		$shipping_detail = $this->_process_curl($request_data, 'cancel');
		
		$this->shipping_cancel_response_data = $shipping_detail;
		
		return $shipping_detail;
		
	}

	function _get_request_data($data = '')
	{
		if($this->shipping_service_request_data != '')
			$data = $this->shipping_service_request_data;
		
		$request_data = array('shipment_details' => array(), 'market_name' => $this->market_name, 'vendor_name' => $this->vendor_name, 'password' => $this->password);
		$shipment_details = $box_details = array();
		$shipment_details['to_pin_code'] = $data['shipping_post_code'];
		$shipment_details['payment_type'] = $data['payment_type'];
		$shipment_details['weight'] = $data['total_weight'];
		$shipment_details['cod_collection'] = $data['cod_collection'];
		$shipment_details['from_pin_code'] = $this->from_pin_code;
		$shipment_details['from_city'] = "Chennai";
		$shipment_details['declared_value'] = $data['declared_value'];
		
		$shipment_details['box_details'] = $data['box_details'];
		
		$request_data['shipment_details'] = array($shipment_details);
		
		return $request_data;
	}
	
	function _get_order_request_data($data)
	{
		
		$request_data = array(
						'shipment_details' => array(), 
						'market_name' => $this->market_name, 
						'vendor_name' => $this->vendor_name, 
						'password' => $this->password);
		$shipment_details = $alternative_from_mo = $alternative_to_mobile_numbers = $client_requested_printable_params = $product_detail_list = array();
		
		$shipment_details['unique_id'] = $data['summary_data']['ord_order_number'];
		$shipment_details['invoice'] = $data['summary_data']['ord_order_number'];
		$shipment_details['reference'] = "";
		$shipment_details['product_detail'] = "Cart";
		$shipment_details['sku_code'] = "";
		$shipment_details['quantity'] = (string) intval($data['summary_data']['ord_total_items']);
		//from_name from_address from_city from_state from_email
		$shipment_details['from_name'] = $this->from_name;
		$shipment_details['from_address'] = $this->from_address;
		$shipment_details['from_city'] = $this->from_city;
		$shipment_details['from_state'] = $this->from_state;
		$shipment_details['from_email'] = $this->from_email;
		$shipment_details['from_mobile_number'] = $this->from_phone;
		$shipment_details["from_pin_code"] = $this->from_pin_code;
		$shipment_details["to_name"] = $data['summary_data']['ord_demo_ship_name'];
		$shipment_details["to_address"] = $data['summary_data']['ord_demo_ship_address_01'] . ', ' . $data['summary_data']['ord_demo_ship_address_02'];
		$shipment_details["to_city"] = $data['summary_data']['ord_demo_ship_city'];
		$shipment_details["to_state"] = $data['summary_data']['ord_demo_ship_state'];
		$shipment_details["to_mobile_number"] = $data['summary_data']['ord_demo_phone'];
		
		//$alternative_from_mo[] = "";
		//$alternative_from_mo[] = "";
		//$shipment_details["alternative_from_mo/bile_numbers"] = $alternative_from_mo;		
			
		//$alternative_to_mobile_numbers[] = "23423423";
		//$alternative_to_mobile_numbers[] = "64564564564";
		//$shipment_details["alternative_to_mobile_numbers"] = $alternative_to_mobile_numbers;
		
		$shipment_details["to_pin_code"] = $data['summary_data']['ord_demo_ship_post_code'];
		$shipment_details["payment_type"] = $data['payment_type'];
		$shipment_details["weight"] = $data['summary_data']['ord_total_weight'];
		if($data['payment_type'] == 'cod')
			$shipment_details["cod_collection"] = $data['summary_data']['ord_total'];
		else
			$shipment_details["cod_collection"] = 0;// For 'prepaid'
		$shipment_details["declared_value"] = $data['summary_data']['ord_total'];
		$shipment_details["declaration"] = "I hereby declare that the above mentioned information is true and correct and value declared(value) is for transportation purpose and has no commercial value.Signature: ";
		$shipment_details["length"] = "";
		$shipment_details["breadth"] = "";
		$shipment_details["height"] = "";
		$shipment_details["to_email"] = $data['summary_data']['ord_demo_email'];
		
		//$client_requested_printable_params["tin"] = "TIN : 2342432423";
		//$client_requested_printable_params["tax_id"] = "Tax ID : 12345";
		//$shipment_details["client_requested_printable_params"] = $client_requested_printable_params;
		
		$shipment_details["use_product_detail_list"] = true;
		
		foreach($data['item_data'] as $item_data) {
			$product_detail_list[] = array(
				"product_details" => $item_data['ord_det_item_name'],
				"quantity" => (int) $item_data['ord_det_quantity'],
				"sku_code" => $item_data['ord_det_item_fk'],
				"declared_value" => $item_data['ord_det_price'],
				"tax" => $item_data['ord_det_tax_total'],
				"weight" => $item_data['ord_det_weight_total'],
				"length" => "",
				"breadth" => "",
				"height" => "",
				"discount" => $item_data['ord_det_discount_price_total'],
				"actual_price"=> $item_data['ord_det_price_total']
			);
		}
		$shipment_details["product_detail_list"] = $product_detail_list;
		
		$shipment_details["edit"] = "0";
		
		$request_data['shipment_details'] = array($shipment_details);
		
		return $request_data;
	}
	
	function _get_pickup_request_data($data)
	{
		/*
		{
		"shipment_details": [{
		"awb": "700005673183TEST",
		"partner": "gojavas"
		}],
		"market_name": "aplyindia",
		"vendor_name": "aplyindia",
		"password": "aplyindia"
		}
		*/
		
		$request_data = array(
						'shipment_details' => array(), 
						'market_name' => $this->market_name, 
						'vendor_name' => $this->vendor_name, 
						'password' => $this->password);
		$shipment_details = array();
		
		$shipment_details["awb"] = $data['awb'];//"700005673183TEST";
		$shipment_details["partner"] = $data['partner'];//"gojavas";
		
		$request_data['shipment_details'] = array($shipment_details);
		
		return $request_data;
	}
	
	function _get_track_request_data($data)
	{
		$request_data = array(
						'shipment_details' => array(), 
						'market_name' => $this->market_name, 
						'vendor_name' => $this->vendor_name, 
						'password' => $this->password);
		$shipment_details = array();
		
		$shipment_details["awb"] = "700005673183TEST";
		$shipment_details["partner"] = "gojavas";
	}
	
	function _get_cancel_request_data($data)
	{		
		$request_data = array(
						'shipment_details' => array(), 
						'market_name' => $this->market_name, 
						'vendor_name' => $this->vendor_name, 
						'password' => $this->password);
		$shipment_details = array();
		
		$shipment_details["awb"] = "700005673183TEST";
		$shipment_details["partner"] = "gojavas";
	}

	function _process_curl($request_data, $type = 'service_check') 
	{
		$ch = curl_init();
		
		if($this->test_mode)
			$url = $this->test_url[$type];
		else
			$url = $this->live_url[$type];

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT , 10);
		curl_setopt($ch,CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data) ); // http_build_query
//print_r(json_encode($request_data, JSON_PRETTY_PRINT));
		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		curl_close ($ch);
		
		return $server_output;
	}
	
	function is_success_order()
	{
		$shipping_order_response_data = $this->shipping_order_response_data;
		
		$res_obj = json_decode($shipping_order_response_data);
		$orders_data = $res_obj->orders_data[0];
			
		if(isset($res_obj->orders_data[0])) {
			$orders_data = $res_obj->orders_data[0];
			$this->response_data = $orders_data;
			
			if($orders_data->success == 1 and $orders_data->result_code == 1 and $orders_data->validation_passed == 1) {
				return true;
			}
		}
		
		return false;
	}
	
	function is_success_response($response_data)
	{
		
		$res_obj = json_decode($response_data);
			
		if(isset($res_obj->results[0])) {
			$orders_data = $res_obj->results[0];
			
			if($orders_data->success == true and $orders_data->result_code == 1) {
				return true;
			}
		}
		
		return false;
	}
	
	function get_log($order_id)
	{
		$query = $this->db->get_where('gopigeon_log', array(
            'order_id' => $order_id
        ));
		
		return $query->row();
	}
	
	function add_log($req_data)
	{
		$response_data = $this->response_data;
		
		$data = array();
		$data['order_id'] = $req_data['summary_data']['ord_order_number'];
        $data['awb']    = $response_data->awb_detail->awb;
        $data['partner']    = $response_data->awb_detail->partner;
        $data['pickup_request_status'] = 'Not Requested';
        $data['cancel_status'] = 'Not Cancelled';
		
		$this->db->cache_delete_all();
		
		$this->db->insert('gopigeon_log', $data);
	}
	
	function update_log($req_data)
	{
		$data = array();
		
		$data['order_id'] = $req_data['order_id'];
		if(isset($req_data['pickup_request_status']))
			$data['pickup_request_status'] = $req_data['pickup_request_status'];
		if(isset($req_data['pickup_request_log']))
			$data['pickup_request_log'] = $req_data['pickup_request_log'];
		
		$data['cancel_status'] = $req_data['cancel_status'];
		if(isset($req_data['cancel_log']))
			$data['cancel_log'] = $req_data['cancel_log'];
			
		$this->db->cache_delete_all();
			
		if($req_data['type'] == 'update') {
			
			$this->db->where('order_id', $req_data['order_id']);
			$this->db->update('gopigeon_log', $data);
			
		} else {
			
			$data['awb']    = $req_data['awb'];
			$data['partner']    = $req_data['partner'];
			
			$this->db->insert('gopigeon_log', $data);
		}
		
	}
	
	function if_log_exists($order_id)
	{
		$query = $this->db->get_where('gopigeon_log', array(
            'order_id' => $order_id
        ));

        $count = $query->num_rows();
		
		if ($count === 0) {		
			return false;
		}
		
		return true;
	}

}

		
		/*{
			"shipment_details": [
				{
					"to_pin_code" : "560034",
					"payment_type" : "cod",
					"weight" : "50",
					"cod_collection" : "10",
					"from_pin_code" : "100000",
					"from_city" : "surat",
					"declared_value" : "100",
					"box_details": 
					[
						{
						"weight" : "100",
						"length" : "100",
						"breadth" : "100",
						"height" : "100"
						},
						{
						"weight" : "100",
						"length" : "100",
						"breadth" : "100",
						"height" : "100"
						}
					]
				}
			],
			"market_name":"aplyindia" ,
			"vendor_name":"aplyindia" ,
			"password": "aplyindia"
		}*/
		
		/*
		{
		"shipment_details": [
			{
			"unique_id": "R474330703-11",
			"invoice": "R474330703-11",
			"reference": "23423432423",
			"product_detail": "Clothing Accessories",
			"sku_code": "sfsfd-w4r23-sdfsdf",
			"quantity": "3",
			"from_name": "Mahaveer Rajasthani Saree",
			"from_address": "B1303 Ashirwad Avenue,VIP road ,New City Light",
			"from_city": "SURAT",
			"from_state": "Gujarat",
			"from_email": "mahaveerrajasthanisaree@gmail.com",
			"from_mobile_number": "9898719362",
			"alternative_from_mo/bile_numbers": [
				"23424322323",
				"3435353453453"
			],
			"from_pin_code": "395007",
			"to_name": "sunitha",
			"to_address": "Sunitha, C. TYPIST, College of agriculture, V.C farm, Mandya",
			"to_city": "Mandya",
			"to_state": "Karnataka",
			"to_mobile_number": "8496975520",
			"alternative_to_mobile_numbers": [
				"23423423",
				"64564564564"
			],
			"to_pin_code": "560034",
			"payment_type": "cod",
			"weight": "500",
			"cod_collection": "414",
			"declared_value": "414",
			"declaration": "I hereby declare that the above mentioned information is true and correct and value declared(value) is for transportation purpose and has no commercial value.Signature: ",
			"length": "10",
			"breadth": "10",
			"height": "10",
			"to_email": " ashams0190@gmail.com ",
			"client_requested_printable_params": {
				"tin": "TIN : 2342432423",
				"tax_id": "Tax ID : 12345"
			},
			"use_product_detail_list": true,
			"product_detail_list": [{
				"product_details": "red shirt XXL",
				"quantity": "2",
				"sku_code": "2342-44234-2342",
				"declared_value": "1222",
				"tax": "212",
				"weight": "23",
				"length": "12",
				"breadth": "123",
				"height": "23",
				"discount": "10",
				"actual_price": "1212"
			}, {
				"product_details": "blue shirt XXL",
				"quantity": "4",
				"sku_code": "2342-44234-2342",
				"declared_value": "1222",
				"tax": "212",
				"weight": "23",
				"length": "12",
				"breadth": "123",
				"height": "23",
				"discount": "10",
				"actual_price": "1212"
			}],
			"edit": "1"
			}
		],
			"market_name": "aplyindia",
			"vendor_name": "aplyindia",
			"password": "aplyindia"
		}
		*/
?>
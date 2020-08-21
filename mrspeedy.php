<?php
$mrspeedy = new Mrspeedy();
class mrspeedy{

    private $token;
    private $callbacktoken;
    private $url_deployment;
    private $url_production;
 
    public function __construct() {
       
        $this->token = "2A92C51DFF4FE14D35EB3F31AC71CB1236B4825A";
        $this->callbacktoken = "6F7982DB3A122DA83E669D32620B42D37CE70EC9";
        $this->url = "https://robotapitest.mrspeedy.co/api/business/1.1";
        //$this->url = "https://robot.mrspeedy.co/api/business/1.1";
    }

    function request($token)
    {

        $curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $this->url); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '.$this->token]); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		 
		$result = curl_exec($curl); 
		if ($result === false) { 
		    throw new Exception(curl_error($curl), curl_errno($curl)); 
		} 
		 
		echo $result;
    }

    function kalkulasi($origin,$destination)
    {
    	$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $this->url.'/calculate-order'); 
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '.$this->token]); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		 
		$data = [ 
		    'matter' => 'Documents', 
		    'points' => [ 
		        [ 
		            'address' => $origin, 
		        ], 
		        [ 
		            'address' => $destination, 
		        ], 
		    ], 
		]; 
		 
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json); 
		 
		$result = curl_exec($curl); 
		if ($result === false) { 
		    throw new Exception(curl_error($curl), curl_errno($curl)); 
		} 
		 
		echo $result; 
    }

    function order($origin,$destination,$sender_phone,$receiver_phone)
    {
    	$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $this->url.'/create-order'); 
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '.$this->token]); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		 
		$data = [ 
		    'matter' => 'Documents', 
		    'points' => [ 
		        [ 
		            'address' => $origin, 
		            'contact_person' => [ 
		                'phone' => $sender_phone, 
		            ], 
		        ], 
		        [ 
		            'address' => $destination, 
		            'contact_person' => [ 
		                'phone' => $receiver_phone, 
		            ], 
		        ], 
		    ], 
		]; 
		 
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json); 
		 
		$result = curl_exec($curl); 
		if ($result === false) { 
		    throw new Exception(curl_error($curl), curl_errno($curl)); 
		} 
		 
		echo $result; 
    }

    function edit_order($order_id,$matter)
    {
    	$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $this->url.'/edit-order'); 
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '.$this->token]); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		 
		$data = [ 
		    'order_id'            => $order_id, 
		    'matter'              => $matter, 
		    'backpayment_details' => null, 
		]; 
		 
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json); 
		 
		$result = curl_exec($curl); 
		if ($result === false) { 
		    throw new Exception(curl_error($curl), curl_errno($curl)); 
		} 
		 
		echo $result; 
    }

    function cancel_order($order_id)
    {
    	$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $this->url.'/cancel-order'); 
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '.$this->token]); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		 
		$data = [ 
		    'order_id' => $order_id, 
		]; 
		 
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json); 
		 
		$result = curl_exec($curl); 
		if ($result === false) { 
		    throw new Exception(curl_error($curl), curl_errno($curl)); 
		} 
		 
		echo $result; 
    }

    function list_order()
    {
    	$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $this->url.'/orders?status=available'); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '.$this->token]); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		 
		$result = curl_exec($curl); 
		if ($result === false) { 
		    throw new Exception(curl_error($curl), curl_errno($curl)); 
		} 
		 
		echo $result;
    }

    function info_kurir($order_id)
    {
    	$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $this->url.'/courier?order_id='.$order_id); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '.$this->token]); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		 
		$result = curl_exec($curl); 
		if ($result === false) { 
		    throw new Exception(curl_error($curl), curl_errno($curl)); 
		} 
		 
		echo $result; 
    }

    function profil()
    {
    	$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $this->url.'/client'); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '.$this->token]); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		 
		$result = curl_exec($curl); 
		if ($result === false) { 
		    throw new Exception(curl_error($curl), curl_errno($curl)); 
		} 
		 
		echo $result; 
    }

    function available_payment()
    {
    	$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $this->url.'/bank-cards'); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '.$this->token]); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		 
		$result = curl_exec($curl); 
		if ($result === false) { 
		    throw new Exception(curl_error($curl), curl_errno($curl)); 
		} 
		 
		echo $result; 
    }

    function buat_draft_delivery($matter,$destinasi,$weight_kg,$receiver_phone)
    {
    	$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $this->url.'/create-deliveries'); 
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '.$this->token]); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		 
		$data = [ 
		    'deliveries' => [ 
		        [ 
		            'matter'         => $matter, 
		            'address'        => $destinasi, 
		            'weight_kg'      => $weight_kg, 
		            'contact_person' => [ 
		                'phone' => $receiver_phone, 
		            ], 
		        ], 
		         
		    ], 
		]; 
		 
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json); 
		 
		$result = curl_exec($curl); 
		if ($result === false) { 
		    throw new Exception(curl_error($curl), curl_errno($curl)); 
		} 
		 
		echo $result; 
    }

    function edit_draft_delivery()
    {
    	$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $this->url.'/edit-deliveries'); 
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '.$this->token]); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		 
		$data = [ 
		    'deliveries' => [ 
		        [ 
		            'delivery_id' => 11712, 
		            'matter'      => "Flowers", 
		            'note'        => null, 
		        ], 
		        [ 
		            'delivery_id' => 11713, 
		            'packages'    => [ 
		                [ 
		                    'delivery_package_id' => 32251, 
		                    'items_count'         => 3, 
		                ], 
		                [ 
		                    'delivery_package_id' => 32252, 
		                ], 
		            ], 
		        ], 
		    ], 
		]; 
		 
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json); 
		 
		$result = curl_exec($curl); 
		if ($result === false) { 
		    throw new Exception(curl_error($curl), curl_errno($curl)); 
		} 
		 
		echo $result; 
    }

    function delete_draft_delivery($delivery_ids)
    {
    	$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $this->url.'/delete-deliveries'); 
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '.$this->token]); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		 
		$data = [ 
		    'delivery_ids' => $delivery_ids, 
		]; 
		 
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json); 
		 
		$result = curl_exec($curl); 
		if ($result === false) { 
		    throw new Exception(curl_error($curl), curl_errno($curl)); 
		} 
		 
		echo $result; 

    }

    function list_delivery()
    {
    	$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $this->url.'/deliveries?status=available'); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '.$this->token]); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		 
		$result = curl_exec($curl); 
		if ($result === false) { 
		    throw new Exception(curl_error($curl), curl_errno($curl)); 
		} 
		 
		echo $result; 
    }

    function notifikasi_ubah_order($data)
    {
    	if (!isset($_SERVER['HTTP_X_DV_SIGNATURE'])) { 
		    echo 'Error: Signature not found'; 
		    exit; 
		} 
		 
		$data = file_get_contents('php://input'); 
		 
		$signature = hash_hmac('sha256', $data, $this->callbacktoken); 
		if ($signature != $_SERVER['HTTP_X_DV_SIGNATURE']) { 
		    echo 'Error: Signature is not found'; 
		    exit; 
		} 
		 
		echo $data; 
    }

    function notifikasi_ubah_delivery($data)
    {
    	if (!isset($_SERVER['HTTP_X_DV_SIGNATURE'])) { 
		    echo 'Error: Signature not found'; 
		    exit; 
		} 
		 
		$data = file_get_contents('php://input'); 
		 
		$signature = hash_hmac('sha256', $data, $this->callbacktoken); 
		if ($signature != $_SERVER['HTTP_X_DV_SIGNATURE']) { 
		    echo 'Error: Signature is not found'; 
		    exit; 
		} 
		 
		echo $data;
    }
}
    //cara pakai
    //gunakan salah satu fungsi di mrspeedy
    //$mrspeedy->request();
    //$mrspeedy->info_kurir('orderid');

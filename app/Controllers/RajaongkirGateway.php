<?php namespace App\Controllers;

use CodeIgniter\Controller;

Class Rajaongkirgateway extends Controller{
	//Initialization
	private $province_model;
	private $city_model;
    protected $request;

    //Construct
    function __construct(){
		$this->province_model = new \App\Models\MProvince;
		$this->city_model = new \App\Models\MCity;
        $this->request = \Config\Services::request();
    }

    function _api_ongkir_post($origin,$des,$qty,$cour)
   {
  	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$des."&weight=".$qty."&courier=".$cour,	  
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	    /* masukan api key disini*/
	    "key: 80b0bfc2b1124dfb6340aa0b493c6aa5"
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  return $err;
		} else {
		  return $response;
		}
   }
   function _api_ongkir($data)
   {
	   	$curl = curl_init();
		curl_setopt_array($curl, array(
		  //CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=12",
		  //CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/".$data,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",		  
		  CURLOPT_HTTPHEADER => array(
		  	/* masukan api key disini*/
		    "key: 80b0bfc2b1124dfb6340aa0b493c6aa5"
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  return  $err;
		} else {
		  return $response;
		}
   }

   	public function provinsi()
	{
		$provinsi = $this->_api_ongkir('province');
		$data = json_decode($provinsi, true);
		
		echo json_encode($data['rajaongkir']['results']);
	}
	public function kota($provinsi="")
	{
		$kota = $this->_api_ongkir('city?province='.$provinsi);	
		$data = json_decode($kota, true);
		echo json_encode($data['rajaongkir']['results']);
	}
	public function tarif()
	{
		$origin = 160;
		$city_destination = $this->request->getPost('city_destination');
		$weight_total = $this->request->getPost('weight_total');
		$courier = $this->request->getPost('courier');

		// echo json_encode($city_destination.' - '.$weight_total.' - '.$courier);
		// return;
		
		$tarif = $this->_api_ongkir_post($origin,$city_destination,$weight_total,$courier);		
		$data = json_decode($tarif, true);
		echo json_encode($data['rajaongkir']['results']);		
	}

	function provinceSaveToDB(){
		$provinsi = $this->_api_ongkir('province');
		$data = json_decode($provinsi, true);
		
		foreach($data['rajaongkir']['results'] as $items){
			print_r($items);
			// $data = [
			// 	'province_id' => $items['province_id'],
			// 	'province' => $items['province'],
			// ];
			// $this->province_model->save($data);

			$this->citySaveToDB($items['province_id']);
		}
   	}

	function citySaveToDB(){
	   for($i=22;$i<=34;$i++){
		   $kota = $this->_api_ongkir('city?province='.$i);	
			$data = json_decode($kota, true);
			echo json_encode($data['rajaongkir']['results']);

			foreach($data['rajaongkir']['results'] as $items){
				print_r($items);
				$data = [
					'city_id' => $items['city_id'],
					'province_id' => $i,
					'city_name' => $items['city_name'],
				];
				$this->city_model->insert($data);
			}
			sleep(5);
		}
   	}
}

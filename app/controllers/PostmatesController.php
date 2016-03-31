<?php
use Guzzle\Http\Client;

class PostmatesController extends BaseController {

    const CUSTOMER_ID = "cus_KiIwvChipab_QF";
    const API_KEY = "bfc1e830-3574-44cc-b076-2cc84078b6f6";

    public $_client;
    private $_baseUrl;

    public function __construct()
    {
        //Guzzle\Http\StaticClient::mount();
        $this->_baseUrl = "https://api.postmates.com";
        $client = new Client($this->_baseUrl);
        $this->_client = $client->setDefaultOption('auth', array(self::API_KEY, ''));
    }

    public function  get($url,$headers=array(),$options=array()){
        $request = $this->_client->get($url,$headers,$options);
        $response =  $request->send();
        return  $response->json();
    }

    public function  post($url,$headers=array(),$body=array(),$options=array()){
        $request = $this->_client->post($url,$headers,$body,$options);
        $response =  $request->send();
        return $response->json();
    }

    public function getDeliveries(){

        $data = $this->get('/v1/customers/'.self::CUSTOMER_ID.'/deliveries');

        return Response::json($data);

    }

    public function getDelivery($id){

        $data = $this->get('/v1/customers/'.self::CUSTOMER_ID.'/deliveries/'.$id);

        return Response::json($data);

    }
    public function cancelDelivery($id){

        $data = $this->post('/v1/customers/'.self::CUSTOMER_ID.'/deliveries/'.$id.'/cancel',array('Content-Type: application/x-www-form-urlencoded'));

        return Response::json($data);

    }
    public function returnDelivery($id){

        $data = $this->post('/v1/customers/'.self::CUSTOMER_ID.'/deliveries/'.$id.'/return',array('Content-Type: application/x-www-form-urlencoded'));

        return Response::json($data);

    }

    public function addTipToDelivery($id){

        /*$post = array();
        $post["tip_by_customer"] = Input::get("tip_by_customer");*/

        $data = $this->post('/v1/customers/'.self::CUSTOMER_ID.'/deliveries/'.$id,array('Content-Type: application/x-www-form-urlencoded'),Input::all());
        return Response::json($data);

    }

    public  function deliveryZones(){

        $data = $this->get('/v1/delivery_zones/');

        return Response::json($data);
    }

    public  function deliveryQuotes(){

        /*$post = array();
        $post["pickup_address"] = "20 McAllister St, San Francisco, CA";
        $post["dropoff_address"] = "101 Market St, San Francisco, CA";*/

        $data = $this->post('/v1/customers/'.self::CUSTOMER_ID.'/delivery_quotes',array('Content-Type: application/x-www-form-urlencoded'), Input::all());

        return Response::json($data);
    }



    public function createDelivery(){

        /*$post = array();
        $post["manifest"] = "A box of gray kittens";
        $post["pickup_name"] ="Kitten Warehouse";
        $post["pickup_address"] ="20 McAllister St, San Francisco, CA";
        $post["pickup_phone_number"] = "415-555-8484";

        $post["dropoff_name"] = "Alice";
        $post["dropoff_address"]  =  "678 Green St, San Francisco, CA";
        $post["dropoff_phone_number"] ="415-555-8484";*/


        $data = $this->post('/v1/customers/'.self::CUSTOMER_ID.'/deliveries',array('Content-Type: application/x-www-form-urlencoded'),Input::all());

        return Response::json($data);
    }



}
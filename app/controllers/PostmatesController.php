<?php
use Guzzle\Http\Client;

class PostmatesController extends BaseController {

    const CUSTOMER_ID = "cus_KiIwvChipab_QF";
    const API_KEY = "bfc1e830-3574-44cc-b076-2cc84078b6f6";

    private $_client;

    public function __construct()
    {
        $this->_client = new Client("https://api.postmates.com");
    }

    public function setAuth($response){
        return $response->setAuth(self::API_KEY, '');
    }

    public function getDeliveries(){

        $request = $this->_client->get('/v1/customers/'.self::CUSTOMER_ID.'/deliveries');
        $request = $this->setAuth($request);

        $response =  $request->send();

        return Response::json($response->json());

    }

    public  function deliveryZones(){
        $request = $this->_client->get('/v1/delivery_zones/');
        $request = $this->setAuth($request);
        $response =  $request->send();

        return Response::json($response->json());
    }

    public  function deliveryQuotes(){

        $address = array();

        $address["pickup_address"] = "20 McAllister St, San Francisco, CA";
        $address["dropoff_address"] = "101 Market St, San Francisco, CA";

        $request = $this->_client->post('/v1/customers/'.self::CUSTOMER_ID.'/delivery_quotes',array(), array(
            'body'    => $address,
        ));
        $request = $this->setAuth($request);
        $response =  $request->send();


        return Response::json($response->json());
    }



    public function createDelivery(){

        $post = array();


        $post["manifest"] = "A box of gray kittens";
        $post["pickup_name"] ="Kitten Warehouse";
        $post["pickup_address"] ="20 McAllister St, San Francisco, CA";

        $post["dropoff_name"] = "Alice";
        $post["dropoff_address"]  =  "678 Green St, San Francisco, CA";
        $post["dropoff_phone_number"] ="415-555-8484";

        $request = $this->_client->post('/v1/customers/'.self::CUSTOMER_ID.'/deliveries',array(), array($post),array());
        $request = $this->setAuth($request);

        $response =  $request->send();

        return Response::json($response->json());
    }




}
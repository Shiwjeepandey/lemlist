<?php

namespace App\Api;

class LemlistApi{ 
    
    // private variables for api urls and keys
    private $apiUrl;
    private $apiKey;

    public function __construct($api_name="",$extra_kwrgs=""){
        // assign the api names and keys
        $this->apiUrl = "https://api.lemlist.com/api/".$api_name;
        $this->apiKey = "f0cbbddf1e4f827f79e93a557155fb34";
        if(!empty($extra_kwrgs)){
            $this->apiUrl = $this->apiUrl."/".$extra_kwrgs;
        }
    }

    /*
    * function to get all capaigns from Lemlist api
    * @param void
    * @return Decoded Json Data @jsonData
    * @author Shiv Kumar Tiwari
    */
    public function callApi(){
        $command = 'curl '.$this->apiUrl.' --user ":'.$this->apiKey.'"';
		$output = exec($command);
		$jsonData = json_decode($output);
        return $jsonData;
    }

    /*
    * function to get all capaigns from Lemlist api
    * @param void
    * @return Decoded Json Data @jsonData
    * @author Shiv Kumar Tiwari
    */
    public function callApiWithData($arrData, $extra_kwrgs=""){
        //echo $jsonDecodedData = json_encode($arrData);
        //echo $this->apiUrl."/".$extra_kwrgs;exit;
        $curl = curl_init();
        $arrCurl = array(
            CURLOPT_URL => $this->apiUrl."/".$extra_kwrgs,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($arrData),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.base64_encode(":".$this->apiKey),
                'Content-Type: application/json'
            ),
        );
        curl_setopt_array($curl, $arrCurl);
        $response = curl_exec($curl);
        curl_close($curl);
        $jsonData = json_decode($response);
        return $jsonData;
    }

    /*
    * function to activites
    * @param void
    * @return Decoded Json Data @jsonData
    * @author Shiv Kumar Tiwari
    */
    public function callApiWithGetData($extra_kwrgs=""){
        $curl = curl_init();
        $arrCurl = array(
            CURLOPT_URL => $this->apiUrl."/".$extra_kwrgs,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.base64_encode(":".$this->apiKey),
                'Content-Type: application/json'
            ),
        );
        curl_setopt_array($curl, $arrCurl);
        $response = curl_exec($curl);
        curl_close($curl);
        $jsonData = json_decode($response);
        return $jsonData;
    }


}

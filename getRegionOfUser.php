<?php

// by using google api key we can retrive the user details by using curls and file_get_containts 
// but using file_get_containts if its taking more time then it may throw errors , to avoid this use curls 

public function getLocationdetailsUsingLatLong($lat,$long){
  

    if((!empty($lat) && $lat != null) && (!empty($long) && $long != null)){

        /*
        // using via file_get_contents

        $url = "https://maps.googleapis.com/maps/api/geocode/json?sensor=false&key=AIzaSyCbCXvsU1WQyyJ2CoHkFWEbR45PI4NHBwk&latlng=12.97628343939399,%2077.59907628103981";
        $url = str_replace(',','%',$url);
        // $response = file_get_contents($url);

        */

        //use curls
        $response = $this->getDetailsUsingCurls($lat,$long);
        // print_r(77);exit;
        $res= json_decode($response);
        $loactionDetails = $res->results;
        $details = $loactionDetails[0]->address_components;

        $state = $details[7]->long_name;
        $state_shotname = $details[7]->short_name;

        $pincode = $details[9]->long_name;
        $locality = $details[4]->short_name;


        $responseData =[
            'state'=>$state,
            'state_shotname'=>$state_shotname,
            'pincode'=>$pincode,
            'locality'=>$locality
        ];


        return $responseData;

        // if(!empty($details)){

        //     // foreach($details as $key=>$val){

        //     // }
        // }


    }else{
        throw new \yii\web\HttpException(422, "Lat and long is missing");
    }

}

public function getDetailsUsingCurls($lat,$long){
   
    $url = "https://maps.googleapis.com/maps/api/geocode/json?sensor=false&key=AIzaSyCbCXvsU1WQyyJ2CoHkFWEbR45PI4NHBwk&latlng=$lat,$long";
    $url = str_replace(',','%',$url);
   
    $curl = curl_init();
    $options = array(CURLOPT_URL => $url,
             CURLOPT_HEADER => false,
             CURLOPT_RETURNTRANSFER=>true,
             CURLOPT_SSL_VERIFYPEER=>false
            );
    curl_setopt_array($curl, $options);
   
    $res = curl_exec($curl);


    if (curl_errno($curl)) {
        $error = curl_error($curl);
        curl_close($curl);
        return ['error' => $error];
    } else {
        // $data = json_decode($res, true);
        curl_close($curl);
        return $res;
    }

}

?>
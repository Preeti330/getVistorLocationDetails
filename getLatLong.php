<?php 



 function GetIp(){

       


        if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
        {
            $IP = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
        {
            $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else 
        {
            $IP = $_SERVER['REMOTE_ADDR']; 
        }
          

          //  $IP=($IP != NULL && !empty($IP))?
          $IP='121.241.200.46';
          
            $locationDetails= json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$IP),true);
      
        $latitude= $locationDetails['geoplugin_latitude'];
        $longitude=$locationDetails['geoplugin_longitude'];
        $defaultLocationLatLong=["latitude"=>$latitude,
                          "longitude"=>$longitude
                        ];
          return $defaultLocationLatLong;
       }

      $ipdetails=GetIp(); 

      print_r($ipdetails);

      
/*
      using geo flugIns get website visitor info.
get Ip adress using  SERVER['REMOTE_ADDRESS'] is use to get remote address of user host.
using the geoplugin  get the user location details based on IP address.
geo plugin  givies near by 200 m loaction details of user .
not accurate some time it varies and it conatins the details like country_code, lat and long , city , region_name,region_code, ect this things are helpful to get information of any perticular Ip address . geo_plugin are free to use upto some limited user
		
        Issues With ip_geo_plugin 
         sometimes its not shows accurate results due to 		 
		1.due to ISP traffic (internet traffic its giving varition in data)
		2.the location of the IP address registration
		3.where the controlling agency is located (ISP )
		4.if user has proxy connection 
		5.if user has VPN connection 
		6.wether the connection is cellular
		7.if user connects to anonymous browser
        */

?>
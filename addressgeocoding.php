<?php
$zip = '160059';
$blnUSA = '';
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$zip."&sensor=false&region=US&key=AIzaSyD4wL-6Vw6rf5wW2DfghgIYQnJRAo71gPs";

    $address_info = file_get_contents($url);
    $json = json_decode($address_info);
    $city = "";
    $state = "";
    $country = "";
     
    // //Get latitude and longitute from json data
    // $latitude  = $json->results[0]->geometry->location->lat; 
    // $longitude = $json->results[0]->geometry->location->lng;
    // //Send request and receive json data by latitude longitute
    // $geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng=48.283273,14.295041&sensor=false&key=AIzaSyD4wL-6Vw6rf5wW2DfghgIYQnJRAo71gPs');
    // $jsonlocation = json_decode($geocode);
    // echo "<pre>";
    // print_r($jsonlocation);
    // echo "</pre>";
 // echo "<pre>";
 //    print_r($json);
 //    echo "</pre>";
    if (count($json->results) > 0) {
        //break up the components
        $arrComponents = $json->results[0]->address_components;

        foreach($arrComponents as $index=>$component) {
            $type = $component->types[0];
            if ($city == "" && ($type == "sublocality_level_1" || $type == "locality") ) {
                $city = trim($component->short_name);
            }
            if ($state == "" && $type=="administrative_area_level_1") {
                $state = trim($component->short_name);
            }
            if ($country == "" && $type=="country") {
                $country = trim($component->short_name);
                if ($country!="US") {
                    $city = "";
                    $state = "";
                    break;
                }
            }
            if ($city != "" && $state != "" && $country != "") {
                //we're done
                break;
            }
        }
    }
    if($country !== 'US'){
    	echo 'Error: Postal code is not valid';
    }else{
    	$arrReturn = array("city"=>$city, "state"=>$state, "country"=>$country);

    	die(json_encode($arrReturn));
    }
    




?>
<?php

//  Initiate curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,'https://eodhistoricaldata.com/api/exchanges-list/?api_token=603291a0208a88.55332119&fmt=json');
$result=curl_exec($ch);
curl_close($ch);


$getexchangeData = json_decode($result);

if(!empty($getexchangeData)){
	foreach ($getexchangeData as $key => $exchangeData) {
		
		$Code = isset($exchangeData->Code) ? $exchangeData->Code : '';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,'https://eodhistoricaldata.com/api/exchange-symbol-list/'.$Code.'?fmt=json&api_token=603291a0208a88.55332119');
		$result=curl_exec($ch);
		curl_close($ch);



		
		$getsymboldata = json_decode($result);
		foreach ($getsymboldata as $ey => $symbols) {
			echo "<pre>";
			print_r($symbols);
			echo "</pre>";
			// $symbolsName = $symbols->Exchange;
			
			// if($symbolsName !== '' && $code !== ''){
			// 	$getcode = $symbolsName . '.'  . $Code;
			// 	$chs = curl_init();
			// 	curl_setopt($chs, CURLOPT_RETURNTRANSFER, true);
			// 	curl_setopt($chs, CURLOPT_URL,'https://eodhistoricaldata.com/api/fundamentals/'.$getcode.'?api_token=603291a0208a88.55332119&filter=General');
			// 	$resultchs=curl_exec($chs);
			// 	curl_close($chs);
			// 	echo "<pre>";
			// 	print_r(json_decode($resultchs));
			// 	echo "</pre>";
			// }
			
		}
	}
}
?>
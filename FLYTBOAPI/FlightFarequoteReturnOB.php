<?php 
//include dirname(__FILE__).'/APIConstants.php';
//include dirname(__FILE__).'/RestApiCaller.php';
//header("Content-Type: application/json");
$auth=array();
$Rurl = APIFAREQUOTE; 

$auth["SiteName"]="";
$auth["AccountCode"]="";
$auth["UserName"]=APIUSERNAME;
$auth["Password"]=APIPASSWORD;

$opta = array( 
               "EndUserIp" => $ip,
               "TokenId" => $TokenId,
               "TraceId" => $TraceId,
               "ResultIndex" => $srkid,
                );
 
$fare_quote_return_result=array();
try
{
$req=str_replace('\/','/',json_encode($opta));
$req=file_put_contents("FLYTBOJSON/".$agentId."_TBOFarequoteOBRequest_".date("Y-m-d_H:i:s").".txt","$req");
  
$postdata = file_get_contents("FLYTBOJSON/".$agentId."_FlyShopFarequoteOBRequest_".date("Y-m-d_H:i:s").".txt","$req"); //Take JSON input from Postman Client
//echo '<pre>';print nl2br(print_r($postdata, true));echo '</pre>'; 
$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$flightRes = $restCaller->post($Rurl, $postdata, $header);

$results=file_put_contents("FLYTBOJSON/".$agentId."_TBOFarequoteOBResponse_".date("Y-m-d_H:i:s").".txt","$flightRes");
$fare_quote_result = json_decode($flightRes,true);
}
catch(Exception $e)
{
   //echo $e;
   //echo 'Sorry! due to some technical issues, flights results not found';	
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";
    include dirname(dirname(__FILE__)).'/error.php';
    exit;
}
//print_r($search_result);
//echo '<pre>';print nl2br(print_r($fare_quote_return_result, true));echo '</pre>'; 
?>
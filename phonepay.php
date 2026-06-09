<?php

//Change these details with your actual PhonePe API credentials
$merchantID = 'PGTESTPAYUAT69'; // Sandbox or Live MerchantID
$apiKey="f23f3fc9-f7ca-455f-9fb3-8bd124642fdf"; // Sandbox or Live APIKEY

//Create Redirect URL so that after it will redirect to success page
$redirectUrl = 'https://chalofly.com/success.php';
 
//Add transaction details
$order_id = uniqid(); 
$name = "Shiwansh Saxena";
$email = "shiwansh1993@gmail.com";
$mobile = 9999999999;
$amount = 10; //amount in INR
$description = 'Payment for Product/Service';
 
 
$paymentData = array(
        'merchantId' => $merchantID,
        'merchantTransactionId' => "EV78399929880897", //test transactionID
        "merchantUserId"=>"EVUSERID17231",
        'amount' => $amount*100,
        'redirectUrl' => $redirectUrl,
        'redirectMode' => "POST",
        'callbackUrl' => $redirectUrl,
        "merchantOrderId" => $order_id,
        "mobileNumber" => $mobile,
        "message" => $description,
        "email" => $email,
        "shortName" => $name,
        "paymentInstrument"=> array(    
        "type"=> "PAY_PAGE",
    )
);
 
 
$jsonencode = json_encode($paymentData);
$payloadMain = base64_encode($jsonencode);


$salt_index = 1; //key index 1
$payload = $payloadMain . "/pg/v1/pay" . $apiKey;
$sha256 = hash("sha256", $payload);
$final_x_header = $sha256 . '###' . $salt_index;
$request = json_encode(array('request'=>$payloadMain));
                
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $request,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "X-VERIFY: " . $final_x_header,
        "accept: application/json"
    ],
]);
 
$response = curl_exec($curl);
$error = curl_error($curl);
 
curl_close($curl);
 
if ($error) {
    echo "CURL Error #:" . $error;
} 
else 
{
    $res = json_decode($response);
 
    if(isset($res->success) && $res->success=='1'){
        $paymentCode=$res->code;
        $paymentMsg=$res->message;
        $payUrl=$res->data->instrumentResponse->redirectInfo->url;
         
        header('Location:'.$payUrl) ;
    }
}
          
?>
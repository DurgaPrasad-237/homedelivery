<?php
include('config.php');
include('dblayer.php');

$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata, true);

$load = $data['load'] ?? "";
$customerid = $data['customerid'] ?? "";
$customername = $data['customername']?? "";
$primaryphone = $data['primaryphone'] ?? "";
$billingphone = $data['billingphone'] ?? "";
$deliveryphone = $data['deliveryphone'] ?? "";
$flatno = $data['flatno'] ?? "";
$street = $data['street'] ?? "";
$area = $data['area'] ?? "";
$landmark = $data['landmark'] ?? "";
$billingaddress = $data['billingaddress'] ?? "";
$deliveryaddress = $data['deliveryaddress'] ?? "";
$email = $data['email'] ?? "";
$periodicity = $data['periodicity'] ?? "";
$map = $data['map'] ?? "";

if($load == "register"){
    register($conn);
}
else if($load == "fetchbymobile"){
    fetch_by_mobile($conn);
}
else if($load == "fetchbyid"){
    fetch_by_id($conn);
}
else if($load == "fetchbycustomername"){
    fetch_by_name($conn);
}
else if($load == "add_delivery_address"){
    add_deliveryaddress($conn);
}
else if($load == "add_billing_address"){
    add_billingaddress($conn);
}
else if($load == "loadperiodicity"){
    load_periodicity($conn);
}

//function for load load_periodicity
function load_periodicity($conn){
   $selectquery = "SELECT * FROM `periodicity`";
   $result = getData($conn,$selectquery);
   if(count($result) > 0){
    $jsonresponse = array('code' => '200', 'status' => "Success",'data'=>$result);
    echo json_encode($jsonresponse);
   }
   else{
    $jsonresponse = array('code' => '200', 'status' => "Success",'data'=>"No data");
    echo json_encode($jsonresponse);
   }
}


//add billing address
function add_billingaddress($conn){
    global $customerid,$billingaddress,$billingphone;

    $insertsql = "UPDATE `customers` 
              SET `BillingAddress` = '$billingaddress', 
                  `Phone2` = '$billingphone'
              WHERE `CustomerID` = '$customerid'";

    $sqlresult = setData($conn,$insertsql);

    if($sqlresult == "Record created"){
        $jsonresponse =  array('code' => '200', 'status' => 'success');
        echo json_encode($jsonresponse);
    }
    else{
        $jsonresponse = array('code' => '400', 'status' => 'fail');
        echo json_encode($jsonresponse);
    }
}

//add delivery address
function add_deliveryaddress($conn){
    global $customerid,$deliveryaddress,$map,$deliveryphone;

    $insertsql = "UPDATE `customers` 
              SET `DeliveryAddress` = '$deliveryaddress', 
                  `Phone3` = '$deliveryphone', 
                  `Map` = '$map' 
              WHERE `CustomerID` = '$customerid'";

    $sqlresult = setData($conn,$insertsql);

    if($sqlresult == "Record created"){
        $jsonresponse = array('code' => '200', 'status' => "Success");
        echo json_encode($jsonresponse);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => "failed");
        echo json_encode($jsonresponse);
    }
}


//register the customer
function register($conn){
    global $customername,$primaryphone,$email,$deliveryaddress,$deliveryphone,$map;
    // $flatno,$street,$area,$landmark,$billingaddress,$deliveryaddress,$email,$periodicity,$map;

    // $insertsql = "INSERT INTO `customers`(`CustomerName`, `Phone1`, `Phone2`, `Phone3`, `FlatNo`, `Street`, `Area`, `Landmark`, `BillingAddress`, `DeliveryAddress`, `email`, `periodicity`, `Map`) 
    // VALUES ('customername','primaryphone','billingphone','deliveryphone','flatno','street','area','landmark','billingaddress','deliveryaddress','email','periodicity','map')";
    
    $insertsql = "INSERT INTO `customers`(`CustomerName`, `Phone1`,`Email`,DeliveryAddress,Phone3,Map) 
    VALUES ('$customername','$primaryphone','$email','$deliveryaddress','$deliveryphone','$map')";

    $sqlresult = setData($conn,$insertsql);

    if($sqlresult == "Record created"){
        $jsonresponse = array('code' => '200', 'status' => "Success");
        echo json_encode($jsonresponse);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => "failed");
        echo json_encode($jsonresponse);
    }
}
//fetch customers by mobile
function  fetch_by_mobile($conn){
    global $primaryphone;

    $selectquery = "SELECT * FROM `customers` WHERE `Phone1` = '$primaryphone'";
    $sqlresult = getData($conn,$selectquery);

    if(count($sqlresult) > 0){
        $jsonresponse = array('code' => '200', 'status' => "Success",'data' => $sqlresult);
        echo json_encode($jsonresponse);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => "No Data",);
        echo json_encode($jsonresponse);
    }

}

//fetch customers by id
function  fetch_by_id($conn){
    global $customerid;

    $selectquery = "SELECT * FROM `customers` WHERE `CustomerId` = '$customerid'";
    $sqlresult = getData($conn,$selectquery);

    if(count($sqlresult) > 0){
        $jsonresponse = array('code' => '200', 'status' => "Success",'data' => $sqlresult);
        echo json_encode($jsonresponse);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => "No Data",);
        echo json_encode($jsonresponse);
    }

}

//fetch by name
function fetch_by_name($conn){
    global $customername;

    $selectquery = "SELECT * FROM `customers`
    WHERE LOWER(REPLACE(CustomerName, ' ', '')) = LOWER(REPLACE('$customername', ' ', ''));";
    $sqlresult = getData($conn,$selectquery);

    if(count($sqlresult) > 0){
        $jsonresponse = array('code' => '200', 'status' => "Success",'data' => $sqlresult);
        echo json_encode($jsonresponse);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => "No Data",);
        echo json_encode($jsonresponse);
    }
}


?>
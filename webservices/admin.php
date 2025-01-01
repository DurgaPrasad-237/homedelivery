<?php
include('config.php');
include('dblayer.php');

$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata, true);

$adminname = $data['adminname'] ?? "";
$adminmobile = $data['adminmobile'] ?? "";
$adminid = $data['adminid'] ?? "";
$adminpass = $data['adminpass'] ?? "";
$load = $data['load']?? "";

if($load == "registeradmin"){
    registeradmin($conn);
}
else if($load == "adminloginbymobile"){
    adminloginbymobile($conn);
}

function registeradmin($conn){
    global $adminname,$adminmobile,$adminpass;
    $admininsertquery = "INSERT INTO `admins`(`admin_name`, `admin_mobile`, `admin_password`) 
    VALUES ('$adminname','$adminmobile','$adminpass')";
    $resultquery = setData($conn,$admininsertquery);

    if($resultquery == "Record created"){
        $jsonresponse = array('code'=>'200','status'=>'success');  
    }
    else{
        $jsonresponse = array('code'=>'400','status'=>'fail');  
    }
    echo json_encode($jsonresponse);
}


function adminloginbyid($conn){
    global $adminid,$adminpass;

    $selectquery = "SELECT * FROM `admins` WHERE adminid='$adminid' and admin_password='$adminpass'";
    $resultquery = getData($conn,$selectquery);
    if(count($resultquery) > 0){
        $jsonresponse = array('code'=>'200','status'=>'success','data'=>$resultquery);  
    }
    else{
        $jsonresponse = array('code'=>'400','status'=>'fail');  
    }
    echo json_encode($jsonresponse);
}


function adminloginbymobile($conn){
    global $adminmobile,$adminpass;

    $selectquery = "SELECT * FROM `admins` WHERE admin_mobile='$adminmobile' and admin_password='$adminpass'";
    $resultquery = getData($conn,$selectquery);
    if(count($resultquery) > 0){
        $jsonresponse = array('code'=>'200','status'=>'success','data'=>$resultquery);  
    }
    else{
        $jsonresponse = array('code'=>'400','status'=>'fail');  
    }
    echo json_encode($jsonresponse);
}



?>
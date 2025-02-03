<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('config.php');
include('dblayer.php');


$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata,true);
$load = $data['load'];
$cid = $data['customerid'] ?? "";
$fromdate = $data['fromdate'] ?? "";
$todate = $data['todate'] ?? "";
$periodicity = $data['periodicity'] ?? "";
$foodtype = $data['foodtype'] ?? "";
$email = $data['email'] ?? "";
$foodtype = $data['foodtype'] ?? "";
$customername = $data['customername'] ?? "";
$orderdate = $data['orderdate'] ?? "";
$status = $data['status'] ?? "";
$foodtypevalue = $data['foodtypevalue'] ?? "";
$paid_amount = $data['paid_amount'] ?? "";
$paymentsno = $data['paymentsno'] ?? "";
$todaydate = $data['todaydate'] ?? "";
$new_value = $data['new_value'] ?? "";
$relatedmonth = $data['relatedmonth'] ?? "";

if($load == "load_report"){
    loadReport($conn);
}
else if($load == "load_foodtype"){
    loadfoodtype($conn);
}
else if($load == "load_status"){
    load_status($conn);
}
else if($load == "send_completed"){
    send_completed($conn);
}
else if($load == "loadpayments"){
    load_payments($conn);
}
else if($load == "update_payment"){
    update_payment($conn);
}
else if($load == "orderHistory"){
    orderHistory($conn);
}
else if($load == "paymenthistory"){
    paymentHistory($conn);
}
else if($load == "todayordersummary"){
    todayOrderSummary($conn);
}

//order summary
function todayOrderSummary($conn){
        $today = date('Y-m-d');
        $selectquery =  "SELECT
        SUM(CASE WHEN FoodTypeID = 1 THEN 1 ELSE 0 END) AS bf,
        SUM(CASE WHEN FoodTypeID = 2 THEN 1 ELSE 0 END) AS lunch,
        SUM(CASE WHEN FoodTypeID = 3 THEN 1 ELSE 0 END) AS Dinner,
        SUM(CASE WHEN Status = 1 THEN 1 ELSE 0 END) AS Pending,
        SUM(CASE WHEN Status = 2 THEN 1 ELSE 0 END) AS Delivered
        FROM (
            SELECT DISTINCT
                OrderID,
                FoodTypeID,
                Status
            FROM
                orders
            WHERE
                OrderDate = '$today'
        ) as distinct_orders";

        $resultquery = getData($conn,$selectquery);

        if(count($resultquery) > 0){
            $jsonresponse = array('code' => '200','status' => "Success",'data'=>$resultquery);
        }
        else{
            $jsonresponse = array('code' => '200','status' => "Success",'data'=>'');
        }
        echo json_encode($jsonresponse); 
}


//payment history of the particular customer and particular month
function paymentHistory($conn){
    global $cid,$paymentsno,$fromdate,$todate;

    $selectquery = "select * from payments_log where payments_sno='$paymentsno'";
    $resultquery = getData($conn,$selectquery);

    if(count($resultquery) > 0){
        $jsonresponse = array('code' => '200','status' => "Success",'data'=>$resultquery);
    }
    else{
        $jsonresponse = array('code' => '200','status' => "Success",'data'=>'no data');
    }
    echo json_encode($jsonresponse); 
}



//orderhistory
function orderHistory($conn){
    global $cid,$fromdate,$todate;

    $selectquery = "SELECT fooddetails.ItemName,orders.OrderDate,orders.Quantity,orders.TotalAmount,foodtype.type
    from orders
    join fooddetails on orders.FoodID = fooddetails.OptionID
    join foodtype on orders.FoodTypeID = foodtype.sno
    where orders.CustomerID = $cid and orders.OrderDate BETWEEN '$fromdate' and '$todate' and orders.Quantity > 0
    and orders.status = 2
    ORDER by orders.OrderDate asc";

    $resultquery = getData($conn,$selectquery);

    if(count($resultquery) > 0){
        $jsonresponse = array('code' => '200','status' => "Success",'data'=>$resultquery);
    }
    else{
        $jsonresponse = array('code' => '200','status' => "Success",'data'=>'no data');
    }
    echo json_encode($jsonresponse);  
}



//function for update_payment
function update_payment($conn){
    global $cid,$fromdate,$todate,$paid_amount,$paymentsno,$todaydate,$new_value,$relatedmonth;
    $updatequery = "UPDATE `payments` SET `paid_amount`='$paid_amount',`paid_date`='$todaydate' WHERE customer_id = '$cid' AND 
    payments.from_date <= '$fromdate' 
    AND payments.to_date >= '$todate' ";
    $resultquery = setData($conn,$updatequery);
    if($resultquery == "Record created"){
        $insertquery = "INSERT INTO `payments_log`(`payments_sno`, `paid_amount`,`paid_date`,`related_month`) VALUES ('$paymentsno','$new_value','$todaydate','$relatedmonth')";
        $resultinsert = setData($conn,$insertquery);
        if($resultinsert == "Record created"){
            $jsonresponse = array('code' => '200','status' => "Success");
        }
        else{
            $jsonresponse = array('code' => '500','status' => "fail",'message'=>"fail to insertion in payments_log");
        }   
    }
    else{
        $jsonresponse = array('code' => '500','status' => "fail",);
    }
    echo json_encode($jsonresponse);       
}



//load_payments
function load_payments($conn){
    global $cid,$fromdate,$todate;

    $whereclause =($cid == "") ? "WHERE orders.OrderDate BETWEEN '$fromdate' AND '$todate'  AND orders.status = 2":
    "WHERE orders.OrderDate BETWEEN '$fromdate' AND '$todate' AND  orders.CustomerID='$cid'
    AND orders.status = 2";

      

    $selectquery = "SELECT 
    customers.CustomerName as CustomerName,
    SUM(orders.TotalAmount) AS total_amount,
    payments.sno,
    payments.paid_amount,
    payments.unpaid_amount,
    payments.customer_id,
    customers.Email,
    customers.Phone2
    FROM 
        orders
    JOIN 
        customers ON orders.CustomerID = customers.CustomerID
    LEFT JOIN 
    payments ON orders.CustomerID = payments.customer_id
	AND payments.from_date <= '$fromdate' 
    AND payments.to_date >= '$todate' 
    $whereclause
    GROUP BY 
    customers.CustomerName, payments.sno, payments.paid_amount, payments.unpaid_amount"
    ;

    $resultquery = getData($conn,$selectquery);

    if(count($resultquery) > 0){
       $jsonresponse = array('code' => '200','status' => "Success",'data'=>$resultquery);
    }
    else{
       $jsonresponse = array('code' => '200','status' => "Success",'data'=>"NO DATA");
    }

    echo json_encode($jsonresponse); 
   
}


function send_completed($conn){
    global $email,$orderdate,$foodtype,$customername,$status,$cid,$foodtypevalue;
    $randomNumber = rand(1000, 9999);
    // $token = bin2hex(random_bytes(32));
    date_default_timezone_set('Asia/Kolkata');
    // $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

    $updatequery = "UPDATE `orders` SET `Status`='$status' 
    WHERE CustomerID = '$cid' AND  OrderDate = '$orderdate' AND FoodTypeID = '$foodtypevalue'";
    $resultsql = setData($conn,$updatequery);

    if ($resultsql === "Record created") {

        $mail = new PHPMailer(true);

        try{
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nani04841@gmail.com';
            $mail->Password = 'goprfivvnxzszgom';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('nani04841@gmail.com', 'Homdedelivery');;
            $mail->addAddress($email);
            $mail->Subject = 'Order Delivered';
            $mail->Body = "Mr/Ms.$customername Your $foodtype order on $orderdate has been delivered.";

            $mail->send();
            $jsonresponse = array('code' => '200','status' => "Success");
            echo json_encode($jsonresponse);  
        }
        catch (Exception $e) {
            $jsonresponse = array('code' => '200','status' => "failed to send  OTP to mail error:'{$mail->ErrorInfo}'");
            echo json_encode($jsonresponse);  
        }

    }
    else {
        $jsonresponse = array('code' => '200','status' => "failed",'sql'=>$updatequery);
        echo json_encode($jsonresponse);  
    }

}



function loadReport($conn){
    global $fromdate, $todate, $cid, $periodicity,$foodtype;

    $x = "";
if ($foodtype == "") {
    if ($periodicity == "" && $cid == "") {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND o.Status <> '0'";
    } elseif ($periodicity !== "" && $cid == "") {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND c.Periodicity = '$periodicity' AND o.Status <> 0";
    } elseif ($periodicity == "" && $cid !== "") {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND c.CustomerID = '$cid' AND o.Status <> 0";
    } else {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND c.CustomerID = '$cid' AND c.Periodicity = '$periodicity' AND o.Status <> 0";
    }
} else {
    if ($periodicity == "" && $cid == "") {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND o.FoodTypeID = '$foodtype' AND o.Status <> '0'";
    } elseif ($periodicity !== "" && $cid == "") {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND c.Periodicity = '$periodicity' AND o.FoodTypeID = '$foodtype' AND o.Status <> 0";
    } elseif ($periodicity == "" && $cid !== "") {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND c.CustomerID = '$cid' AND o.FoodTypeID = '$foodtype' AND o.Status <> 0";
    } else {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND c.CustomerID = '$cid' AND c.Periodicity = '$periodicity' AND o.FoodTypeID = '$foodtype' AND o.Status <> 0";
    }
}


// Final SQL query
$selectsql = "
    SELECT 
        c.CustomerID AS CustomerID,
        c.CustomerName AS name,
        c.Phone3 AS BillingNumber,
        c.Email AS mail,
        o.OrderDate,
        c.Phone2 AS DeliveryNumber,
        SUM(CASE WHEN ft.Type = 'Breakfast' THEN o.TotalAmount ELSE 0 END) AS breakfast,
        SUM(CASE WHEN ft.Type = 'Lunch' THEN o.TotalAmount ELSE 0 END) AS lunch,
        SUM(CASE WHEN ft.Type = 'Dinner' THEN o.TotalAmount ELSE 0 END) AS dinner,
        SUM(o.TotalAmount) AS totalamount,
        s.Status AS status
    FROM 
        orders o
    JOIN 
        customers c ON o.CustomerID = c.CustomerID
    JOIN 
        foodtype ft ON o.FoodTypeID = ft.Sno
    JOIN 
        status s ON o.Status = s.Sno
    $x
    GROUP BY 
        c.CustomerID, c.CustomerName, c.Phone3, c.Email, o.OrderDate, 
        c.Phone2, s.Status
    ORDER BY 
        o.OrderDate ASC
";
// $selectsql = " SELECT 
//         c.CustomerID AS CustomerID,
//         c.CustomerName AS name,
//         c.Phone3 AS BillingNumber,
//         c.Email AS mail,
//         p.period AS periodicity,
//         CASE WHEN ft.Type = 'Breakfast' THEN o.TotalAmount ELSE 0 END AS breakfast,
//        	CASE WHEN ft.Type = 'Lunch' THEN o.TotalAmount ELSE 0 END AS lunch,
//        	CASE WHEN ft.Type = 'Dinner' THEN o.TotalAmount ELSE 0 END AS dinner,
//         o.TotalAmount AS totalamount,
//         s.Status AS status
//     FROM 
//         orders o
//     JOIN 
//         customers c ON o.CustomerID = c.CustomerID
//     JOIN 
//         foodtype ft ON o.FoodTypeID = ft.Sno
//     JOIN 
//         status s ON o.Status = s.Sno
//     JOIN 
//         periodicity p ON c.Periodicity = p.sno
//    $x";

    $resultsql = getData($conn,$selectsql);
    if(count($resultsql) > 0){
        $jsonresponse = array('code' => '200', 'status' => "Success",'data'=>$resultsql,'sql'=>$selectsql);
        echo json_encode($jsonresponse);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => "fail",'data'=>'No Data');
        echo json_encode($jsonresponse);
    }
    

}

//load foodtype
function loadfoodtype($conn){

    $selectquery = "SELECT * FROM `foodtype`";
    $resultquery = getData($conn,$selectquery);

    if(count($resultquery) > 0){
        $jsonresponse = array('code' => '200', 'status' => "Success",'data'=>$resultquery);
        echo json_encode($jsonresponse);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => "fail",'data'=>'No Data');
        echo json_encode($jsonresponse);
    }
}

//load status
function load_status($conn){
    $selectquery = "SELECT * FROM `status`";
    $restulstatus = getData($conn,$selectquery);

    if(count($restulstatus) > 0){
        $jsonresponse = array('code' => '200', 'status' => "Success",'data'=>$restulstatus);
        echo json_encode($jsonresponse);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => "fail",'data'=>'No Data');
        echo json_encode($jsonresponse);
    }
}


?>



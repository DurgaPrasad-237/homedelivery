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
$paiddate = $data['paiddate'] ?? "";
$previousmonth = $data['previousmonth'] ?? "";
$thismonth = $data['thismonth'] ?? "";
$tablename = $data['tablename'] ?? "";

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
else if($load == "pendings"){
    pendings($conn);
}
else if($load == "load_pending_month_report"){
    loadPendingMonthsReport($conn);
}
else if($load == "infopendings"){
    infopendings($conn);
}
else if($load == "checkcurrysetitems"){
    checkcurrysetitems($conn);
}


function checkcurrysetitems($conn){
    global $orderdate,$tablename;
    $sql = "SELECT subcategory.subcategory,fooddetails.ItemName,lunchschedule.FoodID from lunchschedule
    join fooddetails on lunchschedule.FoodID = fooddetails.OptionID
    join subcategory on fooddetails.subcategory = subcategory.SNO
    where lunchschedule.Date = '$orderdate'";
    $resultsql = getData($conn,$sql);
    if(count($resultsql) > 0){
         $jsonresponse = array('code' => '200','status' => "Success",'data'=>$resultsql);
    }
    else{
        $jsonresponse = array('code' => '200','status' => "Success",'data'=>'');
    }
    echo json_encode($jsonresponse); 

}


function infopendings($conn){
    global $cid;
    $sql = "SELECT from_date,total_amount,unpaid_amount,paid_amount FROM `payments` WHERE customer_id = $cid and unpaid_amount > 0";
    $result = getData($conn,$sql);
    $modifiedResult = [];
    if(count($result) > 0){
        foreach($result as $rs){
            $dateObj = DateTime::createFromFormat('Y-m-d', $rs['from_date']);
            $formattedDate = strtoupper($dateObj->format('M-Y'));

            $modifiedResult[] = [
                'monthyear'    => $formattedDate,
                'total_amount'  => $rs['total_amount'],
                'unpaid_amount' => $rs['unpaid_amount'],
                'paid_amount' => $rs['paid_amount']
            ];
        }
        $jsonresponse = array('code' => '200','status' => "Success",'data'=>$modifiedResult);
    }
    echo json_encode($jsonresponse); 
}

//loadPendingMonthsReport
function loadPendingMonthsReport($conn){
    global $fromdate,$todate,$thismonth;
        $selectquery = "SELECT 
            customers.CustomerName AS CustomerName,
            customers.CustomerID AS CustomerID,
            customers.Email AS Email,
            customers.Billing_Phonenumber AS Billingnumber,
            SUM(payments.unpaid_amount) AS total_unpaid, 
            SUM(payments.total_amount) AS total_amount, 
            SUM(payments.paid_amount) AS total_paid
            FROM payments
            JOIN customers ON payments.customer_id = customers.CustomerID
            WHERE payments.customer_id IN (
            -- Get customers who had unpaid records in Dec 2024
            SELECT DISTINCT payments.customer_id 
            FROM payments 
            WHERE payments.unpaid_amount > 0
            AND payments.from_date >= '$fromdate' 
            AND payments.from_date < '$todate'  
            )
            AND payments.unpaid_amount > 0  
            AND payments.from_date >= '$fromdate' 
            AND payments.from_date < '$todate' 
            GROUP BY payments.customer_id
            ORDER BY payments.unpaid_amount desc"; 
    $resultquery = getData($conn,$selectquery);

    if(count($resultquery) > 0){
        $jsonresponse = array('code' => '200','status' => "Success",'data'=>$resultquery,);
    }
    else{
        $jsonresponse = array('code' => '200','status' => "Success",'data'=>'','msg'=>'No Pending');
    }
    echo json_encode($jsonresponse); 
}

//pendings
function pendings($conn){
    global $todaydate;

    $selectquery = "
        SELECT
 		customers.CustomerName AS CustomerName,
        customers.CustomerID AS CustomerID,
        customers.Email as Email,
        customers.Billing_Phonenumber as Billingnumber,
       SUM(payments.unpaid_amount) AS total_unpaid, 
       SUM(payments.total_amount) AS total_amount, 
       SUM(payments.paid_amount) AS total_paid
      
        FROM payments
        join customers on payments.customer_id = customers.CustomerID
        WHERE payments.customer_id IN (
            SELECT payments.customer_id 
            FROM payments 
            WHERE payments.unpaid_amount > 0
            AND payments.from_date < '$todaydate' 
        )
        AND payments.unpaid_amount > 0  
        GROUP BY payments.customer_id
    ";

    $resultsql = getData($conn,$selectquery);

    if(count($resultsql) > 0){
        $jsonresponse = array('code' => '200','status' => "Success",'data'=>$resultsql);
    }
    else{
        $jsonresponse = array('code' => '200','status' => "Success",'data'=>'');
    }
    echo json_encode($jsonresponse); 
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
                OrderDate = '$today' AND
                `Status` != 0
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

    $selectquery = "SELECT fooddetails.ItemName,subcategory.subcategory,orders.OrderDate,orders.Quantity,orders.TotalAmount,foodtype.type,
    foodtype.sno
    from orders
    join fooddetails on orders.FoodID = fooddetails.OptionID
    join foodtype on orders.FoodTypeID = foodtype.sno
    join subcategory on fooddetails.subcategory = subcategory.SNO
    where orders.CustomerID = $cid and orders.OrderDate BETWEEN '$fromdate' and '$todate' and orders.Quantity > 0
    and orders.status = 2
    ORDER by foodtype.sno asc,orders.OrderDate asc";

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
    global $cid,$fromdate,$todate,$paid_amount,$paymentsno,$todaydate,$new_value,$relatedmonth,$paiddate;
    $updatequery = "UPDATE `payments` SET `paid_amount`='$paid_amount',`paid_date`='$paiddate' WHERE customer_id = '$cid' AND 
    payments.from_date <= '$fromdate' 
    AND payments.to_date >= '$todate' ";
    $resultquery = setData($conn,$updatequery);
    if($resultquery == "Record created"){
        $insertquery = "INSERT INTO `payments_log`(`payments_sno`, `paid_amount`,`paid_date`,`related_month`) VALUES ('$paymentsno','$new_value','$paiddate','$relatedmonth')";
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
    customers.Billing_Phonenumber AS BillingNumber
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
        $result = payments($cid,$orderdate,$foodtypevalue,$conn);

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

function payments($cid,$orderdate,$foodtypeID,$conn){

    if ($orderdate instanceof DateTime) {
        $orderdate = $orderdate->format('Y-m-d');
    } else {
        $orderdate = date_create($orderdate)->format('Y-m-d');
    }
    
    $ordermonth = date('m', strtotime($orderdate)); 
    $orderyear = date('Y', strtotime($orderdate));
    
    $fromdate_obj = date_create("$orderyear-$ordermonth-1");
    $fromdate = date_format($fromdate_obj, 'Y-m-d'); 
    $todate = date_format($fromdate_obj->modify('last day of this month'), 'Y-m-d');
    


    $checkquery = "select * from payments where customer_id='$cid' and from_date='$fromdate' and to_date='$todate'";
    $resultcheck = getData($conn,$checkquery);

   
    
    if(count($resultcheck) > 0){
        $previous_totalamount = $resultcheck[0]['total_amount'];
            $total_payment_query = "
             SELECT SUM(orders.TotalAmount) AS TotalAmount
            FROM orders
            JOIN foodtype ON orders.FoodTypeID = foodtype.sno
            JOIN customers ON orders.CustomerID = customers.CustomerID
            WHERE orders.OrderDate =  '$orderdate'
            AND orders.CustomerID = $cid AND orders.status = 2 AND orders.FoodTypeID = '$foodtypeID'";
    
        // Fetch the total payment amount
        $result_tp = getData($conn, $total_payment_query);
        $today_amount = $result_tp[0]['TotalAmount'] ?? 0;

        $total_payment = intval($previous_totalamount) + intval($today_amount);
    
        $updatepayments = "
            UPDATE payments 
            SET total_amount = $total_payment
            WHERE from_date = '$fromdate' 
              AND to_date = '$todate' 
              AND customer_id = $cid";
        
        // Execute the update query
        $result_update = setData($conn, $updatepayments);

        if($result_update == "Record created"){
            return "success";
        }
        else{
            return "fail";
        }
    }
    else{
               $total_payment_query = "
            SELECT SUM(orders.TotalAmount) AS TotalAmount
            FROM orders
            JOIN foodtype ON orders.FoodTypeID = foodtype.sno
            JOIN customers ON orders.CustomerID = customers.CustomerID
            WHERE orders.OrderDate =  '$orderdate'
            AND orders.CustomerID = $cid AND orders.status = 2";
    
        // Fetch total payment
        $result_tp = getData($conn, $total_payment_query);
    
        if (count($result_tp) > 0) {
            $total_payment = $result_tp[0]['TotalAmount'] ?? 0;
    
            $insertquery = "
                INSERT INTO payments (customer_id, from_date, to_date, total_amount)
                VALUES ($cid, '$fromdate', '$todate', $total_payment)";
            
            // Execute the insert query
            $result_insert = setData($conn, $insertquery);

            if($result_insert == "Record created"){
                return "success";
            }
            else{
                return "fail";
            }
        }
    } 
}



function loadReport($conn){
    global $fromdate, $todate, $cid, $periodicity,$foodtype;

    $x = "";
if ($foodtype == "") {
    if ($periodicity == "" && $cid == "") {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND o.Status <> '0'";
    } elseif ($periodicity !== "" && $cid == "") {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate'  AND o.Status <> 0";
    } elseif ($periodicity == "" && $cid !== "") {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND c.CustomerID = '$cid' AND o.Status <> 0";
    } else {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND c.CustomerID = '$cid'  AND o.Status <> 0";
    }
} else {
    if ($periodicity == "" && $cid == "") {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND o.FoodTypeID = '$foodtype' AND o.Status <> '0'";
    } elseif ($periodicity !== "" && $cid == "") {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND o.FoodTypeID = '$foodtype' AND o.Status <> 0";
    } elseif ($periodicity == "" && $cid !== "") {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND c.CustomerID = '$cid' AND o.FoodTypeID = '$foodtype' AND o.Status <> 0";
    } else {
        $x = "WHERE o.OrderDate BETWEEN '$fromdate' AND '$todate' AND c.CustomerID = '$cid' AND o.FoodTypeID = '$foodtype' AND o.Status <> 0";
    }
}


// Final SQL query
$selectsql = "
    SELECT 
        c.CustomerID AS CustomerID,
        c.CustomerName AS name,
        c.Billing_Phonenumber AS BillingNumber,
        c.Email AS mail,
        o.OrderDate,
        c.Delivery_Phonenumber AS DeliveryNumber,
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
        c.CustomerID, c.CustomerName, c.Delivery_Phonenumber, c.Email, o.OrderDate, 
        c.Billing_Phonenumber, s.Status
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



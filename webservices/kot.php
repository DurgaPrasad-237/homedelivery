<?php

include('config.php');
include('dblayer.php');


$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata,true);
$load = $data['load'];


if($load == "load_foodtype"){
    loadfoodtype($conn);
}
elseif ($load == "load_orders") {
    loadOrders($conn, $data);
}
elseif ($load == "update_print_status") {
    updatePrintStatus($conn, $data);
}
elseif ($load == "updateDeliveryBoy") {
    updateDeliveryBoy($conn, $data);
}



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



function loadOrders($conn, $data) {
    $date = $data['date'];
    $foodtype = $data['foodtype'];

    $query = "SELECT 
    o.OrderID, 
    c.CustomerName, 
    c.Phone1 as Phone3,  
    o.OrderDate, 
    f.type AS food_type, 
    fd.ItemName,
    o.Quantity, 
    o.TotalAmount,
    CONCAT(Delivery_Flatno,' ',Delivery_Street,' ',Delivery_Area,' ',Delivery_Landmark) as DeliveryAddress,
    c.Delivery_Landmark as Landmark,
    o.Print,
    o.DeliveryPersonID, 
    -- Fetch Delivery Boys Per Order Date from deliveryinfo
    GROUP_CONCAT(DISTINCT di.ID ORDER BY di.ID) AS DeliveryBoyIDs,
    GROUP_CONCAT(DISTINCT di.Name ORDER BY di.ID) AS DeliveryBoyNames,
    GROUP_CONCAT(DISTINCT di.Contact ORDER BY di.ID) AS DeliveryBoyContacts
    FROM 
    orders o
    JOIN 
    customers c ON o.CustomerID = c.CustomerID 
    JOIN 
    foodtype f ON o.FoodTypeID = f.sno 
    JOIN 
    fooddetails fd ON fd.OptionID = o.FoodID
    LEFT JOIN 
    deliveryschedule d ON DATE(d.Date) = o.OrderDate  -- Ensure Date Matching
    LEFT JOIN 
    deliveryinfo di ON d.ID = di.ID  -- Fetch delivery boy details from deliveryinfo
    WHERE 
    o.OrderDate = '$date'  
    AND o.Quantity <> 0
    AND o.FoodTypeID = '$foodtype'
    GROUP BY 
    o.OrderID, c.CustomerName, c.Phone1, o.OrderDate, f.type, fd.ItemName, 
    o.Quantity, o.TotalAmount, c.Delivery_Landmark, o.Print, o.DeliveryPersonID
    ORDER BY 
    o.OrderID, f.type";

    $resultquery = getData($conn, $query);

    if (count($resultquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => "Success", 'data' => $resultquery);
    } else {
        $jsonresponse = array('code' => '200', 'status' => "fail", 'data' => 'No Data');
    }

    echo json_encode($jsonresponse);
}




function updatePrintStatus($conn, $data) {
    $orderId = $data['orderId'];

    if (!$orderId) {
        echo json_encode(array('code' => '400', 'status' => 'Invalid Request'));
        return;
    }

    $updateQuery = "UPDATE `orders` SET `Print` = 1 WHERE `OrderID` = '$orderId'";
    $result = setData($conn, $updateQuery);

    if ($result) {
        echo json_encode(array('code' => '200', 'status' => 'Success'));
    } else {
        echo json_encode(array('code' => '500', 'status' => 'Error updating print status'));
    }
}


function updateDeliveryBoy($conn, $data) {
    $orderId = $data['orderId'];
    $deliveryBoyId = $data['deliveryBoyId'];

    if (!$orderId || !$deliveryBoyId) {
        echo json_encode(array('code' => '400', 'status' => 'Invalid Request'));
        return;
    }

    // Ensure correct column name (DeliveryPersonID)
    $updateQuery = "UPDATE `orders` SET `DeliveryPersonID` = '$deliveryBoyId' WHERE `OrderID` = '$orderId'";
    $result = setData($conn, $updateQuery);

    if ($result) {
        echo json_encode(array('code' => '200', 'status' => 'Success'));
    } else {
        echo json_encode(array('code' => '500', 'status' => 'Error updating delivery boy assignment'));
    }
}






?>
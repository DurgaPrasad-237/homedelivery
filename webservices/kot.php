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
elseif($load == "load_orderitems"){
    loadOrdersforitems($conn, $data);
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
    o.OrderID, f.type;
    ";

    $resultquery = getData($conn, $query);

    if (count($resultquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => "Success", 'data' => $resultquery);
    } else {
        $jsonresponse = array('code' => '200', 'status' => "fail", 'data' => 'No Data');
    }

    echo json_encode($jsonresponse);
}


function loadOrdersforitems($conn, $data) {
    global $pappu, $pachadi, $pulusu, $fry, $curry, $rice, $curd, $curryset, $meals, $mealsnc, $bf, $dn, $ln;

    $date = $data['date'];
    $foodtype = $data['foodtype'];

    $query = "SELECT 
        o.OrderID, 
        o.OrderDate, 
        f.type AS food_type, 
        fd.ItemName, 
        o.Quantity 
    FROM 
        orders o
    JOIN 
        customers c ON o.CustomerID = c.CustomerID 
    JOIN 
        foodtype f ON o.FoodTypeID = f.sno 
    JOIN 
        fooddetails fd ON fd.OptionID = o.FoodID
    WHERE 
        o.OrderDate = '$date'  
        AND o.Quantity <> 0
        AND o.FoodTypeID = '$foodtype'
    ORDER BY 
        o.OrderID, f.type;
    ";

    $resultquery = getData($conn, $query);

    $bf = $ln = $dn = 0;
    $meals = $mealsnc = $curryset = 0;
    $curry = $pappu = $pachadi = $pulusu = $fry = $curd = $rice = 0;

    if (count($resultquery) > 0) {
        foreach ($resultquery as $row) {
            $food_type = strtolower($row['food_type']);
            $item_name = strtolower($row['ItemName']);
            $quantity = (int)$row['Quantity'];

            if ($food_type === "breakfast") {
                $bf += $quantity;
            } elseif ($food_type === "lunch") {
                $ln += $quantity;
            } elseif ($food_type === "dinner") {
                $dn += $quantity;
            }
 
            if (strpos($item_name, "meals/nc") !== false) {
                $mealsnc += $quantity;
                $curry += $quantity;
                $pappu += $quantity;
                $pachadi += $quantity;
                $pulusu += $quantity;
                $fry += $quantity;
                $rice += $quantity;
            }

            if (strpos($item_name, "curryset") !== false) {
                $curryset += $quantity;
                $curry += $quantity;
                $pappu += $quantity;
                $pachadi += $quantity;
                $pulusu += $quantity;
                $fry += $quantity;
            }

            if ($item_name === "curry") {
                $curry += $quantity;
            }
            if ($item_name === "pappu") {
                $pappu += $quantity;
            }
            if ($item_name === "pachadi") {
                $pachadi += $quantity;
            }
            if ($item_name === "pulusu") {
                $pulusu += $quantity;
            }
            if ($item_name === "fry") {
                $fry += $quantity;
            }
            if ($item_name === "curd") {
                $curd += $quantity;
            }
            if ($item_name === "rice") {
                $rice += $quantity;
            }
        }

        $jsonresponse = array(
            'code' => '200', 
            'status' => "Success", 
            'data' => array(
                'Breakfast' => $bf,
                'Lunch' => $ln,
                'Dinner' => $dn,
                'Meals' => $meals,
                'Meals/Nc' => $mealsnc,
                'Curryset' => $curryset,
                'Curry' => $curry,
                'Pappu' => $pappu,
                'Pachadi' => $pachadi,
                'Pulusu' => $pulusu,
                'Fry' => $fry,
                'Curd' => $curd,
                'Rice' => $rice
            )
        );
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
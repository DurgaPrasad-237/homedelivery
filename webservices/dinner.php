<?php
include('config.php');
include('dblayer.php');

$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata, true);

$datalunch = $data['datalunch'] ?? "";
$load = $data['load'] ?? "";
$sno = $data["sno"] ?? "";
$day = $data["day"] ?? "";
$cid = $data["cid"] ?? "";
$reason = $data["reason"] ?? "";
$ordertype = $data["category"] ?? "";
$totalamount = $data["totalAmount"] ?? "";
$quantity = $data["quantity"] ?? "";
$dates = $data['dates'] ?? [];
$fromdate = $data["fromdate"] ?? "";
$todate = $data["todate"] ?? "";
$orderid = $data["orderid"] ?? "";
$foodid = $data["foodid"] ?? "";
$itemname= $data["itemname"] ??"";
$price = $data["price"] ??"";
$status = $data["status"] ?? "";
$map = $data["map"] ?? "";
$email = $data["email"] ?? "";
$periodicity = $data["periodicity"] ?? "";
$primaryphone = $data["primaryphone"] ?? "";
$billingaddress = $data["billingaddress"] ?? "";
$deliveryaddress = $data["deliveryaddress"] ?? "";
$customername = $data["customername"] ?? "";
$deliverymobile = $data["deliverymobile"] ?? "";
$billingmobile = $data["billingmobile"] ?? "";
$items = $data['items'] ?? "";
$foodtype = $data['foodtype'] ?? "";
$orders = $data['orders'] ?? "";
$date = $data['date'] ?? "";
$data = $data['data'] ?? "";
$order = $data['order'] ?? "";



if ($load == "loadcategory") {
    loadcat($conn);
} else if ($load == "fetchitems") {
    fetchitems($conn);
} else if ($load == "getitems") {
    getitems($conn);
} else if ($load == "fetchorderb") {
    fetchorderb($conn);
} else if ($load == "fetchorderd") {
    fetchorderd($conn);
} else if ($load == "updateQuantity") {
    updateQuantity($conn);
} else if ($load == "lunchdetails") {
    lunchdetails($conn);
} elseif ($load == "fetch") {
    getall($conn);
} elseif ($load == "fetchadditems") {
    getadditems($conn);
} elseif($load=="fetchorderl"){
    fetchorderl($conn);
}
elseif($load == "insertnew"){
    insertnew($conn);
}
else if($load == "todayorder"){
    todayorder($conn);
}
else if ($load == "setitemsb") {
    setitemsb($conn);
} else if ($load == "setitemsd") {
    setitemsd($conn);
} 
elseif($load == "fetchheader"){
    fetchheader($conn);
}
elseif($load == "fetchOrders"){
    fetchOrders($conn);
}
elseif($load == "linsert"){
    lunchinsert($conn);
}
elseif($load == "updatelunch"){
    updatelunch($conn);
}
else if($load == "fetchitemsb") {
    fetchitemsb($conn);
} else if ($load == "getitemsb") {
    getitemsb($conn);
}
elseif($load == "nlunch"){
    nlunch($conn);
}
else if($load == "datechange"){
    loadQuantity($conn);
}
else if($load == "fetchQuantities"){
    fetchQuantities($conn);
}
else if($load == "statuscheck"){
    statuscheck($conn);
}

function statuscheck($conn){
    global $fromdate,$todate,$foodtype,$cid;
    $selectQuery = "SELECT Status FROM orders WHERE FoodTypeID = '$foodtype' AND OrderDate BETWEEN '$fromdate' AND '$todate' AND CustomerID = '$cid'";
    $result = getdata($conn, $selectQuery);

    if (count($result) > 0) {
        echo json_encode([
            'code' => '200',
            'status' => 'success',
            'data' => $result
        ]);
    } else {
        echo json_encode([
            'code' => '204',
            'status' => 'error',
            'message' => 'Fetched'
        ]);
    }

}


function fetchQuantities($conn) {
    // Ensure customer ID is available in session or passed dynamically
    global $cid,$date; // Assuming $cid is set globally
   

    // Query to fetch today's quantities for a specific customer and food type
    $sql = "SELECT 
                o.OrderDate AS Date,
                i.OptionID AS OptionID,
                i.ItemName AS ItemName,
                o.Quantity AS Quantity,
                i.Price AS Price
            FROM 
                orders o
            INNER JOIN 
                fooddetails i ON o.FoodID = i.OptionID
            WHERE 
                o.CustomerID = $cid 
                AND o.FoodTypeID = 2 
                AND o.OrderDate = '$date'
            ORDER BY 
                i.OptionID ASC";

    // Execute the query and fetch results
    $result = getdata($conn, $sql);

    // Return the response as JSON
    if (count($result) > 0) {
        echo json_encode([
            'code' => '200',
            'status' => 'success',
            'data' => $result
        ]);
    } else {
        echo json_encode([
            'code' => '204',
            'status' => 'error',
            'message' => $date
        ]);
    }
}

function nlunch($conn) {
    global $totalamount, $cid, $dates, $foodtype, $items;

    if (empty($dates)) {
        echo json_encode(['code' => '400', 'status' => 'error', 'message' => "Date range is missing"]);
        return;
    }

    // Prepare response data for alert
    $responseDetails = [
        'fromDate' => $dates[0],  // Assuming dates[0] is the start date
        'toDate' => end($dates),   // Assuming the last date in dates is the end date
        'items' => []
    ];

    // Start transaction for bulk operations
    mysqli_begin_transaction($conn);

    // Collect item details only once
    foreach ($items as $ld) {
        $foodid = $ld['foodid'];
        $quantity = (int)$ld['quantity'];
        $price = (float)$ld['price'];
        $totalamount = $price * $quantity;

        // Add item details to response array
        if ($quantity > 0) {
            $responseDetails['items'][] = [
                'itemname' => $ld['itemname'],
                'quantity' => $quantity
            ];
        }

        // Insert or update order and food items for each date
        foreach ($dates as $date) {
            // Check if an order already exists for the given date and customer
            $cdquery = "SELECT OrderID FROM orders WHERE OrderDate = '$date' AND FoodTypeID = $foodtype AND CustomerID = $cid";
            $cdresult = getData($conn, $cdquery);

            if ($cdresult && count($cdresult) > 0) {
                // Order already exists, so update it
                $orderid = $cdresult[0]['OrderID'];

                // Check if the food item already exists in the order
                $checkfoodid = "SELECT OrderID FROM orders WHERE OrderID = '$orderid' AND FoodID = '$foodid'";
                $resultcheckfoodid = getData($conn, $checkfoodid);

                if (count($resultcheckfoodid) > 0) {
                    // Update the existing food item in the order
                    $updatequery = "UPDATE orders SET TotalAmount = '$totalamount', Quantity = '$quantity', Status = '1' 
                                    WHERE OrderID = '$orderid' AND FoodID = '$foodid'";
                    setData($conn, $updatequery);
                } else {
                    // Insert the new food item if it doesn't exist
                    $insertquery = "INSERT INTO orders (OrderID, CustomerID, OrderDate, FoodTypeID, TotalAmount, Status, Quantity, CategoryID, FoodID) 
                                    VALUES ('$orderid', '$cid', '$date', '$foodtype', '$totalamount', '1', '$quantity', '1', '$foodid')";
                    setData($conn, $insertquery);
                }
            } else {
                // No order exists, so create a new one
                $querylastorderid = "SELECT COALESCE(MAX(OrderID), 0) + 1 AS orderid FROM orders";
                $resultorderid = getData($conn, $querylastorderid);
                $orderid = $resultorderid[0]['orderid'];

                // Insert the food item into the new order
                $insertquery = "INSERT INTO orders (OrderID, CustomerID, OrderDate, FoodTypeID, TotalAmount, Status, Quantity, CategoryID, FoodID) 
                                VALUES ('$orderid', '$cid', '$date', '$foodtype', '$totalamount', '1', '$quantity', '1', '$foodid')";
                setData($conn, $insertquery);
            }

            // Log the action (insert or update)
            $logQuery = "INSERT INTO logs (CustomerID, OrderID, Quantity, Price, FoodType) 
                         VALUES ('$cid', '$orderid', '$quantity', '$price', '$foodtype')";
            setData($conn, $logQuery);

            // Process payment
            payments($cid, $date, $conn);
        }
    }

    // Commit transaction
    mysqli_commit($conn);

    // Send a success response with item details
    echo json_encode([
        'code' => '200',
        'status' => 'success',
        'message' => 'Order placed successfully',
        'fromDate' => $responseDetails['fromDate'],
        'toDate' => $responseDetails['toDate'],
        'items' => $responseDetails['items']
    ]);
}







function updatelunch($conn)
{
    global $date, $foodid, $cid, $foodtype, $reason, $datalunch, $quantity, $status, $price;


    $checkdata = "SELECT * FROM orders WHERE OrderDate = '$date' AND FoodTypeID = $foodtype AND CustomerID = $cid";
    $cdresult = getData($conn, $checkdata);

    if (count($cdresult) > 0) {
        $selectorderid = "SELECT OrderID FROM orders WHERE OrderDate = '$date' AND FoodTypeID = $foodtype AND CustomerID = $cid";
        $resultorderid = getData($conn, $selectorderid);
        $orderid = $resultorderid[0]['OrderID'];

        foreach ($datalunch as $ld) {
            $foodid = $ld['foodid'];
            $quantity = $ld['quantity'];
            $price = $ld['price'];
            $totalamount = $price * $quantity;

            $checkfoodid = "SELECT OrderID FROM orders WHERE OrderDate = '$date' 
                            AND FoodTypeID = $foodtype AND CustomerID = $cid AND FoodID = $foodid";
            $resultcheckfoodid = getData($conn, $checkfoodid);

            if (count($resultcheckfoodid) > 0) {
                $newStatus = $quantity == 0 ? 0 : 1;
                $updatequery = "UPDATE orders SET TotalAmount = '$totalamount', Quantity = '$quantity', Status = '$newStatus' 
                                WHERE CustomerID = $cid AND FoodID = $foodid AND OrderID = $orderid";
                $updateresult = setData($conn, $updatequery);

                if ($updateresult == "Record created") {
                    $logQuery = "INSERT INTO logs(CustomerID, OrderID, Quantity, Price, FoodType, Reason) 
                                 VALUES ('$cid', '$orderid', '$quantity', '$totalamount', '$foodtype', '$reason')";
                    setData($conn, $logQuery);

                   $result = payments($cid,$date,$conn);

                    $jsonresponse = ['code' => '200', 'status' => 'success', 'message' => 'Order Updated Successfully'];
                }
            } else {
                $insertquery = "INSERT INTO orders (OrderID, CustomerID, OrderDate, FoodTypeID, TotalAmount, Status, Quantity, CategoryID, FoodID) 
                                VALUES ('$orderid', '$cid', '$date', '$foodtype', '$totalamount', '1', '$quantity', '1', '$foodid')";
                $resultquery = setData($conn, $insertquery);
                if ($resultquery == "Record created") {
                    $logQuery = "INSERT INTO logs(CustomerID, OrderID, Quantity, Price, FoodType) 
                    VALUES ('$cid', '$orderid', '$ld[quantity]', '$totalamount', '$foodtype')";
                    setData($conn, $logQuery);
                    $result = payments($cid,$date,$conn);
                    $jsonresponse = array('code' => '500', 'status' => 'success', 'message' => "Order Placed Succesfully", $date, $foodtype, $resultorderid, $insertquery);
                } else {
                    $jsonresponse = array('code' => '500', 'status' => 'error', 'message' => "no data there", $date, $foodtype, $resultorderid, $datalunch);
                }
            }
        }
    } else {
        $querylastorderid = "SELECT COALESCE(MAX(OrderId), 0) + 1 AS orderid FROM orders";
        $resultorderid = getData($conn, $querylastorderid);
        $orderid = $resultorderid[0]['orderid'];

        foreach ($datalunch as $ld) {
            $foodid = $ld['foodid'];
            $quantity = $ld['quantity'];
            $price = $ld['price'];
            $totalamount = $price * $quantity;

            $insertquery = "INSERT INTO orders (OrderID, CustomerID, OrderDate, FoodTypeID, TotalAmount, Status, Quantity, CategoryID, FoodID) 
                            VALUES ('$orderid', '$cid', '$date', '$foodtype', '$totalamount', '1', '$quantity', '1', '$foodid')";
            setData($conn, $insertquery);

            $logQuery = "INSERT INTO logs(CustomerID, OrderID, Quantity, Price, FoodType) 
                         VALUES ('$cid', '$orderid', '$quantity', '$totalamount', '$foodtype')";
            setData($conn, $logQuery);
            $result = payments($cid,$date,$conn);
        }
        $jsonresponse = ['code' => '200', 'status' => 'success', 'message' => 'Order Placed Successfully'];
    }

    echo json_encode($jsonresponse);
}


// updating lunch quantity in the regiter
function lunchinsert($conn){
    global $data, $cid;
 $skippedRecords = [];
    $insertedRecords = false;
    foreach ($data as $record) {
        $date = $record['Date'];
        $quantity = $record['Quantity'];
        $price = $record['Price'];
        $optionid = $record['OptionID'];
        $foodtypeid = $record['foodtypeid'];
        $cid = $record['cid'];
        


        // Skip if quantity is 0 or less
        if ($quantity <= 0) {
            continue;
        }

        // Check for existing record
        $checkquery = "SELECT * FROM `orders` WHERE `OrderDate` = '$date' AND `FoodID` = '$optionid' AND `FoodTypeID`='$foodtypeid' AND `CustomerID`='$cid'";
        $result = getData($conn, $checkquery);

        if (!empty($result)) {
            $skippedRecords[] = $date; // Track skipped dates
            continue;
        }

        // Insert new record
        $insertquery = "INSERT INTO `orders` (`CustomerID`, `FoodTypeID`, `TotalAmount`, `Quantity`, `OrderDate`, `Status`, `CategoryID`, `FoodID`) 
                        VALUES ('$cid', '$foodtypeid', '$price' * '$quantity', '$quantity', '$date', '1', '1', '$optionid')";
        $resultquery  = setData($conn, $insertquery);
        if ($resultquery) {
            $lastReceiptId = mysqli_insert_id($conn);
            $insertedRecords = true;
;            $insertquery = "INSERT INTO logs(CustomerID, OrderID, Quantity, Price, FoodType) VALUES ('$cid','$lastReceiptId','$quantity','$price' * '$quantity','$foodtypeid')";
            $resultquery  = setData($conn, $insertquery);
        }
      
    }

    // Determine the response message based on the conditions
    if (!empty($skippedRecords) && $insertedRecords) {
        $responseMessage = "Orders placed with new data";
    } elseif (!empty($skippedRecords)) {
        $responseMessage = "Order already exists";
    } elseif ($insertedRecords) {
        $responseMessage = "Order Placed Successfully";
    } else {
        $responseMessage = "No valid records to process";
     }

    // // Return the response as JSON
    $jsonresponse = array('code' => '200', 'status' => 'success', 'message' => $responseMessage);
    echo json_encode($jsonresponse);
}


function fetchOrders($conn) {
    $sql = "
        SELECT 
            o.Orderdate AS date, 
            f.OptionID AS optionid, 
            o.quantity 
        FROM 
            orders o
        JOIN 
            fooddetails f 
        ON 
            o.FoodTypeID = f.OptionID;
    "; 
    
    // Execute the query
    $result = getdata($conn, $sql);
    
    if ($result) {
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $result);
    } else {
        $jsonresponse = array('code' => '500', 'status' => 'error', 'message' => 'Failed to fetch data');
    }

    // Return the JSON response
    echo json_encode($jsonresponse);
}

function fetchheader($conn)
{
    // Query to fetch data
    $sql =" SELECT * FROM fooddetails WHERE Category=2 and activity = 1;";
    $result = getdata($conn, $sql);

    // Build JSON response
    if (is_array($result) && !empty($result)) {
        $jsonresponse = array(
            'code' => 200,
            'status' => 'success',
            'data' => $result
        );
    } else {
        $jsonresponse = array(
            'code' => 204,
            'status' => 'error',
            'message' => 'No items found'
        );
    }

    // Log any SQL errors for debugging
    if (!$result) {
        error_log('SQL Error: ' . $conn->error);
    }

    // Set response headers and output JSON
    header('Content-Type: application/json');
    echo json_encode($jsonresponse);
}


// function setitemsb($conn)
// {
//     global $cid, $ordertype, $totalamount, $quantity, $dates, $foodid, $day;

//     if (empty($dates)) {
//         $jsonresponse = array('code' => '400', 'status' => 'error', 'message' => "Date range is missing");
//         echo json_encode($jsonresponse);
//         return;
//     }

//     $existingDates = [];
//     $newDates = [];
//     $insertedDates = [];

//     // Check for existing dates
//     foreach ($dates as $date) {
//         $checkquery = "SELECT * FROM `orders` WHERE `CustomerID` = '$cid' AND `OrderDate` = '$date' AND `FoodTypeID` = '$ordertype' AND `Quantity`<> 0";
//         $resultselectquery = getData($conn, $checkquery);
//         if (count($resultselectquery) > 0) {
//             $existingDates[] = $date;
//         } else {
//             $newDates[] = $date;
//         }
//     }

//     // Insert new records
//     foreach ($newDates as $date) {
//         $day = date('l', strtotime($date));
//         $query = "SELECT f.price AS Price, f.fd_oid AS OptionID
//                     FROM fooddetails_log f
//                     WHERE f.fd_oid = (
//                         SELECT sno 
//                         FROM week 
//                         WHERE day = '$day'
//                     )
//                     AND f.fromdate = (
//                         SELECT MAX(fromdate)
//                         FROM fooddetails_log
//                         WHERE fd_oid = (
//                             SELECT sno 
//                             FROM week 
//                             WHERE day = '$day'
//                         )
//                         AND fromdate <= '$date'
//                     );
//                     ";
//         $result = $conn->query($query);
//         if ($result && $result->num_rows > 0) {
//             $row = $result->fetch_assoc();
//             $totalamount = $row['Price'];
//             $foodid = $row['OptionID'];
//         } else {
//             $totalamount = 0; // Default to 0 if no price is found
//         }
//         $orderidquery = "SELECT COALESCE(MAX(OrderID),0)+1 AS OrderID FROM `orders`";
//         $orderidResult = $conn->query($orderidquery);
//         if ($orderidResult && $orderidResult->num_rows > 0) {
//             $row = $orderidResult->fetch_assoc();
//             $orderid = $row['OrderID'];
//         }

//         $insertquery = "INSERT INTO `orders` (`OrderID`, `CustomerID`, `FoodTypeID`, `TotalAmount`, `Quantity`, `OrderDate`, `Status`, `CategoryID`, `FoodID`) 
//                         VALUES ('$orderid','$cid', '$ordertype', '" . ($totalamount * $quantity) . "', '$quantity', '$date', '1', '1', '$foodid')";
//         $insertResult = $conn->query($insertquery);

//         if ($conn->affected_rows > 0) {
//             $logQuery = "INSERT INTO `logs`(`CustomerID`, `OrderID`, `Quantity`, `Price`, `FoodType`) 
//                          VALUES ('$cid', '$orderid', '$quantity', '" . ($totalamount * $quantity) . "', '$ordertype')";
//             setData($conn, $logQuery);
//             $result = payments($cid,$date,$conn);

//             $insertedDates[] = $date;
//         }
//     }

//     // Prepare single JSON response
//     $responseMessage = '';
//     if (!empty($existingDates)) {
//         $responseMessage .= 'Records already exist for the following dates: ' . implode(', ', $existingDates) . '. ';
//     }
//     if (!empty($insertedDates)) {
//         $responseMessage .= 'Order placed successfully for the following dates: ' . implode(', ', $insertedDates) . '.';
//     }

//     $jsonresponse = array(
//         'code' => !empty($insertedDates) ? '201' : '200',
//         'status' => !empty($insertedDates) ? 'success' : 'partial_success',
//         'message' => $responseMessage
//     );

//     echo json_encode($jsonresponse);
// }
function setitemsb($conn)
{
    global $cid, $ordertype, $totalamount, $quantity, $dates, $foodid, $day;

    if (empty($dates)) {
        $jsonresponse = array('code' => '400', 'status' => 'error', 'message' => "Date range is missing");
        echo json_encode($jsonresponse);
        return;
    }

    $existingDates = [];
    $newDates = [];
    $insertedDates = [];

    // Check for existing dates
    foreach ($dates as $date) {
        $checkquery = "SELECT * FROM `orders` WHERE `CustomerID` = '$cid' AND `OrderDate` = '$date' AND `FoodTypeID` = '$ordertype' AND `Quantity`<> 0";
        $resultselectquery = getData($conn, $checkquery);
        if (count($resultselectquery) > 0) {
            $existingDates[] = $date;
            $day = date('l', strtotime($date));
        $query = "SELECT 
            f.item_name AS ItemName, 
            f.price AS Price, 
            f.fd_oid AS OptionID, 
            1 AS category
        FROM 
            fooddetails_log f
        WHERE 
            f.fd_oid = (
                SELECT wl.optionid 
                FROM week_log wl 
                WHERE wl.weeksno = (
                    SELECT w.sno 
                    FROM week w
            WHERE w.day = DAYNAME('$date') -- Match the day name (Monday, Tuesday, etc.)
        )
          AND wl.fromdate = (
              SELECT MAX(wl_inner.fromdate) 
              FROM week_log wl_inner 
              WHERE wl_inner.weeksno = wl.weeksno
                AND wl_inner.fromdate <= '$date'
          )
    )
      AND f.fromdate = (
      SELECT MAX(f_inner.fromdate)
      FROM fooddetails_log f_inner
      WHERE f_inner.fd_oid = (
          SELECT wl.optionid 
          FROM week_log wl 
          WHERE wl.weeksno = (
              SELECT w.sno 
              FROM week w
              WHERE w.day = DAYNAME('$date') -- Match the day name (Monday, Tuesday, etc.)
          )
            AND wl.fromdate = (
                SELECT MAX(wl_inner.fromdate) 
                FROM week_log wl_inner 
                WHERE wl_inner.weeksno = wl.weeksno
                  AND wl_inner.fromdate <= '$date'
            )
      )
      AND f_inner.fromdate <= '$date'
  );
    ";
        $result = $conn->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totalamount = $row['Price'];
            $foodid = $row['OptionID'];
        }
        $orderidqueryd = "SELECT OrderID FROM `orders` WHERE `FoodID` = '$foodid' AND `CustomerID` = '$cid' AND `OrderDate` = '$date' AND `FoodTypeID` = '$ordertype' AND `Quantity`<> 0";
        $orderidResultd = $conn->query($orderidqueryd);
        if ($orderidResultd && $orderidResultd->num_rows > 0) {
            $row = $orderidResultd->fetch_assoc();
            $orderid = $row['OrderID'];
        }

        $status = ($quantity === "0") ? ', od.Status = 0' : '';
        $updateQuery = "
            UPDATE orders od
                JOIN (
                    SELECT 
                        f.fd_oid AS FoodID, 
                        f.Price AS Price
                    FROM fooddetails_log f
                    WHERE f.fd_oid = '$foodid'
                    AND f.fromdate = (
                        SELECT MAX(f1.fromdate) 
                        FROM fooddetails_log f1 
                        WHERE f1.fd_oid = '$foodid' AND f1.fromdate <= '$date'
                    )
                ) fd ON fd.FoodID = od.FoodID
                SET 
                    od.Quantity = '$quantity',
                    od.TotalAmount = ('$totalamount' * '$quantity')
                    $status
                WHERE 
                    od.OrderDate = '$date'
                    AND od.CustomerID = '$cid'
                    AND od.FoodID = '$foodid'
                    AND od.FoodTypeID = '$ordertype';

        ";

        $updateResult = $conn->query($updateQuery);
        if ($conn->affected_rows > 0) {
            if (!empty($orderid)) {
                // Fetch the OrderID based on FoodID, CustomerID, and OrderDate
                $orderidquery = "SELECT OrderID FROM `orders` WHERE FoodID = '$foodid' AND CustomerID = '$cid' AND OrderDate = '$date' AND FoodTypeID = '$ordertype'";
                $orderidResult = $conn->query($orderidquery);
                if ($orderidResult && $orderidResult->num_rows > 0) {
                    $row = $orderidResult->fetch_assoc();
                    $orderid = $row['OrderID'];
                }
            }
            // Log the update
            $logQuery = "INSERT INTO `logs`(`CustomerID`, `OrderID`, `Quantity`, `Price`, `FoodType`) 
                         VALUES ('$cid','$orderid','$quantity','$totalamount' * '$quantity','$ordertype')";
            setData($conn, $logQuery);
            $result = payments($cid,$date,$conn); 
            $jsonResponse = array('code' => '200', 'status' => 'success', 'message' => "Record updated successfully", 'sql' => "$orderid");
        } else {
            $jsonResponse = array('code' => '304', 'status' => 'warning', 'message' => "No changes made to the existing record");
        }



        } else {
            $newDates[] = $date;
        }
    }

    // Insert new records
    foreach ($newDates as $date) {
        $day = date('l', strtotime($date));
        $query = "SELECT 
    f.item_name AS ItemName, 
    f.price AS Price, 
    f.fd_oid AS OptionID, 
    1 AS category
    FROM 
    fooddetails_log f
    WHERE 
    f.fd_oid = (
        SELECT wl.optionid 
        FROM week_log wl 
        WHERE wl.weeksno = (
            SELECT w.sno 
            FROM week w
            WHERE w.day = DAYNAME('$date') -- Match the day name (Monday, Tuesday, etc.)
        )
          AND wl.fromdate = (
              SELECT MAX(wl_inner.fromdate) 
              FROM week_log wl_inner 
              WHERE wl_inner.weeksno = wl.weeksno
                AND wl_inner.fromdate <= '$date'
          )
    )
  AND f.fromdate = (
      SELECT MAX(f_inner.fromdate)
      FROM fooddetails_log f_inner
      WHERE f_inner.fd_oid = (
          SELECT wl.optionid 
          FROM week_log wl 
          WHERE wl.weeksno = (
              SELECT w.sno 
              FROM week w
              WHERE w.day = DAYNAME('$date') -- Match the day name (Monday, Tuesday, etc.)
          )
            AND wl.fromdate = (
                SELECT MAX(wl_inner.fromdate) 
                FROM week_log wl_inner 
                WHERE wl_inner.weeksno = wl.weeksno
                  AND wl_inner.fromdate <= '$date'
            )
      )
      AND f_inner.fromdate <= '$date'
  );

                    ";
        $result = $conn->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totalamount = $row['Price'];
            $foodid = $row['OptionID'];
        } else {
            $totalamount = 0; // Default to 0 if no price is found
        }
        $orderidquery = "SELECT COALESCE(MAX(OrderID),0)+1 AS OrderID FROM `orders`";
        $orderidResult = $conn->query($orderidquery);
        if ($orderidResult && $orderidResult->num_rows > 0) {
            $row = $orderidResult->fetch_assoc();
            $orderid = $row['OrderID'];
        }

        $insertquery = "INSERT INTO `orders` (`OrderID`, `CustomerID`, `FoodTypeID`, `TotalAmount`, `Quantity`, `OrderDate`, `Status`, `CategoryID`, `FoodID`) 
                        VALUES ('$orderid','$cid', '$ordertype', '" . ($totalamount * $quantity) . "', '$quantity', '$date', '1', '1', '$foodid')";
        $insertResult = $conn->query($insertquery);

        if ($conn->affected_rows > 0) {
            $logQuery = "INSERT INTO `logs`(`CustomerID`, `OrderID`, `Quantity`, `Price`, `FoodType`) 
                         VALUES ('$cid', '$orderid', '$quantity', '" . ($totalamount * $quantity) . "', '$ordertype')";
            setData($conn, $logQuery);
            $result = payments($cid,$date,$conn);
            $insertedDates[] = $date;
        }
    }

    // Prepare single JSON response
    $responseMessage = "Records successfully updated\n" . 
    "From date: " . reset($dates) . "\n" . 
    "To date: " . end($dates) . "\n" . 
    "Quantity: $quantity.";
    $jsonresponse = array(
        'code' => '200',
        'status' => 'success',
        'message' => $responseMessage
    );

    echo json_encode($jsonresponse);
}







function setitemsd($conn)
{
    global $cid, $ordertype, $totalamount, $quantity, $dates, $foodid;

    if (empty($dates)) {
        $jsonresponse = array('code' => '400', 'status' => 'error', 'message' => "Date range is missing");
        echo json_encode($jsonresponse);
        return;
    }

    $existingDates = [];
    $newDates = [];
    $insertedDates = [];

    // Check for existing dates
    foreach ($dates as $date) {
        $checkquery = "SELECT * FROM `orders` WHERE `CustomerID` = '$cid' AND `OrderDate` = '$date' AND `FoodTypeID` = '$ordertype' AND `Quantity`<> 0";
        $resultselectquery = getData($conn, $checkquery);
        if (count($resultselectquery) > 0) {
            $existingDates[] = $date;
        } else {
            $newDates[] = $date;
        }
    }

    // Insert new records
    foreach ($newDates as $date) {
        $day = date('l', strtotime($date));
        $query = "SELECT Price,OptionID FROM fooddetails WHERE OptionID = (SELECT sno FROM week WHERE day = '$day')";
        $result = $conn->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totalamount = $row['Price'];
            $foodid = $row['OptionID'];
        }
        $orderidqueryd = "SELECT COALESCE(MAX(OrderID),0)+1 AS OrderID FROM `orders`";
        $orderidResultd = $conn->query($orderidqueryd);
        if ($orderidResultd && $orderidResultd->num_rows > 0) {
            $row = $orderidResultd->fetch_assoc();
            $orderid = $row['OrderID'];
        }

        $insertquery = "INSERT INTO `orders` (`OrderID`, `CustomerID`, `FoodTypeID`, `TotalAmount`, `Quantity`, `OrderDate`, `Status`, `CategoryID`, `FoodID`) 
                        VALUES ('$orderid','$cid', '$ordertype', '$totalamount', '$quantity', '$date', '1', '1', '$foodid')";
        $insertResult = $conn->query($insertquery);

        if ($conn->affected_rows > 0) {
            $logQuery = "INSERT INTO `logs`(`CustomerID`, `OrderID`, `Quantity`, `Price`, `FoodType`) 
                         VALUES ('$cid', '$orderid', '$quantity', '$totalamount', '$ordertype')";
            setData($conn, $logQuery);

            $insertedDates[] = $date;
        }

        $result = payments($cid,$date,$conn);
    }

    // Prepare single JSON response
    $responseMessage = '';
    if (!empty($existingDates)) {
        $responseMessage .= 'Records already exist for the following dates: ' . implode(', ', $existingDates) . '.\n';
    }
    if (!empty($insertedDates)) {
        $responseMessage .= 'Order placed successfully for the following dates: ' . implode(', ', $insertedDates) . '.';
    }

    $jsonresponse = array(
        'code' => !empty($insertedDates) ? '201' : '200',
        'status' => !empty($insertedDates) ? 'success' : 'partial_success',
        'message' => $responseMessage
    );

    echo json_encode($jsonresponse);
}




// function updateQuantity($conn)
// {
//     global $date, $quantity, $cid, $foodid, $foodtype, $reason, $price, $orderid;

//     // Check if the record exists
//     $checkQuery = "
//         SELECT * FROM orders 
//         WHERE OrderDate = '$date' 
//         AND CustomerId = '$cid' 
//         AND FoodID = '$foodid' 
//         AND FoodTypeID = '$foodtype'
//         AND Quantity<> 0;
//     ";
//     $checkResult = $conn->query($checkQuery);

//     if ($checkResult->num_rows > 0) {
//         $query = "SELECT f.price AS Price
//                     FROM fooddetails_log f
//                     WHERE f.fd_oid = '$foodid'
//                    AND f.fromdate = (
//                         SELECT MAX(f.fromdate) 
//                         FROM fooddetails_log f
//                         WHERE f.fd_oid = '$foodid' AND f.fromdate <= '$date'
//                     )";
//         $result = $conn->query($query);
//         if ($result && $result->num_rows > 0) {
//             $row = $result->fetch_assoc();
//             $totalamount = $row['Price'];
//         } else {
//             $totalamount = 0; // Default to 0 if no price is found
//         }
//         // Record exists, update it
//         $status = ($quantity === "0") ? ', od.Status = 0' : '';
//         $updateQuery = "
//             UPDATE orders od
//             JOIN fooddetails fd ON fd.OptionID = od.FoodID
//             SET 
//                 od.Quantity = '$quantity',
//                 od.TotalAmount = '$totalamount' * '$quantity'
//                 $status
//             WHERE od.OrderDate = '$date'
//             AND od.CustomerId = '$cid'
//             AND od.FoodID = '$foodid'
//             AND od.FoodTypeID = '$foodtype';
//         ";

//         $updateResult = $conn->query($updateQuery);

//         if ($conn->affected_rows > 0) {
//             if (!empty($orderid)) {
//                 // Fetch the OrderID based on FoodID, CustomerID, and OrderDate
//                 $orderidquery = "SELECT OrderID FROM `orders` WHERE FoodID = '$foodid' AND CustomerID = '$cid' AND OrderDate = '$date'";
//                 $orderidResult = $conn->query($orderidquery);
//                 if ($orderidResult && $orderidResult->num_rows > 0) {
//                     $row = $orderidResult->fetch_assoc();
//                     $orderid = $row['OrderID'];
//                 }
//             }
//             // Log the update
//             $logQuery = "INSERT INTO `logs`(`CustomerID`, `OrderID`, `Quantity`, `Price`, `FoodType`, `Reason`) 
//                          VALUES ('$cid','$orderid','$quantity','$price' * '$quantity','$foodtype','$reason')";
//             setData($conn, $logQuery);
//             $result = payments($cid,$date,$conn);
//             $jsonResponse = array('code' => '200', 'status' => 'success', 'message' => "Record updated successfully", 'sql' => "$orderid");
//         } else {
//             $jsonResponse = array('code' => '304', 'status' => 'warning', 'message' => "No changes made to the existing record");
//         }
//     } else {
//         // Record does not exist, insert it

//         $orderidquery = "SELECT COALESCE(MAX(OrderID),0)+1 AS OrderID FROM `orders`";
//         $orderidResult = $conn->query($orderidquery);
//         if ($orderidResult && $orderidResult->num_rows > 0) {
//             $row = $orderidResult->fetch_assoc();
//             $orderid = $row['OrderID'];
//         }
//         $insertQuery = "
//             INSERT INTO orders (OrderID, OrderDate, CustomerId, FoodID, FoodTypeID, Quantity, TotalAmount, Status, CategoryID) 
//             VALUES ('$orderid','$date', '$cid', '$foodid', '$foodtype', '$quantity', '$price' * '$quantity', 1, 1);
//         ";

//         $insertResult = $conn->query($insertQuery);

//         if ($conn->affected_rows > 0) {
//             $orderidquery = "SELECT COALESCE(MAX(OrderID),0) AS OrderID FROM `orders`";
//             $orderidResult = $conn->query($orderidquery);
//             if ($orderidResult && $orderidResult->num_rows > 0) {
//                 $row = $orderidResult->fetch_assoc();
//                 $orderid = $row['OrderID'];
//             }
//             // Log the insertion
//             $logQuery = "INSERT INTO `logs`(`CustomerID`, `OrderID`, `Quantity`, `Price`, `FoodType`, `Reason`) VALUES ('$cid','$orderid','$quantity','$price' * '$quantity','$foodtype','$reason')";
//             setData($conn, $logQuery);
//             $result = payments($cid,$date,$conn);
//             $jsonResponse = array('code' => '201', 'status' => 'success', 'message' => "New record added successfully");
//         } else {
//             $jsonResponse = array('code' => '500', 'status' => 'error', 'message' => "Failed to add the new record");
//         }
//     }

//     echo json_encode($jsonResponse);
// }
function updateQuantity($conn)
{
    global $date, $quantity, $cid, $foodid, $foodtype, $reason, $price, $orderid;

    // Check if the record exists
    $checkQuery = "
        SELECT * FROM orders 
        WHERE OrderDate = '$date' 
        AND CustomerId = '$cid' 
        AND FoodID = '$foodid' 
        AND FoodTypeID = '$foodtype'
        AND Quantity<> 0;
    ";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        $query = "SELECT f.price AS Price
                    FROM fooddetails_log f
                    WHERE f.fd_oid = '$foodid'
                   AND f.fromdate = (
                        SELECT MAX(f.fromdate) 
                        FROM fooddetails_log f
                        WHERE f.fd_oid = '$foodid' AND f.fromdate <= '$date'
                    )";
        $result = $conn->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totalamount = $row['Price'];
        } else {
            $totalamount = 0; // Default to 0 if no price is found
        }
        // Record exists, update it
        $status = ($quantity === "0") ? ', od.Status = 0' : '';
        $updateQuery = "
            UPDATE orders od
                JOIN (
                    SELECT 
                        f.fd_oid AS FoodID, 
                        f.Price AS Price
                    FROM fooddetails_log f
                    WHERE f.fd_oid = '$foodid'
                    AND f.fromdate = (
                        SELECT MAX(f1.fromdate) 
                        FROM fooddetails_log f1 
                        WHERE f1.fd_oid = '$foodid' AND f1.fromdate <= '$date'
                    )
                ) fd ON fd.FoodID = od.FoodID
                SET 
                    od.Quantity = '$quantity',
                    od.TotalAmount = ('$totalamount' * '$quantity')
                    $status
                WHERE 
                    od.OrderDate = '$date'
                    AND od.CustomerID = '$cid'
                    AND od.FoodID = '$foodid'
                    AND od.FoodTypeID = '$foodtype';

        ";

        $updateResult = $conn->query($updateQuery);

        if ($conn->affected_rows > 0) {
            if (!empty($orderid)) {
                // Fetch the OrderID based on FoodID, CustomerID, and OrderDate
                $orderidquery = "SELECT OrderID FROM `orders` WHERE FoodID = '$foodid' AND CustomerID = '$cid' AND OrderDate = '$date' AND FoodTypeID = '$foodtype'";
                $orderidResult = $conn->query($orderidquery);
                if ($orderidResult && $orderidResult->num_rows > 0) {
                    $row = $orderidResult->fetch_assoc();
                    $orderid = $row['OrderID'];
                }
            }
            // Log the update
            $logQuery = "INSERT INTO `logs`(`CustomerID`, `OrderID`, `Quantity`, `Price`, `FoodType`, `Reason`) 
                         VALUES ('$cid','$orderid','$quantity','$price' * '$quantity','$foodtype','$reason')";
            setData($conn, $logQuery);
            $result = payments($cid,$date,$conn); 
            $jsonResponse = array('code' => '200', 'status' => 'success', 'message' => "Record updated successfully", 'sql' => "$orderid");
        } else {
            $jsonResponse = array('code' => '304', 'status' => 'warning', 'message' => "No changes made to the existing record");
        }
    } else {
        // Record does not exist, insert it

        $orderidquery = "SELECT COALESCE(MAX(OrderID),0)+1 AS OrderID FROM `orders`";
        $orderidResult = $conn->query($orderidquery);
        if ($orderidResult && $orderidResult->num_rows > 0) {
            $row = $orderidResult->fetch_assoc();
            $orderid = $row['OrderID'];
        }
        $insertQuery = "
            INSERT INTO orders (OrderID, OrderDate, CustomerId, FoodID, FoodTypeID, Quantity, TotalAmount, Status, CategoryID) 
            VALUES ('$orderid','$date', '$cid', '$foodid', '$foodtype', '$quantity', '$price' * '$quantity', 1, 1);
        ";

        $insertResult = $conn->query($insertQuery);

        if ($conn->affected_rows > 0) {
            $orderidquery = "SELECT COALESCE(MAX(OrderID),0) AS OrderID FROM `orders`";
            $orderidResult = $conn->query($orderidquery);
            if ($orderidResult && $orderidResult->num_rows > 0) {
                $row = $orderidResult->fetch_assoc();
                $orderid = $row['OrderID'];
            }
            // Log the insertion
            $logQuery = "INSERT INTO `logs`(`CustomerID`, `OrderID`, `Quantity`, `Price`, `FoodType`, `Reason`) VALUES ('$cid','$orderid','$quantity','$price' * '$quantity','$foodtype','$reason')";
            setData($conn, $logQuery);
            $result = payments($cid,$date,$conn); 
            $jsonResponse = array('code' => '201', 'status' => 'success', 'message' => "New record added successfully");
        } else {
            $jsonResponse = array('code' => '500', 'status' => 'error', 'message' => "Failed to add the new record");
        }
    }

    echo json_encode($jsonResponse);
}


function payments($cid,$orderdate,$conn){

    $orderdate = date_create($orderdate);
    $ordermonth = date_format($orderdate, 'm'); 
    $orderyear = date_format($orderdate,'Y');
   
    $fromdate_obj = date_create("$orderyear-$ordermonth-1");
    $fromdate = date_format($fromdate_obj, 'Y-m-d'); 
    $todate = date_format($fromdate_obj->modify('last day of this month'), 'Y-m-d'); 


    $checkquery = "select * from payments where customer_id='$cid' and from_date='$fromdate' and to_date='$todate'";
    $resultcheck = getData($conn,$checkquery);
    
    if(count($resultcheck) > 0){
            $total_payment_query = "
            SELECT SUM(orders.TotalAmount) AS TotalAmount
            FROM orders
            JOIN foodtype ON orders.FoodTypeID = foodtype.sno
            JOIN customers ON orders.CustomerID = customers.CustomerID
            WHERE orders.OrderDate BETWEEN '$fromdate' AND '$todate' 
              AND orders.CustomerID = $cid";
    
        // Fetch the total payment amount
        $result_tp = getData($conn, $total_payment_query);
        $total_payment = $result_tp[0]['TotalAmount'] ?? 0;
    
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
            WHERE orders.OrderDate BETWEEN '$fromdate' AND '$todate' 
              AND orders.CustomerID = $cid";
    
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
    
    // if ($query == 'update') {
    //     $total_payment_query = "
    //         SELECT SUM(orders.TotalAmount) AS TotalAmount
    //         FROM orders
    //         JOIN foodtype ON orders.FoodTypeID = foodtype.sno
    //         JOIN customers ON orders.CustomerID = customers.CustomerID
    //         WHERE orders.OrderDate BETWEEN '$fromdate' AND '$todate' 
    //           AND orders.CustomerID = $cid";
    
    //     // Fetch the total payment amount
    //     $result_tp = getData($conn, $total_payment_query);
    //     $total_payment = $result_tp[0]['TotalAmount'] ?? 0;
    
    //     $updatepayments = "
    //         UPDATE payments 
    //         SET total_amount = $total_payment
    //         WHERE from_date = '$fromdate' 
    //           AND to_date = '$todate' 
    //           AND customer_id = $cid";
        
    //     // Execute the update query
    //     $result_update = setData($conn, $updatepayments);

    //     if($result_update == "Record created"){
    //         return "success";
    //     }
    //     else{
    //         return "fail";
    //     }
    
    // } else {
    //     $total_payment_query = "
    //         SELECT SUM(orders.TotalAmount) AS TotalAmount
    //         FROM orders
    //         JOIN foodtype ON orders.FoodTypeID = foodtype.sno
    //         JOIN customers ON orders.CustomerID = customers.CustomerID
    //         WHERE orders.OrderDate BETWEEN '$fromdate' AND '$todate' 
    //           AND orders.CustomerID = $cid";
    
    //     // Fetch total payment
    //     $result_tp = getData($conn, $total_payment_query);
    
    //     if (count($result_tp) > 0) {
    //         $total_payment = $result_tp[0]['TotalAmount'] ?? 0;
    
    //         $insertquery = "
    //             INSERT INTO payments (customer_id, from_date, to_date, total_amount)
    //             VALUES ($cid, '$fromdate', '$todate', $total_payment)";
            
    //         // Execute the insert query
    //         $result_insert = setData($conn, $insertquery);

    //         if($result_insert == "Record created"){
    //             return "success";
    //         }
    //         else{
    //             return "fail";
    //         }
    //     }
    // }
    
}






//function todayorder
function todayorder($conn){
    global $cid;
    $todaydate = date("Y-m-d"); // Use uppercase 'Y' for a four-digit year.
    $selectsql = "
       SELECT 
    ft.Type AS food_type,
    SUM(o.quantity) AS quantity,
    SUM(o.TotalAmount) AS price
FROM 
    orders o
JOIN 
    foodtype ft ON o.FoodTypeID = ft.Sno
WHERE 
    o.OrderDate = '$todaydate' AND o.CustomerID = $cid
GROUP BY 
    ft.Type
ORDER BY 
    ft.Type ASC;
    ";
    $resultsql = getData($conn, $selectsql);

    if (count($resultsql) > 0) {
        $jsonresponse = array('code' => '500', 'status' => 'Success', 'data' => $resultsql);
        echo json_encode($jsonresponse);
    } else {
        $jsonresponse = array('code' => '500', 'status' => 'fail', 'data' => 'Nodata');
        echo json_encode($jsonresponse);
    }
}


function insertnew($conn) {
    global $customername,$billingaddress,$deliveryaddress,$email,$periodicity,$deliverymobile,$billingmobile,$primaryphone,$map;

    $insertReceiptQuery = "INSERT INTO `customers`(`CustomerName`, `Phone1`, `Phone2`, `Phone3`, `BillingAddress`, `DeliveryAddress`, `Email`,`Map`)
     VALUES ('$customername','$primaryphone','$billingmobile','$deliverymobile','$billingaddress','$deliveryaddress','$email','$map')";
    $resultisertquery = setData($conn,$insertReceiptQuery);
    if ($resultisertquery == "Record created") {
        $lastReceiptId = mysqli_insert_id($conn);
        $jsonresponse = array(
            'code' => '200',
            'status' => 'success',
            'message' => 'Receipt inserted successfully.',
            'cid' => $lastReceiptId
        );
        echo json_encode($jsonresponse);
    } else {
        $jsonresponse = array('code' => '500', 'status' => 'error', 'message' => 'Failed to insert receipt.');
        echo json_encode($jsonresponse);
    }
}

function loadcat($conn)
{
    $selectQuery = "SELECT * FROM category ORDER BY SNO ASC";
    $resultquery = getdata($conn, $selectQuery);

    if (count($resultquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultquery);
        echo json_encode($jsonresponse);
    } else {
        $jsonresponse = array('code' => '200', 'status' => 'error', 'message' => 'No category found');
        echo json_encode($jsonresponse);
    }
}


function fetchorderb($conn)
{
    global $cid, $fromdate, $todate;
    $selectQuery = "SELECT 
    fd.ItemName,
    od.OrderID,
    od.OrderDate,
    od.TotalAmount,
    od.Quantity,
    od.Status
FROM orders od
JOIN fooddetails fd ON fd.OptionID = od.FoodID
WHERE od.FoodTypeID = '1' 
  AND od.CustomerID = '$cid'
  AND od.OrderDate BETWEEN '$fromdate' AND '$todate';";
    $resultquery = getdata($conn, $selectQuery);

    if (count($resultquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultquery);
        echo json_encode($jsonresponse);
    } else {
        $jsonresponse = array('code' => '200', 'status' => 'error', 'message' => 'No items found');
        echo json_encode($jsonresponse);
    }
}

function fetchorderd($conn)
{
    global $cid, $fromdate, $todate;
    $selectQuery = "SELECT 
    fd.ItemName,
    od.OrderID,
    od.OrderDate,
    od.TotalAmount,
    od.Quantity,
    od.Status
FROM orders od
JOIN fooddetails fd ON fd.OptionID = od.FoodID
WHERE od.FoodTypeID = '3' 
  AND od.CustomerID = '$cid'
  AND od.OrderDate BETWEEN '$fromdate' AND '$todate';";
    $resultquery = getdata($conn, $selectQuery);

    if (count($resultquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultquery);
        echo json_encode($jsonresponse);
    } else {
        $jsonresponse = array('code' => '200', 'status' => 'error', 'message' => 'No items found');
        echo json_encode($jsonresponse);
    }
}

function fetchorderl($conn)
{
    global $cid, $fromdate, $todate;
    $selectQuery = "SELECT 
    fd.ItemName,
    od.OrderID,
    od.OrderDate,
    od.TotalAmount,
    od.Quantity,
    od.Status
FROM orders od
JOIN fooddetails fd ON fd.OptionID = od.FoodID
WHERE od.FoodTypeID = '2' 
  AND od.CustomerID = '$cid'
  AND od.OrderDate BETWEEN '$fromdate' AND '$todate';
";
    $resultquery = getdata($conn, $selectQuery);

    if (count($resultquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultquery);
        echo json_encode($jsonresponse);
    } else {
        $jsonresponse = array('code' => '200', 'status' => 'error', 'message' => 'No items found');
        echo json_encode($jsonresponse);
    }
}

function lunchdetails($conn)
{
    global $cid;
    $todaydate = date("Y-m-d");
    $sql="SELECT 
    o.OrderDate AS Date,
    i.OptionID AS OptionID,
    i.ItemName AS ItemName,
    o.Quantity AS Quantity,
    i.Price AS Price,
    o.OrderID AS OrderID,
    o.Status AS Status
FROM 
    orders o
INNER JOIN 
    fooddetails i ON o.FoodID = i.OptionID
WHERE 
    o.CustomerID = $cid AND o.FoodTypeID = 2 AND o.OrderDate >= '$todaydate'
ORDER BY 
    i.OptionID ASC;;";
$result=getdata($conn,$sql);

if (count($result) > 0) {
$jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $result);
echo json_encode($jsonresponse);
} else {
$jsonresponse = array('code' => '200', 'status' => 'error', 'message' => 'No items found');
echo json_encode($jsonresponse);
}
}


// Function to fetch all items
function getall($conn) {
    // Query to fetch all items for category 2
    $sql = "SELECT ItemName, Price, OptionID FROM fooddetails WHERE category = 2 and activity = 1";
    
    // Execute the query and fetch results
    $result = getdata($conn, $sql);

    // Return the response as JSON
    $jsonresponse = [
        'code' => '200',
        'status' => 'success',
        'data' => $result
    ];
    echo json_encode($jsonresponse);
}

// it is used to fetch the add items in the lunch table for container1
function getadditems($conn)
{
    $sql = "Select ItemName,Price,OptionID from fooddetails where OptionID>17 and OptionID<25;";
    $result = getdata($conn, $sql);
    $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $result);
    echo json_encode($jsonresponse);
}


// function fetchitems($conn)
// {
//     global $day, $cid;
//     $selectQuery = "WITH RECURSIVE days AS (
//     SELECT CURDATE() AS day
//     UNION ALL
//     SELECT DATE_ADD(day, INTERVAL 1 DAY)
//     FROM days
//     WHERE day < DATE_ADD(CURDATE(), INTERVAL 29 DAY)
//     )
// SELECT 
//     COALESCE(f.item_name, CONCAT('Sample Item for ', DAYNAME(d.day))) AS ItemName,
//     COALESCE(f.price, 100.00) AS Price,
//     COALESCE(f.fd_oid, w.sno) AS OptionID,
//     o.OrderID AS OrderID,
//     1 AS category,
//     d.day AS Date,
//     DAYNAME(d.day) AS DayName,
//     COALESCE(SUM(o.Quantity), 0) AS Quantity
// FROM 
//     days d
// LEFT JOIN 
//     week w ON DAYNAME(d.day) = w.day  
// LEFT JOIN 
//     fooddetails_log f ON w.sno = f.fd_oid 
//     AND f.fromdate = (
//         SELECT MAX(f.fromdate) 
//         FROM fooddetails_log f
//         WHERE f.fd_oid = w.sno AND f.fromdate <= d.day
//     )
// LEFT JOIN 
//     orders o ON o.OrderDate = d.day AND o.FoodTypeID = 1 AND o.CustomerID = $cid
// GROUP BY 
//     d.day, f.item_name, f.price, f.fd_oid
// ORDER BY 
//     d.day ASC

// ";
//     $resultquery = getdata($conn, $selectQuery);

//     if (count($resultquery) > 0) {
//         $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultquery);
//         echo json_encode($jsonresponse);
//     } else {
//         $jsonresponse = array('code' => '200', 'status' => 'error', 'message' => 'No items found');
//         echo json_encode($jsonresponse);
//     }
// }
function fetchitems($conn)
{
    global $day, $cid;
     //setting time zone
    $setTimezoneQuery = "SET time_zone = '+05:30';";
    mysqli_query($conn, $setTimezoneQuery);
    $selectQuery = "WITH RECURSIVE days AS (
    SELECT CURDATE() AS day
    UNION ALL
    SELECT DATE_ADD(day, INTERVAL 1 DAY)
    FROM days
    WHERE day < DATE_ADD(CURDATE(), INTERVAL 29 DAY)
    )
    SELECT 
    COALESCE(f.item_name, CONCAT('Sample Item for ', DAYNAME(d.day))) AS ItemName,
    COALESCE(f.price, 100.00) AS Price,
    COALESCE(f.fd_oid, wl.optionid) AS OptionID,
    o.OrderID AS OrderID,
    1 AS category,
    d.day AS Date,
    DAYNAME(d.day) AS DayName,
    o.Status as Status,
    COALESCE(SUM(o.Quantity), 0) AS Quantity
    FROM 
    days d
    LEFT JOIN 
    week_log wl ON wl.weeksno = WEEKDAY(d.day) + 1 
    AND wl.fromdate = (
        SELECT MAX(wl_inner.fromdate)
        FROM week_log wl_inner
        WHERE wl_inner.weeksno = wl.weeksno AND wl_inner.fromdate <= d.day
    )
    LEFT JOIN 
    fooddetails_log f ON wl.optionid = f.fd_oid 
    AND f.fromdate = (
        SELECT MAX(f_inner.fromdate) 
        FROM fooddetails_log f_inner
        WHERE f_inner.fd_oid = wl.optionid AND f_inner.fromdate <= d.day
    )
    LEFT JOIN 
    orders o ON o.OrderDate = d.day AND o.FoodTypeID = 1 AND o.CustomerId = $cid
    GROUP BY 
    d.day, f.item_name, f.price, f.fd_oid, wl.optionid
    ORDER BY 
    d.day ASC;

    ";
    $resultquery = getdata($conn, $selectQuery);

    if (count($resultquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultquery);
        echo json_encode($jsonresponse);
    } else {
        $jsonresponse = array('code' => '200', 'status' => 'error', 'message' => 'No items found');
        echo json_encode($jsonresponse);
    }
}


// function getitems($conn)
// {
//     global $day, $cid;
//     $selectQuery = "WITH RECURSIVE days AS (
//     SELECT CURDATE() AS day
//     UNION ALL
//     SELECT DATE_ADD(day, INTERVAL 1 DAY)
//     FROM days
//     WHERE day < DATE_ADD(CURDATE(), INTERVAL 29 DAY)
//     )
// SELECT 
//     COALESCE(f.item_name, CONCAT('Sample Item for ', DAYNAME(d.day))) AS ItemName,
//     COALESCE(f.price, 100.00) AS Price,
//     COALESCE(f.fd_oid, w.sno) AS OptionID,
//     o.OrderID AS OrderID,
//     1 AS category,
//     d.day AS Date,
//     DAYNAME(d.day) AS DayName,
//     COALESCE(SUM(o.Quantity), 0) AS Quantity
// FROM 
//     days d
// LEFT JOIN 
//     week w ON DAYNAME(d.day) = w.day  
// LEFT JOIN 
//     fooddetails_log f ON w.sno = f.fd_oid 
//     AND f.fromdate = (
//         SELECT MAX(f.fromdate) 
//         FROM fooddetails_log f
//         WHERE f.fd_oid = w.sno AND f.fromdate <= d.day
//     )
// LEFT JOIN 
//     orders o ON o.OrderDate = d.day AND o.FoodTypeID = 3 AND o.CustomerID = $cid
// GROUP BY 
//     d.day, f.item_name, f.price, f.fd_oid
// ORDER BY 
//     d.day ASC
// ";
//     $resultquery = getdata($conn, $selectQuery);

//     if (count($resultquery) > 0) {
//         $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultquery);
//         echo json_encode($jsonresponse);
//     } else {
//         $jsonresponse = array('code' => '200', 'status' => 'error', 'message' => 'No items found');
//         echo json_encode($jsonresponse);
//     }
// }
function getitems($conn)
{
    global $day, $cid;
    //setting time zone
    $setTimezoneQuery = "SET time_zone = '+05:30';";
    mysqli_query($conn, $setTimezoneQuery);
    $selectQuery = "WITH RECURSIVE days AS (
    SELECT CURDATE() AS day
    UNION ALL
    SELECT DATE_ADD(day, INTERVAL 1 DAY)
    FROM days
    WHERE day < DATE_ADD(CURDATE(), INTERVAL 29 DAY)
    )
    SELECT 
    COALESCE(f.item_name, CONCAT('Sample Item for ', DAYNAME(d.day))) AS ItemName,
    COALESCE(f.price, 100.00) AS Price,
    COALESCE(f.fd_oid, wl.optionid) AS OptionID,
    o.OrderID AS OrderID,
    3 AS category,
    d.day AS Date,
    DAYNAME(d.day) AS DayName,
    o.Status as Status,
    COALESCE(SUM(o.Quantity), 0) AS Quantity
    FROM 
    days d
    LEFT JOIN 
    week_log wl ON wl.weeksno = WEEKDAY(d.day) + 1 
    AND wl.fromdate = (
        SELECT MAX(wl_inner.fromdate)
        FROM week_log wl_inner
        WHERE wl_inner.weeksno = wl.weeksno AND wl_inner.fromdate <= d.day
    )
    LEFT JOIN 
    fooddetails_log f ON wl.optionid = f.fd_oid 
    AND f.fromdate = (
        SELECT MAX(f_inner.fromdate) 
        FROM fooddetails_log f_inner
        WHERE f_inner.fd_oid = wl.optionid AND f_inner.fromdate <= d.day
    )
    LEFT JOIN 
    orders o ON o.OrderDate = d.day AND o.FoodTypeID = 3 AND o.CustomerId = $cid
    GROUP BY 
    d.day, f.item_name, f.price, f.fd_oid, wl.optionid
    ORDER BY 
    d.day ASC;
    ";
    $resultquery = getdata($conn, $selectQuery);

    if (count($resultquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultquery);
        echo json_encode($jsonresponse);
    } else {
        $jsonresponse = array('code' => '200', 'status' => 'error', 'message' => 'No items found');
        echo json_encode($jsonresponse);
    }
}


function setitems($conn)
{
    global $data, $cid;
    $resultsql = "";

    $skippedRecords = [];
    foreach ($data as $record) {
        $date = $record['Date'];
        $quantity = $record['Quantity'];
        $price = $record['Price'];
        $optionid = $record['OptionID'];
        $foodtypeid = $record['foodtypeid'];


        // Skip if quantity is 0 or less
        if ($quantity <= 0) {
            continue;
        }

        // Check for existing record
        $checkquery = "SELECT * FROM `orders` WHERE `OrderDate` = '$date' AND `FoodID` = '$optionid' AND `FoodTypeID`='$foodtypeid'";
        $result = getData($conn, $checkquery);

        if (!empty($result)) {
            $skippedRecords[] = $date; // Track skipped dates
            continue;
        }

        // Insert new record
        $insertquery = "INSERT INTO `orders` (`CustomerID`, `FoodTypeID`, `TotalAmount`, `Quantity`, `OrderDate`, `Status`, `CategoryID`, `FoodID`) 
                        VALUES ('$cid', '$foodtypeid', '$price' * '$quantity', '$quantity', '$date', '1', '1', '$optionid')";
        $resultsql  = setData($conn, $insertquery);
    }

    if($resultsql == "Record created"){
        $responseMessage = "Order placed successfully.";
    

    $jsonresponse = array('code' => '200', 'status' => 'success', 'message' => $responseMessage,'data'=>$data,'cid'=>$cid);
    echo json_encode($jsonresponse);

    }
    else{
        $responseMessage = "Fail to add.";
        $jsonresponse = array('code' => '500', 'status' => 'fail', 'message' => $responseMessage,'data'=>$data);
        echo json_encode($jsonresponse);
    }
}

function fetchitemsb($conn)
{
    global $day,$fromdate;
    $day = date('l', strtotime($fromdate));
    $selectQuery = "SELECT 
            f.item_name AS ItemName, 
            f.price AS Price, 
            f.fd_oid AS OptionID, 
            1 AS category
        FROM 
            fooddetails_log f
        WHERE 
            f.fd_oid = (
                SELECT wl.optionid 
                FROM week_log wl 
                WHERE wl.weeksno = (
                    SELECT w.sno 
                    FROM week w
            WHERE w.day = DAYNAME('$fromdate') 
        )
          AND wl.fromdate = (
              SELECT MAX(wl_inner.fromdate) 
              FROM week_log wl_inner 
              WHERE wl_inner.weeksno = wl.weeksno
                AND wl_inner.fromdate <= '$fromdate'
          )
    )
      AND f.fromdate = (
      SELECT MAX(f_inner.fromdate)
      FROM fooddetails_log f_inner
      WHERE f_inner.fd_oid = (
          SELECT wl.optionid 
          FROM week_log wl 
          WHERE wl.weeksno = (
              SELECT w.sno 
              FROM week w
              WHERE w.day = DAYNAME('$fromdate') 
          )
            AND wl.fromdate = (
                SELECT MAX(wl_inner.fromdate) 
                FROM week_log wl_inner 
                WHERE wl_inner.weeksno = wl.weeksno
                  AND wl_inner.fromdate <= '$fromdate'
            )
      )
      AND f_inner.fromdate <= '$fromdate'
  );";
    $resultquery = getdata($conn, $selectQuery);

    if (count($resultquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultquery);
        echo json_encode($jsonresponse);
    } else {
        $jsonresponse = array('code' => '200', 'status' => 'error', 'message' => 'No items found');
        echo json_encode($jsonresponse);
    }
}

function getitemsb($conn)
{
    global $day,$fromdate;
    $day = date('l', strtotime($fromdate));
    $selectQuery = "SELECT 
            f.item_name AS ItemName, 
            f.price AS Price, 
            f.fd_oid AS OptionID, 
            3 AS category
        FROM 
            fooddetails_log f
        WHERE 
            f.fd_oid = (
                SELECT wl.optionid 
                FROM week_log wl 
                WHERE wl.weeksno = (
                    SELECT w.sno 
                    FROM week w
            WHERE w.day = DAYNAME('$fromdate') 
        )
          AND wl.fromdate = (
              SELECT MAX(wl_inner.fromdate) 
              FROM week_log wl_inner 
              WHERE wl_inner.weeksno = wl.weeksno
                AND wl_inner.fromdate <= '$fromdate'
          )
    )
      AND f.fromdate = (
      SELECT MAX(f_inner.fromdate)
      FROM fooddetails_log f_inner
      WHERE f_inner.fd_oid = (
          SELECT wl.optionid 
          FROM week_log wl 
          WHERE wl.weeksno = (
              SELECT w.sno 
              FROM week w
              WHERE w.day = DAYNAME('$fromdate') 
          )
            AND wl.fromdate = (
                SELECT MAX(wl_inner.fromdate) 
                FROM week_log wl_inner 
                WHERE wl_inner.weeksno = wl.weeksno
                  AND wl_inner.fromdate <= '$fromdate'
            )
      )
      AND f_inner.fromdate <= '$fromdate'
  );";
    $resultquery = getdata($conn, $selectQuery);

    if (count($resultquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultquery);
        echo json_encode($jsonresponse);
    } else {
        $jsonresponse = array('code' => '200', 'status' => 'error', 'message' => 'No items found');
        echo json_encode($jsonresponse);
    }
}


function loadQuantity($conn)
{
    global $fromdate,$todate,$foodtype,$dayscount,$cid;
    $fromdateObj = new DateTime($fromdate);
    $todateObj = new DateTime($todate);

    $date_diff = date_diff($fromdateObj, $todateObj);
    $dayscount = $date_diff->days;
    $selectQuery = "SELECT Quantity,count(quantity) AS Qtycount,AVG(Quantity) AS QtyAvg FROM orders WHERE FoodTypeID = '$foodtype' AND OrderDate BETWEEN '$fromdate' AND '$todate' AND CustomerID = '$cid'";
    $result = $conn->query($selectQuery);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $quantity = $row['Quantity'];
            $qtycount = $row['Qtycount'];
            $qtyavg = $row['QtyAvg'];
        } 

    if (($dayscount+1==$qtycount) && ($quantity==$qtyavg)) {
        $jsonresponse = array(
            'code' => '200',
            'status' => 'success',
            'data' => $quantity
        );
        echo json_encode($jsonresponse);
    } else {
        $jsonresponse = array(
            'code' => '200',
            'status' => 'error',
            'message' => 'No quantities found',
            'dayscount' => $dayscount,
            'qty' => $quantity,$qtyavg,$qtycount,
            'qtyavg' =>$qtyavg,
            'qtycount' =>$qtycount
        );
        echo json_encode($jsonresponse);
    }
}
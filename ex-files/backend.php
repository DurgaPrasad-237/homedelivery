<?php

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
        } else {
            $newDates[] = $date;
        }
    }

    // Insert new records
    foreach ($newDates as $date) {
        $day = date('l', strtotime($date));
        $query = "SELECT f.price AS Price, f.fd_oid AS OptionID
                    FROM fooddetails_log f
                    WHERE f.fd_oid = (
                        SELECT sno 
                        FROM week 
                        WHERE day = '$day'
                    )
                    AND f.fromdate = (
                        SELECT MAX(fromdate)
                        FROM fooddetails_log
                        WHERE fd_oid = (
                            SELECT sno 
                            FROM week 
                            WHERE day = '$day'
                        )
                        AND fromdate <= '$date'
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

            $insertedDates[] = $date;
        }
    }

    // Prepare single JSON response
    $responseMessage = '';
    if (!empty($existingDates)) {
        $responseMessage .= 'Records already exist for the following dates: ' . implode(', ', $existingDates) . '. ';
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
            JOIN fooddetails fd ON fd.OptionID = od.FoodID
            SET 
                od.Quantity = '$quantity',
                od.TotalAmount = '$totalamount' * '$quantity'
                $status
            WHERE od.OrderDate = '$date'
            AND od.CustomerId = '$cid'
            AND od.FoodID = '$foodid'
            AND od.FoodTypeID = '$foodtype';
        ";

        $updateResult = $conn->query($updateQuery);

        if ($conn->affected_rows > 0) {
            if (!empty($orderid)) {
                // Fetch the OrderID based on FoodID, CustomerID, and OrderDate
                $orderidquery = "SELECT OrderID FROM `orders` WHERE FoodID = '$foodid' AND CustomerID = '$cid' AND OrderDate = '$date'";
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

            $jsonResponse = array('code' => '201', 'status' => 'success', 'message' => "New record added successfully");
        } else {
            $jsonResponse = array('code' => '500', 'status' => 'error', 'message' => "Failed to add the new record");
        }
    }

    echo json_encode($jsonResponse);
}


function fetchitems($conn)
{
    global $day, $cid;
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
    COALESCE(f.fd_oid, w.sno) AS OptionID,
    o.OrderID AS OrderID,
    1 AS category,
    d.day AS Date,
    DAYNAME(d.day) AS DayName,
    COALESCE(SUM(o.Quantity), 0) AS Quantity
FROM 
    days d
LEFT JOIN 
    week w ON DAYNAME(d.day) = w.day  
LEFT JOIN 
    fooddetails_log f ON w.sno = f.fd_oid 
    AND f.fromdate = (
        SELECT MAX(f.fromdate) 
        FROM fooddetails_log f
        WHERE f.fd_oid = w.sno AND f.fromdate <= d.day
    )
LEFT JOIN 
    orders o ON o.OrderDate = d.day AND o.FoodTypeID = 1 AND o.CustomerID = $cid
GROUP BY 
    d.day, f.item_name, f.price, f.fd_oid
ORDER BY 
    d.day ASC


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


function getitems($conn)
{
    global $day, $cid;
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
    COALESCE(f.fd_oid, w.sno) AS OptionID,
    o.OrderID AS OrderID,
    1 AS category,
    d.day AS Date,
    DAYNAME(d.day) AS DayName,
    COALESCE(SUM(o.Quantity), 0) AS Quantity
FROM 
    days d
LEFT JOIN 
    week w ON DAYNAME(d.day) = w.day  
LEFT JOIN 
    fooddetails_log f ON w.sno = f.fd_oid 
    AND f.fromdate = (
        SELECT MAX(f.fromdate) 
        FROM fooddetails_log f
        WHERE f.fd_oid = w.sno AND f.fromdate <= d.day
    )
LEFT JOIN 
    orders o ON o.OrderDate = d.day AND o.FoodTypeID = 3 AND o.CustomerID = $cid
GROUP BY 
    d.day, f.item_name, f.price, f.fd_oid
ORDER BY 
    d.day ASC
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


function fetchitemsb($conn)
{
    global $day;
    $selectQuery = "SELECT item_name AS ItemName, price AS Price, fd_oid AS OptionID, 1 AS category
FROM fooddetails_log
WHERE fd_oid = (
    SELECT sno 
    FROM week 
    WHERE day = '$day'
)
AND fromdate = (
    SELECT MAX(fromdate)
    FROM fooddetails_log
    WHERE fd_oid = (
        SELECT sno 
        FROM week 
        WHERE day = '$day'
    )
    AND fromdate <= CURDATE()
)
LIMIT 1;"
;
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
    global $day;
    $selectQuery = "SELECT item_name AS ItemName, price AS Price, fd_oid AS OptionID, 3 AS category
FROM fooddetails_log
WHERE fd_oid = (
    SELECT sno 
    FROM week 
    WHERE day = '$day'
)
AND fromdate = (
    SELECT MAX(fromdate)
    FROM fooddetails_log
    WHERE fd_oid = (
        SELECT sno 
        FROM week 
        WHERE day = '$day'
    )
    AND fromdate <= CURDATE()
)
LIMIT 1;";
    $resultquery = getdata($conn, $selectQuery);

    if (count($resultquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultquery);
        echo json_encode($jsonresponse);
    } else {
        $jsonresponse = array('code' => '200', 'status' => 'error', 'message' => 'No items found');
        echo json_encode($jsonresponse);
    }
}


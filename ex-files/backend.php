<?php

function updateQuantity($conn)
{
    global $date, $quantity, $cid, $foodid, $foodtype, $reason, $price, $orderid, $subcategory;

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
        $ordersnorow = $checkResult->fetch_assoc();
        $ordersno = $ordersnorow['SNO'];
        // Record exists, update it
        $status = ($quantity === 0) ? ', od.Status = 0' : '';
        $joinquery = ($foodid !== 0) ? "JOIN (
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
                ) fd ON fd.FoodID = od.FoodID " : '';

        $updateQuery = "
            UPDATE orders od
                $joinquery
                SET 
                    od.Quantity = '$quantity',
                    od.TotalAmount = ('$totalamount' * '$quantity')
                    $status
                WHERE 
                    od.OrderDate = '$date'
                    AND od.Status = 1
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
            $logQuery = "INSERT INTO `logs`(`CustomerID`,`OrderSno`, `OrderID`, `Quantity`, `Price`, `FoodType`, `Reason`) 
                         VALUES ('$cid','$ordersno','$orderid','$quantity','$price' * '$quantity','$foodtype','$reason')";
            setData($conn, $logQuery);
            $result = payments($cid, $date, $conn);
            $jsonResponse = array('code' => '200', 'status' => 'success', 'message' => "Record updated successfully", 'sql' => "$orderid");
        } else {
            $jsonResponse = array('code' => '304', 'status' => 'warning', 'message' => "No changes made to the existing record", 'sql' => $updateQuery);
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
            INSERT INTO orders (OrderID, OrderDate, CustomerId, FoodID, FoodTypeID, SubCategorySno, Quantity, TotalAmount, Status, CategoryID) 
            VALUES ('$orderid','$date', '$cid', '$foodid', '$foodtype','$subcategory', '$quantity', '$price' * '$quantity', 1, 1);
        ";

        $insertResult = $conn->query($insertQuery);
        $ordersno = mysqli_insert_id($conn);
        if ($conn->affected_rows > 0) {
            $orderidquery = "SELECT COALESCE(MAX(OrderID),0) AS OrderID FROM `orders`";
            $orderidResult = $conn->query($orderidquery);
            if ($orderidResult && $orderidResult->num_rows > 0) {
                $row = $orderidResult->fetch_assoc();
                $orderid = $row['OrderID'];
            }
            // Log the insertion
            $logQuery = "INSERT INTO `logs`(`CustomerID`,`OrderSno`, `OrderID`, `Quantity`, `Price`, `FoodType`, `Reason`) VALUES ('$cid','$ordersno','$orderid','$quantity','$price' * '$quantity','$foodtype','$reason')";
            setData($conn, $logQuery);
            $result = payments($cid, $date, $conn);
            $jsonResponse = array('code' => '201', 'status' => 'success', 'message' => "New record added successfully");
        } else {
            $jsonResponse = array('code' => '500', 'status' => 'error', 'message' => "Failed to add the new record");
        }
    }

    echo json_encode($jsonResponse);
}

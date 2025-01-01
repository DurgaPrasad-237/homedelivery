<?php
include('config.php');
include('dblayer.php');
$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata, true);

$sno = $data["sno"] ?? "";
$csno = $data["csno"] ?? ""; 
$OptionID = $data["OptionID"] ?? "";
$category = $data["category"] ?? "";
$ItemName = $data["ItemName"] ?? "";
$foodtype = $data['foodtype'] ?? "";
$Price = $data["Price"] ?? "";
$from_date = $data["from_date"] ?? "";
$to_date = $data["to_date"] ?? "";

$load = $data["load"] ?? "";

if ($load == "add") {
    addcom($conn,$category, $ItemName, $Price, $from_date, $to_date);
} else if ($load == "get") {
    getcom($conn);
}
else if($load == "load_foodtype"){
        loadfoodtype($conn);
    }    
else if ($load == "update") {
    updatecom($conn,$category, $OptionID, $ItemName, $Price, $from_date, $to_date);
}

function addcom($conn, $category, $ItemName, $Price, $from_date, $to_date)
{
    // Check if the record with the same ItemName and Price already exists
    $selectquery = "SELECT * FROM fooddetails 
    WHERE category = '$category'
     AND ItemName = '$ItemName' 
    AND Price = '$Price' 
    AND from_date >= '$from_date' 
    AND to_date <= '$to_date'";
   $resultselectquery = getData($conn, $selectquery);

    // If the record already exists, return an error message
    if (count($resultselectquery) > 0) {
        $jsonresponse = array('code' => '500', 'message' => 'Record already exists');
        echo json_encode($jsonresponse);
    } else {
        // Proceed with adding the new record if it doesn't exist
        $insertquery = "INSERT INTO `fooddetails` (`category`,`ItemName`, `Price`, `from_date`, `to_date`) VALUES ('$category','$ItemName', '$Price', '$from_date', '$to_date')";
        $resultquery = setData($conn, $insertquery);

        if ($resultquery) {
            $jsonresponse = array('code' => '200', 'message' => 'Record added successfully');
        } else {
            $jsonresponse = array('code' => '500', 'message' => 'Failed to add record');
        }
        echo json_encode($jsonresponse);
    }
}

function getcom($conn) {
    $sql = "SELECT 
        ft.type AS category,  -- Category name from foodtype table
        fd.ItemName,
        fd.Price,
        fd.from_date,
        fd.to_date,
        fd.OptionID,
        fd.category AS csno  -- Category ID from fooddetails table
    FROM 
        fooddetails fd
    INNER JOIN 
        foodtype ft ON fd.category = ft.sno";  // Join foodtype to get the category name

    $result = getData($conn, $sql);

    $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $result);
    echo json_encode($jsonresponse);
}

function loadfoodtype($conn){
    $selectquery = "SELECT * FROM `foodtype` WHERE type != 'dinner'";
    $resultquery = getData($conn,$selectquery);

    if(count($resultquery) > 0){
        $jsonresponse = array('code' => '200', 'status' => "Success", 'data' => $resultquery);
        echo json_encode($jsonresponse);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => "fail", 'data' => 'No Data');
        echo json_encode($jsonresponse);
    }
}

function updatecom($conn, $category, $OptionID, $ItemName, $Price, $from_date, $to_date) {
    $selectquery = "SELECT * FROM `fooddetails` WHERE `OptionID` = '$OptionID'";
    $resultselectquery = getData($conn, $selectquery);
    if (count($resultselectquery) == 0) {
        $jsonresponse = array('code' => '200', 'message' => 'Record not found');
        echo json_encode($jsonresponse);
    } else {
        $updatequery = "UPDATE `fooddetails` 
                        SET `category` = '$category', 
                            `ItemName` = '$ItemName', 
                            `Price` = '$Price', 
                            `from_date` = '$from_date', 
                            `to_date` = '$to_date' 
                        WHERE `OptionID` = '$OptionID'";

        $resultquery = setData($conn, $updatequery);
        $jsonresponse = array('code' => '200', 'message' => 'Update successful');
        echo json_encode($jsonresponse);
    }
}
?>

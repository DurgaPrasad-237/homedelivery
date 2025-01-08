<?php
include('config.php');
include('dblayer.php');

$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata, true);

if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(array('code' => '400', 'status' => 'fail', 'message' => 'Invalid JSON payload.'));
    exit;
}
$action= $data["action"] ?? "";
$sno = $data["sno"] ?? "";
$ItemName = $data["ItemName"] ?? "";
$day = $data["day"] ?? "";
$OptionID = $data["OptionID"] ?? "";
$category = $data["category"] ?? "";
$load = $data["load"] ?? "";

if ($load == "get") {
    $category = $data["category"] ?? "";
    getcom($conn, $category);
} 
 elseif ($load == "breakfastfooditems") {
    breakfastfooditems($conn);
}
// elseif ($load == "getlunchitems") {
//     getlunchitems($conn);
// }
elseif ($load == "addlunchitem") {
    addlunchitem($conn);
}
elseif ($load == "updatelunch"){
    updatelunch($conn);
}
// elseif ($action === 'update') {
//     if (empty($OptionID) || empty($ItemName)) {
//         echo json_encode(['code' => '400', 'status' => 'error', 'alert' => 'Invalid data.']);
//         exit;
//     }

//     // Update the item in the fooddetails table
//     $sql = "UPDATE `fooddetails` SET `ItemName` = '$ItemName' WHERE `OptionID` = '$OptionID' AND `category` = '$category'";
//     if ($conn->query($sql) === TRUE) {
//         echo json_encode(['code' => '200', 'status' => 'success', 'alert' => 'Lunch item updated successfully']);
//     } else {
//         echo json_encode(['code' => '500', 'status' => 'error', 'alert' => 'Error updating item']);
//     }
// }

function updatelunch($conn){
    global $ItemName;
    $selectquery = "SELECT * FROM fooddetails WHERE ItemName = '$ItemName'";
    $resultselectquery = getData($conn, $selectquery);
    if (count($resultselectquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => 'Record already exists');
        echo json_encode($jsonresponse);
    }
    else{
    global $ItemName, $OptionID;
    $updatequery = "update fooddetails set ItemName = '$ItemName' where OptionID = '$OptionID'";
    $resultquery = setData($conn, $updatequery);
    
    $jsonresponse = array('code' => '200', 'status' => $ItemName);
    echo json_encode($jsonresponse);
}
}

function addlunchitem($conn) {
    global $ItemName, $OptionID;
    $sqlBreakfastCount = "SELECT COUNT(*) as count FROM fooddetails WHERE category = 1"; // Category 1 represents breakfast
    $resultBreakfastCount = $conn->query($sqlBreakfastCount);

    if ($resultBreakfastCount && $row = $resultBreakfastCount->fetch_assoc()) {
        $breakfastCount = $row['count'];

        // If breakfast items are less than 7, show an error
        if ($breakfastCount < 7) {
            echo json_encode(array('code' => '400', 'status' => 'Please add at least 7 breakfast items first!'));
                
            return;
        }
    } else {
        echo json_encode(array('code' => '500', 'status' => 'Failed!'));
        return;
    }

    $selectquery = "SELECT * FROM `fooddetails` WHERE ItemName = '$ItemName'";
    $resultselectquery = getData($conn, $selectquery);
    if (count($resultselectquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => 'Record already exists');
        echo json_encode($jsonresponse);
             } else {
                $insertquery= "INSERT INTO fooddetails (`OptionID`,`ItemName`,`category`) VALUES ('$OptionID','$ItemName','2')";
                $resultquery = setData($conn, $insertquery);
        
                if ($resultquery == "Record created") {
                    // Log the action in the fooddetails_log table
                    $logsql = "INSERT INTO `fooddetails_log`(`fd_oid`,`item_name`) VALUES ('$OptionID','$ItemName')";
                    $resultlog = setData($conn, $logsql);
                    
                    if ($resultlog == "Record created") {
                        $jsonresponse = array('code' => '200', 'status' => 'Record added successfully', 'data' => $resultquery);
                        echo json_encode($jsonresponse);
                    } else {
                        echo json_encode(array('code' => '500', 'status' => 'Failed to insert record into fooddetails_log'));
                    }
                } else {
                    echo json_encode(array('code' => '500', 'status' => 'Failed to insert record into fooddetails'));
                }
            }
        }
        
            
            

function breakfastfooditems($conn)
{
    global $OptionID, $category, $ItemName, $action;
    if (empty($OptionID) || empty($category) || empty($ItemName)) {
        echo json_encode(array('code' => '400','status' => 'error','message' => 'Fields cannot be empty','alert' => 'Field cannot be empty!'));
        return; // Exit the function early
    }
    $checkSql = "SELECT * FROM `fooddetails` WHERE `ItemName` = '$ItemName' AND `category` = '$category'";
    $Result = getData($conn, $checkSql);

    if (count($Result) > 0) {
        echo json_encode(array('code' => '400','status' => 'error','message' => 'DuplicateValue','alert' => 'Record Already exit' ));

        return; // Exit early to prevent duplicate entries
    }

    if ($action == "insert"){
        $sql = "INSERT INTO `fooddetails`(`OptionID`,`ItemName`,`category`) VALUES ('$OptionID','$ItemName','$category')";   
    }
    else{
        $sql = "UPDATE `fooddetails` SET `ItemName`='$ItemName' WHERE OptionID = $OptionID";
    }
    $resultsql = setData($conn, $sql);
    if ($resultsql == "Record created") {
        $logsql = "INSERT INTO `fooddetails_log`(`fd_oid`, `item_name`) VALUES ('$OptionID','$ItemName')";
        $result = setData($conn, $logsql);
        if ($result == "Record created") {
            echo json_encode(array('code' => '200','status' => 'success','message' => $action == "insert" ? 'Record added successfully!' : 'Record updated successfully!','alert' => $action == "insert" ? 'Record added!' : 'Record updated!'));
        } else {
            echo json_encode(array('code' => '500','status' => 'error','message' => 'Record not inserted in log table','alert' => 'Record not inserted in log table' ));
        }
    } else {
        echo json_encode(array('code' => '500','status' => 'error','message' => 'Record not inserted in fooddetails table','alert' => 'Record not inserted in fooddetails table'));
    }
}
function getcom($conn, $category)
{
    if ($category == 1) { // Breakfast/Dinner
        $sql = "SELECT 
                    w.sno, 
                    w.day, 
                    COALESCE(fd.ItemName, '') AS ItemName
                FROM 
                    week w
                LEFT JOIN 
                    fooddetails fd 
                ON 
                    w.sno = fd.OptionID AND fd.Category IN (1, 3)
                ORDER BY 
                    w.sno";
    } elseif ($category == 2) { // Lunch
        $sql = "SELECT  
                    ItemName
                FROM 
                    fooddetails 
                WHERE 
                    Category = 2";
                   }

    $resultsql = $conn->prepare($sql);
    if (!$resultsql) {
        echo json_encode(array('code' => '500', 'status' => 'error', 'message' => 'Prepare failed: ' . $conn->error));
        return;
    }

    $resultsql->execute();
    $result = $resultsql->get_result();
    if (!$result) {
        echo json_encode(array('code' => '500', 'status' => 'error', 'message' => 'Execution failed: ' . $result->error));
        return;
    }

    $data = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(array('code' => '200', 'status' => 'success', 'data' => $data)); // Send items back as JSON
}

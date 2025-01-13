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
$p_from_date = $data['p_from_date'] ?? "";
$Price = $data["Price"] ?? "";
$from_date = $data["from_date"] ?? "";
$to_date = $data["to_date"] ?? "";
$load = $data["load"] ?? "";
$action= $data["action"] ?? "";

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
else if($load == "load_foodprices"){
    loadFoodPrices($conn);
}
else if($load == "setFoodPrices"){
    setFoodPrices($conn);
}
else if($load == "loadfdby_category"){
    loadfdby_category($conn);
}
else if($load == "loadbreakfast"){
    loadbreakfast($conn);
}
else if($load == "breakfastfooditems"){
    breakfastfooditems($conn);
}
else if($load == "loadlunchitems"){
    loadlunchitems($conn);
}
else if($load == 'addlunch'){
    addlunch($conn);
}

//add lunch
function addlunch($conn){
    global $ItemName,$Price,$from_date;
    $sql = "INSERT INTO `fooddetails`(`ItemName`, `Price`, `category`, `from_date`) 
    VALUES ('$ItemName','$Price','2','$from_date')";
    $resultsql = setData($conn,$sql);
    if($resultsql == "Record created"){
        $last_id = $conn->insert_id;
        $logsql = "INSERT INTO `fooddetails_log`(`fd_oid`, `item_name`, `price`, `fromdate`) 
        VALUES ('$last_id','$ItemName','$Price','$from_date')";
        $logresult = setData($conn,$logsql);
        if($logresult == "Record created"){
            $jsonresponse = array('code'=>'200','status'=>'success');
        }
        else{
            $jsonresponse = array('code'=>'500','status'=>'fail','message'=>"fail to add in log table");
        }
    }
    else{
        $jsonresponse = array('code'=>'500','status'=>'fail');
    }
    echo json_encode($jsonresponse);
}

//laod lunch items
function loadlunchitems($conn){
    $sql = "SELECT * FROM `fooddetails` WHERE category = '2' order by OptionID desc";
    $resultsql = getData($conn,$sql);
    if(count($resultsql) > 0){
        $jsonresponse = array('code'=>'200','status'=>'success','data'=>$resultsql);
    }
    else{
        $jsonresponse = array('code'=>'200','status'=>'success','data'=>'');
    }
    echo json_encode($jsonresponse);
}


//insert and unpdate breakfast
function breakfastfooditems($conn)
{
    global $OptionID,$ItemName, $action,$from_date,$Price;
    if (empty($OptionID) || empty($ItemName)) {
        echo json_encode(array('code' => '400','status' => 'error','message' => 'Fields cannot be empty','alert' => 'Field cannot be empty!'));
        return; // Exit the function early
    }
    $checkSql = "SELECT * FROM `fooddetails` WHERE `ItemName` = '$ItemName' AND `category` = '1'";
    $Result = getData($conn, $checkSql);

    if (count($Result) > 0) {
        echo json_encode(array('code' => '400','status' => 'error','message' => 'DuplicateValue','alert' => 'Record Already exit' ));

        return; // Exit early to prevent duplicate entries
    }

    if ($action == "insert"){
        $sql = "INSERT INTO `fooddetails`(`OptionID`,`ItemName`,`category`) VALUES ('$OptionID','$ItemName','1')";   
    }
    else{
        $sql = "UPDATE `fooddetails` SET `ItemName`='$ItemName' WHERE OptionID = $OptionID";
    }
    $resultsql = setData($conn, $sql);
    if ($resultsql == "Record created") {
        $logsql = "INSERT INTO `fooddetails_log`(`fd_oid`, `item_name`,`price`,`fromdate`) VALUES ('$OptionID','$ItemName','$Price','$from_date')";
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






//load brekfast
function loadbreakfast($conn){
    $selectquery = "SELECT 
    week.sno as ID,
    week.day AS Weekday,
  	COALESCE(fooddetails.Price, '') AS Price,
    COALESCE(fooddetails.ItemName, '') AS FoodItem,
      COALESCE(fooddetails.from_date, '') AS FromDate
    FROM 
        week
    LEFT JOIN 
        fooddetails ON week.sno = fooddetails.OptionID
    ORDER BY 
        week.sno";
    $resultquery = getData($conn,$selectquery);
    if(count($resultquery) > 0){
        $jsonresponse = array('code'=>'200','status'=>'success','data'=>$resultquery);
    }
    else{
        $jsonresponse = array('code'=>'200','status'=>'success','data'=>"No Data");
    }
    echo json_encode(($jsonresponse));
}





//load food items by category 
function loadfdby_category($conn){
    global $category;
    $category = ($category == 3 || $category == 1) ? 1:2;
    $selectquery = "SELECT * FROM `fooddetails` WHERE category = $category";
    $resultsql = getData($conn,$selectquery);
    if(count($resultsql) > 0){
        $jsonresponse = array('code'=>'200','status'=>'success','data'=>$resultsql);
    }
    else{
        $jsonresponse = array('code'=>'200','status'=>'success','data'=>"No Data");
    }
    echo json_encode(($jsonresponse));
}



//loadin prices of food details
function loadFoodPrices($conn){
    global $OptionID,$from_date;
    $selectquery = "SELECT foodtype.type,fooddetails_log.item_name,fooddetails_log.price,fooddetails_log.fromdate,fooddetails.OptionID from fooddetails_log
    join fooddetails on fooddetails_log.fd_oid = fooddetails.OptionID
    join foodtype on fooddetails.category = foodtype.sno
    WHERE 
    fooddetails_log.fromdate IS NOT NULL 
    AND fooddetails_log.fromdate != '0000-00-00' and fooddetails_log.fd_oid = $OptionID";

    $resultquery = getData($conn,$selectquery);
    if(count($resultquery) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success','data'=>$resultquery);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success','data'=>"No Data");
    }
    echo json_encode($jsonresponse);
}

//set the prices
function setFoodPrices($conn){
    global $Price,$OptionID,$from_date,$ItemName,$p_from_date;
    // if($p_from_date == ""){
        $updatequery = "UPDATE `fooddetails` SET `Price`='$Price',
        `from_date`='$from_date' WHERE OptionID = $OptionID";

        $resultupdate = setData($conn,$updatequery);
        if($resultupdate == "Record created"){
            $insertlogprice = "INSERT INTO `fooddetails_log`(`fd_oid`,`price`, `fromdate`,`item_name`) VALUES ('$OptionID','$Price','$from_date','$ItemName')";
            $resultlogprice = setData($conn,$insertlogprice);
            if($resultlogprice == "Record created"){
                $jsonresponse = array('code' => '200', 'status' => 'success','message'=>"Record Updated");
            }
            else{
                $jsonresponse = array('code' => '500', 'status' => 'fail','message'=>"Fail To Record Insert in fooddetail log");
            }
        }
        else{
            $jsonresponse = array('code' => '500', 'status' => 'fail','message'=>"Fail To Record Insert in fooddetail");
        }
        
    // }
    // else{
    //    $fromdate = date_create("$from_date");
    //    $to_date =date_create("$from_date");
    //    $to_date->modify("-1 day");
    //    $updatequery = "UPDATE `fooddetails` SET `Price`='$Price',
    //    `from_date`='$from_date' WHERE OptionID = $OptionID";

    //    $resultupdate = setData($conn,$updatequery);

    //    if($resultupdate == "Record created"){
    //     $insertlogprice = "INSERT INTO `fooddetails_log`(`fd_oid`,`price`, `fromdate`,`item_name`) VALUES ('$OptionID','$Price','$from_date','$ItemName')";
    //     $resultlogprice = setData($conn,$insertlogprice);
    //     if($resultlogprice == "Record created"){
    //         $jsonresponse = array('code' => '200', 'status' => 'success','message'=>"Record Updated");
    //     }
    //     else{
    //         $jsonresponse = array('code' => '500', 'status' => 'fail','message'=>"Fail To Record Insert in fooddetail log");
    //     }
    //     }
    //     else{
    //         $jsonresponse = array('code' => '500', 'status' => 'fail','message'=>"Fail To Record Insert in fooddetail");
    //     }
    // }
    echo json_encode($jsonresponse);
   
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

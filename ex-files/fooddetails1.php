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
$activity = $data['activity'] ?? "";
$item= $data["item"] ?? "";
$weeksno = $data["weeksno"] ?? "";
$logsno = $data['logsno'] ?? "";
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
else if($load == "load_foodhistory"){
    loadFoodhistory($conn);
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
else if($load == "activate_deactive_lunch"){
    lunchActivity($conn);
}
else if($load == "loadbfitems"){
    loadbfitems($conn);
}
else if($load == "addbf"){
    addbf($conn);
}
else if($load == "loadbreakfast"){
    loadbreakfast($conn);
}
else if($load == "setbreakfast"){
    setBreakFast($conn);
}
else if($load == "activiyBF"){
    activityBF($conn);
}
else if($load == "updatePrice"){
    updatePrice($conn);
}
// else if($load == 'setbreakfast'){
//     setBreakFast($conn);
    
// }
// else if($load == 'additem'){
//     additem($conn);
// }
// else if($load == 'setactivity'){
//     setactivity($conn);
// }
// else if($load == 'loaditems'){
//     loaditems($conn);
// }

//update the price of the items
       
function updatePrice($conn){
    global $logsno,$OptionID,$Price;
    $updatefdquery = "UPDATE `fooddetails` SET `Price`='$Price' WHERE OptionID = '$OptionID'";
    $resultquery = setData($conn,$updatefdquery);
    if($resultquery == "Record created"){
        $updatequery = "UPDATE `fooddetails_log` SET `price`='$Price' WHERE log_sno = '$logsno'";
        $logresult = setData($conn,$updatequery);
        if($logresult == "Record created"){
            $jsonresponse = array('code'=>'200','status'=>'success');
        }
        else{
            $jsonresponse = array('code'=>'500','status'=>'fail','msg'=>"failed to add in food log table");
        }
    }
    else{
        $jsonresponse = array('code'=>'500','status'=>'fail','msg'=>"failed to add in fooddetail table");
    }
    echo json_encode($jsonresponse);
 
}


//activity of breakfast
function activityBF($conn){
    global $activity,$OptionID;
    $updatesql = "UPDATE `fooddetails` SET `activity`='$activity' WHERE `OptionID` = $OptionID";
    $resultupdate = setData($conn,$updatesql);
    if($resultupdate == "Record created"){
        $jsonresponse = array('code'=>'200','status'=>'success');
    }
    else{
        $jsonresponse = array('code'=>'500','status'=>'fail');
    }
    echo json_encode($jsonresponse);
}


//function for loadbreakfast
function loadbreakfast($conn){
    $selectquery = "SELECT week.sno,week.day,COALESCE(fooddetails.ItemName,'') as ItemName,week.OptionID,week.fromdate
    from week
    left join fooddetails on week.OptionID = fooddetails.OptionID";
    $resultquery = getData($conn,$selectquery);
    if(count($resultquery) > 0){
        $jsonresponse = array('code'=>'200','status'=>'success','data'=>$resultquery);
    }
    else{
        $jsonresponse = array('code'=>'200','status'=>'success','data'=>"No Data");
    }
    echo json_encode(($jsonresponse));
}


//add breakfast
function addbf($conn){
    global $ItemName, $category;

    // Check for duplicate records in the database
    $selectquery = "SELECT * FROM fooddetails WHERE ItemName = '$ItemName' and category = '$category'";
    $resultselectquery = getData($conn, $selectquery);

    if (count($resultselectquery) > 0) {
        // Record already exists
        $jsonresponse = array('code' => '200', 'status' => 'exists');
        echo json_encode($jsonresponse);
    } else {
        $sql = "INSERT INTO `fooddetails`(`ItemName`, `category`) VALUES ('$ItemName','$category')";
        $resultsql = setData($conn,$sql);
        if($resultsql == "Record created"){
            $lastinsertid = mysqli_insert_id($conn); 
            $logsql = "INSERT INTO `fooddetails_log`(`fd_oid`, `item_name`) 
            VALUES ('$lastinsertid','$ItemName')";
            $logresultsql = setData($conn,$logsql);
            if($logresultsql == "Record created"){
                $jsonresponse = array('code'=>'200','status'=>'success');
            }
            else{
                $jsonresponse = array('code'=>'400','status'=>'fail to insert in food log');
            }   
        }
        else{
            $jsonresponse = array('code'=>'500','status'=>'fail');
        }
        echo json_encode($jsonresponse);
    }
}


//load bfitems
function loadbfitems($conn){
    $selectquery = "select itemName, activity, OptionID from fooddetails where category=1  ";
    $resultquery = getData($conn,$selectquery);

    if(count($resultquery) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success','data' => $resultquery);
        echo json_encode($jsonresponse);
    }
}



function setactivity($conn) {
    global $activity, $OptionID;
    $insertquery = "update fooddetails set activity= '$activity' WHERE OptionID= '$OptionID' ";
    $result= setData($conn, $insertquery);
    $jsonresponse = array('status'=>'updated');
    echo json_encode($jsonresponse);
}

function additem($conn) {
    global $item, $activity, $category;

    // Check for duplicate records in the database
    $selectquery = "SELECT * FROM fooddetails WHERE ItemName = '$item' AND activity = '$activity'";
    $resultselectquery = getData($conn, $selectquery);

    if (count($resultselectquery) > 0) {
        // Record already exists
        $jsonresponse = array('code' => '200', 'status' => 'Record already exists');
        echo json_encode($jsonresponse);
    } else {
        $query = "SELECT COALESCE(max(OptionID)+1,1) as OptionID FROM fooddetails WHERE category='$category'";
        $result = $conn->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $foodid = $row['OptionID'];
        }
        // Insert new record
        $insertquery = "INSERT INTO fooddetails (ItemName, activity, OptionID, category) VALUES ('$item', '$activity', '$foodid', '$category')";
        $resultquery = setData($conn, $insertquery);

        if ($resultquery == "Record created") {
            // Record added successfully
            $jsonresponse = array('code' => '200', 'status' => 'Record added successfully');
            echo json_encode($jsonresponse);
        } else {
            // Handle any insert errors
            $jsonresponse = array('code' => '500', 'status' => 'Failed to add record');
            echo json_encode($jsonresponse);
        }
    }
}
function loaditems($conn){
    $selectquery = "select itemName, activity, OptionID from fooddetails where category=1  ";
    $resultquery = getData($conn,$selectquery);

    if(count($resultquery) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success','data' => $resultquery);
        echo json_encode($jsonresponse);
    }
}

//lunch activity
function lunchActivity($conn){
    global $activity,$OptionID;
    $updatesql = "UPDATE `fooddetails` SET `activity`='$activity' WHERE `OptionID` = $OptionID";
    $resultupdate = setData($conn,$updatesql);
    if($resultupdate == "Record created"){
        $jsonresponse = array('code'=>'200','status'=>'success');
    }
    else{
        $jsonresponse = array('code'=>'500','status'=>'fail');
    }
    echo json_encode($jsonresponse);
}




//add lunch
function addlunch($conn){
    global $ItemName,$Price,$from_date;
    $checkSql = "SELECT * FROM `fooddetails` WHERE `ItemName` = '$ItemName' AND `category` = '2'";
    $Result = getData($conn, $checkSql);

    if (count($Result) > 0) {
        echo json_encode(array('code' => '200','status' => 'duplicate','message' => 'DuplicateValue','alert' => 'Record Already exit' ));

        return; 
    }
    else{
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
    }
    
    echo json_encode($jsonresponse);
}

//laod lunch items
function loadlunchitems($conn){
    $sql = "SELECT * FROM `fooddetails` WHERE category = '2' order by ItemName desc";
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

        return; 
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
// function loadbreakfast($conn){
//     $selectquery = "SELECT week.sno,week.day,COALESCE(fooddetails.ItemName,'') as ItemName,week.OptionID,week.fromdate
// from week
// left join fooddetails on week.OptionID = fooddetails.OptionID";
//     $resultquery = getData($conn,$selectquery);
//     if(count($resultquery) > 0){
//         $jsonresponse = array('code'=>'200','status'=>'success','data'=>$resultquery);
//     }
//     else{
//         $jsonresponse = array('code'=>'200','status'=>'success','data'=>"No Data");
//     }
//     echo json_encode(($jsonresponse));
// }

//set breakfastfoodiitems
function setBreakFast($conn){
    global $OptionID,$from_date,$weeksno;
    $updatequery = "UPDATE week SET OptionID='$OptionID',fromdate='$from_date' WHERE sno = $weeksno";
    $resultupdate = setData($conn,$updatequery);
    if($resultupdate == "Record created"){
        $insertlog = "INSERT INTO week_log(weeksno, optionid, fromdate) VALUES ('$weeksno','$OptionID','$from_date')";
        $resultlog = setData($conn,$insertlog);
        if($resultlog == "Record created"){
            $jsonresponse = array('code'=>'200','status'=>'success');
        }
        else{
            $jsonresponse = array('code'=>'500','status'=>'fail','message'=>"fail to insert in week log table");
        }
    }
    else{
        $jsonresponse = array('code'=>'500','status'=>'fail','message'=>"fail to update in week table");
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
    global $OptionID,$from_date,$category;
    $optionquery = ($OptionID) ? " AND fooddetails_log.fd_oid = '$OptionID'" : "";
    if($category == 3){
        $category = 1;
    }
    $selectquery = "SELECT fooddetails_log.log_sno,foodtype.type,fooddetails_log.item_name,fooddetails_log.price,fooddetails_log.fromdate,fooddetails.OptionID from fooddetails_log
    join fooddetails on fooddetails_log.fd_oid = fooddetails.OptionID
    join foodtype on fooddetails.category = $category
    WHERE 
    fooddetails_log.fromdate IS NOT NULL 
    AND fooddetails_log.fromdate != '0000-00-00' 
    $optionquery
    order by fooddetails_log.fromdate desc";

    $resultquery = getData($conn,$selectquery);
    if(count($resultquery) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success','data'=>$resultquery);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success','data'=>"No Data");
    }
    echo json_encode($jsonresponse);
}

function loadFoodhistory($conn){
    global $OptionID,$from_date;
   
    $selectquery = "SELECT fooddetails_log.log_sno,foodtype.type,fooddetails_log.item_name,fooddetails_log.price,fooddetails_log.fromdate,fooddetails.OptionID from fooddetails_log
    join fooddetails on fooddetails_log.fd_oid = fooddetails.OptionID
    join foodtype on fooddetails.category = foodtype.sno
    WHERE 
    fooddetails_log.fromdate IS NOT NULL 
    AND fooddetails_log.fromdate != '0000-00-00' 
    and fooddetails_log.fd_oid = $OptionID 
    order by fooddetails_log.fromdate desc";

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

    $checkdate = "SELECT * FROM `fooddetails_log` WHERE `fromdate`='$from_date' and `fd_oid` = '$OptionID'";
    $resultcheck = getData($conn,$checkdate);

    if(count($resultcheck) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success','message'=>"Record Exist");
    }
    // if(count($resultcheck) > 0){
    //     $updateprice = "UPDATE `fooddetails` SET `Price`='$Price',
    //     `from_date`='$from_date' WHERE OptionID = $OptionID";
    //     $resultupdate = setData($conn,$updateprice);

    //     if($resultupdate == "Record created"){
    //         $updatelog = "UPDATE `fooddetails_log` SET `price`='$Price',`fromdate`='$from_date' WHERE `fd_oid`='$OptionID'";
    //         $resultupdatelog = setData($conn,$updatelog);
    //         if($resultupdatelog == "Record created"){
    //             $jsonresponse = array('code' => '200', 'status' => 'success','message'=>"Record Updated");
    //         }
    //         else{
    //             $jsonresponse = array('code' => '500', 'status' => 'fail','message'=>"Fail To Record Update in fooddetail log");
    //         }
    //     }
    //     else{
    //         $jsonresponse = array('code' => '500', 'status' => 'fail','message'=>"Fail To Record Update in fooddetail");
    //     }
  
    // }
    else{
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
    }    
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

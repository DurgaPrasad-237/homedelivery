<?php
include('config.php');
include('dblayer.php');
$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata, true);

$sno = $data["sno"] ?? "";
$csno = $data["csno"] ?? ""; 
$OptionID = $data["OptionID"] ?? "";
$category = $data["category"] ?? "";
$foodtype = $data["category"] ?? "";
$ssubcategory = $data["ssubcategory"] ?? "";
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
$subcategory = $input['subcategory'] ?? '';
$sbcategory = $data['sbcategory'] ?? '';
$itemname = $input['itemname'] ?? '';
$price = $input['price'] ?? '';
$currentActivity = $data['activity'] ?? '';
$todaydate = $data['todaydate'] ?? '';
$tmrdate = $data['tmrdate'] ?? '';
$updateactivity = $data['updateactivity'] ?? '';


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
else if($load == "load_foodpricessub"){
    loadFoodPricessub($conn);
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
else if($load == "loadfoodtype"){
    loadfoodcategory($conn);
}
else if($load == "loadsubcategory"){
    loadsubcategory($conn);
}
else if($load == "loadItemsByCategory"){
    loadItemsByCategory($conn);
}
elseif ($load == "addSubcategory") {
    addSubcategory($conn);
}
else if($load == "loadsubcategory1"){
 loadsubcategory1($conn, $foodtype);
}
else if($load == "loadfoodtype1"){
    loadfoodcategory1($conn);
}
else if($load == "loadItemsByCategory1"){
    loadItemsByCategory1($conn);
}
else if($load == "additemname"){
    additemname($conn);
}
else if($load == "updateSubcategory"){
    updateSubcategory($conn);
}
else if($load == "activityStatusChange"){
    activityStatusChange($conn);
}
else if($load == "updateitemname"){
    updateitemname($conn);
}
else if($load == "activityStatusChangei"){
    activityStatusChangei($conn);
}
else if($load == "loadtodaybfitem"){
    loadtodaybfitem($conn);
}
else if($load == "loadtodaylunitem"){
    loadtodaylunitem($conn);
}
else if($load == "loadbfitems"){
    loadbfitems($conn);
}
else if($load == "loadbybfitemstmrdate"){
    loadbfitemstmrdate($conn);
}
else if($load == "loadbylunitemstmrdate"){
    loadbylunitemstmrdate($conn);
}
else if($load == "loadbydinitemstmrdate"){
    loadbydinitemstmrdate($conn);
}
else if($load == "loadsubbreakfast"){
    loadsubbreakfast($conn);
}
else if($load == "loadlunchsub"){
    loadlunchsub($conn);
}
else if($load == "loaddinnersub"){
    loaddinnersub($conn);
}
else if($load == "setitem"){
    setitem($conn);
}
else if($load == "bfcatitems"){
    bfcatitems($conn);
}
else if($load == "lunchcatitems"){
    lunchcatitems($conn);
}
else if($load == "dincatitems"){
    dincatitems($conn);
}
else if($load == "checktmritem"){
    checktrmitem($conn);
}
else if($load == "checktmrlunitem"){
    checktmrlunitem($conn);
}
else if($load == "checktmrdinitem"){
    checktrmdinitem($conn);
}
else if($load == "loadtodaydinneritem"){
    loadtodaydinneritem($conn);
}



function checktrmdinitem($conn){
    global $tmrdate;
    $sql = "SELECT dinnerschedule.sno,fooddetails.ItemName,fooddetails.OptionID,fooddetails.subcategory from dinnerschedule
            join fooddetails on dinnerschedule.FoodID = fooddetails.OptionID
            where dinnerschedule.Date = '$tmrdate'";
    $result = getData($conn,$sql);

    if(count($result) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $result);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}



function checktrmitem($conn){
    global $tmrdate;
    $sql = "SELECT breakfastschedule.sno,fooddetails.ItemName,fooddetails.OptionID,fooddetails.subcategory from breakfastschedule
            join fooddetails on breakfastschedule.FoodID = fooddetails.OptionID
            where breakfastschedule.Date = '$tmrdate'";
    $result = getData($conn,$sql);

    if(count($result) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $result);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}

//check tomorrow lunch item
function checktmrlunitem($conn){
    global $tmrdate;
    $sql = "SELECT lunchschedule.sno,fooddetails.ItemName,fooddetails.OptionID,fooddetails.subcategory from lunchschedule
            join fooddetails on lunchschedule.FoodID = fooddetails.OptionID
            where lunchschedule.Date = '$tmrdate'";
    $result = getData($conn,$sql);

    if(count($result) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $result);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}

//load breakfast sub category items
function bfcatitems($conn){
    global $ssubcategory;
    $sql = "SELECT * from fooddetails WHERE subcategory = $ssubcategory";
    $resultsql = getData($conn,$sql);
    if(count($resultsql) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultsql);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}
//function forload lunch sub category items
function lunchcatitems($conn){
    global $ssubcategory;
    $sql = "SELECT * from fooddetails WHERE subcategory = $ssubcategory";
    $resultsql = getData($conn,$sql);
    if(count($resultsql) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultsql);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}

//function for load dinner sub category items
function dincatitems($conn){
    global $ssubcategory;
    $sql = "SELECT * from fooddetails WHERE subcategory = $ssubcategory";
    $resultsql = getData($conn,$sql);
    if(count($resultsql) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultsql);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}


function loadsubbreakfast($conn){
    global $foodtype;
    $sql = "select subcategory,SNO from subcategory where foodtype = $foodtype";
    $resultsql = getData($conn,$sql);
    if(count($resultsql) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultsql);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}

//function for load lunch sub category
function loadlunchsub($conn){
    global $foodtype;
    $sql = "select subcategory,SNO from subcategory where foodtype = $foodtype";
    $resultsql = getData($conn,$sql);
    if(count($resultsql) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultsql);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}


//function for load dinner sub category
function loaddinnersub($conn){
    global $foodtype;
    $sql = "select subcategory,SNO from subcategory where foodtype = $foodtype";
    $resultsql = getData($conn,$sql);
    if(count($resultsql) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultsql);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}


function setitem($conn){
    global $OptionID,$tmrdate,$foodtype,$ssubcategory,$updateactivity;
    $itempricejsql = "SELECT Price from fooddetails where OptionID = $OptionID and subcategory = $ssubcategory";
    $priceresulsql = getData($conn,$itempricejsql);
    $itemprice = $priceresulsql[0]['Price'];

    if($updateactivity == 1){
        if($foodtype == 1){
            $insertschsql = "INSERT INTO `breakfastschedule`(`Date`, `FoodID`) VALUES ('$tmrdate','$OptionID')";
            $resultsqlsch = setData($conn,$insertschsql);
        }
        else if($foodtype == 3){
            $insertschsql = "INSERT INTO `dinnerschedule`(`Date`, `FoodID`) VALUES ('$tmrdate','$OptionID')";
            $resultsqlsch = setData($conn,$insertschsql);
        }
        else{
            $insertschsql = "INSERT INTO `lunchschedule`(`Date`, `FoodID`) VALUES ('$tmrdate','$OptionID')";
            $resultsqlsch = setData($conn,$insertschsql);
        }
       
    }
    else{
        if($foodtype == 1){
            $insertschsql = "UPDATE `breakfastschedule` SET `FoodID`='$OptionID' WHERE breakfastschedule.Date = '$tmrdate'";
            $resultsqlsch = setData($conn,$insertschsql);
        }
        else if($foodtype == 3){
            $insertschsql = "UPDATE `dinnerschedule` SET `FoodID`='$OptionID' WHERE dinnerschedule.Date = '$tmrdate'";
            $resultsqlsch = setData($conn,$insertschsql);
        }
        else{
            $insertschsql = "UPDATE `lunchschedule` SET `FoodID`='$OptionID' WHERE lunchschedule.Date = '$tmrdate'";
            $resultsqlsch = setData($conn,$insertschsql);
        }
       
    }
   

    if($resultsqlsch == 'Record created'){
         //get the list of tmrorders
        if($updateactivity == 1){
                $sqltmrorder = "
                UPDATE orders o
                JOIN (
                    SELECT OrderID, Quantity 
                    FROM orders 
                    WHERE OrderDate = '$tmrdate'
                    AND Status = 1
                    AND SubCategorySno = 0  
                    AND FoodTypeID = '$foodtype'
                ) q 
                ON o.OrderID = q.OrderID
                SET o.TotalAmount = q.Quantity * $itemprice,
                    o.FoodID = $OptionID,
                    o.SubCategorySno = $ssubcategory
                WHERE o.SubCategorySno = 0  
                AND o.FoodTypeID = '$foodtype'
                ";
        }
        else{
            $sqltmrorder = "
                UPDATE orders o
                JOIN (
                    SELECT OrderID, Quantity 
                    FROM orders 
                    WHERE OrderDate = '$tmrdate'
                    AND Status = 1
                    AND SubCategorySno = $ssubcategory  
                    AND FoodTypeID = '$foodtype'
                ) q 
                ON o.OrderID = q.OrderID
                SET o.TotalAmount = q.Quantity * $itemprice,
                    o.FoodID = $OptionID
                WHERE o.SubCategorySno = $ssubcategory  
                AND o.FoodTypeID = '$foodtype'
                ";
        }
               

        $resultmrorder = setData($conn,$sqltmrorder);

        if($resultmrorder == 'Record created'){
            // //get the ordersno
            $sqlosno = "SELECT SNO,CustomerID,Quantity,OrderID,TotalAmount,FoodTypeID from Orders WHERE FoodTypeID = $foodtype and Status = 1 and FoodID = $OptionID and OrderDate = '$tmrdate'";
            $sqlosnoresult = getData($conn,$sqlosno);
            if(count($sqlosnoresult) > 0){
                $jsonresponse = insertToLog($sqlosnoresult,$conn);
            }    
            else{
                $jsonresponse = array('code' => '200', 'status' => 'success' ,'msg'=>"successfully update the order price and id",'d'=>$resultmrorder);
            } 
        }
        else{
            $jsonresponse = array('code' => '500', 'status' => 'fail' ,'msg'=>"failed to update the order price and id");
        }
    }
    else{
        $jsonresponse = array('code' => '500', 'status' => 'fail' ,'msg'=>"failed to insert the scheduletable",'d'=>$foodtype);
    }
    echo json_encode($jsonresponse);
}

//function for record insert in logs table
function insertToLog($resultarr,$conn){
    foreach($resultarr as $rowlog){
        $sqlloginsert = "INSERT INTO `logs`(`OrderSno`, `CustomerID`, `OrderID`, `Quantity`, `Price`, `FoodType`) 
         VALUES ('{$rowlog['SNO']}', '{$rowlog['CustomerID']}', '{$rowlog['OrderID']}', '{$rowlog['Quantity']}', '{$rowlog['TotalAmount']}', '{$rowlog['FoodTypeID']}')";
        $sqlresultinsert = setData($conn,$sqlloginsert);
        if($sqlresultinsert != 'Record created'){
            return array('code' => '500', 'status' => 'fail' ,'msg'=>"failed to insert data in logtable");
        }
    }
    return array('code' => '200', 'status' => 'success','d'=>$resultarr);
}


function loadbfitemstmrdate($conn){
    global $tmrdate;

    $sql = "SELECT breakfastschedule.sno,fooddetails.ItemName,fooddetails.OptionID from breakfastschedule
            join fooddetails on breakfastschedule.FoodID = fooddetails.OptionID
            where breakfastschedule.Date = '$tmrdate'";
    $resulsql = getData($conn,$sql);

    if(count($resulsql) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resulsql);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}
//load lunch tomorrow item
function loadbylunitemstmrdate($conn){
    global $tmrdate;

    $sql = "SELECT lunchschedule.sno,fooddetails.ItemName,fooddetails.OptionID from lunchschedule
            join fooddetails on lunchschedule.FoodID = fooddetails.OptionID
            where lunchschedule.Date = '$tmrdate'";
    $resulsql = getData($conn,$sql);

    if(count($resulsql) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resulsql);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}

//load tomorrow dinner item
function loadbydinitemstmrdate($conn){
    global $tmrdate;

    $sql = "SELECT dinnerschedule.sno,fooddetails.ItemName,fooddetails.OptionID from dinnerschedule
            join fooddetails on dinnerschedule.FoodID = fooddetails.OptionID
            where dinnerschedule.Date = '$tmrdate'";
    $resulsql = getData($conn,$sql);

    if(count($resulsql) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resulsql);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}




function loadtodaybfitem($conn){
    global $todaydate;
    $sql = "SELECT breakfastschedule.Date,fooddetails.ItemName FROM `breakfastschedule` 
            join fooddetails on breakfastschedule.FoodID = fooddetails.OptionID
            where breakfastschedule.Date = '$todaydate'";
    $resultsql = getData($conn,$sql);
    if(count($resultsql) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultsql);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}
//load curry
function loadtodaylunitem($conn){
    global $todaydate;
    $sql = "SELECT lunchschedule.Date,fooddetails.ItemName FROM `lunchschedule` 
            join fooddetails on lunchschedule.FoodID = fooddetails.OptionID
            where lunchschedule.Date = '$todaydate'";
    $resultsql = getData($conn,$sql);
    if(count($resultsql) > 0){
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultsql);
    }
    else{
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}

//function for load today dinner item
function loadtodaydinneritem($conn){
    global $todaydate;
    $sql = "SELECT dinnerschedule.Date,fooddetails.ItemName FROM `dinnerschedule` 
    join fooddetails on dinnerschedule.FoodID = fooddetails.OptionID
    where dinnerschedule.Date = '$todaydate'";
    $resultsql = getData($conn,$sql);
    if(count($resultsql) > 0){
    $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultsql);
    }
    else{
    $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => '');
    }
    echo json_encode($jsonresponse);
}



function activityStatusChangei($conn){
    global $newActivity,$sno,$currentActivity;
      $newActivity = ($currentActivity == 1) ? 0 : 1; // Toggle between 1 and 0
  
      $sql = "UPDATE fooddetails SET activity = '$newActivity' WHERE OptionID = '$sno'";
      $result = mysqli_query($conn, $sql);
  
      if ($result) {
          $statusText = ($newActivity == 1) ? "Active" : "Inactive";
          echo json_encode(["status" => "success", "msg" => "Status changed to $statusText."]);
      } else {
          echo json_encode(["status" => "error", "msg" => "Failed to update status."]);
      }
}

function updateitemname($conn){
    global $sno;
    $input = json_decode(file_get_contents("php://input"), true); 
    $foodtype = $input['foodtype'] ?? '';
    $subcategory = $input['subcategory'] ?? '';
    $itemname = $input['itemname'] ?? '';
    $price = $input['price'] ?? '';

    if (empty($subcategory)) {
        echo json_encode(['code' => '400', 'status' => 'fail', 'msg' => 'Subcategory name is required.']);
        return;
    }

    if (empty($foodtype)) {
        echo json_encode(['code' => '400', 'status' => 'fail', 'msg' => 'Category is required.']);
        return;
    }
    if (empty($itemname)) {
        echo json_encode(['code' => '400', 'status' => 'fail', 'msg' => 'ItemName is required.']);
        return;
    }

    $foodtype = mysqli_real_escape_string($conn, $foodtype);
    $subcategory = mysqli_real_escape_string($conn, $subcategory);
    $itemname = mysqli_real_escape_string($conn, $itemname);
    $price = mysqli_real_escape_string($conn, $price);

    $checkQuery = "SELECT OptionID,ItemName,Price from fooddetails where category ='$foodtype'  AND subcategory = '$subcategory' AND ItemName = '$itemname' AND price = '$price';";
    $checkResult = getData($conn, $checkQuery);

    if (count($checkResult) > 0) {
      
        echo json_encode(['code' => '409', 'status' => 'fail', 'msg' => 'Subcategory already exists for this category.']);
        return;
    }

    // ✅ Insert if not exists
    $query = "UPDATE fooddetails SET category='$foodtype',subcategory= '$subcategory', ItemName = '$itemname ' WHERE OptionID='$sno'";
    $result = setdata($conn, $query);

    if ($result == "Record created") {
        $jsonresponse = array('code' => '201', 'status' => 'success', 'msg' => 'Subcategory added successfully.');
    } else {
        $jsonresponse = array('code' => '500', 'status' => 'fail', 'msg' => 'Failed to add subcategory.');
    }

    echo json_encode($jsonresponse);
}

function additemname($conn){
    $input = json_decode(file_get_contents("php://input"), true); 
    $foodtype = $input['foodtype'] ?? '';
    $subcategory = $input['subcategory'] ?? '';
    $itemname = $input['itemname'] ?? '';
    $price = $input['price'] ?? '';


    if (empty($subcategory)) {
        echo json_encode(['code' => '400', 'status' => 'fail', 'msg' => 'Subcategory name is required.']);
        return;
    }

    if (empty($foodtype)) {
        echo json_encode(['code' => '400', 'status' => 'fail', 'msg' => 'Category is required.']);
        return;
    }
    if (empty($itemname)) {
        echo json_encode(['code' => '400', 'status' => 'fail', 'msg' => 'ItemName is required.']);
        return;
    }

    $foodtype = mysqli_real_escape_string($conn, $foodtype);
    $subcategory = mysqli_real_escape_string($conn, $subcategory);
    $itemname = mysqli_real_escape_string($conn, $itemname);
    $price = mysqli_real_escape_string($conn, $price);

    $checkQuery = "SELECT OptionID,ItemName,Price from fooddetails where category ='$foodtype'  AND subcategory = '$subcategory' AND ItemName = '$itemname' AND price = '$price';";
    $checkResult = getData($conn, $checkQuery);

    if (count($checkResult) > 0) {
      
        echo json_encode(['code' => '409', 'status' => 'fail', 'msg' => 'Subcategory already exists for this category.']);
        return;
    }

    // ✅ Insert if not exists
    $query = "INSERT into fooddetails (category,subcategory,ItemName,Price,from_date) VALUES ('$foodtype', '$subcategory','$itemname','$price', CURDATE())";
    $result = setdata($conn, $query);

    if ($result == "Record created") {
        $lastinsertid = mysqli_insert_id($conn); 
            $logsql = "INSERT INTO `fooddetails_log`(`fd_oid`, `item_name`,`price`,`fromdate`) 
            VALUES ('$lastinsertid','$itemname','$price', CURDATE())";
            $logresultsql = setData($conn,$logsql);
            if($logresultsql == "Record created"){
                $jsonresponse = array('code'=>'200','status'=>'success');
    } else {
        $jsonresponse = array('code' => '500', 'status' => 'fail', 'msg' => 'Failed to add subcategory.');
    }

    echo json_encode($jsonresponse);
  
}
}

// fetcching items for item menu

function loadItemsByCategory1($conn) {

    // Get input data
    $input = json_decode(file_get_contents("php://input"), true);

    // Sanitize input
    $foodtype = $conn->real_escape_string($input["category"] ?? "");
    $subcategory = $conn->real_escape_string($input["subcategory"] ?? "");
    // Query to fetch items based on category
    $query = "SELECT OptionID,ItemName,Price,subcategory,activity FROM fooddetails WHERE category = '$foodtype'AND subcategory = '$subcategory';";

    $result = $conn->query($query);

    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $data);
    } else {
        $jsonresponse = array('code' => '404', 'status' => 'fail', 'msg' => "No items found for this category.");
    }
    echo json_encode($jsonresponse);
}
// Function to load items for item menu screen
function loadfoodcategory1($conn) {
    $selectQuery = "SELECT * FROM foodtype ORDER BY sno ASC";
    $resultquery = getdata($conn, $selectQuery);

    if (count($resultquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultquery);
    } else {
        $jsonresponse = array('code' => '200', 'status' => 'error', 'data'=>'','message' => 'No foodtype found');
    }
    echo json_encode($jsonresponse);
}

//  for item menu screen
function loadsubcategory1($conn, $foodtype) {
    $foodtype = mysqli_real_escape_string($conn, $foodtype);
    $selectQuery = "SELECT sno, subcategory,activity FROM subcategory WHERE foodtype = '$foodtype' ORDER BY sno ASC";
    $resultquery = getdata($conn, $selectQuery);

    if (count($resultquery) > 0) {
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $resultquery);
    } else {
        $jsonresponse = array('code' => '200', 'status' => 'error', 'message' => 'No subcategory found for this food type');
    }
    echo json_encode($jsonresponse);
}


function loadItemsByCategory($conn) {
    // Get input data
    $input = json_decode(file_get_contents("php://input"), true);

    // Sanitize input
    $foodtype = $conn->real_escape_string($input["category"] ?? "");

    // Query to fetch items based on category
    $query = "SELECT SNO, subcategory,activity FROM subcategory WHERE foodtype = '$foodtype' ORDER BY SNO ASC;";
    $result = $conn->query($query);

    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $jsonresponse = array('code' => '200', 'status' => 'success', 'data' => $data);
    } else {
        $jsonresponse = array('code' => '404', 'status' => 'fail', 'msg' => "No items found for this category.");
    }
    echo json_encode($jsonresponse);
}


// Function to add subcategory
function addSubcategory($conn) {
    $input = json_decode(file_get_contents("php://input"), true); 
    $foodtype = $input['foodtype'] ?? '';
    $subcategory = $input['subcategory'] ?? '';

    if (empty($subcategory)) {
        echo json_encode(['code' => '400', 'status' => 'fail', 'msg' => 'Subcategory name is required.']);
        return;
    }

    if (empty($foodtype)) {
        echo json_encode(['code' => '400', 'status' => 'fail', 'msg' => 'Category is required.']);
        return;
    }

    // ✅ Escape inputs to prevent SQL injection
    $foodtype = mysqli_real_escape_string($conn, $foodtype);
    $subcategory = mysqli_real_escape_string($conn, $subcategory);

    // 🔍 Check if the subcategory already exists for the selected foodtype
    $checkQuery = "SELECT * FROM subcategory WHERE foodtype = '$foodtype' AND subcategory = '$subcategory' AND Activity = 1";
    $checkResult = getData($conn, $checkQuery);

    if (count($checkResult) > 0) {
      
        echo json_encode(['code' => '409', 'status' => 'fail', 'msg' => 'Subcategory already exists for this category.']);
        return;
    }

    // ✅ Insert if not exists
    $query = "INSERT INTO subcategory (`foodtype`, `subcategory`,`activity`) VALUES ('$foodtype', '$subcategory','1')";
    $result = setdata($conn, $query);

    if ($result == "Record created") {
        $jsonresponse = array('code' => '201', 'status' => 'success', 'msg' => 'Subcategory added successfully.');
    } else {
        $jsonresponse = array('code' => '500', 'status' => 'fail', 'msg' => 'Failed to add subcategory.');
    }

    echo json_encode($jsonresponse);
}

function updateSubcategory($conn){
    global $sno,$activity;
    $input = json_decode(file_get_contents("php://input"), true); 
    $foodtype = $input['foodtype'] ?? '';
    $subcategory = $input['subcategory'] ?? '';

    if (empty($subcategory)) {
        echo json_encode(['code' => '400', 'status' => 'fail', 'msg' => 'Subcategory name is required.']);
        return;
    }

    if (empty($foodtype)) {
        echo json_encode(['code' => '400', 'status' => 'fail', 'msg' => 'Category is required.']);
        return;
    }

    // ✅ Escape inputs to prevent SQL injection
    $foodtype = mysqli_real_escape_string($conn, $foodtype);
    $subcategory = mysqli_real_escape_string($conn, $subcategory);

    // 🔍 Check if the subcategory already exists for the selected foodtype
    $checkQuery = "SELECT * FROM subcategory WHERE foodtype = '$foodtype' AND subcategory = '$subcategory'";
    $checkResult = getData($conn, $checkQuery);

    if (count($checkResult) > 0) {
      
        echo json_encode(['code' => '409', 'status' => 'fail', 'msg' => 'Subcategory already exists for this category.']);
        return;
    }

    // ✅ Insert if not exists
    $query = "update subcategory set foodtype='$foodtype' , subcategory='$subcategory',activity='$activity'  WHERE SNO='$sno'";
    $result = setdata($conn, $query);

    if ($result == "Record created") {
        $jsonresponse = array('code' => '201', 'status' => 'success', 'msg' => 'Subcategory added successfully.');
    } else {
        $jsonresponse = array('code' => '500', 'status' => 'fail', 'msg' => 'Failed to add subcategory.');
    }

    echo json_encode($jsonresponse);
}
function activityStatusChange($conn){
    global $newActivity,$sno,$currentActivity;
      $newActivity = ($currentActivity == 1) ? 0 : 1; // Toggle between 1 and 0
  
      $sql = "UPDATE subcategory SET activity = '$newActivity' WHERE SNO = '$sno'";
      $result = mysqli_query($conn, $sql);
  
      if ($result) {
          $statusText = ($newActivity == 1) ? "Active" : "Inactive";
          echo json_encode(["status" => "success", "msg" => "Status changed to $statusText."]);
      } else {
          echo json_encode(["status" => "error", "msg" => "Failed to update status."]);
      }
  
  }

//  sub category items for drop down for category menu
function loadsubcategory($conn)
{
    global $category;
    $selectQuery = "SELECT * from  subcategory WHERE foodtype = '$category' ORDER BY sno ASC;";
    $resultquery = getdata($conn, $selectQuery);

    if (count($resultquery) > 0) 
    {
        $jsonresponse = array('code' => '200' , 'status' => 'success' , 'data' => $resultquery);
        echo json_encode($jsonresponse);
    } 
    else 
    {
        $jsonresponse = array('code' => '200' , 'status' => 'error' , 'message' => 'No foodtype found');
        echo json_encode($jsonresponse);
    }
}

//  for category menu screen
function  loadfoodcategory($conn)
{
    $selectQuery = "SELECT * from  foodtype ORDER BY sno ASC";
    $resultquery = getdata($conn, $selectQuery);

    if (count($resultquery) > 0) 
    {
        $jsonresponse = array('code' => '200' , 'status' => 'success' , 'data' => $resultquery);
        echo json_encode($jsonresponse);
    } 
    else 
    {
        $jsonresponse = array('code' => '200' , 'status' => 'error' , 'message' => 'No foodtype found');
        echo json_encode($jsonresponse);
    }
}

      

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
    global $sbcategory;
    $selectquery = "SELECT * FROM `fooddetails` WHERE subcategory = '$sbcategory'";
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

function loadFoodPricessub($conn){
    global $OptionID,$from_date,$category;
  $selectquery = "SELECT fooddetails_log.log_sno,foodtype.type,fooddetails_log.item_name,fooddetails_log.price,fooddetails_log.fromdate,fooddetails.OptionID from fooddetails_log
    join fooddetails on fooddetails_log.fd_oid = fooddetails.OptionID
    
    join foodtype on fooddetails.subcategory = '$category'
    WHERE 
    fooddetails_log.fromdate IS NOT NULL 
    AND fooddetails_log.fromdate != '0000-00-00' 
 
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

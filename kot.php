
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Report page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/kot.css" type="text/css">

</head>

<body>
    <div class="main-container">
        <div class="loader-overlay">
            <div class="loader"></div>
        </div>

        <div class="header">
                <div class="header-box">
                    <img  src="images/person.png" height="25px" width="25px"/><a href="register.php">Register</a>
                </div>
                <div class="header-box" id="reports">
                    <img src="images/report.png" height="25px" width="25px" /><a href="reports.php">Report</a>
                </div>
                <div  class="header-box" id="subreports">
                    <img src="images/summary.png" height="25px" width="25px" />Summary
                </div>
        </div>
       <!-- <div class="orderitems" id="orderSummary" style="border: 2px solid;height:auto">

       </div> -->
        <div class="container">
            <div class="container1">
                <!-- <div class="pending_delivery">
                   
                </div> -->
                <div class="form-row">
                    <!-- <div class="form-group">
                        <label for="customer-id">Customer Id:</label>
                        <input type="text" id="customer-id" placeholder="Enter Customer Id">
                    </div> -->
                    <div class="form-group">
                        <label for="from-date">Date:</label>
                        <input type="date" id="from-date" >
                    </div>
                   

                    <div class="form-group">
                        <label for="foodtype">Foodtype :</label>
                        <select class="foodtype" id="foodtype">
                                 <option value="">Select Foodtype</option>
 
                        </select>
                    </div>
                    <button id="#fetch-btn" onclick="fetchkot(event);loadOrdersforitems(event)">Submit</button>
                </div>
            </div>
            <div id="orderSummary">
                <div class="order-item">Breakfast: <span id="Breakfast" class="quantity">0</span></div>
                <div class="order-item">Lunch: <span id="Lunch" class="quantity">0</span></div>
                <div class="order-item">Meals: <span id="Meals" class="quantity">0</span></div>
                <div class="order-item">Meals/Nc: <span id="MealsNc" class="quantity">0</span></div>
                <div class="order-item">Curryset: <span id="Curryset" class="quantity">0</span></div>
                <div class="order-item">Curry: <span id="Curry" class="quantity">0</span></div>
                <div class="order-item">Pappu: <span id="Pappu" class="quantity">0</span></div>
                <div class="order-item">Pachadi: <span id="Pachadi" class="quantity">0</span></div>
                <div class="order-item">Pulusu: <span id="Pulusu" class="quantity">0</span></div>
                <div class="order-item">Fry: <span id="Fry" class="quantity">0</span></div>
                <div class="order-item">Curd: <span id="Curd" class="quantity">0</span></div>
                <div class="order-item">Rice: <span id="Rice" class="quantity">0</span></div>
                <div class="order-item">Dinner: <span id="Dinner" class="quantity">0</span></div>
            </div>
            <div class="container2">
                <table id="kot-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Delivery Address</th>
                            <th>Landmark</th>
                            <th>Delivery PH NO</th>
                            <th>OrderDate</th>
                            
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Total Amt.</th>
                            <th>DeliveryBoy</th>
                            <th>Contact</th>
                            <th>Save</th>
                            <th>Print</th>
                            <th>Re-Print</th>
                        </tr>
                    </thead>
                    <tbody class="report_tbody">

                    </tbody>

                </table>

                
            </div>
            
            
        </div>
       
       



    </div>

    
   
<script src="scriptfiles/kot.js"></script>

</body>

</html>
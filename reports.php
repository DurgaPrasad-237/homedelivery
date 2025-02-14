
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Report page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/reports.css" type="text/css">

</head>

<body>
    <div class="main-container">
        <div class="loader-overlay">
            <div class="loader"></div>
            
            <div class="imgdiv">
                <img id="houseimg" src="images/house.png" height="100px" width="100px">
                <img id="loadingmoveimage" src="images/delivery.png" height="100px" width="100px">
            </div>
        </div>

        <div class="header">
                <div class="header-box">
                    <img  src="images/person.png" height="25px" width="25px"/><a href="register.php">Register</a>
                </div>
                <div class="header-box" id="reports">
                    <img src="images/report.png" height="25px" width="25px" />Report
                </div>
                <div  class="header-box" id="subreports">
                    <img src="images/summary.png" height="25px" width="25px" />Summary
                </div>
        </div>
       
        <div class="container">
            <div class="container1">
                <div class="pending_delivery">
                   
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="customer-id">Customer Id:</label>
                        <input type="text" id="customer-id" placeholder="Enter Customer Id">
                    </div>
                    <div class="form-group">
                        <label for="from-date">From:</label>
                        <input type="date" id="from-date">
                    </div>
                    <div class="form-group">
                        <label for="to-date">To:</label>
                        <input type="date" id="to-date">
                    </div>
                    <!-- <div class="form-group">
                        <label for="periodicity">Periodicity:</label>
                        <select id="periodicity" class="payment_period">
                        <option value="">Select Periodicity</option>
                                                       
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label for="foodtype">Foodtype :</label>
                        <select class="foodtype">
                                 <option value="">Select Foodtype</option>
 
                        </select>
                    </div>
                    <button id="#fetch-report-btn" onclick="reportdetails(event)">Fetch Report</button>
                </div>
            </div>
            <div class="container2">
                <table id="report-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Delivery Number</th>
                            <th>Email</th>
                            <th>OrderDate</th>
                            <th>Breakfast</th>
                            <th>Lunch</th>
                            <th>Dinner</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody class="report_tbody">

                    </tbody>

                </table>
            </div>
            
        </div>
       
       


        <div class="summary">
            <div class="summary_table">
                <div class="summary_head">
                    <div>
                    <label>Customer ID:</label>
                    <input type="text" placeholder="Enter customer ID" id="customer_id">
                    </div>
                    <div>
                    <label>From Date:</label>
                    <input type="date" id="s_fromdate" disabled>
                    </div>
                    <div>
                    <label>To Date:</label>
                    <input type="date" id="s_todate" disabled>
                    </div>
                    <div>
                    <label>Select Month:</label>
                    <input type="month" id="selected_month">
                    </div>
                    <button onclick="monthly_summary()">Submit</button>
                    <button onclick="pendingreports()">Pending Reports</button>
                </div>
                <div class="s_table-container">
                    <table class="s_table">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Billing Number</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Paid Amount</th>
                                <th>Pending Amount</th>
                                <th>Total Amount</th>
                                <th>Related Y-M</th>
                                <th>Edit Amount</th>
                                <th></th>
                                <th></th>
                            </tr>
                            
                            
                        </thead>
                        <tbody class="s_tbody">
                            <!-- Add as many rows as needed -->
                            
                            
                            <!-- Repeat rows for demonstration -->
                        </tbody>
                    </table>

                    <!-- pending reports -->
                    <div class="pending_reports">
                       <div class="pending_months">
                            <span><select id="yearSelect">
                            </select></span>
                            <span onclick="loadPendingMonthReport(this)">JAN</span>
                            <span onclick="loadPendingMonthReport(this)">FEB</span>
                            <span onclick="loadPendingMonthReport(this)">MAR</span>
                            <span onclick="loadPendingMonthReport(this)">APR</span>
                            <span onclick="loadPendingMonthReport(this)">MAY</span>
                            <span onclick="loadPendingMonthReport(this)">JUN</span>
                            <span onclick="loadPendingMonthReport(this)">JUL</span>
                            <span onclick="loadPendingMonthReport(this)">AUG</span>
                            <span onclick="loadPendingMonthReport(this)">SEP</span>
                            <span onclick="loadPendingMonthReport(this)">OCT</span>
                            <span onclick="loadPendingMonthReport(this)">NOV</span>
                            <span onclick="loadPendingMonthReport(this)">DEC</span>
                            <span id="allreport" class="active">All</span>
                       </div>
                       <table>
                            <thead> 
                                <tr>
                                <th>CustomerName</th>
                                <th>Email</th>
                                <th>Billing Number</th>
                                <th>Total Amount</th>
                                <th>Paid Amount</th>
                                <th>Pending Amount</th>   
                                <th>Info</th>
                                </tr>
                            </thead>
                            <tbody class="pending_months_report_body">
                                
                            </tbody>
                        

                       </table>
                    </div>
                </div>

            </div>
            <div class="view_summary_history">
                <div class="sumamry_tabs">
                    <button class="orders_history">Orders history</button>
                    <button class="payments_history">Payments history</button>
                </div>

                <div class="summary_body">
                    <div class="food_list">
                        <div class="breakfast_list">
                            <h3>BreakFast</h3>
                        </div>

                        <div class="lunch_list">
                            <h3>Lunch</h3>
                        </div>

                        <div class="dinner_list">
                            <h3>Dinner</h3>
                        </div>
                        <div class="total_amount_footer">

                        </div>
                    </div>

                    <div class="payment_list">
                        <div class="pd_amt">
                            <div class="personal_details">
                            
                            </div>
                            <div class="amount_details">
                            
                            </div>
                        </div> 
                        <div class="p_list">
                        
                        </div>
                    </div> 
                </div>
            </div>
            

        </div>
    </div>

    
    <!-- view summary -->
    <!-- <div class="view_summary_wrapper">
    <div class="view_summary">
        <div class="sumamry_tabs">
            <button class="orders_history">Orders history</button>
            <button class="payments_history">Payments history</button>
            <i class="fa-regular fa-circle-xmark"></i>
        </div>

        <div class="food_list">
            <div class="breakfast_list">
                <h3>BreakFast</h3>
            </div>

            <div class="lunch_list">
                <h3>Lunch</h3>
            </div>

            <div class="dinner_list">
                <h3>Dinner</h3>
            </div>
        </div>

        <div class="payment_list">
            <div class="pd_amt">
                <div class="personal_details">
                  
                </div>
                <div class="amount_details">
                   
                </div>
            </div> 
            <div class="p_list">
                    
            </div>
        </div> 

    </div> 
</div>  -->
<script src="scriptfiles/reports.js"></script>

</body>

</html>
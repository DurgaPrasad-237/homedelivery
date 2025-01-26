<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/registerstyle.css">
</head>

<body>
    <header class="head">
        <div class="register" id="register"><img src="images/person.png" height="25px" width="25px"/>Register</div>
        <div class="Report"><img src="images/report.png" width="25px" height="25px"><a href="reports.php">Report</a></div>
        <div class="date-container">
            <div class="date" id="formatted-date"></div>
            <div class="day" id="day-name"></div>
        </div>
    </header>
    <section class="main_container">

        <div class="register_form_wrapper">
            <div class="delivery_address_block">

           <i class="fa-solid fa-xmark fa-beat-fade" onclick="closenewD()"></i>
           <div class="div_a_block">
                <div>
                    <label>Customer Name:</label>
                    <input id="da_name" placeholder="Name" disabled/>
                </div>
                <div>
                    <label>Mobile Number:</label>
                    <input id="da_mobile_number" placeholder="Mobile Number" disabled/>
                </div>
                <div>
                    <label>Email</label>
                    <input id="da_mail" placeholder="Email" disabled/>
                </div>
                <p>Address</p>
                <div>
                    <label>Flat No:</label>
                    <input id="da_flatno" placeholder="Flatno/houseno" />
                </div>
                <div>
                    <label>Area</label>
                    <input id="da_area" placeholder="Area" />
                </div>
                <div>
                    <label>Street</label>
                    <input id="da_street" placeholder="Street" />
                </div>
                <div>
                    <label>Delivery Ph</label>
                    <input id="da_deph" placeholder="Delivery Ph" />
                </div>
                <div>
                    <label>Add Link</label>
                    <input id="da_link" placeholder="Link" />
                </div>
                <button onclick="addNewdelivery()">Save</button>
           </div>

            </div>
            <div class="register_form">
                <div class="search_area">
                    <select id="search_method">
                        <option value="CustomerID">CustomerID</option>
                        <option value="Customer Name">Customer Name</option>
                        <option value="Phone Number">Phone Number</option>
                    </select>
                    <input type="" placeholder="Enter Here" class="search_input" id="search_input">
                    <button class="btn_search" id="btn_search">Search</button>
                </div>

                <!-- multiple list -->
                <div class="multiple_list">
                    <table class="scrollable_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Delivery Address</th>
                            </tr>
                        </thead>
                        <tbody class="tablebody">
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>

                <div class="form_tdylist">
                    <div class="customerform" id="customerform">
                        <div class="input_row" id="customer_div_id">
                            <label>ID:</label>
                            <input disabled class="customer_id">
                        </div>
                        <div class="input_row">
                            <label>Name:</label>
                            <input disabled class="customer_Name" id="customer_name">
                        </div>
                        <div class="input_row">
                            <label>Phone:</label>
                            <input disabled class="customer_Phone" id="customer_phone">
                        </div>
                        <div class="input_row">
                            <label>Email:</label>
                            <input disabled class="customer_Email" id="customer_email">
                        </div>
                        <!-- <div class="input_row" id="selectionperiod">
                            <label>Period:</label>
                            <select class="payment_period" id="payment_period">

                            </select>
                        </div> -->
                        <div class="reg_address">
                            <input placeholder="flatno/houseno" class="regaddress_input" id="regflat">
                            <input placeholder="Street" class="regaddress_input" id="regstreet">
                            <input placeholder="Area" class="regaddress_input" id="regarea">
                            <input placeholder="Delivery_Mobile" class="regaddress_input" id="regdmobile">
                            <input placeholder="Address link" class="regaddress_input" id="reglink">
                            <input placeholder="Address link" class="regaddress_input">
                        </div>
                        <button class="btngenerate" id="Submit">Submit</button>
                    </div>
                    <div class="today_list">
                        <h3 class="toheading">Today Order</h3>
                        <div class="todaycontainer">
                            <div class="headingtdy">
                                <h3 class="hiden">SP</h3>
                                <p class="qtyhd ">Quantity</p>
                                <p class="qtypr">Price</p>
                            </div>
                            <!-- <div class="bftoday">
                            <h3>BF</h3>
                            <p>2</p>
                            <p>10</p>
                        </div>
                        <div class="lunchtoday">
                            <h3>LN</h3>
                            <p>2</p>
                            <p>10</p>
                        </div>
                        <div class="dinnertoday">
                            <h3>DN</h3>
                            <p>2</p>
                            <p>10</p>
                        </div>
                        <div class="totaltoday">
                            <h3>TL</h3>
                            <p>2</p>
                            <p>10</p>
                        </div> -->
                        </div>

                    </div>
                </div>


                <div class="addresses_area">
                    <div class="delivery_area" id="delivery_area">
                        <h3>Delivery Address <span><i class="fa-solid fa-plus" onclick="addnewDelivery()" title="Add new Address"></i></span></h3>
                        <div class="address_input_area">
                            <input placeholder="flatno/houseno" class="address_input" id="address_flat" disabled>
                            <input placeholder="Street" class="address_input" id="address_street" disabled>
                            <input placeholder="Area" class="address_input" id="address_area" disabled>
                            <input placeholder="Mobile" class="address_input" id="address_mobile" disabled>
                            <input placeholder="Address link" class="address_input" id="address_link" disabled>
                            <button class="editbtn" id="deditbtn">Edit</button>
                            <div class="scbtn">
                                <button id="dsbtn">Save</button>
                                <button id="dcbtn">Cancel</button>
                            </div>  
                        </div>
                    </div>
                    <div class="billing_area">
                        <div class="sad_area">
                            <h3>Billing</h3><input type="checkbox" class="input_checkbox" id="input_checkbox">
                            <p class="sadtext">Same as Delivery Address</p>
                        </div>
                        <div class="address_input_area">
                            <input placeholder="flatno/houseno" class="address_input" id="billing_flat" disabled>
                            <input placeholder="Street" class="address_input" id="billing_street" disabled>
                            <input placeholder="Area" class="address_input" id="billing_area" disabled>
                            <input placeholder="Mobile" class="address_input" id="billing_mobile" disabled>
                            <input placeholder="Address link" class="address_input" id="billing_link" disabled>
                            <button class="editbtn" id="beditbtn">Edit</button>
                            <div class="bscbtn">
                                <button id="bsbtn">Save</button>
                                <button id="bcbtn">Cancel</button>
                            </div>

                        </div>
                    </div>

                </div>


                <!-- <div class="button_area">
                    <button>Place Order</button> -->
                    <!-- <button>Save Edit</button> -->
                    <!-- <button>Cancel Order</button>
                </div> -->


            </div>
        </div>

        <div class="selection-container">
            <div class="button-container">
                <button class="menu-button" onclick="showBreakfast()">
                    <img src="images/idly.png" width="50px" height="50px">
                    <p>BreakFast</p>
                    <input type="number" id="mealqty" value="0" readonly />
                    <input type="number" id="mealamt" value="0" readonly />
                </button>
                <button class="menu-button" onclick="showLunch()">
                    <img src="images/meal.png" width="50px" height="50px">
                    <p>Lunch</p>
                    <input type="number" id="mealqtyl" value="0" readonly />
                    <input type="number" id="mealamount" value="0" readonly />
                </button>
                <button class="menu-button" onclick="showDinner()">
                    <img src="images/dosa.png" width="50px" height="50px">
                    <p>Dinner</p>
                    <input type="number" id="mealqtyd" value="0" readonly />
                    <input type="number" id="mealamtd" value="0" readonly />
                </button>
                <!-- <button onclick="showedit()" class="edit-button">
                    Edit Order
                </button> -->
                <button  class="show_fdbtn" onclick="showfooddetails()">
                    FoodDetails
                </button>
            </div>


            <!-- Breakfast Details Box -->
            <div class="breakfast-box" id="breakfast-box">

                <!-- <div class="period">
        <label for="from-date-b">From:</label>
        <input type="date" name="from-date-b" id="from-date-b">
        <label for="to-date-b">To:</label>
        <input type="date" name="to-date-b" id="to-date-b">
        </div> -->

                <div class="bfhead">
                   <th>Breakfast Type</th><label>
                        <input type="radio" name="breakfast-category" value="categoryb1" disabled>
                        Category 1
                    </label>
                    <label>
                        <input type="radio" name="breakfast-category" value="categoryb2" disabled>
                        Category 2
                    </label>
                    <button class="placeorderbtn" onclick="openSummaryModal(event)">Place Order</button>
                </div>


                <div id="breakfast-contain" class="breakfast-contain" style="display: none;">
                    <div class="table-container">
                        <!-- First Table -->
                        <table id="table1">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Quantity</th>
                                    <th>Reason</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <!-- Second Table -->
                        <table id="table2">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Quantity</th>
                                    <th>Reason</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- Lunch Details Box -->
            <div class="breakfast-box" id="lunch-box" style="display: none;">
                <div class="bfhead">
                    <th>Lunch Type</th><label>
                        <input type="radio" name="lunch-category" value="category1" onclick="headerfetch()" disabled checked>
                        Category 1
                    </label>
                    <label>
                        <input type="radio" name="lunch-category" value="category2" disabled>
                        Category 2
                    </label>
                    <button id="insert-button" onclick="openSummaryModal(event)">Place Order</button>
                </div>


                <!-- Dynamic Options Container -->
                <div id="lunch-options-container" style="display: none;">
                <div class="scrollable-table-container">
                    <table id="lunch-table">
                        <thead>

                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            <!-- Dinner Details Box -->
            <div class="breakfast-box" id="dinner-box" style="display: none;">

                <!-- <div class="period">
    <label for="from-date-d">From:</label>
    <input type="date" name="from-date-d" id="from-date-d">
    <label for="to-date-d">To:</label>
    <input type="date" name="to-date-d" id="to-date-d">
</div> -->
                <div class="bfhead">
                    <th>Dinner Type</th><label>
                        <input type="radio" name="dinner-category" value="categoryd1" disabled>
                        Category 1
                    </label>
                    <label>
                        <input type="radio" name="dinner-category" value="categoryd2" disabled>
                        Category 2
                    </label>
                    <button class="placeorderbtn" onclick="openSummaryModal(event)">Place Order</button>
                </div>

                <div id="dinner-container" class="dinner-container" style="display: none;">
                    <div class="table-container">
                        <!-- First Table -->
                        <table id="d-table1">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Quantity</th>
                                    <th>Reason</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <!-- Second Table -->
                        <table id="d-table2">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Quantity</th>
                                    <th>Reason</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="edit-box" id="edit-box" style="display: none;">
                <div class="period">
                    <label for="from-date-edit">From:</label>
                    <input type="date" name="from-date-edit" id="from-date-edit">
                    <label for="to-date-edit">To:</label>
                    <input type="date" name="to-date-edit" id="to-date-edit">
                    <button type="button" onclick="fetchorderb(event);fetchorderl(event);fetchorderd(event)">Search</button>
                </div>
                <div class="edit-tables">
                    <div class="editb-table">
                        <p class="edit-head">Breakfast</p>
                        <table id="edit-breakfast">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="editl-table">
                        <p class="edit-head">Lunch</p>
                        <table id="edit-lunch">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="editd-table">
                        <p class="edit-head">Dinner</p>
                        <table id="edit-dinner">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- food details div -->
             <div class="food_details">
                <?php include "fooddetails.php"; ?>
             </div>
            <!-- <div class="buttons">
                <button id="insert-button" onclick="placeorder(event)">Place Order</button>
            </div> -->
            <div id="overlay"></div>
            <div id="summary-modal">
                <h4><b>Place Order</b></h4>
                <button onclick="closeSummaryModal(event)" type="submit" id="closesummary">X</button>
                <div class="dialog-container">
                <div class="selection-container-b">
                <div class="button-container-b">
                    <button class="menu-button-b" onclick="showBreakfastB();fetchallb()">
                        Breakfast
                        <input type="number" id="mealqtyb" value="0" readonly />
                        <input type="number" id="mealamtb" value="0" readonly />
                    </button>
                    <button class="menu-button-b" onclick="showLunchB()">Lunch
                        <input type="number" id="mealqtylb" value="0" readonly />
                        <input type="number" id="mealamountb" value="0" readonly />
                    </button>
                    <button class="menu-button-b" onclick="showDinnerB();getallb()">
                        Dinner
                        <input type="number" id="mealqtydb" value="0" readonly />
                        <input type="number" id="mealamtdb" value="0" readonly />
                    </button>
                    <button class="savebutton" type="submit" onclick="placeorder(event)">Save</button>
                    
                    
                </div>


                <!-- Breakfast Details Box -->
                <div class="breakfast-box" id="breakfast-box-b">
                    <h3>Breakfast (Qty)</h3>
                    <div class="period">
                        <label for="from-date-b">From:</label>
                        <input type="date" name="from-date-b" id="from-date-b">
                        <label for="to-date-b">To:</label>
                        <input type="date" name="to-date-b" id="to-date-b">
                    </div>
                    <table class="breakfast-table">
                        <tr>
                            <th>Breakfast Type</th>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    <input type="radio" name="breakfast-category-b" value="categoryb1b" disabled>
                                    Category 1
                                </label>
                                <label>
                                    <input type="radio" name="breakfast-category-b" value="categoryb2b" disabled>
                                    Category 2
                                </label>
                            </td>
                        </tr>
                    </table>
                    <div id="breakfast-contain-b" class="breakfast-contain" style="display: none;">
                        <div class="table-container">

                            <table id="fund-table-b">
                                <thead>
                                    <tr>
                                        <!-- <th>SNO</th> -->

                                        <!-- <th>Item</th> -->
                                        <th>Price</th>
                                        <th>Quantity</th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <!-- Lunch Details Box -->
                <div class="breakfast-box" id="lunch-box-b" style="display: none;">
                    <h3>Lunch (Qty)</h3>
                    <div class="period">
                        <label for="from-date-l">From:</label>
                        <input type="date" name="from-date-l" id="from-date-l">
                        <label for="to-date-l">To:</label>
                        <input type="date" name="to-date-l" id="to-date-l">
                    </div>
                    <table class="breakfast-table">
                        <tr>
                            <th>Lunch Type</th>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    <input type="radio" name="lunch-category-1" value="category1-1" onclick="fetchalllunch()" disabled checked>
                                    Category 1
                                </label>
                                <label>
                                    <input type="radio" name="lunch-category" value="category2" disabled>
                                    Category 2
                                </label>
                            </td>
                        </tr>
                    </table>

                    <!-- Dynamic Options Container -->
                    <div id="lunch-options-containers" style="display: none;">
                        <table id="lunch-table-l">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    <!-- </div> -->

                </div>
                </div>




                <!-- Dinner Details Box -->
                <div class="breakfast-box" id="dinner-box-b" style="display: none;">
                    <h3>Dinner (Qty)</h3>
                    <div class="period">
                        <label for="from-date-d">From:</label>
                        <input type="date" name="from-date-d" id="from-date-d">
                        <label for="to-date-d">To:</label>
                        <input type="date" name="to-date-d" id="to-date-d">
                    </div>
                    <table class="breakfast-table">
                        <tr>
                            <th>Dinner Type</th>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    <input type="radio" name="dinner-category-b" value="categoryd1d" disabled>
                                    Category 1
                                </label>
                                <label>
                                    <input type="radio" name="dinner-category-b" value="categoryd2d" disabled>
                                    Category 2
                                </label>
                            </td>
                        </tr>
                    </table>
                    <div id="dinner-container-b" class="dinner-container" style="display: none;">
                        <div class="table-container">
                            <table id="dinner-table-b">
                                <thead>
                                    <tr>
                                        <!-- <th>Item</th> -->
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
               
              


                    </div> 
            </div>
        </div>

        </div>
        </div>
        </div>


        </div>
        </div>

    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scriptfiles/register.js"></script>

</body>

</html>
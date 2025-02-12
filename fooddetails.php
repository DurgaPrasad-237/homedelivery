<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/fooddetails.css">
    <title>Food Details</title>
</head>

<body style="overflow: hidden;">
    <section class="fund-container">
        <div></div>
        <div class="form-and-table">
        </div>
        <div class="heading2">
            <h2>Add Food details</h2>
            <div>
                <button onclick="navbtns(this)" class="pr_btn">Prices</button>
                <button onclick="navbtns(this)" class="bf_din">BreakFast/Dinner</button>
                <button onclick="navbtns(this)" class="ln_btn">Lunch</button>
            </div>
        </div>
        <div class="main-container">
            <div class="category-container">
                <div class="add-category-form">



                    <div class="form-group" id="button">
                    <label for="category">Category:</label>
                        <select id="category" class="category" onchange="loadFdItemByCategory()">
                        <option value="">Select category</option>
                                                        <!-- <option value="daily">Daily</option>
                            <option value="monthly">Monthly</option> -->
                        </select>
                        <label for="food_item">FoodItem:</label>
                       <select id="food_items-dp" class="food_items_dp" onchange="loadFoodPrices()">
                          

                       </select>
                        <input type="number" id="Price" name="Price" placeholder="Price" min="1" max="24" required>
                        <label for="from_date">From:</label>
                        <input type="date" id="from_date" name="from_date" required>

                        <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
                        <button type="cancel" class="btn btn-danger" onclick="cancelOperation()">Cancel</button>

                    </div>


                </div>
                <div class="total">
                <div class="existing-categories">
                    <table class="category-table">
                        <thead>
                            <tr>
                                <!-- <th>Category</th>
                                <th>Item Name</th> -->
                                <th>Price</th>
                                <th>From
                                    Date</th>
                                <!-- <th>To
                                    Date
                                </th> -->
                                <!-- <th>Edit</th> -->
                                 <th></th>
                            </tr>
                        </thead>
                        <tbody id="typesTableBody" >
                            <!-- Dynamic content will be inserted here -->
                        </tbody>
                    </table>
                    <p class="no_price">Price not yet inserted</p>
                </div>
                <div class="order-history">
                <table class="category-table" id="table-head">
                        <thead id="tablehead" style="display: none;">
                            <tr>
                                <!-- <th>Category</th>
                                <th>Item Name</th> -->
                                <th>Price</th>
                                <th>From
                                    Date</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody id="typesTableBody1">
                            <!-- Dynamic content will be inserted here -->
                        </tbody>
                    </table>
                </div>
                </div>
            </div>


            <div class="add_bf">
                <div class="bf_items_add">
                    <h3>Add Items</h3>
                    <div class="bf_item_add">
                        <input placeholder="Enter Item Name" maxlength="20">
                        <button onclick="addbf()">Add</button>
                    </div>
                    <div class="bf_add_item_table">
                        <table>
                            <thead>
                                <tr>
                                <th>ItemName</th>
                                <th>Active/Deactive</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>

                </div>


                <table class="add_table_bf">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Item</th>
                            <th>FromDate</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody class="bfd_body">
                        
                    </tbody>
                </table>
            </div>

            <div class="add_lun">
                <h3>Lunch Items</h3>
                <div class="input_lun">
                    <input placeholder="Enter Lunch Item" maxlength="20">
                    <button onclick="add_lunch_item()">Save</button>
                </div>
                <div>
                    <table class="lun_table">
                        <thead>
                            <tr>
                                <th>ItemName</th>
                                <th>Edit</th>
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
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scriptfiles/fooddetails.js"></script>
</body>

</html>
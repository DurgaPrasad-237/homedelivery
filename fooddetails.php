<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Food Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/fooddetails.css">

    <style>
        .main-container {
            width: 100%;
            height: 78vh;
            display: flex;
            flex-direction: row;
        }

        .side-container {
            width: 20%;
            height: 76vh;
            background-color: grey;
            color: black;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }

        .side-container ul {
            padding: 0;
            width: 100%;
            list-style: none;
        }

        .side-container ul li {
            padding: 15px;
            text-align: left;
            cursor: pointer;
            transition: 0.3s;
            padding-left: 20px;
        }

        .side-container ul li:hover,
        .side-container ul li.active {
            background-color: #eee;
            width: 150px;
            font-weight: bold;
        }

        .content-section {
            display: none;
            padding: 20px;
            font-size: 18px;
            width: 100%;
        }

        .content-section.active {
            display: block;
        }

        .head-container {
            height: 7vh;
            width: 100%;
            background-color: orangered;
            color: whitesmoke;
            font-size: 2vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-container {
            width: 95%;
            padding: 20px;
            height: 80vh;
        }

        #button .row-1,
        #button .row-2 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        #button .row-1 select,
        #button .row-2 input,
        #button .row-2 button {
            width: 25%;
            padding: 6px;
        }

        #button .row-2 button {
            width: 12%;
            padding: 6px;
            font-weight: bold;
            cursor: pointer;
            height: auto;
        }

        .btn-primary {
            background-color: #28a745;
            border: none;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            color: white;
        }

        .category-container {
            margin-bottom: 20px;
        }

        .category-container select {
            width: 60%;
            padding: 8px;
            margin-left: 10px;
        }

        .add_lun .input_lun input {
            width: 60%;
            padding: 8px;
            margin-right: 10px;
        }

        .add_lun .input_lun button {
            padding: 8px 16px;
            font-weight: bold;
            cursor: pointer;
            background-color: #28a745;
            color: white;
            border: none;
        }

        .category-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }

        .category-row label {
            width: 20%;
            font-weight: bold;
        }

        .category-row select {
            width: 60%;
            padding: 8px;
        }

        .input_lun {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 20px;
        }

        .input_lun input {
            width: 60%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input_lun button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #addi {
            background-color: #28a745;
        }

        #addi:hover {
            background-color: #218838;
        }

        #updatei {
            background-color: #ffc107;
        }

        #updatei:hover {
            background-color: #e0a800;
        }


        #add {
            background-color: #28a745;
        }

        #add:hover {
            background-color: #218838;
        }

        #update {
            background-color: #ffc107;
        }

        #update:hover {
            background-color: #e0a800;
        }

        .lun_table th,
        .lun_table td {
            padding: 10px;
            text-align: center;
        }

        .lun_table thead {
            background-color: #f8c471;
            color: white;
            font-weight: bold;
        }

        .lun_table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .lun_table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .lun_table1 th,
        .lun_table1 td {
            padding: 10px;
            text-align: center;
        }

        .lun_table1 thead {
            background-color: #f8c471;
            color: white;
            font-weight: bold;
        }

        .lun_table1 tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .lun_table1 tbody tr:hover {
            background-color: #f1f1f1;
        }
        #scheduling-content{
            border:2px solid black;
           height:80vh;
           width:54.5vw;
        }
        #scheduling-content .scheduling_content_container{
            height:90%;
            width:100%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            padding:5px;
            align-items: center;
        }
        #scheduling-content .scheduling_content_container .schedulingboxes{
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            width:80%;
            height:20%;
            margin-left: 10px;
            margin-top: 3vh;
            border-radius: 5px;
            padding:5px;
        }
        .scheduling_content_container h3{
            margin: 0px;
            padding:5px;
            text-align: center;
            background-color: #f8c471;
            color:white;
        }
        .scheduling_content_container p{
            margin-left: 2vw;;
        }
        .schedulingboxes select{
            width:8vw;
        }
        .schedulingboxes input{
            width:5vw;
        }
        #schtmdydate{
            width:8vw;
        }
        #schtdydate{
            width:8vw;
        }
        .tdybox{
            float: left;
        }
        .tmrbox{
            float: right;
        }
    </style>
</head>

<body style="overflow: hidden;">
    <section class="fund-container">
        <div class="main-container">
            <!-- Sidebar -->
            <div class="side-container">
                <ul>
                    <li onclick="toggleSection('prices-content', this)">Prices</li>
                    <li onclick="toggleSection('items-menu-content', this)">Category Menu</li>
                    <li onclick="toggleSection('sub-items-menu-content', this)">Items Menu</li>
                    <li onclick="toggleSection('scheduling-content', this);checkingtrigger()">Scheduling</li>
                </ul>
            </div>

            <!-- Content Sections -->
            <div class="content-container">
                <!-- Prices Section -->
                <div id="prices-content" class="content-section">
                    <div class='container1'>
                        <div class="category-container">
                            <div class="add-category-form">
                                <div class="form-group" id="button">
                                    <!-- Row 1: Category, Food Item, Sub Item -->
                                    <div class="row-1">
                                        <label for="category">Food Type:</label>
                                        <select id="category" class="category" onchange="loadFdItemByCategory();loadFoodPrices(true);hidetab()">
                                            <option value="">Select Type</option>
                                            <!-- <option value="daily">Daily</option>
                                            <option value="monthly">Monthly</option> -->
                                        </select>

                                        <label for="sub_item">Category:</label>
                                        <select id="sub_items-dp" class="sub_items_dp"></select>

                                        <label for="food_item">Item:</label>
                                        <select id="food_items-dp" class="food_items_dp" onchange="loadFoodPrices(false);hidetab();"></select>
                                    </div>

                                    <!-- Row 2: Price, From Date, Submit, Cancel -->
                                    <div class="row-2">
                                        <label for="price">Price:</label>
                                        <input type="number" id="Price" name="Price" placeholder="Price" min="1" required>

                                        <label for="from_date">From:</label>
                                        <input type="date" id="from_date" name="from_date" required>

                                        <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
                                        <button type="cancel" class="btn btn-danger" onclick="cancelOperation()">Cancel</button>
                                    </div>
                                </div>



                            </div>
                            <div class="total">
                                <div class="existing-categories">
                                    <table class="category-table">
                                        <thead>
                                            <tr>
                                                <!-- <th>Category</th> -->
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>From
                                                    Date</th>
                                                <!-- <th>To
                                    Date
                                </th> -->
                                                <!-- <th>Edit</th> -->
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody id="typesTableBody">
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


                    </div>
                </div>


                <!-- Items Menu Section -->
                <div id="items-menu-content" class="content-section">
                    <!-- <h2>Items Menu Section</h2> -->
                    <div class="category-container">
                        <label for="item_category"><strong>Food Type:</strong></label>
                        <select id="item_category" class="category" onchange="loadItemsByCategory();">
                        </select>
                    </div>

                    <div class="add_lun">
                        <h3>Add Item</h3>
                        <div class="input_lun">
                            <input type="text" id="subcategory_name" placeholder="Enter Subcategory Name">
                            <button type="submit" id="add" name="add">Save</button>
                            <button type="submit" id="update" name="add" style="display:none;">Update</button>
                            <button class="cnclbtn" style="display:none;background-color:red">Cancel</button>
                        </div>
                        <table class="add_lun lun_table">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Edit</th>
                                    <th>Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic items will be loaded here -->
                            </tbody>
                        </table>

                    </div>
                </div>

                <!-- Sub Items Menu Section -->
                <div id="sub-items-menu-content" class="content-section">
                    <div class="category-row">
                        <div>
                            <label for="sub_item_category"><strong>Food Type:</strong></label>
                            <select id="sub_item_category">


                            </select>
                        </div>

                        <div>
                            <label for="sub_items"><strong>Sub Category:</strong></label>
                            <select id="sub_items" onchange=" loadItemsByCategory1()">

                            </select>
                        </div>
                    </div>

                    <div class="add_lun1">
                        <h3>Add Sub Item</h3>
                        <div class="input_lun">
                            <input type="text" id="item_name" placeholder="Enter Sub Item" maxlength="40">
                            <input type="number" id="item_number" placeholder="Enter price" maxlength="10">
                            <button type="submit" id="addi">Save</button>
                            <button type="submit" id="updatei" name="add" style="display:none;">Update</button>
                            <button class="cnclbtni" style="display:none;background-color:red">Cancel</button>
                        </div>
                        <table class="lun_table1">
                            <thead>
                                <tr>
                                    <th>Sub Item Name</th>
                                    <th>Price</th>
                                    <th>Edit</th>
                                    <th>Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic sub-items go here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--scheduling-content section-->
                <div id="scheduling-content">
                    <div class="scheduling_content_container">
                        <div class="schedulingboxes">
                            <h3>Break Fast</h3>
                            <div class="tdybox">
                            <p><b>Today</b></p>
                                <input type="date" id="schtdydate">
                                <input type="text" id="schtdbfitem">
                            </div>
                            <div class="tmrbox">
                            <p><b>Tomorrow</b></p>
                                <input type="date" id="schtmdydate">
                                <select class="subcategory" onchange="loadcatitems()">
                                    
                                </select>
                                <select class="tmbfitems">
                                    
                                </select>
                                <button onclick="upddatetmbfitem(this)" class="btnbftmr">Save</button>
                            </div>

                        </div>

                        <div class="schedulingboxes">
                            <h3>Lunch</h3>
                            <div class="tdybox">
                            <p><b>Today</b></p>
                                <input type="date" id="schtdydate">
                                <input type="text">
                            </div>
                            <div class="tmrbox">
                            <p><b>Tomorrow</b></p>
                                <input type="date" id="schtmdydate">
                                <select>

                                </select>
                                <button>Save</button>
                            </div>
                        </div>

                        <div class="schedulingboxes">
                             <h3>Dinner</h3>
                             <div class="tdybox">
                                <p><b>Today</b></p>
                                <input type="date" id="schtdydate">
                                <input type="text">
                            </div>
                            <div class="tmrbox">
                                <p><b>Tomorrow</b></p>
                                <input type="date" id="schtmdydate">
                                <select>

                                </select>
                                <button>Save</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- JS Section -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scriptfiles/fooddetails.js"></script>
    <script>

        var todaydate = new Date();
        let schtdydate = document.querySelectorAll('#schtdydate');
        let schtmdydate = document.querySelectorAll('#schtmdydate');
        var tomorrowdate = new Date(); 
        tomorrowdate.setDate(todaydate.getDate() + 1);

        schtdydate.forEach(d=>{
          d.value = dateformat(todaydate);
        })

        schtmdydate.forEach(d=>{
            d.value = dateformat(tomorrowdate);
        })

        

        function dateformat(date) {
            let day = String(date.getDate()).padStart(2, "0");
            let month = String(date.getMonth() + 1).padStart(2, "0"); 
            let year = date.getFullYear();

            return `${year}-${month}-${day}`;
        }


        //function for loadtoday order
        function loadtodaybfitem(){

            var payload = {
                todaydate : schtdydate[0].value,
                load:"loadtodaybfitem"
            }
            console.log("payload",payload);
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){
                    console.log("tdydate",response);
                    let schtdbfitem = document.querySelector('#schtdbfitem');
                    schtdbfitem.value = response.data[0]['ItemName'];
                },
                error:function(err){
                    console.log(err);
                }
            })

        }
        loadtodaybfitem();
        function checkingtrigger(){
            checktmritem();
        }

        //check wheather tomorrow item set or not
        function checktmritem(){
            var payload = {
                load:"checktmritem",
                tmrdate:schtmdydate[0].value,
            }
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){
                    console.log('checktrm',response);
                   if(response.data.length > 0){
                    document.querySelector('.btnbftmr').textContent = 'Edit';
                    console.log("t",response);
                    let subcat = response.data[0]['subcategory'];
                    console.log('subcat',subcat)
                    document.querySelector('.subcategory').value = subcat;
                    loadcatitems();
                   }
                },
                error:function(err){
                    console.log(err);
                    alert("Something wrong try again later")
                }
            })
        }
       



        function loadbfitems(){
            
            var payload = {
                tmrdate:schtmdydate[0].value,
                load:"loadbfitems"
            }
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){ 
                   
                    if(response.data && response.data.length > 0){
                        let tmbfitems = document.querySelector('.tmbfitems');
                        if (tmbfitems) {
                            tmbfitems.innerHTML = `<option value="">Select the item</option>`; 
                            response.data.forEach(itm => { 
                                let option = document.createElement('option');
                                option.value = itm.OptionID;
                                option.textContent = itm.itemName;
                                tmbfitems.appendChild(option);
                            });
                        }
                        // loadbfitemstmrdate();
                    }
                
                   
                },
                error:function(err){
                    console.log(err);
                }
            })

        }
        // loadbfitems();



        //load subcategory of breakfast
        function loadsubbreakfast(){
            var payload = {
                foodtype:"1",
                load:"loadsubbreakfast",
            }
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){
                  
                    if(response.data.length > 0){
                        let subcategory = document.querySelector('.subcategory');
                        if(subcategory){
                            subcategory.innerHTML = `<option value="">Select the category</option>`; 
                            response.data.forEach(itm=>{
                               let option = document.createElement('option');
                               option.value = itm.SNO;
                               option.textContent = itm.subcategory;
                                subcategory.appendChild(option);
                            })
                        }
                    }
                },
                error:function(err){
                    console.log(err)
                }
            })
        }
        loadsubbreakfast();


        //load category items
        function loadcatitems(){
            var payload = {
                load:"bfcatitems",
                subcategory: document.querySelector('.subcategory').value
            }
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){    
                    let tmbfitems = document.querySelector('.tmbfitems');
                    if(response.data && response.data.length > 0){
                        console.log('onchange',response)     
                        if (tmbfitems) {
                            tmbfitems.innerHTML = `<option value="">Select the item</option>`; 
                            response.data.forEach(itm => { 
                                let option = document.createElement('option');
                                option.value = itm.OptionID;
                                option.textContent = itm.ItemName;
                                tmbfitems.appendChild(option);
                            });
                        }
                        loadbfitemstmrdate();
                    }
                    else{
                        tmbfitems.innerHTML = `<option value="">No items</option>`; 
                    }
                },
                error:function(err){
                    console.log(err);
                }
            })
        }

        function upddatetmbfitem(thsbtn){
            
            let updateactivity = (thsbtn.textContent === 'Edit') ? 2 : 1;
         

            if(!document.querySelector('.tmbfitems').value || ! document.querySelector('.subcategory').value){
                alert("Please fill the required fields");
                return;
            }
            
            var payload = {
                tmrdate:schtmdydate[0].value,
                load:"setbfitem",
                OptionID:document.querySelector('.tmbfitems').value,
                subcategory: document.querySelector('.subcategory').value,
                updateactivity:updateactivity,
            }
            console.log('d',payload);
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){
                    if(response.status === 'success'){
                        alert("Successfully Updated")
                        document.querySelector('.btnbftmr').textContent = 'Edit';
                    }    
                },
                error:function(err){
                    console.log('e',err);
                }
            })

        }


        function loadbfitemstmrdate(){
          
            var payload = {
                load:"loadbybfitemstmrdate",
                tmrdate:schtmdydate[0].value
            }
            console.log("payload",payload);
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){
                    console.log('tmr',response)
                    if(response.data && response.data.length > 0){
                        document.querySelector('.tmbfitems').value  = response.data[0]['OptionID'];
                    }
                },
                error:function(err){
                    console.log(err);
                }
            })
        }
       


        // Function to toggle sections with active class
        function toggleSection(sectionId, element) {
            const sections = ['prices-content', 'items-menu-content', 'sub-items-menu-content' ,'scheduling-content'];
            sections.forEach(id => {

                document.getElementById(id).style.display = (id === sectionId) ? 'block' : 'none';
            });

            // Active sidebar item
            document.querySelectorAll('.side-container ul li').forEach(li => li.classList.remove('active'));
            element.classList.add('active');

        }

        // Reset form fields
        document.addEventListener("DOMContentLoaded", function() {
            toggleSection('prices-content', document.querySelector('.side-container ul li:first-child'));

            document.getElementById('resetBtn').addEventListener('click', () => {
                document.getElementById('Price').value = '';
                document.getElementById('from_date').value = '';
                document.getElementById('category').selectedIndex = 0;
                document.getElementById('food_items-dp').selectedIndex = 0;
                document.getElementById('sub_items-dp').selectedIndex = 0;
            });
        });

        // drop down for category for category menu 
        function loadsubcategory() {
            console.log('hello');
            var payload = {
                sno: "",
                item: "",
                load: "loadsubcategory",
            }

            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    console.log("subcategory",response);
                    let dropdown = document.getElementById("sub_items-dp");
                    dropdown.innerHTML = ""; //clear any existing options
                    let defaultOption = document.createElement('option');
                    defaultOption.value = "";
                    defaultOption.text = "Select Category";
                    defaultOption.disabled = true; // Make the default option disabled
                    defaultOption.selected = true; // Make the default option selected
                    dropdown.appendChild(defaultOption);
                    response.data.forEach(x => {
                        let option = document.createElement('option');
                        option.value = x.sno;
                        option.text = x.subcategory;
                        dropdown.appendChild(option);
                    });

                },
                error: function(err) {
                    console.error("Error loading subcategory:", err);

                }
            });
        }
        loadsubcategory();

        // this function is for category menu screen
        function loadItemsByCategory() {
            const selectedCategory = document.getElementById("item_category").value;
            if (!selectedCategory) return;

            var payload = {
                category: selectedCategory,
                load: "loadItemsByCategory"
            };

            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    const tbody = document.querySelector(".lun_table tbody");
                    tbody.innerHTML = ""; // Clear existing rows

                    if (response.data && response.data.length > 0) {
                        response.data.forEach(item => {
                            const activityLabel = item.activity == 1 ? "Deactivate" : "Activate";
                            const row = `<tr>
                        <td>${item.subcategory}</td>
                        <td><button onclick="editItem(${item.SNO}, '${item.subcategory}')">Edit</button></td>
                        <td><button onclick="activity(${item.SNO}, ${item.activity})">${activityLabel}</button></td>
                    </tr>`;
                            tbody.insertAdjacentHTML("beforeend", row);
                        });
                    } else {
                        tbody.innerHTML = "<tr><td colspan='3'>No items found for this category.</td></tr>";
                    }
                },
                error: function(err) {
                    console.error("Error loading items:", err);
                }
            });
        }

        //  for category screen  {
        let editSubcategoryId = null; // To track the subcategory being edited

        // Add New Subcategory
        document.querySelector("#add").addEventListener('click', () => {
            var selectedCategory = document.getElementById("item_category").value;
            var subcategoryName = document.getElementById("subcategory_name").value.trim();

            if (subcategoryName === "") {
                alert("Category name cannot be empty!");
                return;
            }

            if (selectedCategory === "") {
                alert("Please select a FoodType!");
                return;
            }

            var payload = {
                foodtype: selectedCategory,
                subcategory: subcategoryName,
                load: "addSubcategory"
            };

            document.getElementById('add').disabled = true; // Disable button during the request

            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        alert("Subcategory added successfully!");
                        resetForm();
                        loadItemsByCategory(); // Reload updated list
                    } else {
                        alert("Failed to add subcategory: " + response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    alert("An error occurred: " + xhr.responseText);
                    console.error("Error adding subcategory:", error);
                },
                complete: function() {
                    document.getElementById('add').disabled = false; // Re-enable button
                }
            });
        });

        // Edit Function - Shows Update & Cancel buttons, hides Save button
        function editItem(sno, subcategoryName) {
            document.getElementById("subcategory_name").value = subcategoryName;
            editSubcategoryId = sno;

            // Toggle button visibility
            document.getElementById('add').style.display = 'none';
            document.getElementById('update').style.display = 'inline-block';
            document.querySelector('.cnclbtn').style.display = 'inline-block';
        }

        // Update Function
        document.getElementById('update').addEventListener('click', function() {
            const updatedName = document.getElementById("subcategory_name").value.trim();
            const selectedCategory = document.getElementById("item_category").value;

            if (updatedName === "") {
                alert("Subcategory name cannot be empty!");
                return;
            }

            var payload = {
                sno: editSubcategoryId,
                foodtype: selectedCategory,
                subcategory: updatedName,
                load: "updateSubcategory"
            };

            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        alert("Subcategory updated successfully!");
                        resetForm();
                        loadItemsByCategory(); // Reload updated list
                    } else {
                        alert("Failed to update subcategory: " + response.msg);
                    }
                },
                error: function(err) {
                    console.error("Error updating subcategory:", err);
                }
            });
        });

        // Cancel Button Function
        document.querySelector('.cnclbtn').addEventListener('click', resetForm);

        // Reset Form Function - Hides Update & Cancel, Shows Save
        function resetForm() {
            document.getElementById("subcategory_name").value = '';
            editSubcategoryId = null;

            document.getElementById('add').style.display = 'inline-block';
            document.getElementById('update').style.display = 'none';
            document.querySelector('.cnclbtn').style.display = 'none';
        }

        // activity button function for category menu
        function activity(sno, currentActivity) {
            var payload = {
                sno: sno,
                activity: currentActivity,
                load: "activityStatusChange"
            };

            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {

                    if (response.status === "success") {

                        loadItemsByCategory(); // Refresh the list after update
                    } else {
                        alert("Failed to change status: " + response.msg);
                    }
                },
                error: function(err) {
                    console.error("Error changing activity status:", err);
                }
            });
        }


        // drop down for category for item menu 
        function loadsubcategory1(foodtype) {
            var payload = {
                foodtype: foodtype,
                load: "loadsubcategory1",
            };

            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    let dropdown = document.getElementById("sub_items");
                    dropdown.innerHTML = "<option value='' disabled selected>Select Category</option>";
                    if (response.status === 'success') {
                        response.data.forEach(x => {
                            let option = document.createElement('option');
                            option.value = x.sno;
                            option.text = x.subcategory;
                            dropdown.appendChild(option);
                        });
                    } else {
                        dropdown.innerHTML = "<option disabled>No Subcategories Found</option>";
                    }
                },
                error: function(err) {
                    console.error("Error loading subcategory:", err);
                }
            });
        }
        loadsubcategory1();

        // drop down for category for item  menu 
        function loadfoodtype1() {
            var payload = {
                load: "loadfoodtype1"
            };

            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    let dropdown = document.getElementById("sub_item_category");
                    dropdown.innerHTML = "<option value='' disabled selected>Select Food Type</option>";
                    response.data.forEach(x => {
                        let option = document.createElement('option');
                        option.value = x.sno;
                        option.text = x.type;
                        dropdown.appendChild(option);
                    });

                    dropdown.addEventListener('change', function() {
                        loadsubcategory1(this.value);
                    });
                },
                error: function(err) {
                    console.error("Error loading foodtype:", err);
                }
            });
        }
        loadfoodtype1();





        // fetching items for item menu
        function loadItemsByCategory1() {
    const selectedCategory = document.getElementById("sub_item_category").value;
    const selectedSubCategory = document.getElementById("sub_items").value;
    if (!selectedCategory || !selectedSubCategory) return;

    const payload = {
        category: selectedCategory,
        subcategory: selectedSubCategory,
        load: "loadItemsByCategory1"
    };

    $.ajax({
        type: "POST",
        url: "./webservices/fooddetails1.php",
        data: JSON.stringify(payload),
        contentType: "application/json",
        dataType: "json",
        success: function(response) {
            console.log("resultttttttttt", response);
            const tbody = document.querySelector(".lun_table1 tbody");
            tbody.innerHTML = ""; // Clear existing rows

            if (response.data && response.data.length > 0) {
                response.data.forEach(item => {
                    // Define activity label based on activity status (you can adjust logic)
                    const activityLabel = item.activity === 1 ? "Deactivate" : "Activate";

                    const row = `<tr>
                        <td>${item.ItemName}</td>
                        <td>${item.Price}</td>
                        <td><button onclick="editItemi(${item.OptionID}, '${item.ItemName.replace(/'/g, "\\'")}')">Edit</button></td>
                        <td><button onclick="activityi(${item.OptionID}, ${item.activity})">${activityLabel}</button></td>
                    </tr>`;
                    tbody.insertAdjacentHTML("beforeend", row);
                });
            } else {
                tbody.innerHTML = "<tr><td colspan='4'>No items found for this category.</td></tr>";
            }
        },

        error: function(err) {
            console.error("Error loading items:", err);
        }
    });
}

        // Trigger load on dropdown change
        $("#sub_item_category, #sub_items").change(loadItemsByCategory1);


// for item screen 
document.querySelector("#addi").addEventListener('click', () => {
            // console.log("item and price add");
            var selectedCategory = document.getElementById("sub_item_category").value;
            var subcategoryName = document.getElementById("sub_items").value;
            var selectitemname = document.getElementById("item_name").value.trim();
            var selectprice = document.getElementById("item_number").value.trim();

            if (selectprice === "") {
                alert("Price cannot be empty!");
                return;
            }
            if (selectitemname === "") {
                alert("Item name cannot be empty!");
                return;
            }
            if (subcategoryName === "") {
                alert("Please select a Category name!");
                return;
            }

            if (selectedCategory === "") {
                alert("Please select a  FoodType!");
            }

            var payload = {
                foodtype: selectedCategory,
                subcategory: subcategoryName,
                itemname: selectitemname,
                price: selectprice,
                load: "additemname"
            }
            document.getElementById('addi').disabled = true; // Disable button during the request
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    console.log("item and price add", response);
                    if (response.status === "success") {
                        alert("Item Name added successfully!");
                        document.getElementById("item_name").value = "";
                        resetForm();   
                        loadfoodtype1();
                        loadItemsByCategory1();
                    } else {
                        alert("Failed to add subcategory: " + response.msg);
                    }
                },
                error: function(error) {
                    console.error("Error adding itemname:", error);
                }
            });
    });

     // Edit Function - Shows Update & Cancel buttons, hides Save button
  // Edit Function - Shows Update & Cancel buttons, hides Save button
function editItemi(sno, subitemName) {
    document.getElementById("item_name").value = subitemName;
    edititemNameId = sno;

    // Toggle button visibility
    document.getElementById('addi').style.display = 'none';
    document.getElementById('updatei').style.display = 'inline-block';
    document.querySelector('.cnclbtni').style.display = 'inline-block';

    // Disable price field during edit
    document.getElementById("item_number").disabled = true;
}
        // Update Function - Updates only the item name
document.getElementById('updatei').addEventListener('click', function() {
    const updateditemName = document.getElementById("item_name").value.trim();
    const selectedCategory = document.getElementById("sub_item_category").value;
    const subcategoryName = document.getElementById("sub_items").value;

    if (updateditemName === "") {
        alert("Item name cannot be empty!");
        return;
    }

    var payload = {
        sno: edititemNameId,
        foodtype: selectedCategory,
        subcategory: subcategoryName,
        itemname: updateditemName,
        load: "updateitemname"
    };

    $.ajax({
        type: "POST",
        url: "./webservices/fooddetails1.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success: function(response) {
            if (response.status === "success") {
                alert("Item Name updated successfully!");
                resetForm();
                loadItemsByCategory1(); // Reload updated list
            } else {
                alert("Failed to update itemname: " + response.msg);
            }
        },
        error: function(err) {
            console.error("Error updating itemname:", err);
        }
    });
});

        // Cancel Button Function
        document.querySelector('.cnclbtni').addEventListener('click', resetForm);

        // Reset Form Function - Hides Update & Cancel, Shows Save
     // Reset Form Function - Hides Update & Cancel, Shows Save
function resetForm() {
    document.getElementById("item_name").value = '';
    document.getElementById("item_number").value = '';
    document.getElementById("item_number").disabled = false; // Enable price input after edit

    edititemNameId = null;

    document.getElementById('addi').style.display = 'inline-block';
    document.getElementById('updatei').style.display = 'none';
    document.querySelector('.cnclbtni').style.display = 'none';
}



function activityi(sno,currentActivity){
    var payload = {
                sno: sno,
                activity: currentActivity,
                load: "activityStatusChangei"
            };

            console.log(payload);
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {

                    if (response.status === "success") {

                        loadItemsByCategory1(); // Refresh the list after update
                    } else {
                        alert("Failed to change status: " + response.msg);
                    }
                },
                error: function(err) {
                    console.error("Error changing activity status:", err);
                }
            });
}










        document.querySelector('.cnclbtn').addEventListener('click', function() {
            document.getElementById("subcategory_name").value = '';
            document.querySelector('#update').style.display = 'none';
            document.querySelector('.cnclbtn').style.display = 'none';
            document.getElementById('#add').style.display = 'block';
        });
    </script>


</body>

</html>
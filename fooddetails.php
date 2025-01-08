<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body{
            height:80vh;
        }
        .heading2 {
            text-align: center;
            background-color: #4c4c4d;
            color: white;
            padding: 2px 0;
            font-size: 12px;
            font-weight: bold;
            width:100%;
        }


        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            /* Add space between input fields and the table */
        }

        .form-group input {
            width: 20%;
            padding: 10px;
            margin: 0 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #4c4c4d;
            margin-left: -4px;
        }

        /* .btn-primary:hover {
            background-color: #ea8dfc;
            margin-left: -2px;
        } */

        .btn-danger {
            background-color: #f50f1a;
        }

        .existing-categories {
            margin-top: 20px;
            /* Add space above the table */
        }

        .category-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .category-table thead {
            background-color: pink;
            color: white;
        }

        .category-table th,
        .category-table td {
            border: 1px solid #ccc;
            padding: 15px;
        }

        .category-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .edit-buttonfd {
            background-color: #4c4c4d;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* .edit-button:hover {
            background-color: #ea8dfc;
        } */


        .complaint_container h2 {
            margin-left: 20px;
        }

        /*.main-container {

            display: flex;
            align-items: center;
            flex-wrap: wrap; 
             justify-content: space-around;

            height: 95vh;
            width: 88%;
            margin: 50px 270px; 
        } */

        .category-container {
            width: 70%;
            padding: 10px;

        }

        .btn-primary {
            height: 40px;
            width: 10%;
            /* padding: 10px; */
        }

        .btn-primary .edit {
            width: 20%;
        }

        .category-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border: 2px #ccc solid;
            background-color: white;
            border-radius: 10%;
            /* border:2px solid red; */
        }

        .category-table td {
            background-color: white;
        }

        .category-table th,
        .category-table td {
            padding: 15px;
            text-align: center;
            width: 100px;
            max-width: 100px;
            white-space: nowrap;
            border: 1px #ccc solid;
            align-items: center;
            justify-content: center;


        }


        .category-table thead {
            background-color: white;
            position: sticky;
            top: 0;
            z-index: 0.5;

        }

        .category-table th {
            height: 60px;
            background-color:#4c4c4d;
        }

        .category-table td {
            height: 20px;

        }

        .form-group .btn-primary {
            width: 15%;
            gap: 5%;
        }

        .existing-categories {
            height: 50vh;
            overflow-y: scroll;
            position: relative;
            border:2px solid gray;

        }

        .existing-categories::-webkit-scrollbar {
            display: none;
        }

        .edit-buttonfd {
            color: white;
            padding: 8px 25px;
        }

        .sb {
            width: 20%;
        }

        @media (min-width: 700px) and (max-width:1024px) {
            .sb {
                height: 0px;
                width: 100%;
                display: none;
            }

            .sb.open {
                height: 100%;
                transition: .4s ease-in-out;
                width: 20%;
            }
        }

        #ItemName,
        #Price, 
        #category,
        .food_item,
        .food_items_dp{
            border: none;
            border-bottom: 2px solid rgb(6, 6, 6);
            outline: none;
            padding: 5px;

            font-size: 14px;


        }

        #ItemName {

            margin-right: 10px;
            width: 180px;


        }
        #from_date,#to_date {
            width:100px;
        }
        #ItemName {
            width: 100px;


        }
        .fund-container{
            /* border:2px solid green; */
            display:flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
           
        }
        .category-container {
            width: 100%;
            padding: 10px;
            height:80%;
            margin-top:0px;
        }
        .add-category-form{
            /* border:2px solid blue; */
            height:50px;
        }
        .category-table th {
            border: 1px solid #ccc;
            padding: 0px;
            height:4vh;
        }
        .category-table td {
            padding: 5px;
        }
        /* Style for the category label */
#button label {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin-top: 10px;
}
.add_bf{
    /* border:2px solid black; */
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    /* padding:10px; */
    height:55vh;
    width:40vw;
    display:none;
    margin:20px auto;
    border-radius: 10px;
    background-color:white;   
    flex-direction: row;
    justify-content: space-between;
}
.add_table_bf {
    width: 100%;
    border-collapse: collapse;
    border:none;
    background-color: transparent;
}

.add_table_bf thead th, .add_table_bf tbody td {
    /* background-color: white; */
    color: black;
    padding: 5px;
    font-size: 12px; 
    line-height: 1;
    /* border: 1px solid #ddd;  */
    text-align: center;
    border:none;
    border-radius: 0px;
}

.add_table_bf tbody tr {
    /* background-color: white; */
    color: black;
    height: 10px;  
   
}

.food_items_dp{
    width:200px;
}
.no_price{
    display:none;
    align-items: center;
    justify-content: center;
    text-align: center;
}
.bf_itm_row input{
    border:none;
    border-bottom: 2px solid black;
    outline:none;
    background-color: transparent;
}
.bf_itm_row td:nth-child(1){
    background-color: #FFC857;
    font-weight: bold;
}
.add_table_bf thead th{
    background-color: white;
    font-size: 18px;
    background-color:#FFC857;
    color:white;
    height:5vh; 
}
.add_table_bf thead{
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.35);
}
.add_table_bf thead th:nth-child(1){
    border-top-left-radius: 10px;
}
.add_table_bf thead th:nth-child(3){
    border-top-right-radius: 10px;
}
.add_table_bf tbody td{
    font-size: 16px;
}
.add_table_bf thead th:nth-child(2){
    width:100px;
}
.bf_eidtbtn{
    background-color: transparent;
    padding:2px;
    margin:auto auto;
    width:4vw;
    border-radius: 5px;
    border: 2px solid #FF5733  ;
    color:#FF5733  ;
    transition: background-color 0.3s ease, color 0.3s ease; 
}
.bf_eidtbtn:hover{
    background-color: #FF5733;
    color:white;
    cursor:pointer;
}



    </style>
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
                <div class="existing-categories">
                    <table class="category-table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>From
                                    Date</th>
                                <!-- <th>To
                                    Date
                                </th> -->
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody id="typesTableBody">
                            <!-- Dynamic content will be inserted here -->
                        </tbody>
                    </table>
                    <p class="no_price">Price not yet inserted</p>
                </div>
            </div>


            <div class="add_bf">
                <table class="add_table_bf">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Item</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody class="bfd_body">
                        
                    </tbody>
                </table>
            </div>
          


        </div>
        </div>
        </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        let editingId = null;

$(document).ready(function() {
    fetchBackendData(); // Initial fetch when page loads
    load_foodType();    // Ensure the category dropdown is populated
});

//function for load food prices
function loadFoodPrices(){
    var payload = {
        OptionID:document.querySelector('#food_items-dp').value,
        load:"load_foodprices",
    }
    console.log("paydload",payload);
    $.ajax({
        type:"POST",
        url: "./webservices/fooddetails1.php",
        dataType: 'json',
        data: JSON.stringify(payload),
        success:function(response){
            console.log(response.data);
           if(response.data !== "No Data"){
            document.querySelector('.no_price').style.display = "none";
            console.log(response.data);
                const typesTableBody = $('#typesTableBody');
                typesTableBody.empty();
                response.data.forEach(item => {
                const fromDate = new Date(item.fromdate).toISOString().split('T')[0];  // Convert to YYYY-MM-DD format
                // const toDate = new Date(item.to_date).toISOString().split('T')[0];  // Convert to YYYY-MM-DD format

                const row = $('<tr>');
                row.html(`
                    <td>${item.type}</td>
                    <td>${item.item_name}</td>
                    <td>${item.price}</td>
                    <td>${fromDate}</td>
                    <td><center><button class="edit-buttonfd">Edit</button></center></td>
                `);
                typesTableBody.append(row);
            });
           }
           else{
            const typesTableBody = $('#typesTableBody');
            typesTableBody.empty();
            document.querySelector('.no_price').style.display = "block";
           }
        },
        error:function(err){
            console.log(err);
        }
    })
}


function loadFdItemByCategory(){
  var payload = {
    category: document.querySelector('.category').value,
    load:"loadfdby_category"
  }
  $.ajax({
    type:"POST",
    url: "./webservices/fooddetails1.php",
    dataType: 'json',
    data: JSON.stringify(payload),
    success:function(response){
       if(response.data !== "No Data"){
        let foodItems = document.querySelector('#food_items-dp');
        foodItems.innerHTML = `<option value="">Select Food Item</option>`;
        response.data.forEach(itm=>{
            let option = document.createElement('option');
            option.value = itm.OptionID
            option.textContent = itm.ItemName
            foodItems.appendChild(option);
        })
       }
    }
    ,
    error:function(err){
        console.log(err);
    }
  })
  
}

function navbtns(this_button){
    if(this_button.classList.contains('bf_din')){
        document.querySelector('.category-container').style.display = "none";
        document.querySelector('.add_bf').style.display = "flex";
        fetchBreakFast_Dinner();
       
    }
    else if(this_button.classList.contains('pr_btn')){
        document.querySelector('.category-container').style.display = "block";
        document.querySelector('.add_bf').style.display = "none";
   
    }
    else{
        document.querySelector('.category-container').style.display = "none";
        document.querySelector('.add_bf').style.display = "none";
    
    }
}


//function for fetch breakfast dinner items
function fetchBreakFast_Dinner(){
    var payload = {
        load:"loadbreakfast"
    }

    $.ajax({
        type: 'POST',
        url: "./webservices/fooddetails1.php",
        dataType: 'json',
        data: JSON.stringify(payload),
        success:function(response){
            let bfd_body = document.querySelector('.bfd_body');
            bfd_body.innerHTML = "";
           response.data.forEach(itm=>{
                console.log("hello");
                let trow = document.createElement('tr');
                trow.setAttribute('class','bf_itm_row')
                trow.innerHTML = `
                <td>${itm.Weekday}</td>
                <td><input value="${itm.FoodItem}" class="bf_item_input_${itm.ID}"></td>
                <td><button class="bf_eidtbtn" onclick="breakfastfooditems('${itm.ID}','${itm.FoodItem}','${itm.FromDate}','${itm.Price}')">Edit</button></td>
                `
                bfd_body.appendChild(trow);
           })

        },
        error:function(err){
            console.log(err);
        }
    })
}
//insert and update breakfast dinner items
function breakfastfooditems(id, fooditem,fromdate,price){
    let action = "update";
    
    let pitem = fooditem;
    let new_item = document.querySelector(`.bf_item_input_${id}`).value;
  
    if(new_item === ""){
        alert("Item Name can't be null")
        return;
    }
    if(pitem === ""){
        action="insert"
    }
    if(pitem === new_item){
        alert("Please change the item")
        return
    }
    console.log(fromdate,price);
 

     var payload= {
        load: 'breakfastfooditems',
        OptionID:id,
        ItemName:new_item,
        action:action,
        from_date:fromdate ?? "",
        Price:price ?? ""
     }
        $.ajax({
        type: 'POST',
        url: "./webservices/fooddetails1.php",
        dataType: 'json',
        data: JSON.stringify(payload),
        success:function(response){
            if (response.code === '200') {
            alert(response.alert); // Show success alert
        } else {
            alert(response.alert); // Show error alert
        }
          console.log(response)
        },
        error:function(error){
            console.log(error)
            
        }
   
        })
}
        



function fetchBackendData() {
    const payload = {
        load: 'get'
    };

    $.ajax({
        type: 'POST',
        url: "./webservices/fooddetails1.php",
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            const typesTableBody = $('#typesTableBody');
            typesTableBody.empty(); // Clear the table body

            response.data.forEach(item => {
                const fromDate = new Date(item.from_date).toISOString().split('T')[0];  // Convert to YYYY-MM-DD format
                const toDate = new Date(item.to_date).toISOString().split('T')[0];  // Convert to YYYY-MM-DD format

                const row = $('<tr>');
                row.html(`
                    <td>${item.category}</td>
                    <td>${item.ItemName}</td>
                    <td>${item.Price}</td>
                    <td>${fromDate}</td>
                    <td>${toDate}</td>
                    <td><center><button class="edit-buttonfd" onclick="startEdit('${item.OptionID}', '${item.csno}', '${item.ItemName}', '${item.Price}', '${fromDate}', '${toDate}')">Edit</button></center></td>
                `);
                typesTableBody.append(row);
            });
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
}

function load_foodType() {
    var payload = {
        sno: "",
        type: "",
        load: "load_foodtype"
    };
    $.ajax({
        type: "POST",
        url: "./webservices/reports.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success: function(response) {
            if (response.status === "Success") {
                let foodtype = document.querySelector('.category');
                foodtype.innerHTML = '';  // Clear the existing options

                // Create a default option (Empty) for the dropdown
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select Category';
                foodtype.appendChild(defaultOption);

                response.data.forEach(fd => {
                    const option = document.createElement('option');
                    option.value = fd.sno; // Category ID (e.g., 1, 2, 3)
                    option.textContent = fd.type; // Category name (e.g., Breakfast, Lunch, Dinner)
                    foodtype.appendChild(option); // Append to the dropdown
                });
            }
        },
        error: function(err) {
            console.log(err);
            alert("Something went wrong. Please try again later.");
        }
    });
}

function startEdit(OptionID, csno, ItemName, Price, from_date, to_date) {
    // Set the selected category based on the category ID
    $('#category').val(csno); // This should be category_id (the ID) and not the name

    $('#OptionID').val(OptionID); // Autofill input fields for editing
    $('#ItemName').val(ItemName);
    $('#Price').val(Price);
    $('#from_date').val(from_date);
    $('#to_date').val(to_date);

    editingId = OptionID; // Set editing ID
}

function submitForm() {
    const category = $('#category').val();
    const OptionID = $('#food_items-dp').val();
    const Price = $('#Price').val();
    const from_date = $('#from_date').val();
    const ItemName = $('#food_items-dp option:selected').text();

    if (!category || !OptionID || !Price || !from_date ) {
        alert("Fields can't be empty");
        return;
    }

    const payload = {
        category: category,
        OptionID: OptionID,
        ItemName:ItemName,
        Price: Price,
        from_date: from_date,
        load:"setFoodPrices"
        // to_date: to_date,
        // load: editingId ? 'update' : 'add',
        // OptionID: editingId // Include OptionID for update, not for add
    };
    console.log("d",payload);

    $.ajax({
        type: 'POST',
        url: "./webservices/fooddetails1.php",
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            console.log(response);
            alert(response.message);
            // fetchBackendData(); // Refresh the table
            // $('#category').val(''); // Clear input fields
            // $('#ItemName').val('');
            // $('#Price').val('');
            // $('#from_date').val('');
            // $('#to_date').val('');
            // editingId = null; // Reset editing ID
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}

        function cancelOperation() {
            $('#OptionID').val(''); // Clear input fields
            $('#category').val('');
            $('#ItemName').val('');
            $('#Price').val('');
            $('#from_date').val('');
            $('#to_date').val('');

            editingId = null; // Reset editing ID
        }
        document.getElementById('ItemName').addEventListener('input', function() {
            if (this.value.length > 20) {
                this.value = this.value.slice(0, 20); // Truncate the value to 6 characters
            }
        });
        document.getElementById('category').addEventListener('input', function() {
            if (this.value.length > 15) {
                this.value = this.value.slice(0, 20); // Truncate the value to 6 characters
            }
        });
        document.getElementById('Price').addEventListener('input', function() {
            if (this.value.length > 8) {
                this.value = this.value.slice(0, 8); // Truncate the value to 6 characters
            }
        });

        
        document.getElementById('from_date').addEventListener('change', function() {
    var fromDate = this.value;
    document.getElementById('to_date').setAttribute('min', fromDate);
});


    
    </script>
</body>

</html>
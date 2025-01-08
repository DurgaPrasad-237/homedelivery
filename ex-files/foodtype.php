<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            height: 50vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .heading2 {
            text-align: center;
            background-color: #4c4c4d;
            color: white;
            padding: 10px 0;
            font-size: 16px;
            font-weight: bold;
        }
        thead {
            background-color: #f2f2f2;
            position: sticky;
            top: 0;
            z-index: 1;

        }

        .button-container {
            text-align: center;
            margin: 20px 0;
        }

        .button-container .btn {
            margin: 5px;
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: none;
            color: white;
            cursor: pointer;
        }

        .btn-primary {
            background-color: green;
        }

        .btn-primary:hover {
            background-color: #32a852;
        }

        .btn-danger {
            background-color: #f50f1a;
        }

        .btn-danger:hover {
            background-color: #d11124;
        }

        .existing-categories {
            margin: 50px 450px;
            width: 60%;
            max-height: 60vh;
            height: 50vh;
            overflow-y: scroll;
            position: relative;

        }
     
        .existing-categories::-webkit-scrollbar {
            display: none;
        }

  .category-table thead {
            background-color: white;
            position: sticky;
            top: 0;
            z-index: 0.5;

        }
        .category-table::-webkit-scrollbar {
            display: none;
        }


        .category-table {
            width: 60%;
            border-collapse: collapse;
            text-align: center;
            background-color: white;
        }

        .category-table th {
            background-color: #4c4c4d;
            color: white;
            padding: 10px;
            
        }
        .category-table::-webkit-scrollbar {
    display: none; /* Hide the scrollbar for the table itself */
}

        .category-table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .category-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .edit-button {
            background-color: #4c4c4d;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-button:hover {
            background-color: #5e5e5f;
        }
        #newLunchItem {
            width: 20vw;
            height: 40px;
            border: none;
            border-bottom: 2px solid black;
            outline: none;
        }
    #add{
        background-color: #5e5e5f;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 18%;
            margin-left: 45px;
    }
    .add-lunch-item {
    position: sticky;     
    top: 0;
    background-color: white; /* Match the background to avoid overlap */
    
}


    </style>
    <title>Food Types</title>
</head>

<body>
    <div class="heading2">
        Food Types
    </div>

    <div class="button-container">
        <button class="btn btn-primary" onclick="getBreakfastDinnerItems()">Breakfast/Dinner</button>
        <button class="btn btn-danger" onclick="getLunchItems()">Lunch</button>
    </div>

    <div class="existing-categories">
    <!-- Input text and Add button directly above the table -->
    <div class="add-lunch-item" style="margin-bottom: 10px; display: none;">
        <input type="text" id="newLunchItem" placeholder="Enter lunch item name" style="padding: 5px; margin-right: 10px;"/>
        <button type="submit" id="add" class="btn btn-danger" name="add">Add LunchItem</button>
        </div>
    <table class="category-table">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Item Name</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody id="typesTableBody">
                <!-- Dynamic content will be inserted here -->
            </tbody>
        </table>
        
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
    fetchBackendData(currentCategory);
});

let editingId = null;
let currentCategory = 1; // Default category: Breakfast/Dinner
let addlunchitem = document.querySelector("#add");
addlunchitem.addEventListener('click', () => {
            // e.preventDefault();
            var categoryName = document.getElementById("newLunchItem").value.trim();
            if (categoryName === "") {
            alert("Lunchitem cannot be empty!");
          return;
        }
        var payload = {
                OptionID: "",
                ItemName: document.getElementById("newLunchItem").value,
                load: "addlunchitem"
            }
            $.ajax({
                type: "POST",
                url: "./webservices/foodtype1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    alert(response.status);
                    loadlunch();
                    // if (response.status === "success") {
                    //     loadamenity();
                    // }
                },
                error: function(error) {
                    console.log(error);
                }
                
            })
        if (categoryName === categoryName) {
          return;
        }
        })
function loadlunch() {

var payload = {
    OptionID: "",
    ItemName: "",
    load: "loadlunch",
}

$.ajax({
    type: "POST",
    url: "./webservices/sample1.php",
    data: JSON.stringify(payload),
    dataType: "json",
    success: function(response) {
        let tbd = document.querySelector("#typesTableBody");
        response.data.forEach(x => {
            let tdrow = document.createElement('tr');
            tdrow.innerHTML = `<td>${x.ItemName}</td><td><button  class="tdbtn" onclick="updatelunch(${x.OptionID},'${x.ItemName}')">EDIT</button></td>`;
            tbd.appendChild(tdrow);
        })


    },
    error: function(err) {

    }
})


}


function fetchBackendData(category) {
    const payload = { load: 'get', category: category };

    $.ajax({
        type: 'POST',
        url: "./webservices/foodtype1.php",
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function (response) {
            console.log('breakfast',response)
            const typesTableBody = $('#typesTableBody');
            const categoryTable = $('.category-table');
            const tableHeaders = categoryTable.find('thead tr');

            typesTableBody.empty(); // Clear existing rows

            if (category === 2) { 
                $('.add-lunch-item').show();
                // Lunch category
                tableHeaders.html(`
                
                    <th>Item Name</th>
                    <th>Edit</th>
                `); // Remove Day column for Lunch
                response.data.forEach(item => {
                    const row = $('<tr>');
                    row.html(`
                        <td><input data-fooditem="${item.ItemName}" value="${item.ItemName}"/></td>
                        <td>
                            <button class="edit-button" onclick="updateLunchItems(${category})">Update</button>
                        </td>
                    `);
                    typesTableBody.append(row);
                });
            } else { // Breakfast/Dinner category
                    // Hide the "Add Lunch Item" input and button
                    $('.add-lunch-item').hide();
                 tableHeaders.html(`
                    <th>Day</th>
                    <th>Item Name</th>
                    <th>Edit</th>
                `); // Include Day column for Breakfast/Dinner
                response.data.forEach(item => {
                    const row = $('<tr>');
                    row.html(`
                        <td>${item.day}</td>
                        <td><input data-fooditem="${item.ItemName}" id="itemName-${item.sno}" value="${item.ItemName}"/></td>
                        <td>
                            <button class="edit-button" onclick="breakfastfooditems(${item.sno}, ${category})">Edit</button>
                        </td>
                    `);
                    typesTableBody.append(row);
                });
            }
        },
        error: function () {
            console.error('Error fetching data');
        }
    });
}
function updateLunchItems($category) {
    console.log($category)
   alert('Hello')
}
function breakfastfooditems(OptionID, category){
    let action;
    let pitem = document.querySelector(`#itemName-${
        OptionID}`).dataset.fooditem;
    if(pitem === ""){
            action = "insert"             
            console.log('insert')
        }
        else{
            action = "update"            
            console.log('update')
        }
     var payload= {
        load: 'breakfastfooditems',
        OptionID:OptionID,
        category:category,
        ItemName:document.querySelector(`#itemName-${
        OptionID}`).value,
        action:action
     }
     console.log('212',payload)
        $.ajax({
        type: 'POST',
        url: "./webservices/foodtype1.php",
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
        function updateLunchItem(OptionID, category) {
    const itemName = document.querySelector(`#itemName-${OptionID}`).value; // Get the item name from the input field

    // Validate the input
    if (itemName.trim() === "") {
        alert("Item name cannot be empty!");
        return;
    }

    // Payload to send to the backend
    const payload = {
        load: 'updateLunchItem', // Action for updating lunch items
        OptionID: OptionID,
        category: category,
        ItemName: itemName,
        action: "update"
    };

    $.ajax({
        type: 'POST',
        url: './webservices/sample1.php', // Backend PHP endpoint
        data: JSON.stringify(payload),    // Send payload as JSON
        contentType: 'application/json',  // Set content type to JSON
        dataType: 'json',
        success: function (response) {
            if (response.code === '200') {
                alert('Lunch item updated successfully!');
                fetchBackendData(category); // Refresh the data
            } else {
                alert('Failed to update lunch item.');
            }
        },
        error: function () {
            alert('Error occurred while updating the lunch item.');
        }
    });
}
        
function getBreakfastDinnerItems() {
    currentCategory = 1; // Set category to Breakfast/Dinner
    fetchBackendData(currentCategory);
}

// This function is called when the "Lunch" button is clicked
function getLunchItems() {
    currentCategory = 2; // Set category to Lunch
    fetchBackendData(currentCategory);
}

    </script>
</body>

</html>

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
        #category{
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
        </div>
        <div class="main-container">
            <div class="category-container">
                <div class="add-category-form">



                    <div class="form-group" id="button">
                    <label for="category">Category:</label>
                        <select id="category" class="category">
                        <option value="">Select category</option>
                                                        <!-- <option value="daily">Daily</option>
                            <option value="monthly">Monthly</option> -->
                        </select>
                        <input type="text" id="ItemName" name="ItemName" placeholder="ItemName" required>
                        <input type="number" id="Price" name="Price" placeholder="Price" min="1" max="24" required>
                        <label for="from_date">From:</label>
                        <input type="date" id="from_date" name="from_date" required>

                        <label for="to_date">To:</label>
                        <input type="date" id="to_date" name="to_date" required>

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
                                <th>To
                                    Date
                                </th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody id="typesTableBody">
                            <!-- Dynamic content will be inserted here -->
                        </tbody>
                    </table>
                </div>
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
    const ItemName = $('#ItemName').val();
    const Price = $('#Price').val();
    const from_date = $('#from_date').val();
    const to_date = $('#to_date').val();

    if (!category || !ItemName || !Price || !from_date || !to_date) {
        alert("Fields can't be empty");
        return;
    }

    const payload = {
        category: category,
        ItemName: ItemName,
        Price: Price,
        from_date: from_date,
        to_date: to_date,
        load: editingId ? 'update' : 'add',
        OptionID: editingId // Include OptionID for update, not for add
    };

    $.ajax({
        type: 'POST',
        url: "./webservices/fooddetails1.php",
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            alert(response.message);
            fetchBackendData(); // Refresh the table
            $('#category').val(''); // Clear input fields
            $('#ItemName').val('');
            $('#Price').val('');
            $('#from_date').val('');
            $('#to_date').val('');
            editingId = null; // Reset editing ID
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
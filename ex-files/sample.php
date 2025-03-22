<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Food Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/fooddetails.css">
<script>

function loadFoodPrices(x) {
    console.log("fffffffffff");
    if(x){
        document.querySelector('#sub_items-dp').value = '';
    }
    var payload = {
        OptionID: document.querySelector('#food_items-dp').value,
        category:document.getElementById('category').value,
        load: "load_foodprices",
    };
    console.log("payload", payload);
    $.ajax({
        type: "POST",
        url: "./webservices/fooddetails1.php",
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function (response) {
            console.log(response.data);
            if (response.data !== "No Data") {
                document.querySelector('.no_price').style.display = "none";

                // Filter the data to find the latest record for each OptionID
                const currentDate = new Date();
                let nearestRecords = {};

                response.data.forEach(item => {
                    const fromDate = new Date(item.fromdate);
                    if (fromDate <= currentDate) { // Ensure the date is in the past or today
                        if (!nearestRecords[item.OptionID] || fromDate > new Date(nearestRecords[item.OptionID].fromdate)) {
                            nearestRecords[item.OptionID] = item; // Store latest record for each OptionID
                        }
                    }
                });

                const typesTableBody = $('#typesTableBody');
                typesTableBody.empty();

                // Populate table with all filtered records
                Object.values(nearestRecords).forEach(record => {
                    const fromDateFormatted = new Date(record.fromdate).toISOString().split('T')[0];
                    const row = $('<tr>');
                    row.html(`
                        <td>${record.item_name}</td>
                        <td>${record.price}</td>
                        <td>${fromDateFormatted}</td>
                        <td>
                            <button class="view_history" >
                                <i class="fa-solid fa-eye fa-beat-fade" onclick="loadhistory(this,'${record.OptionID}')" style="font-size: 18px;"></i>
                            </button>
                        </td>
                    `);
                    typesTableBody.append(row);

                });
                $('#typesTableBody').show();

            } else {
                const typesTableBody = $('#typesTableBody');
                typesTableBody.empty();
                document.querySelector('.no_price').style.display = "block";
            }
        },
        error: function (err) {
            console.log(err);
        }
    });
}


function loadFoodPricessub(x) {
    console.log("fffffffffff");
    if(x){
        document.querySelector('#sub_items-dp').value = '';
    }
    var payload = {
        OptionID: document.querySelector('#food_items-dp').value,
        category:document.getElementById('sub_items-dp').value,
        load: "load_foodpricessub",
    };
    console.log("payload", payload);
    $.ajax({
        type: "POST",
        url: "./webservices/fooddetails1.php",
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function (response) {
            console.log(response.data);
            if (response.data !== "No Data") {
                document.querySelector('.no_price').style.display = "none";

                // Filter the data to find the latest record for each OptionID
                const currentDate = new Date();
                let nearestRecords = {};

                response.data.forEach(item => {
                    const fromDate = new Date(item.fromdate);
                    if (fromDate <= currentDate) { // Ensure the date is in the past or today
                        if (!nearestRecords[item.OptionID] || fromDate > new Date(nearestRecords[item.OptionID].fromdate)) {
                            nearestRecords[item.OptionID] = item; // Store latest record for each OptionID
                        }
                    }
                });

                const typesTableBody = $('#typesTableBody');
                typesTableBody.empty();

                // Populate table with all filtered records
                Object.values(nearestRecords).forEach(record => {
                    const fromDateFormatted = new Date(record.fromdate).toISOString().split('T')[0];
                    const row = $('<tr>');
                    row.html(`
                        <td>${record.item_name}</td>
                        <td>${record.price}</td>
                        <td>${fromDateFormatted}</td>
                        <td>
                            <button class="view_history" >
                                <i class="fa-solid fa-eye fa-beat-fade" onclick="loadhistory(this,'${record.OptionID}')" style="font-size: 18px;"></i>
                            </button>
                        </td>
                    `);
                    typesTableBody.append(row);
                });
                $('#typesTableBody').show();

            } else {
                const typesTableBody = $('#typesTableBody');
                typesTableBody.empty();
                document.querySelector('.no_price').style.display = "block";
            }
        },
        error: function (err) {
            console.log(err);
        }
    });
}




// function for load food prices
function loadhistory(x, OptionID) {
    console.log("loadhistory", x);
    
    // Get all elements with 'fa-eye-slash' class and reset them
    document.querySelectorAll('.fa-eye-slash').forEach(el => {
        if (el !== x) {
            el.classList.add('fa-eye');
            el.classList.remove('fa-eye-slash');
        }
    });

    let payload = {
        OptionID: OptionID,
        load: "load_foodhistory"
    };
    
    console.log("Payload", payload);

    $.ajax({
        type: "POST",
        url: "./webservices/fooddetails1.php",
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            console.log("Response Data:", response.data);
            
            const tableHead = document.getElementById('tablehead');
            const typesTableBody = $('#typesTableBody1');

            // If the same eye icon is clicked again, hide the table and reset icon
            if (x.classList.contains('fa-eye-slash')) {
                x.classList.add('fa-eye');
                x.classList.remove('fa-eye-slash');
                $('#tablehead').hide();
                typesTableBody.empty();
                return;  // Exit function
            }

            if (response.data !== "No Data") {
                document.querySelector('.no_price').style.display = "none";
                typesTableBody.empty();

                x.classList.add('fa-eye-slash');
                x.classList.remove('fa-eye');
                $('#tablehead').show();

                let initial = false;
                response.data.forEach(item => {
                    const fromDate = new Date(item.fromdate).toISOString().split('T')[0]; // Format YYYY-MM-DD
                    let disabledStatus = initial ? "disabled" : "enabled";

                    const row = $('<tr>');
                    row.html(`
                        <td> 
                            <input ${disabledStatus} type="number" min="0" data-prev="${item.price}" 
                                oninput="priceChange(${item.log_sno})" 
                                class="price_${item.log_sno}" value="${item.price}" 
                                style="width:70px;text-align:center"/> 
                        </td>
                        <td>${fromDate}</td>
                        <td>
                            <center>
                                <button disabled id="fdedtbtn" class="edit_buttonfd_${item.log_sno}" 
                                    onclick="foodPriceEdit('${item.log_sno}','${item.OptionID}')">
                                    Edit
                                </button>
                            </center>
                        </td>
                    `);
                    typesTableBody.append(row);
                    initial = true;
                });
                $('#tablehead').show();
                $('#typesTableBody1').show();
            } else {
                $('#tablehead').hide();
                $('#typesTableBody1').hide();
                typesTableBody.empty();
                document.querySelector('.no_price').style.display = "block";
            }
        },
        error: function(err) {
            console.log("Error:", err);
        }
    });
}











if(sectionId === 'prices-content') {
                document.getElementById('from_date').value = "" ;
                document.getElementById('category').selectedIndex = 0 ;
                document.getElementById('sub_items-dp').innerHTML = "<option value='' disabled selected>Select Category</option>";
                document.getElementById('food_items-dp').innerHTML = "<option value='' disabled selected>Select Food Item</option>";
                document.getElementById('Price').value = "";
                $('#typesTableBody').hide();
                $('#typesTableBody1').hide();
                $('#tablehead').hide();
                

               
            }
            else if(sectionId === 'items-menu'){
                alert(sectionId)
                document.getElementById('category_name').value = "";
                $('#typesTableBody').hide();
                $('#typesTableBody1').hide();
                $('#tablehead').hide();
               
            }




</script>


</body>

</html>
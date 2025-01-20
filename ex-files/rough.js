#lunch-options-containers {
    max-height: 300px; /* Set the maximum height for scrolling */
    overflow-y: auto; /* Enable vertical scrolling */
    overflow-x: hidden; /* Disable horizontal scrolling */
    border: 1px solid #ddd; /* Optional: Add a border for better visibility */
    margin-top: 10px;
    height: 24vh;
    
}
#lunch-options-containers::-webkit-scrollbar{
    display: none;
}


/* Table styles */
#lunch-table-l {
    width: 100%;
    border-collapse: collapse; /* Ensure cells share borders */
    table-layout: fixed; /* Fix column widths for better layout control */
}

/* Sticky header styles */
#lunch-table-l thead th {
    position: sticky;
    top: 0; /* Stick the header to the top of the container */
    /* Optional: Background color for header */
    z-index: 10; /* Ensure header stays on top */
    text-align: left;
    padding: 8px;
    border-bottom: 2px solid #ccc; /* Add a bottom border for header */
}

/* Table body rows styling */
#lunch-table-l tbody td {
    padding: 8px;
    border-bottom: 1px solid #ddd; /* Optional: Add row borders */
}

/* Optional: Fixed position for the entire lunch-box-b container */
#lunch-box-b {
    position: fixed;
    top: 284px;
    left: 666px;
    z-index: 100;
    /* background-color: #fff; */
    /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
    padding: 10px;
    border-radius: 4px;
    width: 47%;
}
/* Scrollable container styles */
.scrollable-table-container {
    max-height: 510px; /* Set maximum height for the rows */
    overflow-x: auto; /* Enable horizontal scrolling */
   /* Enable vertical scrolling */
    border: 1px solid #ddd; /* Optional border for visibility */
    position: relative;
}

/* Table styling */
#lunch-table {
    width: 100%;
    border-collapse: collapse; /* Ensure cells share borders */
    min-width: 600px; /* Ensure horizontal scrolling triggers for wide tables */
}

/* Sticky header */
#lunch-table thead th {
    position: sticky;
    top: 0; /* Keep header at the top during vertical scrolling */
    z-index: 2; /* Ensure it stays above table rows */
    text-align: left;
    padding: 8px;
    border-bottom: 2px solid #ccc; /* Optional: Add a bottom border */
}

/* Table rows */
#lunch-table tbody td {
    padding: 8px;
    border-bottom: 1px solid #ddd; /* Optional: Row borders */
}

/* Optional: Fixed container for lunch-box */
#lunch-box {
    /* position: fixed;
    top: 100px; /* Adjust based on your page layout */
    left: 430px; /* Adjust based on your page layout */
    /* z-index: 10; */
    background-color: #fff;
    padding: 10px;
    border-radius: 4px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional shadow */
    /* width: 65%;  */
    width: 97.5%;
    margin-left: 0%;
}

/* Scrollbar styling (optional) */
.scrollable-table-container::-webkit-scrollbar {
    height: 8px; /* Horizontal scrollbar height */
    width: 8px; /* Vertical scrollbar width */
    display: none;
}

.scrollable-table-container::-webkit-scrollbar-thumb {
    background: #888; /* Scrollbar thumb color */
    border-radius: 4px;
}

.scrollable-table-container::-webkit-scrollbar-thumb:hover {
    background: #555; /* Scrollbar thumb hover color */
}








/* script  */
function fetchalll(thlength) {
    console.log("lundiids",lunchidsprice);
    console.log("thlength",thlength);
    const payload = {
        load: "lunchdetails",
        cid: customerid // Ensure `customerid` is defined dynamically in your script
    };

    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(payload),
        success: function(response) {
            console.log("Fetched data:", response,response.length);

            const chargesTableBody = document.querySelector('#lunch-table tbody');
            chargesTableBody.innerHTML = ''; // Clear existing rows

            const today = new Date(); // Get today's date
            const daysInMonth = 30; // Number of days to display

            // Group data by date if available
            const groupedData = response.status === 'success' && response.data
                ? response.data.reduce((acc, item) => {
                    acc[item.Date] = acc[item.Date] || [];
                    acc[item.Date].push(item);
                    return acc;
                }, {})
                : {};

            // Loop through the days to populate the table
            for (let i = 0; i < daysInMonth; i++) {
                const currentDate = new Date(today);
                currentDate.setDate(today.getDate() + i);
                const formattedDate = currentDate.toISOString().split('T')[0];

                const row = document.createElement('tr'); // Create a new row

                // Check if there's an existing order for this date
                const rowData = groupedData[formattedDate] || [];

                let count = 0;
                row.innerHTML = `
                    <td>${formattedDate}</td>
                    
                    ${Array.from({ length: thlength }).map((_, index) => {
                        count = (count > thlength) ? 1 : count + 1;

                        const matchingItem = rowData.find(item => item.OptionID === lunchidsprice[count - 1].id);
                        const quantity = matchingItem ? matchingItem.Quantity : 0;
                        const price = matchingItem ? matchingItem.Price : lunchidsprice[count - 1].price;

                        return `
                            <td>
                                <input 
                                    type="number" 
                                    class="tableqty" 
                                    data-tdate="${formattedDate}" 
                                    data-optionid="${lunchidsprice[count - 1].id}"
                                    data-price="${price}"
                                    value="${quantity}" 
                                    data-initial-value="${quantity}" 
                                    placeholder="0" 
                                    style="width:38px"
                                    min="0"
                                    oninput="updateEditButtonState(this.closest('tr'))">
                            </td>
                        `;
                    }).join('')}

                    <td>
                        <input 
                            type="text" 
                            class="reason-input" 
                            data-tdate="${formattedDate}"
                            style="width:200px">
                    </td>
                    <td>
                        <button class="edit-button" 
                                data-tdate="${formattedDate}" 
                                onclick="updateOrder(this)" 
                                ${rowData.length === 0 ? 'disabled' : ''}>
                            Edit
                        </button>
                    </td>
                `;
                // Calculate the initial sum for this row
    const inputs = row.querySelectorAll('.tableqty');
    const initialSum = Array.from(inputs).reduce((sum, input) => {
        return sum + parseInt(input.value || 0, 10);
    }, 0);
    row.setAttribute('data-initial-sum', initialSum); // Store in `data-initial-sum`

                chargesTableBody.appendChild(row);

                // Initialize Edit button state
                updateEditButtonState(row);
            }

            document.querySelector("#lunch-options-container").style.display = "block";
        },
        error: function(error) {
            console.error("Error fetching data:", error);
            document.querySelector("#lunch-options-container").style.display = "block";
        }
    });
}

function updateOrder(buttonElement) {
    const row = buttonElement.closest('tr'); // Find the row
    const tdate = buttonElement.getAttribute('data-tdate'); // Date of the row
    const inputs = row.querySelectorAll('.tableqty'); // All inputs in the row
    const reasonInput = row.querySelector('.reason-input'); // Reason input field

    const lunchdata = []; // Data payload
    let isUpdate = false; // Flag for update operation
    let allInitialZero = true; // Flag to check if all initial values are 0

    // Collect item names for confirmation messages
    const itemNames = [];
    const decreasedItems = []; // Items whose quantity is reduced but not to 0
    const zeroQuantityItems = []; // Items whose quantity is reduced to 0
    const increasedItems = []; // Items whose quantity is increased

    // Loop through all inputs
    inputs.forEach(input => {
        let optionid = input.getAttribute('data-optionid'); // Food ID
        let newQuantity = parseInt(input.value, 10); // New value
        let initialValue = parseInt(input.getAttribute('data-initial-value'), 10); // Initial value
        let price = parseFloat(input.getAttribute('data-price')); // Price
        
        // Dynamically fetch the item name from the corresponding column
        let headerCell = document.querySelector(`[data-ItemID="${optionid}"]`);
let itemName = headerCell ? headerCell.getAttribute('data-ItemName') : `Item ${optionid}`;



        // Check if the value has changed
        if (newQuantity !== initialValue) {
            itemNames.push(itemName);

            if (newQuantity === 0 && initialValue > 0) {
                zeroQuantityItems.push(itemName);
            } else if (newQuantity < initialValue) {
                decreasedItems.push(itemName);
            } else if (newQuantity > initialValue) {
                increasedItems.push(itemName);
            }

            lunchdata.push({
                quantity: newQuantity,
                foodid: optionid,
                price: price,
            });

            // If any initial value is non-zero, it's an update
            if (initialValue !== 0) {
                isUpdate = true;
            }
        }

        // Check if any initial value is non-zero
        if (initialValue !== 0) {
            allInitialZero = false;
        }
    });

    // Validate reason input for updates (not for new records)
    if (isUpdate && !reasonInput.value.trim()) {
        alert("Please provide a reason for updating the quantity.");
        reasonInput.focus();
        return;
    }

    // Prepare confirmation messages
    const decreasedItemList = decreasedItems.join(", ");
    const zeroItemList = zeroQuantityItems.join(", ");
    const increasedItemList = increasedItems.join(", ");

    // Determine if this is an insert operation
    if (allInitialZero) {
        const newOrderMessage = `Are you sure you want to insert a new order for the following items on ${tdate}?\n\nItems: ${increasedItemList || itemNames.join(", ")}`;
        if (!confirm(newOrderMessage)) {
            return;
        }
        console.log("Insert operation detected.");
    } else {
        // Confirmation for zero-quantity items
        if (zeroQuantityItems.length > 0) {
            if (!confirm(`The following items will be canceled on ${tdate}:\n\n${zeroItemList}\n\nAre you sure you want to proceed?`)) {
                return;
            }
            console.log("Items reduced to 0 detected.");
        }

        // Confirmation for items with decreased quantity (but not to 0)
        if (decreasedItems.length > 0) {
            if (!confirm(`The quantity for the following items will be updated on ${tdate}:\n\n${decreasedItemList}\n\nAre you sure you want to proceed?`)) {
                return;
            }
            console.log("Items with decreased quantity detected.");
        }

        // Confirmation for items with increased quantity
        if (increasedItems.length > 0) {
            if (!confirm(`The quantity for the following items will be increased on ${tdate}:\n\n${increasedItemList}\n\nAre you sure you want to proceed?`)) {
                return;
            }
            console.log("Items with increased quantity detected.");
        }
    }

    // If no changes detected
    if (lunchdata.length === 0) {
        alert("No changes detected.");
        return;
    }

    // Prepare the payload
    const payload = {
        load: "updatelunch",
        reason: isUpdate ? reasonInput.value.trim() : null, // Reason only for updates
        date: tdate,
        cid: customerid, // Assume globally available
        foodtype: 2, // Example: FoodTypeID for lunch
        datalunch: lunchdata,
    };

    console.log("Payload to send:", payload);

    // AJAX request
    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(payload),
        success: function(response) {
            if (response.status === 'success') {
                console.log("Server response:", response);

                // Update the state of the edit button dynamically
                updateEditButtonState(row);
                buttonElement.disabled = true;

                alert(response.message);

                // Update initial values to reflect the current state
                inputs.forEach(input => {
                    input.setAttribute('data-initial-value', input.value);
                });
            } else {
                console.warn("Server warning:", response.message);
                alert(response.message);
            }
        },
        error: function(error) {
            console.error("Error during update:", error);
            alert("An error occurred while updating. Please try again.");
        }
    });
}


function headerfetch() {
            console.log("function");
            document.getElementById('lunch-options-container').style.display = 'block';

            let demo = document.querySelector('#lunch-table thead');
            console.log(demo);
            if (!demo) {
                console.error('Table header element not found!');
                return;
            }

            demo.innerHTML = ''; // Clear existing headers
            let tr = document.createElement('tr');
            let th = document.createElement('th');

            // Add the "Date" column at the beginning
            let dateTh = document.createElement('th');
            dateTh.textContent = "Date";
            tr.appendChild(dateTh);

            // Payload for AJAX request
            const payload = {
                load: "fetchheader"
            };

            // Fetch data from the server
            $.ajax({
                url: './webservices/dinner.php',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify(payload),
                success: function(response) {
                    console.log("2729",response,response.data.length);
                    thlength=response.data.length;

                    if (response.code === 200 && Array.isArray(response.data)) {
                        console.log('Fetched Data:', response.data);

                        // Populate headers based on fetched data
                        response.data.forEach(item => {
                            let th = document.createElement('th');
                            th.setAttribute('data-ItemName', `${item.ItemName}`)
                            th.setAttribute('data-Price', `${
                                item.Price}`)
                            th.textContent = `${item.ItemName}  ${item.Price} `;
                            th.setAttribute('data-ItemID', `${
                                item.OptionID}`)
                            tr.appendChild(th);

                            lunchidsprice.push({
                                id: item.OptionID,
                                price: item.Price
                            })
                        });

                        let reasonTh = document.createElement('th');
                        reasonTh.textContent = "Reason";
                        tr.appendChild(reasonTh);

                        // Add the "Edit Function" column at the end
                        let editTh = document.createElement('th');
                        editTh.textContent = "Edit";
                        tr.appendChild(editTh);

                        demo.appendChild(tr); // Append the row to the table header
                    } else {
                        console.error('No data available:', response.messagde || 'Unknown error');
                        alert('No data available to display.');
                    }
                    fetchalll(thlength);
                },
                error: function(error) {
                    console.error('Error fetching header data:', error);
                    alert('Failed to fetch data.');
                }
            });
        }

        
    function closeSummaryModal(event) {
        event.preventDefault();

        // document.getElementById("mealqtyb").value = binitialqty;
        // document.getElementById("mealamtb").value = binitialamt;
        // document.getElementById("mealqtydb").value = dinitialqty;
        // document.getElementById("mealamtdb").value = dinitialamt;
        document.getElementById("mealqtylb").value = linitialqty;
        document.getElementById("mealamountb").value = linitialamt;
        console.log("lunchquantity",linitialqty,"lunchamount",linitialamt);
       

        document.getElementById("lunch-box-b").style.display = "none";

        $('#lunch-options-containers').hide();
        const lunchRadioBtn = document.querySelector('input[name="lunch-category"][value="category1"]');
        if (lunchRadioBtn) {
            lunchRadioBtn.checked = false;  
        }
        let linitialqty=0;
        let linitialamt=0;
        function showLunchB() {
            linitialqty = document.getElementById('mealqtylb').value;
            linitialamt = document.getElementById('mealamountb').value;
            console.log("lunchquantity",linitialqty,"lunchamount",linitialamt);
            document.getElementById("breakfast-box-b").style.display = "none";
            document.getElementById("lunch-box-b").style.display = "block";
            document.getElementById("dinner-box-b").style.display = "none";
            const radioBtn = document.querySelector('input[name="lunch-category"][value="category1"]');
            if (radioBtn) {
                radioBtn.checked = true; 
            }
            fetchalllunch();
        }
        
        
        let allItems = []; // Global array to store fetched items

// Function to fetch all lunch items
function fetchalllunch() {
    allItems = []; // Clear global array
    const payload = { load: 'fetch' };

    $.ajax({
        url: "./webservices/dinner.php",
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function (response) {
            console.log("All Lunch Items Response:", response);

            if (response.status === 'success' && response.data) {
                const chargesTableBody = $('#lunch-table-l tbody');
                chargesTableBody.empty(); // Clear the table

                response.data.forEach(item => {
                    const row = $(`
                        <tr>
                            <td class="itemname">${item.ItemName}</td>
                            <td class="price">${item.Price}</td>
                            <td>
                                <input 
                                    type="number" 
                                    class='tableqtyl'
                                    id='tableqtyl'
                                    data-optionid1="${item.OptionID}" 
                                    placeholder="0" 
                                    min="0" 
                                    style="width:100px">
                            </td>
                        </tr>
                    `);
                    chargesTableBody.append(row);

                    // Add item to global array
                    allItems.push({
                        itemname: item.ItemName,
                        price: item.Price,
                        foodid: item.OptionID // Ensure consistency with data-optionid1
                    });
                });
                fetchQuantitiesForCustomer(); // Fetch quantities for customer orders

                $("#lunch-options-containers").show();
            } else {
                console.error('Error in response data:', response.message || 'Unknown error');
            }
        },
        error: function (error) {
            console.error('Error fetching lunch items:', error);
        }
    });
}

// Function to fetch quantities for customer orders
function fetchQuantitiesForCustomer() {
    console.log("Fetching quantities for all items...");

    const today = new Date();
    const formattedDate = today.toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

    if (typeof customerid === 'undefined' || customerid === null) {
        console.error("Customer ID is not defined.");
        return;
    }

    const payload = {
        load: "fetchQuantities",
        cid: customerid, // Ensure customerid is dynamically set
        date: formattedDate // Pass the specific date
    };

    console.log("Payload:", payload); // Debug payload

    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(payload),
        success: function (response) {
            console.log("Quantities fetched for the specific date:", response);

            if (response.status === 'success' && response.data) {
                const quantities = response.data;

                // Update table rows with fetched quantities using map
                quantities.map(order => {
                    const inputField = $(`input[data-optionid1="${order.OptionID}"]`);
                    if (inputField.length > 0) {
                        inputField.val(order.Quantity);
                    }
                });

                console.log("Quantities successfully updated in the table.");
            } else {
                console.error(response.message || 'No quantities found.');
            }
        },
        error: function (error) {
            console.error("Error fetching quantities:", error);
        }
    });
}

// based on date quantity in the input box for lunch bulk
// Event listener for date changes
$('#from-date-l, #to-date-l').on('change', function () {
    const fromDate = $('#from-date-l').val();
    const toDate = $('#to-date-l').val();

    if (fromDate && toDate) {
        handleDateChangeL(fromDate, toDate);
    } else {
        console.error("Both From Date and To Date are required.");
    }
});

// Function to handle date range change
function handleDateChangeL(fromDate, toDate) {
    console.log(`Handling date range change: ${fromDate} to ${toDate}`);

    if (typeof customerid === 'undefined' || customerid === null) {
        console.error("Customer ID is not defined.");
        return;
    }

    // Fetch quantities for both dates
    fetchQuantities(fromDate, function (fromData) {
        fetchQuantities(toDate, function (toData) {
            // Compare quantities between the two dates
            if (fromData && toData) {
                updateQuantitiesIfMatched(fromData, toData);
            } else {
                console.error("Quantities not found or do not match.");
                clearQuantities();
            }
        });
    });
}

// Helper function to fetch quantities for a specific date
function fetchQuantities(date, callback) {
    const payload = {
        load: "fetchQuantities",
        cid: customerid,
        date: date
    };

    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(payload),
        success: function (response) {
            if (response.status === 'success' && response.data) {
                callback(response.data); // Pass data to the callback
            } else {
                console.error(`No quantities found for date: ${date}`);
                callback(null); // No data
            }
        },
        error: function (error) {
            console.error(`Error fetching quantities for date: ${date}`, error);
            callback(null); // Error
        }
    });
}

// Helper function to update quantities if they match
function updateQuantitiesIfMatched(fromData, toData) {
    let isMatch = true;

    // Check if both datasets have the same OptionIDs and Quantities
    fromData.forEach(fromItem => {
        const toItem = toData.find(item => item.OptionID === fromItem.OptionID);
        if (!toItem || fromItem.Quantity !== toItem.Quantity) {
            isMatch = false;
        }
    });

    if (isMatch) {
        fromData.forEach(order => {
            const inputField = $(`input[data-optionid1="${order.OptionID}"]`);
            if (inputField.length > 0) {
                inputField.val(order.Quantity); // Update with matching quantity
            }
        });
        console.log("Quantities match and have been updated.");
    } else {
        console.log("Quantities do not match. Clearing fields.");
        clearQuantities();
    }
}

// Helper function to clear quantities in input fields
function clearQuantities() {
    $('input[data-optionid1]').each(function () {
        $(this).val(''); // Clear the value
    });
}

function nlunch(event) {
    event.preventDefault();

    const fromDate = $('#from-date-l').val();
    const toDate = $('#to-date-l').val();
    // const customerid = 2; // Replace with actual customer ID
    const lunchdata = []; // Replace with actual lunch data
    const tdate = new Date().toISOString().split('T')[0];

    let payload = {
        load: 'nlunch',
        cid: customerid,
        foodtype: 2,
        dates: [],
        items: []
    };

    // Validate and populate dates
    if (fromDate && toDate) {
        const from = new Date(fromDate);
        const to = new Date(toDate);

        if (from > to) {
            alert('Invalid date range. Please correct it.');
            return;
        }

        // Populate dates array with range
        for (let current = new Date(from); current <= to; current.setDate(current.getDate() + 1)) {
            payload.dates.push(current.toISOString().split('T')[0]);
        }
    } else {
        alert('No dates provided. Defaulting to today.');
        payload.dates.push(tdate); // Default to today's date
    }

    // Collect quantities from the form
    allItems.forEach(item => {
        const quantity = $(`input[data-optionid1="${item.foodid}"]`).val() || 0;
        const parsedQuantity = parseInt(quantity, 10);

        if (parsedQuantity > 0) {
            payload.items.push({
                itemname: item.itemname,
                price: item.price,
                quantity: parsedQuantity,
                foodid: item.foodid
            });
        }
    });

    if (payload.items.length === 0) {
        alert("Please enter quantities for at least one lunch item.");
        return;
    }

    console.log('Payload:', payload);

    // AJAX request to server
  $.ajax({
    type: 'POST',
    url: './webservices/dinner.php',
    dataType: 'json',
    contentType: 'application/json',
    data: JSON.stringify(payload),
    success: function (response) {
        console.log('Server Response:', response);
        
        if (response.code === '200') {
            let alertMessage = `Order placed successfully\nFrom: ${response.fromDate}\nTo: ${response.toDate}\n`;

            // Add item details to alert message (only once)
            response.items.forEach(item => {
                alertMessage += `${item.itemname}: ${item.quantity}\n`;
            });

            alert(alertMessage);
        } else {
            alert(response.message || 'Order could not be placed.');
        }
        headerfetch();
        fetchalll();

    },
    error: function (xhr, status, error) {
        console.error('Error response:', xhr.responseText);
        alert(`An error occurred: ${error}. Please try again later.`);
    }
});

}


// Function to update total amount
function updateLunchTotaldl() {
    let totalAmount = 0;

    function calculateTableTotal(tableId) {
        $(`${tableId} tbody tr`).each(function() {
            const price = parseFloat($(this).find('td:nth-child(2)').text().trim()); // Get the price
            const quantity = parseInt($(this).find('input[type="number"]').val()); // Get the quantity
            console.log("Price:", price, "Quantity:", quantity);
            if (!isNaN(price) && !isNaN(quantity)) {
                totalAmount += price * quantity;
            }
        });
    }
// totalAmount = 0;
    calculateTableTotal('#lunch-table-l');
    // calculateTableTotal('#lunch-table1-l');
    $('#mealamountb').val(totalAmount.toFixed(2));
}

// Function to update total quantity
function updateLunchQuantitydl() {
    let totalQuantity = 0;

    $('#lunch-table-l tbody input[type="number"]').each(function() {
        const quantity = parseInt($(this).val(), 10); // Parse the value as an integer
        if (!isNaN(quantity) && quantity > 0) {
            totalQuantity += quantity;
        }
    });

    $('#mealqtylb').val(totalQuantity); // Default to 0 if no valid quantities
}

// Attach the event listener to dynamically update the total amount and quantity
$(document).on('input', '#lunch-table-l tbody input[type="number"]', function() {
    updateLunchTotaldl();
    updateLunchQuantitydl();
});















// backend functions

elseif($load == "nlunch"){
    nlunch($conn);
}
elseif($load == "fetchQuantities"){
    fetchQuantities($conn);
}


function fetchQuantities($conn) {
    // Ensure customer ID is available in session or passed dynamically
    global $cid,$date; // Assuming $cid is set globally
   

    // Query to fetch today's quantities for a specific customer and food type
    $sql = "SELECT 
                o.OrderDate AS Date,
                i.OptionID AS OptionID,
                i.ItemName AS ItemName,
                o.Quantity AS Quantity,
                i.Price AS Price
            FROM 
                orders o
            INNER JOIN 
                fooddetails i ON o.FoodID = i.OptionID
            WHERE 
                o.CustomerID = $cid 
                AND o.FoodTypeID = 2 
                AND o.OrderDate = '$date'
            ORDER BY 
                i.OptionID ASC";

    // Execute the query and fetch results
    $result = getdata($conn, $sql);

    // Return the response as JSON
    if (count($result) > 0) {
        echo json_encode([
            'code' => '200',
            'status' => 'success',
            'data' => $result
        ]);
    } else {
        echo json_encode([
            'code' => '204',
            'status' => 'error',
            'message' => $date
        ]);
    }
}

// Function to fetch all items
function getall($conn) {
    // Query to fetch all items for category 2
    $sql = "SELECT ItemName, Price, OptionID FROM fooddetails WHERE category = 2";
    
    // Execute the query and fetch results
    $result = getdata($conn, $sql);

    // Return the response as JSON
    $jsonresponse = [
        'code' => '200',
        'status' => 'success',
        'data' => $result
    ];
    echo json_encode($jsonresponse);
}


function nlunch($conn) {
    global $totalamount, $cid, $dates, $foodtype, $items;

    if (empty($dates)) {
        echo json_encode(['code' => '400', 'status' => 'error', 'message' => "Date range is missing"]);
        return;
    }

    // Prepare response data for alert
    $responseDetails = [
        'fromDate' => $dates[0],  // Assuming dates[0] is the start date
        'toDate' => end($dates),   // Assuming the last date in dates is the end date
        'items' => []
    ];

    // Start transaction for bulk operations
    mysqli_begin_transaction($conn);

    // Collect item details only once
    foreach ($items as $ld) {
        $foodid = $ld['foodid'];
        $quantity = (int)$ld['quantity'];
        $price = (float)$ld['price'];
        $totalamount = $price * $quantity;

        // Add item details to response array
        if ($quantity > 0) {
            $responseDetails['items'][] = [
                'itemname' => $ld['itemname'],
                'quantity' => $quantity
            ];
        }

        // Insert or update order and food items for each date
        foreach ($dates as $date) {
            // Check if an order already exists for the given date and customer
            $cdquery = "SELECT OrderID FROM orders WHERE OrderDate = '$date' AND FoodTypeID = $foodtype AND CustomerID = $cid";
            $cdresult = getData($conn, $cdquery);

            if ($cdresult && count($cdresult) > 0) {
                // Order already exists, so update it
                $orderid = $cdresult[0]['OrderID'];

                // Check if the food item already exists in the order
                $checkfoodid = "SELECT OrderID FROM orders WHERE OrderID = '$orderid' AND FoodID = '$foodid'";
                $resultcheckfoodid = getData($conn, $checkfoodid);

                if (count($resultcheckfoodid) > 0) {
                    // Update the existing food item in the order
                    $updatequery = "UPDATE orders SET TotalAmount = '$totalamount', Quantity = '$quantity', Status = '1' 
                                    WHERE OrderID = '$orderid' AND FoodID = '$foodid'";
                    setData($conn, $updatequery);
                } else {
                    // Insert the new food item if it doesn't exist
                    $insertquery = "INSERT INTO orders (OrderID, CustomerID, OrderDate, FoodTypeID, TotalAmount, Status, Quantity, CategoryID, FoodID) 
                                    VALUES ('$orderid', '$cid', '$date', '$foodtype', '$totalamount', '1', '$quantity', '1', '$foodid')";
                    setData($conn, $insertquery);
                }
            } else {
                // No order exists, so create a new one
                $querylastorderid = "SELECT COALESCE(MAX(OrderID), 0) + 1 AS orderid FROM orders";
                $resultorderid = getData($conn, $querylastorderid);
                $orderid = $resultorderid[0]['orderid'];

                // Insert the food item into the new order
                $insertquery = "INSERT INTO orders (OrderID, CustomerID, OrderDate, FoodTypeID, TotalAmount, Status, Quantity, CategoryID, FoodID) 
                                VALUES ('$orderid', '$cid', '$date', '$foodtype', '$totalamount', '1', '$quantity', '1', '$foodid')";
                setData($conn, $insertquery);
            }

            // Log the action (insert or update)
            $logQuery = "INSERT INTO logs (CustomerID, OrderID, Quantity, Price, FoodType) 
                         VALUES ('$cid', '$orderid', '$quantity', '$price', '$foodtype')";
            setData($conn, $logQuery);

            // Process payment
            payments($cid, $date, $conn);
        }
    }

    // Commit transaction
    mysqli_commit($conn);

    // Send a success response with item details
    echo json_encode([
        'code' => '200',
        'status' => 'success',
        'message' => 'Order placed successfully',
        'fromDate' => $responseDetails['fromDate'],
        'toDate' => $responseDetails['toDate'],
        'items' => $responseDetails['items']
    ]);
}
function getAllFoodDetails($conn) {
    $sql = "SELECT OptionID, ItemName FROM fooddetails";
    $result = getData($conn, $sql);

    $foodDetails = [];
    foreach ($result as $row) {
        $foodDetails[$row['OptionID']] = $row['ItemName'];
    }

    return $foodDetails;
}

function getall($conn) {
    // Query to fetch all items for category 2
    $sql = "SELECT ItemName, Price, OptionID FROM fooddetails WHERE category = 2";
    
    // Execute the query and fetch results
    $result = getdata($conn, $sql);

    // Return the response as JSON
    $jsonresponse = [
        'code' => '200',
        'status' => 'success',
        'data' => $result
    ];
    echo json_encode($jsonresponse);
}
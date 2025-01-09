<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
           #summary-modal {
            display: none;
            position: fixed;
            top: 20%;
            left: 40%;
            width: 50%;
            background: white;
            border: 1px solid #ccc;
            padding: 20px;
            z-index: 100;
            border-radius: 10px;
            max-height: 82vh;
            height: 68vh;
        }

        .dialog-container th {
            min-width: 100px;
            max-width: 130px;
        }

        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
        }

        #closesummary {
            float: right;
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
            margin-top: -50px;
        }

        .selection-container-b {
            display: flex;
            flex-direction: column;
            width: 96%;
            padding: 15px;
            background-color: white;
            border-radius: 10px;
            /* box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); */
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            height: 50vh;
            overflow-y: scroll;
            position: relative;
            cursor: default;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .selection-container::-webkit-scrollbar {
            display: none;
        }

        .button-container-b {
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-bottom: 2px solid #ddd;

        }

        #mealqtyb,
        #mealqtydb,
        #mealqtylb {
            width: 45px;
            height: 30px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0 0px 0 10px;
            margin: 5px;
            box-sizing: border-box;
        }

        #mealamtb,
        #mealamtdb,
        #mealamtlb,
        #mealamountb {
            width: 70px;
            height: 30px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0 0px 0 10px;
            margin: 5px;
            box-sizing: border-box;

        }

        .menu-button-b {
            padding: 10px 14px;
            font-size: 14px;
            border: 2px solid #000;
            border-radius: 5px;
            background-color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .menu-button-b:hover {
            background-color: #ddd;
            border-color: #444;
        }

        .menu-button-b:active {
            background-color: #bbb;
        }

        #insert-button,
        #cancel-button{
            background-color: #557e8f;
            color: white;
            padding: 6px 12px;
            border: 1px solid grey;
            border-radius: 4px;
        }

        #cancel-button{
            background-color: grey;
        }

        .buttons{
            display: flex;
            justify-content: space-between;
            padding: 10px;
            margin-top: 1%;
        }

    </style>
</head>
<body>

<div id="overlay"></div>
            <div id="summary-modal">
                <h4><b>Place Order</b></h4>
                <button onclick="closeSummaryModal(event)" type="submit" id="closesummary">X</button>
                <div class="dialog-container">
            <div class="selection-container-b">
                <div class="button-container-b">
                    <button class="menu-button-b" onclick="showBreakfastB()">
                        Breakfast
                        <input type="number" id="mealqtyb" value="0" readonly />
                        <input type="number" id="mealamtb" value="0" readonly />
                    </button>
                    <button class="menu-button-b" onclick="showLunchB()">Lunch
                        <input type="number" id="mealqtylb" value="0" readonly />
                        <input type="number" id="mealamountb" value="0" readonly />
                    </button>
                    <button class="menu-button-b" onclick="showDinnerB()">
                        Dinner
                        <input type="number" id="mealqtydb" value="0" readonly />
                        <input type="number" id="mealamtdb" value="0" readonly />
                    </button>
                    
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
                                    <input type="radio" name="breakfast-category" value="category1" onclick="fetchallb()">
                                    Category 1
                                </label>
                                <label>
                                    <input type="radio" name="breakfast-category" value="category2" disabled>
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
                                    <input type="radio" name="lunch-category" value="category1" onclick="fetchalll()">
                                    Category 1
                                </label>
                                <label>
                                    <input type="radio" name="lunch-category" value="category2">
                                    Category 2
                                </label>
                            </td>
                        </tr>
                    </table>

                    <!-- Dynamic Options Container -->
                    <div id="lunch-options-container" style="display: none; margin-top: 10px;">
                        <table id="lunch-table">
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


                    <div class="add-items">
                        <button onclick="fetchadditems()">Add Items</button>
                    </div>
                    <div id="lunch-options-container1" style="display: none; margin-top: 10px;">
                        <table id="lunch-table1">
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


                    </div>

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
                                    <input type="radio" name="dinner-category" value="category1" onclick="getallb()">
                                    Category 1
                                </label>
                                <label>
                                    <input type="radio" name="dinner-category" value="category2" disabled>
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
               
                <div class="buttons">
                    <button id="insert-button" type="submit" onclick="placeorder(event)">Save</button>
                    <button id="cancel-button">Cancel</button>
                </div>


                    </div> 
            </div>
        </div>

        </div>
        </div>
        </div>


        </div>
        </div>




    
</body>

<script>
        async function placeorder(event) {

const addressflat = document.getElementById("address_flat").value;
const addressstreet = document.getElementById("address_street").value;
const addressarea = document.getElementById("address_area").value
const deliverymobile = document.getElementById("address_mobile").value;
const addresslink = document.getElementById("address_link").value;

const baddressflat = document.getElementById("billing_flat").value;
const baddressstreet = document.getElementById("billing_street").value;
const baddressarea = document.getElementById("billing_area").value
const billingmobile = document.getElementById("billing_mobile").value;

const custid = document.querySelector(".customer_id").value;


finaldeliveryaddress = addressflat + "," + addressstreet + "," + addressarea + "," + deliverymobile + "," + addresslink;
billingaddress = baddressflat + "," + baddressstreet + "," + baddressarea;

if (!custid) {
    alert("No user selected")
    return;
}

if (!addressflat || !addressstreet || !addressarea || !deliverymobile || !addresslink) {
    alert("Please the fill the delivery address")
    return ""
}
if (!baddressflat || !baddressstreet || !baddressarea || !billingmobile) {
    alert("Please the fill the billing address")
    return ""
}

intialdeliveryaddress = intialdeliveryaddress.replace(/\s/g, "");
finaldeliveryaddress = finaldeliveryaddress.replace(/\s/g, "");



if (intialdeliveryaddress !== finaldeliveryaddress) {
    finaldeliveryaddress = addressflat + "," + addressstreet + "," + addressarea
    response = await getlastid(finaldeliveryaddress, billingaddress);
    // customerid = response.cid;
    console.log(response);
}



// x = "ABC";
// y = "AC";

// if (x !== y) {
// cid = await getlastid(x, y);
// cid = cid.cid;
// }

// console.log("cid", cid);

const bqty = calculateTotalBB();
const lqty = Number(document.getElementById("mealqtyl").value) || 0;
const dqty = calculateTotalDB();

if ((bqty + lqty + dqty) < 1) {
    alert("Please select at least one item to proceed");
    return;
}

let confirmationMessage = 'Do you want to proceed?';
const confirmation = confirm(confirmationMessage);
if (!confirmation) {
    console.log('User cancelled the operation.');
    return;
}
console.log(bqty, "bqty")
console.log(lqty, "lqty")
console.log(dqty, "dqty")

try {
if (bqty > 0) {
await submitForB(event); // Wait for submitForB to complete
}
if (lqty > 0) {
await lunchdetails(event); // Wait for lunchdetails to complete
}
if (dqty > 0) {
await submitForD(event); // Wait for submitForD to complete
}
console.log('All submissions completed successfully.');
} catch (error) {
console.error('Error during submissions:', error);
}
}

     async function submitForB(event) {
    const quantity = $('#mealqtyb').val();
    const totalAmount = $('#mealamtb').val();
    const fromDate = $('#from-date-b').val();
    const toDate = $('#to-date-b').val();

    const currentDate = new Date();
    const dayOfWeek = currentDate.getDay();
    const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayName = dayNames[dayOfWeek];

    let payload = {
        load: 'setitemsb',
        quantity: quantity,
        category: 1,
        totalAmount: totalAmount,
        foodid: foodidb,
        cid: customerid,
        day: dayName,
        dates: []
    };

    if (quantity < 0) {
        throw new Error('Invalid quantity for breakfast.');
    }
    if (fromDate && toDate) {
        const from = new Date(fromDate);
        const to = new Date(toDate);
        if (from > to) {
            alert('Invalid date range.');
            throw new Error('Invalid date range for breakfast.');
        }
        let current = new Date(from);
        while (current <= to) {
            payload.dates.push(current.toISOString().split('T')[0]); // Format date as YYYY-MM-DD
            current.setDate(current.getDate() + 1);
        }
    } else {
        payload.dates.push(new Date().toISOString().split('T')[0]);
    }

    console.log('Payload for Breakfast:', payload);

    return $.ajax({
        type: 'POST',
        url: './webservices/dinner.php',
        dataType: 'json',
        data: JSON.stringify(payload)
    }).then(response => {
        if (response.status !== 'success') {
            throw new Error(response.message);
        }
        alert(response.message);
    }).catch(error => {
        console.error('Error in submitForB:', error);
        throw error;
    });
}



async function submitForD(event) {
    const quantity = $('#mealqtydb').val();
    const totalAmount = $('#mealamtdb').val();
    const fromDate = $('#from-date-d').val();
    const toDate = $('#to-date-d').val();

    const currentDate = new Date();
    const dayOfWeek = currentDate.getDay();
    const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayName = dayNames[dayOfWeek];

    let payload = {
        load: 'setitemsb',
        quantity: quantity,
        category: 3,
        totalAmount: totalAmount,
        foodid: foodidd,
        cid: customerid,
        day: dayName,
        dates: []
    };

    if (quantity < 0) {
        throw new Error('Invalid quantity for dinner.');
    }
    if (fromDate && toDate) {
        const from = new Date(fromDate);
        const to = new Date(toDate);
        if (from > to) {
            alert('Invalid date range.');
            throw new Error('Invalid date range for dinner.');
        }
        let current = new Date(from);
        while (current <= to) {
            payload.dates.push(current.toISOString().split('T')[0]); // Format date as YYYY-MM-DD
            current.setDate(current.getDate() + 1);
        }
    } else {
        payload.dates.push(new Date().toISOString().split('T')[0]);
    }

    console.log('Payload for Dinner:', payload);

    return $.ajax({
        type: 'POST',
        url: './webservices/dinner.php',
        dataType: 'json',
        data: JSON.stringify(payload)
    }).then(response => {
        if (response.status !== 'success') {
            throw new Error(response.message);
        }
        alert(response.message);
    }).catch(error => {
        console.error('Error in submitForD:', error);
        throw error;
    });
}


</script>
</html>
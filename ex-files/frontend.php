<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
          #breakfast-box-b{
            display: none;
        }
    </style>
</head>
<body>
<div class="selection-container">
            <div class="button-container">
                <button class="menu-button" onclick="showBreakfast()">
                    Breakfast
                    <input type="number" id="mealqty" value="0" readonly />
                    <input type="number" id="mealamt" value="0" readonly />
                </button>
                <button class="menu-button" onclick="showLunch()">Lunch
                    <input type="number" id="mealqtyl" value="0" readonly />
                    <input type="number" id="mealamount" value="0" readonly />
                </button>
                <button class="menu-button" onclick="showDinner()">
                    Dinner
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
                        <input type="radio" name="lunch-category" value="category1" onclick="headerfetch()">
                        Category 1
                    </label>
                    <label>
                        <input type="radio" name="lunch-category" value="category2" disabled>
                        Category 2
                    </label>
                    <button id="insert-button" onclick="openSummaryModal(event)">Place Order</button>
                </div>


                <!-- Dynamic Options Container -->
                <div id="lunch-options-container" style="display: none; margin-top: 10px;">
                    <table id="lunch-table">
                        <thead>

                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
                                    <input type="radio" name="lunch-category" value="category1" onclick="fetchalllunch()">
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
                    <div id="lunch-options-containers" style="display: none; margin-top: 10px;">
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


                    <div class="add-items">
                        <button onclick="fetchadditems()">Add Items</button>
                    </div>
                    <div id="lunch-options-container1" style="display: none; margin-top: 10px;">
                        <table id="lunch-table1-l">
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

    </section>
    
</body>
<script>
    function showBreakfast() {
            const cid = document.querySelector('.customer_id').value;
            if(!cid){
                alert("Please select any user!")
                return
            }
            document.getElementById("breakfast-box").style.display = "block";
            document.getElementById("lunch-box").style.display = "none";
            document.getElementById("dinner-box").style.display = "none";
            document.getElementById("insert-button").style.display = "block";
            document.getElementById("edit-box").style.display = "none";
            document.querySelector('.food_details').style.display = "none";
            const radioBtn = document.querySelector('input[name="breakfast-category"][value="categoryb1"]');
        if (radioBtn) {
            radioBtn.checked = true; // Check the radio button
        }
        fetchall();
    }

        function showDinner() {
            const cid = document.querySelector('.customer_id').value;
            if(!cid){
                alert("Please select any user!")
                return
            }
            document.getElementById("breakfast-box").style.display = "none";
            document.getElementById("lunch-box").style.display = "none";
            document.getElementById("dinner-box").style.display = "block";
            document.getElementById("insert-button").style.display = "block";
            document.getElementById("edit-box").style.display = "none";
            document.querySelector('.food_details').style.display = "none";
            const radioBtn = document.querySelector('input[name="dinner-category"][value="categoryd1"]');
        if (radioBtn) {
            radioBtn.checked = true; // Check the radio button
        }
        getall();
        }

        function openSummaryModal(event) {
            event.preventDefault();
            const cid = document.querySelector('.customer_id').value;
            if(!cid){
                alert("Please select any user!")
                return
            }
            document.getElementById('summary-modal').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

    function closeSummaryModal(event) {
        event.preventDefault();
        // Hide the modal
        document.getElementById('summary-modal').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
        document.getElementById("breakfast-box-b").style.display = "none";
        document.getElementById("dinner-box-b").style.display = "none";
        let today = new Date().toISOString().split('T')[0];
    
    
        document.getElementById('from-date-b').value = today;
        document.getElementById('to-date-b').value = today;
        document.getElementById('from-date-l').value = today;
        document.getElementById('to-date-l').value = today;
        document.getElementById('from-date-d').value = today;
        document.getElementById('to-date-d').value = today;
        $('#breakfast-contain-b').hide();
        $('#dinner-container-b').hide();
        const breakfastRadioBtn = document.querySelector('input[name="breakfast-category-b"][value="categoryb1b"]');
        if (breakfastRadioBtn) {
        breakfastRadioBtn.checked = false;  
        }

        const dinnerRadioBtn = document.querySelector('input[name="dinner-category-b"][value="categoryd1d"]');
        if (dinnerRadioBtn) {
        dinnerRadioBtn.checked = false; 
        }
       
    }

    function showBreakfastB() {
        document.getElementById("breakfast-box-b").style.display = "block";
        document.getElementById("lunch-box-b").style.display = "none";
        document.getElementById("dinner-box-b").style.display = "none";
        const radioBtn = document.querySelector('input[name="breakfast-category-b"][value="categoryb1b"]');
        if (radioBtn) {
            radioBtn.checked = true; 
        }
    }

    function showDinnerB() {
        document.getElementById("breakfast-box-b").style.display = "none";
        document.getElementById("lunch-box-b").style.display = "none";
        document.getElementById("dinner-box-b").style.display = "block";
        const radioBtn = document.querySelector('input[name="dinner-category-b"][value="categoryd1d"]');
        if (radioBtn) {
            radioBtn.checked = true; 
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
                fetchall();
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
                getall();
            }).catch(error => {
                console.error('Error in submitForD:', error);
                throw error;
            });
        }















    
    $('#from-date-b, #to-date-b').on('change', handleDateChangeB);
    $('#from-date-d, #to-date-d').on('change', handleDateChangeD);

// Function for the first date pair (B)
function handleDateChangeB() {
    const fromDateB = $('#from-date-b').val();
    const toDateB = $('#to-date-b').val();
    const payload = { 
        load: 'datechange',
        fromdate: fromDateB,
        todate: toDateB,
        foodtype:1
    };


    if (fromDateB && toDateB) {
        $.ajax({
    url: './webservices/dinner.php',
    type: 'POST',
    dataType: 'json',
    data: JSON.stringify(payload),
    success: function(data) {
        console.log(data,"date check");
       if (data.status === 'success') {
            $('#tableqtyb').val(data.data);
        } else {
            $('#tableqtyb').val(0);
        }
    },
    error: function(error) {
        console.error('Error:', error);
    }
});
    }
}


function handleDateChangeD() {
    const fromDateD = $('#from-date-d').val();
    const toDateD = $('#to-date-d').val();
    const payload = { 
        load: 'datechange',
        fromdate: fromDateD,
        todate: toDateD,
        foodtype:3
    };

   
    if (fromDateD && toDateD) {
        $.ajax({
    url: './webservices/dinner.php',
    type: 'POST',
    dataType: 'json',
    data: JSON.stringify(payload),
    success: function(data) {
        console.log(data);
        
        if (data.status === 'success') {
            $('#tableqtyb').val(data.data);
        } else {
            $('#tableqtyb').val(0);
        }
    },
    error: function(error) {
        console.error('Error:', error);
    }
});
    }
}

</script>
</html>
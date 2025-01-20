<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
<script>
function getall() {
var payload = {
    load: "getitems",
    day: dayName,
    cid: customerid
};

$.ajax({
    url: './webservices/dinner.php',
    type: 'POST',
    dataType: 'json',
    data: JSON.stringify(payload),
    success: function(response) {
        console.log('getall', response);

        const table1Body = $('#d-table1 tbody');
        const table2Body = $('#d-table2 tbody');
        table1Body.empty();
        table2Body.empty();

        // Append data for the first table (first 15 rows)
        response.data.slice(0, 15).forEach((x, index) => {
            let disabled = (x.Status === "2") ? "disabled" : "enabled";
            const row = $('<tr>');
            row.html(`
        <td>${x.Date}</td>
        <td>
            <input type='number' min='0' class='tableqtyd' id='tableqtyd-${x.Date.replaceAll('-', '')}' 
                data-optionid='${x.OptionID}' data-price='${x.Price}' data-index='${index}'  data-category='${x.category}'
                data-initial='${x.Quantity}' value='${x.Quantity}' ${disabled}>
        </td>
        <td><input type='text'  class='reason' id='reason-${x.Date.replaceAll('-', '')}'></td>
        <td><button class="table-btn" onclick="update('${x.Date}', this,'${x.category}','${x.OptionID}','${x.Price}','${x.OrderID}')" disabled>Edit</button></td>
    `);
            table1Body.append(row);
        });

        // Append data for the second table (next 15 rows)
        response.data.slice(15, 30).forEach((x, index) => {
            let disabled = (x.Status === "2") ? "disabled" : "enabled";
            const row = $('<tr>');
            row.html(`
        <td>${x.Date}</td>
        <td>
            <input type='number' min='0' class='tableqtyd' id='tableqtyd-${x.Date.replaceAll('-', '')}' 
                data-optionid='${x.OptionID}' data-price='${x.Price}' data-index='${index}'  data-category='${x.category}'
                data-initial='${x.Quantity}' value='${x.Quantity}' ${disabled}>
        </td>
        <td><input type='text'  class='reason' id='reason-${x.Date.replaceAll('-', '')}'></td>
        <td><button class="table-btn" onclick="update('${x.Date}', this,'${x.category}','${x.OptionID}','${x.Price}','${x.OrderID}')" disabled>Edit</button></td>
    `);
            table2Body.append(row);
        });

        // Enable editing on input click
        $('.tableqtyd').on('click', function() {
            if ($(this).is('[readonly]')) {
                $(this).removeAttr('readonly'); // Make editable
                $(this).focus(); // Focus on the input field
            }
        });

        // Revert to readonly on blur
        $('.tableqtyd').on('blur', function() {
            $(this).attr('readonly', true); // Revert to readonly
        });

        $('.tableqtyd').on('input', function() {
            const $input = $(this);
            const currentValue = parseInt($input.val(), 10) || 0; // Current value
            const initialValue = parseInt($input.data('initial'), 10) || 0; // Initial value
            const dateId = $input.attr('id').split('-')[1]; // Extract the date ID
            const button = $input.closest('tr').find('.table-btn');

            // Enable the button only if the current value differs from the initial value
            if (currentValue !== initialValue) {
                button.prop('disabled', false);
            } else {
                button.prop('disabled', true);
            }
        });
        // initialQuantitySumD = calculateTotalSum('.tableqtyd');
        // $('.tableqtyd').on('input', calculateTotalD); // Optional calculation for dinner total

        $('#dinner-container').show();
    },
    error: function(error) {
        console.error('Error fetching data:', error);
    }
});
}



function calculateTotalB() {
            let totalAmount = 0;
            let totalQuantity = 0;
            let bqty = 0;

            const currentQuantitySum = calculateTotalSum('.tableqtyb');
            const today = new Date().toISOString().split('T')[0];
            $('.tableqtyb').each(function() {
                const row = $(this).closest('tr');
                const rowDate = row.find('td:first').text(); // Assuming the Date is in the first column
                const quantity = parseFloat($(this).val()) || 0;

                if (rowDate === today) {
                    const price = parseFloat($(this).data('price')) || 0;
                    totalAmount += quantity * price;
                    totalQuantity += quantity;
                }
            });

            // Determine if the table has changed
            bqty = currentQuantitySum === initialQuantitySumB ? 0 : 1;

            // Update totals in the UI
            // $('#mealamt').val(totalAmount.toFixed(2));
            // $('#mealqty').val(totalQuantity);

            return bqty;
        }

        // Helper function to calculate the total sum of quantities
        function calculateTotalSum(selector) {
            let sum = 0;
            $(selector).each(function() {
                sum += parseFloat($(this).val()) || 0;
            });
            return sum;
        }

        // Store the initial sum of quantities for dinner

        // Function to calculate total and detect changes for dinner
        function calculateTotalD() {
            let totalAmount = 0;
            let totalQuantity = 0;
            let dqty = 0;

            // Calculate the sum of current quantities
            const currentQuantitySum = calculateTotalSum('.tableqtydb');

            // Get today's date in the format used in the table
            const today = new Date().toISOString().split('T')[0];

            // Iterate through all .tableqtyd elements
            $('.tableqtydb').each(function() {
                const row = $(this).closest('tr');
                const rowDate = row.find('td:first').text(); // Assuming the Date is in the first column
                const quantity = parseFloat($(this).val()) || 0;

                if (rowDate === today) {
                    const price = parseFloat($(this).data('price')) || 0;
                    totalAmount += quantity * price;
                    totalQuantity += quantity;
                }
            });

            // Determine if the table has changed
            dqty = currentQuantitySum === initialQuantitySumD ? 0 : 1;

            // Update totals in the UI
            // $('#mealamtd').val(totalAmount.toFixed(2));
            // $('#mealqtyd').val(totalQuantity);

            return dqty;
        }


        function fetchallb() {
            console.log("Fetching breakfast items...");
            bval = 1;
            const currentDate = new Date();
            const dayOfWeek = currentDate.getDay();
            const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const dayName = dayNames[dayOfWeek];
            const fromDate = $('#from-date-b').val();
            

            var payload = {
                load: "fetchitemsb",
                day: dayName,
                fromdate:fromDate
            };

            $.ajax({
                url: './webservices/dinner.php',
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify(payload),

                success: function(response) {
                    console.log("........",response)
                    const chargesTableBody = $('#fund-table-b tbody');
                    chargesTableBody.empty(); // Clear existing rows

                    response.data.forEach((x, index) => {
                        const row = $('<tr>');
                        row.html(`
                    
                    <td>${x.Price}</td>
                        <td><input type='number' class='tableqtyb' id='tableqtyb' data-price='${x.Price}' data-index='${index}' min='0' value='0'></td>
                `);
                        foodidb = `${x.OptionID}`;
                        chargesTableBody.append(row);
                    });
                    document.querySelector('.tableqtyb').value = document.getElementById('mealqtyb').value;
                    initialQuantitySumB = calculateTotalSum('.tableqtyb');
                    $('.tableqtyb').on('input', calculateTotalB);
                    // Show the breakfast container after loading the data
                    $('#breakfast-contain-b').show();
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function getallb() {
            console.log("Fetching Dinner items...");
            dval = 3;
            const currentDate = new Date();
            const dayOfWeek = currentDate.getDay();
            const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const dayName = dayNames[dayOfWeek];
            const fromDate = $('#from-date-d').val();

            var payload = {
                load: "getitemsb",
                day: dayName,
                fromdate:fromDate
            };

            $.ajax({
                url: './webservices/dinner.php',
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify(payload),
                success: function(response) {
                    console.log(response, "1155")
                    const chargesTableBody = $('#dinner-table-b tbody');
                    chargesTableBody.empty(); // Clear existing rows
                    response.data.forEach((x, index) => {
                        const row = $('<tr>');
                        row.html(`
                   
                    <td>${x.Price}</td>
                     <td><input type='number' class='tableqtydb' id='tableqtydb' data-price='${x.Price}' data-index='${index}' min='0' value='0'></td>
                `);

                        foodidd = `${x.OptionID}`;
                        chargesTableBody.append(row);
                    });
                    document.querySelector('.tableqtydb').value = document.getElementById('mealqtydb').value;
                    initialQuantitySumD = calculateTotalSum('.tableqtydb');
                    $('.tableqtydb').on('input', calculateTotalD);
                    // Show the breakfast container after loading the data
                    $('#dinner-container-b').show();
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }


        function handleDateChangeD() {
    const fromDateD = $('#from-date-d').val();
    const toDateD = $('#to-date-d').val();
    const payload = { 
        load: 'datechange',
        fromdate: fromDateD,
        todate: toDateD,
        foodtype:3,
        cid: customerid
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
            $('#tableqtydb').val(data.data);
        } else {
            $('#tableqtydb').val(0);
        }
    },
    error: function(error) {
        console.error('Error:', error);
    }
});
    }
}


async function submitForB(event) {
            const quantity = $('#tableqtyb').val();
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
            const quantity = $('#tableqtydb').val();
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


        function update(Date, btn, category, optionid, price, orderid) {

                const row = $(btn).closest('tr');
                const tname = (category === "1") ? "#tableqty" : "#tableqtyd"
                const input = row.find('.tableqty, .tableqtyd');
                const quantity = parseInt(input.val(), 10) || 0;
                const currentValue = parseInt(input.val(), 10) || 0; // Current value
                const initialValue = parseInt(input.data('initial'), 10) || 0; 
                // const category =row.find(`#tableqtyd-${Date.replaceAll('-', '')}`).data('category');  
                // const optionid =row.find(`#tableqtyd-${Date.replaceAll('-', '')}`).data('optionid'); 
                const newQuantity = row.find(`${tname}-${Date.replaceAll('-', '')}`).val(); 
                const reason = row.find(`#reason-${Date.replaceAll('-', '')}`).val();
                if (!reason.trim() & ((newQuantity==0)||(initialValue!=0 & currentValue !== initialValue))) {
                    alert("Please provide a reason for updating the quantity.");
                    return;
                }

                let confirmationMessageAdd = 'Do you want to place order for '+Date+'?';
                let confirmationMessageUpdate = 'Do you want to update order for '+Date+'?';
                let confirmationMessageDelete = 'Do you want to cancel order for '+Date+'?';
                let confirmation = '';
                if(initialValue==0){
                    confirmation = confirm(confirmationMessageAdd);
                }
                else if(currentValue==0){
                    confirmation = confirm(confirmationMessageDelete);
                }
                else{
                    confirmation = confirm(confirmationMessageUpdate);
                }
                console.log("Confirmation",confirmation);

                if (!confirmation) {
                    console.log('User cancelled the operation.');
                    return;
                    }


                var payload = {
                    load: "updateQuantity",
                    date: Date, 
                    quantity: quantity,
                    reason: reason.trim(),
                    cid: customerid,
                    foodtype: category,
                    foodid: optionid,
                    price: price,
                    orderid: orderid

                };

                console.log("update:", payload);

                $.ajax({
                    url: './webservices/dinner.php',
                    type: 'POST',
                    dataType: 'json',
                    data: JSON.stringify(payload),
                    success: function(response) {
                        console.log("updateresponse",response)
                        input.data('initial', quantity);
                        $(btn).prop('disabled', true);
                        fetchall();
                        getall();
                        alert(response.message); 

                    },
                    error: function(error) {
                        console.error('Error updating quantity:', error);
                        alert("An error occurred while updating. Please try again.");
                    }
                });
                }
</script>
</html>
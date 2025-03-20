let editingId = null;
let  bf_food_items = [];
let itemsno;
let weeksno;

$(document).ready(function() {
fetchBackendData(); // Initial fetch when page loads
load_foodType();    // Ensure the category dropdown is populated
});

//add breakfast
function addbf(){
let bf_item_add = document.querySelector('.bf_item_add input').value;
var payload = {
ItemName:bf_item_add,
category:1,
activity:1,
load:"addbf"
}
document.querySelector('.bf_item_add input').value = "";
$.ajax({
type:"POST",
url: "./webservices/fooddetails1.php",
dataType: 'json',
data: JSON.stringify(payload),
success:function(response){
    if(response.status === "success"){
        alert("Item added")
       
        displaybf();
    }
    else if(response.status === "exists"){
        alert("record already exists");
    }
    else{
        alert("item not added")
    }
},
error:function(err){
    console.log(err);
    alert("something wrong");
}
})
}


//display bf
function displaybf(){
bf_food_items.length = 0;
var payload = {
load:"loadbfitems"
}
$.ajax({
type:"POST",
url: "./webservices/fooddetails1.php",
dataType: 'json',
data: JSON.stringify(payload),
success:function(response){
    console.log(response);
    if(response.data.length > 0){
        let bf_add_item_table = document.querySelector('.bf_add_item_table table tbody');
        bf_add_item_table.innerHTML = ""
        response.data.forEach(itm=>{
            let trow = document.createElement('tr');
            let activestatus = (itm.activity === "1") ? `<button class="deactive_bf" onclick="activebf('${itm.OptionID}','${itm.activity}')">Deactivate</button>`
            :`<button class="active_bf" onclick="activebf('${itm.OptionID}','${itm.activity}')">Activate</button>`
            trow.innerHTML = `
            <td>${itm.itemName}</td>
            <td style="width:30%">${activestatus}</td>
            `
            bf_food_items.push({ bfid: `${itm.OptionID}`, itemname: `${itm.itemName}`,activity:`${itm.activity}`});
            bf_add_item_table.appendChild(trow);
        })
        fetchBreakFast_Dinner();
    }
    console.log(bf_food_items);
},
error:function(err){
    console.log(err);
    alert("something wrong");
}
})
}

//activity
function activebf(optionid,activity){
var payload = {
OptionID:optionid,
activity:(activity === "1") ? 0 : 1,
load:"activiyBF"
}
$.ajax({
type: 'POST',
url: "./webservices/fooddetails1.php",
dataType: 'json',
data: JSON.stringify(payload),
success:function(response){
    if(response.status === "success"){
        if(activity === "1"){
            alert("Deactivated Successfully")
        }
        else{
            alert("Activated SUccessfully")
        }
        displaybf();
    }
},
error:function(err){
    alert("Something worng");
    console.log(err);
}
})
}


//fetch breakfast dinner
function fetchBreakFast_Dinner() {
let dp;
var payload = {
load: "loadbreakfast"
};

$.ajax({
type: 'POST',
url: "./webservices/fooddetails1.php",
dataType: 'json',
data: JSON.stringify(payload),
success: function (response) {
    console.log("fd",response);
    let bfd_body = document.querySelector('.bfd_body');
    
    bfd_body.innerHTML = "";

    response.data.forEach(itm => {

        dp = document.createElement('select');
        dp.setAttribute('onchange',`setBreakFast(${itm.sno})`);
        dp.setAttribute('id',`item_id_${itm.sno}`)
        dp.innerHTML = ""; 
        dp.innerHTML = `<option value="">select the item</option>`; 

     
        bf_food_items.forEach(bfitm => {
           
                let option = document.createElement('option');
         
                option.value = bfitm.bfid;
                option.textContent = bfitm.itemname;
            
                let disabledStatus = (bfitm.activity === "0") ? true : false;
                option.disabled = disabledStatus;
            
                if (itm.OptionID === bfitm.bfid) {
                    option.selected = true;
                }

                dp.appendChild(option);
            
        });

      
        let trow = document.createElement('tr');
        trow.setAttribute('class', 'bf_itm_row');
        trow.innerHTML = `
            <td>${itm.day}</td>
            <td></td>
            <td><input type="date" value=${itm.fromdate} class= "fromdate_${itm.sno}"></td>
            <td><button class="bf_eidtbtn" onclick="breakfastfooditems()">Edit</button></td>
        `;
        trow.cells[1].appendChild(dp);

        
        bfd_body.appendChild(trow);
    });
},
error: function (err) {
    console.log(err);
}
});
}


//setting weeksno and bfitemsno values
function setBreakFast(wsno){
itemsno = document.querySelector(`#item_id_${wsno}`).value
weeksno = wsno
}

//insert and update breakfast dinner items
function breakfastfooditems(){

let update_item = confirm("Do you really want to update")
if(!update_item){
fetchBreakFast_Dinner();
return
}

if(!itemsno){
alert("Item not changed");
return;
}


var payload = {
load:"setbreakfast",
OptionID:itemsno,
weeksno:weeksno,
from_date:document.querySelector(`.fromdate_${weeksno}`).value
}


$.ajax({
type: 'POST',
url: "./webservices/fooddetails1.php",
dataType: 'json',
data: JSON.stringify(payload),
success:function(response){
   if(response.status == "success"){
    alert("update successfully")
   }
},
error:function(err){
    console.log(err);
    alert("something wrong")
}
})

}


//function for addlunch item
function add_lunch_item(){
var payload= {
load: 'addlunch',
ItemName:document.querySelector('.input_lun input').value,
}
document.querySelector('.input_lun input').value = "";
$.ajax({
type:"POST",
url: "./webservices/fooddetails1.php",
dataType: 'json',
data: JSON.stringify(payload),
success:function(response){
    console.log("lun",response);
    if(response.status === "success"){
        alert("Food item added");
        load_lunchItem();
    }
    if(response.status === "duplicate"){
        alert("record already exist");
    }
}
,error:function(err){
    console.log(err);
}
})
}




//function for load lunch item
function load_lunchItem(){
var payload = {
load:"loadlunchitems"
}
$.ajax({
type:"POST",
url: "./webservices/fooddetails1.php",
dataType: 'json',
data: JSON.stringify(payload),
success:function(response){
    console.log(response.data);
    console.log(response.data.length,"hello")
    if(response.data.length > 0){
        let lun_table = document.querySelector('.lun_table tbody');
        lun_table.innerHTML = "";
        response.data.forEach(itm=>{
            let activity = (itm.activity === "1") ? `<button class="deactive_ln" onclick="activateDeactivate('${itm.OptionID}','${itm.activity}')">Deactivate</button>` 
            : `<button class="active_ln" onclick="activateDeactivate('${itm.OptionID}','${itm.activity}')">Activate</button>`
            let trow = document.createElement('tr');
            trow.innerHTML = `
                <td class="lunch_name"><input value="${itm.ItemName}" disabled/></td>
                <td>${activity}</td>
            `
            lun_table.appendChild(trow);
        })
    }
},
error:function(err){
    console.log(err);
}
})
}

//function for activate deactive
function activateDeactivate(OptionID,activity){
var  payload = {
load:"activate_deactive_lunch",
OptionID:OptionID,
activity:(activity === "1") ? 0 : 1
}
console.log("activepayload",payload);
$.ajax({
type:"POST",
url: "./webservices/fooddetails1.php",
dataType: 'json',
data: JSON.stringify(payload),
success:function(response){
    if(response.status === "success"){
        alert("Record Updated");
        load_lunchItem();
    }
    else{
        alert("Record Not Updated")
    }
},
error:function(error){
    alert("something wrong");
    console.log(error)
}

})
}

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
                            <button class="view_history" style="width: 50px; display: flex; align-items: center; justify-content: center; padding: 0; border: none; background-color: #f0f0f0; border-radius: 4px;">
                                <i class="fa-solid fa-eye fa-beat-fade" onclick="loadhistory(this,'${record.OptionID}')" style="font-size: 18px;"></i>
                            </button>
                        </td>
                    `);
                    typesTableBody.append(row);
                });

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
                            <button class="view_history" style="width: 50px; display: flex; align-items: center; justify-content: center; padding: 0; border: none; background-color: #f0f0f0; border-radius: 4px;">
                                <i class="fa-solid fa-eye fa-beat-fade" onclick="loadhistory(this,'${record.OptionID}')" style="font-size: 18px;"></i>
                            </button>
                        </td>
                    `);
                    typesTableBody.append(row);
                });

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
            } else {
                $('#tablehead').hide();
                typesTableBody.empty();
                document.querySelector('.no_price').style.display = "block";
            }
        },
        error: function(err) {
            console.log("Error:", err);
        }
    });
}

function hidetab(){
    const typesTableBody = $('#typesTableBody1');
    $('#tablehead').hide();
    typesTableBody.empty();
}




    



function priceChange(sno){

    let intialprice = document.querySelector(`.price_${sno}`).dataset.prev;
    let finalprice = document.querySelector(`.price_${sno}`).value;

    let disabledstatus = (parseInt(intialprice) === parseInt(finalprice)) ? true : false;
 
    document.querySelector(`.edit_buttonfd_${sno}`).disabled = disabledstatus;
}


function foodPriceEdit(sno,optionid){
   
   if(document.querySelector(`.price_${sno}`).value === ""){
        alert("Price required");
        return;
   }

   let check = confirm(`Do you really want to update price?`);
   if(!check){
        document.querySelector(`.edit_buttonfd_${sno}`).disabled = true;
        document.querySelector(`.price_${sno}`).value = document.querySelector(`.price_${sno}`).dataset.prev;
        return;
    }

   var payload = {
        logsno:sno,
        OptionID:optionid,
        Price: document.querySelector(`.price_${sno}`).value,
        load:"updatePrice"
   }
   $.ajax({
    type:"POST",
    url: "./webservices/fooddetails1.php",
    dataType: 'json',
    data: JSON.stringify(payload),
    success:function(response){
        if(response.status === "success"){
            alert("Update price successfully");
            
        }
        else{
            alert('Price not Updated');
           
        }
        loadFoodPrices(true);
    },
    error:function(err){
        console.log(err);
        alert("Something wrong")
    }
   })
}

// prices screen itemname dropdown

function loadFdItemByCategory(){
console.log("itemanme");
var payload = {
    OptionID : "",
    ItemName : "",
sbcategory: document.querySelector('.sub_items_dp').value,
load:"loadfdby_category"

}
console.log("itemname1",payload);
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

//  dropdown for foodtype
function loadfoodtype() {
    console.log("Loading food types...");

    var payload = {
        load: "loadfoodtype",
        sno: "",
        type: "type"
    };

    $.ajax({
        type: "POST",
        url: "./webservices/fooddetails1.php",
        data: JSON.stringify(payload),
        dataType: "json",
        contentType: "application/json", // Ensures server reads JSON properly
        beforeSend: function() {
            console.log("Fetching food types...");
        },
        success: function(response) {
            console.log("Response received:", response);

            let dropdown = document.getElementById("item_category");
            dropdown.innerHTML = ""; // Clear existing options

            let defaultOption = document.createElement('option');
            defaultOption.value = "";
            defaultOption.text = "Select Type";
            defaultOption.disabled = true;
            defaultOption.selected = true;
            dropdown.appendChild(defaultOption);

            if (response.status === "success" && response.data.length > 0) {
                response.data.forEach(x => {
                    let option = document.createElement('option');
                    option.value = x.sno;
                    option.text = x.type;
                    dropdown.appendChild(option);
                });
            } else {
                console.warn("No food types found.");
                let noDataOption = document.createElement('option');
                noDataOption.value = "";
                noDataOption.text = "No types available";
                noDataOption.disabled = true;
                dropdown.appendChild(noDataOption);
            }
        },
        error: function(err) {
            console.error("Error loading food types:", err);
            alert("Failed to load food types. Please try again later.");
        }
    });
}


    loadfoodtype();




function navbtns(this_button){
if(this_button.classList.contains('bf_din')){
document.querySelector('.category-container').style.display = "none";
document.querySelector('.add_bf').style.display = "flex";
document.querySelector('.add_lun').style.display = "none";
displaybf();

}
else if(this_button.classList.contains('pr_btn')){
document.querySelector('.category-container').style.display = "block";
document.querySelector('.add_bf').style.display = "none";
document.querySelector('.add_lun').style.display = "none";

}
else{
document.querySelector('.category-container').style.display = "none";
document.querySelector('.add_bf').style.display = "none";
document.querySelector('.add_lun').style.display = "flex";
load_lunchItem();

}
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

// price screen foodtype dropdown
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
        defaultOption.textContent = 'Select FoodType';
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
let confirmmsg = confirm(`Do you really want to change the price \nItemName:${ItemName}\nfromdate:${from_date}`);
if(!confirmmsg){
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
    if(response.message === "Record Exist"){
        alert("already record exist in same date");
        return;
    }
    if(response.status == "success"){
        alert("Update Successfully")
        loadFoodPrices(true);
    }   
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
    // $('#OptionID').val(''); // Clear input fields
    $('#category').val('');
    $('#food_items-dp').val('');
    $('#Price').val('');
    $('#from_date').val('');
    $('#to_date').val('');
    $('#typesTableBody').empty();

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

  // Function to enable edit mode
function enableEditMode(itemName) {
    const inputField = document.getElementById('subcategory_name');
    const saveBtn = document.getElementById('add');
    const updateBtn = document.getElementById('update');
    const cancelBtn = document.querySelector('.cnclbtn');
    const addLunSection = document.querySelector('.addlun');

    inputField.value = itemName;
    saveBtn.style.display = 'none';
    updateBtn.style.display = 'inline-block';
    cancelBtn.style.display = 'inline-block';
    addLunSection.classList.add('edit-mode');
}

// Cancel operation and reset form
function cancelOperation() {
    const inputField = document.getElementById('subcategory_name');
    const saveBtn = document.getElementById('add');
    const updateBtn = document.getElementById('update');
    const cancelBtn = document.querySelector('.cnclbtn');
    const addLunSection = document.querySelector('.addlun');

    inputField.value = '';
    saveBtn.style.display = 'inline-block';
    updateBtn.style.display = 'none';
    cancelBtn.style.display = 'none';
    addLunSection.classList.remove('edit-mode');
}


function validateRegisterPhoneNumber(input) {
    input.value = input.value.replace(/[^0-9]/g, ''); // Allow only numbers
    if (!/^[6-9]/.test(input.value)) {
        input.value = ""; // Clear if the first digit is not 6-9
    }
    if (input.value.length > 10) {
        input.value = input.value.substring(0, 10); // Limit to 10 digits
    }
}

function validateDoorNumber(input) {
    input.value = input.value.replace(/[^0-9-]/g, ''); // Allow numbers and hyphen only
    const doornoError = document.getElementById('doornoError');
    if (input.value !== "" && !/^\d+-\d+$/.test(input.value)) {
        doornoError.textContent = 'Format should be number-number (e.g., 6-145)';
    } else {
        doornoError.textContent = '';
    }
}


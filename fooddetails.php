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
        .foodtype_box p{
            margin:0px;
            position: absolute;
            top: 40px; /* Adjust based on your layout */
            left: 10px;
            font-weight: 700;
            display:flex;
            flex-wrap: wrap;
          
        }
        .foodtype_box p span{
            padding:10px;
            font-size: 12px;
            width:auto;
            border-radius: 5px;
            background-color: rgba(174, 174, 174, 0.79);
        }
        
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin: 70px 70px 40px 150px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group-add {
           
            display: flex;
            flex-direction: row;
            align-items: center;
            min-width: 220px;
            margin-bottom: 1rem;
           
        }

 

        .form-group-add label {
            flex: 0 0 85px;
            font-weight: bold;
            color: #333;
            font-size: 16px;
            margin-right: 10px;
        }

        label {
            display: block;
           
            font-weight: bold;
        }

        #deliveryForm input[type="text"],
        #deliveryForm input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .submit-btn, .cancel-btn {
    width: 48%; /* Makes both buttons fit in one row */
    padding: 12px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: inline-block;
    text-align: center;
}

.submit-btn {
    background-color: #F3681E;
    color: white;
}

.submit-btn:hover {
    background-color: #D95D17;
}

.cancel-btn {
    background-color: #DC3545; /* Red color for cancel */
    color: white;
}

.cancel-btn:hover {
    background-color: #B02A37;
}

.selectedItemsParagraph {
 
    width: 98%;
    height: 5.5vh;
    white-space: nowrap;      
    display: flex;
    flex-direction: column;
    overflow:auto ;
    align-items: center;
    
}

.selectedItemsParagraph span {
    margin-right: 10px;
}
.selectedItemsParagraph::-webkit-scrollbar{
    display: none;
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
                    <li onclick="toggleSection('items-menu', this)">FoodType</li>
                    <li onclick="toggleSection('items-menu-content', this)">Category Menu</li>
                    <li onclick="toggleSection('sub-items-menu-content', this)">Items Menu</li>
                    <li onclick="toggleSection('scheduling-content', this);checkingtrigger()">Scheduling</li>
                    <li onclick="toggleSection('delivery-add', this)">Delivery Boy Add</li>
                    <li onclick="toggleSection('delivery-scheduling', this)">Delivery Scheduling</li>
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
                                        <select id="category" class="category" onchange="loadsubcategory();loadFoodPrices(true);hidetab()">
                                            <option value="">Select Type</option>
                                            <!-- <option value="daily">Daily</option>
                                            <option value="monthly">Monthly</option> -->
                                        </select>

                                        <label for="sub_item">Category:</label>
                                        <select id="sub_items-dp" class="sub_items_dp" onchange="loadFdItemByCategory();loadFoodPricessub();"></select>

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
                                                <th>From Date</th>
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


                <!-- foodtypes -->
                <div id="items-menu" class="content-section">
                    <!-- <h2>Items Menu Section</h2> -->

                    <div class="addlun">
                        <h3>Add Item</h3>
                        <div class="input_lun">
                            <input type="text" maxlength="25" oninput="validateName(this)" id="category_name" placeholder="Enter category Name">
                            <button type="submit" id="addBtn" name="add" style="background-color: #28a745; color: white; border: none; padding: 10px 20px; cursor: pointer;">Save</button>

                            <button type="submit" id="updateBtn" name="update" style="display: none;  background-color: #ffc107;">Update </button>

                            <button class="cancelBtn" style=" background-color: #dc3545; color: white; border: none; cursor: pointer;">Cancel</button>
                        </div>
                        <div class="existing-categories">
                                    <table class="category-table">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Edit</th>
                                        <th>Activity</th>

                                    </tr>
                                </thead>
                                <tbody class="category-list">
                                    <!-- Dynamic items will be loaded here -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


                <!-- Items Menu Section -->
                <div id="items-menu-content" class="content-section">
                    <!-- <h2>Items Menu Section</h2> -->
                    <div class="category-containerc">
                        <label for="item_category"><strong>Food Type:</strong></label>
                        <select id="item_category" class="category" onchange="loadItemsByCategory();">
                        </select>
                    </div>

                    <div class="addlun">
                        <h3>Add Item</h3>
                        <div class="input_lun">
                            <input type="text" maxlength="25" oninput="validateName(this)" id="subcategory_name" placeholder="Enter Subcategory Name">
                            <button type="submit" id="add" name="add">Save</button>
                            <button type="submit" id="update" name="add" style="display:none;">Update</button>
                            <button class="cnclbtn" style="display:none;background-color:red">Cancel</button>
                        </div>
                        <div class="data_lunch1">
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
                </div>

                <!-- Sub Items Menu Section -->
                <div id="sub-items-menu-content" class="content-section">
                    <div class="category-row">
                        <!-- <div class="form_group"> -->
                            <label for="sub_item_category"><strong>Food Type:</strong></label>
                            <select id="sub_item_category">


                            </select>
                        <!-- </div> -->

                        <!-- <div class="form_group"> -->
                            <label for="sub_items"><strong>Category:</strong></label>
                            <select id="sub_items" onchange=" loadItemsByCategory1()">

                            </select>
                        <!-- </div> -->
                    </div>

                    <div class="add_lun1">
                        <h3>Add Sub Item</h3>
                        <div class="input_lun">
                            <input type="text" oninput="validateName(this)" id="item_name" placeholder="Enter Sub Item" maxlength="40">
                            <input type="number" id="item_number" placeholder="Enter price" maxlength="10">
                            <button type="submit" id="addi">Save</button>
                            <button type="submit" id="updatei" name="add" style="display:none;">Update</button>
                            <button class="cnclbtni" style="display:none;background-color:red">Cancel</button>
                        </div>
                        <div class="data_lunch">
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
                </div>
                <!--scheduling-content section-->
                <div id="scheduling-content">
                    <div class="scheduling_content_container">
                        <div class="scheduling_dates">
                          
                        </div>
                        <div class="schedule_menu_list">

                        </div>
                        <!-- <div class="schedulingboxes">
                            <h3>Break Fast</h3>
                            <div class="tdybox">
                                <p><b>Today</b></p>
                                <input type="date" id="schtdydate" readonly>
                                <input type="text" id="schtdbfitem" readonly>
                            </div>
                            <div class="tmrbox">
                                <p><b>Tomorrow</b></p>
                                <input type="date" id="schtmdydate" readonly>
                                <select class="subcategory" onchange="loadcatitems()">

                                </select>
                                <select class="tmbfitems">

                                </select>
                                <button onclick="upddatetmitem(this,1)" class="btnbftmr">Save</button>
                            </div>

                        </div> -->
<!-- 
                        <div class="schedulingboxes">
                            <h3>Lunch</h3>
                            <div class="tdybox">
                                <p><b>Today</b></p>
                                <input type="date" id="schtdydate" readonly>
                                <input type="text" id="schtdlunitem" readonly>
                            </div>
                            <div class="tmrbox">
                                <p><b>Tomorrow</b></p>
                                <input type="date" id="schtmdydate" readonly>
                                <select class="lunchsubcategory" onchange="loadLunchCategoryItems()">

                                </select>
                                <select class="tmlunitems">

                                </select>
                                <button onclick="upddatetmitem(this,2)" class="btnluntmr">Save</button>
                            </div>
                        </div> -->

                        <!-- <div class="schedulingboxes">
                            <h3>Dinner</h3>
                            <div class="tdybox">
                                <p><b>Today</b></p>
                                <input type="date" id="schtdydate" readonly>
                                <input type="text" id="schtddinitem" readonly>
                            </div>
                            <div class="tmrbox">
                                <p><b>Tomorrow</b></p>
                                <input type="date" id="schtmdydate" readonly>
                                <select class="dinnersubcategory" onchange="loadDinnerCategoryItems()">

                                </select>
                                <select class="tmdinitems">

                                </select>
                                <button onclick="upddatetmitem(this,3)" class="btndintmr">Save</button>
                            </div>
                        </div> -->
                        </div>
                    </div>
                <div id="delivery-add" class="container">
    <h2>Delivery Information Form</h2>
    <form id="deliveryForm">
        <div class="form-group-add">
            <label for="name">Name:</label>
            <input type="text" oninput="validateNameInput(this)" id="name" maxlength="30" name="name" placeholder="Enter your name" required>
        </div>
        <div class="form-group-add">
            <label for="contact">Contact:</label>
            <input type="text" oninput="validatePhoneNumberInput(this)" id="contact" name="contact" placeholder="Enter your contact number" />
        </div>
        <div class="form-group-add">
            <label for="Doorno">Door No.:</label>
            <input type="text" oninput="validFlatNo(this)"  maxlength="30" id="Doorno" name="Doorno" placeholder="Enter your Doorno" />
            <span id="doornoError" style="color: red; font-size: 12px;"></span>
        </div>
        <div class="form-group-add">
            <label for="Street">Street:</label>
            <input type="text" oninput="validFlatNo(this)"  maxlength="30" id="Street" name="Street" placeholder="Enter your Street" required>
        </div>
        <div class="form-group-add">
            <label for="Area">Area:</label>
            <input type="text" oninput="validFlatNo(this)"  maxlength="30" id="Area" name="Area" placeholder="Enter your Area" required>
        </div>

        <div class="form-buttons">
        <button type="button" class="submit-btn" onclick="adddeliveryinfo(event)">Submit</button>
<button type="button" class="cancel-btn" onclick="clearForm()">Cancel</button>
        </div>
    </form>
</div>

                    <div id="delivery-scheduling">
                    <h2>Delivery Scheduling </h2>
                    <div class="schedulingboxes">
                        <div class="tdybox">
                            <h4 id="today">Today</h4><br>
                            <input type="date" id="schtdydate" readonly>
                            <select class="foodtype-tdy" id="foodtype-tdy" onchange="loadnameds()"></select>
                            <select class="name-tdy" id="name-tdy" onchange="loadcontactds()">
                                <option value="" disabled selected>Select Name</option>
                            </select>
                            <select class="contact-tdy" id="contact-tdy" placeholder="Contact Number" readonly>
                                <option value="" disabled selected>
                                    Select Contact
                                </option>
                            </select>
                            <button onclick="savetdy(event)" class="btntoday">Save</button>
                        </div>
                        <br>
                        <div class="tmrbox">
                            <h4>Tomorrow</h4><br>
                            <input type="date" id="schtmdydate" readonly>
                            <select class="foodtype-tmr" id="foodtype-tmr" onchange="loadnamesds()"></select>
                            <select class="name-tmr" id="name-tmr" onchange="loadcontactsds()">
                                <option value="" disabled selected>
                                    Select Name
                                </option>
                            </select>
                            <select class="contact-tmr" id="contact-tmr" readonly>
                                <option value="" disabled selected>
                                    Select Contact
                                </option>
                            </select>
                            <button onclick="savetmr(event)" class="btntommorrow">Save</button>
                        </div>
                    </div>
                    <div class="schedulinglist">
                        <div class="schedulinglisttdy">
                            <table id="tdyschedulinglist">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Food Type</th>
                                        <th>Name</th>
                                        <th>Contact</th>

                                    </tr>
                                </thead>
                                <tbody class="tdyscheduling">

                                </tbody>
                            </table>
                </div>
                        <div class="schedulinglisttmr">
                            <table id="tmrschedulinglist">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Food Type</th>
                                        <th>Name</th>
                                        <th>Contact</th>

                                    </tr>
                                </thead>
                                <tbody class="tmrscheduling">

                                </tbody>
                            </table>
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
        let breakfasttmritem;
        let dinnertmritem;
        let lunchtmritem;
        let selected_lunch_items = [];
        let selected_lunch_id = [];
        // let selectedlunch = [];

        var editId = null;
        $(document).ready(function() {
            todayfetchall();

        });

        var editId1 = null;
        $(document).ready(function() {
            tmrfetchall();
        });


        tomorrowdate.setDate(todaydate.getDate() + 1);

        schtdydate.forEach(d => {
            d.value = dateformat(todaydate);
            d.setAttribute('max', d.value)
            d.setAttribute('min', d.value)
        })

        schtmdydate.forEach(d => {
            d.value = dateformat(tomorrowdate);
            d.setAttribute('max', d.value)
            d.setAttribute('min', d.value)
        })

        function dateformat(date) {
            let day = String(date.getDate()).padStart(2, "0");
            let month = String(date.getMonth() + 1).padStart(2, "0");
            let year = date.getFullYear();

            return `${year}-${month}-${day}`;
        }

        //trim function
        function trimOperation(string1,string2){
            let string = string1+'_'+string2;
            return string.trim();
        }

        function loadSchedulingDates(){
            let today = new Date();
           

            let scheduling_dates = document.querySelector('.scheduling_dates');
            scheduling_dates.innerHTML = "";
            for (let i = 0; i < 7; i++) {
                let para = document.createElement('p');
                para.setAttribute('class','individual_sch_dates');
                para.setAttribute('onclick',`loadscheduleMenuByDate(this)`);
                let futureDate = new Date();
                futureDate.setDate(today.getDate() + i);
                let formattedDate = futureDate.toISOString().split('T')[0];
                para.setAttribute('data-schdate',`${formattedDate}`)
                para.textContent = formattedDate;
                // para.style.backgroundColor = colors[i]; 
                scheduling_dates.appendChild(para);
            }
            loadfoodType();
        }

        async function loadscheduleMenuByDate(thisdiv) {

            document.querySelectorAll('.subcategory').forEach(sb=>{
                sb.disabled = false;
            })

            selected_lunch_items = [];
            let displayParagraph = document.querySelector('.selectedItemsParagraph');
            displayParagraph.innerHTML = "";
            console.log("lunchitems",selected_lunch_items)
            

            console.log("before button",selected_lunch_items)
            document.querySelectorAll('.individual_sch_dates').forEach(x => {
                x.classList.remove('active_date');
            });

            thisdiv.classList.add('active_date');

            let allselects = document.querySelectorAll('.inside_foodtype_box select');
            allselects.forEach(sel => {
                sel.value = " ";
            });

            let today = new Date();
            let todayFormatted = today.toISOString().split('T')[0];
            let checktddate = (todayFormatted === thisdiv.textContent);
            console.log("checkdate",checktddate)
            document.querySelectorAll('.schsavebtn').forEach(dis => {
                dis.disabled = checktddate;
            });

            var payload = {
                load: "loadMenubyDate",
                menuDate: thisdiv.textContent
            };

            $.ajax({
                type: "POST",
                url: "./webservices/register.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: async function (response) {
                    selected_lunch_items = [];
                    console.log("udresponse",selected_lunch_items)
                    console.log("helo",response);
                    if (response.data.length > 0) {
                        for (const itm of response.data) {

                            if(itm.type === "lunch"){
                                let subcategory = itm.subcategory.trim(); 
                                subcategory = subcategory.replace(/\s+/g, ""); 
                                selected_lunch_items.push({ 
                                    category: subcategory, 
                                    cid: parseInt(itm.subsno), 
                                    item: itm.ItemName, 
                                    foodid: parseInt(itm.OptionID)
                                })
                                console.log(selected_lunch_items);
                                let grandparent = document.querySelector(`#${itm.type}_box`);
                                updateDisplay(grandparent,itm.subcategory,itm.ItemName,itm.OptionID);
                            }


                            let subcategorySelector = trimOperation(itm.type, 'subcategory');
                            let subcategory = document.querySelector(`#${subcategorySelector}`);
                            if(itm.type !== "lunch"){
                                subcategory.value = itm.subsno;
                            }
                           

                            // WAIT until items are loaded before setting the value
                            await loaditembysubcategory({ value: itm.subsno });

                            let itemselector = trimOperation(itm.type, 'items');
                            let items = document.querySelector(`#${itemselector}`);
                            if(itm.type !== "lunch"){
                                items.value = itm.OptionID;
                            }
                          
                        }
                    } else {
                        alert("Menu not decided");
                    }
                }
            });
        }




        //function for load foodtype
        function loadfoodType(){
            var payload = {
                load: "loadfoodtype1"
            };
            
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response){
                    console.log("foodtype",response);
                    if(response.data.length > 0){
                        let schedule_menu_list = document.querySelector('.schedule_menu_list');
                        schedule_menu_list.disabled = true;
                        schedule_menu_list.innerHTML = "";
                        
                        if (!schedule_menu_list) {
                            console.error("Error: .schedule_menu_list not found in DOM");
                            return;
                        }
                        
                        response.data.forEach(itm => {
                            

                            let div = document.createElement('div');
                            div.setAttribute('id', `${trimOperation(itm.type,'box')}`);
                            div.setAttribute('data-foodtypeid', `${itm.sno}`);
                            div.classList.add('foodtype_box');
                            
                            let header3 = document.createElement('h3');
                            header3.textContent = itm.type;

                            let insidediv = document.createElement('div');
                            insidediv.classList.add('inside_foodtype_box');
                           
                            //subcategory select tag
                            let selecttag = document.createElement('select');
                            selecttag.setAttribute('id',`${trimOperation(itm.type,'subcategory')}`)
                            selecttag.setAttribute('class','subcategory')
                            selecttag.disabled = true;

                            selecttag.addEventListener('change', function () {
                                loaditembysubcategory(this);
                            });

                            let lunch_para;
                            // if (itm.type.toLowerCase() === "lunch") {
                            //     selecttag.addEventListener('change', function () {
                            //         display_lunch_items(this);
                            //     });
                               
                            // }
                                                    
                            // if(itm.type.toLowerCase() === "lunch"){
                            //     selecttag.setAttribute('onchange','display_lunch_items(this)')
                            // }
                            let option = document.createElement('option');
                            option.textContent = "Select sub category"
                            option.value = " ";

                            selecttag.appendChild(option);


                            //items select tag
                           
                            let itemsselecttag = document.createElement('select');
                            itemsselecttag.disabled = true;
                            itemsselecttag.setAttribute('id',`${trimOperation(itm.type,'items')}`)
                            itemsselecttag.setAttribute('class','fditems')
                            if(itm.type.toLowerCase() === "lunch"){
                               itemsselecttag.setAttribute('onchange','display_lunch_items(this)')
                            }
                            let itmoption = document.createElement('option');
                            itmoption.textContent = "Select item"
                            itmoption.value = " ";
                            itemsselecttag.appendChild(itmoption)

                            //save button
                            let savebuttons = document.createElement('button');
                            savebuttons.textContent = "save";
                            savebuttons.classList.add('schsavebtn')
                            savebuttons.setAttribute('onclick',`updateSchedule(this,"${itm.type}")`)

                            insidediv.appendChild(selecttag)
                            insidediv.appendChild(itemsselecttag)
                            insidediv.appendChild(savebuttons)


                            div.appendChild(header3); 
                            if(itm.type.toLowerCase() === "lunch"){
                              let createpara = document.createElement('p');
                              createpara.setAttribute('class','selectedItemsParagraph')
                              div.appendChild(createpara)
                            }
                            div.appendChild(insidediv); 
                            // div.appendChild(itemsselecttag); 
                            // div.appendChild(savebuttons);

                            

                            schedule_menu_list.appendChild(div);  
                        });
                        loadAllSubcategory();
                    }
                },
                error: function(err){
                    console.log("Error in loading food type:", err);
                    alert("Something went wrong while fetching food type");
                }
            });
        }

//for luch box items display function
function display_lunch_items(thisselect) {
    let parentdiv = thisselect.parentElement;
    let grandparentdiv = parentdiv.parentElement;
    let valueofselectedsubcategory;
    let textofselectedsubcategory;
    let textofselectedfditems;
    let valueofselectedfditems;



        let subcategoryselect = grandparentdiv.querySelector(".subcategory"); 
        textofselectedsubcategory = subcategoryselect.options[subcategoryselect.selectedIndex].text.trim();
        valueofselectedsubcategory = parseInt(subcategoryselect.value);


        let fditemsselect = grandparentdiv.querySelector(".fditems");
        textofselectedfditems = fditemsselect.options[fditemsselect.selectedIndex].text.trim();
        valueofselectedfditems = parseInt(fditemsselect.value);


    console.log("textofselectedsubcategory",textofselectedsubcategory);
    console.log("valueofselectedsubcategory",valueofselectedsubcategory);
    console.log("textofselectedfditems",textofselectedfditems);
    console.log("valueofselectedfditems",valueofselectedfditems)
 

    let existingcategory = selected_lunch_items.find(item => item.cid === valueofselectedsubcategory) ?? -1;
    if(existingcategory === -1){
        selected_lunch_items.push({ 
        category: textofselectedsubcategory, 
        cid: valueofselectedsubcategory, 
        item: textofselectedfditems, 
        foodid: valueofselectedfditems
        })
    }
    else{
       existingcategory.foodid = valueofselectedfditems;
       existingcategory.cid = valueofselectedsubcategory
       existingcategory.category= textofselectedsubcategory
       existingcategory.item = textofselectedfditems
    }
    console.log("elements",selected_lunch_items)
   
    updateDisplay(grandparentdiv, textofselectedsubcategory, textofselectedfditems, valueofselectedfditems);
   
 
}

function updateDisplay(gpd, category, item, selecteditemid) {
    console.log("update display",selected_lunch_items)
    let displayParagraph = gpd.querySelector('.selectedItemsParagraph');
    displayParagraph.innerHTML = "";
    selected_lunch_items.forEach(itm =>{
        let categoryspan = document.createElement('span');
        let icon = document.createElement('i'); 
        categoryspan.textContent = `${itm.category}:${itm.item}`;
        categoryspan.style.position = "relative"; 
        categoryspan.style.marginRight = "10px";
        categoryspan.dataset.cid =  itm.cid
        icon.style.marginLeft = "8px"; 
        icon.classList.add('fa-solid', 'fa-xmark','itemclose'); 
        icon.style.cursor = "pointer"
        categoryspan.appendChild(icon);
        displayParagraph.appendChild(categoryspan)

        icon.addEventListener('click', (e) => {
            let clickedCid = e.target.parentElement.dataset.cid;

            // Remove the item from the array
            selected_lunch_items = selected_lunch_items.filter(item => item.cid !== clickedCid);

            // Refresh the UI
            e.target.parentElement.remove();  
            console.log("Updated List:", selected_lunch_items);
        });
    })  

    console.log("displapyparagraph",displayParagraph);
}




        //update schedule
        function updateSchedule(selectbutton,foodtype){
            let grandparentDiv = selectbutton.closest('div')?.parentElement.closest('div');
            let divid = grandparentDiv.id;

            let foodtypeid = document.getElementById(divid).dataset.foodtypeid;
            let selecteddate = document.querySelector('.active_date')
          

            let closestFditems = selectbutton.closest('div')?.querySelector('.fditems');
            let itemname = closestFditems.options[closestFditems.selectedIndex].text;

            let closestsubcategory = selectbutton.closest('div')?.querySelector('.subcategory');

            let scheduletablename = (foodtype === "breakfast")
                                        ? `${foodtype}schedule` :(foodtype === "lunch") ? 
                                        `${foodtype}schedule`:`${foodtype}schedule`
            
            let load = "setitem"

             
            if(!selecteddate){
                alert("Date required")
                return;
            }

            if(foodtype === "lunch"){
                load = 'setlunchitem'
                selected_lunch_id = [];
                selected_lunch_items.forEach(itm=>{
                    if(itm.foodid === " "){
                        alert("select the item");
                        return;
                    }
                    console.log("fooid",itm.foodid)
                   selected_lunch_id.push(parseInt(itm.foodid))
                })

                if(selected_lunch_id.length === 0){
                    alert("Please select the lunch items")
                    return;
                }

                
            }
            else{
                if(!closestFditems.value || closestFditems.value === " "){
                    alert("Item required")
                    return
                }

                if(!closestsubcategory.value || closestsubcategory.value === " "){
                    alert("sub category required")
                    return;
                }
            }


            let userResponse = (foodtype === "lunch")? confirm(`Items you want to add\n${selected_lunch_items.map(itm => `-${itm.item}`).join("\n")}`):
                                                     confirm(`Do you want to set the ${foodtype}: ${itemname}\nON: ${selecteddate.textContent}`);

            if(!userResponse){
                closestsubcategory.value = " ";
                closestFditems.value = " ";
                closestFditems.disabled = true;
                return;
            }

            var payload = {
                selecteddate:selecteddate.textContent,
                load:load,
                OptionID:closestFditems.value,
                ssubcategory: closestsubcategory.value,
                // updateactivity:updateactivity,
                foodtype:foodtype,
                foodtypeID:foodtypeid,
                scheduletablename:scheduletablename,
                lunchids:selected_lunch_id
            }
            console.log("payload",payload,typeof(payload.foodtype));

            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){
                    console.log(response);
                    if(response.status === "success"){
                        alert("Sucessfully Updated");
                    }
                },
                error:function(err){
                    console.error("updateing error",err);
                    alert("Something wrong try again later")
                }

            })

        }
        

        //function for load subcategory
        function loaditembysubcategory(thischange) {
            // let grandparenetelement = thischange.parentElement.parentElement;
            // let grandparentid = grandparenetelement.getAttribute('id');
          

            if(thischange.value === " "){
                alert("Please select the subcategory");
                return;
            }
            return new Promise((resolve, reject) => {
                var payload = {
                    ssubcategory: thischange.value,
                    load: "loaditemsbysubcategory"
                };

                console.log('loaditemsbysubcategory', payload);

                $.ajax({
                    type: "POST",
                    url: "./webservices/fooddetails1.php",
                    data: JSON.stringify(payload),
                    dataType: "json",
                    success: function (response) {
                        // if(grandparentid.toLowerCase() === )
                        document.querySelector(`#${trimOperation(response.data[0].type,'items')}`).disabled = false;
                        console.log("loaditem",response);
                        
                        if (response.data.length > 0) {
                            let selectitemid = trimOperation(response.data[0].type, "items");
                            let items = document.querySelector(`#${selectitemid}`);

                            console.log("items",items)
                           
                            items.value = " ";
                            Array.from(items.options).forEach(option => {
                                option.style.display = "none";
                            });

                        
                            response.data.forEach(itm => {
                                        let option = items.querySelector(`option[value="${itm.OptionID}"]`);
                                
                                        let nulloption = items.querySelector(`option[value=" "]`);
                                        nulloption.style.display = "block";
                                        if (option) {
                                            option.style.display = "block";
                                        }
                
                            });
                        }
                        resolve(); // Resolve after AJAX completes
                    },
                    error: function (err) {
                        console.log("Error fetching items through subcategory", err);
                        alert("Something went wrong");
                        reject(err); // Reject if AJAX fails
                    }
                });
            });
        }




        //function for loadtoday order
        function loadtodaybfitem() {

            var payload = {
                todaydate: schtdydate[0].value,
                load: "loadtodaybfitem"
            }
            console.log("payload", payload);
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    console.log("tdydate", response);
                    let schtdbfitem = document.querySelector('#schtdbfitem');
                    schtdbfitem.value = response.data[0]['ItemName'];
                },
                error: function(err) {
                    console.log(err);
                }
            })

        }
        // loadtodaybfitem();

          //today lunch curry item
          function loadCurryInLunch(){
            var payload = {
                todaydate : schtdydate[1].value,
                load:"loadtodaylunitem"
            }
            console.log("payload",payload);
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){
                    console.log("tdydate",response);
                    let schtdbfitem = document.querySelector('#schtdlunitem');
                    schtdbfitem.value = response.data[0]['ItemName'];
                },
                error:function(err){
                    console.log(err);
                }
            })
        }
        // loadCurryInLunch();

        //function for load today dinner item
        function loadtodaydinneritem(){
            var payload = {
                todaydate : schtdydate[2].value,
                load:"loadtodaydinneritem"
            }
            console.log("dinnerpayload",payload);
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){
                    console.log("tdydate",response);
                    let schtddinitem = document.querySelector('#schtddinitem');
                    schtddinitem.value = response.data[0]['ItemName'];
                },
                error:function(err){
                    console.log(err);
                }
            })

        }
        // loadtodaydinneritem();

        async function checkingtrigger() {
            loadSchedulingDates();
            // await checktmritem();
            // await checkdinnertmitem();
            // await checklunchitem();
        }

         //check wheather tomorrow breakfast item set or not
         async function checktmritem(){
            console.log("breakfast tmr item")
            var payload = {
                load:"checktmritem",
                tmrdate:schtmdydate[0].value,
            }
            try{
                let response = await $.ajax({
                    type: "POST",
                    url: "./webservices/fooddetails1.php",
                    data: JSON.stringify(payload),
                    dataType: "json",
                });
                console.log('checktrm', response);
                if (response.data.length > 0) {
                    document.querySelector('.btnbftmr').textContent = 'Edit';
                    console.log("t", response);
                    let subcat = response.data[0]['subcategory'];
                    console.log('subcat', subcat);
                    document.querySelector('.subcategory').value = subcat;
                    loadcatitems();
                }
            }
            catch(err){
                console.log(err);
                alert("Something went wrong, try again later");
            }
        }


         //check tomorrow lunch item
         async function checklunchitem(){
            console.log("check tmr lunc item")
            var payload = {
                load:"checktmrlunitem",
                tmrdate:schtmdydate[1].value,
            }
            try{
                let response = await $.ajax({
                    type: "POST",
                    url: "./webservices/fooddetails1.php",
                    data: JSON.stringify(payload),
                    dataType: "json",
                });
                console.log('check tomorrow lunch item', response);
                if (response.data.length > 0) {
                    console.log("hello");
                    document.querySelector('.btnluntmr').textContent = 'Edit';
                    console.log("t", response);
                    let subcat = response.data[0]['subcategory'];
                    console.log('subcat', subcat);
                    document.querySelector('.lunchsubcategory').value = subcat;
                    loadLunchCategoryItems();
                }
            }
            catch(err){
                console.log(err);
                alert("Something went wrong, try again later");
            }
        }


        //check tomorrow dinner item
        async function checkdinnertmitem(){
            var payload = {
                load:"checktmrdinitem",
                tmrdate:schtmdydate[2].value,
            }
            try{
                let response = await $.ajax({
                    type: "POST",
                    url: "./webservices/fooddetails1.php",
                    data: JSON.stringify(payload),
                    dataType: "json",
                });
                console.log('checktrmdin', response);
                if (response.data.length > 0) {
                    document.querySelector('.btndintmr').textContent = 'Edit';
                    console.log("t", response);
                    let subcat = response.data[0]['subcategory'];
                    console.log('subcat', subcat);
                    document.querySelector('.dinnersubcategory').value = subcat;
                    loadDinnerCategoryItems();
                }
            }
            catch(err){
                console.log(err);
                alert("Something went wrong, try again later");
            }
            // $.ajax({
            //     type: "POST",
            //     url: "./webservices/fooddetails1.php",
            //     data: JSON.stringify(payload),
            //     dataType: "json",
            //     success:function(response){
            //         console.log('checktrm',response);
            //        if(response.data.length > 0){
            //         document.querySelector('.btnbftmr').textContent = 'Edit';
            //         console.log("t",response);
            //         let subcat = response.data[0]['subcategory'];
            //         console.log('subcat',subcat)
            //         document.querySelector('.subcategory').value = subcat;
            //         loadcatitems();
            //        }
            //     },
            //     error:function(err){
            //         console.log(err);
            //         alert("Something wrong try again later")
            //     }
            // })
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
        function loadAllSubcategory(){
            let usingSubcategories = ['tiffin','dinner','fry','curry','pulusu','pachadi','pappu'];
            var payload = {
                foodtype:"1",
                load:"loadallsubcategory",
            }
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    console.log("responseall", response);
                    if (response.data.length > 0) {
                        response.data.forEach(sub => {
                            
                            let subcategoryname = removeSpaces(sub.subcategory);

                            if (usingSubcategories.includes(subcategoryname)) {

                                let subcategorySelector = trimOperation(sub.type, 'subcategory');
                                let subcategory = document.querySelector(`#${subcategorySelector}`);

                            
                            
                                if (subcategory) {
                                    let optionExists = Array.from(subcategory.options).some(option => option.value === sub.SNO);
                                
                                    if(!optionExists){
                                        
                                        let options = document.createElement('option');
                                

                                        options.textContent = sub.subcategory;
                                        options.value = sub.SNO;


                                        subcategory.appendChild(options);
                                    }
                                
                                
                                } else {
                                    console.warn(`Subcategory element not found for selector: ${subcategorySelector}`);
                                }
                            }
                        });

                        response.data.forEach(itm=>{

                            let subcategoryname = removeSpaces(itm.subcategory);

                            if (usingSubcategories.includes(subcategoryname)) {


                                let itemsselector = trimOperation(itm.type,'items');
                                let items = document.querySelector(`#${itemsselector}`);
                                
                                if(items){
                                    let optionExists = Array.from(items.options).some(option => option.value === itm.OptionID);
                                    if(!optionExists){
                                        let itemsoption = document.createElement('option');
                                        
                                        itemsoption.textContent = itm.ItemName
                                        itemsoption.value = itm.OptionID

                                        items.appendChild(itemsoption);
                                    }     
                                }
                                else{
                                    console.warn(`item element not found for selector: ${itemsselector}`);   
                                }
                            }
                        })
                    }
                },
                error:function(err){
                    console.log(err)
                }
            })
        }

        function removeSpaces(str){
            return str.replace(/\s+/g, "").toLowerCase(); 
        }
      

        //load lunch subcategory
        function loadlunchsub(){
            var payload = {
                foodtype:"2",
                load:"loadlunchsub",
            }
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){
                    console.log("sub dinner",response);
                    if(response.data.length > 0){
                        let subcategory = document.querySelector('.lunchsubcategory');
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
        // loadlunchsub();


        //load dinner subcategory
        function loaddinnersub(){
            var payload = {
                foodtype:"3",
                load:"loaddinnersub",
            }
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){
                    console.log("sub dinner",response);
                    if(response.data.length > 0){
                        let subcategory = document.querySelector('.dinnersubcategory');
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
        // loaddinnersub();


        //load category items
        function loadcatitems(){
            var payload = {
                load:"bfcatitems",
                ssubcategory: document.querySelector('.subcategory').value
            }
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){   
                    console.log('breakfasttttttt',response)   
                    let tmbfitems = document.querySelector('.tmbfitems');
                    if(response.data && response.data.length > 0){
                          
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
                    console.log('breakfastcat item',err);

                }
            })
        }
        //load lunch category items
        function loadLunchCategoryItems(){
            var payload = {
                load:"lunchcatitems",
                ssubcategory: document.querySelector('.lunchsubcategory').value
            }
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){    
                    let tmdinitems = document.querySelector('.tmlunitems');
                    if(response.data && response.data.length > 0){
                        console.log('onchange',response)     
                        if (tmdinitems) {
                            tmdinitems.innerHTML = `<option value="">Select the item</option>`; 
                            response.data.forEach(itm => { 
                                let option = document.createElement('option');
                                option.value = itm.OptionID;
                                option.textContent = itm.ItemName;
                                tmdinitems.appendChild(option);
                            });
                        }
                        loadlunitemstmrdate();
                    }
                    else{
                        tmdinitems.innerHTML = `<option value="">No items</option>`; 
                    }
                },
                error:function(err){
                    console.log(err);
                }
            })
        }

        //load dinner category items
        function loadDinnerCategoryItems(){
            var payload = {
                load:"dincatitems",
                ssubcategory: document.querySelector('.dinnersubcategory').value
            }
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){    
                    let tmdinitems = document.querySelector('.tmdinitems');
                    if(response.data && response.data.length > 0){
                        console.log('onchange',response)     
                        if (tmdinitems) {
                            tmdinitems.innerHTML = `<option value="">Select the item</option>`; 
                            response.data.forEach(itm => { 
                                let option = document.createElement('option');
                                option.value = itm.OptionID;
                                option.textContent = itm.ItemName;
                                tmdinitems.appendChild(option);
                            });
                        }
                        loaddinitemstmrdate();
                    }
                    else{
                        tmdinitems.innerHTML = `<option value="">No items</option>`; 
                    }
                },
                error:function(err){
                    console.log(err);
                }
            })
        }

        function upddatetmitem(thsbtn,foodtype){
            
            let updateactivity = (thsbtn.textContent === 'Edit') ? 2 : 1;

            console.log("foodtype",foodtype)

            let dropdown = (foodtype === 1)?document.querySelector('.tmbfitems'):
                            (foodtype === 3)?document.querySelector('.tmdinitems')
                                            :document.querySelector('.tmlunitems')

            let subcategory = (foodtype === 1)?document.querySelector('.subcategory').value:
                                (foodtype === 3)?document.querySelector('.dinnersubcategory').value:
                                                document.querySelector('.lunchsubcategory').value

          
            let tmdate = (foodtype === 1)?schtmdydate[0].value:(foodtype === 3)?schtmdydate[2].value:schtmdydate[1].value
                            
                                           
                                           
            let previousitem = (foodtype === 1)?breakfasttmritem:(foodtype === 3)?dinnertmritem:lunchtmritem;
         

            if(!document.querySelector('.tmbfitems').value || ! document.querySelector('.subcategory').value){
                alert("Please fill the required fields");
                return;
            }

            let optionid = dropdown.value; 

            let itemname = dropdown.options[dropdown.selectedIndex].text
         

            let check = confirm(`Do you really want to update tomorrow's item to ${itemname}?`)
            if(!check){
                dropdown.value = previousitem;
                return;
            }
            
            var payload = {
                tmrdate:tmdate,
                load:"setitem",
                OptionID:optionid,
                ssubcategory: subcategory,
                updateactivity:updateactivity,
                foodtype:foodtype
            }
            console.log('update',payload);
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success:function(response){
                    console.log("updatebfitem",response)
                    if(response.status === 'success'){
                        alert("Successfully Updated")
                        if(foodtype === 1){
                            document.querySelector('.btnbftmr').textContent = 'Edit';
                        }
                        else if(foodtype === 3){
                            document.querySelector('.btndintmr').textContent = 'Edit';
                        }
                        else{
                            document.querySelector('.btnluntmr').textContent = 'Edit';
                        }
                      
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
                        breakfasttmritem = response.data[0]['OptionID'];
                    }
                },
                error:function(err){
                    console.log(err);
                }
            })
        }
        //function for lunch items tomorrow
        function loadlunitemstmrdate(){
            var payload = {
                load:"loadbylunitemstmrdate",
                tmrdate:schtmdydate[1].value
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
                        document.querySelector('.tmlunitems').value  = response.data[0]['OptionID'];
                        lunchtmritem = response.data[0]['OptionID'];
                    }
                },
                error:function(err){
                    console.log(err);
                }
            })
        }
       
        //function for load dinner tomorrow item
        function loaddinitemstmrdate(){
            var payload = {
                load:"loadbydinitemstmrdate",
                tmrdate:schtmdydate[2].value
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
                        document.querySelector('.tmdinitems').value  = response.data[0]['OptionID'];
                        dinnertmritem = response.data[0]['OptionID'];
                    }
                },
                error:function(err){
                    console.log(err);
                }
            })
        }


        // Function to toggle sections with active class
        function toggleSection(sectionId, element) {
            const sections = ['prices-content', 'items-menu', 'items-menu-content', 'sub-items-menu-content', 'scheduling-content', 'delivery-scheduling', 'delivery-add'];
            sections.forEach(id => {

                document.getElementById(id).style.display = (id === sectionId) ? 'block' : 'none';

            });




            if (sectionId === 'prices-content') {
                document.getElementById('from_date').value = "";
                document.getElementById('category').selectedIndex = 0;
                document.getElementById('sub_items-dp').innerHTML = "<option value='' disabled selected>Select Category</option>";
                document.getElementById('food_items-dp').innerHTML = "<option value='' disabled selected>Select Food Item</option>";
                document.getElementById('Price').value = "";
                $('#typesTableBody').hide();
                $('#typesTableBody1').hide();
                $('#tablehead').hide();



            } else if (sectionId === 'items-menu') {
                document.getElementById('category_name').value = "";
                $('#typesTableBody').hide();
                $('#typesTableBody1').hide();
                $('#tablehead').hide();

            } 
            else if (sectionId === 'items-menu-content') {
                document.getElementById('item_category').selectedIndex = 0;
                document.getElementById('subcategory_name').value = "";
                $('.lun_table tbody').hide();
            }
            else if (sectionId === 'sub-items-menu-content') {
                document.getElementById('sub_item_category').selectedIndex = 0;
                document.getElementById('sub_items').innerHTML = "<option value='' disabled selected>Select Category</option>";
                document.getElementById('item_name').value = "";
                document.getElementById('item_number').value = "";
                $('.lun_table1 tbody').hide();
            }
            else if (sectionId === 'delivery-add') {
                document.getElementById('name').value = "";
                document.getElementById('contact').value = "";
                document.getElementById('Doorno').value = "";
                document.getElementById('Street').value = "";
                document.getElementById('Area').value = "";
            }
            else if(sectionId == 'delivery-scheduling'){
                document.getElementById(`foodtype-tdy`).selectedIndex = 0;
                document.getElementById(`foodtype-tmr`).selectedIndex = 0;
                document.getElementById(`name-tdy`).innerHTML = "<option value='' disabled selected>Select Name </option>";
                document.getElementById(`name-tmr`).innerHTML = "<option value='' disabled selected>Select Name </option>";
                document.getElementById(`contact-tdy`).innerHTML = "<option value='' disabled selected>Select Contact </option>";
                document.getElementById(`contact-tmr`).innerHTML = "<option value='' disabled selected>Select Contact </option>";
            }
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
            var payload = {
                sno: "",
                item: "",
                category: document.querySelector('.category').value,
                load: "loadsubcategory",
            }

            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
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
                        option.value = x.SNO;
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
                    console.log("loaditem by category",response);
                    const tbody = document.querySelector(".lun_table tbody");
                    tbody.innerHTML = ""; // Clear existing rows

                    if (response.data && response.data.length > 0) {
                        response.data.forEach(item => {
                            const activityLabel = item.activity == 1 ? "Deactivate" : "Activate";
                            const editLabel = item.subcategory == "Main Items" ? "Fixed" : "Edit";
                            let disabled = (item.subcategory == "Main Items") ? "disabled" : "enabled";
                            const row = `<tr>
                        <td>${item.subcategory}</td>
                        <td><button onclick="editItem(${item.SNO}, '${item.subcategory}')" ${disabled}> ${editLabel}</button></td>
                        <td><button onclick="activity(${item.SNO}, ${item.activity})" >${activityLabel}</button></td>
                    </tr>`;
                            tbody.insertAdjacentHTML("beforeend", row);
                        });
                        $('.lun_table tbody').show();
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
        {
            
        }

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
            status = ( currentActivity  === 1) ? "deactivated" : "activated";
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {

                    if (response.status === "success") {
                        alert(`Item is ${status}`);
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
                        dropdown.innerHTML = "<option disabled></option>";
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
                            const activityLabel = item.activity == 1 ? "Deactivate" : "Activate";
                           console.log("activityyyyyyy",activityLabel);
                            const row = `<tr>
                        <td>${item.ItemName}</td>
                        <td>${item.Price}</td>
                        <td><button onclick="editItemi(${item.OptionID}, '${item.ItemName.replace(/'/g, "\\'")}')">Edit</button></td>
                        <td><button onclick="activityi(${item.OptionID}, ${item.activity})">${activityLabel}</button></td>
                    </tr>`;
                            tbody.insertAdjacentHTML("beforeend", row);
                        });
                        $('.lun_table1 tbody').show();
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

            var todayDate = new Date().toISOString().split('T')[0]; // Get current date in YYYY-MM-DD format


            var payload = {
                foodtype: selectedCategory,
                subcategory: subcategoryName,
                itemname: selectitemname,
                price: selectprice,
                fromdate: todayDate, // Optional if backend handles date
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
                    document.getElementById('addi').disabled = false; // Re-enable button after response
                },
                error: function(error) {
                    console.error("Error adding itemname:", error);
                    document.getElementById('addi').disabled = false; // Re-enable button even if error
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
        document.querySelector('.cnclbtni').addEventListener('click', resetFormi);

        // Reset Form Function - Hides Update & Cancel, Shows Save
        // Reset Form Function - Hides Update & Cancel, Shows Save
        function resetFormi() {
            document.getElementById("item_name").value = '';
            document.getElementById("item_number").value = '';
            document.getElementById("item_number").disabled = false; // Enable price input after edit

            edititemNameId = null;

            document.getElementById('addi').style.display = 'inline-block';
            document.getElementById('updatei').style.display = 'none';
            document.querySelector('.cnclbtni').style.display = 'none';
        }



        function activityi(sno, currentActivity) {
            var payload = {
                sno: sno,
                activity: currentActivity,
                load: "activityStatusChangei"
            };

           status = ( currentActivity  === 1) ? "deactivated" : "activated";
            console.log(payload);
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {

                    if (response.status === "success") {

                        alert(`Item is ${status}`);
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


        // Enable edit mode for Sub Items Menu
        function enableSubItemEditMode(subItemName, subItemPrice) {
            const itemNameField = document.getElementById('item_name');
            const itemPriceField = document.getElementById('item_number');
            const saveBtn = document.getElementById('addi');
            const updateBtn = document.getElementById('updatei');
            const cancelBtn = document.querySelector('.cnclbtni');
            const addSubItemSection = document.querySelector('.add_lun1');

            itemNameField.value = subItemName;
            itemPriceField.value = subItemPrice;
            saveBtn.style.display = 'none';
            updateBtn.style.display = 'inline-block';
            cancelBtn.style.display = 'inline-block';
            addSubItemSection.classList.add('edit-mode');
        }

        // Cancel edit mode for Sub Items Menu
        function cancelSubItemOperation() {
            const itemNameField = document.getElementById('item_name');
            const itemPriceField = document.getElementById('item_number');
            const saveBtn = document.getElementById('addi');
            const updateBtn = document.getElementById('updatei');
            const cancelBtn = document.querySelector('.cnclbtni');
            const addSubItemSection = document.querySelector('.add_lun1');

            itemNameField.value = '';
            itemPriceField.value = '';
            saveBtn.style.display = 'inline-block';
            updateBtn.style.display = 'none';
            cancelBtn.style.display = 'none';
            addSubItemSection.classList.remove('edit-mode');
        }
        let additem = document.querySelector("#addBtn");
         additem.addEventListener('click', () => {
            // e.preventDefault();
            var categoryName = document.getElementById("category_name").value.trim();
            if (categoryName === "") {
            alert("ItemName cannot be empty!");
          return;
        }

            var payload = {
                sno: "",
                type: document.getElementById("category_name").value,
                load: "additem"
            }
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    alert(response.status);
                    loaditem();
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
        
        function loaditem() {
    var payload = {
        sno: "",
        type: "",
        load: "loaditem"
    };

    $.ajax({
        type: "POST",
        url: "./webservices/fooddetails1.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success: function(response) {
            console.log("Response received:", response); // Debugging

            let tbd = document.querySelector(".category-list");
            tbd.innerHTML = ""; // Clear previous data

            if (response.code === "200" && response.data.length > 0) {
                response.data.forEach(x => {
                    let activityLabel = x.activity == 1 ? "Deactivate" : "Activate"; 

                    let tdrow = document.createElement('tr');
                    tdrow.innerHTML = `
                        <td>${x.type}</td>
                        <td><button class="edit-btn" onclick="updateitem(${x.sno}, '${x.type}')">Edit</button></td>
                        <td><button class="toggle-btn" onclick="changeActivity(${x.sno}, ${x.activity}, this)">${activityLabel}</button></td>
                    `;
                    tbd.appendChild(tdrow);
                });
            } else {
                tbd.innerHTML = "<tr><td colspan='3'>No records found</td></tr>";
            }
        },
        error: function(err) {
            console.error("Error loading items:", err);
        }
    });
}
function changeActivity(sno, currentStatus, buttonElement) {
    let newStatus = currentStatus == 1 ? 0 : 1; // Toggle status

    var payload = {
        sno: sno,
        activity: newStatus,
        load: "changeActivity"
    };

    $.ajax({
        type: "POST",
        url: "./webservices/fooddetails1.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success: function(response) {
            if (response.code === "200") {
                // Update button text and toggle status
                buttonElement.textContent = newStatus == 1 ? "Deactivate" : "Activate";
                buttonElement.setAttribute("onclick", `changeActivity(${sno}, ${newStatus}, this)`);
                loadtabs();
            } else {
                alert("Failed to update activity status.");
            }
        },
        error: function(err) {
            console.error("Error updating activity:", err);
        }
    });
}

function updateitem(sno, type) {
    console.log(sno);
    document.getElementById("category_name").value = type; // Set input field value

    let update = document.querySelector('#updateBtn');
    let cncl = document.querySelector('.cancelBtn');
    let add = document.querySelector('#addBtn');

    update.style.display = "block"; // Show update button
    cncl.style.display = "block"; // Show cancel button
    add.style.display = "none"; // Hide add button

    // Remove previous event listeners
    update.replaceWith(update.cloneNode(true));
    update = document.querySelector('#updateBtn');

    update.addEventListener('click', function() {
        var payload = {
            sno: sno,
            type: document.getElementById("category_name").value,
            load: "updateitem"
        };

        $.ajax({
            type: "POST",
            url: "./webservices/fooddetails1.php",
            data: JSON.stringify(payload),
            dataType: "json",
            success: function(response) {
                alert("Record updated successfully");
                update.style.display = "none"; // Hide update button
                cncl.style.display = "none"; // Hide cancel button
                add.style.display = "block"; // Show add button
                document.getElementById("category_name").value = ""; // Clear input
                loaditem(); // Refresh items
            },
            error: function(err) {
                console.log("Error updating item:", err);
            }
        });
    });
}

// Load initial data
loaditem();

// Cancel button functionality
document.querySelector('.cancelBtn').addEventListener('click', function() {
    document.getElementById("category_name").value = ''; // Clear input field
    document.querySelector('#updateBtn').style.display = 'none'; // Hide update button
    document.querySelector('.cancelBtn').style.display = 'none'; // Hide cancel button
    document.getElementById('addBtn').style.display = 'block'; // Show add button
        });

function loadfoodtypeds() {
            var payload = {
                load: "loadfoodtypeds"
            };
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    let dropdown = document.getElementById("foodtype-tdy");
                    dropdown.innerHTML = "<option value='' disabled selected>Select Food Type</option>";
                    response.data.forEach(x => {
                        let option = document.createElement('option');
                        option.value = x.sno;
                        option.text = x.type;
                        dropdown.appendChild(option);
                    });
                    dropdown.addEventListener('change', function() {
                        let selectedFoodType = this.value;
                        if (selectedFoodType) {
                            // If a food type is selected, show the 'name-tdy' dropdown
                            document.getElementById("name-tdy").style.display = "block";
                            loadnameds(selectedFoodType); // Call loadnameds when food type is selected
                        }
                    });
                },
                error: function(err) {
                    console.error("Error loading foodtype:", err);
                }
            });
        }
        loadfoodtypeds();

        // delivery scheduling page foodtype for tommorrow

        function loadfoodtypesds() {
            var payload = {
                load: "loadfoodtypesds"
            };
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    let dropdown = document.getElementById("foodtype-tmr");
                    dropdown.innerHTML = "<option value='' disabled selected>Select Food Type</option>";
                    response.data.forEach(x => {
                        let option = document.createElement('option');
                        option.value = x.sno;
                        option.text = x.type;
                        dropdown.appendChild(option);
                    });


                },
                error: function(err) {
                    console.error("Error loading foodtype:", err);
                }
            });
        }
        loadfoodtypesds();



        // delivery scheduling page name for today 

        function loadnameds(selectedFoodtype) {
            var payload = {
                load: "loadnameds",
                foodtype: selectedFoodtype // Send foodtype if necessary for filtering names
            };

            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    let dropdown = document.getElementById("name-tdy");
                    dropdown.innerHTML = "<option value='' disabled selected>Select Name</option>";

                    // Ensure response contains data
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(x => {
                            let option = document.createElement('option');
                            option.value = x.ID; // Ensure 'ID' is the correct value
                            option.text = x.Name; // Display the name in the dropdown
                            dropdown.appendChild(option);
                        });
                    } else {
                        alert('No names found for this food type');
                    }
                },
                error: function(err) {
                    console.error("Error loading names:", err);
                }
            });
        }


        // delivery scheduling page name for tommorrow

        function loadnamesds(selectedFoodtype) {
            var payload = {
                foodtype: selectedFoodtype,
                load: "loadnameds"
            };
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    let dropdown = document.getElementById("name-tmr");
                    dropdown.innerHTML = "<option value='' disabled selected>Select Name</option>";
                    response.data.forEach(x => {
                        let option = document.createElement('option');
                        option.value = x.ID;
                        option.text = x.Name;
                        dropdown.appendChild(option);
                    });
                },
                error: function(err) {
                    console.error("Error loading name:", err);
                }
            });
        }
        loadnamesds(selectedFoodtype);

        // delivery scheduling page name for today 
        // Function to load contact information based on selected name
        function loadcontactds() {
            var selectedNameID = document.getElementById("name-tdy").value; // Get the selected Name ID

            console.log("Selected Name ID: ", selectedNameID); // Debugging log to check selected value

            if (selectedNameID) {
                var payload = {
                    load: "loadcontactds", // Identifying the action in the PHP backend
                    id: selectedNameID // Send the selected name ID to the server
                };
                console.log("Payload:", payload); // Debugging payload

                $.ajax({
                    type: "POST",
                    url: "./webservices/fooddetails1.php",
                    data: JSON.stringify(payload),
                    dataType: "json",
                    success: function(response) {
                        console.log("fds", response.data)
                        let contactDropdown = document.getElementById("contact-tdy");

                        // Clear the dropdown before populating it
                        contactDropdown.innerHTML = "<option value='' disabled selected>Select Contact</option>";

                        if (response.status === 'success') {
                            if (response.data.length > 0) {
                                // Loop through the response data and add each contact to the dropdown
                                response.data.forEach(function(contact) {
                                    let option = document.createElement('option');
                                    option.value = contact.ID; // Assuming the ID is the value for the contact
                                    option.text = contact.Contact; // Display the contact number in the dropdown
                                    contactDropdown.appendChild(option);
                                });
                            } else {
                                alert('No contact found for the selected name.');
                            }
                        } else {
                            alert(response.message); // If there are no contacts, show an alert
                        }
                    },
                    error: function(err) {
                        console.error("Error loading contact:", err);
                    }
                });
            } else {
                alert("Please select a name first.");
            }
        }

        // Bind to the 'change' event of the name-tdy dropdown
        document.getElementById("name-tdy").addEventListener('change', loadcontactds);






        // delivery scheduling page name for today 

        function loadcontactsds() {
            var selectedNameID = document.getElementById("name-tmr").value; // Get the selected Name ID

            console.log("Selected Name ID: ", selectedNameID); // Debugging log to check selected value

            if (selectedNameID) {
                var payload = {
                    load: "loadcontactsds", // Identifying the action in the PHP backend
                    id: selectedNameID // Send the selected name ID to the server
                };
                console.log("Payload:", payload); // Debugging payload

                $.ajax({
                    type: "POST",
                    url: "./webservices/fooddetails1.php",
                    data: JSON.stringify(payload),
                    dataType: "json",
                    success: function(response) {
                        let contactDropdown = document.getElementById("contact-tmr");

                        // Clear the dropdown before populating it
                        contactDropdown.innerHTML = "<option value='' disabled selected>Select Contact</option>";

                        if (response.status === 'success') {
                            if (response.data.length > 0) {
                                // Loop through the response data and add each contact to the dropdown
                                response.data.forEach(function(contact) {
                                    let option = document.createElement('option');
                                    option.value = contact.ID; // Assuming the ID is the value for the contact
                                    option.text = contact.Contact; // Display the contact number in the dropdown
                                    contactDropdown.appendChild(option);
                                });
                            } else {
                                alert('No contact found for the selected name.');
                            }
                        } else {
                            alert(response.message); // If there are no contacts, show an alert
                        }
                    },
                    error: function(err) {
                        console.error("Error loading contact:", err);
                    }
                });
            } else {
                alert("Please select a name first.");
            }
        }

        // Bind to the 'change' event of the name-tdy dropdown
        document.getElementById("name-tmr").addEventListener('change', loadcontactsds);


        // save button for tdy 
        function savetdy(event) {
            console.log("today save button");

            const date = $('#schtdydate').val();
            // const foodtype = $('#foodtype-tdy').val();
            const name = $('#name-tdy option:selected').text(); // This gets the text of the selected option

            const contact = $('#contact-tdy option:selected').text();
            const foodtype = $('#foodtype-tdy option:selected').val();

            if (!name || !contact || !foodtype) {
                alert('Please fill all the required fields.');
            }

            const payload = {
                load: "savetdy",
                id: $('#name-tdy').val(),
                date: $('#schtdydate').val(),
                foodtype: $('#foodtype-tdy').val(),
                name: $('#name-tdy option:selected').text(), // This gets the text of the selected option

                contact: $('#contact-tdy option:selected').text(),
            };
            console.log("today button", payload);

            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    console.log("Response Data: ", response.data);
                    alert(response.message);
                    editId = null;
                    todayfetchall();
                    resetfields('tdy');


                },
                error: function(err) {
                    console.error("Error loading data: ", err);
                }
            });
        }





        // save button for tmr
        function savetmr(event) {
            console.log("tommorrow save button");

            const date = $('#schtdydate').val();
            // const foodtype = $('#foodtype-tdy').val();
            const name = $('#name-tmr option:selected').text(); // This gets the text of the selected option

            const contact = $('#contact-tmr option:selected').text();
            const foodtype = $('#foodtype-tmr option:selected').val();


            if (!name || !contact || !foodtype) {
                alert('Please fill all the required fields.');
            }

            const payload = {
                load: "savetmr",
                id: $('#name-tmr').val(),
                date: $('#schtmdydate').val(),
                foodtype: $('#foodtype-tmr').val(),
                name: $('#name-tmr option:selected').text(), // This gets the text of the selected option

                contact: $('#contact-tmr option:selected').text(),
            };
            console.log("tommorrow button", payload);

            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    console.log("Response Data: ", response.data);
                    alert(response.message);
                    editId1 = null;
                    tmrfetchall();
                    resetfields('tmr');
                },
                error: function(err) {
                    console.error("Error loading data: ", err);
                }
            });
        }

        function resetfields(x) {
            console.log(x);

            // Reset food type dropdown
            let foodTypeDropdown = document.getElementById(`foodtype-${x}`);
            foodTypeDropdown.innerHTML = "<option value='' disabled selected>Select Food Type</option>";

            // Reset name dropdown
            let nameDropdown = document.getElementById(`name-${x}`);
            nameDropdown.innerHTML = "<option value='' disabled selected>Select Name</option>";

            // Reset contact dropdown
            let contactDropdown = document.getElementById(`contact-${x}`);
            contactDropdown.innerHTML = "<option value='' disabled selected>Select Contact</option>";

            // Reload the food types dropdown so the options appear again
            if (x === "tdy") {
                loadfoodtypeds();
            } else if (x === "tmr") {
                loadfoodtypesds(); // Create a similar function for tomorrow's dropdowns if needed
            }
        }


        function todayfetchall() {
            console.log("today fetchallll");
            const payload = {
                load: 'todayfetchall'
            };
            $.ajax({
                url: "./webservices/fooddetails1.php",
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify(payload),
                success: function(response) {
                    console.log("hello", response);
                    const tdyTableBody = $('.tdyscheduling');
                    tdyTableBody.empty();
                    response.data.forEach(item => {
                        const row = $('<tr>').click(() => populateFormtdy(item));
                        row.html(`
                            <td>${item.Date}</td>
                            <td>${item.type}</td>   
                            <td>${item.Name}</td>
                            <td>${item.Contact}</td>
                      
                                `);
                        tdyTableBody.append(row);
                    });
                },
                error: function(error) {
                    console.log('Error fetching data:', error);
                }
            });
        }
        todayfetchall();

        function tmrfetchall() {
            console.log("tmr fetchallll");
            const payload = {
                load: 'tmrfetchall'
            };
            $.ajax({
                url: "./webservices/fooddetails1.php",
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify(payload),
                success: function(response) {
                    console.log("hello", response);
                    const tmrTableBody = $('.tmrscheduling');
                    tmrTableBody.empty();
                    response.data.forEach(item => {
                        const row = $('<tr>').click(() => populateFormtmr(item));
                        row.html(`
                            <td>${item.Date}</td>
                             <td>${item.type}</td>  
                            <td>${item.Name}</td>
                            <td>${item.Contact}</td>
                            
                                `);
                        tmrTableBody.append(row);
                    });
                },
                error: function(error) {
                    console.log('Error fetching data:', error);
                }
            });
        }
        tmrfetchall();







        function adddeliveryinfo(event) {
    event.preventDefault(); // Prevent default form submission
    let isValid = true;

    const name = document.getElementById('name');
    const contact = document.getElementById('contact');
    const doorno = document.getElementById('Doorno');
    const street = document.getElementById('Street');
    const area = document.getElementById('Area');

    // Validate fields
    if (!/^[a-zA-Z\s]+$/.test(name.value.trim())) {
        alert('Name should only contain letters and spaces.');
        isValid = false;
    }
    if (!/^\d{10}$/.test(contact.value.trim())) {
        alert('Contact number must be exactly 10 digits.');
        isValid = false;
    }
    if (!/^\d+-\d+$/.test(doorno.value.trim())) {
        alert('Door number must be in format: number-number (e.g., 6-145)');
        isValid = false;
    }
    if (!/^[a-zA-Z\s]+$/.test(street.value.trim())) {
        alert('Street name should contain only letters.');
        isValid = false;
    }
    if (!/^[a-zA-Z\s]+$/.test(area.value.trim())) {
        alert('Area name should contain only letters.');
        isValid = false;
    }
    if (!isValid) {
        return; 
    }

    const payload = {
        sno: "",
        name: name.value.trim(),
        contact: contact.value.trim(),
        Doorno: doorno.value.trim(),
        Street: street.value.trim(),
        Area: area.value.trim(),
        load: "additems"
    };

    // AJAX request
    $.ajax({
        type: "POST",
        url: "./webservices/fooddetails1.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success: function(response) {
            alert("Fields added successfully!");
            document.getElementById('deliveryForm').reset();
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            alert("Something went wrong. Please try again!");
        }
    });
}

// Function to clear all fields when Cancel is clicked
function clearForm() {
    document.getElementById('deliveryForm').reset(); // Clears all fields
}
function validatePhoneNumberInput(input) {
    input.value = input.value.replace(/[^0-9]/g, ''); // Allow only numbers
    if (!/^[6-9]/.test(input.value)) {
        input.value = ""; // Clear if the first digit is not 6-9
    }
    if (input.value.length > 10) {
        input.value = input.value.substring(0, 10); // Limit to 10 digits
    }
}

function validateDoorNumberInput(input) {
    input.value = input.value.replace(/[^a-zA-Z0-9\-\/,. ]/g, ''); // Allow letters, numbers, -, /, , and spaces
    if (input.value.length > 10) { // Set max length to 15 characters
        input.value = input.value.substring(0, 10);
    }
}
// Validate Name Input (Allow only letters and spaces, max 40 characters)
function validateNameInput(input) {
    input.value = input.value.replace(/[^a-zA-Z\s]/g, ''); // Remove numbers & special characters
    if (input.value.length > 10) {
        input.value = input.value.substring(0, 40); // Limit to 40 characters
    }
}

// Validate Street Input (Allow only letters, numbers, and spaces, no special characters)
// Validate Street and Area Input (Allow only letters and spaces, max 50 characters)
function validateStreetAndAreaInput(input) {
    input.value = input.value.replace(/[^a-zA-Z\s]/g, ''); // Remove special characters and numbers
    if (input.value.length > 50) {
        input.value = input.value.substring(0, 50); // Limit to 50 characters
            }
}

    </script>
</body>

</html>
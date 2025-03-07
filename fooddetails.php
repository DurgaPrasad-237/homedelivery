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
                            <input type="text" id="category_name" placeholder="Enter category Name">
                            <button type="submit" id="addBtn" name="add" style="background-color: #28a745; color: white; border: none; padding: 10px 20px; cursor: pointer;">Save</button>

<button type="submit" id="updateBtn" class="btn btn-primary" name="update" style="display: none;  padding:15px 20px; background-color: #ffc107;">Update </button>

<button class="btn btn-primary cancelBtn" style="display: none; padding: 15px 20px; background-color: #dc3545; color: white; border: none; cursor: pointer;">Cancel</button>
                        </div>
                        <div class="existing-categories">
                                    <table class="category-table">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Edit</th>
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
                            <input type="text" id="subcategory_name" placeholder="Enter Subcategory Name">
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
                            <input type="text" id="item_name" placeholder="Enter Sub Item" maxlength="40">
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
                    console.log(response);
                    if (response.data.length > 0) {
                        for (const itm of response.data) {
                            let subcategorySelector = trimOperation(itm.type, 'subcategory');
                            let subcategory = document.querySelector(`#${subcategorySelector}`);
                            subcategory.value = itm.subsno;

                            // WAIT until items are loaded before setting the value
                            await loaditembysubcategory({ value: itm.subsno });

                            let itemselector = trimOperation(itm.type, 'items');
                            let items = document.querySelector(`#${itemselector}`);
                            items.value = itm.OptionID;
                        }

                        document.querySelectorAll('.schsavebtn').forEach(dis => {
                            dis.disabled = checktddate;
                        });
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
                    if(response.data.length > 0){
                        let schedule_menu_list = document.querySelector('.schedule_menu_list');
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
                            selecttag.setAttribute('onchange','loaditembysubcategory(this)')
                            selecttag.setAttribute('class','subcategory')
                            let option = document.createElement('option');
                            option.textContent = "Select sub category"
                            option.value = " ";

                            selecttag.appendChild(option);


                            //items select tag
                            let itemsselecttag = document.createElement('select');
                            itemsselecttag.setAttribute('id',`${trimOperation(itm.type,'items')}`)
                            itemsselecttag.setAttribute('class','fditems')
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

        //update schedule
        function updateSchedule(selectbutton,foodtype){
            let grandparentDiv = selectbutton.closest('div')?.parentElement.closest('div');
            let divid = grandparentDiv.id;

            let foodtypeid = document.getElementById(divid).dataset.foodtypeid;
            let selecteddate = document.querySelector('.active_date')
          

            let closestFditems = selectbutton.closest('div')?.querySelector('.fditems');

            let closestsubcategory = selectbutton.closest('div')?.querySelector('.subcategory');

            let scheduletablename = (foodtype === "breakfast")
                                        ? `${foodtype}schedule` :(foodtype === "lunch") ? 
                                        `${foodtype}schedule`:`${foodtype}schedule`

            
            if(!selecteddate){
                alert("Date required")
                return;
            }

            if(!closestFditems.value || closestFditems.value === " "){
                alert("Item required")
            }

            if(!closestsubcategory.value || closestsubcategory.value === " "){
                alert("sub category required")
            }
            
           
            var payload = {
                selecteddate:selecteddate.textContent,
                load:"setitem",
                OptionID:closestFditems.value,
                ssubcategory: closestsubcategory.value,
                // updateactivity:updateactivity,
                foodtype:foodtype,
                foodtypeID:foodtypeid,
                scheduletablename:scheduletablename
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
                        console.log(response);
                        if (response.data.length > 0) {
                            let selectitemid = trimOperation(response.data[0].type, "items");
                            let items = document.querySelector(`#${selectitemid}`);
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
                        });

                        response.data.forEach(itm=>{
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
                        })
                    }
                },
                error:function(err){
                    console.log(err)
                }
            })
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
            const sections = ['prices-content', 'items-menu', 'items-menu-content', 'sub-items-menu-content','scheduling-content'];
            sections.forEach(id => {

                document.getElementById(id).style.display = (id === sectionId) ? 'block' : 'none';
            });

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
                    const tbody = document.querySelector(".lun_table tbody");
                    tbody.innerHTML = ""; // Clear existing rows

                    if (response.data && response.data.length > 0) {
                        response.data.forEach(item => {
                            const activityLabel = item.activity == 1 ? "Deactivate" : "Activate";
                            const row = `<tr>
                        <td>${item.subcategory}</td>
                        <td><button onclick="editItem(${item.SNO}, '${item.subcategory}')">Edit</button></td>
                        <td><button onclick="activity(${item.SNO}, ${item.activity})">${activityLabel}</button></td>
                    </tr>`;
                            tbody.insertAdjacentHTML("beforeend", row);
                        });
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
        document.querySelector('.cnclbtn').addEventListener('click', resetForm);{
            
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

            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {

                    if (response.status === "success") {

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
                        dropdown.innerHTML = "<option disabled>No Subcategories Found</option>";
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
                            const activityLabel = item.activity === 1 ? "Deactivate" : "Activate";

                            const row = `<tr>
                        <td>${item.ItemName}</td>
                        <td>${item.Price}</td>
                        <td><button onclick="editItemi(${item.OptionID}, '${item.ItemName.replace(/'/g, "\\'")}')">Edit</button></td>
                        <td><button onclick="activityi(${item.OptionID}, ${item.activity})">${activityLabel}</button></td>
                    </tr>`;
                            tbody.insertAdjacentHTML("beforeend", row);
                        });
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

            console.log(payload);
            $.ajax({
                type: "POST",
                url: "./webservices/fooddetails1.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {

                    if (response.status === "success") {

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
                    let tdrow = document.createElement('tr');
                    tdrow.innerHTML = `<td>${x.type}</td>
                                       <td><button class="edit-btn" onclick="updateitem(${x.sno}, '${x.type}')">Edit</button></td>`;
                    tbd.appendChild(tdrow);
                });
            } else {
                tbd.innerHTML = "<tr><td colspan='2'>No records found</td></tr>";
            }
        },
        error: function(err) {
            console.error("Error loading items:", err);
        }
    });
}
function updateitem(sno, type) {
    console.log(sno);
    document.getElementById("category_name").value = type;

    let update = document.querySelector('#updateBtn');
    let cncl = document.querySelector('.cancelBtn');
    let add = document.querySelector('#addBtn');

    update.style.display = "block";
    cncl.style.display = "block";
    add.style.display = "none";

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
                update.style.display = "none";
                cncl.style.display = "none";
                add.style.display = "block";
                loaditem();
            },
            error: function(err) {
                console.log("Error updating item:", err);
            }
        });
    });
}
loaditem();
        // JavaScript to display success message
        document.querySelector('.cnclbtn').addEventListener('click', function() {
            document.getElementById("category-name").value = '';
            document.querySelector('#update').style.display = 'none';
            document.querySelector('.cnclbtn').style.display = 'none';
            document.getElementById('add').style.display = 'block';
        });

    </script>
</body>

</html>
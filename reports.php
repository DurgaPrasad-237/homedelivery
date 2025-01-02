
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Report page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-size: 20px;
            background-color: #f0f0f0;
            margin:0px;
        }

        .main-container {
            width: 100%;
            gap: 5%;
            /* border: 2px solid black; */
            background-color: white;
        }

        .header {
            width: 100%;
            height: 15vh;
            display: flex;
            gap: 5%;
            background-color: #FFC857;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            cursor: default;

            /* border: 2px solid brown; */

        }

        .header-box {
            width: 130px;
            height: 30px;
            border: 2px solid black;
            margin-top: 2%;
            margin-left: 1%;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            cursor: pointer;
        }

        .container {
            width: 100%;
            height: 84vh;
            display: flex;
            justify-content: space-between;
            margin-top: 0.4%;
            /* border: 2px solid red; */
            display: flex;
            flex-direction: column;
        }

        .container1 {
            width: 100%;
            height: 15vh;
            /* box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); */
            cursor: default;
            border-radius: 10px;
            border: 2px solid whitesmoke;


        }

        .container2 {
            width: 100%;
            height: 70vh;
            /* border: 3px solid green; */
            border-radius: 10px;
            border: 2px solid whitesmoke;
            overflow-y: auto;




        }

        .form-row {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            /* Fields in a row */
            /* gap: 60px; */
            /* Space between fields */
            align-items: center;
            margin-top: 2%;
            margin-left: 2%;
            font-weight: bold;
            /* margin-bottom:1%; */


        }

        .form-row input,
        .form-row button,
        #periodicity,.foodtype {
            padding: 8px;
            font-size: 1rem;
            border-radius: 5px;
        }

        .form-group {
            display: flex;
            flex-direction: row;
            /* Fields in a row */
            gap: 10px;
            /* Space between fields */
            align-items: center;

        }

        .form-group label {
            font-size: 17px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
            /* overflow-y: scroll; */
            height: 25vh;


        }

        table,
        th,
        td {
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 18px;
        }


        th,
        td {
            text-align: left;
            padding: 15px;
        }

        table th {
            background-color: gray;
            color: #fff;
            padding: 10px;
            font-weight: bold;
            position: sticky;
        }

        table td {
            padding: 8px;
            width: fit-content;
        }

       

        .conatiner2 {

            overflow-y: auto;

            border: 1px solid #ccc;

        }

        .container2::-webkit-scrollbar {
            display: none;
        }

        thead {
            background-color: gray;
            position: sticky;
            top: -4px;
            bottom: 0;
            z-index: 1;
        }
        #customer-id{
            width:5vw;
        }
        .show_hide_cid,.show_hide_num{
            display:none;
            position:absolute;
            background-color: grey;
            color:white;
            padding:5px;
            border-radius: 2px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }
        .show_hide_num{
            font-size: 14px;
        }
        .cidtd:hover,.biltd:hover{
            cursor: pointer;
        }
        
        .summary{
            background-color: #f4f4f4;
            height:81vh;
            
        }
        .summary_head{
            width:100%;
            height:10%;
            display:flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            background-color: rgb(11, 10, 10);
        }
        .summary_head input{
            outline: none;
            border: none;
            border-bottom: 2px solid white;
            background-color: transparent;
            width:10vw;
            color:white;
        }
        .summary_head input[type="date"]::-webkit-calendar-picker-indicator {
            background-color: #FFC857; 
            border-radius: 50%;
            padding: 5px; 
        }
        .summary_head label{
            color:white;
            font-size: 15px;
        }
        .summary_head button{
            padding:5px;
            width:5vw;
            background-color: transparent;
            border:3px solid #FFC857;
            border-radius: 5px;
            color:#FFC857;
            cursor: pointer;
            font-weight: 600;
            width:10vw
        }
        .summary_head button:hover{
            background-color: #FFC857;
            color:white;
            border:3px solid #FFC857;
            transition: background-color 0.4s ease, color 0.4s ease;
        }
        .summary_table{
            width:70%;
            height:100%;
            display:flex;
            flex-direction: column;
            padding:10px;
        }
        .view_summary_history{
            width:30%;
            height:100%;
            padding:10px;
            background-color: #FFC857;
        }
        .s_table-container{
            overflow-y: auto;

            max-height: 90%;
        }
        .s_table{
            height:auto;
            margin-top: 5px;
        }
        .s_table th{
            font-size: 14px;
            background-color:#e4a300 ;
            color:#ffffff;
        }
        .s_tbody td {
            word-wrap: break-word; 
            word-break: break-all; 
            max-width: 150px;
            font-size: 12px;
            padding:4px;
        }
        .paidamount_value{
            width:50px;
        }
        button{
            cursor: pointer;
        }
        .sumamry_tabs{
            flex-direction: row;
            justify-content: space-between;
            display:flex;
            height:10%;
            display:none;
        }
        .sumamry_tabs button{
            background-color: black;
            width:50%;
            border:2px solid #FFC857;
            color:#FFC857;
            font-weight: 600;
            font-size: 18px;
        }
        .sumamry_tabs button:hover{
            background-color: white;
            color:#FFC857;
            transition: background-color 0.4s ease, color 0.4s ease;
        }
        .summary_body{
            /* border:2px solid white; */
            height:90%;
            overflow-y: auto;
            display:none;
        }
        .breakfast_list h3, .lunch_list h3, .dinner_list h3{
            background-color: black;
            color:white;
            margin:0px;
            font-size: 18px;
            padding:5px
        }
        .food_list{
            display:flex;
            flex-direction: column;
            height:100%;
            display:flex;
            width:100%;
            /* justify-content: center;
            align-items: center; */
        }
        .breakfast_list,.lunch_list,.dinner_list{
            /* flex-direction: column;
            display:flex; */
            height:30vh;
            /* border:2px solid black; */
            overflow-y: auto;
            font-size: 15px;
            background-color: rgba(255, 255, 255, 0.5);
            
        }
        .breakfast_list div, .lunch_list div, .dinner_list div{
            flex-direction: row;
            display:flex;
            justify-content: space-around;
            height:18%;
            text-align: center;
        }
        .breakfast_list div p,.lunch_list div p,.dinner_list div p{
            width:20%;
        }
        .breakfast_list h3,.lunch_list h3,.dinner_list h3{
            margin:0px;
            /* border:2px solid black; */
            background-color: black;
            color:white
        }
        .payment_list{
            /* border:2px solid black; */
            display:flex;
            flex-direction: column;
            align-items: center;
            overflow-y: auto;
            height:99%;
            display:none;
            width:100%;
        }
        .pd_amt{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;    
            width:100%;
            height:20%;
        }
        .pd_amt p{
            font-size: 18px;
            margin: 5px;
            width:13vw;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .pd_amt p span{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block; /* Ensure truncation applies */
        }
        .p_list{
            height:80%;
            width:100%;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }
        .p_list div{
            display:flex;
            flex-direction: row;
            width:99%;
            justify-content: space-around;
            align-items: center;
            height:20px;
            font-size: 14px;
        }
        .p_list div p{
            width:100px;
        }
        .pd_amt{
            background-color: rgba(255, 255, 255, 0.5);
        }
        .pd_amt p{
            font-size: 14px;
        }
        .headplist{
            /* border:2px solid black; */
            background-color: black;
            color:white;
            width:100%;
            position: sticky;
            z-index: 1000;
            top:0px;
        }
        .pay_list_divs:nth-child(even){
            background-color: white;
        }
        .pay_list_divs:nth-child(odd){
           background-color:  rgb(195, 178, 178);
        }
        




        /* .sumamry_tabs{
            
        } */
    </style>

</head>

<body>
    <div class="main-container">
        <div class="header">
            <div class="header-box"><a href="register.php">Register</a></div>
            <div class="header-box" id="reports">Report</div>
            <div  class="header-box" id="subreports">Summary</div>
        </div>

        <div class="container">
            <div class="container1">
                <div class="form-row">
                    <div class="form-group">
                        <label for="customer-id">Customer Id:</label>
                        <input type="text" id="customer-id" placeholder="Enter Customer Id">
                    </div>
                    <div class="form-group">
                        <label for="from-date">From:</label>
                        <input type="date" id="from-date">
                    </div>
                    <div class="form-group">
                        <label for="to-date">To:</label>
                        <input type="date" id="to-date">
                    </div>
                    <div class="form-group">
                        <label for="periodicity">Periodicity:</label>
                        <select id="periodicity" class="payment_period">
                        <option value="">Select Periodicity</option>
                                                        <!-- <option value="daily">Daily</option>
                            <option value="monthly">Monthly</option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="foodtype">Foodtype :</label>
                        <select class="foodtype">
                                 <option value="">Select Foodtype</option>
 
                        </select>
                    </div>
                    <button id="#fetch-report-btn" onclick="reportdetails(event)">Fetch Report</button>
                </div>
            </div>
            <div class="container2">
                <table id="report-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Delivery Number</th>
                            <th>Email</th>
                            <th>OrderDate</th>
                            <th>Periodicity</th>
                            <th>Breakfast</th>
                            <th>Lunch</th>
                            <th>Dinner</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody class="report_tbody">

                    </tbody>

                </table>
            </div>
        </div>


        <div class="summary">
            <div class="summary_table">
                <div class="summary_head">
                    <div>
                    <label>Customer ID:</label>
                    <input type="text" placeholder="Enter customer ID" id="customer_id">
                    </div>
                    <div>
                    <label>From Date:</label>
                    <input type="date" id="s_fromdate">
                    </div>
                    <div>
                    <label>To Date:</label>
                    <input type="date" id="s_todate">
                    </div>
                    <button onclick="monthly_summary()">Submit</button>
                </div>
                <div class="s_table-container">
                    <table class="s_table">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Billing Number</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Paid Amount</th>
                                <th>Pending Amount</th>
                                <th>Total Amount</th>
                                <th>Edit Amount</th>
                                <th></th>
                                <th></th>
                            </tr>
                            
                            
                        </thead>
                        <tbody class="s_tbody">
                            <!-- Add as many rows as needed -->
                            
                            
                            <!-- Repeat rows for demonstration -->
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="view_summary_history">
                <div class="sumamry_tabs">
                    <button class="orders_history">Orders history</button>
                    <button class="payments_history">Payments history</button>
                </div>

                <div class="summary_body">
                    <div class="food_list">
                        <div class="breakfast_list">
                            <h3>BreakFast</h3>
                        </div>

                        <div class="lunch_list">
                            <h3>Lunch</h3>
                        </div>

                        <div class="dinner_list">
                            <h3>Dinner</h3>
                        </div>
                    </div>

                    <div class="payment_list">
                        <div class="pd_amt">
                            <div class="personal_details">
                            
                            </div>
                            <div class="amount_details">
                            
                            </div>
                        </div> 
                        <div class="p_list">
                        
                        </div>
                    </div> 
                </div>
            </div>
            

        </div>
    </div>

    
    <!-- view summary -->
    <!-- <div class="view_summary_wrapper">
    <div class="view_summary">
        <div class="sumamry_tabs">
            <button class="orders_history">Orders history</button>
            <button class="payments_history">Payments history</button>
            <i class="fa-regular fa-circle-xmark"></i>
        </div>

        <div class="food_list">
            <div class="breakfast_list">
                <h3>BreakFast</h3>
            </div>

            <div class="lunch_list">
                <h3>Lunch</h3>
            </div>

            <div class="dinner_list">
                <h3>Dinner</h3>
            </div>
        </div>

        <div class="payment_list">
            <div class="pd_amt">
                <div class="personal_details">
                  
                </div>
                <div class="amount_details">
                   
                </div>
            </div> 
            <div class="p_list">
                    
            </div>
        </div> 

    </div> 
</div>  -->

<script>
    let billingnumber;
    let cidno;
    let status = [];
    let subreports = document.querySelector('#subreports');
    let reports = document.querySelector('#reports');
    let previous_paid_amount;
    const summary_wrapper = document.querySelector('.view_summary_wrapper');
    
      
//date format function
function date_format(date) {
    console.log('date:', date);

    const d_date = new Date(date);

    // Extract day, month, and year
    const day = d_date.getDate().toString().padStart(2, '0'); 
    const month = (d_date.getMonth() + 1).toString().padStart(2, '0');
    const year = d_date.getFullYear();

    // Format the date as DD-MM-YYYY
    return `${day}-${month}-${year}`;
}


    




//closing sumamry
// document.querySelector('.fa-circle-xmark').addEventListener('click',()=>{
//     document.querySelector('.view_summary_wrapper').style.display = "none";
//     document.querySelector('.food_list').style.display = "none";
//     document.querySelector('.payment_list').style.display = "none";
// })

// summary_wrapper.addEventListener('click', (event) => {
//   if (event.target === summary_wrapper) {
//     summary_wrapper.style.display = 'none';
//     document.querySelector('.payment_list').style.display = "none";
//     document.querySelector('.food_list').style.display = "none";
//   }
// });

// // Example: Show the food_list div on some action
// document.querySelector('.some-button').addEventListener('click', () => {
//     const foodList = document.getElementById('foodList');
//     foodList.style.display = 'flex'; // Show the div when required
// });





//orders history
function viewHistory(cid,psno,name,fd,td,tamt,piamt,peamt,clickedButton ){
    // document.querySelector('.view_summary_wrapper').style.display = "flex";
 
    let summarytabs = document.querySelector('.sumamry_tabs');
    let allButtons = document.querySelectorAll('.view_history');

    document.querySelector('.payment_list').style.display = "none";
    document.querySelector('.food_list').style.display = "none";
   
    allButtons.forEach(x=>{
        if(x === clickedButton){
            if(x.innerHTML.includes("fa-eye-slash")){
                x.innerHTML = `<i class="fa-solid fa-eye fa-beat-fade"></i>`;
                summarytabs.style.display = "none";
            }
            else{
                x.innerHTML = `<i class="fa-solid fa-eye-slash fa-beat-fade"></i>`;
                summarytabs.style.display = "flex";
            }
            
        }
        else{
            x.innerHTML = `<i class="fa-solid fa-eye fa-beat-fade"></i>`;
        }
    })

   



    // if (computedDisplay === "none") {
    //     summarytabs.style.display = "flex";
    //     viewHistory.innerHTML = `<i class="fa-solid fa-eye-slash fa-beat-fade"></i>`;
    // } else {
    //     summarytabs.style.display = "none";
    //     document.querySelector('.summary_body').style.display = "none";
    //     viewHistory.innerHTML = `<i class="fa-solid fa-eye fa-beat-fade"></i>`;
    //     return;
    // }


    let orderhistory = document.querySelector('.orders_history');
    let paymenthistory = document.querySelector('.payments_history')

    orderhistory.addEventListener('click',()=>{
        var payload = {
            customerid:cid,
            fromdate:document.querySelector('#s_fromdate').value,
            todate:document.querySelector('#s_todate').value,
            load:"orderHistory"
        }
        console.log("p",payload)
        $.ajax({
            type:"POST",
            url: "./webservices/reports.php",
            data: JSON.stringify(payload),
            dataType:"json",
            success: function (response) {
            console.log(response);

            document.querySelector('.payment_list').style.display = "none";
            document.querySelector('.food_list').style.display = "flex";
            document.querySelector('.summary_body').style.display = "flex";
            let breakfastlist = document.querySelector('.breakfast_list');
            let lunchlist = document.querySelector('.lunch_list');
            let dinnerlist = document.querySelector('.dinner_list');

    

            breakfastlist.innerHTML = "";
            lunchlist.innerHTML = "";
            dinnerlist.innerHTML = "";
         // Clear previous data if necessary
            breakfastlist.innerHTML = `<h3>BreakFast</h3>
                <div>
                    <p><b>Date</b></p>
                    <p><b>Item</b></p>
                    <p><b>Quantity</b></p>
                    <p><b>Amount</b></p>
                </div>`;
            lunchlist.innerHTML = `<h3>Lunch</h3>
                <div>
                     <p><b>Date</b></p>
                    <p><b>Item</b></p>
                    <p><b>Quantity</b></p>
                    <p><b>Amount</b></p>
                </div>`;
            dinnerlist.innerHTML = `<h3>Dinner</h3>
                <div>
                    <p><b>Date</b></p>
                    <p><b>Item</b></p>
                    <p><b>Quantity</b></p>
                    <p><b>Amount</b></p>
                </div>`;

            // Process the response data
            response.data.forEach((itm) => {
                let divele = document.createElement('div');
                divele.innerHTML = `
                    <p>${itm.OrderDate}</p>
                    <p>${itm.ItemName}</p>
                    <p>${itm.Quantity}</p>
                    <p>${itm.TotalAmount}</p>
                `;

                if (itm.type === "breakfast") {
                    breakfastlist.appendChild(divele);
                } else if (itm.type === "lunch") {
                    lunchlist.appendChild(divele);
                } else if (itm.type === "dinner") {
                    dinnerlist.appendChild(divele);
                }
            });
        },
        error:function(err){
            console.log(err);
        }
        })
    })


    //viewhistory of payment
    paymenthistory.addEventListener('click',()=>{
        document.querySelector('.payment_list').style.display = "flex";
        document.querySelector('.food_list').style.display = "none";
        document.querySelector('.summary_body').style.display = "flex";
        let personaldetails = document.querySelector('.personal_details');
        let amountdetails = document.querySelector('.amount_details');
        let plist = document.querySelector('.p_list');
        personaldetails.innerHTML = `
            <p><b>Name:</b><span>${name}</span></p>
            <p><b>From Date:</b><span>${date_format(fd)}</span></p>
            <p><b>To Date:</b><span>${date_format(td)}</span></p>
        `
        amountdetails.innerHTML = `
            <p><b>Total Amount:</b><span>${tamt}</span></p>
            <p><b>Paid Amount:</b><span>${piamt}</span></p>
            <p><b>Pending Amount:</b><span>${peamt}</span></p>
        `

        var payload = {
            customerid:cid,
            paymentsno:psno,
            fromdate:document.querySelector('#s_fromdate').value,
            todate:document.querySelector('#s_todate').value,
            load:"paymenthistory"
        }

        $.ajax({
            type:"POST",
            url: "./webservices/reports.php",
            data: JSON.stringify(payload),
            dataType:"json",
            success:function(response){
                console.log("responseplist",response)
                plist.innerHTML = "";
                plist.innerHTML = `
                    <div class="headplist">
                        <p><b>Paid Date</b></p>
                        <p><b>Paid Amount</b></p>
                    </div>
                
                `

                if(response.data.length > 0){
                    response.data.forEach(itm=>{
                        let divele = document.createElement('div');
                        divele.classList.add('pay_list_divs')
                        divele.innerHTML = `
                            <p>${itm.paid_date}</p>
                            <p>${itm.paid_amount}</p>
                        `;
                        plist.appendChild(divele);
                    })
                }
            },
            error:function(err){
                console.log(err);
            }
        })
    })
}



reports.addEventListener('click',()=>{
    document.querySelector('.container').style.display = "flex";
    document.querySelector('.summary').style.display = "none";
})


subreports.addEventListener('click',()=>{
   document.querySelector('.container').style.display = "none";
   document.querySelector('.summary').style.display = "flex";

   let today = new Date();

   console.log("today",today);
   const firstdate = new Date(Date.UTC(today.getFullYear(), today.getMonth(), 1));
   const lastdate = new Date(Date.UTC(today.getFullYear(), today.getMonth() + 1, 0));

   const firstdateStr = firstdate.toISOString().split('T')[0];
   const lastdateStr = lastdate.toISOString().split('T')[0];

   const fromDateInput = document.querySelector('#s_fromdate');
    const toDateInput = document.querySelector('#s_todate');

    document.querySelector('#s_fromdate').setAttribute('min', firstdateStr);
    document.querySelector('#s_fromdate').setAttribute('value', firstdateStr); 

    document.querySelector('#s_todate').setAttribute('max', lastdateStr);
    document.querySelector('#s_todate').setAttribute('value', lastdateStr);

})


function monthly_summary(){
    document.querySelector('.sumamry_tabs').style.display = "none";
    document.querySelector('.payment_list').style.display = "none";
            document.querySelector('.food_list').style.display = "none";
    var payload = {
        load:"loadpayments",
        customerid:document.querySelector('#customer_id').value,
        fromdate:document.querySelector('#s_fromdate').value,
        todate:document.querySelector('#s_todate').value 
    }

    console.log("ms",payload);

    $.ajax({
        type: "POST",
        url: "./webservices/reports.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success:function(response){
            console.log(response);
            if(response.data !== "NO DATA"){
                document.querySelector('.s_table').style.display = "inline-table";
                let s_tbody = document.querySelector('.s_tbody');
                s_tbody.innerHTML = "";
                response.data.forEach((dt)=>{
                let trow = document.createElement('tr');

                trow.innerHTML = `
                <td data-cid="${dt.customer_id}" data-psno="${dt.sno}" class="customer_name">${dt.CustomerName}</td>
                <td>${dt.Email}</td>
                <td>${dt.Phone2}</td>
                <td class="p_fromdate" data-fromdate="${dt.from_date}">${date_format(dt.from_date)}</td>
                <td class="p_todate" data-todate="${dt.to_date}">${date_format(dt.to_date)}</td>
                <td data-initial-value="${dt.paid_amount}" class="previous_paid_amount">${dt.paid_amount}</td>
                <td>${dt.unpaid_amount}</td>
                <td>${dt.total_amount}</td>
                <td><input type="number"  oninput="payment_input(event)" class="paidamount_value"></td>
                <td><button onclick="payment_update(event)" class="payment_update_btn" disabled>
                <i class="fa-solid fa-pen-to-square fa-beat-fade"></i>
                </button></td>    
                <td><button class="view_history" onclick="viewHistory('${dt.customer_id}', '${dt.sno}', '${dt.CustomerName}', 
                '${dt.from_date}', '${dt.to_date}', '${dt.total_amount}', '${dt.paid_amount}', '${dt.unpaid_amount}',this)">
               <i class="fa-solid fa-eye fa-beat-fade"></i></button></td>    
                `
                s_tbody.appendChild(trow);
            })
            }
            else{
                alert("No data")
            }
           
        },
        error:function(err){
            console.log(err);
        }
  
    })
}

//function for store the previous value and enable the btn
function payment_input(event){
    const trow = event.target.closest('tr'); 
    const editButton = trow.querySelector('.payment_update_btn');
    previous_paid_amount = trow.querySelector('.previous_paid_amount').dataset.initialValue;

    paidamountinput = trow.querySelector('.paidamount_value').value;
     if(paidamountinput === ""){
        editButton.disabled = true;
    }
    else{
        editButton.disabled = false;
    }
    
}

//payment update btn
function payment_update(event){
    const ptrow = event.target.closest('tr'); 
    let new_value = ptrow.querySelector('.paidamount_value').value;
    let todaydate = new Date();

    console.log(previous_paid_amount,'pp')

    if(previous_paid_amount === new_value){
        alert("No changes in paid amount field")
        return;
    }
    else{

        let confirmstatus = confirm(`Do you update the paid amount of customer:${ptrow.querySelector('.customer_name').textContent}`);

        if(!confirmstatus){
            return;
        }


        console.log(parseInt(previous_paid_amount) + parseInt(new_value));

       var payload = {
         previouspaid_amount:previous_paid_amount,
         new_value:new_value,
         paid_amount:parseInt(previous_paid_amount) + parseInt(new_value),
         customerid:ptrow.querySelector('.customer_name').dataset.cid,
         paymentsno:ptrow.querySelector('.customer_name').dataset.psno,
         fromdate:ptrow.querySelector('.p_fromdate').dataset.fromdate,
         todate:ptrow.querySelector('.p_todate').dataset.todate,
         load:"update_payment",
         todaydate:todaydate.toISOString().split('T')[0]
       }

       console.log("update",payload);

       $.ajax({
        type:"POST",
        url: "./webservices/reports.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success:function(response){
            console.log(response);
            if(response.status == "Success"){
                alert("Successfully Updated")
            }
            else{
                alert("NO updated")
            }
        },
        error:function(err){
            console.log(err);
            alert("Something wrong")
        }
       })
    }

}




//function reports
function reportdetails(){
    let fromDate = $("#from-date").val();
    let toDate = $("#to-date").val();
    let od;
    let periodicity = document.querySelector('#periodicity').value
    let foodtype = document.querySelector('.foodtype').value
    let actualstatus;

  //  if(!foodtype){
    //    alert("Please select the foodtype")
   //     return "";
    // }

    var payload = {
        load:"load_report",
        todate:toDate,
        fromdate:fromDate,
        periodicity:periodicity,
        customerid:document.getElementById('customer-id').value,
        foodtype:foodtype
    }
    console.log("report",payload);

    $.ajax({
        type: "POST",
        url: "./webservices/reports.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success:function(response){
            console.log(response)
            if(response.status === "Success"){
                let reporttbody = document.querySelector('.report_tbody');
                reporttbody.innerHTML = "";
                response.data.forEach(dt =>{
                    // let bgclr = (dt.status === "2") ? "green" : "#F05050";
                    if(dt.CustomerID === null){
                        alert("No Data Found");
                        return "";
                    }
                    let od = (periodicity === '1') ? dt.OrderDate : dt.OrderDate;
                    let filteredStatus = status.filter(sts => sts.sno !== "0");
                    
                    let actualstatus = `
                    <select class="orderstatus" 
                    onchange="updateStatus(this, '${dt.CustomerID}', '${dt.mail}', '${dt.name}', '${od}')">
                    ${filteredStatus.map(sts => `
                        <option value="${sts.sno}" ${sts.status === dt.status ? 'selected' : ''}>
                            ${sts.status}
                        </option>`).join('')}
                    </select>
                    `;

                    let trow = document.createElement('tr');
                    // trow.style.backgroundColor = bgclr;
                    trow.innerHTML = `
                   
                    <td class="cidtd" onmouseover="show_cid(this, '${dt.CustomerID}')"  onmouseout="hide_cid(this, '${dt.CustomerID}')">
                    ${dt.name}<br><span class="show_hide_cid">id:${dt.CustomerID}</span></td>

                    <td>${dt.DeliveryNumber}</td>

                    <td class="biltd" onmouseover="show_num(this, '${dt.BillingNumber}')"  onmouseout="hide_num(this, '${dt.BillingNumber}')">
                    ${dt.mail}<br/><span class="show_hide_num">BillingNumber:<br/>${dt.BillingNumber}</span></td>
                    <td>${od}</td>
                        <td>${dt.periodicity}</td>
                        <td>${dt.breakfast}</td>
                        <td>${dt.lunch}</td>
                            <td>${dt.dinner}</td>
                            <td>${dt.totalamount}</td>
                            <td>${actualstatus}</td>
                            <td class="icon-links">
                                    <a href="https://wa.me/${dt.BillingNumber}" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp" style="color: green;"></i></a>
                                    <a href="mailto:${dt.mail}" target="_blank" title="Email"><i class="fas fa-envelope" style="color: blue;"></i></a>
                                </td>
                    `
                    reporttbody.appendChild(trow);
                 })
            }
            else{
                alert("No Data Found")
            }
        }
        ,
        error:function(err){
            console.log(err);
        }
    })

}

function show_cid(x,cid){
    const span = x.querySelector('span');
    span.style.display = "block";
}
function hide_cid(x,cid){
    const span = x.querySelector('span');
    span.style.display = "none";
}
function show_num(x,num){
     const span = x.querySelector('span');
    span.style.display = "block";
}
function hide_num(x,num){
    const span = x.querySelector('span');
    span.style.display = "none";
}

function loadperiodicity(){

var payload = {
    load:"loadperiodicity"
}

$.ajax({
    type: "POST",
    url: "./webservices/register.php",
    data: JSON.stringify(payload),
    dataType: "json",
    success:function(response){
        if(response.status === "Success"){
            periodarr = response.data;
            console.log(periodarr);
            let selectElement = document.querySelector('.payment_period');  
            let selectperiod = document.getElementById('selectionperiod')
            // selectElement.innerHTML = "<option>select</option>";
            periodarr.forEach(per=>{
                const option = document.createElement('option');
                option.value = per.sno;
                option.textContent = per.period;
                
                // Append the option to the select element
                selectElement.appendChild(option);
            })
            console.log(selectElement);
            
        }
    },
    error:function(err){
        console.log(err);
    }
})

}
loadperiodicity();



//load todate fromdate
function load_fromdate_todate(){
    const today = new Date();
    const formattedDate = today.toISOString().split('T')[0];
    console.log(formattedDate);

    const weekBackDate = new Date(formattedDate);
    weekBackDate.setDate(today.getDate() - 7);
    const formatedweekbackdate = weekBackDate.toISOString().split('T')[0];

    document.getElementById('from-date').value = formattedDate;
    document.getElementById('to-date').value = formattedDate;


    // weekBackDate.setDate(today.getDate() - 7); // Subtract 7 days
    // const formattedWeekBackDate = weekBackDate.toISOString().split('T')[0];

    // console.log(weekBackDate)
}
load_fromdate_todate();

//function for load foodtype
function load_foodType(){
    
    var payload = {
        load:"load_foodtype"
    }
    $.ajax({
        type: "POST",
        url: "./webservices/reports.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success:function(response){
            if(response.status === "Success"){
                let foodtype = document.querySelector('.foodtype');
                response.data.forEach(fd=>{
                    const option = document.createElement('option');
                    option.value = fd.sno;
                    option.textContent = fd.type;
                
                // Append the option to the select element
                foodtype.appendChild(option);
                })

            }
        },
        error:function(err){
            console.log(err);
            alert("something error try again later")
        }
    })
}
load_foodType();


//function for loadstatus
function load_status(){
    var payload = {
        load:"load_status"
    }
    $.ajax({
         type: "POST",
        url: "./webservices/reports.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success:function(response){
           status = response.data;
        },
        error:function(err){
            console.log(err);
        }
    
    })
}
load_status();

//update status
function updateStatus(th,cid,mail,name,od){
    let foodtype = document.querySelector('.foodtype');
    let foodtypetxt = foodtype.options[foodtype.selectedIndex].text;
    let foodtypevalue = foodtype.value;
    let orderstatus = document.querySelector('.orderstatus');
    let result = confirm(`Are you sure you want to change the status of${name}`);
    if (result) {

    } else {
        console.log(intialvalue);
       document.querySelector('.orderstatus').value = "1";
       return "";
    }

    var payload = {
        email:mail,
        load:"send_completed",
        customerid:cid,
        foodtypetxt:foodtypetxt,
        foodtypevalue:foodtypevalue,
        customername:name,
        orderdate:od,
        status:th.value
    }
    console.log("updatestatus",payload);
    $.ajax({
        type: "POST",
        url: "./webservices/reports.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success:function(response){
            console.log(response)
           if(response.status === "Success"){
            alert("Successfully Updated")
           }
        },
        error:function(err){
            alert("Something wrong")
            console.log(err)
        }
    })
}


    </script>

</body>

</html>
let billingnumber;
let cidno;
let status = [];
let subreports = document.querySelector('#subreports');
let reports = document.querySelector('#reports');
let previous_paid_amount;
const summary_wrapper = document.querySelector('.view_summary_wrapper');
let selectedmonth = document.querySelector('#selected_month');
let [year,month] = [];
let months = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
let orderhistory = document.querySelector('.orders_history');
let paymenthistory = document.querySelector('.payments_history')
let customerid;
let paymentsno;
let customername;
let fromdate;
let todate;
let paidamount;
let pendingamount;
let totalamount;
let pending_months_span = document.querySelectorAll('.pending_months span:nth-child(n+2)');
let infocircle;
let allreports = document.querySelector('#allreport');
let statusOptions = [];







const yearSelect = document.getElementById("yearSelect");
const currentYear = new Date().getFullYear();

//dropdown of year
for (let i = currentYear; i >= 2020; i--) {
    let option = document.createElement("option");
    option.value = i;
    option.text = i;
    yearSelect.appendChild(option);
}

yearSelect.addEventListener('change',()=>{
    pendingmonths();
})




function togetMonth(index){
    return months[index -1];
}

function todayordersummary(){
var payload = {
    load:"todayordersummary"
}
$.ajax({
    type:"POST",
    url: "./webservices/reports.php",
    data: JSON.stringify(payload),
    dataType:"json",
    success:function(response){
        console.log("today order summary",response)
        let tos = document.querySelector('.pending_delivery');
        tos.innerHTML = "";
        if(response.data.length > 0){
            tos.innerHTML = `
            <div><img src="./images/idly.png" height="30px" width="30px">BreakFast:<span>${response.data[0]['bf'] || 0}</span></div>
            <div><img src="./images/meal.png" height="30px" width="30px">Lunch:<span>${response.data[0]['lunch'] || 0}</span></div>
           <div><img src="./images/dosa.png" height="30px" width="30px">Dinner:<span>${response.data[0]['Dinner'] || 0}</span></div>
            <div><img src="./images/total.png" height="25px" width="25px">TotalOrders:<span>
                ${parseInt(response.data[0]['bf'] || 0) +
                parseInt(response.data[0]['lunch'] || 0) +
                parseInt(response.data[0]['Dinner'] || 0)}
            </span></div>

          <div><img id="movingImage" src="./images/delivery.png" height="30px" width="30px">Delivered:<span>${response.data[0]['Delivered'] || 0}</span></div>
           <div><img id="scalingpending" src="./images/Pending.png" height="25px" width="25px">Pending:<span>${response.data[0]['Pending'] || 0}</span></div>   `
        }
    },
    error:function(err){
        console.log(err);
        alert("something wrong")
    }
    
})
}
todayordersummary();


let scaleUp = true;
setInterval(() => {
    const image = document.getElementById('scalingpending');
    if (scaleUp) {
        image.style.transform = 'scale(1.1)';
    } else {
        image.style.transform = 'scale(.8)';
    }
    scaleUp = !scaleUp;
}, 800);


selectedmonth.addEventListener('change',()=>{
let monthyear = selectedmonth.value;
let todaymonthyear = new Date().toISOString().split('T')[0];

[year,month] = monthyear.split('-');
let [tyear,tmonth,tdate] = todaymonthyear.split('-');

let firstday = `${year}-${month}-01`;
let lastDayDate = new Date(year, month, 0);
let lastDay = `${year}-${month}-${lastDayDate.getDate()}`

// console.log("fromdate",firstday);
// console.log("lastdate",lastDay);

// console.log("year->",year,"month->",month,"tyear->",tyear,"tmonth->",tmonth);
console.log(year !== tyear && month !== tmonth);

console.log("selected",monthyear);
console.log("firstdate",`${year}-${month}-01`);
console.log("lastdate",`${year}-${month}-${lastDayDate.getDate()}`);

document.querySelector('#s_fromdate').setAttribute('min', firstday);
document.querySelector('#s_fromdate').setAttribute('value', firstday); 

document.querySelector('#s_todate').setAttribute('max', lastDay);
document.querySelector('#s_todate').setAttribute('value', lastDay);

// if(year !== tyear && month !== tmonth){
//     document.querySelector('#s_todate').setAttribute('max', lastDay);
//     document.querySelector('#s_todate').setAttribute('value', lastDay);
// }
// else{
//     document.querySelector('#s_todate').setAttribute('max', todaymonthyear);
//     document.querySelector('#s_todate').setAttribute('value', todaymonthyear);
// }
// document.querySelector('#s_fromdate').setAttribute('min', firstday);
// document.querySelector('#s_fromdate').setAttribute('value', firstday); 


})

  
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

//another date formation starting with year
function year_date_format(date) {
    console.log('date:', date);
    
    const d_date = new Date(date);
    
    // Extract day, month, and year
    const day = d_date.getDate().toString().padStart(2, '0'); 
    const month = (d_date.getMonth() + 1).toString().padStart(2, '0');
    const year = d_date.getFullYear();
    
    // Format the date as DD-MM-YYYY
    return `${year}-${month}-${day}`;
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
customerid = cid;
paymentsno = psno;
customername = name;
totalamount = tamt;
fromdate = fd;
todate = td;
paidamount = piamt;
pendingamount = peamt;

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
}

orderhistory.addEventListener('click',()=>{
    console.log("customerid------>",customerid);
    let bfamount = 0;
    let lnamount = 0;
    let dnamount = 0;
    var payload = {
        customerid:customerid,
        fromdate:document.querySelector('#s_fromdate').value,
        todate:document.querySelector('#s_todate').value,
        load:"orderHistory"
    }
    console.log("orderhistory",payload)
    $.ajax({
        type:"POST",
        url: "./webservices/reports.php",
        data: JSON.stringify(payload),
        dataType:"json",
        success: function (response) {
        console.log("viehistory",response);

        document.querySelector('.payment_list').style.display = "none";
        document.querySelector('.food_list').style.display = "flex";
        document.querySelector('.summary_body').style.display = "flex";

        let foodList = document.querySelector('.food_list');
        
        // Clear any existing content
        foodList.innerHTML = "";
        let sections = {};
        let totalAmounts = {};

        response.data.forEach(itm => {
            if (!sections[itm.type]) {
                let sectionDiv = document.createElement('div');
                sectionDiv.classList.add(`${itm.type}_list`);
                sectionDiv.classList.add('order_item_list')
                sectionDiv.innerHTML = `<h3>${itm.type.charAt(0).toUpperCase() + itm.type.slice(1)} <span class="${itm.type}_amount">0</span></h3>`;
                
                let tableHeader = document.createElement('div');
                tableHeader.innerHTML = `
                    <p><b>Date</b></p>
                
                    <p><b>SC</b></p>
                    <p><b>Q</b></p>
                    <p><b>₹</b></p>
                    <p><b>info</b></p>
                `;
                sectionDiv.appendChild(tableHeader);
                
                foodList.appendChild(sectionDiv);
                sections[itm.type] = sectionDiv;

                totalAmounts[itm.type] = 0;

            }
        });


         // Step 2: Populate the sections with data
         response.data.forEach(itm => {
            let rowDiv = document.createElement('div');
            rowDiv.innerHTML = `
                <p>${itm.OrderDate}</p>
              
                <p>${itm.subcategory}</p>
                <p>${itm.Quantity}</p>
                <p>${itm.TotalAmount}</p>
                <p><i class="fa-solid fa-circle-info" onmouseover="checkfooditems('${itm.OrderDate}','${itm.type}','${itm.ItemName}',this)"></i></p>
            `;

            sections[itm.type].appendChild(rowDiv);

            // Update total amounts
            totalAmounts[itm.type] += parseInt(itm.TotalAmount);
            document.querySelector(`.${itm.type}_amount`).textContent = totalAmounts[itm.type];
        });

        // Step 3: Add Total Amount Footer
        let totalAmountFooter = document.createElement('div');
        totalAmountFooter.classList.add('total_amount_footer');

        let totalAmount = Object.values(totalAmounts).reduce((sum, amount) => sum + amount, 0);
        totalAmountFooter.innerHTML = `<h3>Total Amount: <span>${totalAmount}</span></h3>`;
        foodList.appendChild(totalAmountFooter);

    },
    error:function(err){
        console.log(err);
    }
    })
})

async function checkfooditems(orderdate,foodtype,Itemname,thisinfo){
    console.log(Itemname);
    let parentElement = thisinfo.parentElement; // Declare first
    
    // Remove existing popup if present
    let existingDiv = parentElement.querySelector('.custom-popup');
    if (existingDiv) {
        existingDiv.remove();
    }
    
    let cdiv = document.createElement('div');
    cdiv.classList.add('custom-popup'); // Add a class for easy identification
    
    parentElement.style.position = "relative";
    
    cdiv.style.width = "20vw";
    cdiv.style.height = "auto";
    cdiv.style.position = "absolute";
    cdiv.style.border = "2px solid black";
    cdiv.style.left = "-40vh";
    cdiv.style.top = "0px";
    cdiv.style.backgroundColor = "white";
    cdiv.style.display = "none";
    cdiv.style.flexDirection = "column";
    cdiv.style.overflowY = "auto";
    
    // if (foodtype.toLowerCase().trim() === "lunch") {
        if (Itemname.toLowerCase().trim() === "curryset") {         
            let response = await currySetItems(orderdate, foodtype);
            console.log("data", response);
            if (response.data.length > 0) {
                response.data.forEach(itm => {
                    let p = document.createElement('p');
                    p.classList.add("currysetlist")
                    p.style.margin = "5px 0";
                    p.style.width = "100%";
                    cdiv.style.top = "-100px";
                    p.innerHTML = `<span><b>${itm.subcategory}</b></span><span>${itm.ItemName}</span>`;
                    cdiv.appendChild(p);
                });
                parentElement.appendChild(cdiv); // Append first
                cdiv.style.display = "flex"; // Then display it
            }
        // }
    } else {
        let p = document.createElement('p');
        p.style.margin = "5px 0";
        p.style.width = "100%";
        p.textContent = Itemname;
        cdiv.appendChild(p);
        parentElement.appendChild(cdiv);
        cdiv.style.display = "flex";
    }
    
    thisinfo.addEventListener('mouseleave', () => {
        cdiv.style.display = "none";
    });
    

}

async function currySetItems(od,foodtype){
    let tablename = foodtype+"schedule";
    tablename = tablename.trim();
    return new Promise((resolve,reject) =>{

   
    var payload = {
        load:"checkcurrysetitems",
        orderdate:od,
        tablename:tablename
    }

    console.log("payload",payload);
    $.ajax({
        type:"POST",
        url: "./webservices/reports.php",
        data: JSON.stringify(payload),
        dataType:"json",
        success:function(response){
            resolve(response);
        },
        error:function(err){
            console.log("error to fetch lunch items",err);
            reject(err);

        }
    })
    })
}


paymenthistory.addEventListener('click',()=>{
    document.querySelector('.payment_list').style.display = "flex";
    document.querySelector('.food_list').style.display = "none";
    document.querySelector('.summary_body').style.display = "flex";
    let personaldetails = document.querySelector('.personal_details');
    let amountdetails = document.querySelector('.amount_details');
    let plist = document.querySelector('.p_list');
    personaldetails.innerHTML = `
        <p><b>Name:</b><span>${customername}</span></p>
        <p><b>From Date:</b><span>${date_format(fromdate)}</span></p>
        <p><b>To Date:</b><span>${date_format(todate)}</span></p>
    `
    amountdetails.innerHTML = `
        <p><b>Total Amount:</b><span>${totalamount}</span></p>
        <p><b>Paid Amount:</b><span>${paidamount}</span></p>
        <p><b>Pending Amount:</b><span>${pendingamount}</span></p>
    `

    var payload = {
        customerid:customerid,
        paymentsno:paymentsno,
        fromdate:document.querySelector('#s_fromdate').value,
        todate:document.querySelector('#s_todate').value,
        load:"paymenthistory"
    }
    console.log("paymenthistory",payload);

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



reports.addEventListener('click',()=>{
document.querySelector('.container').style.display = "flex";
document.querySelector('.summary').style.display = "none";
let s_tbody = document.querySelector('.s_tbody');
s_tbody.innerHTML = "";
})


subreports.addEventListener('click',()=>{
document.querySelector('.container').style.display = "none";
document.querySelector('.summary').style.display = "flex";
document.querySelector('.pending_reports').style.display = "none";

let reporttbody = document.querySelector('.report_tbody');
reporttbody.innerHTML = "";

let today = new Date();
let todaydate = today.toISOString().split('T')[0]
let formattedDate = todaydate.slice(0, 7);
[year, month] = formattedDate.split('-');

console.log("today",today);
const firstdate = new Date(Date.UTC(today.getFullYear(), today.getMonth(), 1));
const lastdate = new Date(Date.UTC(today.getFullYear(), today.getMonth() + 1, 0));

const firstdateStr = firstdate.toISOString().split('T')[0];
const lastdateStr = lastdate.toISOString().split('T')[0];

const fromDateInput = document.querySelector('#s_fromdate');
const toDateInput = document.querySelector('#s_todate');

document.querySelector('#s_fromdate').setAttribute('min', firstdateStr);
document.querySelector('#s_fromdate').setAttribute('value', firstdateStr); 
selectedmonth.setAttribute('value',formattedDate)
selectedmonth.max = `${year}-${month}`

document.querySelector('#s_todate').setAttribute('max', todaydate);
document.querySelector('#s_todate').setAttribute('value', todaydate);

})

//find reports
function pendingreports(){
   document.querySelector('.s_table').style.display = "none";
   document.querySelector('.pending_reports').style.display = "flex";
   document.querySelector('.sumamry_tabs').style.display = "none";
   document.querySelector('.summary_body').style.display = "none";
   pendingmonths();

   //first date of the previous month
   let today = new Date();
//    let firstDayPrevMonth = new Date(today.getFullYear(), today.getMonth() - 1, 1);
   let todaydate = year_date_format(today);

   var payload = {
    todaydate:todaydate,
    load:"pendings"
   }
   console.log(payload);

   $.ajax({
        type: "POST",
        url: "./webservices/reports.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success:function(response){
            console.log(response);
            if(response.data.length > 0){
                
                let tbodyr = document.querySelector('.pending_months_report_body');
                tbodyr.innerHTML = "";

                response.data.forEach(itm=>{
                   let trrow = document.createElement('tr');
                   trrow.innerHTML = `
                    <td>${itm.CustomerName}</td>
                    <td>${itm.Email}</td>
                    <td>${itm.Billingnumber}</td>
                    <td>${itm.total_amount}</td>
                    <td>${itm.total_paid}</td>
                    <td>${itm.total_unpaid}</td>
                    <td><i onmouseover="displayinfo(${itm.CustomerID})" onmouseout="hideinfo(${itm.CustomerID})" class="fa-solid fa-circle-info fa-beat-fade"></i>
                    <div class="descinfo">
                        <div class="desctd">
                            <p>Month</p>
                            <p>Amount</p>
                            <p>Paid</p>
                            <p>Pending</p>
                        </div>
                        <div class="descbd">
                        
                        </div>
                    </div>
                    </td> 
                   `
                   tbodyr.appendChild(trrow);
                })
         


            }
            else{
                alert("No pending")
                let tbodyr = document.querySelector('.pending_months_report_body');
                tbodyr.innerHTML = ""
            }
        },
        error:function(err){
            alert("Something Wrong");
            console.log(err);
        }
   })
}

//allreports
allreports.addEventListener('click',(event)=>{
    pending_months_span.forEach(el => el.classList.remove("active"));
    yearSelect.value = currentYear;
    event.target.classList.add('active');
    console.log("d",event.target);
    pendingreports();
})



//circle info
function displayinfo(cid){
     var payload = {
        customerid:cid,
        load:"infopendings",
     }

     $.ajax({
        type: "POST",
        url: "./webservices/reports.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success:function(response){
            console.log(response);
            let descinfo = document.querySelector(`.descinfo`);
            descinfo.style.display = 'block';

            let descbd = document.querySelector('.descbd');
            descbd.innerHTML = "";
            response.data.forEach(itm=>{
                let pr = document.createElement('p');
                pr.innerHTML = `<span>${itm.monthyear}</span><span>${itm.total_amount}</span><span>${itm.paid_amount}</span><span>${itm.unpaid_amount}</span>`;
                descbd.appendChild(pr);
            })
        },
        error:function(err){
            alert("Somethig Error");
            console.log(err);
        }
     })
}
function hideinfo(cid){
    let descinfo = document.querySelector(`.descinfo`);
    descinfo.style.display = 'none';
}


//months
function pendingmonths(){
    let i = 0;
    let star
    pending_months_span.forEach(spn => {
        let todaydate = new Date();
        //this for ignore last span
        if(i < 12){
            spn.setAttribute('data-month',++i);
            spn.setAttribute('data-year',todaydate.getFullYear());
        }


       
        if(parseInt(spn.dataset.month) === parseInt(todaydate.getMonth() + 1)  && parseInt(spn.dataset.year) === parseInt(yearSelect.value)){  
            if(!spn.textContent.includes('*')){
                spn.textContent += "*";
            }
          
        } 
        else{
            console.log("else")
            spn.textContent = spn.textContent.replace(/\*/g, "");;
        }  
    });
}

//load pendingreport
function loadPendingMonthReport(tbtn){
    pending_months_span.forEach(el => el.classList.remove("active"));
    tbtn.classList.add('active');


    let fromdate = new Date(`${yearSelect.value}-${tbtn.dataset.month}-01`)
    let todate = new Date(fromdate.getFullYear(),fromdate.getMonth() + 1 , 1);

    fromdate = year_date_format(fromdate);
    todate = year_date_format(todate);

    let thismonth_status = tbtn.textContent.includes('*');
    // if(thismonth_status){
    //     todate = new Date();
    //     todate = year_date_format(todate);
    // }

    var payload = {
        load:"load_pending_month_report",
        fromdate:fromdate,
        todate:todate,
        thismonth:thismonth_status
    }


    $.ajax({
        type: "POST",
        url: "./webservices/reports.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success:function(response){
            console.log("months",response);
            if(response.data.length > 0){
             
                let tbodyr = document.querySelector('.pending_months_report_body');
                tbodyr.innerHTML = "";

                response.data.forEach(itm=>{
                   let trrow = document.createElement('tr');
                   trrow.innerHTML = `
                    <td>${itm.CustomerName}</td>
                    <td>${itm.Email}</td>
                    <td>${itm.Billingnumber}</td>
                    <td>${itm.total_amount}</td>
                    <td>${itm.total_paid}</td>
                    <td>${itm.total_unpaid}</td>
                    <td>-</i>
                    
                   `
                   tbodyr.appendChild(trrow);
                })
                infocircle = document.querySelector('.fa-circle-info');
            }
            else{
                alert("No pending")
                let tbodyr = document.querySelector('.pending_months_report_body');
                tbodyr.innerHTML = ""
            }
        },
        error:function(err){
            console.log(err);
        }
    })
}

   


//monthly summary
function monthly_summary(){
document.querySelector('.sumamry_tabs').style.display = "none";
document.querySelector('.payment_list').style.display = "none";
document.querySelector('.food_list').style.display = "none";
let totalpaid = document.querySelector('.totalpaid');
let totapending = document.querySelector('.totapending');
let totalamount = document.querySelector('.totalamount');
totalpaid.textContent = 0;
totapending.textContent = 0;
totalamount.textContent = 0;
let tp = 0;
let tpen = 0;
let ta = 0;


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
            document.querySelector('.pending_reports').style.display = "none";
            let s_tbody = document.querySelector('.s_tbody');
            s_tbody.innerHTML = "";
            response.data.forEach((dt)=>{
                console.log("Data => paid_amount:", dt.paid_amount, "total_amount:", dt.total_amount);
                const paid = Number(dt.paid_amount) || 0;
                const total = Number(dt.total_amount) || 0;
                
                
                tp += paid;
                tpen += (total - paid);
                ta += total;
                console.log("tp",total - paid,typeof(total));
               
            let disable = (dt.total_amount - dt.paid_amount === 0) ? "disabled" : "enabled";
            let trow = document.createElement('tr');

            // let paidamount = (dt.paid_amount === "")
            
            trow.innerHTML = `
            <td data-cid="${dt.customer_id}" data-psno="${dt.sno}" class="customer_name">${dt.CustomerName}</td>
            <td>${dt.Email}</td>
            <td>${dt.BillingNumber}</td>
            <td class="p_fromdate" data-fromdate="${payload.fromdate}">${date_format(payload.fromdate)}</td>
            <td class="p_todate" data-todate="${payload.todate}">${date_format(payload.todate)}</td>
            <td data-initial-value="${dt.paid_amount}" class="previous_paid_amount">${dt.paid_amount}</td>
            <td>${dt.total_amount - dt.paid_amount}</td>
            <td>${dt.total_amount}</td>
            <td class="related_month">${year}-${togetMonth(month)}</td>
            <td class="editamt_td"><input type="number"  oninput="payment_input(event)" class="paidamount_value" ${disable}><span><input type="date" class="calendar-only"></span></td>
            <td><button onclick="payment_update(event,${dt.total_amount - dt.paid_amount})" class="payment_update_btn" disabled>
            <i class="fa-solid fa-pen-to-square fa-beat-fade"></i>
            </button></td>    
            <td><button class="view_history" onclick="viewHistory('${dt.customer_id}', '${dt.sno}', '${dt.CustomerName}', 
            '${payload.fromdate}', '${payload.todate}', '${dt.total_amount}', '${dt.paid_amount}', '${dt.total_amount - dt.paid_amount}',this)">
           <i class="fa-solid fa-eye fa-beat-fade"></i></button></td>    
            `
            s_tbody.appendChild(trow);
        })
        totalpaid.textContent = tp;
        totapending.textContent = tpen;
        totalamount.textContent = ta;
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
function payment_update(event,pendingamount){

const ptrow = event.target.closest('tr'); 
let new_value = ptrow.querySelector('.paidamount_value').value;
let todaydate = new Date();

console.log(previous_paid_amount,'pp')

if(parseInt(pendingamount) < parseInt(new_value)){
    alert(`Inavlid Payment amount \nPending Amount: ${pendingamount} \nYou Entered:${new_value}`);
    return;
}

if(previous_paid_amount === new_value){
    alert("No changes in paid amount field")
    return;
}
else{

    let confirmstatus = confirm(`Do you update the paid amount of customer:${ptrow.querySelector('.customer_name').textContent}\namount:${new_value}`);
    let calendaronly = ptrow.querySelector('.calendar-only').value;

    if(!confirmstatus){
        return;
    }
    console.log("h",calendaronly);
    if(!calendaronly){
        alert("select the date also");
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
     relatedmonth:ptrow.querySelector('.related_month').textContent,
     todaydate:todaydate.toISOString().split('T')[0],
     paiddate:calendaronly
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
            monthly_summary();
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
let  fdtextvaluearr = [];
// let periodicity = document.querySelector('#periodicity').value
let foodtype = document.querySelector('.foodtype').value
let fdtext = document.querySelector('.foodtype')
fdtext = fdtext.options[fdtext.selectedIndex].text;
let actualstatus;

console.log(foodtype,"foodtype");

    if(foodtype === ""){
        for (let i = 1; i < document.querySelector('.foodtype').options.length; i++) {  // Skip "All" option (index 0)
            let option = document.querySelector('.foodtype').options[i];
            fdtextvaluearr.push({foodvalue:option.value,foodtext:option.text});
        }
    }


    if(!document.querySelector('.status').value){
        alert("Please select the Status")
        return "";
    }

    var payload = {
        load:"load_report",
        todate:toDate,
        fromdate:fromDate,
        // periodicity:periodicity,
        customerid:document.getElementById('customer-id').value,
        foodtype:foodtype,
        foodtext:fdtext,
        fdtextvaluearr:fdtextvaluearr,
        status:document.querySelector('.status').value
    }
    console.log("report",payload);

$.ajax({
    type: "POST",
    url: "./webservices/reports.php",
    data: JSON.stringify(payload),
    dataType: "json",
    success:function(response){
        console.log("report response",response)

        
        let reporttable = document.querySelector('#report-table');
        let report_thead = document.querySelector('.report_thead');
        let report_tbody = document.querySelector('.report_tbody');

        // Clear previous data
        report_thead.innerHTML = "";
        report_tbody.innerHTML = "";

        // Check if response has data
        if (!response.data || response.data.length === 0) {
            alert("No data available");
            return; // Exit if no data
        }

        let firstrecord = response.data[0];

        // Define case-insensitive keys to exclude
        let excludeKeys = ["customerid","billingnumber","statussno"];
        let headers = Object.keys(firstrecord).filter(key => !excludeKeys.includes(key.toLowerCase()));

        console.log(headers);

        // Create table header row
        let trhead = document.createElement('tr');
        headers.forEach(itm => {
            let th = document.createElement('th');
            th.textContent = itm;
            trhead.appendChild(th);
        });

        report_thead.appendChild(trhead);

        // Populate table body with data
        response.data.forEach(row => {
            console.log("r",row);
            let tr = document.createElement('tr');
            headers.forEach(key => {
                let td = document.createElement('td');
                if(key === "Status"){
                    let select = document.createElement("select");
                    select.className = "orderstatus";
                    if(foodtype === "" || row.StatusSno === "0" || row.StatusSno === "2"){
                        select.disabled = true;
                    }
                    select.setAttribute("onchange", `updateStatus(this, '${row.CustomerID}', '${row.Mail}', '${row.Name}', '${row.OrderDate}')`);
                    statusOptions.forEach(sts => {
                        let option = document.createElement("option");

                        option.value = sts.sno;
                        option.textContent = sts.status;
                        if (sts.status === row[key]) {
                            option.selected = true;
                        }
                        select.appendChild(option);
                    });

                    td.appendChild(select);
                }
                else{
                    td.textContent = row[key] || '-'; // Fallback for missing values
                }
                tr.appendChild(td);
               
            });
            report_tbody.appendChild(tr);
        });


        //body of report table
        





        // if(response.status === "Success"){
        //     let reporttbody = document.querySelector('.report_tbody');
        //     reporttbody.innerHTML = "";
        //     console.log("value",document.querySelector('.foodtype').value)
        //     response.data.forEach(dt =>{
        //         // let bgclr = (dt.status === "2") ? "green" : "#F05050";
        //         if(dt.CustomerID === null){
        //             alert("No Data Found");
        //             return "";
        //         }
        //         // let od = (periodicity === '1') ? dt.OrderDate : dt.OrderDate;
        //         let filteredStatus = status.filter(sts => sts.sno !== "0");
                
        //         let actualstatus = (!foodtype) ? `
        //         <select class="orderstatus" 
        //         onchange="updateStatus(this, '${dt.CustomerID}', '${dt.mail}', '${dt.name}', '${dt.OrderDate}')" disabled>
        //         ${filteredStatus.map(sts => `
        //             <option value="${sts.sno}" ${sts.status === dt.status ? 'selected' : ''}>
        //                 ${sts.status}
        //             </option>`).join('')}
        //         </select>
        //         `:
        //         `
        //         <select class="orderstatus" 
        //         onchange="updateStatus(this, '${dt.CustomerID}', '${dt.mail}', '${dt.name}', '${dt.OrderDate}')">
        //         ${filteredStatus.map(sts => `
        //             <option value="${sts.sno}" ${sts.status === dt.status ? 'selected' : ''}>
        //                 ${sts.status}
        //             </option>`).join('')}
        //         </select>
        //         `;

        //         let trow = document.createElement('tr');
        //         // trow.style.backgroundColor = bgclr;
        //         trow.innerHTML = `
               
        //         <td class="cidtd" onmouseover="show_cid(this, '${dt.CustomerID}')"  onmouseout="hide_cid(this, '${dt.CustomerID}')">
        //         ${dt.name}<br><span class="show_hide_cid">id:${dt.CustomerID}</span></td>

        //         <td>${dt.DeliveryNumber}</td>

        //         <td class="biltd" onmouseover="show_num(this, '${dt.BillingNumber}')"  onmouseout="hide_num(this, '${dt.BillingNumber}')">
        //         ${dt.mail}<br/><span class="show_hide_num">BillingNumber:<br/>${dt.BillingNumber}</span></td>
        //         <td>${dt.OrderDate}</td>
              
        //             <td>${dt.breakfast}</td>
        //             <td>${dt.lunch}</td>
        //                 <td>${dt.dinner}</td>
        //                 <td>${dt.totalamount}</td>
        //                 <td>${actualstatus}</td>
        //                 <td class="icon-links">
        //                         <a href="https://wa.me/${dt.BillingNumber}" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp" style="color: green;"></i></a>
        //                         <a href="mailto:${dt.mail}" target="_blank" title="Email"><i class="fas fa-envelope" style="color: blue;"></i></a>
        //                     </td>
        //         `
        //         reporttbody.appendChild(trow);
        //      })
        // }
        // else{
        //     alert("No Data Found")
        //     let reporttbody = document.querySelector('.report_tbody');
        //     reporttbody.innerHTML = "";
        // }
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
           foodtype.innerHTML = '<option value="">All</option>'
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
       let statusop = document.querySelector('.status')
       response.data.forEach(st=>{
        statusOptions.push({
            sno:st.sno,
            status:st.status
        })
        let options = document.createElement('option');
        options.text = st.status;
        options.value = st.sno
        statusop.appendChild(options);
       })
    },
    error:function(err){
        console.log(err);
        alert("Something wrong in loading status")
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
document.querySelector('.loader-overlay ').style.display = "flex";
document.querySelector('.loader').style.display = "block"
$.ajax({
    type: "POST",
    url: "./webservices/reports.php",
    data: JSON.stringify(payload),
    dataType: "json",
    success:function(response){
        console.log("d",response);
       if(response.status === "Success"){
        alert("Successfully Updated")
        document.querySelector('.loader').style.display = "none"
        animationdelivery(); 
        todayordersummary();
       }
    },
    error:function(err){
        alert("Something wrong")
        document.querySelector('.loader-overlay ').style.display = "none";
        console.log(err)
    }
})
}


function animationdelivery(){
    document.querySelector('.imgdiv').style.display = "block";
    setTimeout(function() {
        document.querySelector('.imgdiv').style.display = "none";
        document.querySelector('.loader-overlay').style.display = "none";
    }, 3000);  
}
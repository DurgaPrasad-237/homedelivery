let register = document.getElementById('register');
let customerform = document.getElementById('customerform');
let searchbtn = document.getElementById('btn_search');
let searchinput = document.getElementById('search_input');
let orderlist = document.querySelector('.order_list')
let addressarea = document.querySelector('.addresses_area')
//    let buttonarea = document.querySelector('.button_area')
let generatebtn = document.querySelector('.btngenerate');
let customerdivid = document.getElementById('customer_div_id');
let customername = document.getElementById("customer_name");
let primaryphone = document.getElementById("customer_phone");
let email = document.getElementById("customer_email");
let periodicity = document.getElementById("payment_period");
let submit = document.getElementById("Submit");
let searchtype = document.getElementById("search_method");
let multiple_list = document.querySelector('.multiple_list');
let form_tdylist = document.querySelector('.form_tdylist');
let dedit = document.getElementById('deditbtn');
let bedit = document.getElementById('beditbtn');
let dsbtn = document.getElementById('dsbtn');
let dcbtn = document.getElementById('dcbtn');
let bsbtn = document.getElementById('bsbtn');
let bcbtn = document.getElementById('bcbtn');
let sameasadd = document.getElementById('input_checkbox');


let regflat = document.getElementById('regflat')
let regstreet = document.getElementById('regstreet')
let regarea = document.getElementById('regarea')
let reglink = document.getElementById('reglink')
let regmobile = document.getElementById('regdmobile')
let finaldeliveryaddress;
let intialdeliveryaddress;
let customerid;
let finalamount = 0;
let finalquantity = 0;
let existingOrders = [];
let lunchidsprice = [];

let prevdeliveryflat,prevbillingflat;
let prevdeliverystreet,prevbillingstreet;
let prevdeliveryarea,prevbillingarea;
let prevdeliverymobile,prevbillingmobile;
let prevdeliverylink;



$(document).ready(intialload())






//function showfooddetails
function showfooddetails(){
//    window.location.href = "fooddetails.php";
   document.querySelector('.food_details').style.display = "block";
}


//intial load function
function intialload() {
    document.querySelector('.customerform').style.display = "none";
    document.querySelector('.addresses_area').style.display = "none";
 //   document.querySelector('.button_area').style.display = "none";
    form_tdylist.style.display = "none";
}


// Function to validate phone number
function validatePhoneNumber(phoneNumber) {
    const phoneRegex = /^[6-9]\d{9}$/;
    return phoneRegex.test(phoneNumber);
}

//email validate
function validateEmail(email) {
    const emailRegex = /\S+@\S+\.\S+/;
    return emailRegex.test(email);
}
//extract digit
function extractdigit(customerid) {
    let digit = customerid.replace(/\D/g, '');
    return digit;
}
//flat function validation
function validateFlatNumber(flatNumber) {
    const flatNumberPattern = /^[A-Za-z0-9/-]+$/; // Allow A-Z, a-z, 0-9, hyphen, and slash
    return flatNumberPattern.test(flatNumber);
}

//function for enabled the inputs
function enableinputs() {
    customername.disabled = false;
    primaryphone.disabled = false;
    email.disabled = false;
}
//function for fullform display
function fullformdisplay() {
    customername.disabled = true;
    primaryphone.disabled = true;
    email.disabled = true;
    customerdivid.style.display = "flex";
}
//functio for display forms after click search button
function displaydetails() {
    customerform.style.display = "flex";
    addressarea.style.display = "flex";
    // buttonarea.style.display = "flex";
    generatebtn.style.display = "none";
    multiple_list.style.display = "none";
    form_tdylist.style.display = "flex";
    document.querySelector('.reg_address').style.display = "none";
    // customerid.style.display = "flex";
}

//address billing disabled
function billingdisabled(status) {
    document.getElementById("billing_flat").disabled = true;
    document.getElementById("billing_street").disabled = true
    document.getElementById("billing_area").disabled = true
    document.getElementById("billing_mobile").disabled = true
    document.querySelector('.bscbtn').style.display = "none";

    if(status !== "success"){
        document.getElementById("billing_flat").value = prevbillingflat || ""
        document.getElementById("billing_street").value = prevbillingstreet || ""
        document.getElementById("billing_area").value = prevbillingarea || ""
        document.getElementById("billing_mobile").value = prevbillingmobile || ""
    }
    // else{

    // }
   

    bedit.style.display = "block";
}
//address billing enabled
function billingenabled() {
    document.getElementById("billing_flat").disabled = false;
    document.getElementById("billing_street").disabled = false
    document.getElementById("billing_area").disabled = false
    document.getElementById("billing_mobile").disabled = false
}

//address delivery disabled
function deliveryenabled() {
    document.getElementById("address_flat").disabled = false
    document.getElementById("address_street").disabled = false
    document.getElementById("address_area").disabled = false
    document.getElementById("address_mobile").disabled = false
    document.getElementById("address_link").disabled = false
}

//address delivery enabled
function deliverydisabled(status) {
    document.getElementById("address_flat").disabled = true;
    document.getElementById("address_street").disabled = true
    document.getElementById("address_area").disabled = true
    document.getElementById("address_mobile").disabled = true
    document.getElementById("address_link").disabled = true;
    document.querySelector('.scbtn').style.display = "none";

    if(status !== "Success"){
        document.querySelector('#address_flat').value = prevdeliveryflat
        document.querySelector('#address_street').value = prevdeliverystreet
        document.querySelector('#address_area').value =  prevdeliveryarea
        document.querySelector('#address_mobile').value =  prevdeliverymobile
        document.querySelector('#address_link').value =  prevdeliverylink
    }
    dedit.style.display = "block";
}

//function for todayorderdetails
// function todayorderdetails(customerid) {
//     //intially setting all 0 
//     ['mealqty','mealqtyl','mealqtyd','mealamt','mealamount','mealamtd'].
//     forEach(id=>document.getElementById(id).value = 0);
//     let finalamount = 0;
//     let totalquantity = 0;
//     var payload = {
//         load: "todayorder",
//         cid: customerid,
//     }
//     console.log(payload);

//     $.ajax({
//         type: "POST",
//         url: "./webservices/dinner.php",
//         data: JSON.stringify(payload),
//         dataType: "json",
//         success: function(response) {
//             if (response.status === "Success") {
//                 console.log("today", response.data);
//                 let todaycontainer = document.querySelector('.todaycontainer');
//                 todaycontainer.innerHTML = "";
//                 response.data.forEach(itm => {
//                     console.log(itm);
//                     let type = (itm.food_type === "breakfast") ? 'BF' : (itm.food_type === "lunch") ? 'LN' : 'DN';
//                     finalamount += parseInt(itm.price);
//                     totalquantity += parseInt(itm.quantity)
//                     let div = document.createElement('div');
//                     div.setAttribute('class', 'today_order');
//                     div.innerHTML = `
//                         <h3>${type}</h3>
//                         <p class="qty">${itm.quantity}</p>
//                         <p class="amt">${itm.price}</p>
//                 `
//                     let iqty = (itm.food_type === 'breakfast') ? "mealqty" : (itm.food_type === 'lunch') ? "mealqtyl" : "mealqtyd";
//                     let iamt = (itm.food_type === 'breakfast') ? "mealamt" : (itm.food_type === 'lunch') ? "mealamount" : "mealamtd";
//                     document.getElementById(`${iqty}`).value = itm.quantity;
//                     document.getElementById(`${iamt}`).value = itm.price;
//                     todaycontainer.append(div);
//                 })
//                 let totaldiv = document.createElement('div');
//                 totaldiv.setAttribute('class', 'totaltoday');
//                 totaldiv.innerHTML = `
//                         <h3>TL</h3>
//                         <p class="fqty">${totalquantity}</p>
//                         <p class="famt">${finalamount}</p>
                    
//               `
//                 todaycontainer.append(totaldiv);

//                 console.log("finalamount", todaycontainer)



//                 console.log(todaycontainer);
//             }
//         },
//         error: function(err, xhr) {
//             alert("Something wrong")
//             console.log(err);
//         }
//     })

// }


function todayorderdetails(customerid) {
    let todaycontainer = document.querySelector('.todaycontainer');
    
    todaycontainer.innerHTML = " ";
    let finalamount = 0;
    let totalquantity = 0;
    var payload = {
        load: "todayorder",
        cid: customerid,
    }
    console.log(payload);

    $.ajax({
        type: "POST",
        url: "./webservices/dinner.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success: function(response) {
            console.log("dataresponsetodayorderdetails",response.data);
            if (response.data !== "Nodata") {
                console.log("today", response.data);
                response.data.forEach(itm => {
                    console.log(itm);
                    if(itm.quantity > 0){
                        let type = (itm.food_type === "breakfast") ? 'BF' : (itm.food_type === "lunch") ? 'LN' : 'DN';
                        finalamount += parseInt(itm.price);
                        totalquantity += parseInt(itm.quantity)
                        let div = document.createElement('div');
                        div.setAttribute('class', 'today_order');
                        div.innerHTML = `
                            <h3>${type}</h3>
                            <p class="qty">${itm.quantity}</p>
                            <p class="amt">${itm.price}</p>
                    `
                        let iqty = (itm.food_type === 'breakfast') ? "mealqty" : (itm.food_type === 'lunch') ? "mealqtyl" : "mealqtyd";
                        let iamt = (itm.food_type === 'breakfast') ? "mealamt" : (itm.food_type === 'lunch') ? "mealamount" : "mealamtd";
                        let iqtyb = (itm.food_type === 'breakfast') ? "mealqtyb" : (itm.food_type === 'lunch') ? "mealqtylb" : "mealqtydb";
                        let iamtb = (itm.food_type === 'breakfast') ? "mealamtb" : (itm.food_type === 'lunch') ? "mealamountb" : "mealamtdb";
                        
                        document.getElementById(`${iqty}`).value = itm.quantity;
                        document.getElementById(`${iamt}`).value = itm.price;
                        document.getElementById(`${iqtyb}`).value = itm.quantity;
                        document.getElementById(`${iamtb}`).value = itm.price;
                        
                    
                        todaycontainer.append(div);
                    }    
                })
                let totaldiv = document.createElement('div');
                totaldiv.setAttribute('class', 'totaltoday');
                if(totalquantity > 0){
                    totaldiv.innerHTML = `
                    <h3>TL</h3>
                    <p class="fqty">${totalquantity}</p>
                    <p class="famt">${parseFloat(finalamount).toFixed(2)}</p>
                
                    `
                    todaycontainer.append(totaldiv);
                }
               

                // console.log("finalamount", todaycontainer)



                // console.log(todaycontainer);
            }
            else{

                let bulkvalues = document.querySelectorAll(
                    '#mealqty,#mealamt,#mealqtyl,#mealamount,#mealqtyd,#mealamtd,#mealqtyb,#mealqtylb,#mealamtb,#mealqtyb,#mealamountb,#mealqtydb,#mealamtdb'
                )
             
                bulkvalues.forEach(val=>{
                  val.value = 0;
                })

                // document.querySelector('#mealqty').value = 0;
                // document.querySelector('#mealamt').value = 0;
                // document.querySelector('#mealqtyl').value = 0;
                // document.querySelector('#mealamount').value = 0;
                // document.querySelector('#mealqtyd').value = 0;
                // document.querySelector('#mealamtd').value = 0;
                // document.querySelector('#mealqtyb').value = 0;
                // document.querySelector('#mealamtb').value = 0;
                // document.querySelector('#mealqtyb').value = 0;
                // document.querySelector('#mealamountb').value = 0;
                // document.querySelector('#mealqtydb').value = 0;
                // document.querySelector('#mealamtdb').value = 0;
            }
        },
        error: function(err, xhr) {
            alert("Something wrong")
            console.log(err);
        }
    })

}






//function for display register form
register.addEventListener('click', () => {
    intialload();
    form_tdylist.style.display = "flex";
    customerform.style.display = 'flex';
    console.log("hello", document.getElementById('delivery_area'));
    document.getElementById('customer_div_id').style.display = "none";
    document.querySelector('.reg_address').style.display = "flex";
    document.querySelector('.btngenerate').style.display = "block";
    document.querySelector('.today_list').style.display = "none";
    document.getElementById("breakfast-box").style.display = "none";
    document.getElementById("lunch-box").style.display = "none";
    document.getElementById("dinner-box").style.display = "none";
    document.getElementById("insert-button").style.display = "none";
    document.getElementById("edit-box").style.display = "none";
    document.querySelector('.food_details').style.display = "none";
    todayorderdetails(0);
    
    enableinputs();
    customername.value = "";
    email.value = "";
    primaryphone.value = "";

    let regadd = document.querySelectorAll(".reg_address input");
    regadd.forEach(x=>{
        x.value = "";
    })

})

//function for register
submit.addEventListener('click', () => {
   
    if (!customername.value || !primaryphone.value || !email.value || !regflat.value || !regstreet.value ||
        !regarea.value || !reglink.value || !regmobile.value
    ) {
        alert("fill the required fields")
        return "";
    }
    if (!validateEmail(email.value)) {
        alert("not a valid email")
        return "";
    }
    if (!validatePhoneNumber(primaryphone.value)) {
        alert("not a valid phone number")
        return "";
    }
    if (!validateFlatNumber(regflat.value)) {
        alert("enter valid flatnumber")
        return "";
    }
    if (!validatePhoneNumber(regmobile.value)) {
        alert("not a valid delivery phone number")
        return "";
    }
    regaddress = regflat.value + "," + regstreet.value + "," + regarea.value;

    var payload = {
        customername: customername.value,
        primaryphone: primaryphone.value,
        email: email.value,
        deliveryaddress: regaddress,
        map: reglink.value,
        deliveryphone: regmobile.value,
        load: "register",

    }
    console.log("regpayload",payload);

    $.ajax({
        type: "POST",
        url: "./webservices/register.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success: function(response) {
            if (response.status === "Success") {
                alert("registred sucessfully");
                form_tdylist.style.display = "none";
                searchinput.value = primaryphone.value;
            }
        },
        error: function(err, xhr) {
            alert("Something wrong")
            console.log(err);
        }

    })

})

//search customer
searchbtn.addEventListener('click', () => {

    let address_input = document.querySelectorAll('.billing_area .address_input_area input');
   address_input.forEach(x=>{
    x.value = "";   
   })
    

    console.log("h",address_input);
    

    const searchmethod = searchtype.value;

    if (!searchinput.value) {
        alert("enter phonenumber/id/name");
        return;
    }

    if (searchmethod === "CustomerID") {
        fetchbyid(searchinput.value);
    } else if (searchmethod === "Phone Number") {
        fetchbymobile(searchinput.value);
    } else if (searchmethod === "Customer Name") {
        fetchbyname(searchinput.value);
    }
})

//fetching the customerdetails by id
function fetchbyid(sinput) {
    console.log("sinput",sinput,typeof(sinput));
    customerid = extractdigit(sinput);

    var load = "fetchbyid";

    var payload = {
        load: load,
        customerid: customerid,
    }
    $.ajax({
        type: "POST",
        url: "./webservices/register.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success: function(response) {
            if (response.status === "Success") {
                response.data.forEach(cust => {
                    searchinput.value = "";
                    document.getElementById('customer_div_id').style.display = "flex";
                    document.querySelector('.today_list').style.display = "block";
                    document.querySelector('.customer_id').value = cust.CustomerID;
                    customername.value = cust.CustomerName;
                    console.log("helo", customername.value + " " + cust.CustomerName.trim());
                    primaryphone.value = cust.Phone1
                    email.value = cust.Email
                    // periodicity.value = cust.Periodicity.trim();
                    intialdeliveryaddress = cust.DeliveryAddress + "," + cust.Phone3 + "," + cust.Map;
                    if (cust.BillingAddress !== null) {
                        const baddressarray = cust.BillingAddress.split(",");
                        document.getElementById("billing_flat").value = baddressarray[0]
                        document.getElementById("billing_street").value = baddressarray[1]
                        document.getElementById("billing_area").value = baddressarray[2]
                        document.getElementById("billing_mobile").value = cust.Phone2

                        prevbillingarea =  baddressarray[2];
                        prevbillingflat = baddressarray[0];
                        prevbillingmobile = cust.Phone2;
                        prevbillingstreet = baddressarray[1];

                    } else {
                        document.getElementById("billing_flat").value = ""
                        document.getElementById("billing_street").value = ""
                        document.getElementById("billing_area").value = ""
                        document.getElementById("billing_mobile").value = ""
                    }
                    if (cust.DeliveryAddress !== null) {
                        const daddressarray = cust.DeliveryAddress.split(",");
                        document.getElementById("address_flat").value = daddressarray[0]
                        document.getElementById("address_street").value = daddressarray[1]
                        document.getElementById("address_area").value = daddressarray[2]
                        document.getElementById("address_mobile").value = cust.Phone3
                        document.getElementById('address_link').value = cust.Map;

                                                
                        prevdeliveryflat =  daddressarray[0];
                        prevdeliverystreet = daddressarray[1];
                        prevdeliveryarea =  daddressarray[2];
                        prevdeliverymobile = cust.Phone3;
                        prevdeliverylink =  cust.Map;


                        
                    } else {
                        document.getElementById("address_flat").value = ""
                        document.getElementById("address_street").value = ""
                        document.getElementById("address_area").value = ""
                        document.getElementById("address_mobile").value = ""
                        document.getElementById('address_link').value = ""
                    }



                    displaydetails();
                    todayorderdetails(cust.CustomerID);
                    // console.log(cust.CustomerID);
                    // console.log(customerid);

                })

            } else {
                alert("No data found");
            }

        },
        error: function(err) {
            alert("Somethind wrong")
            console.log(err);
        }

    })
}

//function for fetchbyname
function fetchbyname(sinput) {
    cn = searchinput.value;
    var load = "fetchbycustomername";

    var payload = {
        load: load,
        customername: cn
    }

    $.ajax({
        type: "POST",
        url: "./webservices/register.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success: function(response) {
            if (response.status === "Success") {
                searchinput.value = "";
                if (response.data.length > 1) {
                    let tbody = document.querySelector(".tablebody");
                    tbody.innerHTML = "";
                    response.data.forEach(cust => {
                        let tr = document.createElement('tr');
                        tr.innerHTML = `
                        <td>${cust.CustomerName}</td>
                        <td>${cust.Phone1}</td>
                        <td>${cust.DeliveryAddress}</td>
                        `
                        tr.setAttribute('onclick', `fetchbyid('${cust.CustomerID}')`);
                        tbody.append(tr);
                    })
                    console.log(tbody);
                    multiple_list.style.display = "block";
                    intialload();
                } else {

                    response.data.forEach(cust => {
                        document.getElementById('customer_div_id').style.display = "flex";
                        document.querySelector('.customer_id').value = cust.CustomerID;
                        customerid = cust.CustomerID;
                        customername.value = cust.CustomerName.trim();
                        primaryphone.value = cust.Phone1
                        email.value = cust.Email
                        // periodicity.value = cust.Periodicity.trim();
                        intialdeliveryaddress = cust.DeliveryAddress + "," + cust.Phone3 + "," + cust.Map;
                        console.log(cust.DeliveryAddress);
                        if (cust.BillingAddress !== null) {
                            const baddressarray = cust.BillingAddress.split(",");
                            document.getElementById("billing_flat").value = baddressarray[0]
                            document.getElementById("billing_street").value = baddressarray[1]
                            document.getElementById("billing_area").value = baddressarray[2]
                            document.getElementById("billing_mobile").value = cust.Phone2

                            prevbillingarea =  baddressarray[2];
                            prevbillingflat = baddressarray[0];
                            prevbillingmobile = cust.Phone2;
                            prevbillingstreet = baddressarray[1];
                        }

                        if (cust.DeliveryAddress !== null) {
                            console.log(cust.DeliveryAddress)
                            const daddressarray = cust.DeliveryAddress.split(",");
                            document.getElementById("address_flat").value = daddressarray[0]
                            document.getElementById("address_street").value = daddressarray[1]
                            document.getElementById("address_area").value = daddressarray[2]
                            document.getElementById("address_mobile").value = cust.Phone3
                            document.getElementById('address_link').value = cust.Map;

                            prevdeliveryflat =  daddressarray[0];
                            prevdeliverystreet = daddressarray[1];
                            prevdeliveryarea =  daddressarray[2];
                            prevdeliverymobile = cust.Phone3;
                            prevdeliverylink =  cust.Map;
                        }


                        setInterval(todayorderdetails(cust.CustomerID), 2000);
                        displaydetails();
                        // console.log(cust.CustomerID);
                        // console.log(customerid);

                    })

                }
            } else {
                alert("No data found")
            }

        },
        error: function(err) {
            alert("Somethind wrong")
            console.log(err);
        }

    })
}

//fetch by mobile
function fetchbymobile(sinput) {
    console.log(sinput);
    cm = sinput;
    var load = "fetchbymobile";

    var payload = {
        load: load,
        primaryphone: cm
    }
    console.log(payload);

    $.ajax({
        type: "POST",
        url: "./webservices/register.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success: function(response) {
            if (response.status === "Success") {
                searchinput.value = "";
                if (response.data.length > 1) {
                    let tbody = document.querySelector(".tablebody");
                    tbody.innerHTML = "";
                    response.data.forEach(cust => {
                        let tr = document.createElement('tr');
                        tr.innerHTML = `
                        <td>${cust.CustomerName}</td>
                        <td>${cust.Phone1}</td>
                        <td>${cust.DeliveryAddress}</td>
                        `
                        tr.setAttribute('onclick', `fetchbyid('${cust.CustomerID}')`);
                        tbody.append(tr);
                    })
                    console.log(tbody);
                    multiple_list.style.display = "block";
                    intialload();
                } else {
                    response.data.forEach(cust => {
                        document.getElementById('customer_div_id').style.display = "flex";
                        document.querySelector('.customer_id').value = cust.CustomerID;
                        customerid = cust.CustomerID;
                        customername.value = cust.CustomerName.trim();
                        primaryphone.value = cust.Phone1
                        email.value = cust.Email
                        // periodicity.value = cust.Periodicity.trim();
                        intialdeliveryaddress = cust.DeliveryAddress + "," + cust.Phone3 + "," + cust.Map;
                        console.log(cust.DeliveryAddress);
                        if (cust.BillingAddress !== null) {
                            const baddressarray = cust.BillingAddress.split(",");
                            document.getElementById("billing_flat").value = baddressarray[0]
                            document.getElementById("billing_street").value = baddressarray[1]
                            document.getElementById("billing_area").value = baddressarray[2]
                            document.getElementById("billing_mobile").value = cust.Phone2

                            prevbillingarea =  baddressarray[2];
                            prevbillingflat = baddressarray[0];
                            prevbillingmobile = cust.Phone2;
                            prevbillingstreet = baddressarray[1];
                        }

                        if (cust.DeliveryAddress !== null) {
                            console.log(cust.DeliveryAddress)
                            const daddressarray = cust.DeliveryAddress.split(",");
                            document.getElementById("address_flat").value = daddressarray[0]
                            document.getElementById("address_street").value = daddressarray[1]
                            document.getElementById("address_area").value = daddressarray[2]
                            document.getElementById("address_mobile").value = cust.Phone3
                            document.getElementById('address_link').value = cust.Map;

                            prevdeliveryflat =  daddressarray[0];
                            prevdeliverystreet = daddressarray[1];
                            prevdeliveryarea =  daddressarray[2];
                            prevdeliverymobile = cust.Phone3;
                            prevdeliverylink =  cust.Map;
                        }



                        displaydetails();
                        setInterval(todayorderdetails(cust.CustomerID), 2000);
                        // console.log(cust.CustomerID);
                        // console.log(customerid);

                    })

                }
            } else {
                alert("No data found")
            }

        },
        error: function(err) {
            alert("Somethind wrong")
            console.log(err);
        }

    })
}

//checkbox same as address
sameasadd.addEventListener('click', () => {

    if (sameasadd.checked === true) {
        document.getElementById("billing_flat").value = document.getElementById("address_flat").value
        document.getElementById("billing_street").value = document.getElementById("address_street").value
        document.getElementById("billing_area").value = document.getElementById("address_area").value
        document.getElementById("billing_mobile").value = document.getElementById("address_mobile").value
        document.querySelector('.bscbtn').style.display = "flex";
        bedit.style.display = "none";
    } else {
        // alert("false")
    }

})

//edit delivery address
dedit.addEventListener('click', () => {
    document.querySelector('.scbtn').style.display = "flex";
    dedit.style.display = "none";
    // document.querySelector('#da_name').value = customername.value;
    // document.querySelector('#da_mobile_number').value = primaryphone.value;
    // document.querySelector('#da_mail').value = email.value;

    // document.querySelector('.delivery_address_block').style.display = "block";
    deliveryenabled();
})

//add new delivery
function addnewDelivery(){
    document.querySelector('#da_name').value = customername.value;
    document.querySelector('#da_mobile_number').value = primaryphone.value;
    document.querySelector('#da_mail').value = email.value;

    document.querySelector('.delivery_address_block').style.display = "block";
}


//close new delivery addresss block
function closenewD(){
    document.querySelector('.delivery_address_block').style.display = "none";
}
//add new dlivery address
function addNewdelivery(){

    let billingaddress = 
    `${
        document.querySelector('#billing_flat').value +","+
        document.querySelector('#billing_street').value +","+
        document.querySelector('#billing_area').value}`;

    let deliveryaddress = 
    `${
        document.querySelector('#da_flatno').value +","+
        document.querySelector('#da_area').value +","+
        document.querySelector('#da_street').value}`

    if(
        ! document.querySelector('#da_flatno').value ||
        ! document.querySelector('#da_area').value ||
        ! document.querySelector('#da_street').value ||
        ! document.getElementById('da_deph').value ||
        ! document.getElementById('da_link').value
    ){
        alert("enter the required fields");
        return;
    }

    if(
        ! document.querySelector('#billing_flat').value ||
        ! document.querySelector('#billing_street').value ||
        ! document.querySelector('#billing_area').value ||
        ! document.getElementById('billing_mobile').value
    ){
        alert("enter the billing fields");
        return;
    }

    if (!validateFlatNumber(document.querySelector('#da_flatno').value)) {
        alert("invalid flatno")
        return;
    }

    if (!validatePhoneNumber(document.getElementById('da_deph').value)) {
        alert("enter valid delivery mobile number");
        return;
    }
    


    var payload = {
        load: "insertnew",
        customername: document.getElementById('customer_name').value,
        email: document.getElementById('customer_email').value,
        primaryphone: document.getElementById('customer_phone').value,
        // periodicity: document.getElementById('payment_period').value,
        billingaddress: billingaddress,
        deliveryaddress: deliveryaddress,
        deliverymobile: document.getElementById('da_deph').value,
        billingmobile: document.getElementById('billing_mobile').value,
        map: document.getElementById('da_link').value
    }

    return $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            console.log(response);
            if(response.status === "success"){
                alert("Successfully Added")
                closenewD();
                fetchbyid(`"${response.cid}"`);
            }
           

        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });



   
}

dsbtn.addEventListener('click', () => {
    const addressflat = document.getElementById("address_flat").value;
    const addressstreet = document.getElementById("address_street").value;
    const addressarea = document.getElementById("address_area").value
    const deliverymobile = document.getElementById("address_mobile").value;
    const addresslink = document.getElementById("address_link").value;

    if (!validateFlatNumber(addressflat)) {
        alert("invalid flatno")
        return;
    }

    if (!addressflat || !addressstreet || !addressarea || !deliverymobile || !addresslink) {
        alert("fill the requried fields");
        return;
    }

    if (!validatePhoneNumber(deliverymobile)) {
        alert("enter valid mobile number");
        return;
    }
    // deliverydisabled();
    // checkaddress();
    var payload = {
        deliveryaddress: addressflat + "," + addressstreet + "," + addressarea,
        deliveryphone: deliverymobile,
        map: addresslink,
        customerid: customerid,
        load: "add_delivery_address"
        // load: "insertnew",
        // customername: document.getElementById('customer_name').value,
        // email: document.getElementById('customer_email').value,
        // primaryphone: document.getElementById('customer_phone').value,
        // // periodicity: document.getElementById('payment_period').value,
        // billingaddress: billingaddress,
        // deliveryaddress: finaldeliveryaddress,
        // deliverymobile: document.getElementById('address_mobile').value,
        // billingmobile: document.getElementById('billing_mobile').value,
        // map: document.getElementById('address_link').value
    }
    console.log("deliveryaddress",payload);
    $.ajax({
        type: "POST",
        url: "./webservices/register.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success: function(response) {
            if (response.status === "Success") {
                alert("Successfully updated")
                // fetchbyid(`"${response.cid}"`);
                document.getElementById("address_flat").value = addressflat;
                document.getElementById("address_street").value = addressstreet;
                document.getElementById("address_area").value = addressarea
                document.getElementById("address_mobile").value = deliverymobile;
                document.getElementById("address_link").value = addresslink;
            

                deliverydisabled(response.status);
            } else {
                alert("Fail to add the address")
            }
        },
        error: function(err) {
            console.log(err);
        }
    })


})

dcbtn.addEventListener('click', () => {
    document.querySelector('.scbtn').style.display = "none";
    dedit.style.display = "block";
    deliverydisabled("fail");
})













//edit billing address
bedit.addEventListener('click', () => {
    document.querySelector('.bscbtn').style.display = "flex";
    bedit.style.display = "none";
    billingenabled();
})
bsbtn.addEventListener('click', () => {
        const billingflat = document.getElementById("billing_flat").value;
        const billinstreet = document.getElementById("billing_street").value;
        const billingarea = document.getElementById("billing_area").value
        const billingmobile = document.getElementById("billing_mobile").value;

        if (!validateFlatNumber(billingflat)) {
            alert("invalid flatno")
            return;
        }

        if (!billingflat || !billinstreet || !billingarea || !billingmobile) {
            alert("fill the requried fields");
            return;
        }

        if (!validatePhoneNumber(billingmobile)) {
            alert("enter valid mobile number");
            return;
        }

        var payload = {
            billingaddress: billingflat + "," + billinstreet + "," + billingarea,
            billingphone: billingmobile,
            customerid: customerid,
            load: "add_billing_address"
        }
        $.ajax({
            type: "POST",
            url: "./webservices/register.php",
            data: JSON.stringify(payload),
            dataType: "json",
            success: function(response) {
                console.log(response);
                if (response.status === "success") {
                    prevbillingarea = document.getElementById("billing_area").value;
                    prevbillingflat = document.getElementById("billing_flat").value;
                    prevbillingmobile =  document.getElementById("billing_mobile").value
                    prevbillingstreet =  document.getElementById("billing_street").value
                    alert("Successfully updated")
                    billingdisabled(response.status);
                } else {
                    alert("Fail to add the address")
                }
            },
            error: function(err) {
                console.log(err);
            }
        })

    })
    bcbtn.addEventListener('click', () => {
        document.querySelector('.bscbtn').style.display = "none";
        bedit.style.display = "block";
        billingdisabled("fail");
    })





// ------------------------------------------------------
let bval = 0;
let dval = 0;
let foodidb = 0;
let foodidd = 0;
let foodidl = 0;
let catid = 0;
let addressflat
let addressstreet
let address_area
let deliverymobile
let addresslink
let baddressflat 
let baddressstreet
let billingmobile

function checkaddress(){
    addressflat = document.getElementById("address_flat").value;
    addressstreet = document.getElementById("address_street").value;
    address_area = document.getElementById("address_area").value
    deliverymobile = document.getElementById("address_mobile").value;
    addresslink = document.getElementById("address_link").value;

    baddressflat = document.getElementById("billing_flat").value;
    baddressstreet = document.getElementById("billing_street").value;
    baddressarea = document.getElementById("billing_area").value
    billingmobile = document.getElementById("billing_mobile").value;

    finaldeliveryaddress = addressflat + "," + addressstreet + "," + address_area + "," + deliverymobile + "," + addresslink;
    billingaddress = baddressflat + "," + baddressstreet + "," + baddressarea;
}



async function placeorder(event) {

    const custid = document.querySelector(".customer_id").value;

    checkaddress();

    if (!addressflat || !addressstreet || !address_area || !deliverymobile || !addresslink) {
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
        finaldeliveryaddress = addressflat + "," + addressstreet + "," + address_area
        response = await getlastid(finaldeliveryaddress, billingaddress);
        customerid = response.cid;
        console.log(response);
    }




    if (!custid) {
        alert("No user selected")
        return;
    }

    if (!addressflat || !addressstreet || !address_area || !deliverymobile || !addresslink) {
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
        finaldeliveryaddress = addressflat + "," + addressstreet + "," + address_area
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

    const bqty = calculateTotalB();
    const lqty = calculateTotalL();
    const dqty = calculateTotalD();

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
        await nlunch(event); // Wait for lunchdetails to complete
        }
        if (dqty > 0) {
        await submitForD(event); // Wait for submitForD to complete
        }
        console.log('All submissions completed successfully.');
    } catch (error) {
        console.error('Error during submissions:', error);
    }
}

async function getlastid(finaldeliveryaddress, billingaddress) {
    var payload = {
        load: "insertnew",
        customername: document.getElementById('customer_name').value,
        email: document.getElementById('customer_email').value,
        primaryphone: document.getElementById('customer_phone').value,
        // periodicity: document.getElementById('payment_period').value,
        billingaddress: billingaddress,
        deliveryaddress: finaldeliveryaddress,
        deliverymobile: document.getElementById('address_mobile').value,
        billingmobile: document.getElementById('billing_mobile').value,
        map: document.getElementById('address_link').value
    };


    return $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            console.log(response.cid);

        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
}


function fetchall() {

    var payload = {
        load: "fetchitems",
        day: dayName,
        cid: customerid,
    };

    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            console.log("fetchall", response);

            const table1Body = $('#table1 tbody');
            const table2Body = $('#table2 tbody');
            table1Body.empty();
            table2Body.empty();

            // Append data for the first table (first 15 rows)
            response.data.slice(0, 15).forEach((x, index) => {
                let disabled = (x.Status === "2") ? "disabled" : "enabled";
                const row = $('<tr>');
                row.html(`
            <td>${x.Date}</td>
            <td>${x.ItemName}</td>
            <td>
            <input type='number' min='0' class='tableqty' id='tableqty-${x.Date.replaceAll('-', '')}' 
            data-optionid='${x.OptionID}' data-price='${x.Price}' data-index='${index}' data-category='${x.category}'
            data-initial='${x.Quantity}' value='${x.Quantity}' ${disabled}>
            </td>
            <td><input type='text' class='reason' id='reason-${x.Date.replaceAll('-', '')}'></td>
            <td><button class="table-btn" onclick="update('${x.Date}', this,'${x.category}','${x.OptionID}','${x.Price}','${x.OrderID}','${x.subcategory}')" disabled>Edit</button></td>
            `);
                table1Body.append(row);
            });

            // Append data for the second table (next 15 rows)
            response.data.slice(15, 30).forEach((x, index) => {
                let disabled = (x.Status === "2") ? "disabled" : "enabled";
                const row = $('<tr>');
                row.html(`
            <td>${x.Date}</td>
            <td>${x.ItemName}</td>
            <td>
            <input type='number' min='0' class='tableqty' id='tableqty-${x.Date.replaceAll('-', '')}' 
            data-optionid='${x.OptionID}' data-price='${x.Price}' data-index='${index}'  data-category='${x.category}'
            data-initial='${x.Quantity}' value='${x.Quantity}' ${disabled}>
            </td>
            <td><input type='text' class='reason' id='reason-${x.Date.replaceAll('-', '')}'></td>
            <td><button class="table-btn" onclick="update('${x.Date}', this,'${x.category}','${x.OptionID}','${x.Price}','${x.OrderID}','${x.subcategory}')" disabled>Edit</button></td>
            `);
                table2Body.append(row);
            });

            // Enable editing on input click
            $('.tableqty').on('click', function() {
                if ($(this).is('[readonly]')) {
                    $(this).removeAttr('readonly'); // Make editable
                    $(this).focus(); // Focus on the input field
                }
            });

            // Revert to readonly on blur
            $('.tableqty').on('blur', function() {
                $(this).attr('readonly', true); // Revert to readonly
            });
            $('.tableqty').on('input', function() {
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
            // initialQuantitySumB = calculateTotalSum('.tableqty');
            // $('.tableqty').on('input', calculateTotalB); // Optional calculation

            $('#breakfast-contain').show();
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
}

function getall() {
    console.log("helfha;lhfa;jh")
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
            console.log('getalll........', response);

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
<td>${x.ItemName}</td>
<td>
    <input type='number' min='0' class='tableqtyd' id='tableqtyd-${x.Date.replaceAll('-', '')}' 
        data-optionid='${x.OptionID}' data-price='${x.Price}' data-index='${index}'  data-category='${x.category}'
        data-initial='${x.Quantity}' value='${x.Quantity}' ${disabled}>
</td>
<td><input type='text'  class='reason' id='reason-${x.Date.replaceAll('-', '')}'></td>
<td><button class="table-btn" onclick="update('${x.Date}', this,'${x.category}','${x.OptionID}','${x.Price}','${x.OrderID}','${x.subcategory}')" disabled>Edit</button></td>
`);
                table1Body.append(row);
            });

            // Append data for the second table (next 15 rows)
            response.data.slice(15, 30).forEach((x, index) => {
                let disabled = (x.Status === "2") ? "disabled" : "enabled";
                const row = $('<tr>');
                row.html(`
<td>${x.Date}</td>
<td>${x.ItemName}</td>
<td>
    <input type='number' min='0' class='tableqtyd' id='tableqtyd-${x.Date.replaceAll('-', '')}' 
        data-optionid='${x.OptionID}' data-price='${x.Price}' data-index='${index}'  data-category='${x.category}'
        data-initial='${x.Quantity}' value='${x.Quantity}' ${disabled}>
</td>
<td><input type='text'  class='reason' id='reason-${x.Date.replaceAll('-', '')}'></td>
<td><button class="table-btn" onclick="update('${x.Date}', this,'${x.category}','${x.OptionID}','${x.Price}','${x.OrderID}','${x.subcategory}')" disabled>Edit</button></td>
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




// lunch table data td
//         function fetchalll() {
//             console.log("lundiids",lunchidsprice);
//     const payload = {
//         load: "lunchdetails",
//         cid: customerid // Ensure `customerid` is defined dynamically in your script
//     };

//     $.ajax({
//         url: './webservices/dinner.php',
//         type: 'POST',
//         dataType: 'json',
//         contentType: 'application/json',
//         data: JSON.stringify(payload),
//         success: function(response) {
//             console.log("Fetched data:", response);

//             const chargesTableBody = document.querySelector('#lunch-table tbody');
//             chargesTableBody.innerHTML = ''; // Clear existing rows

//             const today = new Date(); // Get today's date
//             const daysInMonth = 30; // Number of days to display

//             // Group data by date if available
//             const groupedData = response.status === 'success' && response.data
//                 ? response.data.reduce((acc, item) => {
//                     acc[item.Date] = acc[item.Date] || [];
//                     acc[item.Date].push(item);
//                     return acc;
//                 }, {})
//                 : {};

//             // Loop through the days to populate the table
// // Loop through the days to populate the table
// for (let i = 0; i < daysInMonth; i++) {
//     const currentDate = new Date(today);
//     currentDate.setDate(today.getDate() + i);
//     const formattedDate = currentDate.toISOString().split('T')[0];

//     const row = document.createElement('tr'); // Create a new row

//     // Check if there's an existing order for this date
//     const rowData = groupedData[formattedDate] || [];

//     let count = 0;
//     row.innerHTML = `
//         <td>${formattedDate}</td>
//         ${Array.from({ length: 9 }).map((_, index) => {
//             count = (count > 8) ? 1 : count + 1;


//             const matchingItem = rowData.find(item => item.OptionID === lunchidsprice[count-1].id);
//             const quantity = matchingItem ? matchingItem.Quantity : 0;
//             const price = matchingItem ? matchingItem.Price : lunchidsprice[count-1].price;
//             const OrderID = matchingItem ? matchingItem.OrderID : ''; // Use matching OrderID or leave empty


//             return `
//                 <td>
//                     <input 
//                         type="number" 
//                         class="tableqty" 
//                         data-tdate="${formattedDate}" 
//                         data-optionid="${lunchidsprice[count-1].id}"
//                         data-price="${price}"
//                         value="${quantity}" 
//                         data-initial-value="${quantity}" 
//                         placeholder="0" 
//                         style="width:38px"
//                         min="0"
//                         oninput="updateEditButtonState(this.closest('tr'))">
//                 </td>
//             `;
//         }).join('')}

//         <td>
//             <input 
//                 type="text" 
//                 class="reason-input" 
//                 data-tdate="${formattedDate}"
//                 style="width:240px">
//         </td>
//         <td>
//             <button class="edit-button" 
//                     data-tdate="${formattedDate}" 
//                     onclick="updateOrder(this)" 
//                     ${rowData.length === 0 ? 'disabled' : ''}>
//                 Edit
//             </button>
//         </td>
//     `;

//     // Calculate the initial sum for this row
//     const inputs = row.querySelectorAll('.tableqty');
//     const initialSum = Array.from(inputs).reduce((sum, input) => {
//         return sum + parseInt(input.value || 0, 10);
//     }, 0);
//     row.setAttribute('data-initial-sum', initialSum); // Store in `data-initial-sum`

//     chargesTableBody.appendChild(row);

//     // Initialize Edit button state
//     updateEditButtonState(row);
// }

//             document.querySelector("#lunch-options-container").style.display = "block";
//         },
//         error: function(error) {
//             console.error("Error fetching data:", error);
//             document.querySelector("#lunch-options-container").style.display = "block";
//         }
//     });
// }

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
                            style="width:180px">
                    </td>
                    <td>
                        <button class="edit-button" 
                                data-tdate="${formattedDate}" 
                                onclick="updateOrder(this)" 
                                ${rowData.length === 0 ? 'disabled' : ''}">
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
            if (response.status === 'success' && response.data) {
                disableFieldsBasedOnStatus(response.data);
            }
            document.querySelector("#lunch-options-container").style.display = "block";
        },
        error: function(error) {
            console.error("Error fetching data:", error);
            document.querySelector("#lunch-options-container").style.display = "block";
        }
    });
}


//Kotha function 
function disableFieldsBasedOnStatus(data) {
    const inputs = document.querySelectorAll('.tableqty');
    inputs.forEach(input => {
        const tdate = input.getAttribute('data-tdate');
        const matchingEntry = data.find(item => item.Date === tdate && item.Status === "2");
        if (matchingEntry) {
            input.disabled = true;
        }
    });
}






// Function to update Edit button state dynamically
function updateEditButtonState(row) {
const inputs = row.querySelectorAll('.tableqty'); // Get all inputs in the row
const editButton = row.querySelector('.edit-button'); // Get the Edit button in the row

// Calculate the initial sum (stored in the row's data attribute)
const initialSum = parseInt(row.getAttribute('data-initial-sum'), 10) || 0;

// Calculate the current sum of input values
const currentSum = Array.from(inputs).reduce((sum, input) => {
return sum + parseInt(input.value || 0, 10);
}, 0);

// Check if individual values match their original values
const isUnchanged = Array.from(inputs).every(input => {
const initialValue = parseInt(input.getAttribute('data-initial-value'), 10) || 0;
const currentValue = parseInt(input.value || 0, 10);
return initialValue === currentValue;
});

console.log("Initial Sum:", initialSum, "Current Sum:", currentSum, "Is Unchanged:", isUnchanged);

// Enable the Edit button if either the sum or individual values have changed
editButton.disabled = isUnchanged && initialSum === currentSum;
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
        todayorderdetails(customerid);
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
            console.log("2729", response, response.data.length);
            thlength = response.data.length;

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



function fetchorderb(event) {
    let todatecheck = $("#to-date-edit").val();
    let fromdatecheck = $("#from-date-edit").val();
    let todaydate = new Date().toISOString().split('T')[0];
    let todate = todatecheck ? todatecheck : "2040-01-01";
    let pastdate = "1970-01-01";
    let fromdate = fromdatecheck ? fromdatecheck : pastdate;



    var payload = {
        load: "fetchorderb",
        fromdate: fromdate,
        todate: todate,
        cid: customerid
    };

    console.log("Payload for fetch", payload);

    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            console.log("line 3535", response);
            const chargesTableBody = $('#edit-breakfast tbody');
            chargesTableBody.empty(); // Clear existing rows

            response.data.forEach((x, index) => {
                const statusText = getStatusText(x.Status); // Map the numeric status to text
                const row = $('<tr>');
                row.html(`
            <td>${x.OrderDate}</td>
            <td>${x.ItemName}</td>
            <td contenteditable="true" class="editable-qty">${x.Quantity}</td>
            <td>
                <select class="editable-status">
                    <option value="0" ${x.Status == 0 ? 'selected' : ''}>Cancelled</option>
                    <option value="1" ${x.Status == 1 ? 'selected' : ''}>Pending</option>
                    <option value="2" ${x.Status == 2 ? 'selected' : ''}>Completed</option>
                </select>
            </td>
            <td><input type='text' class='reason' id='reason-${x.OrderID}'></td>
            <td><button class="table-btn" onclick="update(${x.OrderID}, this)">Edit</button></td>
        `);
                chargesTableBody.append(row);
            });

            // Show the breakfast container after loading the data
            $('#breakfast-container').show();
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
}



function fetchorderd(event) {
    let todatecheck = $("#to-date-edit").val();
    let fromdatecheck = $("#from-date-edit").val();
    let todaydate = new Date().toISOString().split('T')[0];
    let todate = todatecheck ? todatecheck : "2040-01-01";
    let pastdate = "1970-01-01";
    let fromdate = fromdatecheck ? fromdatecheck : pastdate;
    var payload = {
        load: "fetchorderd",
        fromdate: fromdate,
        todate: todate,
        cid: customerid
    };

    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            const chargesTableBody = $('#edit-dinner tbody');
            chargesTableBody.empty(); // Clear existing rows

            response.data.forEach((x, index) => {
                const statusText = getStatusText(x.Status); // Map the numeric status to text
                const row = $('<tr>');
                row.html(`
            <td>${x.OrderDate}</td>
            <td>${x.ItemName}</td>
            <td contenteditable="true" class="editable-qty">${x.Quantity}</td>
            <td>
                <select class="editable-status">
                    <option value="0" ${x.Status == 0 ? 'selected' : ''}>Cancelled</option>
                    <option value="1" ${x.Status == 1 ? 'selected' : ''}>Pending</option>
                    <option value="2" ${x.Status == 2 ? 'selected' : ''}>Completed</option>
                </select>
            </td>
            <td><input type='text' class='reason' id='reason-${x.OrderID}'></td>
            <td><button class="table-btn" onclick="update(${x.OrderID}, this)">Edit</button></td>
        `);
                chargesTableBody.append(row);
            });


            $('#breakfast-container').show();
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
}
// This will be the common function for bf and dinner----------------------------->

function fetchorderl(event) {
    let todatecheck = $("#to-date-edit").val();
    let fromdatecheck = $("#from-date-edit").val();
    let todaydate = new Date().toISOString().split('T')[0];
    let todate = todatecheck ? todatecheck : "2040-01-01";
    let pastdate = "1970-01-01";
    let fromdate = fromdatecheck ? fromdatecheck : pastdate;
    var payload = {
        load: "fetchorderl",
        fromdate: fromdate,
        todate: todate,
        cid: customerid
    };

    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            const chargesTableBody = $('#edit-lunch tbody');
            chargesTableBody.empty();

            response.data.forEach((x, index) => {
                const statusText = getStatusText(x.Status);
                const row = $('<tr>');
                row.html(`
            <td>${x.OrderDate}</td>
            <td>${x.ItemName}</td>
            <td contenteditable="true" class="editable-qty">${x.Quantity}</td>
            <td>
                <select class="editable-status">
                    <option value="0" ${x.Status == 0 ? 'selected' : ''}>Cancelled</option>
                    <option value="1" ${x.Status == 1 ? 'selected' : ''}>Pending</option>
                    <option value="2" ${x.Status == 2 ? 'selected' : ''}>Completed</option>
                </select>
            </td>
            <td><input type='text' class='reason' id='reason-${x.OrderID}'></td>
            <td><button class="table-btn" onclick="update(${x.OrderID}, this)">Edit</button></td>
        `);
                chargesTableBody.append(row);
            });


            $('#breakfast-container').show();
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
}


async function update(Date, btn, category, optionid, price, orderid,subcategory) {

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

    checkaddress();

    if (!addressflat || !addressstreet || !address_area || !deliverymobile || !addresslink) {
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
        finaldeliveryaddress = addressflat + "," + addressstreet + "," + address_area
        response = await getlastid(finaldeliveryaddress, billingaddress);
        customerid = response.cid;
        console.log("3818", response);
    }


    if (!reason.trim() & ((newQuantity == 0) || (initialValue != 0 & currentValue !== initialValue))) {
        alert("Please provide a reason for updating the quantity.");
        return;
    }

    let confirmationMessageAdd = 'Do you want to place order for ' + Date + '?';
    let confirmationMessageUpdate = 'Do you want to update order for ' + Date + '?';
    let confirmationMessageDelete = 'Do you want to cancel order for ' + Date + '?';
    let confirmation = '';
    if (initialValue == 0) {
        confirmation = confirm(confirmationMessageAdd);
    } else if (currentValue == 0) {
        confirmation = confirm(confirmationMessageDelete);
    } else {
        confirmation = confirm(confirmationMessageUpdate);
    }
    console.log("Confirmation", confirmation);

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
        subcategory:subcategory,
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
            console.log("updateresponse", response)
            input.data('initial', quantity);
            $(btn).prop('disabled', true);
            fetchall();
            getall();
            alert(response.message);
            todayorderdetails(customerid);

        },
        error: function(error) {
            console.error('Error updating quantity:', error);
            alert("An error occurred while updating. Please try again.");
        }
    });
}


function getStatusText(status) {
    switch (status) {
        case 0:
            return "Cancelled";
        case 1:
            return "Pending";
        case 2:
            return "Completed";
        default:
            return "Unknown";
    }
}


function toggleDeliveryTextbox() {
    var deliveryCheckbox = document.getElementById('delivery-address');
    var deliveryFields = document.getElementById('delivery-address-fields');
    if (deliveryCheckbox.checked) {
        deliveryFields.style.display = 'none'; // Hide the delivery fields
    } else {
        deliveryFields.style.display = 'block'; // Show the delivery fields
    }
}

// function showBreakfast() {
//     document.getElementById("breakfast-box").style.display = "block";
//     document.getElementById("lunch-box").style.display = "none";
//     document.getElementById("dinner-box").style.display = "none";
//     document.getElementById("insert-button").style.display = "block";
//     document.getElementById("edit-box").style.display = "none";
//     document.querySelector('.food_details').style.display = "none";
// }
function showBreakfast() {
    const cid = document.querySelector('.customer_id').value;
    if (!cid) {
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

function showLunch() {
    document.getElementById("breakfast-box").style.display = "none";
    document.getElementById("lunch-box").style.display = "block";
    document.getElementById("dinner-box").style.display = "none";
    document.getElementById("insert-button").style.display = "block";
    document.getElementById("edit-box").style.display = "none";
    document.querySelector('.food_details').style.display = "none";
    const radioBtn = document.querySelector('input[name="lunch-category"][value="category1"]');
    if (radioBtn) {
        radioBtn.checked = true;
    }
    headerfetch();

}

// function showDinner() {
//     document.getElementById("breakfast-box").style.display = "none";
//     document.getElementById("lunch-box").style.display = "none";
//     document.getElementById("dinner-box").style.display = "block";
//     document.getElementById("insert-button").style.display = "block";
//     document.getElementById("edit-box").style.display = "none";
//     document.querySelector('.food_details').style.display = "none";
// }
function showDinner() {
    const cid = document.querySelector('.customer_id').value;
    if (!cid) {
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

function showedit() {

    const cid = document.querySelector('.customer_id').value;

    if (!cid) {
        alert("No user selected")
        return "";
    }
    document.getElementById("breakfast-box").style.display = "none";
    document.getElementById("lunch-box").style.display = "none";
    document.getElementById("dinner-box").style.display = "none";
    document.getElementById("insert-button").style.display = "none";
    document.getElementById("edit-box").style.display = "flex";
    document.querySelector('.food_details').style.display = "none";
}

//function showfooddetails
function showfooddetails(){
//    window.location.href = "fooddetails.php";
   document.querySelector('.food_details').style.display = "block";
   document.getElementById("breakfast-box").style.display = "none";
    document.getElementById("lunch-box").style.display = "none";
    document.getElementById("dinner-box").style.display = "none";
    document.getElementById("insert-button").style.display = "none";
    document.getElementById("edit-box").style.display = "none";

}




// Function to handle the + Add Extra button
function addExtra() {
    // Check if a category is selected
    var selectedCategory = document.querySelector('input[name="lunch-category"]:checked');
    if (!selectedCategory) {
        alert("Please select a category before adding extras.");
        return; // Exit the function if no category is selected
    }

    // Display the extra options (Fry and Rice)
    document.getElementById('extra-options-container').style.display = 'block';
    // Optionally, you can hide the "+ Add Extra" button after it's clicked to prevent adding again
    document.getElementById('add-extra').style.display = 'none';
}


// let initialQuantitySumB = 0;
// let initialQuantitySumD = 0;
allBreakfastItems = [];
allDinnerItems = [];

function calculateTotalB() {
    let totalAmount = 0;
    let totalQuantity = 0;

    // Build the current data array
    currentBreakfastData = [];
    $('.tableqtyb').each(function() {
        const quantity = parseFloat($(this).val()) || 0;
        currentBreakfastData.push({
            ItemName: $(this).data('itemname'),
            Price: $(this).data('price'),
            OptionID: $(this).data('foodid'),
            Quantity: quantity,
        });

        // Calculate totals for the UI
        const price = parseFloat($(this).data('price')) || 0;
        totalAmount += quantity * price;
        totalQuantity += quantity;
    });

    // Compare initial and current data
    const isChanged = detectArrayChanges(allBreakfastItems, currentBreakfastData);
    console.log(" Data Changed:", isChanged ? 1 : 0);

    return isChanged ? 1 : 0;
}

function calculateTotalD() {
    let totalAmount = 0;
    let totalQuantity = 0;

    // Build the current data array
    currentDinnerData = [];
    $('.tableqtydb').each(function() {
        const quantity = parseFloat($(this).val()) || 0;
        currentDinnerData.push({
            ItemName: $(this).data('itemname'),
            Price: $(this).data('price'),
            OptionID: $(this).data('foodid'),
            Quantity: quantity,
        });

        // Calculate totals for the UI
        const price = parseFloat($(this).data('price')) || 0;
        totalAmount += quantity * price;
        totalQuantity += quantity;
    });

    // Compare initial and current data
    const isChanged = detectArrayChanges(allDinnerItems, currentDinnerData);
    console.log(" Data Changed:", isChanged ? 1 : 0);

    return isChanged ? 1 : 0;
}

// Store the initial sum of quantities for dinner

// Function to calculate total and detect changes for dinner





function totalquantityprice(totalAmount, totalQuantity) {
    finalamount = finalamount + totalAmount
    finalquantity = finalquantity + totalQuantity
    console.log(finalquantity + "" + totalQuantity)
    $('.total_price').val(finalamount.toFixed(2))
    $('.total_quantity').val(finalquantity)
}



// function fetchadditems() {
//     const payload = {
//         load: 'fetchadditems'
//     };

//     $.ajax({
//         url: "./webservices/dinner.php",
//         type: 'POST',
//         dataType: 'json',
//         contentType: 'application/json',
//         data: JSON.stringify(payload),
//         success: function(response) {
//             console.log("Response received:", response);
//             if (response.status === 'success') {
//                 const tableBody = $('#lunch-table1 tbody');
//                 tableBody.empty(); // Clear any previous rows

//                 // Loop through the fetched data and add rows to the table
//                 response.data.forEach(item => {
//                     const date = new DataTransferItemList
//                     const row = $('<tr>').attr('data-optionid', item.OptionID); // Store OptionID in data attribute
//                     row.html(`
//                 <td>${item.ItemName}</td>
//                 <td>${item.Price}</td>
//                 <td><input type="number" class="tableqty"  placeholder="0" min="0"></td>
//             `);
//                     tableBody.append(row);
//                 });

//                 $("#lunch-options-container1").show();
//             } else {
//                 console.error('Error in response status:', response);
//             }
//         },
//         error: function(error) {
//             console.error('AJAX request failed:', error);
//         }
//     });
// }

// // Event listener for 'Add Items' button
// $('#add-items').on('click', function() {
//     fetchadditems(); // Fetch additional items when button is clicked
// });

// // Collect data from both tables (lunch-table and lunch-table1)
// function collectLunchItems() {
//     const items = [];

//     // Function to extract data from a table
//     function processTable(tableId) {
//         $(`${tableId} tbody tr`).each(function() {
//             const optionid = $(this).data('optionid'); // Get OptionID from data attribute
//             const price = parseFloat($(this).find('td:nth-child(2)').text().trim()); // Get Price
//             const quantity = parseInt($(this).find('input[type="number"]').val()) || 0; // Get Quantity (default to 0 if not valid)

//             // Validate that OptionID, Price, and Quantity are available
//             if (quantity > 0 && optionid && !isNaN(price)) {
//                 items.push({
//                     foodid: optionid,
//                     price: price,
//                     quantity: quantity,
//                 });
//             }
//         });
//     }

//     // Collect items from both tables
//     processTable('#lunch-table'); // Process first table
//     processTable('#lunch-table1'); // Process second table

//     return items;
// }

// Function to handle form submission
function LunchDetails() {
    // Fetch all headers and extract their attributes
    const headers = document.querySelectorAll('#lunch-table thead th[data-ItemName]');
    const headerData = Array.from(headers).map(header => ({
        itemName: header.getAttribute('data-ItemName'),
        price: header.getAttribute('data-Price'),
        itemID: header.getAttribute('data-ItemID')
    }));

    // Fetch all rows in the body and combine with header data
    const rows = document.querySelectorAll('#lunch-table tbody tr');
    const combinedData = Array.from(rows).map(row => {
        // Extract the date from the first cell or input's data-tdate
        const dateCell = row.querySelector('input.tableqty[data-tdate]');
        const date = dateCell ? dateCell.getAttribute('data-tdate') : null;

        // Extract quantities for each header column
        const quantities = Array.from(row.querySelectorAll('input.tableqty')).map(input => ({
            optionID: input.getAttribute('data-optionid'),
            quantity: input.value
        }));

        // Match quantities with headers
        const rowData = quantities.map(quantity => {
            const header = headerData.find(h => h.itemID === quantity.optionID);
            return {
                date,
                itemName: header ? header.itemName : null,
                price: header ? header.price : null,
                quantity: quantity.quantity,
                optionID: header.itemID

            };
        });

        return rowData; // One row of combined data
    });


    console.log('Combined Data:', combinedData);
    // return combinedData;

    const payload = {
        load: "linsert",
        data: []
    };

    combinedData.forEach(subArray => {
        subArray.forEach(row => {
            if (row.quantity > 0) { // Ensure 'quantity' matches the actual key in your data
                payload.data.push({
                    Date: row.date, // Match key casing to your data structure
                    Quantity: row.quantity,
                    Price: row.price,
                    OptionID: row.optionID,
                    foodtypeid: 2,
                    cid: customerid
                });
            }
        });
    });
    console.log("lunchinsertinggggg", payload);
    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            console.log("2456", response);
            alert(response.message);
        },
        error: function(error) {
            console.error('Error inserting data:', error);
        }
    });
}


//example lunchtable
function examplelunchtable(){
    let x = document.querySelectorAll('#lunchtabletd');
    x.forEach(u=>{

        if(u.value > 0){
            console.log(u.dataset.optionid);
            console.log(u.dataset.price)
            console.log(u.dataset.tdate);
        }
       
    })

    console.log(lunchidsprice[0].id);

}



// Event listener for form submission (e.g., a button or form submission)
$('#submit-lunch-details').on('click', function(event) {
    lunchdetails(event); // Trigger lunch details submission
});

// for total amount of lunch
// Function to update the total amount for lunch
function updateLunchTotal() {
    let totalAmount = 0;
    const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

    // Loop through each row of the lunch table
    $('#lunch-table tbody tr').each(function() {
        // Get the date from the first column (assumed to be in the format YYYY-MM-DD)
        const rowDate = $(this).find('td:first').text().trim();

        // Only calculate the total if the date in the row matches today's date
        if (rowDate === today) {
            // Loop through each cell in the row
            $(this).find('td').each(function(index) {
                // For each cell, if it's an input field, we'll get the quantity
                if ($(this).find('input[type="number"]').length) {
                    const quantity = parseInt($(this).find('input[type="number"]').val()); // Get the quantity

                    // Get the price from the header (using the index to match with columns)
                    const price = parseFloat($('#lunch-table thead th').eq(index).data('price')); // Get the price from header

                    // Check if both price and quantity are valid
                    if (!isNaN(price) && !isNaN(quantity) && quantity > 0) {
                        totalAmount += price * quantity; // Add to total if the date matches today
                    }
                }
            });
        }
    });

    // Update the total amount field
    $('#mealamount').val(totalAmount.toFixed(2));
}

// Attach event listener to all quantity input fields dynamically
// $(document).on('input', '#lunch-table tbody input[type="number"]', function() {
//     updateLunchTotal(); // Update total when any quantity changes
// });




// Function to update total quantity for lunch based on today's date
function updateLunchQuantity() {
    let totalQuantity = 0;

    // Get today's date in YYYY-MM-DD format
    const today = new Date().toISOString().split('T')[0];

    // Iterate through inputs in the table for today's date
    $('#lunch-table tbody input[type="number"]').each(function () {
        const inputDate = $(this).data('tdate'); // Fetch the date from data attribute
        if (inputDate === today) { // Check if input's date matches today's date
            const quantity = parseInt($(this).val());
            if (!isNaN(quantity) && quantity > 0) {
                totalQuantity += quantity;
            }
        }
    });

    // Update the total quantity input field
    $('#mealqtyl').val(totalQuantity); // Set the value of the input field
}

// Attach event listener to dynamically update quantity for today's date
// $(document).on('input', '#lunch-table tbody input[type="number"]', function () {
//     updateLunchQuantity();
// });


window.onload = function() {
    const today = new Date();
    const formattedDate = today.toISOString().split('T')[0]; // Format: YYYY-MM-DD
    function initializeDatePair(fromDateId, toDateId) {
        const fromDateField = document.getElementById(fromDateId);
        const toDateField = document.getElementById(toDateId);
    
        fromDateField.value = formattedDate;
        fromDateField.min = formattedDate;
        toDateField.value = formattedDate;
        toDateField.min = formattedDate;
    
        fromDateField.addEventListener('change', function() {
            const selectedFromDate = fromDateField.value;
            toDateField.min = selectedFromDate;
            if (toDateField.value < selectedFromDate) {
                toDateField.value = selectedFromDate;
            }
        });
    }
    
    initializeDatePair('from-date-b', 'to-date-b');
    initializeDatePair('from-date-l', 'to-date-l');
    initializeDatePair('from-date-d', 'to-date-d');
};





const today = new Date();

const options = {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
};
const formattedDate = today.toLocaleDateString('en-US', options);

const dayName = today.toLocaleDateString('en-US', {
    weekday: 'long'
});

document.getElementById('formatted-date').textContent = formattedDate;
document.getElementById('day-name').textContent = dayName;


//     function openSummaryModal(event) {
//     event.preventDefault();

//     // Display the modal
//     document.getElementById('summary-modal').style.display = 'block';
//     document.getElementById('overlay').style.display = 'block';
// }
function openSummaryModal(event) {
    event.preventDefault();
    const cid = document.querySelector('.customer_id').value;
    if (!cid) {
        alert("Please select any user!")
        return
    }
    document.getElementById('summary-modal').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}

// function closeSummaryModal(event) {
//     event.preventDefault();
//     // Hide the modal
//     document.getElementById('summary-modal').style.display = 'none';
//     document.getElementById('overlay').style.display = 'none';

// }
// function closeSummaryModal(event) {
//     event.preventDefault();
//     // Hide the modal
//     document.getElementById('summary-modal').style.display = 'none';
//     document.getElementById('overlay').style.display = 'none';
//     document.getElementById("breakfast-box-b").style.display = "none";
//     document.getElementById("dinner-box-b").style.display = "none";
//     let today = new Date().toISOString().split('T')[0];


//     document.getElementById('from-date-b').value = today;
//     document.getElementById('to-date-b').value = today;
//     document.getElementById('from-date-l').value = today;
//     document.getElementById('to-date-l').value = today;
//     document.getElementById('from-date-d').value = today;
//     document.getElementById('to-date-d').value = today;
//     $('#breakfast-contain-b').hide();
//     $('#dinner-container-b').hide();
//     const breakfastRadioBtn = document.querySelector('input[name="breakfast-category-b"][value="categoryb1b"]');
//     if (breakfastRadioBtn) {
//     breakfastRadioBtn.checked = false;  
//     }

//     const dinnerRadioBtn = document.querySelector('input[name="dinner-category-b"][value="categoryd1d"]');
//     if (dinnerRadioBtn) {
//     dinnerRadioBtn.checked = false; 
//     }

// }
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
    $('#lunch-options-containers').hide();
    const breakfastRadioBtn = document.querySelector('input[name="breakfast-category-b"][value="categoryb1b"]');
    if (breakfastRadioBtn) {
        breakfastRadioBtn.checked = false;
    }

    const dinnerRadioBtn = document.querySelector('input[name="dinner-category-b"][value="categoryd1d"]');
    if (dinnerRadioBtn) {
        dinnerRadioBtn.checked = false;
    }

    const lunchRadioBtn = document.querySelector('input[name="lunch-category"][value="category1"]');
    if (lunchRadioBtn) {
        lunchRadioBtn.checked = false;
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


function showLunchB() {

    document.getElementById("breakfast-box-b").style.display = "none";
    document.getElementById("lunch-box-b").style.display = "block";
    document.getElementById("dinner-box-b").style.display = "none";
    const radioBtn = document.querySelector('input[name="lunch-category"][value="category1"]');
    if (radioBtn) {
        radioBtn.checked = true;
    }
    fetchalllunch();
}

// function showDinnerB() {
//     document.getElementById("breakfast-box-b").style.display = "none";
//     document.getElementById("lunch-box-b").style.display = "none";
//     document.getElementById("dinner-box-b").style.display = "block";
// }
function showDinnerB() {

    document.getElementById("breakfast-box-b").style.display = "none";
    document.getElementById("lunch-box-b").style.display = "none";
    document.getElementById("dinner-box-b").style.display = "block";
    const radioBtn = document.querySelector('input[name="dinner-category-b"][value="categoryd1d"]');
    if (radioBtn) {
        radioBtn.checked = true;
    }
}



let fetchAlertTriggered = false;
let fetchAlertTriggeredD = false;
let handleAlertTriggered = false;
let initialPriceB = null;
let isInitialPriceBCaptured = false;
let initialPriceD = null;
let isInitialPriceDCaptured = false;





function fetchsubtab() {
    console.log("Fetching subcategories...");
    var payload = {
        load: "fetchsubtab"
    }
    $.ajax({
        url: './webservices/dinner.php',
        type: "POST",
        data: JSON.stringify(payload),
        dataType: "json",
        success: function(response) {
            console.log("Received Data:", response);

            let tabContainer = $("#subTabs").html(""); // Clear existing tabs

            if (response.code === "200" && response.status === "success") {
                response.data.forEach(item => {
                    $("<div>")
                        .addClass("tab")
                        .text(item.subcategory)
                        .attr("data-id", item.SNO)
                        .click(function() {
                            $(".tab").removeClass("active");
                            $(this).addClass("active");
                            $("#subCategoryContent").text(`You selected: ${item.subcategory}`);
                        })
                        .appendTo(tabContainer);
                });
            } else {
                tabContainer.html("<p>No subcategories available.</p>");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
        }
    });
}

function fetchsubtabDinner() {
    console.log("Fetching dinner subcategories...");
    var payload = {
        load: "fetchsubtabd"
    };
    $.ajax({
        url: './webservices/dinner.php',
        type: "POST",
        data: JSON.stringify(payload),
        dataType: "json",
        success: function(response) {
            console.log("Received Dinner Data:", response);
            let tabContainer = $("#subTabsDinner").html(""); 

            if (response.code === "200" && response.status === "success") {
                response.data.forEach(item => {
                    $("<div>")
                        .addClass("tab")
                        .text(item.subcategory)
                        .attr("data-id", item.SNO)
                        .click(function() {
                            $(".tab").removeClass("active");
                            $(this).addClass("active");
                            $("#subCategoryContentDinner").text(`You selected: ${item.subcategory}`);
                        })
                        .appendTo(tabContainer);
                });
            } else {
                tabContainer.html("<p>No subcategories available.</p>");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
        }
    });
}


function initTabs() {
    console.log("Initializing tabs...");

    $(document).off("click", ".tab").on("click", ".tab", function() {
        let cat = $(this).attr("data-id"); 
        console.log("Clicked tab category:", cat);

        $(".tab").removeClass("active");
        $(this).addClass("active");

        // Hide all tables
        $(".food-table").hide();
        $("#fund-table-b").hide(); 

        if (cat == 1) {
            // document.getElementById("breakfast-bulk-table").style.height = '48vh';
            $("#fund-table-b").show(); 
            fetchallb();
        } else {
            // document.getElementById("breakfast-bulk-table").style.height = 'auto';
            $("#fund-table-" + cat).show();

            if (!$("#fund-table-" + cat).data("loaded")) {
                fetchItems(cat); 
            }
        }
    });
}


function initTabsDinner() {
    console.log("Initializing dinner tabs...");

    $(document).off("click", ".tab").on("click", ".tab", function() {
        let cat = $(this).attr("data-id"); 
        console.log("Clicked dinner tab category:", cat);

        $(".tab").removeClass("active");
        $(this).addClass("active");


        $(".food-table-dinner").hide();
        $("#dinner-table-b").hide(); 

        if (cat == 9) {
            // document.getElementById("dinner-bulk-table").style.height = '48vh';
            $("#dinner-table-b").show(); 
            getallb();
        } else {
            // document.getElementById("dinner-bulk-table").style.height = 'auto';
            $("#dinner-table-" + cat).show(); 

            if (!$("#dinner-table-" + cat).data("loaded")) {
                fetchItemsDinner(cat); 
            }
        }
    });
}




function fetchItems(cat) {
    console.log("Fetching items for category:", cat);
    bval = 1;
    if (cat == 1) {
        // document.getElementById("breakfast-bulk-table").style.height = '48vh';
        fetchallb();
        return;
    }
    // document.getElementById("breakfast-bulk-table").style.height = 'auto';

    // Ensure table exists for the category
    if ($("#fund-table-" + cat).length === 0) {
        $("#breakfast-contain-b").append(`
    <table id="fund-table-${cat}" class="food-table" style="display: none;">
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
     `);
    }

    const currentDate = new Date();
    const dayOfWeek = currentDate.getDay();
    const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayName = dayNames[dayOfWeek];
    const fromDate = $('#from-date-b').val();
    const toDate = $('#to-date-b').val();
    var payload = {
        load: "fetchsubitem",
        day: dayName,
        fromdate: fromDate,
        cat: cat
    };

    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),

        success: function(response) {
            console.log("Response for category", cat, ":", response);

            const tableBody = $('#fund-table-' + cat + ' tbody');
            tableBody.empty(); // Clear previous entries

            response.data.forEach((x, index) => {
                const row = $('<tr>');
                row.html(`
                <td>${x.ItemName}</td>
            <td>${x.Price}</td>
            <td><input type='number' class='tableqtyb' data-price='${x.Price}' data-subcategory = '${x.subcategory}' data-index='${index}' data-id='${x.OptionID}' data-foodid='${x.OptionID}' min='0' value='${x.Quantity}'></td>
        `);
                tableBody.append(row);
            
            });
            // handleDateChangeB();
            let alertshown = 1;
                document.querySelectorAll('.tableqtyb').forEach(field => {
                    statuscheck(fromDate, toDate, bval, field, alertshown);
                    alertshown = 1;
                });
            $("#fund-table-" + cat).data("loaded", true).show(); // Show the table after loading
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
}

function fetchItemsDinner(cat) {
    console.log("Fetching dinner items for category:", cat);
    dval = 3;
    if (cat == 9) {
        // document.getElementById("dinner-bulk-table").style.height = '48vh';
        getallb();
        return;
    }
    // document.getElementById("dinner-bulk-table").style.height = 'auto';
    if ($("#dinner-table-" + cat).length === 0) {
        $("#dinner-container-b").append(`
    <table id="dinner-table-${cat}" class="food-table-dinner" style="display: none;">
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    `);
    }

    const currentDate = new Date();
    const dayOfWeek = currentDate.getDay();
    const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayName = dayNames[dayOfWeek];
    const fromDate = $('#from-date-d').val();
    const toDate = $('#to-date-d').val();
    var payload = {
        load: "fetchsubitem",
        day: dayName,
        fromdate: fromDate,
        cat: cat
    };
    console.log("Line 5027",payload)
    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            console.log("Response for dinner category", cat, ":", response);

            const tableBody = $('#dinner-table-' + cat + ' tbody');
            tableBody.empty();

            response.data.forEach((x, index) => {
                const row = $('<tr>');
                row.html(`
        <td>${x.ItemName}</td>
        <td>${x.Price}</td>
        <td><input type='number' class='tableqtydb' data-price='${x.Price}' data-subcategory = '${x.subcategory}' data-index='${index}' data-id='${x.OptionID}' data-foodid='${x.OptionID}' min='0' value='${x.Quantity}'></td>
    `);
                tableBody.append(row);
            });
            let alertshown = 1;
                document.querySelectorAll('.tableqtydb').forEach(field => {
                    statuscheck(fromDate, toDate, dval, field, alertshown);
                    alertshown = 1;
                });
            // handleDateChangeD();
            $("#dinner-table-" + cat).data("loaded", true).show(); // Show after loading
        },
        error: function(error) {
            console.error('Error fetching dinner data:', error);
        }
    });
}






function fetchallb() {
    console.log("Fetching breakfast items...");
    bval = 1;
    
    allBreakfastItems = [];
    const currentDate = new Date();
    const formattedDate = currentDate.toISOString().split('T')[0];
    const dayOfWeek = currentDate.getDay();
    const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayName = dayNames[dayOfWeek];
    const fromDate = $('#from-date-b').val();


    var payload = {
        load: "fetchitemsb",
        day: dayName,
        fromdate: fromDate
    };

    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),

        success: function(response) {
            console.log("........", response)
            const chargesTableBody = $('#fund-table-b tbody');
            chargesTableBody.empty(); // Clear existing rows

            response.data.forEach((x, index) => {
                const row = $('<tr>');
                row.html(`
            <td>${x.ItemName}</td>
                <td id='tablepriceb'>${x.Price}</td>
                <td><input type='number' class='tableqtyb' id='tableqtyb' data-price='${x.Price}' data-subcategory = '${x.subcategory}' data-index='${index}' data-foodid='${x.OptionID}' min='0' value='${x.Quantity}'></td>
        `);
                foodidb = `${x.OptionID}`;
                chargesTableBody.append(row);
                allBreakfastItems.push({
                        itemname: x.ItemName,
                        price: x.Price,
                        foodid: x.OptionID,
                        subcategory: x.subcategory,
                        Quantity: x.Quantity !== undefined && x.Quantity !== null ? x.Quantity : 0

                    });
                if (!isInitialPriceBCaptured) {
                    initialPriceB = parseFloat(x.Price);
                    isInitialPriceBCaptured = true;
                }
            });
            // document.querySelector('.tableqtyb').value = document.getElementById('mealqtyb').value;
            // initialQuantitySumB = calculateTotalSum('.tableqtyb');
            $('.tableqtyb').on('input', calculateTotalB);
            // let field = document.getElementById('tableqtyb');
            fetchsubtab();
            initTabs();
            let alertshown = 0;
                document.querySelectorAll('.tableqtyb').forEach(field => {
                    statuscheck(formattedDate, formattedDate, bval, field, alertshown);
                    alertshown = 1;
                });
            fetchAlertTriggered = true;
            // handleDateChangeB();
            // Show the breakfast container after loading the data
            $('#breakfast-contain-b').show();
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
}


function getallb() {
    console.log("Fetching all dinner items...");
    dval = 3;
    allDinnerItems = [];
    const currentDate = new Date();
    const dayOfWeek = currentDate.getDay();
    const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayName = dayNames[dayOfWeek];
    const fromDate = $('#from-date-d').val();

    var payload = {
        load: "getitemsb",
        day: dayName,
        fromdate: fromDate
    };

    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            console.log("Received dinner items:", response);
            const chargesTableBody = $('#dinner-table-b tbody');
            chargesTableBody.empty();

            response.data.forEach((x, index) => {
                const row = $('<tr>');
                row.html(`
        <td>${x.ItemName}</td>
        <td id='tablepriced'>${x.Price}</td>
        <td><input type='number' class='tableqtydb' id='tableqtydb' data-price='${x.Price}' data-subcategory = '${x.subcategory}' data-index='${index}' data-foodid='${x.OptionID}' min='0' value='${x.Quantity}'></td>
        `);
                chargesTableBody.append(row);
                allDinnerItems.push({
                        itemname: x.ItemName,
                        price: x.Price,
                        foodid: x.OptionID,
                        subcategory: x.subcategory,
                        Quantity: x.Quantity !== undefined && x.Quantity !== null ? x.Quantity : 0

                    });
            });

            $('.tableqtydb').on('input', calculateTotalD);
            // let field = document.getElementById('tableqtydb');
            fetchsubtabDinner();
            initTabsDinner();
            // handleDateChangeD();
            let alertshown = 0;
                document.querySelectorAll('.tableqtydb').forEach(field => {
                    statuscheck(formattedDate, formattedDate, dval, field, alertshown);
                    alertshown = 1;
                });
            $('#dinner-container-b').show();
        },
        error: function(error) {
            console.error('Error fetching dinner data:', error);
        }
    });
}





function fetchpriceb() {
    console.log(" Breakfast Prices...");
    const currentDate = new Date();
    const formattedDate = currentDate.toISOString().split('T')[0];
    const dayOfWeek = currentDate.getDay();
    const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayName = dayNames[dayOfWeek];
    const fromDate = $('#from-date-b').val();

    var payload = {
        load: "fetchitemsb",
        day: dayName,
        fromdate: fromDate
    };

    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),

        success: function(response) {
            console.log("p.r.i.c.e", response.data[0].Price)
            document.getElementById('tablepriceb').textContent = response.data[0].Price;
            const finalPrice = parseFloat(response.data[0].Price);
            comparePrices(initialPriceB, finalPrice);
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
}


function getpriceb() {
    console.log(" Dinner Prices...");
    const currentDate = new Date();
    const formattedDate = currentDate.toISOString().split('T')[0];
    const dayOfWeek = currentDate.getDay();
    const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayName = dayNames[dayOfWeek];
    const fromDate = $('#from-date-d').val();

    var payload = {
        load: "getitemsb",
        day: dayName,
        fromdate: fromDate
    };

    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),

        success: function(response) {
            console.log("p.r.i.c.e", response.data[0].Price)
            document.getElementById('tablepriced').textContent = response.data[0].Price;
            const finalPrice = parseFloat(response.data[0].Price);
            comparePricesD(initialPriceD, finalPrice);
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
}


function comparePrices(initial, final) {
    if (initial !== final) {
        alert(`Price update detected! Initial price: ${initial}, New price: ${final}`);
        console.log(`Price updated from ${initial} to ${final}`);
        initialPriceB = final;
    }
}

function comparePricesD(initial, final) {

    if (initial !== final) {
        alert(`Price update detected! Initial price: ${initial}, New price: ${final}`);
        console.log(`Price updated from ${initial} to ${final}`);
        initialPriceD = final;
    }
}




function checkprice(fromdate, todate, previousPrice) {
    console.log("Fetching Breakfast Prices...");
    var payload = {
        load: "checkprice",
        fromdate: fromdate,
        todate: todate
    };
    $.ajax({
        url: './webservices/dinner.php',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
            console.log("Price Data Received:", response.data);
            let priceChanges = [];
            response.data.forEach(item => {
                let date = item.Date;
                let newPrice = parseFloat(item.Price);
                let itemName = item.Item;
                if (previousPrice !== null && previousPrice !== newPrice) {
                    priceChanges.push(`New price ${newPrice} for ${itemName} from ${date}`);
                }
                previousPrice = newPrice;
            });
            if (priceChanges.length > 0) {
                alert(priceChanges.join("\n"));
            }
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
}


async function submitForB(event) {
    const fromDate = $('#from-date-b').val();
    const toDate = $('#to-date-b').val();
    const currentDate = new Date();
    const dayOfWeek = currentDate.getDay();
    const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayName = dayNames[dayOfWeek];

    // Collect all selected food items and their quantities
    let items = [];
    $('.tableqtyb').each(function() {
        let quantity = $(this).val();
        let foodid = $(this).data('foodid');
        let price = $(this).data('price');
        let subcategory = $(this).data('subcategory');
    //   if (quantity > 0) { // Only include items with a quantity > 0
            items.push({
                foodid: foodid,
                quantity: quantity,
                price: price,
                subcategory:subcategory
            });
    //   }
    });

    if (items.length === 0) {
        alert("Please select at least one item with quantity.");
        return;
    }

    let payload = {
        load: 'setitemsb',
        category: 1,
        items: items,
        cid: customerid,
        day: dayName,
        dates: []
    };
   
    if (fromDate && toDate) {
        const from = new Date(fromDate);
        const to = new Date(toDate);
        if (from > to) {
            alert('Invalid date range.');
            throw new Error('Invalid date range for breakfast.');
        }
        let current = new Date(from);
        while (current <= to) {
            payload.dates.push(current.toISOString().split('T')[0]);
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
        todayorderdetails(customerid);
        fetchall();
        fetchallb();
    }).catch(error => {
        console.error('Error in submitForB:', error);
        throw error;
    });
}





async function submitForD(event) {
    const fromDate = $('#from-date-d').val();
    const toDate = $('#to-date-d').val();
    const currentDate = new Date();
    const dayOfWeek = currentDate.getDay();
    const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayName = dayNames[dayOfWeek];

    // Collect all selected food items and their quantities
    let items = [];
    $('.tableqtydb').each(function() {
        let quantity = $(this).val();
        let foodid = $(this).data('foodid');
        let price = $(this).data('price');
        let subcategory = $(this).data('subcategory');
   //    if (quantity > 0) { // Only include items with a quantity > 0
            items.push({
                foodid: foodid,
                quantity: quantity,
                price: price,
                subcategory:subcategory
            });
   //    }
    });

    if (items.length === 0) {
        alert("Please select at least one item with quantity.");
        return;
    }

    let payload = {
        load: 'setitemsb', // Use a separate identifier for dinner orders
        category: 3,
        items: items,
        cid: customerid,
        day: dayName,
        dates: []
    };

    if (fromDate && toDate) {
        const from = new Date(fromDate);
        const to = new Date(toDate);
        if (from > to) {
            alert('Invalid date range.');
            throw new Error('Invalid date range for dinner.');
        }
        let current = new Date(from);
        while (current <= to) {
            payload.dates.push(current.toISOString().split('T')[0]);
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
        todayorderdetails(customerid);
        getall();
        getallb();
    }).catch(error => {
        console.error('Error in submitForD:', error);
        throw error;
    });
}

// Global array to store both fetched items

allItems = []; // Global array to store both fetched items
let initialLunchData = []; // To store the initial fetched array of values
let currentLunchData = [];
// Function to fetch all lunch items
function fetchalllunch() {
    allItems = []; // Clear global array
    const foodtype = 2;
    const currentDate = new Date();
    const formattedDate = currentDate.toISOString().split('T')[0];
    const payload = {
        load: 'fetch'
    };

    $.ajax({
        url: "./webservices/dinner.php",
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function(response) {
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
                        foodid: item.OptionID,
                        Quantity: item.quantity !== undefined && item.quantity !== null ? item.quantity : 0

                    });
                });

                fetchQuantitiesForCustomer(); // Fetch quantities for customer orders
                $('.tableqtyl').on('input', calculateTotalL);
                let alertshown = 0;
                document.querySelectorAll('.tableqtyl').forEach(field => {
                    statuscheck(formattedDate, formattedDate, foodtype, field, alertshown);
                    alertshown = 1;
                });
                $("#lunch-options-containers").show();
            } else {
                console.error('Error in response data:', response.message || 'Unknown error');
            }
        },
        error: function(error) {
            console.error('Error fetching lunch items:', error);
        }
    });
}


let previouslunqty = 0; //global
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
        success: function(response) {
            console.log("Quantities fetched for the specific date:", response);

            if (response.status === 'success' && response.data) {
                const quantities = response.data;

                // Update table rows with fetched quantities using map
                quantities.forEach(order => {
                    const inputField = $(`input[data-optionid1="${order.OptionID}"]`);
                    if (inputField.length > 0) {
                        inputField.val(order.Quantity);

                        // Update the corresponding item in allItems array
                        const itemIndex = allItems.findIndex(item => item.foodid === order.OptionID);
                        if (itemIndex !== -1) {
                            allItems[itemIndex].Quantity = order.Quantity; // Add or update the Quantity field
                        }
                    }
                });

                console.log("Quantities successfully updated in the table and allItems array.");
                console.log("Updated allItems array:", allItems);
            } else {
                console.error(response.message || 'No quantities found.');
            }
        },
        error: function(error) {
            console.error("Error fetching quantities:", error);
        }
    });
}

// Function to handle lunch order submission

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



// if (payload.items.length === 0) {
//     alert("Please enter quantities for at least one lunch item.");
//     return;
// }

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
todayorderdetails(customerid);
headerfetch();
fetchalll();
fetchalllunch();

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
// $(document).on('input', '#lunch-table-l tbody input[type="number"]', function() {
//     updateLunchTotaldl();
//     updateLunchQuantitydl();
// });


$('#from-date-b, #to-date-b').on('change', handleDateChangeB);
$('#from-date-d, #to-date-d').on('change', handleDateChangeD);

// Function for the first date pair (B)
function handleDateChangeB() {

    const fromDateB = $('#from-date-b').val();
    let toDateB = $('#to-date-b').val();
    if (fromDateB > toDateB) {
        toDateB = fromDateB;
    }

    const foodtype = 1;
    let alertshown = 0;

    if (fromDateB && toDateB) {
        document.querySelectorAll('.tableqtyb').forEach(field => {
            statuscheck(fromDateB, toDateB, foodtype, field, alertshown);
            alertshown = 1;
        });

        const payload = {
            load: 'datechange',
            fromdate: fromDateB,
            todate: toDateB,
            foodtype: foodtype,
            cid: customerid
        };

        $.ajax({
            url: './webservices/dinner.php',
            type: 'POST',
            dataType: 'json',
            data: JSON.stringify(payload),
            success: function(data) {
                console.log(data, "date check");

                if (data.status === 'success' && data.data.length > 0) {
                    const groupedData = groupByDate(data.data);
                    if (checkIfPatternMatches(groupedData)) {
                        // Pattern matches, update fields
                        const referencePattern = Object.values(groupedData)[0]; // Use first day's pattern
                        referencePattern.forEach(order => {
                            const inputField = $(`.tableqtyb[data-foodid="${order.FoodID}"]`);
                            if (inputField.length > 0) {
                                inputField.val(order.Quantity);
                            }
                        });
                    } else {
                        // Pattern mismatch, set all to 0
                        $('.tableqtyb').val(0);
                    }
                } else {
                    $('.tableqtyb').val(0);
                }

                initialQuantitySumB = calculateTotalSum('.tableqtyb');
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }
}

function handleDateChangeD() {
    const fromDateD = $('#from-date-d').val();
    let toDateD = $('#to-date-d').val();
    if (fromDateD > toDateD) {
        toDateD = fromDateD;
    }

    const foodtype = 3;
    let alertshown = 0;

    if (fromDateD && toDateD) {
        document.querySelectorAll('.tableqtydb').forEach(field => {
            statuscheck(fromDateD, toDateD, foodtype, field, alertshown);
            alertshown = 1;
        });

        const payload = {
            load: 'datechange',
            fromdate: fromDateD,
            todate: toDateD,
            foodtype: foodtype,
            cid: customerid
        };

        $.ajax({
            url: './webservices/dinner.php',
            type: 'POST',
            dataType: 'json',
            data: JSON.stringify(payload),
            success: function(data) {
                console.log(data);

                if (data.status === 'success' && data.data.length > 0) {
                    const groupedData = groupByDate(data.data);
                    if (checkIfPatternMatches(groupedData)) {
                        // Pattern matches, update fields
                        const referencePattern = Object.values(groupedData)[0]; // Use first day's pattern
                        referencePattern.forEach(order => {
                            const inputField = $(`.tableqtydb[data-foodid="${order.FoodID}"]`);
                            if (inputField.length > 0) {
                                inputField.val(order.Quantity);
                            }
                        });
                    } else {
                        // Pattern mismatch, set all to 0
                        $('.tableqtydb').val(0);
                    }
                } else {
                    $('.tableqtydb').val(0);
                }

                initialQuantitySumD = calculateTotalSum('.tableqtydb');
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }
}


function groupByDate(data) {
    return data.reduce((acc, order) => {
        if (!acc[order.Date]) {
            acc[order.Date] = [];
        }
        acc[order.Date].push({
            FoodID: order.FoodID,
            Quantity: order.Quantity
        });
        return acc;
    }, {});
}


function checkIfPatternMatches(groupedData) {
    const patternArray = Object.values(groupedData);
    if (patternArray.length === 0) return false;

    const referencePattern = JSON.stringify(patternArray[0]);
    return patternArray.every(pattern => JSON.stringify(pattern) === referencePattern);
}



// For status check

function statuscheck(fromdate, todate, foodtype, field, alertcount) {

    const payload = {
        load: 'statuscheck',
        fromdate: fromdate,
        todate: todate,
        foodtype: foodtype,
        cid: customerid
    };
  

    if (fromdate && todate) {
        $.ajax({
            url: './webservices/dinner.php',
            type: 'POST',
            dataType: 'json',
            data: JSON.stringify(payload),
            success: function(data) {
             
                if (data.status !== "error" && data.data[0].Status == 2) {
                    if (alertcount != 1) {
                        alert(`Order has been already delivered for the following date: ${fromdate}.\nPlease select any other date.`);
                    }

                    field.disabled = true;
                } else {
                    field.disabled = false;
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }
}








// // Function to send lunch details
// function nlunch(event) {
//     event.preventDefault();

//     const fromDate = $('#from-date-l').val();
//     const toDate = $('#to-date-l').val();

//     // Initialize payload
//     let payload = {
//         load: 'nlunch',
//         cid: customerid,
//         foodtype: 2,
//         category: '2',
//         dates: [],
//         items: [] // Initialize an array for storing item details
//     };

//     // Update total amount and quantity before submission
//     updateLunchTotaldl();
//     updateLunchQuantitydl();

//     // Check date validity
//     if (fromDate && toDate) {
//         const from = new Date(fromDate);
//         const to = new Date(toDate);
//         if (from > to) {
//             alert('Invalid date range.');
//             return;
//         }
//         let current = new Date(from);
//         while (current <= to) {
//             payload.dates.push(current.toISOString().split('T')[0]); // Format date as YYYY-MM-DD
//             current.setDate(current.getDate() + 1);
//         }
//     } else {
//         payload.dates.push(new Date().toISOString().split('T')[0]); // Default to today's date
//     }

//     // Loop through all items (from both fetchalllunch and fetchadditems)
//     allItems.forEach(item => {
//         const quantity = parseInt($(`input[data-optionid="${item.OptionID}"]`).val() || 0, 10); // Get the quantity for the item
//         const price = item.Price || 0; // Assuming you are retrieving price from your `allItems` array
//         if (quantity > 0) {
//             payload.items.push({
//                 itemname: item.ItemName,
//                 price: price,
//                 quantity: quantity,
//                 foodid: item.OptionID // Add OptionID to the payload
//             });
//         }
//     });

//     // If no items have been selected, alert the user
//     if (payload.items.length === 0) {
//         alert("Please enter quantities for at least one lunch item.");
//         return;
//     }

//     console.log('Payload:', payload);

//     // Send the data using AJAX
//     $.ajax({
//         type: 'POST',
//         url: './webservices/dinner.php',
//         dataType: 'json',
//         data: JSON.stringify(payload),
//         success: function(response) {
//             alert(response.message);
//             location.reload(); // Reload the page after successful update
//         },
//         error: function(error) {
//             console.error('Error:', error);
//         }
//     });
// }
$('#from-date-l, #to-date-l').on('change', function() {
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
    let foodtype = 2;
    let alertshown = 0;
    document.querySelectorAll('.tableqtyl').forEach(field => {
        statuscheck(fromDate, toDate, foodtype, field, alertshown);
        alertshown = 1;
    });

    if (typeof customerid === 'undefined' || customerid === null) {
        console.error("Customer ID is not defined.");
        return;
    }

    // Fetch quantities for both dates
    fetchQuantities(fromDate, function(fromData) {
        fetchQuantities(toDate, function(toData) {
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
        success: function(response) {
            if (response.status === 'success' && response.data) {
                callback(response.data); // Pass data to the callback
            } else {
                console.error(`No quantities found for date: ${date}`);
                callback(null); // No data
            }
        },
        error: function(error) {
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
                console.log("dlhaf", order.Quantity)
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
    $('input[data-optionid1]').each(function() {
        $(this).val(''); // Clear the value
    });
}

function calculateTotalL() {
    let totalAmount = 0;
    let totalQuantity = 0;

    // Build the current data array
    currentLunchData = [];
    $('.tableqtyl').each(function() {
        const quantity = parseFloat($(this).val()) || 0;
        currentLunchData.push({
            ItemName: $(this).data('itemname'),
            Price: $(this).data('price'),
            OptionID: $(this).data('optionid1'),
            Quantity: quantity,
        });

        // Calculate totals for the UI
        const price = parseFloat($(this).data('price')) || 0;
        totalAmount += quantity * price;
        totalQuantity += quantity;
    });

    // Compare initial and current data
    const isChanged = detectArrayChanges(allItems, currentLunchData);

    // Log or use the change status (1 for changes, 0 for no changes)
    console.log("Lunch Data Changed:", isChanged ? 1 : 0);

    // Update totals in the UI (if required)
    // $('#lunchamt').val(totalAmount.toFixed(2));
    // $('#lunchqty').val(totalQuantity);

    return isChanged ? 1 : 0;
}

function detectArrayChanges(initial, current) {
    console.log("Initial Data:", initial);
    console.log("Current Data:", current);

    // Ensure both arrays are of the same length, otherwise return 1 (changes detected)
    if (initial.length !== current.length) {
        return 1; // Different lengths mean changes
    }

    // Iterate through the arrays to compare each item
    for (let i = 0; i < initial.length; i++) {
        const initItem = initial[i];
        const currItem = current[i];

        // Only compare items where Quantity is defined
        if (initItem.Quantity !== undefined && currItem.Quantity !== undefined) {
            const initFoodId = String(initItem.foodid); // Convert to string for comparison
            const currOptionId = String(currItem.OptionID); // Convert to string for comparison

            // Compare food IDs and quantities (ensure both are numbers for consistency)
            if (
                initFoodId !== currOptionId || // Compare food IDs
                Number(initItem.Quantity) !== Number(currItem.Quantity) // Compare quantities as numbers
            ) {
                return 1; // Found a difference (changes detected)
            }
        }
    }

    return 0; // No differences found (no changes)
}

function disableFieldsBasedOnStatus(data) {
    const inputs = document.querySelectorAll('.tableqty');
    inputs.forEach(input => {
        const tdate = input.getAttribute('data-tdate');
        const matchingEntry = data.find(item => item.Date === tdate && item.Status === "2");
        if (matchingEntry) {
            input.disabled = true; 
        }
    });
}
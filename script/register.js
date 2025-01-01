const searchButton = document.getElementById('search-button');
const registerErrorMessage = document.getElementById('register-error-message');
const registerButton = document.getElementById('register-button');
const errorMessage = document.getElementById('error-message');
const detailsSection = document.querySelector('.details');
const registerSection = document.querySelector('.register-details');
const registerSubmitButton = document.getElementById('register-btn');
const registerNameInput = document.getElementById('register-name');
const searchInput = document.getElementById('search-input');
const searchType = document.getElementById('search-type');
const registerPhoneInput = document.getElementById('register-phone');
const registerPhoneError = document.getElementById('register-phone-error');
const multiple_list = document.querySelector('.multiple_list');

//register button to display the register form
registerButton.addEventListener('click', () => {
    errorMessage.textContent = '';
    registerErrorMessage.textContent = '';
    detailsSection.style.display = 'none';
    registerSection.style.display = 'flex';
});



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
//digit
function extractdigit(customerid){
   let digit = customerid.replace(/\D/g, '');
   return digit;
}



registerSubmitButton.addEventListener('click', () => {
    var customername = document.getElementById("register-name").value;
    var primaryphone = document.getElementById("register-phone").value;
    var email = document.getElementById("register-email").value;
    var periodicity = document.getElementById("paymentperiod").value;

    console.log(customername+" "+primaryphone+" "+email+" "+periodicity)
    if (!customername || !primaryphone || !email || !periodicity) {
       alert("fill the required fields")
       return "";
    }
    else if(!validateEmail(email)){
        alert("not a valid email")
        return "";
    }
    else if(!validatePhoneNumber(primaryphone)) {
        alert("not a valid phone number")
        return "";
    }
  
  
    
    var payload = {
        customername:customername,
        primaryphone:primaryphone,
        email:email,
        periodicity:periodicity,
        load:"register"
    }

    $.ajax({
        type: "POST",
        url: "./webservices/register.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success:function(response){
           if(response.status === "Success"){
            alert("registred sucessfully");
            registerSection.style.display = 'none';
            document.getElementById('search-input').value = primaryphone;

           }
        },
        error:function(err,xhr){
           alert("Something wrong")
           console.log(err);
        }

    })
    
    
    
    
    // else {
    //     registerErrorMessage.textContent = '';
    //     alert('Registration successful!');
    //     // Reset form to initial state
    //     document.getElementById('search-input').value = '';
    //     registerNameInput.value = '';
    //     registerPhoneInput.value = '';
    //     detailsSection.style.display = 'flex'; // Show customer details section after successful registration
    //     registerSection.style.display = 'none'; // Hide registration section
    //     errorMessage.textContent = '';
    // }
});





searchButton.addEventListener('click', () => {
    const searchmethod = searchType.value;
    if(!searchInput.value){
        alert("enter phonenumber/id/name");
        return;
    }

    if(searchmethod === "customer-id"){
        fetchbyid(searchInput.value);
    }
    else if(searchmethod === "mobile-number"){
        fetchbymobile(searchInput.value);
    }
    else if(searchmethod === "customer-name"){
        fetchbyname(searchInput.value);
    }
});

function detailsfetch(customerid){
    alert(customerid);
}



//function fetchbyid
function fetchbyid(sinput){
    customerid = extractdigit(sinput);
    var load = "fetchbyid";

    var payload = {
        load:load,
        customerid:customerid,
    }
     $.ajax({
        type: "POST",
        url: "./webservices/register.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success:function(response){
           
           if(response.status === "Success"){
            multiple_list.style.display = "none";
            detailsSection.style.display = 'flex';
            
            response.data.forEach(cust =>{
                console.log(cust);
                document.getElementById('customer-id').value = cust.CustomerID;
                document.getElementById('customer-name').value = cust.CustomerName;
                document.getElementById('customer-email').value = cust.Email;
                document.getElementById('customer-phone').value = cust.Phone1;
                const baddressarray = cust.BillingAddress.split(" ");
                const daddressarray = cust.DeliveryAddress.split(" ");
                document.getElementById("billing-flat-number").value = baddressarray[0]
                document.getElementById("billing-street").value = baddressarray[1]
                document.getElementById("billing-area").value = baddressarray[2]
                document.getElementById("billing-phone").value = cust.Phone2
                document.getElementById("delivery-flat-number").value = daddressarray[0]
                document.getElementById("delivery-street").value = daddressarray[1]
                document.getElementById("delivery-area").value = daddressarray[2]
                document.getElementById("delivery-phone").value = cust.Phone3
                
            })

           }
           else{
            alert("NO data found")
           }
           
        },
        error:function(err){
            alert("Somethind wrong")
            console.log(err);
        }

     })
}

//function fetchbyname
function fetchbyname(sinput){
    customername = searchInput.value;
    var load = "fetchbycustomername";

    var payload = {
        load:load,
        customername:customername
    }

    $.ajax({
        type: "POST",
        url: "./webservices/register.php",
        data: JSON.stringify(payload),
        dataType: "json",
        success:function(response){
           if(response.status === "Success"){
                if(response.data.length > 1){
                    let tbody = document.querySelector(".tablebody");
                    tbody.innerHTML = "";
                    response.data.forEach(cust=>{
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
                    detailsSection.style.display = 'none';
                }
                else{
                    detailsSection.style.display = 'flex';

                }
           }
           else{
            alert("No data found")
           }
            
        },
        error:function(err){
            alert("Somethind wrong")
            console.log(err);
        }

    })
}


//function for update
function detailsupdate(){
    var flatno = document.getElementById().value;
    var street = document.getElementById().value;
    var area = document.getElementById().value;
    var dflatno = document.getElementById().value;
    var dstreet = document.getElementById().value;
    var darea = document.getElementById().value;
    var billingphone = document.getElementById().value;
    var deliveryphone = document.getElementById().value;
    var map = document.getElementById().value;
    var deliveryaddress = dflatno+" "+dstreet+" "+darea;
    var billingaddress = flatno+" "+street+" "+area;
    var customername = document.getElementById("");
    var primaryphone = document.getElementById("");
    var email = document.getElementById("");
    var periodicity = document.getElementById("").value;

}
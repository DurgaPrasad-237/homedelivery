function load_foodType() {
  var payload = {
    load: "load_foodtype",
  };
  $.ajax({
    type: "POST",
    url: "./webservices/kot.php",
    data: JSON.stringify(payload),
    dataType: "json",
    success: function (response) {
      if (response.status === "Success") {
        let foodtype = document.querySelector(".foodtype");
        foodtype.innerHTML = '<option value="">All</option>';
        response.data.forEach((fd) => {
          const option = document.createElement("option");
          option.value = fd.sno;
          option.textContent = fd.type;

          // Append the option to the select element
          foodtype.appendChild(option);
        });
      }
    },
    error: function (err) {
      console.log(err);
      alert("something error try again later");
    },
  });
}
load_foodType();

function fetchkot(event) {
    event.preventDefault();
    console.log("Fetching KOT data...");

    let selectedDate = $("#from-date").val();
    let selectedFoodType = $("#foodtype").val();

    if (!selectedDate) {
        alert("Please select a date.");
        return;
    }

    let payload = {
        load: "load_orders",
        date: selectedDate,
        foodtype: selectedFoodType,
    };

    console.log("Payload:", payload);

    $.ajax({
        url: "./webservices/kot.php",
        type: "POST",
        dataType: "json",
        data: JSON.stringify(payload),
        success: function (response) {
            if(response.status == "fail"){
                alert('No valid items found!');
            }
            console.log("Response:", response);
            const kotTableBody = $(".report_tbody");
            kotTableBody.empty(); // Clear existing rows
    
            if (response.code === "200" && response.status === "Success") {
                let groupedOrders = {};
    
                // Group items by OrderID
                response.data.forEach((order) => {
                    if (!groupedOrders[order.OrderID]) {
                        groupedOrders[order.OrderID] = {
                            details: order,
                            items: []
                        };
                    }
                    groupedOrders[order.OrderID].items.push(order);
                });
    
                // Render grouped data
                Object.values(groupedOrders).forEach((group) => {
                    group.items.forEach((item, index) => {
                        let row = $('<tr>');
    
                        // Prepare dropdown options
                        let deliveryBoyNames = item.DeliveryBoyNames ? item.DeliveryBoyNames.split(",") : [];
                        let deliveryBoyIDs = item.DeliveryBoyIDs ? item.DeliveryBoyIDs.split(",") : [];
                        let deliveryBoyContacts = item.DeliveryBoyContacts ? item.DeliveryBoyContacts.split(",") : [];
    
                        let deliveryBoyOptions = `<option value="">Select</option>`;
                        deliveryBoyIDs.forEach((id, i) => {
                            deliveryBoyOptions += `<option value="${id}" data-contact="${deliveryBoyContacts[i]}" ${item.DeliveryPersonID == id ? "selected" : ""}>
                                ${deliveryBoyNames[i]}
                            </option>`;
                        });
    
                        let deliveryContactOptions = `<option value="">Select</option>`;
                        deliveryBoyIDs.forEach((id, i) => {
                            deliveryContactOptions += `<option value="${id}" data-name="${deliveryBoyNames[i]}" ${item.DeliveryPersonID == id ? "selected" : ""}>
                                ${deliveryBoyContacts[i]}
                            </option>`;
                        });
    
                        row.html(`
                            <td>${index === 0 ? item.OrderID : ""}</td>
                            <td>${index === 0 ? item.CustomerName : ""}</td>
                            <td>${index === 0 ? item.DeliveryAddress : ""}</td>
                            <td>${index === 0 ? item.Landmark : ""}</td>
                            <td>${index === 0 ? item.Phone3 : ""}</td>
                            <td>${index === 0 ? item.OrderDate : ""}</td>
                            <td>${item.ItemName}</td>
                            <td>${item.Quantity}</td>
                            <td>${item.TotalAmount}</td>
    
                            ${index === 0 ? `
                                <td>
                                    <select class="delivery-boy" data-orderid="${item.OrderID}">
                                        ${deliveryBoyOptions}
                                    </select>
                                </td>
                                <td>
                                    <select class="delivery-contact" data-orderid="${item.OrderID}">
                                        ${deliveryContactOptions}
                                    </select>
                                </td>
                                <td>
                                    <button class="save-btn" data-id="${item.OrderID}">Save</button>
                                </td>
                                <td>
                                <button class="print-btn" data-id="${item.OrderID}" 
                                    ${item.Print == 1 || item.DeliveryPersonID == 0 || selectedDate < new Date().toISOString().split('T')[0] ? "disabled" : ""}>
                                    Print
                                </button>
                            </td>

                                <td>
                                    <button class="reprint-btn" data-id="${item.OrderID}" ${item.Print == 0 || selectedDate < new Date().toISOString().split('T')[0]? "disabled" : ""}>
                                        Re-Print
                                    </button>
                                </td>
                            ` : '<td colspan="5"></td>'}
                        `);
                        kotTableBody.append(row);
                    });
                });
    
                // Drop-down-select logic
                $(".delivery-boy").on("change", function () {
                    let selectedValue = $(this).val();
                    let selectedContact = $(this).find("option:selected").data("contact");
                    $(this).closest("tr").find(".delivery-contact").val(selectedValue).trigger("change");
                });
    
                $(".delivery-contact").on("change", function () {
                    let selectedValue = $(this).val();
                    let selectedName = $(this).find("option:selected").data("name");
                    $(this).closest("tr").find(".delivery-boy").val(selectedValue).trigger("change");
                });
    
                // Save delivery boy to orders table 
                $(".save-btn").on("click", function () {
                  
                    let orderId = $(this).data("id");
                    let deliveryBoyId = $(this).closest("tr").find(".delivery-boy").val();
                    console.log(deliveryBoyId)
                    if(!deliveryBoyId){
                        alert("Please select the delivery boy!");
                        return
                    }
                    if(selectedDate < new Date().toISOString().split('T')[0]){
                        alert("Cannot assign for a past date.");
                        return
                    }
                    $.ajax({
                        url: "./webservices/kot.php",
                        type: "POST",
                        contentType: "application/json",
                        data: JSON.stringify({
                            load: "updateDeliveryBoy",
                            orderId: orderId,
                            deliveryBoyId: deliveryBoyId
                        }),
                        success: function (response) {
                            let res = JSON.parse(response);
                            if (res.code === "200") {
                                alert("Delivery boy assigned successfully!");
                              
                                    $(`.print-btn[data-id="${orderId}"]`).prop("disabled", false);
                                
                              
                            } else {
                                alert("Error updating delivery boy");
                            }
                        }
                    });
                });
                $(".print-btn").on("click", function () {
                    let orderId = $(this).data("id");
                    let printButton = $(this);
                    let reprintButton = printButton.closest("tr").find(".reprint-btn");

                    let order = response.data.filter(o => o.OrderID == orderId);
                    console.log("Printing order:", orderId);
                    printkot(order);

                    // Update print status in backend
                    $.ajax({
                        url: "./webservices/kot.php",
                        type: "POST",
                        contentType: "application/json",
                        data: JSON.stringify({
                            load: "update_print_status",
                            orderId: orderId
                        }),
                        success: function (response) {
                            let res = JSON.parse(response);
                            if (res.code === "200") {
                                printButton.prop("disabled", true);
                                reprintButton.prop("disabled", false);
                            } else {
                                alert("Error updating print status");
                            }
                        },
                        error: function () {
                            alert("Failed to update print status.");
                        }
                    });
                });
                $(".reprint-btn").on("click", function () {
                    let orderId = $(this).data("id");
                    let order = response.data.filter(o => o.OrderID == orderId);
                    console.log("Re-Printing order:", orderId);
                    printkot(order);
                });
            }
        }
    });
    
}


function printkot(order) {
    if (!order || order.length === 0) {
        console.error("No order data provided for printing.");
        return;
    }

    let kotWindow = window.open('', '', 'width=600,height=500');

    let kotContent = `
        <html>
        <head>
            <title>KOT - Order #${order[0].OrderID}</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 2px; font-size: 12px; margin: 0; }
                .kot-container { width: 90%; margin: auto; border: 1px solid black; padding: 5px; }
                h2 { text-align: center; font-size: 14px; margin: 0; display: flex; justify-content: space-between; align-items: center; }
                .kot-header { display: flex; justify-content: space-between; font-size: 12px; margin-top: 2px; }
                .kot-header p { margin: 1px 0; }
                .left, .right { width: 48%; }
                .right { text-align: right; }
                table { width: 95%; margin: auto; border-collapse: collapse; font-size: 12px; margin-top: 4px; }
                th, td { border: 1px solid black; padding: 2px; }
                th { background-color: #f2f2f2; }
                .total-row { font-weight: bold; }
                .kot-footer { margin-top: 2px; text-align: center; font-size: 11px; }
                .bold { font-weight: bold; }
            </style>
        </head>
        <body>
            <div class="kot-container">
                <h2>
                    <span>${order[0].food_type}</span>
                    <span>Kitchen Order Ticket</span>
                    <span style="text-align: right;">${order[0].OrderDate}</span>
                </h2>
                <div class="kot-header">
                    <div class="left">
                        <p><strong>Order ID:</strong> ${order[0].OrderID}</p>
                        <p><strong>Customer:</strong> <span class="bold">${order[0].CustomerName}</span></p>
                        <p><strong>Contact:</strong> <span class="bold">${order[0].Phone3 || "N/A"}</span></p>
                    </div>
                    <div class="right">
                        <p><strong>Delivery Address:</strong> ${order[0].DeliveryAddress || "N/A"}</p>
                        <p><strong>Landmark:</strong> ${order[0].Landmark || ""}</p>
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th style="width: 65%;">Item Name</th>
                            <th style="width: 15%;">Qty</th>
                            <th style="width: 20%;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${generateItemRows(order)}
                    </tbody>
                </table>

                <div class="kot-footer">
                    <p>Thank you for your order!</p>
                </div>
            </div>
        </body>
        </html>
    `;

    kotWindow.document.open();
    kotWindow.document.write(kotContent);
    kotWindow.document.close();

    // Ensure the document is fully loaded before printing
    setTimeout(() => {
        kotWindow.focus();
        kotWindow.print();
        setTimeout(() => kotWindow.close(), 500);
    }, 500);
}


// Function to generate item rows with proper formatting
function generateItemRows(order) {
    let totalQuantity = 0;
    let totalAmount = 0;
    let rows = "";

    order.forEach((item) => {
        totalQuantity += parseInt(item.Quantity);
        totalAmount += parseFloat(item.TotalAmount);
        rows += `
            <tr>
                <td>${item.ItemName}</td>
                <td>${item.Quantity}</td>
                <td>₹${parseFloat(item.TotalAmount).toFixed(2)}</td>
            </tr>`;
    });

    rows += `
        <tr class="total-row">
            <td>Total</td>
            <td>${totalQuantity}</td>
            <td>₹${totalAmount.toFixed(2)}</td>
        </tr>`;

    return rows;
}




// Function to generate KOT PDF 
// function generateKOTPDF(order) {
//     const { jsPDF } = window.jspdf;
//     let doc = new jsPDF();

//     doc.setFontSize(18);
//     doc.text("KOT", 105, 15, { align: "center" });

//     doc.setFontSize(12);
//     doc.setFont("helvetica", "bold");
//     doc.text(`Customer Name: ${order.CustomerName}`, 10, 30);
//     doc.text(`Phone Number: ${order.Phone3}`, 150, 30);
//     doc.setFont("helvetica", "normal");
//     doc.text(`Delivery Address: ${order.DeliveryAddress}`, 10, 40);

//     let totalAmount = Number(order.TotalAmount) || 0;
//     let formattedTotal = totalAmount.toFixed(2);

//     let tableData = [
//         ["Food Type", "Qty", "Price"],
//         [order.food_type, order.Quantity, formattedTotal]
//     ];

//     doc.autoTable({
//         startY: 50,
//         head: [tableData[0]], // Headers
//         body: [tableData[1]]  // Data row
//     });

//     doc.save(`KOT_${order.OrderID}.pdf`);
// }




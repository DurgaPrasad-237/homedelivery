<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
        }

        .head {
            border: 2px solid black;
            height: 10vh;
            width: 100%;
            border: hidden;
            background-color: #FFC857;
        }

        .main_container {
            display: flex;
            flex-direction: row;
            width: 100%;
        }

        .register_form_wrapper {
            /* border-right:2px solid black; */
            height: 87vh;
            width: 30%;
            padding: 10px;
            display: flex;
            flex-direction: column;
            overflow: auto;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            background-color: #FFC857;
        }

        .register_form {
            height: 80vh;
        }

        .register_form_wrapper::-webkit-scrollbar {
            display: none;
        }

        .search_area {
            height: 5vh;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .search_input {
            width: 60%;
        }

        .btn_search {
            width: 20%;
        }

        .customerform,
        .order_list,
        .addresses_area {

            /* border-bottom: 2px solid black; */
            /* margin-top: 5vh; */
            height: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-direction: column;

        }

        .addresses_area,
        .form_tdylist {
            background-color: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.3);
            margin-top: 1vh;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Adds depth */
        }

        .regaddress_input {
            background-color: transparent;
        }

        .form_tdylist {
            height: 45%;
            padding: 10px;
            display: flex;
            flex-direction: row;
            /* background-color: white;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; */
            margin-top: 1vh;
            border-radius: 10px;

        }

        .customerform {
            width: 70%;
            margin-top: 0vh;
            ;
            /* border: 2px solid black; */
        }

        .input_row {
            /* border:2px solid black; */
            width: 80%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .customer_id,
        .customer_Name,
        .customer_Phone,
        .customer_Email,
        .payment_period {
            outline: none;
            border: none;
            border-bottom: 2px solid black;
            width: 70%;
            background-color: transparent;
        }

        .btngenerate {
            width: 30%;
            cursor: pointer;
            background-color: transparent;
            border-radius: 5px;
            padding: 5px;
        }

        .order_input_row {
            /* border:2px solid black; */
            width: 80%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .bf_quantity,
        .bf_price,
        .lunch_quantity,
        .lunch_price,
        .dinner_quantity,
        .dinner_price,
        .total_quantity,
        .total_price {
            width: 30%;
            outline: none;
            border: none;
            border-bottom: 2px solid black;
        }

        .order_list {
            height: 10%;
        }

        .addresses_area {
            height: 40%;
        }

        .quantity_price_area {
            display: flex;
            justify-content: space-between;
            flex-direction: row;
        }

        /* .total{
            width:80%;
        } */
        .addresses_area {
            flex-direction: row;
            height: 45%;
        }

        .delivery_area,
        .billing_area {
            /* border:2px solid black; */
            height: 100%;
            width: 50%;
            padding: 3px;
        }

        .address_input_area {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .address_input,
        .editbtn {
            width: 90%;
            border: none;
            border-bottom: 2px solid black;
            margin-top: 1.5vh;
        }

        .editbtn {
            background-color: rgba(201, 137, 18, 0.707);
            color: white;
            border: none;
            padding: 5px;
            cursor: pointer;

        }

        .sad_area {
            display: flex;
            flex-direction: row;
            width: 90%;
            align-items: center;
        }

        .sadtext {
            /* font-size: 10px; */
            font-size: 10px;
        }

        .input_checkbox {
            cursor: pointer;
        }

        .button_area {
            /* margin-top:5vh; */
            /* border:2px solid black; */
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .head {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .register,
        .Report {
            border: 2px solid white;
            padding: 10px;
            margin-left: 5vh;
            width: 10vw;
            text-align: center;
            cursor: pointer;
            border-radius: 10px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: bold;
            /* Smooth transitions */
        }

        .register:hover,
        .Report:hover {
            background-color: white;
            color: #FFC857;
            font-weight: bold;
        }

        .Report a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .Report:hover a {
            color: #FFC857;
        }




        /*  */
        .selection-container {
            display: flex;
            flex-direction: column;
            width: 69%;
            padding: 20px;
            background-color: white;
            /* border-radius: 10px; */
            /* box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); */
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            height: 87vh;
            overflow-y: scroll;
            position: relative;
            cursor: default;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .selection-container::-webkit-scrollbar {
            display: none;
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            gap: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-bottom: 2px solid #ddd;
            background-color: black;

        }

        .menu-button {
            padding: 10px 14px;
            font-size: 14px;
            border: 2px solid #000;
            border-radius: 5px;
            background-color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #ffc7574a;
            color:#FFC857;
            border:2px solid #ffc7574a;
        }

        .menu-button:hover {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            transform: scale(0.9);
        }

        .menu-button:active {
            background-color: #bbb;
        }

        .breakfast-box {
            padding: 10px;
            width: 97.5%;
            margin-left: 0%;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
            position:relative;
        }


        .amount-container {
            margin: 10px 0;
            display: flex;
            /* Use flexbox for horizontal alignment */
            align-items: center;
            /* Align items vertically at the center */
            gap: 10px;
            /* Add spacing between the label and input */
        }

        .amount-container label {
            font-size: 16px;
            margin-right: 0;
            /* Remove unnecessary margin */
            flex-shrink: 0;
            /* Ensure the label does not shrink */
        }

        .amount-container input {
            padding: 5px;
            /* Adjust padding for a compact design */
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 5px;
            width: auto;
            /* Let the input width adjust naturally */
            flex-grow: 1;
            /* Allow the input to grow to take available space */
        }

        .breakfast-table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        .breakfast-table th,
        .breakfast-table td {
            padding: 10px;
            text-align: left;
        }

        .breakfast-table th {
            background-color: gray;
            border-bottom: 2px solid #ddd;
        }

        .breakfast-table td label {
            margin-right: 15px;
            font-size: 16px;
        }

        #lunch-options-container {
            display: flex;
            flex-direction: column;
            /* Arrange options vertically */
            gap: 15px;
            /* Add spacing between options */
        }

        .lunch-option {
            display: flex;
            /* Arrange elements in a single line */
            align-items: center;
            /* Align items vertically in the center */
            justify-content: flex-start;
            /* Ensure proper alignment for name and buttons */
            font-size: 16px;
            /* Slightly larger text for readability */
            padding: 5px;
            /* Add some space around each option */
            border-bottom: 1px solid #ddd;
            /* Light divider for each row */
        }

        .lunch-option span {
            font-size: 16px;
            /* Match text size with options */
            color: #333;
            /* Neutral color for the text */
            flex-grow: 1;
            /* Allow the text to take available space */
        }

        /* Buttons styling for + and - */
        .increment-button,
        .decrement-button {
            background: none;
            /* Remove background color */
            color: #007bff;
            /* Use a clean blue color for the text */
            border: none;
            /* No border for a minimalist design */
            cursor: pointer;
            /* Pointer cursor for clickability */
            font-size: 18px;
            /* Slightly larger font for better visibility */
            font-weight: bold;
            /* Bold text for emphasis */
            transition: transform 0.2s ease, color 0.3s ease;
        }

        /* Hover and Active states for buttons */
        .increment-button:hover,
        .decrement-button:hover {
            color: #0056b3;
            /* Darker blue on hover for a subtle effect */
            transform: scale(1.2);
            /* Slight zoom effect */
        }

        .increment-button:active,
        .decrement-button:active {
            transform: scale(1);
            /* Return to normal size on click */
        }

        /* Count Styling */
        .count {
            font-size: 16px;
            /* Count text size */
            color: #444;
            /* Slightly darker text color for the count */
            margin-left: 10px;
            /* Space between button and count */
            font-weight: bold;
            /* Emphasize count */
            order: 2;
            /* Ensure count appears after the + button and before the - button */
        }

        /* Specific Button Orders */
        .lunch-option .increment-button {
            order: 1;
            /* Make the + button appear first */
        }

        .lunch-option .decrement-button {
            order: 3;
            /* Make the - button appear last */
        }

        /* Styling for the amount container (Add Extra button) */
        .amount-container {
            margin-top: 10px;
            display: flex;
            justify-content: flex-start;
        }

        #add-extra {
            background: none;
            border: 1px solid #007bff;
            color: #007bff;
            padding: 5px 15px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        #add-extra:hover {
            background-color: #007bff;
            color: white;
        }

        #add-extra:active {
            background-color: #0056b3;
            color: white;
        }

        .breakfast-container {
            display: flex;

            gap: 10px;
            margin-top: 10px;
        }

        .breakfast-item {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .item-input,
        .amount-input,
        .bf-quantity {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 150px;
        }

        .amount-input,
        .bf-quantity {
            width: 100px;
        }

        .lunch-options-container {
            height: 60vh;
            width: 100%;
            /* border: solid orangered 4px; */
            overflow: auto;
            box-sizing: border-box;
            /* border-radius: 10px; */
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: white;
            margin: -20px 10px 10px 10px;
            margin-top: 1%;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 0 5px 5px 5px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
            border-radius: 5px;
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
            text-align: center;
        }

        table th:nth-child(1),
        table th:nth-child(2) {
            width: 65px;
        }

        table td {
            padding: 8px;
            width: fit-content;
            min-width: 110px;
        }

        table td:nth-last-child(1) {
            width: 90px;
            max-width: 130px;
        }

        #tableqty,
        .tableqty,
        .tableqtyd {
            width: 50px;
            margin-left: 10px;
        }

        .reason {
            width: 250px;
        }

        /* table tr:hover {
            /* background-color: #007bff; 
            color: white;
        } */
        .lunch-options-container::-webkit-scrollbar {
            display: none;
        }

        thead {
            background-color: gray;
            position: sticky;
            top: -20px;
            bottom: 0;
            z-index: 1;
        }

        /* #insert-button {
            width: 110px;
            padding: 5px 15px;
            position: fixed;
            top: 185px;
            right: 28px;
            display: none;
        } */

        #mealqty,
        #mealqtyd,
        #mealqtyl {
            width: 50px;
            height: 30px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0 0px 0 10px;
            margin: 5px;
            box-sizing: border-box;
        }

        #mealamt,
        #mealamtd,
        #mealamtl,
        #mealamount {
            width: 80px;
            height: 30px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0 0px 0 10px;
            margin: 5px;
            box-sizing: border-box;

        }

        .period {
            display: flex;
            font-size: 14px;
            align-items: center;
            justify-content: space-around;
            gap: 16px;
            border: #ccc 2px solid;
            padding: 10px;
        }

        .period input[type=date] {
            padding: 5px;
            border: #ccc 2px solid;
            border-radius: 6px;
            font-size: 14px;
        }

        /* .edit-button {
            width: 90px;
            padding: 5px 10px;
            height: 40px;
            border-radius: 5px;
            align-self: center;

        } */

        .edit-tables {
            display: flex;
            flex-direction: row;
            gap: 5%;
            justify-content: space-evenly;
            margin-top: 5%;
        }

        .edit-box {
            display: flex;
            flex-direction: column;
        }

        #edit-breakfast,
        #edit-lunch,
        #edit-dinner {
            font-size: 14px;
        }

        #edit-breakfast td,
        #edit-breakfast th,
        #edit-lunch th,
        #edit-lunch td,
        #edit-dinner th,
        #edit-dinner td {
            min-width: 75px;
            width: 75px;
            max-width: 75px;
            text-align: center;
        }


        #edit-breakfast td:nth-child(3),
        #edit-breakfast th:nth-child(3),
        #edit-lunch td:nth-child(3),
        #edit-lunch th:nth-child(3) #edit-dinner th:nth-child(3),
        #edit-dinner td:nth-child(3) {
            min-width: 40px;
            width: 40px;
            max-width: 40px;
        }

        .edit-tables {
            overflow-x: scroll;
            height: 50vh;
        }

        .edit-tables::-webkit-scrollbar {
            display: none;
        }


        h3 {
            font-size: 15px;
        }

        .multiple_list {
            /* position: absolute;
    border: 2px solid black;
    max-height: 30vh;
    width: auto; 
    min-width: 35vw; 
    top: 30%;
    overflow: hidden; */
            display: none;
            margin-top: 5vh;
            /* background-color: white; */
        }

        /*.scrollable_table {
    border-collapse: collapse;
    width: 100%;
}

.scrollable_table thead {
    position: sticky;
    top: 0;
    background-color: #f1f1f1;
    z-index: 1;
}

.scrollable_table th,
.scrollable_table td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
    white-space: nowrap; 
}

.tablebody {
    display: block;
    max-height: calc(30vh - 40px);
    overflow-y: auto;
    overflow-x: hidden; 
}

.scrollable_table tbody tr {
    display: table;
    width: 100%; 
    table-layout: auto;
}

.multiple_list tbody::-webkit-scrollbar {
    width: 0;
    background: transparent;
}

.scrollable_table thead tr {
    display: table;
    width: 100%;
    table-layout: auto; 
} */




        .scbtn,
        .bscbtn {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 90%;
            display: none;
        }

        .scbtn button,
        .bscbtn button {
            background-color: transparent;
            width: 5vw;
            padding: 4px;
            margin: 1vh;
        }

        .scbtn button:nth-child(1),
        .bscbtn button:nth-child(1) {
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
        }

        .scbtn button:nth-child(2),
        .bscbtn button:nth-child(2) {
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
        }

        #billing_link {
            visibility: hidden;
        }

        .reg_address {
            /* border:2px solid black; */
            /* padding: 10px; */
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-around;
            width:100%;
        }

        .reg_address input {
            margin: 2px 2px;
            outline: none;
            border: none;
            border-bottom: 2px solid black;
            width:120px;
        }

        .reg_address input:nth-child(6) {
            visibility: hidden;
        }

        .date-container {
            font-family: Arial, sans-serif;
            text-align: center;
            justify-self: end;
            margin-left: 60%;
            /* margin-top: 20px; */
            /* position: relative;
            right: -59%;
            top: 18px; */
            /* border:2px solid black */
        }

        .date {
            font-size: 1rem;
            font-weight: bold;
        }

        .day {
            font-size: 1rem;
            color: gray;
        }

        .edit-head {
            text-align: center;
            text-decoration: underline;
        }



        .today_list {
            width: 30%;
        }

        .toheading {
            text-align: center;
        }

        .headingtdy,
        .today_order,
        .totaltoday {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            height: 20%;
            align-items: center;

        }

        .today_order h3 {
            width: 15%;
        }

        .today_order .qty {
            width: 10%;
        }

        .today_order .amt {
            width: 30%;
            text-align: end;
        }

        .totaltoday {
            border-top: 2px solid black;
        }

        .totaltoday h3 {
            width: 15%;
        }

        .totaltoday .fqty {
            width: 10%;
        }

        .totaltoday .famt {
            width: 30%;
            text-align: end
        }

        .hiden {
            visibility: hidden;
            width: 5%;
            border: 2px solid black
        }

        .todaycontainer {
            display: flex;
            flex-direction: column;

            height: 75%;
        }

        .table-container {
            display: flex;
            flex-direction: row;
            gap: 5px;

        }

        .bfhead {
            display: flex;
            flex-direction: row;
            background-color: #e4a300;
            padding: 10px;
            align-items: center;
            gap: 50px;
            color: white;
            border-radius: 4px;
            margin-bottom: 4px;
            justify-content: space-evenly;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 0 5px 5px 5px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
            border-radius: 5px;
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
        }

        table td {
            padding: 4px;
            width: fit-content;
            min-width: 35px;
        }

        table td:nth-last-child(1) {
            width: 16px;
            max-width: fit-content;
        }

        #tableqty,
        .tableqty {
            width: 50px;
        }
          /* #lunch-table td {
            min-width: 80px;
            width:80px;
         

        } */
         /* #lunch-table td:nth-child(1){
            min-width: 90px;
            width:90px;} */
            #lunch-table th:nth-child(1){
            min-width: 80px;
            width:80px;}
         
         .reason-input  {
            min-width:52px;
            width:52px;


        }
        #lunch-table th:nth-child(2), 
        #lunch-table td:nth-child(3),
        #lunch-table th:nth-child(4),
        #lunch-table td:nth-child(5),
        #lunch-table th:nth-child(6), 
        #lunch-table td:nth-child(7),
        #lunch-table th:nth-child(8),
        #lunch-table td:nth-child(9),
        #lunch-table td:nth-child(10) {
        width: 50px; /* First column */
        }
        .food_details{
            border:2px solid black;
            height:80vh;
            width:100%;
            display:none;
        }
        .show_fdbtn{
            background-color: transparent;
            border: 2px solid #FFC857;
            color:#FFC857;
            width:100px;
            height:40px;
            align-self: center;
            justify-self:flex-end;
        }
        .show_fdbtn:hover{
            background-color: #FFC857;
            color:white;
            cursor:pointer;
            transition: background-color 0.4s ease, color 0.4s ease;
        }
        #summary-modal {
            display: none;
            position: fixed;
            top: 20%;
            left: 40%;
            width: 50%;
            background: white;
            border: 1px solid #ccc;
            padding: 20px;
            z-index: 100;
            border-radius: 10px;
            max-height: 82vh;
            height: 68vh;
        }

        .dialog-container th {
            min-width: 100px;
            max-width: 130px;
        }

        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
        }

        #closesummary {
            float: right;
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
            margin-top: -50px;
        }

        .selection-container-b {
            display: flex;
            flex-direction: column;
            width: 96%;
            padding: 15px;
            background-color: white;
            border-radius: 10px;
            /* box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); */
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            height: 50vh;
            overflow-y: scroll;
            position: relative;
            cursor: default;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .selection-container::-webkit-scrollbar {
            display: none;
        }

        .button-container-b {
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-bottom: 2px solid #ddd;

        }

        #mealqtyb,
        #mealqtydb,
        #mealqtylb {
            width: 45px;
            height: 30px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0 0px 0 10px;
            margin: 5px;
            box-sizing: border-box;
        }

        #mealamtb,
        #mealamtdb,
        #mealamtlb,
        #mealamountb {
            width: 70px;
            height: 30px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0 0px 0 10px;
            margin: 5px;
            box-sizing: border-box;

        }

        .menu-button-b {
            padding: 10px 14px;
            font-size: 14px;
            border: 2px solid #000;
            border-radius: 5px;
            background-color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .menu-button-b:hover {
            background-color: #ddd;
            border-color: #444;
        }

        .menu-button-b:active {
            background-color: #bbb;
        }

        #insert-button,
        #cancel-button{
            background-color: #557e8f;
            color: white;
            padding: 6px 12px;
            border: 1px solid grey;
            border-radius: 4px;
        }

        #cancel-button{
            background-color: grey;
        }

        .buttons{
            display: flex;
            justify-content: space-between;
            padding: 10px;
            margin-top: 1%;
        }
        #breakfast-box-b{
            display: none;
        }
        /* .placeorderbtn{
            margin-left: 20vw;
        } */
    </style>
</head>

<body>
    <header class="head">
        <div class="register" id="register">Register</div>
        <div class="Report"><a href="reports.php">Report</a></div>
        <div class="date-container">
            <div class="date" id="formatted-date"></div>
            <div class="day" id="day-name"></div>
        </div>
    </header>
    <section class="main_container">

        <div class="register_form_wrapper">
            <div class="register_form">
                <div class="search_area">
                    <select id="search_method">
                        <option value="CustomerID">CustomerID</option>
                        <option value="Customer Name">Customer Name</option>
                        <option value="Phone Number">Phone Number</option>
                    </select>
                    <input type="" placeholder="Enter Here" class="search_input" id="search_input">
                    <button class="btn_search" id="btn_search">Search</button>
                </div>

                <!-- multiple list -->
                <div class="multiple_list">
                    <table class="scrollable_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Delivery Address</th>
                            </tr>
                        </thead>
                        <tbody class="tablebody">
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>

                <div class="form_tdylist">
                    <div class="customerform" id="customerform">
                        <div class="input_row" id="customer_div_id">
                            <label>ID:</label>
                            <input disabled class="customer_id">
                        </div>
                        <div class="input_row">
                            <label>Name:</label>
                            <input disabled class="customer_Name" id="customer_name">
                        </div>
                        <div class="input_row">
                            <label>Phone:</label>
                            <input disabled class="customer_Phone" id="customer_phone">
                        </div>
                        <div class="input_row">
                            <label>Email:</label>
                            <input disabled class="customer_Email" id="customer_email">
                        </div>
                        <!-- <div class="input_row" id="selectionperiod">
                            <label>Period:</label>
                            <select class="payment_period" id="payment_period">

                            </select>
                        </div> -->
                        <div class="reg_address">
                            <input placeholder="flatno/houseno" class="regaddress_input" id="regflat">
                            <input placeholder="Street" class="regaddress_input" id="regstreet">
                            <input placeholder="Area" class="regaddress_input" id="regarea">
                            <input placeholder="Delivery_Mobile" class="regaddress_input" id="regdmobile">
                            <input placeholder="Address link" class="regaddress_input" id="reglink">
                            <input placeholder="Address link" class="regaddress_input">
                        </div>
                        <button class="btngenerate" id="Submit">Submit</button>
                    </div>
                    <div class="today_list">
                        <h3 class="toheading">Today Order</h3>
                        <div class="todaycontainer">
                            <div class="headingtdy">
                                <h3 class="hiden">SP</h3>
                                <p class="qtyhd ">Quantity</p>
                                <p class="qtypr">Price</p>
                            </div>
                            <!-- <div class="bftoday">
                            <h3>BF</h3>
                            <p>2</p>
                            <p>10</p>
                        </div>
                        <div class="lunchtoday">
                            <h3>LN</h3>
                            <p>2</p>
                            <p>10</p>
                        </div>
                        <div class="dinnertoday">
                            <h3>DN</h3>
                            <p>2</p>
                            <p>10</p>
                        </div>
                        <div class="totaltoday">
                            <h3>TL</h3>
                            <p>2</p>
                            <p>10</p>
                        </div> -->
                        </div>

                    </div>
                </div>


                <div class="addresses_area">
                    <div class="delivery_area" id="delivery_area">
                        <h3>Delivery Address</h3>
                        <div class="address_input_area">
                            <input placeholder="flatno/houseno" class="address_input" id="address_flat" disabled>
                            <input placeholder="Street" class="address_input" id="address_street" disabled>
                            <input placeholder="Area" class="address_input" id="address_area" disabled>
                            <input placeholder="Mobile" class="address_input" id="address_mobile" disabled>
                            <input placeholder="Address link" class="address_input" id="address_link" disabled>
                            <button class="editbtn" id="deditbtn">Edit</button>
                            <div class="scbtn">
                                <button id="dsbtn">Save</button>
                                <button id="dcbtn">Cancel</button>
                            </div>  
                        </div>
                    </div>
                    <div class="billing_area">
                        <div class="sad_area">
                            <h3>Billing</h3><input type="checkbox" class="input_checkbox" id="input_checkbox">
                            <p class="sadtext">Same as Delivery Address</p>
                        </div>
                        <div class="address_input_area">
                            <input placeholder="flatno/houseno" class="address_input" id="billing_flat" disabled>
                            <input placeholder="Street" class="address_input" id="billing_street" disabled>
                            <input placeholder="Area" class="address_input" id="billing_area" disabled>
                            <input placeholder="Mobile" class="address_input" id="billing_mobile" disabled>
                            <input placeholder="Address link" class="address_input" id="billing_link" disabled>
                            <button class="editbtn" id="beditbtn">Edit</button>
                            <div class="bscbtn">
                                <button id="bsbtn">Save</button>
                                <button id="bcbtn">Cancel</button>
                            </div>

                        </div>
                    </div>

                </div>


                <!-- <div class="button_area">
                    <button>Place Order</button> -->
                    <!-- <button>Save Edit</button> -->
                    <!-- <button>Cancel Order</button>
                </div> -->


            </div>
        </div>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        let register = document.getElementById('register');
        let customerform = document.getElementById('customerform');
        let searchbtn = document.getElementById('btn_search');
        let searchinput = document.getElementById('search_input');
        let orderlist = document.querySelector('.order_list')
        let addressarea = document.querySelector('.addresses_area')
    //    let buttonarea = document.querySelector('.button_area')
        let generatebtn = document.querySelector('.btngenerate');
        let customerid = document.getElementById('customer_div_id')
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
        let finaldeliveryaddress;
        let intialdeliveryaddress;
        let regflat = document.getElementById('regflat')
        let regstreet = document.getElementById('regstreet')
        let regarea = document.getElementById('regarea')
        let reglink = document.getElementById('reglink')
        let regmobile = document.getElementById('regdmobile')
        let finalamount = 0;
        let finalquantity = 0;
        let existingOrders = [];
        let lunchidsprice = [];
        let binitialqty = 0;
        let binitialamt = 0;
        let dinitialqty = 0;
        let dinitialamt = 0;



        $(document).ready(intialload())

        

        //function for load periodicity
        function loadperiodicity() {

            var payload = {
                load: "loadperiodicity"
            }

            $.ajax({
                type: "POST",
                url: "./webservices/register.php",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function(response) {
                    if (response.status === "Success") {
                        periodarr = response.data;
                        console.log(periodarr);
                        let selectElement = document.querySelector('.payment_period');
                        let selectperiod = document.getElementById('selectionperiod')
                        selectElement.innerHTML = "<option>select</option>";
                        periodarr.forEach(per => {
                            const option = document.createElement('option');
                            option.value = per.sno;
                            option.textContent = per.period;

                            // Append the option to the select element
                            selectElement.appendChild(option);
                        })
                        console.log(selectElement);

                    }
                },
                error: function(err) {
                    console.log(err);
                }
            })

        }

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
            loadperiodicity();

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
            customerid.style.display = "flex";
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
        function billingdisabled() {
            document.getElementById("billing_flat").disabled = true;
            document.getElementById("billing_street").disabled = true
            document.getElementById("billing_area").disabled = true
            document.getElementById("billing_mobile").disabled = true
            document.querySelector('.bscbtn').style.display = "none";
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
        function deliverydisabled() {
            document.getElementById("address_flat").disabled = true;
            document.getElementById("address_street").disabled = true
            document.getElementById("address_area").disabled = true
            document.getElementById("address_mobile").disabled = true
            document.getElementById("address_link").disabled = false
            document.querySelector('.scbtn').style.display = "none";
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
                    if (response.status === "Success") {
                        console.log("today", response.data);
                        let todaycontainer = document.querySelector('.todaycontainer');
                        todaycontainer.innerHTML = "";
                        response.data.forEach(itm => {
                            console.log(itm);
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
                        })
                        let totaldiv = document.createElement('div');
                        totaldiv.setAttribute('class', 'totaltoday');
                        totaldiv.innerHTML = `
                                <h3>TL</h3>
                                <p class="fqty">${totalquantity}</p>
                                <p class="famt">${finalamount}</p>
                            
                      `
                        todaycontainer.append(totaldiv);

                        console.log("finalamount", todaycontainer)



                        console.log(todaycontainer);
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
            enableinputs();
            customername.value = "";
            email.value = "";
            primaryphone.value = "";

        })

        //function for register
        submit.addEventListener('click', () => {
            if (!customername.value || !primaryphone.value || !email.value || !periodicity.value || !regflat.value || !regstreet.value ||
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
            regaddress = regflat.value + "," + regstreet.value + "," + regarea.value;

            var payload = {
                customername: customername.value,
                primaryphone: primaryphone.value,
                email: email.value,
                periodicity: periodicity.value,
                deliveryaddress: regaddress,
                map: reglink.value,
                deliveryphone: regmobile.value,
                load: "register",

            }

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
                            } else {
                                document.getElementById("address_flat").value = ""
                                document.getElementById("address_street").value = ""
                                document.getElementById("address_area").value = ""
                                document.getElementById("address_mobile").value = ""
                                document.getElementById('address_link').value = ""
                            }



                            displaydetails();
                            setInterval(todayorderdetails(cust.CustomerID), 2000);
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
                                customername.value = cust.CustomerName.trim();
                                primaryphone.value = cust.Phone1
                                email.value = cust.Email
                                periodicity.value = cust.Periodicity.trim();
                                intialdeliveryaddress = cust.DeliveryAddress + "," + cust.Phone3 + "," + cust.Map;
                                console.log(cust.DeliveryAddress);
                                if (cust.BillingAddress !== null) {
                                    const baddressarray = cust.BillingAddress.split(",");
                                    document.getElementById("billing_flat").value = baddressarray[0]
                                    document.getElementById("billing_street").value = baddressarray[1]
                                    document.getElementById("billing_area").value = baddressarray[2]
                                    document.getElementById("billing_mobile").value = cust.Phone2
                                }

                                if (cust.DeliveryAddress !== null) {
                                    console.log(cust.DeliveryAddress)
                                    const daddressarray = cust.DeliveryAddress.split(",");
                                    document.getElementById("address_flat").value = daddressarray[0]
                                    document.getElementById("address_street").value = daddressarray[1]
                                    document.getElementById("address_area").value = daddressarray[2]
                                    document.getElementById("address_mobile").value = cust.Phone3
                                    document.getElementById('address_link').value = cust.Map;
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
                                customername.value = cust.CustomerName.trim();
                                primaryphone.value = cust.Phone1
                                email.value = cust.Email
                                periodicity.value = cust.Periodicity.trim();
                                intialdeliveryaddress = cust.DeliveryAddress + "," + cust.Phone3 + "," + cust.Map;
                                console.log(cust.DeliveryAddress);
                                if (cust.BillingAddress !== null) {
                                    const baddressarray = cust.BillingAddress.split(",");
                                    document.getElementById("billing_flat").value = baddressarray[0]
                                    document.getElementById("billing_street").value = baddressarray[1]
                                    document.getElementById("billing_area").value = baddressarray[2]
                                    document.getElementById("billing_mobile").value = cust.Phone2
                                }

                                if (cust.DeliveryAddress !== null) {
                                    console.log(cust.DeliveryAddress)
                                    const daddressarray = cust.DeliveryAddress.split(",");
                                    document.getElementById("address_flat").value = daddressarray[0]
                                    document.getElementById("address_street").value = daddressarray[1]
                                    document.getElementById("address_area").value = daddressarray[2]
                                    document.getElementById("address_mobile").value = cust.Phone3
                                    document.getElementById('address_link').value = cust.Map;
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
            } else {
                // alert("false")
            }

        })

        //edit delivery address
        dedit.addEventListener('click', () => {
            document.querySelector('.scbtn').style.display = "flex";
            dedit.style.display = "none";
            deliveryenabled();

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

                var payload = {
                    deliveryaddress: addressflat + "," + addressstreet + "," + addressarea,
                    deliveryphone: deliverymobile,
                    map: addresslink,
                    customerid: customerid,
                    load: "add_delivery_address"
                }
                console.log(payload);
                $.ajax({
                    type: "POST",
                    url: "./webservices/register.php",
                    data: JSON.stringify(payload),
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "Success") {
                            alert("Successfully updated")
                            deliverydisabled();
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
                deliverydisabled();
            })
        })

        //edit billing address
        bedit.addEventListener('click', () => {
            document.querySelector('.bscbtn').style.display = "flex";
            bedit.style.display = "none";
            billingenabled();

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
                        if (response.status === "Success") {
                            alert("Successfully updated")
                            billingdisabled();
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
                billingdisabled();
            })
        })





        // ------------------------------------------------------
        let bval = 0;
        let dval = 0;
        let foodidb = 0;
        let foodidd = 0;
        let foodidl = 0;
        let catid = 0;

        async function placeorder(event) {

            const addressflat = document.getElementById("address_flat").value;
            const addressstreet = document.getElementById("address_street").value;
            const addressarea = document.getElementById("address_area").value
            const deliverymobile = document.getElementById("address_mobile").value;
            const addresslink = document.getElementById("address_link").value;

            const baddressflat = document.getElementById("billing_flat").value;
            const baddressstreet = document.getElementById("billing_street").value;
            const baddressarea = document.getElementById("billing_area").value
            const billingmobile = document.getElementById("billing_mobile").value;

            const custid = document.querySelector(".customer_id").value;


            finaldeliveryaddress = addressflat + "," + addressstreet + "," + addressarea + "," + deliverymobile + "," + addresslink;
            billingaddress = baddressflat + "," + baddressstreet + "," + baddressarea;

            if (!custid) {
                alert("No user selected")
                return;
            }

            if (!addressflat || !addressstreet || !addressarea || !deliverymobile || !addresslink) {
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
                finaldeliveryaddress = addressflat + "," + addressstreet + "," + addressarea
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

            const bqty = calculateTotalBB();
            const lqty = Number(document.getElementById("mealqtylb").value) || 0;
            const dqty = calculateTotalDB();

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
                periodicity: document.getElementById('payment_period').value,
                billingaddress: billingaddress,
                deliveryaddress: finaldeliveryaddress,
                deliverymobile: document.getElementById('address_mobile').value,
                billingmobile: document.getElementById('billing_mobile').value,
                map: document.getElementById('address_link').value
            };
            console.log("NObody can scratch me", payload);

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
    cid: customerid
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
            const row = $('<tr>');
            row.html(`
<td>${x.Date}</td>
<td>
<input type='number' min='0' class='tableqty' id='tableqty-${x.Date.replaceAll('-', '')}' 
    data-optionid='${x.OptionID}' data-price='${x.Price}' data-index='${index}' data-category='${x.category}'
    data-initial='${x.Quantity}' value='${x.Quantity}' readonly>
</td>
<td><input type='text' class='reason' id='reason-${x.Date.replaceAll('-', '')}'></td>
<td><button class="table-btn" onclick="update('${x.Date}', this,'${x.category}','${x.OptionID}','${x.Price}','${x.OrderID}')" disabled>Edit</button></td>
`);
            table1Body.append(row);
        });

        // Append data for the second table (next 15 rows)
        response.data.slice(15, 30).forEach((x, index) => {
            const row = $('<tr>');
            row.html(`
<td>${x.Date}</td>
<td>
<input type='number' min='0' class='tableqty' id='tableqty-${x.Date.replaceAll('-', '')}' 
    data-optionid='${x.OptionID}' data-price='${x.Price}' data-index='${index}'  data-category='${x.category}'
    data-initial='${x.Quantity}' value='${x.Quantity}' readonly>
</td>
<td><input type='text' class='reason' id='reason-${x.Date.replaceAll('-', '')}'></td>
<td><button class="table-btn" onclick="update('${x.Date}', this,'${x.category}','${x.OptionID}','${x.Price}','${x.OrderID}')" disabled>Edit</button></td>
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
        initialQuantitySumB = calculateTotalSum('.tableqty');
        $('.tableqty').on('input', calculateTotalB); // Optional calculation

        $('#breakfast-contain').show();
    },
    error: function(error) {
        console.error('Error fetching data:', error);
    }
});
}

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
            const row = $('<tr>');
            row.html(`
        <td>${x.Date}</td>
        <td>
            <input type='number' min='0' class='tableqtyd' id='tableqtyd-${x.Date.replaceAll('-', '')}' 
                data-optionid='${x.OptionID}' data-price='${x.Price}' data-index='${index}'  data-category='${x.category}'
                data-initial='${x.Quantity}' value='${x.Quantity}' readonly>
        </td>
        <td><input type='text'  class='reason' id='reason-${x.Date.replaceAll('-', '')}'></td>
        <td><button class="table-btn" onclick="update('${x.Date}', this,'${x.category}','${x.OptionID}','${x.Price}','${x.OrderID}')" disabled>Edit</button></td>
    `);
            table1Body.append(row);
        });

        // Append data for the second table (next 15 rows)
        response.data.slice(15, 30).forEach((x, index) => {
            const row = $('<tr>');
            row.html(`
        <td>${x.Date}</td>
        <td>
            <input type='number' min='0' class='tableqtyd' id='tableqtyd-${x.Date.replaceAll('-', '')}' 
                data-optionid='${x.OptionID}' data-price='${x.Price}' data-index='${index}'  data-category='${x.category}'
                data-initial='${x.Quantity}' value='${x.Quantity}' readonly>
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
        initialQuantitySumD = calculateTotalSum('.tableqtyd');
        $('.tableqtyd').on('input', calculateTotalD); // Optional calculation for dinner total

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
                            style="width:240px">
                    </td>
                    <td>
                        <button class="edit-button" 
                                data-tdate="${formattedDate}" 
                                onclick="updateOrder(this)" 
                                ${rowData.length === 0 ? 'disabled' : ''}>
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

            document.querySelector("#lunch-options-container").style.display = "block";
        },
        error: function(error) {
            console.error("Error fetching data:", error);
            document.querySelector("#lunch-options-container").style.display = "block";
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
                    console.log("2729",response,response.data.length);
                    thlength=response.data.length;

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


        function update(Date, btn, category, optionid, price, orderid) {

const row = $(btn).closest('tr');
const tname = (category === "1") ? "#tableqty" : "#tableqtyd"
const input = row.find('.tableqty, .tableqtyd');
const quantity = parseInt(input.val(), 10) || 0;
const currentValue = parseInt(input.val(), 10) || 0; // Current value
const initialValue = parseInt(input.data('initial'), 10) || 0; 
// const category =row.find(`#tableqtyd-${Date.replaceAll('-', '')}`).data('category');  
// const optionid =row.find(`#tableqtyd-${Date.replaceAll('-', '')}`).data('optionid'); 
const newQuantity = row.find(`${tname}-${Date.replaceAll('-', '')}`).val(); // Access the input field value
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
    date: Date, // Pass the date
    quantity: newQuantity,
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
        alert(response.message); // Show the error message from the backend

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

        function showLunch() {
            document.getElementById("breakfast-box").style.display = "none";
            document.getElementById("lunch-box").style.display = "block";
            document.getElementById("dinner-box").style.display = "none";
            document.getElementById("insert-button").style.display = "block";
            document.getElementById("edit-box").style.display = "none";
            document.querySelector('.food_details').style.display = "none";
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


        let initialQuantitySumB = 0;
        let initialQuantitySumD = 0;

        function calculateTotalB() {
            let totalAmount = 0;
            let totalQuantity = 0;
            let bqty = 0;

            const currentQuantitySum = calculateTotalSum('.tableqty');
            const today = new Date().toISOString().split('T')[0];
            $('.tableqty').each(function() {
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
            $('#mealamt').val(totalAmount.toFixed(2));
            $('#mealqty').val(totalQuantity);

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
            const currentQuantitySum = calculateTotalSum('.tableqtyd');

            // Get today's date in the format used in the table
            const today = new Date().toISOString().split('T')[0];

            // Iterate through all .tableqtyd elements
            $('.tableqtyd').each(function() {
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
            $('#mealamtd').val(totalAmount.toFixed(2));
            $('#mealqtyd').val(totalQuantity);

            return dqty;
        }




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
                            foodtypeid: 2 ,
                            cid : customerid
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
        $(document).on('input', '#lunch-table tbody input[type="number"]', function() {
            updateLunchTotal(); // Update total when any quantity changes
        });




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
        $(document).on('input', '#lunch-table tbody input[type="number"]', function () {
            updateLunchQuantity();
        });


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
            if(!cid){
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
        document.getElementById("mealqtyb").value = binitialqty;
        document.getElementById("mealamtb").value = binitialamt;
        document.getElementById("mealqtydb").value = dinitialqty;
        document.getElementById("mealamtdb").value = dinitialamt;

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



    // function showBreakfastB() {
    //     document.getElementById("breakfast-box-b").style.display = "block";
    //     document.getElementById("lunch-box-b").style.display = "none";
    //     document.getElementById("dinner-box-b").style.display = "none";
    // }
    function showBreakfastB() {
        binitialqty = document.getElementById("mealqtyb").value;
        binitialamt = document.getElementById("mealamtb").value;
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
    }

    // function showDinnerB() {
    //     document.getElementById("breakfast-box-b").style.display = "none";
    //     document.getElementById("lunch-box-b").style.display = "none";
    //     document.getElementById("dinner-box-b").style.display = "block";
    // }
    function showDinnerB() {
        dinitialqty = document.getElementById("mealqtydb").value;
        dinitialamt = document.getElementById("mealamtdb").value;
        document.getElementById("breakfast-box-b").style.display = "none";
        document.getElementById("lunch-box-b").style.display = "none";
        document.getElementById("dinner-box-b").style.display = "block";
        const radioBtn = document.querySelector('input[name="dinner-category-b"][value="categoryd1d"]');
        if (radioBtn) {
            radioBtn.checked = true; 
        }
    }

    function calculateTotalBB() {
            let totalAmount = 0;
            let totalQuantity = 0;

            $('.tableqtyb').each(function() {
                const quantity = parseFloat($(this).val()) || 0;
                const price = parseFloat($(this).data('price')) || 0;
                totalAmount += quantity * price;
                totalQuantity += quantity;
            });

            $('#mealamtb').val(totalAmount.toFixed(2));
            $('#mealqtyb').val(totalQuantity);

            return totalQuantity;
        }

        function calculateTotalDB() {
            let totalAmount = 0;
            let totalQuantity = 0;

            $('.tableqtydb').each(function() {
                const quantity = parseFloat($(this).val()) || 0;
                const price = parseFloat($(this).data('price')) || 0;
                totalAmount += quantity * price;
                totalQuantity += quantity;

            });

            $('#mealamtdb').val(totalAmount.toFixed(2));
            $('#mealqtydb').val(totalQuantity);

            return totalQuantity;
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

                    $('.tableqtyb').on('input', calculateTotalBB);
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
                     <td><input type='number' class='tableqtydb' id='tableqtyb' data-price='${x.Price}' data-index='${index}' min='0' value='0'></td>
                `);

                        foodidd = `${x.OptionID}`;
                        chargesTableBody.append(row);
                    });
                    document.querySelector('.tableqtydb').value = document.getElementById('mealqtydb').value;
                    $('.tableqtydb').on('input', calculateTotalDB);
                    // Show the breakfast container after loading the data
                    $('#dinner-container-b').show();
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

//         async function submitForB(event) {
//     const quantity = $('#mealqtyb').val();
//     const totalAmount = $('#mealamtb').val();
//     const fromDate = $('#from-date-b').val();
//     const toDate = $('#to-date-b').val();

//     const currentDate = new Date();
//     const dayOfWeek = currentDate.getDay();
//     const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
//     const dayName = dayNames[dayOfWeek];

//     let payload = {
//         load: 'setitemsb',
//         quantity: quantity,
//         category: 1,
//         totalAmount: totalAmount,
//         foodid: foodidb,
//         cid: customerid,
//         day: dayName,
//         dates: []
//     };

//     if (quantity < 0) {
//         throw new Error('Invalid quantity for breakfast.');
//     }
//     if (fromDate && toDate) {
//         const from = new Date(fromDate);
//         const to = new Date(toDate);
//         if (from > to) {
//             alert('Invalid date range.');
//             throw new Error('Invalid date range for breakfast.');
//         }
//         let current = new Date(from);
//         while (current <= to) {
//             payload.dates.push(current.toISOString().split('T')[0]); // Format date as YYYY-MM-DD
//             current.setDate(current.getDate() + 1);
//         }
//     } else {
//         payload.dates.push(new Date().toISOString().split('T')[0]);
//     }

//     console.log('Payload for Breakfast:', payload);

//     return $.ajax({
//         type: 'POST',
//         url: './webservices/dinner.php',
//         dataType: 'json',
//         data: JSON.stringify(payload)
//     }).then(response => {
//         if (response.status !== 'success') {
//             throw new Error(response.message);
//         }
//         alert(response.message);
//     }).catch(error => {
//         console.error('Error in submitForB:', error);
//         throw error;
//     });
// }



// async function submitForD(event) {
//     const quantity = $('#mealqtydb').val();
//     const totalAmount = $('#mealamtdb').val();
//     const fromDate = $('#from-date-d').val();
//     const toDate = $('#to-date-d').val();

//     const currentDate = new Date();
//     const dayOfWeek = currentDate.getDay();
//     const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
//     const dayName = dayNames[dayOfWeek];

//     let payload = {
//         load: 'setitemsb',
//         quantity: quantity,
//         category: 3,
//         totalAmount: totalAmount,
//         foodid: foodidd,
//         cid: customerid,
//         day: dayName,
//         dates: []
//     };

//     if (quantity < 0) {
//         throw new Error('Invalid quantity for dinner.');
//     }
//     if (fromDate && toDate) {
//         const from = new Date(fromDate);
//         const to = new Date(toDate);
//         if (from > to) {
//             alert('Invalid date range.');
//             throw new Error('Invalid date range for dinner.');
//         }
//         let current = new Date(from);
//         while (current <= to) {
//             payload.dates.push(current.toISOString().split('T')[0]); // Format date as YYYY-MM-DD
//             current.setDate(current.getDate() + 1);
//         }
//     } else {
//         payload.dates.push(new Date().toISOString().split('T')[0]);
//     }

//     console.log('Payload for Dinner:', payload);

//     return $.ajax({
//         type: 'POST',
//         url: './webservices/dinner.php',
//         dataType: 'json',
//         data: JSON.stringify(payload)
//     }).then(response => {
//         if (response.status !== 'success') {
//             throw new Error(response.message);
//         }
//         alert(response.message);
//     }).catch(error => {
//         console.error('Error in submitForD:', error);
//         throw error;
//     });
// }
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

 // Global array to store both fetched items

// Function to fetch all lunch items
allItems = []; // Global array to store both fetched items

// Function to fetch all lunch items
function fetchalllunch() {
    allItems = []; // Clear global array
    const payload = { load: 'fetch' };

    $.ajax({
        url: "./webservices/dinner.php",
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function (response) {
            console.log("All Lunch Items Response:", response);

            if (response.status === 'success' && response.data) {
                const chargesTableBody = $('#lunch-table-l tbody');
                chargesTableBody.empty(); // Clear the table before adding new rows

                response.data.forEach(item => {
                    const row = $('<tr>');
                    row.html(`
                        <td class="itemname">${item.ItemName}</td>
                        <td class="price">${item.Price}</td>
                        <td><input type="number" data-optionid1="${item.OptionID}" placeholder="0" min="0" style="width:100px"></td>
                    `);
                    chargesTableBody.append(row);

                    // Add the item to the global array
                    allItems.push({
                        itemname: item.ItemName,
                        price: item.Price,
                        foodid: item.OptionID // Ensure this matches data-optionid
                    });
                });

                $("#lunch-options-containers").show();
            } else {
                console.error('Error in response data:', response);
            }
        },
        error: function (error) {
            console.error('Error fetching lunch items:', error);
        }
    });
}

// Function to fetch additional lunch items
function fetchadditems() {
    const payload = { load: 'fetchadditems' };

    $.ajax({
        url: "./webservices/dinner.php",
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(payload),
        success: function (response) {
            console.log("Additional Lunch Items Response:", response);

            if (response.status === 'success' && response.data) {
                const tableBody = $('#lunch-table1-l tbody');
                tableBody.empty(); // Clear the table before adding new rows

                response.data.forEach(item => {
                    const row = $('<tr>');
                    row.html(`
                        <td class="itemname">${item.ItemName}</td>
                        <td class="price">${item.Price}</td>
                        <td><input type="number" data-optionid1="${item.OptionID}" placeholder="0" min="0" style="width:100px"></td>
                    `);
                    tableBody.append(row);

                    // Add the item to the global array
                    allItems.push({
                        itemname: item.ItemName,
                        price: item.Price,
                        foodid: item.OptionID
                    });
                });

                $("#lunch-options-container1").show();
            } else {
                console.error('Error in additional items response:', response);
            }
        },
        error: function (error) {
            console.error('Error fetching additional lunch items:', error);
        }
    });
}

// Add items button event
$('#add-items').on('click', function () {
    fetchadditems();
});

// Function to handle lunch order submission
function nlunch(event) {
    event.preventDefault();

    const fromDate = $('#from-date-l').val();
    const toDate = $('#to-date-l').val();

    let payload = {
        load: 'nlunch',
        cid: customerid,
        foodtype: 2,
        dates: [],
        items: []
    };

    if (fromDate && toDate) {
        const from = new Date(fromDate);
        const to = new Date(toDate);
        if (from > to) {
            alert('Invalid date range.');
            return;
        }
        let current = new Date(from);
        while (current <= to) {
            payload.dates.push(current.toISOString().split('T')[0]);
            current.setDate(current.getDate() + 1);
        }
    } else {
        payload.dates.push(new Date().toISOString().split('T')[0]);
    }

    allItems.forEach(item => {
        const quantity = $(`input[data-optionid1="${item.foodid}"]`).val() || 0;
        if (quantity > 0) {
            payload.items.push({
                itemname: item.itemname,
                price: item.price,
                quantity: parseInt(quantity, 10),
                foodid: item.foodid
            });
        }
    });

    if (payload.items.length === 0) {
        alert("Please enter quantities for at least one lunch item.");
        return;
    }

    console.log('Payload:', payload);

    $.ajax({
        type: 'POST',
        url: './webservices/dinner.php',
        dataType: 'json',
        data: JSON.stringify(payload),
        success: function (response) {
            console.log('Server Response:', response);
            alert(response.message || 'Order placed successfully.');
        },
        error: function (xhr, status, error) {
            console.error('Error response:', xhr.responseText);
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

    calculateTableTotal('#lunch-table-l');
    calculateTableTotal('#lunch-table1-l');
    $('#mealamountb').val(totalAmount.toFixed(2));
}

// Function to update total quantity
function updateLunchQuantitydl() {
    let totalQuantity = 0;

    $('#lunch-table-l tbody input[type="number"], #lunch-table1-l tbody input[type="number"]').each(function() {
        const quantity = parseInt($(this).val(), 10); // Parse the value as an integer
        if (!isNaN(quantity) && quantity > 0) {
            totalQuantity += quantity;
        }
    });

    $('#mealqtylb').val(totalQuantity); // Default to 0 if no valid quantities
}

// Attach the event listener to dynamically update the total amount and quantity
$(document).on('input', '#lunch-table-l tbody input[type="number"], #lunch-table1-l tbody input[type="number"]', function() {
    updateLunchTotaldl();
    updateLunchQuantitydl();
});


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

</script>

</body>

</html>
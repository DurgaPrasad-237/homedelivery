
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

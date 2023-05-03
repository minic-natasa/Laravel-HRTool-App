var familyMembers = [];

function openAddFamilyMembersPopup() {
    loadFamilyMembers();
    $('#addFamilyMembersModal').modal('show');
}

async function loadFamilyMembers() {
    // Empty the table body first
    var table = document.getElementById('familyMembersTableBody');
    table.innerHTML = '';

    try {
        const profileIdElement = document.getElementById('addFamilyMembersModal');
        const profileId = profileIdElement.getAttribute('data-id');
        console.log('Profile ID:', profileId);
        const response = await axios.get(`/family-members/${profileId}`);
        familyMembers = response.data;

        familyMembers.forEach((member) => {
            var newRow = addNewMember();
            newRow.querySelectorAll(".relationship")[0].value = member.relationship;
            newRow.querySelectorAll(".name")[0].value = member.name;
            newRow.querySelectorAll(".birth_date")[0].value = member.birth_date;
            newRow.querySelectorAll(".jmbg")[0].value = member.jmbg;
            newRow.querySelectorAll(".fmId")[0].value = member.id;
            newRow.querySelector('.save-btn').style.display = 'none';
            newRow.querySelector('.edit-btn').style.display = 'inline-block';
            disableInputs(newRow);
        });
    } catch (error) {
        console.log(error);
    }
}

function addNewMember(memberId = null) {
    console.log("Adding...");
    // Get the table element
    var table = document.getElementById('familyMembersTableBody');

    // Create a new row for the family member input fields
    var newRow = document.createElement('tr');

    // Create cells for the input fields
    var relationshipCell = document.createElement('td');
    var nameCell = document.createElement('td');
    var birthdateCell = document.createElement('td');
    var jmbgCell = document.createElement('td');
    var actionsCell = document.createElement('td');
    var fmIDCell = document.createElement('td');

    // Add input fields to the cells
    var relationshipInput = document.createElement('input');
    relationshipInput.setAttribute('type', 'text');
    relationshipInput.setAttribute('class', 'form-control relationship');
    relationshipInput.setAttribute('name', 'relationship[]');
    relationshipInput.setAttribute('value', '');
    relationshipInput.setAttribute('placeholder', 'Enter relationship');
    relationshipCell.appendChild(relationshipInput);

    var nameInput = document.createElement('input');
    nameInput.setAttribute('type', 'text');
    nameInput.setAttribute('class', 'form-control name');
    nameInput.setAttribute('name', 'name[]');
    nameInput.setAttribute('value', '');
    nameInput.setAttribute('placeholder', 'Enter name');
    nameCell.appendChild(nameInput);

    var birthdateInput = document.createElement('input');
    birthdateInput.setAttribute('type', 'date');
    birthdateInput.setAttribute('class', 'form-control birth_date');
    birthdateInput.setAttribute('name', 'birth_date[]');
    birthdateInput.setAttribute('value', '');
    birthdateInput.setAttribute('placeholder', 'Enter birth date');
    birthdateCell.appendChild(birthdateInput);

    var jmbgInput = document.createElement('input');
    jmbgInput.setAttribute('type', 'text');
    jmbgInput.setAttribute('class', 'form-control jmbg');
    jmbgInput.setAttribute('name', 'jmbg[]');
    jmbgInput.setAttribute('value', '');
    jmbgInput.setAttribute('placeholder', 'Enter JMBG');
    jmbgCell.appendChild(jmbgInput);

    var fmIDInput = document.createElement('input');
    fmIDInput.setAttribute('type', 'hidden');
    fmIDInput.setAttribute('class', 'form-control fmId');
    fmIDInput.setAttribute('name', 'fmId[]');
    fmIDInput.setAttribute('value', '');
    fmIDInput.setAttribute('placeholder', 'Enter ID');
    fmIDCell.appendChild(fmIDInput);

    actionsCell.setAttribute('id', 'actionButton')

    // Add save, delete, and edit buttons to the actions cell
    var saveButton = document.createElement('button');
    saveButton.setAttribute('class', 'btn btn-success save-btn');
    saveButton.setAttribute('id', 'saveButton');
    saveButton.textContent = 'Save';
    saveButton.addEventListener('click', function () {
    saveRow(saveButton);
    disableInputs(newRow);
    });
    actionsCell.appendChild(saveButton);
    saveButton.style.marginRight = '10px';

    var deleteButton = document.createElement('button');
deleteButton.setAttribute('class', 'btn btn-danger delete-btn');
deleteButton.textContent = 'Delete';
deleteButton.addEventListener('click', function () {
    
    deleteRow(deleteButton);
});
actionsCell.appendChild(deleteButton);
deleteButton.style.marginRight = '10px';

var editButton = document.createElement('button');
editButton.setAttribute('class', 'btn btn-primary edit-btn');
editButton.setAttribute('id', 'editButton');
editButton.textContent = 'Edit';
editButton.addEventListener('click', function () {
    editRow(editButton);
    enableInputs(newRow);
});
actionsCell.appendChild(editButton);
editButton.style.display = 'none';

// Add cells to the row
newRow.appendChild(relationshipCell);
newRow.appendChild(nameCell);
newRow.appendChild(birthdateCell);
newRow.appendChild(jmbgCell);
newRow.appendChild(actionsCell);
newRow.appendChild(fmIDCell);

// Add the new row to the table
table.appendChild(newRow);

return newRow; 

}

function editRow(button) {
    console.log("Editing...");

    var row = button.parentNode.parentNode;
    var rowIndex = Array.from(row.parentNode.children).indexOf(row);
    console.log("rowIndex:", rowIndex); // Add this line
    console.log("familyMembers:", familyMembers); // Add this line
    var existingRow = familyMembers[rowIndex];
    console.log("existingRow:", existingRow); // Add this line
    
    // Populate the input fields with the values from the existing row
    row.querySelectorAll(".relationship")[0].value = existingRow.relationship;
    row.querySelectorAll(".name")[0].value = existingRow.name;
    row.querySelectorAll(".birth_date")[0].value = existingRow.birth_date;
    row.querySelectorAll(".jmbg")[0].value = existingRow.jmbg;
    
    //Hide the edit button
    const editBtn = row.querySelector('.edit-btn');
    editBtn.style.display = 'none';
    
    //Show save button
    const saveBtn = row.querySelector('.save-btn');
    saveBtn.style.display = 'inline-block';
    
    // Set a flag on the row to indicate that it's being edited
    row.setAttribute('data-edited', 'true');

}


function saveRow(button) {

    var row = button.parentNode.parentNode;
    var rowIndex = Array.from(row.parentNode.children).indexOf(row);

    var relationship = row.querySelectorAll(".relationship")[0].value;
    var name = row.querySelectorAll(".name")[0].value;
    var birth_date = row.querySelectorAll(".birth_date")[0].value;
    var jmbg = row.querySelectorAll(".jmbg")[0].value;
    
    // Check if the row is being edited
    var isEdited = row.getAttribute('data-edited') === 'true';
    
    if (isEdited) {
        // Update the corresponding row in the familyMembers array
        familyMembers[rowIndex].relationship = relationship;
        familyMembers[rowIndex].name = name;
        familyMembers[rowIndex].birth_date = birth_date;
        familyMembers[rowIndex].jmbg = jmbg;
    } else {
        // Add a new row to the familyMembers array
        var familyMember = {
            relationship: relationship,
            name: name,
            birth_date: birth_date,
            jmbg: jmbg
        };
        familyMembers.push(familyMember);
    }    
    // Send the family member data to the Laravel controller


        console.log(familyMembers);

        showMembers();

        // Hide the save button
        const saveBtn = row.querySelector('.save-btn');
        saveBtn.style.display = 'none';

        // Show the edit button
        const editBtn = row.querySelector('.edit-btn');
        editBtn.style.display = 'inline-block';

        // Remove the edited flag from the row
        row.removeAttribute('data-edited');
        }


function deleteRow(button) {
    console.log("Deleting...");
    var row = button.parentNode.parentNode;
    var rowIndex = Array.from(row.parentNode.children).indexOf(row);
    var existingRow = familyMembers[rowIndex];
    // Remove the row from the familyMembers array
    //familyMembers.splice(rowIndex, 1);

    //console.log(familyMembers);

    const fmIdTd_value = row.querySelectorAll(".fmId")[0].value;
    deleteRowDb(fmIdTd_value) ;
    // Remove the row from the table
    row.parentNode.removeChild(row);

}


function enableInputs(row) {
    row.querySelectorAll('input').forEach((input) => {
    input.disabled = false;
    });
}

function disableInputs(row) {
    row.querySelectorAll('input').forEach((input) => {
    input.disabled = true;
    });
}

function showMembers() {
    submitFamilyMembers();
}


async function submitFamilyMembers() {
    try {
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };
        const response = await axios.post('/profile/family-members/update', JSON.stringify({familyMembers}), {headers});
        console.log(response.data);
    } catch (error) {
        console.log(error.response.data);
    }
}


async function deleteRowDb(id) {
    try {
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };
        const response = await axios.post(`/profile/family-members/delete/${id}`, {headers});
        console.log(response.data);
        
    } catch (error) {
        console.log(error.response.data);
    }
}
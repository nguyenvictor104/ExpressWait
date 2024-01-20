$(document).ready(function() {
    //testDBConnection();
    getOrgID();

    window.setInterval( function() {
    $('#waitlistTable > tbody > tr').remove();
    }, 30000);
    window.setInterval( function() {
        getOrgID();
    }, 30100);
});



var org_id = null;

function getOrgID(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    org_id = urlParams.get('org_id');
    
    if (org_id!=null){
        getOrgName(org_id);
        getWaitlist(org_id);
    }
    else{
        console.log("Invalid org_id");
    }
}

function getOrgName(org_id){
    $.ajax({
        url: './Scripts/default.php',
        type: 'GET',
        data: { 
            action: 'getOrgName',
            org_id: org_id
        },
        dataType: 'json',
        success: function(response) {
            // Handle the successful response here
            populateTitle(response);
        },
        error: function(error) {
            // Handle errors here
            console.error('Error:', error);
        }
    });
}

function populateTitle(response){
    if (Array.isArray(response)) {
        response.forEach(function(response) {
            $('#org_nameTitle').text("ExpressWait - " + response.org_name);
            $('#org_nameHeader').text(response.org_name);
        });
    } else { 
        console.log('Invalid response format. Expected an array.');
    }
}

function getWaitlist(org_id){
    $.ajax({
        url: './Scripts/default.php',
        type: 'GET',
        data: { 
            action: 'getWaitlist',
            org_id: org_id
        },
        dataType: 'json',
        success: function(response) {
            // Handle the successful response here
            populateWaitlist(response);
        },
        error: function(error) {
            // Handle errors here
            console.error('Error:', error);
        }
    });
}

function populateWaitlist(response){
    // Iterate through the array and print out firstname and lastname
    if (Array.isArray(response)) {
        var counter = 1;
        response.forEach(function(response) {
            $('#waitlistTable > tbody:last-child').append("<tr><th scope='row'>"+counter+"</th><td>"+response.customer_name+"</td></tr>");
            counter++;
        });
    } else {
        $('#waitlistTable > tbody:last-child').append("<tr><th scope='row'>0</th><td>Empty</td></tr>");
   
        console.log('Invalid response format. Expected an array.');
    }

}

function addToWaitlist(){
    const inputName = $( "#inputName" ).val();
    const inputPhoneNumber = $( "#inputPhoneNumber" ).val();
    const datetime_submitted = new Date().toLocaleString();

    $.ajax({
        url: './Scripts/default.php',
        type: 'POST',
        data: {
            action: 'addToWaitlist',
            org_id: org_id,
            customer_name: inputName,
            customer_phone: inputPhoneNumber,
            datetime_submitted: datetime_submitted,
        },
        success: function(response) {
            console.log(response);
            window.alert("Submitted!");
            location.reload();
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}
































function testDBConnection(){
    $.ajax({
        url: './Scripts/default.php',
        type: 'GET',
        data: { action: 'testDBConnection' },
        success: function(response) {
            // Handle the successful response here
            console.log(response);
            
        },
        error: function(error) {
            // Handle errors here
            console.error('Error:', error);
        }
    });
}

function getUsers(){
    $.ajax({
        url: './Scripts/default.php',
        type: 'GET',
        data: { action: 'getUsers' },
        dataType: 'json',
        success: function(response) {
            // Handle the successful response here
            handleUserData(response);
        },
        error: function(error) {
            // Handle errors here
            console.error('Error:', error);
        }
    });
}

// Function to handle user data
function handleUserData(users) {
    // Iterate through the array and print out firstname and lastname
    if (Array.isArray(users)) {
        users.forEach(function(user) {
        console.log(user.firstname);
        });
    } else {
        console.log('Invalid response format. Expected an array.');
    }
}

function insertUser(firstName, lastname) {
    $.ajax({
        url: './Scripts/default.php',
        type: 'POST',
        data: {
        action: 'insertUser',
        firstname: firstName,
        lastname: lastname
        },
        success: function(response) {
            console.log(response);
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}
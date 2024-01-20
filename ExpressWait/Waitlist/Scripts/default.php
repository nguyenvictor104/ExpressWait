<?php
  $dbServername = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbDBName = "expresswait";
  $conn = new mysqli($GLOBALS['dbServername'], $GLOBALS['dbUsername'], $GLOBALS['dbPassword'], $GLOBALS['dbDBName']);
    
  // Check if the action parameter is set
  if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];

    switch ($action) {
      /*
      case 'testDBConnection':
        // Call your PHP function to test the database connection
        $result = testDBConnection();
        // Send the result as a response
        echo $result;
        break;

      case 'getUsers':
        // Call the function to get users data
        $result = getUsers();
        echo json_encode($result);
        break;
      
      case 'insertUser':
        // Check if the required parameters are set
        if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
          $firstname = $_POST['firstname'];
          $lastname = $_POST['lastname'];

          // Call the function to insert a new user
          $result = insertUser($firstname, $lastname);
          echo $result;
        } else {
          echo 'Error: Missing parameters for insertUser';
        }
      break;
      */
      case 'testDBConnection':
        // Call your PHP function to test the database connection
        $result = testDBConnection();
        // Send the result as a response
        echo $result;
        break;
      case 'getOrgName':
        // Call the function to get users data
        $org_id = $_GET['org_id'];
        $result = getOrgName($org_id);
        echo json_encode($result);
        break;
      case 'getWaitlist':
        // Call the function to get users data
        $org_id = $_GET['org_id'];
        $result = getWaitlist($org_id);
        echo json_encode($result);
        break;
      case 'addToWaitlist':
        // Check if the required parameters are set
        if (isset($_POST['customer_name']) && isset($_POST['customer_phone'])) {
          $org_id = $_POST['org_id'];
          $customer_name = $_POST['customer_name'];
          $customer_phone = $_POST['customer_phone'];
          $datetime_submitted = $_POST['datetime_submitted'];

          // Call the function to insert a new user
          $result = addToWaitlist($org_id, $customer_name, $customer_phone, $datetime_submitted);
          echo $result;
        } else {
          echo 'Error: Missing parameters for addToWaitlist';
        }
        break;
      default:
        // Handle unknown action
        echo "Unknown action";
        break;
    }
  }

  function getOrgName($org_id){
    global $conn; // Use the global connection variable

    // Perform the query to get id, firstname, lastname from tblusers
    $sql = "SELECT org_name FROM tblorganizations WHERE org_id = $org_id";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result->num_rows > 0) {
        // Fetch the results and return them as an array
        $usersData = array();
        while ($row = $result->fetch_assoc()) {
            $usersData[] = $row;
        }
        return $usersData;
    } else {
        return "No users found";
    }
    $conn->close();
  }

  function getWaitlist($org_id){
    global $conn; // Use the global connection variable

    // Perform the query to get id, firstname, lastname from tblusers
    $sql = "SELECT customer_name, customer_phone, datetime_submitted FROM tblwaitlist WHERE org_id = $org_id ORDER BY datetime_submitted";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result->num_rows > 0) {
        // Fetch the results and return them as an array
        $usersData = array();
        while ($row = $result->fetch_assoc()) {
            $usersData[] = $row;
        }
        return $usersData;
    } else {
        return "No users found";
    }
    $conn->close();
  }

  function addToWaitlist($org_id, $customer_name, $customer_phone, $datetime_submitted) {
    global $conn;

    // Escape user input to prevent SQL injection
    $customer_name = $conn->real_escape_string($customer_name);
    $customer_phone = $conn->real_escape_string($customer_phone);

    // Perform the SQL query to insert a new user
    $sql = "INSERT INTO tblwaitlist (org_id, customer_name, customer_phone, datetime_submitted) VALUES ('$org_id','$customer_name', '$customer_phone', '$datetime_submitted')";

    if ($conn->query($sql) === TRUE) {
        return "New user inserted successfully";
    } else {
        return "Error: " . $conn->error;
    }
  }





















































  
  // Function to test the database connection (replace this with your actual connection code)
  function testDBConnection() {
    // Create connection
    global $conn;
    
    // Check connection
    if ($conn->connect_error) {
        return "Connection failed: " . $conn->connect_error;
    } else {
        return "Connection successful!";
    }
    $conn->close();
  }
  
  function getUsers(){
    global $conn; // Use the global connection variable

    // Perform the query to get id, firstname, lastname from tblusers
    $sql = "SELECT id, firstname, lastname FROM tblusers";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result->num_rows > 0) {
        // Fetch the results and return them as an array
        $usersData = array();
        while ($row = $result->fetch_assoc()) {
            $usersData[] = $row;
        }
        return $usersData;
    } else {
        return "No users found";
    }
    $conn->close();
  }

  function insertUser($firstname, $lastname) {
    global $conn;

    // Escape user input to prevent SQL injection
    $firstname = $conn->real_escape_string($firstname);
    $lastname = $conn->real_escape_string($lastname);

    // Perform the SQL query to insert a new user
    $sql = "INSERT INTO tblusers (firstname, lastname) VALUES ('$firstname', '$lastname')";

    if ($conn->query($sql) === TRUE) {
        return "New user inserted successfully";
    } else {
        return "Error: " . $conn->error;
    }
  }


?>

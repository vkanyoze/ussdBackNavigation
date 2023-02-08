<?php

// Connect to the database
$servername = "localhost";
$username = "database_username";
$password = "database_password";
$dbname = "database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the input from the user
$input = $_REQUEST['text'];

// Split the input into levels
$levels = explode("*", $input);

// Get the values from each level
$level1 = $levels[0];
$level2 = isset($levels[1]) ? $levels[1] : '';
$level3 = isset($levels[2]) ? $levels[2] : '';

// Check which menu the user is on
if ($input == '') {
    // Show the first menu
    echo "Welcome to our USSD Application!\n";
    echo "1. Menu 1\n";
    echo "2. Menu 2\n";
    echo "3. Menu 3\n";
    echo "Enter the number of the menu you want to access.";
} else if ($level1 == '1') {
    if ($level2 == '') {
        // Show the second menu
        echo "You have selected Menu 1.\n";
        echo "1. Option 1\n";
        echo "2. Option 2\n";
        echo "0. Back\n";
        echo "Enter the number of the option you want to access.";
    } else if ($level2 == '0') {
        // Go back to the first menu
        echo "Welcome to our USSD Application!\n";
        echo "1. Menu 1\n";
        echo "2. Menu 2\n";
        echo "3. Menu 3\n";
        echo "Enter the number of the menu you want to access.";
    } else {
        // Insert the values into the database
        $sql = "INSERT INTO ussd_data (level1, level2, level3)
        VALUES ('$level1', '$level2', '$level3')";

        if ($conn->query($sql) === TRUE) {
            echo "Data successfully inserted.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

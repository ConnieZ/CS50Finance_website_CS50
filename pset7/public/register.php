<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate the user provided values
        if(empty($_POST["username"]) || empty($_POST["password"])) {
            apologize("Invalid username and/or password.");
        }
        else {
            // validate confirmed password
            if($_POST["password"] != $_POST["confirmation"]) {
                apologize("Passwords don't match.");
            }
            else {
                //create the user record in the database
                if (query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", 
                $_POST["username"], crypt($_POST["password"])) === false) {
                    apologize("Registration failed.");
                }
                //log the user in
                $rows = query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["id"] = $id;
                // redirect user
                redirect("/");
            }
        }
        
        
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

?>

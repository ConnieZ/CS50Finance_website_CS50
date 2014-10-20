<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //verify the amount is positive
        
        if($_POST["deposit"] < 0) { 
            apologize("This amount is less than zero.");
        }
        else {
            //add the money to cash
            $cashUpdate = query("UPDATE users SET cash = cash + ? WHERE id = ?", 
                            $_POST["deposit"], $_SESSION["id"]);
                        
            //redirect home
            redirect("/");
            
        }
    }
     
    else
    {
        // else render form
        render("deposit_form.php", ["title" => "Deposit Money"]);
    }

?>

<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //lookup the stock value submitted to see if it's valid
        $stock = lookup($_POST["stockSymbol"]);
        
        // validate the user provided values
        if($stock === false) {
            apologize("Invalid stock symbol.");
        }
        else {
            render("return_quote.php", ["quote" => $stock]);
            }
        }
    
    else
    {
        // else render form
        render("quote_form.php", ["title" => "Submit Quote"]);
    }

?>

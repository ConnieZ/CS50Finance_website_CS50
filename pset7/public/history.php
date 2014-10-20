<?php

    // configuration
    require("../includes/config.php"); 
    
    //prepare the associative array with transaction values
    $positions = [];
    //query the database for the transaction data
    $rows = query("SELECT * FROM transactions WHERE userID = ?", $_SESSION["id"]);
    
    //validate there's transactions to show
    if ($rows !== false) {
        //fill in the positions array
        foreach ($rows as $row)
        {  
            $positions[] = [
                    "Transaction" => $row["type"],
                    "Symbol" => $row["symbol"],
                    "Shares" => $row["shares"],
                    "Price" => number_format($row["price"], 2),
                    "Date/Time" => $row["timestamp"]
                ];
            
        }
    }
    
    // render history page
    render("history_page.php", ["title" => "History", "positions" => $positions, "id" => $_SESSION["id"]]);

?>

<?php

    // configuration
    require("../includes/config.php"); 
    
    //prepare the associative array with portfolio values
    $positions = [];
    //query the database for the data on that user
    $rows = query("SELECT * FROM stocks WHERE userID = ?", $_SESSION["id"]);
    
    //validate there's shares owned
    if ($rows !== false) {
        //fill in the positions array
        foreach ($rows as $row)
        {  
            $stock = lookup($row["symbol"]);
            if ($stock !== false)
            {
                $positions[] = [
                    "name" => $stock["name"],
                    "price" => number_format($stock["price"], 2),
                    "shares" => $row["numShares"],
                    "symbol" => $row["symbol"],
                    "cash" => number_format(query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"])[0]["cash"], 2)
                ];
            }
        }
    }
    
    // render portfolio
    render("portfolio.php", ["title" => "Portfolio", "positions" => $positions, "id" => $_SESSION["id"]]);

?>

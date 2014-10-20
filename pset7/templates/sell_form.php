<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <select class="form-control" name="stockSymbol">
            <option value=""> </option>
            <?php
            //validate that positions is not an empty array
            if (empty($allUserStock)) {
                print("No shares owned.");
                
            }
            else {
                //print out the stock as dropdown list of options to sell
                foreach ($allUserStock as $position)
                {
                    print("<option value=" . $position["symbol"] . ">" . $position["symbol"] . "</option>");
                }
                
            }
             ?>           
                </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Sell</button>
        </div>
    </fieldset>
</form>


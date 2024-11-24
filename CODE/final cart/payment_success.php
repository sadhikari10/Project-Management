<?php
    session_start();
    $collection_slots = ['10-13','13-16','16-19'];

    $available_days = ['Wednesday', 'Thursday', 'Friday'];
    $today = new DateTime();
    $today->setTime(0, 0); // Set time to 00:00 to compare whole days

    $available_dates = [];

    for ($i = 1; $i <= 7; $i++) {
        $date = clone $today;
        $date->modify("+$i days");
        $weekday = $date->format('l'); // Full name of the day of the week

        if (in_array($weekday, $available_days)) {
            $available_dates[] = $date;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form method="post" action="">
            <label for="collection_date">Select a collection date:</label>
            <select name="collection_date" id="collection_date">
                <?php foreach ($available_dates as $date): ?>
                    <option value="<?= $date->format('Y-m-d') ?>">
                        <?= $date->format('l, Y-m-d') ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="collection_slot">Select a collection slot:</label>
            <select name="collection_slot" id="collection_slot">
                <?php foreach ($collection_slots as $slot): ?>
                    <option value="<?= $slot ?>"><?= $slot ?></option>
                <?php endforeach; ?>
            </select>

            <input type="submit" value="select">
        </form>
        <script>
            <?php 
                if (isset($_SESSION['order_placed']) && $_SESSION['order_placed']): 
            ?>
                alert("Order placed successfully!");
            <?php
                // Unset the session variable
                unset($_SESSION['order_placed']);
                endif;
            ?>
        </script>
    </body>
</html>



<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if collection_date and collection_slot are set in $_POST
        if(isset($_POST['collection_date']) && isset($_POST['collection_slot'])) {
            $selected_date = $_POST['collection_date'];
            $selected_slot = $_POST['collection_slot'];
            $customer_id = $_SESSION['customer_id'];

            $now = new DateTime();
            //DateTime::createFromFormat() static method of datetime class to create datetime instance
            $selected_datetime = DateTime::createFromFormat('Y-m-d H:i', "$selected_date 00:00");
            $interval = $now->diff($selected_datetime);
            $hours = $interval->h + ($interval->days * 24);

            if ($hours < 24) {
                die("Error: Collection date must be at least 24 hours from now.");
            }

            // Process the order...

            //insert into payment table
            $amount = $_SESSION['amount']; 
            $currency = "USD";
            $user_id = $_SESSION['customer_id'];

            $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');
 
            $payment_query = "INSERT INTO PAYMENT(PAYMENT_AMOUNT,CURRENCY,USER_ID) 
                            VALUES(:amount,:currency,:user_id)";

            $exec = oci_parse($conn,$payment_query);
            oci_bind_by_name($exec,':amount',$amount);
            oci_bind_by_name($exec,':currency',$currency);
            oci_bind_by_name($exec,':user_id',$user_id);
            
            oci_execute($exec);


            //inserting into collection slot
        
            $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');

            
            $qry = "INSERT INTO COLLECTION_SLOT(DAY,COLLECTION_TIME,USER_ID)
            VALUES(:day,:collection_time,:user_id)";
            $stid = oci_parse($conn,$qry);
        
            oci_bind_by_name($stid, ':day', $selected_date);
            oci_bind_by_name($stid, ':collection_time', $selected_slot);
            oci_bind_by_name($stid,':user_id',$customer_id);

            $stid1 = oci_execute($stid);

            if($stid1){
                // selecting the last collection slot on which the data is stored
                $select_query = "SELECT SLOT_ID FROM COLLECTION_SLOT
                    WHERE SLOT_ID = (SELECT MAX(SLOT_ID) FROM COLLECTION_SLOT)";
                $execute = oci_parse($conn,$select_query);
                oci_execute($execute);

                $row = oci_fetch_assoc($execute);
                $max_slot_id = $row['SLOT_ID'];

                //fetching the required data from multiple tables for inserting into ordered table
                //for the last entry in collection slot
                $qry = "SELECT c.QUANTITY,c.PRICE,cs.SLOT_ID,c.PRODUCT_ID,c.QUANTITY, c.PRICE,c.USER_ID
                        FROM CART c JOIN COLLECTION_SLOT cs ON c.USER_ID = cs.USER_ID WHERE SLOT_ID  = $max_slot_id";



                $stid = oci_parse($conn,$qry);
                $stid2 = oci_execute($stid);

                while($row=oci_fetch_assoc($stid)){
                    $quantity = $row['QUANTITY'];
                    $price = $row['PRICE'];
                    $final_price = $quantity * $price;
                    $slot_id = $row['SLOT_ID'];
                    $user_id = $row['USER_ID'];
                    $product_id = $row['PRODUCT_ID'];
                    $quantity = $row['QUANTITY'];

                    //inserting a value inthe ordered table for each product that is ordered
                    $qry = "INSERT INTO ORDERED_PRODUCT(ORDER_ID,PRODUCT_ID,QUANTITY,USER_ID,SLOT_ID,PRICE,ORDERED_DATE) 
                            VALUES(ORDER_ID_SEQ.NEXTVAL,:product_id,:quantity,:user_id,:slot_id,:price,SYSTIMESTAMP)";
                    $stid3 = oci_parse($conn,$qry);
                    oci_bind_by_name($stid3,':product_id',$product_id);
                    oci_bind_by_name($stid3,':quantity',$quantity);
                    oci_bind_by_name($stid3,':user_id',$user_id);
                    oci_bind_by_name($stid3,':slot_id',$slot_id);
                    oci_bind_by_name($stid3,':price',$final_price);

                    $stid4 = oci_execute($stid3);
                } 
            }
            
            // stock less
            $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');

            


            $user_id = $_SESSION['customer_id'];
            $query = "SELECT op.PRODUCT_ID, op.QUANTITY, p.NAME 
                    FROM ORDERED_PRODUCT op
                    JOIN PRODUCT p ON op.PRODUCT_ID = p.PRODUCT_ID
                    WHERE op.USER_ID = :user_id";
            $stmt = oci_parse($conn, $query);
            oci_bind_by_name($stmt, ":user_id", $user_id);
            oci_execute($stmt);

            // RETRIEVE the quantity of each product in the ORDERED PRODUCT table
            while ($row = oci_fetch_assoc($stmt)) {
                $product_id = $row['PRODUCT_ID'];
                $ordered_quantity = $row['QUANTITY'];

                // Update the quantity in the PRODUCT table
                $update_query = "UPDATE PRODUCT 
                                SET STOCK = STOCK - :ordered_quantity 
                                WHERE PRODUCT_ID = :product_id";
                $update_stmt = oci_parse($conn, $update_query);
                oci_bind_by_name($update_stmt, ":ordered_quantity", $ordered_quantity);
                oci_bind_by_name($update_stmt, ":product_id", $product_id);
                oci_execute($update_stmt);
            }


            //remove from cart
            $user_id = $_SESSION['customer_id'];
            $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');
 
            $remove_statement = "DELETE FROM CART WHERE USER_ID = $user_id";
            $remove_execute = oci_parse($conn,$remove_statement);
            oci_execute($remove_execute);

            //
            if($remove_execute){
                $_SESSION['order_placed'] = true;
                echo "<script>alert('Order placed successfully!');
                    window.location.href = 'index.php';
                    </script>";
                
                
                exit;
            }
            //
        }
        else {
            die("Error: Collection date and slot are not set.");
        }
    }
?>
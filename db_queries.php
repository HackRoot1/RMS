<?php 

    include("config.php");



    // ===================================== Fetch data ========================================

    // fetching all menu data from database.
    $query1 = "SELECT * FROM menu";
    $run_query1 = mysqli_query($conn, $query1);
    
    

    // fetching single row from menu table

    $query2 = "SELECT * FROM menu WHERE id = 3";
    $run_query2 = mysqli_query($conn, $query2);



    // fetching more than one matching rows from database i.e. filters
    $filter_arr = ['value1' => "food", 'value2' => 'Fruit'];

    // array to string conversion 
    $arrToString = implode("', '", $filter_arr);

    $query3 = "SELECT * FROM menu WHERE category IN ('{$arrToString}')";
    $run_query3 = mysqli_query($conn, $query3);



    // fetching data based on ascending and descending order

    $query4 = "SELECT * FROM menu ORDER BY name DESC";
    $run_query4 = mysqli_query($conn, $query4);



    // fetching data based on search item i.e. like query
    
    $query5 = "SELECT * FROM menu WHERE category LIKE '%food%'";
    $run_query5 = mysqli_query($conn, $query5);


    // fetching filtered and sorted data simultaneously 

    
    $query6 = "SELECT * FROM menu WHERE category IN ('{$arrToString}') ORDER BY name DESC";
    $run_query6 = mysqli_query($conn, $query6);



    // fetching filtered and searched data simultaneously 

    
    $query6 = "SELECT * FROM menu WHERE category IN ('{$arrToString}') AND category LIKE '%fr%'";
    $run_query6 = mysqli_query($conn, $query6);


    // fetching sorted and searched data simultaneously 

    
    $query7 = "SELECT * FROM menu WHERE category LIKE '%fr%' ORDER BY name DESC";
    $run_query7 = mysqli_query($conn, $query7);



    // fetching filtered, sorted and searched data simultaneously 

    
    $query8 = "SELECT * FROM menu WHERE category IN ('{$arrToString}') AND category LIKE '%fr%' ORDER BY name DESC";
    $run_query8 = mysqli_query($conn, $query8);


    // ======================================= end fetch ==========================================



    // ====================================== delete data ==============================================


    // Note : - always delete on where condition...

    // $query9 = "DELETE FROM menu";
    // $run_query9 = mysqli_query($conn, $query9);


    // multi-check deletes.....

    // $query10 = "DELETE FROM menu WHERE id = 46";
    // $run_query10 = mysqli_query($conn, $query10);


    // delete all for optional when needed

    // $query11 = "DELETE FROM menu WHERE id IN (47, 48, 49, 50)";
    // $run_query11 = mysqli_query($conn, $query11);




    // ======================================= end delete ======================================



    // ======================================== update data ====================================



    // $query12 = "UPDATE 
    //                 menu 
    //             SET 
    //                 name = 'new name'
    //             WHERE 
    //                 id = 5
    //             ";
    // $run_query12 = mysqli_query($conn, $query12);

    // ======================================== end update ====================================




    $data = mysqli_fetch_all($run_query12);
    
    echo "<pre>";
    print_r($data);

?>
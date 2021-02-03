<?php
require_once root.'db/conn.php';

function get_items($sql){
    $conn = get_conn();
    $result = $conn->query($sql);
    $items = array();
    if ($result->num_rows > 0) {
    
    //echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $items[]= $row;
            //echo "<tr><td>".$row["id"]."</td><td>".$row["producto_nombre"]." ".$row["precio"]."</td></tr>";
        }
    //echo "</table>";
    }
    $conn->close();
    return $items;

}

function get_item($sql){
    $conn = get_conn();
    $result = $conn->query($sql);
    //$items = array();
    if ($result->num_rows > 0) {
    
    //echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $conn->close();
            return $row;
            //echo "<tr><td>".$row["id"]."</td><td>".$row["producto_nombre"]." ".$row["precio"]."</td></tr>";
        }
   
    }
    $conn->close();
    return NULL;

}


function insert_item($sql){
    $conn = get_conn();
    //$result = $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
        return TRUE;
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        return FALSE;
    }

    $conn->close();
}

function update_item($sql){
    $conn = get_conn();
    //$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
    if ($conn->query($sql) === TRUE) {
        //echo "Record updated successfully";
        return TRUE; 
    } else {
        //echo "Error updating record: " . $conn->error;
        return FALSE;
    }

    $conn->close();
}
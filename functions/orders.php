<?php

include 'connectdb.php';

function getAllOrders($search = "") {
    $conn = Connect();

    $where = "";
    if ($search != "") {
        $search = $conn->real_escape_string($search);
        $where = "WHERE invoice.inv_number LIKE '%$search%' 
                  OR customer.cus_fname LIKE '%$search%'
                  OR customer.cus_lname LIKE '%$search%'";
    }

    $query = "
        SELECT 
            invoice.inv_number,
            CONCAT(customer.cus_fname, ' ', customer.cus_lname) AS customer_name,
            invoice.inv_date,
            invoice.inv_subtotal,
            invoice.inv_tax,
            invoice.inv_total
        FROM invoice
        INNER JOIN customer 
            ON invoice.cus_code = customer.cus_code
        $where
        ORDER BY invoice.inv_number ASC
    ";

    $result = $conn->query($query);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}
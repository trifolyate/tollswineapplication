<?php
    $con = mysqli_connect("us-cdbr-east-06.cleardb.net", "b34e5df2471635", "6ffed3a5", "heroku_eb7517145b609d1");
    $result = array();
    $result['data'] = array();
    $select = "SELECT * from inbound_list where status_completed = 0 ORDER BY t_quantity ASC";
    $response = mysqli_query($con,$select);

    while($row = mysqli_fetch_array($response))
    {
        $index['id'] = $row['0'];
        $index['arrival_date'] = $row['1'];
        $index['departure_date'] = $row['2'];
        $index['exporter'] = $row['3'];
        $index['handling_agent'] = $row['4'];
        $index['importer'] = $row['5'];
        $index['permit_no'] = $row['6'];
        $index['status_completed'] = $row['7'];
        $index['t_cartons'] = $row['8'];
        $index['t_quantity'] = $row['9'];

        array_push($result['data'],$index);
    }

    $result['success'] = "1";
    echo json_encode($result, JSON_PRETTY_PRINT);
    mysqli_close($con);

?>

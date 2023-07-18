<?php
    $con = mysqli_connect("us-cdbr-east-06.cleardb.net", "b34e5df2471635", "6ffed3a5", "heroku_eb7517145b609d1");
    $result = array();
    $result['data'] = array();
    $select = "SELECT * from wine_label where inbound_list_id = '693826083' and status_completed = 0 ";
    $response = mysqli_query($con,$select);

    while($row = mysqli_fetch_array($response))
    {
        $index['brand_name'] = $row['1'];
        $index['brand_name'] = $row['2'];
        $index['brand_name'] = $row['3'];
        $index['brand_name'] = $row['4'];
        $index['brand_name'] = $row['5'];
        $index['brand_name'] = $row['6'];
        $index['brand_name'] = $row['7'];
        $index['brand_name'] = $row['8'];
        $index['brand_name'] = $row['9'];
        $index['brand_name'] = $row['10'];

        array_push($result['data'],$index);
    }

    $result['success'] = "1";
    echo json_encode($result, JSON_PRETTY_PRINT);

?>
<?php
    $con = mysqli_connect("us-cdbr-east-06.cleardb.net", "b34e5df2471635", "6ffed3a5", "heroku_eb7517145b609d1");
    $result = array();
    $result['data'] = array();
    $select = "SELECT * from wine_label where inbound_list_id = '693826083' and status_completed = 0 ";
    $response = mysqli_query($con,$select);

    while($row = mysqli_fetch_array($response))
    {
        $index['brand_name'] = $row['1'];
        $index['test1'] = $row['2'];
        $index['test2'] = $row['3'];
        $index['test3'] = $row['4'];
        $index['test4'] = $row['5'];
        $index['test5'] = $row['6'];
        $index['test6'] = $row['7'];
        $index['test7'] = $row['8'];
        $index['test8'] = $row['9'];
        $index['test9'] = $row['10'];

        array_push($result['data'],$index);
    }

    $result['success'] = "1";
    echo json_encode($result, JSON_PRETTY_PRINT);

?>
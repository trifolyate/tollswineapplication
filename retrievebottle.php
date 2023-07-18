<?php
    $con = mysqli_connect("us-cdbr-east-06.cleardb.net", "b34e5df2471635", "6ffed3a5", "heroku_eb7517145b609d1");
    $result = array();
    $result['data'] = array();
    $select = "SELECT * from wine_label where status_completed = 0";
    $response = mysqli_query($con,$select);

    while($row = mysqli_fetch_array($response))
    {
        $index['alcohol_content'] = $row['0'];
        $index['bottle_information'] = $row['1'];
        $index['brand_name'] = $row['2'];
        $index['grape_variety'] = $row['3'];
        $index['importer_information'] = $row['4'];
        $index['model_name'] = $row['5'];
        $index['quantity'] = $row['6'];
        $index['region_of_production'] = $row['7'];
        $index['status_completed'] = $row['8'];
        $index['vintage'] = $row['9'];
        $index['wine_name'] = $row['10'];
        $index['inbound_list_id'] = $row['11'];
        $index['wine_label_id'] = $row['12'];
        $index['model_number'] = $row['13'];

        array_push($result['data'],$index);
    }

    $result['success'] = "1";
    echo json_encode($result, JSON_PRETTY_PRINT);
    mysqli_close($con);

    echo "Hello World!";
?>
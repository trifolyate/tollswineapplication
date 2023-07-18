<?php
// if (!empty($_POST['id'])) {
//     $id = $_POST['id'];
    $con = mysqli_connect("us-cdbr-east-06.cleardb.net", "b34e5df2471635", "6ffed3a5", "heroku_eb7517145b609d1");
    $result = array();
    $result['data'] = array();
    $select = "SELECT * from wine_label where inbound_list_id = '693826083' and status_completed = 0 ";
    $response = mysqli_query($con,$select);
    if (mysqli_num_rows($response) != 0) {
    while($row = mysqli_fetch_array($response))
    {
        $index['wine_name'] = $row['0'];
        $index['vintage'] = $row['1'];
        $index['region_of_production'] = $row['2'];
        $index['quantity'] = $row['3'];
        $index['model_name'] = $row['4'];
        $index['importer_information'] = $row['5'];
        $index['grape_variety'] = $row['6'];
        $index['brand_name'] = $row['7'];
        $index['bottle_information'] = $row['8'];
        $index['alcohol_content'] = $row['9'];

        array_push($result['data'],$index);
    }
    } else $result = array("status" => "failed","message" => "Bottles Not Found");

    $result['success'] = "1";
    echo json_encode($result, JSON_PRETTY_PRINT);
    mysqli_close($con);
// } else
//     $result = array("status" => "failed", "message" => "Barcode ID Needed");

// echo json_encode($result, JSON_PRETTY_PRINT);
?>
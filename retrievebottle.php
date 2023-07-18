<?php
if (!empty($_POST['id'])) {
    $id = $_POST['id'];
    $con = mysqli_connect("us-cdbr-east-06.cleardb.net", "b34e5df2471635", "6ffed3a5", "heroku_eb7517145b609d1");
    $result = array();
    $result['data'] = array();
    $select = "SELECT * from wine_label where inbound_list_id = '" . $id . "' and status_completed = 0 ";
    mysqli_set_charset($con, "utf8");
    $response = mysqli_query($con, $select);
    while ($row = mysqli_fetch_array($response)) {
        $index['wine_name'] = $row['11'];
        $index['vintage'] = $row['10'];
        $index['region_of_production'] = $row['8'];
        $index['quantity'] = $row['7'];
        $index['model_name'] = $row['6'];
        $index['importer_information'] = $row['5'];
        $index['grape_variety'] = $row['4'];
        $index['brand_name'] = $row['3'];
        $index['bottle_information'] = $row['2'];
        $index['alcohol_content'] = $row['1'];


        array_push($result['data'], $index);

        $result['success'] = "1";
    }
} else $result = array("status" => "failed","message" => "Barcode ID needed");


echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);



?>
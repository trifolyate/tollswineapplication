<?php
// if (!empty($_POST['id'])) {
    // $id = $_POST['id'];
    $result = array();
    $con = mysqli_connect("us-cdbr-east-06.cleardb.net", "b34e5df2471635", "6ffed3a5", "heroku_eb7517145b609d1");
    if ($con) {
        $sql = "select * from wine_label where wine_label_id = '572038408' AND status_completed = 0";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) != 0) {
            while ($row = mysqli_fetch_array($response)) {
                $index['wine_name'] = $row['0'];
                $index['vintage'] = $row['1'];
                $index['region_of_production'] = $row['2'];
                $index['quantity'] = $row['3'];
                $index['model_name'] = $row['4'];
                $index['importer_information'] = $row['5'];
                $index['grape_variety'] = $row['6'];
                $index['brand_name'] = $row['7'];
                $index['bottle_information'] = $row['8'];
                $index['quantity'] = $row['9'];
                $index['alcohol_content'] = $row['10'];
                array_push($result['data'], $index);
            }
        } else
            $result = array("status" => "failed", "message" => "Empty Results");
    } else
        $result = array("status" => "failed", "message" => "Connection to DataBase Failed");
// } else
//     $result = array("status" => "failed", "message" => "Barcode ID Needed");

echo json_encode($result, JSON_PRETTY_PRINT);
?>
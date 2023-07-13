<?php
if (!empty($_POST['id'])) {
    $id = $_POST['id'];
    $result = array();
    $con = mysqli_connect("us-cdbr-east-06.cleardb.net", "b34e5df2471635", "6ffed3a5", "heroku_eb7517145b609d1");
    if ($con) {
        $sql = "select * from inbound_list where id = '" . $id . "'AND status_completed = 0";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) != 0) {
            $row = mysqli_fetch_assoc($res);
            if ($id == $row['id']) {
                    $result = array(
                        "status" => "success",
                        "message" => "Found Task!",
                        "id" => $row['id'],
                        "arrival_date" => $row['arrival_date'],
                        "exporter" => $row['exporter'],
                        "importer" => $row['importer'],
                        "t_cartons" => $row['t_cartons'],
                        "t_quantity" => $row['t_quantity']
                    );
            } else $result = array("status" => "failed","message" => "Incorrect ID Type (Please Check List)");
        } else $result = array("status" => "failed","message" => "Inbound List Not Found In Database OR Completed");
    } else $result = array("status" => "failed","message" => "Database connection failed");
} else $result = array("status" => "failed","message" => "Barcode ID needed");

echo json_encode($result, JSON_PRETTY_PRINT);
?>

<?php
if (isset($_POST['id']) && isset($_POST['text'])) {
    $id = $_POST['id'];
    $text = $_POST['text'];
    $con = mysqli_connect("us-cdbr-east-06.cleardb.net", "b34e5df2471635", "6ffed3a5", "heroku_eb7517145b609d1");
    $result = array();
    $result['data'] = array();

    // Replace '\n' with a blank space in the extracted text
    $text = str_replace("\n", ' ', $text);

    // Fetch data from the database, including the brand_name column
    $select = "SELECT * FROM wine_label WHERE inbound_list_id = '$id' AND status_completed = 0 ";
    mysqli_set_charset($con, "utf8");
    $response = mysqli_query($con, $select);

    // Function to calculate the similarity between two strings
    function calculateSimilarity($text1, $text2) {
        // Convert both strings to lowercase for case-insensitive comparison
        $text1 = strtolower($text1);
        $text2 = strtolower($text2);

        // Calculate the similarity using the similar_text function
        similar_text($text1, $text2, $similarityPercentage);

        return $similarityPercentage;
    }

    // Loop through the database rows and compare with the text
    while ($row = mysqli_fetch_array($response)) {
        // Extract data from the row
        $wine_name = $row['11'];
        $brand_name = $row['3'];

        // Calculate the similarity between the extracted text and both wine name and brand name
        $wine_similarity = calculateSimilarity($text, $wine_name);
        $brand_similarity = calculateSimilarity($text, $brand_name);

        // If similarity with wine name or brand name is greater than or equal to 60%,
        // add the data to the result
        if ($wine_similarity >= 40 || $brand_similarity >= 40) {
            $index['wine_name'] = $row['11'];
            $index['vintage'] = $row['10'];
            $index['region_of_production'] = $row['8'];
            $index['quantity'] = $row['7'];
            $index['model_name'] = $row['6'];
            $index['importer_information'] = $row['5'];
            $index['grape_variety'] = $row['4'];
            $index['brand_name'] = $row['3']; // Add brand_name to the result
            $index['bottle_information'] = $row['2'];
            $index['alcohol_content'] = $row['1'];
            $index['wine_label_id'] = $row['0'];
            $index['similarity_wine'] = $wine_similarity;
            $index['similarity_brand'] = $brand_similarity;
            $index['extractedtext'] = $text;
            
            array_push($result['data'], $index);
        }
    }

    if (count($result['data']) > 0) {
        $result['success'] = "1";
    } else {
        $result['success'] = "0";
    }
} else {
    $result = array("status" => "failed", "message" => "Barcode ID and Text needed");
}

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
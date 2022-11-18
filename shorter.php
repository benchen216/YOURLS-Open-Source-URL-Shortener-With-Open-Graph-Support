
<?php
include ('config.php');
# 連接 MySQL/MariaDB 資料庫
$connection = new mysqli(SERVER, DB_USER, DB_PASS, DB_NAME);

# 檢查連線是否成功
if ($connection->connect_error) {
    die("連線失敗：" . $connection->connect_error);
}
$fid=0;
$result = $connection->query("SELECT id from og_image_url order by id DESC limit 1;");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $fid = $row["id"];
    }
}
$fid+=1;



$short_url = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data2 = json_decode(file_get_contents('php://input'), true);
    // Init the CURL session 打短網址api
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, YOURLS_URL);
    curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
    curl_setopt($ch, CURLOPT_POST, 1);              // This is a POST request
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(     // Data to POST
        'format'   => 'json',
        'action'   => 'shorturl',
        'signature' => YOURLS_SIGNATURE,
        'url' => DIRECT_URL.$fid,
    ));

// Fetch and return content
    $data = curl_exec($ch);
    curl_close($ch);

    // 解析 JSON
    $data = json_decode( $data );
    //將資料(id 產品id 短網址 原網址)存到DB
    $connection->query("INSERT INTO `og_image_url` (`id`, `url_id`, `short_url`, `url`) VALUES (NULL, '".$data2["url_id"]."', '".$data->shorturl."', '".$data2["url"]."');");
    $connection->close();
    $short_url = $data->shorturl;
}
echo $short_url;


<?php
include ('config.php');
# 連接 MySQL/MariaDB 資料庫
$connection = new mysqli(SERVER, DB_USER, DB_PASS, DB_NAME);

# 檢查連線是否成功
if ($connection->connect_error) {
    die("DB connect fail:" . $connection->connect_error);
}

$sql="SELECT * FROM og_image JOIN og_image_url ON og_image.id = og_image_url.url_id WHERE og_image_url.id ='".$_GET['id']."';";
$result = $connection->query($sql);
$fid = $title = $keyword = $imgurl = $description = $target_url = "";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $fid = $row["id"];
        $title = $row["title"];
        $keyword = $row["keyword"];
        $imgurl = $row["imgurl"];
        $description = $row["descriptions"];
        $target_url = $row["url"];
    }
} else {
    echo "0 results";
}
$connection->close();
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="description" content=' <?php echo $description; ?>' >
    <meta name="keywords" content='<?php echo $keyword; ?>'>
    <meta property="og:image" id="ogimage" content="<?php echo $imgurl; ?>">
    <meta name="author" content="">
    <meta http-equiv="refresh" content="0;url=<?php echo $target_url ?>">
</head>
<body>
</body>
</html>

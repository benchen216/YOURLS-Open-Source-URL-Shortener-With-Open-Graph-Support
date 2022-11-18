
<!DOCTYPE HTML>
<html lang="zh-TW">
<head>
    <style>
        .error {color: #FF0000;}
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</head>
<body>

<?php
include ('config.php');
# 連接 MySQL/MariaDB 資料庫
$connection = new mysqli(SERVER, DB_USER, DB_PASS, DB_NAME);

# 檢查連線是否成功
if ($connection->connect_error) {
    die("DB connect fail:" . $connection->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    //確認資料
    //print_r($data);
    echo $data['title'];
$connection->query("INSERT INTO `og_image` (`id`, `title`, `descriptions`, `imgurl`, `keyword`) VALUES (NULL, '".$data["title"]."', '".$data["description"]."', '".$data["imgurl"]."', '".$data["keyword"]."');");
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<div class="container">
    <div class="rendered-form">
        <div class="formbuilder-text form-group field-name" hidden>
            <label for="fid" class="formbuilder-text-label">編號 id：</label>
            <input type="text" class="form-control" name="fid"  id="fid">
        </div>
        <div class="formbuilder-text form-group field-name">
            <label for="title" class="formbuilder-text-label">標題 title：</label>
            <input type="text" class="form-control" name="title"   id="title">
        </div>
        <div class="formbuilder-text form-group field-imgurl">
            <label for="imgurl" class="formbuilder-text-label">圖片網址 imgurl：</label>
            <input type="text" class="form-control" name="imgurl"  id="imgurl">
        </div>
        <div class="formbuilder-text form-group field-keyword">
            <label for="keyword" class="formbuilder-text-label">關鍵字 keyword：</label>
            <input type="text" class="form-control" name="keyword"  id="keyword">
        </div>
        <div class="formbuilder-textarea form-group field-deception">
            <label for="description" class="formbuilder-textarea-label">說明 description：</label>
            <textarea type="textarea" class="form-control" name="description"  rows="5" id="description"></textarea>
        </div>
        <br>
        <div class="formbuilder-button form-group field-button-1668519592701">
            <button type="submit" class="btn-primary btn" name="button-1668519592701"  style="primary" id="button-1668519592701" >Button</button>
        </div>
        <span id="status">

        </span>
    </div>
</div>
</body>
<script>
    var button = document.getElementById("button-1668519592701");
    button.addEventListener("click", function(){
        button.disabled = true;
        var fid = document.getElementById("fid").value;
        var title = document.getElementById("title").value;
        var imgurl = document.getElementById("imgurl").value;
        var keyword = document.getElementById("keyword").value;
        var description = document.getElementById("description").value;
        var data = {
            "fid": fid,
            "title": title,
            "imgurl": imgurl,
            "keyword": keyword,
            "description": description
        }
        console.log(data);
        fetch('admin.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(async (res) => {
            const data = await res.text();
            document.getElementById("status").textContent = "成功";
        }).catch((err) => {
            console.log(err);
        });
    })
</script>
</html>

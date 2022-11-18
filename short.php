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

<div class="container">
    <div class="rendered-form">
        <div class="formbuilder-select form-group field-select-1668612678182">
            <label for="url_id" class="formbuilder-select-label">預覽資訊選擇 Opengraph detail select：<span class="formbuilder-required">*</span></label>
            <select class="form-control" name="url_id" id="url_id" required="required" aria-required="true">
                <?php
                include ('config.php');
                    $connection = new mysqli(SERVER, DB_USER, DB_PASS, DB_NAME);
                    if ($connection->connect_error) {
                        die("DB connect fail：" . $connection->connect_error);
                    }
                    $result = $connection->query("SELECT id,title from og_image;");
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='".$row['id']."' id='url_id-'".$row['id'].">".$row['title']."</option>";
                        }
                    } ?>
            </select>
        </div>
        <div class="formbuilder-text form-group field-text-1668612671451">
            <label for="url" class="formbuilder-text-label">轉跳網址 Redirect URL：<span class="formbuilder-required">*</span></label>
            <input type="text" class="form-control" name="url"  id="url" required="required" aria-required="true">
        </div>
        <div class="formbuilder-button form-group field-button-1668612742989">
            <button type="submit" class="btn-primary btn" name="button-1668612742989"  style="primary" id="button-1668612742989">送出</button>
        </div>
        <div class="formbuilder-text form-group field-text-345755612">
            <label for="url-short" class="formbuilder-text-label">短網址 Short URL：<span class=""></span></label>
            <input type="text" class="form-control" name="url-short"  id="url-short" disabled aria-required="true" value="">
        </div>
    </div>
</div>
<script>
    var button = document.getElementById("button-1668612742989");
    button.addEventListener("click", function(){

        var url_id = document.getElementById("url_id").value;
        var url = document.getElementById("url").value;
        if(url.includes("<?php echo RESTRICT_URL;?>")){
            var data = {
                "url_id": url_id,
                "url": url,
            }
            console.log(data);
            fetch('shorter.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(async (res)=>{
                var url_short = document.getElementById("url-short");
                url_short.value = await res.text();
            }).catch((err)=>{
                console.log(err);
            })
        }else {
            alert("網址格式錯誤 Only <?php echo RESTRICT_URL;?> can be used");
        }

    })
</script>
</body>
</html>



<?php
// header("Content-Type: text/html; charset=Shift_JIS");
/****
 * 1.建立資料庫及資料表
 * 2.建立上傳檔案機制
 * 3.取得檔案資源
 * 4.取得檔案內容
 * 5.建立SQL語法
 * 6.寫入資料庫
 * 7.結束檔案
 */
if(!empty($_FILES['file'])){
    move_uploaded_file($_FILES['file']['tmp_name'],"./files/{$_FILES['file']['name']}");
    echo $_FILES['file']['name']."上傳成功";
    getfile("./files/{$_FILES['file']['name']}");
}
function getfile($path) {
    $file=fopen($path,'r');
    $line=fgets($file);
    // 轉換為 Shift-JIS
    $line = mb_convert_encoding($line, 'UTF-8', 'SJIS');
    $cols=explode(",",trim($line));
    echo "<table>";
    echo "<tr>";
    foreach($cols as $col){
        echo "<td>$col</td>";
    }
    echo "</tr>";
    // 內容
    while($line=fgets($file)){
        // echo $line;
        // 轉換為 Shift-JIS
        // $line = mb_convert_encoding($line, "SJIS", "UTF-8"); 
        $cols=explode(",",trim($line));
        echo "<tr>";
        foreach ($cols as $col) {
            echo "<td>$col</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    fclose($file);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文字檔案匯入</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 class="header">文字檔案匯入練習</h1>
<!---建立檔案上傳機制--->
<form action="?" method="post" enctype="multipart/form-data">
<label for="file">文字檔</label> 
<input type="file" name="file" id="file">
<input type="submit" value="上傳">
</form>


<!----讀出匯入完成的資料----->



</body>
</html>
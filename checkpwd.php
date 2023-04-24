<?php
  require_once("dbtools.inc.php");
  
  echo$account = $_POST["UserAccount"];
  echo$password = $_POST["UserPassword"];

  $link = create_connection();
  $sql = "SELECT * FROM `users` WHERE `account`='$account' AND `password`='$password'";
  $result = execute_sql($link,'member',$sql);

  //若帳號或密碼錯誤，就跳出提示訊息
  if(mysqli_num_rows($result)==0)
  {
    //釋放記憶體空間
    mysqli_free_result($result);
    //關閉資料連接
    mysqli_close($link);
    echo "<script type='text/javascript'>";
    echo "alert('帳號或密碼錯誤');";
    echo "history.back();";
    echo "</script>";
    
  }
  //若登入成功，就將資料寫入Cookie，並跳轉到會員頁面
  else
  {
    //取得id欄位
    $id = mysqli_fetch_object($result)->id;

    //釋放記憶體空間
    mysqli_free_result($result);
    //關閉資料連接
    mysqli_close($link);

    //將資料寫入coockie
    setcookie("id",$id);
    setcookie("passed","TRUE");
    header("location:main.php");
    
  }


?>
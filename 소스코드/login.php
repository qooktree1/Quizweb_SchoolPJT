<meta charset='utf-8'>
<?
    $connect = mysql_connect("localhost", "kdhong",  "1234");
    mysql_select_db("kdhong_db", $connect);
    mysql_set_charset("utf8", $connect);

    $sql = "select * from user";

    $result=mysql_query($sql, $connect);
    $fields = mysql_num_fields($result);

    $id=$_POST['user_id'];
    $pw=$_POST['password'];

    $id_count=0;

    while($row=mysql_fetch_array($result)){
        if($id==$row['id'] && $pw==$row['pwd']){
            $id_count+=1;
        }
        else if($id == $row['id'] && $pw != $row['pwd']){
            echo("
                <script>
                    alert('틀린 비밀번호입니다.');
                    history.go(-1);
                </script>
            ");
            exit;
        }
    }
    if($id_count==1){
        echo ("<form action='setcookie_user.php' method='post' name='pass'>
        <input type='hidden' name='id' value='$id'>
        </form>");
    echo ("<script>
    document.pass.submit();
    </script>");
    exit;
    }
    elseif($id_count != 1){
        echo("
        <script>
        alert('없는 아이디입니다.');
        history.go(-1);
        </script>
        ");
        exit;
    }
?>
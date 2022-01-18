<meta charset='utf-8'>
<?
    $connect = mysql_connect("localhost", "kdhong",  "1234");
    mysql_select_db("kdhong_db", $connect);
    mysql_set_charset("utf8", $connect);

    $id=$_POST['user_id'];
    $pw=$_POST['password'];
    $name=$_POST['name'];
    $tel=$_POST['phone_number'];
    $mail=$_POST['email'];
    $score_common=0;
    $score_non=0;
    $score_idiom=0;

    $sql = "select * from user";
    $result=mysql_query($sql, $connect);
    $fields=mysql_num_fields($result);

    while($row=mysql_fetch_array($result)){
        if($id==$row['id']){
            echo("
        <script>
        window.alert('이미 있는 아이디입니다.')
        history.go(-1)
        </script>
        ");
        exit;
        }
    }



    $sql = "insert into user values ('', '$id', '$pw', '$name', '$tel', '$mail',";
    $sql .= "$score_common, $score_non, $score_idiom)";

    mysql_query($sql, $connect);

    echo("
                <script>
                    location.href='login.html';
                    alert('성공적으로 등록되었습니다.');
                </script>
            ");    
    
?>
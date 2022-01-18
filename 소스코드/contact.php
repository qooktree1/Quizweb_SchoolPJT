<meta charset="utf-8">
<?

$name=$_POST['name'];
$email=$_POST['email'];
$subject=$_POST['subject'];
$message=$_POST['message'];

$connect=mysql_connect("localhost","kdhong","1234");
mysql_select_db("kdhong_db",$connect);
mysql_set_charset("utf8",$connect);

$sql="insert into contact values ('$email','$name','$subject','$message')";
$result=mysql_query($sql,$connect);

if(!$result){
    echo ("
        <script>
        location.href='contact.html';
        alert('전송에 실패하였습니다.');
        </script>
    ");
}
else{
    echo ("
    <script>
    location.href='contact.html';
    alert('전송에 성공하였습니다.');
    </script>
");
}

mysql_close();

?>
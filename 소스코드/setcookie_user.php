<?
    setcookie('userid', $_POST['id']);
?>
<meta charset='utf-8'>
<?
    echo("
    <script>
    alert('성공적으로 로그인 되었습니다.')
    location.href='index.html'
    </script>
    ");
?>
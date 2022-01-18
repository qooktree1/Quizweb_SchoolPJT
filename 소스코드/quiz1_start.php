<?
    setcookie("count_2", "");
    setcookie("count_3", "");
    $count = 1;
    if(isset($_COOKIE['count_1'])){
        $count = $_COOKIE['count_1'];
        $count++;

        if($count>15){
            setcookie("count_1", "");
            echo("
                <script>
                    location.href='quiz1_print.php';
                </script>
            ");            
        }
        else{
            setcookie("count_1", $count);
        }
    }
    if($count==1){
        setcookie("count_1", $count);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>퀴즈</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
            #quiz {
                margin: 5px;
                display: inline-block;

                padding: 7px 15px;
                font-size: 40px;
                font-weight: 400;
                color: #666666;
                border: 1px solid #dddddd;}
            
            #quiz:hover{
                color: #f7cac9;
                background: #343148;}

            #answer{
                margin: 5px;
                display: inline-block;

                padding: 7px 15px;
                font-size: 40px;
                font-weight: 400;
                color: #666666;
                border: 1px solid #dddddd;}
        </style>
    </head>

    <body>

        <!-- Nav Bar Start -->
        <div class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a href="index.html" class="navbar-brand">Q<span>uiz</span></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="index.html" class="nav-item nav-link">Home</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">QUIZ</a>
                            <div class="dropdown-menu">
                                <a href="quiz1.html" class="dropdown-item">상식</a>
                                <a href="quiz2.html" class="dropdown-item">넌센스</a>
                                <a href="quiz3.html" class="dropdown-item">사자성어</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">RANK</a>
                            <div class="dropdown-menu">
                                <a href="rank1.php" class="dropdown-item">상식</a>
                                <a href="rank2.php" class="dropdown-item">넌센스</a>
                                <a href="rank3.php" class="dropdown-item">사자성어</a>
                            </div>
                        </div>
                        
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                        <?
                            if(isset($_COOKIE['userid'])){
                                echo ("<a href='logout.php' class='nav-item nav-link'>Logout</a>");
                            }
                            else{
                                echo ("<a href='login.html' class='nav-item nav-link'>Login</a>");
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nav Bar End -->


        <!-- Page Header Start -->
        <div class="page-header">
            <div class="col-12">
                <h2>상식퀴즈</h2>
            </div>
        </div>
        <!-- Page Header End -->

        <?
        $id=$_COOKIE['userid'];

        $connect = mysql_connect("localhost", "kdhong",  "1234");
        mysql_select_db("kdhong_db", $connect);
        mysql_set_charset("utf8", $connect);

        $same_count=0;

        $sql="select * from user where id='$id'";
        $result = mysql_query($sql, $connect);
        $id_num = mysql_result($result, 0, 0);


        if($count==1){
            $sql="update user set score_common=0 where id='$id'";
            mysql_query($sql, $connect);

            $sql="insert into check_num values ($id_num,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1)";
            mysql_query($sql, $connect);

            $sql="select * from common_sense";
            $result=mysql_query($sql, $connect);

            $random = mt_rand(0, 49);
            $content=mysql_result($result, $random, 1);
            $answer=mysql_result($result, $random, 2);
            
            
            $sql="update check_num set c1=$random where num=$id_num";
            mysql_query($sql, $connect);
        }
        else{
            $random = mt_rand(0, 49);
            $sql="select * from check_num where num=$id_num";
            $result=mysql_query($sql, $connect);

            while($row = mysql_fetch_row($result)){
                for($i=1; $i<$count; $i++){
                    if($random==$row[$i]){
                        $same_count +=1;
                        $random=mt_rand(0,49);
                        $i=1;
                    }
                    else{
                        $same_count=0;
                    }
                }
            }

            if($same_count==0 && $count != 1){
                $sql="select * from common_sense";
                $result=mysql_query($sql, $connect);

                $content=mysql_result($result, $random, 1);
                $answer=mysql_result($result, $random, 2);
                $text="c"."$count";

                $sql="update check_num set $text = $random where num=$id_num";
                mysql_query($sql, $connect);
            }
            if($count>15){
                $sql="delete from check_num where num='$id_num'";
                mysql_query($sql, $connect);
            }
        }
        
        $sql="select * from user where id='$id'";
        $result=mysql_query($sql, $connect);
        $tmp_score=mysql_result($result, 0, 6);
        
        if($_POST['mode']=="next" && $_POST['answer']==$_POST['temp']){
            $tmp_score+=1;
            $sql="update user set score_common=$tmp_score where id='$id'";
            $result=mysql_query($sql, $connect);
        }        
        ?>


        <!-- Single Post Start-->
        <form action='<? echo $_SERVER['PHP_SELF']; ?>' method='post'>
        <div class="single">
            <div class="container">
                        <div class="single-bio wow fadeInUp">
                            <div class="single-bio-text">
                                <h3>Q. <?=$count?></h3>
                                <p><?=$content?></p>
                            </div>
                        </div>
                        <div class="single-tags wow fadeInUp">
                            <input type='text' name='answer' id='answer'>
                            <input type='submit' id="quiz" value='next'>
                            <input type=hidden name='mode' value='next'>
                            <input type=hidden name='temp' value='<?=$answer?>'>
                        </div>
            </div>
        </div>
        </form>
        <!-- Single Post End-->   

        <?
        mysql_close($connect);
        ?>
        <!-- Footer Start -->
        <div class="footer">
            <div class="footer-info">
                <a href="index.html" class="footer-logo">Q<span>uiz</span></a>
                <h3>고려대학교 컴퓨터정보학과</h3>
                <div class="footer-menu">
                    <p>2016270258 임경민</p>
                    <p>2016270259 박종민</p>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

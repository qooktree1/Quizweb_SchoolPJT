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
            table.rank {
            
            margin: 0 auto;
            border-collapse: collapse;
            text-align: center;
            line-height: 1.5;
            border: 1px solid #ccc;
            margin: 20px 10px;
            }
            table.rank thead {
            border-right: 1px solid #ccc;
            border-left: 1px solid #ccc;
            background: #e7708d;
            }
            table.rank thead th {
            padding: 10px;
            font-weight: bold;
            vertical-align: top;
            color: #fff;
            }
            table.rank tbody th {
            width: 100px;
            padding: 10px;
            font-weight: bold;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
            background: #fcf1f4;
            }
            table.rank td {
            width: 300px;
            padding: 10px;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
            }
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
                <h2>상식퀴즈 랭크</h2>
            </div>
        </div>
        <!-- Page Header End -->

        <?
        $connect = mysql_connect("localhost", "kdhong",  "1234");
        mysql_select_db("kdhong_db", $connect);
        mysql_set_charset("utf8", $connect);

        $sql="select * from user order by max_common desc";
        $result=mysql_query($sql, $connect);

        $count=1;
        
        ?>

        
        <!-- Single Post Start-->

        <div align=center>
            <table class="rank" border=1>
                <thead>
                <tr>
                    <th scope="cols">RANK</th>
                    
                    <th scope="cols">ID</th>
                    <th scope="cols">SCORE</th>
                </tr>
                </thead>
                <tbody>
                    <?
                    while($row=mysql_fetch_array($result)){
                        echo("<tr>");
                        echo("<th scope='row' >$count</th>");
                        echo("<td>$row[id]</td>");
                        echo("<td>$row[max_common]</td>");
                        echo("</tr>");
                        $count++;
                            }
                ?>
                </tbody>
            </table>
        </div>

        <div class="single">
            <div class="container">
                <div class="single-tags wow fadeInUp">
                    <h4 style="color:#343148;">랭크에 이름을 올리고 싶다면 지금 당장 도전해보세요!</h4>
                    <a href='quiz1.html' >GO!</a>
                </div>
            </div>
        </div>
        <?
        mysql_close();
        ?>
        <!-- Single Post End-->   


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

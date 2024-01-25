<?php
session_start();

include("db/connection.php");
include("db/functions.php");

$user_data = check_login($con);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="styles/reports.css?version7" />
    <link rel="stylesheet" href="themeChanger.css?version1" />
    <title>My website</title>
</head>
<body>
<div class="sidebar">
      <div class="profile" id="sticky">
      <div class="namepart">
        <h2>TaskMate</h2>
      </div>
      <ul>
        <li><a href="mainpremium.php" onclick="toggle()"><i class="fa fa-home" aria-hidden="true"></i></a></li>
        <li><a href="premnewtask.php" onclick="toggle()"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
        <li><a href="reports.php" onclick="toggle()"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>
        <li><a href="premmanageacc.php" onclick="toggle()"><i class="fa fa-user" aria-hidden="true"></i></a></li>
        <li><a href="front.html" onclick="toggle()"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
      </ul>

        <div class="toggle" onclick="toggle()"></div>
    </div>
</div>
<h4><?php echo $user_data['FirstName'].' '.$user_data['LastName']; ?></h4>
  <div class="wrap">
    <div class="datefilter">
        <div class="viewfilter">
            <form method="post">
            <select required name="view" id="view">
                <option value="" disabled selected hidden>View</option>
                <option value="1"> Daily</option>
                <option value="2"> Weekly</option>
                <option value="3"> Monthly</option>
                <option value="4"> Yearly</option>
            </select> 
            <input type="date" placeholder="yyyy-mm-dd" maxlength="10" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="date-input" name="date-input"/>
            <div><button class="filter-btn" name="filter-btn" type="submit" >Filter</button></div>
            </form>
        </div>
    </div>
    
    <div class="form-box">
        <div class="dayform">
            <div class="datechanger-day">
                <div class="datevalue">
                    <h2><?php echo date('l M, d Y'); ?></h2>
                </div>
            </div>
        </div>

        <div class="weekform">
            <div class="datechanger-week">
                <div class="datevalue"><h2><?php echo date('M, d Y'); ?></h2></div>
            </div>
        </div>

        <div class="monthform">
            <div class="datechanger-month">
                <div class="datevalue"><h2><?php echo date('M Y'); ?></h2></div>
            </div>
        </div>

        <div class="yearform">
            <div class="datechanger-year">
                <div class="datevalue"><h2><?php echo date('Y'); ?></h2></div>
            </div>
        </div>

        
            <?php
            $id = $user_data['id'];
            $currentDate = date('Y-m-d');
            $bool = false;
            
            if(isset($_POST['filter-btn'])){
                $bool = true;
                $ch_view = $_POST['view'];
                $ch_date = $_POST['date-input'];?>
                <?php
                if($ch_view == 1){
                    $t1 = strtotime($ch_date);
                    $t2 = date('l M, d Y',$t1);
                    ?>
                    <style>
                        .datechanger-day{
                            display: flex;
                        }
                        .datechanger-week,
                        .datechanger-month,
                        .datechanger-year {
                            display: none;
                        }

                        .pictday{
                            display: flex;
                        }

                        .pictweek,
                        .pictmon,
                        .pictyear {
                            display: none;
                        }
                    </style>
                    <script>
                        var value = " <?= $t2 ?>";
                        const eventdate = document.querySelector(".datechanger-day .datevalue h2");
                        eventdate.innerHTML = value; 
                    </script>
                    
                <?php
                
                }

                else if($ch_view == 2){
                    $t1 = strtotime($ch_date);
                    $t4 = date_create($ch_date);
                    $t2 = date('M, d Y',$t1);
                    $t22 = date('Y-m-d', $t1);
                    $t3 = date_sub($t4, date_interval_create_from_date_string("7 days"));
                    $t5 = date_format($t3, 'M, d Y');
                    $t55 = date_format($t3, 'Y-m-d');
                    ?>
                    <style>
                        .datechanger-week{
                            display: flex;
                        }
                        .datechanger-day,
                        .datechanger-month,
                        .datechanger-year {
                            display: none;
                        }
                        .pictweek{
                            display: flex;
                        }

                        .pictday,
                        .pictmon,
                        .pictyear {
                            display: none;
                        }
                    </style>
                    <script>
                        var value = " <?= $t2 ?>";
                        var value2 = " <?= $t5 ?>";
                        const eventdate = document.querySelector(".datechanger-week .datevalue h2");
                        eventdate.innerHTML = value2 + ' - ' + value;
                    </script>
                    
                <?php
                }

                else if($ch_view == 3){
                    $t1 = strtotime($ch_date);
                    $t2 = date('F Y',$t1);
                    ?>
                    <style>
                        .datechanger-month{
                            display: flex;
                        }
                        .datechanger-week,
                        .datechanger-day,
                        .datechanger-year {
                            display: none;
                        }
                        .pictmon{
                            display: flex;
                        }

                        .pictweek,
                        .pictday,
                        .pictyear {
                            display: none;
                        }
                    </style>
                    <script>
                        var value = " <?= $t2 ?>";
                        const eventdate = document.querySelector(".datechanger-month .datevalue h2");
                        eventdate.innerHTML = value; 
                    </script>
                    
                <?php
                }

                else if($ch_view == 4){
                    $t1 = strtotime($ch_date);
                    $t2 = date('Y',$t1);
                    ?>
                    <style>
                        .datechanger-year{
                            display: flex;
                        }
                        .datechanger-week,
                        .datechanger-month,
                        .datechanger-day {
                            display: none;
                        }
                        .pictyear{
                            display: flex;
                        }

                        .pictweek,
                        .pictmon,
                        .pictday {
                            display: none;
                        }
                    </style>
                    <script>
                        var value = " <?= $t2 ?>";
                        const eventdate = document.querySelector(".datechanger-year .datevalue h2");
                        eventdate.innerHTML = value; 
                    </script>
                    
                <?php
                }
            }
            ?>


<div class="pictday">
<?php
        $id = $user_data['id'];

        $currentDate = date('Y-m-d');

        if($bool == true){
        $q1 = "select count(*) as s1 from tasks where UserID = '$id' and Date = '$ch_date' and Status = 1 group by Status";
        $run_q1 = mysqli_query($con, $q1);
        if(mysqli_num_rows($run_q1) > 0){
            foreach($run_q1 as $r1){?>
                <div class="pen"><h3>Pending tasks: <?= $r1['s1']; ?></h3></div>
            <?php
            }
        }

        else if(mysqli_num_rows($run_q1) == 0){
            ?>
                <div class="pen"><h3>Pending tasks: 0</h3></div>
            <?php
        }
        
        
        $q2 = "select count(*) as s2 from tasks where UserID = '$id' and Date = '$ch_date' and Status = 2 group by Status";
        $run_q2 = mysqli_query($con, $q2);
        if(mysqli_num_rows($run_q2) > 0){
            foreach($run_q2 as $r2){?>
                <div class="pro"><h3>Progressing tasks: <?= $r2['s2']; ?></h3></div>
            <?php
            }
        }
        else if(mysqli_num_rows($run_q2) == 0){
            ?>
                <div class="pro"><h3>Progressing tasks: 0</h3></div>
            <?php
        }
        
        $q3 = "select count(*) as s3 from tasks where UserID = '$id' and Date = '$ch_date' and Status = 3 group by Status";
        $run_q3 = mysqli_query($con, $q3);
        if(mysqli_num_rows($run_q3) > 0){
            foreach($run_q3 as $r3){?>
                <div class="com"><h3>Completed tasks: <?= $r3['s3']; ?></h3></div>
            <?php
            }
        }
        else if(mysqli_num_rows($run_q3) == 0){
            ?>
                <div class="com"><h3>Completed tasks: 0</h3></div>
            <?php
        }
        
        $qt = "select count(*) as st from tasks where UserID = '$id' and Date = '$ch_date'";
        $run_qt = mysqli_query($con, $qt);
        if(mysqli_num_rows($run_qt) > 0){
            foreach($run_qt as $rt){?>
                <div class="tot"><h3>Total tasks: <?= $rt['st']; ?></h3></div>
            <?php
            }
        }
        }

        else{
            $q1 = "select count(*) as s1 from tasks where UserID = '$id' and Date = '$currentDate' and Status = 1 group by Status";
            $run_q1 = mysqli_query($con, $q1);
            if(mysqli_num_rows($run_q1) > 0){
                foreach($run_q1 as $r1){?>
                    <div class="pen"><h3>Pending tasks: <?= $r1['s1']; ?></h3></div>
                <?php
                }
            }
    
            else if(mysqli_num_rows($run_q1) == 0){
                ?>
                    <div class="pen"><h3>Pending tasks: 0</h3></div>
                <?php
            }
            
            
            $q2 = "select count(*) as s2 from tasks where UserID = '$id' and Date = '$currentDate' and Status = 2 group by Status";
            $run_q2 = mysqli_query($con, $q2);
            if(mysqli_num_rows($run_q2) > 0){
                foreach($run_q2 as $r2){?>
                    <div class="pro"><h3>Progressing tasks: <?= $r2['s2']; ?></h3></div>
                <?php
                }
            }
            else if(mysqli_num_rows($run_q2) == 0){
                ?>
                    <div class="pro"><h3>Progressing tasks: 0</h3></div>
                <?php
            }
            
            $q3 = "select count(*) as s3 from tasks where UserID = '$id' and Date = '$currentDate' and Status = 3 group by Status";
            $run_q3 = mysqli_query($con, $q3);
            if(mysqli_num_rows($run_q3) > 0){
                foreach($run_q3 as $r3){?>
                    <div class="com"><h3>Completed tasks: <?= $r3['s3']; ?></h3></div>
                <?php
                }
            }
            else if(mysqli_num_rows($run_q3) == 0){
                ?>
                    <div class="com"><h3>Completed tasks: 0</h3></div>
                <?php
            }
            
            $qt = "select count(*) as st from tasks where UserID = '$id' and Date = '$currentDate'";
            $run_qt = mysqli_query($con, $qt);
            if(mysqli_num_rows($run_qt) > 0){
                foreach($run_qt as $rt){?>
                    <div class="tot"><h3>Total tasks: <?= $rt['st']; ?></h3></div>
                <?php
                }
            }
            }

            ?>
</div>
<div class="pictweek">
    <?php
        $id = $user_data['id'];
        $currentDate = date('Y-m-d');
        ?>
        <?php
        $q1 = "select count(*) as s1 from tasks where Date between '$t55' and '$t22' and UserID = '$id' and Status = 1 group by Status";
        $run_q1 = mysqli_query($con, $q1);
        if(mysqli_num_rows($run_q1) > 0){
            foreach($run_q1 as $r1){?>
                <div class="pen"><h3>Pending tasks: <?= $r1['s1']; ?></h3></div>
            <?php
            }
        }

        else if(mysqli_num_rows($run_q1) == 0){
            ?>
                <div class="pen"><h3>Pending tasks: 0</h3></div>
            <?php
        }
        
        
        $q2 = "select count(*) as s2 from tasks where Date between '$t55' and '$t22' and UserID = '$id' and Status = 2 group by Status";
        $run_q2 = mysqli_query($con, $q2);
        if(mysqli_num_rows($run_q2) > 0){
            foreach($run_q2 as $r2){?>
                <div class="pro"><h3>Progressing tasks: <?= $r2['s2']; ?></h3></div>
            <?php
            }
        }
        else if(mysqli_num_rows($run_q2) == 0){
            ?>
                <div class="pro"><h3>Progressing tasks: 0</h3></div>
            <?php
        }
        
        $q3 = "select count(*) as s3 from tasks where Date between '$t55' and '$t22' and UserID = '$id' and Status = 3 group by Status";
        $run_q3 = mysqli_query($con, $q3);
        if(mysqli_num_rows($run_q3) > 0){
            foreach($run_q3 as $r3){?>
                <div class="com"><h3>Completed tasks: <?= $r3['s3']; ?></h3></div>
            <?php
            }
        }
        else if(mysqli_num_rows($run_q3) == 0){
            ?>
                <div class="com"><h3>Completed tasks: 0</h3></div>
            <?php
        }
        
        $qt = "select count(*) as st from tasks where Date between '$t55' and '$t22' and UserID = '$id' ";
        $run_qt = mysqli_query($con, $qt);
        if(mysqli_num_rows($run_qt) > 0){
            foreach($run_qt as $rt){?>
                <div class="tot"><h3>Total tasks: <?= $rt['st']; ?></h3></div>
            <?php
            }
        }

        ?></div>
<div class="pictmon">
<?php
        $id = $user_data['id'];
            // $currentDate = date('Y-m-d');
            // $cD = strtotime($currentDate);
            $cD = strtotime($ch_date);
            $currentMon = date('m', $cD);
            $bool = false;
            $q1 = "select count(*) as s1 from tasks where UserID = '$id' and MONTH(Date) = '$currentMon' and Status = 1 group by Status";
            $run_q1 = mysqli_query($con, $q1);
            if(mysqli_num_rows($run_q1) > 0){
                foreach($run_q1 as $r1){?>
                    <div class="pen"><h3>Pending tasks: <?= $r1['s1']; ?></h3></div>
                <?php
                }
            }

            else if(mysqli_num_rows($run_q1) == 0){
                ?>
                    <div class="pen"><h3>Pending tasks: 0</h3></div>
                <?php
            }
            
            
            $q2 = "select count(*) as s2 from tasks where UserID = '$id' and MONTH(Date) = '$currentMon' and Status = 2 group by Status";
            $run_q2 = mysqli_query($con, $q2);
            if(mysqli_num_rows($run_q2) > 0){
                foreach($run_q2 as $r2){?>
                    <div class="pro"><h3>Progressing tasks: <?= $r2['s2']; ?></h3></div>
                <?php
                }
            }
            else if(mysqli_num_rows($run_q2) == 0){
                ?>
                    <div class="pro"><h3>Progressing tasks: 0</h3></div>
                <?php
            }
            
            $q3 = "select count(*) as s3 from tasks where UserID = '$id' and MONTH(Date) ='$currentMon' and Status = 3 group by Status";
            $run_q3 = mysqli_query($con, $q3);
            if(mysqli_num_rows($run_q3) > 0){
                foreach($run_q3 as $r3){?>
                    <div class="com"><h3>Completed tasks: <?= $r3['s3']; ?></h3></div>
                <?php
                }
            }
            else if(mysqli_num_rows($run_q3) == 0){
                ?>
                    <div class="com"><h3>Completed tasks: 0</h3></div>
                <?php
            }
            
            $qt = "select count(*) as st from tasks where UserID = '$id' and MONTH(Date) ='$currentMon'";
            $run_qt = mysqli_query($con, $qt);
            if(mysqli_num_rows($run_qt) > 0){
                foreach($run_qt as $rt){?>
                    <div class="tot"><h3>Total tasks: <?= $rt['st']; ?></h3></div>
                <?php
                }
            }

            ?>
</div>
<div class="pictyear">
<?php
        $id = $user_data['id'];
            $currentDate = date('Y-m-d');
            $cD = strtotime($currentDate);
            $currentYear = date('Y', $cD);
            $bool = false;
            $q1 = "select count(*) as s1 from tasks where UserID = '$id' and YEAR(Date) = '$currentYear' and Status = 1 group by Status";
            $run_q1 = mysqli_query($con, $q1);
            if(mysqli_num_rows($run_q1) > 0){
                foreach($run_q1 as $r1){?>
                    <div class="pen"><h3>Pending tasks: <?= $r1['s1']; ?></h3></div>
                <?php
                }
            }

            else if(mysqli_num_rows($run_q1) == 0){
                ?>
                    <div class="pen"><h3>Pending tasks: 0</h3></div>
                <?php
            }
            
            
            $q2 = "select count(*) as s2 from tasks where UserID = '$id' and YEAR(Date) = '$currentYear' and Status = 2 group by Status";
            $run_q2 = mysqli_query($con, $q2);
            if(mysqli_num_rows($run_q2) > 0){
                foreach($run_q2 as $r2){?>
                    <div class="pro"><h3>Progressing tasks: <?= $r2['s2']; ?></h3></div>
                <?php
                }
            }
            else if(mysqli_num_rows($run_q2) == 0){
                ?>
                    <div class="pro"><h3>Progressing tasks: 0</h3></div>
                <?php
            }
            
            $q3 = "select count(*) as s3 from tasks where UserID = '$id' and YEAR(Date) = '$currentYear' and Status = 3 group by Status";
            $run_q3 = mysqli_query($con, $q3);
            if(mysqli_num_rows($run_q3) > 0){
                foreach($run_q3 as $r3){?>
                    <div class="com"><h3>Completed tasks: <?= $r3['s3']; ?></h3></div>
                <?php
                }
            }
            else if(mysqli_num_rows($run_q3) == 0){
                ?>
                    <div class="com"><h3>Completed tasks: 0</h3></div>
                <?php
            }
            
            $qt = "select count(*) as st from tasks where UserID = '$id' and YEAR(Date) = '$currentYear'";
            $run_qt = mysqli_query($con, $qt);
            if(mysqli_num_rows($run_qt) > 0){
                foreach($run_qt as $rt){?>
                    <div class="tot"><h3>Total tasks: <?= $rt['st']; ?></h3></div>
                <?php
                }
            }

            ?>
</div>

        
    </div>
</div>
</body>
</html>
<script src="scripts/stylemain.js"></script>
<script src="theme.js"></script>
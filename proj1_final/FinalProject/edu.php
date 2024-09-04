<?php

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

$firstname = $_SESSION['first_name'];
$lastname = $_SESSION['last_name'];
$app_no = $_SESSION['application_number'];
$server = "localhost";
$username = "root";
$password = "";
$database = "faculty";

// Create connection
$conn = mysqli_connect($server, $username, $password , $database );

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$university_prev = "";
$department_prev = "";
$name_phd_prev = "";
$yoj_prev = "";
$ds_prev = "";
$award_prev = "";
$title_prev = "";
$pg_degree_prev = "";
$pg_university_prev = "";
$pg_stream_prev = "";
$pg_yoj_prev = "";
$pg_yoc_prev = "";
$pg_duration_prev = "";
$pg_cgpa_prev = "";
$pg_division_prev = "";
$ug_degree_prev = "";
$ug_university_prev = "";
$ug_stream_prev = "";     
$ug_yoj_prev = "";
$ug_yoc_prev = "";
$ug_duration_prev = "";
$ug_cgpa_prev = "";
$ug_division_prev = "";
$sc_school_prev = "";
$sc_yop_prev = "";
$sc_perce_prev = "";
$sc_div_prev = "";
$sc_school_prev1 = "";
$sc_yop_prev1 = "";
$sc_perce_prev1 = "";
$sc_div_prev1 = "";

$sql = "SELECT * FROM `details_of_phd` WHERE `APP_NO` = '$app_no';";
        $result = $conn->query($sql);
       
        if( mysqli_num_rows($result) == 1 ) {
            $row = $result->fetch_assoc();
            $university_prev = $row["university"];
            $department_prev = $row["department"];
            $name_phd_prev = $row["Name_of_PhD_Supervisor"];
            $yoj_prev = $row["Year_of_Joining"];
            $ds_prev = $row["Date_of_Successful_Thesis_Defence"];
            $award_prev = $row["Date_of_Award"];
            $title_prev = $row["Title_of_PhD_Thesis"];

        }

$sql = "SELECT * FROM `pg_details` WHERE `APP_NO` = '$app_no';";
        $result = $conn->query($sql);
        
        if( mysqli_num_rows($result) == 1 ) {
          $row = $result->fetch_assoc();
          $pg_degree_prev = $row["degree"];
          $pg_university_prev = $row["university"];
          $pg_stream_prev = $row["stream"];
          $pg_yoj_prev = $row["Year_of_Joining"];
          $pg_yoc_prev = $row["Year_of_Completion"];
          $pg_duration_prev = $row["duration"];
          $pg_cgpa_prev = $row["cgpa"];
          $pg_division_prev= $row["division"];

        }

$sql = "SELECT * FROM `ug_details` WHERE `APP_NO` = '$app_no';";
        $result = $conn->query($sql);

        if( mysqli_num_rows($result)  == 1 ) {
          $row = $result->fetch_assoc();
          $ug_degree_prev = $row["degree"];
          $ug_university_prev = $row["university"];
          $ug_stream_prev = $row["stream"];
          $ug_yoj_prev = $row["yoj"];
          $ug_yoc_prev = $row["yoc"];
          $ug_duration_prev = $row["duration"];
          $ug_cgpa_prev = $row["percentage"];
          $ug_division_prev = $row["division"];
          
        }
        

$sql = "SELECT * FROM `school_details` WHERE `APP_NO` ='$app_no' AND `standard` = '12th';";
      $result = $conn->query($sql);

      if( mysqli_num_rows($result) == 1 ) {
        $row = $result->fetch_assoc();
        // $sc_standard_prev = $row["standard"];
        $sc_school_prev = $row["school"];
        $sc_yop_prev = $row["year_of_passing"];
        $sc_perce_prev = $row["percentage/grade"];
        $sc_div_prev = $row["division"];

      }

      // $cnt = $_POST['cnt1'];
      // echo "cnt = ";
      // echo $cnt;


$sql = "SELECT * FROM `school_details` WHERE `APP_NO` = '$app_no' AND `standard` = '10th';";
      $result = $conn->query($sql);

      if( mysqli_num_rows($result) == 1 ) {
        $row = $result->fetch_assoc();
        
        $sc_school_prev1 = $row["school"];
        $sc_yop_prev1 = $row["year_of_passing"];
        $sc_perce_prev1 = $row["percentage/grade"];
        $sc_div_prev1 = $row["division"];
        
      }

    
        $sql_additional = "SELECT * FROM `additional_qualifications` WHERE APP_NO = ?";
        $stmt_additional = $conn->prepare($sql_additional);
        $stmt_additional->bind_param("i", $app_no);
        $stmt_additional->execute();
        $result_additional = $stmt_additional->get_result();

        // Initialize arrays to store retrieved data
        $stored_sno = [];
        $stored_degree = [];
        $stored_university= [];
        $stored_branch = [];
        $stored_yoj = [];
        $stored_yoc = [];
        $stored_duration = [];
        $stored_cgpa = [];
        $stored_class = [];

        // Check if there are rows returned
        // echo $a = $result_additional->num_rows;
        // echo "HIII";
        if ( $result_additional->num_rows > 0 ) {
            //Loop through each row and store the data in arrays
            while ($row = $result_additional->fetch_assoc()) {
                $stored_degree[] = $row['degree'];
                $stored_university[] = $row['university'];
                $stored_branch[] = $row['branch'];
                $stored_yoj[] = $row['yoj'];
                $stored_yoc[] = $row['yoc'];
                $stored_duration[] = $row['duration'];
                $stored_cgpa[] = $row['percentage'];
                $stored_class[] = $row['division'];
            }
        }

        // var_dump($stored_class);


// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['logout'])) {
            // Clear all session variables
            session_unset();
            // Destroy the session
            session_destroy();
            // Redirect to login page
            header("Location: login.php");

            exit();
        }

        $university = $_POST["college_phd"];
        $department = $_POST["stream"];
        $Name_of_PhD_Supervisor = $_POST["supervisor"];
        $Year_of_Joining = $_POST["yoj_phd"];
        $Date_of_Successful_Thesis_Defence = $_POST["dod_phd"];
        $Date_of_Award = $_POST["doa_phd"];
        $Title_of_PhD_Thesis = $_POST["phd_title"];


        $sql = "SELECT * FROM `details_of_phd` WHERE `APP_NO` = '$app_no';";
        $result = $conn->query($sql);
        // echo mysqli_num_rows($result);
        if( mysqli_num_rows($result) == 1 ) {
        
            if( ($university != $university_prev) || ( $department != $department_prev) || ( $Name_of_PhD_Supervisor != $name_phd_prev) || ( $Year_of_Joining != $yoj_prev) ||( !$Date_of_Successful_Thesis_Defence != $ds_prev) || ($Date_of_Award != $award_prev) || ( $Title_of_PhD_Thesis != $title_prev) ) {
              $sql = "UPDATE `details_of_phd`
                  SET `university` = '$university',
                      `department` = '$department',
                      `Name_of_PhD_Supervisor` = '$Name_of_PhD_Supervisor',
                      `Year_of_Joining` = '$Year_of_Joining',
                      `Date_of_Successful_Thesis_Defence` = '$Date_of_Successful_Thesis_Defence',
                      `Date_of_Award` = '$Date_of_Award',
                      `Title_of_PhD_Thesis` = '$Title_of_PhD_Thesis'
                  WHERE `APP_NO` = '$app_no'";

                  $conn->query($sql);

                  // echo "updated";

                  $university_prev = $university;
                  $department_prev = $department;
                  $name_phd_prev = $Name_of_PhD_Supervisor;
                  $yoj_prev = $Year_of_Joining;
                  $ds_prev = $Date_of_Successful_Thesis_Defence;
                  $award_prev = $Date_of_Award;
                  $title_prev = $Title_of_PhD_Thesis;
            }

        }
        else {
        
            $sql = "INSERT INTO `faculty`.`details_of_phd` (`APP_NO` , `university`, `department`, `Name_of_PhD_Supervisor`, `Year_of_Joining`, `Date_of_Successful_Thesis_Defence`, `Date_of_Award` , `Title_of_PhD_Thesis` ) VALUES ('$app_no' , '$university', '$department', '$Name_of_PhD_Supervisor', '$Year_of_Joining', '$Date_of_Successful_Thesis_Defence', '$Date_of_Award' , '$Title_of_PhD_Thesis');";

            if ($conn->query($sql) == true) {
                $insert = true;
                echo $message = "Success!";
                
                $university_prev = $university;
                $department_prev = $department;
                $name_phd_prev = $Name_of_PhD_Supervisor;
                $yoj_prev = $Year_of_Joining;
                $ds_prev = $Date_of_Successful_Thesis_Defence;
                $award_prev = $Date_of_Award;
                $title_prev = $Title_of_PhD_Thesis;
            } else {
                $message = "Error: " . $sql . "<br>" . $conn->error;
            }
        }



        $pg_degree = $_POST['pg_degree'];
        $pg_university = $_POST['pg_college'];
        $pg_stream = $_POST['pg_subjects'];
        $pg_yoj = $_POST['pg_yoj'];
        $pg_yoc = $_POST['pg_yog'];
        $pg_duration = $_POST['pg_duration'];
        $pg_cgpa = $_POST['pg_perce'];
        $pg_division = $_POST['pg_rank'];

        $sql = "SELECT * FROM `pg_details` WHERE `APP_NO` = '$app_no';";
        $result = $conn->query($sql) ;
        
        if( mysqli_num_rows($result) == 1 ) {
          $row = $result->fetch_assoc();

          if( ($pg_degree != $pg_degree_prev) || ($pg_university != $pg_university_prev) ||($pg_stream != $pg_stream_prev) ||( $pg_yoj != $pg_yoj_prev) || ($pg_yoc != $pg_yoc_prev) || ( $pg_duration != $pg_duration_prev) || ( $pg_cgpa != $pg_cgpa_prev) || ( $pg_division != $pg_division_prev) ){
            $sql = "UPDATE `pg_details`
              SET `degree` = '$pg_degree',
                  `university` = '$pg_university',
                  `stream` = '$pg_stream',
                  `Year_of_Joining` = '$pg_yoj',
                  `Year_of_Completion` = '$pg_yoc',
                  `duration` = '$pg_duration',
                  `cgpa` = '$pg_cgpa',
                  `division` = '$pg_division'
              WHERE `APP_NO` = '$app_no'";

              $conn->query($sql);

              $pg_degree_prev = $pg_degree;
              $pg_university_prev = $pg_university;
              $pg_stream_prev = $pg_stream;
              $pg_yoj_prev = $pg_yoj;
              $pg_yoc_prev = $pg_yoc;
              $pg_duration_prev = $pg_duration;
              $pg_cgpa_prev = $pg_cgpa;
              $pg_division_prev = $pg_division;
     
          }

        }
        else {
            $sql =  "INSERT INTO `pg_details` (`APP_NO` , `degree` , `university` , `stream` , `Year_of_Joining` , `Year_of_Completion` , `duration` , `cgpa` , `division` )
            VALUES ('$app_no' , '$pg_degree' , '$pg_university' , '$pg_stream' , '$pg_yoj' , '$pg_yoc', '$pg_duration' , '$pg_cgpa' , '$pg_division' );";
                
            if( $conn->query($sql) == true ) { 
                // echo $m = "data insesrted in pg_details";
                $pg_degree_prev = $pg_degree;
                $pg_university_prev = $pg_university;
                $pg_stream_prev = $pg_stream;
                $pg_yoj_prev = $pg_yoj;
                $pg_yoc_prev = $pg_yoc;
                $pg_duration_prev = $pg_duration;
                $pg_cgpa_prev = $pg_cgpa;
                $pg_division_prev = $pg_division;
       
            }
            else {
                // echo $t = "error in inserting data in pg_details";
            }  
        }

        $ug_degree = $_POST['ug_degree'];
        $ug_university = $_POST['pg_college'];
        $ug_stream = $_POST['ug_subjects'];
        $ug_yoj = $_POST['ug_yoj'];
        $ug_yoc = $_POST['ug_yog'];
        $ug_duration = $_POST['ug_duration'];
        $ug_cgpa = $_POST['ug_perce'];
        $ug_division = $_POST['ug_rank'];

        $sql = "SELECT * FROM `ug_details` WHERE `APP_NO` = '$app_no';";
        $result = $conn->query($sql);

        if( mysqli_num_rows($result)  == 1 ) {
          $row = $result->fetch_assoc();

          if( ($ug_degree != $ug_degree_prev) || ($ug_university != $ug_university_prev) ||($ug_stream != $ug_stream_prev) ||( $ug_yoj != $ug_yoj_prev) || ($ug_yoc != $ug_yoc_prev) || ( $ug_duration != $ug_duration_prev) || ( $ug_cgpa != $ug_cgpa_prev) || ( $ug_division != $ug_division_prev) ){
            $sql = "UPDATE `ug_details`
              SET `degree` = '$ug_degree',
                  `university` = '$ug_university',
                  `stream` = '$ug_stream',
                  `yoj` = '$ug_yoj',
                  `yoc` = '$ug_yoc',
                  `duration` = '$ug_duration',
                  `percentage` = '$ug_cgpa',
                  `division` = '$ug_division'
              WHERE `APP_NO` = '$app_no'";

              $conn->query($sql);

              $ug_degree_prev = $ug_degree;
              $ug_university_prev = $ug_university;
              $ug_stream_prev = $ug_stream;
              $ug_yoj_prev = $ug_yoj;
              $ug_yoc_prev = $ug_yoc;
              $ug_duration_prev = $ug_duration;
              $ug_cgpa_prev = $ug_cgpa;
              $ug_division_prev = $ug_division;
     
          }

        }
        else {

            $sql =  "INSERT INTO `ug_details` (`APP_NO` , `degree` , `university` , `stream` , `yoj` , `yoc` , `duration` , `percentage` , `division` )
            VALUES ('$app_no' , '$ug_degree' , '$ug_university' , '$ug_stream' , '$ug_yoj' , '$ug_yoc', '$ug_duration' , '$ug_cgpa' , '$ug_division' );";
                
            if( $conn->query($sql) == true ) { 
                // echo $m = "data insesrted in ug_details";
                
                $ug_degree_prev = $ug_degree;
                $ug_university_prev = $ug_university;
                $ug_stream_prev = $ug_stream;
                $ug_yoj_prev = $ug_yoj;
                $ug_yoc_prev = $ug_yoc;
                $ug_duration_prev = $ug_duration;
                $ug_cgpa_prev = $ug_cgpa;
                $ug_division_prev = $ug_division;
            }
            else {
                // echo $t = "error in inserting data in ug_details";
            }

      }

        $standard = $_POST['hsc_ssc'];
        $school = $_POST['school'];
        $year_of_passing = $_POST['passing_year'];
        $percentage = $_POST['s_perce'];
        $division = $_POST['s_rank'];

        
        $sql = "SELECT * FROM `school_details` WHERE `APP_NO` ='$app_no' AND `standard` = '12th';";
        $result = $conn->query($sql);

        if( mysqli_num_rows($result) == 1 ) {

          $row = $result->fetch_assoc();
          if(  ( $sc_school_prev != $school) || ( $sc_yop_prev != $year_of_passing ) || ( $percentage != $sc_perce_prev ) || ( $division != $sc_div_prev ) ) {
            $sql = "UPDATE `school_details`
                SET `standard` = '$standard',
                    `school` = '$school',
                    `year_of_passing` = '$year_of_passing',
                    
                    `percentage/grade` = '$percentage',
                    `division` = '$division',
                    `APP_NO` = '$app_no'
                 
                WHERE `APP_NO` = '$app_no' AND `standard` = '12th'";

                $conn->query($sql);

                // echo "school details updated";

                $sc_school_prev = $school;
                $sc_yop_prev = $year_of_passing;
                $sc_perce_prev = $percentage;
                $sc_div_prev = $division;

          }

        }
        else {

          $sql = "INSERT INTO `school_details` ( `standard` , `school` , `year_of_passing` , `percentage/grade` , `division` , `APP_NO` ) VALUES (  '$standard' , '$school' , '$year_of_passing' , '$percentage' , '$division' , '$app_no' );";
                  
          if( $conn->query($sql) == true ) { 
              // echo $m = "<br>data insesrted in school_details";

              $sc_standard_prev = $standard;
              $sc_school_prev = $school;
              $sc_yop_prev = $year_of_passing;
              $sc_perce_prev = $percentage;
              $sc_div_prev = $division;

          }
          else {
              // echo $t = "error in inserting data in school_details";
          }

        }



        $standard = $_POST['hsc_ssc1'];
        $school = $_POST['school1'];
        $year_of_passing = $_POST['passing_year1'];
        $percentage = $_POST['s_perce1'];
        $division = $_POST['s_rank1'];


        $sql = "SELECT * FROM `school_details` WHERE `APP_NO` = '$app_no' AND `standard` = '10th';";
        $result = $conn->query($sql);

        if( mysqli_num_rows($result) == 1 ) {
          $row = $result->fetch_assoc();

          if( ($sc_school_prev1 != $school) || ($sc_yop_prev1 != $year_of_passing) || ($sc_perce_prev1 != $percentage) || ($sc_div_prev1 != $division) ) {
                  $sql = "UPDATE `school_details`
                  SET `standard` = '$standard',
                      `school` = '$school',
                      `year_of_passing` = '$year_of_passing',
                      `percentage/grade` = '$percentage',
                      `division` = '$division',
                      `APP_NO` = '$app_no'
                  
                  WHERE `APP_NO` = '$app_no' AND `standard` = '10th'";

                  $conn->query($sql);

                  // echo "school details updated";

                  $sc_school_prev1 = $school;
                  $sc_yop_prev1 = $year_of_passing;
                  $sc_perce_prev1 = $percentage;
                  $sc_div_prev1 = $division;
          }


        }
        else {

            $sql = "INSERT INTO `school_details` (`standard` , `school` , `year_of_passing` , `percentage/grade` , `division` , `APP_NO` ) VALUES ( '$standard' , '$school' , '$year_of_passing' , '$percentage' , '$division' , '$app_no'  );";
  
            if( $conn->query($sql) == true ) { 
                  $sc_school_prev1 = $school;
                  $sc_yop_prev1 = $year_of_passing;
                  $sc_perce_prev1 = $percentage;
                  $sc_div_prev1 = $division;
                // echo $m = "<br>data insesrted in school_detail";
            }
            else {
                // echo $t = "error in inserting data in school_detail";
            }
        }

    }

          // else {



        if (isset($_POST['submit']) ) {

                $sql = "DELETE FROM `additional_qualifications` WHERE `APP_NO` = '$app_no'";
                $conn->query($sql);


                    $adi_add_degree = $_POST['add_degree'];
                    $adi_college = $_POST['add_college'];
                    $adi_subjects = $_POST['add_subjects'];
                    $adi_yoj = $_POST['add_yoj'];
                    $adi_yog = $_POST['add_yog'];
                    $adi_duration = $_POST['add_duration'];
                    $adi_perce = $_POST['add_perce'];
                    $adi_rank = $_POST['add_rank'];


                $flag = true;
                for( $i = 0 ; $i < count($adi_add_degree); $i++ ) {
                    // func();
                    $degree = $adi_add_degree[$i];
                    $college = $adi_college[$i];
                    $subjects = $adi_subjects[$i];
                    $yoj = $adi_yoj[$i];
                    $yog = $adi_yog[$i];
                    $duration = $adi_duration[$i];
                    $perce = $adi_perce[$i];
                    $rank = $adi_rank[$i];

                    $sql = "INSERT INTO `additional_qualifications` ( `APP_NO` , `degree` , `university` , `branch` , `yoj` , `yoc` , `duration` , `percentage` , `division` ) VALUES ( '$app_no' , '$degree' , '$college' , '$subjects' , '$yoj' , '$yog' , '$duration' , '$perce' , '$rank' );";

                    if( $conn->query($sql) == true ) { 
                        // echo $m = "<br>data inserted in additional_qualifications";

                        header("location: emp_detail.php");
                    }
                    else {
                        $flag = false;
                        break;
                        // echo $t = "error in inserting data in additional_qualifications";
                    }
                
                }

                if( $flag == 1 ) header("Location: emp_detail.php");
                else {
                  // echo $tt = "Error in insertion";
                }
    
        }   
        
        // Close connection
        $conn->close();
}
else {
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Academic Details</title>
	<link rel="stylesheet" type="text/css" href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/css/bootstrap-datepicker.css">
	<script type="text/javascript" src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/js/jquery.js"></script>
	<script type="text/javascript" src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/js/bootstrap.js"></script>
	<script type="text/javascript" src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/js/bootstrap-datepicker.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Sintony" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Hind&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet"> 
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">


	
</head>
<style type="text/css">
	body { background-color: lightgray; padding-top:0px!important;}

</style>
<body>
  <div class="container-fluid" style="background-color: #f7ffff; margin-bottom: 10px">
    <div class="container">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-8 col-md-offset-2">
                <!-- Institute name and logo -->
                <h3 style="
            text-align: center;
            color: #414002 !important;
            font-weight: bold;
            font-size: 2.3em;
            margin-top: 3px;
            font-family: 'Noto Sans', sans-serif;
          ">
                    भारतीय प्रौद्योगिकी संस्थान पटना
                </h3>
                <h3 style="
            text-align: center;
            color: #414002 !important;
            font-weight: bold;
            font-family: 'Oswald', sans-serif !important;
            font-size: 2.2em;
            margin-top: 0px;
          ">
                    Indian Institute of Technology Patna
                </h3>
            </div>
        </div>
    </div>
</div>
<!-- <div class="container-fluid" style="background-color: #f7ffff; margin-bottom: 10px;">
	<div class="container">
        <div class="row" style="margin-bottom:10px; ">
        	<div class="col-md-8 col-md-offset-2">

        		<!--  <img src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/IITIndorelogo.png" alt="logo1" class="img-responsive" style="padding-top: 5px; height: 120px; float: left;"> -->

        		<!-- <h3 style="text-align:center;color:#414002!important;font-weight: bold;font-size: 2.3em; margin-top: 3px; font-family: 'Noto Sans', sans-serif;">भारतीय प्रौद्योगिकी संस्थान इंदौर</h3>
    			<h3 style="text-align:center;color: #414002!important;font-weight: bold;font-family: 'Oswald', sans-serif!important;font-size: 2.2em; margin-top: 0px;">Indian Institute of Technology Indore</h3>
    			 -->

        	</div>
        	

    	   
        </div>
		    <!-- <h3 style="text-align:center; color: #414002; font-weight: bold;  font-family: 'Fjalla One', sans-serif!important; font-size: 2em;">Application for Academic Appointment</h3> -->
    </div> -->
   </div> 
			<h3 style="color: #e10425; margin-bottom: 20px; font-weight: bold; text-align: center;font-family: 'Noto Serif', serif;" class="blink_me">Application for Faculty Position</h3>




<div class="container">




<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 well">
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="ci_csrf_token" value="" />
        <fieldset>
         
             <legend>
              <div class="row">
                <div class="col-md-10">
                    <h4>Welcome : <font color="#025198"><strong><?php echo $firstname ?>&nbsp;<?php echo $lastname?></strong></font></h4>
                </div>
                <div class="col-md-2">
                <a href="login.php" class="btn btn-sm btn-success  pull-right">Logout</a>

                  <!-- <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/facultypanel/logout" class="btn btn-sm btn-success  pull-right">Logout</a> -->
                </div>
              </div>
            
            
    </legend>

<h4 style="text-align:center; font-weight: bold; color: #6739bb;">2. Educational Qualifications</h4>
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-success">
      <div class="panel-heading">(A) Details of PhD *</div>
        <div class="panel-body">
          
          <span class="col-md-2 control-label" for="college_phd">University/Institute</span>  
          <div class="col-md-4">
          <input id="college_phd" value= "<?php echo $university_prev ?>" name="college_phd" type="text" placeholder="University/Institute" class="form-control input-md" autofocus="" required="">
          </div>

          <span class="col-md-2 control-label" for="stream">Department</span>  
          <div class="col-md-4">
          <input id="stream" value="<?php echo $department_prev ?>" name="stream" type="text" placeholder="Department" class="form-control input-md" autofocus="">
          </div> 
          
          <span class="col-md-2 control-label" for="duration_phd">Name of PhD Supervisor</span>  
          <div class="col-md-4">
          <input id="supervisor" name="supervisor" type="text" placeholder="Name of Ph. D. Supervisor" value="<?php echo $name_phd_prev ?>" class="form-control input-md" required="">
          </div>

          <span class="col-md-2 control-label" for="yoj_phd">Year of Joining</span>  
          <!-- <div class="col-md-4">
          <input id="yoj_phd"  name="yoj_phd" type="text" placeholder="Year of Joining"  class="form-control input-md" required="">
          </div> -->
          <div class="col-md-4">
            <input id="yoj_phd" name="yoj_phd" type="number" value = "<?php echo $yoj_prev ?>" placeholder="Year of Joining" class="form-control input-md" required="" min="1900" max="9999">
        </div>

          
          <div class="row">
          <div class="col-md-12">
          <span class="col-md-2 control-label" for="dod_phd">Date of Successful Thesis Defence</span>  
          <div class="col-md-4">
          <input id="dod_phd" name="dod_phd" value = "<?php echo $ds_prev ?>" type="text" data-provide="datepicker"  placeholder="Date of Defence"  class="form-control input-md datepicker" required="">
          </div>

          <span class="col-md-2 control-label" for="doa_phd">Date of Award</span>  
          <div class="col-md-4">
          <input id="doa_phd" name="doa_phd" value = "<?php echo $award_prev ?>" type="text" data-provide="datepicker" placeholder="Date of Award" class="form-control input-md datepicker" required="">
          </div>
          </div>
          </div>
          <br />
          <span class="col-md-2 control-label" for="phd_title">Title of PhD Thesis</span>  
          <div class="col-md-10">
          <input id="phd_title" value="<?php echo $title_prev ?>" name="phd_title" type="text" placeholder="Title of PhD Thesis" class="form-control input-md" required="">
          </div>

      </div>
    </div>
  </div>
</div>


<div class="row">
    <div class="col-md-12">
      <div class="panel panel-success">
      <div class="panel-heading">(B) Academic Details - M. Tech./ M.E./ PG Details</div>
        <div class="panel-body">
          
          <span class="col-md-2 control-label" for="pg_degree">Degree/Certificate</span>  
          <div class="col-md-4">
          <input id="pg_degree"  name="pg_degree" value = "<?php echo $pg_degree_prev ?>" type="text" placeholder="Degree/Certificate" class="form-control input-md" autofocus="">
          </div>

          <span class="col-md-2 control-label" for="pg_college">University/Institute</span>  
          <div class="col-md-4">
          <input id="pg_college"  name="pg_college" value = "<?php echo $pg_university_prev ?>" type="text" placeholder="University/Institute" class="form-control input-md" autofocus="">
          </div> 
          
          <span class="col-md-2 control-label" for="pg_subjects">Branch/Stream</span>  
          <div class="col-md-4">
          <input id="pg_subjects" name="pg_subjects" value = "<?php echo $pg_stream_prev ?>" type="text" placeholder="Branch/Stream"  class="form-control input-md" >
          </div>

          <span class="col-md-2 control-label" for="pg_yoj">Year of Joining</span>  
          <div class="col-md-4">
          <input id="pg_yoj" name="pg_yoj" type="number" value = "<?php echo $pg_yoj_prev ?>" placeholder="Year of Joining" class="form-control input-md" >
          </div>
          
          <div class="row">
          <div class="col-md-12">
          <span class="col-md-2 control-label" for="pg_yog">Year of Completion</span>  
          <div class="col-md-4">
          <input id="pg_yog" name="pg_yog" type="number" value = "<?php echo $pg_yoc_prev?>" placeholder="Year of Completion"  class="form-control input-md" >
          </div>

          <span class="col-md-2 control-label" for="pg_duration">Duration (in years)</span>  
          <div class="col-md-4">
          <input id="pg_duration" name="pg_duration" type="number" value = "<?php echo $pg_duration_prev ?>" placeholder="Duration" class="form-control input-md" >
          </div>

          <span class="col-md-2 control-label" for="pg_perce">Percentage/ CGPA</span>  
          <div class="col-md-4">
          <input id="pg_perce" name="pg_perce" value = "<?php echo $pg_cgpa_prev ?>" type="text" placeholder="Percentage/ CGPA"class="form-control input-md" >
          </div>

          <span class="col-md-2 control-label" for="pg_rank">Division/Class</span>  
          <div class="col-md-4">
          <input id="pg_rank" name="pg_rank" value = "<?php echo $pg_cgpa_prev ?>" type="text" placeholder="Division/Class" class="form-control input-md" >
          </div>

          </div>
          </div>
          <br />
          

      </div>
    </div>
  </div>
</div>



<div class="row">
    <div class="col-md-12">
      <div class="panel panel-success">
      <div class="panel-heading">(C) Academic Details - B. Tech /B.E. / UG Details *</div>
        <div class="panel-body">
          
          <span class="col-md-2 control-label" for="ug_degree">Degree/Certificate</span>  
          <div class="col-md-4">
          <input id="ug_degree"  value = "<?php echo $ug_degree_prev ?>" name="ug_degree" type="text" placeholder="Degree/Certificate" class="form-control input-md" autofocus="" required="">
          </div>

          <span class="col-md-2 control-label" for="ug_college">University/Institute</span>  
          <div class="col-md-4">
          <input id="ug_college"  value = "<?php echo $ug_university_prev ?>" name="ug_college" type="text" placeholder="University/Institute" class="form-control input-md" autofocus="">
          </div> 
          
          <span class="col-md-2 control-label" for="ug_subjects">Branch/Stream</span>  
          <div class="col-md-4">
          <input id="ug_subjects" value = "<?php echo $ug_stream_prev ?>" name="ug_subjects" type="text" placeholder="Branch/Stream"  class="form-control input-md" required="">
          </div>

          <span class="col-md-2 control-label" for="ug_yoj">Year of Joining</span>  
          <div class="col-md-4">
          <input id="ug_yoj"  value = "<?php echo $ug_yoj_prev ?>" name="ug_yoj" type="number" placeholder="Year of Joining" class="form-control input-md" required="">
          </div>
          
          <div class="row">
          <div class="col-md-12">
          <span class="col-md-2 control-label" for="ug_yog">Year of Completion</span>  
          <div class="col-md-4">
          <input id="ug_yog" value = "<?php echo $ug_yoc_prev?>" name="ug_yog" type="number" placeholder="Year of Completion" class="form-control input-md" required="">
          </div>

          <span class="col-md-2 control-label" for="ug_duration">Duration (in years)</span>  
          <div class="col-md-4">
          <input id="ug_duration" value = "<?php echo $ug_duration_prev ?>"  name="ug_duration" type="number" placeholder="Duration"  class="form-control input-md" required="">
          </div>

          <span class="col-md-2 control-label" for="ug_perce">Percentage/ CGPA</span>  
          <div class="col-md-4">
          <input id="ug_perce" name="ug_perce" value = "<?php echo $ug_cgpa_prev ?>" type="text" placeholder="Percentage/ CGPA" class="form-control input-md" required="">
          </div>

          <span class="col-md-2 control-label" for="ug_rank">Division/Class</span>  
          <div class="col-md-4">
          <input id="ug_rank" name="ug_rank" value = "<?php echo $ug_division_prev ?>" type="text" placeholder="Division/Class" class="form-control input-md" required="">
          </div>

          

          </div>
          </div>
          <br />
          

      </div>
    </div>
  </div>
</div>


<div class="row">
    <div class="col-md-12">
      <div class="panel panel-success">
      <div class="panel-heading">(D) Academic Details - School *
        
      </div>
        <div class="panel-body">
          <table class="table table-bordered">
              
              <tr height="30px">
                <th class="col-md-3"> 10th/12th/HSC/Diploma </th>
                <th class="col-md-3"> School </th>
                <th class="col-md-1"> Year of Passing</th>
                <th class="col-md-2"> Percentage/ Grade </th>
                <th class="col-md-2"> Division/Class </th>
              </tr>

              
              
              <tr height="60px">
                <td class="col-md-2">  
                    <input id="hsc_ssc1" name="hsc_ssc" type="text" value="12th" placeholder="" class="form-control input-md" readonly="" required=""> 
                </td>

                <td class="col-md-2"> 
                    <input id="school1" value = "<?php echo $sc_school_prev ?>" name="school" type="text"  placeholder="School" class="form-control input-md" maxlength="80" required=""> 
                  </td>
                <td class="col-md-2"> 
                  <input id="passing_year1" value = "<?php echo $sc_yop_prev ?>" name="passing_year" type="text"  placeholder="Passing Year" class="form-control input-md" maxlength="5" required=""> 
                </td>

              

                <td class="col-md-2"> 
                  <input id="s_perce1"  value = "<?php echo $sc_perce_prev ?>" name="s_perce" type="text"  placeholder="Percentage/Grade" class="form-control input-md" maxlength="5" required="">
                </td>

                 
                <td class="col-md-2"> 
                  <input id="s_rank1" value = "<?php echo $sc_div_prev ?>"  name="s_rank" type="text" placeholder="Division" class="form-control input-md" maxlength="5" required="">
                </td>



              </tr>
              
              <tr height="60px">
                <td class="col-md-2">  
                    <input id="hsc_ssc2" name="hsc_ssc1" type="text" value="10th" placeholder="" class="form-control input-md" readonly="" required=""> 
                </td>

                <td class="col-md-2"> 
                    <input id="school2" name="school1" type="text"  value = "<?php echo $sc_school_prev1?>" placeholder="School" class="form-control input-md" maxlength="80" required=""> 
                  </td>
                <td class="col-md-2"> 
                  <input id="passing_year2" name="passing_year1" value = "<?php echo $sc_yop_prev1?>" type="text" placeholder="Passing Year" class="form-control input-md" maxlength="5" required=""> 
                </td>

              

                <td class="col-md-2"> 
                  <input id="s_perce2" name="s_perce1" type="text"  value = "<?php echo $sc_perce_prev1?>" placeholder="Percentage/Grade" class="form-control input-md" maxlength="5" required="">
                </td>

                 
                <td class="col-md-2"> 
                  <input id="s_rank2" name="s_rank1" type="text" value = "<?php echo $sc_div_prev1?>"  placeholder="Division" class="form-control input-md" maxlength="5" required="">
                </td>


              </tr>
                            
           
          </table>

      </div>
    </div>
  </div>
</div>

 
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-success">
      <div class="panel-heading">(E) Additional Educational Qualification (If any)
        <button class="btn btn-sm btn-danger" id="add_more_acde">Add More</button>
      </div>
        <div class="panel-body">
          <table class="table table-bordered">
              <tbody id="acde">

              <style>
                /* Custom CSS to set the width of the first column */
                .custom-col-width {
                    width: 520px;
                    /* max-width: 5%; */
                }
                </style>
              
              
              <tr height="30px">
                <!-- <th class="custom-col-width" style = "width:20px"> S/No. </th> -->
                <th class="col-md-2"> Degree/Certificate </th>
                <th class="col-md-2"> University/Institute </th>
                <th class="col-md-2"> Branch/Stream </th>
                <th class="col-md-1"> Year of Joining</th>
                <th class="col-md-1"> Year of Completion </th>
                <th class="col-md-1"> Duration (in years)</th>
                <th class="col-md-3"> Percentage/ CGPA </th>
                <th class="col-md-3"> Division/Class</th>
              </tr>

                <?php 

                global $stored_branch;
                global $i;

                for($i = 0; $i < count($stored_branch); $i++ ) {
                //   echo $i;
                  ?>
                      <tr height="60px" id="row<?php echo $i + 1; ?>">

                       
                        <td class="col-md-2" >  
                            <input id="add_degree1<?php echo $i + 1; ?>" name="add_degree[]" type="text" value="<?php echo isset($stored_degree[$i]) ? $stored_degree[$i] : ''; ?>" placeholder="Degree" class="form-control input-md" required=""> 
                        </td>

                        <td class="col-md-2"> 
                            <input id="add_college1<?php echo $i + 1; ?>" name="add_college[]" type="text" value="<?php echo isset($stored_university[$i]) ? $stored_university[$i] : ''; ?>"  placeholder="College" class="form-control input-md"  required=""> 
                          </td>

                        <td class="col-md-2"> 
                            <input id="add_subjects1<?php echo $i + 1; ?>" name="add_subjects[]" type="text" value="<?php echo isset($stored_branch[$i]) ? $stored_branch[$i] : ''; ?>"  placeholder="Subjects" class="form-control input-md" required=""> 
                          </td>

                        <td class="col-md-2"> 
                          <input id="add_yoj1<?php echo $i + 1; ?>" name="add_yoj[]" type="text" value="<?php echo isset($stored_yoj[$i]) ? $stored_yoj[$i] : ''; ?>"  placeholder="Year of Joining" class="form-control input-md"  required=""> 
                        </td>
                        <td class="col-md-2"> 
                          <input id="add_yog1<?php echo $i + 1; ?>" name="add_yog[]" type="text" value="<?php echo isset($stored_yoc[$i]) ? $stored_yoc[$i] : ''; ?>"  placeholder="Year of Graduation" class="form-control input-md"  required=""> 
                        </td>
                        <td class="col-md-2"> 
                          <input id="add_duration1<?php echo $i + 1; ?>" name="add_duration[]" type="text" value="<?php echo isset($stored_duration[$i]) ? $stored_duration[$i] : ''; ?>"  placeholder="Duration" class="form-control input-md" required=""> 
                        </td>

                        <td class="col-md-2"> 
                          <input id="add_perce1<?php echo $i + 1; ?>" name="add_perce[]" type="text" value="<?php echo isset($stored_cgpa[$i]) ? $stored_cgpa[$i] : ''; ?>"  placeholder="Percentage" class="form-control input-md"  required="">
                        </td>

                        <td class="col-md-2"> 
                          <input id="add_rank1<?php echo $i + 1; ?>" name="add_rank[]" type="text" value="<?php echo isset($stored_class[$i]) ? $stored_class[$i] : ''; ?>"  placeholder="Percentage" class="form-control input-md" required="">
                            

                          <button class="close" onclick="remove_row('acde', <?php echo $i + 1; ?> )"><span style="color:red; font-weight:bold;">x</span></button>
                        </td>
                        
                      </tr>
                <?php
                }
                ?>
            

              
            </tbody>
          </table>

      </div>
    </div>
  </div>
</div>
     <!-- Form Name -->



<div class="form-group">
  
  <div class="col-md-1">
    <a href="welcome.php" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
  </div>

  <div class="col-md-11">
    <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right" style="margin-left: 75%;">SAVE & NEXT</button>
    
  </div>

    
</div>
          
</fieldset>
</form>

        </div>
    </div>
</div>




<script type="text/javascript">
  function yearcalc()
  { 
    // alert('hi');
    var num1=document.getElementById("yoj").value;
    var num2=document.getElementById("yog").value;

    var duration_year=parseFloat(num2)-parseFloat(num1);
    // alert(duration_year);
    document.getElementById("result_test").value = duration_year ;
   
  }

 
</script>

<div id="footer"></div>
</body>
</html>

<script type="text/javascript">
	
	function blinker() {
	    $('.blink_me').fadeOut(500);
	    $('.blink_me').fadeIn(500);
	}

	setInterval(blinker, 1000);
</script>

<script type="text/javascript">
var tr="";
var counter_acde = parseInt("<?php echo count($stored_branch);?>");
var counter = 0;
  $(document).ready(function(){
    $("#add_more_acde").click(func);

    function func(){

        // var len = $('.sl').length();
        create_tr();
        create_input('add_degree[]', 'Degree','add_degree'+counter_acde, 'acde', counter_acde, 'acde');
        create_input('add_college[]', 'College', 'add_college'+counter_acde,'acde', counter_acde, 'acde');
        create_input('add_subjects[]', 'Subjects', 'add_subjects'+counter_acde,'acde', counter_acde, 'acde');
        create_input('add_yoj[]', 'Year Of Joining', 'add_yoj'+counter_acde,'acde', counter_acde, 'acde');
        create_input('add_yog[]', 'Year Of Graduation','add_yog'+counter_acde, 'acde', counter_acde, 'acde');
        create_input('add_duration[]', 'Duration','add_duration'+counter_acde, 'acde', counter_acde, 'acde');
        create_input('add_perce[]', 'Percentage','add_perce'+counter_acde, 'acde', counter_acde, 'acde');
        create_input('add_rank[]', 'Rank', 'add_rank'+counter_acde,'acde', counter_acde,'acde',true);
        counter_acde++;
       
        return false;

    }
    
    
  });
  function create_tr()
  {
    tr=document.createElement("tr");
  }

  function for_date_picker(obj)
  {
    obj.setAttribute("data-provide", "datepicker");
    obj.className += " datepicker";
    return obj;

  }
  function create_input(t_name, place_value, id, tbody_id, counter, remove_name, btn=false, datepicker_set=false, length=80)
{
    var input=document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("name", t_name);
    input.setAttribute("id", id);
    input.setAttribute("placeholder", place_value);
    input.setAttribute("class", "form-control input-md");
    input.setAttribute("maxlength", length);
    input.setAttribute("required", "");
    if(datepicker_set==true)
    {
      input=for_date_picker(input);
    }
    
    var td=document.createElement("td");
    td.appendChild(input);
    
    // Check if the serial number cell exists
    // var serialCell = tr.querySelector('.serial-cell');
    // if (!serialCell) {
    //     // Create serial number cell if it doesn't exist
    //     serialCell = document.createElement("td");
    //     serialCell.className = "serial-cell";
    //     var serialInput = document.createElement("input");
    //     serialInput.setAttribute("type", "text");
    //     serialInput.setAttribute("class", "form-control input-md");
    //     serialInput.setAttribute("readonly", "true");
    //     serialCell.appendChild(serialInput);
    //     tr.insertBefore(serialCell, tr.firstChild);
    // }
    
    // Update the serial number
    var serialNumber = counter + 1;
    // var serialInput = serialCell.querySelector('input');
    // serialInput.value = serialNumber;
    
    // Insert the new column data after the Serial Number column
    tr.appendChild(td);
    
    if(btn==true)
    {
        var but=document.createElement("button");
        but.setAttribute("class", "close");
        but.setAttribute("onclick", "remove_row('"+remove_name+"','"+serialNumber+"')");
        but.innerHTML="<span style='color:red; font-weight:bold;'>x</span>";
        td.appendChild(but);
    }
    
    tr.setAttribute("id", "row"+serialNumber);
    document.getElementById(tbody_id).appendChild(tr);
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
}
function remove_row(remove_name, n)
{
    var tab = document.getElementById(remove_name);
    var tr=document.getElementById("row"+n);
    tab.removeChild(tr);
    counter_acde--;
}

</script>



<script type="text/javascript">
    $(function () {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
</script>
<style type="text/css">
body { padding-top:30px; }
.form-control { margin-bottom: 10px; }
.floating-box {
    display: inline-block;
    width: 150px;
    height: 75px;
    margin: 10px;
    border: 3px solid #73AD21;  
}
</style>
<style type="text/css">
body { padding-top:30px; }
.form-control { margin-bottom: 10px; }
label{
  padding: 0 !important;
}
hr{
  border-top: 1px solid #025198 !important;
}
span{
  font-size: 1.2em;
  font-family: 'Oswald', sans-serif!important;
  text-align: left!important;
  padding: 0px 10px 0px 0px!important;
  /*margin-bottom: 20px!important;*/

}
hr{
  border-top: 1px solid #025198 !important;
  border-style: dashed!important;
  border-width: 1.2px;
}

.panel-heading{
  font-size: 1.3em;
  font-family: 'Oswald', sans-serif!important;
  letter-spacing: .5px;
}
.btn-primary {
  padding: 9px;
}
</style>



<script type="text/javascript">

document.getElementById('submit').addEventListener('click', function(event) {
  var isValid = true;

  // Validate PhD details
  var college_phd = document.getElementById('college_phd').value;
  var stream = document.getElementById('stream').value;
  var supervisor = document.getElementById('supervisor').value;
  var yoj_phd = document.getElementById('yoj_phd').value;
  var dod_phd = document.getElementById('dod_phd').value;
  var doa_phd = document.getElementById('doa_phd').value;
  var phd_title = document.getElementById('phd_title').value;

  if (college_phd === '' || stream === '' || supervisor === '' || yoj_phd === '' || dod_phd === '' || doa_phd === '' || phd_title === '') {
    isValid = false;
    alert('Please fill in all required fields in the PhD section.');
  }

  // Validate M.Tech./M.E./PG details
  var pg_degree = document.getElementById('pg_degree').value;
  var pg_college = document.getElementById('pg_college').value;
  var pg_subjects = document.getElementById('pg_subjects').value;
  var pg_yoj = document.getElementById('pg_yoj').value;
  var pg_yog = document.getElementById('pg_yog').value;
  var pg_duration = document.getElementById('pg_duration').value;
  var pg_perce = document.getElementById('pg_perce').value;
  var pg_rank = document.getElementById('pg_rank').value;

  if (pg_degree === '' || pg_college === '' || pg_subjects === '' || pg_yoj === '' || pg_yog === '' || pg_duration === '' || pg_perce === '' || pg_rank === '') {
    isValid = false;
    alert('Please fill in all required fields in the M.Tech./M.E./PG section.');
  }

  // Validate B.Tech./B.E./UG details
  var ug_degree = document.getElementById('ug_degree').value;
  var ug_college = document.getElementById('ug_college').value;
  var ug_subjects = document.getElementById('ug_subjects').value;
  var ug_yoj = document.getElementById('ug_yoj').value;
  var ug_yog = document.getElementById('ug_yog').value;
  var ug_duration = document.getElementById('ug_duration').value;
  var ug_perce = document.getElementById('ug_perce').value;
  var ug_rank = document.getElementById('ug_rank').value;

  if (ug_degree === '' || ug_college === '' || ug_subjects === '' || ug_yoj === '' || ug_yog === '' || ug_duration === '' || ug_perce === '' || ug_rank === '') {
    isValid = false;
    alert('Please fill in all required fields in the B.Tech./B.E./UG section.');
  }

  // Validate School details
  var hsc_ssc1 = document.getElementById('hsc_ssc1').value;
  var school1 = document.getElementById('school1').value;
  var passing_year1 = document.getElementById('passing_year1').value;
  var s_perce1 = document.getElementById('s_perce1').value;
  var s_rank1 = document.getElementById('s_rank1').value;

  if (hsc_ssc1 === '' || school1 === '' || passing_year1 === '' || s_perce1 === '' || s_rank1 === '') {
    isValid = false;
    alert('Please fill in all required fields in the School details section.');
  }

  var hsc_ssc2 = document.getElementById('hsc_ssc2').value;
  var school2 = document.getElementById('school2').value;
  var passing_year2 = document.getElementById('passing_year2').value;
  var s_perce2 = document.getElementById('s_perce2').value;
  var s_rank2 = document.getElementById('s_rank2').value;

  if (hsc_ssc2 === '' || school2 === '' || passing_year2 === '' || s_perce2 === '' || s_rank2 === '') {
    isValid = false;
    alert('Please fill in all required fields in the School details section.');
  }

  if (!isValid) {
    event.preventDefault();
  }
});
</script>
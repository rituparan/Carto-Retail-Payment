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
    // echo "EE";
    // Create connection
    $conn = mysqli_connect($server, $username, $password , $database );

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $sql = "SELECT * FROM `registration` WHERE `APP_NO` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $app_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $firstname = $row['FIRSTNAME'];
        $lastname = $row['LASTNAME'];
        $email = $row['EMAIL'];
        // $date_of_app = $row['APP_DATE'];
        $category = $row['CATEGORY'];
    } else {
        // echo "User not found.";
        exit();
    }


    $sql = "SELECT * FROM `present_employment` WHERE `APP_NO` = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $app_no );
    $stmt->execute();
    $result_prev = $stmt->get_result();

    if( $result_prev->num_rows > 0 ) {
      $row = $result_prev->fetch_assoc();

      $emp_prev_position = $row['position'];
      $emp_prev_status = $row['status'];
      $emp_prev_dol= $row['DateOfLeaving'];
      $emp_prev_org  = $row['OrganizationInstitution'];
      $emp_prev_doj = $row['DateOfJoining'];
      $emp_prev_duration = $row['DurationYears'];  
    }
    mysqli_free_result($result_prev);
    $stmt->close();

    //B
    $sql = "SELECT * FROM `employmenthistory` WHERE `APP_NO` = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $app_no );
    $stmt->execute();
    $result_prev = $stmt->get_result();
    
      $prev_position = [];
      $prev_org = [];
      $prev_doj = [];
      $prev_dol = [];
      $prev_duration = [];


    // Check if there are any rows returned
    if ($result_prev->num_rows > 0) {
        // Loop through each row
        while ($row = $result_prev->fetch_assoc()) {
            // Store data into respective arrays
            $prev_position[] = $row['Position'];
            $prev_org[] = $row['Organization'];
            $prev_doj[] = $row['Date_of_Joining'];
            $prev_dol[] = $row['Date_of_Leaving'];
            $prev_duration = $row['duration'];

        }
    }

    mysqli_free_result($result_prev);
    $stmt->close();
    //C
    
    $sql = "SELECT * FROM `teachingexperience` WHERE `APP_NO` = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $app_no );
    $stmt->execute();
    $result_prev = $stmt->get_result();

    $te_prev_position = [] ;
    $te_prev_employer = [];
    $te_prev_course= [];
    $te_prev_ug_pg = [];
    $te_prev_nos = [];
    $te_prev_doj = [];
    $te_prev_dol = [];
    $te_prev_duration = [];  

    if( $result_prev->num_rows > 0 ) {
      while(  $row = $result_prev->fetch_assoc() ) {

        $te_prev_position[] = $row['position'];
        $te_prev_employer[] = $row['employer'];
        $te_prev_course[]= $row['CourseTaught'];
        $te_prev_ug_pg[]  = $row['UG_PG'];
        $te_prev_nos[] = $row['NoOfStudents'];
        $te_prev_doj[] = $row['DateOfJoining'];
        $te_prev_dol[] = $row['DateOfLeaving'];
        $te_prev_duration[] = $row['Duration'];  
      }
    }


    mysqli_free_result($result_prev);
    $stmt->close();
      //D
      $sql = "SELECT * FROM `research_experience` WHERE `APP_NO` = ?;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $app_no );
      $stmt->execute();
      $result_prev = $stmt->get_result();

      $re_prev_position = [] ;
      $re_prev_institute= [];
      $re_prev_supervisor= [];
      $re_prev_doj = [];
      $re_prev_dol = [];
      $re_prev_duration = [];  

      if( $result_prev->num_rows > 0 ) {
        while(  $row = $result_prev->fetch_assoc() ) {

          $re_prev_position[] = $row['position'];
          $re_prev_institute[] = $row['Institute'];
          $re_prev_supervisor[]= $row['Supervisor'];
      
          $re_prev_doj[] = $row['DateOfJoining'];
          $re_prev_dol[] = $row['DateOfLeaving'];
          $re_prev_duration[] = $row['duration']; 
        }
      }

      mysqli_free_result($result_prev);
      $stmt->close();

      //E
      $sql = "SELECT * FROM `industrial_experience` WHERE `APP_NO` = ?;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $app_no );
      $stmt->execute();
      $result_prev = $stmt->get_result();

      $ie_prev_org = [];
      $ie_prev_work = [];
      $ie_prev_doj = [];
      $ie_prev_dol = [];
      $ie_prev_duration = [];  

      if( $result_prev->num_rows > 0 ) {
        while(  $row = $result_prev->fetch_assoc() ) {
          $ie_prev_org[] = $row['organization'];
          $ie_prev_work[] = $row['WorkProfile'];
         
          $ie_prev_doj[] = $row['DateOfJoining'];
          $ie_prev_dol[] = $row['DateOfLeaving'];
          $ie_prev_duration[] = $row['Duration']; 
        }
      }



      
      $prev_area_of_specialization = "";
      $prev_area_of_research = "";
      $sql = "SELECT * FROM `specialization` WHERE `APP_NO` = ?;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $app_no);
      
      if(!$stmt->execute()) {
        // echo "Error: " . $sql . "<br>" . $conn->error;
        // break; // Exit loop if an error occurs
      }
      else {
        
        $result_prev = $stmt->get_result();
        if( $result_prev->num_rows > 0  ) {
          $row = $result_prev->fetch_assoc() ;
          $prev_area_of_specialization = $row['area_of_specialization'];
          $prev_area_of_research = $row['current_area_of_research'];
        }
      }
                    
      mysqli_free_result($result_prev);
      $stmt->close();

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Logout process
        if (isset($_POST['logout'])) {
            // Clear all session variables
            session_unset();
            // Destroy the session
            session_destroy();
            // Redirect to login page
            header("Location: login.php");

            exit();
        }
        


        //A 
        $position = $_POST['pres_emp_position'];
        $status = $_POST['pres_status'];
        $dol = $_POST['pres_emp_dol'];
        $organization = $_POST['pres_emp_employer'];
        $doj = $_POST['pres_emp_doj'];
        $duration = $_POST['pres_emp_duration'];

        // mysqli_free_result($result_prev);
        
        $sql = "INSERT INTO present_employment (APP_NO, position, status , 	DateOfLeaving, OrganizationInstitution	, DateOfJoining, DurationYears ) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
            APP_NO = VALUES(APP_NO), 
            position = VALUES(position), 
            status = VALUES(status), 
            DateOfLeaving = VALUES(DateOfLeaving), 
            OrganizationInstitution = VALUES(OrganizationInstitution), 
            DateOfJoining = VALUES(DateOfJoining), 
            DurationYears = VALUES(DurationYears)";

        $stmt1 = $conn->prepare($sql);
        $stmt1->bind_param("issssss", $app_no,  $position , $status , $dol ,  $organization, $doj , $duration) ;
        $stmt1->execute();
        $stmt1->close();
        // mysqli_free_result($result_prev);

        //B
        $positions = $_POST['position'];
        $organizations = $_POST['employer'];
        $dojs = $_POST['doj'];
        $dols = $_POST['dol'];
        $durations = $_POST['exp_duration'];

        // Prepare and bind SQL statement for books
        $sql = "INSERT INTO `employmenthistory` ( Position, Organization, Date_of_Joining, Date_of_Leaving, duration , APP_NO , id) VALUES (?, ?, ?, ?, ?, ? , ?) 
        ON DUPLICATE KEY UPDATE 
        APP_NO = VALUES(APP_NO), 
                Position = VALUES(Position), 
                Organization = VALUES(Organization), 
                Date_of_Joining = VALUES(Date_of_Joining), 
                Date_of_Leaving = VALUES(Date_of_Leaving), 
                duration = VALUES(duration)";
        $id = 1;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssii" , $position , $organization , $doj , $dol , $duration , $app_no , $id );

        for ($i = 0; !is_null($positions) &&  $i < count($positions); $i++) {

            $position = $positions[$i];
            $organization = $organizations[$i];
            $doj = $dojs[$i];
            $dol = $dols[$i];
            $duration = $durations[$i];

            // Execute the statement for books
            if (!$stmt->execute()) {
                // Error occurred while inserting or updating data for books
                // echo "Error: " . $sql . "<br>" . $conn->error;
                break; // Exit loop if an error occurs
            }
            $id++;
        }
        $stmt->close(); // Close the statement after execution


        //C
        $positions = $_POST['te_position'];
        $organizations = $_POST['te_employer'];
        $course_taughts = $_POST['te_course'];
        $ug_pgs = $_POST['te_ug_pg'];
        $noOfStudents = $_POST['te_no_stu'];
        $dojs = $_POST['te_doj'];
        $dols = $_POST['te_dol'];
        $durations = $_POST['te_duration'];

        // Prepare and bind SQL statement for books
        $sql = "INSERT INTO `teachingexperience` ( id , app_no , position, employer , CourseTaught	, 	UG_PG , 	NoOfStudents , DateOfJoining, DateOfLeaving	, Duration) VALUES (?, ?, ?, ?, ?, ? , ? , ?, ? , ?) 
        ON DUPLICATE KEY UPDATE 
        id = VALUES(id),
        app_no = VALUES(app_no), 
                position = VALUES(position), 
                employer = VALUES(employer), 
                CourseTaught = VALUES(CourseTaught),
                UG_PG = VALUES(UG_PG),
                NoOfStudents = VALUES(NoOfStudents),
                DateOfJoining = VALUES(DateOfJoining), 
                DateOfLeaving = VALUES(DateOfLeaving), 
                Duration = VALUES(Duration)";
        $id = 1;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissssssss" , $id , $app_no , $position , $employer , $course_taught , $ug_pg , $noOfStudent , $doj , $dol , $duration );

        for ($i = 0; !is_null($positions) &&  $i < count($positions); $i++) {

            $position = $positions[$i];
            $organization = $organizations[$i];
            $course_taught = $course_taughts[$i];
            $employer = $organizations[$i];
            $ug_pg = $ug_pgs[$i];
            $noOfStudent = $noOfStudents[$i];
            $doj = $dojs[$i];
            $dol = $dols[$i];
            $duration = $durations[$i];

            // Execute the statement for books
            if (!$stmt->execute()) {
                // Error occurred while inserting or updating data for books
                // echo "Error: " . $sql . "<br>" . $conn->error;
                break; // Exit loop if an error occurs
            }
            $id++;
        }
        $stmt->close(); // Close the statement after execution


        //D
        $positions = $_POST['r_exp_position'];
        $institutes = $_POST['r_exp_institute'];
        $supervisors = $_POST['r_exp_supervisor'];
        $dojs = $_POST['r_exp_doj'];
        $dols = $_POST['r_exp_dol'];
        $durations = $_POST['r_exp_duration'];

        // Prepare and bind SQL statement for research experience
        $sql = "INSERT INTO `research_experience` (id, app_no, position, Institute, Supervisor, DateOfJoining, DateOfLeaving, duration) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE 
        id=VALUES(id),
        app_no=VALUES(app_no), 
        position=VALUES(position), 
        institute=VALUES(institute), 
        supervisor=VALUES(supervisor),
        DateOfJoining=VALUES(DateOfJoining), 
        DateOfLeaving=VALUES(DateOfLeaving), 
        Duration=VALUES(Duration)";
        $id = 1; // Assuming $id is set to 1 for demonstration purposes
      
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissssss", $id, $app_no, $position, $institute, $supervisor, $doj, $dol, $duration);

        for ($i = 0; !is_null($positions) &&  $i < count($positions); $i++) {

            $position = $positions[$i];
            $institute = $institutes[$i];
            $supervisor = $supervisors[$i];
            $doj = $dojs[$i];
            $dol = $dols[$i];
            $duration = $durations[$i];

            // Execute the prepared statement
            if(!$stmt->execute()) {
              // echo "Error: " . $sql . "<br>" . $conn->error;
              break; // Exit loop if an error occurs
            }

            $id++;
        }

        //E
        $organizations = $_POST['org'];
        $workp = $_POST['work'];
        $dojs = $_POST['ind_doj'];
        $dols = $_POST['ind_dol'];
        $durations = $_POST['period'];

        // Prepare and bind SQL statement for research experience
        $sql = "INSERT INTO `industrial_experience` (id, APP_NO, organization, WorkProfile, DateOfJoining, DateOfLeaving, Duration) VALUES (?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE 
        id=VALUES(id),
        app_no=VALUES(app_no), 
        organization=VALUES(organization), 
        WorkProfile=VALUES(WorkProfile), 
        DateOfJoining=VALUES(DateOfJoining), 
        DateOfLeaving=VALUES(DateOfLeaving), 
        Duration=VALUES(Duration)";
        $id = 1; // Assuming $id is set to 1 for demonstration purposes
      
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisssss", $id, $app_no, $organization, $work, $doj, $dol, $duration);

        for ($i = 0; !is_null($organizations) &&  $i < count($organizations); $i++) {

            $organization = $organizations[$i];
            $work = $workp[$i];
          
            $doj = $dojs[$i];
            $dol = $dols[$i];
            $duration = $durations[$i];

            // Execute the prepared statement
            if(!$stmt->execute()) {
              // echo "Error: " . $sql . "<br>" . $conn->error;
              break; // Exit loop if an error occurs
            }

            $id++;
        }



        //area

        $area_of_specialization = $_POST['area_spl'];
        $current_area_of_research = $_POST['area_rese'];


        // echo $area_of_research;


        $sql = "INSERT INTO `specialization` (APP_NO , area_of_specialization , current_area_of_research) VALUES ( ?, ?, ? ) 
        ON DUPLICATE KEY UPDATE
        APP_NO = VALUES(APP_NO),
        area_of_specialization = VALUES(area_of_specialization),
        current_area_of_research = VALUES(current_area_of_research)";
      
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $app_no, $area_of_specialization, $current_area_of_research );

        if(!$stmt->execute()) {
          // echo "Error: " . $sql . "<br>" . $conn->error;  
          // break; // Exit loop if an error occurs
        }
        
         header("location: page5_summ.php");
    }

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
    $(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });
    });
</script>

<script type="text/javascript">
var tr="";
var counter_exp=1;
var counter_t_exp=1;
var counter_r_exp=1;
var counter_ind_exp=1;


  $(document).ready(function(){
    
    $("#add_more_exp").click(function(){
        create_tr();
        create_serial('exp');
        create_input('position[]', 'Position','position'+counter_exp, 'exp',counter_exp, 'exp');
        create_input('employer[]', 'Organization/Institution', 'employer'+counter_exp,'exp',counter_exp, 'exp');
        create_input('doj[]', 'DD/MM/YYYY', 'doj'+counter_exp,'exp',counter_exp, 'exp');
        create_input('dol[]', 'DD/MM/YYYY', 'dol'+counter_exp,'exp',counter_exp, 'exp');
        create_input('exp_duration[]', 'Duration','exp_duration'+counter_exp, 'exp',counter_exp,'exp', true);
        counter_exp++;
        return false;
    });

    $("#add_more_t_exp").click(function(){
        create_tr();
        create_serial('t_exp');
        create_input('te_position[]', 'Position','te_position'+counter_t_exp, 't_exp',counter_t_exp, 't_exp');
        create_input('te_employer[]', 'Employer', 'te_employer'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_course[]', 'Courses', 'te_course'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_ug_pg[]', 'UG/PG', 'te_ug_pg'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_no_stu[]', 'No. of Students', 'te_no_stu'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_doj[]', 'DD/MM/YYYY', 'te_doj'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_dol[]', 'DD/MM/YYYY', 'te_dol'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_duration[]', 'Duration', 'te_duration'+counter_t_exp,'t_exp',counter_t_exp, 't_exp', true);
        counter_t_exp++;
        return false;
    });

    
    $("#add_more_r_exp").click(function(){
        create_tr();
        create_serial('r_exp');
        create_input('r_exp_position[]', 'Position','r_exp_position'+counter_r_exp, 'r_exp',counter_r_exp, 'r_exp');
        create_input('r_exp_institute[]', 'Institute', 'r_exp_institute'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp');
        create_input('r_exp_supervisor[]', 'Supervisor', 'r_exp_supervisor'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp');
        create_input('r_exp_doj[]', 'DD/MM/YYYY', 'r_exp_doj'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp');
        create_input('r_exp_dol[]', 'DD/MM/YYYY', 'r_exp_dol'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp');
        create_input('r_exp_duration[]', 'Duration', 'r_exp_duration'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp', true);
        counter_r_exp++;
        return false;
    });



$("#add_more_ind_exp").click(function(){
    create_tr();
    create_serial('ind_exp');
    create_input('org[]', 'Organization','org'+counter_ind_exp, 'ind_exp',counter_ind_exp, 'ind_exp');
    create_input('work[]', 'Work Profile', 'work'+counter_ind_exp,'ind_exp',counter_ind_exp, 'ind_exp');
    create_input('ind_doj[]', 'DD/MM/YYYY', 'ind_doj'+counter_ind_exp,'ind_exp',counter_ind_exp, 'ind_exp');
    create_input('ind_dol[]', 'DD/MM/YYYY', 'ind_dol'+counter_ind_exp,'ind_exp',counter_ind_exp, 'ind_exp');
    create_input('period[]', 'Duration', 'period'+counter_ind_exp,'ind_exp',counter_ind_exp, 'ind_exp',true);
    counter_ind_exp++;
    return false;
  });

  

});

  function create_select()
  {
    
  }
  function create_tr()
  {
    tr=document.createElement("tr");
  }
  function create_serial(tbody_id)
  {
    //console.log(tbody_id);
    var td=document.createElement("td");
    // var x=0;
     var x = document.getElementById(tbody_id).rows.length;
    // if(document.getElementById(tbody_id).rows)
    // {
    // }
    td.innerHTML=x;
    tr.appendChild(td);
  }
   function for_date_picker(obj)
  {
    obj.setAttribute("data-provide", "datepicker");
    obj.className += " datepicker";
    return obj;

  }
  
  function create_input(t_name, place_value, id, tbody_id, counter, remove_name, btn=false, select=false, datepicker_set=false)
  {
    //console.log(counter);
    if(select==false)
    {

      var input=document.createElement("input");
      input.setAttribute("type", "text");
      input.setAttribute("name", t_name);
      input.setAttribute("id", id);
      input.setAttribute("placeholder", place_value);
      input.setAttribute("class", "form-control input-md");
      input.setAttribute("required", "");
      var td=document.createElement("td");
      td.appendChild(input);
    }
    if(select==true)
    {

      var sel=document.createElement("select");
      sel.setAttribute("name", t_name);
      sel.setAttribute("id", id);
      sel.setAttribute("class", "form-control input-md");
      sel.innerHTML+="<option>Select</option>";
      sel.innerHTML+="<option value='Principal Investigator'>Principal Investigator</option>";
      sel.innerHTML+="<option value='Co-investigator'>Co-investigator</option>";
      // sel.innerHTML+="<option value='in_preparation'>In-Preparation</option>";
      var td=document.createElement("td");
      td.appendChild(sel);
    }
    if(datepicker_set==true)
    {
      input=for_date_picker(input);
    }
    if(btn==true)
    {
      // alert();
      var but=document.createElement("button");
      but.setAttribute("class", "close");
      but.setAttribute("type" , "button");
      but.setAttribute("onclick", "remove_row('"+remove_name+"','"+counter+"', '"+tbody_id+"')");
      but.innerHTML="x";
      td.appendChild(but);
    }
    tr.setAttribute("id", "row"+counter);
    tr.appendChild(td);
    document.getElementById(tbody_id).appendChild(tr);
     $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
    
  }
  function remove_row(remove_name, n, tbody_id )
  {
    var tab=document.getElementById(remove_name);
    var tr=document.getElementById("row"+n);
    tab.removeChild(tr);
    var x = document.getElementById(tbody_id).rows.length;
    for(var i=0; i<=x; i++)
    {
      $("#"+tbody_id).find("tr:eq("+i+") td:first").text(i);
      
    }
    
  }
</script>
<!-- all bootstrap buttons classes -->
<!-- 
  class="btn btn-sm, btn-lg, "
  color - btn-success, btn-primary, btn-default, btn-danger, btn-info, btn-warning
-->

<h4 style="text-align:center; font-weight: bold; color: #6739bb;">3. Employment Details</h4>

<div class="row">
    <div class="col-md-12">
      <div class="panel panel-success">
      <div class="panel-heading">(A) Present Employment</div>
        <div class="panel-body">

          
          <span class="col-md-2 control-label" for="pres_emp_position">Position</span>  
          <div class="col-md-4">
          <input id="pres_emp_position" value = "<?php echo $emp_prev_position; ?>" name="pres_emp_position" type="text" placeholder="Position" class="form-control input-md" autofocus="" required="">
          </div>

          <span class="col-md-2 control-label" for="pres_emp_employer">Organization/Institution</span>  
          <div class="col-md-4">
          <input id="pres_emp_employer" value = "<?php echo $emp_prev_org; ?>"  name="pres_emp_employer" type="text" placeholder="Organization/Institution" class="form-control input-md" autofocus="">
          </div> 
          
          <span class="col-md-2 control-label" for="pres_status">Status</span>  
          <div class="col-md-4">
          <select id="pres_status" value = "<?php echo $emp_prev_status; ?>"  name="pres_status" class="form-control input-md" required="">
              <option value="">Select</option>
              <option   value="Central Govt.">Central Govt.</option>
              <option   value="State Government">State Government</option>
              <option   value="Private">Private</option>
              <option   value="Quasi Govt.">Quasi Govt.</option>
              <option   value="Other">Other</option>
          </select>
          </div>

          <span class="col-md-2 control-label" for="pres_emp_doj">Date of Joining</span>  
          <div class="col-md-4">
          <input id="pres_emp_doj" value = "<?php echo $emp_prev_doj; ?>"  name="pres_emp_doj" type="text" placeholder="Date of Joining"  class="form-control input-md" required="">
          </div>

          <span class="col-md-2 control-label" for="pres_emp_dol">Date of Leaving <br />(Mention Continue if working)</span>  
          <div class="col-md-4">
          <input id="pres_emp_dol" value = "<?php echo $emp_prev_dol; ?>"  name="pres_emp_dol" type="text" placeholder="Date of Leaving" class="form-control input-md" required="">
          </div>
          
          <span class="col-md-2 control-label" for="pres_emp_duration">Duration (in years & months)</span>  
          <div class="col-md-4">
          <input id="pres_emp_duration"  value = "<?php echo $emp_prev_duration; ?>"  name="pres_emp_duration" type="text" placeholder="Duration"  class="form-control input-md" required="">
          </div>


         

  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
      <div class="panel-heading">(B) Employment History (After PhD, Starting with Latest)  </strong></font>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-sm btn-danger" id="add_more_exp">Add Details</button></div>
      <div class="panel-body">
        
           <table class="table table-bordered">
              <tbody id="exp">
              
                <tr height="30px">
                <th class="col-md-1"> S. No.</th>
                <th class="col-md-3"> Position </th>
                <th class="col-md-4"> Organization/Institution </th>
                <th class="col-md-1"> Date of Joining</th>
                <th class="col-md-1"> Date of Leaving </th>
                <th class="col-md-2"> Duration (in years & months)</th>
              </tr>

      

            <?php 

                for($i = 0; $i < count($prev_position); $i++ ) {

                  ?>
              
                <tr height="60px" id = 'row<?php echo $i + 1;?>' >

                    <td class="col-md-1"> 
                      <?php echo $i + 1; ?>          </td>
                  <td class="col-md-2">  
                      <input id="position1" value="<?php echo $prev_position[$i]; ?>" name="position[]" type="text" placeholder="Position" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                      <input id="employer" value="<?php echo $prev_org[$i]; ?>" name="employer[]" type="text" placeholder="Employer" class="form-control input-md" required=""> 
                    </td>
                  <td class="col-md-2"> 
                    <input id="doj" name="doj[]" value="<?php echo $prev_doj[$i]; ?>" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="dol" name="dol[]" value="<?php echo $prev_dol[$i]; ?>" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input  name="exp_duration[]" value="<?php echo $prev_duration[$i]; ?>" type="text" placeholder="Duration" class="form-control input-md" required=""> 
                    <button type = "button" class="close" onclick="remove_row('exp','<?php echo $i + 1; ?>', 'exp')">x</button>
                  </td>
                 
                </tr>

                <?php
                }
                ?>

                
             
                               </tbody>
              </table>

                            <h4 style="color:red;">
              <div>

                <textarea style="height:50px; font-weight: bold; color: red;" class="form-control input-md" name="teach_exp_declaration" readonly="" required="">Experience : Minimum 10 years’ experience of which at least 4 years should be at the level of Associate Professor in IITs, IISc Bangalore, IIMs, NITIE Mumbai and IISERs.</textarea>
                <input type="radio" name="teach_exp" checked='checked' value="Yes" required="">Yes</input>
                
                <input type="radio" name="teach_exp"  value="No" required="">No</input>
              </div>
              </h4>
              
              
                        </div>
        </div>
      </div>
    </div>

<!-- Teaching Experience  -->
          
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
    <div class="panel-heading">(C) Teaching Experience (After PhD)&nbsp;&nbsp;&nbsp;<button type = "button" class="btn btn-sm btn-danger" id="add_more_t_exp">Add Details</button></div>
      <div class="panel-body">
        <table class="table table-bordered">
            <tbody id="t_exp">
            
            <tr height="30px">
              <th class="col-md-1"> S. No.</th>
              <th class="col-md-2"> Position</th>
              <th class="col-md-1"> Employer </th>
              <th class="col-md-1"> Course Taught </th>
              <th class="col-md-1"> UG/PG </th>
              <th class="col-md-1"> No. of Students </th>
              <th class="col-md-1"> Date of Joining the Institute</th>
              <th class="col-md-1"> Date of Leaving the Institute</th>
              <th class="col-md-1"> Duration (in years & months) </th>
              
            </tr>


          <?php 
            for($i = 0; $i < count($te_prev_position) ; $i++ ) {   

              ?>
            <tr height="60px" id = 'row<?php echo $i + 1;?>' >
             
              <td class="col-md-1"> 
                <?php echo $i + 1 ; ?>           </td>
              <td class="col-md-2"> 
                  <input id="te_position1" name="te_position[]" type="text" value="<?php echo $te_prev_position[$i]; ?>"  placeholder="Position" class="form-control input-md" required=""> 
                </td>
              <td class="col-md-2"> 
                <input id="te_employer1" name="te_employer[]" type="text" value="<?php echo $te_prev_employer[$i]; ?>"  placeholder="Employer" class="form-control input-md" required=""> 
              </td>

              <td class="col-md-2"> 
                <input id="te_course1" name="te_course[]" type="text" value="<?php echo $te_prev_course[$i]; ?>" placeholder="Course Taught" class="form-control input-md" required=""> 
              </td>
             
             <td class="col-md-2"> 
               <input id="te_ug_pg1" name="te_ug_pg[]" type="text"value="<?php echo $te_prev_ug_pg[$i]; ?>"  placeholder="UG/PG" class="form-control input-md" required=""> 
             </td>

             <td class="col-md-2"> 
               <input id="te_no_stu1" name="te_no_stu[]" type="text" value="<?php echo $te_prev_nos[$i]; ?>" placeholder="No. of Students" class="form-control input-md" required=""> 
             </td>

              <td class="col-md-1"> 
                <input id="te_doj1" name="te_doj[]" type="text" value="<?php echo $te_prev_doj[$i]; ?>" placeholder="Joining" class="form-control input-md" required=""> 
              </td>
              <td class="col-md-1"> 
                <input id="te_dol1" name="te_dol[]" type="text" value="<?php echo $te_prev_dol[$i]; ?>" placeholder="Leaving" class="form-control input-md" required=""> 
              </td>
              <td class="col-md-1"> 
                <input id="te_duration1" name="te_duration[]" type="text" value="<?php echo $te_prev_duration[$i]; ?>"placeholder="Duration" class="form-control input-md" required=""> 
              
                <button class="close" type="button" onclick="remove_row('t_exp','<?php echo $i + 1;?>', 't_exp')">x</button>
              </td>
             
            </tr>
                        
           <?php } ?>
                        
            
            
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>

  <!-- c) Research Experience: (including Postdoctoral) input-->
                 
<div class="row">
<div class="col-md-12">
  <div class="panel panel-success">
  <div class="panel-heading">(D) Research Experience (Post PhD, including Post Doctoral)&nbsp;&nbsp;&nbsp;<button type = "button" class="btn btn-sm btn-danger" id="add_more_r_exp">Add Details</button></div>
    <div class="panel-body">
      <table class="table table-bordered">
          <tbody id="r_exp">
          
          <tr height="30px">
            <th class="col-md-1"> S. No.</th>
            <th class="col-md-1"> Position </th>
            <th class="col-md-2"> Institute</th>
            <th class="col-md-2"> Supervisor</th>
            <!-- <th class="col-md-2"> Topic </th> -->
            <th class="col-md-1"> Date of Joining</th>
            <th class="col-md-1"> Date of Leaving</th>
            <th class="col-md-1"> Duration (in years & months) </th>
            
          </tr>


                    
          <?php 

              for($i = 0; $i < count($re_prev_position); $i++ ) {
                ?>
              <tr height="60px">
                
              <td class="col-md-1"> 
                <?php echo $i + 1; ?>         </td>
              <td class="col-md-2"> 
                  <input id="r_exp_position1" name="r_exp_position[]" type="text" value="<?php echo $re_prev_position[$i]; ?>"  placeholder="Position" class="form-control input-md" required=""> 
                </td>
              <td class="col-md-2"> 
                <input id="r_exp_institute1" name="r_exp_institute[]" type="text" value="<?php echo $re_prev_institute[$i]; ?>"  placeholder="Institute" class="form-control input-md" required=""> 
              </td>
              <td class="col-md-2"> 
                <input id="r_exp_supervisor1" name="r_exp_supervisor[]" type="text" value="<?php echo $re_prev_supervisor[$i]; ?>"  placeholder="Supervisor" class="form-control input-md" required=""> 
              </td>

              <td class="col-md-1"> 
                <input id="r_exp_doj1" name="r_exp_doj[]" type="text" value="<?php echo $re_prev_doj[$i]; ?>"  placeholder="Joining" class="form-control input-md" required=""> 
              </td>
              <td class="col-md-1"> 
                <input id="r_exp_dol1" name="r_exp_dol[]" type="text" value="<?php echo $re_prev_dol[$i]; ?>" placeholder="Leaving" class="form-control input-md" required=""> 
              </td>
              <td class="col-md-1"> 
                <input id="r_exp_duration1" name="r_exp_duration[]" type="text" value="<?php echo $re_prev_duration[$i]; ?>" placeholder="Duration" class="form-control input-md" required=""> 
              </td>

              </tr>

              <?php } ?>
                                  
          
          
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>


<!-- g)  Industrial Experience Interaction -->
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-success">
      <div class="panel-heading">(E) Industrial Experience &nbsp;&nbsp;&nbsp;<button type = "button" class="btn btn-sm btn-danger" id="add_more_ind_exp">Add Details</button></div>
        <div class="panel-body">

            <table class="table table-bordered">
                <tbody id="ind_exp">
                
                <tr height="30px">
                  <th class="col-md-1"> S. No.</th>
                  <th class="col-md-2"> Organization </th>
                  <th class="col-md-3"> Work Profile</th>
                  <th class="col-md-2"> Date of Joining</th>
                  <th class="col-md-2"> Date of Leaving</th>
                  <th class="col-md-2"> Duration (in years & months)</th>
                </tr>





                <?php 
                    for($i = 0 ; $i < count($ie_prev_org); $i++ ) {
                      ?>
                        
                    <tr height="60px">
                              
                    <td class="col-md-1"> 
                      <?php echo $i + 1 ; ?>                 </td>
                    <td class="col-md-2"> 
                        <input id="org1" name="org[]" type="text" value="<?php echo $ie_prev_org[$i]; ?>"  placeholder="Organization" class="form-control input-md" required=""> 
                      </td>
                    <td class="col-md-2"> 
                      <input id="work1" name="work[]" type="text" value="<?php echo $ie_prev_work[$i]; ?>"   placeholder="Nature of Work" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-1"> 
                      <input id="ind_doj1" name="ind_doj[]" type="text" value="<?php echo $ie_prev_doj[$i]; ?>"  placeholder="Joining" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-1"> 
                      <input id="ind_dol1" name="ind_dol[]" type="text" value="<?php echo $ie_prev_dol[$i]; ?>"  placeholder="Leaving" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-2"> 
                      <input id="period1" name="period[]" type="text" value="<?php echo $ie_prev_duration[$i]; ?>"  placeholder="Period" class="form-control input-md" required=""> 
                    </td>
                  
                  </tr>

                    <?php } ?>
  
  
                
                                
               
                              </tbody>
            </table>
          </div>
      </div>
    </div>
</div>


<h4 style="text-align:center; font-weight: bold; color: #6739bb;">4. Area(s) of Specialization and Current Area(s) of Research</h4>

<div class="row">
      <div class="col-md-6">
        <div class="panel panel-success">
          <!-- <div class="panel-heading">9. Area(s) of Specialization *</div> -->
          <div class="panel-body">
            <strong>Areas of specialization</strong>
            <textarea style="height:150px" value = "<?php echo $prev_area_of_specialization; ?>" placeholder="Areas of specialization" class="form-control input-md" name="area_spl" maxlength="500" required=""></textarea>
          </div>
        </div>
      </div>
    
      <div class="col-md-6">
        <div class="panel panel-success">
          <!-- <div class="panel-heading">10. Current Area(s) of Research *</div> -->
          <div class="panel-body">
            <strong>Current Area of research</strong>
            <textarea style="height:150px" value = "<?php echo $prev_area_of_research; ?>" placeholder="Current Area of research" class="form-control input-md" name="area_rese" maxlength="500" required=""></textarea>
          </div>
        </div>
      </div>
     </div>
    
<div class="form-group">
  
  <div class="col-md-1">
    <a href="edu.php" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
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
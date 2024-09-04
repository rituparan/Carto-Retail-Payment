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
   
    $conn = mysqli_connect($server, $username, $password , $database );

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    // $sql = "SELECT * FROM `registration` WHERE `APP_NO` = ?";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("i", $app_no);
    // $stmt->execute();
    // $result = $stmt->get_result();

    // if ($result->num_rows == 1) {
    //     $row = $result->fetch_assoc();
    //     $firstname = $row['FIRSTNAME'];
    //     $lastname = $row['LASTNAME'];
    //     $email = $row['EMAIL'];
    //     // $date_of_app = $row['APP_DATE'];
    //     $category = $row['CATEGORY'];
    // } else {
    //     echo "User not found.";
    //     exit();
    // }
      

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // // Logout process
        // if (isset($_POST['logout'])) {
        //     // Clear all session variables
        //     session_unset();
        //     // Destroy the session
        //     session_destroy();
        //     // Redirect to login page
        //     header("Location: login.php");

        //     exit();
        // }
        
        //5 best paper
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["userfile7"]["name"]);
        $uploadOk = 1;
        $pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $best_paper = "";
        // Check file size
        if ($_FILES["userfile7"]["size"] > 6000000) {
            // echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($pdfFileType != "pdf") {
            // echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["userfile7"]["tmp_name"], $targetFile)) {
                
                $filePath = $targetFile;
                $best_paper = $targetFile;

              
            } else {
                
                // echo "Sorry, there was an error uploading your file.";
            }
        }



        
        // $tmp_file_path = "http://localhost/CS260_Project/" . $targetFile ;
        // echo $tmp_file_path;

        //phd
        $targetFile = $targetDir . basename($_FILES["userfile"]["name"]);
       
        $pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $phd = "";

        // Check file size
        if ($_FILES["userfile"]["size"] > 5000000) {
            echo "Sorry1, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($pdfFileType != "pdf") {
            // echo "Sorry1, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry1, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $targetFile)) {
                
                $phd = $targetFile;
            } else {
                // echo "Sorry1, there was an error uploading your file.";
            }
        }



        //pg
        $targetFile = $targetDir . basename($_FILES["userfile1"]["name"]);
        $pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $pg = "";

        // Check file size
        if ($_FILES["userfile1"]["size"] > 5000000) {
            // echo "Sorry2, /your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($pdfFileType != "pdf") {
            // echo "Sorry2, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry2, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["userfile1"]["tmp_name"], $targetFile)) {
                
                $pg = $targetFile;
            } else {
                // echo "Sorry2, there was an error uploading your file.";
            }
        }


        //ug
        $targetFile = $targetDir . basename($_FILES["userfile2"]["name"]);
        $pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $ug = "";

        // Check file size
        if ($_FILES["userfile2"]["size"] > 5000000) {
            // echo "Sorry3, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($pdfFileType != "pdf") {
            // echo "Sorry3, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry3, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["userfile2"]["tmp_name"], $targetFile)) {
      
                $ug = $targetFile;
            } else {
                // echo "Sorry3, there was an error uploading your file.";
            }
        }


        //12th
        $targetFile = $targetDir . basename($_FILES["userfile3"]["name"]);
        $pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $twelve = "";

        // Check file size
        if ($_FILES["userfile3"]["size"] > 5000000) {
            // echo "Sorry4, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($pdfFileType != "pdf") {
            // echo "Sorry4, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry4, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["userfile3"]["tmp_name"], $targetFile)) {
            
                $twelve = $targetFile;
            } else {
                // echo "Sorry4, there was an error uploading your file.";
            }
        }



        //10th
        $targetFile = $targetDir . basename($_FILES["userfile4"]["name"]);
        $pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $tenth = "";

        // Check file size
        if ($_FILES["userfile4"]["size"] > 5000000) {
            // echo "Sorry5, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($pdfFileType != "pdf") {
            // echo "Sorry5, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry5, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["userfile4"]["tmp_name"], $targetFile)) {
              
                $tenth = $targetFile;
            } else {
                // echo "Sorry5, there was an error uploading your file.";
            }
        }



        //pay slip 
        $targetFile = $targetDir . basename($_FILES["userfile9"]["name"]);
        $pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $pay_slip = "";

        // Check file size
        if ($_FILES["userfile9"]["size"] > 5000000) {
            // echo "Sorry6, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($pdfFileType != "pdf") {
            // echo "Sorry6, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry6, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["userfile9"]["tmp_name"], $targetFile)) {
               
                $pay_slip = $targetFile;
            } else {
                // echo "Sorry6, there was an error uploading your file.";
            }
        }


          //noc
        $targetFile = $targetDir . basename($_FILES["userfile10"]["name"]);
        $pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $noc = "";

        // Check file size
        if ($_FILES["userfile10"]["size"] > 5000000) {
            // echo "Sorry7, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($pdfFileType != "pdf") {
            // echo "Sorry7, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry7, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["userfile10"]["tmp_name"], $targetFile)) {
                
                $noc = $targetFile;
            } else {
                // echo "Sorry7, there was an error uploading your file.";
            }
        }


        //experience
        $targetFile = $targetDir . basename($_FILES["userfile8"]["name"]);
        $pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $experience = "";

        // Check file size
        if ($_FILES["userfile8"]["size"] > 5000000) {
            // echo "Sorry8, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($pdfFileType != "pdf") {
            // echo "Sorry8, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry8, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["userfile8"]["tmp_name"], $targetFile)) {
             
                $experience = $targetFile;
            } else {
                // echo "Sorry8, there was an error uploading your file.";
            }
        }


        
        //misc
        $targetFile = $targetDir . basename($_FILES["userfile6"]["name"]);
        $pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $misc = "";

        // Check file size
        if ($_FILES["userfile6"]["size"] > 1000000) {
            // echo "Sorry9, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($pdfFileType != "pdf") {
            // echo "Sorry9, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry9, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["userfile6"]["tmp_name"], $targetFile)) {
               
                $misc = $targetFile;
            } else {
                // echo "Sorry9, there was an error uploading your file.";
            }
        }



        // //signature
        $targetFile = $targetDir . basename($_FILES["userfile5"]["name"]);
        $pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $sign = "";

        // Check file size
        if ($_FILES["userfile5"]["size"] > 5000000) {
            // echo "Sorry10, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($pdfFileType != "jpg") {
            // echo "Sorry10, only jpg files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["userfile5"]["tmp_name"], $targetFile)) {
                
                $sign = $targetFile;
            } else {
                // echo "Sorry, there was an error uploading your file.";
            }
        }

        // echo $uploadOk;

        if( $uploadOk == 1 ) {
          $sql = "INSERT INTO `documents` (APP_NO , five_best_papers , phd , pg , ug , 12th_hsc , 10th_ssc , pay_slip , noc , experience , other_doc , signature ) VALUES ( ?, ?, ? , ? , ? , ? , ? , ? , ? , ? , ? , ? ) 
          ON DUPLICATE KEY UPDATE
          APP_NO = VALUES(APP_NO),
          five_best_papers = VALUES(five_best_papers),
          phd = VALUES(phd),
          pg = VALUES(pg),
          ug = VALUES(ug),
          12th_hsc = VALUES(12th_hsc),
          10th_ssc = VALUES(10th_ssc),
          pay_slip = VALUES(pay_slip),
          noc = VALUES(noc),
          experience = VALUES(experience),
          other_doc = VALUES(other_doc),
          signature = VALUES(signature)
          ";
        
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("isssssssssss", $app_no, $best_paper, $phd , $pg , $ug , $twelve , $tenth , $pay_slip , $noc , $experience , $misc , $sign );
          $stmt->execute();

        }


         $names = $_POST['ref_name'];
         $positions = $_POST['positions'];
         $associates = $_POST['association_referee'];
         $organizations = $_POST['org'];
         $emails = $_POST['email'];
         $contacts = $_POST['phone'];
 
         // Prepare and bind SQL statement for research experience
         $sql = "INSERT INTO `refrees` ( APP_NO, name , position, associate_with_reference, institute , email , contact) VALUES (?, ?, ?, ?, ?, ?, ?)
         ON DUPLICATE KEY UPDATE 

         app_no=VALUES(app_no), 
         name = VALUES(name),
         position=VALUES(position), 
         associate_with_reference=VALUES(associate_with_reference), 
         institute=VALUES(institute), 
         email=VALUES(email), 
         contact=VALUES(contact)";
       
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("issssss", $app_no, $name , $position, $associate_with_reference, $institute, $email, $contact);
        $id = 0;
         for ($i = 0; $i < 3 ; $i++) {

             $name = $names[$i];
             $institute = $organizations[$i];
             $position = $positions[$i];
             $associate_with_reference = $associates[$i];
             $email = $emails[$i];  
             $contact = $contacts[$i];
 
             // Execute the prepared statement
             if(!$stmt->execute()) {
              $uploadOk = 0;
              //  echo "Error: " . $sql . "<br>" . $conn->error;
               break; // Exit loop if an error occurs
             }
 
             $id++;
         }

         if( $uploadOk == 1 ) {
          // header("Location: last_page.php");
          header("Location: test1.php");
         }

    }


}
else {
  header("Location: login.php");
  exit();
}
?>

<html>
<head>
	<title>Referees & Upload</title>
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
<div class="container-fluid" style="background-color: #f7ffff; margin-bottom: 10px;">
	<div class="container">
        <div class="row" style="margin-bottom:10px; ">
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
		    <!-- <h3 style="text-align:center; color: #414002; font-weight: bold;  font-family: 'Fjalla One', sans-serif!important; font-size: 2em;">Application for Academic Appointment</h3> -->
    </div>
   </div> 
			<h3 style="color: #e10425; margin-bottom: 20px; font-weight: bold; text-align: center;font-family: 'Noto Serif', serif;" class="blink_me">Application for Faculty Position</h3>

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
  /*padding: 10 !important;*/
  text-align: left!important;
  margin-top: -5px;
  font-family: 'Noto Serif', serif;
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

.panel-info .panel-heading{
  font-size: 1.1em;
  font-family: 'Oswald', sans-serif!important;
  padding-top: 5px;
  padding-bottom: 5px;
}

.panel-danger .panel-heading{
  font-size: 1.1em;
  font-family: 'Oswald', sans-serif!important;
  padding-top: 5px;
  padding-bottom: 5px;
}

.btn-primary {
  padding: 9px;
}

.Acae_data
{
  font-size: 1.1em;
  font-weight: bold;
  color: #414002;
}


.upload_crerti
{
  font-size: 1.1em;
  font-weight: bold;
  color: red;
  text-align: center;
}

.update_crerti
{
  font-size: 1.1em;
  font-weight: bold;
  color: green;
  text-align: center;
}
p
{
  padding-top: 10px;
}
</style>

<!-- all bootstrap buttons classes -->
<!-- 
  class="btn btn-sm, btn-lg, "
  color - btn-success, btn-primary, btn-default, btn-danger, btn-info, btn-warning
-->



<a href='https://ofa.iiti.ac.in/facrec_che_2023_july_02/layout'></a>

<div class="container">
  
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 well">
            
              
            <fieldset>
             
                 <legend>
                  <div class="row">
                    <div class="col-md-10">
                        <h4>Welcome : <font color="#025198"><strong><?php echo  $firstname." ".$lastname; ?></strong></font></h4>
                    </div>
                    <div class="col-md-2">
                      <a href="login.php" class="btn btn-sm btn-success  pull-right">Logout</a>
                    </div>
                  </div>
                
                
        </legend>
       </fieldset>



<!-- publication file upload           -->

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">


   <!-- Reprints of 5 Best Research Papers  -->

  <h4 style="text-align:center; font-weight: bold; color: #6739bb;">20. Reprints of 5 Best Research Papers *</h4>
   <div class="row">

        <div class="col-md-12">
          <div class="panel panel-info">
            <div class="panel-heading">Upload 5 Best Research Papers in a single PDF < 6MB 
              
             <a href="<?php echo $filePath ?>" class="btn-sm btn-info " target="_blank">View Uploaded File </a>
              <br />
              <br />
             
            </div>
            
            <div class="panel-body">

                <div class="col-md-5">
                  <label for="full_5_paper" class="file-input-label">
                      <!-- <?php echo "Your Text Here"; ?> -->
                  </label>

                  <p class="update_crerti">Update 5 best papers</p>
                </div>

                <div class="col-md-7">
                  <input id="full_5_paper" name="userfile7" type="file" class="form-control input-md fileInputClass">
                </div>

            </div>
            
          </div>
        </div>

                
  </div>


  <!-- certificate file code start -->
<h4 style="text-align:center; font-weight: bold; color: #6739bb;">21. Check List of the documents attached with the online application *</h4>

<div class="row">
  <div class="col-md-12">
  <div class="panel panel-success">
  <div class="panel-heading">Check List of the documents attached with the online application (Documents should be uploaded in PDF format only):
    <br />
    <small style="color: red;">Uploaded PDF files will not be displayed as part of the printed form.</small>
  </div>
    <div class="panel-body">
      <div class="row">
  
        <!-- <form action="https://ofa.iiti.ac.in/facrec_che_2023_july_02/submission_complete/upload" method="post" enctype="multipart/form-data"> -->
        <input type="hidden" name="ci_csrf_token" value="" />
     
     <!-- phd certificate  -->
      <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">PHD Certificate <a href="<?php echo $phd ?>" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
        <div class="panel-body">
          <p class="update_crerti">Update PHD Certificate</p>
           <input id="phd" name="userfile" type="file" class="form-control input-md fileInputClass">
      </div>
    </div>
  </div>

        
         

     <!-- Master certificate  -->


                  <div class="col-md-4">
        <div class="panel panel-info">
          <div class="panel-heading">PG Documents <a href="<?php echo $pg ?>" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
            <div class="panel-body">
              <p class="update_crerti">Update All semester/year-Marksheets and degree certificate</p>
               <input id="post_gr" name="userfile1" type="file" class="form-control input-md fileInputClass">
          </div>
        </div>
      </div>

            
              

 
 <!-- Bachelor certificate  -->


      <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">UG Documents <a href="<?php echo $ug ?>" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
        <div class="panel-body">
          <p class="update_crerti">Update All semester/year-Marksheets and degree certificate  </p>
           <input id="under_gr" name="userfile2" type="file" class="form-control input-md fileInputClass">
      </div>
    </div>
  </div>

             


      <!-- 12th certificate  -->


                     <div class="col-md-4">
         <div class="panel panel-info">
           <div class="panel-heading">12th/HSC/Diploma Documents <a href="<?php echo $twelve ?>" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
             <div class="panel-body">
               <p class="update_crerti">Update 12th/HSC/Diploma/Marksheet(s) and passing certificate</p>
                <input id="higher_sec" name="userfile3" type="file" class="form-control input-md fileInputClass">
           </div>
         </div>
       </div>

                  



   <!-- 10th certificate  -->


            <div class="col-md-4">
      <div class="panel panel-info">
        <div class="panel-heading">10th/SSC Documents <a href="<?php echo $tenth ?>" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
          <div class="panel-body">
            <p class="update_crerti">Update 12th/HSC/Diploma/Marksheet(s) and passing certificate</p>
             <input id="high_school" name="userfile4" type="file" class="form-control input-md fileInputClass">
        </div>
      </div>
    </div>

            


    <!-- Pay Slip -->

            <div class="col-md-4">
      <div class="panel panel-info">
        <div class="panel-heading">Pay Slip <a href="<?php echo $pay_slip ?>" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
          <div class="panel-body">
            <p class="update_crerti">Update Pay Slip</p>
             <input id="pay_slip" name="userfile9" type="file" class="form-control input-md fileInputClass">
        </div>
      </div>
    </div>

            

<!-- Under Taking NOC -->

<!-- Pay Slip -->

<div class="col-md-6">
  <div class="panel panel-info">
    <div class="panel-heading">NOC or Undertaking <a href="<?php echo $noc ?>" class="btn-sm btn-info " target="_blank">View Uploaded File </a></div>
      <div class="panel-body">
        <p class="update_crerti">Undertaking-in case, NOC is not available at the time of application but will be provided at the time of interview</p>
         <input id="noc_under" name="userfile10" type="file" class="form-control input-md fileInputClass">
    </div>
  </div>
</div>

       
        <!-- 10 years post phd exp certificate  -->

                           <div class="col-md-5">
           <div class="panel panel-info">
             <div class="panel-heading">Post phd Experience Certificate/All Experience Certificates/ Last Pay slip/ 
              <a href="<?php echo $experience ?>" class="btn-sm btn-info " target="_blank">View Uploaded File </a>
              <br />

             </div>
               <div class="panel-body">
                 <p class="update_crerti">Update Certificate</p>
                  <input id="post_phd_10" name="userfile8" type="file" class="form-control input-md fileInputClass">
             </div>
           </div>
         </div>

                 


       

     <!-- Misc certificate  -->


            
          <div class="col-md-12">
            <div class="panel panel-info">
          <div class="panel-heading">Upload any other relevant document in a single PDF (For example award certificate, experience certificate etc) . If there are multiple documents, combine all the documents in a single PDF) <1MB. </div>
              <div class="panel-body">
                <div class="col-md-5">
                  <p class="upload_crerti">Upload any other document</p>
                </div>
                <div class="col-md-7">
                <input id="misc_certi" name="userfile6" type="file" class="form-control input-md fileInputClass">
                </div>
            </div>
          </div>
        </div>
              





        <div class="col-md-2"> 
        <!-- <input type="submit" value="Upload" name="upload_submit" class="btn btn-danger" required="" /> -->
        <!-- <br /><br /> -->
        </div>
      <!-- </form> -->
      </div> 

      
    
   </div>
  </div>
<!-- </div> -->

</div>
</div>



<!-- Signature certificate  -->

<div class="row">
   <div class="col-md-4">
   <div class="panel panel-danger">
     <div class="panel-heading">Upload your Signature in JPG only 
      <!-- <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/attach/711_Ma_Agarwal_1698348165/711_sign_1698348500838566.jpg" class="btn-sm btn-info " target="_blank">View Uploaded File </a> -->
    </div>
       <div class="panel-body">
         <!-- <p class="update_crerti">Update your signature</p> -->
         <img src="<?php echo $sign ?>" style="height: 52px; width: 100px; margin-top: -10px;">
          <input id="signature" name="userfile5" type="file" class="form-control input-md jpg">
     </div>
     <p class="upload_crerti"></p>
   </div>
 </div>

         

   <div class="col-md-12">
  
   </div>

</div>

<h4 style="text-align:center; font-weight: bold; color: #6739bb;">22. Referees *</h4>

       <div class="row">
       <div class="col-md-12">
         <div class="panel panel-success">
         <div class="panel-heading">Fill the Details</div>
           <div class="panel-body">
             <table class="table table-bordered">
                 <tbody id="acde">
                 
                 <tr height="30px">
                   <th class="col-md-2"> Name </th>
                   <th class="col-md-3"> Position </th>
                   <th class="col-md-3"> Association with Referee</th>
                   <th class="col-md-3"> Institution/Organization</th>
                   <th class="col-md-2"> E-mail </th>
                   <th class="col-md-2"> Contact No.</th>
                 </tr>
                 
                 
                <?php for ($i = 0; $i < 3 ; $i++) { ?>

                 <tr height="60px">
                   <td class="col-md-2">  
                       <input id="ref_name1" name="ref_name[]" type="text" value="uYolanda Cummerata" placeholder="Name" class="form-control input-md" required="" autofocus=""> 
                   </td>

                   <td class="col-md-2"> 
                       <input id="position1" name="positions[]" type="text" value="Ullam illum alias neque."  placeholder="Position" class="form-control input-md" required=""> 
                     </td>

                   <td class="col-md-2"> 
                     <select id="association_referee1" name="association_referee[]" class="form-control input-md" required="">

                       <option value="">Select</option>
                       <option  value="Thesis Supervisor">Thesis Supervisor</option>
                       <option  value="Postdoc Supervisor">Postdoc Supervisor</option>
                       <option selected='selected' value="Research Collaborator">Research Collaborator</option>
                       <option  value="Other">Other</option>
                     </select>
                     </td>

                 
                    <td class="col-md-2"> 
                     <input id="org1" name="org[]" type="text" value="Vitae voluptate temporibus minima architecto nisi assumenda."  placeholder="Institution/Organization" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="email1" name="email[]" type="email" value="your.email+fakedata18670@gmail.com"  placeholder="E-mail" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="phone1" name="phone[]" type="text" value="656-293-5557"  placeholder="Contact No." class="form-control input-md" maxlength="20" required=""> 
                   </td>

                   
                 </tr>
                  
                 <?php } ?>
              
               </tbody>
             </table>

         </div>
       </div>
       </div>
       </div>

<!-- Payment file upload           -->



<!-- Referees Details -->


<input type="hidden" name="ci_csrf_token" value="" />
    
 
<hr> 
<div class="form-group">
<div class="col-md-10">
  <!-- <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/acde" class="btn btn-primary pull-left">BACK</a> -->
  <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/rel_info" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
  
  <!-- <button type="submit" name="submit" value="Submit" class="btn btn-success">SAVE</button> -->


</div>



  
  <div class="col-md-2">
    <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE & NEXT</button>
    <!-- <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">Final Submission</button> -->

  </div>


</form>


</div> 
</div>

<script >
// Event listener for DOM content loaded
document.addEventListener('DOMContentLoaded', function() {
    // Select all file inputs with the class 'fileInputClass'
    var fileInputs = document.querySelectorAll('.fileInputClass');
    
    // Function to check if the file is a PDF
    function checkIfPdf(file) {
        return file.type === 'application/pdf';
    }

    // Iterate over each file input element
    fileInputs.forEach(function(input) {
        input.addEventListener('change', function(event) {
            // Get the files for the current input
            var files = event.target.files;
            // Check each file
            Array.from(files).forEach(function(file) {
                if(checkIfPdf(file)) {
                    console.log(file.name + ' is a PDF.');
                } else {
                    alert(file.name + ' is not a PDF. Please upload PDF files only.');
                    console.log(file.name + ' is not a PDF.');
                }
            });
        });
    });
});


// Event listener for DOM content loaded
document.addEventListener('DOMContentLoaded', function() {
    // Select all file inputs with the class 'fileInputClass'
    var fileInputs = document.querySelectorAll('.fileInputClass');
    
    // Function to check if the file is a PDF and less than 5 MB
    function checkFile(file) {
        var isPdf = file.type === 'application/pdf';
        var isLessThan5Mb = file.size <= 5 * 1024 * 1024; // 5 MB in bytes
        return isPdf && isLessThan5Mb;
    }

    // Iterate over each file input element
    fileInputs.forEach(function(input) {
        input.addEventListener('change', function(event) {
            // Get the files for the current input
            var files = event.target.files;
            // Check each file
            Array.from(files).forEach(function(file) {
                if(checkFile(file)) {
                    console.log(file.name + ' is a PDF and is less than 5 MB.');
                } else {
                    if(file.type !== 'application/pdf') {
                        alert(file.name + ' is not a PDF. Please upload PDF files only.');
                    } else if(file.size > 5 * 1024 * 1024) {
                        alert(file.name + ' is larger than 5 MB. Please upload files smaller than 5 MB.');
                    }
                    console.log(file.name + ' does not meet the requirements.');
                }
            });
        });
    });
});


// Event listener for file input change
document.querySelector('.jpg1').addEventListener('change', function(event) {
    // Get the first file in the file input
    var file = event.target.files[0];
    
    // Check if the file type is 'image/jpeg'
    if(file.type === 'image/jpg') {
        console.log('The file is a JPG image.');
    } else {
        alert('The uploaded file is not a JPG image. Please upload a JPG image.');
        console.log('The file is not a JPG image.');
    }
});


  </script>
<script type="text/javascript">

function confirm_box()
{
  if(confirm("Dear Candidate, \n\nAre you sure that you are ready to submit the application? Press OK to submit the application. Press CANCEL to edit. \nOnce you press OK you cannot make any changes.\n\nThank you."))
  {
    return true;
  }
  else
  {
    return false;
  }
}
function submit_frm()
{
  alert();
  document.getElementById("upload_frm").submit();
}
</script>



<script type="text/javascript">
  $(document).ready(function () 
  {
   
    var list1 = document.getElementById('applicant_cate');
     
    list1.options[0] = new Option('Select/Category', '');
    list1.options[1] = new Option('Other Applicants', 'Other Applicants');
    list1.options[2] = new Option('OBC-NC, PwD, EWS and Female Applicants', 'OBC-NC, PwD, EWS and Female Applicants');
    list1.options[3] = new Option('SC, ST and Faculty Applicants from IIT Indore', 'SC, ST and Faculty Applicants from IIT Indore');
   

    $("#applicant_cate option").each(function()
    {

           if($(this).val()==selectoption){
        $(this).attr('selected', 'selected');
      }
      // Add $(this).val() to your list
    });

    getFoodItem();
      $("#payment_amount option").each(function()
    {

           if($(this).val()==selectsubthemeoption){
        $(this).attr('selected', 'selected');
      }
      // Add $(this).val() to your list
    });
  });

  
  function getFoodItem()
  {
 
    var list1 = document.getElementById('applicant_cate');
    var list2 = document.getElementById("payment_amount");
    var list1SelectedValue = list1.options[list1.selectedIndex].value;


    if (list1SelectedValue=='Other Applicants')
    {
         
        // list2.options.length=0;
        // list2.options[0] = new Option('Select Amount', '');
        list2.options[0] = new Option('INR 1000', 'INR 1000');
        
         
    }
    else if (list1SelectedValue=='OBC-NC, PwD, EWS and Female Applicants')
    {
         
        // list2.options.length=0;
        // list2.options[0] = new Option('Select Amount', '');
        list2.options[0] = new Option('INR 500', 'INR 500');
       
         
    }

    else if (list1SelectedValue=='SC, ST and Faculty Applicants from IIT Indore')
    {
         
        // list2.options.length=0;
        // list2.options[0] = new Option('Select Amount', '');
        list2.options[0] = new Option('NIL', 'NIL');
       
         
    }


    
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
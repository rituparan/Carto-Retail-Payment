<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Database connection parameters
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "faculty";

    // Create connection
    $conn = mysqli_connect($server, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve email of the logged-in user
    $email = $_SESSION['email'];

    // Retrieve previously submitted data from the database

    // Query to retrieve user details
    $sql = "SELECT * FROM `registration` WHERE `EMAIL` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstname = $row['FIRSTNAME'];
        $lastname = $row['LASTNAME'];
        $app_no = $row['APP_NO'];
        $doa = $row['APP_DATE'];
        $cast = $row['CATEGORY'];
    }

    // Retrieve certificates details
    $sql_certificates = "SELECT * FROM `certificates` WHERE `APP_NO` = ?";
    $stmt_certificates = $conn->prepare($sql_certificates);
    $stmt_certificates->bind_param("s", $app_no);
    $stmt_certificates->execute();
    $result_certificates = $stmt_certificates->get_result();

    if ($result_certificates->num_rows > 0) {
        $row_certificates = $result_certificates->fetch_assoc();
        $research_paper = $row_certificates['research_paper'];
        $phd = $row_certificates['phd'];
        $pg = $row_certificates['pg'];
        $ug = $row_certificates['ug'];
        $twelth = $row_certificates['12th'];
        $tenth = $row_certificates['10th'];
        $pay_slip = $row_certificates['pay_slip'];
        $noc = $row_certificates['noc'];
        $post_phd = $row_certificates['post_phd'];
        $other = $row_certificates['other'];
        $signature = $row_certificates['signature'];
    }

    // Retrieve referees details
    $sql_referees = "SELECT * FROM `referees` WHERE `APP_NO` = ?";
    $stmt_referees = $conn->prepare($sql_referees);
    $stmt_referees->bind_param("s", $app_no);
    $stmt_referees->execute();
    $result_referees = $stmt_referees->get_result();

    if ($result_referees->num_rows > 0) {
        $row_referees = $result_referees->fetch_assoc();
        $ref_id = $row_referees['ref_id'];
        $name = $row_referees['name'];
        $position = $row_referees['position'];
        $association = $row_referees['association'];
        $institute = $row_referees['institute'];
        $email = $row_referees['email'];
        $contact = $row_referees['contact'];
    }

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

        // Define upload directory
        $uploadDir1 = 'Certificates/';
        $uploadDir2 = 'signature/';

        // Get file details
        $research_paper = $_FILES['userfile7']['name'];
        $phd = $_FILES['userfile']['name'];
        $pg = $_FILES['userfile1']['name'];
        $ug = $_FILES['userfile2']['name'];
        $twelth = $_FILES['userfile3']['name'];
        $tenth = $_FILES['userfile4']['name'];
        $pay_slip = $_FILES['userfile9']['name'];
        $noc = $_FILES['userfile10']['name'];
        $post_phd = $_FILES['userfile8']['name'];
        $other = $_FILES['userfile6']['name'];
        $signature = $_FILES['userfile5']['name'];

        // Generate a unique name for the file
        $uniqueName1 = uniqid() . '_' . $research_paper;
        $uniqueName2 = uniqid() . '_' . $phd;
        $uniqueName3 = uniqid() . '_' . $pg;
        $uniqueName4 = uniqid() . '_' . $ug;
        $uniqueName5 = uniqid() . '_' . $twelth;
        $uniqueName6 = uniqid() . '_' . $tenth;
        $uniqueName7 = uniqid() . '_' . $pay_slip;
        $uniqueName8 = uniqid() . '_' . $noc;
        $uniqueName9 = uniqid() . '_' . $post_phd;
        $uniqueName10 = uniqid() . '_' . $other;
        $uniqueName11 = uniqid() . '_' . $signature;

        // Move the uploaded file to the upload directory
        $filePath1 = $uploadDir1 . $uniqueName1;
        $filePath2 = $uploadDir1 . $uniqueName2;
        $filePath3 = $uploadDir1 . $uniqueName3;
        $filePath4 = $uploadDir1 . $uniqueName4;
        $filePath5 = $uploadDir1 . $uniqueName5;
        $filePath6 = $uploadDir1 . $uniqueName6;
        $filePath7 = $uploadDir1 . $uniqueName7;
        $filePath8 = $uploadDir1 . $uniqueName8;
        $filePath9 = $uploadDir1 . $uniqueName9;
        $filePath10 = $uploadDir1 . $uniqueName10;
        $filePath11 = $uploadDir2 . $uniqueName11;

        move_uploaded_file($_FILES['userfile7']['tmp_name'], $filePath1);
        move_uploaded_file($_FILES['userfile']['tmp_name'], $filePath2);
        move_uploaded_file($_FILES['userfile1']['tmp_name'], $filePath3);
        move_uploaded_file($_FILES['userfile2']['tmp_name'], $filePath4);
        move_uploaded_file($_FILES['userfile3']['tmp_name'], $filePath5);
        move_uploaded_file($_FILES['userfile4']['tmp_name'], $filePath6);
        move_uploaded_file($_FILES['userfile9']['tmp_name'], $filePath7);
        move_uploaded_file($_FILES['userfile10']['tmp_name'], $filePath8);
        move_uploaded_file($_FILES['userfile8']['tmp_name'], $filePath9);
        move_uploaded_file($_FILES['userfile6']['tmp_name'], $filePath10);
        move_uploaded_file($_FILES['userfile5']['tmp_name'], $filePath11);

        $sql2 = "INSERT INTO `certificates` (`app_no`, `research_paper`, `phd`, `pg`, `ug`, `12th`, `10th`, `pay_slip`, `noc`, `post_phd`, `other`, `signature`)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
         ON DUPLICATE KEY UPDATE 
         `research_paper` = VALUES(research_paper), `phd` = VALUES(phd), `pg` = VALUES(pg), `ug` = VALUES(ug), `12th` = VALUES(12th), `10th` = VALUES(10th), `pay_slip` = VALUES(pay_slip), `noc` = VALUES(noc), `post_phd` = VALUES(post_phd), `other` = VALUES(other), `signature` = VALUES(signature);";
        $stmt2 = $conn->prepare($sql2);
        if (!$stmt2) {
            echo "Error preparing statement: " . $conn->error;
            exit();
        }
        $stmt2->bind_param("ssssssssssss", $app_no, $filepath1, $filepath2, $filepath3, $filepath4, $filepath5, $filepath6, $filepath7, $filepath8, $filepath9, $filepath10, $filepath11);
        $stmt2->execute();
        $stmt2->close();

        // Retrieve form data arrays
        $names = $_POST['ref_name'];
        $positions = $_POST['position'];
        $associations = $_POST['association_referee'];
        $institutions = $_POST['org'];
        $emails = $_POST['email'];
        $contacts = $_POST['phone'];

        // Prepare and bind SQL statement
        $sql = "INSERT INTO referees (app_no, ref_id, name, position, association, institute, email, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissssss", $app_no, $ref_id, $name, $position, $association, $institute, $email, $contact);

        $ref_id = 1;

        // Loop through each referee entry and execute the statement
        foreach ($names as $key => $name) {
            // Retrieve data for each referee
            $name = $names[$key];
            $position = $positions[$key];
            $association = $associations[$key];
            $institute = $institutions[$key];
            $email = $emails[$key];
            $contact = $contacts[$key];

            // Execute the statement
            if (!$stmt->execute()) {
                // Error occurred while inserting data
                echo "Error: " . $sql . "<br>" . $conn->error;
                break; // Exit loop if an error occurs
            }

            $ref_id++; // Increment ref_id for the next entry
        }

        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome</title>
    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Include jQuery UI library -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="icon" href="IIT-Patna-logo.ico" type="image/x-icon" />
    <!-- Include CSS files for styling -->
    <link rel="stylesheet" type="text/css" href="stylesheet1.css" />
    <link rel="stylesheet" type="text/css" href="stylesheet2.css" />
    <!-- Include Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Sintony" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Hind&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&amp;display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&amp;display=swap" rel="stylesheet" />

    <style type="text/css">
        /* Additional CSS styles */
        body {
            background-color: lightgray;
            padding-top: 0px !important;
        }
    </style>

</head>

<body>
    <!-- Header section -->
    <?php require 'partials/_header.php' ?>

    <style type="text/css">
        body {
            padding-top: 30px;
        }

        .form-control {
            margin-bottom: 10px;
        }

        .floating-box {
            display: inline-block;
            width: 150px;
            height: 75px;
            margin: 10px;
            border: 3px solid #73AD21;
        }

        label {
            /*padding: 10 !important;*/
            text-align: left !important;
            margin-top: -5px;
            font-family: 'Noto Serif', serif;
        }

        hr {
            border-top: 1px solid #025198 !important;
            border-style: dashed !important;
            border-width: 1.2px;
        }

        .panel-heading {
            font-size: 1.3em;
            font-family: 'Oswald', sans-serif !important;
            letter-spacing: .5px;
        }

        .panel-info .panel-heading {
            font-size: 1.1em;
            font-family: 'Oswald', sans-serif !important;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .panel-danger .panel-heading {
            font-size: 1.1em;
            font-family: 'Oswald', sans-serif !important;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .btn-primary {
            padding: 9px;
        }

        .Acae_data {
            font-size: 1.1em;
            font-weight: bold;
            color: #414002;
        }


        .upload_crerti {
            font-size: 1.1em;
            font-weight: bold;
            color: red;
            text-align: center;
        }

        .update_crerti {
            font-size: 1.1em;
            font-weight: bold;
            color: green;
            text-align: center;
        }

        p {
            padding-top: 10px;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 well">
                <fieldset>
                    <legend>
                        <div class="row">
                            <div class="col-md-10">
                                <h4>Welcome : <font color="#025198"><strong><?php echo $firstname . ' ' . $lastname ?></strong></font>
                                </h4>
                            </div>
                            <div class="col-md-2">
                                <a href="logout.php" class="btn btn-sm btn-success  pull-right">Logout</a>
                            </div>
                        </div>
                    </legend>
                </fieldset>

                <!-- publication file upload           -->

                <form class="form-horizontal" action="page6.php" method="post" enctype="multipart/form-data">

                    <!-- Reprints of 5 Best Research Papers  -->
                    <h4 style="text-align:center; font-weight: bold; color: #6739bb;">20. Reprints of 5 Best Research Papers *</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">Upload 5 Best Research Papers in a single PDF &lt; 6MB
                                    <?php if (!empty($research_paper)) : ?>
                                        <a href="<?php echo $research_paper; ?>" class="btn-sm btn-info" target="_blank">View Uploaded File </a>
                                    <?php endif; ?>
                                    <br>
                                    <br>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-5">
                                        <p class="update_crerti">Update 5 best papers</p>
                                    </div>
                                    <div class="col-md-7">
                                        <input id="full_5_paper" name="userfile7" type="file" class="form-control input-md">
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
                                    <br>
                                    <small style="color: red;">Uploaded PDF files will not be displayed as part of the printed form.</small>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <!-- phd certificate  -->

                                        <div class="col-md-4">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">PHD Certificate
                                                    <?php if (!empty($phd)) : ?>
                                                        <a href="<?php echo $phd; ?>" class="btn-sm btn-info" target="_blank">View Uploaded File </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="panel-body">
                                                    <p class="update_crerti">Update PHD Certificate</p>
                                                    <input id="phd" name="userfile" type="file" class="form-control input-md">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Master certificate  -->

                                        <div class="col-md-4">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">PG Documents
                                                    <?php if (!empty($pg)) : ?>
                                                        <a href="<?php echo $pg; ?>" class="btn-sm btn-info" target="_blank">View Uploaded File </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="panel-body">
                                                    <p class="update_crerti">Update All semester/year-Marksheets and degree certificate</p>
                                                    <input id="post_gr" name="userfile1" type="file" class="form-control input-md">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bachelor certificate  -->

                                        <div class="col-md-4">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">UG Documents
                                                    <?php if (!empty($ug)) : ?>
                                                        <a href="<?php echo $ug; ?>" class="btn-sm btn-info" target="_blank">View Uploaded File </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="panel-body">
                                                    <p class="update_crerti">Update All semester/year-Marksheets and degree certificate </p>
                                                    <input id="under_gr" name="userfile2" type="file" class="form-control input-md">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 12th certificate  -->


                                        <div class="col-md-4">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">12th/HSC/Diploma Documents
                                                    <?php if (!empty($twelth)) : ?>
                                                        <a href="<?php echo $twelth; ?>" class="btn-sm btn-info" target="_blank">View Uploaded File </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="panel-body">
                                                    <p class="update_crerti">Update 12th/HSC/Diploma/Marksheet(s) and passing certificate</p>
                                                    <input id="higher_sec" name="userfile3" type="file" class="form-control input-md">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 10th certificate  -->

                                        <div class="col-md-4">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">10th/SSC Documents
                                                    <?php if (!empty($tenth)) : ?>
                                                        <a href="<?php echo $tenth; ?>" class="btn-sm btn-info" target="_blank">View Uploaded File </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="panel-body">
                                                    <p class="update_crerti">Update 12th/HSC/Diploma/Marksheet(s) and passing certificate</p>
                                                    <input id="high_school" name="userfile4" type="file" class="form-control input-md">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pay Slip -->

                                        <div class="col-md-4">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">Pay Slip
                                                    <?php if (!empty($pay_slip)) : ?>
                                                        <a href="<?php echo $pay_slip; ?>" class="btn-sm btn-info" target="_blank">View Uploaded File </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="panel-body">
                                                    <p class="update_crerti">Update Pay Slip</p>
                                                    <input id="pay_slip" name="userfile9" type="file" class="form-control input-md">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Under Taking NOC -->

                                        <!-- Pay Slip -->

                                        <div class="col-md-6">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">NOC or Undertaking
                                                    <?php if (!empty($noc)) : ?>
                                                        <a href="<?php echo $noc; ?>" class="btn-sm btn-info" target="_blank">View Uploaded File </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="panel-body">
                                                    <p class="update_crerti">Undertaking-in case, NOC is not available at the time of application but will be provided at the time of interview</p>
                                                    <input id="noc_under" name="userfile10" type="file" class="form-control input-md">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 10 years post phd exp certificate  -->

                                        <div class="col-md-5">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">Post PHD Experience Certificate/All Experience Certificates/ Last Pay slip/
                                                    <?php if (!empty($post_phd)) : ?>
                                                        <a href="<?php echo $post_phd; ?>" class="btn-sm btn-info" target="_blank">View Uploaded File </a>
                                                    <?php endif; ?>
                                                    <br>
                                                </div>
                                                <div class="panel-body">
                                                    <p class="update_crerti">Update Certificate</p>
                                                    <input id="post_phd_10" name="userfile8" type="file" class="form-control input-md">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Misc certificate  -->

                                        <div class="col-md-12">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">Upload any other relevant document in a single PDF (For example award certificate, experience certificate etc) &lt;1MB.
                                                </div>
                                                <div class="panel-body">
                                                    <div class="col-md-5">
                                                        <p class="upload_crerti">Upload any other document</p>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input id="misc_certi" name="userfile6" type="file" class="form-control input-md">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Signature certificate  -->

                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-danger">
                                <div class="panel-heading">Upload your Signature in JPG only
                                </div>
                                <div class="panel-body">
                                    <?php if (!empty($signature)) : ?>
                                        <img src="<?php echo $signature; ?>" style="height: 52px; width: 100px; margin-top: -10px;">
                                    <?php endif; ?>
                                    <input id="signature" name="userfile5" type="file" class="form-control input-md">
                                </div>
                                <p class="upload_crerti"></p>
                            </div>
                        </div>
                        <div class="col-md-12"></div>
                    </div>


                    <!-- Referees Details -->

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

                                            <!-- Repeat this section dynamically based on the number of referees -->
                                            <?php for ($i = 1; $i <= 3; $i++) { ?>
                                                <tr height="60px">
                                                    <td class="col-md-2">
                                                        <input id="ref_name<?php echo $i; ?>" name="ref_name[]" type="text" placeholder="Name" class="form-control input-md" required autofocus>
                                                    </td>
                                                    <td class="col-md-2">
                                                        <input id="position<?php echo $i; ?>" name="position[]" type="text" placeholder="Position" class="form-control input-md" required>
                                                    </td>
                                                    <td class="col-md-2">
                                                        <select id="association_referee<?php echo $i; ?>" name="association_referee[]" class="form-control input-md" required>
                                                            <option value="">Select</option>
                                                            <option value="Thesis Supervisor">Thesis Supervisor</option>
                                                            <option value="Postdoc Supervisor">Postdoc Supervisor</option>
                                                            <option value="Research Collaborator">Research Collaborator</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </td>
                                                    <td class="col-md-2">
                                                        <input id="org<?php echo $i; ?>" name="org[]" type="text" placeholder="Institution/Organization" class="form-control input-md" required>
                                                    </td>
                                                    <td class="col-md-2">
                                                        <input id="email<?php echo $i; ?>" name="email[]" type="email" placeholder="E-mail" class="form-control input-md" required>
                                                    </td>
                                                    <td class="col-md-2">
                                                        <input id="phone<?php echo $i; ?>" name="phone[]" type="text" placeholder="Contact No." class="form-control input-md" maxlength="20" required>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <!-- End of dynamic section -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <hr>
                    <div class="form-group">
                        <div class="col-md-10">
                            <a href="page5.php" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
                        </div>

                        <div class="col-md-2">
                            <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE &amp; NEXT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            function confirm_box() {
                if (confirm("Dear Candidate, \n\nAre you sure that you are ready to submit the application? Press OK to submit the application. Press CANCEL to edit. \nOnce you press OK you cannot make any changes.\n\nThank you.")) {
                    return true;
                } else {
                    return false;
                }
            }

            function submit_frm() {
                alert();
                document.getElementById("upload_frm").submit();
            }
        </script>



        <script type="text/javascript">
            $(document).ready(function() {

                var list1 = document.getElementById('applicant_cate');

                list1.options[0] = new Option('Select/Category', '');
                list1.options[1] = new Option('Other Applicants', 'Other Applicants');
                list1.options[2] = new Option('OBC-NC, PwD, EWS and Female Applicants', 'OBC-NC, PwD, EWS and Female Applicants');
                list1.options[3] = new Option('SC, ST and Faculty Applicants from IIT Patna', 'SC, ST and Faculty Applicants from IIT Patna');


                $("#applicant_cate option").each(function() {

                    if ($(this).val() == selectoption) {
                        $(this).attr('selected', 'selected');
                    }
                    // Add $(this).val() to your list
                });

                getFoodItem();
                $("#payment_amount option").each(function() {

                    if ($(this).val() == selectsubthemeoption) {
                        $(this).attr('selected', 'selected');
                    }
                    // Add $(this).val() to your list
                });
            });


            function getFoodItem() {

                var list1 = document.getElementById('applicant_cate');
                var list2 = document.getElementById("payment_amount");
                var list1SelectedValue = list1.options[list1.selectedIndex].value;


                if (list1SelectedValue == 'Other Applicants') {

                    // list2.options.length=0;
                    // list2.options[0] = new Option('Select Amount', '');
                    list2.options[0] = new Option('INR 1000', 'INR 1000');


                } else if (list1SelectedValue == 'OBC-NC, PwD, EWS and Female Applicants') {

                    // list2.options.length=0;
                    // list2.options[0] = new Option('Select Amount', '');
                    list2.options[0] = new Option('INR 500', 'INR 500');


                } else if (list1SelectedValue == 'SC, ST and Faculty Applicants from IIT Patna') {

                    // list2.options.length=0;
                    // list2.options[0] = new Option('Select Amount', '');
                    list2.options[0] = new Option('NIL', 'NIL');
                }



            }
        </script>
    </div>
    <link rel="stylesheet" href="stylesheet4.css" id="videoNoteFrameStyle">
</body>

</html>
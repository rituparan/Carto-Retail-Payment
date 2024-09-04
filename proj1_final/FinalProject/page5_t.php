<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    $app_no = $_SESSION['app_no'];

    // Retrieve previously submitted data from the database

    // Query to retrieve user details
    $sql = "SELECT * FROM `registration` WHERE `APP_NO` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $app_no);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstname = $row['FIRSTNAME'];
        $lastname = $row['LASTNAME'];
        $email = $row['EMAIL'];
        $doa = $row['APP_DATE'];
        $cast = $row['CATEGORY'];
    }

    $sql_personal = "SELECT * FROM `contributions` WHERE `APP_NO` = ?";
    $stmt_personal = $conn->prepare($sql_personal);
    $stmt_personal->bind_param("s", $app_no);
    $stmt_personal->execute();
    $result_personal = $stmt_personal->get_result();

    if ($result_personal->num_rows > 0) {
        $row_personal = $result_personal->fetch_assoc();
        $research = $row_personal['research'];
        $teaching = $row_personal['teaching'];
        $other_info = $row_personal['other_info'];
        $professional_service = $row_personal['professional_service'];
        $journal_publications = $row_personal['journal_publications'];
        $conference_publications = $row_personal['conference_publications'];
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

        // Insert application details
        $research_statement = $_POST['research_statement'];
        $teaching_statement = $_POST['teaching_statement'];
        $rel_in = $_POST['rel_in'];
        $prof_serv = $_POST['prof_serv'];
        $jour_details = $_POST['jour_details'];
        $conf_details = $_POST['conf_details'];

        $sql1 = "INSERT INTO `contributions` (`APP_NO`, `research`, `teaching`, `other_info`, `professional_service`, `journal_publications`, `conference_publications`) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE 
        `research` = VALUES(research), `teaching` = VALUES(teaching), `other_info` = VALUES(other_info), `professional_service` = VALUES(professional_service), `journal_publications` = VALUES(journal_publications), `conference_publications` = VALUES(conference_publications)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("sssssss", $app_no, $research_statement, $teaching_statement, $rel_in, $prof_serv, $jour_details, $conf_details);
        $stmt1->execute();
        $stmt1->close();
        
        // Execute all queries
        $_SESSION['form_data'] = $_POST;
        $_SESSION['loggedin'] = true;
        $_SESSION['app_no'] = $app_no;
        header("location: page6.php");
        exit();
    }

    // Close connection
    mysqli_close($conn);
} else {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
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
            padding: 0 !important;
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

        .btn-primary {
            padding: 9px;
        }

        .Acae_data {
            font-size: 1.1em;
            font-weight: bold;
            color: #414002;
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
                            <div class="col-md-3">
                                    <!-- Logout button -->
                                    <button type="button" id="logout" name="logout" class="btn btn-sm btn-success pull-right">Logout</button>
                            </div>
                        </div>
                    </legend>

                    <form class="form-horizontal" action="page5.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-success ">
                                    <div class="panel-heading">14. Significant research contribution and future plans *<small class="pull-right">(not more than 500 words)</small>
                                        <br>
                                        <small>(Please provide a Research Statement describing your research plans and one or two specific research projects to be conducted at IIT Patna in 2-3 years time frame)</small>
                                    </div>
                                    <div class="panel-body">
                                        <textarea style="height: 250px; display: block;" placeholder="Significant research contribution and future plans" class="form-control input-md" name="research_statement" maxlength="3500" ><?php echo isset($research) ? $research : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="panel panel-success ">
                                    <div class="panel-heading">15. Significant teaching contribution and future plans * <small>(Please list UG/PG courses that you would like to develop and/or teach at IIT Patna)</small>
                                        <small class="pull-right"> (not more than 500 words)</small>
                                    </div>
                                    <div class="panel-body">
                                        <textarea style="height: 250px; display: block;" placeholder="Significant teaching contribution and future plans" class="form-control input-md" name="teaching_statement" maxlength="3500" ><?php echo isset($teaching) ? $teaching : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="panel panel-success ">
                                    <div class="panel-heading">16. Any other relevant information. <small class="pull-right">(not more than 500 words)</small></div>
                                    <div class="panel-body">
                                        <textarea style="height: 250px; display: block;" placeholder="Any other relevant information" class="form-control input-md" name="rel_in" maxlength="3500" ><?php echo isset($other_info) ? $other_info : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="panel panel-success ">
                                    <div class="panel-heading">17. Professional Service : Editorship/Reviewership <small class="pull-right">(not more than 500 words)</small></div>
                                    <div class="panel-body">
                                        <textarea style="height: 250px; display: block;" placeholder="Professional Service : Editorship/Reviewership" class="form-control input-md" name="prof_serv" maxlength="3500" ><?php echo isset($professional_service) ? $professional_service : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="panel panel-success ">
                                    <div class="panel-heading">18. Detailed List of Journal Publications
                                        <br>
                                        (Including Sr. No., Author's Names, Paper Title, Volume, Issue, Year, Page Nos., Impact Factor (if any), DOI, Status[Published/Accepted] )
                                    </div>
                                    <div class="panel-body">
                                        <textarea style="height: 250px; display: block;" placeholder="Detailed List of Journal Publications" class="form-control input-md" name="jour_details" maxlength="3500"><?php echo isset($journal_publications) ? $journal_publications : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="panel panel-success ">
                                    <div class="panel-heading">19. Detailed List of Conference Publications<br>(Including Sr. No., Author's Names, Paper Title, Name of the conference, Year, Page Nos., DOI [If any] )</div>
                                    <div class="panel-body">
                                        <textarea style="height: 250px; display: block;" placeholder="Detailed List of Conference Publications" class="form-control input-md" name="conf_details" maxlength="3500" ><?php echo isset($conference_publications) ? $conference_publications : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10">
                                <a href="page4.php" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
                            </div>

                            <div class="col-md-2">
                                <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE &amp; NEXT</button>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="stylesheet4.css" id="videoNoteFrameStyle">
    <script src="page5.js"></script>
</body>

</html>
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
    $app_no = $_SESSION['app_no'];

    // Query to retrieve user details
    $sql = "SELECT * FROM `registration` WHERE `APP_NO` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $app_no);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $firstname = $row['FIRSTNAME'];
        $lastname = $row['LASTNAME'];
        $email = $row['EMAIL'];
        $date_of_app = $row['APP_DATE'];
        $category = $row['CATEGORY'];
    } else {
        echo "User not found.";
        exit();
    }

    // Retrieve previously submitted data from the database
    // Prepare and bind SQL statement for retrieving previously stored data
    $sql_retrieve = "SELECT * FROM publications WHERE app_no = ?";
    $stmt_retrieve = $conn->prepare($sql_retrieve);
    $stmt_retrieve->bind_param("s", $app_no);
    $stmt_retrieve->execute();
    $result_retrieve = $stmt_retrieve->get_result();

    if ($result_retrieve->num_rows > 0) {
        $row_retrieve = $result_retrieve->fetch_assoc();
        // Assign retrieved data to variables
        $summary_journal_inter = $row_retrieve['summary_journal_inter'];
        $summary_journal = $row_retrieve['summary_journal'];
        $summary_conf_inter = $row_retrieve['summary_conf_inter'];
        $summary_conf_national = $row_retrieve['summary_conf_national'];
        $patent_publish = $row_retrieve['patent_publish'];
        $summary_book = $row_retrieve['summary_book'];
        $summary_book_chapter = $row_retrieve['summary_book_chapter'];
    }

    // Retrieve previously stored data for the list of publications
    $sql_retrieve = "SELECT * FROM bestpublications WHERE app_no = ?";
    $stmt_retrieve = $conn->prepare($sql_retrieve);
    $stmt_retrieve->bind_param("i", $app_no);
    $stmt_retrieve->execute();
    $result_retrieve = $stmt_retrieve->get_result();

    // Initialize arrays to store retrieved data
    $retrieved_authors = [];
    $retrieved_titles = [];
    $retrieved_journals = [];
    $retrieved_years = [];
    $retrieved_impacts = [];
    $retrieved_dois = [];
    $retrieved_statuses = [];

    // Check if there are any rows returned
    if ($result_retrieve->num_rows > 0) {
        // Loop through each row
        while ($row = $result_retrieve->fetch_assoc()) {
            // Store data into respective arrays
            $retrieved_authors[] = $row['author'];
            $retrieved_titles[] = $row['title'];
            $retrieved_journals[] = $row['journal'];
            $retrieved_years[] = $row['year'];
            $retrieved_impacts[] = $row['impact'];
            $retrieved_dois[] = $row['doi'];
            $retrieved_statuses[] = $row['status'];
        }
    }


    // Retrieve previously stored patent data
    $sql_patents = "SELECT * FROM Patents WHERE app_no = ?";
    $stmt_patents = $conn->prepare($sql_patents);
    $stmt_patents->bind_param("i", $app_no);
    $stmt_patents->execute();
    $result_patents = $stmt_patents->get_result();

    // Initialize arrays to store retrieved data
    $stored_pauthors = [];
    $stored_ptitles = [];
    $stored_p_countries = [];
    $stored_p_numbers = [];
    $stored_pyears_filed = [];
    $stored_pyears_published = [];
    $stored_pyears_issued = [];

    // Check if there are rows returned
    if ($result_patents->num_rows > 0) {
        // Loop through each row and store the data in arrays
        while ($row = $result_patents->fetch_assoc()) {
            $stored_pauthors[] = $row['author'];
            $stored_ptitles[] = $row['title'];
            $stored_p_countries[] = $row['country'];
            $stored_p_numbers[] = $row['patent_number'];
            $stored_pyears_filed[] = $row['date_filed'];
            $stored_pyears_published[] = $row['date_published'];
            $stored_pyears_issued[] = $row['date_issued'];
        }
    }

    // Prepare and execute SQL query to retrieve previously stored book data
    $sql_books = "SELECT * FROM Books WHERE app_no = ?";
    $stmt_books = $conn->prepare($sql_books);
    $stmt_books->bind_param("i", $app_no);
    $stmt_books->execute();
    $result_books = $stmt_books->get_result();

    // Initialize arrays to store retrieved data
    $stored_bauthors = [];
    $stored_btitles = [];
    $stored_byears = [];
    $stored_bisbns = [];

    // Check if there are any rows returned
    if ($result_books->num_rows > 0) {
        // Loop through each row and store the data in arrays
        while ($row = $result_books->fetch_assoc()) {
            $stored_bauthors[] = $row['author'];
            $stored_btitles[] = $row['title'];
            $stored_byears[] = $row['year_of_publication'];
            $stored_bisbns[] = $row['isbn'];
        }
    }

    // Close the statement after fetching data
    $stmt_books->close();

    // Prepare and bind SQL statement to retrieve previously stored data
    $sql = "SELECT author, title, year_of_publication, isbn FROM BookChapters WHERE app_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $app_no);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize arrays to store retrieved data
    $stored_authors = array();
    $stored_titles = array();
    $stored_years = array();
    $stored_isbns = array();

    // Fetch and store the retrieved data
    while ($row = $result->fetch_assoc()) {
        $stored_authors[] = $row['author'];
        $stored_titles[] = $row['title'];
        $stored_years[] = $row['year_of_publication'];
        $stored_isbns[] = $row['isbn'];
    }

    $stmt->close(); // Close the statement after execution

    // Prepare and bind SQL statement for retrieving Google Scholar link
    $sql_retrieve_google_link = "SELECT google_scholar_link FROM googlescholar WHERE app_no = ?";
    $stmt_retrieve_google_link = $conn->prepare($sql_retrieve_google_link);
    $stmt_retrieve_google_link->bind_param("i", $app_no);
    $stmt_retrieve_google_link->execute();
    $result_retrieve_google_link = $stmt_retrieve_google_link->get_result();

    // Check if the query was successful
    if ($result_retrieve_google_link) {
        // Fetch the result
        $row_google_link = $result_retrieve_google_link->fetch_assoc();
        if ($row_google_link) {
            // Google Scholar link found, assign it to a variable
            $previous_google_link = $row_google_link['google_scholar_link'];
        } else {
            // Google Scholar link not found
            $previous_google_link = ""; // or any default value
        }
    }

    // Close the prepared statement
    $stmt_retrieve_google_link->close();

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
        // Retrieve form data for summary of publications
        $summary_journal_inter = $_POST['summary_journal_inter'];
        $summary_journal = $_POST['summary_journal'];
        $summary_conf_inter = $_POST['summary_conf_inter'];
        $summary_conf_national = $_POST['summary_conf_national'];
        $patent_publish = $_POST['patent_publish'];
        $summary_book = $_POST['summary_book'];
        $summary_book_chapter = $_POST['summary_book_chapter'];

        // Prepare and bind SQL statement for summary of publications
        $sql_summary = "INSERT INTO publications (app_no, summary_journal_inter, summary_journal, summary_conf_inter, summary_conf_national, patent_publish, summary_book, summary_book_chapter) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                summary_journal_inter = VALUES(summary_journal_inter), 
                summary_journal = VALUES(summary_journal), 
                summary_conf_inter = VALUES(summary_conf_inter), 
                summary_conf_national = VALUES(summary_conf_national), 
                patent_publish = VALUES(patent_publish), 
                summary_book = VALUES(summary_book), 
                summary_book_chapter = VALUES(summary_book_chapter)";

        $stmt1 = $conn->prepare($sql_summary);
        $stmt1->bind_param("ssssssss", $app_no, $summary_journal_inter, $summary_journal, $summary_conf_inter, $summary_conf_national, $patent_publish, $summary_book, $summary_book_chapter);
        $stmt1->execute();
        $stmt1->close();


        // Retrieve form data arrays for list of publications
        $authors = $_POST['author'];
        $titles = $_POST['title'];
        $journals = $_POST['journal'];
        $years = $_POST['year'];
        $impacts = $_POST['impact'];
        $dois = $_POST['doi'];
        $statuses = $_POST['status'];

        // Prepare and bind SQL statement for list of publications
        $sql_list = "INSERT INTO bestpublications (app_no, id, author, title, journal, year, impact, doi, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) 
             ON DUPLICATE KEY UPDATE 
             author = VALUES(author), 
             title = VALUES(title), 
             journal = VALUES(journal), 
             year = VALUES(year), 
             impact = VALUES(impact), 
             doi = VALUES(doi), 
             status = VALUES(status)";
        $id = 1;
        $stmt_list = $conn->prepare($sql_list);

        // Bind parameters for list of publications
        $stmt_list->bind_param("iisssssss", $app_no, $id, $author, $title, $journal, $year, $impact, $doi, $status);

        // Loop through each publication entry and execute the statement
        for ($i = 0; $i < count($authors); $i++) {

            $author = $authors[$i];
            $title = $titles[$i];
            $journal = $journals[$i];
            $year = $years[$i];
            $impact = $impacts[$i];
            $doi = $dois[$i];
            $status = $statuses[$i];

            // Execute the statement for list of publications
            if (!$stmt_list->execute()) {
                // Error occurred while inserting or updating data for list of publications
                echo "Error: " . $sql_list . "<br>" . $conn->error;
                break; // Exit loop if an error occurs
            }

            $id++;
        }

        // Retrieve form data arrays for patents
        $pauthors = $_POST['pauthor'];
        $ptitles = $_POST['ptitle'];
        $p_countries = $_POST['p_country'];
        $p_numbers = $_POST['p_number'];
        $pyears_filed = $_POST['pyear_filed'];
        $pyears_published = $_POST['pyear_published'];
        $pyears_issued = $_POST['pyear_issued'];

        // Prepare and bind SQL statement for patents
        $sql = "INSERT INTO Patents (app_no, id, author, title, country, patent_number, date_filed, date_published, date_issued) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) 
        ON DUPLICATE KEY UPDATE 
        author = VALUES(author), 
        title = VALUES(title), 
        country = VALUES(country), 
        patent_number = VALUES(patent_number), 
        date_filed = VALUES(date_filed), 
        date_published = VALUES(date_published), 
        date_issued = VALUES(date_issued)";
        $id = 1;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisssssss", $app_no, $id, $pauthor, $ptitle, $p_country, $p_number, $pyear_filed, $pyear_published, $pyear_issued);

        // Loop through each patent entry and execute the statement
        for ($i = 0; $i < count($pauthors); $i++) {

            $pauthor = $pauthors[$i];
            $ptitle = $ptitles[$i];
            $p_country = $p_countries[$i];
            $p_number = $p_numbers[$i];
            $pyear_filed = $pyears_filed[$i];
            $pyear_published = $pyears_published[$i];
            $pyear_issued = $pyears_issued[$i];

            // Execute the statement for patents
            if (!$stmt->execute()) {
                // Error occurred while inserting or updating data for patents
                echo "Error: " . $sql . "<br>" . $conn->error;
                break; // Exit loop if an error occurs
            }

            $id++;
        }

        $stmt->close(); // Close the statement after execution


        // Retrieve form data arrays for books
        $bauthors = $_POST['bauthor'];
        $btitles = $_POST['btitle'];
        $byears = $_POST['byear'];
        $bisbns = $_POST['bisbn'];

        // Prepare and bind SQL statement for books
        $sql = "INSERT INTO Books (app_no, id, author, title, year_of_publication, isbn) VALUES (?, ?, ?, ?, ?, ?) 
        ON DUPLICATE KEY UPDATE 
        author = VALUES(author), 
        title = VALUES(title), 
        year_of_publication = VALUES(year_of_publication), 
        isbn = VALUES(isbn)";
        $id = 1;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissss", $app_no, $id, $bauthor, $btitle, $byear, $bisbn);

        // Loop through each book entry and execute the statement
        for ($i = 0; $i < count($bauthors); $i++) {

            $bauthor = $bauthors[$i];
            $btitle = $btitles[$i];
            $byear = $byears[$i];
            $bisbn = $bisbns[$i];

            // Execute the statement for books
            if (!$stmt->execute()) {
                // Error occurred while inserting or updating data for books
                echo "Error: " . $sql . "<br>" . $conn->error;
                break; // Exit loop if an error occurs
            }

            $id++;
        }

        $stmt->close(); // Close the statement after execution


        // Retrieve form data arrays
        $authors = $_POST['bc_author'];
        $titles = $_POST['bc_title'];
        $years = $_POST['bc_year'];
        $isbns = $_POST['bc_isbn'];

        // Prepare and bind SQL statement
        $sql = "INSERT INTO BookChapters (app_no, id, author, title, year_of_publication, isbn) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissss", $app_no, $id, $author, $title, $year, $isbn);

        // Loop through each book chapter entry and execute the statement
        foreach ($authors as $key => $author) {

            $author = $authors[$key];
            $title = $titles[$key];
            $year = $years[$key];
            $isbn = $isbns[$key];

            // Execute the statement
            if (!$stmt->execute()) {
                // Error occurred while inserting data
                echo "Error: " . $sql . "<br>" . $conn->error;
                break; // Exit loop if an error occurs
            }

            $id++;
        }

        $stmt->close(); // Close the statement after execution


        // Retrieve Google Scholar link
        $google_link = $_POST['google_link'];

        // Prepare and bind SQL statement for updating Google Scholar link
        $sql_update_google_link = "INSERT INTO googlescholar (app_no, google_scholar_link) VALUES (?, ?) ON DUPLICATE KEY UPDATE google_scholar_link = ?";
        $stmt_update_google_link = $conn->prepare($sql_update_google_link);

        // Check if the prepare operation succeeded
        if ($stmt_update_google_link === false) {
            // Output error message and SQL statement for debugging
            echo "Error preparing SQL statement: " . $conn->error . "<br>";
            echo "SQL: " . $sql_update_google_link;
        } else {

            // Bind parameters and execute the statement
            $stmt_update_google_link->bind_param("iss", $app_no, $google_link, $google_link);

            // Execute the statement to update Google Scholar link
            if ($stmt_update_google_link->execute()) {
                // Check if a new row was inserted or existing row was updated
                if ($stmt_update_google_link->affected_rows > 0) {
                    // Google Scholar link updated successfully
                    echo "Google Scholar link submitted successfully.";
                } else {
                    // Google Scholar link already existed, and it was updated
                    //echo "Google Scholar link updated successfully.";
                }
            } else {
                // Error occurred while updating Google Scholar link
                echo "Error: Unable to update Google Scholar link.";
            }

            // Close prepared statement
            $stmt_update_google_link->close();
        }

        // Close list statement (Assuming this is part of the previous code)
        $stmt_list->close();


        // Redirect to page5.php after successful submission
        $_SESSION['loggedin'] = true; // This seems redundant, but I'm keeping it for consistency
        $_SESSION['app_no'] = $app_no; // Set the session variable correctly
        header("location: page5.php");
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
    <title>Publication Details</title>
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

        /* Control the image size */
        .logo {
            max-width: 75%;
            height: auto;
            display: block;
            margin: 0 auto;
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

        span {
            font-size: 1.2em;
            font-family: 'Oswald', sans-serif !important;
            text-align: left !important;
            padding: 0px 10px 0px 0px !important;

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
    </style>

    <div class="container">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-8 well">
                <form class="form-horizontal" action="page4.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
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

                        <!-- Form Name -->
                        <!-- Text input-->

                        <h4 style="text-align:center; font-weight: bold; color: #6739bb;">5. Summary of Publications *</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-success">
                                    <div class="panel-body">
                                        <span class="col-md-5 control-label" for="summary_journal_inter">Number of International Journal Papers</span>
                                        <div class="col-md-1">
                                            <input id="summary_journal_inter" name="summary_journal_inter" type="text" placeholder="" class="form-control input-md" required="" maxlength="3" value="<?php echo isset($summary_journal_inter) ? $summary_journal_inter : ''; ?>">
                                        </div>

                                        <span class="col-md-5 control-label" for="summary_journal">Number of National Journal Papers</span>
                                        <div class="col-md-1">
                                            <input id="summary_journal" name="summary_journal" type="text" placeholder="" class="form-control input-md" required="" maxlength="3" value="<?php echo isset($summary_journal) ? $summary_journal : ''; ?>">
                                        </div>

                                        <span class="col-md-5 control-label" for="summary_conf_inter">Number of International Conference Papers</span>
                                        <div class="col-md-1">
                                            <input id="summary_conf_inter" name="summary_conf_inter" type="text" placeholder="" class="form-control input-md" required="" maxlength="3" value="<?php echo isset($summary_conf_inter) ? $summary_conf_inter : ''; ?>">
                                        </div>

                                        <span class="col-md-5 control-label" for="summary_conf_national">Number of National Conference Papers</span>
                                        <div class="col-md-1">
                                            <input id="summary_conf_national" name="summary_conf_national" type="text" placeholder="" class="form-control input-md" required="" maxlength="3" value="<?php echo isset($summary_conf_national) ? $summary_conf_national : ''; ?>">
                                        </div>

                                        <span class="col-md-5 control-label" for="patent_publish">Number of Patent(s) [Filed, Published, Granted] </span>
                                        <div class="col-md-1">
                                            <input id="patent_publish" name="patent_publish" type="text" placeholder="" class="form-control input-md" required="" maxlength="3" value="<?php echo isset($patent_publish) ? $patent_publish : ''; ?>">
                                        </div>

                                        <span class="col-md-5 control-label" for="summary_book">Number of Book(s) </span>
                                        <div class="col-md-1">
                                            <input id="summary_book" name="summary_book" type="text" placeholder="" class="form-control input-md" required="" maxlength="3" value="<?php echo isset($summary_book) ? $summary_book : ''; ?>">
                                        </div>

                                        <span class="col-md-5 control-label" for="summary_book_chapter">Number of Book Chapter(s)</span>
                                        <div class="col-md-1">
                                            <input id="summary_book_chapter" name="summary_book_chapter" type="text" placeholder="" class="form-control input-md" required="" maxlength="3" value="<?php echo isset($summary_book_chapter) ? $summary_book_chapter : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <h4 style="text-align:center; font-weight: bold; color: #6739bb;">6. List of 10 Best Publications (Journal/Conference)</h4>
                        <div class="container-fluid table-responsive">
                            <div class="row">
                                <div class="panel panel-success">
                                    <div class="panel-heading">List of 10 Best Publications (Journal/Conference) &nbsp;&nbsp;&nbsp;
                                        <button type="button" class="btn btn-sm btn-danger" id="add_more_journal">Add Details</button>
                                    </div>
                                    <table class="table table-bordered">
                                        <tbody id="jour">
                                            <tr height="30px">
                                                <th class="col-md-1"> S. No.</th>
                                                <th class="col-md-2"> Author(s) </th>
                                                <th class="col-md-1"> Title</th>
                                                <th class="col-md-2"> Name of Journal/Conference </th>
                                                <th class="col-md-1"> Year, Vol., Page</th>
                                                <th class="col-md-1"> Impact Factor </th>
                                                <th class="col-md-1"> DOI</th>
                                                <th class="col-md-2"> Status</th>
                                            </tr>
                                            <tr height="60px">
                                                <td class="col-md-1">1</td>
                                                <td class="col-md-2">
                                                    <input id="author1" name="author[]" type="text" placeholder="Author" class="form-control input-md" value="<?php echo isset($retrieved_authors[0]) ? $retrieved_authors[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="title1" name="title[]" type="text" placeholder="Title" class="form-control input-md" value="<?php echo isset($retrieved_titles[0]) ? $retrieved_titles[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="journal1" name="journal[]" type="text" placeholder="Journal Name" class="form-control input-md" value="<?php echo isset($retrieved_journals[0]) ? $retrieved_journals[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="year1" name="year[]" type="text" placeholder="Year of publication" class="form-control input-md" value="<?php echo isset($retrieved_years[0]) ? $retrieved_years[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="impact1" name="impact[]" type="text" placeholder="Impact Factor" class="form-control input-md" value="<?php echo isset($retrieved_impacts[0]) ? $retrieved_impacts[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="doi1" name="doi[]" type="text" placeholder="DOI" class="form-control input-md" value="<?php echo isset($retrieved_dois[0]) ? $retrieved_dois[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <select id="status1" name="status[]" class="form-control input-md">
                                                        <option value="">Select</option>
                                                        <option value="published" <?php echo isset($retrieved_statuses[0]) && $retrieved_statuses[0] === 'published' ? 'selected' : ''; ?>>Published</option>
                                                        <option value="accepted" <?php echo isset($retrieved_statuses[0]) && $retrieved_statuses[0] === 'accepted' ? 'selected' : ''; ?>>Accepted</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr height="60px">
                                                <td class="col-md-1">2</td>
                                                <td class="col-md-2">
                                                    <input id="author2" name="author[]" type="text" placeholder="Author" class="form-control input-md" value="<?php echo isset($retrieved_authors[1]) ? $retrieved_authors[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="title2" name="title[]" type="text" placeholder="Title" class="form-control input-md" value="<?php echo isset($retrieved_titles[1]) ? $retrieved_titles[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="journal2" name="journal[]" type="text" placeholder="Journal Name" class="form-control input-md" value="<?php echo isset($retrieved_journals[1]) ? $retrieved_journals[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="year2" name="year[]" type="text" placeholder="Year of publication" class="form-control input-md" value="<?php echo isset($retrieved_years[1]) ? $retrieved_years[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="impact2" name="impact[]" type="text" placeholder="Impact Factor" class="form-control input-md" value="<?php echo isset($retrieved_impacts[1]) ? $retrieved_impacts[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="doi2" name="doi[]" type="text" placeholder="DOI" class="form-control input-md" value="<?php echo isset($retrieved_dois[1]) ? $retrieved_dois[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <select id="status2" name="status[]" class="form-control input-md">
                                                        <option value="">Select</option>
                                                        <option value="published" <?php echo isset($retrieved_statuses[1]) && $retrieved_statuses[1] === 'published' ? 'selected' : ''; ?>>Published</option>
                                                        <option value="accepted" <?php echo isset($retrieved_statuses[1]) && $retrieved_statuses[1] === 'accepted' ? 'selected' : ''; ?>>Accepted</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr height="60px">
                                                <td class="col-md-1">3</td>
                                                <td class="col-md-2">
                                                    <input id="author3" name="author[]" type="text" placeholder="Author" class="form-control input-md" value="<?php echo isset($retrieved_authors[2]) ? $retrieved_authors[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="title3" name="title[]" type="text" placeholder="Title" class="form-control input-md" value="<?php echo isset($retrieved_titles[2]) ? $retrieved_titles[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="journal3" name="journal[]" type="text" placeholder="Journal Name" class="form-control input-md" value="<?php echo isset($retrieved_journals[2]) ? $retrieved_journals[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="year3" name="year[]" type="text" placeholder="Year of publication" class="form-control input-md" value="<?php echo isset($retrieved_years[2]) ? $retrieved_years[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="impact3" name="impact[]" type="text" placeholder="Impact Factor" class="form-control input-md" value="<?php echo isset($retrieved_impacts[2]) ? $retrieved_impacts[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="doi3" name="doi[]" type="text" placeholder="DOI" class="form-control input-md" value="<?php echo isset($retrieved_dois[2]) ? $retrieved_dois[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <select id="status3" name="status[]" class="form-control input-md">
                                                        <option value="">Select</option>
                                                        <option value="published" <?php echo isset($retrieved_statuses[2]) && $retrieved_statuses[2] === 'published' ? 'selected' : ''; ?>>Published</option>
                                                        <option value="accepted" <?php echo isset($retrieved_statuses[2]) && $retrieved_statuses[2] === 'accepted' ? 'selected' : ''; ?>>Accepted</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr height="60px">
                                                <td class="col-md-1">4</td>
                                                <td class="col-md-2">
                                                    <input id="author4" name="author[]" type="text" placeholder="Author" class="form-control input-md" value="<?php echo isset($retrieved_authors[3]) ? $retrieved_authors[3] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="title4" name="title[]" type="text" placeholder="Title" class="form-control input-md" value="<?php echo isset($retrieved_titles[3]) ? $retrieved_titles[3] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="journal4" name="journal[]" type="text" placeholder="Journal Name" class="form-control input-md" value="<?php echo isset($retrieved_journals[3]) ? $retrieved_journals[3] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="year4" name="year[]" type="text" placeholder="Year of publication" class="form-control input-md" value="<?php echo isset($retrieved_years[3]) ? $retrieved_years[3] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="impact4" name="impact[]" type="text" placeholder="Impact Factor" class="form-control input-md" value="<?php echo isset($retrieved_impacts[3]) ? $retrieved_impacts[3] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="doi4" name="doi[]" type="text" placeholder="DOI" class="form-control input-md" value="<?php echo isset($retrieved_dois[3]) ? $retrieved_dois[3] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <select id="status4" name="status[]" class="form-control input-md">
                                                        <option value="">Select</option>
                                                        <option value="published" <?php echo isset($retrieved_statuses[3]) && $retrieved_statuses[3] === 'published' ? 'selected' : ''; ?>>Published</option>
                                                        <option value="accepted" <?php echo isset($retrieved_statuses[3]) && $retrieved_statuses[3] === 'accepted' ? 'selected' : ''; ?>>Accepted</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <?php
                                            // Loop to generate rows for each previously submitted publication
                                            for ($i = 4; $i < count($retrieved_authors); $i++) {
                                            ?>
                                                <tr height="60px">
                                                    <td class="col-md-1"><?php echo $i + 1; ?></td>
                                                    <td class="col-md-2">
                                                        <input id="author<?php echo $i + 1; ?>" name="author[]" type="text" placeholder="Author" class="form-control input-md" value="<?php echo isset($retrieved_authors[$i]) ? $retrieved_authors[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-2">
                                                        <input id="title<?php echo $i + 1; ?>" name="title[]" type="text" placeholder="Title" class="form-control input-md" value="<?php echo isset($retrieved_titles[$i]) ? $retrieved_titles[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-2">
                                                        <input id="journal<?php echo $i + 1; ?>" name="journal[]" type="text" placeholder="Journal Name" class="form-control input-md" value="<?php echo isset($retrieved_journals[$i]) ? $retrieved_journals[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-2">
                                                        <input id="year<?php echo $i + 1; ?>" name="year[]" type="text" placeholder="Year of publication" class="form-control input-md" value="<?php echo isset($retrieved_years[$i]) ? $retrieved_years[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-2">
                                                        <input id="impact<?php echo $i + 1; ?>" name="impact[]" type="text" placeholder="Impact Factor" class="form-control input-md" value="<?php echo isset($retrieved_impacts[$i]) ? $retrieved_impacts[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-2">
                                                        <input id="doi<?php echo $i + 1; ?>" name="doi[]" type="text" placeholder="DOI" class="form-control input-md" value="<?php echo isset($retrieved_dois[$i]) ? $retrieved_dois[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-2">
                                                        <select id="status<?php echo $i + 1; ?>" name="status[]" class="form-control input-md">
                                                            <option value="">Select</option>
                                                            <option value="published" <?php echo isset($retrieved_statuses[$i]) && $retrieved_statuses[$i] === 'published' ? 'selected' : ''; ?>>Published</option>
                                                            <option value="accepted" <?php echo isset($retrieved_statuses[$i]) && $retrieved_statuses[$i] === 'accepted' ? 'selected' : ''; ?>>Accepted</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Patent Text -->

                        <div class="container-fluid table-responsive">
                            <h4 style="text-align:center; font-weight: bold; color: #6739bb;">7. List of Patent(s), Book(s), Book Chapter(s)</h4>
                            <div class="row">
                                <div class="panel panel-success">
                                    <div class="panel-heading">(A) Patent(s)&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-sm btn-danger" id="add_more_patent">Add Details</button> </div>
                                    <table class="table table-bordered">
                                        <tbody id="patent">
                                            <tr height="30px">
                                                <th class="col-md-1"> S. No.</th>
                                                <th class="col-md-1"> Inventor(s) </th>
                                                <th class="col-md-2"> Title of Patent </th>
                                                <th class="col-md-1"> Country of Patent </th>
                                                <th class="col-md-1"> Patent Number</th>
                                                <th class="col-md-1"> Date of Filing</th>
                                                <th class="col-md-1"> Date of Published</th>
                                                <th class="col-md-1"> Status Filed/Published/Granted</th>
                                            </tr>
                                            <tr height="60px">
                                                <td class="col-md-1">1</td>
                                                <td class="col-md-1">
                                                    <input id="pauthor1" name="pauthor[]" type="text" placeholder="Author(s)" class="form-control input-md" required="" value="<?php echo isset($stored_pauthors[0]) ? $stored_pauthors[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="ptitle1" name="ptitle[]" type="text" placeholder="Title" class="form-control input-md" required="" value="<?php echo isset($stored_ptitles[0]) ? $stored_ptitles[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="p_country1" name="p_country[]" type="text" placeholder="Country" class="form-control input-md" required="" value="<?php echo isset($stored_p_countries[0]) ? $stored_p_countries[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="p_number1" name="p_number[]" type="text" placeholder="Patent Number" class="form-control input-md" required="" value="<?php echo isset($stored_p_numbers[0]) ? $stored_p_numbers[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="pyear_filed1" name="pyear_filed[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" value="<?php echo isset($stored_pyears_filed[0]) ? $stored_pyears_filed[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="pyear_published1" name="pyear_published[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" value="<?php echo isset($stored_pyears_published[0]) ? $stored_pyears_published[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="pyear_issued1" name="pyear_issued[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" value="<?php echo isset($stored_pyears_issued[0]) ? $stored_pyears_issued[0] : ''; ?>">
                                                </td>
                                            </tr>

                                            <tr height="60px">
                                                <td class="col-md-1">2</td>
                                                <td class="col-md-1">
                                                    <input id="pauthor2" name="pauthor[]" type="text" placeholder="Author(s)" class="form-control input-md" required="" value="<?php echo isset($stored_pauthors[1]) ? $stored_pauthors[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="ptitle2" name="ptitle[]" type="text" placeholder="Title" class="form-control input-md" required="" value="<?php echo isset($stored_ptitles[1]) ? $stored_ptitles[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="p_country2" name="p_country[]" type="text" placeholder="Country" class="form-control input-md" required="" value="<?php echo isset($stored_p_countries[1]) ? $stored_p_countries[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="p_number2" name="p_number[]" type="text" placeholder="Patent Number" class="form-control input-md" required="" value="<?php echo isset($stored_p_numbers[1]) ? $stored_p_numbers[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="pyear_filed2" name="pyear_filed[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" value="<?php echo isset($stored_pyears_filed[1]) ? $stored_pyears_filed[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="pyear_published2" name="pyear_published[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" value="<?php echo isset($stored_pyears_published[1]) ? $stored_pyears_published[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="pyear_issued2" name="pyear_issued[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" value="<?php echo isset($stored_pyears_issued[1]) ? $stored_pyears_issued[1] : ''; ?>">
                                                </td>
                                            </tr>
                                            <tr height="60px">
                                                <td class="col-md-1">3</td>
                                                <td class="col-md-1">
                                                    <input id="pauthor3" name="pauthor[]" type="text" placeholder="Author(s)" class="form-control input-md" required="" value="<?php echo isset($stored_pauthors[2]) ? $stored_pauthors[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="ptitle3" name="ptitle[]" type="text" placeholder="Title" class="form-control input-md" required="" value="<?php echo isset($stored_ptitles[2]) ? $stored_ptitles[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="p_country3" name="p_country[]" type="text" placeholder="Country" class="form-control input-md" required="" value="<?php echo isset($stored_p_countries[2]) ? $stored_p_countries[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="p_number3" name="p_number[]" type="text" placeholder="Patent Number" class="form-control input-md" required="" value="<?php echo isset($stored_p_numbers[2]) ? $stored_p_numbers[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="pyear_filed3" name="pyear_filed[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" value="<?php echo isset($stored_pyears_filed[2]) ? $stored_pyears_filed[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="pyear_published3" name="pyear_published[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" value="<?php echo isset($stored_pyears_published[2]) ? $stored_pyears_published[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="pyear_issued3" name="pyear_issued[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" value="<?php echo isset($stored_pyears_issued[2]) ? $stored_pyears_issued[2] : ''; ?>">
                                                </td>
                                            </tr>
                                            <?php
                                            // Loop to generate rows for each patent
                                            for ($i = 3; $i < count($stored_pauthors); $i++) {
                                            ?>
                                                <tr height="60px">
                                                    <td class="col-md-1"><?php echo $i + 1; ?></td>
                                                    <td class="col-md-1">
                                                        <input id="pauthor<?php echo $i + 1; ?>" name="pauthor[]" type="text" placeholder="Author(s)" class="form-control input-md" required="" value="<?php echo isset($stored_pauthors[$i]) ? $stored_pauthors[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-1">
                                                        <input id="ptitle<?php echo $i + 1; ?>" name="ptitle[]" type="text" placeholder="Title" class="form-control input-md" required="" value="<?php echo isset($stored_ptitles[$i]) ? $stored_ptitles[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-1">
                                                        <input id="p_country<?php echo $i + 1; ?>" name="p_country[]" type="text" placeholder="Country" class="form-control input-md" required="" value="<?php echo isset($stored_p_countries[$i]) ? $stored_p_countries[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-1">
                                                        <input id="p_number<?php echo $i + 1; ?>" name="p_number[]" type="text" placeholder="Patent Number" class="form-control input-md" required="" value="<?php echo isset($stored_p_numbers[$i]) ? $stored_p_numbers[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-1">
                                                        <input id="pyear_filed<?php echo $i + 1; ?>" name="pyear_filed[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" value="<?php echo isset($stored_pyears_filed[$i]) ? $stored_pyears_filed[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-1">
                                                        <input id="pyear_published<?php echo $i + 1; ?>" name="pyear_published[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" value="<?php echo isset($stored_pyears_published[$i]) ? $stored_pyears_published[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-1">
                                                        <input id="pyear_issued<?php echo $i + 1; ?>" name="pyear_issued[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" value="<?php echo isset($stored_pyears_issued[$i]) ? $stored_pyears_issued[$i] : ''; ?>">
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Book Text -->

                        <div class="container-fluid table-responsive">
                            <div class="row">
                                <div class="panel panel-success">
                                    <div class="panel-heading">(B) Book(s) &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-sm btn-danger" id="add_more_book">Add Details</button></div>

                                    <table class="table table-bordered">
                                        <tbody id="book">
                                            <tr height="30px">
                                                <th class="col-md-1"> S. No.</th>
                                                <th class="col-md-2"> Author(s)</th>
                                                <th class="col-md-2"> Title of the Book </th>
                                                <th class="col-md-2"> Year of Publication </th>
                                                <th class="col-md-2"> ISBN</th>
                                                <!-- <th class="col-md-2"> Status</th> -->
                                            </tr>
                                            <tr height="60px">
                                                <td class="col-md-1">1</td>
                                                <td class="col-md-4">
                                                    <input id="bauthor1" name="bauthor[]" type="text" placeholder="Author" class="form-control input-md" required="" value="<?php echo isset($stored_bauthors[0]) ? $stored_bauthors[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-3">
                                                    <input id="btitle1" name="btitle[]" type="text" placeholder="Title" class="form-control input-md" required="" value="<?php echo isset($stored_btitles[0]) ? $stored_btitles[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="byear1" name="byear[]" type="text" placeholder="Year of" class="form-control input-md" required="" value="<?php echo isset($stored_byears[0]) ? $stored_byears[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="bisbn1" name="bisbn[]" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo isset($stored_bisbns[0]) ? $stored_bisbns[0] : ''; ?>">
                                                </td>
                                            </tr>
                                            <tr height="60px">
                                                <td class="col-md-1">2</td>
                                                <td class="col-md-4">
                                                    <input id="bauthor2" name="bauthor[]" type="text" placeholder="Author" class="form-control input-md" required="" value="<?php echo isset($stored_bauthors[1]) ? $stored_bauthors[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-3">
                                                    <input id="btitle2" name="btitle[]" type="text" placeholder="Title" class="form-control input-md" required="" value="<?php echo isset($stored_btitles[1]) ? $stored_btitles[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="byear2" name="byear[]" type="text" placeholder="Year of" class="form-control input-md" required="" value="<?php echo isset($stored_byears[1]) ? $stored_byears[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="bisbn2" name="bisbn[]" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo isset($stored_bisbns[1]) ? $stored_bisbns[1] : ''; ?>">
                                                </td>
                                            </tr>
                                            <tr height="60px">
                                                <td class="col-md-1">3</td>
                                                <td class="col-md-4">
                                                    <input id="bauthor3" name="bauthor[]" type="text" placeholder="Author" class="form-control input-md" required="" value="<?php echo isset($stored_bauthors[2]) ? $stored_bauthors[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-3">
                                                    <input id="btitle3" name="btitle[]" type="text" placeholder="Title" class="form-control input-md" required="" value="<?php echo isset($stored_btitles[2]) ? $stored_btitles[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="byear3" name="byear[]" type="text" placeholder="Year of" class="form-control input-md" required="" value="<?php echo isset($stored_byears[2]) ? $stored_byears[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="bisbn3" name="bisbn[]" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo isset($stored_bisbns[2]) ? $stored_bisbns[2] : ''; ?>">
                                                </td>
                                            </tr>
                                            <?php
                                            // Loop to generate rows for each book
                                            for ($i = 3; $i < count($stored_bauthors); $i++) {
                                            ?>
                                                <tr height="60px">
                                                    <td class="col-md-1"><?php echo $i + 1; ?></td>
                                                    <td class="col-md-4">
                                                        <input id="bauthor<?php echo $i + 1; ?>" name="bauthor[]" type="text" placeholder="Author" class="form-control input-md" required="" value="<?php echo isset($stored_bauthors[$i]) ? $stored_bauthors[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-3">
                                                        <input id="btitle<?php echo $i + 1; ?>" name="btitle[]" type="text" placeholder="Title" class="form-control input-md" required="" value="<?php echo isset($stored_btitles[$i]) ? $stored_btitles[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-2">
                                                        <input id="byear<?php echo $i + 1; ?>" name="byear[]" type="text" placeholder="Year of" class="form-control input-md" required="" value="<?php echo isset($stored_byears[$i]) ? $stored_byears[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-2">
                                                        <input id="bisbn<?php echo $i + 1; ?>" name="bisbn[]" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo isset($stored_bisbns[$i]) ? $stored_bisbns[$i] : ''; ?>">
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <br>
                        <br>

                        <!-- Book chapter Text -->

                        <div class="container-fluid table-responsive">
                            <div class="row">
                                <div class="panel panel-success">
                                    <div class="panel-heading">(C) Book Chapter(s)&nbsp;&nbsp;&nbsp;
                                        <button type="button" class="btn btn-sm btn-danger" id="add_more_book_chapter">Add Details</button>
                                    </div>

                                    <table class="table table-bordered">
                                        <tbody id="book_chapter">
                                            <tr height="30px">
                                                <th class="col-md-1"> S. No.</th>
                                                <th class="col-md-2"> Author(s)</th>
                                                <th class="col-md-2"> Title of the Book Chapter(s) </th>
                                                <th class="col-md-2"> Year of Publication </th>
                                                <th class="col-md-2"> ISBN</th>
                                                <!-- <th class="col-md-2"> Status</th> -->
                                            </tr>
                                            <tr height="60px">
                                                <td class="col-md-1">1</td>
                                                <td class="col-md-4">
                                                    <input id="bc_author1" name="bc_author[]" type="text" placeholder="Author" class="form-control input-md" required="" value="<?php echo isset($stored_authors[0]) ? $stored_authors[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-3">
                                                    <input id="bc_title1" name="bc_title[]" type="text" placeholder="Title" class="form-control input-md" required="" value="<?php echo isset($stored_titles[0]) ? $stored_titles[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="bc_year1" name="bc_year[]" type="text" placeholder="Year of" class="form-control input-md" required="" value="<?php echo isset($stored_years[0]) ? $stored_years[0] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="bc_isbn1" name="bc_isbn[]" type="text" placeholder="ISBN" class="form-control input-md" required="" value="<?php echo isset($stored_isbns[0]) ? $stored_isbns[0] : ''; ?>">
                                                </td>
                                            </tr>
                                            <tr height="60px">
                                                <td class="col-md-1">2</td>
                                                <td class="col-md-4">
                                                    <input id="bc_author2" name="bc_author[]" type="text" placeholder="Author" class="form-control input-md" required="" value="<?php echo isset($stored_authors[1]) ? $stored_authors[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-3">
                                                    <input id="bc_title2" name="bc_title[]" type="text" placeholder="Title" class="form-control input-md" required="" value="<?php echo isset($stored_titles[1]) ? $stored_titles[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="bc_year2" name="bc_year[]" type="text" placeholder="Year of" class="form-control input-md" required="" value="<?php echo isset($stored_years[1]) ? $stored_years[1] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="bc_isbn2" name="bc_isbn[]" type="text" placeholder="ISBN" class="form-control input-md" required="" value="<?php echo isset($stored_isbns[1]) ? $stored_isbns[1] : ''; ?>">
                                                </td>
                                            </tr>
                                            <tr height="60px">
                                                <td class="col-md-1">3</td>
                                                <td class="col-md-4">
                                                    <input id="bc_author3" name="bc_author[]" type="text" placeholder="Author" class="form-control input-md" required="" value="<?php echo isset($stored_authors[2]) ? $stored_authors[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-3">
                                                    <input id="bc_title3" name="bc_title[]" type="text" placeholder="Title" class="form-control input-md" required="" value="<?php echo isset($stored_titles[2]) ? $stored_titles[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="bc_year3" name="bc_year[]" type="text" placeholder="Year of" class="form-control input-md" required="" value="<?php echo isset($stored_years[2]) ? $stored_years[2] : ''; ?>">
                                                </td>
                                                <td class="col-md-2">
                                                    <input id="bc_isbn3" name="bc_isbn[]" type="text" placeholder="ISBN" class="form-control input-md" required="" value="<?php echo isset($stored_isbns[2]) ? $stored_isbns[2] : ''; ?>">
                                                </td>
                                            </tr>
                                            <?php
                                            // Loop to generate rows for each book chapter
                                            for ($i = 3; $i < count($stored_authors); $i++) {
                                            ?>
                                                <tr height="60px">
                                                    <td class="col-md-1"><?php echo $i + 1; ?></td>
                                                    <td class="col-md-4">
                                                        <input id="bc_author<?php echo $i + 1; ?>" name="bc_author[]" type="text" placeholder="Author" class="form-control input-md" required="" value="<?php echo isset($stored_authors[$i]) ? $stored_authors[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-3">
                                                        <input id="bc_title<?php echo $i + 1; ?>" name="bc_title[]" type="text" placeholder="Title" class="form-control input-md" required="" value="<?php echo isset($stored_titles[$i]) ? $stored_titles[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-2">
                                                        <input id="bc_year<?php echo $i + 1; ?>" name="bc_year[]" type="text" placeholder="Year of" class="form-control input-md" required="" value="<?php echo isset($stored_years[$i]) ? $stored_years[$i] : ''; ?>">
                                                    </td>
                                                    <td class="col-md-2">
                                                        <input id="bc_isbn<?php echo $i + 1; ?>" name="bc_isbn[]" type="text" placeholder="ISBN" class="form-control input-md" required="" value="<?php echo isset($stored_isbns[$i]) ? $stored_isbns[$i] : ''; ?>">
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <br>
                        <br>

                        <?php
                        // Retrieve Google Scholar link
                        $google_link = isset($previous_google_link) ? htmlspecialchars($previous_google_link) : '';
                        ?>
                        <h4 style="text-align:center; font-weight: bold; color: #6739bb;">8. Google Scholar Link *</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">URL</div>
                                    <div class="panel-body">
                                        <span class="col-md-2 control-label" for="google_link">Google Scholar Link </span>
                                        <div class="col-md-10">
                                            <input id="google_link" name="google_link" type="text" placeholder="Google Scholar Link" class="form-control input-md" required="" value="<?php echo $google_link; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Button -->
                        <div class="form-group">

                            <div class="col-md-1">
                                <a href="welcome.php" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
                            </div>


                            <div class="col-md-12">
                                <!-- Save and Next button -->
                                <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right"">SAVE &amp; NEXT</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    
    <link rel=" stylesheet" href="stylesheet4.css" id="videoNoteFrameStyle">
                                    <!-- JavaScript -->
                                    <script src=" page4.js"></script>
</body>

</html>
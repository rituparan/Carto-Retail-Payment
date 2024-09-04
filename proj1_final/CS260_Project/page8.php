
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
        echo "User not found.";
        exit();
    }


    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
         header("location: page9.php");
    }

}
else {
  header("Location: login.php");
  exit();
}
?>
<html>
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Rel Info</title>
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
                <h3 style="text-align: center; color: #414002 !important;
                    font-weight: bold; font-size: 2.3em; margin-top: 3px;
                    font-family: 'Noto Sans', sans-serif;
                ">
                    भारतीय प्रौद्योगिकी संस्थान पटना
                </h3>
                <h3 style="
                    text-align: center; color: #414002 !important;
                    font-weight: bold; font-family: 'Oswald', sans-serif !important;
                    font-size: 2.2em; margin-top: 0px;
                ">
                    Indian Institute of Technology Patna
                </h3>
        	</div>
        </div>
    </div>
</div> 
<h3 style="color: #e10425; margin-bottom: 20px; font-weight: bold; text-align: center;font-family: 'Noto Serif', serif;" class="blink_me">Application for Faculty Position</h3>

<script type="text/javascript" src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/ckeditor/ckeditor.js"></script>

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

.Acae_data
{
  font-size: 1.1em;
  font-weight: bold;
  color: #414002;
}
p
{
  padding-top: 10px;
}
</style>

<a href='https://ofa.iiti.ac.in/facrec_che_2023_july_02/layout'></a>

<div class="container">
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 well">  
            <fieldset>
             
                 <legend>
                  <div class="row">
                    <div class="col-md-10">
                        <h4>Welcome : <font color="#025198"><strong><?php echo $firstname; ?> &nbsp;<?php echo $lastname; ?> </strong></font></h4>
                    </div>
                    <div class="col-md-2">
                      <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/facultypanel/logout" class="btn btn-sm btn-success  pull-right">Logout</a>
                    </div>
                  </div>
                
                
        </legend>
  
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="ci_csrf_token" value="" />


<div class="row">
      <div class="col-md-12">
        <div class="panel panel-success ">
        <div class="panel-heading">14. Significant research contribution and future plans *<small class="pull-right">(not more than 500 words)</small> <br /><small>(Please provide a Research Statement describing your research plans and one or two specific research projects to be conducted at IIT Indore in 2-3 years time frame)</small></div>
          <div class="panel-body">
            <textarea style="height:150px" placeholder="Significant research contribution and future plans" class="form-control input-md" name="research_statement" maxlength="3500" required=""><p><small>(Please provide a Research St<strong>atement des</strong>cribing khhkhkhkyour research plans and onhjgjgkkjke or two specific research projects to be conducted at IIT Indore in 2-3 years time frame</small></p>
</textarea>

          <script>
              // CKEDITOR.replace($_POST['conf_details']);
              CKEDITOR.replace('research_statement');
              
          </script>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="panel panel-success ">
      <div class="panel-heading">15. Significant teaching contribution and future plans * <small>(Please list UG/PG courses that you would like to develop and/or teach at IIT Indore)</small> <small class="pull-right"> (not more than 500 words)</small></div>
        <div class="panel-body">
          <textarea style="height:150px" placeholder="Significant teaching contribution and future plans" class="form-control input-md" name="teaching_statement" maxlength="3500" required=""><p><small>(Please provide a Research Statement describing your research plans and one or two specific research projects to be conducted at IIT Indore in 2-3 years time frame)</small></p>

<p><a href="[removed]void('Cut')"> </a><a href="[removed]void('Copy')"> </a><a href="[removed]void('Paste')"> </a><a href="[removed]void('Paste as plain text')"> </a><a href="[removed]void('Paste from Word')"> </a><a href="[removed]void('Undo')"> </a><a href="[removed]void('Redo')"> </a><a href="[removed]void('Spell Check As You Type')"> </a><a href="[removed]void('Link')"> </a><a href="[removed]void('Unlink')"> </a><a href="[removed]void('Anchor')"> </a><a href="[removed]void('Image')"> </a><a href="[removed]void('Table')"> </a><a href="[removed]void('Insert Horizontal Line')"> </a><a href="[removed]void('Insert Special Character')"> </a><a href="[removed]void('Maximize')"> </a><a href="[removed]void('Source')"> Source</a><a href="[removed]void('Bold')"> </a><a href="[removed]void('Italic')"> </a><a href="[removed]void('Strikethrough')"> </a><a href="[removed]void('Remove Format')"> </a><a href="[removed]void('Insert/Remove Numbered List')"> </a><a href="[removed]void('Insert/Remove Bulleted List')"> </a><a href="[removed]void('Decrease Indent')"> </a><a href="[removed]void('Increase Indent')"> </a><a href="[removed]void('Block Quote')"> </a><a href="[removed]void('Formatting Styles')">Styles</a><a href="[removed]void('Paragraph Format')">Normal</a><a href="[removed]void('About CKEditor 4')"> </a></p>
</textarea>

         <script>
             // CKEDITOR.replace($_POST['conf_details']);
             CKEDITOR.replace('teaching_statement');

          

             
         </script>
      </div>
    </div>
    </div>

<!-- <div class="col-md-12">
      <div class="panel panel-success ">
      <div class="panel-heading"> Awards and recognition <small class="pull-right">(not more 500 words)</small></div>
        <div class="panel-body">
          <textarea style="height:150px" placeholder="Any other relevant information you may like to furnish" class="form-control input-md" name="award_recg" maxlength="3500" required=""></textarea>
      </div>
    </div>
    </div> -->

<!-- 
<div class="col-md-12">
      <div class="panel panel-success ">
      <div class="panel-heading">27. Contribution to Continuing Education Programs  <small class="pull-right">(not more than 500 words)</small></div>
        <div class="panel-body">
          <textarea style="height:150px" placeholder="Contribution to Continuing Education Programs" class="form-control input-md" name="cep" maxlength="3500" ></textarea>
      </div>
    </div>
    </div> -->

<!-- <div class="col-md-12">
      <div class="panel panel-success ">
      <div class="panel-heading">28. Short-term Courses/Workshop/Seminars/Conference etc. organized  <small class="pull-right">(not more than 500 words)</small></div>
        <div class="panel-body">
          <textarea style="height:150px" placeholder="Short-term Courses/Workshop/Seminars etc. organized" class="form-control input-md" name="short_course" maxlength="3500"></textarea>
      </div>
    </div>
    </div> -->

<div class="col-md-12">
      <div class="panel panel-success ">
      <div class="panel-heading">16. Any other relevant information. <small class="pull-right">(not more than 500 words)</small></div>
        <div class="panel-body">
          <textarea style="height:150px" placeholder="Any other relevant information you may like to furnish" class="form-control input-md" name="rel_in" maxlength="3500"><p><small>(Please provide a Research Statement describing your research plans and one or two specific research projects to be conducted at IIT Indore in 2-3 years time frame)</small></p>

<p><a href="[removed]void('Cut')"> </a><a href="[removed]void('Copy')"> </a><a href="[removed]void('Paste')"> </a><a href="[removed]void('Paste as plain text')"> </a><a href="[removed]void('Paste from Word')"> </a><a href="[removed]void('Undo')"> </a><a href="[removed]void('Redo')"> </a><a href="[removed]void('Spell Check As You Type')"> </a><a href="[removed]void('Link')"> </a><a href="[removed]void('Unlink')"> </a><a href="[removed]void('Anchor')"> </a><a href="[removed]void('Image')"> </a><a href="[removed]void('Table')"> </a><a href="[removed]void('Insert Horizontal Line')"> </a><a href="[removed]void('Insert Special Character')"> </a><a href="[removed]void('Maximize')"> </a><a href="[removed]void('Source')"> Source</a><a href="[removed]void('Bold')"> </a><a href="[removed]void('Italic')"> </a><a href="[removed]void('Strikethrough')"> </a><a href="[removed]void('Remove Format')"> </a><a href="[removed]void('Insert/Remove Numbered List')"> </a><a href="[removed]void('Insert/Remove Bulleted List')"> </a><a href="[removed]void('Decrease Indent')"> </a><a href="[removed]void('Increase Indent')"> </a><a href="[removed]void('Block Quote')"> </a><a href="[removed]void('Formatting Styles')">Styles</a><a href="[removed]void('Paragraph Format')">Normal</a><a href="[removed]void('About CKEditor 4')"> </a></p>
</textarea>

         <script>
             // CKEDITOR.replace($_POST['conf_details']);
             CKEDITOR.replace('rel_in');

          

             
         </script>
      </div>
    </div>
    </div>

<!-- <div class="col-md-12">
      <div class="panel panel-success ">
      <div class="panel-heading">27. Highlighting how your work fits with  the overall research activities of the department/institute.<small class="pull-right">(Research plan 500 Words)</small></div>
        <div class="panel-body">
          <textarea style="height:150px" placeholder="Any other relevant information you may like to furnish" class="form-control input-md" name="highlights" maxlength="3000"></textarea>
      </div>
    </div>
    </div>

<div class="col-md-12">
      <div class="panel panel-success ">
      <div class="panel-heading">28. Courses you have taught earlier if any/ Your plan for new courses/ What kind of novel teaching methodologies you can include.<small class="pull-right">(Research plan 500 Words)</small></div>
        <div class="panel-body">
          <textarea style="height:150px" placeholder="Any other relevant information you may like to furnish" class="form-control input-md" name="novel_teching" maxlength="3000"></textarea>
      </div>
    </div>
    </div> -->


    <div class="col-md-12">
          <div class="panel panel-success ">
          <div class="panel-heading">17. Professional Service : Editorship/Reviewership <small class="pull-right">(not more than 500 words)</small></div>
            <div class="panel-body">
              <textarea style="height:150px" placeholder="Professional Service as Reviewer/Editor etc" class="form-control input-md" name="prof_serv" maxlength="3500"><p><small>(Please provide a Research Statement describing your research plans and one or two specific research projects to be conducted at IIT Indore in 2-3 years time frame)</small></p>

<p><a href="[removed]void('Cut')"> </a><a href="[removed]void('Copy')"> </a><a href="[removed]void('Paste')"> </a><a href="[removed]void('Paste as plain text')"> </a><a href="[removed]void('Paste from Word')"> </a><a href="[removed]void('Undo')"> </a><a href="[removed]void('Redo')"> </a><a href="[removed]void('Spell Check As You Type')"> </a><a href="[removed]void('Link')"> </a><a href="[removed]void('Unlink')"> </a><a href="[removed]void('Anchor')"> </a><a href="[removed]void('Image')"> </a><a href="[removed]void('Table')"> </a><a href="[removed]void('Insert Horizontal Line')"> </a><a href="[removed]void('Insert Special Character')"> </a><a href="[removed]void('Maximize')"> </a><a href="[removed]void('Source')"> Source</a><a href="[removed]void('Bold')"> </a><a href="[removed]void('Italic')"> </a><a href="[removed]void('Strikethrough')"> </a><a href="[removed]void('Remove Format')"> </a><a href="[removed]void('Insert/Remove Numbered List')"> </a><a href="[removed]void('Insert/Remove Bulleted List')"> </a><a href="[removed]void('Decrease Indent')"> </a><a href="[removed]void('Increase Indent')"> </a><a href="[removed]void('Block Quote')"> </a><a href="[removed]void('Formatting Styles')">Styles</a><a href="[removed]void('Paragraph Format')">Normal</a><a href="[removed]void('About CKEditor 4')"> </a></p>
</textarea>

              <script>
                  // CKEDITOR.replace($_POST['conf_details']);
                  CKEDITOR.replace('prof_serv');

               

                  
              </script>
            
          </div>
        </div>
        </div>

<div class="col-md-12">
  <div class="panel panel-success ">
  <div class="panel-heading">18. Detailed List of Journal Publications <br />(Including Sr. No., Author's Names, Paper Title, Volume, Issue, Year, Page Nos., Impact Factor (if any), DOI, Status[Published/Accepted] )</div>
    <div class="panel-body">


      <textarea style="height:15px!important" placeholder="Detailed List of Journal Publications" id="jour_details" class="form-control input-md" name="jour_details"><p><small>(Please provide a Research Statement describing your research plans and one or two specific research projects to be conducted at IIT Indore in 2-3 years time frame)</small></p>

<p><a href="[removed]void('Cut')"> </a><a href="[removed]void('Copy')"> </a><a href="[removed]void('Paste')"> </a><a href="[removed]void('Paste as plain text')"> </a><a href="[removed]void('Paste from Word')"> </a><a href="[removed]void('Undo')"> </a><a href="[removed]void('Redo')"> </a><a href="[removed]void('Spell Check As You Type')"> </a><a href="[removed]void('Link')"> </a><a href="[removed]void('Unlink')"> </a><a href="[removed]void('Anchor')"> </a><a href="[removed]void('Image')"> </a><a href="[removed]void('Table')"> </a><a href="[removed]void('Insert Horizontal Line')"> </a><a href="[removed]void('Insert Special Character')"> </a><a href="[removed]void('Maximize')"> </a><a href="[removed]void('Source')"> Source</a><a href="[removed]void('Bold')"> </a><a href="[removed]void('Italic')"> </a><a href="[removed]void('Strikethrough')"> </a><a href="[removed]void('Remove Format')"> </a><a href="[removed]void('Insert/Remove Numbered List')"> </a><a href="[removed]void('Insert/Remove Bulleted List')"> </a><a href="[removed]void('Decrease Indent')"> </a><a href="[removed]void('Increase Indent')"> </a><a href="[removed]void('Block Quote')"> </a><a href="[removed]void('Formatting Styles')">Styles</a><a href="[removed]void('Paragraph Format')">Normal</a><a href="[removed]void('About CKEditor 4')"> </a></p>
</textarea>

      <script>
          // CKEDITOR.replace($_POST['conf_details']);
          CKEDITOR.replace('jour_details');

       

          
      </script>
  </div>
</div>
</div>


<div class="col-md-12">
  <div class="panel panel-success ">
  <div class="panel-heading">19. Detailed List of Conference Publications<br />(Including Sr. No.,  Author's Names, Paper Title, Name of the conference, Year, Page Nos., DOI [If any] )</div>
    <div class="panel-body">
      <textarea style="height:150px" placeholder="Detailed List of Conference Publications" id="conf_details" class="form-control input-md" name="conf_details"><p><small>(Please provide a Research Statement describing your research plans and one or two specific research projects to be conducted at IIT Indore in 2-3 years time frame)</small></p>

<p><a href="[removed]void('Cut')"> </a><a href="[removed]void('Copy')"> </a><a href="[removed]void('Paste')"> </a><a href="[removed]void('Paste as plain text')"> </a><a href="[removed]void('Paste from Word')"> </a><a href="[removed]void('Undo')"> </a><a href="[removed]void('Redo')"> </a><a href="[removed]void('Spell Check As You Type')"> </a><a href="[removed]void('Link')"> </a><a href="[removed]void('Unlink')"> </a><a href="[removed]void('Anchor')"> </a><a href="[removed]void('Image')"> </a><a href="[removed]void('Table')"> </a><a href="[removed]void('Insert Horizontal Line')"> </a><a href="[removed]void('Insert Special Character')"> </a><a href="[removed]void('Maximize')"> </a><a href="[removed]void('Source')"> Source</a><a href="[removed]void('Bold')"> </a><a href="[removed]void('Italic')"> </a><a href="[removed]void('Strikethrough')"> </a><a href="[removed]void('Remove Format')"> </a><a href="[removed]void('Insert/Remove Numbered List')"> </a><a href="[removed]void('Insert/Remove Bulleted List')"> </a><a href="[removed]void('Decrease Indent')"> </a><a href="[removed]void('Increase Indent')"> </a><a href="[removed]void('Block Quote')"> </a><a href="[removed]void('Formatting Styles')">Styles</a><a href="[removed]void('Paragraph Format')">Normjnknmlkal</a><a href="[removed]void('About CKEditor 4')"> </a></p>
</textarea>

      <script>
          CKEDITOR.replace('conf_details');
          
      </script>

  </div>
</div>
</div>



 </div>      
 
<div class="form-group">
<div class="col-md-10">
  <!-- <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/acde" class="btn btn-primary pull-left">BACK</a> -->
  <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/thesis_course" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>


</div>

<div class="col-md-2">

   <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE & NEXT</button>

</div>


</div>
 

</div> 
            

</fieldset>
</form>



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
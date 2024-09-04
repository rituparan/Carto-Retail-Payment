
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
    
        $email = $row['EMAIL'];
        // $date_of_app = $row['APP_DATE'];
        $category = $row['CATEGORY'];
    } else {
        echo "User not found.";
        exit();
    }

    mysqli_free_result($result);




       
    $prev_name_arr = [];
    $prev_status_arr = [];

    $sql = "SELECT * FROM `membership` WHERE `APP_NO` = '$app_no';";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result_prev = $stmt->get_result();

    if ($result_prev->num_rows > 0) {
        // Loop through each row
        while ($row = $result_prev->fetch_assoc()) {
            // Store data into respective arrays
            $prev_name_arr[] = $row['nameOfSociety'];
            $prev_status_arr[] = $row['status'];
        }
    }
    $stmt->close(); // Close the statement after 
    mysqli_free_result($result_prev);



    $sql = "SELECT * FROM `professional_training` WHERE `APP_NO` = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $app_no );
    $stmt->execute();
    $result_prev = $stmt->get_result();
    
   
    $prev_trg_arr = [];
    $prev_porg_arr = [];
    $prev_pyear_arr = [];
    $prev_pduration_arr = [];

    // Check if there are any rows returned
    if ($result_prev->num_rows > 0) {
        // Loop through each row
        while ($row = $result_prev->fetch_assoc()) {
            // Store data into respective arrays
            $prev_trg_arr[] = $row['TypeOfTrainingReceived'];
            $prev_porg_arr[] = $row['Organisation'];
            $prev_pyear_arr[] = $row['Year'];
            $prev_pduration_arr[] = $row['Duration'];
        }
    }
    $stmt->close();
    mysqli_free_result($result_prev);

    $prev_award_name = [];
    $prev_a_body = [];
    $prev_a_year = [];

    
    $sql = "SELECT * FROM `awards_recognitions` WHERE `APP_NO` = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $app_no );
    $stmt->execute();
    $result_prev = $stmt->get_result();

    // Check if there are any rows returned
    if ($result_prev->num_rows > 0) {
        // Loop through each row
        while ( $row = $result_prev->fetch_assoc() ) {
            // Store data into respective arrays
            $prev_award_name[] = $row['AwardName'];
            $prev_a_body[] = $row['AwardingBody'];
            $prev_a_year[] = $row['YearOfAward'];
            
        }
    }
    $stmt->close();
    mysqli_free_result($result_prev);





    $sql = "SELECT * FROM `projectdetails` WHERE `APP_NO` = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $app_no );
    $stmt->execute();
    $result_prev = $stmt->get_result();
    
   
    $prev_agency = [];
    $prev_title = [];
    $prev_amount = [];
    $prev_period = [];
    $prev_role = [];
    $prev_status = [];

    // Check if there are any rows returned
    if ($result_prev->num_rows > 0) {
        // Loop through each row
        while ($row = $result_prev->fetch_assoc()) {
            // Store data into respective arrays
            $prev_agency[] = $row['SponsoringAgency'];
            $prev_title[] = $row['TitleOfProject'];
            $prev_amount[] = $row['SanctionedAmount'];
            $prev_period[] = $row['Period'];
            $prev_role[] = $row['Role'];
            $prev_status[] = $row['Status'];
        }
    }
    $stmt->close();
    mysqli_free_result($result_prev);


    
    $sql = "SELECT * FROM `consultancyprojects` WHERE `APP_NO` = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $app_no );
    $stmt->execute();
    $result_prev = $stmt->get_result();
    
   
    $prev_org_c = [];
    $prev_title_c  = [];
    $prev_amount_c  = [];
    $prev_period_c  = [];
    $prev_role_c  = [];
    $prev_status_c  = [];

    // Check if there are any rows returned
    if ($result_prev->num_rows > 0) {
        // Loop through each row
        while ($row = $result_prev->fetch_assoc()) {
            // Store data into respective arrays
            $prev_org_c[] = $row['Organization'];
            $prev_title_c[] = $row['TitleOfProject'];
            $prev_amount_c[] = $row['AmountGranted'];
            $prev_period_c[] = $row['Period'];
            $prev_role_c[] = $row['Role'];
            $prev_status_c[] = $row['Status'];
        }
    }
    $stmt->close();
    mysqli_free_result($result_prev);

















   


    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $name_arr = $_POST['mname'];
        $status_arr = $_POST['mstatus'];

        // Prepare and bind SQL statement for books
        $sql = "INSERT INTO `membership` (APP_NO ,  SNo , nameOfSociety , status ) VALUES (?, ?, ? , ?) 
        ON DUPLICATE KEY UPDATE 
        APP_NO = VALUES(APP_NO), 
                SNo = VALUES(SNo), 
                nameOfSociety = VALUES(nameOfSociety), 
                status = VALUES(status)";
        $id = 1;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiss" , $app_no , $id , $name , $status );

        for ($i = 0; $i < count($name_arr); $i++) {

            $name = $name_arr[$i];
            $status = $status_arr[$i];
        
            // Execute the statement for books
            if (!$stmt->execute()) {
                // Error occurred while inserting or updating data for books
                echo "Error: " . $sql . "<br>" . $conn->error;
                break; // Exit loop if an error occurs
            }
            $id++;
        }
        $stmt->close(); // Close the statement after 
        

        $trg_arr = $_POST['porg'];

        if(isset($_POST['awardmemb']) ) {

               
                $porg_arr = $_POST['porg'];
                $pyear_arr = $_POST['pyear'];
                $pduration_arr = $_POST['pduration'];


                // Prepare and bind SQL statement for books
                $sql = "INSERT INTO `professional_training` (APP_NO ,  SNo , TypeOfTrainingReceived , Organisation , Year , Duration  ) VALUES (?, ?, ? , ? , ? , ? ) 
                ON DUPLICATE KEY UPDATE 
                APP_NO = VALUES(APP_NO), 
                        SNo = VALUES(SNo), 
                        TypeOfTrainingReceived = VALUES(TypeOfTrainingReceived), 
                        Organisation = VALUES(Organisation),
                        Year = VALUES(Year), 
                        Duration = VALUES(Duration)";
                $id = 1;
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iissss" , $app_no , $id , $trg , $porg , $year , $duration );

                for ($i = 0; $i < count($trg_arr); $i++) {

                    $trg = $trg_arr[$i];
                    $porg = $porg_arr[$i];
                    $year = $pyear_arr[$i];
                    $duration = $pduration_arr[$i];
                
                    // Execute the statement for books
                    if (!$stmt->execute()) {
                        // Error occurred while inserting or updating data for books
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        break; // Exit loop if an error occurs
                    }
                    $id++;
                }
                $stmt->close(); // Close the statement after execution

            }


        
        if( isset($_POST['awardmemb'])  ) {
                $AwardName_arr = $_POST['awardmemb'];
                $AwardingBody_arr = $_POST['abody'];
                $YearOfAward_arr = $_POST['ayear'];
            
                $sql = "INSERT INTO `awards_recognitions` (APP_NO ,  SNo , AwardName , AwardingBody , YearOfAward ) VALUES (?, ?, ? , ? , ? ) 
                ON DUPLICATE KEY UPDATE 
                APP_NO = VALUES(APP_NO), 
                        SNo = VALUES(SNo), 
                        AwardName = VALUES(AwardName), 
                        AwardingBody = VALUES(AwardingBody),
                        YearOfAward = VALUES(YearOfAward)";
                $id = 1;
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iisss" , $app_no , $id , $AwardName , $AwardingBody , $YearOfAward  );

                for ($i = 0; $i < count($AwardName_arr); $i++) {

                    $AwardName = $AwardName_arr[$i];
                    $AwardingBody = $AwardingBody_arr[$i];
                    $YearOfAward = $YearOfAward_arr[$i];
                
                    // Execute the statement for books
                    if (!$stmt->execute()) {
                        // Error occurred while inserting or updating data for books
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        break; // Exit loop if an error occurs
                    }
                    $id++;
                }
                $stmt->close(); // Close the statement after execution
        }   


       
        if( isset($_POST['stitle'])  ) {

                $agency_arr = $_POST['agency'];
                $title = $_POST['stitle'];
                $amount_arr = $_POST['samount'];
                $period_arr = $_POST['speriod'];
                $role_arr = $_POST['s_role'];
                $status_arr = $_POST['s_status'];


                // Prepare and bind SQL statement for books
                $sql = "INSERT INTO `projectdetails` (APP_NO ,  SNo , SponsoringAgency , TitleOfProject , SanctionedAmount , Period , Role , Status  ) VALUES (?, ?, ? , ? , ? , ? , ? , ?  ) 
                ON DUPLICATE KEY UPDATE 
                APP_NO = VALUES(APP_NO), 
                        SNo = VALUES(SNo), 
                        SponsoringAgency = VALUES(SponsoringAgency), 
                        TitleOfProject = VALUES(TitleOfProject),
                        SanctionedAmount = VALUES(SanctionedAmount),
                        Period = VALUES(Period),
                        Role = VALUES(Role),
                        Status = VALUES(Status)
                        ";
                $id = 1;
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iissssss" , $app_no , $id , $sanc_agency , $top , $sanc_amt , $period , $role ,  $status );

                for ($i = 0; $i < count($agency_arr); $i++) {

                    $sanc_agency = $agency_arr[$i];
                    $top = $title[$i];
                    $sanc_amt = $amount_arr[$i];
                    $period = $period_arr[$i];
                    $role = $role_arr[$i];
                    $status = $status_arr[$i];
                
                    // Execute the statement for books
                    if (!$stmt->execute()) {
                        // Error occurred while inserting or updating data for books
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        break; // Exit loop if an error occurs
                    }
                    $id++;
                }
                $stmt->close(); // Close the statement after execution

        }


        
        if(  isset($_POST['ctitle']) ) {
            $org_arr_c = $_POST['c_org'];
                $title_arr_c = $_POST['ctitle'];
                $amount_arr_c = $_POST['camount'];
                $period_arr_c = $_POST['cperiod'];
                $role_arr_c = $_POST['c_role'];
                $status_arr_c = $_POST['c_status'];


                // Prepare and bind SQL statement for books
                $sql = "INSERT INTO `consultancyprojects` (APP_NO ,  SNo , Organization , TitleOfProject , AmountGranted , Period , Role , Status  ) VALUES (?, ?, ? , ? , ? , ? , ? , ?  ) 
                ON DUPLICATE KEY UPDATE 
                APP_NO = VALUES(APP_NO), 
                        SNo = VALUES(SNo), 
                        Organization = VALUES(Organization), 
                        TitleOfProject = VALUES(TitleOfProject),
                        AmountGranted = VALUES(AmountGranted),
                        Period = VALUES(Period),
                        Role = VALUES(Role),
                        Status = VALUES(Status)
                        ";
                $id = 1;
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iissssss" , $app_no , $id , $org , $top , $amt , $period , $role ,  $status );

                for ($i = 0; $i < count($org_arr_c); $i++) {

                    $org = $org_arr_c[$i];
                    $top = $title_arr_c[$i];
                    $amt = $amount_arr_c[$i];
                    $period = $period_arr_c[$i];
                    $role = $role_arr_c[$i];
                    $status = $status_arr_c[$i];
                
                    // Execute the statement for books
                    if (!$stmt->execute()) {
                        // Error occurred while inserting or updating data for books
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        break; // Exit loop if an error occurs
                    }
                    $id++;
                }
                $stmt->close(); // Close the statement after execution
        }

        
        header("Location: page7.php");


    }


  

  









    




}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Academic Industrial Experience</title>
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

        		<!--  <img src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/IITIndorelogo.png" alt="logo1" class="img-responsive" style="padding-top: 5px; height: 120px; float: left;"> -->

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
  padding: 0 !important;
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
var counter_s_proj=1;
var counter_award=1;
var counter_prof_trg=1;
var counter_membership=1;
var counter_consultancy=1;

  $(document).ready(function(){
  

$("#add_more_s_proj").click(function(){
        create_tr();
        create_serial('s_proj');
        create_input('agency[]', 'Sponsoring Agency','agency'+counter_s_proj, 's_proj',counter_s_proj, 's_proj');
        create_input('stitle[]', 'Title of Project', 'stitle'+counter_s_proj,'s_proj',counter_s_proj, 's_proj');
        create_input('samount[]', 'Amount of grant', 'samount'+counter_s_proj,'s_proj',counter_s_proj, 's_proj');
        create_input('speriod[]', 'Period', 'speriod'+counter_s_proj,'s_proj',counter_s_proj, 's_proj');
        create_input('s_role[]', 'Role', 's_role'+counter_s_proj,'s_proj',counter_s_proj, 's_proj',false,true);
        create_input('s_status[]', 'Status', 's_status'+counter_s_proj,'s_proj',counter_s_proj, 's_proj',true);
        counter_s_proj++;
        return false;
  });
  
  $("#add_more_award").click(function(){
          create_tr();
          create_serial('award');
          create_input('award_nature[]', 'Name of Award','award_nature'+counter_award, 'award',counter_award, 'award');
          create_input('award_org[]', 'Granting body/Organization', 'award_org'+counter_award,'award',counter_award, 'award');
          create_input('award_year[]', 'Year', 'award_year'+counter_award,'award',counter_award, 'award',true);
          counter_award++;
          return false;
    });

  $("#add_more_prog_trg").click(function(){
          create_tr();
          create_serial('prof_trg');
          create_input('trg[]', 'Taining Received','trg'+counter_prof_trg, 'prof_trg',counter_prof_trg, 'prof_trg');
          create_input('porg[]', 'Organization', 'porg'+counter_prof_trg,'prof_trg',counter_prof_trg, 'prof_trg');
          create_input('pyear[]', 'Year', 'pyear'+counter_prof_trg,'prof_trg',counter_prof_trg, 'prof_trg');
          create_input('pduration[]', 'Duration', 'pduration'+counter_prof_trg,'prof_trg',counter_prof_trg, 'prof_trg',true);
          counter_prof_trg++;
          return false;
    });

  $("#add_membership").click(function(){
          create_tr();
          create_serial('membership');
          create_input('mname[]', 'Name of the Professional Society','mname'+counter_membership, 'membership',counter_membership, 'membership');
          create_input('mstatus[]', 'Membership Status (Lifetime/Annual)', 'mstatus'+counter_membership,'membership',counter_membership, 'membership',true);
          counter_membership++;
          return false;
    });

  $("#add_consultancy").click(function(){
          create_tr();
          create_serial('consultancy');
          create_input('c_org[]', 'Organization','c_org'+counter_consultancy, 'consultancy',counter_consultancy, 'consultancy');
          create_input('ctitle[]', 'Title of Project','ctitle'+counter_consultancy, 'consultancy',counter_consultancy, 'consultancy');
          create_input('camount[]', 'Amount of grant','camount'+counter_consultancy, 'consultancy',counter_consultancy, 'consultancy');
          create_input('cperiod[]', 'Period','cperiod'+counter_consultancy, 'consultancy',counter_consultancy, 'consultancy');

          create_input('c_role[]', 'Role', 'c_role'+counter_consultancy,'consultancy',counter_consultancy, 'consultancy',false,true);
          create_input('c_status[]', 'Status', 'c_status'+counter_consultancy,'consultancy',counter_consultancy, 'consultancy',true);
          counter_consultancy++;
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
  function deleterow(e){
    var rowid=$(e).attr("data-id");
    var textbox=$("#id"+rowid).val();
    $.ajax({
            type: "POST",
            url  : "https://ofa.iiti.ac.in/facrec_che_2023_july_02/Acd_ind/deleterow/",
            data: {id: textbox},
                success: function(result) { 
                if(result.status=="OK"){
                $('.row_'+rowid).remove();
                            //remove_row('award',rowid, 'award');
                }
                   
                }});

   
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
  function remove_row(remove_name, n, tbody_id)
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




<a href='https://ofa.iiti.ac.in/facrec_che_2023_july_02/layout'></a>

<div class="container">
  
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-8 well">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <fieldset>
              <input type="hidden" name="ci_csrf_token" value="" />
             
                 <legend>
                  <div class="row">
                    <div class="col-md-10">
                        <h4>Welcome : <font color="#025198"><strong><?php echo $firstname; ?> &nbsp;<?php echo $lastname; ?> </strong></font></h4>
                    </div>
                    <div class="col-md-2">
                      <a href="login.php" class="btn btn-sm btn-success  pull-right">Logout</a>
                    </div>
                  </div>
                
                
        </legend>



<!-- Membership of Professional Societies -->

<h4 style="text-align:center; font-weight: bold; color: #6739bb;">9. Membership of Professional Societies </h4>

<div class="row">
<div class="col-md-12">
<div class="panel panel-success">
<div class="panel-heading">Fill the Details  &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_membership">Add Details</button></div>
  <div class="panel-body">

        <table class="table table-bordered">
            <tbody id="membership">
            
            <tr height="30px">
              <th class="col-md-1"> S. No.</th>
              <th class="col-md-3"> Name of the Professional Society </th>
              <th class="col-md-3"> Membership Status (Lifetime/Annual)</th>
              
            </tr>



            <?php 
                for($i = 0; $i < count($prev_name_arr); $i++ ) {
                    
                    ?>
                <tr height="60px" class="row_1">
                        
                <td class="col-md-1"> 
                <?php echo $i + 1; ?>        </td>
                <td class="col-md-2"> 
                <input id="id1" name="id[]" type="hidden" value="<?php echo $id + 1; ?>"  class="form-control input-md" required=""> 
                    <input id="mname1" name="mname[]" type="text" value="<?php echo $prev_name_arr[$i]?>"  placeholder="Name of the Professional Society" class="form-control input-md" required=""> 
                </td>
                <td class="col-md-2"> 
                <input id="mstatus1" name="mstatus[]" type="text"  value="<?php echo $prev_status_arr[$i]?>"  placeholder="Membership Status (Lifetime/Annual)" class="form-control input-md" required=""> 
                </td>
                
            
            </tr>

            <?php } ?>
                        
           
                      </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Professional Training -->

<h4 style="text-align:center; font-weight: bold; color: #6739bb;">10. Professional Training </h4>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
    <div class="panel-heading">Fill the Details  &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_prog_trg">Add Details</button></div>
      <div class="panel-body">

            <table class="table table-bordered">
                <tbody id="prof_trg">
                
                <tr height="30px">
                  <th class="col-md-1"> S. No.</th>
                  <th class="col-md-3"> Type of Training Received </th>
                  <th class="col-md-3"> Organisation</th>
                  <th class="col-md-2"> Year</th>
                  <th class="col-md-2"> Duration (in years & months)</th>
                  
                </tr>

                <?php
                    for($i = 0; $i < count($prev_porg_arr); $i++ ) { ?>
                                                
                    <tr height="60px" class="row_1">
                                
                    <td class="col-md-1"> 
                    <?php echo $i + 1 ; ?>           </td>
                    <td class="col-md-2"> 
                    <input id="id1" name="id[]" type="hidden" value="<?php echo $i + 1 ; ?>"  class="form-control input-md" required=""> 
                        <input id="trg1" name="trg[]" type="text" value="<?php echo $prev_trg_arr[$i]; ?>"   placeholder="Sponsoring Agency" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-2"> 
                    <input id="porg1" name="porg[]" type="text" value="<?php echo $prev_trg_arr[$i]; ?>"   placeholder="Title of Project" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-2"> 
                    <input id="pyear1" name="pyear[]" type="text" value="<?php echo $prev_trg_arr[$i]; ?>"   placeholder="Amount of grant" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-2"> 
                    <input id="pduration1" name="pduration[]" type="text" value="<?php echo $prev_trg_arr[$i]; ?>"   placeholder="Amount of grant" class="form-control input-md" required=""> 
                    </td>
                
                </tr>
                    <?php } ?>
   

                                
               
                              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<!-- Award(s) and Recognition(s) -->

<h4 style="text-align:center; font-weight: bold; color: #6739bb;">11. Award(s) and Recognition(s)</h4>
<div class="row">
<div class="col-md-12">
<div class="panel panel-success">
<div class="panel-heading">Fill the Details  &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_award">Add Details</button></div>
  <div class="panel-body">

        <table class="table table-bordered">
            <tbody id="award">
            
            <tr height="30px">
              <th class="col-md-1"> S. No.</th>
              <th class="col-md-3"> Name of Award </th>
              <th class="col-md-3"> Awarded By</th>
              <th class="col-md-2"> Year</th>

              
            </tr>
                        
                <?php 
                for($i = 0; $i < count($prev_a_body); $i++ ) { ?>

                <tr height="60px" class="row_1">
                                        
                    <td class="col-md-1"> 
                    <?php echo $i + 1 ; ?></td>
                    <td class="col-md-2"> 
                    <input id="id1" name="id[]" type="hidden" value="<?php echo $i + 1 ; ?>"  class="form-control input-md" required=""> 
                        <input id="trg1" name="awardmemb[]" type="text" value="<?php echo $prev_award_name[$i]; ?>"   placeholder="Sponsoring Agency" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-2"> 
                    <input id="porg1" name="abody[]" type="text" value="<?php echo $prev_a_body[$i]; ?>"   placeholder="Title of Project" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-2"> 
                    <input id="pyear1" name="ayear[]" type="text" value="<?php echo $prev_a_year[$i]; ?>"   placeholder="Amount of grant" class="form-control input-md" required=""> 
                    </td>
                
                </tr>

                    <?php } ?>


                      </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<h4 style="text-align:center; font-weight: bold; color: #6739bb;">12. Sponsored Projects/ Consultancy Details</h4>
<!-- sponsored projects  -->
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-success">
      <div class="panel-heading">(A) Sponsored Projects &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_s_proj">Add Details</button></div>
        <div class="panel-body">

              <table class="table table-bordered">
                  <tbody id="s_proj">
                  
                  <tr height="30px">
                    <th class="col-md-1"> S. No.</th>
                    <th class="col-md-2"> Sponsoring Agency </th>
                    <th class="col-md-2"> Title of Project</th>
                    <th class="col-md-2"> Sanctioned Amount (&#8377) </th>
                    <th class="col-md-1"> Period</th>
                    <th class="col-md-2"> Role </th>
                    <th class="col-md-2"> Status (Completed/On-going)</th>
                    
                  </tr>


                                    
                 
                    <?php 
                    for($i = 0 ; $i < count($prev_agency); $i++ ) { ?>
                    <tr height="60px">
                                
                    <td class="col-md-1"> 
                            <?php echo $i + 1 ; ?>           </td>
                    <td class="col-md-2"> 
                    
                        <input id="agency1" name="agency[]" type="text" value="<?php echo $prev_agency[$i] ?>"  placeholder="Sponsoring Agency" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-2"> 
                    <input id="stitle1" name="stitle[]" type="text" value="<?php echo $prev_title[$i] ?>"    placeholder="Title of Project" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-2"> 
                    <input id="samount1" name="samount[]" type="text" value="<?php echo $prev_amount[$i] ?>"    placeholder="Amount of grant" class="form-control input-md" required=""> 
                    </td>
                    <td class="col-md-1"> 
                    <input id="speriod1" name="speriod[]" type="text" value="<?php echo $prev_period[$i] ?>"    placeholder="Period" class="form-control input-md" required=""> 
                    </td>

                    <td class="col-md-2"> 
                    <select id="s_role" name="s_role[]" class="form-control input-md" required="">
                        <option value="">Select</option>
                        <option selected='selected' value="<?php echo $prev_role[$i]; ?>">Principal Investigator</option>
                        <option  value="Co-investigator">Co-investigator</option>
                    </select>
                    </td>

                    <td class="col-md-2"> 
                    <input id="s_status1" name="s_status[]" type="text" value="<?php echo $prev_status[$i] ?>" placeholder="Status" class="form-control input-md" required=""> 
                    </td>
                    
                
                </tr>
                        <?php } ?>

                                    
                

                                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

     <!-- Consultancy Details -->
             <div class="row">
                 <div class="col-md-12">
                   <div class="panel panel-success">
                   <div class="panel-heading">(B) Consultancy Projects  &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_consultancy">Add Details</button></div>
                     <div class="panel-body">

                           <table class="table table-bordered">
                               <tbody id="consultancy">
                               
                               <tr height="30px">
                                 <th class="col-md-1"> S. No.</th>
                                 <th class="col-md-3"> Organization </th>
                                 <th class="col-md-2"> Title of Project</th>
                                 <th class="col-md-2"> Amount of Grant</th>
                                 <th class="col-md-1"> Period</th>
                                 <th class="col-md-2"> Role</th>
                                 <th class="col-md-2"> Status</th>
                                 
                               </tr>


                                                              
                                
                                    <?php 
                                    for($i = 0; $i < count($prev_org_c); $i++ ) { ?>

                                    <tr height="60px" class="row_1">
                                                            
                                    <td class="col-md-1"> 
                                    <?php echo $i + 1; ?>                    </td>
                                    <td class="col-md-2"> 
                                    <input id="id1" name="id[]" type="hidden" value="<?php echo $i + 1 ; ?>"  class="form-control input-md" required=""> 

                                        <input id="c_org1" name="c_org[]" type="text" value="<?php echo $prev_org_c[$i]; ?>"  placeholder="Sponsoring Agency" class="form-control input-md" required=""> 
                                    </td>
                                    <td class="col-md-2"> 
                                    <input id="ctitle1" name="ctitle[]" type="text" value="<?php echo $prev_title_c[$i]; ?>"   placeholder="Title of Project" class="form-control input-md" required=""> 
                                    </td>
                                    <td class="col-md-2"> 
                                    <input id="camount1" name="camount[]" type="text" value="<?php echo $prev_amount_c[$i]; ?>"  placeholder="Title of Project" class="form-control input-md" required=""> 
                                    </td>
                                    <td class="col-md-1"> 
                                    <input id="cperiod1" name="cperiod[]" type="text" value="<?php echo $prev_period_c[$i]; ?>"  placeholder="Title of Project" class="form-control input-md" required=""> 
                                    </td>

                                    <td class="col-md-2"> 
                                    <select id="c_role" name="c_role[]" class="form-control input-md" required="">
                                        <option value="<?php echo $prev_role_c[$i]; ?>"  >Select</option>
                                        <option  value="Principal Investigator">Principal Investigator</option>
                                        <option selected='selected' value="Co-investigator">Co-investigator</option>
                                    </select>
                                    </td>

                                    <td class="col-md-2"> 
                                    <input id="c_status1" name="c_status[]" type="text" value="<?php echo $prev_status_c[$i]; ?>"  placeholder="Status" class="form-control input-md" required=""> 
                                    </td>
                                    
                                
                                </tr>
                                

                                <?php } ?>
                              
                             
                                                            </tbody>
                           </table>
                         </div>
                       </div>
                     </div>

                   </div>
 
    


      




            <!-- Button -->

            <div class="form-group">
              
              <div class="col-md-1">
                <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/publish" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
              </div>

              <div class="col-md-11">
                <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE & NEXT</button>
                
              </div>
              
            </div>

            <!-- <div class="form-group">
              <label class="col-md-5 control-label" for="submit"></label>
              <div class="col-md-4">
                <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-primary">SUBMIT</button>

              </div>
            </div> -->

            </fieldset>
            </form>
            
            

        </div>
    </div>
</div>

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
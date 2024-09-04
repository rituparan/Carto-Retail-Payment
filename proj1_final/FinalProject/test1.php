<?php

session_start();

// if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

$firstname = $_SESSION['first_name'];
$lastname = $_SESSION['last_name'];
$app_no = $_SESSION['application_number'];

$server = "localhost";
$username = "root";
$password = "";
$database = "faculty";
// echo "EE";
// Create connection
$conn = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


// echo $app_no;

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$stylesheet = file_get_contents('style.css');
$html = file_get_contents('pdf.html');

$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

// $html = "<table>";


$html = '   
          
            
    ';

$sql = "Select * from applicationdetails where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {
    $html .= '
        <div>
  
                 Advertisement Number : ' . $data["AdvertisementNumber"] . '<br>
                 Date Of Application : ' . $data["DateOfApplication"] . '<br>
                 Post Applied For : ' . $data["PostAppliedFor"] . '<br>
                 Application Number : ' . $data["APP_NO"] . '<br>
                 Department School : ' . $data["DepartmentSchool"] . '<br>
             
  
         </div>
          ';
    // $count++;
  }


}
// else echo "empty";

$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);




$html = '<span class="label">1. Personal Details</span>

<table class="tab">
  <tr style="background-color:#f1f1f1;">
    <td><strong class="tr_title">First Name</strong></td>
    <td><strong class="tr_title">Middle Name</strong></td>
    <td><strong class="tr_title">Last Name</strong></td>
  </tr>
     
</table>

                  
   ';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);




$html = '   
                  <table class="tab">
            
    ';

$sql = "Select * from personaldetails where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {
    $html .= '

              <tr>
                <td width="33%">' . $data["FirstName"] . '</td>
                <td width="33%">' . $data["MiddleName"] . '</td>
                <td width="33%">' . $data["LastName"] . '</td>
      
              </tr>
                
         
          ';
    // $count++;
  }

  $html .=  '                  </table>
       ';
}
// else echo "empty";

$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);






$html = '
<br />
	

<table class="tab">
  <tr style="background-color:#f1f1f1;">
    <td width = "20%" ><strong class="tr_title">Date of Birth</strong></td>
   
    <td><strong class="tr_title">Gender</strong></td>
    <td><strong class="tr_title">Marital Status</strong></td>
    <td><strong class="tr_title">Category</strong></td>
    <td><strong class="tr_title">Nationality</strong></td>
    <td><strong class="tr_title">ID Proof</strong></td>

  </tr>
      
</table>

                  
   ';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);


$html = '   
                  <table class="tab">
            
    ';

$sql = "Select * from personaldetails where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {
    $html .= '

              <tr>
                <td width="20%">' . $data["DOB"] . '</td>
                <td width="20%">' . $data["Gender"] . '</td>
                <td width="20%">' . $data["MaritalStatus"] . '</td>
                <td width="15%">' . $data["Category"] . '</td>
                <td width="15%">' . $data["Nationality"] . '</td>
                <td width="15%">' . $data["IDProof"] . '</td>
      
              </tr>
                
         
          ';
    // $count++;
  }

  $html .=  '                  </table>
       ';
}
// else echo "empty";

$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);




$html = '
<br />
	

<table class="tab">
<tr style="background-color:#f1f1f1;">
  <td width="50%"><strong class="tr_title">Current Address </strong></td>
  <td width="50%"><strong class="tr_title">Permanent Address </strong></td>
  
</tr>

</table>
                  
   ';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

$html = '   
                  <table class="tab">
            
    ';

$sql = "Select * from personaldetails where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {
    $html .= '

              <tr>
                <td width="20%">' . $data["CorrAddress"] . '</td>
                <td width="20%">' . $data["PermanentAddress"] . '</td>
               
              </tr>
                
         
          ';
    // $count++;
  }

  $html .=  '                  </table>
       ';
}
// else echo "empty";

$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);


$sql = "Select * from personaldetails where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

// echo $row['mobile'];

$html = '	<br />
	
<span class="label"></span>
<table class="tab">
  <!-- <tr>
    <td colspan="2"><strong>Mobile & Email</strong></td>
    
  </tr> -->
      <tr>
    <td style="background-color:#f1f1f1;"><strong class="tr_title">Mobile</strong></td>
    <td>'. $row['Mobile'] .'</td>
  </tr>

  <tr>
    <td style="background-color:#f1f1f1;"><strong class="tr_title">Alternate Mobile</strong></td>
    <td>'. $row['AltMobile'] .'</td>
  </tr>

  <tr>
    <td style="background-color:#f1f1f1;"><strong class="tr_title">Landline Phone No.</strong></td>
    <td>'. $row['Landline'] .'</td>
  </tr>

  <tr>
    <td style="background-color:#f1f1f1;"><strong class="tr_title">E-mail</strong></td>
    <td>'. $row['Email'] .'</td>
  </tr>

  <tr>
    <td style="background-color:#f1f1f1;"><strong class="tr_title">Alternate E-mail</strong></td>
    <td>'. $row['AltEmail'] .'</td>
  </tr>

  

  
</table> <br>';



$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);







$html = '
                  <span class="label">2. Educational Qualifications</span>
                  <table class="tab">
                
                    <tr style="background-color:#f1f1f1;">
                      <td colspan="6" class="tr_title"><strong>(A) Ph. D. Details</strong></td>
                    </tr>
                    
                    <tr>
                      <td width="30%"><strong>University/<br />Institute</strong></td>
                      <td width="12%"><strong>Department</strong></td>
                      <td width="17%"><strong>Name of Ph. D. <br />Supervisor</strong></td>
                      <td width="10%"><strong>Year of <br />Joining</strong></td>
                      <td width="15%"><strong>Date of <br />successful <br />thesis Defence</strong></td>
                      <td width="15%"><strong>Date of <br />Award</strong></td>
                    </tr>
                    
                 
                    
                  </table>

                  
   ';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);



$html = '   
                  <table class="tab">
            
    ';

$sql = "Select * from details_of_phd where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {
    $html .= '

              <tr>
                <td width="30%">' . $data["university"] . '</td>
                <td width="12%">' . $data["department"] . '</td>
                <td width="17%">' . $data["Name_of_PhD_Supervisor"] . '</td>
                <td width="10%">' . $data["Year_of_Joining"] . '</td>
                <td width="15%">' . $data["Date_of_Successful_Thesis_Defence"] . '</td>
                <td width="15%">' . $data["Title_of_PhD_Thesis"] . '</td>
              </tr>
                
         
          ';
    // $count++;
  }

  $html .=  '                  </table>
       ';
}
// else echo "empty";

$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);


$html = '
      
              <table class = "tab" >
              
                <tr>
                  <td><strong>Title of Ph. D. Thesis</strong></td>
                  <td colspan="5">Dynamic Research Developer</td>
                </tr>
              </table>
              <br>
  
          ';
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);




$html = '
      
      
      <table class="tab">

            <tr style="background-color:#f1f1f1;">
              <td colspan="8" class="tr_title"><strong style = "font-size:18px;" >(B) Academic Details - PG</strong></td>
            </tr>
            
            <tr>
              <td width="10%"><strong>Degree</strong></td>
              <td width="25%"><strong>University/<br />Institute</strong></td>
              <td width="20%"><strong>Subjects</strong></td>
              <td width="10%"><strong>Year of <br />Joining</strong></td>
              <td width="12%"><strong>Year of <br />Graduation</strong></td>
              <td width="10%"><strong>Duration <br />(in years)</strong></td>
              <td width="30%"><strong>Percentage/CGPA </strong></td>
              <td width="30%"><strong>Division/Class </strong></td>

            </tr>

        </table>';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$html = '
        
          <table class = "tab">';

$sql = "Select * from pg_details where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {
    $html .= '


                    <tr>
                      <td width="10%">' . $data["degree"] . '</td>
                      <td width="25%">' . $data["university"] . '</td>
                      <td width="20%">' . $data["stream"] . '</td>
                      <td width="10%">' . $data["Year_of_Joining"] . '</td>
                      <td width="12%">' . $data["Year_of_Completion"] . '</td>
                      <td width="10%">' . $data["duration"] . '</td>
                      <td width="30%">' . $data["cgpa"] . '</td>
                      <td width="30%">' . $data["division"] . '</td>

                    </tr>

              ';
    // $count++;
  }

  $html .=  '</table> <br>';
}
// else echo "empty";

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);







$html = '
            <table class="tab">

            <tr style="background-color:#f1f1f1;">
              <td colspan="8" class="tr_title"><strong style = "font-size:18px;">(C) Academic Details - UG</strong></td>
            </tr>
        
            <tr>
              <td width="10%"><strong>Degree</strong></td>
              <td width="25%"><strong>University/<br />Institute</strong></td>
              <td width="20%"><strong>Subjects</strong></td>
              <td width="10%"><strong>Year of <br />Joining</strong></td>
              <td width="12%"><strong>Year of <br />Graduation</strong></td>
              <td width="10%"><strong>Duration <br />(in years)</strong></td>
              <td width="30%"><strong>Percentage/CGPA </strong></td>
              <td width="30%"><strong>Division/Class </strong></td>
              
            </tr>
  
              </table>';


$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);



$sql = "Select * from ug_details where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

$html = '
        
          <table class = "tab">';

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {
    $html .= '

                <tr>
                  <td width="10%">' . $data["degree"] . '</td>
                  <td width="25%">' . $data["university"] . '</td>
                  <td width="20%">' . $data["stream"] . '</td>
                  <td width="10%">' . $data["yoj"] . '</td>
                  <td width="12%">' . $data["yoc"] . '</td>
                  <td width="10%">' . $data["duration"] . '</td>
                  <td width="30%">' . $data["percentage"] . '</td>
                  <td width="30%">' . $data["division"] . '</td>
                  </tr>
               
              ';
    // $count++;
  }

  $html .=  '</table> <br> ';
}
// else echo "empty";

$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);








$html = '<table class="tab">

        <tr style="background-color:#f1f1f1;">
          <td colspan="8" class="tr_title"><strong>(D) Academic Details - School</strong></td>
        </tr>
    
        <tr>
          <td width="30%"><strong>10th/12th/HSC/Diploma</strong></td>
          <td width="25%"><strong>School</strong></td>
          <td width="15%"><strong>Year of Passing</strong></td>
          <td width="15%"><strong>Percentage/CGPA</strong></td>
          <td width="15%"><strong>Division/Class</strong></td>
          
    
        </tr>
       
          </table>';



$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);


$html = '
        
        <table class = "tab">';

$sql = "Select * from school_details where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {

  foreach ($query as $data) {
    $html .= '
              
                <tr>
                  <td width = "30%">' . $data["standard"] . '</td>
                  <td width = "25%">' . $data["school"] . '</td>
                  <td width = "15%">' . $data["year_of_passing"] . '</td>
                  <td width = "15%">' . $data["percentage/grade"] . '</td>
                  <td width = "15%">' . $data["division"] . '</td>
                  
                  </tr>
               
              ';
  }

  $html .=  '</table>';
}


$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);







$html = ' <br>	<table class="tab">
          <tr style="background-color:#f1f1f1;">
            <td colspan="8" class="tr_title"><strong style = "font-size:18px" >(E) Additional Educational Qualifications (If any) </strong></td>
          </tr>
          
          <tr>
            <td width="10%"><strong>Degree</strong></td>
            <td width="25%"><strong>University/<br />Institute</strong></td>
            <td width="20%"><strong>Subjects</strong></td>
            <td width="10%"><strong>Year of <br />Joining</strong></td>
            <td width="12%"><strong>Year of <br />Graduation</strong></td>
            <td width="10%"><strong>Duration <br />(in years)</strong></td>
            <td width="30%"><strong>Percentage/CGPA </strong></td>
            <td width="30%"><strong>Division/Class </strong></td>
          </tr>
          
            </table>';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$html = '<table class = "tab" >';
$sql = "Select * from additional_qualifications where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {

  foreach ($query as $data) {
    $html .= '
            
              <tr>
                <td width = "10%;">' . $data["degree"] . '</td>
                <td width = "25%;">' . $data["university"] . '</td>
                <td width = "20%;">' . $data["branch"] . '</td>
                <td width = "10%;">' . $data["yoj"] . '</td>
                <td width = "12%;">' . $data["yoc"] . '</td>
                <td width = "10%;">' . $data["duration"] . '</td>
                <td width = "30%;">' . $data["percentage"] . '</td>
                <td width = "30%;">' . $data["division"] . '</td>
                
                </tr>
             
            ';
  }

  $html .=  '</table>';
}

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);





$html = '
        <br>
        <span class="label">3. Employment Details </span>
      
        <table class="tab">
    
          <tr style="background-color:#f1f1f1;">
            <td colspan="5" class="tr_title"><strong>(A) Present Employment</strong></td>
          </tr>
          <tr>
            <td width="20"><strong>Position </strong></td>
            <td width="30"><strong>Organization/Institution</strong></td>
            <td width="15"><strong>Date of <br />Joining</strong></td>
            <td width="15"><strong>Date of <br />Leaving </strong></td>
            <td width="15"><strong>Duration <br />(in years)</strong></td>
          </tr>
          
            </table>';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$html = '<table class = "tab">';
$sql = "Select * from present_employment where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {

  foreach ($query as $data) {
    $html .= '
            
              <tr>
                <td width = "15%">' . $data["position"] . '</td>
                <td width = "40%">' . $data["OrganizationInstitution"] . '</td>
                <td width = "15%">' . $data["DateOfJoining"] . '</td>
                <td width = "15%">' . $data["DateOfLeaving"] . '</td>
                <td width = "15%">' . $data["DurationYears"] . '</td>
                
                
                </tr>

            ';
  }

  $html .=  '</table>';
}

$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);


$html = '
        <br>
        <br>
        <br>
        <br>
        <span class="label"> </span>
        <table class="tab">
          <tr style="background-color:#f1f1f1;">
            <td colspan="5" class="tr_title"><strong>(B) Employment History (After PhD )</strong></td>
          </tr>
          
          <tr>
            <td width="20"><strong>Position </strong></td>
            <td width="30"><strong>Organization/Institution</strong></td>
            <td width="15"><strong>Date of <br />Joining</strong></td>
            <td width="15"><strong>Date of <br />Leaving </strong></td>
            <td width="15"><strong>Duration <br />(in years)</strong></td>
          </tr>
          
          
      
        </table>';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$html = '<table class = "tab">';
$sql = "Select * from employmenthistory where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {

  foreach ($query as $data) {
    $html .= '
            
              <tr>
                <td width = "18%">' . $data["Position"] . '</td>
                <td width = "40%">' . $data["Organization"] . '</td>
                <td width = "15%">' . $data["Date_of_Joining"] . '</td>
                <td width = "15%">' . $data["Date_of_Leaving"] . '</td>
                <td width = "15%">' . $data["duration"] . '</td>
                
                
                </tr>

            ';
  }

  $html .=  '</table>';
}

$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);





$html = '
        <br>
        <table class="tab">
        <tr style="background-color:#f1f1f1;">
          <td colspan="8" class="tr_title"><strong style = "font-size:27px;">(C) Teaching Experience (After PhD)</strong></td>
        </tr>
        
        <tr>
          <!-- <td><strong>S. No.</strong></td> -->
          <td width="25%"><strong>Position</strong></td>
          <td width="30%"><strong>Employer</strong></td>
          <td width="30%"><strong>Course Taught</strong></td>
          <td width="30%"><strong>UG/PG</strong></td>
          <td width="25%"><strong>No. of Students</strong></td>
          <td width="20%"><strong>Date of <br />Joining</strong></td>
          <td width="20%"><strong>Date of <br />Leaving</strong></td>
          <td width="15%"><strong>Duration</strong></td>
        </tr>
            <tr>
          
      </table>';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$html = '<table class = "tab">';
$sql = "Select * from teachingexperience where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {

  foreach ($query as $data) {
    $html .= '
            
              <tr>
                <td width = "25%">' . $data["position"] . '</td>
                <td width = "30%">' . $data["employer"] . '</td>
                <td width = "30%">' . $data["CourseTaught"] . '</td>
                <td width = "30%">' . $data["UG_PG"] . '</td>
                <td width = "25%">' . $data["NoOfStudents"] . '</td>
                <td width = "20%">' . $data["DateOfJoining"] . '</td>
                <td width = "20%">' . $data["DateOfLeaving"] . '</td>
                <td width = "15%">' . $data["Duration"] . '</td>
                </tr>

            ';
  }

  $html .=  '</table>';
}

$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);





$html = '
        <br>
        
          <table class="tab">
          <tr style="background-color:#f1f1f1">
            <td colspan="6" class="tr_title"><strong>(D) Research Experience </strong></td>
          </tr>
          
          <tr>
          
            <td width="20%"><strong>Position</strong></td>
            <td width="20%"><strong>Institute</strong></td>
            <td width="20%"><strong>Supervisor</strong></td>
            <td width="10%"><strong>Date of <br />Joining</strong></td>
            <td width="10%"><strong>Date of <br />Leaving</strong></td>
            <td width="10%"><strong>Duration</strong></td>
          </tr>
          
    </table>';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$html = '<table class = "tab">';
$sql = "Select * from research_experience where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {

  foreach ($query as $data) {

    $html .= '
              
              <tr>
                <td width = "10%">' . $data["position"] . '</td>
                <td width = "20%">' . $data["Institute"] . '</td>
                <td width = "20%">' . $data["Supervisor"] . '</td>
                <td width = "10%">' . $data["DateOfJoining"] . '</td>
                <td width = "10%">' . $data["DateOfLeaving"] . '</td>
                <td width = "10%">' . $data["duration"] . '</td>
                </tr>

            ';
  }

  $html .=  '</table>';
}

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);









$html = '
        <br>

        <table class="tab">
        <tr style="background-color:#f1f1f1">
          <td colspan="5"><strong  class="tr_title">(E) Industrial Experience </strong></td>
        </tr>
        
        <tr>
          
          <td width="20%"><strong>Organization</strong></td>
          <td width="20%"><strong>Work Profile</strong></td>
          <td width="10%"><strong>Date of <br />Joining</strong></td>
          <td width="10%"><strong>Date of <br />Leaving</strong></td>
          <td width="10%"><strong>Duration</strong></td>
        </tr>
          
          </table>';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$html = '<table class = "tab">';
$sql = "Select * from industrial_experience where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {

  foreach ($query as $data) {

    $html .= '
              
              <tr>
                <td width = "20%">' . $data["organization"] . '</td>
                <td width = "20%">' . $data["WorkProfile"] . '</td>
                <td width = "10%">' . $data["DateOfJoining"] . '</td>
                <td width = "10%">' . $data["DateOfLeaving"] . '</td>
                <td width = "10%">' . $data["Duration"] . '</td>
                </tr>

            ';
  }

  $html .=  '</table>';
}

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);







$html = '

        <br>
        <span class="label">4.  Area(s) of Specialization and Current Area(s) of Research</span>
        <table class="tab">
        
            <tr>
              <td width="25%" style="background-color: #f1f1f1;"><strong class="tr_title">Area(s) of Specialization</strong></td>
              
            
              <td width="25%" style="background-color: #f1f1f1;"><strong class="tr_title">Current Area(s) of Research</strong></td>
            </tr>
      
            
          </table>
          ';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);


$html = '<table class = "tab">';
$sql = "Select * from specialization where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {

  foreach ($query as $data) {

    $html .= '
              
              <tr>
                <td width = "35%">' . $data["area_of_specialization"] . '</td>
                <td width = "25%">' . $data["current_area_of_research"] . '</td>
                </tr>
            ';
  }

  $html .=  '</table>';
}

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);



$html = '
<br>

<span class="label">5. Summary of Publications</span>
<table class="tab">
  
  <tr>
    <td width="50%"><strong>Number of International Journal Papers  </strong></td>
    <td>ggg</td>
  </tr>

  <tr>
    <td width="50%"><strong>Number of National Journal Papers  </strong></td>
    <td>Ea </td>
  </tr>

  <tr>
    <td><strong> Number of International Conference Papers </strong></td>
    <td>sss</td>
  </tr>

  <tr>
    <td><strong> Number of National Conference Papers </strong></td>
    <td>Mol</td>
  </tr>

  <tr>
    <td><strong> Number of Patent(s) </strong></td>
    <td>Qua</td>
  </tr>

  <tr>
    <td><strong> Number of Book(s) </strong></td>
    <td>Ill</td>
  </tr>

  <tr>
    <td><strong>Number of Book Chapter(s) </strong></td>
    <td>a</td>
  </tr>
  
  
      </table>
<br />


<span class="label">6. List of 10 Best Research Publications (Journal/Conference)</span>
<table class="tab">
  <tr style="background-color:#f1f1f1;">
    <td colspan="8"><strong class="tr_title">(A) Journals(s)</strong></td>
  </tr>
  <tr>
    <td width="5%"><strong>S. No.</strong></td>
    <td width="25%"><strong>Author(s) </strong></td>
    <td width="30%"><strong>Title</strong></td>
    <td width="25%"><strong>Name of Journal</strong></td>
    <td width="10%"><strong>Year, Vol., Page</strong></td>
    <td width="5%"><strong>Impact Factor</strong></td>
    <td width="1%"><strong>DOI</strong></td>
    <td width="5%"><strong>Status</strong></td>
  </tr>
        <tr>
    <td>1</td>
    <td>Quibusdam vel sunt quisquam ipsa repellat.</td>
    <td>Forward Paradigm Liaison</td>
    <td>Reinhold Lowe</td>
    <td>Rerum cupiditate fugit deserunt provident recusandae dicta.</td>
    <td>Minima aperiam eveniet quos amet doloribus commodi dolore aliquam porro.</td>
    <td>Libero sint sequi.</td>
    <td></td>
  </tr>
        <tr>
    <td>2</td>
    <td>Enim excepturi eos facere officiis quo.</td>
    <td>Product Operations Liaison</td>
    <td>Freda Hegmann</td>
    <td>Veritatis quia quod laboriosam corrupti enim harum dolorum excepturi voluptatum.</td>
    <td>Maxime debitis accusantium.</td>
    <td>Quia alias dolor veritatis eos illum.</td>
    <td></td>
  </tr>
        <tr>
    <td>3</td>
    <td>Sit optio facere consectetur tempora laborum esse.</td>
    <td>Product Markets Orchestrator</td>
    <td>Whitney Mills</td>
    <td>Enim distinctio qui saepe veritatis expedita.</td>
    <td>Provident fugit praesentium excepturi placeat quos eligendi debitis.</td>
    <td>Natus sit ducimus.</td>
    <td></td>
  </tr>
        <tr>
    <td>4</td>
    <td>Quidem eius adipisci enim itaque architecto ipsum earum possimus.</td>
    <td>Global Accountability Orchestrator</td>
    <td>lG3xo2IheV</td>
    <td>Alias ducimus earum dolore saepe ea necessitatibus.</td>
    <td>Repellendus natus repellendus consequatur ad enim adipisci deserunt numquam unde.</td>
    <td>Vero impedit similique harum.</td>
    <td></td>
  </tr>
      </table>


<span class="label">7. List of Patent(s), Book(s), Book Chapter(s)</span>
<table class="tab">
  <tr style="background-color:#f1f1f1;">
    <td colspan="8"><strong class="tr_title">(A) Patent(s)</strong></td>
  </tr>
  <tr>
    <td width="5%"><strong>S. No.</strong></td>
    <td width="20%"><strong>Inventor(s) </strong></td>
    <td width="20%"><strong>Title of Patent</strong></td>
    <td width="15%"><strong>Country of<br /> Patent</strong></td>
    <td width="10%"><strong>Patent <br />Number</strong></td>
    <td width="10%"><strong>Date of <br />Filing</strong></td>
    <td width="10%"><strong>Date of <br />Published</strong></td>
    <td width="10%"><strong>Status<br />Filed/Published</strong></td>
  </tr>
        <tr>
    <td>1</td>
    <td>LMFXclcu3JKj6Xb</td>
    <td>Regional Marketing Analyst</td>
    <td>Mozambique</td>
    <td>626</td>
    <td>Quia placeat nulla voluptatibus perferendis nostrum aspernatur hic.</td>
    <td>Tenetur delectus dolor a dignissimos consequatur nemo.</td>
    <td>Alias id facilis quidem expedita debitis eius necessitatibus esse ducimus.</td>
  </tr>

        <tr>
    <td>3</td>
    <td>iMwlvzGiuPVmMhv</td>
    <td>Direct Factors Executive</td>
    <td>Heard Island and McDonald Islands</td>
    <td>506</td>
    <td>Aperiam quas ipsum.</td>
    <td>Ducimus possimus corrupti ab veniam eum.</td>
    <td>Impedit reprehenderit excepturi nemo rerum eum recusandae nostrum eos.</td>
  </tr>
      </table>

<table class="tab">
<tr style="background-color:#f1f1f1;">
  <td colspan="5"><strong class="tr_title">(B) Book(s)</strong></td>
</tr>
<tr>
  <td width="5%"><strong>S. No.</strong></td>
  <td width="30%"><strong>Author(s) </strong></td>
  <td width="40%"><strong>Title of the Book</strong></td>
  <td width="20%"><strong>Year of Publication</strong></td>
  <td width="10%"><strong>ISBN</strong></td>
  
</tr>
    <tr>
  <td>1</td>
  <td>Sit quod veniam quisquam facere debitis.</td>
  <td>Lead Configuration Officer</td>
  <td>Dignissimos a delectus eum similique at.</td>
  <td>Tempora id quaerat sit inventore quidem consequatur.</td>
  
</tr>
    <tr>
  <td>2</td>
  <td>Eveniet asperiores deleniti earum accusantium ex facilis quaerat.</td>
  <td>Internal Assurance Representative</td>
  <td>Vel non voluptates aperiam molestias nihil architecto.</td>
  <td>Sed laudantium quo iure temporibus.</td>
  
</tr>
    <tr>
  <td>3</td>
  <td>Harum incidunt voluptates ipsa.</td>
  <td>District Brand Coordinator</td>
  <td>Odit officiis sit deserunt beatae.</td>
  <td>Assumenda illum ad.</td>
  
</tr>
  </table>

  <br>

<table class="tab">
<tr style="background-color:#f1f1f1;">
  <td colspan="5"><strong class="tr_title">(C) Book Chapter(s)</strong></td>
</tr>
<tr>
  <td width="5%"><strong>S. No.</strong></td>
  <td width="30%"><strong>Author(s) </strong></td>
  <td width="40%"><strong>Title of the Book Chapter</strong></td>
  <td width="20%"><strong>Year of Publication</strong></td>
  <td width="10%"><strong>ISBN</strong></td>
  
</tr>
    <tr>
  <td>1</td>
  <td>Odit quibusdam neque debitis molestiae numquam repudiandae cupiditate non beatae.</td>
  <td>Central Directives Supervisor</td>
  <td>Ipsam harum enim vel consequuntur.</td>
  <td>Modi eius amet culpa.</td>
  
</tr>
    <tr>
  <td>2</td>
  <td>Deserunt soluta dolores perferendis dolore.</td>
  <td>Internal Group Designer</td>
  <td>Quae esse esse reprehenderit nam neque saepe facilis.</td>
  <td>Saepe dolores illo.</td>
  
</tr>
    <tr>
  <td>3</td>
  <td>Facere fugit neque aspernatur molestiae deserunt odio ipsum.</td>
  <td>Customer Security Developer</td>
  <td>Deserunt necessitatibus velit possimus voluptatum explicabo asperiores nostrum possimus.</td>
  <td>Beatae consectetur corrupti voluptatibus sequi aliquid quibusdam.</td>
  
</tr>

<br>
  </table>
<br>
<span class="label">8. Google Scholar Link </span>
<table class="tab">
  <tr style="background-color:#f1f1f1;">
    <td colspan="6"><strong class="tr_title">URL</strong></td>
  </tr>
  <tr>
    <td width="100%"><a href="Exercitationem excepturi commodi magnam placeat impedit illum eligendi nobis." target="_blank">Exercitationem excepturi commodi magnam placeat impedit illum eligendi nobis.</a></td>
  </tr>

  <br>
  
</table>

';


$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);






$html = '
        <br>
	<span class="label">9. Membership of Professional Societies </span>
	<table class="tab">
		<tr style="background-color:#f1f1f1;">
			<td colspan="3"><strong class="tr_title">Details</strong></td>
		</tr>
		
		<tr>
			<td width="3%"><strong>S. No.</strong></td>
			<td width="20%"><strong>Name of the Professional Society</strong></td>
			<td width="20%"><strong>Membership Status (Lifetime/Annual)</strong></td>
      
      </tr>
      </table>';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$sql = "Select * from membership where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);


$html = '<table class = "tab">';

if (mysqli_num_rows($query) > 0) {
  $count = 1;
  foreach ($query as $data) {

    $html .= '
              
              <tr>
                <td width = "8%">' . $data["SNo"] . '</td>
                <td width = "35%">' . $data["nameOfSociety"] . '</td>
                <td width = "25%">' . $data["status"] . '</td>
                </tr>
            ';

    $count++;
  }

  $html .=  '</table>';
}

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);







$html = '
       <br>
        
	<span class="label">10. Professional Training </span>
	<table class="tab">
		<tr style="background-color:#f1f1f1;">
			<td colspan="5"><strong class="tr_title">Details</strong></td>
		</tr>
		
		<tr>
			<td width="5%"><strong>S. No.</strong></td>
			<td width="20%"><strong>Type of Training Received</strong></td>
			<td width="20%"><strong>Organisation</strong></td>
			<td width="10%"><strong>Year</strong></td>
			<td width="10%"><strong>Duration</strong></td>
		</tr>
				
			</table>';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$sql = "Select * from professional_training where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

$html = '<table class = "tab">';

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {

    $html .= '
                    
                    <tr>
                      <td width = "8%">' . $data["SNo"] . '</td>
                      <td width = "35%">' . $data["TypeOfTrainingReceived"] . '</td>
                      <td width = "25%">' . $data["Organisation"] . '</td>
                      <td width = "25%">' . $data["Year"] . '</td>
                      <td width = "25%">' . $data["Duration"] . '</td>
                      </tr>
                  ';

    // $count++;
  }

  $html .=  '</table>';
}

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);


$html = '
                          <span class="label">11. Award(s) and Recognition(s) </span>
              <table class="tab">
                <tr style="background-color:#f1f1f1;">
                  <td colspan="4"><strong class="tr_title">Details</strong></td>
                </tr>
                
                <tr>
                  <td width="5%"><strong>S. No.</strong></td>
                  <td width="20%"><strong>Name of Award</strong></td>
                  <td width="20%"><strong>Awarded By</strong></td>
                  <td width="10%"><strong>Year</strong></td>
                </tr>
                  </table>
              ';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$sql = "Select * from awards_recognitions where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

$html = '<table class = "tab">';

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {

    $html .= '
                           
                           <tr>
                             <td width = "5%">' . $data["SNo"] . '</td>
                             <td width = "20%">' . $data["AwardName"] . '</td>
                             <td width = "20%">' . $data["AwardingBody"] . '</td>
                             <td width = "10%">' . $data["YearOfAward"] . '</td>
                          </tr>
                         ';

    // $count++;
  }

  $html .=  '</table> <br>';
}

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);





$html = '
  
	<span class="label">12. Sponsored Projects/ Consultancy Details </span>

  <table class="tab">
		<tr style="background-color:#f1f1f1;">
			<td colspan="7"><strong class="tr_title">(A) Sponsored Projects</strong></td>
		</tr>
		
		<tr>
			<td width="5%"><strong>S. No.</strong></td>
			<td width="20%"><strong>Sponsoring Agency</strong></td>
			<td width="20%"><strong>Title of Project</strong></td>
			<td width="10%"><strong>Sanctioned Amount</strong></td>
			<td width="10%"><strong>Period</strong></td>
			<td width="10%"><strong>Role</strong></td>
			<td width="10%"><strong>Status</strong></td>
		</tr>

			</table>

	';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$sql = "Select * from projectdetails where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

$html = '<table class = "tab">';

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {

    $html .= '
                                                    
                                                    <tr>
                                                      <td width = "5%">' . $data["SNo"] . '</td>
                                                      <td width = "20%">' . $data["SponsoringAgency"] . '</td>
                                                      <td width = "20%">' . $data["TitleOfProject"] . '</td>
                                                      <td width = "10%">' . $data["SanctionedAmount"] . '</td>
                                                      <td width = "10%">' . $data["Period"] . '</td>
                                                      <td width = "10%">' . $data["Role"] . '</td>
                                                      <td width = "10%">' . $data["Status"] . '</td>
                                                      </tr>
                                                  ';

    // $count++;
  }

  $html .=  '</table> <br>';
}

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);



$html = '
<table class="tab">
		<tr style="background-color:#f1f1f1;">
			<td colspan="7"><strong class="tr_title">(B) Consultancy Projects</strong></td>
		</tr>
		
		<tr>
			<td width="5%"><strong>S. No.</strong></td>
			<td width="20%"><strong>Organization</strong></td>
			<td width="20%"><strong>Title of Project</strong></td>
			<td width="15%"><strong>Amount of Grant</strong></td>
			<td width="15%"><strong>Period</strong></td>
			<td width="15%"><strong>Role</strong></td>
			<td width="15%"><strong>Status</strong></td>
		</tr>
			</table>
	';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$sql = "Select * from consultancyprojects where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

$html = '<table class = "tab">';

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {

    $html .= '
                                                    
    <tr>
    <td width = "5%">' . $data["SNo"] . '</td>
    <td width = "20%">' . $data["Organization"] . '</td>
    <td width = "20%">' . $data["TitleOfProject"] . '</td>
    <td width = "10%">' . $data["AmountGranted"] . '</td>
    <td width = "10%">' . $data["Period"] . '</td>
    <td width = "10%">' . $data["Role"] . '</td>
    <td width = "10%">' . $data["Status"] . '</td>
    </tr>
                                                  ';

    // $count++;
  }

  $html .=  '</table> <br>';
}

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);



$html = '
<span class="label">14. Significant research contribution and future plans</span>
	<table class="tab">
	</table>
	<br />';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

// $sql = "Select * from contributions where APP_NO = '$app_no'";
// $query = mysqli_query($conn, $sql);

// $html = '<table class = "tab">';

// if (mysqli_num_rows($query) > 0) {
//   // $count = 1;
//   foreach ($query as $data) {

//     $html .= '
                                                    
//                                                     <tr>
//                                                       <td style="text-align:justify;><p>' . $data["research"] . '</p></td>
//                                                       </tr>
//                                                   ';

//     // $count++;
//   }

//   $html .=  '</table>';
// }


$html = '

<div style = "border:2px solid grey;">
It really shouldnt have mattered to Betty Thats what she kept trying to convince herself even she knew it mattered to Betty more than practically anything Why was she trying to convince herself otherwise she stepped forward to knock on Betty door, she still didn have a convincing answer to this question that she been asking herself more than two years now
</div>
';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$html = '
<br>
<span class="label">15. Significant teaching contribution and future plans</span>

	<table class="tab">
		
	</table>
	<br />';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

// $sql = "Select * from contributions where APP_NO = '$app_no'";
// $query = mysqli_query($conn, $sql);

// $html = '<table class = "tab">';

// if (mysqli_num_rows($query) > 0) {
//   // $count = 1;
//   foreach ($query as $data) {

//     $html .= '
                                                    
//                                                     <tr>
//                                                       <td style="text-align:justify;>' . $data["teaching"] . '</td>
//                                                       </tr>
//                                                   ';

//     // $count++;
//   }

//   $html .=  '</table>';
// }


// $stylesheet = file_get_contents('style.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
// $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);


$html = '
<br>

<span class="label">16. Any other relevant information</span>
	
	<table class="tab">
		
	</table>
	<br />';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

// $sql = "Select * from contributions where APP_NO = '$app_no'";
// $query = mysqli_query($conn, $sql);

// $html = '<table class = "tab">';

// if (mysqli_num_rows($query) > 0) {
//   // $count = 1;
//   foreach ($query as $data) {

//     $html .= '
                                                    
//                                                     <tr>
//                                                       <td><p>' . $data["other_info"] . '</p></td>
//                                                       </tr>
//                                                   ';

//     // $count++;
//   }

//   $html .=  '</table>';
// }

$html = '
<div style = "border:2px solid grey;">
The tree missed the days the kids used to come by and play. It still wore the tire swing the kids had put up in its branches years ago although both the tire and the rope had seen better days. The tree had watched all the kids in the neighborhood grow up and leave, and it wondered if there would ever be a time when another child played and laughed again under its branches. That was the hope that the tree wished every day as the swing gently swung empty in the wind
</div>'
;
$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);



// $html = '
// <span class="label">16. Any other relevant information</span>
	
// 	<table class="tab">
		
// 	</table>
// 	<br />';

// $stylesheet = file_get_contents('style.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
// $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

// $sql = "Select * from contributions where APP_NO = '$app_no'";
// $query = mysqli_query($conn, $sql);

// $html = '<table class = "tab">';

// if (mysqli_num_rows($query) > 0) {
//   // $count = 1;
//   foreach ($query as $data) {

//     $html .= '
                                                    
//                                                     <tr>
//                                                       <td><p>' . $data["other_info"] . '</p></td>
//                                                       </tr>
//                                                   ';

//     // $count++;
//   }

//   $html .=  '</table>';
// }

// $stylesheet = file_get_contents('style.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
// $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);


$html = '
<br>

<span class="label">17. Professional Service as Reviewer/Editor etc.</span>
	<table class="tab">
	</table>
	<br />';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

// $sql = "Select * from contributions where APP_NO = '$app_no'";
// $query = mysqli_query($conn, $sql);

// $html = '<table class = "tab">';

// if (mysqli_num_rows($query) > 0) {
//   // $count = 1;
//   foreach ($query as $data) {

//     $html .= '
                                                    
//                                                     <tr>
//                                                       <td>' . $data["professional_service"] . '</td>
//                                                       </tr>
//                                                   ';

//     // $count++;
//   }

//   $html .=  '</table>';
// }

// $stylesheet = file_get_contents('style.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
// $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);


$html = '
<br>
<span class="label">18. Detailed List of Journal Publications<br />(Including Sr. No., Authors Names, Paper Title, Volume, Issue, Year, Page Nos., Impact Factor (if any), DOI, Status [Published/Accepted])</span>
	<table class="tab">
	</table>
	<br />';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

// $sql = "Select * from contributions where APP_NO = '$app_no'";
// $query = mysqli_query($conn, $sql);

// $html = '<table class = "tab">';

// if (mysqli_num_rows($query) > 0) {
//   // $count = 1;
//   foreach ($query as $data) {

//     $html .= '
                                                    
//                                                     <tr>
//                                                       <td>' . $data["journal_publications"] . '</td>
//                                                       </tr>
//                                                   ';

//     // $count++;
//   }

//   $html .=  '</table>';
// }

$html = '

<div style = "border:2px solid grey;">
He couldn remember exactly where he had read it but he was sure that he had The fact that she didn believe him was quite frustrating he began to search the Internet to find the article. It was it was something that seemed impossible. Yet she insisted on always seeing the source whenever he stated a fact
He stared out the window at the snowy field Hebeen stuck in the house for close to a month and his only view of the outside world was through the window. There wasn much to see It was mostly just the field with an occasional bird small animal who ventured into the field he continued to stare out the window, he wondered how much longer he be shackled to the steel bar inside the house.

There was no ring on his finger That was a good sign although far from proof that he was available. Still, it was much better than if he had been wearing a wedding ring on his hand. She glanced at his hand a bit more intently to see if there were any tan lines where a ring may have been and he simply taken it off. She could not detect any which was also a good sign a relief The next step would be to get access to his wallet to see there were any family photos in it.
</div>';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);





$html = '
<br>
<span class="label">19. Detailed List of Conference Publications<br />(Including Sr. No.,  Authors Names, Paper Title, Name of the conference, Year, Page Nos., DOI [If any])</span>
	<table class="tab">

	</table>
	<br />';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

// $sql = "Select * from contributions where APP_NO = '$app_no'";
// $query = mysqli_query($conn, $sql);

// $html = '<table class = "tab">';

// if (mysqli_num_rows($query) > 0) {
//   // $count = 1;
//   foreach ($query as $data) {

//     $html .= '
                                                    
//                                                     <tr>
//                                                       <td>' . $data["conference_publications"] . '</td>
//                                                       </tr>
//                                                   ';

//     // $count++;
//   }

//   $html .=  '</table>';
// }

// $stylesheet = file_get_contents('style.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
// $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);




$html = '
<br>
<span class="label">20. Reprints of 5 Best Research Papers-Attached </span>
	<table></table>';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$sql = "Select * from documents where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

$html = '<table class = "tab">';

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {

    $html .= '
                                                                                        
                                                  ';

    // $count++;
  }

  $html .=  '</table>';
}

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);


$html = '
<br>
<span class="label">21. Check List of the documents attached with the online application </span><br />
  <div style = "border:1px solid grey;">
	1. PHD Certificate<br />
	2. PG Certificate<br />
	3. UG Certificate<br />
	4. 12th/HSC/Diploma<br />
	5. 10th/SSC Certificate<br />
	6. 10 Years Post phd Experience Certificate <br />
	7. Any other relevant documents ( Experience Certificate, Award Certificate, etc.)

  </div>

	<br />';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$sql = "Select * from documents where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

$html = '<table class = "tab">';

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {

    $html .= '
                                                    
                                                    
                                                  ';

    // $count++;
  }

  $html .=  '</table>';
}

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);



$html = '
<span class="label">22. Referees</span>
	<table class="tab">
		<tr style="background-color:#f1f1f1;">
			<td colspan="6"><strong class="tr_title">Details of Referees</strong></td>
		</tr>

		<tr>
			<!-- <td><strong>S. No.</strong></td> -->
			<td width="20%"><strong>Name</strong></td>
			<td width="20%"><strong>Position</strong></td>
			<td width="15%"><strong>Association with Referee</strong></td>
			<td width="15%"><strong>Institution/<br />Organization</strong></td>
			<td width="15%"><strong>E-mail</strong></td>
			<td width="15%"><strong>Contact No.</strong></td>
		</tr>
				
			</table>
';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$sql = "Select * from refrees where APP_NO = '$app_no'";
$query = mysqli_query($conn, $sql);

$html = '<table class = "tab">';

if (mysqli_num_rows($query) > 0) {
  // $count = 1;
  foreach ($query as $data) {

    $html .= '
                                                    
                                                    <tr>
                                                      <td width = "20%">' . $data["name"] . '</td>
                                                      <td width = "20%">' . $data["position"] . '</td>
                                                      <td width = "15%">' . $data["associate_with_reference"] . '<td>
                                                      <td width = "15%">' . $data["institute"] . '</td>
                                                      <td width = "15%">' . $data["email"] . '</td>
                                                      <td width = "15%">' . $data["contact"] .'</td>
                                                      </tr>
                                                  ';

    // $count++;
  }

  $html .=  '</table>';
}

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);




$html = '
<br>
<span class="label">23. Final Declaration</span>

	  <div style = "border:1px solid grey; " >          
    I hereby declare that I have carefully read and understood the instructions and particulars mentioned in the advertisment and this application form. I further declare that all the entries along with the attachments uploaded in this form are true to the best of my knowledge and belief
    </div>
 

';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$sql = "Select signature from documents where APP_NO = '$app_no';";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

// echo $row["signature"];

$html = '

<br>
<div>
<img src="' .  $row["signature"] . '" style="height:50; "/><br />
Signature of Applicant

</div>';

$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);



if ($_SERVER["REQUEST_METHOD"] == "POST") {

$mpdf->Output();

}



?>

<html>

<head>
  <title>Final Submission</title>
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
  body {
    background-color: lightgray;
    padding-top: 0px !important;
  }
</style>

<body>
  <div class="container-fluid" style="background-color: #f7ffff; margin-bottom: 10px;">
    <div class="container">
      <div class="row" style="margin-bottom:10px; ">
        <div class="col-md-8 col-md-offset-2">

          <!--  <img src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/IITIndorelogo.png" alt="logo1" class="img-responsive" style="padding-top: 5px; height: 120px; float: left;"> -->
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
      <!-- <h3 style="text-align:center; color: #414002; font-weight: bold;  font-family: 'Fjalla One', sans-serif!important; font-size: 2em;">Application for Academic Appointment</h3> -->
    </div>
  </div>
  <h3 style="color: #e10425; margin-bottom: 20px; font-weight: bold; text-align: center;font-family: 'Noto Serif', serif;" class="blink_me">Application for Faculty Position</h3>

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
  </style>
  <style type="text/css">
    body {
      padding-top: 30px;
    }

    .form-control {
      margin-bottom: 10px;
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
                <h4>Welcome : <font color="#025198"><strong>Ma&nbsp;Agarwal</strong></font>
                </h4>
              </div>
              <div class="col-md-2">
                <a href="login.php" class="btn btn-sm btn-success  pull-right">Logout</a>
              </div>
            </div>


          </legend>
        </fieldset>

        <!-- publication file upload           -->

        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">


          <!-- Payment file upload           -->


          <input type="hidden" name="ci_csrf_token" value="" />
          <div class="row">

            <div class="col-md-12">
              <div class="panel panel-success ">
                <div class="panel-heading">23. Final Declaration *</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">

                      <textarea style="height:60px" placeholder="" class="form-control input-md" name="my_state" readonly="">
                I hereby declare that I have carefully read and understood the instructions and particulars mentioned in the advertisment and this application form. I further declare that all the entries along with the attachments uploaded in this form are true to the best of my knowledge and belief.
              </textarea>

                      <input type="checkbox" name="decl_status" value="1" required="" />

                    </div>
                    <br />
                    <br />
                    <br />
                    <div class="col-md-4">

                    </div>

                    <!--  <label class="col-md-4"><strong> Name of Applicant</strong></label>
          <div class="col-md-4">
          <input id="name" value="" name="name" type="text" placeholder="Name of the Applicant" class="form-control input-md" required="">
        </div> -->
                  </div>
                </div>
              </div>
            </div>


          </div>

          <h5 style="font-weight: bold; color:red;">Note: The form can be edited till the cutoff date of the rolling advertisment.</h5>
          <hr>
          <div class="form-group">
            <div class="col-md-12">
              <!-- <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/acde" class="btn btn-primary pull-left">BACK</a> -->
              <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/submission_complete" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
              <button type="submit" name="preview" value="preview" class="btn btn-info pull-right">SAVE & SUBMIT</button>
              <!-- <button type="submit" name="submit" value="Submit" class="btn btn-success">SAVE</button> -->


            </div>

            <!-- <div class="col-md-2">

  <button id="submit" type="submit" name="submit" value="Submit" onclick="return confirm_box()" class="btn btn-success pull-right">Final Submission</button>

</div>
 -->

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
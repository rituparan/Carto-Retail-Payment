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
    $conn = mysqli_connect($server, $username, $password , $database );

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } 


    echo $app_no;

    require_once __DIR__ .'/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();

    $stylesheet = file_get_contents('style.css');
    $html = file_get_contents('pdf.html');

    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

    // $html = "<table>";

    
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
      $query = mysqli_query($conn , $sql);

      if( mysqli_num_rows($query) > 0 ) {
        // $count = 1;
        foreach($query as $data ) {
          $html .= '

              <tr>
                <td width="30%">'.$data["university"].'</td>
                <td width="12%">'.$data["department"].'</td>
                <td width="17%">'.$data["Name_of_PhD_Supervisor"].'</td>
                <td width="10%">'.$data["Year_of_Joining"].'</td>
                <td width="15%">'.$data["Date_of_Successful_Thesis_Defence"].'</td>
                <td width="15%">'.$data["Title_of_PhD_Thesis"].'</td>
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
          $query = mysqli_query($conn , $sql);
    
          if( mysqli_num_rows($query) > 0 ) {
            // $count = 1;
            foreach($query as $data ) {
              $html .= '


                    <tr>
                      <td width="10%">'.$data["degree"].'</td>
                      <td width="25%">'.$data["university"].'</td>
                      <td width="20%">'.$data["stream"].'</td>
                      <td width="10%">'.$data["Year_of_Joining"].'</td>
                      <td width="12%">'.$data["Year_of_Completion"].'</td>
                      <td width="10%">'.$data["duration"].'</td>
                      <td width="30%">'.$data["cgpa"].'</td>
                      <td width="30%">'.$data["division"].'</td>

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
  
              </table>'
              
            ;


            $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
  


        $sql = "Select * from ug_details where APP_NO = '$app_no'";
          $query = mysqli_query($conn , $sql);
    
          $html = '
        
          <table class = "tab">';
        
          if( mysqli_num_rows($query) > 0 ) {
            // $count = 1;
            foreach($query as $data ) {
              $html .= '

                <tr>
                  <td width="10%">'.$data["degree"].'</td>
                  <td width="25%">'.$data["university"].'</td>
                  <td width="20%">'.$data["stream"].'</td>
                  <td width="10%">'.$data["yoj"].'</td>
                  <td width="12%">'.$data["yoc"].'</td>
                  <td width="10%">'.$data["duration"].'</td>
                  <td width="30%">'.$data["percentage"].'</td>
                  <td width="30%">'.$data["division"].'</td>
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
          $query = mysqli_query($conn , $sql);
    
          if( mysqli_num_rows($query) > 0 ) {
            
            foreach($query as $data ) {
              $html .= '
              
                <tr>
                  <td width = "30%">'.$data["standard"].'</td>
                  <td width = "25%">'.$data["school"].'</td>
                  <td width = "15%">'.$data["year_of_passing"].'</td>
                  <td width = "15%">'.$data["percentage/grade"].'</td>
                  <td width = "15%">'.$data["division"].'</td>
                  
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
        $query = mysqli_query($conn , $sql);
  
        if( mysqli_num_rows($query) > 0 ) {
          
          foreach($query as $data ) {
            $html .= '
            
              <tr>
                <td width = "10%;">'.$data["degree"].'</td>
                <td width = "25%;">'.$data["university"].'</td>
                <td width = "20%;">'.$data["branch"].'</td>
                <td width = "10%;">'.$data["yoj"].'</td>
                <td width = "12%;">'.$data["yoc"].'</td>
                <td width = "10%;">'.$data["duration"].'</td>
                <td width = "30%;">'.$data["percentage"].'</td>
                <td width = "30%;">'.$data["division"].'</td>
                
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
        $query = mysqli_query($conn , $sql);
  
        if( mysqli_num_rows($query) > 0 ) {
          
          foreach($query as $data ) {
            $html .= '
            
              <tr>
                <td width = "15%">'.$data["position"].'</td>
                <td width = "40%">'.$data["OrganizationInstitution"].'</td>
                <td width = "15%">'.$data["DateOfJoining"].'</td>
                <td width = "15%">'.$data["DateOfLeaving"].'</td>
                <td width = "15%">'.$data["DurationYears"].'</td>
                
                
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
        $query = mysqli_query($conn , $sql);
  
        if( mysqli_num_rows($query) > 0 ) {
          
          foreach($query as $data ) {
            $html .= '
            
              <tr>
                <td width = "18%">'.$data["Position"].'</td>
                <td width = "40%">'.$data["Organization"].'</td>
                <td width = "15%">'.$data["Date_of_Joining"].'</td>
                <td width = "15%">'.$data["Date_of_Leaving"].'</td>
                <td width = "15%">'.$data["duration"].'</td>
                
                
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
        $query = mysqli_query($conn , $sql);
  
        if( mysqli_num_rows($query) > 0 ) {
          
          foreach($query as $data ) {
            $html .= '
            
              <tr>
                <td width = "25%">'.$data["position"].'</td>
                <td width = "30%">'.$data["employer"].'</td>
                <td width = "30%">'.$data["CourseTaught"].'</td>
                <td width = "30%">'.$data["UG_PG<"].'</td>
                <td width = "25%">'.$data["NoOfStudents"].'</td>
                <td width = "20%">'.$data["DateOfJoining"].'</td>
                <td width = "20%">'.$data["DateOfLeaving"].'</td>
                <td width = "15%">'.$data["Duration"].'</td>
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
        $query = mysqli_query($conn , $sql);
  
        if( mysqli_num_rows($query) > 0 ) {
          
          foreach($query as $data ) {
            
            $html .= '
              
              <tr>
                <td width = "10%">'.$data["position"].'</td>
                <td width = "20%">'.$data["Institute"].'</td>
                <td width = "20%">'.$data["Supervisor"].'</td>
                <td width = "10%">'.$data["DateOfJoining"].'</td>
                <td width = "10%">'.$data["DateOfLeaving"].'</td>
                <td width = "10%">'.$data["duration"].'</td>
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
        $query = mysqli_query($conn , $sql);
  
        if( mysqli_num_rows($query) > 0 ) {
          
          foreach($query as $data ) {
            
            $html .= '
              
              <tr>
                <td width = "20%">'.$data["organization"].'</td>
                <td width = "20%">'.$data["WorkProfile"].'</td>
                <td width = "10%">'.$data["DateOfJoining"].'</td>
                <td width = "10%">'.$data["DateOfLeaving"].'</td>
                <td width = "10%">'.$data["Duration"].'</td>
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
        $query = mysqli_query($conn , $sql);
  
        if( mysqli_num_rows($query) > 0 ) {
          
          foreach($query as $data ) {
            
            $html .= '
              
              <tr>
                <td width = "35%">'.$data["area_of_specialization"].'</td>
                <td width = "25%">'.$data["current_area_of_research"].'</td>
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
      $query = mysqli_query($conn , $sql);


      $html = '<table class = "tab">';

        if( mysqli_num_rows($query) > 0 ) {
            $count = 1;
          foreach($query as $data ) {
            
            $html .= '
              
              <tr>
                <td width = "8%">'.$data["SNo"].'</td>
                <td width = "35%">'.$data["nameOfSociety"].'</td>
                <td width = "25%">'.$data["status"].'</td>
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
            $query = mysqli_query($conn , $sql);
      
            $html = '<table class = "tab">';
      
              if( mysqli_num_rows($query) > 0 ) {
                  // $count = 1;
                foreach($query as $data ) {
                  
                  $html .= '
                    
                    <tr>
                      <td width = "8%">'.$data["SNo"].'</td>
                      <td width = "35%">'.$data["TypeOfTrainingReceived"].'</td>
                      <td width = "25%">'.$data["Organisation"].'</td>
                      <td width = "25%">'.$data["Year"].'</td>
                      <td width = "25%">'.$data["duration"].'</td>
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
            </table>';
       
             $stylesheet = file_get_contents('style.css');
             $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
             $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
       
             $sql = "Select * from awards_recognitions where APP_NO = '$app_no'";
             $query = mysqli_query($conn , $sql);
        
             $html = '<table class = "tab">';
       
               if( mysqli_num_rows($query) > 0 ) {
                   // $count = 1;
                 foreach($query as $data ) {
                   
                   $html .= '
                     
                     <tr>
                       <td width = "8%">'.$data["SNo"].'</td>
                       <td width = "35%">'.$data["AwardName"].'</td>
                       <td width = "25%">'.$data["Organisation"].'</td>
                       <td width = "25%">'.$data["YearOfAward"].'</td>
                       </tr>
                   ';
                 }
         
                 $html .=  '</table>';
               }
               
               $stylesheet = file_get_contents('style.css');
               $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
               $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);




  
    $mpdf->Output();
    




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
	body { background-color: lightgray; padding-top:0px!important;}

</style>
<body>
<div class="container-fluid" style="background-color: #f7ffff; margin-bottom: 10px;">
	<div class="container">
        <div class="row" style="margin-bottom:10px; ">
        	<div class="col-md-8 col-md-offset-2">

        		<!--  <img src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/IITIndorelogo.png" alt="logo1" class="img-responsive" style="padding-top: 5px; height: 120px; float: left;"> -->

        		<h3 style="text-align:center;color:#414002!important;font-weight: bold;font-size: 2.3em; margin-top: 3px; font-family: 'Noto Sans', sans-serif;">भारतीय प्रौद्योगिकी संस्थान इंदौर</h3>
    			<h3 style="text-align:center;color: #414002!important;font-weight: bold;font-family: 'Oswald', sans-serif!important;font-size: 2.2em; margin-top: 0px;">Indian Institute of Technology Indore</h3>
    			

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
                        <h4>Welcome : <font color="#025198"><strong>Ma&nbsp;Agarwal</strong></font></h4>
                    </div>
                    <div class="col-md-2">
                      <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/facultypanel/logout" class="btn btn-sm btn-success  pull-right">Logout</a>
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
  <button type="submit" name="preview"  value="preview" class="btn btn-info pull-right">SAVE & SUBMIT</button>
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
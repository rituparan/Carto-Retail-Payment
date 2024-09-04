
<?php
session_start();


if( isset($_POST['submit']) ) {
  header("Location:page6_memb.php");
}
else echo "JKJKJK";

?>


<html>
<head>
	<title>Publication Details</title>
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
                $('#dob').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
            });
</script>

<script type="text/javascript">
var tr="";
var counter_jour=1;
// var counter_confer=1;
var counter_book=1;
var counter_book_chapter=1;
var counter_patent=1;
  $(document).ready(function(){

    $("#add_more_jour").click(function(){
        create_tr();
        create_serial('jour');
        create_input('author[]', 'Author', 'author'+counter_jour,'jour', counter_jour, 'jour');
        create_input('title[]', 'Title', 'title'+counter_jour,'jour', counter_jour, 'jour');
        create_input('journal[]', 'Journal', 'journal'+counter_jour,'jour', counter_jour, 'jour');
        create_input('year[]', 'Year, Vol., Page', 'year'+counter_jour,'jour', counter_jour, 'jour');
        create_input('impact[]', 'Impact Factor','impact'+counter_jour, 'jour', counter_jour, 'jour');
        create_input('doi[]', 'DOI','doi'+counter_jour, 'jour', counter_jour, 'jour');
        create_input('status[]', 'Status', 'status'+counter_jour,'jour', counter_jour,'jour',true, true);
        counter_jour++;
        return false;
    });

    // $("#add_more_confer").click(function(){
    //     create_tr();
    //     create_serial('confer');
    //     create_input('cname[]', 'Conference','cname'+counter_confer, 'confer',counter_confer, 'confer');
    //     create_input('ctitle[]', 'Title', 'ctitle'+counter_confer,'confer',counter_confer, 'confer');
    //     create_input('cyear[]', 'Year', 'cyear'+counter_confer,'confer',counter_confer, 'confer',true);
    //     counter_confer++;
    //     return false;
    // });

    $("#add_more_book").click(function(){
        create_tr();
        create_serial('book');
        create_input('bauthor[]', 'Book','bauthor'+counter_book, 'book',counter_book, 'book');
        create_input('btitle[]', 'Title of the Book', 'btitle'+counter_book,'book',counter_book, 'book');
        create_input('byear[]', 'Year', 'byear'+counter_book,'book',counter_book, 'book');
        create_input('bisbn[]', 'ISBN', 'bisbn'+counter_book,'book',counter_book, 'book',true);
        // create_input('bstatus[]', 'Status', 'bstatus'+counter_book,'book', counter_book,'book',true, true);
        // create_input('dol[]', 'Date of Leaving', 'dol'+counter_exp,'exp',counter_exp, 'exp');
        // create_input('duration2[]', 'Duration','duration2'+counter_exp, 'exp',counter_exp,'exp', true);
        // //create_input('perce[]', 'Percentage', 'perce'+counter_exp,'exp', true);
        counter_book++;
        return false;
    });


    $("#add_more_book_chapter").click(function(){
        create_tr();
        create_serial('book_chapter');
        create_input('bc_author[]', 'Book Chapter','bc_author'+counter_book_chapter, 'book_chapter',counter_book_chapter, 'book_chapter');
        create_input('bc_title[]', 'Title', 'bc_title'+counter_book_chapter,'book_chapter',counter_book_chapter, 'book_chapter');
        create_input('bc_year[]', 'Year', 'bc_year'+counter_book_chapter,'book_chapter',counter_book_chapter, 'book_chapter');
        create_input('bc_isbn[]', 'ISBN', 'bc_isbn'+counter_book_chapter,'book_chapter',counter_book_chapter, 'book_chapter',true);
        counter_book_chapter++;
        return false;
    });


    $("#add_more_patent").click(function(){
        create_tr();
         create_serial('patent');
        create_input('pauthor[]', 'Inventor(s)','pauthor'+counter_patent, 'patent',counter_patent, 'patent');
        // create_input('p_year[]', 'Year of the patent','p_year'+counter_patent, 'patent',counter_patent, 'patent');
        create_input('ptitle[]', 'Title of Patent', 'ptitle'+counter_patent,'patent',counter_patent, 'patent');
        create_input('p_country[]', 'Country of patent','p_country'+counter_patent, 'patent',counter_patent, 'patent');
        create_input('p_number[]', 'Patent Number','p_number'+counter_patent, 'patent',counter_patent, 'patent');
        create_input('pyear_filed[]', 'DD/MM/YYYY','pyear_filed'+counter_patent, 'patent',counter_patent, 'patent');
        create_input('pyear_published[]', 'DD/MM/YYYY','pyear_published'+counter_patent, 'patent',counter_patent, 'patent');
        create_input('pyear_issued[]', 'DD/MM/YYYY','pyear_issued'+counter_patent, 'patent',counter_patent, 'patent',true);
        // create_input('pyear[]', 'Year', 'pyear'+counter_patent,'patent',counter_patent, 'patent',true);
        // create_input('pstatus[]', 'Status', 'pstatus'+counter_patent,'patent', patent,'patent',true, true);
        // create_input('dol[]', 'Date of Leaving', 'dol'+counter_exp,'exp',counter_exp, 'exp');
        // create_input('duration2[]', 'Duration','duration2'+counter_exp, 'exp',counter_exp,'exp', true);
        // //create_input('perce[]', 'Percentage', 'perce'+counter_exp,'exp', true);
        counter_patent++;
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
  function create_input(t_name, place_value, id, tbody_id, counter, remove_name, btn=false, select=false)
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
      sel.innerHTML+="<option value='published'>Published</option>";
      sel.innerHTML+="<option value='accepted'>Accepted</option>";
      // sel.innerHTML+="<option value='in_preparation'>In-Preparation</option>";
      var td=document.createElement("td");
      td.appendChild(sel);
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
    //var tbody=document.getElementById(tbody_id);
    //console.log(tbody[1].childNodes);
    // var row=tbody[0].getElementByTagName("tr");
    // var td=row[0].getElementByTagName("td");
    // td.innerHTML=i;
    // for(var i=1; i<=x; i++)
    // {
    //     var tbody=document.getElementById(tbody_id);
    //     var row=tbody[0].getElementByTagName("tr");
    //     var td=row[0].getElementByTagName("td");
    //     td.innerHTML=i;
    // }
  }
</script>
        
<!-- all bootstrap buttons classes -->
<!-- 
  class="btn btn-sm, btn-lg, "
  color - btn-success, btn-primary, btn-default, btn-danger, btn-info, btn-warning
-->



<a href='https://ofa.iiti.ac.in/facrec_che_2023_july_02/layout'></a>

<div class="container">
  
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-8 well">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="ci_csrf_token" value="" />
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

             

    
            <!-- Form Name -->
            
              
            <!-- Text input-->
           
            <h4 style="text-align:center; font-weight: bold; color: #6739bb;">5. Summary of Publications *</h4>
            <div class="row">
              <div class="col-md-12">
              <div class="panel panel-success">
              <div class="panel-body">

                <span class="col-md-5 control-label" for="summary_journal_inter">Number of International Journal Papers</span>  
                <div class="col-md-1">
                <input id="summary_journal_inter" value="Sed" name="summary_journal_inter" type="text" placeholder="" class="form-control input-md" required="" maxlength="3">
                </div>

                <span class="col-md-5 control-label" for="summary_journal">Number of National Journal Papers</span>  
                <div class="col-md-1">
                <input id="summary_journal" value="Ea " name="summary_journal" type="text" placeholder="" class="form-control input-md" required="" maxlength="3">
                </div>

                <span class="col-md-5 control-label" for="summary_conf_inter">Number of International Conference Papers</span>  
                <div class="col-md-1">
                <input id="summary_conf_inter" value="Deb" name="summary_conf_inter" type="text" placeholder="" class="form-control input-md" required="" maxlength="3">
                </div>

                <span class="col-md-5 control-label" for="summary_conf_national">Number of National Conference Papers</span>  
                <div class="col-md-1">
                <input id="summary_conf_national" value="Mol" name="summary_conf_national" type="text" placeholder="" class="form-control input-md" required="" maxlength="3">
                </div>

                <span class="col-md-5 control-label" for="patent_publish">Number of Patent(s) [Filed, Published, Granted] </span>  
                <div class="col-md-1">
                <input id="patent_publish" value="Qua" name="patent_publish" type="text" placeholder="" class="form-control input-md" required="" maxlength="3">
                </div>

                <span class="col-md-5 control-label" for="summary_book">Number of Book(s) </span>  
                <div class="col-md-1">
                <input id="summary_book" value="Ill" name="summary_book" type="text" placeholder="" class="form-control input-md" required="" maxlength="3">
                </div>

                <span class="col-md-5 control-label" for="summary_book_chapter">Number of Book Chapter(s)</span>  
                <div class="col-md-1">
                <input id="summary_book_chapter" value="Dig" name="summary_book_chapter" type="text" placeholder="" class="form-control input-md" required="" maxlength="3">
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
                  <button class="btn btn-sm btn-danger" id="add_more_jour">Add Details</button>
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
                     
                      <td class="col-md-1"> 
                        1                        </td>
                      <td class="col-md-2"> 
                          <input id="author1" name="author[]" type="text" value="Quibusdam vel sunt quisquam ipsa repellat."  placeholder="Author" class="form-control input-md"> 
                        </td>
                      <td class="col-md-2"> 
                        <input id="title1" name="title[]" type="text" value="Forward Paradigm Liaison"  placeholder="Title" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="journal1" name="journal[]" type="text" value="Reinhold Lowe"  placeholder="Journal Name" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="year1" name="year[]" type="text" value="Rerum cupiditate fugit deserunt provident recusandae dicta."  placeholder="Year of publication" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="impact1" name="impact[]" type="text" value="Minima aperiam eveniet quos amet doloribus commodi dolore aliquam porro."  placeholder="Impact Factor" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="doi1" name="doi[]" type="text" value="Libero sint sequi."  placeholder="DOI" class="form-control input-md"> 
                      </td>

                      
                      <td class="col-md-2"> 
                        
                        <select id="status" name="status[]" class="form-control input-md">
                            <option value="">Select</option>
                            <option  value="published">Published</option>
                            <option selected='selected' value="accepted">Accepted</option>
                            
                        </select>

                      </td>
                    </tr>
                                        
                    <tr height="60px">
                     
                      <td class="col-md-1"> 
                        2                        </td>
                      <td class="col-md-2"> 
                          <input id="author2" name="author[]" type="text" value="Enim excepturi eos facere officiis quo."  placeholder="Author" class="form-control input-md"> 
                        </td>
                      <td class="col-md-2"> 
                        <input id="title2" name="title[]" type="text" value="Product Operations Liaison"  placeholder="Title" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="journal2" name="journal[]" type="text" value="Freda Hegmann"  placeholder="Journal Name" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="year2" name="year[]" type="text" value="Veritatis quia quod laboriosam corrupti enim harum dolorum excepturi voluptatum."  placeholder="Year of publication" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="impact2" name="impact[]" type="text" value="Maxime debitis accusantium."  placeholder="Impact Factor" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="doi2" name="doi[]" type="text" value="Quia alias dolor veritatis eos illum."  placeholder="DOI" class="form-control input-md"> 
                      </td>

                      
                      <td class="col-md-2"> 
                        
                        <select id="status" name="status[]" class="form-control input-md">
                            <option value="">Select</option>
                            <option  value="published">Published</option>
                            <option selected='selected' value="accepted">Accepted</option>
                            
                        </select>

                      </td>
                    </tr>
                                        
                    <tr height="60px">
                     
                      <td class="col-md-1"> 
                        3                        </td>
                      <td class="col-md-2"> 
                          <input id="author3" name="author[]" type="text" value="Sit optio facere consectetur tempora laborum esse."  placeholder="Author" class="form-control input-md"> 
                        </td>
                      <td class="col-md-2"> 
                        <input id="title3" name="title[]" type="text" value="Product Markets Orchestrator"  placeholder="Title" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="journal3" name="journal[]" type="text" value="Whitney Mills"  placeholder="Journal Name" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="year3" name="year[]" type="text" value="Enim distinctio qui saepe veritatis expedita."  placeholder="Year of publication" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="impact3" name="impact[]" type="text" value="Provident fugit praesentium excepturi placeat quos eligendi debitis."  placeholder="Impact Factor" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="doi3" name="doi[]" type="text" value="Natus sit ducimus."  placeholder="DOI" class="form-control input-md"> 
                      </td>

                      
                      <td class="col-md-2"> 
                        
                        <select id="status" name="status[]" class="form-control input-md">
                            <option value="">Select</option>
                            <option selected='selected' value="published">Published</option>
                            <option  value="accepted">Accepted</option>
                            
                        </select>

                      </td>
                    </tr>
                                        
                    <tr height="60px">
                     
                      <td class="col-md-1"> 
                        4                        </td>
                      <td class="col-md-2"> 
                          <input id="author4" name="author[]" type="text" value="Quidem eius adipisci enim itaque architecto ipsum earum possimus."  placeholder="Author" class="form-control input-md"> 
                        </td>
                      <td class="col-md-2"> 
                        <input id="title4" name="title[]" type="text" value="Global Accountability Orchestrator"  placeholder="Title" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="journal4" name="journal[]" type="text" value=""  placeholder="Journal Name" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="year4" name="year[]" type="text" value="Alias ducimus earum dolore saepe ea necessitatibus."  placeholder="Year of publication" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="impact4" name="impact[]" type="text" value="Repellendus natus repellendus consequatur ad enim adipisci deserunt numquam unde."  placeholder="Impact Factor" class="form-control input-md"> 
                      </td>
                      <td class="col-md-2"> 
                        <input id="doi4" name="doi[]" type="text" value="Vero impedit similique harum."  placeholder="DOI" class="form-control input-md"> 
                      </td>

                      
                      <td class="col-md-2"> 
                        
                        <select id="status" name="status[]" class="form-control input-md">
                            <option value="">Select</option>
                            <option  value="published">Published</option>
                            <option selected='selected' value="accepted">Accepted</option>
                            
                        </select>

                      </td>
                    </tr>
                                      </tbody>
                </table>

               </div>
              
            </div>

              
            </div> 
 
                <!-- Conference input-->
                
            <!--  <div class="container-fluid table-responsive">
              <div class="row">

                <div class="panel panel-success">
                 <div class="panel-heading">(B) Conference (List of 10 Best Publications)&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-sm btn-danger" id="add_more_confer">Add Details</button>
                </div>
                 <table class="table table-bordered">
                     <tbody id="confer">
                     
                     <tr height="30px">
                       <th class="col-md-2"> S. No. </th>
                       <th class="col-md-3"> Name of the Conference</th>
                       <th class="col-md-5"> Title of Paper </th>
                       <th class="col-md-2"> Year </th>
                     </tr>


                                        </tbody>
                 </table>
            </div>

              
            </div> 
          </div> -->

           <!-- Patent Text -->

             <div class="container-fluid table-responsive">

              <h4 style="text-align:center; font-weight: bold; color: #6739bb;">7. List of  Patent(s), Book(s), Book Chapter(s)</h4>
             <div class="row">

           <div class="panel panel-success">
            <div class="panel-heading">(A) Patent(s)&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_patent">Add Details</button>  </div>
            <table class="table table-bordered">
                <tbody id="patent">
                
                <tr height="30px">
                  <th class="col-md-1"> S. No.</th>
                  <th class="col-md-1"> Inventor(s) </th>
                  <!-- <th class="col-md-2"> Year of Patent </th> -->
                  <th class="col-md-2"> Title of Patent </th>
                  <th class="col-md-1"> Country of Patent </th>
                  <th class="col-md-1"> Patent Number</th>
                  <th class="col-md-1"> Date of Filing</th>
                  <th class="col-md-1"> Date of Published</th>
                  <th class="col-md-1"> Status Filed/Published/Granted</th>
                  <!-- <th class="col-md-1"> Date of Filed/Published (If not granted, mention "Awaited")</th> -->
                </tr>


                                
                <tr height="60px">
                 
                  <td class="col-md-1"> 
                    1                    </td>
                  <td class="col-md-1"> 
                      <input id="pauthor1" name="pauthor[]" type="text" value="LMFXclcu3JKj6Xb"  placeholder="Author(s)" class="form-control input-md" required=""> 
                    </td>
                 <!--  <td class="col-md-2"> 
                    <input id="p_year1" name="p_year[]" type="text" value=""  placeholder="Year" class="form-control input-md" required=""> 
                  </td> -->
                  <td class="col-md-1"> 
                    <input id="ptitle1" name="ptitle[]" type="text" value="Regional Marketing Analyst"  placeholder="Title" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="p_country1" name="p_country[]" type="text" value="Mozambique"  placeholder="Country" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="p_number1" name="p_number[]" type="text" value="626"  placeholder="Patent Number" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="pyear_filed1" name="pyear_filed[]" type="text" value="Quia placeat nulla voluptatibus perferendis nostrum aspernatur hic."  placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
                   <td class="col-md-1"> 
                    <input id="pyear_published1" name="pyear_published[]" type="text" value="Tenetur delectus dolor a dignissimos consequatur nemo."  placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
                   <td class="col-md-1"> 
                    <input id="pyear_issued1" name="pyear_issued[]" type="text" value="Alias id facilis quidem expedita debitis eius necessitatibus esse ducimus."  placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
             
                </tr>
                                
                <tr height="60px">
                 
                  <td class="col-md-1"> 
                    2                    </td>
                  <td class="col-md-1"> 
                      <input id="pauthor2" name="pauthor[]" type="text" value="UyE3068CIS7wx8R"  placeholder="Author(s)" class="form-control input-md" required=""> 
                    </td>
                 <!--  <td class="col-md-2"> 
                    <input id="p_year2" name="p_year[]" type="text" value=""  placeholder="Year" class="form-control input-md" required=""> 
                  </td> -->
                  <td class="col-md-1"> 
                    <input id="ptitle2" name="ptitle[]" type="text" value="Dynamic Assurance Developer"  placeholder="Title" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="p_country2" name="p_country[]" type="text" value="Virgin Islands, U.S."  placeholder="Country" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="p_number2" name="p_number[]" type="text" value="38"  placeholder="Patent Number" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="pyear_filed2" name="pyear_filed[]" type="text" value="Occaecati commodi debitis voluptatum aut molestias pariatur odio."  placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
                   <td class="col-md-1"> 
                    <input id="pyear_published2" name="pyear_published[]" type="text" value="Velit doloremque explicabo esse."  placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
                   <td class="col-md-1"> 
                    <input id="pyear_issued2" name="pyear_issued[]" type="text" value="Laborum cum nam nam eos aliquid maiores optio."  placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
             
                </tr>
                                
                <tr height="60px">
                 
                  <td class="col-md-1"> 
                    3                    </td>
                  <td class="col-md-1"> 
                      <input id="pauthor3" name="pauthor[]" type="text" value="iMwlvzGiuPVmMhv"  placeholder="Author(s)" class="form-control input-md" required=""> 
                    </td>
                 <!--  <td class="col-md-2"> 
                    <input id="p_year3" name="p_year[]" type="text" value=""  placeholder="Year" class="form-control input-md" required=""> 
                  </td> -->
                  <td class="col-md-1"> 
                    <input id="ptitle3" name="ptitle[]" type="text" value="Direct Factors Executive"  placeholder="Title" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="p_country3" name="p_country[]" type="text" value="Heard Island and McDonald Islands"  placeholder="Country" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="p_number3" name="p_number[]" type="text" value="506"  placeholder="Patent Number" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="pyear_filed3" name="pyear_filed[]" type="text" value="Aperiam quas ipsum."  placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
                   <td class="col-md-1"> 
                    <input id="pyear_published3" name="pyear_published[]" type="text" value="Ducimus possimus corrupti ab veniam eum."  placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
                   <td class="col-md-1"> 
                    <input id="pyear_issued3" name="pyear_issued[]" type="text" value="Impedit reprehenderit excepturi nemo rerum eum recusandae nostrum eos."  placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
             
                </tr>
                              </tbody>
            </table>
          </div>
             
           </div>

            
           </div>

            <!-- Book Text -->

             <div class="container-fluid table-responsive">
              <div class="row">

             <div class="panel panel-success">
             <div class="panel-heading">(B) Book(s) &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_book">Add Details</button></div>

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
                  
                   <td class="col-md-1"> 
                     1                     </td>
                   <td class="col-md-4"> 
                       <input id="bauthor1" name="bauthor[]" type="text" value="Sit quod veniam quisquam facere debitis."  placeholder="Author" class="form-control input-md" required=""> 
                     </td>
                   <td class="col-md-3"> 
                     <input id="btitle1" name="btitle[]" type="text" value="Lead Configuration Officer"  placeholder="Title" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="byear1" name="byear[]" type="text" value="Dignissimos a delectus eum similique at."  placeholder="Year of" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="bisbn1" name="bisbn[]" type="text" value="Tempora id quaerat sit inventore quidem consequatur."  placeholder="" class="form-control input-md" required=""> 
                   </td>
               
                 </tr>
                                  
                 <tr height="60px">
                  
                   <td class="col-md-1"> 
                     2                     </td>
                   <td class="col-md-4"> 
                       <input id="bauthor2" name="bauthor[]" type="text" value="Eveniet asperiores deleniti earum accusantium ex facilis quaerat."  placeholder="Author" class="form-control input-md" required=""> 
                     </td>
                   <td class="col-md-3"> 
                     <input id="btitle2" name="btitle[]" type="text" value="Internal Assurance Representative"  placeholder="Title" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="byear2" name="byear[]" type="text" value="Vel non voluptates aperiam molestias nihil architecto."  placeholder="Year of" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="bisbn2" name="bisbn[]" type="text" value="Sed laudantium quo iure temporibus."  placeholder="" class="form-control input-md" required=""> 
                   </td>
               
                 </tr>
                                  
                 <tr height="60px">
                  
                   <td class="col-md-1"> 
                     3                     </td>
                   <td class="col-md-4"> 
                       <input id="bauthor3" name="bauthor[]" type="text" value="Harum incidunt voluptates ipsa."  placeholder="Author" class="form-control input-md" required=""> 
                     </td>
                   <td class="col-md-3"> 
                     <input id="btitle3" name="btitle[]" type="text" value="District Brand Coordinator"  placeholder="Title" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="byear3" name="byear[]" type="text" value="Odit officiis sit deserunt beatae."  placeholder="Year of" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="bisbn3" name="bisbn[]" type="text" value="Assumenda illum ad."  placeholder="" class="form-control input-md" required=""> 
                   </td>
               
                 </tr>
                                </tbody>
             </table>
            </div>
              
            
            </div>

             
            </div>


            <br />
            <br />

            <!-- Book chapter Text -->

             <div class="container-fluid table-responsive">
              <div class="row">

             <div class="panel panel-success">
             <div class="panel-heading">(C) Book Chapter(s)&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_book_chapter">Add Details</button></div>

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
                  
                   <td class="col-md-1"> 
                     1                     </td>
                   <td class="col-md-4"> 
                       <input id="bc_author1" name="bc_author[]" type="text" value="Odit quibusdam neque debitis molestiae numquam repudiandae cupiditate non beatae."  placeholder="Author" class="form-control input-md" required=""> 
                     </td>
                   <td class="col-md-3"> 
                     <input id="bc_title1" name="bc_title[]" type="text" value="Central Directives Supervisor"  placeholder="Title" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="bc_year1" name="bc_year[]" type="text" value="Ipsam harum enim vel consequuntur."  placeholder="Year of" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="bc_isbn1" name="bc_isbn[]" type="text" value="Modi eius amet culpa."  placeholder="" class="form-control input-md" required=""> 
                   </td>
               
                 </tr>
                                  
                 <tr height="60px">
                  
                   <td class="col-md-1"> 
                     2                     </td>
                   <td class="col-md-4"> 
                       <input id="bc_author2" name="bc_author[]" type="text" value="Deserunt soluta dolores perferendis dolore."  placeholder="Author" class="form-control input-md" required=""> 
                     </td>
                   <td class="col-md-3"> 
                     <input id="bc_title2" name="bc_title[]" type="text" value="Internal Group Designer"  placeholder="Title" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="bc_year2" name="bc_year[]" type="text" value="Quae esse esse reprehenderit nam neque saepe facilis."  placeholder="Year of" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="bc_isbn2" name="bc_isbn[]" type="text" value="Saepe dolores illo."  placeholder="" class="form-control input-md" required=""> 
                   </td>
               
                 </tr>
                                  
                 <tr height="60px">
                  
                   <td class="col-md-1"> 
                     3                     </td>
                   <td class="col-md-4"> 
                       <input id="bc_author3" name="bc_author[]" type="text" value="Facere fugit neque aspernatur molestiae deserunt odio ipsum."  placeholder="Author" class="form-control input-md" required=""> 
                     </td>
                   <td class="col-md-3"> 
                     <input id="bc_title3" name="bc_title[]" type="text" value="Customer Security Developer"  placeholder="Title" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="bc_year3" name="bc_year[]" type="text" value="Deserunt necessitatibus velit possimus voluptatum explicabo asperiores nostrum possimus."  placeholder="Year of" class="form-control input-md" required=""> 
                   </td>
                   <td class="col-md-2"> 
                     <input id="bc_isbn3" name="bc_isbn[]" type="text" value="Beatae consectetur corrupti voluptatibus sequi aliquid quibusdam."  placeholder="" class="form-control input-md" required=""> 
                   </td>
               
                 </tr>
                                </tbody>
             </table>
            </div>
              
            
            </div>

             
            </div>


            <br />
            <br />
            

 

            <h4 style="text-align:center; font-weight: bold; color: #6739bb;">8. Google Scholar Link *</h4>
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-success">
            <div class="panel-heading">URL</div>
            <div class="panel-body">
              <span class="col-md-2 control-label" for="google_link">Google Scholar Link </span>  
              <div class="col-md-10">
              <input id="google_link" value="Exercitationem excepturi commodi magnam placeat impedit illum eligendi nobis." name="google_link" type="text" placeholder="Google Scholar Link" class="form-control input-md" required="">
              </div>

              

            </div>
            </div>
            </div>
            </div>


            <!-- Button -->
<div class="form-group">

  <div class="col-md-1">
    <a href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/employment_details" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-fast-backward"></i></a>
  </div>

<div class="col-md-11">
  <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE & NEXT</button>
  
</div>

             
            </div>
           

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
<?php
//Script for uploading the file

//Giving the realpath for the uploaded file to get stored

ini_set('max_execution_time', 3000);

$target_dir="/opt/lampp/htdocs/inria/uploads/";

//Naming the file for further purpose
date_default_timezone_set('Europe/London');


//Extracting the current time and date
$time = date('Y-m-d H:i:s');

//echo $time;

//This will create a unique name for all the files that are being uploaded 
//Creation of a trigger is necessary for the file, which will ensure that it gets deleted on it's own after 1 hour.
$unique_id = $_GET["id"];
$target_file = $target_dir.$unique_id.$time.basename($_FILES["fileToUpload"]["name"]);

$uploadOk=1;

//The following statement will give the format of the file which the user has uploaded
$FileType=pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"]))
{
	
	
	if(!empty($_FILES["fileToUpload"]))
	{
       

     //This is redundant as we already are creating unique names for the files which are being uploaded - So this is an optional step
        if(file_exists($target_file))
        {
        	echo "File already exists";
        	$uploadOk=0;
        }

        
        if($uploadOk==0)
        {
        	echo "Sorry File cannot be uploaded to the directory";
        }


        else
        {
        	//On this if statement beign true, the file will get uploaded to the directory
           if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
           {
           	//echo "The file ".basename($_FILES["fileToUpload"]["name"])." has been uploaded<br />";

           	//A file has been uploaded by the user in the given directory and it will be used by the following 
           	//lines to pass it onto the ALLGO engine

           	//The ALLGO engine will compute the Genome Assembly and return us back with a file which will be used for various data analysis
            //The file is not passed to the ALLGO engine for the assembly
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://allgo.inria.fr/api/v1/jobs");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-type: multipart/form-data','Authorization: Token token=');
            //curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(array('job[webapp_id]' => '122','job[params]'=> "''")));
            //$fields = array('job' => array('webapp_id' => "122",'file_url' => urlencode("https://upload.wikimedia.org/wikipedia/en/5/5f/Original_Doge_meme.jpg")));
                    //urlencode(base64_encode('image1')),
            //$fields = array('webapp_id'=>"122",'file_url'=>"https://upload.wikimedia.org/wikipedia/en/5/5f/Original_Doge_meme.jpg");

            //$fields = array('webapp_id'=>"122",'files[0]'=>"@".$_FILES["fileToUpload"]["tmp_name"]); 

            //$fields = array('webapp_id'=>"122",'file_url'=>"localhost/inria/small_test_reads.fa");

            //url-ify the data for the POST
            //$field_string = http_build_query($fields,null, '&', PHP_QUERY_RFC3986);


            $file_location = "https://localhost/inria/uploads/".$unique_id.$time.basename($_FILES["fileToUpload"]["name"]);
            $fields = array('webapp_id'=>"122",'file_url'=>"http://gatb-pipeline.gforge.inria.fr/test/small_test_reads.fa.gz");
            //$fields = array('webapp_id'=>"122",'file_url'=>"https://localhost/inria/upload.php/small_test_reads.fa.gz");

            $fields_string = http_build_query(array('job' => $fields));
            //var_dump($fields_string);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
           //var_dump($fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //print "running the request";
            $server_output = curl_exec ($ch);
//
            curl_close ($ch);
            //print $server_output;



            // Now the file has been passed and we get an unique id 


            if(strpos($server_output,"id"))
            {
             //echo "Id is available";
             $pos_id = strpos($server_output,"id"); 
            }

            $pos_id=$pos_id + 4;

            $job_id="";

            while($server_output[$pos_id]!=",")
            {
             $job_id = $job_id. $server_output[$pos_id];
             $pos_id = $pos_id + 1;
            }
            


// The following piece of code will 

$ch = curl_init();
$var = curl_setopt($ch, CURLOPT_URL,"https://allgo.inria.fr/api/v1/jobs/".$job_id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-type: multipart/form-data','Authorization: Token token='));

$output=curl_exec($ch);

// output has to be checked for progress if "status" : "in progress" then wait and run a loader





while(1)
 {
  if(strpos($output,"allgo.log"))
{
   if(strpos($output,"assembly.fasta"))
   {
    //job is completed 
   //echo "Job is completed - Job ID: ".$job_id."<br/>";
   //get the position of output.log to extract the url from it

   $pos=strpos($output,"assembly.fasta");
   
    break;
  
   
   }

   else
   {
      header("Location:index.php");
      exit;
   }
}

   else
   {
     $output=curl_exec($ch);
   }
   // Here usage of an else loop is needed

}


// Procedure for loader
// Parse through the string and check if if output.log is present 
// if output.log is not present then it means that the Allgo engine is still computing the job
// If that is the case then run a loader for that time
// Once we get output.log present in the $output variable, then start with the computation of the visualization
// url to be used : "https://allgo.inria.fr/datastore/35/122/<job_id>/output.log";
//echo $output."<br />";
//echo $output[$pos+14];
// $pos+14 will give the first '"' after which the https://...  will start


//echo $output[$pos+15];

$pos=$pos+19;
$link="";


while($output[$pos]!='"')
{
   $link=$link.$output[$pos];
   $pos=$pos+1;
}


//echo $link;

//Encoded Download link to be provided to the end users

//echo "<a href={$link}>Download your Result</a>";


          //Computation for GC % 
    

          $file = file_get_contents($link);
          $len = strlen($file);
          $g = substr_count($file, "G");
          $c = substr_count($file,"C");
          $total_gc = $g + $c ;

          $percentage = ($total_gc) / $len;
          

          //Computation for number of contigs

          $contig = substr_count($file,"scaffold");


            

           }
          //End of if statement for file upload option

           // This is when the file is nto uploaded properly

           else
           {
             header('Location:index.php');

            exit;
           }
        }
       


	}
}







?>


<!-- Design of the Results Page -->

<!DOCTYPE html>
<html>
<head>
 <title>Results</title>
 <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">

<style type="text/css">

.footer-basic-centered{
  background-color: #292c2f;
  box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
  box-sizing: border-box;
  width: 100%;
  text-align: center;
  font: normal 18px sans-serif;

  padding: 45px;
  margin-top: 80px;
}

.footer-basic-centered .footer-company-motto{
  color:  #8d9093;
  font-size: 24px;
  margin: 0;
}

.footer-basic-centered .footer-company-name{
  color:  #8f9296;
  font-size: 14px;
  margin: 0;
}

.footer-basic-centered .footer-links{
  list-style: none;
  font-weight: bold;
  color:  #ffffff;
  padding: 35px 0 23px;
  margin: 0;
}

.footer-basic-centered .footer-links a{
  display:inline-block;
  text-decoration: none;
  color: inherit;
}

/* If you don't want the footer to be responsive, remove these media queries */

@media (max-width: 600px) {

  .footer-basic-centered{
    padding: 35px;
  }

  .footer-basic-centered .footer-company-motto{
    font-size: 18px;
  }

  .footer-basic-centered .footer-company-name{
    font-size: 12px;
  }

  .footer-basic-centered .footer-links{
    font-size: 14px;
    padding: 25px 0 20px;
  }

  .footer-basic-centered .footer-links a{
    line-height: 1.8;
  }




}

</style>
</head>
<body>

<!-- Creation of the navigation bar -->


<nav class="navbar navbar-default" >
  <div class="container-fluid" style="background-color:black;">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="color:white;font-family:Lato;font-weight:500;">GATB-Web</a>
    </div>
    <ul class="nav navbar-nav" style="font-family:Lato;">
      <li><a href="index.php">Home</a></li>
      <li class="active"><a href="#">Results</a></li>
      <li><a href="#">Docs </a></li>
      <li><a href="#">More Softwares </a></li>
    </ul>
  </div>
</nav>  

<div class="container">
 <div class="row">
  <div class="col-sm-3" style="border:1px solid black;height:450px;font-family:Lato;font-weight:300;font-size:35px;">Filters</div>
  <div class="col-sm-9" style="border:1px solid black;height:450px;font-family:Lato;font-weight:300;font-size:35px;">Visualisation</div>
</div>


<h2 style="font-family:Lato;font-weight:300;font-size:35px;">Data Analysis</h2>


<h3 style="font-family:Lato;font-weight:300;">Your Job ID : <?php echo $job_id;?></h3>
<h4><?php echo "<a href={$link} class='pure-button pure-button-primary' style='font-family:Lato;text-decoration:none;color:white;'>Download your Result</a>" ?></h4>


</div>
<br /><br />
<div class="container">
 <div class="row">
  <div class="col-sm-4 text-center" style="font-family:Lato;font-size:35px;font-weight:700;">GC %
    
      <p style="font-weight:300;font-size:40px;"><?php $percentage=$percentage*100; echo $percentage."%"; ?></p>
  </div>
  

  <div class="col-sm-4 text-center" style="font-family:Lato;font-size:35px;font-weight:700;">No. of Contigs

      <p style="font-weight:300;font-size:40px;"><?php echo $contig; ?></p>
  </div>
    

  <div class="col-sm-4 text-center" style="font-family:Lato;font-size:35px;font-weight:700;">N50</div>
</div>
</div>




<footer class="footer-basic-centered">

      <p class="footer-company-motto">Team Genscale,INRIA</p>

      <p class="footer-links">
        <a href="#">GATB offline</a>
        ·
        <a href="#">Documentation</a>
        ·
        <a href="#">Contact</a>
        ·
        <a href="#">About</a>
        ·
        <a href="#">Faq</a>
        ·
       
      </p>

      <p class="footer-company-name">INRIA/IRISA &copy; 2016</p>

    </footer>

    <script src="http://cdn.tutorialzine.com/misc/enhance/v2.js" async></script>

</body>
</html>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
 


<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

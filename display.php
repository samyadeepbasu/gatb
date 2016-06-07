<?php
//Script for uploading the file

//Giving the realpath for the uploaded file to get stored

ini_set('max_execution_time', 300);

$target_dir="/opt/lampp/htdocs/inria/uploads/";

//Naming the file for further purpose
date_default_timezone_set('Europe/London');


//Extracting the current time and date
$time = date('Y-m-d H:i:s');

//echo $time;

//This will create a unique name for all the files that are being uploaded 
//Creation of a trigger is necessary for the file, which will ensure that it gets deleted on it's own after 1 hour.
$target_file = $target_dir.$_POST["email"].$time.basename($_FILES["fileToUpload"]["name"]);

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
           	echo "The file ".basename($_FILES["fileToUpload"]["name"])." has been uploaded<br />";

           	//A file has been uploaded by the user in the given directory and it will be used by the following 
           	//lines to pass it onto the ALLGO engine

           	//The ALLGO engine will compute the Genome Assembly and return us back with a file which will be used for various data analysis
            //The file is not passed to the ALLGO engine for the assembly
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://allgo.inria.fr/api/v1/jobs");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-type: multipart/form-data','Authorization: Token token=c00eefecd3834fd4acdd0df45c4bb77e'));
            //curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(array('job[webapp_id]' => '122','job[params]'=> "''")));
            //$fields = array('job' => array('webapp_id' => "122",'file_url' => urlencode("https://upload.wikimedia.org/wikipedia/en/5/5f/Original_Doge_meme.jpg")));
                    //urlencode(base64_encode('image1')),
            $fields = array('webapp_id'=>"122",'file_url'=>"https://upload.wikimedia.org/wikipedia/en/5/5f/Original_Doge_meme.jpg");

            //$fields = array('webapp_id'=>"122",'files[1]'=>"@".realpath("small_test_reads.fa")); 

            //$fields = array('webapp_id'=>"122",'file_url'=>"localhost/inria/small_test_reads.fa");

            //url-ify the data for the POST
            //$field_string = http_build_query($fields,null, '&', PHP_QUERY_RFC3986);

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
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-type: multipart/form-data','Authorization: Token token=c00eefecd3834fd4acdd0df45c4bb77e'));

$output=curl_exec($ch);

// output has to be checked for progress if "status" : "in progress" then wait and run a loader





while(1)
 {

   if(strpos($output,"output.log"))
   {
    //job is completed 
   echo "Job is completed - Job ID: ".$job_id."<br/>";
   //get the position of output.log to extract the url from it

   $pos=strpos($output,"output.log");
   
    break;
  
   
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

$pos=$pos+15;
$link="";
echo "<br />";

while($output[$pos]!='"')
{
   $link=$link.$output[$pos];
   $pos=$pos+1;
}


//echo $link;

//Encoded Download link to be provided to the end users

echo "<a href={$link}>Download your Result</a>";
            

           }
          //End of if statement for file upload option

           // This is when the file is nto uploaded properly
           else
           {
           	echo "Sorry, There was an error uploading the file";
           }
        }
       


	}
}





?>

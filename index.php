<?php

  $id = uniqid();
?>

<!DOCTYPE html>
<html>
<head>
<title>GATB-Web </title>

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
<style scoped>


</style>

</head>

<body>

<nav class="navbar navbar-default" >
  <div class="container-fluid" style="background-color:black;">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="color:white;">GATB-Web</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Docs </a></li>
      <li><a href="#">More Softwares </a></li>
    </ul>
  </div>
</nav>


<div class="container">
  <div class="jumbotron">
    <h1>Genome Assembly Tool Box</h1>
    <p>For Bacterial Genomes.</p>

    <p><button class="pure-button pure-button-primary">Go to GATB-Offline</button></p>
  </div>
   <form role="form" action=<?php echo "display.php?id=".$id?> method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="pwd">Enter the Bacterial Genomic File to upload</label>
    <input type="file" name="fileToUpload" id="fileToUpload">
  </div>
    <input type="submit" value="Upload" name="submit" class="pure-button pure-button-primary"> 
</form>

<br />
<!--
  <div class="row">
    <div class="col-sm-4">
      <h3 style="border:solid 1px #E0E0E0;">What is GATB?</h3>
      
    </div>
    <div class="col-sm-4">
      <h3 style="border:solid 1px #E0E0E0;">Why Online?</h3>
    </div>
    <div class="col-sm-4">
      <h3 style="border:solid 1px #E0E0E0;">Utility</h3>
    </div>
  </div>

</div>
-->
<br />

<div class="row" style="height:10px;background-color:#E0E0E0;">


</div>
<br /><br />
<div id="whatis" class="content-section-b" style="border-top: 0">
<div class="container">
<div class="col-md-6 col-md-offset-3 text-center wrap_title">
<h2 style="font-size:45px;font-family:Lato;font-weight: 700;line-height: 1.1;color: inherit;">What is GATB-Web?</h2>
<p></p><br/><br />
</div>
<div class="row">
<div class="col-sm-4 text-center">
<h3 style="font-family:Lato;font-weight:600;">GATB</h3>
<p class="lead">Epsum factorial non deposit quid pro quo hic escorol. Olypian quarrels et gorilla congolium sic ad nauseum. </p>
 
</div> 
<div class="col-sm-4 wow fadeInDown text-center">
<h3>Why online?</h3>
<p class="lead">Epsum factorial non deposit quid pro quo hic escorol. Olypian quarrels et gorilla congolium sic ad nauseum. </p>
 
</div> 
<div class="col-sm-4 wow fadeInDown text-center">
<h3>Visualization</h3>
<p class="lead">Epsum factorial non deposit quid pro quo hic escorol. Olypian quarrels et gorilla congolium sic ad nauseum. </p>
 
</div> 
</div> 



</div> 
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

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
 


<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

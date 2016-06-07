<!DOCTYPE html>
<html>
<head>
<title>GATB-Web </title>

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
    <p>Now Online! Developed by Genscale,Inria</p>
    <p><button>GATB-Offline</button></p>
  </div>
   <form role="form" action="display.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="pwd">Enter the Genomic File to upload</label>
    <input type="file" name="fileToUpload" id="fileToUpload">
  </div>
    <input type="submit" value="Upload" name="submit"> 
</form>

<br /><br />
  <div class="row">
    <div class="col-sm-4">
      <h3>What is GATB?</h3>
      
    </div>
    <div class="col-sm-4">
      <h3>Why Online?</h3>
    </div>
    <div class="col-sm-4">
      <h3>Utility</h3>
    </div>
  </div>
</div>
</body>


</html>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
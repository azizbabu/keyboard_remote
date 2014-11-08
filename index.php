<?php
include 'keyboard.class.php';
$keyboard = new Keyboard();
$sentence = 'find the optimum path for this sentence';
if( isset( $_REQUEST['input'] )) {
$sentence = $_REQUEST['input'];
}
$output = $keyboard->findOptimumPath( $sentence );
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Remote Keyboard</title>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
</head>
<body>
<div class="container">
<div class="page-header">
<h1>Question 2:<small> Speed typing !</small></h1>
</div>
<div class="row">
<div class="col-md-12">
<form role="form">
<div class="form-group">
<label for="exampleInputEmail1">Input</label>
<input type="text" name="input" class="form-control" id="exampleInputEmail1" placeholder="Enter sentance"
value="<?php echo $sentence ?>"
/>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<a href="index.php" class="btn btn-default"> Reset</a>
</form>
</div>
</div>
<div class="row">
<div class="col-md-12">
<br>
<div class="panel panel-default">
<div class="panel-heading"><strong><?php echo 'Input : ' . $sentence;?></strong></div>
<div class="panel-body">
<?php
echo $output;
?>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading"><strong>Example1 : 7&amp;</strong></div>
<div class="panel-body">
<?php echo $keyboard->findOptimumPath( "7&"); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-heading"><strong>Example2 : ABCD</strong></div>
<div class="panel-body">
<?php echo $keyboard->findOptimumPath( "ABCD"); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-heading"><strong>Example3 : P#</strong></div>
<div class="panel-body">
<?php echo $keyboard->findOptimumPath( "P#"); ?>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
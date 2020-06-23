<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

  
</head>
<body>
  <?php echo do_shortcode("[own-plugin]");?>

<div class="container">
  <h2>Vertical (basic) form</h2>
  <form action="" id="frmPost">
    <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" class="form-control" id="txtName" required placeholder="Enter name" name="txtName">
    </div>
    <div class="form-group">
      <label for="pwd">Email:</label>
      <input type="email" class="form-control" id="txtEmail" required placeholder="Enter Email" name="txtEmail">
    </div>
    <button type="button" class="btn btn-default">Submit</button>
  </form>
</div>

<?php echo get_template_directory_uri();?>

<div>
  <h3 class="yes"></h3>
</div>

</body>
</html>
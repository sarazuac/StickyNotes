
<?php
  session_start();
$email =  $_SESSION['email'];
//echo $email;
  if($_SESSION['signed_in']!==1){
    echo '<script type="text/javascript">
             window.location = "signin.php";
        </script>';
  }

 ?>
<html>

<head>
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/bootstrap-journal.css">


</head>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Sticky Notes</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Note List </a></li>
        <li  class="active"><a href="newnote.php">Create New Note <span class="sr-only">(current)</span></a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" id="signout">Sign Out</a></li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<body>
<h2>Create New Note</h2>
<form action="createNote.php" method="POST">

<div id="form_create_div" >
<div class="form-group row">
  <label for="example-text-input" class="col-2 col-form-label">Title</label>
  <div class="col-10">
    <input class="form-control" type="text" placeholder="Title goes here.." id="note_title_create" name="note_title_create">
  </div>
</div>
<div class="form-group row">
  <label for="example-search-input" class="col-2 col-form-label">Body</label>
  <div class="col-10">
    <textarea class="form-control" type="search" placeholder="Body goes here.." id="note_body_create" name="note_body_create" maxlength="255"></textarea>
  </div>
</div>
<div class="form-group row">
  <input type="hidden" name="email" id="email" value="<?php echo $email; ?>"/>
  <button class="btn btn-primary" id="submit_new_note" type="button">Save</button>
</div>

</div>

</form>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
//
//var tes2 = "<?php echo $email; ?>";
//alert(tes2);
$( "#submit_new_note" ).on("click",function( event ) {
  //alert("Successsss");
  $.ajax({
   url: "createNote.php",
   type: "POST",
  data: {email: "<?php echo $email; ?>",
          note_title_create: $('#note_title_create').val(),
          note_body_create: $('#note_body_create').val()
},

   error: function(){
     location.reload();
   },
   success: function(data){
     //console.log("Success");
     //alert(data);
     //if(data=="Sign up success"){
       window.location = "index.php";
    // }
     //window.location = "/cart";
   }
});
event.preventDefault();
});
</script>

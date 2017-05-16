<?php
  session_start();
  $_SESSION['signed_in'] = 0;

?>


<html>

<head>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap-journal.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


</head>

<body>
  <div>
    <!-- <a href="signin.php">Sign in</a>
  </div>
<h3>Sign Up!</h3>
  <div>
    <form id="signin-form">

    <input type="text"  id="name" name="name"/>
    <input type="text"  id="email" name="email"/>
    <input type="password"  id="password" name="password"/>
    <input type="password"  id="confirm_password" name="confirm_password"/>
    <button type="button" id="submit">Sign Up!</button>

</form> -->
<div  id="error_banner" >

</div>
<form class="form-signin" id="signup_form">
        <h2 class="form-signin-heading">Sign up!</h2>
        <input type="email" id="name" name="name" class="form-control" placeholder="Name" required="true" autofocus="">
        <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required="true" autofocus="">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="true">
        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required="true">
        <div class="checkbox">
          <label>
            <a href="signin.php">Already a Member? Sign in!</a>
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="button" id="submit">Sign in</button>
      </form>


  </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script>
  $( "#submit" ).on("click",function( event ) {
  //  alert("Successsss");
  if($('#password').val() !== $('#confirm_password').val()){
    $('#error_banner').append('<div class="alert alert-danger fade in"><a class="close" data-dismiss="alert">×</a><span>Passwords do not match</span></div>');
  }else{
    $.ajax({
     url: "signup_auth.php",
     type: "POST",
    data: {name: $('#email').val(),
            email: $('#email').val(),
            password: $('#password').val()
  },

     success: function(data){
       console.log("Success");
       alert(data);
       if(data==1){
         window.location = "index.php";
       }
       //window.location = "/cart";
     }
  });
  event.preventDefault();
}
});
  </script>

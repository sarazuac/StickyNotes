
<?php
  session_start();

  $_SESSION['signed_in']=0;


 ?>

<html>

<head>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap-journal.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body>
  <div  id="error_banner" >

  </div>
  <form class="form-signin" id="signin_form">
          <h2 class="form-signin-heading">Please sign in</h2>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required="true" autofocus="">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="true">
          <div class="checkbox">
            <label>
              <a href="signup.php">Not a member? Sign up!</a>
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="button" id="submit">Sign in</button>
        </form>

</body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script>
  $(document).ready(function(){
  $( "#submit" ).on("click",function( event ) {
     $('#error_banner').empty();
  //  alert("Successsss");
  if($('#email').val()!=''){
    $.ajax({
     url: "auth.php",
     type: "GET",
    data: {email: $('#email').val(),
            password: $('#password').val()
  },

     success: function(data){

         if(data==3){
           $('#error_banner').append('<div class="alert alert-danger fade in"><a class="close" data-dismiss="alert">×</a><span>Wrong Password</span></div>');
         }
         if(data==2){
           $('#error_banner').append('<div class="alert alert-danger fade in"><a class="close" data-dismiss="alert">×</a><span>Wrong Email</span></div>');
         }
         if(data ==1){
           window.location = "index.php";
        }
     }//success
  });//ajax
  event.preventDefault();
}else{//if email >0
$('#error_banner').append('<div class="alert alert-danger fade in"><a class="close" data-dismiss="alert">×</a><span>Enter an Email</span></div>');
}
});

});
  </script>

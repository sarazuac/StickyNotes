
<?php
  session_start();
  //echo $_SESSION['signed_in'];

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
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

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
        <li class="active"><a href="#">Note List <span class="sr-only">(current)</span></a></li>
        <li><a href="newnote.php">Create New Note</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" id="signout">Sign Out</a></li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<body>
<h2>Notes</h2>
<button type="button" class="btn btn-default btn-lg" id="myBtn">Login</button>
  <div id="notes_container" class="container-fluid">

  </div>

  <div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:15px 20px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <label for="modal_note_title">Title</label>
          <input class="form-control" for="modal_note_title" value="" id="modal_note_title" name="modal_note_title"> </input>

        </div>
        <div class="modal-body" style="padding:20px 25px;">
          <form role="form">
            <div class="form-group">
              <label for="modal_note_body">Body</label>
              <textarea id="modal_note_body" class="form-control" value='' rows="5" name="modal_note_body"></textarea>
              <label for="modal_note_createdby" id="modal_note_createdby"> </label>
            </div>

              <button type="button" class="btn btn-success btn-block" id="modal_note_save" name="modal_note_save">Save</button>
          </form>
        </div>
        <input type="hidden" value='' name="id"/>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-default pull-left" data-dismiss="modal">Cancel</button>
        </div>
      </div>

    </div>
  </div>
</div>
</body>


</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<script>
$( "#signout" ).on("click",function( event ) {
//alert("signout");
$.get("logout.php");
$.ajax({
        url: "logout.php",
        success: function(data){
            window.location = "signin.php";
        }
      });



event.preventDefault();
});



$(document).ready(function(){


$.ajax({ url: "listNotes.php",
        context: document.body,
        dataType:'json',
        success: function(data){

          for(var i=0;i<data.Notes.length;i++){
                $('#notes_container').append('<div class="col-sm-3 note"><div class="inner-note"><span class="note-title-label"> Title: </span>' + data.Notes[i].title + '<button type="button" data-toggle="modal"  class="btn btn-default btn-xs edit-btn" id='+data.Notes[i].id+'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><br/><span class="note-body-label">Body: </span>' + data.Notes[i].body + '<br/><div class="createdby-div"><span class="note-createdby-label">Created By: </span>' +data.Notes[i].createdby+ '</div></div></div>');

          }


          $(".edit-btn").click(function(){
            //alert($(this).attr('id'));
            var id = $(this).attr('id');
            $.ajax({ url: "listNotes.php",
                    context: document.body,
                    dataType:'json',
                    data: {noteID : id},
                    success: function(data){

                      $('#modal_note_title').val(data.Notes[0].title);
                      $('#modal_note_body').val(data.Notes[0].body);
                      $('#modal_note_createdby').html("Created by: " +data.Notes[0].createdby);

                    }});

                $("#editModal").modal();

                $("#modal_note_save").click(function(){

                    $.ajax({ url: "editNote.php",
                            dataType:'json',
                            type:'POST',
                            data: {noteID : id,
                                  title:$('#modal_note_title').val(),
                                  body : $('#modal_note_body').val()

                                           },
                            success: function(data){

                            }});
                            location.reload();
                });

          });

      }});


});

</script>

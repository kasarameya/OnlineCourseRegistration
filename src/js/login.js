$(document).ready(function () {
  $("#uname_error").hide();
  $("#pwd_error").hide();

  $("input").focus(function () {
    $("#uname_error").hide();
    $("#pwd_error").hide();
  });

  $("#submit").click(function () {
    $("#uname_error").hide();
    $("#pwd_error").hide();

    if($("#username").val() == ""){
      $("#username").after("<span class='text font-weight-bold' id='uname_error'>Username field cannot be empty.</span>");
      	$("#uname_error").addClass("error");
        event.preventDefault();
    }
    if($("#password").val() == ""){
      $("#password").after("<span  class='text font-weight-bold' id='pwd_error'>Password field cannot be empty.</span>");
      	$("#pwd_error").addClass("error");
        event.preventDefault();
    }
    if ($("#password").val() != "" && $("#username").val() != "" ) {
      var uname = $("#username").val();
      var pwd = $("#password").val();
      variableString = 'username='+uname+'&password='+pwd;
      $.ajax({
      type: "POST",
      url: "login.php",
      data: variableString,
      success: function(msg){
        if (msg == 0) {
          alert('Incorrect username and password combination');
            window.location.href='login.html';
        }else if(msg == 1) {
          window.location.href='homepage.php';
        }else {
          alert('User does not exists, please register!');
            window.location.href='registration.html';
        }
      }
    });
    }
  });
});

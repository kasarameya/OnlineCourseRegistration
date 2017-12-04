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
      $("#username").after("<span id='uname_error'>Username field cannot be empty.</span>");
      	$("#uname_error").addClass("error");
        event.preventDefault();
    }
    if($("#password").val() == ""){
      $("#password").after("<span id='pwd_error'>Password field cannot be empty.</span>");
      	$("#pwd_error").addClass("error");
        event.preventDefault();
    }
    if ($("#password").val() != "" && $("#username").val() != "" ) {
      var uname = $("#username").val();
      var pwd = $("#password").val();
      variableString = 'admin_username='+uname+'&admin_password='+pwd;
      $.ajax({
      type: "POST",
      url: "adminLogin.php",
      data: variableString,
      success: function(msg){
        if (msg == 0) {
          alert('Incorrect username and password combination');
            window.location.href='adminLogin.html';
        }else if(msg == 1) {
          window.location.href='adminViewCourses.php';
        }else {
          alert('Admin does not exists, please register!');
        }
      }
    });
    }
  });
});

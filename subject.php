<?php
  include 'includes/autoloader.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Forum</title>
<link rel="icon" href="icons/favicon.ico">
<link rel="stylesheet" type="text/css" href="/font/flaticon.css">
<link rel="stylesheet" type="text/css" href="/style/main.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>

<div class="main-container">
  <div id="forumhead"></div>
  <div id="user-info"></div>
  <div id="posts">
    <?php
      $subjectID = $_GET['id'];
      $myForumDB = new MyDB();
      $myForumDB->getDescription($subjectID);
      $myForumDB->getPosts($subjectID);
    ?>
  </div>
  <button onclick="replyButtonClickEvent('post')">Reply</button>
</div>
<div id="new-something-body">
  <div id="new-something-box">
    <div id="close-button" class="cursor-pointer" onclick="closeBox('post')">
      <div></div>
    </div>
    <form id="newsomething-form" name="newpost" action="newpost.php" method="post" onsubmit="return checkNewPostForm()">
      <textarea id="message" name="message" placeholder="type your message here"></textarea>
      <input class="cursor-pointer" type="submit" name="send-button" value="Send">
    </form>
  </div>
</div>

<script>
  var curURL = window.location.href;
  var pos = curURL.indexOf("?id=");
  var subjectID = curURL.slice(pos);
  $("#newsomething-form").attr("action", "newpost.php" + subjectID);

  $("#forumhead").load("/html/forumhead.html");
  $("#user-info").load("/html/user-info.html", function(responseTxt, statusTxt, xhr){
    if(statusTxt == "success") {
      userCondition();
      $("#login-form").attr("action", "login.php" + subjectID);
    }
  });
</script>
<script src="/js/main.js"></script>
<script> loadPosts() </script>

</body>
</html>

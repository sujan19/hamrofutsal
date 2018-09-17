Welcome to thesoftwareguy blog!
*******************************
To install this script on your localhost/web server perform the following steps
---------------------------------------------------------------------------------
1) Create a folder name "rating-system" in your htdocs/www/public_html folder.
2) Extract the zip file inside your newly created folder "rating-system". (without double quotes).
3) Open your phpmyadmin (http://localhost/phpmyadmin)
4) Import the rating_system.sql file to your database. You dont have to create a database this script will automatically create a new database named "rating_system".
5) I have used PDO classes, if you guys are still using old mysql function time to upgrade dear.
6) If you want advance lessons on using raty visit http://wbotelhos.com/raty
7) You must add user_id yourself. Right now its in config.php
8) Ratings is applied on products.php page using the product id, user_id, and score.
9) To add ratings just add this script, make sure you got path correct for raty folder.
<script src="raty/jquery.raty.js" type="text/javascript"></script>
<div id="prd"></div>
<script>
  $(function() {
    $('#prd').raty({
      number: 5, starOff: 'raty/img/star-off-big.png', starOn: 'raty/img/star-on-big.png', width: 180, scoreName: "score",
    });
  });
</script>
10) When the user will click on submit an ajax call will be fired to update_ratings.php which will update the rating for that product.
<script>
  $(document).on('click', '#submit', function() {
      var score = $("#score").val();
      if (score.length > 0) {
        $("#rating_zone").html('processing...');
        $.post("update_ratings.php", {
          pid: "<?php echo $_GET["pid"]; ?>",
          uid: "<?php echo $USER_ID; ?>",
          score: score
        }, function(data) {
          if (!data.error) {
            // display the new ratings 
            $("#avg_ratings").html(data.updated_rating);
			// display the success message
            $("#rating_zone").html(data.message).show();
          } else {
            // display the failure message
            $("#rating_zone").html(data.message).show();
          }
        }, 'json'
                );
      } else {
        alert("select the ratings.");
      }
  });
</script>
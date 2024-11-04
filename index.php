<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VGA Shop</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <?php
            session_start();
            include("admincp/config/config.php");
            include("pages/header.php");
            include("pages/menu.php");
            include("pages/main.php");
            include("pages/footer.php");
        ?>
       </div>
       <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 

       

       <script type="text/javascript">
        $('#tabs-nav li:first-child').addClass('active');
        $('.tab-content').hide();
        $('.tab-content:first').show();

        // Click function
        $('#tabs-nav li').click(function(){
        $('#tabs-nav li').removeClass('active');
        $(this).addClass('active');
        $('.tab-content').hide();
        
        var activeTab = $(this).find('a').attr('href');
        $(activeTab).fadeIn();
        return false;
        });
       </script>

       <script>
        jQuery( document ).ready(function() {
		
		var back =jQuery(".prev");
		var	next = jQuery(".next");
		var	steps = jQuery(".step");
		
		next.bind("click", function() { 
			jQuery.each( steps, function( i ) {
				if (!jQuery(steps[i]).hasClass('current') && !jQuery(steps[i]).hasClass('done')) {
					jQuery(steps[i]).addClass('current');
					jQuery(steps[i - 1]).removeClass('current').addClass('done');
					return false;
				}
			})		
		});
		back.bind("click", function() { 
			jQuery.each( steps, function( i ) {
				if (jQuery(steps[i]).hasClass('done') && jQuery(steps[i + 1]).hasClass('current')) {
					jQuery(steps[i + 1]).removeClass('current');
					jQuery(steps[i]).removeClass('done').addClass('current');
					return false;
				}
			})		
		});

	})
       </script>
</body>
</html>
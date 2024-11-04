
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styleadmincp.css">
    <title>Admincp</title>
    
    
</head>
<?php
    session_start();
    if(!isset($_SESSION['dangnhap'])) {
        header('Location:login.php');
    }
?>

<body>
    
    <div class="wrapper">
    <h3 class="title_admin">Welcome to Admin</h3>
    <?php   
        include("config/config.php");
        include("modules/header.php");
        include("modules/menu.php");
        include("modules/main.php");
        include("modules/footer.php");
    ?>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>  
    <script>
            CKEDITOR.replace( 'tomtat' );
            CKEDITOR.replace( 'noidung' );
    </script>
    <script>
        function imagePreview(fileInput) {
            if (fileInput.files && fileInput.files[0]) {
                var fileReader = new FileReader();
                fileReader.onload = function (event) {
                    $('#preview').html('<img src="'+event.target.result+'" width="300" height="auto"/>');
                };
                fileReader.readAsDataURL(fileInput.files[0]);
            }
        }

        $("#image").change(function () {
            imagePreview(this);
        });
    </script> 
    
</body>
</html>

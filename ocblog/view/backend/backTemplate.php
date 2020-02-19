<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="public/css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="https://cdn.tiny.cloud/1/6r30t1grcyd6zij09d3y4r8hd55fh4qezbdvm0v5zgb86clp/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

        <script>
            tinymce.init({
                selector: '#content'
             });
        </script>

    </head>

    
        
    <body>
        
        <?php include("view/backend/backHeader.php"); ?>
        
        <main>
            <div class="container">

                <?= $content ?>

            </div>
        </main>

        
        <?php include("view/backend/backFooter.php"); ?>

        <script type="text/javascript" src="public/js/materialize.min.js"></script>
        <script src="public/js/jquery-3.4.1.js"></script> <!-- jQuerry -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> <!-- jQuerry -->
        <script type="text/javascript" src="public/js/deletepost.js"></script>
        
    </body>

    

</html>
<?php

  $generic = "Bienvenid@";
  $status = false;

  // extract url to form
  $url = isset($_POST['url']) ? $_POST['url'] : '';

  
  if(isset($_POST['url']) && $url != '') {
    // Escribir archivo JSON
    $file = fopen('./src/data/data.txt', 'w');
    fwrite($file, $url);
    fclose($file);

    // python script (crear QR)
    $command = 'python ./src/generateQR.py';
    $permissions = escapeshellcmd('chmod +x ./src/generateQR.py');
    exec($permissions);
    exec($command);

    $status = true;

  }
 


  #echo $url;

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generate qr image</title>
    <link rel="icon" type="image/gif/png" href="public/favicon.png">
  </head>
  <body>

    <h1>
      <?= $generic; ?>
    </h1>
    <p>
      Por favor ingrese la 
        <span class="orange">
          url
        </span> 
      que desee convertir en un código QR.
    </p>
  
    <form name="form" action="" method="post">
      <input type=text name="url" id="url" placeholder="https://www.example.dom" />
      <input class="btn" type=submit value="Generar QR" /> 
    </form>

  
  </body>
</html>


<?php
    
    if ($status){
      echo '<img src="./public/qr_image.png" alt="QR" />';

    } else {
      echo '<div class="cont">
      <span style="--i:1">r</span>
      <span style="--i:2">e</span>
      <span style="--i:3">s</span>
      <span style="--i:4">u</span>
      <span style="--i:5">l</span>
      <span style="--i:6">t</span>
      <span style="--i:7">.</span>
      <span style="--i:8">.</span>
      <span style="--i:9">.</span>
      </div>';
    }

?>


<style>

  :root{
    color-scheme: light dark;
    font-family: monospace;
  }

  body{
    display: flex;
    height: 100vh;
    margin: 0;
    flex-direction: column;
    justify-content: center;  
    align-items: center;
    font-size: 2em;
  }

  form{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 2em;  
  }

  input{
    width: 22em;
    height: 2em;
    margin-top: 1em;
  }

  img{
    margin-top: 2em;
  }

  .btn{
    width: 10em;
  }

  #url{
    padding-left: 1em;
  }

  .orange{
    color: orange;
  }
    
  .cont{
    margin-top: 5em;
    user-select: none;
  }

  .cont span{
    display: inline-block;
    margin-left: -0.3em;
    user-select: none;
    animation: waviy 1s ease infinite;
    animation-delay: calc(.1s * var(--i));
  }

  @keyframes waviy {
    0%, 100% {
      transform: translateY(0);
    }
    20% {
      transform: translateY(-5px);
    }
    40% {
      transform: translateY(0);
    }
    60% {
      transform: translateY(-2.5px);
    }
    80% {
      transform: translateY(0);
    }
  }


</style>

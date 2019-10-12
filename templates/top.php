<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Andrea Tirrell Photography</title>
    <link href="styles.css" rel="stylesheet">
    <link href="static-styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Tinos&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Wire+One&display=swap" rel="stylesheet">
    
    <script
        src="https://code.jquery.com/jquery-3.4.1.slim.js"
        integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI="
        crossorigin="anonymous">
    </script>
    <style>
        #headerWrapper{
            z-index: 1;
        }
        #header{
            z-index: 999;
        }
        
    </style>
</head>
<body>

    <div id="canvasWrapper">
        <div id="canvas">
        
            <div id="mobileNav" class="menu-close">
                <div id="mobileWrapper">
                    <nav id="firstNavMobile">                       
                        <ul>                    
                            <li><a class="nav-link" href="index.php"><?php echo $album_names_clean[0] ?></a></li>

                            <?php for($i = 1; $i < sizeof($album_names_clean); $i++): ?> 
                            <li><a class="nav-link" href="album.php?name=<?php echo $album_names_underscore[$i] ?>"><?php echo $album_names_clean[$i] ?></a></li>
                            <?php endfor; ?> 

                        </ul>
                    </nav>
                    <nav id="secondNavMobile">
                        <ul>
                            <li><a class="nav-link" href="cv.php">CV</a></li>
                            <li><a class="nav-link" href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            
            <div id="headerWrapper">
                <header id="header">
                    <nav id="menu">
                        <div id="menuIcon">
                            menu
                        </div>
                    </nav>
                    <div id="logo">
                       <a href="index.php"><h1> andrea tirrell </h1></a>
                    </div>
                    
                    <div id="desktopNav">
                    
                        <nav id="firstNav">
                            <ul>
                                <li><a class="nav-link" href="index.php"><?php echo $album_names_clean[0] ?></a></li>
                                <?php for($i = 1; $i < sizeof($album_names_clean); $i++): ?> 
                                <li><a class="nav-link" href="album.php?name=<?php echo $album_names_underscore[$i] ?>"><?php echo $album_names_clean[$i] ?></a></li>
                                <?php endfor; ?>    
                            </ul>
                        </nav>
                        <nav id="secondNav">
                            <ul>
                                <li><a class="nav-link" href="cv.php">CV</a></li>
                                <li><a class="nav-link" href="contact.php">Contact</a></li>
                            </ul>
                        </nav>

                    </div>

                </header>
            </div>
        
<?php
/**
 * Created by PhpStorm.
 * User: maciej
 * Date: 08/12/2015
 * Time: 21:46
 */

// Loads class that handles QOF data file.
require_once('inc/LoadQofData.class.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>QOF Assistant</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">QOF Assistant</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="#" class="waves-effect waves-light">Summary</a></li>
            <li><a href="#" class="waves-effect waves-light">Domains</a></li>
            <li><a href="#" class="waves-effect waves-light">Measures</a></li>
            <li><a href="#" class="waves-effect waves-light">Hit List</a></li>
        </ul>

        <ul id="nav-mobile" class="side-nav">
            <li><a href="#" class="waves-effect waves-light">Summary</a></li>
            <li><a href="#" class="waves-effect waves-light">Domains</a></li>
            <li><a href="#" class="waves-effect waves-light">Measures</a></li>
            <li><a href="#" class="waves-effect waves-light">Hit List</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>


<div class="container">

    <div class="section">
        <br><br>

        <h1 class="header center orange-text">Sample Data</h1>
        <br><br>

        <div class="row center">
            <table class="highlight bordered">
                <thead>
                <tr>
                    <th data-field="id">Domain</th>
                    <th data-field="name">Description</th>
                    <th data-field="price">Score</th>
                    <th data-field="price">TargetScore</th>
                </tr>
                </thead>

                <tbody>
                <?php
                /*
                 * Set url address to the xml file containing QOF data.
                 * Example: http://microtest.co.uk/data/qofdomains.xml
                 */
                $file = 'http://microtest.co.uk/data/qofdomains.xml';


                // Initialise the class class
                $qofData = new LoadQofData($file);

                // Load QOF data as an array.
                $qofData = $qofData->getDataArray();

                // Loop through the array
                foreach ($qofData as $item) { ?>
                    <tr>
                        <td><?php printf('<a href="#">%s</a>', $item['type']); ?></td>
                        <td><?php echo $item['description']; ?></td>
                        <td><?php echo $item['score']; ?></td>
                        <td><?php echo $item['targetScore']; ?></td>
                    </tr>
                    <?php
                } // EOF foreach. ?>
                </tbody>
            </table>
        </div>
    </div><!-- EOF .section -->
    <br><br>
</div><!-- EOF .container -->

<footer class="page-footer orange">
    <div class="container">
        <div class="row">

            <div class="col m12">
                <h5 class="white-text">Navigation</h5>
                <ul>
                    <li><a class="white-text waves-effect" href="#">Terms and Conditions</a></li>
                    <li><a class="white-text waves-effect" href="#">Service Desk</a></li>
                    <li><a class="white-text waves-effect" href="#">About QOF Assistant</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Made by <a class="orange-text text-lighten-3" href="#">Maciej Sularz</a>
        </div>
    </div>
</footer>


<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>

</body>
</html>

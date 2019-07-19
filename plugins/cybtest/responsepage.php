<?php include 'security.php' ?>

<html>
<head>
<title>RESPONSE PAGE</title>
</head>
<body>
<h1>This is the response from Cybersource</h1>

		<form id="receipt">
            <?php
                 foreach($_REQUEST as $name => $value) {
                     $params[$name] = $value;
                     echo "<span>" . $name . "</span><input type=\"text\" name=\"" . $name . "\" size=\"50\" value=\"" . $value . "\" readonly=\"true\"/><br/>";
                 }

                 echo "<span>Signature Verified:</span><input type=\"text\" name=\"verified\" size=\"50\" value=\"";
                 if (strcmp($params["signature"], sign($params))==0) {
                     echo "True";
                 } else {
                     echo "False";
                 }
                 echo "\" readonly=\"true\"/><br/>";
            ?>
        </form>

</body>
</html>
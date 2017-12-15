<!doctype html>

<html>
	<head>
		<title>Reading the Database</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
	</head>

	<body>
        <?php 

            // forbindelse til mySQL serveren ved brug af mysqli metode

            // 1. Variabler (konstanter) til forbindelsen

            const HOSTNAME = 'localhost'; // server
            const MYSQLUSER = 'root'; // superbruger
            const MYSQLPASS = 'root'; // password
            const MYSQLDB = 'exampledb'; // database navn

            // 2. Forbindelsen via mysqli metoden

            $con = new mysqli(HOSTNAME, MYSQLUSER, MYSQLPASS, MYSQLDB);

            // at sikre sig, at alle utf8-tegn kan blive brugt under forbindelsen
            $con->set_charset ('utf8');

            // 3. Tjek

            // hvis der er fejl i forbindelsen
            if($con->connect_error){
	       die($con->connect_error);
                    // hvis der er hul i gennem
                } else {
	               echo 'Der er forbindelse! Woohoo!';
                }
            // PHP slut tag kan undlades, hvis filen indeholder "rent" PHP
            ?>
        
        <nav>
            <ul>
                <li><a href="create.php">Create new apartment</a></li>
                <li><a href="read.php">Read from the database</a></li>
                <li><a href="update.php">Update records</a></li>
                <li><a href="delete.php">Delete records</a></li>
            </ul>
        </nav>
        
        <!-- READ section -->
        <h1>Apartments in the database</h1>
        <?php
            $apid = '1';
            $apartment = 'Mainway';
            $size = 'very big';
            
            $sql = "SELECT aprt_adress, aprt_size FROM apartment ORDER BY aprt_ID";
            $result =  $con->query($sql);
        
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "ADRESS: ".$row["aprt_adress"]." -- SIZE IN SQUARE METERS: ".$row["aprt_size"]. "<br>";  
                }    
            } else {
                echo "No apartments were found";
            }
        ?>
        
	</body>
</html>
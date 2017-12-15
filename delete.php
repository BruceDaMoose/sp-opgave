<!doctype html>

<html>
	<head>
		<title>Deleting Records</title>
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
        
        <h1>Delete Apartment Record</h1>
        <fieldset>
        <legend>Deletion Form</legend>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="text" name="aprtID" placeholder="Apartment ID, only numbers">
                <input type="submit" name="submit" value="DELETE APARTMENT">
            </form>
        </fieldset>
        
        <?php 
            $aprtid = filter_input(INPUT_POST, 'aprtID', FILTER_VALIDATE_INT) or die('missing/illegal ID parameter');
            
            $sql = 'DELETE FROM apartment WHERE aprt_id= ?';
            $stmt = $con->prepare($sql);
            $stmt->bind_param('i', $aprtid);
            $stmt->execute();
            if ($stmt->affected_rows >0) {
                echo 'The apartment was deleted from table';
            } else {
                echo 'Nothing was deleted - did you enter a valid ID?';
            }
        ?>
	</body>
</html>
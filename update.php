<!doctype html>

<html>
	<head>
		<title>Update Information</title>
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
        
        <h1>Update existing information</h1>
        <fieldset>
        <legend>Change information</legend>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="text" name="aprtID" placeholder="Apartment ID, only numbers">
                <input type="text" name="aprtAdress" placeholder="New Adress">
                <input type="submit" name="submit" value="Change Existing Adress">
            </form>
        </fieldset>
        
        <?php 
            $aprtadress = filter_input(INPUT_POST, 'aprtAdress') or die('missing/illegal apartment adress parameter');
            $aprtid = filter_input(INPUT_POST, 'aprtID') or die('missing/illegal apartment ID parameter');
        
            $sql = "UPDATE apartment SET aprt_adress=? WHERE aprt_id=?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('si', $aprtadress, $aprtid);
            $stmt->execute();
        
            if($stmt->affected_rows > 0){
                echo 'Changed adress to '.$aprtadress;
            } else {
                echo 'Adress could not be changed';
            }
        ?>
	</body>
</html>
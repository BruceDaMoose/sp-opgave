<!doctype html>

<html>
	<head>
		<title>Create new apartments</title>
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
        
        <h1>Add New Apartment</h1>
        <fieldset>
            <legend>Apartment Formular</legend>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="text" name="aprtAdress" placeholder="Apartment Adress">
                <input type="text" name="aprtSize" placeholder="Apartment size">
                <input type="submit" name="submit" value="Submit to table">
            </form>
        </fieldset>
        
        <?php 
            if(filter_input(INPUT_POST, 'submit')){
                
                $aprtadress = filter_input(INPUT_POST, 'aprtAdress') or die('missing/illegal apartment adress parameter');
                $aprtsize = filter_input(INPUT_POST, 'aprtSize') or die('missing/illegal apartment size parameter');
                
                $sql = 'INSERT INTO apartment (aprt_adress, aprt_size) VALUES (?, ?)';
                $stmt = $con->prepare($sql);
                $stmt->bind_param('ss', $aprtadress, $aprtsize);
                $stmt->execute();
                
                if($stmt->affected_rows > 0){
                    echo $aprtadress.", with a size of ". $aprtsize." square meters was added";
                } else {
                    echo "Sorry, the apartment wasn't added";
                }
            }
        ?>
	</body>
</html>
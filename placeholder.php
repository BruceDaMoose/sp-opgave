<?php 
            //create
            $sql = 'INSERT INTO apartment (aprt_adress, aprt_size) VALUES (?, ?)';
            $stmt = $link->prepare($sql);
            $stmt->bind_param($apAdress, $apSize,);
            $stmt->execute();
        ?>
        
        
        <?php 
            //read
            $sql = 'SELECT aprt_adress, aprt_size FROM apartment ORDER BY aprt_ID';
            $stmt = $link->query($sql);
        ?>
        
        
        <?php 
            //update
            $sql = 'UPDATE families SET apartment_aprt_id=4 WHERE fam_id=3';
            $stmt = $link->query($sql);
        ?>
        
        
        <?php 
            //delete
            $sql = 'DELETE FROM pets WHERE pet_id=2';
            $stmt = $link->query($sql)
        ?>
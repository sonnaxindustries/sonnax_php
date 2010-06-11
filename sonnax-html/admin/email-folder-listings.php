<html>
    <head>
    	<title>Email Folder Listings</title>
    </head>
    <body>
    	<?php
    	$email_address = "ep@sonnax.com"; //"terryheinel@gmail.com";
    	
        exec( 'ls /home/htmldocs/sonnax/announcements | mail ' . $email_address . '  -s "/home/htmldocs/sonnax/announcements listing"' );
        echo "Announcements listing email sent<br />\n";
        
        exec( 'ls /home/htmldocs/sonnax/exploded-views | mail ' . $email_address . ' -s "/home/htmldocs/sonnax/exploded-views listing"' );
        echo "Exploded-views listing email sent<br />\n";
        
        exec( 'ls /home/htmldocs/sonnax/instructions | mail ' . $email_address . ' -s "/home/htmldocs/sonnax/instructions listing"' );
        echo "Instructions listing email sent<br />\n";
        
        exec( 'ls /home/htmldocs/sonnax/part-images | mail ' . $email_address . ' -s "/home/htmldocs/sonnax/part-images listing"' );
        echo "Part-images listing email sent<br />\n";
        
        exec( 'ls /home/htmldocs/sonnax/sonnaflow-charts | mail ' . $email_address . ' -s "/home/htmldocs/sonnax/sonnaflow-charts listing"' );
        echo "Sonnaflow-charts listing email sent<br />\n";
        
        exec( 'ls /home/htmldocs/sonnax/tech | mail ' . $email_address . ' -s "/home/htmldocs/sonnax/tech listing"' );
        echo "Tech listing email sent<br />\n";
        
        exec( 'ls /home/htmldocs/sonnax/tech-articles | mail ' . $email_address . ' -s "/home/htmldocs/sonnax/tech-articles listing"' );
        echo "Tech-articles listing email sent<br />\n";
        ?>
        
    </body>
</html>
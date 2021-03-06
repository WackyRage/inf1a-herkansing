<?php

    function getDocuments()
    {
        $errorArray = array();

        $conn = dbConnect();
        $result = $conn->query("SELECT `documentID`, `documentName` 
                                FROM `documents`;");
        
        // Check if there are results
        if($result->num_rows > 0)
        {
            /* close connection */
            $conn->close();
            //return sql results
            return $result;
            /* 
                the return value will be in a array and have to be summon accordingly
                example:
                foreach ($rows as $row) {
                    echo $row['documentID'];
                    echo $row['documentName'];
                }
            */
        }
        else 
        {
            /* close connection */
            $conn->close();
            array_push($errorArray, "<span class='card-title red-text text-accent-4'><h3>Er zijn nog geen documenten aangemaakt.</span></h3>");
            //echo "Error: " . $sql . "<br>" . $conn->error;
            return $errorArray;
        }
    }

?>
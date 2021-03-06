<?php

function addProject($projectGroup, $projectPeriod, $projectYear, $ProjectName)
{
    $errorArray = array();
    $errCount = 0;

        // Check if variable is an integer
    if (!ctype_digit(strval($projectPeriod))) {
        array_push($errorArray, "<span class='card-title red-text text-accent-4'><h3>Er is een verkeerde periode waarde ingevuld.</span></h3>");
    }

        // Check if variable is an integer
    if (!ctype_digit(strval($projectYear))) {
        array_push($errorArray, "<span class='card-title red-text text-accent-4'><h3>Er is een verkeerde jaar waarde ingevuld.</span></h3>");
    }

        // check if periode not bigger than 5
    if ($projectPeriod > 5) {
        array_push($errorArray, "<span class='card-title red-text text-accent-4'><h3>Er is een te hoge periode waarde ingevuld.</span></h3>");
    }

    if ($ProjectName == '' || $projectPeriod == '' || $projectGroup == '') {
        array_push($errorArray, "<span class='card-title red-text text-accent-4'><h3>Alle velden moeten worden ingevuld.</span></h3>");
    }

    $errCount = count($errorArray);

        // Adding project to database
    if ($errCount == 0) {
        $conn = dbConnect();
        $ProjectName = htmlentities($ProjectName);
        $projectGroup = htmlentities($projectGroup);
        $ProjectName = mysqli_real_escape_string($conn, $ProjectName);
        $projectGroup = mysqli_real_escape_string($conn, $projectGroup);
        $ProjectName = strtoupper($ProjectName);

        $sql = "INSERT INTO `projects` 
    		(`projectID`, `projectGroup`, `projectPeriode`, `projectYear`, `ProjectName`) 
    		VALUES (NULL, '" . $projectGroup . "', '" . $projectPeriod . "', '" . $projectYear . "', '" . $ProjectName . "');";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            array_push($errorArray, "<span class='card-title red-text text-accent-4'><h3>Project is succesful aangemaakt.</span></h3>");

                // Add current user to project
            addProjectMember($_SESSION["userID"], $last_id);
        } else {
            array_push($errorArray, "<span class='card-title red-text text-accent-4'><h3>Er is iets fout gegaan bij het uploaden van het project</span></h3>");
                //echo "Error: " . $sql . "<br>" . $conn->error;
        }

            /* Close connection */
        $conn->close();

        return $errorArray;
    } else {
        return $errorArray;
    }
}
?>
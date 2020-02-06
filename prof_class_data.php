<html>
    <head>
        <title>CS332 Term Project</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>
<body>
        <center>
	<p>Professor Classes</p>
        <!-- Start of PHP block -->
        <?php 
        
                $dbHost = 'mariadb';
                $dbUsername = 'cs332f4';
                $dbPassword = 'eiLee4ku';
        
                // Connection with MySQL Relational DBMS
                $mysql_conn = mysql_connect($dbHost, $dbUsername, $dbPassword);
        
                // if unsuccessful connecting to MySQL Relational DBMS
                if (! $mysql_conn ) {
                        die('Unable to connect to host MariaDB' . mysql_error());
                }
        
                // if successful
                $db_selection = mysql_select_db($dbUsername, $mysql_conn);
        
                echo 'Connection with database was successful', "<br>";
        
                echo "<br>";
        
                $search = "SELECT C_Title, Classroom, Meeting_Days, Begin_Time, End_Time
                            FROM Professor, Course, Section
                            WHERE SSN = P_SSN 
                            AND C_Number = Sec_C_Num
                            AND SSN =" . $_POST["prof_ssn"];
                
                $result = mysql_query($search, $mysql_conn) or die(mysql_error());
                
                $index = 0;
    
                if ($index < mysql_numrows($result))  {
                    
                    echo "Professor SSN: " .$_POST["prof_ssn"], "<br>", "<br>";
                    
                    for($index = 0; $index < mysql_numrows($result); $index++) {
                    
                        echo "Course Title: ", mysql_result($result, $index, C_Title), "<br>";
                        echo "Classroom: ", mysql_result($result, $index, Classroom), "<br>";
                        echo "Meeting Days: ", mysql_result($result, $index, Meeting_Days), "<br>";
                        echo "Begin Time: ", mysql_result($result, $index, Begin_Time), "<br>";
                        echo "End Time: ", mysql_result($result, $index, End_Time), "<br>", "<br>";
    
                    }
                
                    
                }
                else {
                    echo "Invalid SSN", "<br>";
                    echo "Professor with specified SSN was not found", "<br>";
                }
    
                // Closes connection to MySQL database server
                mysql_close($mysql_conn);
        
        ?> <!-- End of PHP block -->
    </center>
</body>
</html>


<html>
<head>
        <title>CPSC 332 Term Project</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
    <center>
	<p>Student Courses</p>
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

                $search = "SELECT Sec_Number, Classroom, Meeting_Days, 
                            Begin_Time, End_Time, (Num_Seats-COUNT(s_cwid)) as 'Num_Seats'
                            
                            FROM Course, Enrollment_Records, Section
                            WHERE Sec_num = Sec_Number
                            AND C_Number = Sec_C_Num
                            AND C_num ='".$_POST["s_courseNum"]."'
                            GROUP BY Sec_Number;";

                $result = mysql_query($search, $mysql_conn) or die(mysql_error());
                
                $index = 0;
    
                if ($index < mysql_numrows($result))  {

                    echo "Course Number: " .$_POST["s_courseNum"], "<br>", "<br>";
                    
                    for($index = 0; $index < mysql_numrows($result); $index++) {

                        echo "Section Number: ", mysql_result($result, $index, Sec_Number), "<br>";
                        echo "Classroom: ", mysql_result($result, $index, Classroom), "<br>";
                        echo "Meeting Days: ", mysql_result($result, $index, Meeting_Days), "<br>";
                        echo "Begin Time: ", mysql_result($result, $index, Begin_Time), "<br>";
                        echo "End Time: ", mysql_result($result, $index, End_Time), "<br>";
                        echo "Number enrolled: ", mysql_result($result, $index, "Num_Seats"), "<br>", "<br>";
                    }
                }
                else {
                    echo "Invalid Course Number", "<br>";
                    echo "Please try again", "<br>";
                }

                // Closes connection to MySQL database server
                mysql_close($mysql_conn);
        
        ?> <!-- End of PHP block -->
    </center>
</body>
</html>


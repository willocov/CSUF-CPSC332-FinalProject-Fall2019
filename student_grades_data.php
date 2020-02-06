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
	<p>Student Grades</p>
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
                
                $search = "SELECT C_Title, Grade
                            FROM Enrollment_Records, Course
                            WHERE C_num = C_Number 
                            AND s_cwid =" . $_POST["s_cwid"];
                
                $result = mysql_query($search, $mysql_conn) or die(mysql_error());
    
                $index = 0;
                
                if ($index < mysql_numrows($result))  {
    
                    echo "Student CWID: " .$_POST["s_cwid"], "<br>", "<br>";
                    
                    for($index = 0; $index < mysql_numrows($result); $index++) {
    
                        echo "Course Title: ", mysql_result($result, $index, C_Title), "<br>";
                        echo "Grade: ", mysql_result($result, $index, Grade), "<br>", "<br>";
                    }
 
                }
                else {
                    echo "Invalid student CWID", "<br>";
                    echo "Please try again", "<br>";
                }

                // Closes connection to MySQL database server
                mysql_close($mysql_conn);
        
        ?> <!-- End of PHP block -->
    </center>
</body>
</html>

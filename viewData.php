<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <h1>Hello, world!</h1>

    <?php

    //Connecting to the DataBase
    $severname = "localhost";
    $username = "root";
    $password = "";
    $database = "dbNihu";

    //create connection
    $conn = mysqli_connect($severname, $username, $password, $database);
    //Die if connection was not successful
    if (!$conn) {
        die("Sorry we failed to connect: " . mysqli_connect_error());
    }
    else {
        echo "Connection was Successful<br>";
    }

    $sql = "SELECT * FROM `contacts`";
    $result = mysqli_query($conn, $sql);

    //find the no. of records returned
    $num = mysqli_num_rows($result);
    // echo $num;

    //Display the rows returned by sql query
    while($row = mysqli_fetch_assoc($result)){
        // echo var_dump($row);
        echo $row['sno.'].") &nbsp;".$row['name']."-&nbsp;".$row['email']."-&nbsp;".$row['phone']."&nbsp;".$row['concern']."-&nbsp;";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>
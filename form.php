<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css"
    integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Tritorc</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    a {
      text-decoration: none;
      /* color: white; */
    }

    #main-section {
      max-width: 100vw;
      min-height: 100vh;
      background-color: darkslategrey;
    }

    #main-nav {
      height: 10%;
    }

    #main-1 {
      height: 92.5vh;
      background-color: darkslategray;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #form-1 {
      width: 25rem;
      height: 37rem;
      border: 5px solid darkblue;
      position: relative;
      display: none;
    }

    #main-btn {
      width: 6rem;
      height: 3rem;
      border: 5px solid darkblue;
      background-color: lightgreen;
      color: darkblue;
      border-radius: 5px;
    }

    #f-close {
      width: 5rem;
      height: 2rem;
      border: 2px solid red;
      background-color: lightgreen;
      color: darkblue;
      border-radius: 5px
    }

    #dis-alrt {
      position: relative;
      display: none;
    }
  </style>
</head>

<body>
  <div id="main-section">
    <div id="main-nav">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Tritorc </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Contact Us
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">email</a></li>
                  <li><a class="dropdown-item" href="#">Phone</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control ms-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $desc = $_POST['desc'];

      //Connecting to the DataBase
      $severname = "localhost";
      $database = "dbNihu";
      $username = "root";
      $password = "";

      //create connection
      $conn = mysqli_connect($severname, $username, $password, $database);
      //Die if connection was not successful
      if (!$conn) {
        die("Sorry we failed to connect: " . mysqli_connect_error());
      } else {

        // Check if file is uploaded
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
          $filename = $_FILES['file']['name'];
          //
          $fileloc = 'uploads/' . $filename;

          // Move the uploaded file to the target directory
          if (move_uploaded_file($_FILES['file']['tmp_name'], $fileloc)) {
            // echo 'File uploaded and moved to the target directory successfully.';
          } else {
            // echo 'Failed to move the uploaded file to the target directory.';
          }
        } else {
          $filename = '';
          $fileloc = '';
        }
        // echo "Connection was Successful<br>";
        //submitting to the database
        $sql = "INSERT INTO `contacts` (`name`, `email`, `phone`, `concern`, `file_name`, `file_loc`, `dt`) VALUES ('$name', '$email', '$phone', '$desc', '$filename', '$fileloc', current_timestamp())";
        $result = mysqli_query($conn, $sql);

        if ($result) {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="dis-alrt">
        <strong>success!</strong> You have submitted the data successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        } else {
          // echo "the record was not inserted successfully because of this error -->>". mysqli_error($conn);
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
      }
    }
    ?>
    <div class="container col-10" id="main-1">
      <button id="main-btn">html</button>
      <form class="form-control" action="/Nihu_pro/form.php" method="post" id="form-1"
        enctype="multipart/form-data">
        <div class="d-flex justify-content-end">
          <button id="f-close" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="mb-3">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control" aria-describedby="name">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Phone</label>
          <input type="tel" name="phone" class="form-control" id="phone" aria-describedby="emailHelp"
            pattern="^[0-9]{10}$" maxlength="10">

        </div>
        <div class="mb-3">
          <label for="desc" class="form-label">Description</label>
          <textarea name="desc" class="form-control" id="desc"></textarea>
        </div>
        <div class="mb-3">
          <hr>
          <label for="file" class="mt--3">Upload file:</label>
          <input type="file" name="file" id="file">
        </div>
        <button type="submit" value="Submit" id="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-outline-primary" onclick="window.location.href='viewData.php'">See Data</button>
      </form>
    </div>
  </div>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

  <script>
    let div1 = document.getElementById('form-1');
    let btn1 = document.getElementById('main-btn');
    let btn2 = document.getElementById('f-close');
    let btn3 = document.getElementById('submit');
    let div2 = document.getElementById('dis-alrt');

    btn1.addEventListener('click', function fn1() {
      div1.style.position = 'absolute';
      div1.style.display = 'block';
    });

    btn2.addEventListener('click', function fn2() {
      div1.style.display = 'none';
    });

    btn3.addEventListener('click', function fn3() {
      div2.style.position = 'absolute';
      div2.style.display = 'block';
    });
  </script>
</body>

</html>
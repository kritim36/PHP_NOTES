<?php
$insert = false;
//connection to database
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

//create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
  die("Failed to connect: ".mysqli_connect_error());
}
// else{
//   echo "Connection Sucessful";
// }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $title = $_POST["title"];
  $description = $_POST["description"];

  //Sql query to be executed
  $sql = "INSERT INTO note (title, description) VALUES('$title', '$description')";
  $result = mysqli_query($conn,$sql);

  if($result){
    //echo "Note has been added sucessfully!<br>";
    $insert = true;
  }else{
    echo "Failed to add note". mysqli_error($conn);
  }
 
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NOTES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

  <?php
  ?>
    <div class="container my-4">
        <h1>Add a Note!</h1>
        <form action="/notes/index.php" method="POST">
            <div class="mb-3">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">  
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Note Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              </div>            
            <button type="submit" class="btn btn-primary">Add note</button>
          </form>
    </div>

    <div class="container">
     
        <table class="table">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
        $sql = "SELECT * FROM note " ;
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
         echo "<tr>
            <th scope='row'>". $row['sno']. "</th>
            <td>". $row['title']."</td>
            <td>". $row['description']."</td>
            <td>Action</td>
          </tr>";
          
        }
      
        ?>
    
  
  </tbody>
</table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
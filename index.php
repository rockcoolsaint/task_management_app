<?php
  // configuration info
  include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" href="./material.min.css">
    <script src="./material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  </head>

  <body>
    <h1>Task Manager</h1>
      
      <form action="" method="POST">
        <label for 'task'>Task: </label>
        <input type="text" name="task" required/>
        <label for 'description'>Description: </label>
        <textarea name='description' rows="4" cols="50" placeholder='Description' required/></textarea>
        <label for 'date'>Day: </label>
        <input type="date" name="day" required/>
        <label for 'time'>Time: </label>
        <input type="time" name="time" required/>
        <br/>
        <button type="submit" name="submit">Submit</button>
      </form>
      <?php
        if (!empty($_POST)) {
          $form = $_POST;
          $task = $form['task'];
          $description = $form['description'];
          $day = $form['day'];
          $time = $form['time'];

          //prepare sql statement
          $sql = "INSERT INTO tasks (task, description, day, time) 
                  VALUES (:task, :description, :day, :time)";

          //insert into table
          $query = $db->prepare($sql);
          $result = $query->execute(array(':task'=>$task,':description'=>$description,
                                          ':day'=>$day,':time'=>$time));
          if ($result) {
            echo "<p>Task successfully registered!</p>";
          } else {
            echo "<p>Sorry, there has been a problem inserting your task. Please contact admin.</p>";
          }
        }
      ?>

      <?php
        $sql = "SELECT * FROM tasks";
        $query = $db->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        print_r($_POST);
      ?>
        <table class="table">
            <tr>
              <th>ID</th>
              <th>Tasks</th>
              <th>Description</th>
              <th>Date</th>
              <th>Time</th>
            </tr>

        <?php foreach( $results as $row ) {
          echo "<tr><td>";
          echo $row['id'];
          echo "</td><td>";
          echo $row['task'];
          echo "</td><td>";
          echo $row['description'];
          echo "</td><td>";
          echo $row['day'];
          echo "</td><td>";
          echo $row['time'];
          echo "</td>";
          echo "</tr>";
        }
    ?>
  </table>

  </body>
</html>
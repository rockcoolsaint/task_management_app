<?php include 'connection.php';?>

<?php

	//print_r($_POST);
	if (isset($_POST['update'])) {
		$id = $_GET['id'];
		$task = $_POST['task'];
		$description = $_POST['description'];
		$day = $_POST['day'];
		$time = $_POST['surname'];
		$update_stmt = "UPDATE users 
						SET task='{$task}', 
						description='{$description}', 
						day='{$day}', 
						time='{$time}', 
						WHERE id= {$id}";
		$update_query = $db->prepare($update_stmt);
		$update_query->execute();
		if ($update_query->rowCount() == 1) {
			//echo $update_query->rowCount()." record updated successfully";
			$message = "1 record was successfully updated!";
		}
		else {
			//echo $update_stmt. "<br>" . $e->getMessage();
		}
		//$update_results = $update_query->fetchAll(PDO::FETCH_ASSOC);
	}
	//print_r($_POST);
?>

<?php
	$sql = "SELECT * FROM tasks";
	$query = $db->prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
	if (isset($_GET['id'])) {
		# code...
		$id = $_GET['id'];
		$edit_stmt = "SELECT * 
					FROM tasks
					WHERE id=".$id." Limit 1";
		$edit_query = $db->prepare($edit_stmt);
		$edit_query->execute();
		$edit_results = $edit_query->fetchAll(PDO::FETCH_ASSOC);
		//print_r($edit_results);
		//$username = $edit_result['username'];
	}
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
	<table class="table">
	   	<tr>
		    <th>ID</th>
		    <th>Task</th>
		    <th>Description</th>
		    <th>Date</th>
		    <th>Time</th>
		    <!--<th>Edit/Delete</th>-->
		</tr>

		<?php foreach( $results as $row ) {
			echo "<tr><td>";
			    echo $row['id'];
		        echo "</td><td>";
		        echo $row['task'];
		        echo "</td><td>";
		        echo $row['description'];
		        echo "</td><td>";
		        echo $row['date'];
		        echo "</td><td>";
		        echo $row['time'];
		        echo "</td>";
			    //echo "<a href=\"edit.php?id=".$row['id'].""."\">Edit</a>|";
			    //echo "<a href=\"edit.php?id=".$row['id'].""."\" onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>";
			    //echo "</td>";
		   	echo "</tr>";
		}
		?>
	</table>
		<?php
			if (isset($_GET['id'])){ 
				foreach ($edit_results as $result) {
					# code...
					echo "<form name=\"registration\" action=\"update.php?id=".$result['id']."\" method=\"POST\">";
				    echo    "<label for 'username'>Username: </label>";
				    echo    "<input type=\"text\" name=\"username\" value=".$result['username']." required/>";
				    echo    "<label for 'password'>Password: </label>";
				    echo    "<input type=\"password\" name=\"password\" value=".$result['password']." required/>";
				    echo    "<label for 'first_name'>First name: </label>";
				    echo    "<input type=\"text\" name=\"first_name\" value=".$result['first_name']." required/>";
				    echo    "<label for 'surname'>Surname: </label>";
				    echo    "<input type=\"text\" name=\"surname\" value=".$result['surname']." required/>";
				    echo    "<label for 'address'>Address: </label>";
				    echo    "<input type=\"text\" name=\"address\" value=".$result['address']." required/>";
				    echo    "<label for 'email'>Email: </label>";
				    echo    "<input type=\"text\" name=\"email\" value=".$result['email']." required/>";
				    echo    "<br/>";
				    echo    "<button type=\"submit\" name=\"update\">Update</button>"."&nbsp;&nbsp; Back to "."<a href=\"edit.php\">Edit page</a>";
				    echo "</form>";
				    //echo "&nbsp;&nbsp; Back to "."<a href=\"edit.php\">Edit page</a>";
				}
			}
			if (!empty($message)) {
					# code...
				echo "$message";
				}	
      	?>

      	

  </body>
 </html>
<?php
  // configuration info
  include 'connection.php';
?>

<?php
	// update statement
	print_r($_POST);
	if (isset($_POST['update'])) {
		$id = $_GET['id'];
		echo "$id";
		$task = $_POST['task'];
		echo "$task";
		$description = $_POST['description'];
		$day = $_POST['day'];
		$time = $_POST['time'];
		$update_stmt = "UPDATE tasks 
						SET task='$task', 
						description='$description', 
						day='$day', 
						time='$time' 
						WHERE id= $id";
		$update_query = $db->prepare($update_stmt);
		$update_query->execute();
		echo $update_query->rowCount();
		if ($update_query->rowCount() == 1) {
			//echo $update_query->rowCount()." record updated successfully";
			$message = "1 record was successfully updated!";
		}
		else {
			$message = "update failed!";
		}
		//$update_results = $update_query->fetchAll(PDO::FETCH_ASSOC);
	}
	//print_r($_POST);
?>

<?php
	// query to populate the table
	$sql = "SELECT * FROM tasks";
	$query = $db->prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
	// query to prepopulate fields of the form
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
		        echo $row['day'];
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
				    echo    "<label for 'task'>Username: </label>";
				    echo    "<input type=\"text\" name=\"task\" value=".$result['task']." required/>";
				    echo    "<label for 'description'>Description: </label>";
				    echo    "<input type=\"text\" name=\"description\" value=".$result['description']." required/>";
				    echo    "<label for 'day'>Date: </label>";
				    echo    "<input type=\"date\" name=\"day\" value=".$result['day']." required/>";
				    echo    "<label for 'time'>Time: </label>";
				    echo    "<input type=\"time\" name=\"time\" value=".$result['time']." required/>";
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
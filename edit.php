<?php include 'connection.php';?>

<?php
	if (isset($_GET['id'])) {
		$sql = "DELETE FROM tasks WHERE id=".$_GET['id'];
		$db->exec($sql);
		$delete = $db->exec($sql);
		if ($delete) {
			//echo $update_query->rowCount()." record updated successfully";
			$message = "1 record was successfully deleted!";
		}
	}
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
		    <th>Tasks</th>
		    <th>Description</th>
		    <th>Date</th>
		    <th>time</th>
		    <th>Edit/Delete</th>
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
			    echo "</td><td>";
			    echo "<a href=\"update.php?id=".$row['id'].""."\">Edit</a>|";
			    echo "<a id=\"delete\" href=\"edit.php?id=".$row['id'].""."\" onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>";
			    echo "</td>";
		   	echo "</tr>";
		}
		?>
	</table>

  </body>
 </html>
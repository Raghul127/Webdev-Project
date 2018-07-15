
<?php

function renderForm($id, $firstname, $error)

{

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>

<title>Edit Record</title>

</head>

<body>

<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>



<form action="" method="post">

<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<div>

<p><strong>ID:</strong> <?php echo $id; ?></p>

<strong>New Review: *</strong> <input type="text" name="firstname" value="<?php echo $firstname; ?>"/><br/>

<p>* Required</p>

<input type="submit" name="submit" value="Submit">

</div>

</form>

</body>

</html>

<?php

}







// connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



// check if the form has been submitted. If it has, process the form and save it to the database

if (isset($_POST['submit']))

{

// confirm that the 'id' value is a valid integer before getting the form data

if (is_numeric($_POST['id']))

{

// get form data, making sure it is valid

$id = $_POST['id'];

$firstname  = mysqli_real_escape_string($conn, $_POST['firstname']);



// check that firstname/lastname fields are both filled in

if ($firstname == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



//error, display form

renderForm($id, $firstname, $error);

}

else

{

// save the data to the database


$sql ="UPDATE data SET descr='$firstname' WHERE id='$id'";

   $result = $conn->query($sql);


// once saved, redirect back to the view page

header("Location: viewmy.php");

}

}

else

{

// if the 'id' isn't valid, display an error

echo 'Error!';

}

}

else

// if the form hasn't been submitted, get the data from the db and display the form

{



// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)

{

// query db

$id = $_GET['id'];

$sql ="SELECT * FROM data WHERE id=$id";
   $result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {



// get data from db

$firstname = $row['descr'];




// show form

renderForm($id, $firstname, '');

}}

else

// if no match, display result

{

echo "No results!";

}

}

else

// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error

{

echo 'Error!';

}

}

?>
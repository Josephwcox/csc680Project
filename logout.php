
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> </title>
	<style> </style>
</head>

<body>

	<header></header>

	<nav></nav>

	<main>
        
        <?php 
        
    session_start();
        unset($_SESSION["username"]);
        unset($_SESSION["password"]);
        
        unset ($_SESSION["login"]);
        header("Location: index.php");
        echo '<p>why isnt this working</p>';
        session_destroy();
        ?>
        
        
	</main>

	<footer>
	</footer>

</body>
</html>


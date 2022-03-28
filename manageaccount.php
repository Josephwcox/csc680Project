<?php
session_start();

if($_SESSION['username'] == NULL)
{
    
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Account</title>
	<style> </style>
    <link rel="stylesheet" href=css/styles.css>
</head>

<body>
        <?php 
            $server_name = "localhost";
            $db_name = "penpals";
            $user_name = "root";
            $password = "";
            
            $mysqli = new mysqli($server_name, $user_name, $password, $db_name);

        ?>
    
    <?php ?>
    
        <?php
        $username=$_SESSION['username'];
            $query="SELECT * FROM users u,account a WHERE  a.Screen_Name= '$username' AND u.UserID=a.UserID";
            $userResults = $mysqli->query ($query);
            $userInfo = $userResults->fetch_assoc();
        ?>
	<header>
        <div class="banner">
            <h1>PenPals</h1>
        </div>
    
    
    </header>

	<nav>
        <div class="navBar">
            <a href="manageaccount.php"> <div class="navButton">
               Account 
            </div></a>

            <a href="search.php"> <div class="navButton">
               Search 
            </div></a>

            <a href="messages.php"> <div class="navButton">
               Messages 
            </div></a>

            <a href="logout.php"> <div class="navButton">
               Log Out 
            </div></a>
        </div>
    </nav>

	<main>
        <h2>Account Management</h2>
        <div class="box signUpWrapper myInfo">
        <h3>My Info</h3>
            <div class="infoWrapper">
            <span class="myLabel">Name:</span> <span id="myName"><?php echo $userInfo['Name'] ?></span>
            
            <div class="right"><span class="myLabel">Pen Name:</span> <span id="myPenName"> <?php echo $userInfo['Screen_Name'] ?> </span></div><div class="clear-floating"></div>
            
            <span class="myLabel">Email Address:</span> <span id="myemail"><?php echo $userInfo['Email']; ?></span>
            
            <div class="right"><span class="myLabel">Phone:</span><span id="myPhone"> <?php echo $userInfo['Phone']; ?></span></div><div class="clear-floating"></div>
            
            <span class="myLabel">Date of Birth:</span> <span id="myDob"> <?php echo $userInfo['DOB']; ?></span><br>
            <span class="myLabel">City:</span> <span id="myCity"><?php echo $userInfo['City']; ?></span><br>
            <span class="myLabel">State:</span> <span id="myState"><?php echo $userInfo['State']; ?></span><br>
            <span class="myLabel">Country:</span> <span id="myCountry"><?php echo $userInfo['Country']; ?></span>
            <br>
        </div>
        </div>
        
        <div class="box signUpWrapper myInfo">
        <h3>My Interests</h3>
        
        <div id="interests">
        <?php
        
            $query2="SELECT * FROM interests i,account a WHERE  a.Screen_Name= '$username' AND a.Screen_Name= i.Screen_Name";
            $userInterests = $mysqli->query ($query2);
            
            
            while ($interest = $userInterests->fetch_assoc()) { 
                echo $interest['Interest'].', ';
            }
        ?>
        
        </div>
        <div class="buttonWrapper accountButtons">
            <form method='POST'>
            <input type="text" id="newInterest" name="newInterest">
            
            <button class="button button2" id="newInterestButton" >Add New Interest </button>
            </form>
            
         <?php
            
            if(isset($_POST['newInterest']))
            {
            $newInterest= $_POST['newInterest'];
            $addInterest="INSERT INTO `interests` (`Screen_Name`, `Interest`) VALUES ('".$username."', '".$newInterest."');";
            
            $added=$mysqli->query($addInterest);
            }
        ?>
        </div>
        
        </div>
	</main>

	<footer>

	</footer>

</body>
</html>


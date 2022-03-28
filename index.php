<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pen Pals</title>
	<style> </style>
    <link rel="stylesheet" href=css/styles.css>
</head>

<body>

	<header>
        <div class="banner">
            <h1>Pen Pals</h1>
        </div>
    
    
    </header>

	<nav>
    
    
    </nav>

	<main>
        <?php ?>
        <?php 
            $server_name = "localhost";
            $db_name = "penpals";
            $user_name = "root";
            $password = "";
            
            $mysqli = new mysqli($server_name, $user_name, $password, $db_name);

        ?>

        
    <div class=loginWrapper>
        <h2>Welcome to Pen Pals</h2>
        
        <div class="box info">
        <h3>Pan Pals is...</h3>
            <p>This site would be intended to help users find electronic pen pals with options to filter based on interests and geographic locations. 
            </p>
            <p> The site would not facilitate sharing images and will not share identifying characteristics of its users such as gender, date of birth, or other demographic details often used in social media sites.
            </p>
            <p>This site would be intended to put focus of its users toward the content of the conversation and shared interests. If users decide to share their personal information with their pen pals that is their decision to do so during their conversations.
            </p>
        </div>
        <div class="box login">
            
            <form id="loginForm" method="POST">
                <h3>Log In Here</h3>
                <label for="userName">User Name:</label><br>
                <input type="text" id="userName" name="userName"><br>
                <label for="pwd">Password:</label><br>
                <input type="password" id="pwd" name="pwd">
                
                <br>
                
                <div class="buttonWrapper">
                <a href="signup.php" class="button" id="signUp" >Sign Up! </a>

               <input type="submit" value="Login" class="button" id="LogInButton">
                </div>
                </div>
                </form>
                
        
        
        <?php
            session_start();

            $error = "";
            
            if(isset($_POST['userName']) && isset($_POST['pwd'])){
            $username = $_POST['userName'];
            $userPassword = $_POST['pwd'];
            
            $query="SELECT u.UserID, u.Password FROM users u WHERE u.password='$userPassword' AND u.UserID= '$username'";
            $userResults = $mysqli->query ($query);
            $userInfo = $userResults->fetch_assoc();
            
            
            if($username == $userInfo['UserID'] && $userPassword == $userInfo['Password']){
                
                $query="SELECT a.Screen_Name FROM users u,account a WHERE u.password='$userPassword' AND u.UserID= '$username' AND u.UserID=a.UserID";
                $screenNames = $mysqli->query ($query);
                $screenArray = $screenNames->fetch_assoc();
                $screenName= $screenArray['Screen_Name'];
                $_SESSION['login'] = true;
                $_SESSION['username'] = $screenName;
                header('location: manageaccount.php');
                        
               
        
                         

                        
            }
            else {
            $error = "Invalid username or password!";
            }
            }

  
               
                   
            
            
        
        ?>        
        </div>
        
	</main>

	<footer>
	</footer>

</body>
</html>

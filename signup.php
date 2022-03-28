<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<style> </style>
    <link rel="stylesheet" href=css/styles.css>
</head>

<body>

	<header>
        <div class="banner">
            <h1>PenPals</h1>
        </div>
    
    
    </header>

	<nav>
    
    
    </nav>

	<main>
                <?php 
            $server_name = "localhost";
            $db_name = "penpals";
            $user_name = "root";
            $password = "";
            
            $mysqli = new mysqli($server_name, $user_name, $password, $db_name);

        ?>
        <div class="box signUpWrapper">
        <h3>Sign Up</h3>
        <form id="newAccountForm" method='POST'>
            <div class="accountForm">
            <label for="newUserName">User Name:</label><br>
            <input type="text" id="newUserName" name="userName">
            <br>
                
            <label for="newPwd">Password:</label><br>
            <input type="password" id="newPwd" name="pwd">
            <br>
                
            <label for="confirmPwd">Confirm Password:</label><br>
            <input type="password" id="confirmPwd" name="confirmpwd">
            <br>
                
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email">
            <br>
                
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name">
            <br>
                
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob">
            <br>
            </div>
            

            
            <div class="accountForm">
            <label for="penName">Pen Name (Public Screen Name:</label><br>
            <input type="text" id="penName" name="penName">
            <br>
                
            <label for="city">City:</label><br>
            <input type="text" id="city" name="city">
            <br>
                
            <label for="state">State:</label><br>
            <input type="text" id="state" name="state">
            <br>
                
            <label for="country">Country:</label><br>
            <input type="text" id="country" name="country">
            <br>
            <label for="phone">Phone Number XXX-XXX-XXXX:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
            <br>
            <label for="language">Language:</label><br>
            <input type="text" id="language" name="language">
            <br>
            </div>
             <div class="buttonWrapper">
            <a href="index.html" class="button" id="BackToLogInButton right">Back to Log In</a>
            
             <button class="button" id="LogInButton" name='newAcc' type='submit'> Create Account </button>
             </div>
        </form>    

            
            
            <?php
                       session_start();

            $error = "";
            echo "<pre>";
            if(isset($_POST['newAcc'])){
                
                if(!empty($_POST['userName']))
                $username = $_POST['userName'];

                
                if(!empty($_POST['pwd']))
                 $userPassword = $_POST['pwd'];
                

                
                if(!empty($_POST['confirmpwd']))
                 $confirmPassword = $_POST['confirmpwd'];
                

                
                if(!empty($_POST['email']))
                 $email = $_POST['email'];
                


                if(!empty($_POST['name']))
                 $name = $_POST['name'];
                

                
                if(!empty($_POST['dob']))
                 $dob = $_POST['dob'];
                

                
                if(!empty($_POST['penName']))
                 $penName = $_POST['penName'];
                

                
                if(!empty($_POST['city']))
                 $city = $_POST['city']; 
                

       
                if(!empty($_POST['state']))
                 $state = $_POST['state'];
                
                

                
                if(!empty($_POST['country']))
                 $country = $_POST['country'];
                
                
                if(!empty($_POST['phone']))
                 $phone = $_POST['phone'];
                
                

                
                if(!empty($_POST['language']))
                 $language = $_POST['language'];
                               
                
            }
            
            
            echo "</pre>";
            
            if ($userPassword ==$confirmPassword)
            {
            $query="SELECT u.UserID FROM users u WHERE u.UserID= '$username'";
            $userResults = $mysqli->query ($query);
            $userInfo = $userResults->fetch_assoc();
                if(empty($userInfo))
                {
                   $query="SELECT a.Screen_Name FROM account a WHERE a.Screen_Name= '$penName'"; 
                    $userResults = $mysqli->query ($query);
                    $userInfo = $userResults->fetch_assoc();
                    
                    if(empty($userInfo))
                    {
                        $newUser="INSERT INTO `users` (`UserID`, `Password`, `Name`, `Phone`, `Email`, `DOB`) VALUES ('".$username."', '".$userPassword."', '".$name."', '".$phone."', '".$email."', '".$dob."')";
                        
                        $added=$mysqli->query($newUser);
                        
                        $newAccount="INSERT INTO `account` (`City`, `State`, `Country`, `Screen_Name`, `Primary_Language`, `UserID`) VALUES ('".$city."', '".$state."', '".$country."', '".$penName."', '".$language."', '".$username."');";
                        // echo "<p>".$newAccount."</p>";
                        $added=$mysqli->query($newAccount);
                        $_SESSION['login'] = true;
                        $_SESSION['username'] = $penName;
                       header('location: manageaccount.php');
                    }
                   
                }    
                        
                
            }

             
            ?>
            
        
        </div>
	</main>

	<footer>
	</footer>

</body>
</html>

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
        <?php 
            $server_name = "localhost";
            $db_name = "penpals";
            $user_name = "root";
            $password = "";
            
            $mysqli = new mysqli($server_name, $user_name, $password, $db_name);
            
            $username=$_SESSION['username'];
        ?>
    
    <?php ?>
        <h2>Find A New Pen Pal!</h2>
        <div class="box searchWrapper">
            <div class="searchContainer">
             <form method='post'>
            <label for="interestSearch">Interests:</label><br>
            <input type="text" id="interestSearch" name="interestSearch">
            <br>
            <br>
            <br>
            <div class="searchBox">
                <label for="CitySearch">City:</label><br>
                <input type="text" id="citySearch" name="citySearch">
            </div>
            
            <div class="searchBox">
                <label for="stateSearch">State:</label><br>
                <input type="text" id="stateSearch" name="stateSearch">
            </div>
            
            <div class="searchBox">
                <label for="countrySearch">Country:</label><br>
                <input type="text" id="countrySearch" name="countrySearch">
            </div>
                
            <div class="buttonWrapper searchButtons">
                <button class="button button2 right" id="searchButton" name='searchButton'>Find Pen Pals </button>
                <div class="clear-floating"></div>
            </div>
            </form>
            </div>
        </div>
        <?php

            
            if(isset($_POST['searchButton']))
            {
                $sharedInterest="";
                $query="SELECT DISTINCT a.Screen_Name FROM account a, interests i WHERE a.Screen_Name= i.Screen_Name";
                if(!empty($_POST['interestSearch']))
                {
                $interest= $_POST['interestSearch'];
                $sharedInterest=$sharedInterest.$interest." ";
                $query = $query. " AND i.interest = '$interest'";
                }

                if(!empty($_POST['citySearch']))
                {
                $city= $_POST['citySearch'];
                $query = $query." AND a.city = '$city'";
                $sharedInterest=$sharedInterest.$city." ";
                }

                if(!empty($_POST['stateSearch']))
                {
                $state= $_POST['stateSearch'];
                $query = $query." AND a.state = '$state'";
                $sharedInterest=$sharedInterest.$state." ";
                $sharedInterest=$sharedInterest.$state." ";
                }

                if(!empty($_POST['countrySearch']))
                {
                $country= $_POST['countrySearch'];
                $query = $query." AND a.country = '$country'";
                $sharedInterest=$sharedInterest.$country." ";
                }
                $results = $mysqli->query ($query); 
                
            
        
        
        ?>
            <div class="box resultWrapper ">
            <h3>These Pen Pals Share Your Interests!</h3>

                <div class="resultContainer">
                <table class="searchResultTable">
                    <tr class="titleRow">
                        <th class="col1">Pen Name</th>
                        <th class="col2">Shared Interests</th>
                        <th class=buttonCol></th>
                    </tr>
                     <?php while ($result = $results->fetch_assoc()) { 
                         if($result["Screen_Name"]!=$username){
                             $messageURL= "messages.php?id=".$result['Screen_Name'];
                         ?>
                    <tr class="resultRow">
                        <td class="col1" id=rName1><?php echo $result["Screen_Name"] ?></td>
                        <td class="col2" id=rInterest1> <?php echo $sharedInterest ?> </td>
                        <th class=buttonCol>            
                            
                                <div class="buttonWrapper">
                                    <a href='<?php echo $messageURL ?>'><button class="button button2 resultButton" name="resultButton">Message
                                        </button></a>
                                    
                                </div>
                            
                        </td>
                    </tr>
                     <?php 
                     }
                     }
                     
                     }
                     ?> 
                    
                    
                </table>
                    
                </div>
            </div>
        
    
 
	</main>

	<footer>
	</footer>

</body>
</html>
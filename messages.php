<?php
session_start();


if($_SESSION['username'] == NULL)
{
    
    header("Location: index.php");
}

$currentPenpal=$_GET['id']; 
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
            
            $query="SELECT Friend_Name FROM friends f  WHERE  f.Screen_Name= '$username'";
            $friends = $mysqli->query ($query);
                        
            $query="SELECT Blocked_User FROM blocked b  WHERE  b.Screen_Name= '$username';";     
            $blocked = $mysqli->query ($query);
            
            $query="SELECT DISTINCT c.Screen_Name1, c.Screen_Name2 FROM conversation c WHERE  (c.Screen_Name1 = '$username' OR c.Screen_Name2 = '$username');";     
            $myconvos = $mysqli->query ($query);
            
            $query="SELECT * FROM conversation c, messages m  WHERE  (c.Screen_Name1 = '$username' OR c.Screen_Name2 = '$username')AND(c.Screen_Name1 = '$currentPenpal' OR c.Screen_Name2 = '$currentPenpal') AND c.Conversation_ID=m.Conversation_ID ORDER BY m.TimeStamp ASC;";     
            $currentConvo = $mysqli->query ($query);
            
 
            
            ;
        ?>
       
        
        <br>
        <div class="box sideBox">
            <div class="smallBoxTitle">
                <p>My Conversations</p> 
            </div>
            <div class="smallBoxText">
            <?php while ($myconvo = $myconvos->fetch_assoc()) { 
                $sname1=$myconvo['Screen_Name1'];
                $sname2=$myconvo['Screen_Name2'];
                
                if($sname1==$user_name)
                {
                    $messageURL= "messages.php?id=".$sname1;
                    echo'<a href='.$messageURL.'><p> '.$sname1.'</p></a>';   
                }
                else
                { $messageURL= "messages.php?id=".$sname2;
                   echo'<a href='.$messageURL.'><p> '.$sname2.'</p></a>'; 
                }
            }   ?>

            </div>
        </div>
        
        <div class="box convBox">
            <div class="conversationWrapper">
                <div class=convPenpal><span class="myLabel">Pen Pal:</span><span id="currentPenpal"><?php echo $currentPenpal ?></span></div>
                
                <div class="smallButtonWrapper">
                <button class="button button2 addButton" id="addButton">Add</button></div>
                
                <div class="smallButtonWrapper">
                <button class="button button2 blockButton" id="blockButton">Block</button></div>
                
                <div><span class="myLabel">Matching Interests:</span><span id="matchedInterests"> Examples, writing, Nature</span></div>
                <br>
                <p class="myLabel">Message Log</p>
                
                <div class="messageLog">
                    <?php 
                            while($convo = $currentConvo->fetch_assoc()){
                            
                            ?>
                    
                    <div class="message" >
                        <span class="myLabel" id="timestamp1"><?php echo $convo['TimeStamp'] ?></span>
                        <span class="myLabel" id="sender1"><?php echo $convo['Sender'] ?></span>
                        <p id="messageText1"> <?php echo $convo['Message_Text'] ?></p>
                        
                    </div>
                    
                            <?php }
                            
                            if(!empty($convo['Message_Text'])){
                            }
                            else{
                                            
                                
                            $newConvo="INSERT INTO `conversation` (`Conversation_ID`, `Screen_Name1`, `Screen_Name2`, `Matched_Interests`) VALUES (NULL, '".$username."', '".$currentPenpal."', '');";
                            $newConvo1 = $mysqli->query ($newConvo);
                            
                            $query='SELECT `Conversation_ID` FROM `conversation` WHERE `Screen_Name1`="NewUser";';     
                            $currentConvo = $mysqli->query ($query);
                            $convo = $currentConvo->fetch_assoc();
                            $conversationID=$convo['Conversation_ID'];
                            echo "<p>".$conversationID."</p>";
                            }
?> 
                

                </div>
                <div class="newMessage">
                    <form method='POST'>
                <textarea id="newMessageText" name="newMessage" rows="10" cols="50">
                </textarea>
                <div class="buttonWrapper sendMessage">
                    <button class="button button2 right" id="sendButton" type='submit'>Send Message </button>
                <div class="clear-floating"></div>
                </form>
                <?php 
                if(isset($_POST['newMessage'])) 
                {
                    $messageText=$_POST['newMessage'];
                    $sender=$username;
                    $Recipient=$currentPenpal;
                    
                    $conversationID=$convo['Conversation_ID'];
                   
                    $newMessage="INSERT INTO `messages` (`Message_ID`, `Conversation_ID`, `Sender`, `Recipient`, `TimeStamp`, `Message_Text`) VALUES "
                            . "(NULL, '$conversationID', '$sender', '$Recipient', current_timestamp(), '$messageText')";
                    
                   echo "<p>".$newMessage."</p>";
                    $added=$mysqli->query($newMessage);
                }
                    ?>
                
                </div>
                </div>

                
            </div>
 
        </div>
        
        <div class="sideBox">
            <div class="box messagesRight">
                <div class="smallBoxTitle">
                    <p>My Pen Pals</p>
                </div>
                <div class="smallBoxText">
                
             <?php while ($friend = $friends->fetch_assoc()) { 
                echo'<p> '.$friend['Friend_Name'].'</p>';
            }   ?>
                <br>
                </div>
            </div>

            <div class="box messagesRight">
                <div class="smallBoxTitle">
                    <p>Blocked Users</p>
                </div>
                <div class="smallBoxText">
                    
                <?php while ($block = $blocked->fetch_assoc()) { 
                echo'<p>'.$block['Blocked_User'].'</p>';
            }   ?>

                </div>
            </div>
        </div>
        
	</main>

	<footer>
	</footer>

</body>
</html>
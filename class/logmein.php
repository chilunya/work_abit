<?php
//start session
session_start();
class logmein {
	//database setup 
       //MAKE SURE TO FILL IN DATABASE INFO
	var $hostname_logon = '192.168.5.112';		//Database server LOCATION
	var $database_logon = 'Abitur';		//Database NAME
	var $username_logon = 'asu';		//Database USERNAME
	var $password_logon = '5Y7jwSzL2DyEAApt';		//Database PASSWORD
	
	//table fields
	var $user_table = 'pass';		//Users table name
	var $user_column = 'log';		//USERNAME column (value MUST be valid email)
	var $pass_column = 'pass';		//PASSWORD column
	var $md5_pass_column = 'md5_pass';
	var $user_level = 'level';		//(optional) userlevel column
	
	//encryption
	var $encrypt = false;		//set to true to use md5 encryption for the password
	var $encrypt_for_ais = true;		//set to true to use md5 encryption for the password
	//connect to database
	function dbconnect(){
		$connections = mysql_connect($this->hostname_logon, $this->username_logon, $this->password_logon) or die ('Unabale to connect to the database');
		mysql_select_db($this->database_logon) or die ('Unable to select database!');	
		return;
	}
	//login function
	function login_with_ais($table, $login, $pass){	
	    $this->dbconnect();
		//make sure table name is set
		if($this->user_table == ""){
			$this->user_table = $table;
		}
		//execute login via qry function that prevents MySQL injections
		$result = $this->qry("SELECT * FROM ".$this->user_table." WHERE ".$this->user_column."='?' AND ".$this->md5_pass_column." = '?';" , $login, $pass);
		$row=mysql_fetch_assoc($result);
		//echo($row);
		if($row != "Error"){
			if($row[$this->user_column] !="" && $row[$this->md5_pass_column] !=""){
				//register sessions
				//you can add additional sessions here if needed
				$_SESSION['nnname'] = $row[$this->user_column];
				//$_SESSION['loggedin'] = $row[$this->pass_column];
				//userlevel session is optional. Use it if you have different user levels
				$_SESSION['levl'] = $row[$this->user_level];
				header('Location: index.php');	
			}else{
				session_destroy();
				return false;
			}
		}else{
			return false;
		}
		
	}
	//login function
	function login($table, $username, $password){	
	        $this->dbconnect();
		//make sure table name is set
		if($this->user_table == ""){
			$this->user_table = $table;
		}
		//check if encryption is used
		if($this->encrypt == true){
			$password = md5($password);	
		}
		//execute login via qry function that prevents MySQL injections
		$result = $this->qry("SELECT * FROM ".$this->user_table." WHERE ".$this->user_column."='?' AND ".$this->pass_column." = '?';" , $username, $password);
		$row=mysql_fetch_assoc($result);
		if($row != "Error"){
			if($row[$this->user_column] !="" && $row[$this->pass_column] !=""){
				//register sessions
				//you can add additional sessions here if needed
				$_SESSION['username'] = $row[$this->user_column];
				$_SESSION['loggedin'] = $row[$this->pass_column];
				//userlevel session is optional. Use it if you have different user levels
				$_SESSION['userlevel'] = $row[$this->user_level];
				return true;	
			}else{
				session_destroy();
				return false;
			}
		}else{
			return false;
		}
		
	}
	
	//prevent injection
	function qry($query) {
	  $this->dbconnect();
      $args  = func_get_args();
      $query = array_shift($args);
      $query = str_replace("?", "%s", $query);
      $args  = array_map('mysql_real_escape_string', $args);
      array_unshift($args,$query);
      $query = call_user_func_array('sprintf',$args);
      $result = mysql_query($query) or die(mysql_error());
		  if($result){
		  	return $result;
		  }else{
		 	 $error = "Error";
		 	 return $result;
		  }
    }
	
	//logout function 
	function logout(){
		session_destroy();
		header('Location: http://priem.pguas.ru/');	
	}
	
	//check if loggedin
	function logincheck($logincode, $user_table, $pass_column, $user_column){
	       $this->dbconnect();	
               //make sure password column and table are set
		if($this->pass_column == ""){
			$this->pass_column = $pass_column;	
		}
		if($this->user_column == ""){
			$this->user_column = $user_column;	
		}
		if($this->user_table == ""){
			$this->user_table = $user_table;	
		}
		//exectue query
		$result = $this->qry("SELECT * FROM ".$this->user_table." WHERE ".$this->pass_column." = '?';" , $logincode);
		$rownum = mysql_num_rows($result);
		

		

		//return true if logged in and false if not
		if($row != "Error"){
			if($rownum > 0){
				return true;	
			}else{
				return false;	
			}
		}
	}
	
	//reset password
	function passwordreset($username, $user_table, $pass_column, $user_column){
		$this->dbconnect();
                //generate new password
		$newpassword = $this->createPassword();
		
		//make sure password column and table are set
		if($this->pass_column == ""){
			$this->pass_column = $pass_column;	
		}
		if($this->user_column == ""){
			$this->user_column = $user_column;	
		}
		if($this->user_table == ""){
			$this->user_table = $user_table;	
		}
		//check if encryption is used
		if($this->encrypt == true){
			$newpassword = md5($newpassword);	
		}
		
		//update database with new password
		$qry = "UPDATE ".$this->user_table." SET ".$this->pass_column."='".$newpassword."' WHERE ".$this->user_column."='".stripslashes($username)."'";
		$result = mysql_query($qry) or die(mysql_error());
		
		$to = stripslashes($username);
		//some injection protection
		$illigals=array("n", "r","%0A","%0D","%0a","%0d","bcc:","Content-Type","BCC:","Bcc:","Cc:","CC:","TO:","To:","cc:","to:");
		$to = str_replace($illigals, "", $to);
		$getemail = explode("@",$to);
		
		//send only if there is one email
		if(sizeof($getemail) > 2){
			return false;	
		}else{
			//send email
			$from = $_SERVER['SERVER_NAME'];
			$subject = "Password Reset: ".$_SERVER['SERVER_NAME'];
			$msg = "
Your new password is: ".$newpassword."

";
			
			//now we need to set mail headers
			$headers = "MIME-Version: 1.0 rn" ;
			$headers .= "Content-Type: text/html; rn" ;
			$headers .= "From: $from  rn" ;
			
			//now we are ready to send mail
			$sent = mail($to, $subject, $msg, $headers);
			if($sent){
				return true; 
			}else{
				return false;	
			}
		}
	}
	
	//create random password with 8 alphanumerical characters
	function createPassword() {
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
		while ($i <= 7) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return $pass;
	}
	
	//login form
     function loginform($formname, $formclass){
		 
      		$this->dbconnect();
      		echo'<div class="login"><form name="'.$formname.'" method="post" id="'.$formname.'" class="'.$formclass.'" enctype="application/x-www-form-urlencoded" >
      		<input name="username" id="username" type="text" class="input-small" placeholder="Логин">
      		<input name="password" id="password" type="password" class="input-small" placeholder="Пароль">
      		<input name="action" id="action" value="login" type="hidden">
      		<input name="submit" id="submit" value="Войти" type="submit" class="btn">
      		</form></div>';
		
     }
    //reset password form
     function resetform($formname, $formclass, $formaction){
      		$this->dbconnect();
      		echo'<form name="'.$formname.'" method="post" id="'.$formname.'" class="'.$formclass.'" enctype="application/x-www-form-urlencoded" action="'.$formaction.'">
      		<div><label for="username">Username</label>
      		<input name="username" id="username" type="text"></div>
      		<input name="action" id="action" value="resetlogin" type="hidden">
      		<div><input name="submit" id="submit" value="Reset Password" type="submit"></div>
      		</form>';
     }
	//function to install logon table
	function cratetable($tablename){
                $this->dbconnect();
		$qry = "CREATE TABLE IF NOT EXISTS ".$tablename." (
			  userid int(11) NOT NULL auto_increment,
			  useremail varchar(50) NOT NULL default '',
			  password varchar(50) NOT NULL default '',
			  userlevel int(11) NOT NULL default '0',
			  PRIMARY KEY  (userid)
			)";
		$result = mysql_query($qry) or die(mysql_error());
		return;
	}
       //register function by Micah B-F.
function register($table, $username, $password){ 
    //conect to DB
    $this->dbconnect(); 
    //make sure table name is set 
    if($this->user_table == ""){ 
   	 $this->user_table = $table; 
    } 
    //check if encryption is used 
    if($this->encrypt == true){ 
    	$password = md5($password); 
    } 
    //execute registration via qry function that prevents MySQL injections 
    $result = $this->qry("INSERT INTO ".$this->user_table." VALUES(DEFAULT,'?','?',DEFAULT)", $username, $password); 
    $row=mysql_fetch_assoc($result); 
    if($row != "Error"){ 
    if($row[$this->user_column] !="" && $row[$this->pass_column] !=""){ 
        //register sessions 
        //you can add additional sessions here if needed 
        $_SESSION['loggedin'] = $row[$this->pass_column]; 
        $_SESSION['username'] = $username; 
        //userlevel session is optional. 
        //Use it if you have different user levels
        $_SESSION['userlevel'] = $row[$this->user_level]; 
        return true;
    }else{ 
        session_destroy(); 
        return false; 
    }
    }else{
    	return false; 
    } 
}
}
?>
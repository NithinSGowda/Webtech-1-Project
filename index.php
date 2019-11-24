<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>


<html>
	<head>
	<script defer src="script.js"></script>
		<title>GUI Web Builder</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="icon" href="Images/ezgif.com-gif-maker.png">

    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
	</head>
	<body>
		<div class="blue">
			<div class="colorChanger">
			<input type="color" class="picker1" value="#176bfd" >
			<button  class="change" onclick="changeColor()">Change Color</button>
			<input type="color" class="picker2" value="#000ed4"></div>
		<div class="a">
			<span class="a1 et">
				PES University
			</span>
			<span class="a2 et">
				Web-Tech Project
			</span>
			<span class="a3 et">
				Department of CSE
			</span>
				<a href="mailto:oneandonlytobe@gmail.com" class="a5"><img src="Images/question-circle-solid.svg" width="35px"></a>
			<div class="Download a4" onclick="download()"><img src="Images/download-solid.svg" width="30px"></div>
		</span>
		</div>
		<div class="head">
			<img src="Images/ezgif.com-gif-maker.png" class="logo et" width="40px">
			<span class="title et">GUI Web Builder</span> 
			<span class="nav">
				<ul>
					<li class="et">Overview</li>
					<li class="et">Landings</li>
					<li class="et">Pages</li>
					<li class="et">Docs</li>
				</ul>
				</span>
		</div>
		<div class="head2">
			<span class="b1 et">
				Web development<br>Now made easy
			</span><br><br>
			<span class="b2 et">
				Build amazing websites with our GUI Web builder .
			</span><br><br><br>
			<span class="b3">
					<button class="b4 et">See features</button>
					<button class="b5 et">Documentation</button>
			</span>
		</div>
		</div>
		<div class="c">
			<table class="cust"  cellspacing=50px>
				<tr>
					<th class="c1 et">10k<br>Customers</th>
					<th class="c1 et">50k<br>Downloads</th>
					<th class="c1 et">98%<br>Happy Users</th>
				</tr>
			</table>
		</div>
			<p class="c31 et">Code faster and better</p>
			<p class="c32 et">With an intuitive markup, powerful and lightning fast build tools, Quick has everything you need to turn your ideas into incredible products.</p>
		<div class="c2 et">
			<img src="coder.svg" width="500px">
		</div>
		<div class="hrline">
			</div>

		<div class="d">
		<div class="d1">
			<span class="d11 et">Key features</span>
			<div class="d12 et">Our Website helps you buil beautiful websites that stand out and <br> automatically adapt to your style.</div>
			<div class="d2">
				<table class="d21" cellspacing="40px">
					<tr>
						<td class="d22 et"><img src="Images/11.png"><br><p class="dd1" style="padding-bottom: 7px;
							padding-top: 13px;">Modular</p><p class="dd2">All components are built to be used in any combination.</p></td>
						<td class="d22 et"><img src="Images/22.png"><br><p class="dd1"  style="padding-bottom: 17px;
							padding-top: 3px;">Responsive</p><p class="dd2">Quick is optimized to work for most devices.</p></td>
						<td class="d22 et"><img src="Images/33.png"><br><p class="dd1">Scalar</p><p class="dd2">Remain consistent while developing new features.</p></td>
						<td class="d22 et"><img src="Images/44.png"><br><p class="dd1">Customizable</p><p class="dd2">Change a few variables and the whole theme adapts.</p></td>
					</tr>
				</table>
			</div>
		</div>
		</div>
		<div class="hrline">
			</div>
			

		<div class="f">
			<span class="f1 et"><img src="Images/img2.png" width="500px"></span>
			<span class="f2 et"><div class="f21">Change the way you build<br>websites</div>
			<div class="f22 et">You can combine all the Quick templates into a<br>single one, you can take a component from the<br>Application theme and use it in the Website.</div>
			<span class="f23 et">Modularity at its best</span>
			</span>
		</div>
		<div class="hrline">
		</div>

		<div class="footer">
		<table class="foottable">
			<tr>
				<th class="et">Account</th>
				<th class="et">About</th>
				<th class="et">Company</th>
			</tr>
			<tr>
				<td class="et">Profile</td>
				<td class="et">Services</td>
				<td class="et">Terms</td>
			</tr>
			<tr>
				<td class="et">Settings</td>
				<td class="et">Contact</td>
				<td class="et">Privacy</td>
			</tr>
			<tr>
				<td class="et">Billings</td>
				<td class="et">Career</td>
				<td class="et">Support</td>
			</tr>
			<tr>
				<td class="et">Notifications</td>
			</tr>
		</table>
		
		</div>
		<div class="credits">&copyDeveloped by GUI Web Developer</div>
		
		

		<div class="login-form">
			<div class="wrapper">
				<h2>Sign Up</h2>
				<p>Please fill this form to create an account.</p>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
					<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
						<label>Username</label><br>
						<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
						<span class="help-block"><?php echo $username_err; ?></span>
					</div>    
					<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
						<label>Password</label><br>
						<input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
						<span class="help-block"><?php echo $password_err; ?></span>
					</div>
					<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
						<label>Confirm Password</label><br>
						<input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
						<span class="help-block"><?php echo $confirm_password_err; ?></span>
					</div><br>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Submit">
						<input type="reset" class="btn btn-default" value="Reset">
					</div><br>
					<p>Already have an account? <span class="registerOption" onclick="login()">Login here</a>.</p>
				</form>
			</div>
		</div>

		<div class="loginButton" onclick="login()">
			Login
		</div>
		<div class="existinglogin">
		<div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label><br>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label><br>
                <input type="password" name="password" class="form-control"><br><br>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <span class="registerOption" onclick="register()">Sign up now</span>.</p>
        </form>
    </div></div>
	
	
	
	
	
	<div class="inpt">
		<div class="inpi">
			<textarea name="text" style = "height: 10em;" placeholder="Enter the text here"></textarea>
			<button class="inpb" id="L" >Insert Link</button><br>
			<button class="inpb" id="B">B</button>
			<button class="inpb" id="I">I</button>
			<button class="inpb" id="U">U</button>
			<input type="checkbox" name="shadow">Shadow&nbsp;&nbsp;
			<input type="color" class="pickerg"><br>
			<button class="submit">Submit</button>
		</div>
	</div>

	<div class="inpl">
		<div class="inpi">
			<textarea name="text" placeholder="Enter the text here"></textarea><br><br>
			<textarea name="link" placeholder="Enter the link here"></textarea><br><br>
			
			<button class="submit">Submit</button>
		</div>
	</div>

	<div class="tutorial" hidden>
		<div class="tt1">
			<div class="tt1b"><span class="arrow">&lt &lt</span>    Double click on any element to edit it</div>
			<div class="next" onclick="nxt1()">Next</div>
		</div>

		<div class="tt2">
			<div class="tt2b"><span class="arrow"> &lt</span>   Drag and drop any element to change its position</div>
			<div class="next" onclick="nxt2()">Next</div>
		</div>

		<div class="tt3">
			<div class="tt3a arrow tt3a1">&lt &lt</div>
			<div class="tt3b">Select any two colors and click here to change color</div>
			<div class="tt3a arrow tt3a2">&gt &gt</div>
			<div class="next" onclick="nxt3()">Next</div>
		</div>
	</div>
	<div class="downloader">
		<div class="intoMark" onclick="remover()">X</div>
	<div class="DBox">
		<div class="h1h">You are just 2 steps away from downloading your website</div>
		<div class="h2h">Step 1 : Close this instruction box </div>
		<div class="h2h">Step 2 : Press <span class="h4h">CTRL + S </span></div>
	</div>
</div>

	</body>
	<div class="dark" onclick="dl()">
	</div>
	<div class="jss">
	<script defer src="script.js"></script>
</div>
</html>


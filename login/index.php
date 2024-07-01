<?php
require_once 'includes/signup_view.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/reset.css">
</head>

<body>
    <main>

    <h3>
        <?php
        output_username();
        ?>
    </h3>

    <?php
    if(!isset($_SESSION["user_id"])) { 
        // show login form just if not logged in
    ?>

    <h1>Login</h1>

    <form action="includes/login.inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <button>Login</button>
    </form> 
            
    <?php } ?>
    
    <?php
    check_login_errors();
    ?>

<?php
    if(!isset($_SESSION["user_id"])) {
    ?>
    
    <h1>Sign in</h1>

    <form action="includes/signup.inc.php" method="post">
        <?php
        signup_inputs()
        ?>
        <button>Sign in</button>

        <?php } ?>    

<!-- Původně místo funkce signup_inputs()
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <input type="text" name="email" placeholder="Email">
-->
    </form> 

    <?php
    check_singup_errors();
    ?>

    
    <?php
    if(isset($_SESSION["user_id"])) { 
        // show login form just if is logged in
    ?>

    <form action="includes/logout.inc.php" method="post">
        <button>Logout</button>
    </form> 

    <?php } ?>

    <!--
        <form class="searchform" action="search.php" method="post">
            <label for="search">Search for user:</label>
            <input id="search" type="text" name="usersearch" placeholder="Search...">
            <button>Search</button>
        </form>

       

        <h1>Change account</h1>

        <form action="includes/userupdate.inc.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="text" name="email" placeholder="Email">
            <button>Update</button>
        </form> 

        <h1>Delete account</h1>

        <form action="includes/userdelete.inc.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <button>Delete</button>
        </form> 
-->

    </main>
</body>

</html>
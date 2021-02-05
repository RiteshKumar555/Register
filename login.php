    <?php include('server.php') ?>
    <!DOCTYPE html>
    <html>
    <head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <div class="header">
        <h2>Login</h2>
    </div>
        
    <form method="post" action="login.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="login_user">Login</button>
        </div>
        <p>
            Not yet a member? <a href="register.php">Sign up</a>
        </p>
    </form>
    </body>
    </html>
      <!-- <td>' . '<a href="delete.php?id='.$row["id"].'"><button>Delete</button></a>&nbsp&nbsp<input type="button" id="btnQueryString" value="Send" /></button>' . '</td> -->

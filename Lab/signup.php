<?php require_once "signup_process.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shovon's Portfolio</title>
    <link rel="stylesheet" href="contacts.css">
</head>

<body>
        <h1>SignUp Page</h1>
        <p><span class="required">* Required field</span></p>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <fieldset>
                

                <table class="form-table">

                <tr>
                    <td>First Name <span class="required">*</span></td>
                    <td>
                        <input type="text" name="fname" value="<?php echo $fname; ?>">
                        <div class="error"><?php echo $fnameErr; ?></div>
                    </td>
                </tr>

                <tr>
                    <td>Last Name <span class="required">*</span></td>
                    <td>
                        <input type="text" name="lname" value="<?php echo $lname; ?>">
                        <div class="error"><?php echo $lnameErr; ?></div>
                    </td>
                </tr>

                <tr>
                    <td>Contact Number </td>
                    <td>
                        <input type="number" name="number" value="<?php echo $number; ?>">
                        <div class="error"><?php echo $numberErr; ?></div>
                    </td>
                </tr>

                <tr>
                    <td>Email <span class="required">*</span></td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                        <div class="error"><?php echo $emailErr; ?></div>
                    </td>
                </tr>

                <tr>
                    <td>Password <span class="required">*</span></td>
                    <td>
                        <input type="password" name="pass" value="<?php echo $pass; ?>">
                        <div class="error"><?php echo $passErr; ?></div>
                    </td>
                </tr>

                

                <tr>
                    <td></td>
                    <td><input type="submit" value="Register"></td>
                </tr>

                </table>

            </fieldset>
        </form>

   <?php if ($_SERVER["REQUEST_METHOD"] == "POST" &&
        !$fnameErr && !$lnameErr && !$numberErr && !$emailErr): ?>
        <h3>Submitted values</h3>
        <table class="result-table">
            <tr><td>First Name</td><td><?php echo $fname; ?></td></tr>
            <tr><td>Last Name</td><td><?php echo $lname; ?></td></tr>
            <tr><td>Contact Number</td><td><?php echo $number; ?></td></tr>
            <tr><td>Email</td><td><?php echo $email; ?></td></tr>
        </table>
    <?php endif; ?>

</body>

</html>

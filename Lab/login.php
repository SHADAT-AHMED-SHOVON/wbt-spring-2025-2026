<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <h2>Student Login</h2>
    <p><span class="required">* required field</span></p>

    <form method="post" action="login_process.php">
        <table class="form-table">
            <tr>
                <td>Email <span class="required">*</span></td>
                <td>
                    <input type="text" name="email" required placeholder="example@mail.com">
                </td>
            </tr>
            <tr>
                <td>Password <span class="required">*</span></td>
                <td>
                    <input type="password" name="password" required placeholder="Minimum 8 characters">
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Login"></td>
            </tr>
        </table>
    </form>
</body>
</html>
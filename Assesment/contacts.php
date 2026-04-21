<?php require_once "contact_process.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shovon's Portfolio</title>
    <link rel="stylesheet" href="contacts.css">
</head>

<body>
        <h1>Contact Me</h1>
        <p><span class="required">* Required field</span></p>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <fieldset>
                <legend>Registration Form</legend>

                <table class="form-table">

                <tr>
                    <td>Name <span class="required">*</span></td>
                    <td>
                        <input type="text" name="name" value="<?php echo $name; ?>">
                        <div class="error"><?php echo $nameErr; ?></div>
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
                    <td>Gender <span class="required">*</span></td>
                    <td>
                        <input type="radio" name="gender" value="female" <?php echo ($gender == "female") ? "checked" : ""; ?>> Female &nbsp;
                        <input type="radio" name="gender" value="male" <?php echo ($gender == "male") ? "checked" : ""; ?>> Male
                        <div class="error"><?php echo $genderErr; ?></div>
                    </td>
                </tr>

                <tr>
                    <td>Company <span class="required">*</span></td>
                    <td>
                        <input type="text" name="company" value="<?php echo $company; ?>">
                        <div class="error"><?php echo $companyErr; ?></div>
                    </td>
                </tr>

                <tr>
                    <td>Reason of Contact <span class="required">*</span></td>
                    <td>
                        <input type="radio" name="reason" value="projects" <?php echo ($reason == "projects") ? "checked" : ""; ?>> Projects &nbsp;
                        <input type="radio" name="reason" value="thesis" <?php echo ($reason == "thesis") ? "checked" : ""; ?>> Thesis &nbsp;
                        <input type="radio" name="reason" value="job" <?php echo ($reason == "job") ? "checked" : ""; ?>> Job &nbsp;
                        <div class="error"><?php echo $reasonErr; ?></div>
                    </td>
                </tr>

                <tr>
                    <td>Skills <span class="required">*</span></td>
                    <td>
                        <input type="checkbox" name="skills[]" value="web development" <?php echo in_array("web development", $skills) ? "checked" : ""; ?>> Web Development &nbsp;
                        <input type="checkbox" name="skills[]" value="mobile development" <?php echo in_array("mobile development", $skills) ? "checked" : ""; ?>> Mobile Development &nbsp;
                        <input type="checkbox" name="skills[]" value="ai development" <?php echo in_array("ai development", $skills) ? "checked" : ""; ?>> AI/ML Development &nbsp;
                        <div class="error"><?php echo $skillsErr; ?></div>
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
        !$nameErr && !$emailErr && !$genderErr && !$companyErr && !$reasonErr && !$skillsErr): ?>
        <h3>Submitted values</h3>
        <table class="result-table">
            <tr><td>Name</td><td><?php echo $name; ?></td></tr>
            <tr><td>Email</td><td><?php echo $email; ?></td></tr>
            <tr><td>Company</td><td><?php echo $company; ?></td></tr>
            <tr><td>Reason of Contact</td><td><?php echo $reason; ?></td></tr>
            <tr><td>Gender</td><td><?php echo $gender; ?></td></tr>
            <tr><td>Skills</td><td><?php echo implode(", ", $skills); ?></td></tr>
        </table>
    <?php endif; ?>

</body>

</html>

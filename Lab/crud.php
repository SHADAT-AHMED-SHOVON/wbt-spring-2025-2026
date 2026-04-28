<?php
// ---------- Database connection ----------
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";          
$DB_NAME = "school";

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");

// ---------- Action router ----------
$action  = $_REQUEST["action"]  ?? "";
$message = "";        // success message shown after an action
$error   = "";        // error message
$editing = null;      // record currently being edited (if any)

// ---------- CREATE ----------
if ($_SERVER["REQUEST_METHOD"] === "POST" && $action === "create") {
    $first = trim($_POST["first_name"] ?? "");
    $last  = trim($_POST["last_name"]  ?? "");
    $email = trim($_POST["email"]      ?? "");
    $number = trim($_POST["number"]    ?? "");
    $pass   = trim($_POST["pass"]      ?? "");

    if ($first === "" || $last === "" || $email === "" || $number === "" || strlen($pass) < 8) {
        $error = "All fields are required. Password must be at least 8 characters.";
    } else {
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO students (first_name, last_name, email, number, pass)
             VALUES (?, ?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $email, $number, $pass);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Student added successfully (ID: "
                     . mysqli_stmt_insert_id($stmt) . ").";
        } else {
            $error = "Could not add student: " . mysqli_stmt_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}

// ---------- UPDATE ----------
if ($_SERVER["REQUEST_METHOD"] === "POST" && $action === "update") {
    $id    = (int)($_POST["id"] ?? 0);
    $first = trim($_POST["first_name"] ?? "");
    $last  = trim($_POST["last_name"]  ?? "");
    $email = trim($_POST["email"]      ?? "");
    $number = trim($_POST["number"]    ?? "");
    $pass   = trim($_POST["pass"]      ?? "");

    if ($id <= 0 || $first === "" || $last === "" || $email === "" || $number === "" || strlen($pass) < 8) {
        $error = "Invalid input. All fields are required.";
    } else {
        $stmt = mysqli_prepare(
            $conn,
            "UPDATE students
                SET first_name = ?, last_name = ?, email = ?, number = ?, pass = ?
              WHERE id = ?"
        );
        mysqli_stmt_bind_param($stmt, "sssssi", $first, $last, $email, $number, $pass, $id);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Student #$id updated successfully.";
        } else {
            $error = "Could not update student: " . mysqli_stmt_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}

// ---------- DELETE ----------
if ($action === "delete") {
    $id = (int)($_REQUEST["id"] ?? 0);
    if ($id > 0) {
        $stmt = mysqli_prepare($conn, "DELETE FROM students WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Student #$id deleted.";
        } else {
            $error = "Could not delete: " . mysqli_stmt_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}

// ---------- Load record for EDIT form ----------
if ($action === "edit") {
    $id = (int)($_REQUEST["id"] ?? 0);
    if ($id > 0) {
        $stmt = mysqli_prepare(
            $conn,
            "SELECT id, first_name, last_name, email, number, pass FROM students WHERE id = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $editing = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if (!$editing) {
            $error = "Record #$id not found.";
        }
    }
}

// ---------- READ — fetch all students for the table ----------
$result   = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students — CRUD Demo</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 24px;
            color: #222;
        }
        h1 { margin-top: 0; color: #0f4c81; }
        h2 { color: #1b7c3a; margin-bottom: 12px; }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            padding: 24px 28px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }
        .alert {
            padding: 10px 14px;
            border-radius: 4px;
            margin: 12px 0;
            font-size: 14px;
        }
        .alert.success { background: #e6f4ea; color: #1b5e20; border: 1px solid #a5d6a7; }
        .alert.error   { background: #fdecea; color: #b71c1c; border: 1px solid #f5b7b1; }

        form.crud {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            background: #fafbfc;
            padding: 16px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            margin-bottom: 24px;
        }
        form.crud label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #555;
            margin-bottom: 4px;
        }
        form.crud input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        form.crud .actions {
            grid-column: 1 / -1;
            display: flex;
            gap: 10px;
        }
        button, .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            background: #0f4c81;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        button:hover, .btn:hover { background: #0c3c66; }
        .btn.secondary { background: #777; }
        .btn.secondary:hover { background: #555; }
        .btn.danger { background: #c0392b; }
        .btn.danger:hover { background: #962d22; }
        .btn.small { padding: 4px 10px; font-size: 12px; }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            font-size: 14px;
        }
        thead { background: #0f4c81; color: #fff; }
        th, td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #e6e6e6;
        }
        tbody tr:hover { background: #f7f9fc; }
        td.actions { white-space: nowrap; }
        td.actions a { margin-right: 4px; }
        .empty { text-align: center; padding: 24px; color: #888; }
    </style>
</head>
<body>
<div class="container">

    <h1>Students &mdash; CRUD Demo</h1>

    <?php if ($message !== ""): ?>
        <div class="alert success"><?= h($message) ?></div>
    <?php endif; ?>
    <?php if ($error !== ""): ?>
        <div class="alert error"><?= h($error) ?></div>
    <?php endif; ?>

    <h2><?= $editing ? "Edit Student #" . h($editing["id"]) : "Add New Student" ?></h2>

    <form class="crud" method="post" action="crud.php">
        <input type="hidden" name="action"
               value="<?= $editing ? "update" : "create" ?>">
        <?php if ($editing): ?>
            <input type="hidden" name="id" value="<?= h($editing["id"]) ?>">
        <?php endif; ?>

        <div>
            <label>First name</label>
            <input type="text" name="first_name" required
                   value="<?= h($editing["first_name"] ?? "") ?>">
        </div>
        <div>
            <label>Last name</label>
            <input type="text" name="last_name" required
                   value="<?= h($editing["last_name"] ?? "") ?>">
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" required
                   value="<?= h($editing["email"] ?? "") ?>">
        </div>
        <div>
            <label>Contact Number</label>
            <input type="text" name="number" required
                   value="<?= h($editing["number"] ?? "") ?>">
        </div>
        
        <div>
        <label>Password</label>
            <input type="password" name="pass" required
           value="<?= h($editing["pass"] ?? "") ?>"> 
        </div>

        <div class="actions">
            <button type="submit">
                <?= $editing ? "Update Student" : "Add Student" ?>
            </button>
            <?php if ($editing): ?>
                <a href="crud.php" class="btn secondary">Cancel</a>
            <?php endif; ?>
        </div>
    </form>

    <h2>All Students (<?= count($students) ?>)</h2>

    <?php if (count($students) === 0): ?>
        <div class="empty">No students yet. Use the form above to add one.</div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($students as $row): ?>
                <tr>
                    <td><?= h($row["id"]) ?></td>
                    <td><?= h($row["first_name"]) ?></td>
                    <td><?= h($row["last_name"]) ?></td>
                    <td><?= h($row["email"]) ?></td>
                    <td><?= h($row["number"]) ?></td>
                    <td class="actions">
                        <a class="btn small"
                           href="crud.php?action=edit&id=<?= h($row["id"]) ?>">Edit</a>
                        <a class="btn small danger"
                           href="crud.php?action=delete&id=<?= h($row["id"]) ?>"
                           onclick="return confirm('Delete this student?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>

<?php mysqli_close($conn); ?>
</body>
</html>
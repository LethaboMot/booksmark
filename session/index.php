<?php
// Start session
session_start();

// Handle form submission
if(isset($_POST['submit'])) {
    // Validate and sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);

    // Validate URL
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        // Invalid URL, handle the error (not shown in this snippet)
    }

    // Initialize or update bookmarks session variable
    if(isset($_SESSION['bookmarks'])) {
        $_SESSION['bookmarks'][$name] = $url;
    } else {
        $_SESSION['bookmarks'] = array($name => $url);
    }
}

// Handle actions (clearing or deleting bookmarks)
if(isset($_GET['action'])) {
    if ($_GET['action'] === 'clear') {
        unset($_SESSION['bookmarks']);
    } elseif ($_GET['action'] === 'delete' && isset($_GET['name'])) {
        $nameToDelete = $_GET['name'];
        if (isset($_SESSION['bookmarks'][$nameToDelete])) {
            unset($_SESSION['bookmarks'][$nameToDelete]);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarker</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/cyborg/bootstrap.min.css">
    <style>
        /* Basic styling for the navbar */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }
        nav {
            background-color: #333;
            overflow: hidden;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        nav ul li {
            float: left;
        }
        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        nav ul li a:hover {
            background-color: #555;
        }
        /* Right-aligned content */
        .navbar-right {
            float: right;
        }
        .navbar-right a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<nav>
    <ul>
        <li><a href="#">Bookmarker</a></li>
        <li><a href="index.php">Home</a></li>
        <li class="navbar-right"><a href="index.php?action=clear">Clear All</a></li>
    </ul>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-7">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-group">
                    <label for="name">Website Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="url">Website URL</label>
                    <input type="text" class="form-control" name="url" id="url" required>
                </div>
                <input type="submit" value="Submit" name="submit" class="btn btn-default">
            </form>
        </div>
        <div class="col-md-5">
            <?php if (isset($_SESSION['bookmarks'])) : ?>
                <ul class="list-group">
                    <?php foreach($_SESSION['bookmarks'] as $name => $url) : ?>
                        <li class="list-group-item">
                            <a href="<?php echo htmlspecialchars($url); ?>" target="_blank"><?php echo htmlspecialchars($name); ?></a>
                            <a href="index.php?action=delete&name=<?php echo urlencode($name); ?>">[X]</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>

<?php
    //start session
    session_start();
    if(isset($_POST['name'])){
        if(isset($_SESSION['bookmarks'])){
            $_SESSION['bookmarks'][$_POST['name']] = $_POST['url'];
        } else {
            $_SESSION['bookmarks']= array($_POST['name'] => $_POST['url']);
    }
}
    ?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bookmarker</title>
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
        <li><a href="#">bookmarker</a></li>
        <li><a href="index.php">Home</a></li>

        <!-- Right-aligned content -->
        <div class="navbar-right">
            <a href="index.php?action=clear">Clear All</a>
        </div>
    </ul>
</nav>
<div class=" container">
    <div class="row">
        <div class="col-md-7">
            <form Method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="">website NAME</label>
                <input type="text" class="form-control" name="url">
                </div>
                <div class="form-group">
                    <label for="">website URL</label>
                <input type="text" class="form-control" name="url">
                </div>
                <input type="submit" value="submit" class="btn btn-default">
            </form>
        </div>
        <div class="col-md-5">
        <!-- loop -->
            <?php if (isset($_SESSION['bookmarks'])) : ?>
                <ul class="list-group">
                    <?php foreach($_SESSION['bookmarks'] as $name => $url) :  ?>
                        <li class="list-group-item"><a href="<?php echo $url; ?>"</li>
                    <?php endforeach; ?>
                </ul>
        </div>
    </div>
</body>
</html>

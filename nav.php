<head>

    <style>
        .nav-ul {
            list-style: none;
            display: flex;
            justify-content: space-evenly;
        }

        button.logout {
            background: white;
            color: #007bff;
            border: none;
            padding: 0.5em 1em;
            border-radius: 0.25em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .uname {
            font-weight: bold;
            color: #555;
        }
        
    </style>
    <link rel="stylesheet" href="./css/home.css">
</head>

<nav class="admin-nav">
    <ul class="nav-ul">
        <li><a href="<?php echo $_SERVER['PHP_REFERER'] ?>">Home</a></li>
        <?php
            session_start();
            if (isset($_SESSION['username'])) {
        ?>
        <li class='uname'>
            <?php
                echo $_SESSION['username'];
            ?>
        </li>
        <?php
            }
        ?>
        <li>
            <form action="logout.php" class="logout">
                <button type="submit" class="logout">Logout</button>
            </form>
        </li>
    </ul>
</nav>

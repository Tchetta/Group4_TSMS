

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/css.css">
    <link rel="stylesheet" href="./css/home.css">
    <title>Employee Home - TSMS</title>
</head>
<body>
    <header class="admin-header">
        <div class="ini">
            <div class="logo">
                <img src="favicon.ico.png" alt="TSMS logo">
                <h2>Employee Home</h2>
            </div>
            <div class="ini-row">
                <ul>
                    <li><a href="./index.php" style="color: white;">Home Page</a></li>
                    <li><a href="./about.html" style="color: white;">About</a></li>
                    <li><a href="./contact.php" style="color: white;">Contact Us</a></li>
                    
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
                        <form action="logout.php">
                            <button type="submit" class="logout">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="admin-container">
        <aside class="sidebar">
            <div class="container-home">
                <a href="#" class="btn-add" data-page="./includes/view_employee.php">View Employees</a>
            </div>
            <div class="container-home">
                <a href="#" class="btn-add" data-page="create_subscriber.php">Add Subscriber</a>
            </div>
            <div class="container-home">
                <a href="#" class="btn-add" data-page="./includes/view_subscriber.php">View Subscribers</a>
            </div>
            <div class="container-home">
                <a href="#" class="btn-add" data-page="./includes/view_services.php">View Services</a>
            </div>
            <div class="container-home">
                <a href="#" class="btn-add" data-page="billing.php">View Billing</a>
            </div>
            <div class="container-home">
                <a href="#" class="btn-add" data-page="generate_report.php">Generate Report</a>
            </div>
        </aside>
        <main class="main-content">
            <!-- Content will be loaded dynamically here -->
            <h2>TELECOM SUBSCRIBER MANAGEMENT SYSTEM</h2>
            <?php include_once "./intro.php"; ?>
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarLinks = document.querySelectorAll(".sidebar .btn-add");

            // Add click event listener to each menu item
            sidebarLinks.forEach(link => {
                link.addEventListener("click", function(event) {
                    event.preventDefault();

                    // Remove 'active' class from all menu items
                    sidebarLinks.forEach(item => item.classList.remove("active"));

                    // Add 'active' class to the clicked menu item
                    this.classList.add("active");

                    // Load content dynamically into the main section
                    const page = this.getAttribute("data-page");
                    loadPage(page);
                });
            });

            // Function to load content dynamically into the main section
            function loadPage(page) {
                const mainContent = document.querySelector(".main-content");
                
                // Use AJAX to fetch content from the specified page
                fetch(page)
                    .then(response => response.text())
                    .then(data => {
                        mainContent.innerHTML = data;
                    })
                    .catch(error => console.error("Error loading page:", error));
            }
        });
    </script>
</body>
</html>

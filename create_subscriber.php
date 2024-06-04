
<body>
    <h1>Create Subscriber</h1>
    <div class="container-in">  
        <main>
            <?php
            //session_start();
            if (isset($_SESSION['message'])) {
                $messageType = $_SESSION['message_type'] == 'error' ? 'error-msg' : 'success-msg';
                echo "<p class='$messageType'>{$_SESSION['message']}</p>";
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>
            <form action="./includes/create_subscriber.inc.php" method="post">
                <div class="form-group">
                    <label for="phone-number">Phone Number</label>
                    <input type="text" id="phone-number" name="phone_number" maxlength="15" required>
                </div>
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first_name" maxlength="30" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last_name" maxlength="30" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" placeholder="YYYY-MM-DD" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" maxlength="100" required>
                </div>
                <div class="form-group">
                    <label for="status">Status (optional)</label>
                    <input type="text" id="status" name="status" maxlength="20">
                </div>
                <div class="form-group">
                    <label for="time-status">Time Status (optional)</label>
                    <input type="text" id="time-status" name="time_status" maxlength="20">
                </div>
                <button type="submit" class="btn">Add</button>
            </form>
        </main>
    </div>
</body>
</html>

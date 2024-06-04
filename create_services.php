<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service - Admin Panel</title>
    <link rel="shortcut icon" href="favicon.ico.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/css.css">
    <style>
        .form-group textarea {
    padding: .8em;
    width: calc(100% - 20px);
    border: 1px solid #ccc;
    border-radius: 5px;
}
    </style>
</head>
<body>
    <main>
        <h1>Add Service</h1>
        <div class="container-in">
        <form action="./includes/create_services.inc.php" method="POST">
            <div class="form-group">
                <label for="service_name">Service Name:</label>
                <input type="text" id="service_name" name="service_name" required>
            </div>
            <div class="form-group">
                <label for="service_description">Service Description:</label><br>
                <textarea id="service_description" name="service_description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="daily_cost">Daily Cost:</label>
                <input type="number" id="daily_cost" name="daily_cost" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn">Add Service</button>
        </form>
        </div>
    </main>
</body>
</html>

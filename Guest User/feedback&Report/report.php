<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System report</title>
    <link rel="stylesheet" href="report-style.css">
</head>
<body>
    <div class="container">
        <h1>Report From</h1>
        <div class="main">
            <label for="name">Name (optional):</label>
            <input type="text" name="name" id="name" placeholder="Enter the your name">

            <label for="email" id="label">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter the your email">

            <label for="issue" id="label">Share Screenshot:</label>
            <input type="file" name="issue" id="issue">

            <label for="descrition">Facing issue:<label>
            <textarea name="des" id="message" placeholder="Describe your Problem..."></textarea>

            <button type="submit">Submit Report</button>
        </div>
    </div>
    
</body>
</html>
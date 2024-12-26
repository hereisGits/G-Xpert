<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form - Gxpert</title>
    <link rel="stylesheet" href="feedback-styles.css">
</head>
<body>
    <div class="container">
        <h1>Feedback Form</h1>
        <form class="form">
            <label for="name">Name (optional):</label>
            <input type="text" id="name" name="name" placeholder="Enter your name">

            <label for="email" id="label">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" >

            <label for="rating" id="label">Rating:</label>
            <select id="rating" name="rating">
                <option value=" " style="color: rgb(185, 185, 185);">Give rating:</option>
                <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                <option value="4">⭐⭐⭐⭐ - Good</option>
                <option value="3">⭐⭐⭐ - Average</option>
                <option value="2">⭐⭐ - Poor</option>
                <option value="1">⭐ - Very Poor</option>
            </select>

            <label for="message" id="label">Your Feedback:</label>
            <textarea id="message" name="message" placeholder="Share your thoughts..."></textarea>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Body Styling */
        body {
            background: #f4f7fc;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Profile Section Styling */
        .profile-section {
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            width: 100%;
            max-width: 600px;
            padding: 30px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .token-info {
            border-radius: 10px;
            border: 1px solid #555;
            padding: 20px;
            font-size: 16px;
            margin-bottom: 30px;
            text-align: left;
        }

        .token-info p {
            margin: 10px 0;
            font-weight: 500;
        }

        .token-info span {
            color: #4caf50;
            font-weight: bold;
        }

        /* Button Styles */
        .token-actions button {
            background-color: #4caf50;
            color: white;
            font-size: 16px;
            padding: 12px 20px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .token-actions button:hover {
            background-color: #45a049;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .profile-section {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            .token-info {
                font-size: 14px;
            }

            .token-actions button {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-section">
        <h2>Your Token Wallet</h2>

        <div class="token-info">
            <p><strong>Total Tokens:</strong> <span id="total-tokens"></span></p>
            <p><strong>Used Tokens:</strong> <span id="used-tokens"></span></p>
            <p><strong>Tokens Available:</strong> <span id="tokens-available"></span></p>
        </div>

        <div class="token-actions">
            <button id="buy-course-btn">Buy Course with Tokens</button>
        </div>

    <script src="profile.js"></script>
</body>
</html>

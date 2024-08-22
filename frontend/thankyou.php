<?php
// Start the session to access any session variables if needed
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Order Confirmed</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 3rem;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
        }
        h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .btn {
            background: linear-gradient(45deg, #00b4db, #0083b0);
            color: #fff;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        .circle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 8s infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body>
    <div class="animation">
        <?php
        // Generate random floating circles
        for ($i = 0; $i < 20; $i++) {
            $size = rand(10, 100);
            $left = rand(0, 100);
            $top = rand(0, 100);
            $delay = rand(0, 8);
            echo "<div class='circle' style='width: {$size}px; height: {$size}px; left: {$left}%; top: {$top}%; animation-delay: {$delay}s;'></div>";
        }
        ?>
    </div>
    <div class="container">
        <h1>Thank You!</h1>
        <p>Your order has been successfully placed. Get ready for a culinary adventure!</p>
        <a href="index.php" class="btn">Return Home</a>
    </div>

    <script>
        // Add a simple animation when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.querySelector('.container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(20px)';
            setTimeout(() => {
                container.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>
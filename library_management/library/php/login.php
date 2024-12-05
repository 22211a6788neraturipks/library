<?php
require_once("./connect/connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap');

        body {
            font-family: "PT Sans", sans-serif;
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            margin: 0;
            position: relative;
            padding-bottom: 60px;
        }

        #logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
        }

        #logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Styling for the form container */
        #form-container {
            background: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 15px;
            padding: 30px;
            width: 90%;
            max-width: 350px;
            height: 350px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        /* Adjustments for the logo image in the form */
        #form-container img {
            max-width: 25%;
            height: auto;
            margin-bottom: -10px;
        }

        #form {
            width: 100%;
        }

        #form h1 {
            margin-bottom: 20px;
            color: #333;
        }

        #form label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        #form input[type="text"],
        #form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
        }

        #btn {
            color: white;
            background-color: #28a745;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #btn:hover {
            background-color: #218838;
        }

        /* Styling for the footer */
        .footer {
            width: 100%;
            text-align: center;
            font-size: 14px;
            color: #555;
            padding: 5px 0;
            background: linear-gradient(135deg, #a3d5f1, #4fb99e);
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            bottom: 0;
            left: 0;
            animation: fadeInUp 2s ease-out;
        }


        /* Fade-in and slide-up animation */
        @keyframes fadeInUp {
            from {
                transform: translateY(100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Styling for the content inside the footer */
        .footer-content {
            max-width: 500px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .footer a:active {
            color: #0056b3;
        }

        /* Responsive design for smaller screens */
        @media (max-width: 600px) {
            #form-container {
                padding: 20px;
                height: auto;
            }

            #btn {
                font-size: 14px;
                padding: 8px 16px;
            }
        }

        /* Styling for error messages */
        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <!-- Logo positioned at the top left -->
    <div id="logo">
        <img src="./iare_logo.png" alt="IARE Logo">
    </div>

    <div id="form-container">
        <img src="./bookquestlogo.png" alt="BookQuest Logo">
        <h1>Login Form</h1>
        <form name="form" action="login1.php" onsubmit="return isValid()" method="POST" id="form">
            <label for="user">Username:</label>
            <input type="text" placeholder="abc@iare.ac.in" id="user" name="user" required><br>
            <label for="pass">Password:</label>
            <input type="password" placeholder="Password" id="pass" name="pass" required><br>
            <input type="submit" id="btn" value="Login" name="submit" />
        </form>
    </div>
    <div class="footer">
        <div class="footer-content">
            <p>© 2024 Institute of Aeronautical Engineering.</p>
            <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
            <p>Contact us at: <a href="mailto:info@iare.ac.in">info@iare.ac.in</a></p>
            <p>Follow us on:
                <a href="https://twitter.com/iare" target="_blank">Twitter</a> |
                <a href="https://www.facebook.com/iare" target="_blank">Facebook</a> |
                <a href="https://www.instagram.com/iare" target="_blank">Instagram</a>
            </p>
        </div>
    </div>

    <script>
        function isValid() {
            var user = document.form.user.value;
            var pass = document.form.pass.value;
            if (user.length == "" && pass.length == "") {
                alert("User name and password field is empty!!");
                return false;
            }
            else {
                if (user.length == "") {
                    alert("User name field is empty!!");
                    return false;
                }
                if (pass.length == "") {
                    alert("Password field is empty!!");
                    return false;
                }
            }
        }
    </script>
</body>

</html>
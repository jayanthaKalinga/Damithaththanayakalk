<?php
session_start();

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($action == 'login') {
        // Login logic
        // Here you should fetch the user from the database and verify the password
        $_SESSION['username'] = $username;
        $_SESSION['login_success'] = true;
        header('Location: index.php');
        exit();
    } elseif ($action == 'signup') {
        // Signup logic
        // Here you should save the user to the database
        header('Location: index.php');
        exit();
    } elseif ($action == 'logout') {
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($_SESSION['username']) ? 'Damithaththanayaka.lk' : 'Login or Sign Up'; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('login.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .card {
            background-color: rgba(68, 68, 68, 0.8);
        }

        .jumbotron {
            background-color: rgba(34, 34, 34, 0.8);
            padding: 2rem;
            border-radius: 0.5rem;
        }

        .btn {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            border: 6px solid black;
            width: 100%;
            max-width: 300px;
            margin: 10px auto;
        }

        button:hover {
            background-color: #e60000;
        }

        .d-none {
            display: none;
        }

        .animated-button {
            transition: transform 0.2s ease-in-out;
        }

        .animated-button:hover {
            transform: scale(1.1);
        }

        .navbar {
            transition: background-color 0.5s ease;
        }

        .navbar-nav {
            flex-direction: row;
        }

        .nav-link {
            padding-right: .5rem;
            padding-left: .5rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #e60000;
        }

        .nav-item {
            margin-right: 1rem;
        }

        @media (min-width: 576px) {
            .btn {
                max-width: 200px;
            }
        }

        @media (min-width: 768px) {
            .btn {
                max-width: 300px;
            }
        }

        .navbar-dark.scrolled {
            background-color: rgba(0, 0, 0, 0.9) !important;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Damithaththanayaka.lk</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Classes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <?php if (isset($_SESSION['username'])): ?>
                <li class="nav-item">
                    <form method="POST" action="">
                        <button type="submit" name="action" value="logout" class="btn btn-link nav-link">Logout</button>
                    </form>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container" style="margin-top: 70px;">
        <?php if (isset($_SESSION['username'])): ?>
            <div id="welcomeMessage" class="jumbotron mt-5 text-center bg-dark text-white">
                <h1 class="display-4">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
            </div>
            <?php
                if (isset($_SESSION['login_success'])) {
                    echo "<script>
                        alert('Congratulations! You have successfully logged in.');
                        document.getElementById('welcomeMessage').style.display = 'none';
                    </script>";
                    unset($_SESSION['login_success']);
                }
            ?>
        <?php else: ?>
            <div class="mt-3">
                <button id="showLogin" class="btn btn-danger animated-button">Login</button>
                <button id="showSignup" class="btn btn-danger animated-button">Sign Up</button>
            </div>
            <div id="loginForm" class="card mt-5 bg-dark text-white d-none">
                <div class="card-body">
                    <h2 class="card-title text-center">Login</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="login">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-danger btn-block">Login</button>
                    </form>
                </div>
            </div>
            <div id="signupForm" class="card mt-5 bg-dark text-white d-none">
                <div class="card-body">
                    <h2 class="card-title text-center">Sign Up</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="signup">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-danger btn-block">Sign Up</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('showLogin').addEventListener('click', function() {
            document.getElementById('loginForm').classList.remove('d-none');
            document.getElementById('signupForm').classList.add('d-none');
        });

        document.getElementById('showSignup').addEventListener('click', function() {
            document.getElementById('signupForm').classList.remove('d-none');
            document.getElementById('loginForm').classList.add('d-none');
        });

        // Change navbar style on scroll
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').classList.add('scrolled');
            } else {
                document.querySelector('.navbar').classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>

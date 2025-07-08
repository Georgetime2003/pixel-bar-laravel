<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("css/particles.css") }}">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/i18next@23.10.0/dist/umd/i18next.min.js") }}"></script>
    <script src="{{ asset("js/idioma.js") }}"></script>
    <script src="{{ asset("js/particles.js") }}"></script>
    <link rel="stylesheet" href="{{ asset("css/contact.css") }}">
    <link rel="stylesheet" href="{{ asset("css/menuPixel.css") }}">
</head>
<body>
    <div id="particles-js" style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:-1;"></div>
    
    <!-- NAVBAR FIXED -->
    <nav class="pixel-navbar">
        <div class="navbar-left">
            <a href="/"><img src="/img/logo.png" alt="Logo Pixel Bar" class="navbar-logo"></a>
        </div>
        <div class="navbar-center">
            <span class="navbar-title" data-i18n="contact_us">🍔 Contacta'ns 🎮</span>
        </div>
        <div class="navbar-right">
            <div class="dropdown">
                <button class="dropbtn"><img src="/img/flags/es.svg" alt="Lang" style="width:24px;vertical-align:middle;"> <span id="selected-lang">ES</span> ▼</button>
                <div class="dropdown-content">
                    <a href="#" data-lang="en"><img src="/img/flags/en.svg" alt="EN" style="width:20px;"> English</a>
                    <a href="#" data-lang="ca"><img src="/img/flags/ca.svg" alt="CA" style="width:20px;"> Català</a>
                    <a href="#" data-lang="es"><img src="/img/flags/es.svg" alt="ES" style="width:20px;"> Español</a>
                    <a href="#" data-lang="fr"><img src="/img/flags/fr.svg" alt="FR" style="width:20px;"> Français</a>
                    <a href="#" data-lang="ds"><img src="/img/flags/de.svg" alt="DE" style="width:20px;"> Deutsch</a>
                </div>
            </div>
        </div>
    </nav>
    <style>

    </style>
    <!-- FI NAVBAR -->

    <!-- Main contact container -->
    <div class="contact-container">
        <h1 class="contact-title" data-i18n="contact_us">Contact Us</h1>

        <!-- Contact Information -->
        <div class="contact-info">
            <h3 data-i18n="get_in_touch">Contacte'ns</h3>
            <p><strong data-i18n="email">Email:</strong> contact@pixelbarBlanes.com</p>
            <p><strong data-i18n="phone">Phone:</strong> 872416760(WhatsApp)</p>
            <p><strong data-i18n="address">Address:</strong> <span data-i18n="full_address"></span></p>
            <p><strong data-i18n="hours">Hours:</strong> <span data-i18n="business_hours">Dimarts a Diumenge des de 18H</span></p>
            <p><strong data-i18n="instagram">Instagram</strong> <a href="https://www.instagram.com/pixelbar.blanes/" target="_blank" class="contact-link">Pixelbar.blanes</a></p>
        </div>

        <?php
        $message = '';
        $messageType = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $subject = trim($_POST['subject'] ?? '');
            $messageContent = trim($_POST['message'] ?? '');

            // Basic validation
            if (empty($name) || empty($email) || empty($subject) || empty($messageContent)) {
                $message = 'Please fill in all fields.';
                $messageType = 'error';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = 'Please enter a valid email address.';
                $messageType = 'error';
            } else {
                // Here you would typically save to database or send email
                // For now, we'll just show a success message
                $message = 'Thank you for your message! We will get back to you soon.';
                $messageType = 'success';
                
                // Optional: Log the contact submission
                $logData = [
                    'date' => date('Y-m-d H:i:s'),
                    'name' => $name,
                    'email' => $email,
                    'subject' => $subject,
                    'message' => $messageContent
                ];
                
                // You could save this to a file or database
                // file_put_contents('../../Database/contact_log.txt', json_encode($logData) . "\n", FILE_APPEND);
            }
        }
        ?>

        <?php if ($message): ?>
            <div class="<?php echo $messageType; ?>-message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- Contact Form -->
        <form class="contact-form" method="POST" action="">
            <div class="form-group">
                <label class="form-label" for="name" data-i18n="name">Name *</label>
                <input type="text" id="name" name="name" class="form-input" required 
                       value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>

            <div class="form-group">
                <label class="form-label" for="email" data-i18n="email">Email *</label>
                <input type="email" id="email" name="email" class="form-input" required 
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <div class="form-group">
                <label class="form-label" for="subject" data-i18n="subject">Subject *</label>
                <input type="text" id="subject" name="subject" class="form-input" required 
                       value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
            </div>

            <div class="form-group">
                <label class="form-label" for="message" data-i18n="message">Message *</label>
                <textarea id="message" name="message" class="form-textarea" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
            </div>

            <button type="submit" class="submit-btn" data-i18n="send_message">Send Message</button>
        </form>
    </div>

    <script>
        // Initialize particles
        particlesJS.load('particles-js', '{{ asset("json/particles.json") }}', function() {
            console.log('callback - particles.js config loaded');
        });

        // Handle dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.querySelector('.dropdown');
            const dropbtn = document.querySelector('.dropbtn');
            const dropdownContent = document.querySelector('.dropdown-content');

            dropbtn.addEventListener('click', function() {
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
            });

            // Close dropdown when clicking outside
            window.addEventListener('click', function(event) {
                if (!dropdown.contains(event.target)) {
                    dropdownContent.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
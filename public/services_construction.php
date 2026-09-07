<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Construction Services | TRIV Design and Construction</title>
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="../assets/images/favicon.png">
    <link rel="stylesheet" href="../assets/css/public-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<header>

<div class="return-services-container">
    <a href="../public/services.php" class="return-services-button">
        <i class="fas fa-arrow-left"></i> Return to Services
    </a>
</div>

    
    <div class="logo">
        <img src="../assets/images/trivfinalnatalaga.png" alt="TRIV Design & Construction">
    </div>
    <button class="menu-toggle" aria-label="Toggle menu">☰</button>
    <nav>
        <ul>
            <li><a href="../public/index.php">HOME</a></li>
            <li><a href="../public/services.php">SERVICES</a></li>
            <li><a href="../public/developers.php">ABOUT US</a></li>
            <li><a href="../public/contact.php">CONTACT US</a></li>
            <li><a href="../public/career.php">CAREERS</a></li>
            <li><a href="../public/projects.php">PROJECTS</a></li>
        </ul>
    </nav>
</header>

    <main class="service-detail-main">
        <!-- Banner Section -->
        <section class="service-banner construction-banner">
            <div class="service-banner-overlay"></div>
            <img src="../assets/images/services_construction.jpg" alt="Construction Banner" class="hero-bg">
            <div class="service-banner-content">
                <h1>Construction</h1>
                <p>From foundation to finishing, we build durable structures that last for generations.</p>
            </div>
        </section>

        <!-- Description Section -->
        <section class="service-description">
            <div class="service-description-container">
                <h2>Construction Solutions</h2>
                <div class="service-description-content">
                    <div class="service-description-text">
                        <p>From foundation to finishing, we build durable structures that last for generations. Our construction services deliver exceptional quality and craftsmanship for both residential and commercial projects.</p>
                    </div>
                    <div class="service-description-image">
                        <img src="../assets/images/services_construction.jpg" alt="Construction project by TRIV">
                    </div>
                </div>
            </div>
        </section>

        <!-- Process Section -->
        <section class="service-process">
            <div class="service-process-container">
                <h2>Our Construction Process</h2>
                <div class="process-steps">
                    <div class="process-step">
                        <div class="process-step-number">1</div>
                        <div class="process-step-content">
                            <h3>Planning &amp; Design</h3>
                            <p>We begin with thorough planning and design, working closely with architects and engineers to create detailed blueprints and construction schedules.</p>
                        </div>
                    </div>
                    <div class="process-step">
                        <div class="process-step-number">2</div>
                        <div class="process-step-content">
                            <h3>Permits &amp; Approvals</h3>
                            <p>Our team handles all necessary permits and regulatory approvals, ensuring your project complies with local building codes and regulations.</p>
                        </div>
                    </div>
                    <div class="process-step">
                        <div class="process-step-number">3</div>
                        <div class="process-step-content">
                            <h3>Site Preparation</h3>
                            <p>We prepare the construction site with proper excavation, foundation work, and utility installations to create a solid base for your structure.</p>
                        </div>
                    </div>
                    <div class="process-step">
                        <div class="process-step-number">4</div>
                        <div class="process-step-content">
                            <h3>Construction</h3>
                            <p>Our skilled construction team executes the building process with precision, following the approved plans while maintaining quality and safety standards.</p>
                        </div>
                    </div>
                    <div class="process-step">
                        <div class="process-step-number">5</div>
                        <div class="process-step-content">
                            <h3>Finishing &amp; Handover</h3>
                            <p>We complete all finishing touches, conduct thorough quality inspections, and hand over your completed project with full documentation and support.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="service-cta">
            <div class="service-cta-container">
                <h2>Ready to Build Your Dream Project?</h2>
                <p>Contact us today to discuss your construction needs and get a detailed quote.</p>
                <a href="../public/contact.php" class="cta-button">Request a Quote</a>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const menuToggle = document.querySelector('.menu-toggle');
            const nav = document.querySelector('nav');
            
            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    nav.classList.toggle('active');
                });
            }
            
            // Close menu when clicking on a link
            const navLinks = document.querySelectorAll('nav ul li a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    nav.classList.remove('active');
                });
            });
        });
    </script>
</body>
</html>
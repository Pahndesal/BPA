<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGISTIC 2 </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="index-styles.css" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <div class="sidebar-toggle">
            <i class="bi bi-list"></i>
        </div>
        <h1 style="font-family: 'Great Vibes', cursive !important; font-size: 1.5rem; font-weight: 350; letter-spacing: 2px; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
            RAEVOR</h1>
    </header>
    


   <!-- Side Navigation -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Clothing And Fashionwear E-commerce</h3>
        </div>
        <ul class="sidebar-nav">
            

            <!-- Logistic 2 -->
            <li class="sidebar-item has-submenu">
                <a href="#">
                    <i class="bi bi-truck"></i>
                    <span class="menu-text">Logistic 2</span>
                    <i class="bi bi-chevron-down submenu-icon"></i>
                </a>
                <ul class="submenu">
                    <li><a href="vendor_portal.php"><span class="menu-text">Vendor Portal</span></a></li>
                    <li><a href="audit.php"><span class="menu-text">Audit Management</span></a></li>
                    <li><a href="vehicle.php"><span class="menu-text">Vehicle Reservation </span></a></li>
                    <li><a href="fleet.php"><span class="menu-text">Fleet Management</span></a></li>
                    <li><a href="document.php"><span class="menu-text">Document Tracking System</span></a></li>
                </ul>
            </li>

            
        </ul>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            <p>Please select a management module from the sidebar menu.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar collapse
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');
        });
        
        // Toggle submenu visibility
        const menuItems = document.querySelectorAll('.sidebar-item.has-submenu');
        
        menuItems.forEach(item => {
            item.querySelector('a').addEventListener('click', function(e) {
                e.preventDefault();
                
                // Add data-title attribute for tooltip when collapsed
                if (!this.hasAttribute('data-title')) {
                    const menuText = this.querySelector('.menu-text').textContent;
                    this.setAttribute('data-title', menuText);
                }
                
                // If sidebar is collapsed, don't toggle the active class
                if (!document.body.classList.contains('sidebar-collapsed')) {
                    item.classList.toggle('active');
                    
                    // Close other open menus
                    menuItems.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('active')) {
                            otherItem.classList.remove('active');
                        }
                    });
                }
            });
        });
        
        // Add hover functionality for collapsed state
        if (window.innerWidth > 768) {
            menuItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    if (document.body.classList.contains('sidebar-collapsed')) {
                        const menuText = this.querySelector('.menu-text').textContent;
                        this.querySelector('a').setAttribute('data-title', menuText);
                    }
                });
            });
        }
        
        // Intercept submenu link clicks and render blank content box
        const submenuLinks = document.querySelectorAll('.submenu li a');
        const mainContentContainer = document.querySelector('.main-content .container-fluid');
        
        submenuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Mark active submenu link
                submenuLinks.forEach(other => other.classList.remove('active'));
                this.classList.add('active');
                
                const titleText = this.querySelector('.menu-text') ? this.querySelector('.menu-text').textContent.trim() : this.textContent.trim();
                
                // Render blank rounded box with title placeholder
                if (mainContentContainer) {
                    mainContentContainer.innerHTML = `
                        <div class="content-box">
                            <div class="content-title">${titleText}</div>
                            <div class="content-body"></div>
                        </div>
                    `;
                }
            });
        });
    </script>
</body>
</html>
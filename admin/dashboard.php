<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <div class="logo">
                <h2>Admin Panel</h2>
            </div>
            <ul class="nav-links">
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="projects.php"><i class="fas fa-project-diagram"></i> Projects</a></li>
                <li><a href="skills.php"><i class="fas fa-tools"></i> Skills</a></li>
                <li><a href="experience.php"><i class="fas fa-briefcase"></i> Experience</a></li>
                <li><a href="messages.php"><i class="fas fa-envelope"></i> Messages</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
        
        <main class="main-content">
            <header>
                <h1>Welcome to Dashboard</h1>
                <div class="user-info">
                    <span>Admin</span>
                </div>
            </header>
            
            <div class="dashboard-stats">
                <div class="stat-card">
                    <h3>Total Projects</h3>
                    <p>12</p>
                </div>
                <div class="stat-card">
                    <h3>Skills</h3>
                    <p>24</p>
                </div>
                <div class="stat-card">
                    <h3>Messages</h3>
                    <p>5</p>
                </div>
                <div class="stat-card">
                    <h3>Views Today</h3>
                    <p>156</p>
                </div>
            </div>
            
            <div class="recent-activity">
                <h2>Recent Activity</h2>
                <div class="activity-list">
                    <div class="activity-item">
                        <p>New project added: E-commerce Website</p>
                        <span>2 hours ago</span>
                    </div>
                    <div class="activity-item">
                        <p>Updated skill: React.js</p>
                        <span>5 hours ago</span>
                    </div>
                    <div class="activity-item">
                        <p>New message received</p>
                        <span>1 day ago</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://kit.fontawesome.com/your-kit-code.js"></script>
    <script src="../js/admin.js"></script>
</body>
</html>
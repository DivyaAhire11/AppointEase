<?php
include "../config/db.php";
include "../config/auth_check.php"; // Require authentication

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Get user details
$user_query = "SELECT * FROM users WHERE id = $1";
$user_result = pg_query_params($conn, $user_query, array($user_id));
$user = pg_fetch_assoc($user_result);

// Get upcoming appointments
$appointments_query = "SELECT * FROM appointments WHERE user_id = $1 AND status != 'cancelled' ORDER BY appointment_date, appointment_time";
$appointments_result = pg_query_params($conn, $appointments_query, array($user_id));

// Count statistics
$upcoming_count = 0;
$completed_count = 0;

$stats_query = "SELECT COUNT(*) as total, status FROM appointments WHERE user_id = $1 GROUP BY status";
$stats_result = pg_query_params($conn, $stats_query, array($user_id));

$stats = array();
while ($row = pg_fetch_assoc($stats_result)) {
    $stats[$row['status']] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AppointEase</title>
    <link rel="stylesheet" href="../Style/base/navbar.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .dashboard-header {
            margin-bottom: 40px;
        }

        .dashboard-header h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 5px;
        }

        .dashboard-header p {
            color: #666;
            font-size: 16px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
        }

        .section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .section h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }

        .appointment-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .appointment-card:hover {
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
            border-color: #667eea;
        }

        .appointment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .appointment-doctor {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .appointment-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-confirmed {
            background: #d4edda;
            color: #155724;
        }

        .status-completed {
            background: #d1ecf1;
            color: #0c5460;
        }

        .appointment-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin: 10px 0;
            font-size: 14px;
            color: #666;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .appointment-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            border-top: 1px solid #e0e0e0;
            padding-top: 15px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            display: inline-block;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
        }

        .btn-secondary {
            background: #e0e0e0;
            color: #333;
        }

        .btn-secondary:hover {
            background: #d0d0d0;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .empty-state p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .profile-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            font-size: 14px;
        }

        .profile-item {
            display: flex;
            flex-direction: column;
        }

        .profile-label {
            color: #999;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .profile-value {
            color: #333;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 20px 15px;
            }

            .dashboard-header h1 {
                font-size: 24px;
            }

            .appointment-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .section {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <?php include "../Includes/navbar.php"; ?>

    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <h1>Welcome, <?php echo htmlspecialchars($user_name); ?>! 👋</h1>
            <p>Manage your appointments and profile</p>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📋</div>
                <div class="stat-number"><?php echo isset($stats['pending']) ? $stats['pending'] : 0; ?></div>
                <div class="stat-label">Pending Appointments</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-number"><?php echo isset($stats['confirmed']) ? $stats['confirmed'] : 0; ?></div>
                <div class="stat-label">Confirmed Appointments</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🎉</div>
                <div class="stat-number"><?php echo isset($stats['completed']) ? $stats['completed'] : 0; ?></div>
                <div class="stat-label">Completed Appointments</div>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="section">
            <h2>Profile Information</h2>
            <div class="profile-section">
                <div class="profile-item">
                    <span class="profile-label">Email</span>
                    <span class="profile-value"><?php echo htmlspecialchars($user['email']); ?></span>
                </div>
                <div class="profile-item">
                    <span class="profile-label">Phone</span>
                    <span class="profile-value"><?php echo $user['phone'] ?? 'Not provided'; ?></span>
                </div>
                <div class="profile-item">
                    <span class="profile-label">Date of Birth</span>
                    <span class="profile-value"><?php echo $user['date_of_birth'] ?? 'Not provided'; ?></span>
                </div>
                <div class="profile-item">
                    <span class="profile-label">City</span>
                    <span class="profile-value"><?php echo $user['city'] ?? 'Not provided'; ?></span>
                </div>
            </div>
        </div>

        <!-- Appointments Section -->
        <div class="section">
            <h2>Your Appointments</h2>

            <?php if (pg_num_rows($appointments_result) > 0): ?>
                <?php while ($appointment = pg_fetch_assoc($appointments_result)): ?>
                    <div class="appointment-card">
                        <div class="appointment-header">
                            <div class="appointment-doctor">
                                👨‍⚕️ Dr. <?php echo htmlspecialchars($appointment['doctor_id'] ?? 'Doctor'); ?>
                            </div>
                            <div class="appointment-status status-<?php echo strtolower($appointment['status']); ?>">
                                <?php echo ucfirst($appointment['status']); ?>
                            </div>
                        </div>

                        <div class="appointment-details">
                            <div class="detail-item">
                                📅 <?php echo date('M d, Y', strtotime($appointment['appointment_date'])); ?>
                            </div>
                            <div class="detail-item">
                                ⏰ <?php echo date('h:i A', strtotime($appointment['appointment_time'])); ?>
                            </div>
                            <div class="detail-item">
                                📝 <?php echo htmlspecialchars($appointment['reason'] ?? 'General Checkup'); ?>
                            </div>
                        </div>

                        <div class="appointment-actions">
                            <a href="?view=<?php echo $appointment['id']; ?>" class="btn btn-primary">View Details</a>
                            <?php if ($appointment['status'] !== 'completed'): ?>
                                <a href="../Pages/cancle_appointments.php?id=<?php echo $appointment['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this appointment?');">Cancel</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <p>No appointments yet</p>
                    <a href="../Pages/bookAppoint.php" class="btn btn-primary">Book Your First Appointment</a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Quick Actions -->
        <div class="section">
            <h2>Quick Actions</h2>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <a href="../Pages/bookAppoint.php" class="btn btn-primary">📅 Book New Appointment</a>
                <a href="../Pages/Doctors/doctors.php" class="btn btn-secondary">👨‍⚕️ View All Doctors</a>
                <a href="../Pages/Services/services.php" class="btn btn-secondary">🏥 View Services</a>
            </div>
        </div>
    </div>
</body>
</html>

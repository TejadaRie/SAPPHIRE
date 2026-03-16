<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Database connection
$host = 'localhost';
$dbname = 'Sapphireweb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// ONLY INSERT DEFAULT DATA IF TABLES ARE EMPTY
// Check if tables are empty before inserting defaults

// Check site_stats table
$statsCount = $pdo->query("SELECT COUNT(*) FROM site_stats")->fetchColumn();
if ($statsCount == 0) {
    $defaultStats = [
        ['years', '21', 'Years Experience'],
        ['models', '25', 'Tire Models'],
        ['riders', '1000K', 'Happy Riders']
    ];

    $stmt = $pdo->prepare("INSERT INTO site_stats (stat_key, stat_value, stat_label) VALUES (?, ?, ?)");
    foreach ($defaultStats as $stat) {
        $stmt->execute($stat);
    }
}

// Check site_content table
$contentCount = $pdo->query("SELECT COUNT(*) FROM site_content")->fetchColumn();
if ($contentCount == 0) {
    $defaultContent = [
        ['overview_eyebrow', 'Who We Are'],
        ['overview_title', 'COMPANY OVERVIEW'],
        ['overview_tagline', 'Kasama mo sa Hanapbuhay &mdash; Philippine Made'],
        ['quality_title', 'Quality<br>First'],
        ['quality_stat', '15+ Years of Excellence'],
        ['quality_heading', 'Our Commitment'],
        ['quality_text', 'Sapphire Tire is committed to delivering high-quality, durable, and reliable tires designed for everyday riders and professionals. Our dedication to quality has made us a trusted name in the motorcycle tire industry.'],
        ['rider_title', 'Rider<br>Focused'],
        ['rider_stat', '1,000K+ Satisfied Riders'],
        ['rider_heading', 'Our Philosophy'],
        ['rider_text', 'We understand the needs of Filipino riders. From daily commuters to adventure enthusiasts, our tires are designed to deliver performance, safety, and confidence on every journey.'],
        ['collab_eyebrow', 'Our Partners'],
        ['collab_title', 'COLLABORATORS'],
        ['collab_tagline', 'Kasama mo sa Hanapbuhay — Trusted Partners'],
        ['bst_eyebrow', 'Top Picks'],
        ['bst_title', 'BEST SELLING TIRES'],
        ['bst_tagline', 'Most trusted by Filipino riders'],
        ['stories_eyebrow', 'Rider Stories'],
        ['stories_title', 'BIDA & KWENTO'],
        ['stories_subtitle', 'Discover the inspiring journeys of riders who trust Sapphire Tire for their adventures.'],
        ['hero_video', 'assets/images/BKasambuhay-Video.mp4']
    ];

    $stmt = $pdo->prepare("INSERT INTO site_content (section, content) VALUES (?, ?)");
    foreach ($defaultContent as $content) {
        $stmt->execute($content);
    }
}

// Check collaborators table
$collabCount = $pdo->query("SELECT COUNT(*) FROM collaborators")->fetchColumn();
if ($collabCount == 0) {
    $defaultCollaborators = [
        ['Lodi Lia', 'Rider & Influencer', 'assets/images/collaborators/Lodi-Lia.jpg', 1],
        ['Zurc Moto', 'Motorcycle Enthusiast', 'assets/images/collaborators/Zurc-Moto.jpg', 2],
        ['Sunshine Effy', 'Adventure Rider', 'assets/images/collaborators/Sunshine-Effy.jpg', 3],
        ['Don Nelson', 'Motovlogger', 'assets/images/collaborators/Don-Nelson.jpg', 4],
        ['Elmer Pakingan', 'Professional Rider', 'assets/images/collaborators/Elmer-Pakingan.jpg', 5],
        ['AZIZAH', 'Motorcycle Club Member', 'assets/images/collaborators/AZIZAH.jpg', 6],
        ['Ayee Lakwatsera', 'Travel Rider', 'assets/images/collaborators/Ayee-Lakwatsera.jpg', 7],
        ['TMX125 Angel', 'Custom Bike Builder', 'assets/images/collaborators/TMX125-ANGEL.jpg', 8],
        ['TMX155 Pampang', 'Racing Enthusiast', 'assets/images/collaborators/TMX155-PAMPANG.jpg', 9]
    ];

    $stmt = $pdo->prepare("INSERT INTO collaborators (name, title, image, display_order) VALUES (?, ?, ?, ?)");
    foreach ($defaultCollaborators as $collab) {
        $stmt->execute($collab);
    }
}

// Check tires table
$tiresCount = $pdo->query("SELECT COUNT(*) FROM tires")->fetchColumn();
if ($tiresCount == 0) {
    $defaultTires = [
        ['HI-MILLER E716', 'Motocross', 'Engineered for the toughest off-road conditions, the HI-MILLER E716 features an aggressive knob pattern that delivers superior mud traction and stability on loose terrain. Ideal for motocross riders who demand peak performance.', 'assets/images/E716 edited.png', json_encode(['2.50-17', '2.75-17', '3.00-17', '2.50-18', '2.75-18', '3.00-18']), 1],
        ['SPORTS E708', 'On/Off-Road · Dual', 'The versatile SPORTS E708 transitions seamlessly between tarmac and trail. A dual-purpose tread pattern ensures confident handling on paved roads while retaining off-road capability for weekend adventures.', 'assets/images/E708 edited.png', json_encode(['2.50-17', '2.75-17', '3.00-17', '2.75-18', '3.00-18', '3.25-18']), 2],
        ['STRENGTH E707', 'On-Road · High Speed', 'Designed for the fast lane, the STRENGTH E707 offers a smooth center rib for straight-line stability and optimized shoulder blocks for confident cornering. Perfect for daily commuters and highway cruisers.', 'assets/images/E707 png.png', json_encode(['2.50-17', '2.75-17', '3.00-17', '3.50-17', '2.75-18', '3.00-18', '3.50-18']), 3],
        ['EXTREME PERFORMANCE E701', 'Heavy Duty Tricycle', 'Built to handle the demands of commercial tricycle operations, the E701 features a reinforced carcass for heavy load capacity and a wide tread for maximum contact patch and durability under constant use.', 'assets/images/E701 edited.png', json_encode(['4.00-8', '4.50-10', '5.00-10', '6.00-12', '3.50-8']), 4]
    ];

    $stmt = $pdo->prepare("INSERT INTO tires (name, tag, description, image, sizes, display_order) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($defaultTires as $tire) {
        $stmt->execute($tire);
    }
}

// Check rider_stories table
$storiesCount = $pdo->query("SELECT COUNT(*) FROM rider_stories")->fetchColumn();
if ($storiesCount == 0) {
    $defaultStories = [
        ['BIDA KASAMBUHAY', 'Featured rider stories using Sapphire Tire products.', 'assets/images/bida.jpg', 'events.php#blog', 1],
        ['KWENTONG KASAMBUHAY', 'Inspirational journeys of riders powered by Sapphire Tire.', 'assets/images/kwento.jpg', 'events.php#blog', 2]
    ];

    $stmt = $pdo->prepare("INSERT INTO rider_stories (title, description, image, link, display_order) VALUES (?, ?, ?, ?, ?)");
    foreach ($defaultStories as $story) {
        $stmt->execute($story);
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Handle form submissions
$message = '';
$messageType = '';

// Save text content
if (isset($_POST['save_content'])) {
    $section = $_POST['section'];
    $content = $_POST['content'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO site_content (section, content) VALUES (?, ?) ON DUPLICATE KEY UPDATE content = VALUES(content)");
        $stmt->execute([$section, $content]);
        $message = "Content saved successfully!";
        $messageType = "success";
    } catch(PDOException $e) {
        $message = "Error saving content: " . $e->getMessage();
        $messageType = "error";
    }
}

// Save stats
if (isset($_POST['save_stats'])) {
    $years = $_POST['stat_years'];
    $models = $_POST['stat_models'];
    $riders = $_POST['stat_riders'];
    $years_label = $_POST['stat_years_label'];
    $models_label = $_POST['stat_models_label'];
    $riders_label = $_POST['stat_riders_label'];
    
    try {
        $stmt = $pdo->prepare("UPDATE site_stats SET stat_value = ?, stat_label = ? WHERE stat_key = 'years'");
        $stmt->execute([$years, $years_label]);
        
        $stmt = $pdo->prepare("UPDATE site_stats SET stat_value = ?, stat_label = ? WHERE stat_key = 'models'");
        $stmt->execute([$models, $models_label]);
        
        $stmt = $pdo->prepare("UPDATE site_stats SET stat_value = ?, stat_label = ? WHERE stat_key = 'riders'");
        $stmt->execute([$riders, $riders_label]);
        
        $message = "Statistics updated successfully!";
        $messageType = "success";
    } catch(PDOException $e) {
        $message = "Error updating stats: " . $e->getMessage();
        $messageType = "error";
    }
}

// Update video path
if (isset($_POST['update_video'])) {
    $video_path = $_POST['video_path'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO site_content (section, content) VALUES ('hero_video', ?) ON DUPLICATE KEY UPDATE content = VALUES(content)");
        $stmt->execute([$video_path]);
        $message = "Video path updated successfully!";
        $messageType = "success";
    } catch(PDOException $e) {
        $message = "Error updating video path: " . $e->getMessage();
        $messageType = "error";
    }
}

// Save all content sections at once
if (isset($_POST['save_all_content'])) {
    $contentFields = $_POST['content'];
    $success = true;
    
    foreach ($contentFields as $section => $content) {
        try {
            $stmt = $pdo->prepare("INSERT INTO site_content (section, content) VALUES (?, ?) ON DUPLICATE KEY UPDATE content = VALUES(content)");
            $stmt->execute([$section, $content]);
        } catch(PDOException $e) {
            $success = false;
            $message = "Error saving content: " . $e->getMessage();
            $messageType = "error";
            break;
        }
    }
    
    if ($success) {
        $message = "All content saved successfully!";
        $messageType = "success";
    }
}

// Add/Update/Delete collaborators
if (isset($_POST['add_collaborator'])) {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $image = $_POST['image'];
    $display_order = $_POST['display_order'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO collaborators (name, title, image, display_order) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $title, $image, $display_order]);
        $message = "Collaborator added successfully!";
        $messageType = "success";
    } catch(PDOException $e) {
        $message = "Error adding collaborator: " . $e->getMessage();
        $messageType = "error";
    }
}

if (isset($_POST['update_collaborator'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $title = $_POST['title'];
    $image = $_POST['image'];
    $display_order = $_POST['display_order'];
    $active = isset($_POST['active']) ? 1 : 0;
    
    try {
        $stmt = $pdo->prepare("UPDATE collaborators SET name = ?, title = ?, image = ?, display_order = ?, active = ? WHERE id = ?");
        $stmt->execute([$name, $title, $image, $display_order, $active, $id]);
        $message = "Collaborator updated successfully!";
        $messageType = "success";
    } catch(PDOException $e) {
        $message = "Error updating collaborator: " . $e->getMessage();
        $messageType = "error";
    }
}

if (isset($_GET['delete_collaborator'])) {
    $id = $_GET['delete_collaborator'];
    try {
        $stmt = $pdo->prepare("DELETE FROM collaborators WHERE id = ?");
        $stmt->execute([$id]);
        $message = "Collaborator deleted successfully!";
        $messageType = "success";
    } catch(PDOException $e) {
        $message = "Error deleting collaborator: " . $e->getMessage();
        $messageType = "error";
    }
}

// Add/Update/Delete tires
if (isset($_POST['add_tire'])) {
    $name = $_POST['name'];
    $tag = $_POST['tag'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $sizes = $_POST['sizes'];
    $display_order = $_POST['display_order'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO tires (name, tag, description, image, sizes, display_order) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $tag, $description, $image, $sizes, $display_order]);
        $message = "Tire added successfully!";
        $messageType = "success";
    } catch(PDOException $e) {
        $message = "Error adding tire: " . $e->getMessage();
        $messageType = "error";
    }
}

if (isset($_POST['update_tire'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $tag = $_POST['tag'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $sizes = $_POST['sizes'];
    $display_order = $_POST['display_order'];
    $active = isset($_POST['active']) ? 1 : 0;
    
    try {
        $stmt = $pdo->prepare("UPDATE tires SET name = ?, tag = ?, description = ?, image = ?, sizes = ?, display_order = ?, active = ? WHERE id = ?");
        $stmt->execute([$name, $tag, $description, $image, $sizes, $display_order, $active, $id]);
        $message = "Tire updated successfully!";
        $messageType = "success";
    } catch(PDOException $e) {
        $message = "Error updating tire: " . $e->getMessage();
        $messageType = "error";
    }
}

if (isset($_GET['delete_tire'])) {
    $id = $_GET['delete_tire'];
    try {
        $stmt = $pdo->prepare("DELETE FROM tires WHERE id = ?");
        $stmt->execute([$id]);
        $message = "Tire deleted successfully!";
        $messageType = "success";
    } catch(PDOException $e) {
        $message = "Error deleting tire: " . $e->getMessage();
        $messageType = "error";
    }
}

// Add/Update/Delete rider stories
if (isset($_POST['add_story'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $link = $_POST['link'];
    $display_order = $_POST['display_order'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO rider_stories (title, description, image, link, display_order) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description, $image, $link, $display_order]);
        $message = "Rider story added successfully!";
        $messageType = "success";
    } catch(PDOException $e) {
        $message = "Error adding rider story: " . $e->getMessage();
        $messageType = "error";
    }
}

if (isset($_POST['update_story'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $link = $_POST['link'];
    $display_order = $_POST['display_order'];
    $active = isset($_POST['active']) ? 1 : 0;
    
    try {
        $stmt = $pdo->prepare("UPDATE rider_stories SET title = ?, description = ?, image = ?, link = ?, display_order = ?, active = ? WHERE id = ?");
        $stmt->execute([$title, $description, $image, $link, $display_order, $active, $id]);
        $message = "Rider story updated successfully!";
        $messageType = "success";
    } catch(PDOException $e) {
        $message = "Error updating rider story: " . $e->getMessage();
        $messageType = "error";
    }
}

if (isset($_GET['delete_story'])) {
    $id = $_GET['delete_story'];
    try {
        $stmt = $pdo->prepare("DELETE FROM rider_stories WHERE id = ?");
        $stmt->execute([$id]);
        $message = "Rider story deleted successfully!";
        $messageType = "success";
    } catch(PDOException $e) {
        $message = "Error deleting rider story: " . $e->getMessage();
        $messageType = "error";
    }
}

// Get all data for display
$contentSections = $pdo->query("SELECT * FROM site_content ORDER BY section")->fetchAll(PDO::FETCH_ASSOC);
$contentBySection = [];
foreach ($contentSections as $section) {
    $contentBySection[$section['section']] = $section['content'];
}

$collaborators = $pdo->query("SELECT * FROM collaborators ORDER BY display_order")->fetchAll(PDO::FETCH_ASSOC);
$tires = $pdo->query("SELECT * FROM tires ORDER BY display_order")->fetchAll(PDO::FETCH_ASSOC);
$stories = $pdo->query("SELECT * FROM rider_stories ORDER BY display_order")->fetchAll(PDO::FETCH_ASSOC);
$stats = $pdo->query("SELECT * FROM site_stats")->fetchAll(PDO::FETCH_ASSOC);

$statsByKey = [];
foreach ($stats as $stat) {
    $statsByKey[$stat['stat_key']] = $stat;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Sapphireweb CMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background: #f0f2f5;
        }
        
        .navbar {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar h1 {
            font-size: 1.5rem;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .navbar h1 i {
            font-size: 2rem;
        }
        
        .nav-links {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            background: rgba(255,255,255,0.2);
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .nav-links a:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }
        
        .container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .welcome-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .welcome-card h2 {
            font-family: 'Montserrat', sans-serif;
            color: #333;
        }
        
        .user-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .message {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .message.success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .stat-card h3 {
            font-size: 2rem;
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 5px;
        }
        
        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            background: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .tab-btn {
            padding: 12px 24px;
            background: transparent;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            color: #555;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .tab-btn:hover {
            background: #f0f2f5;
            color: #1e3c72;
        }
        
        .tab-btn.active {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
        }
        
        .tab-pane {
            display: none;
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .tab-pane.active {
            display: block;
            animation: fadeIn 0.4s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .section-header h2 {
            font-family: 'Montserrat', sans-serif;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30, 60, 114, 0.4);
        }
        
        .btn-success {
            background: #28a745;
            color: white;
        }
        
        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
        }
        
        .btn-warning {
            background: #ffc107;
            color: #333;
        }
        
        .btn-warning:hover {
            background: #e0a800;
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        
        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
        }
        
        .btn-sm {
            padding: 5px 10px;
            font-size: 0.85rem;
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            padding: 1.2rem;
            border: 1px solid #e9ecef;
            position: relative;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #1e3c72;
        }
        
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
            transition: transform 0.3s;
        }
        
        .card:hover img {
            transform: scale(1.02);
        }
        
        .card h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 8px;
            color: #333;
        }
        
        .card .badge {
            display: inline-block;
            padding: 4px 10px;
            background: #1e3c72;
            color: white;
            border-radius: 20px;
            font-size: 0.75rem;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .card .meta {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-actions {
            display: flex;
            gap: 8px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            overflow-y: auto;
            backdrop-filter: blur(5px);
        }
        
        .modal-content {
            background: white;
            max-width: 700px;
            margin: 50px auto;
            padding: 2rem;
            border-radius: 20px;
            position: relative;
            animation: modalSlideIn 0.3s ease;
        }
        
        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 28px;
            cursor: pointer;
            color: #666;
            transition: color 0.3s;
        }
        
        .close:hover {
            color: #333;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s;
        }
        
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #1e3c72;
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.1);
        }
        
        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
        }
        
        .checkbox-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        
        .preview-image {
            max-width: 150px;
            max-height: 150px;
            margin-top: 10px;
            border-radius: 8px;
            border: 2px solid #e9ecef;
        }
        
        .quick-edit-form {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        
        .quick-edit-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
        }
        
        .info-text {
            background: #e7f3ff;
            padding: 1rem;
            border-radius: 8px;
            color: #004085;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .image-upload-hint {
            font-size: 0.85rem;
            color: #666;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .search-box {
            margin-bottom: 20px;
        }
        
        .search-box input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-links {
                justify-content: center;
            }
            
            .form-row {
                flex-direction: column;
                gap: 10px;
            }
            
            .quick-edit-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<nav class="navbar">
    <h1><i class="fas fa-cog"></i> Sapphireweb CMS Admin</h1>
    <div class="nav-links">
        <a href="adminindex.php"><i class="fas fa-pen"></i> Index</a>
        <a href="adminproduct.php"><i class="fas fa-chart-bar"></i> Products</a>
        <a href="adminevent.php"><i class="fas fa-video"></i> Events</a>
        <a href="adminabout.php"><i class="fas fa-users"></i> About</a>
        <a href="adminkitakm.php"><i class="fas fa-circle"></i> KitaKM</a>
        <a href="?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</nav>
    
    <div class="container">
        <div class="welcome-card">
            <div>
                <h2><i class="fas fa-user-circle" style="margin-right: 10px;"></i> Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
                <p style="color: #666; margin-top: 10px;">Manage your website content from this dashboard. All changes are saved to the database.</p>
            </div>
            <div class="user-badge">
                <i class="fas fa-shield-alt"></i>
                <span>Administrator</span>
            </div>
        </div>
        
        <?php if ($message): ?>
            <div class="message <?php echo $messageType; ?>">
                <i class="fas <?php echo $messageType === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i>
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <!-- Stats Overview -->
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <h3><?php echo count($collaborators); ?></h3>
                <p>Total Collaborators</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-circle"></i>
                <h3><?php echo count($tires); ?></h3>
                <p>Tire Models</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-book-open"></i>
                <h3><?php echo count($stories); ?></h3>
                <p>Rider Stories</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-file-alt"></i>
                <h3><?php echo count($contentSections); ?></h3>
                <p>Content Sections</p>
            </div>
        </div>
        
        <!-- Tabs Navigation -->
        <div class="tabs">
            <button class="tab-btn active" onclick="showTab('quick-edit')">
                <i class="fas fa-pen"></i> Quick Edit
            </button>
            <button class="tab-btn" onclick="showTab('stats')">
                <i class="fas fa-chart-bar"></i> Statistics
            </button>
            <button class="tab-btn" onclick="showTab('video')">
                <i class="fas fa-video"></i> Video Settings
            </button>
            <button class="tab-btn" onclick="showTab('collaborators')">
                <i class="fas fa-users"></i> Collaborators
            </button>
            <button class="tab-btn" onclick="showTab('tires')">
                <i class="fas fa-circle"></i> Tires
            </button>
            <button class="tab-btn" onclick="showTab('stories')">
                <i class="fas fa-book-open"></i> Rider Stories
            </button>
        </div>
        
        <!-- Quick Edit Tab (All Content in One Place) -->
        <div id="quick-edit-tab" class="tab-pane active">
            <div class="section-header">
                <h2><i class="fas fa-pen"></i> Quick Content Editor</h2>
            </div>
            
            <div class="info-text">
                <i class="fas fa-info-circle"></i>
                Edit all text content in one place. Changes will be reflected immediately on your website.
            </div>
            
            <form method="POST" class="quick-edit-form">
                <div class="quick-edit-grid">
                    <!-- Overview Section -->
                    <div class="form-group">
                        <label><i class="fas fa-eye"></i> Overview Eyebrow</label>
                        <input type="text" name="content[overview_eyebrow]" value="<?php echo htmlspecialchars($contentBySection['overview_eyebrow'] ?? 'Who We Are'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-heading"></i> Overview Title</label>
                        <input type="text" name="content[overview_title]" value="<?php echo htmlspecialchars($contentBySection['overview_title'] ?? 'COMPANY OVERVIEW'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-tag"></i> Overview Tagline</label>
                        <input type="text" name="content[overview_tagline]" value="<?php echo htmlspecialchars($contentBySection['overview_tagline'] ?? 'Kasama mo sa Hanapbuhay &mdash; Philippine Made'); ?>">
                    </div>
                    
                    <!-- Quality Section -->
                    <div class="form-group">
                        <label><i class="fas fa-star"></i> Quality Title</label>
                        <input type="text" name="content[quality_title]" value="<?php echo htmlspecialchars($contentBySection['quality_title'] ?? 'Quality<br>First'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-chart-line"></i> Quality Stat</label>
                        <input type="text" name="content[quality_stat]" value="<?php echo htmlspecialchars($contentBySection['quality_stat'] ?? '15+ Years of Excellence'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-heading"></i> Quality Heading</label>
                        <input type="text" name="content[quality_heading]" value="<?php echo htmlspecialchars($contentBySection['quality_heading'] ?? 'Our Commitment'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-align-left"></i> Quality Text</label>
                        <textarea name="content[quality_text]"><?php echo htmlspecialchars($contentBySection['quality_text'] ?? 'Sapphire Tire is committed to delivering high-quality, durable, and reliable tires designed for everyday riders and professionals.'); ?></textarea>
                    </div>
                    
                    <!-- Rider Section -->
                    <div class="form-group">
                        <label><i class="fas fa-motorcycle"></i> Rider Title</label>
                        <input type="text" name="content[rider_title]" value="<?php echo htmlspecialchars($contentBySection['rider_title'] ?? 'Rider<br>Focused'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-users"></i> Rider Stat</label>
                        <input type="text" name="content[rider_stat]" value="<?php echo htmlspecialchars($contentBySection['rider_stat'] ?? '1,000K+ Satisfied Riders'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-heading"></i> Rider Heading</label>
                        <input type="text" name="content[rider_heading]" value="<?php echo htmlspecialchars($contentBySection['rider_heading'] ?? 'Our Philosophy'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-align-left"></i> Rider Text</label>
                        <textarea name="content[rider_text]"><?php echo htmlspecialchars($contentBySection['rider_text'] ?? 'We understand the needs of Filipino riders. From daily commuters to adventure enthusiasts, our tires are designed to deliver performance, safety, and confidence on every journey.'); ?></textarea>
                    </div>
                    
                    <!-- Collaborators Section -->
                    <div class="form-group">
                        <label><i class="fas fa-handshake"></i> Collaborators Eyebrow</label>
                        <input type="text" name="content[collab_eyebrow]" value="<?php echo htmlspecialchars($contentBySection['collab_eyebrow'] ?? 'Our Partners'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-heading"></i> Collaborators Title</label>
                        <input type="text" name="content[collab_title]" value="<?php echo htmlspecialchars($contentBySection['collab_title'] ?? 'COLLABORATORS'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-tag"></i> Collaborators Tagline</label>
                        <input type="text" name="content[collab_tagline]" value="<?php echo htmlspecialchars($contentBySection['collab_tagline'] ?? 'Kasama mo sa Hanapbuhay — Trusted Partners'); ?>">
                    </div>
                    
                    <!-- Best Selling Tires Section -->
                    <div class="form-group">
                        <label><i class="fas fa-star"></i> BST Eyebrow</label>
                        <input type="text" name="content[bst_eyebrow]" value="<?php echo htmlspecialchars($contentBySection['bst_eyebrow'] ?? 'Top Picks'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-heading"></i> BST Title</label>
                        <input type="text" name="content[bst_title]" value="<?php echo htmlspecialchars($contentBySection['bst_title'] ?? 'BEST SELLING TIRES'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-tag"></i> BST Tagline</label>
                        <input type="text" name="content[bst_tagline]" value="<?php echo htmlspecialchars($contentBySection['bst_tagline'] ?? 'Most trusted by Filipino riders'); ?>">
                    </div>
                    
                    <!-- Rider Stories Section -->
                    <div class="form-group">
                        <label><i class="fas fa-book"></i> Stories Eyebrow</label>
                        <input type="text" name="content[stories_eyebrow]" value="<?php echo htmlspecialchars($contentBySection['stories_eyebrow'] ?? 'Rider Stories'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-heading"></i> Stories Title</label>
                        <input type="text" name="content[stories_title]" value="<?php echo htmlspecialchars($contentBySection['stories_title'] ?? 'BIDA & KWENTO'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-align-left"></i> Stories Subtitle</label>
                        <textarea name="content[stories_subtitle]"><?php echo htmlspecialchars($contentBySection['stories_subtitle'] ?? 'Discover the inspiring journeys of riders who trust Sapphire Tire for their adventures.'); ?></textarea>
                    </div>
                </div>
                
                <button type="submit" name="save_all_content" class="btn btn-primary" style="margin-top: 20px;">
                    <i class="fas fa-save"></i> Save All Content Changes
                </button>
            </form>
            
            <!-- Individual Content Sections List -->
            <h3 style="margin: 40px 0 20px;">Individual Content Sections</h3>
            <div class="grid">
                <?php foreach ($contentSections as $section): ?>
                <div class="card">
                    <h3><i class="fas fa-file-alt" style="color: #1e3c72; margin-right: 8px;"></i> <?php echo htmlspecialchars($section['section']); ?></h3>
                    <div class="meta">
                        <i class="far fa-clock"></i> Last updated: <?php echo date('M d, Y H:i', strtotime($section['updated_at'])); ?>
                    </div>
                    <p><?php echo substr(htmlspecialchars($section['content']), 0, 150) . '...'; ?></p>
                    <div class="card-actions">
                        <button class="btn btn-sm btn-warning" onclick="editContent('<?php echo $section['section']; ?>', '<?php echo htmlspecialchars(addslashes($section['content'])); ?>')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Statistics Tab -->
        <div id="stats-tab" class="tab-pane">
            <div class="section-header">
                <h2><i class="fas fa-chart-bar"></i> Statistics Management</h2>
            </div>
            
            <form method="POST" style="max-width: 800px;">
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-calendar"></i> Years Experience (Number)</label>
                        <input type="text" id="stat_years" name="stat_years" value="<?php echo isset($statsByKey['years']) ? htmlspecialchars($statsByKey['years']['stat_value']) : '21'; ?>" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-tag"></i> Years Experience Label</label>
                        <input type="text" id="stat_years_label" name="stat_years_label" value="<?php echo isset($statsByKey['years']) ? htmlspecialchars($statsByKey['years']['stat_label']) : 'Years Experience'; ?>" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-circle"></i> Tire Models (Number)</label>
                        <input type="text" id="stat_models" name="stat_models" value="<?php echo isset($statsByKey['models']) ? htmlspecialchars($statsByKey['models']['stat_value']) : '25'; ?>" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-tag"></i> Tire Models Label</label>
                        <input type="text" id="stat_models_label" name="stat_models_label" value="<?php echo isset($statsByKey['models']) ? htmlspecialchars($statsByKey['models']['stat_label']) : 'Tire Models'; ?>" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-users"></i> Happy Riders (Number)</label>
                        <input type="text" id="stat_riders" name="stat_riders" value="<?php echo isset($statsByKey['riders']) ? htmlspecialchars($statsByKey['riders']['stat_value']) : '1000K'; ?>" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-tag"></i> Happy Riders Label</label>
                        <input type="text" id="stat_riders_label" name="stat_riders_label" value="<?php echo isset($statsByKey['riders']) ? htmlspecialchars($statsByKey['riders']['stat_label']) : 'Happy Riders'; ?>" required>
                    </div>
                </div>
                
                <button type="submit" name="save_stats" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Statistics
                </button>
            </form>
        </div>
        
        <!-- Video Settings Tab -->
        <div id="video-tab" class="tab-pane">
            <div class="section-header">
                <h2><i class="fas fa-video"></i> Video Settings</h2>
            </div>
            
            <form method="POST" style="max-width: 600px;">
                <div class="form-group">
                    <label for="video_path">Hero Video Path</label>
                    <input type="text" id="video_path" name="video_path" value="<?php echo htmlspecialchars($contentBySection['hero_video'] ?? 'assets/images/BKasambuhay-Video.mp4'); ?>" required>
                    <div class="image-upload-hint">
                        <i class="fas fa-info-circle"></i>
                        Path to your video file (relative to website root). Recommended: MP4 format, H.264 codec.
                    </div>
                </div>
                
                <button type="submit" name="update_video" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Video Path
                </button>
            </form>
        </div>
        
        <!-- Collaborators Tab -->
        <div id="collaborators-tab" class="tab-pane">
            <div class="section-header">
                <h2><i class="fas fa-users"></i> Collaborators Management</h2>
                <button class="btn btn-primary" onclick="openCollaboratorModal('new')">
                    <i class="fas fa-plus"></i> Add Collaborator
                </button>
            </div>
            
            <div class="search-box">
                <input type="text" id="collaboratorSearch" placeholder="Search collaborators..." onkeyup="searchCards('collaboratorSearch', 'collaboratorCard')">
            </div>
            
            <div class="grid" id="collaboratorGrid">
                <?php foreach ($collaborators as $collaborator): ?>
                <div class="card collaboratorCard" data-name="<?php echo strtolower($collaborator['name']); ?>">
                    <?php if ($collaborator['image']): ?>
                        <img src="<?php echo htmlspecialchars($collaborator['image']); ?>" alt="<?php echo htmlspecialchars($collaborator['name']); ?>">
                    <?php endif; ?>
                    <span class="badge">Order: <?php echo $collaborator['display_order']; ?></span>
                    <h3><?php echo htmlspecialchars($collaborator['name']); ?></h3>
                    <p><i class="fas fa-tag" style="color: #666;"></i> <?php echo htmlspecialchars($collaborator['title']); ?></p>
                    <?php if (!$collaborator['active']): ?>
                        <p class="badge" style="background: #dc3545;"><i class="fas fa-eye-slash"></i> Inactive</p>
                    <?php else: ?>
                        <p class="badge" style="background: #28a745;"><i class="fas fa-eye"></i> Active</p>
                    <?php endif; ?>
                    <div class="card-actions">
                        <button class="btn btn-sm btn-warning" onclick="editCollaborator(<?php echo $collaborator['id']; ?>, '<?php echo htmlspecialchars(addslashes($collaborator['name'])); ?>', '<?php echo htmlspecialchars(addslashes($collaborator['title'])); ?>', '<?php echo htmlspecialchars(addslashes($collaborator['image'])); ?>', <?php echo $collaborator['display_order']; ?>, <?php echo $collaborator['active']; ?>)">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <a href="?delete_collaborator=<?php echo $collaborator['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this collaborator?')">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Tires Tab -->
        <div id="tires-tab" class="tab-pane">
            <div class="section-header">
                <h2><i class="fas fa-circle"></i> Tire Models Management</h2>
                <button class="btn btn-primary" onclick="openTireModal('new')">
                    <i class="fas fa-plus"></i> Add Tire
                </button>
            </div>
            
            <div class="search-box">
                <input type="text" id="tireSearch" placeholder="Search tires..." onkeyup="searchCards('tireSearch', 'tireCard')">
            </div>
            
            <div class="grid" id="tireGrid">
                <?php foreach ($tires as $tire): ?>
                <div class="card tireCard" data-name="<?php echo strtolower($tire['name']); ?>">
                    <?php if ($tire['image']): ?>
                        <img src="<?php echo htmlspecialchars($tire['image']); ?>" alt="<?php echo htmlspecialchars($tire['name']); ?>">
                    <?php endif; ?>
                    <span class="badge"><?php echo htmlspecialchars($tire['tag']); ?></span>
                    <h3><?php echo htmlspecialchars($tire['name']); ?></h3>
                    <p><i class="fas fa-align-left" style="color: #666;"></i> <?php echo substr(htmlspecialchars($tire['description']), 0, 100) . '...'; ?></p>
                    <p><small><i class="fas fa-ruler"></i> Sizes: <?php 
                        $sizes = json_decode($tire['sizes'], true);
                        if (is_array($sizes)) {
                            echo implode(', ', array_slice($sizes, 0, 3)) . (count($sizes) > 3 ? '...' : '');
                        }
                    ?></small></p>
                    <p class="badge" style="background: #17a2b8;">Order: <?php echo $tire['display_order']; ?></p>
                    <?php if (!$tire['active']): ?>
                        <p class="badge" style="background: #dc3545;"><i class="fas fa-eye-slash"></i> Inactive</p>
                    <?php else: ?>
                        <p class="badge" style="background: #28a745;"><i class="fas fa-eye"></i> Active</p>
                    <?php endif; ?>
                    <div class="card-actions">
                        <button class="btn btn-sm btn-warning" onclick="editTire(<?php echo $tire['id']; ?>, '<?php echo htmlspecialchars(addslashes($tire['name'])); ?>', '<?php echo htmlspecialchars(addslashes($tire['tag'])); ?>', '<?php echo htmlspecialchars(addslashes($tire['description'])); ?>', '<?php echo htmlspecialchars(addslashes($tire['image'])); ?>', '<?php echo htmlspecialchars(addslashes($tire['sizes'])); ?>', <?php echo $tire['display_order']; ?>, <?php echo $tire['active']; ?>)">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <a href="?delete_tire=<?php echo $tire['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tire?')">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Rider Stories Tab -->
        <div id="stories-tab" class="tab-pane">
            <div class="section-header">
                <h2><i class="fas fa-book-open"></i> Rider Stories Management</h2>
                <button class="btn btn-primary" onclick="openStoryModal('new')">
                    <i class="fas fa-plus"></i> Add Story
                </button>
            </div>
            
            <div class="search-box">
                <input type="text" id="storySearch" placeholder="Search stories..." onkeyup="searchCards('storySearch', 'storyCard')">
            </div>
            
            <div class="grid" id="storyGrid">
                <?php foreach ($stories as $story): ?>
                <div class="card storyCard" data-name="<?php echo strtolower($story['title']); ?>">
                    <?php if ($story['image']): ?>
                        <img src="<?php echo htmlspecialchars($story['image']); ?>" alt="<?php echo htmlspecialchars($story['title']); ?>">
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($story['title']); ?></h3>
                    <p><i class="fas fa-align-left" style="color: #666;"></i> <?php echo substr(htmlspecialchars($story['description']), 0, 100) . '...'; ?></p>
                    <p><i class="fas fa-link"></i> <a href="<?php echo htmlspecialchars($story['link']); ?>" target="_blank">View Link</a></p>
                    <p class="badge" style="background: #17a2b8;">Order: <?php echo $story['display_order']; ?></p>
                    <?php if (!$story['active']): ?>
                        <p class="badge" style="background: #dc3545;"><i class="fas fa-eye-slash"></i> Inactive</p>
                    <?php else: ?>
                        <p class="badge" style="background: #28a745;"><i class="fas fa-eye"></i> Active</p>
                    <?php endif; ?>
                    <div class="card-actions">
                        <button class="btn btn-sm btn-warning" onclick="editStory(<?php echo $story['id']; ?>, '<?php echo htmlspecialchars(addslashes($story['title'])); ?>', '<?php echo htmlspecialchars(addslashes($story['description'])); ?>', '<?php echo htmlspecialchars(addslashes($story['image'])); ?>', '<?php echo htmlspecialchars(addslashes($story['link'])); ?>', <?php echo $story['display_order']; ?>, <?php echo $story['active']; ?>)">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <a href="?delete_story=<?php echo $story['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this story?')">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <!-- Content Modal -->
    <div id="contentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('contentModal')">&times;</span>
            <h2 id="contentModalTitle"><i class="fas fa-edit"></i> Edit Content</h2>
            <form method="POST">
                <input type="hidden" name="section" id="contentSection">
                <div class="form-group">
                    <label for="contentSectionName">Section Name</label>
                    <input type="text" id="contentSectionName" name="section" readonly class="form-control-plaintext" style="background: #f8f9fa;">
                </div>
                <div class="form-group">
                    <label for="contentText">Content</label>
                    <textarea id="contentText" name="content" required></textarea>
                </div>
                <button type="submit" name="save_content" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Content
                </button>
            </form>
        </div>
    </div>
    
    <!-- Collaborator Modal -->
    <div id="collaboratorModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('collaboratorModal')">&times;</span>
            <h2 id="collaboratorModalTitle"><i class="fas fa-user-plus"></i> Add Collaborator</h2>
            <form method="POST">
                <input type="hidden" name="id" id="collaboratorId">
                <div class="form-group">
                    <label for="collaboratorName">Name</label>
                    <input type="text" id="collaboratorName" name="name" required>
                </div>
                <div class="form-group">
                    <label for="collaboratorTitle">Title/Role</label>
                    <input type="text" id="collaboratorTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="collaboratorImage">Image Path</label>
                    <input type="text" id="collaboratorImage" name="image" placeholder="assets/images/collaborators/name.jpg" oninput="previewImage(this, 'collaboratorPreview')">
                    <img class="preview-image" id="collaboratorPreview" src="" alt="Preview" style="display:none;">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="collaboratorOrder">Display Order</label>
                        <input type="number" id="collaboratorOrder" name="display_order" value="0">
                    </div>
                    <div class="form-group checkbox-group">
                        <label>
                            <input type="checkbox" name="active" id="collaboratorActive" checked> Active
                        </label>
                    </div>
                </div>
                <button type="submit" name="add_collaborator" id="collaboratorSubmitBtn" class="btn btn-primary">
                    <i class="fas fa-save"></i> Add Collaborator
                </button>
                <button type="submit" name="update_collaborator" id="collaboratorUpdateBtn" class="btn btn-primary" style="display:none;">
                    <i class="fas fa-save"></i> Update Collaborator
                </button>
            </form>
        </div>
    </div>
    
    <!-- Tire Modal -->
    <div id="tireModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('tireModal')">&times;</span>
            <h2 id="tireModalTitle"><i class="fas fa-circle"></i> Add Tire</h2>
            <form method="POST">
                <input type="hidden" name="id" id="tireId">
                <div class="form-group">
                    <label for="tireName">Tire Name</label>
                    <input type="text" id="tireName" name="name" required>
                </div>
                <div class="form-group">
                    <label for="tireTag">Tag/Category</label>
                    <input type="text" id="tireTag" name="tag" required>
                </div>
                <div class="form-group">
                    <label for="tireDescription">Description</label>
                    <textarea id="tireDescription" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="tireImage">Image Path</label>
                    <input type="text" id="tireImage" name="image" placeholder="assets/images/tire-name.jpg" oninput="previewImage(this, 'tirePreview')">
                    <img class="preview-image" id="tirePreview" src="" alt="Preview" style="display:none;">
                </div>
                <div class="form-group">
                    <label for="tireSizes">Available Sizes (JSON array)</label>
                    <textarea id="tireSizes" name="sizes" placeholder='["2.50-17", "2.75-17", "3.00-17"]' required></textarea>
                    <div class="image-upload-hint">
                        <i class="fas fa-info-circle"></i>
                        Enter as JSON array of strings. Example: ["2.50-17", "2.75-17", "3.00-17"]
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="tireOrder">Display Order</label>
                        <input type="number" id="tireOrder" name="display_order" value="0">
                    </div>
                    <div class="form-group checkbox-group">
                        <label>
                            <input type="checkbox" name="active" id="tireActive" checked> Active
                        </label>
                    </div>
                </div>
                <button type="submit" name="add_tire" id="tireSubmitBtn" class="btn btn-primary">
                    <i class="fas fa-save"></i> Add Tire
                </button>
                <button type="submit" name="update_tire" id="tireUpdateBtn" class="btn btn-primary" style="display:none;">
                    <i class="fas fa-save"></i> Update Tire
                </button>
            </form>
        </div>
    </div>
    
    <!-- Story Modal -->
    <div id="storyModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('storyModal')">&times;</span>
            <h2 id="storyModalTitle"><i class="fas fa-book"></i> Add Rider Story</h2>
            <form method="POST">
                <input type="hidden" name="id" id="storyId">
                <div class="form-group">
                    <label for="storyTitle">Title</label>
                    <input type="text" id="storyTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="storyDescription">Description</label>
                    <textarea id="storyDescription" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="storyImage">Image Path</label>
                    <input type="text" id="storyImage" name="image" placeholder="assets/images/story-name.jpg" oninput="previewImage(this, 'storyPreview')">
                    <img class="preview-image" id="storyPreview" src="" alt="Preview" style="display:none;">
                </div>
                <div class="form-group">
                    <label for="storyLink">Link</label>
                    <input type="text" id="storyLink" name="link" placeholder="events.php#blog">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="storyOrder">Display Order</label>
                        <input type="number" id="storyOrder" name="display_order" value="0">
                    </div>
                    <div class="form-group checkbox-group">
                        <label>
                            <input type="checkbox" name="active" id="storyActive" checked> Active
                        </label>
                    </div>
                </div>
                <button type="submit" name="add_story" id="storySubmitBtn" class="btn btn-primary">
                    <i class="fas fa-save"></i> Add Story
                </button>
                <button type="submit" name="update_story" id="storyUpdateBtn" class="btn btn-primary" style="display:none;">
                    <i class="fas fa-save"></i> Update Story
                </button>
            </form>
        </div>
    </div>
    
    <script>
        // Tab switching
        function showTab(tabName) {
            const tabs = document.querySelectorAll('.tab-pane');
            const buttons = document.querySelectorAll('.tab-btn');
            
            tabs.forEach(tab => tab.classList.remove('active'));
            buttons.forEach(btn => btn.classList.remove('active'));
            
            document.getElementById(tabName + '-tab').classList.add('active');
            
            // Find and activate the clicked button
            buttons.forEach(btn => {
                if (btn.textContent.toLowerCase().includes(tabName.replace('-', ' '))) {
                    btn.classList.add('active');
                }
            });
            
            // Save active tab to localStorage
            localStorage.setItem('activeTab', tabName);
        }
        
        // Restore last active tab on page load
        document.addEventListener('DOMContentLoaded', function() {
            const activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                showTab(activeTab);
            }
        });
        
        // Modal functions
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        // Image preview
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.value) {
                preview.src = input.value;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        }
        
        // Search function
        function searchCards(searchInputId, cardClass) {
            const input = document.getElementById(searchInputId);
            const filter = input.value.toLowerCase();
            const cards = document.getElementsByClassName(cardClass);
            
            for (let i = 0; i < cards.length; i++) {
                const card = cards[i];
                const name = card.getAttribute('data-name');
                if (name.includes(filter)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            }
        }
        
        // Content modal
        function editContent(section, content) {
            const modal = document.getElementById('contentModal');
            const title = document.getElementById('contentModalTitle');
            const sectionInput = document.getElementById('contentSectionName');
            const contentInput = document.getElementById('contentText');
            
            title.innerHTML = '<i class="fas fa-edit"></i> Edit Content';
            sectionInput.value = section;
            contentInput.value = content;
            
            openModal('contentModal');
        }
        
        // Collaborator modal
        function openCollaboratorModal(action, id = '', name = '', title = '', image = '', order = 0, active = 1) {
            const modal = document.getElementById('collaboratorModal');
            const modalTitle = document.getElementById('collaboratorModalTitle');
            const idInput = document.getElementById('collaboratorId');
            const nameInput = document.getElementById('collaboratorName');
            const titleInput = document.getElementById('collaboratorTitle');
            const imageInput = document.getElementById('collaboratorImage');
            const orderInput = document.getElementById('collaboratorOrder');
            const activeCheck = document.getElementById('collaboratorActive');
            const submitBtn = document.getElementById('collaboratorSubmitBtn');
            const updateBtn = document.getElementById('collaboratorUpdateBtn');
            const preview = document.getElementById('collaboratorPreview');
            
            if (action === 'edit') {
                modalTitle.innerHTML = '<i class="fas fa-user-edit"></i> Edit Collaborator';
                idInput.value = id;
                nameInput.value = name;
                titleInput.value = title;
                imageInput.value = image;
                orderInput.value = order;
                activeCheck.checked = active == 1;
                submitBtn.style.display = 'none';
                updateBtn.style.display = 'inline-flex';
                
                if (image) {
                    preview.src = image;
                    preview.style.display = 'block';
                } else {
                    preview.style.display = 'none';
                }
            } else {
                modalTitle.innerHTML = '<i class="fas fa-user-plus"></i> Add Collaborator';
                idInput.value = '';
                nameInput.value = '';
                titleInput.value = '';
                imageInput.value = '';
                orderInput.value = '0';
                activeCheck.checked = true;
                submitBtn.style.display = 'inline-flex';
                updateBtn.style.display = 'none';
                preview.style.display = 'none';
            }
            
            openModal('collaboratorModal');
        }
        
        function editCollaborator(id, name, title, image, order, active) {
            openCollaboratorModal('edit', id, name, title, image, order, active);
        }
        
        // Tire modal
        function openTireModal(action, id = '', name = '', tag = '', description = '', image = '', sizes = '', order = 0, active = 1) {
            const modal = document.getElementById('tireModal');
            const modalTitle = document.getElementById('tireModalTitle');
            const idInput = document.getElementById('tireId');
            const nameInput = document.getElementById('tireName');
            const tagInput = document.getElementById('tireTag');
            const descInput = document.getElementById('tireDescription');
            const imageInput = document.getElementById('tireImage');
            const sizesInput = document.getElementById('tireSizes');
            const orderInput = document.getElementById('tireOrder');
            const activeCheck = document.getElementById('tireActive');
            const submitBtn = document.getElementById('tireSubmitBtn');
            const updateBtn = document.getElementById('tireUpdateBtn');
            const preview = document.getElementById('tirePreview');
            
            if (action === 'edit') {
                modalTitle.innerHTML = '<i class="fas fa-edit"></i> Edit Tire';
                idInput.value = id;
                nameInput.value = name;
                tagInput.value = tag;
                descInput.value = description;
                imageInput.value = image;
                sizesInput.value = sizes;
                orderInput.value = order;
                activeCheck.checked = active == 1;
                submitBtn.style.display = 'none';
                updateBtn.style.display = 'inline-flex';
                
                if (image) {
                    preview.src = image;
                    preview.style.display = 'block';
                } else {
                    preview.style.display = 'none';
                }
            } else {
                modalTitle.innerHTML = '<i class="fas fa-circle"></i> Add Tire';
                idInput.value = '';
                nameInput.value = '';
                tagInput.value = '';
                descInput.value = '';
                imageInput.value = '';
                sizesInput.value = '';
                orderInput.value = '0';
                activeCheck.checked = true;
                submitBtn.style.display = 'inline-flex';
                updateBtn.style.display = 'none';
                preview.style.display = 'none';
            }
            
            openModal('tireModal');
        }
        
        function editTire(id, name, tag, description, image, sizes, order, active) {
            openTireModal('edit', id, name, tag, description, image, sizes, order, active);
        }
        
        // Story modal
        function openStoryModal(action, id = '', title = '', description = '', image = '', link = '', order = 0, active = 1) {
            const modal = document.getElementById('storyModal');
            const modalTitle = document.getElementById('storyModalTitle');
            const idInput = document.getElementById('storyId');
            const titleInput = document.getElementById('storyTitle');
            const descInput = document.getElementById('storyDescription');
            const imageInput = document.getElementById('storyImage');
            const linkInput = document.getElementById('storyLink');
            const orderInput = document.getElementById('storyOrder');
            const activeCheck = document.getElementById('storyActive');
            const submitBtn = document.getElementById('storySubmitBtn');
            const updateBtn = document.getElementById('storyUpdateBtn');
            const preview = document.getElementById('storyPreview');
            
            if (action === 'edit') {
                modalTitle.innerHTML = '<i class="fas fa-edit"></i> Edit Story';
                idInput.value = id;
                titleInput.value = title;
                descInput.value = description;
                imageInput.value = image;
                linkInput.value = link;
                orderInput.value = order;
                activeCheck.checked = active == 1;
                submitBtn.style.display = 'none';
                updateBtn.style.display = 'inline-flex';
                
                if (image) {
                    preview.src = image;
                    preview.style.display = 'block';
                } else {
                    preview.style.display = 'none';
                }
            } else {
                modalTitle.innerHTML = '<i class="fas fa-book"></i> Add Story';
                idInput.value = '';
                titleInput.value = '';
                descInput.value = '';
                imageInput.value = '';
                linkInput.value = '';
                orderInput.value = '0';
                activeCheck.checked = true;
                submitBtn.style.display = 'inline-flex';
                updateBtn.style.display = 'none';
                preview.style.display = 'none';
            }
            
            openModal('storyModal');
        }
        
        function editStory(id, title, description, image, link, order, active) {
            openStoryModal('edit', id, title, description, image, link, order, active);
        }
        
        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.style.display = 'none';
                });
                document.body.style.overflow = 'auto';
            }
        });
    </script>
</body>
</html>
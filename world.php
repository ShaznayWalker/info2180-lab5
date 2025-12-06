<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Get the country parameter from the query string
$country = isset($_GET['country']) ? $_GET['country'] : '';

// Get the lookup parameter to determine if we're looking up cities
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';

if ($country !== '') {
    // Use LIKE for partial matching as specified in instructions
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->execute([':country' => '%' . $country . '%']);
} else {
    // If no country specified, get all countries
    $stmt = $conn->query("SELECT * FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
  
  
 
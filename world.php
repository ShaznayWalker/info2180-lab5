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

<table border="1">
    <tr>
        <th>Name</th>
        <th>Continent</th>
        <th>Independence</th>
        <th>Head of State</th>
    </tr>
    
    <?php foreach ($results as $row): ?>
    <tr>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['continent']) ?></td>
        <td><?= htmlspecialchars($row['independence_year']) ?></td>
        <td><?= htmlspecialchars($row['head_of_state']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
  
  
 
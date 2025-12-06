<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : 'countries';

// Check lookup
if ($lookup === 'cities') {
    
    if ($country !== '') {
        // JOIN query from countries and cities tables
        // cities for country
        $stmt = $conn->prepare("
            SELECT cities.name, cities.district, cities.population 
            FROM cities 
            JOIN countries ON cities.country_code = countries.code 
            WHERE countries.name LIKE :country
        ");
        $stmt->execute([':country' => '%' . $country . '%']);
    } else {
        // If no country get some sample cities
        $stmt = $conn->query("
            SELECT cities.name, cities.district, cities.population 
            FROM cities 
            JOIN countries ON cities.country_code = countries.code 
            LIMIT 50
        ");
    }
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Output cities table 
    echo '<table border="1">';
    echo '<tr><th>Name</th><th>District</th><th>Population</th></tr>';
    
    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['district']) . '</td>';
        echo '<td>' . htmlspecialchars($row['population']) . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
    
} else {
   
    if ($country !== '') {
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        $stmt->execute([':country' => '%' . $country . '%']);
    } else {
        $stmt = $conn->query("SELECT * FROM countries");
    }
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Output countries in a table
    echo '<table border="1">';
    echo '<tr><th>Name</th><th>Continent</th><th>Independence</th><th>Head of State</th></tr>';
    
    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['continent']) . '</td>';
        echo '<td>' . htmlspecialchars($row['independence_year']) . '</td>';
        echo '<td>' . htmlspecialchars($row['head_of_state']) . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
}
?>
  
  
 
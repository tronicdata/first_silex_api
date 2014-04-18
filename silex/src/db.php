<?php

$stmt = $db->query('SELECT * FROM books');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
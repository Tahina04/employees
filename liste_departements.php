<?php
require_once 'includes/employees.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Departements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Liste des Departements</h1>
    <?php
    $sql = "SELECT d.dept_no, d.dept_name, CONCAT(e.first_name, ' ', e.last_name) AS manager_name
            FROM departments d
            JOIN dept_manager dm ON d.dept_no = dm.dept_no
            JOIN employees e ON dm.emp_no = e.emp_no
            WHERE dm.to_date = '9999-01-01'";
    $result = $conn->query($sql);

    echo '<table class="table table-striped">';
    echo '<thead><tr><th>Departement</th><th>Manager</th><th>Actions</th></tr></thead><tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['dept_name'] . '</td>';
        echo '<td>' . $row['manager_name'] . '</td>';
        echo '<td><a href="employes.php?dept_no=' . $row['dept_no'] . '" class="btn btn-primary btn-sm">Voir les employes</a></td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
    ?>
</div>
</body>
</html>

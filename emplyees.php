<?php
include 'includes/db.php';
$dept = $_GET['dept'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Employes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head><?php
require_once 'includes/db.php';
$dept_no = $_GET['dept_no'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">  
<head>
    <meta charset="UTF-8">
    <title>Employes du Departement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="liste_departements.php" class="btn btn-secondary mb-3">&larr; Retour</a>
    <h1 class="mb-4">Employes du departement <?php echo htmlspecialchars($dept_no); ?></h1>
    <?php
    $stmt = $conn->prepare("SELECT e.first_name, e.last_name, e.hire_date
                            FROM employees e
                            JOIN dept_emp de ON e.emp_no = de.emp_no
                            WHERE de.dept_no = ? AND de.to_date = '9999-01-01'");
    $stmt->bind_param("s", $dept_no);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<table class="table table-hover">';
    echo '<thead><tr><th>Nom</th><th>Date d\'embauche</th></tr></thead><tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr><td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>';
        echo '<td>' . $row['hire_date'] . '</td></tr>';
    }
    echo '</tbody></table>';
    ?>
</div>
</body>
</html>

<body>
<div class="container mt-4">
  <a href="liste_departements.php" class="btn btn-secondary mb-3">← Retour</a>
  <h2>Employes du departement <?= htmlspecialchars($dept) ?></h2>
  <table class="table table-striped">
    <tr>
      <th>Nom</th>
      <th>Date d'embauche</th>
    </tr>
    <?php
    $sql = "SELECT e.first_name, e.last_name, e.hire_date
            FROM employees e
            JOIN dept_emp de ON e.emp_no = de.emp_no
            WHERE de.dept_no = '$dept' AND de.to_date = '9999-01-01'";
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) {
      echo "<tr><td>" . $row['first_name'] . " " . $row['last_name'] . "</td><td>" . $row['hire_date'] . "</td></tr>";
    }
    ?>
  </table>
</div>
</body>
</html>

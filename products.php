<?php
include "db_conn.php";

$sql = "SELECT DISTINCT type FROM proizvodi";
$result = $spoj->query($sql);
$types = array();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $types[] = $row["type"];
  }
}

$items_per_page = 8;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$type = isset($_GET['type']) ? $_GET['type'] : '';

$sql = "SELECT COUNT(*) AS total FROM proizvodi";
if (!empty($type)) {
  $sql .= " WHERE type = '$type'";
}

$result = $spoj->query($sql);
$row = $result->fetch_assoc();
$total_items = $row['total'];
$total_pages = ceil($total_items / $items_per_page);

$offset = ($current_page - 1) * $items_per_page;

$sql = "SELECT * FROM proizvodi";
if (!empty($type)) {
  $sql .= " WHERE type = '$type'";
}
$sql .= " ORDER BY id DESC LIMIT $offset, $items_per_page";

$result = $spoj->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <?php include 'header.php'; ?>
  </header>

  <div class="filter-section">
    <form action="" method="GET">
      <label for="type-picker">Vrsta:</label>
      <select id="type-picker" name="type" onchange="this.form.submit()">
        <option value="">Sve vrste</option>
        <?php
        foreach ($types as $option) {
          $selected = ($type == $option) ? "selected" : "";
          echo "<option value='$option' $selected>$option</option>";
        }
        ?>
      </select>
    </form>
  </div>

  <div class="items-grid">

    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='item'>";
        echo "<a href='product.php?id=".$row["id"]."'>";
        echo "<img src='".$row["image"]."' alt='Product Image'>";
        echo "<h3>".$row["name"]."</h3>";
        echo "<p>Cijena: ".$row["price"]."€</p>";
        echo "</a>";
        echo "</div>";
      }
    } else {
      echo "<p>Nema dostupnih proizvoda.</p>";
    }

    $spoj->close();
    ?>

  </div>

  <div class="numberofpage">
    <?php
    for ($i = 1; $i <= $total_pages; $i++) {
      $active = ($i == $current_page) ? "active" : "";
      echo "<a href='products.php?page=".$i."&type=".$type."' class='".$active."'>".$i."</a>";
    }

    ?>
  </div>
</body>
</html>



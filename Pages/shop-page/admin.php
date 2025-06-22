<?php
require "database.php";
$message = "";
$view = isset($_GET["view"]) ? $_GET["view"] : "dashboard";

// Fetch categories for dropdown
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"])) {
  $name = trim($_POST["name"]);
  $price = $_POST["price"];
  $description = trim($_POST["description"]);
  $category_id = $_POST["category_id"];

  if (empty($name) || !is_numeric($price) || !is_numeric($category_id)) {
    $message = "Vui lòng nhập đúng thông tin!";
  } else {
    if (isset($_FILES["image_url"]) && $_FILES["image_url"]["error"] == 0) {
      $allowed = ["jpg" => "image/jpeg", "jpeg" => "image/jpeg", "png" => "image/png"];
      $filename = $_FILES["image_url"]["name"];
      $filetype = $_FILES["image_url"]["type"];
      $filesize = $_FILES["image_url"]["size"];
      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

      if (!array_key_exists($ext, $allowed)) {
        $message = "Chỉ cho phép file JPG, JPEG, PNG!";
      } elseif ($filesize > 10 * 1024 * 1024) {
        $message = "File quá lớn! Giới hạn 10MB.";
      } else {
        $new_filename = uniqid() . "." . $ext;
        $upload_dir = "img/" . $new_filename;
        if (!is_dir("img")) mkdir("img", 0777, true);
        if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $upload_dir)) {
          $sql = "INSERT INTO products (name, price, description, image_url, category_id)
                            VALUES (:name, :price, :description, :image_url, :category_id)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([
            ":name" => $name,
            ":price" => $price,
            ":description" => $description,
            ":image_url" => $new_filename,
            ":category_id" => $category_id
          ]);
          $message = "Thêm sản phẩm thành công!";
        } else {
          $message = "Lỗi upload file!";
        }
      }
    } else {
      $message = "Vui lòng chọn ảnh sản phẩm!";
    }
  }
}
?>


<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Trang Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="admin.css">
</head>

<body>
  <nav>
    <a href="admin.php?view=dashboard"><i class="fa-solid fa-house-user"></i> Dashboard</a>
    <a href="admin.php?view=add"><i class="fa-solid fa-plus"></i> Thêm sản phẩm</a>
  </nav>

  <div class="container">
    <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

    <?php if ($view == "add"): ?>
      <h2>Thêm sản phẩm mới</h2>
      <form action="admin.php?view=add" method="post" enctype="multipart/form-data">
        <label>Danh mục:</label>
        <select name="category_id" required>
          <option value="">-- Chọn danh mục --</option>
          <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
          <?php endforeach; ?>
        </select>

        <label>Tên sản phẩm:</label>
        <input type="text" name="name" required>

        <label>Mô tả sản phẩm:</label>
        <textarea name="description" required></textarea>

        <label>Giá:</label>
        <input type="number" name="price" step="0.01" required>

        <label>Ảnh sản phẩm:</label>
        <input type="file" name="image_url" accept=".jpg,.jpeg,.png" required>

        <input type="submit" value="Thêm sản phẩm">
      </form>


    <?php else: ?>
      <h2>Danh sách sản phẩm</h2>
      <div class="product-grid">
        <?php
        $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
        while ($row = $stmt->fetch()):
        ?>
          <div class="product-card">
            <img src="img/<?= htmlspecialchars($row["image_url"]) ?>" alt="Ảnh">
            <h3><?= htmlspecialchars($row["name"]) ?></h3>
            <p>Giá: <?= number_format($row["price"]) ?>đ</p>
            <p><?= htmlspecialchars($row["description"]) ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>
</body>

</html>
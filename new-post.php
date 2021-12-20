<?php
include('include/connection.php');
include('include/header.php');
session_start();
$p_title = $_POST['title'];
$p_cate = $_POST['cate'];
// $p_image = $_POST['cate'];
$p_content = $_POST['content'];
$p_auther = "الأدمن";
$p_add = $_POST['add'];

// image
$image_name = basename($_FILES["post_image"]["name"]);
$image_tmp = $_FILES["post_image"]["tmp_name"];

if (!isset($_SESSION['id'])) {
  echo "<div class='alert alert-danger'>" . "غير مسموح لك بفتح هذه الصفحة" . "</div>";
  header('REFRESH:1;URL=login.php');
} else {

?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2" id="side-area">
          <h4>لوحة التحكم</h4>
          <ul>
            <li>
              <a href="categories.php">
                <span><i class="fas fa-tags"></i></span>
                <span>التصنيفات</span>
              </a>
            </li>
            <!-- Articles Section -->
            <li data-toggle="collapse" data-target="#menu">
              <a href="#">
                <span><i class="far fa-newspaper"></i></span>
                <span>المقالات</span>
              </a>
            </li>
            <ul class="collapse" id="menu">
              <li>
                <a href="new-post.php">
                  <span><i class="far fa-edit"></i></span>
                  <span>مقال جديد</span>
                </a>
              </li>
              <li>
                <a href="posts.php">
                  <span><i class="fas fa-th-list"></i></span>
                  <span>كل المقالات</span>
                </a>
              </li>
            </ul>
            <li>
              <a href="index.php" target="_blank">
                <span><i class="far fa-window-restore"></i></span>
                <span>عرض الموقع</span>
              </a>
            </li>
            <li>
              <a href="logout.php">
                <span><i class="fas fa-sign-out-alt"></i></span>
                <span>تسجيل الخروج</span>
              </a>
            </li>
          </ul>
        </div>

        <div class="col-md-10" id="main-area">
          <h4 style="margin-top: 20px;">إضافة مقال جديد</h4>
          <?php
          if (isset($p_add)) {
            if (empty($p_title) || empty($p_content)) {
              echo ('<div class="alert alert-danger" role="alert">الرجاء ملء الحقول أدناه</div>');
            } else {
              $p_image = rand(0, 1000) . "_" . $image_name;
              move_uploaded_file($image_tmp, "uploads\\" . $p_image);
              $query = "INSERT INTO posts (post_title,post_category,post_image,post_content,post_auther)
             VALUES ('$p_title','$p_cate','$p_image','$p_content','$p_auther')";
              $res = mysqli_query($conn, $query);
              if (isset($res)) {
                echo ('<div class="alert alert-success" role="alert">تمت إضافة المنشور بنجاح</div>');
              } else {
                echo ('<div class="alert alert-danger" role="alert">حدث خطأ ما</div>');
              }
            }
          }
          ?>
          <div class="add-category">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="title">عنوان المقال</label>
                <input type="text" name="title" id="title" class="form-control" />
              </div>
              <div class="form-group">
                <label for="cate">التصنيف</label>
                <select name="cate" id="cate" class="form-control">
                  <?php
                  $query = "SELECT * FROM categories";
                  $res = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                    <option name="category">
                      <?php echo $row['category_name'] ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="image">صورة المقال</label>
                <input type="file" class="form-control" accept="image/*" id="image" name="post_image" />
              </div>
              <div class="form-group">
                <label for="content">نص المقال</label>
                <textarea id="content" name="content" cols="30" rows="10" class="form-control"></textarea>
              </div>
              <button class="btn btn-custom" name="add">نشر المقالة</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<?php
include('include/footer.php');
?>
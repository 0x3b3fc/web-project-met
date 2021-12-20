<?php
include('include/connection.php');
include('include/header.php');

session_start();

$cName = $_POST['category'];
$cAdd = $_POST['add'];
$id = $_GET['id'];
if (isset($id)) {
  $query = "DELETE FROM categories WHERE id = '$id'";
  $delete = mysqli_query($conn, $query);
}
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
          <div class="add-category">
            <?php
            if (isset($cAdd)) {

              if (empty($cName)) {
                echo ('<div class="alert alert-danger" role="alert">حقل التصنيف فارغ</div>');
              } else {
                $query = "INSERT INTO categories (category_name) VALUES ('$cName')";
                mysqli_query($conn, $query);
                echo ('<div class="alert alert-success" role="alert">تم إضافة التصنيف</div>');
              }
            }
            if (isset($delete)) {
              echo "<div class='alert alert-success'>" . "تم حذف الفئة بنجاح" . "</div>";
            }
            ?>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
              <div class="form-group">
                <label for="category">تصنيف جديد</label>
                <input type="text" name="category" id="category" class="form-control" />
              </div>
              <button class="btn btn-custom" name="add">إضافة</button>
            </form>
          </div>
          <!-- Display Category -->
          <div class="display-cat mt-5">
            <table class="table table-bordered table-striped">
              <tr class="bg-info">
                <th scope="col">رقم الفئة</th>
                <th scope="col">إسم الفئة</th>
                <th scope="col">تاريخ الإضافة</th>
                <th scope="col">حذف الفئة</th>
              </tr>
              <?php
              $query = "SELECT * FROM categories";
              $res = mysqli_query($conn, $query);
              $no = 0;
              while ($row = mysqli_fetch_assoc($res)) {
                $no++;
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['category_name']; ?></td>
                  <td><?php echo $row['category_date']; ?></td>
                  <td>
                    <a href="categories.php?id=<?php echo $row['id']; ?>">
                      <button class="btn btn-custom">حذف التصنيف</button>
                    </a>
                  </td>
                </tr>
              <?php
              }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>
<?php
include('include/footer.php');
?>
<?php
include('include/connection.php');
include('include/header.php');

session_start();
$id = $_GET['id'];
if (isset($id)) {
  $query = "DELETE FROM posts WHERE id = '$id'";
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
          <?php
          if (isset($delete)) {
            echo "<div class='alert alert-success'>" . "تم حذف المقال بنجاح" . "</div>";
          }
          ?>
          <!-- Display all posts -->
          <table class="table table-bordered table-striped mt-5">
            <tr>
              <th scope="col">رقم المقال</th>
              <th scope="col">عنوان المقال</th>
              <th scope="col">كاتب المقال</th>
              <th scope="col">صورة المقال</th>
              <th scope="col">تاريخ المقال</th>
              <th scope="col">حذف المقال</th>
            </tr>
            <?php
            $query = "SELECT * FROM posts";
            $res = mysqli_query($conn, $query);
            $no = 0;
            while ($row = mysqli_fetch_assoc($res)) {
              $no++;
            ?>

              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row['post_title']; ?></td>
                <td><?php echo $row['post_auther']; ?></td>
                <td><img src="uploads/<?php echo $row['post_image']; ?>" alt="" width="70px" height="50px"></td>
                <td><?php echo $row['post_date']; ?></td>
                <td>
                  <a href="posts.php?id=<?php echo $row['id']; ?>">
                    <button class="btn btn-custom">حذف المقال</button>
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
<?php
}
?>
<?php
include('include/footer.php');
?>
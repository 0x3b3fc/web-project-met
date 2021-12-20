<?php
include('include/connection.php');
include('public/header.php');
?>

<!-- content section start -->
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM posts WHERE id = '$id'";
        $res = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($res);
        ?>
          <div class="post">
            <div class="post-image">
              <img src="uploads/<?php echo $row['post_image']; ?>" alt="" />
            </div>
            <div class="post-title">
              <h4>
              <?php echo $row['post_title']; ?>
              </h4>
            </div>
            <div class="post-details">
              <p class="post-info">
                <span><i class="far fa-user"></i><?php echo $row['post_auther']; ?></span>
                <span><i class="fas fa-calendar-alt"></i><?php echo $row['post_date']; ?></span>
                <span><i class="fas fa-tags"></i><?php echo $row['post_category']; ?></span>
              </p>
              <p class="post-content">
                  <?php
                  echo $row['post_content'];
                  ?>
              </p>
            </div>
          </div>

      </div>
      <div class="col-md-3">
        <!-- Category Sub Section Start -->
        <div class="categories">
          <h4>التصنيفات</h4>
          <ul>
            <?php
            $query = "SELECT * FROM categories";
            $res = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
              <li>
                <a href="category.php?cat=<?php echo $row['category_name'];?>">
                  <span><i class="fas fa-tags"></i></span>
                  <span><?php echo $row['category_name']; ?></span>
                </a>
              </li>
            <?php
            }
            ?>


          </ul>
        </div>
        <!-- Category Sub Section end -->
        <!-- Latest posts Sub Section start -->
        <div class="last-posts">
          <h4>أحدث المنشورات</h4>
          <ul>
            <?php
            $query = "SELECT * FROM posts ORDER BY id DESC LIMIT 3";
            $res = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
              <li>
                <a href="post.php?id=<?php echo $row['id']; ?>">
                  <span class="span-image"><img src="uploads/<?php echo $row['post_image'] ;?>" alt="" /></span>
                  <span><?php echo $row['post_title'] ;?></span>
                </a>
              </li>
            <?php
            }
            ?>

          </ul>
        </div>
        <!-- Latest posts Sub Section end -->
      </div>
    </div>
  </div>
</div>
<!-- content section end -->

<?php
include('public/footer.php');
?>
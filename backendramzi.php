<?php
include_once '../Controller/postC.php';
include_once '../Controller/commentC.php';
require_once '../vendor/tecnickcom/tcpdf/examples/tcpdf_include.php';  // Adjust the path as necessary
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php'; // Include the TCPDF class
// Initialize controller
$postController = new postC();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['postId'], $_POST['author'], $_POST['title'], $_POST['content'])) {
    $postId = $_POST['postId'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Assuming updatepost is a method in your postC class that accepts four parameters
    $result = $postController->updatepost($postId, $author, $title, $content);
    if ($result) {
        echo 'Post updated successfully.';
        // Redirect or other response
    } else {
        echo 'Failed to update post.';
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteId'])) {
    $deleteId = $_POST['deleteId'];
    $postController->deletepost($deleteId);
    echo "Post deleted successfully"; // You can return something more structured here
    exit;
}

$commentController = new commentC();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['commentId'], $_POST['author'], $_POST['content'])) {
    $commentId = $_POST['commentId'];
    $author = $_POST['author'];
    $content = $_POST['content'];

    // Assuming updateComment is a method in your commentC class that accepts three parameters
    $result = $commentController->updateComment($commentId, $author, $content);
    if ($result) {
        echo 'Comment updated successfully.';
        // Redirect or other response
    } else {
        echo 'Failed to update comment.';
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteCommentId'])) {
    $deleteId = $_POST['deleteCommentId'];
    $commentController->deleteComment($deleteId);
    echo "Comment deleted successfully"; // You can return something more structured here
    exit;
}


$posts = $postController->listpost();
$comments = $commentController->listComment();


?>

<html lang="en"><head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Admin Ramzi</title>
    <link rel="canonical" href="https://www.creative-tim.com/product/light-bootstrap-dashboard">
    <!--  Social tags      -->

    <!-- Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/css/bootstrapr.min.css" rel="stylesheet">
    <link href="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/css/demo.css" rel="stylesheet">
    <!-- Google Tag Manager -->
    <script type="text/javascript" async="" src="https://ssl.google-analytics.com/ga.js"></script><script async="" src="https://www.googletagmanager.com/gtm.js?id=GTM-NKDMSK6"></script><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NKDMSK6');</script>
    <!-- End Google Tag Manager -->
    <script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/33/7/intl/es_ALL/common.js"></script><script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/33/7/intl/es_ALL/util.js"></script><script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/33/7/intl/es_ALL/stats.js"></script><script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps/api/js/AuthenticationService.Authenticate?1shttps%3A%2F%2Fdemos.creative-tim.com%2Flight-bootstrap-dashboard%2Fexamples%2Fdashboard.html%3F_ga%3D2.22224315.1471826603.1531747550-1340017084.1530656181&amp;4sAIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU&amp;callback=_xdc_._4ykeoi&amp;key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU&amp;token=53352"></script></head>
<link href="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/css/bootstrap.min.css" rel="stylesheet">
<script src="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!-- Correct the path to jQuery if it's incorrect -->
<script src="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script>
function loadPostDetails(post) {
    console.log(post); // Check if post data is correct
    document.getElementById('postAuthor').textContent = post.auteur;
    document.getElementById('postTitle').textContent = post.titre;
    document.getElementById('postContent').textContent = post.contenu;
}

function setDeletePostId(postId) {
    window.postIdToDelete = postId;
}

function setDeleteCommentId(commentId) {
    window.commentIdToDelete = commentId;
}

function deletePost() {
    var postId = window.postIdToDelete; // This should be set by your setDeletePostId function
    $.ajax({
        url: '', // Empty string means the current page
        type: 'POST',
        data: {deleteId: postId},
        success: function(response) {
            alert(response); // Display success message from server
            location.reload(); // Reload to update the table
        },
        error: function() {
            alert('Error deleting post');
        }
    });
}
function editPost(post) {
    document.getElementById('editPostId').value = post.id; // Hidden field for post ID
    document.getElementById('editPostAuthor').value = post.auteur;
    document.getElementById('editPostTitle').value = post.titre;
    document.getElementById('editPostContent').value = post.contenu;
}
function loadCommentDetails(comment) {
    document.getElementById('commentAuthor').textContent = comment.auteur;
    document.getElementById('commentContent').textContent = comment.contenu_comment;
}

function editComment(comment) {
    document.getElementById('editCommentId').value = comment.id;
    document.getElementById('editCommentAuthor').value = comment.auteur;
    document.getElementById('editCommentContent').value = comment.contenu_comment;
}

function deleteComment() {
    var commentId = window.commentIdToDelete;
    $.ajax({
        url: '', // Empty string means the current page
        type: 'POST',
        data: {deleteCommentId: commentId},
        success: function(response) {
            alert(response); // Display success message from server
            location.reload(); // Reload to update the table
        },
        error: function() {
            alert('Error deleting comment');
        }
    });
}
function exportPost(postId) {
    window.open('export_post.php?id=' + postId, '_blank');
}



</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <body>
    <div class="wrapper">
        <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="http://www.creative-tim.com" class="simple-text">
                        Creative Tim
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="./table.html">
                            <i class="nc-icon nc-notes"></i>
                            <p>Posts List </p>
                        </a>
                    </li>
              </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class=" container-fluid  ">
                    <a class="navbar-brand" href="#pablo"> Table List </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="card strpied-tabled-with-hover">
<div class="card-header">
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addPostModal">Add New Post</button>
</div>

<div class="card strpied-tabled-with-hover">
    <div class="card-header">
        <h4 class="card-title">Posts</h4>
        <p class="card-category">List of all blog posts</p>
    </div>
    <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <th>ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Content</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?php echo $post['id']; ?></td>
                    <td><?php echo $post['auteur']; ?></td>
                    <td><?php echo $post['titre']; ?></td>
                    <td><?php echo $post['contenu']; ?></td>
                    <td>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPostModal" onclick="loadPostDetails(<?php echo htmlspecialchars(json_encode($post)); ?>)">View</button>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editPostModal" onclick="editPost(<?php echo htmlspecialchars(json_encode($post)); ?>)">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePostModal" onclick="setDeletePostId(<?php echo $post['id']; ?>)">Delete</button>
                    <button type="button" class="btn btn-success btn-sm" onclick="exportPost(<?php echo $post['id']; ?>)">Export as PDF</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="card strpied-tabled-with-hover">
    <div class="card-header">
        <h4 class="card-title">Comments</h4>
        <p class="card-category">List of all comments on posts</p>
    </div>
    <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <th>ID</th>
                <th>Post ID</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><?php echo $comment['id']; ?></td>
                    <td><?php echo $comment['post_id']; ?></td>
                    <td><?php echo $comment['auteur']; ?></td>
                    <td><?php echo $comment['contenu_comment']; ?></td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewCommentModal" onclick="loadCommentDetails(<?php echo htmlspecialchars(json_encode($comment)); ?>)">View</button>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCommentModal" onclick="editComment(<?php echo htmlspecialchars(json_encode($comment)); ?>)">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCommentModal" onclick="window.commentIdToDelete = <?php echo $comment['id']; ?>">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewPostModal" tabindex="-1" role="dialog" aria-labelledby="viewPostModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewPostModalLabel">View Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Dynamic content goes here -->
        <p><strong>Author:</strong> <span id="postAuthor"></span></p>
        <p><strong>Title:</strong> <span id="postTitle"></span></p>
        <p><strong>Content:</strong> <span id="postContent"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="deletePostModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletePostModalLabel">Delete Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this post?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" onclick="deletePost()">Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form id="editPostForm" action="your_php_script_handling_update.php" method="POST">
  <input type="hidden" name="postId" id="editPostId" value="">
  <div class="form-group">
    <label for="editPostAuthor">Author</label>
    <input type="text" class="form-control" id="editPostAuthor" name="author">
  </div>
  <div class="form-group">
    <label for="editPostTitle">Title</label>
    <input type="text" class="form-control" id="editPostTitle" name="title">
  </div>
  <div class="form-group">
    <label for="editPostContent">Content</label>
    <textarea class="form-control" id="editPostContent" name="content"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Save Changes</button>
</form>
      </div>
    </div>
  </div>
</div>

<!-- View Comment Modal -->
<div class="modal fade" id="viewCommentModal" tabindex="-1" role="dialog" aria-labelledby="viewCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewCommentModalLabel">View Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Author:</strong> <span id="commentAuthor"></span></p>
        <p><strong>Content:</strong> <span id="commentContent"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Edit Comment Modal -->
<div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editCommentForm" action="your_php_script_handling_comment_update.php" method="POST">
          <input type="hidden" name="commentId" id="editCommentId" value="">
          <div class="form-group">
            <label for="editCommentAuthor">Author</label>
            <input type="text" class="form-control" id="editCommentAuthor" name="author">
          </div>
          <div class="form-group">
            <label for="editCommentContent">Content</label>
            <textarea class="form-control" id="editCommentContent" name="content"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Delete Comment Modal -->
<div class="modal fade" id="deleteCommentModal" tabindex="-1" role="dialog" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteCommentModalLabel">Delete Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this comment?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" onclick="deleteComment()">Delete</button>
      </div>
    </div>
  </div>
</div>


<!-- Add Post Modal -->
<div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="addPostModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPostModalLabel">Add New Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addPostForm" action="your_php_script_for_adding_post.php" method="POST">
          <div class="form-group">
            <label for="postAuthor">Author</label>
            <input type="text" class="form-control" id="postAuthor" name="author" required>
          </div>
          <div class="form-group">
            <label for="postTitle">Title</label>
            <input type="text" class="form-control" id="postTitle" name="title" required>
          </div>
          <div class="form-group">
            <label for="postContent">Content</label>
            <textarea class="form-control" id="postContent" name="content" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>



            <!-- End Navbar -->
            <footer class="footer">
                <div class="container">
                    <nav>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
</body>

<!--   Core JS Files   -->
<script src=".https://demos.creative-tim.com/light-bootstrap-dashboard/assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: https://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
<!--  Chartist Plugin  -->
<script src="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/js/plugins/chartist.min.js"></script>
<!--  Share Plugin -->
<script src="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/js/plugins/jquery.sharrre.js"></script>
<!--  Notifications Plugin    -->
<script src="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="https://demos.creative-tim.com/light-bootstrap-dashboard/assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.showNotification();

    });
</script>



</body></html>
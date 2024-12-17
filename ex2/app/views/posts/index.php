<?php if(!empty($_SESSION['message'])): ?>
  <div class="alert alert-<?php echo $_SESSION['status'] ?>" role="alert">
    <?php echo htmlspecialchars($_SESSION['message']) ?>
  </div>
  <?php unset($_SESSION['message']); ?>
  <?php unset($_SESSION['status']); ?>
<?php endif; ?>
<div>
  <a href="/admin/posts/create" class="btn btn-primary">Create Post</a>
  <a href="/admin/categories/create" class="btn btn-primary">Create Category</a>
</div>

<h2>
  Admin Posts
</h2>

<?php if (empty($posts)): ?>
  <div class="alert alert-info" role="alert">
    No posts found
  </div>
<?php else: ?>
  <?php foreach ($posts as $post): ?>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($post['title']) ?></h5>
        <p class="card-text"><?php echo htmlspecialchars($post['content']) ?></p>
        <a href="/admin/posts/edit/<?php echo $post['id'] ?>" class="btn btn-primary">Edit</a>
        <a href="/admin/posts/delete/<?php echo $post['id'] ?>" class="btn btn-danger">Delete</a>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

<style>
  .card {
    margin: 10px;
    width: 18rem;
    display: inline-block;
  }
  .card-body {
    display: flex;
    flex-direction: column;
  }
  .card-title {
    font-size: 1.5rem;
  }
  .card-text {
    font-size: 1rem;
  }
  .alert-ok {
    color: green;
  }
  .alert-ko {
    color: red;
  }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Post</title>
</head>
<body>
  <h1>Create a New Post</h1>
  <form action="/admin/posts/store" method="POST" enctype="multipart/form-data">
    <div>
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" required>
    </div>
    <div>
      <label for="content">Content:</label>
      <textarea id="content" name="content" rows="10" required></textarea>
    </div>
    <div>
      <label for="images">Images:</label>
      <input type="file" id="images" name="images[]" multiple>
    </div>
    <div>
      <label for="category">Category:</label>
      <select id="category" name="category_id">
        <option value="">Select a category</option>
        <option value="1">News</option>
        <option value="2">Events</option>
        <option value="3">Updates</option>
      </select>
    </div>
    <div>
      <button type="submit">Create Post</button>
    </div>
  </form>
</body>
</html>
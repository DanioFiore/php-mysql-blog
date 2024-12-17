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
      <select id="category" name="category" required>
        <option value="news">News</option>
        <option value="events">Events</option>
        <option value="updates">Updates</option>
      </select>
    </div>
    <div>
      <button type="submit">Create Post</button>
    </div>
  </form>
</body>
</html>
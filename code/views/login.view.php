<?php require_once(__DIR__ . "/_partials/head.part.php") ?>
<body>
  <h1><?= $viewData->pageHeading ?></h1>
  <p><?= $viewData->pageMessage ?></p>
  <form method="post" class="form login-form">
    <div class="form__group">
      <label for="username">Username</label>
      <input id="username" name="username" type="text" />
    </div>
    <button type="submit">Login</button>
  </form>
</body>
</html>
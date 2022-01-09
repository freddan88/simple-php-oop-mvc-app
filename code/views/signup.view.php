<?php require_once(__DIR__ . "/_partials/head.part.php") ?>
<body>
  <?php require_once(__DIR__ . "/_partials/header.part.php") ?>
  <main class="main-content">
    <section class="section section--intro">
      <h1><?= $viewData->pageHeading ?? '' ?></h1>
      <p><?= $viewData->pageMessage ?></p>

        <form method="post" class="form signup-form" id="signup-form">
          <div class="form__group">
            <label for="email">Email</label>
            <input id="email" name="email" type="text" />
          </div>

          <div class="form__group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" />
          </div>

          <div class="form__group">
            <label for="confirm_password">Confirm password</label>
            <input id="confirm_password" name="confirm_password" type="password" />
          </div>

          <button type="submit" class="form__submit-button">Signup</button>
        </form>

    </section>
  </main>
  <footer class="main-footer">
  </footer>
</body>
</html>
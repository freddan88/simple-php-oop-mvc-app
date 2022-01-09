<?php require_once(__DIR__ . "/_partials/head.part.php") ?>
<body>
  <?php require_once(__DIR__ . "/_partials/header.part.php") ?>
  <main class="main-content">
    <section class="section section--intro">
      <h1><?= $viewData->pageHeading ?? '' ?></h1>
      <p><?= $viewData->pageMessage ?></p>

        <form method="post" class="form login-form" id="login-form">
          <div class="form__group">
            <label for="email">Email</label>
            <input id="email" name="email" type="text" />
          </div>

          <div class="form__group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" />
          </div>

          <div class="form__group">
            <p>Don´t have an account?
              <a href="signup">click here to create one</a>
            </p>
            <p>Forgot your password?
              <a href="">click here to recover it</a>
            </p>
          </div>

          <button type="submit" class="form__submit-button">Login</button>
        </form>

    </section>
  </main>
  <footer class="main-footer">
  </footer>
</body>
</html>
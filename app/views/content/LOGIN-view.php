  <?php require_once __DIR__."/../inc/head.php" ?>
  <?php require_once __DIR__."/../inc/navbar.php" ?>

  <form class="Loading" action="<?php echo APP_URL; ?>app/ajax/loginAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">
      <input type="text" id="log" name="log" value="log" required hidden>
      <div class="form-group">
          <label for="email" class="is-required">Correo Electrónico:</label>
          <input type="email" class="form-control is-required" id="email" name="email" pattern="[a-zA-Z0-9@.]{7,50}" minlength="3" maxlength="50"  required autocomplete="off">
      </div>
      <div class="form-group mt-3">
          <label for="message" class="is-required">Mensaje:</label>
          <textarea class="form-control is-required" id="message" pattern=".{15,500}" name="message" minlength="15" maxlength="500" rows="4" required></textarea>
      </div>
      <div id="divAlert" class="mt-2"></div>
      <button type="submit" class="btn btn-primary mt-3">Enviar</button>
  </form>

  <?php require_once __DIR__."/../inc/footer.php" ?>
  <?php require_once __DIR__."/../inc/script.php" ?>


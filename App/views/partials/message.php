    <?php if (isset($_SESSION['success_message'])): ?>
      <div class="message bg-green-100 p-3 my-3">
        <?= $_SESSION['success_message'] ?>
      </div>
      <?= $_SESSION['success_message'] ?>
    <?php endif ?>

    <?php if (isset($_SESSION['error_message'])): ?>
      <div class="message bg-red-100 p-3 my-3">
        <?= $_SESSION['error_message'] ?>
      </div>
      <?= $_SESSION['error_message'] ?>
    <?php endif ?>

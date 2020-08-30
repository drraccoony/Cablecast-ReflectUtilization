<?php
  $conn->close();
  $pageendtime = microtime(true);
?>

  <footer class="footer">
    <div class="container">
      <span class="text-muted"><?php printf("Page loaded in %f seconds", $pageendtime - $pagestarttime ); ?></span>
    </div>
  </footer>

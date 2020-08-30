<?php
  $conn->close();
  $pageendtime = microtime(true);
?>

  <footer class="footer">
    <div class="container">
      <span class="text-muted">Made with <i class="fas fa-heart-circle" style="color:Tomato"></i> by <a href="https://github.com/drraccoony/">Shawn</a> in <i class="fab fa-php"></i>. View <a href="https://github.com/drraccoony/Cablecast-ReflectUtilization"><i class="fab fa-github-alt"></i> Repo</a>.
        <?php printf("(Page loaded in %f seconds)", $pageendtime - $pagestarttime ); ?></span>
    </div>
  </footer>

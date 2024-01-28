<?php if (count($errors) > 0): ?>
  	<?php foreach ($errors as $error): ?>
        <?php
        echo '<div class="alert alert-danger" role="alert">';
        echo $error;
        echo "</div>";
        ?>
  	<?php endforeach; ?>
<?php endif; ?>

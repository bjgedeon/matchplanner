<?php
include 'models/model.home.php'
?>
<main>
    <?php
foreach($infos as $info)  { ?>
<div class="main">
    <h2 class="block"><?= htmlspecialchars($info['info_title'])?></h2> <br>
    <p class="block"><?= htmlspecialchars($info['info_text'])?></p>
</div>
<?php
}
?>  
</main>
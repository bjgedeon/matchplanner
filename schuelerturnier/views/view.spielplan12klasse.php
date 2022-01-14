<?php
include 'models/model.spielplan12klasse.php'
?>
<table>
    <tr class="th">
    <th>Gruppe 1</th>
    <th>Klassenname</th>
    <th>Teamname</th>
</tr>
    <main>
    <?php
foreach($sign_ups as $sign_up)  { ?>
<?php
if ($sign_up['post_class'] == '1,2Klasse') {?>
<?php
if ($sign_up['post_group'] == 1) {?>
<tr>
    <th> </th>
    <th><?= htmlspecialchars($sign_up['post_classname'])?></th>  
    <th><?= htmlspecialchars($sign_up['post_teamname'])?></th>
</tr>
<?php } ?>
<?php } ?>
<?php
} ?>
</table>
<table>
    <tr class="th">

<th>Gruppe 2</th>
    <th>Klassenname</th>
    <th>Teamname</th>
</tr>
    <main>
    <?php
foreach($sign_ups as $sign_up)  { ?>
<?php
if ($sign_up['post_class'] == '1,2Klasse') {?>
<?php
if ($sign_up['post_group'] == 2) {?>
<tr>
    <th> </th>
    <th><?= htmlspecialchars($sign_up['post_classname'])?></th>  
    <th><?= htmlspecialchars($sign_up['post_teamname'])?></th>
</tr>
<?php } ?>
<?php } ?>
<?php
} ?>
</table>
<?php
$stmt = $pdo->query('SELECT * FROM `matchplan`');
$matchplans = $stmt->fetchALL(); 
?>
    <table>
    <tr class="th">
        <th>Zeit</th>
    <th>Heimteam</th>
    <th> </th>
    <th>Gastteam</th>
    <th>Platz</th>
</tr>
    <main>
    <?php
foreach($matchplans as $matchplan)  { ?>
<?php
if ($matchplan['post_class'] == '1,2Klasse') {?>
<tr>
    <th><?= htmlspecialchars($matchplan['post_time'])?></th> 
    <th><?= htmlspecialchars($matchplan['post_team'])?></th>  
    <th>vs.</th>
    <th><?= htmlspecialchars($matchplan['post_otherteam'])?></th>
    <th><?= htmlspecialchars($matchplan['post_place'])?></th>
</tr>
<?php } ?>
<?php
} ?>
</table>
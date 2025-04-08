<h2>Lista de usuários (<?php echo count($users) ?>)</h2>

<ul>
    <?php foreach ($users as $user) { ?>        
        <li><?php echo "$user->firstName $user->lastName" ?> | <a href=<?php echo "/user/show/{$user->id}"?> <?php echo $user->id ?>>Ver dados</a></li> 
    <?php } ?> 
</ul>

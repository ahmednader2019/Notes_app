<?php

//  $connection = require_once('./connectionn.php');
//  $currentNote = [
//         'id'  => '',
//         'title' => '',
//         'description' => ''
//  ];
// if(isset($_GET['id'])){
//     $currentNote = $connection->getNoteById($_GET['id']);
// }
// $notes = $connection->getNotes();

$connection = require_once("./connection.php");
$notes = $connection->getNotes();
$currentNote = [
    'id' => '',
    'title' => '',
    'description' => ''
];

if(isset($_GET['id'])){
    $currentNote = $connection->getNoteById($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App </title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 
            <div>
                <form class = "new-note" action ="create.php" method="post" >
                <input type="hidden" name="id" value="<?php echo $currentNote['id']; ?>">
                <input type="text" name="title" placeholder="Note title" autocomplete="off" value="<?php echo $currentNote['title']?>">
                <textarea name="description" cols="30" rows="4"  placeholder="description"><?php echo $currentNote['description'] ?></textarea>
                <button >
                    <?php if ($currentNote['id']): ?>
                        <div class="update" id="update">Update note</div>
                    <?php else: ?>
                        <div class="new" id="new">New note</div>
                    <?php endif ?>
                 </button>  
             </form>
             <form class = "new-note" action ="deleteAll.php" method="post" >
                <button>
                <div class="delete" id="delete">Delete All Notes</div>
                </button>
             </form>
            <div class="notes">
                <?php foreach($notes as $note): ?>
                    <div class="note">
                        <div class="title">
                            <a href="?id=<?php echo $note['id']?> " ><?php echo $note['title'];?></a>
                        </div>
                        <div class="Description">
                            <?php echo $note['description']?>
                        </div>
                        <small><?php echo $note['create_date']?></small>
                        <form action="deletee.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $note['id'] ?>">
                        <button class="close">X</button>
                    </form>
                    </div>
                <?php endforeach;?>
            </div>
      
</body>
</html>
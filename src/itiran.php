<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/itiran.css" />
    <title>muscle</title>
</head>
<body>
    <div class="head">
        <h1>MUSCLE</h1>
    </div>
    <button class="t" onclick="location.href='toroku.php'">新規登録</button>
        
    <?php
        require 'db.php';        
        $sql=$pdo->query('select * from muscle inner join category on muscle.c_id=category.c_id order by muscle.c_id');
        echo '<table>';
        echo '<tr><th>カテゴリー</th><th>種目</th></tr>';
        foreach($sql as $row){
            echo '<tr>';
            echo '<td>',$row['c_name'],'</td>';
            echo '<td><a href="shosai.php?id=',$row['m_id'],'">',$row['m_name'],'</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    ?>
    
    <div class="image">
        <img src="image/y.png" alt="">
    </div>
    </body>
</html>
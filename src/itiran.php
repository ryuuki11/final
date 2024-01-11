<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>muscle</title>
</head>
<body>
        
    <?php
        require 'db.php';        
        $sql=$pdo->query('select * from muscle inner join category on muscle.c_id=category.c_id');
        echo '<table>';
        echo '<tr><th>カテゴリー</th><th>種目</th></tr>';
        foreach($sql as $row){
            echo '<tr>';
            echo '<td>',$row['c_name'],'</td>';
            echo '<td>',$row['m_name'],'</td>';
            echo '</tr>';
        }
        echo '</table>';
    ?>
    </body>
</html>
<?php session_start()?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/toroku.css" />
    <title>muscle</title>
</head>
<body>
<div class="head">
        <h1>MUSCLE</h1>
    </div>
        
    <?php
        require 'db.php';        
        
        if ((((isset($_POST["update"]))&&($_POST["update"] == $_SESSION["chkno"]))||((isset($_POST['delete']))&&($_POST["delete"] == $_SESSION["chkno"]))) && (isset($_SESSION["chkno"]))){
            $num=1;
            if(isset($_POST['update'])){
                $mess='更新しました';
                $sql=$pdo->prepare('update  muscle set m_name=?,c_id=? where m_id=?');
                $sql->execute([$_POST['name'],$_POST['category'],$_GET['id']]);
            }else{
                $mess='削除しました';
                $sql=$pdo->prepare('delete from muscle where m_id=?');
                $sql->execute([$_GET['id']]);
            }
        }else{
            $num=0;
        }

        $sql=$pdo->prepare('select * from muscle inner join category on muscle.c_id=category.c_id where m_id=?');
        $sql->execute([$_GET['id']]);

        $_SESSION["chkno"] = $chkno = mt_rand();
        $option=$pdo->query('select * from category');
        foreach($sql as $row){
            echo '<form method="post" class="f">';
            echo '<p>部位';
            echo '<select name="category">';
                foreach($option as $r){
                    if($row['c_id']!=$r['c_id']){
                        echo '<option value="',$r['c_id'],'">',$r['c_name'],'</option>';
                    }else{
                        echo '<option value="',$r['c_id'],'" selected>',$r['c_name'],'</option>';
                    }
                }
            echo '</select>';
            echo '</p>';
            echo '<p>種目<input type="text" name="name" value="',$row['m_name'],'"></p>';
            echo '<button name="update" value="',$_SESSION['chkno'],'">更新</button>';
            echo '<button name="delete" value="',$_SESSION['chkno'],'">削除</button>';
            echo '</form>';
        }
        echo '<a href="itiran.php"><button class="b2">一覧画面へ</button></a>';
        echo '<div class="backv"></div>';
        echo '<div class="display_none">';
        echo '<p>',$mess,'</p>';
        echo '<a href="itiran.php"><button>一覧画面へ</button></a>';
        if(isset($_POST['update'])){
            echo '<a href="shosai.php?id=',$_GET['id'],'"><button>閉じる</button></a>';
        }
        echo '</div>';

    ?>
    <div class="image">
    <img src="image/y.png" alt="">
    </div>
        <script>
            const displayNone = document.querySelector('.display_none');
            const back = document.querySelector('.backv');
            let num = <?php echo $num; ?>;
            console.log(num);
            if(num==1){
                    displayNone.style.visibility = 'visible';
                    back.style.visibility = 'visible';
                
            };      
        </script>
    </body>
</html>
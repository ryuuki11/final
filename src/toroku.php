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
        $mess='';
        if ((isset($_POST["toroku1"])) && (isset($_SESSION["chkno"])) && ($_POST["toroku1"] == $_SESSION["chkno"])){
            $num=1;
            if(!(empty($_POST['name']))){
                $mess='種目を追加しました';
                $sql=$pdo->prepare('insert into muscle (m_name,c_id) values(?,?)');
                $sql->execute([$_POST['name'],$_POST['category']]);
            }else{
                $mess='情報を入力してください';
            }
        }else if ((isset($_POST["toroku2"])) && (isset($_SESSION["chkno"])) && ($_POST["toroku2"] == $_SESSION["chkno"])){
            $num=1;
            $sql=$pdo->prepare('select c_name from category where c_name=?');
            $sql->execute([$_POST['category1']]);
            $a=$sql->fetchAll();
            if(empty($a)){
                if(!(empty($_POST['category1']))){
                    $mess='カテゴリーを追加しました';
                    $sql=$pdo->prepare('insert into category (c_name) values(?)');
                    $sql->execute([$_POST['category1']]);
                }else{
                    $mess='情報を入力してください';
                }
            }else{
                $mess='すでに登録されています';
            }
        }else{
            $num=0;
        }

        $_SESSION["chkno"] = $chkno = mt_rand();

        $sql=$pdo->query('select * from category');

        echo '<div class="area">';
        echo '<input class="check" type="radio" name="tab_name" id="tab1" checked>';
        echo '<label class="tab_class" for="tab1">種目</label>';
        echo '<div class="content_class">';
            echo '<form method="post">';
            echo '<p>部位';
            echo '<select name="category">';
            foreach($sql as $row){
            echo '<option value="',$row['c_id'],'">',$row['c_name'],'</option>';
            }
            echo '</select>';
            echo '</p>';
            echo '<p>種目<input type="text" name="name"></P>';
            
            echo '<button name="toroku1" value="',$_SESSION['chkno'],'">登録</button>';
            echo '</form>';
        echo '</div>';
        echo '<input class="check" type="radio" name="tab_name" id="tab2" >';
        echo '<label class="tab_class" for="tab2">カテゴリー</label>';
        echo '<div class="content_class">';
            echo '<form method="post">';
            echo '<p>部位<input type="text" name="category1"></P>';
            echo '<button name="toroku2" value="',$_SESSION['chkno'],'">登録</button>';
            echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '<a href="itiran.php"><button class="b1">一覧画面へ</button></a>';
        

        echo '<div class="backv"></div>';
        echo '<div class="display_none">';
        echo '<p>',$mess,'</p>';
        if(!(empty($_POST['name'])) || !(empty($_POST['category1']))){
            echo '<a href="itiran.php"><button>一覧画面へ</button></a>';
        }
        echo '<br><div class="button"><a href="toroku.php"><button class="close">閉じる</button></a></div>';
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
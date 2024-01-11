<?php session_start()?>
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
        $mess='';
        if ((isset($_POST["cartb"])) && (isset($_SESSION["chkno"])) && ($_POST["toroku"] == $_SESSION["chkno"])){
            $num=1;
            if(isset($_POST['name'])&&isset($_POST['category'])){
                $mess='種目を追加しました';
                $sql=$pdo->prepare('insert into Cart (m_id,s_id,c_date,c_piece) values(?,?,CURRENT_DATE(),?)');
                $sql->execute([$_SESSION['member']['id'],$_SESSION['shohin_shosai']['id'],$_POST['piece']]);
            }else{
                $mess='情報を入力してください';
            }
        }else{
            $num=0;
        }

        $_SESSION["chkno"] = $chkno = mt_rand();


        echo '<form method="post">';
        echo '部位<input type="text"><br>';
        echo '種目<input type="text">';
        echo '<button name="toroku" value="',$_SESSION['chkno'],'">登録</button>';
        echo '</form>';

        echo '<div class="backv"></div>';
        echo '<div class="display_none">';
        echo '<p>',$mess,'</p>';
        if(isset($_SESSION['member']['id'])){
            echo '<a href="../cart/cart1.php"><button>カートへ</button></a>';
        }else{
            echo '<a href="../login/login.php"><button>ログイン画面へ</button></a>';
        }
        echo '<br><div class="button"><a href="shosai.php?id=',$_GET['id'],'"><button class="close">閉じる</button></a></div>';
        echo '</div>';

    ?>

        <script>
            const displayNone = document.querySelector('.display_none');
            const cartb = document.querySelector('.cartb');
            const closeb = document.querySelector('.close');
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
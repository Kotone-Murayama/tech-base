<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_5-1</title>
    </head>
    <center><body>
        <div style = "background-color:yellow"><h1><center>掲示板</center></h1></div>
        
        <div class="box2"><p><center>オヂサンに聞きたいことは、あるカナ<span>！？</span>😄</center></p></div>
        
        <style>
            span{
                color:red;
                font-weight: bold;
            }
            
        </style>
        <?php
        #データベースへの接続
        $dsn = 'データベース名';
        $user = 'ユーザー名';
        $password = 'パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $date = date("Y-m-d H:i:s");
        
          
        if(!empty($_POST["editnum"])){   
                $editnum=$_POST["editnum"];                                     #$editnumに編集対象番号を代入
               
                $sql = 'SELECT * FROM ninomiyalove WHERE id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $editnum, PDO::PARAM_INT);
                $stmt->execute();
                $results = $stmt->fetchAll();
                foreach ($results as $row){
                //$rowの中にはテーブルのカラム名が入る
                $editname = $row['name'];
                $editstr = $row['comment'];
                $editpassword = $row['password'];
                echo "<hr>";
                }
                
                $editpassword=$_POST["editpassword"];
                if($password == $editpassword){                                  #投稿番号と編集番号が同じとき
                $id = $num; //変更する投稿番号
                $sql = 'UPDATE ninomiyalove SET name=:name,comment=:comment,password=:password, date=:date WHERE id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':comment', $str, PDO::PARAM_STR);
                $stmt->bindParam(':password', $edit_password, PDO::PARAM_STR);
                $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                $stmt->bindParam(':id', $editnum, PDO::PARAM_INT);
                $stmt->execute();
                            
                        }
                
                }                                      
            
        
            if(empty($_POST["editnum"])){
                $editname="";
                $editstr="";
                $editnum="";
                
            }
            
        ?>
        <section>
            <h2><center>新規投稿</center></h2>
        <form action="#" method="post">
            <center><input type="text" name="name" placeholder="名前" value="<?php echo $editname;?>">
            <input type="text" name="str" placeholder="コメント" value="<?php echo $editstr;?>">
            <input type="text" name="password" placeholder="パスワード">
            <input type="submit" name="submit">
            
            
            <input type="hidden" name="editednum" placeholder="編集対象番号パート2" value="<?php echo $editnum;?>"><br>
            
            <input type = "num" name = "deletenum" placeholder = "削除対象番号">
            <input type="text" name="deletepassword" placeholder="パスワード">
            <input type = "submit" name = "delete" value = "削除"><br>
            
            <input type = "num" name = "editnum" placeholder = "編集対象番号">
            <input type="text" name="editpassword" placeholder="パスワード">
            <input type = "submit" name = "edit" value = "編集"></center>
            
            
        </form>
        </section>
        <section>
            <div style = "background-color:yellow">
                <marquee scrollamount="30"><h2>投稿一覧</h2></marquee></div>
        </section>
        <?php
        
            if(!empty($_POST["name"]) && !empty($_POST["str"] && !empty($_POST["password"]))){                
                $password=$_POST["password"];                                                                #名前とコメントの送信があり、編集対象番号にはないとき
                $name=$_POST["name"];                                           #$nameに名前を代入
                $str=$_POST["str"];                                             #$strにコメントを代入
                $password=$_POST["password"];
                
                
                $sql = $pdo -> prepare("INSERT INTO ninomiyalove (name, comment, date, password) VALUES (:name, :comment,:date,:password)");
                $sql -> bindParam(':name', $name, PDO::PARAM_STR);
                $sql -> bindParam(':comment', $str, PDO::PARAM_STR);
                $sql -> bindParam(':password', $password, PDO::PARAM_STR);
                $sql -> bindParam(':date', $date, PDO::PARAM_STR);
                $sql -> execute();
                //bindParamの引数名（:name など）はテーブルのカラム名に併せるとミスが少なくなります。最適なものを適宜決めよう。
            }
                
    
            if(!empty($_POST["deletenum"])){                                    #削除対象番号に記入があれば
                    $deletenum=$_POST["deletenum"];                             #$deletenumに削除対象番号を代入
                    $deletepassword=$_POST["deletepassword"];
                    $sql = 'SELECT * FROM ninomiyalove';
                    $stmt = $pdo->query($sql);
                    $results = $stmt->fetchAll();
                    foreach ($results as $row){
                     //$rowの中にはテーブルのカラム名が入
                    $id=$row['id'];
                    $password=$row['password'];
                    
                    if($deletenum==$id && $deletepassword==$password){
                        $sql = 'DELETE from ninomiyalove where id=:id';
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                        $stmt->execute();
                    }
                    }
    
                    }
                   
            
            $sql = 'SELECT * FROM ninomiyalove';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            echo "<br><br>";
            echo $row['id'].'<br>';
            echo $row['name'].'<br>';
            echo $row['comment'].'<br>';
            echo $row['date'];
            }
    
         
            
            
                 

        ?>
    </body></center>
</html>
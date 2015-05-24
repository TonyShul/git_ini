<!DOCTYPE html>
<html>
    <body>
        <form action method="POST">
            <input type = "text" name= "product">
            <input type = "submit" value="Add product">
        </form>

        <?php

        function addProduct($name) {
            $list = getProductList();
            array_push($list, $name);
            $newList = serialize($list);
            file_put_contents("list.txt", $newList);
        }
        ?>  
        <?php
        if (!empty($_POST ["product"])) {
            addProduct($_POST ["product"]);
        }
        ?>

        <?php
        if ($_GET['action'] == "del" && !empty($_GET['name'])) {
            delList($_GET['name']);
        }
        ?>
        <?php

        function getProductList() {
            $list = array();
            $listData = file_get_contents("list.txt");
            if (!empty($listData)) {
                $list = unserialize($listData);
            }
            return $list;
        }
        ?>        
<?php $getList = getProductList(); ?>

        <ul>
            <?php foreach ($getList as $value): ?>
            <li><?php echo $value; ?> <input type="checkbox" name="selprod"> <a href ="index.php?action=del&name=<?php echo $value; ?>" >remove</a></li>
<?php endforeach; ?>
        </ul>

        <input type = "button" name="delSev" value="Delete">



        <?php

        function delList($name) {
            $listArr = getProductList();
            $key = array_search($name, $listArr);
            if ($key !== false) {
                unset($listArr[$key]);
                $list = serialize($listArr);
                file_put_contents("list.txt", $list);
            }
        }
        ?>

       <?php
       
    //  function delSever(){
    //      
    //   }
       
       ?>
       
        
    </body>

</html>

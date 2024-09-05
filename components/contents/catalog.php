<?php
    $query = "SELECT * FROM categories";
    $res = mysqli_query($conn, $query);
?>
<content class="catalog-content">
<h2 class="catalog-h2">Выберите категорию товара</h2>
    <div class="category">
        <?php
            while($row = mysqli_fetch_array($res)){
                //print_r($row['Category_name']);
                $output = "<a href='category.php?category=$row[category_ID]' class='category-ancor'> $row[Category_name] <a>";
                print_r($output);
            } 
        ?>
    </div>
</content>
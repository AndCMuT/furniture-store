<?php
    $query = "SELECT * FROM products AS prts 
                JOIN countries ON prts.Country_ID=countries.Country_ID
                JOIN materials ON prts.Material_ID=materials.Material_ID
                JOIN colors ON prts.Color_ID=colors.Color_ID
                JOIN Prices ON prts.Product_ID=Prices.Product_ID
                WHERE date_start <= CURRENT_TIMESTAMP
                AND date_start = (SELECT MAX(date_start) FROM Prices WHERE Product_ID=prts.Product_ID)";


    if (isset($_GET['category'])) {
        $cat = $_GET['category'];
        $query .= " AND Category_ID=$_GET[category]";
        $get_cat_name = "SELECT Category_name FROM categories WHERE Category_ID=$cat";
        $cat_res = mysqli_query($conn, $get_cat_name);
        $cat_row = mysqli_fetch_array($cat_res);
            if($cat_row) {
                $cat_name = $cat_row['Category_name'];
                $h2 = "Товары категории $cat_name";
            }
            else {
                $h2 = "Категория не найдена";
            }
    }
   
    $res = mysqli_query($conn, $query);
?>
<content class="page-products">
<h2><?php print_r($h2); ?></h2>  
<?php
    while ($row = mysqli_fetch_array($res)) {
        $output = "<div class='product'>
            <div class='image-description'>
                <img src='Images/$row[image_name]' alt='$row[image_name]'>
                <div class='characteristic'>
                    <p>Страна производитель: $row[Country_name]</p>
                    <p>Материал: $row[Material_name]</p>
                    <p>Цвет: $row[Color_name]</p>
                    <p>Габариты: $row[width]x$row[depth]x$row[height]</p>
                </div>
                <div class='description'>
                    <p><b>$row[Product_name]</b></p>
                    $row[Description]
                </div>
            </div>
            <div class='btn-details-buy'>
                <p>$row[price] руб</p>
                <a href='#' class='btn-deatais'>Купить</a>
                <a href='product.php?product=$row[Product_ID]' class='btn-deatais'>Подробнее</a>
            </div>
        </div>";
    print_r($output);
    }
?>
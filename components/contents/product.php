<?php
    $query = "SELECT * FROM products AS prts 
                JOIN countries ON prts.Country_ID=countries.Country_ID
                JOIN materials ON prts.Material_ID=materials.Material_ID
                JOIN colors ON prts.Color_ID=colors.Color_ID
                JOIN Prices ON prts.Product_ID=Prices.Product_ID
                WHERE date_start <= CURRENT_TIMESTAMP
                AND date_start = (SELECT MAX(date_start) FROM Prices WHERE Product_ID=prts.Product_ID)";

    if (isset($_GET['product'])) {
        $prod = $_GET['product'];
        $query .= " AND prts.Product_ID=$prod";

    }

    $res = mysqli_query($conn, $query);
?>


<content class="product-page">
    <?php
        $row = mysqli_fetch_array($res); 
        $output = "
        <h2>$row[Product_name]</h2>
        <img src='./Images/$row[image_name]' alt='$row[image_name]' class='product-image'>
        <div class='product-price'>$row[price]</div>
        <div class='product-charct'>
            <div class='charct'>Страна производитель: $row[Country_name]</div>
            <div class='charct'>Материал: $row[Material_name]</div>
            <div class='charct'>Габариты: $row[width]x$row[depth]x$row[height]</div>
            <div class='charct'>Цвет: $row[Color_name]</div>
        </div>
        <div class='product-description'>$row[Description]</div>
    <button type='submit' class='buy-btn'>Купить</button>";
    print_r($output);
    ?>
</content>
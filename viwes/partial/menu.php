<!DOCTYPE html>
<?php
$menu = [
        ['name' => "Home", 'link' => '/'],
        ['name'=> "Catalog", 'kink' => '/catalog']
];
?>
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <?php foreach ($menu as $item):?>
                <li class="active"><a href="<?=$item['link']?>"><?=$item['name']?></a></li>
                <?php endforeach;?>
            </ul>
<!--                <li><a href="#">Hot Deals</a></li>-->
<!--                <li><a href="#">Categories</a></li>-->
<!--                <li><a href="#">Laptops</a></li>-->
<!--                <li><a href="#">Smartphones</a></li>-->
<!--                <li><a href="#">Cameras</a></li>-->
<!--                <li><a href="#">Accessories</a></li>-->
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
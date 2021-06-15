<!DOCTYPE html>
<html lang="en">
<head>
<?php
    include_once("./lib-loader.php");

    $loader = new LibLoader(echoes_on);
    $loader->set_errors(errors_on);
    
    $loader->get_library('nav-menu-colorlib-v17');
    $loader->get_library('lb-banner');

    // set header
    $nav_menu = $loader->get_instance_of('NavMenuColorlibV17');
    $nav_menu->set_logo("LibLoader");
    $nav_menu->set_tagline("As you sow, so shall you reap!");
    $nav_menu->set_socials(
        array(
            "Facebook"=>"https://www.facebook.com",
            "Twitter"=>"https://www.twitter.com",
            "LinkedIn"=>"https://www.linkedin.com",
            "Instagram"=>"https://www.instagram.com",
        )
    );
    $nav_menu->set_menu_items(
        array(
            "Home"=>"#",
            "About"=>"#about",
            "Services"=> array(
                    "self" => "#service",
                    "Service 1"=>"#service1",
                    "Service 2"=>"#service2",
                    "Service 3"=>"#service3"
                ),
            "Products" => array(
                "self" => "#self",
                "Product 1"=>"#product1",
                "Product 2"=>"#product2",
                "Product 3"=>"#product3",
                "Product 4"=>"#product4",
                "Product 5"=>"#product5"
            ),
            "Contact Us"=>"#contact"
            )
    );

    // set banner
    $banner = $loader->get_instance_of('LbBanner');
    $banner->set_slider_images(
        array(
            "./library/lb-banner/1.jpg"=> array(
                "alt"=> "image1",
                "caption"=> "Caption 1"
            ),
            "./library/lb-banner/2.jpg"=> array(
                "alt"=> "image2",
                "caption"=> "Caption 2"
            ),
            "./library/lb-banner/3.jpg"=> array(
                "alt"=> "image3",
                "caption"=> "Caption 3"
            ),
            "https://wallpapercave.com/wp/wp2046360.jpg"=> array(
                "alt" => "scsa",
                "caption" => "dscvsdv"
            )
        )
    );
    $banner->set_slider_interval(100000);

    
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        $nav_menu->set_style(array("PRIMARY_COLOR"=>"blue", "SECONDARY_COLOR"=> "violet"));
        $nav_menu->get_style();
        $banner->set_style(array("BANNER_NAVIGATON_BUTTONS_BGCOLOR"=>"rgba(50,20,80, 0.4)", "BANNER_CAPTIONS_COLOR"=>"rgba(50,20,80, 0.4)"));
        $banner->get_style();
    ?>
    <style>
        body{
            background-color: #fafafa;
        }
    </style>
</head>
<body>
    <?php
        $nav_menu->execute();
        $banner->execute();
        // $loader->envelope("menus", $nav_menu);
        // $loader->envelope("banner", $banner);
        $loader->stop();
    ?>
</body>
</html>
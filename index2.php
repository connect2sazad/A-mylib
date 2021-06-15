<?php
    include_once("./lib-loader.php");

    $loader = new LibLoader(echoes_on);
    $loader->set_errors(errors_on);
    $loader->get_library('nav-menu-colorlib-v17');

    $nav_menu = $loader->get_instance_of('NavMenuColorlibV17');
    // $nav_menu->set_style(array("PRIMARY_COLOR"=>"blue", "SECONDARY_COLOR"=>"violet"));
    $nav_menu->get_style();
    $nav_menu->set_logo("LibLoader");
    $nav_menu->set_tagline("As you sow, so shall you reap!");
    $nav_menu->set_socials(
        array(
            "Facebook"=>"https://www.facebook.com",
            "Twitter"=>"https://www.twitter.com",
            "LinkedIn"=>"https://www.linkedin.com",
            "Behance"=>"https://www.behance.com",
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
                "Product 1"=>"#product1",
                "Product 2"=>"#product2",
                "Product 3"=>"#product3",
                "Product 4"=>"#product4",
                "Product 5"=>"#product5"
            ),
            "Contact Us"=>"#contact"
            )
    );
    $nav_menu->execute();
    
    $loader->stop();
?>
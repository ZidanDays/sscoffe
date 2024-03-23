<?php
@$page = $_GET['q'];
if (!empty($page)) {
    switch ($page) {

            // beranda
        case 'beranda':
            include './pages/beranda/beranda.php';
            break;

            // shop
        case 'shop':
            include './pages/shop/shop.php';
            break;

            // shop-detail
        case 'shop-detail':
            include './pages/shop-detail/shop-detail.php';
            break;

            // cart
        case 'cart':
            include './pages/cart/cart.php';
            break;

            // cart
        case 'cart_add':
            include './pages/cart/cart_add/cart_add.php';
            break;

            // cart
        case 'cart_delete':
            include './pages/cart/cart_delete/cart_delete.php';
            break;

            // status
        case 'status':
            include './pages/status/status.php';
            break;

            // status
        case 'status_add':
            include './pages/status/status_add/status_add.php';
            break;

            // status
        case 'status_delete':
            include './pages/status/status_delete/status_delete.php';
            break;

            // chackout
        case 'chackout':
            include './pages/chackout/chackout.php';
            break;

            // chackout
        case 'proses_chackout':
            include './pages/chackout/proses_chackout/proses_chackout.php';
            break;

            // testimonial
        case 'testimonial':
            include './pages/testimonial/testimonial.php';
            break;

            // 404
        case '404':
            include './pages/404/404.php';
            break;

            // contact
        case 'contact':
            include './pages/contact/contact.php';
            break;
    }
} else {
    include './pages/beranda/beranda.php';
}
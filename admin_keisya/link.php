<?php
@$page = $_GET['q'];
if (!empty($page)) {
    switch ($page) {

        case 'beranda':
            include './pages/beranda/beranda.php';
            break;

            // MENU HOME
        case 'homes':
            include './pages/homes/homes.php';
            break;

        case 'add_produk':
            include './pages/homes/add_produk/add_produk.php';
            break;

        case 'edit_produk':
            include './pages/homes/edit_produk/edit_produk.php';
            break;

        case 'delete_produk':
            include './pages/homes/delete_produk/delete_produk.php';
            break;
            // END MENU HOME

            // MENU MAKANAN
        case 'menu_makanan':
            include './pages/menu_makanan/menu_makanan.php';
            break;

        case 'add_produk_makanan':
            include './pages/menu_makanan/add_produk_makanan/add_produk_makanan.php';
            break;

        case 'edit_produk_makanan':
            include './pages/menu_makanan/edit_produk_makanan/edit_produk_makanan.php';
            break;

        case 'delete_produk_makanan':
            include './pages/menu_makanan/delete_produk_makanan/delete_produk_makanan.php';
            break;
            // END MENU MAKANAN

            // MENU MINUMAN
        case 'menu_minuman':
            include './pages/menu_minuman/menu_minuman.php';
            break;

        case 'add_menu_minuman':
            include './pages/menu_minuman/add_menu_minuman/add_menu_minuman.php';
            break;

        case 'edit_menu_minuman':
            include './pages/menu_minuman/edit_menu_minuman/edit_menu_minuman.php';
            break;

        case 'delete_menu_minuman':
            include './pages/menu_minuman/delete_menu_minuman/delete_menu_minuman.php';
            break;
            // END MENU MINUMAN

            // Section 4
        case 'section4':
            include './pages/section4/section4.php';
            break;

        case 'add_section4':
            include './pages/section4/add_section4/add_section4.php';
            break;

        case 'edit_section4':
            include './pages/section4/edit_section4/edit_section4.php';
            break;

        case 'delete_section4':
            include './pages/section4/delete_section4/delete_section4.php';
            break;
            // END SECTION 4

            // Best Produk
        case 'bestproduk':
            include './pages/bestproduk/bestproduk.php';
            break;

        case 'add_bestproduk':
            include './pages/bestproduk/add_bestproduk/add_bestproduk.php';
            break;

        case 'edit_bestproduk':
            include './pages/bestproduk/edit_bestproduk/edit_bestproduk.php';
            break;

        case 'delete_bestproduk':
            include './pages/bestproduk/delete_bestproduk/delete_bestproduk.php';
            break;
            // Best Produk

            // User
        case 'user':
            include './pages/user/user.php';
            break;
            // User
        case 'edit_user':
            include './pages/user/edit_user/edit_user.php';
            break;
            // User
        case 'delete_user':
            include './pages/user/delete_user/delete_user.php';
            break;
    }
} else {
    include './pages/beranda/beranda.php';
}
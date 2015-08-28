<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //HOME PAGE
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__."/../views"
    ));

    $app->get("/", function() use ($app){
        return $app['twig']->render('index.html.twig');
    });

    //ALL BRANDS
    $app->get("/brands", function() use ($app){
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->post("/brands", function() use ($app){
        $name = $_POST['name'];
        $brand = new Brand($name);
        $brand->save();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->post("/delete_brands", function() use ($app){
        Brand::deleteAll();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    //ALL STORES
    $app->get("/stores", function() use ($app){
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/stores", function() use ($app){
        $store = new Store($_POST['name'], $_POST['location'], $_POST['hours'], $_POST['phone'], $_POST['website']);
        $store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/delete_stores", function() use ($app){
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    //INDIVIDUAL BRAND
    $app->get("/brands/{id}", function($id) use ($app){
        $brand = Brand::find($id);
        $stores = $brand->getStores();
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $stores));
    });

    $app->post("/add_stores", function($id) use ($app){

    });

    //INDIVIDUAL STORES
    $app->get("/stores/{id}", function($id) use ($app){
        $store = Store::find($id);
        $brands = $store->getBrands();
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $brands));
    });

    $app->get("/stores/{id}/edit", function($id) use ($app){
        $store = Store::find($id);
        $brands = $store->getBrands();
        return $app['twig']->render('store_edit.html.twig', array('store' => $store, 'brands' => $brands));
    });

    $app->delete("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    return $app;
?>

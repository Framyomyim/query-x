<?php 

    use QueryX\Support\Loader;
    use Bramus\Router\Router;
    
    $router = new Router();

    # Set 404 Page
    $router->set404(function() {
        die(Loader::view('errors.404'));
    });

    # Make your route
    $router->get('/', function() {
        Loader::controller('HomeController@index');
    });

    # Run route
    $router->run();

?>
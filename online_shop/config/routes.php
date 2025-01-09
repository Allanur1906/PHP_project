<?php
$routes = [
    "online_shop/login" => ["AuthController", "login_view"],
    "online_shop/register" => ["AuthController", "register_view"],
    "online_shop/post_register" => ["AuthController", "register"],

    "online_shop/login_post" => ["AuthController", "login_post"],
    "online_shop/logout" => ["AuthController", "logout"],

    "online_shop/users/index" => ["UserController", "index"],
    "online_shop/users" => ["UserController", "store"],
    "online_shop/users/{id}/delete" => ["UserController", "delete"],
    "online_shop/users/{id}/update" => ["UserController", "update"],
    "online_shop" => ["UserController", "index"],
    "online_shop/products" => ["ProductController", "store"],// for saving products
    "online_shop/products/index" => ["ProductController", "index"],
    "online_shop/products/{id}/delete" => ["ProductController", "delete"],
    "online_shop/products/{id}/update" => ["ProductController", "update"],
];

class Router {
    private $uri;

    public function __construct() {
        // Get the current URI
        $this->uri = trim($_SERVER["REQUEST_URI"], "/");
    }
    
    public function direct() {
        global $routes;
//controlllaryn methody cagyramak
        foreach ($routes as $uri => $route) {
            // Replace the dynamic parts like {id} with a regular expression
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $uri);
            // Match the current URI against the pattern
            if (preg_match("#^$pattern$#", $this->uri, $matches)) {
                // Extract the controller and method
                [$controller, $method] = $route;

                // Pass the extracted parameters (like IDs) to the controller method
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Load the controller file if not autoloaded
                require_once "app/controllers/{$controller}.php";
                
                // Call the method with the parameters
                return $controller::$method(...array_values($params));
            }
        }
        
        require_once "app/views/404.php";
    }
}

?>
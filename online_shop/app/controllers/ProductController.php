<?php
require_once("app/models/Product.php");

require_once "BaseController.php";


class ProductController  extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }


        #protect etmek ucin
    public static function index() {
        if(!isset($_SESSION["user_id"])){ // check if session has user id, if exists continue, otherwise redirect to login
            header("Location: /online_shop/login");
            exit();
        }
        $products = Product::getAllProduct();
        
        require_once "app/views/products/index.php";
    }

    public static function store() {
        $post = self::xss($_POST);
        $category = $post['category'];
        $name = $post['name'];
        $price = $post['price'];

        $product_insertion = Product::create($category, $name, $price);

        session_start();
        if(!$product_insertion){
            $_SESSION['message'] = 'Error occurred during product creation!';
            $_SESSION['message_type'] = 'error'; // Optional
        } else {
            $_SESSION['message'] = 'Product created successfully!';
            $_SESSION['message_type'] = 'success';
        }
        header("Location: /online_shop/products/index");
    }

    public static function delete($id)
    {
        // Ensure the ID is valid and exists in the database
        $product = Product::findById($id);

        if ($product) {
            // Call the model to delete the product
            $delete_result = Product::delete($id);

            session_start();
            if ($delete_result) {
                $_SESSION['message'] = 'Product deleted successfully!';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Error occurred during product deletion!';
                $_SESSION['message_type'] = 'error';
            }
        } else {
            session_start();
            $_SESSION['message'] = 'Product not found!';
            $_SESSION['message_type'] = 'error';
        }

        // Redirect to the product list page
        header("Location: /online_shop/products/index");
        exit();
    }

    public static function update($id){
        $post = self::xss($_POST);
        $category = $post['category'];
        $name = $post['name'];
        $price = $post['price'];

        // Call the model method to update the product
        $product_updated = Product::update($id, $category, $name, $price);

        session_start();
        if ($product_updated) {
            $_SESSION['message'] = 'Product updated successfully!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Error occurred during product update!';
            $_SESSION['message_type'] = 'error';
        }

        // Redirect to the product list page
        header("Location: /online_shop/products/index");
        exit();


    }




}
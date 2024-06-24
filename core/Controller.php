<?php 
class Controller{
    protected string $layout;
    public function __construct(){
        Session::ouvrir();
        $this->layout = "base";
    }
    public function renderView(string $view ,array $data){
        // var_dump( $data);
        ob_start();
        extract($data);
        // echo '<pre>';
        // print_r(get_defined_vars());
        // echo '</pre>';
        require_once("../views/$view.html.php");
        $contentView=ob_get_clean();
        require_once("../views/layout/$this->layout.layout.php");
}
public function rendirectToRoute(string $path){
    header("Location: " . WEBROOT . "?$path");
    exit();
}
}
?>
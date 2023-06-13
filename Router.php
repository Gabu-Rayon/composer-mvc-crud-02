<?php 


namespace app;


class Router {
    public array $getRoutes = []; 
     public array $postRoutes = []; 

     public Database $db;

     public function __construct(){
      
      $this->db = new Database();
      
     }

     
  public function get($url,$fn){
    
      $this->getRoutes[$url] = $fn;
  }  
   public function post($url,$fn){
    
       $this->postRoutes[$url] = $fn;
  }  
  public function resolve(){   
    
        /*********
         *@Gabu-Rayon 
         
         @virtualHost for setting up local virtual Host 
         
         
          */  
          
    $currentUrl  = $_SERVER['PATH_URI'] ??  '/';

     if (strpos($currentUrl,'?') !== false) {
      
       $currentUrl = substr($currentUrl ,0, strpos($currentUrl,'?'));
    
      }

    
    
    // $currentUrl  = $_SERVER['PATH_INFO'] ??  '/';
    $method= $_SERVER['REQUEST_METHOD'];
    
    
    if ($method ==='GET') {
        
    $fn = $this->getRoutes[$currentUrl]  ?? null ; 
    
    }else {
        
        $fn = $this->postRoutes[$currentUrl]  ?? null; 
        
    }

    if ($fn) {
        
     call_user_func($fn,$this);
       
    }else {
        
       echo "Page not found"; 
       
    }   
  
  }
  public function renderView($view,$params = []){

    foreach ($params as $key => $value) {
      $$key = $value;

    }
        // we use output cache method for _layout
       ob_start();
        include __DIR__."/views/$view.php";
        $content  = ob_get_clean();
        include __DIR__."/views/_layout.php";
    }
}
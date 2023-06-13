<?php 


namespace app;
use app\models\Product;
use PDO;

class Database{
    public PDO $pdo;
   //instantiate of database to access public
    public static Database $db;

    
    public function __construct(){
    $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=betechatours_scandiweb_db', 'betechatours_gibson','@Nelsonel01');
    // this->pdo = new PDO('mysql:host=localhost;port=3306;dbname= composer_crud_db_01', 'root','123#@!??SiteA');
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     self::$db = $this;
   
   
    }


    public function getProducts($search = ''){
        if ($search) {
            $statement = $this->pdo->prepare('SELECT * FROM products WHERE title like :search ORDER BY create_at DESC');
            $statement->bindValue(":search", "%$search%");
        } else {
            $statement = $this->pdo->prepare('SELECT * FROM products ORDER BY create_at DESC');
        }
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

   
   ///To get product id froom database for product to be updated
    public function getProductById($id){
        
        $statement = $this->pdo->prepare('SELECT * FROM products WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }


     public function updateProduct(Product $product){
        
         $statement = $this->pdo->prepare("UPDATE products SET title = :title,image = :image,description = :description,price = :price WHERE id = :id");
        $statement->bindValue(':title', $product->title);
        $statement->bindValue(':image', $product->imagePath);
        $statement->bindValue(':description', $product->description);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':id', $product->id);

        $statement->execute();
    }
    
    public function deleteProduct($id){
        
        $statement = $this->pdo->prepare('DELETE FROM products WHERE id = :id');
        $statement->bindValue(':id', $id);

        return $statement->execute();
    }

     public function createProduct(Product $product){
        
         $statement = $this->pdo->prepare("INSERT INTO products (title, image, description, price, create_at)
                VALUES (:title, :image, :description, :price, :date)");
        $statement->bindValue(':title', $product->title);
        $statement->bindValue(':image', $product->imagePath);
        $statement->bindValue(':description', $product->description);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));

        $statement->execute();
     }
}
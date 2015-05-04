<?php

require 'class/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim([
    //modif du chemin pour le dossier templates
    'templates.path' => 'templates'
]);

$app->get('/emprunteur', 'getProducts');
$app->get('/emprunteur/:idemprunteur', 'getProduct');
$app->post('/emprunteur', 'addProduct');
$app->put('/emprunteur/:idemprunteur', 'updateProduct');
$app->delete('/emprunteur/:idemprunteur', 'deleteProduct');
$app->delete('/emprunteur/:idemprunteur', 'deleteAll');

$app->get('/user', 'getUsers');

$app->run();


function getProducts() {

    $sql = "SELECT idemprunteur, nom, prenom, age FROM emprunteur";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $product = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($product);
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function getProduct($id) {
    $sql = "SELECT * FROM emprunteur WHERE idemprunteur=:idemprunteur";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("idemprunteur", $id);
        $stmt->execute();
        $Product = $stmt->fetchObject();
        $db = null;
        echo json_encode($Product);
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function addProduct() {
    $request = Slim\Slim::getInstance()->request();
    $Product = json_decode($request->getBody());
    $sql = "INSERT INTO emprunteur (nom, prenom, date_naissance) VALUES (:nom, :prenom, :date_naissance)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nom", $Product->nom);
        $stmt->bindParam("prenom", $Product->prenom);
        $stmt->bindParam("date_naissance", $Product->date_naissance);
        $stmt->execute();
        //$Product->nom = $db->lastInsertId();
        $db = null;
        echo json_encode($Product);
    } catch (PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function updateProduct($id) {
    $request = Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $Product = json_decode($body);
    $sql = "UPDATE emprunteur SET nom=:nom, prenom=:prenom WHERE idemprunteur=:idemprunteur";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nom", $Product->nom);
        $stmt->bindParam("prenom", $Product->prenom);
        $stmt->bindParam("idemprunteur", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($Product);
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function deleteProduct($id) {
    $sql = "DELETE FROM emprunteur WHERE idemprunteur=:idemprunteur";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("idemprunteur", $id);
        $stmt->execute();
        $db = null;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function deleteAll($id) {
    $sql = "DELETE FROM emprunteur WHERE idemprunteur=:idemprunteur";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("idemprunteur", $id);
        $stmt->execute();
        $db = null;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function getUsers() {

    $sql = "SELECT nom, prenom, photo FROM utilisateur";
    try {
        $db = getConnection2();
        $stmt = $db->query($sql);
        $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        for($i=0; $i<sizeof($product); $i++){
            if (strpos($product[$i]['photo'],"PNG") !== false){
                $product[$i]['photo'] = base64_encode($product[$i]['photo']);
            }
        }
                    
        $db = null;
        echo json_encode($product);
    }
    catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function getConnection() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "location";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->query('SET NAMES utf8');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbh;
}
function getConnection2() {
    $dbhost = "localhost";
    $dbuser = "adm";
    $dbpass = "";
    $dbname = "camera";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->query('SET NAMES utf8');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbh;
}

?>
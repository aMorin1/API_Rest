<?php

require 'class/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim([
    //modif du chemin pour le dossier templates
    'templates.path' => 'templates'
]);

$app->get('/vehicule', 'getProducts');
$app->get('/vehicule/:immatriculation', 'getProduct');
$app->post('/vehicule', 'addProduct');
$app->put('/vehicule/:idvehicule', 'updateProduct');
$app->delete('/vehicule/:idvehicule', 'deleteProduct');

$app->run();

function getProducts() {

    $sql = "SELECT * FROM vehicule";
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
    $sql = "SELECT * FROM vehicule WHERE immatriculation=:immatriculation";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("immatriculation", $id);
        $stmt->execute();
        $Product = $stmt->fetchObject();
        $db = null;
        echo json_encode($Product);
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function addProduct() {
    error_log('addProduct\n', 3, '/var/tmp/php.log');
    $request = Slim\Slim::getInstance()->request();
    $Product = json_decode($request->getBody());
    $sql = "INSERT INTO (`immatriculation`, `dateMiseCirculation`, `marque`,
            `modele`, `energie`, `releveKm`, `prochaineRevisionKm`)
            VALUES (:immatriculation, :dateMiseCirculation, :marque, :modele, :energie, :releveKm, :prochaineRevisionKm)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("immatriculation", $Product->immatriculation);
        $stmt->bindParam("dateMiseCirculation", $Product->dateMiseCirculation);
        $stmt->bindParam("marque", $Product->marque);
        $stmt->bindParam("modele", $Product->modele);
        $stmt->bindParam("energie", $Product->energie);
        $stmt->bindParam("releveKm", $Product->releveKm);
        $stmt->bindParam("prochaineRevisionKm", $Product->prochaineRevisionKm);
        $stmt->execute();
        $Product->immatriculation = $db->lastInsertId();
        $db = null;
        echo json_encode($Product);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function updateProduct($id) {
    $request = Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $Product = json_decode($body);
    $sql = "UPDATE vehicule SET immatriculation=:immatriculation, dateMiseCirculation=:dateMiseCirculation, marque=:marque,
            modele=:modele, energie=:energie, releveKm=:releveKm, prochaineRevisionKm=:prochaineRevisionKm WHERE idvehicule=:idvehicule";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("immatriculation", $Product->immatriculation);
        $stmt->bindParam("dateMiseCirculation", $Product->dateMiseCirculation);
        $stmt->bindParam("marque", $Product->marque);
        $stmt->bindParam("modele", $Product->modele);
        $stmt->bindParam("energie", $Product->energie);
        $stmt->bindParam("releveKm", $Product->releveKm);
        $stmt->bindParam("prochaineRevisionKm", $Product->prochaineRevisionKm);
        $stmt->bindParam("idvehicule", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($Product);
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function deleteProduct($id) {
    $sql = "DELETE FROM vehicule WHERE idvehicule=:idvehicule";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("idvehicule", $id);
        $stmt->execute();
        $db = null;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function getConnection() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "azerty";
    $dbname = "location";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->query('SET NAMES utf8');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbh;

}

?>

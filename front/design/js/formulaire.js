'use strict';
(function () {

  //Initialisation du module AngularJS et du module xeditable.
  var app = angular.module('EmprunteurA', ["xeditable"]);

  //Controleur principal de l'app AngularJS
  app.controller('emprunteurCtrl', function ($scope, $http) {
    //$scope.tableEmp = false;
    // Déclaration de l'URL du Serveur REST
    var url = 'http://localhost/API_Rest/back/emprunteur';
    $scope.emprunteur=[];

    //Méthode GET -> Récupérer et afficher les données
    $scope.init=function(){
      $http.get(url)
        .success(function(resultat) {
          $scope.emprunteur = resultat;
          setTimeout($scope.initCheck,1000);
      });
    };
    $scope.init();

    //Méthode DELETE -> Suppression d'un élement
    $scope.removeEmp = function(index, nom, prenom){
      if (window.confirm("Êtes vous sur de vouloir supprimer l'utilisateur : " + nom + " " + prenom + " ?")){
        $scope.emprunteur.splice(index, 1);
        var urlDel = url + '/' + this.emp.idemprunteur;
        $http.delete(urlDel);
      }
    };

    //Méthode POST -> Ajouter un élement dans la base
    $scope.addEmp = function () {
      $scope.emprunteur.push({
        nom: this.emp.nom,
        prenom: this.emp.prenom

      });
      $http.post(url,{
        nom: this.emp.nom,
        prenom: this.emp.prenom
      });
      $scope.emp =[];
      $scope.init();
    };

    //Méthode PUT -> MàJ d'un élément
    $scope.updateEmp = function () {
      var urlUpd = url + '/' + this.emp.idemprunteur;
      $http.put(urlUpd,{
        nom: this.emp.nom,
        prenom: this.emp.prenom
      });
    };

//Checkboxs et fonctions de suppression
//Initialisation des checkboxs
  $scope.initCheck=function(){
    for(var i=0;i<$scope.emprunteur.length;i++)
    {
      $scope.emprunteur[i].checkedd=false;
    }
  };

//Regarde si des checkboxs sont cochées ou pas
  $scope.checkeddAll=function()
  {
    var check1=$scope.emprunteur[0].checkedd;
    for(var i=1;i<$scope.emprunteur.length;i++)
    {
      if($scope.emprunteur[i].checkedd!=check1)
        return true;
    }
    return false;
  };

//Cocher tous les checkboxs
$scope.checkAll= function(){
  var checkeddAll=$scope.checkeddAll();
  if(!checkeddAll){
    for(var i=0;i<$scope.emprunteur.length;i++)
        $scope.emprunteur[i].checkedd=!$scope.emprunteur[i].checkedd;
  }
  else if(checkeddAll && $scope.selectedAll){
    for(var i=0;i<$scope.emprunteur.length;i++)
        $scope.emprunteur[i].checkedd=true;
  }
  else{
    for(var i=0;i<$scope.emprunteur.length;i++)
        $scope.emprunteur[i].checkedd=false;
  }
};

//Supprimer les élements cochés
$scope.DeleteAll= function(){
  if (window.confirm("Êtes vous sur de vouloir supprimer le(s) utilisateur(s) ?")){
    for(var i=0; i<$scope.emprunteur.length;i++){
      if($scope.emprunteur[i].checkedd===true){
        var urlDel = url + '/' + $scope.emprunteur[i].idemprunteur;
        $http.delete(urlDel);
        $scope.emprunteur.splice(i, 1);
        i--;
        }
    }
}

};

});
})();

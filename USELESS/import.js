'use strict';
(function () {

    //Initialisation du module AngularJS et du module xeditable.
    var app = angular.module('EmprunteurA', ["xeditable", "ngDialog"]);

    //Controleur principal de l'app AngularJS
    app.controller('emprunteurCtrl', function ($scope, $http, ngDialog) {
      // Déclaration de l'URL du Serveur REST
      var url = 'http://localhost/API_Rest/back/vehicule';

      //Méthode GET -> Récupérer et afficher les données
       $http.get(url)
                .success(function(resultat) {
                  $scope.emprunteur = resultat;
                });

      //Méthode DELETE -> Suppression d'un élement
        $scope.removeEmp = function(index){
            $scope.emprunteur.splice(index, 1);
            var urlDel = url + '/' + this.emp.idemprunteur;
            $scope.clickToOpen = function () {
            ngDialog.open({ template: 'popupTmpl.html'});};
            $http.delete(urlDel);
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
      };
    //Méthode PUT -> MàJ d'un élément
      $scope.updateEmp = function () {
          var urlUpd = url + '/' + this.emp.idemprunteur;
          $http.put(urlUpd,{
            nom: this.emp.nom,
            prenom: this.emp.prenom
          });
        };


    });
})();

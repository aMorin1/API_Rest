'use strict';
(function () {

    var app = angular.module('EmprunteurA', []);

    app.controller('emprunteurCtrl', function ($scope, $http) {

       $http.get('http://localhost/API_Rest/back/emprunteur')
                .then(function(resultat) {
                  $scope.emprunteur = resultat.data;
                });

        $scope.removeEmp = function(index, id){
            $scope.emprunteur.splice(index, 1);
            var del = 'http://localhost/API_Rest/back/emprunteur/';
            del += id;
            alert("Vous êtes sur le point de supprimer l'utilisateur: " + del);
            http.delete(del);
          };

        $scope.addEmp = function () {
            $scope.emprunteur.push({
                nom: this.emp.nom,
                prenom: this.emp.prenom

            });
            $http.post('http://localhost/API_Rest/back/emprunteur',{
              nom: this.emp.nom,
              prenom: this.emp.prenom
            });
        };

      $scope.updateEmp = function (index) {
            $scope.emprunteur[index]["nom"];
            $scope.emprunteur[index]["prenom"];
            $("#nom").val($scope.emprunteur[index]["nom"]);
            $("#prenom").val($scope.emprunteur[index]["prenom"]);
        };


    });
})();

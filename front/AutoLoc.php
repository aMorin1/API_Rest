<!DOCTYPE html>
<html ng-app="EmprunteurA" class="ng-scope  -webkit-">

<?php include("header.php"); ?>

<body align="center" ng-controller="emprunteurCtrl" class="ng-scope" id="background">
   <!-- NAVBAR -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><i class="fa fa-car"></i> AutoLoc</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/Portofil">Portfolio</a></li>
                    <li><a href="/CameraBadge/">CameraBadge</a></li>
                </ul>
            </div>
        </div>
    </nav>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="col-xs-4">
        <div class="well">
        <legend>Filtrer</legend>
        <fieldset><div class="form-group"><input class ="search" ng-model="searchText" placeholder="Filtrer par nom ou prénom..." /></div></fieldset>
      </div>
        <form name="formEmp" ng-submit="addEmp()" id="formEmp" class="well">
          <legend>Ajout d'un emprunteur</legend>
          <fieldset>
            <div class="form-group" ng-class="{'has-error':formEmp.nom.$error.required, 'has-success':formEmp.nom.$valid}">
              <label for="nom">Nom de l'emprunteur</label>
              <input type="text" name="nom" id="nom" class="form-control" ng-model="emp.nom" required/>
            </div><br>
            <div class="form-group" ng-class="{'has-error':formEmp.prenom.$error.required, 'has-success':formEmp.prenom.$valid}">
              <label for="prenom">Prénom de l'emprunteur</label>
              <input type="text" name="prenom" id="prenom"  class="form-control" ng-model="emp.prenom" required/>
            </div><br/>
            <div class="form-group" ng-class="{'has-error':formEmp.datenaissance.$error.required || formEmp.datenaissance.$error.pattern, 'has-success':formEmp.datenaissance.$valid}">
               <label for="datenaissance">Date de naissance</label>
                <input type="text" name="datenaissance" id="datenaissance" class="form-control" ng-model="emp.date_naissance" required ng-pattern="/^((0[1-9])|([1-2][0-9])|(3[0-1]))\/((0[1-9])|(1[0-2]))\/[1-2][0-9]{3}$/"/>
                <p class="help-block">Entrez une date au format français : jj/mm/aaaa</p>
            </div>
              <button class="btn btn-primary" type="submit" data-toggle="popover" data-placement="bottom" data-content="L'utilisateur a bien été ajouté."><span class="glyphicon glyphicon-ok-sign elem-demo"></span> Ajouter</button>
          </fieldset>
        </form>
      </div>
      <!--<a class="btn btn-primary" style="margin-right: 380px;" href="#" ng-click="tableEmp = !tableEmp" ng-class="{ active: tableEmp }"><span class="glyphicon glyphicon-chevron-down"></span> Afficher le tableau <span class="glyphicon glyphicon-chevron-down"></span></a><br><br>-->
      <div class="col-sm-6 table-responsive">
        <table id="tDonnees" class="table table-bordered table-condensed table-striped table-hover">
          <thead>
            <tr class="active">
              <th>Cocher tout <br><input id="mark-all" type="checkbox" ng-model="selectedAll" ng-change="checkAll()" class="ng-valid ng-dirty"></th>
              <th style="display:none;">ID</th>
              <th>Nom de l'emprunteur</th>
              <th>Prénom de l'emprunteur</th>
              <th>Age</th>
              <!--<td id="tdSup"></td>-->
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="emp in emprunteur | filter:searchText as results">
              <td><input id="chkbox" class="mark ng-pristine ng-valid" type="checkbox" ng-model="emp.checkedd" ng-checked="selectedAll" ng-click="checkedIndex(emp)"></td>
              <td style="display:none;">{{emp.idemprunteur}}</td>
              <td><span editable-text="emp.nom" e-name="nom" e-form="rowform">{{emp.nom}}</span></td>
              <td><span editable-text="emp.prenom" e-name="prenom" e-form="rowform">{{emp.prenom}}</span></td>
              <td><span  e-name="age" e-form="rowform">{{emp.age}}</span></td>
              <td class="tdEdit">
               <form editable-form onaftersave ="updateEmp()" name="rowform" ng-show="rowform.$visible" class="form-buttons form-inline formEdit" shown="inserted == emp">
                  <button type="submit" ng-disabled="rowform.$waiting" ng-click="updateEmp()" class="btn btn-primary btn-sm editable-submit">
                    <span class="glyphicon glyphicon-floppy-saved"></span>
                  </button>
                  <button type="button" ng-disabled="rowform.$waiting" ng-click="rowform.$cancel()" class="btn btn-danger">
                    <span class="glyphicon glyphicon-floppy-remove"></span>
                </button>
                </form>
                <div class="buttons" ng-show="!rowform.$visible">
                  <button class="btn btn-primary" ng-click="rowform.$show()">
                    <i class="fa fa-pencil-square-o"></i>
                  </button>
                  <button id="supp" class="btn btn-danger" ng-click="removeEmp($index, emp.nom, emp.prenom)">
                    <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                </td>
            </tr>
          </tbody>
        </table>
        <div ng-show="!results.length">Il n'y a pas d'emprunteur correspondant!</div><br>
        <button id="suppAll" class="btn btn-danger" ng-click="DeleteAll()">Supprimer tous les élements cochés</button>
      </div>
    </div>
  </div>
</body>
</html>

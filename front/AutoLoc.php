<!DOCTYPE html>
<html ng-app="EmprunteurA" class="ng-scope">

<?php include("header.php"); ?>

<body align="center" ng-controller="emprunteurCtrl" class="ng-scope">
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
            <div class="form-group">
              <label for="nom">Nom de l'emprunteur</label>
              <input type="text" name="nom" id="nom" class="form-control" ng-model="emp.nom" ng-pattern="/^([a-z]||[A-Z])/" ng-class="{'has-error':formEmp.nom.$error.required, 'has-success':formEmp.nom.$valid}"/>
            </div><br>
            <div class="form-group">
              <label for="prenom">Prénom de l'emprunteur</label>
              <input type="text" name="prenom" id="prenom"  class="form-control" ng-model="emp.prenom"/>
            </div>
            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-sign"></span> Ajouter</button>
          </fieldset>
        </form>
      </div>
      <!--<a class="btn btn-primary" href="#" ng-click="tableEmp = !tableEmp" ng-class="{ active: tableEmp }"><span class="glyphicon glyphicon-chevron-down"></span> SPOILER <span class="glyphicon glyphicon-chevron-down"></span></a><br><br>-->
      <div class="col-xs-5 row-fluid">
        <table class="table table-bordered table-hover">
          <thead>
            <tr class="active">
              <th><input id="mark-all" type="checkbox" ng-model="selectedAll" ng-change="checkAll()" class="ng-valid ng-dirty"></th>
              <th style="display:none;">ID</th>
              <th>Nom de l'emprunteur</th>
              <th>Prénom de l'emprunteur</th>
              <!--<td align="center">Supprimer</td>-->
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="emp in emprunteur | filter:searchText as results">
              <td><input id="chkbox" class="mark ng-pristine ng-valid" type="checkbox" ng-model="emp.checkedd" ng-checked="selectedAll" ng-click="checkedIndex(emp)"></td>
              <td style="display:none;">{{emp.idemprunteur}}</td>
              <td><span editable-text="emp.nom" e-name="nom" e-form="rowform">{{emp.nom}}</span></td>
              <td><span editable-text="emp.prenom" e-name="prenom" e-form="rowform">{{emp.prenom}}</span></td>
              <td>
                <form editable-form onaftersave ="updateEmp()" name="rowform" ng-show="rowform.$visible" class="form-buttons form-inline" shown="inserted == emp">
                  <button type="submit" ng-disabled="rowform.$waiting" ng-click="updateEmp()" class="btn btn-primary btn-sm editable-submit">
                    <span class="glyphicon glyphicon-floppy-saved"></span>
                  </button>&nbsp;
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

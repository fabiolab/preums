preums.controller('preumsCtrl', function($scope, alertes){

	$scope.data = {};
	$scope.data.alertes = alertes.info;

	alertes.getAlertes();
	
	$scope.supprimer = function(id){
		alertes.delAlerte(id);
	};

	$scope.ajouter = function(titre, url, email){
		alertes.addAlerte(titre, url, email);
	};
});
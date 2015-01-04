preums.factory('alertes', function($http){

	var alertesObj = {};
	alertesObj.info = {'liste':[]}

	alertesObj.getAlertes = function(){
		$http.get('http://localhost/preums/api/getAnnonces.php').
			success(function(data, status, headers, config) {
				// console.log(data[0]);
				alertesObj.info.liste = data;
			}).
			error(function(data, status, headers, config) {
				console.log(data);

			});
	};

	alertesObj.delAlerte = function(id){
		$http.get('http://localhost/preums/api/delAnnonce.php?id='+id).
			success(function(data, status, headers, config) {
				// console.log(data);
				alertesObj.getAlertes();
			}).
			error(function(data, status, headers, config) {
				console.log(data);
			});
	};

	alertesObj.addAlerte = function(titre, url, email){
		body = {};
		body.titre = titre;
		body.url = url;
		body.email = email;
		console.log(body);
		$http.post('http://localhost/preums/api/addAnnonce.php', body).
			success(function(data, status, headers, config) {
				// console.log('ok : '+body);
				alertesObj.getAlertes();
			}).
			error(function(data, status, headers, config) {
				// console.log('ko : '+body);
				console.log(data);

			});
	};

	return alertesObj;

});
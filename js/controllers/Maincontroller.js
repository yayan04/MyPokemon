app.controller('MainController', ['$scope', 'Mainfactory', function ($scope, Mainfactory) {

    $scope.ShowPageStart = function () {
        $scope.ShowPokemon_Main = true;
        $scope.ShowPokemon_Detail = false;
        $scope.ShowPokemon_MyPokemonList = false;

        $scope.statusNav1 = 'Active';
        $scope.statusNav2 = '';

        $scope.dataManualPokemon = [];

        Mainfactory.getPokemonAll().success(function (data) {
            // $scope.listPokemon = data;
            console.log(data);

            for (i in data.results) {
                Mainfactory.getPokemonDetail(data.results[i].url).success(function (res) {
                    $scope.dataManualPokemon.push(res);
                });
            }
            console.log('datamanual', $scope.dataManualPokemon);

        });
    };

    $scope.ShowPageStart();

    //======== DETAIL POKEMON ==============//

    $scope.detailPokemon = function (id) {
        $scope.ShowPokemon_Main = false;
        $scope.ShowPokemon_Detail = true;
        $scope.ShowPokemon_MyPokemonList = false;


        Mainfactory.getMyPokemonList().success(function (res2) {
            console.log(res2)
            var strId = id.toString();
            var a = res2.findIndex(x => x.Pokemon_ID === strId);
            console.log(a);
            if (a >= 0) {
                $scope.isHide = true;

            } else {
                $scope.isHide = false;

            }
            console.log($scope.isHide);

        });

        Mainfactory.getPokemonDetailId(id).success(function (res) {
            $scope.dataPokemon = res;
            console.log('Detail Pokemon=>', res);
        });

    };

    $scope.CatchPokemon = function () {
        var success = Math.random();
        console.log(success);

        if (success > 0.5) {
            // alert('Success catch the Pokemon !!');
            Swal.fire({
                title: 'Success catch the Pokemon !!',
                icon: 'success',
                confirmButtonText: 'OK'
            })
            $scope.idModal = '#ModalPokemon';
        } else {
            // alert('Sorry, you failed catch the Pokemon');
            Swal.fire({
                title: 'Sorry, you failed catch the Pokemon',
                icon: 'error',
                confirmButtonText: 'OK'
            })
            $scope.idModal = null;
        }
    }

    $scope.insertData = function () {
        var data = {
            'Pokemon_ID': $scope.dataPokemon.id,
            'Name': $scope.dataPokemon.name,
            'Nickname': $scope.Nickname
        };

        console.log(data);

        Mainfactory.postMyPokemonList(data).then(function successCallback(response) {
            if (response.data.length > 0) {
                Swal.fire({
                    title: 'Success inserted to My Pokemon List',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            }
            else {
                alert('Record not inserted.');
            }
        });

        $scope.ShowPageStart();
        $scope.Nickname = "";

    }

    //==================== MY POKEMON LIST ==================//

    $scope.Mypokemonlist = function () {
        $scope.ShowPokemon_Main = false;
        $scope.ShowPokemon_Detail = false;
        $scope.ShowPokemon_MyPokemonList = true;

        $scope.statusNav1 = '';
        $scope.statusNav2 = 'Active';

        // console.log('aaaaaa')
        $scope.dataPokemonList = [];

        Mainfactory.getMyPokemonList().success(function (res) {
            console.log(res);

            for (i = 0; i < res.length; i++) {
                var idPok = parseInt(res[i].Pokemon_ID);
                // console.log(idPok);
                Mainfactory.getPokemonDetailId(idPok).success(function (res2) {
                    $scope.dataPokemonList.push(res2);
                    // console.log('res2',res2);
                });
            }

            console.log('aaa', $scope.dataPokemonList);

        });
    }

}]);

//================ SERVICES =====================//

app.service('Mainfactory', ['$http', function ($http) {

    this.getPokemonAll = function () {
        return $http.get('https://pokeapi.co/api/v2/pokemon/');
    };

    this.getPokemonDetail = function (url) {
        return $http.get(url);
    };

    this.getPokemonDetailId = function (id) {
        return $http.get('https://pokeapi.co/api/v2/pokemon/' + id);
    };

    this.postMyPokemonList = function (data) {
        console.log('Masuk service ga', data)
        return $http.post("insertMyPokemon.php", data);
    };

    this.getMyPokemonList = function () {
        return $http.get("selectMyPokemon.php");
    };

}]);
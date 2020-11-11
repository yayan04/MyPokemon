<!DOCTYPE html>
<html lang="en">

<head>
    <title>POKEMON</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.6/angular.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="js/App.js"></script>
    <script src="js/controllers/Maincontroller.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <style>
        .card:hover {
            -webkit-box-shadow: inset 0 1px 1px rgba(27, 23, 23, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
        }

        img.rounded {
            width: 270px;
            height: 270px;
            margin: 20px 10px 10px 20px;
        }
    </style>

</head>

<body ng-app="FirstApp" ng-controller="MainController">
    <div class="fixed-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item {{statusNav1}}">
                        <a class="nav-link" href="" ng-click="ShowPageStart()">Home</a>
                    </li>
                    <li class="nav-item {{statusNav2}}">
                        <a class="nav-link" href="" ng-click="Mypokemonlist()">My Pokemon List</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container">
        <div ng-show="ShowPokemon_Main" class="container">
            <div class="jumbotron jumbotron-fluid">
                <div class="container" style="margin-top: 40px;">
                    <h1 class="display-2" style="text-align: center; font-weight: 500;">POKEMON</h1>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-4">
                <div class="col mb-4" ng-repeat="item in dataManualPokemon | orderBy: 'id'">
                    <div class="card h-100">
                        <div style="margin: 10px 10px 10px 10px"></div>
                        <center>
                            <a ng-click="detailPokemon(item.id)"><img ng-src={{item.sprites.other.dream_world.front_default}} class="card-img-top" alt="" style="width: 150px;height: 150px;"></a>
                            <div class="card-body" style="text-transform: uppercase;">
                                <h5 class="card-title">{{item.name}}</h5>
                                <p><span class="badge badge-success" ng-repeat="tipe in item.types" style="margin-right: 5px;">{{tipe.type.name}}</span></p>
                                <!-- <button class="btn btn-primary" style="width: 100%;"
                                    ng-click="detailPokemon(item.id)">Detail</button> -->
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <hr>
            <nav aria-label="...">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    <li class="page-item active"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div ng-show="ShowPokemon_Detail" class="row">
            <div class="col-md-12">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container" style="margin-top: 40px;">
                        <h1 class="display-4" style="text-align: center; text-transform: capitalize; font-weight: 500;">
                            {{dataPokemon.name}}</h1>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img ng-src={{dataPokemon.sprites.other.dream_world.front_default}} class="rounded float-left" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body" style="text-transform: uppercase;">
                                <h5 class="card-title">Abilities</h5>
                                <p class="card-text"><span class="badge badge-info" ng-repeat="items in dataPokemon.abilities" style="margin-right: 5px;">{{items.ability.name}}</span></p>
                                <h5 class="card-title">Types</h5>
                                <p class="card-text"><span class="badge badge-success" ng-repeat="tipe in dataPokemon.types" style="margin-right: 5px;">{{tipe.type.name}}</span></p>
                                <h5 class="card-title">Moves</h5>
                                <p class="card-text"><span class="badge badge-secondary" ng-repeat="moving in dataPokemon.moves" style="margin-right: 5px;">{{moving.move.name}}</span></p>
                                <button class="btn btn-warning" style="width: 100%; font-weight: bold;" ng-hide={{isHide}} ng-click="CatchPokemon()" data-toggle="modal" data-target={{idModal}} > Catch the
                                    Pokemon</button>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <div ng-show="ShowPokemon_MyPokemonList" class="container">
            <div class="jumbotron jumbotron-fluid">
                <div class="container" style="margin-top: 40px;">
                    <h1 class="display-3" style="text-align: center; font-weight: 500;">MY POKEMON LIST</h1>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-4">
                <div class="col mb-4" ng-repeat="item3 in dataPokemonList | orderBy: 'id'">
                    <div class="card h-100">
                        <div style="margin: 10px 10px 10px 10px"></div>
                        <center>
                            <a ng-click="detailPokemon(item3.id)"><img ng-src={{item3.sprites.other.dream_world.front_default}} class="card-img-top" alt="" style="width: 150px;height: 150px;"></a>
                            <div class="card-body" style="text-transform: uppercase;">
                                <h5 class="card-title">{{item3.name}}</h5>
                                <p><span class="badge badge-success" ng-repeat="tipe in item3.types" style="margin-right: 5px;">{{tipe.type.name}}</span></p>
                                <!-- <button class="btn btn-primary" style="width: 100%;"
                                    ng-click="detailPokemon(item3.id)">Detail</button> -->
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <hr>
            <nav aria-label="...">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    <li class="page-item active"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="modal" id="ModalPokemon" aria-labelledby="ModalPokemonLabel">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalPokemonLabel">Give the Pokemon Nickname</h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> -->
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nickname</label>
                                <input type="text" class="form-control" id="nickname" ng-model="Nickname">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-primary" data-dismiss="modal" ng-click="insertData()" value="Save">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
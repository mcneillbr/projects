<!DOCTYPE html>
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8" />
	<title>Avaliação</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-resource.min.js"></script>
	<style type="text/css">
	div#panel-app-todo-list
	{
		margin: 50px auto 0px auto;
		padding: 0px;
		width: 900px;
		background-color: transparent;
	}
	div#container-todo-list
	{
		margin: 0px;
		padding: 0px;
		width: 900px;
		height: 600px;
		overflow: auto;
		background-color: Cornsilk;
	}
	.container-tdList
	{
		float: left;
		margin: 10px;
		padding: 2px;
		width: 130px;
		height: 130px;
		overflow: auto;
		background-color: BurlyWood;
	}
	.destaque
	{
		border: 2px solid #1E90FF;
	}
	</style>
</head>
<body ng-app="appTodoList"  >
	<nav class="navbar navbar-default" role="navigation" ng-controller="navCtrl" id="pageNav">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand">Lista de Tarefas - Ações -></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#" ng-click="createTodo()">Criar</a></li>
			<li class="active"><a href="#" ng-click="updateTodo()">Editar</a></li>
			<li class="active"><a href="#" ng-click="deleteTodo()">Deletar</a></li>
			 <li class="active"><a href="#" ng-click="viewTodo()">Listar</a></li>
          </ul>
        </div>
      </div>
    </nav>
	<div id="panel-app-todo-list" ng-controller="appTodoListCtrl">
		<div id="container-frm-login">
		<form class="form-inline" id="frmLogin">
			<div class="form-group">
				<label class="sr-only" for="nome">Nome</label>
				<input type="text" class="form-control" id="nome" ng-model="nome" placeholder="Nome">
			</div>
			<div class="form-group">
				<label class="sr-only" for="nome">E-mail</label>
				<input type="email" class="form-control" id="email" ng-model="email" placeholder="E-mail">
			</div>
			<div class="form-group">
			<button type="button" class="btn btn-default" ng-click="UsrLogin_OnClick()">Acessar</button>	
			</div>
			
		</form>
		
		</div>
		<div id="container-todo-list">
			<div id="todo-text-{{todolist.tdId}}" ng-click="todoList_OnClick(todolist.tdId)" ng-repeat="todolist in todoListData" class="container-tdList">{{todolist.text}}</div>
		</div>
		<div class="modal fade" id="todoModal" role="dialog" aria-labelledby="Todo List">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="fechar"><span aria-hidden="true"></span></button>
				<h4 class="modal-title">Todo List</h4>
			  </div>
			  <div class="modal-body">
				<textarea id="text-todo" row="5" cols="80"></textarea>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-primary" ng-click="SaveTodoList_OnClick()">Save</button>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
<script>
	
	var usersService = angular.module('userService', ['ngResource']);

	usersService.factory('Users', ['$resource',
		function($resource)
		{
			return $resource('./usrservice.php/', {}, 
			{
				//query: {method:'GET', params:{usrId:'email', usrname: 'nome'}, isArray:true} //
				query: {method:'GET', params:{'cmd': 'login'}, isArray:false}
				,'insert': {method:'GET', params:{'cmd': 'insert'}, isArray:false}
				,'update': {method:'GET', params:{'cmd': 'update'}, isArray:false}
				,'delete': {method:'GET', params:{'cmd': 'delete'}, isArray:false}
			});
		}
	]);
	

	var todoListService = angular.module('mgtodoListService', ['ngResource']);

	todoListService.factory('ManagerTodoList', ['$resource',
		function($resource)
		{
			return $resource('./manager_todolist.php/', {}, 
			{
				//query: {method:'GET', params:{usrId:'email', usrname: 'nome'}, isArray:true} //
				query: {method:'GET', params:{'cmd': 'list'}, isArray:false}
				,'insert': {method:'GET', params:{'cmd': 'insert'}, isArray:false}
				,'update': {method:'GET', params:{'cmd': 'update'}, isArray:false}
				,'delete': {method:'GET', params:{'cmd': 'delete'}, isArray:false}
			});
		}
	]);
	
	
	var app = angular.module('appTodoList', ['userService', 'mgtodoListService']);
	
	
	
	
	app.controller('appTodoListCtrl', function($scope, Users, ManagerTodoList) {
	$scope.nome = "John";
	$scope.email = "mcn@dddd";
	$scope.isUsrLogin = false;
	$scope.usrdata;
	$scope.isEdit = false;
	$scope.todoListActive = 0;
	$scope.todoListData = [{'text': 'dkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkddk', 'tdId': 1}, {'text': 'dkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkdkddk', 'tdId': 2}];
	//
	$scope.SaveTodoList_OnClick = function()
	{
		var t = angular.element('#text-todo').val();
		
		if( $scope.todoListActive == 0)
		{
		
			ManagerTodoList.insert({'todo_text':t, 'email':$scope.email}).$promise.then(function (result) 
			{ 
				angular.element('#todoModal').modal('hide');
				if(result.rstCmd == 'insert_ok')
				{
					$scope.viewTodo();
					alert('registro salvo');
					angular.element('#text-todo').val('');
				}
				//console.info(' result.rstCmd = ' + result.rstCmd);
			});
		}
		else if( $scope.todoListActive > 0)
		{
			if($scope.isEdit)
			{
				ManagerTodoList.update({'todo_text':t, 'todo_id':$scope.todoListActive}).$promise.then(function (result) 
				{ 
					
					if(result.rstCmd == 'update_ok')
					{
						$scope.viewTodo();
						alert('registro atualizado');
						angular.element('#todoModal').modal('hide');
						angular.element('#text-todo').val('');
					}
					//console.info(' result.rstCmd = ' + result.rstCmd);
				});
				$scope.isEdit = false;
			}
			else
			{
				ManagerTodoList.update({'todo_text':t, 'email':$scope.email}).$promise.then(function (result) 
				{ 
					angular.element('#todoModal').modal('hide');
					if(result.rstCmd == 'insert_ok')
					{
						$scope.viewTodo();
						alert('registro salvo');
					}
					//console.info(' result.rstCmd = ' + result.rstCmd);
				});
			}
		}
		
	}
	//
	$scope.todoList_OnClick = function (id){
		
		angular.element('.container-tdList').removeClass('destaque');
		angular.element('#todo-text-'+id).addClass('destaque');
		$scope.todoListActive = id;
		console.info('id = ' + id);
	};
	//
	$scope.UsrLogin_OnClick = function()
	{
		var restObj = Users.query({'name':$scope.nome, 'email':$scope.email}).$promise.then(function(data) 
			{
						$scope.usrdata = data;
						// success
						/*for (var item in  data ) 
						{
						  console.info(' query = ' + item);
						}*/
						
						if(data.rstCmd == 'login_ok')
						{
							$scope.isUsrLogin = true;
							angular.element('#frmLogin').hide();
							$scope.viewTodo();
						}
						else
						{
							data.$insert({'name':$scope.nome, 'email':$scope.email}).then(function (result) 
							{ 
								$scope.isUsrLogin = (result.rstCmd == 'login_ok'); 
								if(!$scope.isUsrLogin)
								{
									alert(" Erro de Nome e ou E-mail !");
								}
								else{
									angular.element('#frmLogin').hide();
									$scope.viewTodo();
								}
								
								//console.info(' result.rstCmd = ' + result.rstCmd);
							});
						}
						//console.info(' $scope.isUsrLogin = ' + $scope.isUsrLogin);											
			},
			function(errResponse) 
			{
				console.info("erro query " + errResponse);
				// fail
			});
		
	};
	$scope.createTodo = function()
	{
		
		if($scope.isUsrLogin)
		{
			angular.element('#todoModal').modal('show');
			console.info("create todo");
		}
	};
	//
	$scope.updateTodo = function()
	{
		if( $scope.todoListActive > 0)
		{
			var t = angular.element('#text-todo').val( angular.element('#todo-text-' + $scope.todoListActive).html()  );
			$scope.isEdit = true;
			angular.element('#todoModal').modal('show');
			console.info("update todo");
		}
	};
	//
	$scope.deleteTodo = function()
	{
		if( $scope.todoListActive > 0)
		{
			ManagerTodoList.delete({'todo_id':$scope.todoListActive}).$promise.then(function (result) 
				{ 
					
					if(result.rstCmd == 'delete_ok')
					{
						$scope.viewTodo();
						alert('registro deletado');
						
					}
					//console.info(' result.rstCmd = ' + result.rstCmd);
				});
			
			console.info("delete todo");
		}
	};
	//
	$scope.viewTodo = function()
	{
		if($scope.isUsrLogin)
		{
		ManagerTodoList.query({'email':$scope.email}).$promise.then(function (result) 
			{ 
				$scope.todoListData = result.viewData;
			});
		console.info("view todo");
		}
	}
	
	//
	});
	
	app.controller('navCtrl', function($scope) 
	{
		$scope.createTodo = function()
		{
			angular.element('#panel-app-todo-list').scope().createTodo();
			
		};
		//
		$scope.updateTodo = function()
		{
			angular.element('#panel-app-todo-list').scope().updateTodo();
		};
		//
		$scope.deleteTodo = function()
		{
			angular.element('#panel-app-todo-list').scope().deleteTodo();
		};
		//
		$scope.viewTodo = function()
		{
			angular.element('#panel-app-todo-list').scope().viewTodo();
		}
	});
</script>
</body>
</html>

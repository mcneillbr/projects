<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<title>Cookie Clicker</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
		<style type="text/css">
		div.quadro
		{
			margin: 10px 25px 20px 25px;
			background-color: #abc456;
			width: 500px;
			heigth: 350px;
		}
		div.quadro > form > div > label
		{
			display: block;
			
		}
		div.quadro > form > div > label > span
		{
			display: inline-block;
			width: 200px;
			padding: 5px;
		}
		</style>
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		
		function calcCookie()
		{
			var qtnCookiesPorClique = 2; 
			
			var C = document.getElementById("txtQtnBis").value;
			var F = document.getElementById("txtQtnFazendasBis").value;
			var X = document.getElementById("txtQtnXBis").value;
			
			//console.info("C = " + C);
			
			var melhorTempo =  doCalcCookies(C, F, X, 0, qtnCookiesPorClique, 0, (X * (1 / qtnCookiesPorClique)));
			
			document.getElementById("panelCookies").innerHTML = "Resultado " + melhorTempo;
			
			//console.info("melhorTempo = " + melhorTempo);			
			
		}
		function doCalcCookies(valC, valF, valX, qtnFazenda, qtnCookiesPorClique, tempoGasto, tempoObjeto)
		{
			qtnCookiesPorClique = 2 + (valF * qtnFazenda); //quantidade de cookies por clique
			var qtnCookiesPorSegundo = (1 / qtnCookiesPorClique); //quantidade de cookies por segundo
			var tempoParaObjetivo = qtnCookiesPorSegundo * valX; // calcula o tempo normal para a quantidade X
			var tempoObjetivo = tempoGasto +  tempoParaObjetivo; //
			var tempoGastoNovo = (tempoGasto + (valC * qtnCookiesPorSegundo));//
			
			/*var debug = "valC = " + valC;
			debug +=  " valF = " + valF;
			debug +=  " valX = " + valX;
			debug +=  " qtnFazenda = " + qtnFazenda;
			debug +=  " qtnCookiesPorClique = " + qtnCookiesPorClique;
			debug +=  " qtnCookiesPorSegundo = " + qtnCookiesPorSegundo;
			debug +=  " tempoGasto = " + tempoGasto;
			debug +=  " tempoParaObjetivo = " + tempoParaObjetivo;
			debug +=  " tempoObjetivo = " + tempoObjetivo;
			debug +=  " tempoGastoNovo = " + tempoGastoNovo;
			
			console.info(debug);
		*/	
					
			if(tempoObjetivo > tempoObjeto)
			{
				return tempoObjeto
			}
			
			return doCalcCookies(valC, valF, valX, (qtnFazenda + 1), qtnCookiesPorClique, tempoGastoNovo, tempoObjetivo);
		}
		
		</script>
	</head>
	<body>
	<div class="quadro">
		<form class="form-inline" role="form">
			<div class="form-group">
			<label class="control-label" for="txtQtnBis"><span>Quantidade de Biscoitos C: </span><input class="form-control" type="text" id="txtQtnBis" name="txtQtnBis" value="" placeholder="0" /></label>
			<label class="control-label" for="txtQtnFazendasBis"><span>Extra F: </span><input class="form-control" type="text" id="txtQtnFazendasBis" name="txtQtnFazendasBis" value="" placeholder="0" /></label>
			<label class="control-label" for="txtQtnXBis"><span>Objetivo X: </span><input class="form-control" type="text" id="txtQtnXBis" name="txtQtnXBis" value="" placeholder="0" /></label>
			</div>
			<div style="width: 100%;">
			<button style="margin: 5px auto 5px auto;" type="button" onclick="calcCookie()" class="btn btn-primary">Enviar</button>
			</div>
		</form>
		<div id="panelCookies">
		
		</div>
	</div>
	</body>
</html>

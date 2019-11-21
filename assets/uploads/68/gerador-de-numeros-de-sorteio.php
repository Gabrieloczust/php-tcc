<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	
	<style>
	*{font: 12px Arial;}
	form{ margin: 0 0 10px 0;}
	input{
		height: 30px;
		width: 120px;
		border-color: #2196f3;
		box-shadow: none;
		border-radius: 10px;
		outline: none;
		text-align: center;
	}
	button{
		width: 150px;
		background: #2196F3;
		height: 40px;
		-webkit-appearance: none;
		text-align: center;
		border: none;
		box-shadow: none;
		color: #fff;
		border-radius: 10px;
		margin: 0 0 0 10px;
		cursor: pointer;
	}
	.tabela{float: left;display:block; width: 595px;}
	.numeros{display: inline-block; margin: 2px; width: 130px;}
	.n{display: block;width: 100%; padding: 17px 0;text-align: center; font: 23px Arial;border: 1px solid #000;box-sizing: border-box;border-style: dashed}
	@media print{
		form{display: none}
	}
	</style>
	
</head>

<body>
	<form method="POST">
		DE
		<input type="number" placeholder="" name="inicial">
		ATÉ
		<input type="number" placeholder="" name="final">
		<button>Gerar Números</button>
	</form>
	<div class="tabela">
		<?php
		if(!EMPTY($_POST)){
			$inicial = $_POST['inicial'];
			$final = $_POST['final'];
			if($inicial > $final){
				$i = $inicial;
				$f = $final;
				$inicial = $f;
				$final = $i;
			}
			for($n = $inicial; $n <= $final; $n++){
		?>
		<div class="numeros">
				<?php 
				for($a = 0; $a < 2; $a++){
				?>
			<div class="n" 
			<?php if($n == 6 || $n == 9 || $n == 66 || $n == 69 || $n == 96 || $n ==99){echo 'style="text-decoration: underline"';} ?>><?= $n ?>
			</div>
				<?php 
				} 
				?>
		</div>
		<?php 
			} 
		}
		else{
			$inicial = '0';
			$final = $inicial;
		}
		?>
	<title>Gerador de Sorteio <?= ' - ' . $inicial . ' a ' .$final ?></title>
	</div>
</body>

</html>
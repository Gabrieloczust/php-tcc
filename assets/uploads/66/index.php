<?php
function fatorial($i)
{
    $fatorial = 1;
    while ($i > 1) {
        $fatorial *= $i;
        $i--;
    }
    return $fatorial;
}

$output = '';
$anagramas = [];

$palavras = file_get_contents("palavras.txt");
$palavras = explode("\n", $palavras);

if ($_POST) :
    $input = $_POST['input'];
    $limpo = preg_replace("/[^A-Za-z ]/", "", $input);
    if ($limpo != $input) :
        $output = "APENAS LETRAS SÃO PERMITIDAS";
    else :
        $output = '$ ./anagrama "' . $limpo . '" <br>';
        $palavra = str_replace(" ", "",  mb_strtoupper($limpo));
        $letras = str_split($palavra);
        $qtdLetras = fatorial(count(($letras)));

        $letrasRepetidas = array_count_values($letras);
        $aux = 1;
        foreach ($letrasRepetidas as $t) :
            $aux *= fatorial($t);
        endforeach;
        $qtdRepetidas = $aux;
        $possibilidades = $qtdLetras / $qtdRepetidas;

        // Adiciona no array todas possibilidades
        do {
            $p = str_shuffle($palavra);
            if (!in_array($p, $anagramas)) {
                array_push($anagramas, $p);
                $possibilidades--;
            }
        } while ($possibilidades > 0);

        // Remove do array as palvras que nao constam em palavras.txt
        foreach ($anagramas as $anagrama) :
            if (array_search($anagrama, $palavras) == false) :
                $key = array_search($anagrama, $anagramas);
                unset($anagramas[$key]);
            endif;
        endforeach;
    endif;
endif;
?>
<form method="POST">
    <input type="text" name="input" pattern="[A-Za-z ]+" title="Apenas letras(sem acento)" required>
    <button type="submit">PESQUISAR</button>
</form>
<?php
echo $output;
sort($anagramas);
foreach ($anagramas as $anagrama) :
    echo $anagrama . "<br>";
endforeach;

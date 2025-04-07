<?php
// Função para calcular a Taxa Metabólica Basal (TMB) utilizando a fórmula de Mifflin-St Jeor
function calcularTMB($peso, $altura, $idade, $sexo) {
    if ($sexo === 'masculino') {
        return 10 * $peso + 6.25 * $altura - 5 * $idade + 5;
    } else {
        return 10 * $peso + 6.25 * $altura - 5 * $idade - 161;
    }
}

// Função para calcular o TDEE (Gasto Diário Total) com base no nível de atividade
function calcularTDEE($tmb, $nivelAtividade) {
    // Fatores de atividade:
    // sedentario: pouco ou nenhum exercício (fator 1.2)
    // leve: exercício leve 1-3 dias/semana (fator 1.375)
    // moderado: exercício moderado 3-5 dias/semana (fator 1.55)
    // intenso: exercício intenso 6-7 dias/semana (fator 1.725)
    // muito_intenso: exercício muito intenso ou trabalho físico pesado (fator 1.9)
    $fatores = [
        'sedentario'    => 1.2,
        'leve'          => 1.375,
        'moderado'      => 1.55,
        'intenso'       => 1.725,
        'muito_intenso' => 1.9
    ];
    $fator = $fatores[$nivelAtividade] ?? 1.2;
    return $tmb * $fator;
}

// Função para ajustar as calorias com base no objetivo, utilizando percentuais seguros
function ajustarCalorias($tdee, $objetivo) {
    switch ($objetivo) {
        case 'manter':
            return $tdee;
        case 'perder':
            // Estudos indicam que um déficit de cerca de 15% é uma abordagem mais sustentável que uma redução fixa de 500 calorias.
            return $tdee * 0.85;  // Aproximadamente 15% a menos
        case 'ganhar':
            // Para ganho de massa magra, um superávit de cerca de 10% é recomendado para evitar acúmulo excessivo de gordura.
            return $tdee * 1.10;  // Aproximadamente 10% a mais
        default:
            return $tdee;
    }
}

// Função para calcular a distribuição de macronutrientes com base nas recomendações científicas atuais
function calcularMacros($calorias, $peso, $objetivo) {
    // Recomendações de proteína (g por kg de peso corporal):
    // - Perder peso: 1.8 a 2.2 g/kg
    // - Manter: 1.6 a 2.0 g/kg
    // - Ganhar: 2.0 a 2.5 g/kg
    $proteina_por_kg = match($objetivo) {
        'perder' => 2.0,
        'manter' => 1.8,
        'ganhar' => 2.2,
        default  => 1.8
    };
    $proteinas = $proteina_por_kg * $peso;
    $caloriasProteinas = $proteinas * 4;

    // Gorduras: recomenda-se que 25-30% das calorias totais venham de gorduras
    $porcentagemGorduras = 0.30;
    $caloriasGorduras = $calorias * $porcentagemGorduras;
    $gorduras = $caloriasGorduras / 9;

    // Carboidratos: as calorias restantes serão de carboidratos
    $caloriasCarboidratos = $calorias - ($caloriasProteinas + $caloriasGorduras);
    $carboidratos = $caloriasCarboidratos / 4;

    return [
        'proteinas'    => round($proteinas),
        'carboidratos' => round($carboidratos),
        'gorduras'     => round($gorduras),
        'calorias'     => round($calorias)
    ];
}

// Coleta os dados do formulário (certifique-se de enviar também o nível de atividade)
$peso = $_POST['peso'] ?? 0;           // em kg
$altura = $_POST['altura'] ?? 0;         // em cm
$idade = $_POST['idade'] ?? 0;           // em anos
$sexo = $_POST['sexo'] ?? 'masculino';   // 'masculino' ou 'feminino'
$objetivo = $_POST['objetivo'] ?? 'manter'; // 'manter', 'perder', 'ganhar'
$nivelAtividade = $_POST['nivelAtividade'] ?? 'sedentario'; // 'sedentario', 'leve', 'moderado', 'intenso', 'muito_intenso'

// Cálculo da TMB
$tmb = calcularTMB($peso, $altura, $idade, $sexo);

// Cálculo do TDEE
$tdee = calcularTDEE($tmb, $nivelAtividade);

// Ajusta as calorias conforme o objetivo
$calorias = ajustarCalorias($tdee, $objetivo);

// Cálculo dos macronutrientes
$macros = calcularMacros($calorias, $peso, $objetivo);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado da Dieta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>📊 Resultado da sua Dieta</h1>
    <p>Seu plano está pronto! Vamos dar o próximo passo? 🚀</p>

    <p><strong>🔥 Calorias diárias:</strong> <?= $macros['calorias'] ?> kcal</p>
    <p><strong>💪 Proteínas:</strong> <?= $macros['proteinas'] ?> g</p>
    <p><strong>🍞 Carboidratos:</strong> <?= $macros['carboidratos'] ?> g</p>
    <p><strong>🥑 Gorduras:</strong> <?= $macros['gorduras'] ?> g</p>

    <a href="alimentos.php?calorias=<?= $macros['calorias'] ?>&proteinas=<?= $macros['proteinas'] ?>&carboidratos=<?= $macros['carboidratos'] ?>&gorduras=<?= $macros['gorduras'] ?>">➡️ Continuar para seleção de alimentos</a>

</div>
</body>
</html>
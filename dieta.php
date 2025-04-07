<?php
// Captura os valores enviados via POST, com valores padrão se não informados
$calorias = $_POST['calorias'] ?? 2000;
$proteinas = $_POST['proteinas'] ?? 150;
$carboidratos = $_POST['carboidratos'] ?? 200;
$gorduras = $_POST['gorduras'] ?? 70;
$alimentos = $_POST['alimentos'] ?? [];

if (empty($alimentos)) {
    die("Você não selecionou nenhum alimento.");
}

$lista = implode(', ', $alimentos);

// Cria o prompt incluindo os novos campos para os macronutrientes
$prompt = " VOCE E O MELHOR NUTRICIONISTA DO MUNDO
Crie uma dieta personalizada que atinja as seguintes metas nutricionais:
- Total de calorias: {$calorias} kcal
- Proteínas: {$proteinas} g
- Carboidratos: {$carboidratos} g
- Gorduras: {$gorduras} g

Utilize os seguintes alimentos (não é obrigatório usar todos): {$lista}.

A dieta deve ser dividida em até 6 refeições, abrangendo Café da Manhã, Almoço, Lanche da Tarde e Jantar. Para cada alimento, especifique as quantidades em gramas ou unidades, Deve ser seguido ao maximo o total de todos macros tentar chegar ao mais proximo possivel.

Ao final, forneça um resumo em formato JSON contendo os totais de proteínas, carboidratos, gorduras e calorias por refeição, conforme o modelo abaixo:

{
  \"refeicoes\": [
    {\"nome\": \"Café da Manhã\", \"proteinas\": 20, \"carboidratos\": 30, \"gorduras\": 10, \"calorias\": 350},
    ...
  ]
}

A resposta deve apresentar o plano de dieta em texto, seguido do JSON na última linha, separados.";


$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => "https://api.openai.com/v1/chat/completions",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode([
        "model" => "gpt-3.5-turbo",
        "messages" => [
            ["role" => "user", "content" => $prompt]
        ],
        "temperature" => 0.7
    ]),
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer TOKEN_AQUI"
    ]
]);

$response = curl_exec($ch);
curl_close($ch);

$resultado = json_decode($response, true);
$dieta = $resultado['choices'][0]['message']['content'] ?? "Erro ao gerar dieta.";

// Extrair JSON ao final
preg_match_all('/\{.*\}/s', $dieta, $matches);

$jsonMacros = null;
if (!empty($matches[0])) {
    $jsonMacros = str_replace("'", '"', end($matches[0]));
}

$dietaTexto = preg_replace('/\{.*\}$/s', '', $dieta);
$dietaTexto = trim($dietaTexto);

$dados = [];
if ($jsonMacros) {
    $dados = json_decode($jsonMacros, true);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sua Dieta</title>
    <link rel="stylesheet" href="dieta.css">
</head>
<body>
<div class="container">
    <h1>🍽️ Sua Dieta Gerada com IA</h1>
    <p><strong>Calorias alvo:</strong> <?= round($calorias) ?> kcal</p>

    <pre class="dieta-texto"><?= htmlspecialchars($dietaTexto) ?></pre>

    <?php if (!empty($dados['refeicoes'])): ?>
        <h2>📊 Macronutrientes por Refeição</h2>
        <table>
            <thead>
                <tr>
                    <th>Refeição</th>
                    <th>Proteínas (g)</th>
                    <th>Carboidratos (g)</th>
                    <th>Gorduras (g)</th>
                    <th>Calorias (kcal)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados['refeicoes'] as $r): ?>
                    <tr>
                        <td><?= $r['nome'] ?></td>
                        <td><?= $r['proteinas'] ?>g</td>
                        <td><?= $r['carboidratos'] ?>g</td>
                        <td><?= $r['gorduras'] ?>g</td>
                        <td><?= $r['calorias'] ?> kcal</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="index.php">← Refazer cálculo</a>
</div>
</body>
</html>

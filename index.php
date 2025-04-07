<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Dieta</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .alerta {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            padding: 12px;
            border-radius: 8px;
            margin: 20px auto;
            max-width: 600px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🍽️ Calculadora de Dieta com IA</h1>
        <p>Transforme sua saúde, uma refeição por vez! 💪🥗</p>

        <div class="alerta">
            ⚠️ <strong>Aviso:</strong> Esta calculadora é apenas uma ferramenta informativa e <strong>não substitui a orientação de um nutricionista</strong>. Consulte um profissional antes de iniciar qualquer plano alimentar. 🧑‍⚕️🥼
        </div>

        <form action="tmb.php" method="POST">
            <label for="peso">⚖️ Peso (kg):</label>
            <input type="number" name="peso" id="peso" required step="0.1" min="1">

            <label for="altura">📏 Altura (cm):</label>
            <input type="number" name="altura" id="altura" required step="0.1" min="1">

            <label for="idade">🎂 Idade:</label>
            <input type="number" name="idade" id="idade" required min="1">

            <label for="sexo">🧍 Sexo:</label>
            <select name="sexo" id="sexo" required>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
            </select>

            <label for="objetivo">🎯 Objetivo:</label>
            <select name="objetivo" id="objetivo" required>
                <option value="manter">Manter peso</option>
                <option value="perder">Perder peso</option>
                <option value="ganhar">Ganhar massa</option>
            </select>

            <button type="submit">✨ Calcular Dieta</button>
        </form>
    </div>
</body>
</html>

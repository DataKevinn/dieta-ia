
<?php
$calorias = $_GET['calorias'] ?? 2000; // valor padrão caso não venha nada
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Seleção de Alimentos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Escolha seus alimentos preferidos</h1>
    <p>Você precisa de aproximadamente <strong><?= round($calorias) ?> kcal</strong> por dia.</p>

    <form action="dieta.php" method="post">
        <input type="hidden" name="calorias" value="<?= $calorias ?>">

        <h2>🍗 Proteínas</h2>
        <div class="category">
        <?php
        $proteinas = [
            // Carnes e peixes
            "Peito de frango",
            "Frango grelhado",
            "Carne bovina (patinho, coxão mole)",
            "Picanha (com moderação)",
            "Costela bovina",
            "Lagarto cozido",
            "Carne seca",
            "Charque",
            "Moela",
            "Fígado de boi",
            "Carne de porco (lombo)",
            "Peito de peru",
            "Bacalhau",
            "Sardinha",
            "Atum em lata",
            "Tilápia",
            "Salmão",
            "Camarão",
        
            // Ovos e derivados
            "Ovos",
            "Ovo de codorna",
        
            // Laticínios
            "Leite integral",
            "Leite desnatado",
            "Leite de soja",
            "Leite de amêndoas (enriquecido)",
            "Iogurte natural",
            "Queijo minas",
            "Queijo cottage",
            "Ricota",
        
            // Embutidos e industrializados (usar com moderação)
            "Presunto magro",
            "Linguiça de frango",
            "Hambúrguer caseiro",
            "Mortadela (com moderação)",
        
            // Proteínas vegetais
            "Tofu",
            "Tempeh",
            "Soja cozida",
            "Feijão carioca",
            "Feijão preto",
            "Feijão branco",
            "Lentilha",
            "Grão-de-bico",
            "Ervilha",
            "Quinoa",
            "Aveia",
            "Amendoim",
            "Castanha de caju",
            "Castanha-do-pará",
            "Nozes",
            "Semente de girassol",
            "Semente de abóbora",
            "Pinhão",
        
            // Suplementos e alimentos fitness
            "Whey protein",
            "Caseína",
            "Proteína isolada da soja",
            "Proteína de ervilha",
            "Barra de proteína",
            "Iogurte grego sem açúcar",
            "Clara de ovo pasteurizada",
            "Pasta de amendoim integral"
        ];
        foreach ($proteinas as $item) {
            echo "<label><input type='checkbox' name='alimentos[]' value='$item'> $item</label>";
        }
        ?>
        </div>

        <h2>🍚 Carboidratos</h2>
        <div class="category">
        <?php
        $carbos = [
            // Grãos e cereais
            "Arroz branco",
            "Arroz integral",
            "Arroz parboilizado",
            "Arroz negro",
            "Arroz vermelho",
            "Quinoa",
            "Cevada",
            "Trigo para quibe",
            "Milho",
            "Milho verde",
            "Canjica",
        
            // Massas e derivados
            "Macarrão tradicional",
            "Macarrão integral",
            "Macarrão de arroz",
            "Macarrão de grão-de-bico",
            "Macarrão de lentilha",
            "Macarrão de abobrinha (low carb)",
        
            // Pães e panificados
            "Pão francês",
            "Pão integral",
            "Pão de forma integral",
            "Pão de centeio",
            "Tapioca",
            "Rapadura (com moderação)",
        
            // Tubérculos e raízes
            "Batata inglesa",
            "Batata doce",
            "Batata baroa (mandioquinha)",
            "Mandioca (aipim/macaxeira)",
            "Inhame",
            "Cará",
        
            // Leguminosas (ricas em carbo e proteínas)
            "Feijão carioca",
            "Feijão preto",
            "Feijão branco",
            "Grão-de-bico",
            "Lentilha",
            "Ervilha",
        
            // Frutas ricas em carboidratos
            "Banana",
            "Uva",
            "Maçã",
            "Manga",
            "Mamão",
            "Pera",
            "Abacate (tem mais gordura, mas também tem carboidratos)",
            "Tâmara",
            "Damasco seco",
            "Passas",
        
            // Outros carboidratos funcionais
            "Aveia",
            "Farinha de aveia",
            "Farinha de arroz",
            "Farinha de amêndoas",
            "Granola sem açúcar",
            "Cuscuz de milho",
            "Polenta",
            "Purê de batata doce",
            "Purê de mandioquinha",
        
            // Suplementos e opções para atletas
            "Maltodextrina",
            "Dextrose",
            "Waxy maize",
            "Batata doce em pó",
            "Palatinose",
            "Barras de cereal (sem açúcar)",
            "Frutas desidratadas"
        ]; // mesma lista que já estava
        foreach ($carbos as $item) {
            echo "<label><input type='checkbox' name='alimentos[]' value='$item'> $item</label>";
        }
        ?>
        </div>

        <h2>🥑 Gorduras boas</h2>
        <div class="category">
        <?php
        $gorduras = [
            "Azeite de oliva extra virgem",
            "Abacate",
            "Castanha-do-pará",
            "Castanha de caju",
            "Amendoim",
            "Nozes",
            "Sementes de chia",
            "Sementes de linhaça",
            "Sementes de girassol",
            "Óleo de coco (com moderação)",
            "Pasta de amendoim integral",
            "Gema de ovo"
        ];
        foreach ($gorduras as $item) {
            echo "<label><input type='checkbox' name='alimentos[]' value='$item'> $item</label>";
        }
        ?>
        </div>

        <h2>🥬 Fibras e vegetais</h2>
        <div class="category">
        <?php
        $fibras = [
            // Verduras e vegetais fibrosos
            "Brócolis",
            "Espinafre",
            "Cenoura",
            "Repolho",
            "Alface",
            "Tomate",
            "Couve",
            "Chuchu",
            "Abobrinha",
            "Berinjela",
            "Jiló",
            "Quiabo",
            "Vagem",
            "Pimentão",
            "Rúcula",
            "Agrião",
            "Couve-flor",
            "Aspargos",
        
            // Frutas com alta fibra
            "Maçã com casca",
            "Pera com casca",
            "Mamão",
            "Banana",
            "Laranja com bagaço",
            "Kiwi",
            "Manga",
            "Figo",
            "Ameixa",
            "Tâmara",
        
            // Leguminosas e grãos
            "Feijão preto",
            "Feijão carioca",
            "Lentilha",
            "Grão-de-bico",
            "Ervilha",
            "Soja",
            "Quinoa",
        
            // Sementes e cereais integrais
            "Aveia",
            "Farelo de aveia",
            "Chia",
            "Linhaça",
            "Centeio",
            "Cevada",
            "Semente de abóbora",
            "Semente de girassol",
            "Amêndoas",
        
            // Outros
            "Batata doce com casca",
            "Mandioca",
            "Inhame",
            "Farinha de trigo integral",
            "Granola sem açúcar"
        ];
        foreach ($fibras as $item) {
            echo "<label><input type='checkbox' name='alimentos[]' value='$item'> $item</label>";
        }
        ?>
        </div>

        <button type="submit">Gerar dieta</button>
    </form>
</div>

<script>
document.querySelector("form").addEventListener("submit", function(e) {
    if (document.querySelectorAll("input[type='checkbox']:checked").length === 0) {
        alert("Por favor, selecione pelo menos um alimento.");
        e.preventDefault();
    }
});
</script>

</body>
</html>

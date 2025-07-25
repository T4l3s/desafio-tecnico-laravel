<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produtos - Demonstração da API</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
</head>

<body class="w-screen h-screen flex flex-col justify-center items-center antialiased gap-6">
    <div class="min-w-[600px] flex flex-col gap-4 items-center justify-between">
        <form id="form-criar-produto"
            class="flex flex-col gap-4 items-end border border-white px-4 py-2 rounded-lg w-full mb-4 bg-white/10"
            onsubmit="return false;">
            <div class="flex flex-col">
                <label for="nome" class="text-white">Nome</label>
                <input type="text" id="nome" name="nome" class="px-2 py-1 border-b" required />
            </div>
            <div class="flex flex-col">
                <label for="preco" class="text-white">Preço</label>
                <input type="number" id="preco" name="preco" class="px-2 py-1 border-b" step="0.01" min="0" required />
            </div>
            <div class="flex flex-col">
                <label for="quantidade" class="text-white">Quantidade</label>
                <input type="number" id="quantidade" name="quantidade" class="px-2 py-1 border-b" min="0" required />
            </div>
            <button type="submit" class="border text-white px-4 py-2 rounded cursor-pointer">Criar</button>
        </form>
        <a href="/" class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-arrow-left-icon lucide-arrow-left">
                <path d="m12 19-7-7 7-7" />
                <path d="M19 12H5" />
            </svg>
            Voltar
        </a>
</body>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const form = document.getElementById('form-criar-produto');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const nome = document.getElementById('nome').value;
            const preco = document.getElementById('preco').value;
            const quantidade = document.getElementById('quantidade').value;

            axios.post('/api/produtos', {
                nome: nome,
                preco: preco,
                quantidade: quantidade
            })
                .then(function (response) {
                    alert('Produto criado com sucesso!');
                    form.reset();
                    window.location.href = '/';
                })
                .catch(function (error) {
                    let msg = 'Erro ao criar o produto.';
                    if (error.response && error.response.data && error.response.data.message) {
                        msg += '\n' + error.response.data.message;
                    }
                    alert(msg);
                });
        });
    }
</script>

</html>
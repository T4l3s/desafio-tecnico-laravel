<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produtos - Demonstração da API</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
</head>

<body class="w-screen h-screen flex flex-col justify-center items-center antialiased gap-6">
    <div class="min-w-[600px] flex gap-4 items-center justify-between">
        <form class="flex items-center border border-white px-4 py-2 rounded-lg" method="GET" action="{{ url('/') }}"
            onsubmit="return true;">
            <input class="flex-1" type="text" name="pesquisa" id="pesquisa" placeholder="Pesquisar..."
                value="{{ request('pesquisa') }}" />
            <button type="submit" class="cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-search-icon lucide-search">
                    <path d="m21 21-4.34-4.34" />
                    <circle cx="11" cy="11" r="8" />
                </svg>
            </button>
        </form>
        <a href="criar-produto" class="flex gap-2 border border-white px-4 py-2 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-plus-icon lucide-plus">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            Criar produto
        </a>
    </div>
    <table class="min-w-[600px] rounded-lg shadow-lg overflow-hidden border-gray-400 border-2">
        <thead>
            <tr class="bg-white text-gray-700 border-b border-gray-400 divide-x divide-gray-400">
                <th class="px-4 py-2 text-left border border-gray-400">ID</th>
                <th class="px-4 py-2 text-left border border-gray-400">Nome</th>
                <th class="px-4 py-2 text-left border border-gray-400">Preço</th>
                <th class="px-4 py-2 text-left border border-gray-400">Quantidade</th>
                <th class="px-4 py-2 text-left border border-gray-400">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
                <tr class="border-b border-gray-400">
                    <td class="px-4 py-2 border border-gray-400">{{ $produto->id }}</td>
                    <td class="px-4 py-2 border border-gray-400">{{ $produto->nome }}</td>
                    <td class="px-4 py-2 border border-gray-400">R$ {{ number_format($produto->preco, 2, ',', '') }}</td>
                    <td class="px-4 py-2 border border-gray-400">{{ $produto->quantidade }}</td>
                    <td class="px-4 py-2 flex gap-4">
                        <!-- Delete -->
                        <button class="cursor-pointer" title="Deletar produto" data-id="{{ $produto->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-trash-icon lucide-trash">
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                <path d="M3 6h18" />
                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                            </svg>
                        </button>
                        <!-- Update -->
                        <a href="/atualizar-produto/{{ $produto->id }}" title="Atualizar produto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-pen-icon lucide-pen">
                                <path
                                    d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                            </svg>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('button[title="Deletar produto"]');
        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const id = button.getAttribute('data-id');

                if (confirm('Tem certeza que deseja deletar este produto?')) {
                    axios.delete(`/api/produtos/${id}`)
                        .then(function (response) {
                            alert('Produto deletado com sucesso!');
                            window.location.reload();
                        })
                        .catch(function (error) {
                            alert('Erro ao deletar o produto.');
                        });
                }
            });
        });
    });
</script>


</html>
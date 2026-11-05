<?php
include 'config.php';
require 'conn.php';
require "config.postagem.php";
$main = '    
<style>
        :root {
            --bg-color: #f4f6f9;
            --card-bg: #ffffff;
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --danger: #ef4444;
            --danger-hover: #dc2626;
            --border-color: #e5e7eb;
            --radius: 12px;
        }

        /* Estrutura Base do Card */
        .post-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            width: 100%;
            max-width: 500px;
            padding: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .post-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
        }

        /* Cabeçalho do Card (Autor e Data) */
        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .post-author {
            font-weight: 600;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .post-author::before {
            content: "";
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: var(--primary);
            border-radius: 50%;
        }

        /* Título e Descrição */
        .post-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0 0 10px 0;
            line-height: 1.4;
        }

        .post-description {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin: 0 0 20px 0;
        }

        /* Rodapé de Ações (Exclusivo para o segundo card) */
        .post-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-top: 1px solid var(--border-color);
            padding-top: 16px;
        }

        .btn {
            padding: 8px 16px;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-edit {
            background-color: #eff6ff;
            color: var(--primary);
        }

        .btn-edit:hover {
            background-color: #dbeafe;
        }

        .btn-delete {
            background-color: #fef2f2;
            color: var(--danger);
        }

        .btn-delete:hover {
            background-color: #fee2e2;
        }
    </style>
    <main>';

// Listando postagens do banco de dados
$postagens = listarPostagem($conn);
if ($postagens == null) {
    $main .= "<h2>Houve um erro ao listar postagens</h2>";
}
else if (mysqli_num_rows($postagens) > 0) {
    while ($row = mysqli_fetch_assoc($postagens)) {
        $titulo = $row["titulo"];
        $descricao = $row["descricao"];
        $data = $row["data"];
        $usuario = $row["email_usuario"];
        $postagem = "";
        if ($_SESSION["user"]["email"] !== $usuario) {
            $postagem = '
            <article class="post-card">
                <div class="post-header">
                    <span class="post-author">'.$usuario.'</span>
                    <span class="post-date">'.$data.'</span>
                </div>
                <h3 class="post-title">'.$titulo.'</h3>
                <p class="post-description">
                    '.$descricao.'
                </p>
            </article>';
        }
        else {
            $postagem = '
            <article class="post-card">
                <div class="post-header">
                    <span class="post-author">'.$usuario.'</span>
                    <span class="post-date">'.$data.'</span>
                </div>
                <h3 class="post-title">'.$titulo.'</h3>
                <p class="post-description">
                    '.$descricao.'
                </p>
                <div class="post-actions">
                    <button class="btn btn-edit" onclick="editarPost()">Editar</button>
                    <button class="btn btn-delete" onclick="deletarPost()">Deletar</button>
                </div>
            </article>';
        }
        $main .= $postagem;
    }
}
else {
    $main .= "<h2>Não há postagens ainda</h2>";
}
$main .= '</main>';


criarTopo("Posts");
echo $main;
echo $rodape;
?>
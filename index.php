<?php
// ================== CONFIGURAÇÃO ==================
// SEUS DADOS JÁ ESTÃO INCLUÍDOS ABAIXO
$token   = "EAAK6gGFkOEgBPURyZBE6NaUIPCfjh85VZC5wZBCzZB73ayadI65kM7ztN49MofLz2HtLNDdvMU9jmsfFtnG56PKMatO7tFfLtBZApdaDq00ZCFyJZB8VHizpjZCZCm53cMv3o8QBG6sWJX6LZAlTZC7QilM2NtSTN8Kg7PUGHjwU8e6IeYx2Bzpm36ikiTkoBna2a8ejSp2evFLu29rAPcjlfAr35uLZCCCu1lJusHYZD";
$user_id = "308228122382946";

// AQUI VOCÊ PODE MUDAR A HASHTAG QUANDO QUISER
$hashtag = "natureza";
// ==================================================

// --- O CÓDIGO ABAIXO FUNCIONA SOZINHO, NÃO PRECISA MUDAR ---

// 1. Buscar o ID da hashtag
$hashtag_search_url = "https://graph.facebook.com/v19.0/ig_hashtag_search?user_id=$user_id&q=" . urlencode($hashtag) . "&access_token=$token";
@$response = file_get_contents($hashtag_search_url); // O @ esconde erros caso a API falhe
$data = json_decode($response, true);
$hashtag_id = $data['data'][0]['id'] ?? null;

// 2. Buscar os posts da hashtag
$posts = [];
if ($hashtag_id) {
    $posts_url = "https://graph.facebook.com/v19.0/$hashtag_id/recent_media?user_id=$user_id&fields=id,caption,media_url,permalink&access_token=$token";
    @$posts_response = file_get_contents($posts_url);
    $posts = json_decode($posts_response, true);
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feed #<?php echo htmlspecialchars($hashtag); ?> - Instagram</title>
    <style>
        /*!
     * Bootstrap v5.3.3 (https://getbootstrap.com/)
     * Copyright 2011-2024 The Bootstrap Authors
     * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
     */
        :root,
        [data-bs-theme=light] {
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #6f42c1;
            --bs-pink: #d63384;
            --bs-red: #dc3545;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffc107;
            --bs-green: #198754;
            --bs-teal: #20c997;
            --bs-cyan: #0dcaf0;
            --bs-black: #000;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-gray-100: #f8f9fa;
            --bs-gray-200: #e9ecef;
            --bs-gray-300: #dee2e6;
            --bs-gray-400: #ced4da;
            --bs-gray-500: #adb5bd;
            --bs-gray-600: #6c757d;
            --bs-gray-700: #495057;
            --bs-gray-800: #343a40;
            --bs-gray-900: #212529;
            --bs-primary: #0d6efd;
            --bs-secondary: #6c757d;
            --bs-success: #198754;
            --bs-info: #0dcaf0;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-primary-rgb: 13, 110, 253;
            --bs-secondary-rgb: 108, 117, 125;
            --bs-success-rgb: 25, 135, 84;
            --bs-info-rgb: 13, 202, 240;
            --bs-warning-rgb: 255, 193, 7;
            --bs-danger-rgb: 220, 53, 69;
            --bs-light-rgb: 248, 249, 250;
            --bs-dark-rgb: 33, 37, 41;
            --bs-primary-text-emphasis: #052c65;
            --bs-secondary-text-emphasis: #2b2f32;
            --bs-success-text-emphasis: #0a3622;
            --bs-info-text-emphasis: #055160;
            --bs-warning-text-emphasis: #664d03;
            --bs-danger-text-emphasis: #58151c;
            --bs-light-text-emphasis: #495057;
            --bs-dark-text-emphasis: #495057;
            --bs-primary-bg-subtle: #cfe2ff;
            --bs-secondary-bg-subtle: #e2e3e5;
            --bs-success-bg-subtle: #d1e7dd;
            --bs-info-bg-subtle: #cff4fc;
            --bs-warning-bg-subtle: #fff3cd;
            --bs-danger-bg-subtle: #f8d7da;
            --bs-light-bg-subtle: #fcfcfd;
            --bs-dark-bg-subtle: #ced4da;
            --bs-primary-border-subtle: #9ec5fe;
            --bs-secondary-border-subtle: #c4c8cb;
            --bs-success-border-subtle: #a3cfbb;
            --bs-info-border-subtle: #9eeaf9;
            --bs-warning-border-subtle: #ffe69c;
            --bs-danger-border-subtle: #f1aeb5;
            --bs-light-border-subtle: #e9ecef;
            --bs-dark-border-subtle: #adb5bd;
            --bs-white-rgb: 255, 255, 255;
            --bs-black-rgb: 0, 0, 0;
            --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
            --bs-body-font-family: var(--bs-font-sans-serif);
            --bs-body-font-size: 1rem;
            --bs-body-font-weight: 400;
            --bs-body-line-height: 1.5;
            --bs-body-color: #212529;
            --bs-body-bg: #fff;
            --bs-border-width: 1px;
            --bs-border-style: solid;
            --bs-border-color: #dee2e6;
            --bs-border-color-translucent: rgba(0, 0, 0, 0.175);
            --bs-border-radius: 0.375rem;
            --bs-border-radius-sm: 0.25rem;
            --bs-border-radius-lg: 0.5rem;
            --bs-border-radius-xl: 1rem;
            --bs-border-radius-xxl: 2rem;
            --bs-border-radius-2xl: var(--bs-border-radius-xxl);
            --bs-border-radius-pill: 50rem;
            --bs-link-color: #0d6efd;
            --bs-link-hover-color: #0a58ca;
            --bs-code-color: #d63384;
            --bs-highlight-bg: #fff3cd;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        @media (prefers-reduced-motion: no-preference) {
            :root {
                scroll-behavior: smooth;
            }
        }

        body {
            margin: 0;
            font-family: var(--bs-body-font-family);
            font-size: var(--bs-body-font-size);
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            color: var(--bs-body-color);
            text-align: var(--bs-body-text-align);
            background-color: var(--bs-body-bg);
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
        }

        h1,
        .h1 {
            font-size: calc(1.375rem + 1.5vw);
        }

        @media (min-width: 1200px) {

            h1,
            .h1 {
                font-size: 2.5rem;
            }
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        a {
            color: rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 1));
            text-decoration: underline;
        }

        a:hover {
            color: rgba(var(--bs-link-hover-color-rgb), var(--bs-link-opacity, 1));
        }

        img {
            vertical-align: middle;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .container {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            width: 100%;
            padding-right: calc(var(--bs-gutter-x) * .5);
            padding-left: calc(var(--bs-gutter-x) * .5);
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 576px) {
            .container {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .container {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1140px;
            }
        }

        @media (min-width: 1400px) {
            .container {
                max-width: 1320px;
            }
        }

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-.5 * var(--bs-gutter-x));
            margin-left: calc(-.5 * var(--bs-gutter-x));
        }

        .row>* {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x) * .5);
            padding-left: calc(var(--bs-gutter-x) * .5);
            margin-top: var(--bs-gutter-y);
        }

        .g-4,
        .gx-4 {
            --bs-gutter-x: 1.5rem;
        }

        .g-4,
        .gy-4 {
            --bs-gutter-y: 1.5rem;
        }

        @media (min-width: 768px) {
            .col-md-4 {
                flex: 0 0 auto;
                width: 33.33333333%;
            }
        }

        .card {
            --bs-card-spacer-y: 1rem;
            --bs-card-spacer-x: 1rem;
            --bs-card-title-spacer-y: 0.5rem;
            --bs-card-border-width: var(--bs-border-width);
            --bs-card-border-color: var(--bs-border-color-translucent);
            --bs-card-border-radius: var(--bs-border-radius);
            --bs-card-box-shadow: ;
            --bs-card-inner-border-radius: calc(var(--bs-border-radius) - (var(--bs-border-width)));
            --bs-card-cap-padding-y: 0.5rem;
            --bs-card-cap-padding-x: 1rem;
            --bs-card-cap-bg: rgba(var(--bs-black-rgb), 0.03);
            --bs-card-cap-color: ;
            --bs-card-height: ;
            --bs-card-color: ;
            --bs-card-bg: var(--bs-body-bg);
            --bs-card-img-overlay-padding: 1rem;
            --bs-card-group-margin: 0.75rem;
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            height: var(--bs-card-height);
            word-wrap: break-word;
            background-color: var(--bs-card-bg);
            background-clip: border-box;
            border: var(--bs-card-border-width) solid var(--bs-card-border-color);
            border-radius: var(--bs-card-border-radius);
        }

        .card-body {
            flex: 1 1 auto;
            padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);
            color: var(--bs-card-color);
        }

        .card-text:last-child {
            margin-bottom: 0;
        }

        .card-img-top {
            width: 100%;
            border-top-left-radius: var(--bs-card-inner-border-radius);
            border-top-right-radius: var(--bs-card-inner-border-radius);
        }

        .btn {
            --bs-btn-padding-x: 0.75rem;
            --bs-btn-padding-y: 0.375rem;
            --bs-btn-font-family: ;
            --bs-btn-font-size: 1rem;
            --bs-btn-font-weight: 400;
            --bs-btn-line-height: 1.5;
            --bs-btn-color: var(--bs-body-color);
            --bs-btn-bg: transparent;
            --bs-btn-border-width: var(--bs-border-width);
            --bs-btn-border-color: transparent;
            --bs-btn-border-radius: var(--bs-border-radius);
            --bs-btn-hover-border-color: transparent;
            --bs-btn-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(0, 0, 0, 0.075);
            --bs-btn-disabled-opacity: 0.65;
            --bs-btn-focus-box-shadow: 0 0 0 0.25rem rgba(var(--bs-btn-focus-shadow-rgb), .5);
            display: inline-block;
            padding: var(--bs-btn-padding-y) var(--bs-btn-padding-x);
            font-family: var(--bs-btn-font-family);
            font-size: var(--bs-btn-font-size);
            font-weight: var(--bs-btn-font-weight);
            line-height: var(--bs-btn-line-height);
            color: var(--bs-btn-color);
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            border: var(--bs-btn-border-width) solid var(--bs-btn-border-color);
            border-radius: var(--bs-btn-border-radius);
            background-color: var(--bs-btn-bg);
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .btn-sm {
            --bs-btn-padding-y: 0.25rem;
            --bs-btn-padding-x: 0.5rem;
            --bs-btn-font-size: .875rem;
            --bs-btn-border-radius: var(--bs-border-radius-sm);
        }

        .btn-outline-primary {
            --bs-btn-color: #0d6efd;
            --bs-btn-border-color: #0d6efd;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #0d6efd;
            --bs-btn-hover-border-color: #0d6efd;
            --bs-btn-focus-shadow-rgb: 13, 110, 253;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #0d6efd;
            --bs-btn-active-border-color: #0d6efd;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #0d6efd;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #0d6efd;
            --bs-gradient: none;
        }

        .d-flex {
            display: flex !important;
        }

        .flex-column {
            flex-direction: column !important;
        }

        .mt-auto {
            margin-top: auto !important;
        }

        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-primary {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-primary-rgb), var(--bs-text-opacity)) !important;
        }

        .text-muted {
            --bs-text-opacity: 1;
            color: #6c757d !important;
        }

        .bg-light {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important;
        }

        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        .h-100 {
            height: 100% !important;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-5">
        <h1 class="mb-4 text-center">Postagens com <span class="text-primary">#<?php echo htmlspecialchars($hashtag); ?></span></h1>

        <div class="row g-4">
            <?php if (!empty($posts['data'])): ?>
                <?php foreach ($posts['data'] as $post): ?>
                    <?php if (!empty($post['media_url'])): // Só exibe se tiver uma URL de imagem/vídeo 
                    ?>
                        <div class="col-md-4">
                            <div class="card shadow-sm h-100">
                                <a href="<?= htmlspecialchars($post['permalink']); ?>" target="_blank" rel="noopener noreferrer">
                                    <img src="<?= htmlspecialchars($post['media_url']); ?>" class="card-img-top" alt="Post do Instagram">
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <p class="card-text">
                                        <?= isset($post['caption']) ? htmlspecialchars(substr($post['caption'], 0, 100)) . "..." : "Sem legenda."; ?>
                                    </p>
                                    <a href="<?= htmlspecialchars($post['permalink']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary mt-auto">Ver no Instagram</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-muted">Nenhuma postagem encontrada ou erro na API. Verifique se o Token e os IDs estão corretos e se a hashtag tem posts recentes.</p>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>
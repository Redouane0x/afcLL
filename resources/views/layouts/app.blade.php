<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>AFCLL</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        :root {
            --vert-principal: #6CC24A;
            --vert-fonce: #0f3d1e;
            --blanc: #FFFFFF;
        }

        body {
            background-color: #f8f9fa;
        }

        .bg-vert {
            background-color: var(--vert-principal);
        }

        .bg-vert-fonce {
            background-color: var(--vert-fonce);
        }

        .text-vert {
            color: var(--vert-principal);
        }

        .btn-vert {
            background-color: var(--vert-principal);
            color: white;
        }

        .btn-vert:hover {
            background-color: #5aa63f;
        }
    </style>
</head>

<body>

@include('components.navbar')

<main class="container mt-4">
    @yield('content')
</main>

@include('components.footer')

<!-- Bootstrap JS (IMPORTANT pour menu mobile) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

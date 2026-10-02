<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mudamos!</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8fafc 0%, #eef2f7 100%);
            color: #1f2937;
            padding: 1.5rem;
        }

        .card {
            max-width: 32rem;
            width: 100%;
            text-align: center;
            background: #ffffff;
            border-radius: 1rem;
            padding: 3rem 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        }

        .card h1 {
            font-size: 2.75rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #111827;
        }

        .card p {
            font-size: 1.125rem;
            line-height: 1.6;
            color: #4b5563;
            margin-bottom: 2rem;
        }

        .btn {
            display: inline-block;
            background: #2563eb;
            color: #ffffff;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            padding: 0.85rem 2rem;
            border-radius: 0.6rem;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
                color: #e5e7eb;
            }

            .card {
                background: #1f2937;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            }

            .card h1 {
                color: #f9fafb;
            }

            .card p {
                color: #d1d5db;
            }
        }
    </style>
</head>
<body>
    <main class="card">
        <h1>Mudamos!</h1>
        <p>O Periódico de Educação Física tem um novo endereço, clique no botão abaixo para acessar</p>
        <a class="btn" href="https://rcpef.org/">Acessar RCPEF</a>
    </main>
</body>
</html>

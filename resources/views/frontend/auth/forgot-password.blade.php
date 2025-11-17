<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Esqueci minha senha - Hub do Café</title>
    </head>
    <body>
        <div class="container">
            <header>
                <h1>Hub do Café</h1>
            </header>

            <main>
                <h2>Recuperar senha</h2>
                <p>Informe seu e-mail para receber o link de recuperação de senha.</p>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                        >
                        @error('email')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit">Enviar link de recuperação</button>

                    <div class="links">
                        <a href="{{ route('login') }}">Voltar para login</a>
                    </div>
                </form>
            </main>

            <footer>
                <p>Projeto fictício desenvolvido para fins acadêmicos. Sem fins lucrativos.</p>
            </footer>
        </div>
    </body>
</html>

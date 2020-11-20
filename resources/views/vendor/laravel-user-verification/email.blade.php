<h3>{{config('app.name')}}</h3>
<p>Sua conta na plataforma foi criada</p>

<p>
    Clique
    <a href="{{ $link = route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) }}">
        Aqui
    </a>
    para verificar a sua conta.
</p>
<p><strong>Não responda este e-mail, pois ele é gerado automaticamente.</strong></p>


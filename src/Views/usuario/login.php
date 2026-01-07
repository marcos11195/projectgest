<h1>Pantalla de Login</h1>

<form action="<?= BASE_URL ?>/auth/login" method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Entrar</button>
</form>

<!-- Botón para ir a registro -->
<a href="<?= BASE_URL ?>/auth/register"
    style="display:inline-block; margin-top:10px; padding:8px 12px; background:#007bff; color:white; text-decoration:none; border-radius:4px;">
    Crear cuenta nueva
</a>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>
<h3>Form Login</h3>

<?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
    <script>
        alert('Username atau password salah. Silakan coba lagi.');
    </script>
<?php endif; ?>

<form method="POST" action="users_controller.php">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="username" />
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" />
    </div>
    <button type="submit" class="btn btn-primary">Login</button>

    <button type="reset" class="btn btn-warning">Cancel</button>
</form>
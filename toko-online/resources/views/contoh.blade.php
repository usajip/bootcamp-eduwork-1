<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Mode dan Light Mode dengan Session</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body.dark-mode {
            background-color: #212529;
            color: white;
        }
        body.light-mode {
            background-color: white;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container text-center mt-5">
        <h1>Dark Mode dan Light Mode dengan Session</h1>
        <p>Ini adalah contoh penerapan dark mode dan light mode menggunakan Bootstrap dan LocalStorage.</p>
        <button id="toggleMode" class="btn btn-primary">Ubah ke Dark Mode</button>
    </div>

    <!-- JavaScript -->
    <script>
        const body = document.body;
        const toggleButton = document.getElementById('toggleMode');

        // Fungsi untuk menyimpan preferensi pengguna di LocalStorage
        function setMode(mode) {
            localStorage.setItem('theme', mode);
            body.className = mode;
            toggleButton.textContent = mode === 'dark-mode' ? 'Ubah ke Light Mode' : 'Ubah ke Dark Mode';
        }

        // Cek preferensi yang tersimpan di LocalStorage saat halaman dimuat
        const savedMode = localStorage.getItem('theme') || 'light-mode';
        setMode(savedMode);

        // Event listener untuk tombol toggle
        toggleButton.addEventListener('click', () => {
            const currentMode = body.classList.contains('light-mode') ? 'dark-mode' : 'light-mode';
            setMode(currentMode);
        });
    </script>
</body>
</html>

// Fungsi validasi JavaScript
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("registrationForm");

    form.addEventListener("submit", (event) => {
        // ambil elemen form dari php
        const name = document.getElementById('name').value.trim();
        const nim = document.getElementById('nim').value.trim();
        const email = document.getElementById('email').value.trim();
        const fileInput = document.getElementById('file');
        const file = fileInput.files[0];
        const gender = document.getElementById('gender').value;

        // Validasi nama
        if (name === "") {
            alert("Nama tidak boleh kosong.");
            event.preventDefault();
            return false;
        }

        // Validasi NIM
        if (nim === "" || isNaN(nim) || nim.length < 8) {
            alert("NIM harus berupa angka dan minimal 8 karakter.");
            event.preventDefault();
            return false;
        }

        // Validasi email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Email tidak valid.");
            event.preventDefault();
            return false;
        }

        // Validasi jenis kelamin
        if (gender === "") {
            alert("Pilih jenis kelamin.");
            event.preventDefault();
            return false;
        }

        // Validasi file
        if (!file) {
            alert("Harap unggah file.");
            event.preventDefault();
            return false;
        }
        if (file.type !== "text/plain") {
            alert("File harus berupa file teks (.txt).");
            event.preventDefault();
            return false;
        }
        if (file.size > 2000000) { // 2MB
            alert("Ukuran file tidak boleh lebih dari 2MB.");
            event.preventDefault();
            return false;
        }

        return true;
    });
});

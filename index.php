<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Ticketing System - Trakindo Utama</title>
    <link rel="stylesheet" href="./assets/styles/app.css">
    
</head>
<body>
    <main class="container">
        <div class="leftSide">
        <img src="./assets/icons/trakindo.png" alt="icontrackindo">
            <h1>Maintenance Ticketing System</h1>
            <figure>
                <img src="./assets/images/loginillus.svg" alt="illustration">
            </figure>
        </div>
        <div class="rightSide">
            <div class="loginForm">
                <form action="#" autocomplete="off">
                    <h3>Form Login</h3>
                    <div class="wrapper">
                        <div class="inputBox">
                            <label for="username">Masukkan Username</label>
                            <input type="text" id="username" name="username" required >
                        </div>
                        <div class="inputBox">
                            <label for="password">Masukkan password</label>
                            <input type="password" id="password" name="password" required >
                        </div>
                        <button type="submit" class="loginBtn">Log In</button>
                        <p>Belum memiliki akun? Silahkan mendaftar <a href="#" onClick="hideFormCreateUser('show')">disini</a>. </p>
                        <p class="info salah">Username atau password yang anda masukkan tidak sesuai, silahkan coba kembali!</p>
                        <p class="info created">Data User berhasil ditambahkan, silahkan Log In.</p>
                    </div>
                </form>
            </div>
        </div>
        <footer>
            Maintenance Ticketing System - Trakindo Utama &copy; 2022
        </footer>
    </main>
    <div class="outerContainer" id="outer">
        <div class="addForm">
            <form action="#" autocomplete="off">
                <div class="formtitle">
                    <h3>Tambah Data User</h3>
                    <a href="#" onClick="hideFormCreateUser('hide')"><i class="fi fi-rs-cross"></i></a>
                </div>
                <div class="wrapper">
                    <div class="inputBox">
                        <label for="username">Masukkan Username</label>
                        <input type="text" name="username" id="username">
                    </div>
                    <div class="inputBox">
                        <label for="password">Masukkan Password</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="inputBox">
                        <label for="company">Masukkan Nama Perusahaan</label>
                        <input list="companies" name="company" id="company">
                        <datalist id="companies">
                            <option value="PT. Madhani"></option>
                            <option value="PT. Bukit Asam"></option>
                        </datalist>
                    </div>
                    <button type="submit" class="loginBtn">Tambah User</button>
                </div>
            </form>
        </div>
    </div>
    <script src="./controller/scripts/script.js"></script>
</body>
</html>
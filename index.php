<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Ticketing System - Trakindo Utama</title>
    <link rel="stylesheet" href="./assets/styles/app.css">
    <link rel="icon" href="./assets/icons/laptop.png" />
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
                <form action="./controller/validateLogin.php autocomplete="off" method="post">
                    <h3>Form Login</h3>
                    <div class="wrapper">
                        <div class="inputBox">
                            <label for="username">Masukkan Username</label>
                            <input type="text" id="username" name="username" spellcheck="false" required >
                        </div>
                        <div class="inputBox">
                            <label for="password">Masukkan password <i onclick="showPassword('password')" title="Klik untuk melihat password" class="fi fi-rs-eye adjust eye" style="transform: translate(5px, 3px)"></i></label>
                            <input type="password" id="password" name="password" spellcheck="false"  required >
                        </div>
                        <button type="submit" class="loginBtn"><i class="fi fi-rs-sign-in-alt adjust"></i> Log In</button>
                        <p>Belum memiliki akun? Silahkan mendaftar <a href="#" onClick="hideFormCreateUser('show')">disini</a>. </p>
                        <!-- hasil validasi informasi login ataupun tambah data -->
                        <?php 
                            if(isset($_GET['status'])){
                                if($_GET['status'] === "successadd"){
                                    echo "<p class='info created'>Data User berhasil ditambahkan, silahkan Log In.</p>";
                                } else {
                                    echo "<p class='info salah'>Username atau password yang anda masukkan tidak sesuai, silahkan coba kembali!</p>";
                                }
                            }
                        ?>
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
            <form action="./controller/addUser.php" autocomplete="off" method="post">
                <div class="formtitle">
                    <h3>Tambah Data User</h3>
                    <a href="#" onClick="hideFormCreateUser('hide')"><i class="fi fi-rs-cross"></i></a>
                </div>
                <div class="wrapper">
                    <div class="inputBox">
                        <label for="username">Masukkan Username</label>
                        <input type="text" spellcheck="false"  name="username" id="username">
                    </div>
                    <div class="inputBox">
                        <label for="password">Masukkan Password  <i onclick="showPassword('passwordS')" title="Klik untuk melihat password" class="fi fi-rs-eye adjust eye" style="transform: translate(5px, 3px)"></i></label>
                        <input type="password" spellcheck="false"  name="password" id="passwordS">
                    </div>
                    <div class="inputBox">
                        <label for="company">Masukkan Nama Perusahaan</label>
                        <input list="companies" spellcheck="false" name="company" id="company">
                        <datalist id="companies">
                            <option value="PT. Madhani"></option>
                            <option value="PT. Bukit Asam"></option>
                        </datalist>
                    </div>
                    <button type="submit" class="loginBtn" name="add-user"><i class="fi fi-rs-user-add adjusts"></i> Tambah User</button>
                </div>
            </form>
        </div>
    </div>
    <script src="./controller/scripts/script.js"></script>
</body>
</html>
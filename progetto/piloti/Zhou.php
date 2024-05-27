<?php 
session_start(); // Start the session at the beginning of your file 
?>
<!DOCTYPE html>
<html lang="IT">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FormulaForFun</title>
        <link rel="stylesheet" href="Style_Pilota.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.min.css" integrity="sha512-fJcFDOQo2+/Ke365m0NMCZt5uGYEWSxth3wg2i0dXu7A1jQfz9T4hdzz6nkzwmJdOdkcS8jmy2lWGaRXl+nFMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">  
    </head>

    
<body>
    <div class="header">
        <div class="logo">
            <a href="../index.php" class="box-link"><img src="media/logo.png" alt=""></a>
        </div>

        <ul class="menu">
            <?php if(isset($_SESSION['username'])): ?>
                <li><a href="../pagina_personale.php" id="userImage"><img src="<?php echo $_SESSION['profile_image']; ?>" alt="image"></a></li>
                <label><a href="../logout.php" id="logoutButton" class="menu-text">LOGOUT</a></label>
            <?php else: ?>
                <label><a href="../login.html" id="loginButton" class="menu-text">LOGIN</a></label>
                <label><a href="../register.html" id="registerButton" class="menu-text">REGISTER</a></label>
            <?php endif; ?>           
            <li><a href="../stats.php" class="menu-text">Stats</a></li>
            <li><a href="../piloti.php" class="menu-text">Piloti</a>
                <ul>
                    <li><a href="verstappen.php">Max Verstappen</a></li> 
                    <li><a href="perez.php">Sergio Perez</a></li> 
                    <li><a href="Hamilton.php">Lewis Hamilton</a></li> 
                    <li><a href="Russel.php">George Russell</a></li> 
                    <li><a href="Leclerc.php">Charles Leclerc</a></li>
                    <li><a href="sainz.php">Carlos Sainz</a></li> 
                    <li><a href="Norris.php">Lando Norris</a></li>
                    <li><a href="piastri.php">Oscar Piastri</a></li>
                    <li><a href="Alonso.php">Fernando Alonso</a></li>
                    <li><a href="Stroll.php">Lance Stroll</a></li>                     
                    <li><a href="Gasly.php">Pierre Gasly</a></li>
                    <li><a href="Ocon.php">Esteban Ocon</a></li>
                    <li><a href="Albon.php">Alexander Albon</a></li>
                    <li><a href="Sargeant.php">Logan Sargeant</a></li>
                    <li><a href="Tsunoda.php">Yuki Tsunoda</a></li>
                    <li><a href="Ricciardo.php">Daniel Ricciardo</a></li>
                    <li><a href="bottas.php">Valterri Bottas</a></li>
                    <li><a href="Zhou.php">Ghuanyu Zhou</a></li>
                    <li><a href="Hulkenberg.php">Nico Hulkenberg</a></li>
                    <li><a href="magnussen.php">Kevin Magnussen</a></li>
                </ul>
            </li>
            <li><a href="../scuderie.php" class="menu-text">Scuderie</a>
                <ul>
                    <span><a href="../scuderie/RedBull.php" >Red Bull</a></span>
                    <span><a href="../scuderie/Mercedes.php" >Mercedes</a></span>
                    <span><a href="../scuderie/Ferrari.php" >Ferrari</a></span>
                    <span><a href="../scuderie/McLaren.php" >McLaren</a></span>
                    <span><a href="../scuderie/AstonMartin.php" >Aston Martin</a></span>
                    <span><a href="../scuderie/Alpine.php" >Alpine</a></span>
                    <span><a href="../scuderie/Williams.php" >Williams</a></span>                       
                    <span><a href="../scuderie/AlphaTauri.php" >Alpha Tauri</a></span>
                    <span><a href="../scuderie/KickSaubern.php" >Kick Saubern</a></span>
                    <span><a href="../scuderie/Haas.php" >Haas</a></span>
                </ul>
            </li>
            <li><a href="../fanta-formula.php" class="menu-text">Fanta-Formula</a></li> 
            <label><a href="../login.php"class="menu-text">Login</a></label>
            <label><a href="../register.php"class="menu-text">Register</a></label>
        </ul>

        <div class="r-l">
        <?php if(isset($_SESSION['username'])): ?>
                    <a href="pagina_personale.php" id="userImage"><img  src="<?php echo $_SESSION['profile_image']; ?>" alt="image"></a>
                    <a href="../logout.php" id="logoutButton" class="button">LOGOUT</a>
                <?php else: ?>
                    <a href="../login.html" id="loginButton" class="button">LOGIN</a>
                    <p>
                    <a href="../register.html" id="registerButton" class="button">REGISTER</a>
                <?php endif; ?>
        </div>

        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="hero">
        <div class="hero__content ">
            <h1 class = "big-text"> GHUANYU ZHOU </h1>
        </div>
        <video autoplay muted loop id="video">
            <source src="media/ZHOU_VIDEO.mp4" type="video/mp4">

        </video>
    </div>
    <div class="mt-2 scroll">
        <main>
            <ul class="slider">
            <li class="item" style="background-image: url('media/carriera_stake.jpg')";>
                <div class="content">
                <h2 class="title" style="font-size: 60px;">"Carriera"</h2>
                <p class="description">
                    Il primo contatto di Guanyu Zhou con la Formula 1 è avvenuto nel luglio 2021, 
                    quando ha avuto l'opportunità di partecipare a una sessione di prove libere 
                    del Gran Premio d'Austria con la squadra Alpine. Questa esperienza ha alimentato 
                    il suo desiderio di competere nella massima categoria del motorsport.
                    <br>
                    Nel novembre 2021, Zhou ha raggiunto un traguardo significativo diventando il primo 
                    pilota cinese a ottenere un posto come pilota titolare in Formula 1, firmando con 
                    l'Alfa Romeo F1 Team per la stagione 2022. Nonostante le sfide iniziali, Zhou ha dimostrato 
                    il suo talento e la sua determinazione durante la sua stagione di debutto, conquistando il 
                    rinnovo contrattuale per il 2023.
                    <br>
                    Nel 2024, Zhou continua la sua avventura in Formula 1 con l'Alfa Romeo, mantenendo Valtteri 
                    Bottas come suo compagno di squadra mentre la squadra viene rinominata Stake F1 Team. La sua 
                    carriera è caratterizzata da una costante crescita e dalla promessa di risultati sempre migliori 
                    nel futuro.
                </p>
                </div>
            </li>
            <li
                class="item"
                style="background-image: url('media/stats_zhou.jpg')"
            >
                <div class="content">
                <h2 class="title" style="font-size: 60px;">"Statistiche"</h2>
                <p class="description">
                   Per il rappresentante della Cina non ci sono molte statistiche di cui parlare.
                   Ha partecipato solo a 3 stagioni, nel quale ha fatto solo 12 punti, e tutte in Alpha Romeo che, come nella produzione
                   di macchine commerciali, non hanno fatto una buona macchina da anni.
                   Ma ha potenziale, bisognerà vedere con altre macchine come competirà.
                </p>
                <a href=""><button>Read More</button></a>
                </div>
            </li>
            <li class="item" style="background-image: url('media/biografia_zhou.jpg');">
                <div class="content">
                <h2 class="title" style="font-size: 60px;">"Biografia"</h2>
                <p class="description">
                    Guanyu Zhou è nato il 30 maggio 1999 a Shanghai, Cina. Ha iniziato la sua passione 
                    per il motorsport all'età di 8 anni, cominciando con il karting. La sua determinazione 
                    e i suoi successi precoci lo hanno portato a essere notato dalla Ferrari Driver Academy 
                    nel 2014, che gli ha aperto le porte per passare dalle corse di kart alle monoposto.
                    <br>
                    Nel corso degli anni successivi, Zhou ha progredito costantemente nelle categorie giovanili 
                    del motorsport, dimostrando un talento naturale e guadagnandosi rispetto nel mondo delle corse. 
                    Nel 2019, ha fatto il grande passo nella Formula 2 con il team UNI-Virtuosi, dove ha gareggiato 
                    per tre stagioni consecutive, mostrando una rapida crescita e ottenendo risultati significativi.
                </p>
            </li>

            <li class="item" style=" background-image: url('media/team_stake.jpg');">
                <div class="content">
                <h2 class="title" style="font-size: 60px; text-align: center;">"Compagno"</h2>
                <a href="bottas.php"><button>Read More</button></a>
                </div>
            </li>
            <li class="item" style=" background-image: url('media/stake_pitstop.jpg');">
                <div class="content">
                <h2 class="title"style="font-size: 60px;">"Scuderia"</h2>
                <button>Read More</button>
                </div>
            </li>
            </ul>
            <nav class="nav">
            <ion-icon class="btn prev" name="arrow-back-outline"></ion-icon>
            <ion-icon class="btn next" name="arrow-forward-outline"></ion-icon>
            </nav>
        </main>
    </div>

    <div class="hero-telefono" style=" background-image: url('media/zhou_phone.jpg');">
        <div class="hero-telefono__content">
            <h1 class = "medium-text">GHUANYU ZHOU</h1>
        </div>
    </div>
  
    <div class="telefono">
        <h2 class="title">Carriera</h2>
        <p class="description">
            Il primo contatto di Guanyu Zhou con la Formula 1 è avvenuto nel luglio 2021, 
            quando ha avuto l'opportunità di partecipare a una sessione di prove libere 
            del Gran Premio d'Austria con la squadra Alpine. Questa esperienza ha alimentato 
            il suo desiderio di competere nella massima categoria del motorsport.
            <br>
            Nel novembre 2021, Zhou ha raggiunto un traguardo significativo diventando il primo 
            pilota cinese a ottenere un posto come pilota titolare in Formula 1, firmando con 
            l'Alfa Romeo F1 Team per la stagione 2022. Nonostante le sfide iniziali, Zhou ha dimostrato 
            il suo talento e la sua determinazione durante la sua stagione di debutto, conquistando il 
            rinnovo contrattuale per il 2023.
            <br>
            Nel 2024, Zhou continua la sua avventura in Formula 1 con l'Alfa Romeo, mantenendo Valtteri 
            Bottas come suo compagno di squadra mentre la squadra viene rinominata Stake F1 Team. La sua 
            carriera è caratterizzata da una costante crescita e dalla promessa di risultati sempre migliori 
            nel futuro.
        </p>
        <h2 class="title">Statistiche</h2>
        <p class="description">
            Per il rappresentante della Cina non ci sono molte statistiche di cui parlare.
            Ha partecipato solo a 3 stagioni, nel quale ha fatto solo 12 punti, e tutte in Alpha Romeo che, come nella produzione
            di macchine commerciali, non hanno fatto una buona macchina da anni.
            Ma ha potenziale, bisognerà vedere con altre macchine come competirà.
        </p>

        <h2 class="title">Biografia</h2>
        <p class="description">
            Guanyu Zhou è nato il 30 maggio 1999 a Shanghai, Cina. Ha iniziato la sua passione 
            per il motorsport all'età di 8 anni, cominciando con il karting. La sua determinazione 
            e i suoi successi precoci lo hanno portato a essere notato dalla Ferrari Driver Academy 
            nel 2014, che gli ha aperto le porte per passare dalle corse di kart alle monoposto.
            <br>
            Nel corso degli anni successivi, Zhou ha progredito costantemente nelle categorie giovanili 
            del motorsport, dimostrando un talento naturale e guadagnandosi rispetto nel mondo delle corse. 
            Nel 2019, ha fatto il grande passo nella Formula 2 con il team UNI-Virtuosi, dove ha gareggiato 
            per tre stagioni consecutive, mostrando una rapida crescita e ottenendo risultati significativi.
        </p>
    </div>
  
    <script
    type="module"
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
    nomodule
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
    <script src="verstappen.js"></script>

    <footer class="footer">        
        <div class="col">
            <h3 class="medium-text">Contatti </h3>
            <p class="normal-text">e-mail: <br/> Fantaformula@gmail.com</p>
            <p class="normal-text">telefono: <br/> +39 3383477124</p>
        </div>
    </footer>
    
    <!-- Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.pkgd.min.js" integrity="sha512-achKCfKcYJg0u0J7UDJZbtrffUwtTLQMFSn28bDJ1Xl9DWkl/6VDT3LMfVTo09V51hmnjrrOTbtg4rEgg0QArA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="hamburger.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.pkgd.min.js" integrity="sha512-achKCfKcYJg0u0J7UDJZbtrffUwtTLQMFSn28bDJ1Xl9DWkl/6VDT3LMfVTo09V51hmnjrrOTbtg4rEgg0QArA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>


<!-- dobbiamo inserire i link per le paggine appena le abbiamo crete -->
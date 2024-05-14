<?php
session_start();
if(!isset($_SESSION['username'])) {
?>
<script type="text/javascript">
    window.onload = function() {
        var popup = document.getElementById('popup1');
        var popupText = document.getElementById('popup1-text');
                        
        popupText.textContent = 'Perfavore fai il Login per usare questa funzione';
        //popup.innerHTML = '<p>Perfavore fai il Login per usare questa funzione</p><a href="Login.html">Login</a>';
        popup.style.display = 'block';
    }
</script>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FormulaForFun</title>
        <link rel="stylesheet" href="fanta-formula_style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.min.css" integrity="sha512-fJcFDOQo2+/Ke365m0NMCZt5uGYEWSxth3wg2i0dXu7A1jQfz9T4hdzz6nkzwmJdOdkcS8jmy2lWGaRXl+nFMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <div class="header">
            <div class="logo">
                <a href="index.php"><img src="media/logo.png" alt=""></a>
            </div>

            <ul class="menu">
                <?php if(isset($_SESSION['username'])): ?>
                    <li><a href="pagina_personale.php" id="userImage"><img src="<?php echo $_SESSION['profile_image']; ?>" alt="image"></a></li>
                    <label><a href="logout.php" id="logoutButton" class="menu-text">LOGOUT</a></label>
                <?php else: ?>
                    <label><a href="login.html" id="loginButton" class="menu-text">Login</a></label>
                    <label><a href="register.html" id="registerButton" class="menu-text">Register</a></label>
                <?php endif; ?>
                <li><a href="stats.php" class="menu-text">Stats</a></li>
                <li><a href="piloti.php" class="menu-text">Piloti</a>
                    <ul>
                        <li><a href="piloti/verstappen.php">Max Verstappen</a></li> 
                        <li><a href="piloti/perez.php">Sergio Perez</a></li> 
                        <li><a href="piloti/Hamilton.php">Lewis Hamilton</a></li> 
                        <li><a href="piloti/Russel.php">George Russell</a></li> 
                        <li><a href="piloti/Leclerc.php">Charles Leclerc</a></li>
                        <li><a href="piloti/sainz.php">Carlos Sainz</a></li> 
                        <li><a href="piloti/Norris.php">Lando Norris</a></li>
                        <li><a href="piloti/piastri.php">Oscar Piastri</a></li>
                        <li><a href="piloti/Alonso.php">Fernando Alonso</a></li>
                        <li><a href="piloti/Stroll.php">Lance Stroll</a></li>                                       
                        <li><a href="piloti/Gasly.php">Pierre Gasly</a></li>
                        <li><a href="piloti/Ocon.php">Esteban Ocon</a></li>
                        <li><a href="piloti/Albon.php">Alexander Albon</a></li>
                        <li><a href="piloti/Sargeant.php">Logan Sargeant</a></li>
                        <li><a href="piloti/Tsunoda.php">Yuki Tsunoda</a></li>
                        <li><a href="piloti/Ricciardo.php">Daniel Ricciardo</a></li>
                        <li><a href="piloti/bottas.php">Valterri Bottas</a></li>
                        <li><a href="piloti/Zhou.php">Ghuanyu Zhou</a></li>
                        <li><a href="piloti/Hulkenberg.php">Nico Hulkenberg</a></li>
                        <li><a href="piloti/magnussen.php">Kevin Magnussen</a></li>
                    </ul>
                </li>
                <li><a href="scuderie.php" class="menu-text">Scuderie</a>
                    <ul>
                        <span><a href="scuderie/RedBull.php" >Red Bull</a></span>
                        <span><a href="scuderie/Mercedes.php" >Mercedes</a></span>
                        <span><a href="scuderie/Ferrari.php" >Ferrari</a></span>
                        <span><a href="scuderie/McLaren.php" >McLaren</a></span>
                        <span><a href="scuderie/AstonMartin.php" >Aston Martin</a></span>
                        <span><a href="scuderie/Alpine.php" >Alpine</a></span>
                        <span><a href="scuderie/Williams.php" >Williams</a></span>                       
                        <span><a href="scuderie/AlphaTauri.php" >Alpha Tauri</a></span>
                        <span><a href="scuderie/KickSaubern.php" >kick Saubern</a></span>
                        <span><a href="scuderie/Haas.php" >Haas</a></span>
                    </ul>
                </li>
                <li><a href="fanta-formula.php" class="menu-text">Fanta-Formula</a></li>
            </ul>

            <div class="r-l">
            <?php if(isset($_SESSION['username'])): ?>
                    <a href="pagina_personale.php" id="userImage"><img src="<?php echo $_SESSION['profile_image']; ?>" alt="image"></a>
                    <a href="logout.php" id="logoutButton" class="button">LOGOUT</a>
                <?php else: ?>
                    <a href="login.html" id="loginButton" class="button">LOGIN</a>
                    <p>
                    <a href="register.html" id="registerButton" class="button">REGISTER</a>
                <?php endif; ?>
            </div>

            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        
        <?php if(isset($_SESSION['username'])): ?>
            <div class="bunner-budget">
                <ul class="content-bunner">
                    <li><a id="total" class="banner-text">Budget disponibile: 15000 $</a></li>
                    <li><a id="scelte" class="banner-text">Piloti: 0/2, Scuderie: 0/1</a></li>
                </ul>
            
                <div class="conferma-squad"> 
                    <button class="button-squad" name="conferma_squadra">Conferma Squadra</button>
                </div>
            </div>
        <?php endif; ?>
        <?php
                    // Stabilisci la connessione al database
                    $conn = new mysqli('localhost', 'root', '', 'statistiche');

                    // Controlla se la connessione è riuscita
                    if ($conn->connect_error) {
                        die("Connessione fallita: " . $conn->connect_error);
                    }
                    
                    // Esegui la query SQL
                    $sql = "SELECT tipo, nome, prezzo FROM prezzi ORDER BY tipo";                    $result = $conn->query($sql);

                    // Stampa i risultati
                    if ($result->num_rows > 0) {
                        //while($row = $result->fetch_assoc()) {
                            $prezzoVerstappen = "0$";
                            $prezzoPerez = "0$";
                            $prezzoRedBull = "0$";
                            $prezzoLeclerc = "0$";
                            $prezzoSainz = "0$";
                            $prezzoFerrrari = "0$";
                            $prezzoHamilton = "0$";
                            $prezzoRussell = "0$";
                            $prezzoMercedes = "0$";
                            $prezzoNorris = "0$";
                            $prezzoPiastri = "0$";
                            $prezzoMcLaren = "0$";
                            $prezzoAlonso = "0$";
                            $prezzoStroll = "0$";
                            $prezzoAstonMartin = "0$";
                            $prezzoGasly = "0$";
                            $prezzoOcon = "0$";
                            $prezzoAlpine = "0$";
                            $prezzoAlbon = "0$";
                            $prezzoSargeant = "0$";
                            $prezzoWilliams = "0$";
                            $prezzoTsunoda = "0$";
                            $prezzoRicciardo = "0$";
                            $prezzoAlphaTauri = "0$";
                            $prezzoBottas = "0$";
                            $prezzoZhou = "0$";
                            $prezzoSauber = "0$";
                            $prezzoHulkenberg = "0$";
                            $prezzoMagnussen = "0$";
                            $prezzoHaas = "0$";


                            while($row = $result->fetch_assoc()) {
                                $tipo = $row["tipo"];
                                $nome = $row["nome"];
                                $prezzo = $row["prezzo"];
                                
                                if($tipo == "Pilota"){
                                    if($nome == "Verstappen")$prezzoVerstappen = $prezzo;
                                    if($nome == "Perez")$prezzoPerez = $prezzo;
                                    if($nome == "Hamilton")$prezzoHamilton = $prezzo;
                                    if($nome == "Russell")$prezzoRussell = $prezzo;
                                    if($nome == "Leclerc")$prezzoLeclerc = $prezzo;
                                    if($nome == "Sainz")$prezzoSainz = $prezzo;
                                    if($nome == "Norris")$prezzoNorris = $prezzo;
                                    if($nome == "Piastri")$prezzoPiastri = $prezzo;
                                    if($nome == "Alonso")$prezzoAlonso = $prezzo;
                                    if($nome == "Stroll")$prezzoStroll = $prezzo;
                                    if($nome == "Gasly")$prezzoGasly = $prezzo;
                                    if($nome == "Ocon")$prezzoOcon = $prezzo;
                                    if($nome == "Albon")$prezzoAlbon = $prezzo;
                                    if($nome == "Sargeant")$prezzoSargeant = $prezzo;
                                    if($nome == "Tsunoda")$prezzoTsunoda = $prezzo;
                                    if($nome == "Ricciardo")$prezzoRicciardo = $prezzo;
                                    if($nome == "Bottas")$prezzoBottas = $prezzo;
                                    if($nome == "Zhou")$prezzoZhou = $prezzo;
                                    if($nome == "Hulkenberg")$prezzoHulkenberg = $prezzo;
                                    if($nome == "Magnussen")$prezzoMagnussen = $prezzo;
                                }

                                if($tipo == "Scuderia"){
                                    if($nome == "RedBull")$prezzoRedBull = $prezzo;
                                    if($nome == "Mercedes")$prezzoMercedes = $prezzo;
                                    if($nome == "Ferrari")$prezzoFerrari = $prezzo;
                                    if($nome == "McLaren")$prezzoMcLaren = $prezzo;
                                    if($nome == "Aston Martin")$prezzoAstonMartin = $prezzo;
                                    if($nome == "Alpine")$prezzoAlpine = $prezzo;
                                    if($nome == "Williams")$prezzoWilliams = $prezzo;
                                    if($nome == "Alpha Tauri")$prezzoAlphaTauri = $prezzo;
                                    if($nome == "Sauber")$prezzoKickSauber = $prezzo;
                                    if($nome == "Haas")$prezzoHaas = $prezzo;

                                }

                            }

                            echo     '<div class="grid-container">';
                            echo     '<div class="grid-item description">';
                            echo         '<div class="grid-container-interno">';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno">';
                            echo                     '<div class="description">';
                            echo                         '<img src="media/redbull-removebg-preview.png" alt="">';
                            echo                         '<button class="botton_costo_scuderia" data-price="' . $prezzoRedBull . '" value="RedBull">' . $prezzoRedBull . "$" .'</button>';                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno-interno">';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/versatppen.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoVerstappen . '"value="Max Verstappen">' . $prezzoVerstappen . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/perez.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoPerez . '" value="Sergio Perez">' . $prezzoPerez . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo         '</div>';
                            echo     '</div>';
                            echo     '<div class="grid-item ">';
                            echo         '<div class="grid-container-interno">';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno">';
                            echo                     '<div class="description">'; 
                            echo                         '<img src="media/mercedes-removebg-preview - fanta.png" alt="">';
                            echo                         '<button class="botton_costo_scuderia" data-price="' . $prezzoMercedes . '" value="Mercedes">' . $prezzoMercedes . "$" .'</button>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno-interno">';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/hamilton.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoHamilton . '" value="Lewis Hamilton">' . $prezzoHamilton . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/russel.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoRussell . '" value="George Russell">' . $prezzoRussell . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo         '</div>';
                            echo     '</div>';
                            echo     '<div class="grid-item ">';
                            echo         '<div class="grid-container-interno">';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno">';
                            echo                     '<div class="description">';
                            echo                         '<img src="media/ferrar-removebg-preview.png" alt="">';
                            echo                         '<button class="botton_costo_scuderia" data-price="' . $prezzoFerrari . '" value="Ferrari">' . $prezzoFerrari . "$" .'</button>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno-interno">';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/leclerc.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoLeclerc . '" value="Charles Leclerc">' . $prezzoLeclerc . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/sainz.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoSainz . '" value="Carlos Sainz">' . $prezzoSainz . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo         '</div>';
                            echo     '</div>';
                            echo     '<div class="grid-item ">';
                            echo         '<div class="grid-container-interno">';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno">';
                            echo                     '<div class="description">';
                            echo                         '<img src="media/mclaren-removebg-preview - Copia.png" alt="">';
                            echo                         '<button class="botton_costo_scuderia" data-price="' . $prezzoMcLaren . '" value="McLaren">' . $prezzoMcLaren . "$" .'</button>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno-interno">';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/Norris.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoNorris . '" value="Lando Norris">' . $prezzoNorris . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/Piastri.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoPiastri . '" value="Oscar Piastri">' . $prezzoPiastri . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo         '</div>';
                            echo     '</div>';
                            echo     '<div class="grid-item ">';
                            echo         '<div class="grid-container-interno">';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno">';
                            echo                     '<div class="description">';
                            echo                         '<img src="media/AstonMartin-removebg-preview.png" alt="">';
                            echo                         '<button class="botton_costo_scuderia" data-price="' . $prezzoAstonMartin . '" value="Aston Martin">' . $prezzoAstonMartin . "$" .'</button>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno-interno">';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/alonso.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoAlonso . '" value="Fernando Alonso">' . $prezzoAlonso . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/stroll.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoStroll . '" value="Lance Stroll">' . $prezzoStroll . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo         '</div>';
                            echo     '</div>';
                            echo     '<div class="grid-item ">';
                            echo         '<div class="grid-container-interno">';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno">';
                            echo                     '<div class="description">';
                            echo                         '<img src="media/alphine-removebg-preview - Copia.png" alt="">';
                            echo                         '<button class="botton_costo_scuderia" data-price="' . $prezzoAlpine . '" value="Alpine">' . $prezzoAlpine . "$" .'</button>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno-interno">';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/gasly.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoGasly . '" value="Pierre Gasly">' . $prezzoGasly . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/ocon.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoOcon . '" value="Esteban Ocon">' . $prezzoOcon . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo         '</div>';
                            echo     '</div>';
                            echo     '<div class="grid-item ">';
                            echo         '<div class="grid-container-interno">';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno">';
                            echo                     '<div class="description">';
                            echo                         '<img src="media/williams-removebg-preview.png" alt="">';
                            echo                         '<button class="botton_costo_scuderia" data-price="' . $prezzoWilliams . '" value="Williams"> ' . $prezzoWilliams . "$" .'</button>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno-interno">';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/albon.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoAlbon . '" value="Alexander Albon">' . $prezzoAlbon . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/sargent.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoSargeant . '" value="Logan Sargeant"> ' . $prezzoSargeant . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo         '</div>';
                            echo     '</div>';
                            echo     '<div class="grid-item ">';
                            echo         '<div class="grid-container-interno">';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno">';
                            echo                     '<div class="description">';
                            echo                         '<img src="media/AlphaTauri-removebg-preview - Copia.png" alt="">';
                            echo                         '<button class="botton_costo_scuderia" data-price="' . $prezzoAlphaTauri . '" value="Alpha Tauri">' . $prezzoAlphaTauri . "$" .'</button>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno-interno">';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/tunoda.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoTsunoda . '" value="Yuki Tsunoda"> ' . $prezzoTsunoda . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/riccardo.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoRicciardo . '" value="Daniel Ricciardo"> ' . $prezzoRicciardo . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo         '</div>';
                            echo     '</div>';
                            echo     '<div class="grid-item ">';
                            echo         '<div class="grid-container-interno">';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno">';
                            echo                     '<div class="description">';
                            echo                         '<img src="media/kik_saubern-removebg-preview.png" alt="">';
                            echo                         '<button class="botton_costo_scuderia" data-price="' . $prezzoKickSauber . '" value="Kick Sauber"> ' . $prezzoKickSauber . "$" .'</button>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno-interno">';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/bottas.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoBottas . '" value="Valterri Bottas">' . $prezzoBottas . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/zhou.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoZhou . '" value="Ghuanyu Zhou">' . $prezzoZhou . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo         '</div>';
                            echo     '</div>';
                            echo     '<div class="grid-item ">';
                            echo         '<div class="grid-container-interno">';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno">';
                            echo                     '<div class="description">';
                            echo                         '<img src="media/Haas-removebg-preview-copia.png" alt="">';
                            echo                         '<button class="botton_costo_scuderia" data-price="' . $prezzoHaas . '" value="Haas"> ' . $prezzoHaas . "$" .'</button>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo             '<div class="grid-item-interno">';
                            echo                 '<div class="grid-container-interno-interno">';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/hulkenberg.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoHulkenberg . '" value="Nico Hulkenberg"> ' . $prezzoHulkenberg . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                     '<div class="grid-container-interno">';
                            echo                         '<div class="description">';
                            echo                             '<img src="media/magnussen.avif" alt="">';
                            echo                             '<button class="botton_costo_pilota" data-price="' . $prezzoMagnussen . '" value="Kevin Magnussen"> ' . $prezzoMagnussen . "$" .'</button>';
                            echo                         '</div>';
                            echo                     '</div>';
                            echo                 '</div>';
                            echo             '</div>';
                            echo         '</div>';
                            echo     '</div>';
                            echo '</div>  ';
                        //}                     
                    } else {
                        echo "0 risultati";
                    }


                    // Chiudi la connessione
                    $conn->close();
        ?>

           
        <footer class="footer mt-0">        
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
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- PopUp personalizzato -->
        <div id="popup">
            <img src="media/logo.png" alt="logo" class="logo2">
            <p id="popup-text"></p>
            <button id="popup-close">Chiudi</button>
        </div>
        <div id="popup1" style="display: none;">
            <p id="popup1-text"></p>
        </div>
    </body>
    

    <script>
        // Seleziona il popup e il suo testo
        var popup = document.getElementById('popup');
        var popupText = document.getElementById('popup-text');

        // Seleziona il bottone per chiudere il popup
        var popupClose = document.getElementById('popup-close');

        // Seleziona l'elemento delle scelte
        var choicesElement = document.getElementById('scelte');

        // Aggiungi un event listener per chiudere il popup
        popupClose.addEventListener('click', function() {
            popup.style.display = 'none';
        });

        // Inizializza i contatori di piloti e scuderie
        

        var counters = {
            piloti: 0,
            scuderie: 0
        };

        function handleClick(button, counterName, maxCount) {
            var price = Number(button.getAttribute('data-price'));
            var totalElement = document.getElementById('total');
            var totalText = totalElement.textContent;
            var total = Number(totalText.replace(/[^0-9.-]+/g,""));
            var parentDiv = button.parentElement;

            if (parentDiv.classList.contains('disabled')) {
                total += price;
                parentDiv.classList.remove('disabled');
                parentDiv.classList.remove('clicked');
                counters[counterName]--;
            } else {
                if (price > total) {
                    popupText.textContent = "Non hai abbastanza budget per questo acquisto!";
                    popup.style.display = 'block';
                    return false;
                }
                if (counters[counterName] >= maxCount) {
                    popupText.textContent = "Non puoi scegliere più di " + maxCount + " " + counterName + "!";
                    popup.style.display = 'block';
                    return false;
                }
                total -= price;
                parentDiv.classList.add('disabled');
                parentDiv.classList.add('clicked');
                counters[counterName]++;
            }

            totalElement.textContent = "Budget disponibile: " + total + " $";
            choicesElement.textContent = "Piloti: " + counters.piloti + "/2, Scuderie: " + counters.scuderie + "/1";
            return true;
        }
        

        var scuderia = null;
        var pilota1 = null;
        var pilota2 = null;

        document.querySelectorAll('.botton_costo_scuderia').forEach(function(button) {
            button.addEventListener('click', function() {
                handleClick(button, 'scuderie', 1);
                scuderia = this.value; // Salva il valore del pulsante
                console.log(scuderia); // Stampa il valore del pulsante per verificare che sia corretto
            });
        });

        document.querySelectorAll('.botton_costo_pilota').forEach(function(button) {
            button.addEventListener('click', function() {
                var success = handleClick(button, 'piloti', 2);
                if (success) {
                    var value = this.value;

                    if (pilota1 === value) {
                        pilota1 = null;
                    } else if (pilota2 === value) {
                        pilota2 = null;
                    } else if (pilota1 === null) {
                        pilota1 = value;
                    } else if (pilota2 === null) {
                        pilota2 = value;
                    }
                }
            });
        });

        $('.button-squad').on('click', function(e) {
            e.preventDefault();

            //ALLERT DA LEVARE QUANDO FINITO
            //alert('Scuderia: ' + scuderia + '\nPilota 1: ' + pilota1 + '\nPilota 2: ' + pilota2);

            // Controlla se uno qualsiasi dei dati è null o vuoto
            if (!scuderia || !pilota1 || !pilota2) {
                var popup = document.getElementById('popup');
                var popupText = document.getElementById('popup-text');
                popupText.textContent = 'Per favore, completa tutti i campi.';
                popup.style.display = 'block';
                return;
            }
            else if (counters.scuderie != 1 || counters.piloti != 2) {
                var popup = document.getElementById('popup');
                var popupText = document.getElementById('popup-text');
                popupText.textContent = 'Per favore, completa tutti i campi.';
                popup.style.display = 'block';
                return;
            }
            //! Controllo partita gia iniziata
            var targetDate;
            // Funzione per ottenere la prossima gara dal database
            function getNextRace() {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "getNextRace.php", false); // Imposta il terzo parametro su false per rendere la chiamata sincrona
                xhr.send();

                if (xhr.status == 200) {
                    targetDate = xhr.responseText;
                }
            }
            getNextRace();
            
                var now = new Date().getTime();
                var targetDateTimestamp = new Date(targetDate).getTime();
                var timeLeft = targetDateTimestamp - now;
                var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                
                if (timeLeft < 0) {
                    // Controlla se sono passati tre giorni dalla gara
                    var threeDaysAfter = new Date(targetDate);
                    threeDaysAfter.setDate(threeDaysAfter.getDate() + 3);
                    console.log("Now: " + now + "Tempo Rimanente: " + timeLeft + "Tre giorni rimanenti: "+ threeDaysAfter);
                    if (now < threeDaysAfter) {
                        var popup = document.getElementById('popup1');
                        var popupText = document.getElementById('popup1-text');
                        popupText.textContent = 'Non puoi cambiare la squadra se la partita è iniziata.';
                        popup.style.display = 'block';
                        return;
                    }
                }
            

            // Invia i dati al server utilizzando AJAX
            $.ajax({
                type: 'POST',
                url: 'salva.php',
                data: { 
                    scuderia: scuderia,
                    pilota1: pilota1,
                    pilota2: pilota2
                },
                success: function(response) {
                    //response = JSON.parse(response.replaceAll(/\s*<.*/gs,""));
                    
                    // Pulisci la risposta rimuovendo tutto dopo il primo carattere di chiusura graffa
                    var cleanResponse = response.substring(0, response.indexOf('}') + 1);

                    console.log('Clean server response:', cleanResponse);

                    try {
                        // Prova a fare il parse della risposta pulita
                        response = JSON.parse(cleanResponse);
                    } catch (error) {
                        // Se c'è un errore nel fare il parse, stampa l'errore
                        console.error('Error parsing JSON:', error);
                        return;
                    }
                    if (response.error) {
                        var popup = document.getElementById('popup1');
                        var popupText = document.getElementById('popup1-text');
                        //alert('PopUpText: ' + popupText);
                        popupText.textContent = response.error;
                        popup.style.display = 'block';
                    } else {
                        // Gestisci il caso di successo qui
                        window.location.href = "pagina_personale.php";
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Questo blocco di codice viene eseguito quando la richiesta AJAX fallisce
                    console.log('AJAX error:', textStatus, errorThrown);
                }
            });
        });

        //NON CAMBIARE ^
        /*
        function saveTeam(scuderia, pilota1, pilota2) {
            $.ajax({
                type: "POST",
                url: "salva.php",
                data: { scuderia: scuderia, pilota1: pilota1, pilota2: pilota2 },
                dataType: "json", 
                success: function(response) {
                    if (response.error) {
                        var popup = document.getElementById('popup1');
                        var popupText = document.getElementById('popup1-text');
                        //alert('PopUpText: ' + popupText);
                        popupText.textContent = response.error;
                        popup.style.display = 'block';
                    } else {
                        // Gestisci il caso di successo qui
                        window.location.href = "index.php";
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Gestisci gli errori di rete o di server qui
                }
            });
        }*/
    </script>
</html>



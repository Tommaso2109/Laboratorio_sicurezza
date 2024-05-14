-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 07, 2024 alle 13:36
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `statistiche`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `amici`
--

CREATE TABLE `amici` (
  `utente` varchar(191) NOT NULL,
  `amico` varchar(191) NOT NULL,
  `punteggioTotale` int(191) NOT NULL,
  `punteggioStagionale` int(191) NOT NULL DEFAULT 0,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `amici`
--

INSERT INTO `amici` (`utente`, `amico`, `punteggioTotale`, `punteggioStagionale`, `id`) VALUES
('AdviceLOL', 'Francesco', 35, 0, 1),
('AdviceLOL', 'Taylor Swift', 10, 0, 2),
('AdviceLOL', 'AdviceLOL', 76, 200, 3),
('AdviceLOL', 'Tommaso', 99, 13, 15);

-- --------------------------------------------------------

--
-- Struttura della tabella `fanta`
--

CREATE TABLE `fanta` (
  `cognome` varchar(191) NOT NULL,
  `posizione` int(191) NOT NULL,
  `gare` int(191) NOT NULL,
  `vittorie` int(191) NOT NULL,
  `podi` int(191) NOT NULL,
  `fastLap` int(191) NOT NULL,
  `mediaGriglia` decimal(65,3) NOT NULL,
  `mediaFinale` decimal(65,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `fanta`
--

INSERT INTO `fanta` (`cognome`, `posizione`, `gare`, `vittorie`, `podi`, `fastLap`, `mediaGriglia`, `mediaFinale`) VALUES
('Albon', 13, 21, 0, 0, 0, 11.950, 11.110),
('Alonso', 5, 24, 0, 8, 1, 6.050, 5.600),
('Bottas', 15, 23, 0, 0, 0, 13.000, 13.370),
('Gasly', 11, 24, 0, 1, 0, 11.140, 10.240),
('Hamilton', 3, 23, 0, 6, 5, 6.090, 4.900),
('Hulkenberg', 16, 25, 0, 0, 0, 9.680, 14.290),
('Leclerc', 4, 21, 0, 8, 2, 4.430, 4.065),
('Magnussen', 19, 22, 0, 0, 0, 12.550, 14.890),
('Norris', 6, 25, 0, 8, 2, 7.950, 7.430),
('Ocon', 12, 20, 0, 1, 0, 10.410, 9.310),
('Perez', 2, 24, 2, 10, 2, 5.725, 3.625),
('Piastri', 9, 23, 0, 2, 2, 7.820, 7.810),
('Ricciardo', 18, 10, 0, 0, 0, 13.710, 12.710),
('Russell', 8, 23, 0, 2, 2, 6.450, 6.630),
('Sainz', 7, 23, 2, 4, 0, 4.550, 4.315),
('Sargeant', 20, 20, 0, 0, 0, 15.910, 15.000),
('Stroll', 10, 20, 0, 0, 0, 10.090, 9.330),
('Tsunoda', 14, 24, 0, 0, 2, 13.820, 12.550),
('Verstappen', 1, 25, 21, 2, 13, 2.095, 1.135),
('Zhou', 17, 22, 0, 0, 1, 14.770, 13.420);

-- --------------------------------------------------------

--
-- Struttura della tabella `nextgare`
--

CREATE TABLE `nextgare` (
  `Luogo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Data` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `nextgare`
--

INSERT INTO `nextgare` (`Luogo`, `Data`) VALUES
('Abu Dhabi', '2024-12-06 10:30:00.000000'),
('Austria', '2024-06-28 12:30:00.000000'),
('Azerbigian', '2024-09-15 11:30:00.000000'),
('Barcellona', '2024-06-21 13:30:00.000000'),
('Belgio', '2024-07-28 13:30:00.000000'),
('Cananda', '2024-06-07 19:30:00.000000'),
('Citta del Messico', '2024-10-25 20:30:00.000000'),
('Emilia Romagna', '2024-05-17 13:30:00.000000'),
('Gran Bretagna', '2024-07-05 13:30:00.000000'),
('Las Vegas', '2024-11-22 09:30:00.000000'),
('Monaco', '2024-05-24 13:30:00.000000'),
('Monza', '2024-08-30 13:30:00.000000'),
('Olanda', '2024-08-23 12:30:00.000000'),
('Qatar', '2024-11-29 15:30:00.000000'),
('San Paolo', '2024-11-01 06:30:00.000000'),
('Singapore', '2024-09-20 11:30:00.000000'),
('USA', '2024-10-18 05:30:00.000000'),
('Ungheria', '2024-07-19 19:30:00.000000');

-- --------------------------------------------------------

--
-- Struttura della tabella `prezzi`
--

CREATE TABLE `prezzi` (
  `tipo` varchar(191) NOT NULL,
  `nome` varchar(191) NOT NULL,
  `prezzo` int(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prezzi`
--

INSERT INTO `prezzi` (`tipo`, `nome`, `prezzo`) VALUES
('Pilota', 'Albon', 3200),
('Pilota', 'Alonso', 5800),
('Scuderia', 'Alpha Tauri', 2100),
('Scuderia', 'Alpine', 3300),
('Scuderia', 'Aston Martin', 5100),
('Pilota', 'Bottas', 3200),
('Scuderia', 'Ferrari', 5700),
('Pilota', 'Gasly', 3200),
('Scuderia', 'Haas', 2200),
('Pilota', 'Hamilton', 5900),
('Pilota', 'Hulkenberg', 2200),
('Pilota', 'Leclerc', 6000),
('Pilota', 'Magnussen', 2100),
('Scuderia', 'McLaren', 5100),
('Scuderia', 'Mercedes', 5200),
('Pilota', 'Norris', 5700),
('Pilota', 'Ocon', 3200),
('Pilota', 'Perez', 6100),
('Pilota', 'Piastri', 4400),
('Scuderia', 'RedBull', 6900),
('Pilota', 'Ricciardo', 2100),
('Pilota', 'Russell', 4500),
('Pilota', 'Sainz', 5900),
('Pilota', 'Sargeant', 2200),
('Scuderia', 'Sauber', 2700),
('Pilota', 'Stroll', 4300),
('Pilota', 'Tsunoda', 3200),
('Pilota', 'Verstappen', 8100),
('Scuderia', 'Williams', 2700),
('Pilota', 'Zhou', 2100);

-- --------------------------------------------------------

--
-- Struttura della tabella `scuderie`
--

CREATE TABLE `scuderie` (
  `nome` varchar(191) NOT NULL,
  `position` int(191) NOT NULL,
  `prezzoP1` int(191) NOT NULL,
  `prezzoP2` int(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `scuderie`
--

INSERT INTO `scuderie` (`nome`, `position`, `prezzoP1`, `prezzoP2`) VALUES
('Alpha Tauri', 8, 2100, 2100),
('Alpine', 6, 3200, 3300),
('Aston Martin', 5, 5800, 4300),
('Ferrari', 3, 5800, 5600),
('Haas', 10, 2100, 2200),
('McLaren', 4, 5700, 4400),
('Mercedes', 2, 5900, 4500),
('RedBull', 1, 7800, 5900),
('Sauber', 9, 2200, 3200),
('Williams', 7, 3200, 2100);

-- --------------------------------------------------------

--
-- Struttura della tabella `squadra`
--

CREATE TABLE `squadra` (
  `utente` varchar(191) NOT NULL,
  `scuderia` varchar(191) NOT NULL,
  `pilota1` varchar(191) NOT NULL,
  `pilota2` varchar(191) NOT NULL,
  `punteggioTotale` int(191) NOT NULL,
  `prevSquadra` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `squadra`
--

INSERT INTO `squadra` (`utente`, `scuderia`, `pilota1`, `pilota2`, `punteggioTotale`, `prevSquadra`) VALUES
('AdviceLOL', 'RedBull', 'Charles Leclerc', 'Daniel Ricciardo', 45, 1),
('Francesco', 'Ferrari', 'Charles Leclerc', 'Alexander Albon', 35, 0),
('Taylor Swift', 'Mercedes', 'Lewis Hamilton', 'Sergio Perez', 10, 0),
('Tommaso', 'RedBull', 'Lando Norris', 'Daniel Ricciardo', 99, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `ultimagara`
--

CREATE TABLE `ultimagara` (
  `posizione` int(191) NOT NULL,
  `nome` varchar(191) NOT NULL,
  `scuderia` varchar(191) NOT NULL,
  `fastLap` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ultimagara`
--

INSERT INTO `ultimagara` (`posizione`, `nome`, `scuderia`, `fastLap`) VALUES
(18, 'Alexander Albon', 'Williams', 0),
(5, 'Carlos Sainz', 'Ferrari', 0),
(3, 'Charles Leclerc', 'Ferrari', 0),
(15, 'Daniel Ricciardo', 'Alpha Tauri', 0),
(10, 'Esteban Ocon', 'Alpine', 0),
(9, 'Fernando Alonso', 'Aston Martin', 0),
(8, 'George Russell', 'Mercedes', 0),
(14, 'Ghuanyu Zhou', 'Sauber', 0),
(19, 'Kevin Magnussen', 'Haas', 0),
(17, 'Lance Stroll', 'Aston Martin', 0),
(1, 'Lando Norris', 'McLaren', 0),
(6, 'Lewis Hamilton', 'Mercedes', 0),
(20, 'Logan Sargent', 'Williams', 0),
(2, 'Max Verstappen', 'RedBull', 0),
(11, 'Nico Hulkenberg', 'Haas', 0),
(13, 'Oscar Piastri', 'McLaren', 1),
(12, 'Pierre Gasly', 'Alpine', 0),
(4, 'Sergio Perez', 'RedBull', 0),
(16, 'Valteri Bottas', 'Sauber', 0),
(7, 'Yuki Tsunoda', 'Alpha Tauri', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `username` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `profile_image` varchar(191) NOT NULL,
  `record_reaction` varchar(191) NOT NULL DEFAULT '00.999',
  `punteggioStagionale` int(191) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`username`, `email`, `password`, `profile_image`, `record_reaction`, `punteggioStagionale`) VALUES
('AdviceLOL', 'dariodisanto19@gmail.com', 'Stocazzo5', 'uploads/609408376a70fe9709ea689887adf04abf68d1b6_full.jpg', '00.251', 400),
('Francesco', 'Gesco2002@gmail.com', 'Gesco122002', 'uploads/Screenshot_20231021_233316_Instagram.jpg', '100000.00', 0),
('Il Papa', 'papavatican@gmail.com', 'Papagang69', 'uploads/EjgeRFFXsAIesP0 - Copia.jfif', '308.59999999403954', 0),
('Tommaso', 'tommasogay@gmail.com', 'Stocazzo3', 'uploads/Cattura.PNG', '00:00:00.000000', 13);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `amici`
--
ALTER TABLE `amici`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `fanta`
--
ALTER TABLE `fanta`
  ADD PRIMARY KEY (`cognome`);

--
-- Indici per le tabelle `nextgare`
--
ALTER TABLE `nextgare`
  ADD PRIMARY KEY (`Luogo`);

--
-- Indici per le tabelle `prezzi`
--
ALTER TABLE `prezzi`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `scuderie`
--
ALTER TABLE `scuderie`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `squadra`
--
ALTER TABLE `squadra`
  ADD PRIMARY KEY (`utente`);

--
-- Indici per le tabelle `ultimagara`
--
ALTER TABLE `ultimagara`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `amici`
--
ALTER TABLE `amici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

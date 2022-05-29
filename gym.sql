-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 29, 2022 alle 23:11
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `likes`
--

CREATE TABLE `likes` (
  `user` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `likes`
--

INSERT INTO `likes` (`user`, `post`) VALUES
('Slavo', 'Sala CrossFit');

--
-- Trigger `likes`
--
DELIMITER $$
CREATE TRIGGER `likesTrigger` AFTER INSERT ON `likes` FOR EACH ROW BEGIN
UPDATE posts 
SET nlikes = nlikes + 1
WHERE titolo = new.post;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `likes_trigger` AFTER INSERT ON `likes` FOR EACH ROW BEGIN
UPDATE posts 
SET nlikes = nlikes + 1
WHERE id = new.post;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `unlikesTrigger` AFTER DELETE ON `likes` FOR EACH ROW BEGIN
UPDATE posts 
SET nlikes = nlikes - 1
WHERE titolo = old.post;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `unlikes_trigger` AFTER DELETE ON `likes` FOR EACH ROW BEGIN
UPDATE posts 
SET nlikes = nlikes - 1
WHERE id = old.post;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `titolo` varchar(255) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `immagine` varchar(255) DEFAULT NULL,
  `nlikes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `posts`
--

INSERT INTO `posts` (`id`, `titolo`, `descrizione`, `immagine`, `nlikes`) VALUES
(1, 'Sala pesi', 'La sala pesi si sviluppa sull’ampia zona suddivisa tra cardiofitness, attrezzi isotonici, pesi liberi, area funzionale e area dedicata al corpo libero. Gli attrezzi Technogym di ultima generazione, rinnovati secondo tendenze con software continuamente aggiornati, offrono allenamenti efficaci supportati dalla presenza di istruttori qualificati e di esperienza che seguono e accrescono il percorso per il raggiungimento degli obiettivi.', 'https://palestratortona.it/wp-content/uploads/2019/10/SalaPesi_PalestraTortona_3.jpg', 0),
(2, 'Sala CrossFit', 'Il CrossFit è un programma di allenamento e condizionamento muscolare che usa diversi movimenti funzionali ad alta intensità. E’ una disciplina che negli ultimi anni sta spopolando in Italia e in tutto il mondo. Il CrossFit allena il sistema cardiovascolare, migliora la condizione fisica e sviluppa le tue capacità sportive. Il crossFit si pratica in una box (sala con materiale adatto) e gli allenamenti WOD (workout of the day) sono composti da 52 esercizi. Ad esempio, i pull-up, push-up, snatch, vengono realizzati in sequenza e in gruppo per creare emulazione.', 'https://www.taoplus.es/wp-content/uploads/2017/02/2017-02-21_58ac5cd99d20e_crossfitnaga1-e1487778399611.jpg', 1),
(3, 'Sala Funzionale', 'L’allenamento di tipo funzionale (Fuctional Trining) Scopo dell’allenamento funzionale è sviluppare un corpo che sia forte e proporzionato, grazie ad esercizi che richiamano le funzioni base per cui è nato. Per questo motivo i programmi propri dell’allenamento funzionale “mimano” le singole attività fisiche, che il corpo umano fa per natura. L’allenamento funzionale, pertanto, è un allenamento “a tutto tondo”, non vi è una specificità precisa. Essere funzionali vuol dire essere forti, reattivi, agili, veloci, elastici e coordinati. La sala è attrezzata con una grande rack Funzionale e tutti gli attrezzi e pesi, pesetti che aiuteranno a stimolare la nostra muscolatura', 'https://www.matrixfitnessblog.it/wp-content/uploads/2012/05/area-funzionale1.jpg', 0),
(4, 'Sala Tapis roulant', 'Sala ampia e spaziona, attrezzata con numerosi tapis roulant in grando di gestire al meglio un numero consistende di persone. Il principio dei tapis roulant come fonte di energia ha origine nell\'antichità. Queste macchine potevano essere di tre tipi: il primo, aveva una barra orizzontale che sporgeva da un asse verticale. La barra veniva spinta da un animale o da un essere umano. Il secondo tipo era una ruota a scorrimento verticale alimentata da un meccanismo di scalata sul posto. Il suo funzionamento è quello della ruota del criceto. Il terzo tipo era simile al secondo ma era costituito da una piattaforma mobile inclinata per l\'arrampicata, invece di quella verticale. ', 'https://judoalicante.es/wp-content/uploads/2019/12/IMG_2917-scaled-1.jpg', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cognome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `nome`, `cognome`, `email`, `password`) VALUES
(1, 'Slavo', 'Paolo', '', 'stillittano2000@gmail.com', '$2y$10$wtYCV7WZNSUIBlSxrfe9SuCRdwncBBrOi4igFs.8wG34TkBGW40rO');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`user`,`post`),
  ADD KEY `yuser` (`user`),
  ADD KEY `ypost` (`post`);

--
-- Indici per le tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titolo` (`titolo`),
  ADD KEY `xpost` (`titolo`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `xuser` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post`) REFERENCES `posts` (`titolo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

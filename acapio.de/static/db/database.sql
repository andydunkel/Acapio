-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2025 at 03:40 PM
-- Server version: 8.0.43-0ubuntu0.24.04.2
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scamdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `scams`
--

CREATE TABLE `scams` (
  `id` int NOT NULL,
  `scam_type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `message_content` text COLLATE utf8mb4_general_ci NOT NULL,
  `language` varchar(10) COLLATE utf8mb4_general_ci DEFAULT 'de',
  `date_received` date DEFAULT NULL,
  `date_submitted` datetime DEFAULT CURRENT_TIMESTAMP,
  `notes` text COLLATE utf8mb4_general_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_general_ci DEFAULT 'approved',
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scams`
--

INSERT INTO `scams` (`id`, `scam_type`, `message_content`, `language`, `date_received`, `date_submitted`, `notes`, `status`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'Kreditscam', 'Benötigen Sie dringend einen Kredit mit 3% Zinsen? Falls ja, kontaktieren Sie uns bitte für weitere Informationen über: exoticloanfirm38@gmail.com ', 'de', '2025-11-16', '2025-11-16 15:15:06', '', 'approved', NULL, '2025-11-16 14:15:06', '2025-11-16 14:15:06'),
(2, 'Gewinn von Elon Musk', 'Hallo, herzlichen Glückwunsch! Hier ist Elon Musk Tesla. Wir freuen uns, Ihnen mitteilen zu können, dass Ihr Name durch Ihren Kommentar auf unserer Facebook-Seite und per E-Mail zufällig ausgewählt wurde und Ihnen ein Betrag von $500.000,00 USD sowie ein brandneues Tesla-Modell zugeteilt wurde. Bitte antworten Sie an: (elonmusktesla0102@gmail.com) / https://en.wikipedia.org/wiki/Elon_Musk Weiter. Vielen Dank. Nochmals herzlichen Glückwunsch.', 'de', '2025-11-16', '2025-11-16 17:01:03', '', 'approved', NULL, '2025-11-16 16:01:03', '2025-11-16 16:01:03'),
(3, 'Angeblicher Gewinn: European Elgordo Lottery', ' C/l Sta Engracia,\r\n98 - 100, 28010, Madrid\r\nTele/Fax : +34-631-101981.\r\n\r\n                                                                  30 - OKTOBER - 2025\r\n\r\nSehr geehrter Gewinner\r\n\r\nWir wurden beauftragt, Ihnen zu helfen Ihr Gewinn zu beanspruche in der letzten Sitzung der\r\nEuropean Elgordo Lottery 2024/2025. Ihre Informationen wurden aus einer Online-Umfrage und\r\nZahlungssystemen ausgewählt.\r\n\r\nAus Tausenden von E-Mails und Namen erhalten von den internationalen Umfrage und\r\nZahlungssystemen, um Teilnahme an der Europäischen Online Elgordo Lotterie/Nationale Lotterie\r\n2024/2025, Sie ein Gewinner in der zuerst Kategorie sind mit Gewinnnummer (72480). Gewinnen\r\nbetrag €4.000.000,00\r\n\r\nUnten ist die Information von der geprüfte und zugewiesene Rechtsanwalts/Ansprüche Agent die Sie\r\nmüssen kontaktieren, um Ihnen zu helfen, Ihr Geld zu verarbeiten, das in Ihrem Namen bei der\r\nlotteriezahlenden Bank hinterlegt ist und jetzt zur Auszahlung bereit ist.\r\n\r\nAgent name: Herr Luis Chabaneix. Tel : +34- 610- 003985.\r\nVIA Email:  chabaneixabogadosygestoria@gmail.com . Rechtsanwalt / Agent ,\r\nWEBSEITE:  https://ergodolotto.com\r\n\r\nAufmerksamkeit!!!\r\nUm Ihrem Anspruch zu beginnen, es ist wichtig dass Sie Ihren Agenten sofort kontaktieren und\r\nausfüllen Sie das Formular unter und folgen Sie seinen Anweisungen für die schnelle und einfache\r\nÜberweisung Ihre Gewinn.\r\n\r\nFreundliche Grüße\r\nDr. Raul De Molina Sanchez\r\nKPMG administration.\r\n\r\nEU-Claims\r\n\r\nNAMEN::---------------------------------\r\n\r\nANSCHRIFT:-------------------------------\r\n\r\nGEBURTSDATUM:--------------------------\r\n\r\nFAMILIENSTAND :------------------------\r\n\r\nGESCHLECHT:----------------------------\r\n\r\nBERUF:--------------------------------\r\n\r\nNATIONALITÄT:------------------------\r\n\r\nBETRAG GEWONNEN:--------------------------------------\r\n\r\nTELEPHONE:----------------------------------------\r\n\r\nMOBILE:--------------------------------------------- ', 'de', '2025-11-16', '2025-11-16 17:02:02', '', 'approved', NULL, '2025-11-16 16:02:02', '2025-11-16 16:02:02'),
(4, 'Steuererstattung Elster', 'Guten Tag,\r\n\r\nein neues \"Gesetz zur Modernisierung des Besteuerungsverfahrens\" verlangt von uns, die Identifikation unserer Nutzer regelmäßig zu überprüfen. Diese Regelung im § 146 AO dient dem Datenschutz und der Verfahrenssicherheit.\r\n\r\nDamit die Bearbeitung und Auskehr Ihrer Steuererstattung nicht ins Stocken gerät, muss Ihre Identität einmalig bestätigt werden.\r\n\r\nBitte nehmen Sie die Bestätigung umgehend in Ihrem persönlichen Bereich vor.\r\n\r\nWir schätzen Ihre Kooperation.\r\n\r\nMit freundlichen Grüßen,\r\n\r\nThomas Berger\r\nSachgebiet Bürger-Service', 'de', '2025-11-04', '2025-11-16 17:44:54', '', 'approved', NULL, '2025-11-16 16:44:54', '2025-11-16 16:44:54'),
(5, 'SPENDE IN HÖHE VON 3.700.000,00 £', 'Ihre E-Mail-Adresse wurde für eine Spende in Höhe von 3.700.000,00 £ ausgewählt. Kontaktieren Sie mich für weitere Informationen.\r\n', 'de', '2025-11-17', '2025-11-17 16:47:59', '', 'approved', NULL, '2025-11-17 15:47:59', '2025-11-17 15:47:59'),
(6, 'Maria Elisabeth Schaeffler', 'Ich bin Maria Elisabeth Schaeffler, eine deutsche Unternehmerin, Investorin und CEO der Schaeffler-Gruppe. Ich habe beschlossen, 1.800.000,00 € an 100 Personen zu spenden. Wenn Sie an meiner Spende interessiert sind, kontaktieren Sie mich bitte für weitere Informationen:', 'de', NULL, '2025-11-17 16:51:17', '', 'approved', NULL, '2025-11-17 15:51:17', '2025-11-17 15:51:17'),
(7, 'MARIA: 4,8 Mio Spende', 'Ihre E-Mail-Adresse wurde für eine Spende in Höhe von 4.800.000,00 Euro ausgewählt. Kontaktieren Sie mich für weitere Informationen.', 'de', '2025-11-18', '2025-11-18 10:59:46', '', 'approved', NULL, '2025-11-18 09:59:46', '2025-11-18 09:59:46'),
(8, 'Geschäftsvorschlag von David Johnson', '\r\nSehr geehrte/r Empfänger/in,\r\n\r\nzunächst möchte ich Sie um Ihr Vertrauen in dieser Angelegenheit bitten. Aufgrund ihrer streng vertraulichen Natur ist absolute Diskretion unerlässlich. Ich spreche kein Deutsch, übersetze Ihnen aber alles, damit Sie es verstehen. Mir ist bewusst, dass eine Transaktion dieser Größenordnung für jeden beunruhigend und besorgniserregend sein kann, aber ich versichere Ihnen, dass alles rechtmäßig abgewickelt wird. Erlauben Sie mir, mich kurz vorzustellen. Mein Name ist David Johnson. Ich war Principal Asset Manager bei der Hang Seng Bank, einem Mitglied der HSBC-Gruppe, einem der weltweit größten Investmentbanken und Finanzdienstleistungsunternehmen. Ich wende mich an Sie, um Sie um Ihre Unterstützung bei der Sicherung einer Bareinlage zu bitten, die mein verstorbener Mandant, ein ausländischer Ölberater/Auftragnehmer eines chinesischen Mineralienunternehmens, hinterlassen hat.\r\n\r\nMein Ziel ist es, zu verhindern, dass die Erträge aus dieser Anlage von der Bank, bei der mein verstorbener Mandant den Betrag vor seinem Tod am 16. April 2014 eingezahlt hat, beschlagnahmt oder für ungültig erklärt werden. Er hat kein Testament hinterlassen, und seine Erben sind unbekannt. Bisher hat niemand Ansprüche geltend gemacht, weshalb ich Ihre Unterstützung benötige.\r\n\r\nIch bin vor Kurzem in den Ruhestand getreten und habe gerade eine langwierige Scheidung hinter mir. Über die Jahre habe ich im Stillen einen Plan entwickelt und auf den richtigen Moment gewartet. Ich besitze alle relevanten Dokumente und Informationen bezüglich der Bareinlage und garantiere daher den Erfolg dieser Transaktion in jeder Hinsicht. Sollte dieses Vorhaben gegen Ihre moralischen Grundsätze verstoßen, bitte ich um Entschuldigung. Falls Sie jedoch an einer Zusammenarbeit interessiert sind, kontaktieren Sie mich bitte, damit ich Ihnen alle notwendigen Informationen und einen detaillierten Plan für die Umsetzung dieses Projekts zukommen lassen kann.\r\n\r\nIch freue mich auf Ihre baldige Antwort.\r\n\r\nMit freundlichen Grüßen,\r\n\r\nDavid Johnson', 'de', '2025-11-18', '2025-11-18 11:02:36', '', 'approved', NULL, '2025-11-18 10:02:36', '2025-11-18 10:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `scam_categories`
--

CREATE TABLE `scam_categories` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scam_categories`
--

INSERT INTO `scam_categories` (`id`, `name`, `description`) VALUES
(1, 'Erbschaftsbetrug', 'Inheritance/heir scams'),
(2, 'Lotteriegewinn', 'Lottery/prize scams'),
(3, 'Romance Scam', 'Dating and romance scams'),
(4, 'Phishing', 'Phishing attempts'),
(5, 'Jobangebot', 'Fake job offers'),
(6, 'Vorschussbetrug', 'Advance-fee fraud'),
(7, 'Paketbetrug', 'Package delivery scams');

-- --------------------------------------------------------

--
-- Table structure for table `scam_category_link`
--

CREATE TABLE `scam_category_link` (
  `scam_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scam_category_link`
--

INSERT INTO `scam_category_link` (`scam_id`, `category_id`) VALUES
(3, 2),
(4, 4),
(1, 6),
(2, 6),
(3, 6),
(5, 6),
(6, 6),
(7, 6),
(8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `scam_emails`
--

CREATE TABLE `scam_emails` (
  `id` int NOT NULL,
  `scam_id` int NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scam_emails`
--

INSERT INTO `scam_emails` (`id`, `scam_id`, `email_address`) VALUES
(1, 1, 'exoticloanfirm38@gmail.com'),
(2, 2, 'elonmusktesla0102@gmail.com'),
(3, 3, 'lawyer@chabaneixabogados.org'),
(6, 5, 'conllyfrancess@gmail.com'),
(7, 7, 'ems19608112@gmail.com'),
(8, 8, '61djjohnson@gmail.com'),
(9, 6, 'mariaelisa07702@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `scam_names`
--

CREATE TABLE `scam_names` (
  `id` int NOT NULL,
  `scam_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scam_names`
--

INSERT INTO `scam_names` (`id`, `scam_id`, `name`) VALUES
(1, 7, 'Maria'),
(2, 8, 'David Johnson'),
(3, 6, 'Maria Elisabeth Schaeffler');

-- --------------------------------------------------------

--
-- Table structure for table `scam_phone_numbers`
--

CREATE TABLE `scam_phone_numbers` (
  `id` int NOT NULL,
  `scam_id` int NOT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scams`
--
ALTER TABLE `scams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scam_categories`
--
ALTER TABLE `scam_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `scam_category_link`
--
ALTER TABLE `scam_category_link`
  ADD PRIMARY KEY (`scam_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `scam_emails`
--
ALTER TABLE `scam_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scam_id` (`scam_id`),
  ADD KEY `idx_email` (`email_address`);

--
-- Indexes for table `scam_names`
--
ALTER TABLE `scam_names`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scam_id` (`scam_id`),
  ADD KEY `idx_name` (`name`);

--
-- Indexes for table `scam_phone_numbers`
--
ALTER TABLE `scam_phone_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scam_id` (`scam_id`),
  ADD KEY `idx_phone` (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scams`
--
ALTER TABLE `scams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `scam_categories`
--
ALTER TABLE `scam_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `scam_emails`
--
ALTER TABLE `scam_emails`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `scam_names`
--
ALTER TABLE `scam_names`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scam_phone_numbers`
--
ALTER TABLE `scam_phone_numbers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `scam_category_link`
--
ALTER TABLE `scam_category_link`
  ADD CONSTRAINT `scam_category_link_ibfk_1` FOREIGN KEY (`scam_id`) REFERENCES `scams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scam_category_link_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `scam_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scam_emails`
--
ALTER TABLE `scam_emails`
  ADD CONSTRAINT `scam_emails_ibfk_1` FOREIGN KEY (`scam_id`) REFERENCES `scams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scam_names`
--
ALTER TABLE `scam_names`
  ADD CONSTRAINT `scam_names_ibfk_1` FOREIGN KEY (`scam_id`) REFERENCES `scams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scam_phone_numbers`
--
ALTER TABLE `scam_phone_numbers`
  ADD CONSTRAINT `scam_phone_numbers_ibfk_1` FOREIGN KEY (`scam_id`) REFERENCES `scams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
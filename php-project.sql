
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `boardgame` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `minplayer` int(11) NOT NULL,
  `maxplayer` int(11) NOT NULL,
  `playtime` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `boardgame` (`id`, `name`, `description`, `minplayer`, `maxplayer`, `playtime`, `image`) VALUES
(11, 'A MARS TERRAFORMÁLÁSA', 'A Mars terraformálása egy közepesen összetett társasjáték, 1 - 5 játékos részére, az átlagos játékidő hosszabb, akár 2 óra is lehet. A játékot az Év Játékának jelölték 2016-ban (BGG), illetve 2016-ban és 2017-ben több, összesen 3 másik jelölést is kapott. A társast, a bonyolultsága miatt, csak 12 éves kortól ajánljuk kipróbálni. A játékmenet erősen épít a lapka-elhelyezés, a kollekció gyűjtés, a váltakozó képességek, a hatszög-rács és a pakli tervezés mechanizmusokra.', 1, 5, '2 óra', '1716397621_664e26352a01a.jpeg'),
(12, 'EVERDELL - AZ ÖRÖKFA ÁRNYÉKÁBAN', 'Az Everdell - Az örökfa árnyékában egy közepesen összetett társasjáték, 1 - 4 játékos részére, az átlagos játékidő 40 - 80 perc. A játékot 2018-ban jelölték a Golden Geek Awards díjára Az Év Játéka kategóriában, illetve szintén ebben az évben jelölték a Golden Geek Awards díjára is Legjobb grafika/prezentáció kategóriában. A társast, a bonyolultsága miatt, csak 10 éves kortól ajánljuk kipróbálni. A játékmenet erősen épít a kollekció gyűjtés, a pakli tervezés, a kártya húzás, a munkás-elhelyezés és a solitaire mechanizmusokra.', 1, 4, '40 - 80 perc', '1716397734_664e26a669cbb.jpeg'),
(13, '7 CSODA: PÁRBAJ', 'A 7 Csoda: Párbaj egy könnyen tanulható társasjáték, 2 játékos részére, az átlagos játékidő rövid, csak 30 perc. A játékot az Év Játékának jelölték 2015-ben (BGG), illetve ebben az évben több, összesen 3 másik elismerést és jelölést is kapott. A társast, a könnyebb tanulhatósága ellenére, csak 10 éves kortól ajánljuk kipróbálni. A játékmenet erősen épít a kollekció gyűjtés, a moduláris tábla, a váltakozó képességek, a kártya húzás és az once-per-game abilities mechanizmusokra.', 2, 2, '30 perc', '1716398033_664e27d169147.jpeg'),
(14, 'TICKET TO RIDE: EURÓPA', 'A Ticket to Ride: Európa egy könnyen tanulható társasjáték, 2 - 5 játékos részére, az átlagos játékidő rövidebb, csak 30 - 60 perc. A játék 2013-ban megnyerte a Magyar Társasjátékdíj díját különdíj kategóriában, illetve 2006-ban jelölték a Golden Geek Awards díjára is Legjobb családi játék kategóriában. A társast, a könnyebb tanulhatósága miatt, akár már 8 éves kortól ajánljuk kipróbálni. A játékmenet erősen épít a kollekció gyűjtés, a pakli tervezés, a kártya húzás, az útépítés és a merj és nyerj mechanizmusokra.', 2, 5, '30 - 60 perc', '1716398132_664e2834b80c8.jpeg'),
(15, 'PANDEMIC', 'A Pandemic egy könnyen tanulható társasjáték, 2 - 4 játékos részére, az átlagos játékidő rövidebb, csak 45 perc. A játékot az Év Játékának jelölték 2015-ben (Magyar Társasjátékdíj) és 2009-ben (Spiel des Jahres), illetve ezekben az években több, összesen 9 másik elismerést és jelölést is kapott. A társast, a könnyebb tanulhatósága miatt, akár már 8 éves kortól ajánljuk kipróbálni. Kooperatív jellegű, a játékmenet erősen épít az akció pontok, a kollekció gyűjtés, a váltakozó képességek, a pakli tervezés és a pontról pontra mozgás mechanizmusokra.', 2, 4, '45 perc', '1716398216_664e288843b1a.jpeg'),
(16, 'CARCASSONNE', 'A Carcassonne egy könnyen tanulható társasjáték, 2 - 5 játékos részére, az átlagos játékidő rövidebb, csak 30 - 45 perc. A játék 2001-ben megnyerte a Spiel des Jahres díját Az Év Játéka kategóriában. A társast, a könnyebb tanulhatósága miatt, akár már 7 éves kortól ajánljuk kipróbálni. A játékmenet erősen épít a lapka-elhelyezés, a terület foglalás, a minta felismerés, a terület befolyásolás/irányítás és a mov-16 map addition mechanizmusokra.', 2, 4, '30 - 45 perc', '1716398283_664e28cbcfa5b.jpeg'),
(17, 'VITICULTURE: ESSZENCIÁLIS KIADÁS', 'A Viticulture: Esszenciális kiadás egy közepesen összetett társasjáték, 1 - 6 játékos részére, az átlagos játékidő 45 - 90 perc. A társast, a bonyolultsága miatt, csak 13 éves kortól ajánljuk kipróbálni. A játékmenet erősen épít a pakli tervezés, a munkás-elhelyezés, a solitaire, a turn order: auction és a vic-04 victory points as a resource mechanizmusokra. - Tarsasjatekok.com', 2, 4, '45 - 90 perc', '1716398344_664e29087b52e.jpeg'),
(18, 'THE CASTLES OF BURGUNDY', 'A The Castles of Burgundy egy közepesen összetett társasjáték, 2 - 4 játékos részére, az átlagos játékidő 30 - 90 perc. A játékot 2011-ben jelölték a Golden Geek Awards díjára Legjobb stratégiai játék kategóriában, illetve 2012-ben jelölték a Golden Geek Awards díjára is Legjobb stratégiai játék kategóriában. A társast, a bonyolultsága miatt, csak 12 éves kortól ajánljuk kipróbálni. A játékmenet erősen épít a lapka-elhelyezés, a hatszög-rács, a kártya húzás, a minták és a kockadobás mechanizmusokra.', 2, 4, '30 - 90 perc', '1716398425_664e295973cf4.jpeg'),
(19, 'CONCORDIA: SESTERTIUSSAL KIKÖVEZETT UTAK', 'A Concordia: Sestertiussal kikövezett utak egy közepesen összetett társasjáték, 2 - 5 játékos részére, az átlagos játékidő hosszabb, akár 2 óra is lehet. A játékot 2014-ben jelölték a Spiel des Jahres díjára Az Év Gémerjátéka kategóriában. A társast, a bonyolultsága miatt, csak 13 éves kortól ajánljuk kipróbálni. A játékmenet erősen épít a kollekció gyűjtés, a pakli tervezés, a kártya húzás, a pontról pontra mozgás és a pakli építés mechanizmusokra. - Tarsasjatekok.com', 2, 5, '90 perc', '1716398482_664e29921ca44.jpeg');


CREATE TABLE `comment` (
  `ID` int(11) NOT NULL,
  `Boardgame_ID` int(11) DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Comment_Text` text,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Edited` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `comment` (`ID`, `Boardgame_ID`, `User_ID`, `Comment_Text`, `Created_at`, `Edited`) VALUES
(3, 11, 12, 'xxycxycyx', '2024-05-23 19:27:49', 0);

-- --------------------------------------------------------


CREATE TABLE `user_form` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `image`, `admin`) VALUES
(12, 'Admin', 'admin@admin.admin', 'cc03e747a6afbbcbf8be7668acfebee5', '1716398834_664e2af230400.jpeg', 1),
(13, 'test', 'test@test.test', 'cc03e747a6afbbcbf8be7668acfebee5', '', 0),
(14, 'test2', 'test2@test.test', 'cc03e747a6afbbcbf8be7668acfebee5', '', 0);


ALTER TABLE `boardgame`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `comment_ibfk_1` (`Boardgame_ID`),
  ADD KEY `comment_ibfk_2` (`User_ID`);


ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `boardgame`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;


ALTER TABLE `comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `user_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;


ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`Boardgame_ID`) REFERENCES `boardgame` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `user_form` (`id`) ON DELETE CASCADE;
COMMIT;


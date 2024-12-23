-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 20 déc. 2024 à 14:46
-- Version du serveur : 8.0.40-0ubuntu0.22.04.1
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `film`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `firstname_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mail_user` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `psw_user` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `birthday_user` date NOT NULL,
  `image_user` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `firstname_user`, `lastname_user`, `mail_user`, `psw_user`, `birthday_user`, `image_user`) VALUES
(1, 'ggfdd', 'tyyyuy', '007@conic.com', '$argon2i$v=19$m=65536,t=4,p=1$YXdDQVp5dVRxUGpyOXptVA$1kPO1El/zfGCjgetc7CFjs/zsJWF8D+h7aPcDEI6UaU', '2000-12-01', '89825a48ec7b343a199bd7bacfaad349b17d5186ggfdd_tyyyuy.jpeg'),
(2, 'james', 'bond', 'bond@yahoo.fr', '$argon2i$v=19$m=65536,t=4,p=1$ZHJacWxkQUhKeTdrQm1KUg$zTt0MHNN+KcLx+t+lSpFrL+vSUg//oBHl5CwmlYSNdU', '1991-01-01', 'ca432b6571fefc27358f859683c78b2ad8e5ff1c.webp'),
(3, 'kkfkf', 'ssssd', 'hhhe@kekee.com', '$argon2i$v=19$m=65536,t=4,p=1$Z0hrOW9tck5hbUwwbFB2NQ$AAleMD9Lz3KRzhMBlntgATaExmRWLcljQp0IQfXJRms', '2003-02-01', '06d2b192ae8f6c306f8925f32e7c2ca67d94a2df.webp'),
(4, 'loic', 'lo', 'lolo@lycos.com', '$argon2i$v=19$m=65536,t=4,p=1$Vjd4NWpDdDVvb0RSQXIzcQ$xN/Haz7ukU1SGMHHZLdM8lHPYVMCWiFWFw9JIRIhq4I', '1997-03-02', 'e09caec81289ee739aa2162426b27741a012541dloic_lo.jpeg'),
(5, 'mario', 'bros', 'mario@n64.com', '$argon2i$v=19$m=65536,t=4,p=1$UkZjTjBKSEEvQ2s3bnd2SQ$fLt8ZA5sOPORM/mHq2yx6qCN3/rXuevaQVKNCnKY7Hw', '1998-02-01', '8942e462ae0c3fc470f6262503e1c9613436cc68mario_bros.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

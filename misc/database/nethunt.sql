CREATE TABLE `nethunt` (
  `id` int NOT NULL AUTOINCREMENT,
  `datum` datetime NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kommentar` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `rating` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



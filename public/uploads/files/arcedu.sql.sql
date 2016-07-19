INSERT INTO `environments` (`env_id`, `type`, `area`, `flat`, `code`, `busy`, `delete`, `created_at`, `updated_at`) VALUES
(1, 'Departamento', 45.50, 1, 'A-1', 0, 0, '2016-02-09 04:08:58', '2016-02-09 07:41:36'),
(2, 'Departamento', 67.50, 1, 'A-2', 1, 0, '2016-02-09 04:13:53', '2016-02-09 08:13:53'),
(3, 'Departamento', 95.50, 1, 'A-3', 0, 0, '2016-02-06 02:56:51', '2016-02-06 06:53:43'),
(4, 'Departamento', 45.50, 1, 'A-4', 0, 0, '2016-02-09 03:28:27', '2016-02-06 06:58:24'),
(5, 'Departamento', 94.50, 1, 'A-5', 0, 0, '2016-01-22 09:40:10', '0000-00-00 00:00:00'),
(6, 'Oficina', 45.50, 2, 'B-1', 0, 0, '2016-01-22 09:40:10', '0000-00-00 00:00:00'),
(7, 'Oficina', 60.50, 2, 'B-2', 0, 0, '2016-02-09 03:28:24', '2016-02-06 06:59:14'),
(8, 'Oficina', 75.50, 2, 'B-3', 0, 0, '2016-01-22 09:40:10', '0000-00-00 00:00:00'),
(9, 'Oficina', 55.50, 2, 'B-4', 0, 0, '2016-01-22 09:40:10', '0000-00-00 00:00:00'),
(10, 'Tienda', 45.50, 0, 'P-1', 0, 0, '2016-01-22 09:40:10', '0000-00-00 00:00:00'),
(11, 'Tienda', 60.50, 0, 'P-2', 0, 0, '2016-01-22 09:40:10', '0000-00-00 00:00:00'),
(12, 'Tienda', 78.50, 0, 'P-3', 0, 0, '2016-02-09 03:28:31', '0000-00-00 00:00:00'),
(13, 'Tienda', 45.50, 0, 'P-4', 0, 0, '2016-01-22 09:40:10', '0000-00-00 00:00:00'),
(14, 'Deposito', 30.50, 0, 'P-5', 0, 0, '2016-01-22 09:40:10', '0000-00-00 00:00:00'),
(15, 'Deposito', 30.50, -1, 'S-1', 0, 0, '2016-01-22 09:40:10', '0000-00-00 00:00:00'),
(16, 'Deposito', 40.50, -1, 'S-2', 0, 0, '2016-01-22 09:40:10', '0000-00-00 00:00:00'),
(17, 'Deposito', 35.50, -1, 'S-2', 0, 0, '2016-01-22 09:40:10', '0000-00-00 00:00:00'),
(18, 'Area Social', 100.50, 7, 'I-1', 0, 0, '2016-01-22 09:40:10', '0000-00-00 00:00:00'),
(19, 'Area Social', 100.50, 7, 'I-2', 0, 0, '2016-01-22 09:40:11', '0000-00-00 00:00:00'),
(20, 'Area Social', 100.50, 7, 'I-3', 0, 0, '2016-01-22 09:40:11', '0000-00-00 00:00:00');

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`id`, `user_id`, `ci`, `expedido`, `names`, `last_name_f`, `last_name_m`, `phone`, `phone_cel`, `email`, `delete`, `created_at`, `updated_at`) VALUES
(1, NULL, 5208822, 'CBA', 'Angel Pedro Dom', 'Murillo', 'Nava', '4739913', '79346585', 'arc.quars@gmail.com', 0, '2016-02-05 19:52:22', '2016-02-05 23:52:22'),
(2, NULL, 789582, 'ORU', 'Juan', 'Capriles', '', '', '', NULL, 0, '2016-02-03 20:45:33', '0000-00-00 00:00:00'),
(3, NULL, 5208821, 'LPZ', 'Romulo', 'Capriles', 'Orellana', '4739918', '79346588', 'orellana@gmail.com', 0, '2016-02-05 19:58:35', '2016-02-05 23:57:51'),
(4, NULL, 5208820, 'LPZ', 'Carmilo', 'Peres', 'Soria', '', '70755485', 'carmilo@gmail.com', 0, '2016-02-05 22:48:12', '2016-02-06 02:48:12');

INSERT INTO `rental_month` (`rm_id`, `date_admission`, `date_end`, `warranty`, `payment`, `larder`, `penalty_fee`, `delete`, `created_at`, `updated_at`) VALUES
(4, '2016-02-01', '2017-02-01', 1500.00, 250.00, 85.00, 5.00, 0, '2016-02-09 08:13:53', '2016-02-09 08:13:53');

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'angel', 'arc.quars@gmail.com', '$2y$10$xeRGlL8mkNfj.hfB6VLq6eATIHPG0/2ZgKCwRjuhQxxEKnSVIqsSC', 'admin', 'VzmRjM1LcJjKCFffQ2jKTcuxt8jKJ1A17LIpAMliVS51rkQehigs1cJs7l2p', '2016-02-05 03:16:26', '2016-02-05 07:16:26'),
(2, 'pedro', 'arc.quars@hotmail.com', '$2y$10$1xYsTJAqW6/hTqMA0y52VO/IZ1DZ0TZtjAQ87xuo0pxuEjGhfs3EO', 'user', 'DfJlsy6gdQTkqeErZ28JRlDMiFKfWkxf8Ge2j3A3757E04Ch1mz1UJxAP8Xy', '2016-01-27 04:29:18', '2016-01-27 08:29:18');




CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `employee_code` char(7) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('manager','employee') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE (`email`),
  UNIQUE (`employee_code`)
);

CREATE TABLE `requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

INSERT INTO `users` (`name`, `email`, `employee_code`, `password`, `role`, `created_at`, `updated_at`) VALUES
(NULL, 'john.doe@example.com', '3214007', '$2y$10$Ud.EHQvIEwQ5FMCC.W4cN.nkheOau4QSxB0Q99UGjTyK5krm2B8hO', 'manager', '2024-10-28 06:32:27', '2024-10-28 06:32:45'),
(NULL, 'code.wizard@geekmail.com', '5249012', '$2y$10$AvGpEmWJBTqytbOruFNBnuK4ufJwMdG49YnSVmSvUBUa9qyQrFFVy', 'employee', '2024-10-28 06:33:57', '2024-10-28 06:33:57'),
(NULL, 'hackerman@techhub.com', '1588478', '$2y$10$Ik7BhLMZmhagpRs6CXpyee5rLAliSHObhqmu.a9u9UDGoyZ/RHG1C', 'employee', '2024-10-28 06:34:25', '2024-10-28 06:34:25');

INSERT INTO `requests` (`user_id`, `start_date`, `end_date`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(2, '2024-10-11', '2024-10-12', 'Personal time off', 'pending', '2024-10-11 10:15:00', '2024-10-28 06:34:04'),
(2, '2024-10-15', '2024-10-18', 'Vacation', 'rejected', '2024-10-14 16:00:00', '2024-10-28 06:34:07'),
(2, '2024-09-30', '2024-10-02', 'Family commitment', 'rejected', '2024-09-28 08:30:00', '2024-10-28 06:34:10'),
(3, '2024-10-07', '2024-10-09', 'Medical leave', 'approved', '2024-10-06 15:00:00', '2024-10-28 06:34:13'),
(3, '2024-10-25', '2024-10-27', 'Household emergency', 'rejected', '2024-10-24 07:45:00', '2024-10-28 06:34:41'),
(3, '2024-10-21', '2024-10-28', 'Reason goes here', 'approved', '2024-10-27 17:41:31', '2024-10-28 06:34:44'),
(3, '2024-10-21', '2024-10-28', 'Reason\r\n', 'pending', '2024-10-27 20:18:40', '2024-10-28 06:34:47');

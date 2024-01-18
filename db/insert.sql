INSERT INTO `User` (`username`, `name`, `surname`, `password`, `date_of_birth`, `gender`, `email`, `profile_image`)
VALUES ('edgar_01', 'Edgar', 'Kane', '$2y$10$th0elE0Lvz7td6EguAcJcu6QUinpXC1Wc.ipDPxmnTR...', '1958-01-08', 'Male', 'edgar@gmail.com', 'Edgar.jpg');
--PWD for Edgar is edgaredgar.
INSERT INTO `User` (`username`, `name`, `surname`, `password`, `date_of_birth`, `gender`, `email`, `profile_image`)
VALUES ('mikemike', 'Mike', 'Mikeson', '$2y$10$0lmfGv1ryve4pgtbdyJnSu5RHLN3gj7YnTs77dAbBEn...', '2024-01-01', 'Male', 'mike@gmail.com', 'mike.jpg');
--PWD for mikmike is mikemike

INSERT INTO `Post` (`user_id`, `username`, `image`, `timestamp`, `caption`)
VALUES (25, 'edgar_01', 'egar_out1.jpg', '2024-01-18 20:38:26', 'Check out my new outfit! Per il post');
INSERT INTO `Post` (`user_id`, `username`, `image`, `timestamp`, `caption`)
VALUES (26, 'mikemike', 'mar_out1.jpg', '2024-01-18 20:48:27', 'My new look!');
INSERT INTO `Post` (`user_id`, `username`, `image`, `timestamp`, `caption`)
VALUES (27, 'sophia_xd', 'sophia_out1.jpg', '2024-01-18 20:54:34', 'Busy day at school.');

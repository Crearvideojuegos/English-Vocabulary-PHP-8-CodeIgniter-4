DROP DATABASE if exists english_vocabulary;
CREATE DATABASE english_vocabulary CHARACTER SET utf8 COLLATE utf8_general_ci;
use english_vocabulary;

/*
 * -------------------------------------------------------------------
 * TABLES
 * -------------------------------------------------------------------
 */

CREATE TABLE `user_type` (
    `id` tinyint (2) NOT NULL AUTO_INCREMENT,
    `name_user_type` varchar(20) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/*****************************************************/

CREATE TABLE `native_language` (
    `id` tinyint (2) NOT NULL AUTO_INCREMENT,
    `native_language` varchar(20) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/*****************************************************/

CREATE TABLE `user` (
    `id` int (11) NOT NULL AUTO_INCREMENT,
    `user_nickname` varchar(50) NULL unique,
    `user_email` varchar(120) NULL unique,
    `user_pass` varchar(255) NOT NULL,
    `id_user_type` tinyint(2) NOT NULL,
    `user_status` tinyint(2) NOT NULL,
    `id_native_language` tinyint(2) NOT NULL,
    `user_voice_selected` tinyint(3) NOT NULL DEFAULT '1',
    `is_premium` tinyint(2) NOT NULL,
    `code_for_activation` varchar(32) NULL,
	`created_at` datetime NOT NULL,
	`updated_at` datetime NOT NULL,
	`deleted_at` datetime NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;


/*****************************************************/

CREATE TABLE `user_recovery_password` (
    `id_user` int(11) NULL,
    `code_for_recovery` varchar(32) NULL,
	`created_at` datetime NOT NULL
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/*****************************************************/

CREATE TABLE `word_user` (
    `id` bigint (16) NOT NULL AUTO_INCREMENT,
    `id_user` int(11) NULL,
    `english_word` varchar(30) NULL,
    `native_word` varchar(70) NULL,
    `description` varchar(130),
    `number_failed` int(4) DEFAULT '0',
    `number_success` int(4) DEFAULT '0',
    `active_in_game` tinyint(2) DEFAULT '0',
    `last_appearance_in_game` datetime NULL,
	`created_at` datetime NOT NULL,
	`updated_at` datetime NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/*****************************************************/

CREATE TABLE `sentence_user` (
    `id` bigint (16) NOT NULL AUTO_INCREMENT,
    `id_user` int(11) NULL,
    `english_sentence` varchar(200) NULL,
    `native_sentence` varchar(200) NULL,
    `number_failed` int(4) DEFAULT '0',
    `number_success` int(4) DEFAULT '0',
    `active_in_game` tinyint(2),
    `last_appearance_in_game` datetime NULL,
	`created_at` datetime NOT NULL,
	`updated_at` datetime NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/*****************************************************/

CREATE TABLE `failure_history_user` (
    `id` bigint (20) NOT NULL AUTO_INCREMENT,
    `id_user` int(11) NULL,
    `id_word` bigint (16) NULL,
    `id_sentence` bigint (16) NULL,
	`created_at` datetime NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

/*****************************************************/

CREATE TABLE `irregular` (
    `id` int (11) NOT NULL AUTO_INCREMENT,
    `infinitive` varchar(20) NOT NULL,
    `past_simple` varchar(20) NOT NULL,
    `past_participle` varchar(20) NOT NULL,
    `spanish` varchar(40) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;


/*
 * -------------------------------------------------------------------
 * DATA
 * -------------------------------------------------------------------
 */

INSERT INTO `user_type` (id, name_user_type) VALUES 
('1','User');

/*****************************************************/

INSERT INTO `native_language` (`id`, `native_language`) VALUES (NULL, 'Español');
INSERT INTO `native_language` (`id`, `native_language`) VALUES (NULL, 'Français');
INSERT INTO `native_language` (`id`, `native_language`) VALUES (NULL, 'Deutsch');
INSERT INTO `native_language` (`id`, `native_language`) VALUES (NULL, 'Italiano');
INSERT INTO `native_language` (`id`, `native_language`) VALUES (NULL, 'Português');
INSERT INTO `native_language` (`id`, `native_language`) VALUES (NULL, 'Русский');
INSERT INTO `native_language` (`id`, `native_language`) VALUES (NULL, 'Hindi');
INSERT INTO `native_language` (`id`, `native_language`) VALUES (NULL, 'Arabian');
INSERT INTO `native_language` (`id`, `native_language`) VALUES (NULL, 'Japanese');
INSERT INTO `native_language` (`id`, `native_language`) VALUES (NULL, 'Chinese');
INSERT INTO `native_language` (`id`, `native_language`) VALUES (NULL, 'Korean');
INSERT INTO `native_language` (`id`, `native_language`) VALUES (NULL, 'Other Language');


/*
 * -------------------------------------------------------------------
 * KEYS
 * -------------------------------------------------------------------
 */

ALTER TABLE `user`
ADD FOREIGN KEY (`id_user_type`) REFERENCES `user_type`(`id`);

ALTER TABLE `user`
ADD FOREIGN KEY (`id_native_language`) REFERENCES `native_language`(`id`);

ALTER TABLE `user_recovery_password`
ADD FOREIGN KEY (`id_user`) REFERENCES `user`(`id`);

ALTER TABLE `word_user`
ADD FOREIGN KEY (`id_user`) REFERENCES `user`(`id`);

ALTER TABLE `sentence_user`
ADD FOREIGN KEY (`id_user`) REFERENCES `user`(`id`);

ALTER TABLE `failure_history_user`
ADD FOREIGN KEY (`id_user`) REFERENCES `user`(`id`),
ADD FOREIGN KEY (`id_word`) REFERENCES `word_user`(`id`),
ADD FOREIGN KEY (`id_sentence`) REFERENCES `sentence_user`(`id`);



/*
 * -------------------------------------------------------------------
 * REFILL DATA
 * -------------------------------------------------------------------
 */


INSERT INTO `user` (`id`, `user_nickname`, `user_email`, `user_pass`, `id_user_type`, `user_status`, 
`id_native_language`, `user_voice_selected`, `is_premium`, `code_for_activation`, `created_at`, `updated_at`, `deleted_at`) VALUES 
(1, 'Alex Luján', 'admin@exampleenglishvocabulary.com', '$P$Bo8QRaCpH/sehcUNs4Ay24tsZ7sO2T/', '1', '1', '1', '1', '1',
NULL, '2022-12-17 15:18:50.000000', '2022-12-17 15:18:50.000000', NULL);


INSERT INTO `irregular` (`id`, `infinitive`, `past_simple`, `past_participle`, `spanish`) VALUES
(2, 'Arise', 'Arose', 'Arisen', 'Surgir, Levantarse'),
(3, 'Awake', 'Awoke', 'Awoken', 'Despertarse'),
(4, 'Be', 'Was/Were', 'Been', 'Ser, Estar'),
(5, 'Bear', 'Bore', 'Borne / Born', 'Soportar, dar a Luz'),
(6, 'Beat', 'Beat', 'Beaten', 'Golpear'),
(7, 'Become', 'Became', 'Become', 'Llegar a ser'),
(8, 'Begin', 'Began', 'Begun', 'Empezar'),
(9, 'Bend', 'Bent', 'Bent', 'Doblar'),
(10, 'Bet', 'Bet', 'Bet', 'Apostar'),
(11, 'Bind', 'Bound', 'Bound', 'Atar, encuadernar'),
(12, 'Bid', 'Bid', 'Bid', 'Pujar'),
(13, 'Bite', 'Bit', 'Bitten', 'Morder'),
(14, 'Bleed', 'Bled', 'Bled', 'Sangrar'),
(15, 'Blow', 'Blew', 'Blown', 'Soplar'),
(16, 'Break', 'Broke', 'Broken', 'Romper'),
(17, 'Breed', 'Bred', 'Bred', 'Criar'),
(18, 'Bring', 'Brought', 'Brought', 'Traer, Llevar'),
(19, 'Broadcast', 'Broadcast', 'Broadcast', 'Radiar, Retransmitir'),
(20, 'Build', 'Built', 'Built', 'Edificar'),
(21, 'Burn', 'Burnt / Burned', 'Burnt / Burned', 'Quemar'),
(22, 'Burst', 'Burst', 'Burst', 'Reventar'),
(23, 'Buy', 'Bought', 'Bought', 'Comprar'),
(24, 'Cast', 'Cast', 'Cast', 'Arrojar'),
(25, 'Catch', 'Caught', 'Caught', 'Coger'),
(26, 'Come', 'Came', 'Come', 'Venir'),
(27, 'Cost', 'Cost', 'Cost', 'Costar'),
(28, 'Cut', 'Cut', 'Cut', 'Cortar'),
(29, 'Choose', 'Chose', 'Chosen', 'Elegir'),
(30, 'Cling', 'Clung', 'Clung', 'Agarrarse'),
(31, 'Creep', 'Crept', 'Crept', 'Arrastrarse'),
(32, 'Deal', 'Dealt', 'Dealt', 'Tratar'),
(33, 'Dig', 'Dug', 'Dug', 'Cavar'),
(34, 'Do', 'Did', 'Done', 'Hacer'),
(35, 'Draw', 'Drew', 'Drawn', 'Dibujar'),
(36, 'Dream', 'Dreamt/Dreamed', 'Dreamt/Dreamed', 'Soñar'),
(37, 'Drink', 'Drank', 'Drunk', 'Beber'),
(38, 'Drive', 'Drove', 'Driven', 'Conducir'),
(39, 'Eat', 'Ate', 'Eaten', 'Comer'),
(40, 'Fall', 'Fell', 'Fallen', 'Caer'),
(41, 'Feed', 'Fed', 'Fed', 'Alimentar'),
(42, 'Feel', 'Felt', 'Felt', 'Sentir'),
(43, 'Fight', 'Fought', 'Fought', 'Luchar'),
(44, 'Find', 'Found', 'Found', 'Encontrar'),
(45, 'Flee', 'Fled', 'Fled', 'Huir'),
(46, 'Fly', 'Flew', 'Flown', 'Volar'),
(47, 'Forbid', 'Forbade', 'Forbidden', 'Prohibir'),
(48, 'Forget', 'Forgot', 'Forgotten', 'Olvidar'),
(49, 'Forgive', 'Forgave', 'Forgiven', 'Perdonar'),
(50, 'Freeze', 'Froze', 'Frozen', 'Helar'),
(51, 'Get', 'Got', 'Got / Gotten', 'Obtener'),
(52, 'Give', 'Gave', 'Given', 'Dar'),
(53, 'Go', 'Went', 'Gone', 'Ir'),
(54, 'Grow', 'Grew', 'Grown', 'Crecer'),
(55, 'Grind', 'Ground', 'Ground', 'Moler'),
(56, 'Hang', 'Hung', 'Hung', 'Colgar'),
(57, 'Have', 'Had', 'Had', 'Haber o Tener'),
(58, 'Hear', 'Heard', 'Heard', 'Oir'),
(59, 'Hide', 'Hid', 'Hidden', 'Ocultar'),
(60, 'Hold', 'Held', 'Held', 'Agarrar, Celebrar'),
(61, 'Hurt', 'Hurt', 'Hurt', 'Herir'),
(62, 'Keep', 'Kept', 'Kept', 'Conservar'),
(63, 'Know', 'Knew', 'Known', 'Saber, Conocer'),
(64, 'Kneel', 'Knelt', 'Knelt', 'Arrodillarse'),
(65, 'Knit', 'Knit', 'Knit', 'Hacer punto'),
(66, 'Lay', 'Laid', 'Laid', 'Poner'),
(67, 'Lead', 'Led', 'Led', 'Conducir'),
(68, 'Lean', 'Leant', 'Leant', 'Apoyarse'),
(69, 'Leap', 'Leapt', 'Leapt', 'Brincar'),
(70, 'Learn', 'Learnt/Learned', 'Learnt/Learned', 'Aprender'),
(71, 'Leave', 'Left', 'Left', 'Dejar'),
(72, 'Lend', 'Lent', 'Lent', 'Prestar'),
(73, 'Let', 'Let', 'Let', 'Permitir'),
(74, 'Lie', 'Lay', 'Lain', 'Echarse'),
(75, 'Light', 'Lit', 'Lit', 'Encender'),
(76, 'Lose', 'Lost', 'Lost', 'Perder'),
(77, 'Make', 'Made', 'Made', 'Hacer'),
(78, 'Mean', 'Meant', 'Meant', 'Significar'),
(79, 'Meet', 'Met', 'Met', 'Encontrar'),
(80, 'Mistake', 'Mistook', 'Mistaken', 'Equivocar'),
(81, 'Overcome', 'Overcame', 'Overcome', 'Vencer'),
(82, 'Pay', 'Paid', 'Paid', 'Pagar'),
(83, 'Put', 'Put', 'Put', 'Poner'),
(84, 'Read', 'Read', 'Read', 'Leer'),
(85, 'Ride', 'Roden', 'Ridden', 'Montar'),
(86, 'Ring', 'Rang', 'Rung', 'Llamar'),
(87, 'Rise', 'Rose', 'Risen', 'Levantarse'),
(88, 'Run', 'Rang', 'Rung', 'Correr'),
(89, 'Say', 'Said', 'Said', 'Decir'),
(90, 'See', 'Saw', 'Seen', 'Ver'),
(91, 'Seek', 'Sought', 'Sought', 'Buscar'),
(92, 'Sell', 'Sold', 'Sold', 'Vender'),
(93, 'Send', 'Sent', 'Sent', 'Enviar'),
(94, 'Set', 'Set', 'Set', 'Poner(se)'),
(95, 'Sew', 'Sewed', 'Sewed / Sewn', 'Coser'),
(96, 'Shake', 'Shook', 'Shaken', 'Sacudir'),
(97, 'Shear', 'Shore', 'Shorn', 'Esquilar'),
(98, 'Shine', 'Shone', 'Shone', 'Brillar'),
(99, 'Shoot', 'Shot', 'Shot', 'Disparar'),
(100, 'Show', 'Showed', 'Shown', 'Mostrar'),
(101, 'Shrink', 'Shrank', 'Shrunk', 'Encogerse'),
(102, 'Shut', 'Shut', 'Shut', 'Cerrar'),
(103, 'Sing', 'Sang', 'Sung', 'Cantar'),
(104, 'Sink', 'Sank', 'Sunk', 'Hundir'),
(105, 'Sit', 'Sat', 'Sat', 'Sentarse'),
(106, 'Sleep', 'Slept', 'Slept', 'Dormir'),
(107, 'Slide', 'Slid', 'Slid', 'Resbalar'),
(108, 'Smell', 'Smelt', 'Smelt', 'Oler'),
(109, 'Sow', 'Sowed', 'Sowed/Sown', 'Sembrar'),
(110, 'Speak', 'Spoke', 'Spoken', 'Hablar'),
(111, 'Speed', 'Sped', 'Sped', 'Acelerar'),
(112, 'Spell', 'Spelt', 'Spelt', 'Deletrear'),
(113, 'Spend', 'Spent', 'Spent', 'Gastar'),
(114, 'Spill', 'Spilt/Spilled', 'Spilt /Spilled', 'Derramar'),
(115, 'Spin', 'Spun', 'Spun', 'Hilar'),
(116, 'Spit', 'Spat', 'Spat', 'Escupir'),
(117, 'Split', 'Split', 'Split', 'Hendir/Partir/Rajar'),
(118, 'Spoil', 'Spoilt / Spoiled', 'Spoilt / Spoiled', 'Estropear'),
(119, 'Spread', 'Spread', 'Spread', 'Extender'),
(120, 'Spring', 'Sprang', 'Sprung', 'Saltar'),
(121, 'Stand', 'Stood', 'Stood', 'Estar en pie'),
(122, 'Steal', 'Stole', 'Stolen', 'Robar'),
(123, 'Stick', 'Stuck', 'Stuck', 'Pegar, engomar'),
(124, 'Sting', 'Stung', 'Stung', 'Picar'),
(125, 'Stink', 'Stank/Stunk', 'Stunk', 'Apestar'),
(126, 'Stride', 'Struck', 'Struck', 'Golpear'),
(127, 'Swear', 'Swore', 'Sworn', 'Jurar'),
(128, 'Sweat', 'Sweat', 'Sweat', 'Sudar'),
(129, 'Sweep', 'Swept', 'Swept', 'Barrer'),
(130, 'Swell', 'Swelled', 'Swollen', 'Hinchar'),
(131, 'Swim', 'Swam', 'Swum', 'Nadar'),
(132, 'Swing', 'Swung', 'Swung', 'Columpiarse'),
(133, 'Take', 'Took', 'Taken', 'Coger'),
(134, 'Teach', 'Taught', 'Taught', 'Enseñar'),
(135, 'Tear', 'Tore', 'Torn', 'Rasgar'),
(136, 'Tell', 'Told', 'Told', 'Decir'),
(137, 'Think', 'Thought', 'Thpught', 'Pensar'),
(138, 'Throw', 'Threw', 'Thrown', 'Arrojar, tirar'),
(139, 'Thrust', 'Thrust', 'Thrust', 'Introducir'),
(140, 'Tread', 'Trod', 'Trodden', 'Pisar, Hollar'),
(141, 'Understand', 'Understood', 'Understood', 'Entender'),
(142, 'Undergo', 'Underwent', 'Undergone', 'Sufrir'),
(143, 'Undertake', 'Undertook', 'Undertaken', 'Emprender'),
(144, 'Wake', 'Woke', 'Woken', 'Despertarse'),
(145, 'Wear', 'Wore', 'Worn', 'Llevar puesto'),
(146, 'Weave', 'Wove', 'Woven', 'Tejer'),
(147, 'Weep', 'Wept', 'Wept', 'Llorar'),
(148, 'Wet', 'Wet', 'Wet', 'Mojar'),
(149, 'Win', 'Won', 'Won', 'Ganar'),
(150, 'Wind', 'Wound', 'Wound', 'Enrollar'),
(151, 'Withdraw', 'Withdrew', 'Withdrawn', 'Retirarse'),
(152, 'Wring', 'Wrung', 'Wrung', 'Torcer'),
(153, 'Write', 'Wrote', 'Written', 'Escribir');



INSERT INTO `word_user` (`id`, `id_user`, `english_word`, `native_word`, `description`, `number_failed`, `active_in_game`, `created_at`, `updated_at`) VALUES
(1, 1, 'Widget', 'Artilugio', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(2, 1, 'Runtime', 'Tiempo de ejecución', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(3, 1, 'Bounce', 'Botar, rebotar', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(4, 1, 'Tumbler', 'Vaso (Alargado)', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(5, 1, 'Perhaps ', 'Quizás, probablemente ', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(6, 1, 'Restraint ', 'Restricción, control', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(7, 1, 'Ruthless', 'Despiadado', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(8, 1, 'Skew', 'Torcido', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(9, 1, 'Alley', 'Callejón ', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(10, 1, 'Umpire', 'Árbitro ', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(11, 1, 'Kind', 'Amable / Clase, tipo', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(12, 1, 'Sweaty', 'Sudoroso ', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(13, 1, 'Afraid', 'Miedo ', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(14, 1, 'Further', 'Más lejano', 'Es el comparativo de far', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(15, 1, 'Cage', 'Jaula ', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(16, 1, 'Upset', 'Molesto', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(17, 1, 'Quirk', 'Peculiaridad', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(18, 1, 'Wrangler ', 'Adiestrador', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(19, 1, 'Cast', 'Reparto / Lanzar', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(20, 1, 'Shattered', 'Desmenuzado ', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(21, 1, 'Hobble', 'Cojear', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(22, 1, 'Steady', 'Firme, regular', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(23, 1, 'Tent', 'Carpa / Tienda de campaña', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(24, 1, 'Upbeat', 'Futuro alentador / Optimista ', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(25, 1, 'Scuff', 'Marcar', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29'),
(26, 1, 'Rattle', 'Agitar, hacer ruido ', '', 0, 1, '2022-12-19 23:36:29', '2022-12-19 23:36:29');


INSERT INTO `sentence_user` (`id`, `id_user`, `english_sentence`, `native_sentence`, `number_failed`, `active_in_game`, `created_at`, `updated_at`) VALUES
(1, 1, 'I still have no opinion', 'Aun/Todavia no tengo opinion', 0, 1, '2022-12-19 23:36:30', '2022-12-19 23:36:30');

UPDATE word_user set active_in_game = 0;
UPDATE sentence_user set active_in_game = 0;

UPDATE word_user set last_appearance_in_game = NOW();
UPDATE sentence_user set last_appearance_in_game = NOW();


-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 20 2018 г., 18:44
-- Версия сервера: 10.1.31-MariaDB
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `id3993744_dev`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(1, 'Red Cat', 1),
(2, 'Red Cat', 1),
(3, 'Black cat', 1),
(4, 'Gogs', 1),
(5, 'Cat Doo', 1),
(6, 'Coo Coo', 1),
(7, 'Testcat', 1),
(8, 'Redirect Cat', 1),
(9, 'Redirect Cat', 1),
(10, 'New cat', 1),
(11, 'New cat', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `metas`
--

CREATE TABLE `metas` (
  `id` int(11) NOT NULL,
  `resource_id` int(11) UNSIGNED NOT NULL,
  `resource` varchar(20) DEFAULT NULL,
  `title` varchar(70) DEFAULT NULL,
  `links` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `metas`
--

INSERT INTO `metas` (`id`, `resource_id`, `resource`, `title`, `links`, `keywords`, `description`) VALUES
(1, 3, NULL, 'Meta tile', '', 'test, meta', 'Meta description'),
(2, 4, 'products', 'page title', '', 'page, des', 'pegae description'),
(4, 1, 'posts', 'test neta title', '', 'post, meta', 'meta for test'),
(5, 4, 'products', 'page title', '', 'page, des', 'pegae description'),
(6, 1, 'posts', 'test neta title', '', 'post, meta', 'meta for test'),
(7, 1, 'posts', 'test neta title', '', 'post, meta', 'meta for test'),
(8, 5, 'products', 'test neta title', '', '', ''),
(9, 6, 'products', '', '', '', ''),
(10, 7, 'products', 'test', '', 'test', 'test');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `products`, `status`) VALUES
(1, 4, '2018-03-20 17:36:45', '\"[{\\\"Id\\\":\\\"6\\\",\\\"Product\\\":\\\"Cool\\u00a0Cat\\\",\\\"Price\\\":\\\"23456\\\",\\\"Quantity\\\":\\\"3\\\",\\\"Picture\\\":\\\"\\/media\\/files_5aa8156a4bfdf.jpg\\\"}]\"', 4),
(2, 4, '2018-03-20 17:43:34', '\"[{\\\"Id\\\":\\\"6\\\",\\\"Product\\\":\\\"Cool\\u00a0Cat\\\",\\\"Price\\\":\\\"23456\\\",\\\"Quantity\\\":4,\\\"Picture\\\":\\\"\\/media\\/files_5aa8156a4bfdf.jpg\\\"},{\\\"Id\\\":\\\"5\\\",\\\"Product\\\":\\\"new\\u00a0prod\\u00a0cat\\\",\\\"Price\\\":\\\"1111\\\",\\\"Quantity\\\":\\\"1\\\",\\\"Picture\\\":\\\"\\/media\\/files_5aa80df58e1a6.jpg\\\"}]\"', 2),
(3, 5, '2018-03-20 17:46:51', '\"[{\\\"Id\\\":\\\"4\\\",\\\"Product\\\":\\\"Cool\\u00a0Cat\\\",\\\"Price\\\":\\\"456\\\",\\\"Quantity\\\":\\\"3\\\",\\\"Picture\\\":\\\"\\/media\\/files_5a9edf618e12f.png\\\"}]\"', 1),
(4, 4, '2018-03-20 18:23:10', '\"[{\\\"Id\\\":\\\"7\\\",\\\"Product\\\":\\\"www\\u00a0cat\\\",\\\"Price\\\":\\\"555\\\",\\\"Quantity\\\":\\\"4\\\",\\\"Picture\\\":\\\"\\/media\\/files_5ab150f007645.png\\\"}]\"', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pictures`
--

CREATE TABLE `pictures` (
  `id` int(10) NOT NULL,
  `filename` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `resource` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `resource_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `pictures`
--

INSERT INTO `pictures` (`id`, `filename`, `resource`, `resource_id`) VALUES
(2, 'files_5a9edf618e12f.png', 'products', 4),
(3, 'files_5aa80df58e1a6.jpg', 'products', 5),
(4, 'files_5aa8156a4bfdf.jpg', 'products', 6),
(5, 'files_5ab150f007645.png', 'products', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `status`, `created_at`) VALUES
(1, 'Що таке Lorem Ipsum?', '<p>Lorem Ipsum - це текст-риба, що використовується в друкарстві та дизайні. Lorem Ipsum є, фактично, стандартною рибою аж з XVI сторіччя, коли невідомий друкар взяв шрифтову гранку та склав на ній підбірку зразків шрифтів. Риба не тільки успішно пережила п\'ять століть, але й прижилася в електронному верстуванні, залишаючись по суті незмінною. Вона популяризувалась в 60-их роках минулого сторіччя завдяки виданню зразків шрифтів Letraset, які містили уривки з Lorem Ipsum, і вдруге - нещодавно завдяки програмам комп\'юте<img src=\"../../../media/1.jpg\" />рного верстування на кшталт Aldus Pagemaker, які використовували різні версії Lorem Ipsum.</p>\r\n<p>&nbsp;</p>', 0, '2018-01-30 17:56:33'),
(2, 'Чому ми ним користуємось?', 'Вже давно відомо, що читабельний зміст буде заважати зосередитись людині, яка оцінює композицію сторінки. Сенс використання Lorem Ipsum полягає в тому, що цей текст має більш-менш нормальне розподілення літер на відміну від, наприклад, \"Тут іде текст. Тут іде текст.\" Це робить текст схожим на оповідний. Багато програм верстування та веб-дизайну використовують Lorem Ipsum як зразок і пошук за терміном \"lorem ipsum\" відкриє багато веб-сайтів, які знаходяться ще в зародковому стані. Різні версії Lorem Ipsum з\'явились за минулі роки, деякі випадково, деякі було створено зумисно (зокрема, жартівливі).', 0, '2018-01-30 17:56:33'),
(3, 'Звідки він походить?', 'На відміну від поширеної думки Lorem Ipsum не є випадковим набором літер. Він походить з уривку класичної латинської літератури 45 року до н.е., тобто має більш як 2000-річну історію. Річард Макклінток, професор латини з коледжу Хемпдін-Сидні, що у Вірджінії, вивчав одне з найменш зрозумілих латинських слів - consectetur - з уривку Lorem Ipsum, і у пошуку цього слова в класичній літературі знайшов безсумнівне джерело. Lorem Ipsum походить з розділів 1.10.32 та 1.10.33 цицеронівського \"de Finibus Bonorum et Malorum\" (\"Про межі добра і зла\"), написаного у 45 році до н.е. Цей трактат з теорії етики був дуже популярним в епоху Відродження. Перший рядок Lorem Ipsum, \"Lorem ipsum dolor sit amet...\" походить з одного з рядків розділу 1.10.32. Класичний текст, використовуваний з XVI сторіччя, наведено нижче для всіх зацікавлених. Також точно за оригіналом наведено розділи 1.10.32 та 1.10.33 цицеронівського \"de Finibus Bonorum et Malorum\" разом із перекладом англійською, виконаним 1914 року Х.Рекемом.', 0, '2018-01-30 17:56:33'),
(4, 'Де собі взяти трохи?', 'Існує багато варіацій уривків з Lorem Ipsum, але більшість з них зазнала певних змін на кшталт жартівливих вставок або змішування слів, які навіть не виглядають правдоподібно. Якщо ви збираєтесь використовувати Lorem Ipsum, ви маєте упевнитись в тому, що всередині тексту не приховано нічого, що могло б викликати у читача конфуз. Більшість відомих генераторів Lorem Ipsum в Мережі генерують текст шляхом повторення наперед заданих послідовностей Lorem Ipsum. Принципова відмінність цього генератора робить його першим справжнім генератором Lorem Ipsum. Він використовує словник з більш як 200 слів латини та цілий набір моделей речень - це дозволяє генерувати Lorem Ipsum, який виглядає осмислено. Таким чином, згенерований Lorem Ipsum не міститиме повторів, жартів, нехарактерних для латини слів і т.ін.', 0, '2018-01-30 17:56:33'),
(5, 'Hello host', 'Hello host', 1, '2018-01-30 18:17:52'),
(6, 'Оператор splat', 'Post ContentВ Php 5.6+ можно использовать ... operator вместо func_get_args(). оператор... (также известный как оператор splat на некоторых языках):\r\n\r\nМожно получить все параметры, которые вы передаете:\r\n\r\nfunction manyVars(...$params) {\r\n   var_dump($params);\r\n}\r\nоператор ... собирает список переменных аргументов в массиве.\r\n\r\n\r\npublic function directPath($uri)\r\n   {\r\n       if (array_key_exists($uri, $this->routes)) {\r\n           return $this->callAction(...explode(\'@\', $this->routes[$uri]));\r\n       }\r\n       throw new Exception(\'No route defined for this URI.\');\r\n   }', 1, '2018-02-06 18:32:38');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `category_id` int(11) UNSIGNED DEFAULT NULL,
  `price` float UNSIGNED NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT '1',
  `is_recommended` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `status`, `category_id`, `price`, `brand`, `description`, `is_new`, `is_recommended`) VALUES
(4, 'Cool Cat', 1, 1, 456, 'cats', 'test meta res', 1, 0),
(5, 'new prod cat', 1, 1, 1111, 'cats', '', 1, 0),
(6, 'Cool Cat', 1, 3, 23456, 'cats', 'new black cat', 1, 0),
(7, 'www cat', 1, 2, 555, 'cats', 'cat cat', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL DEFAULT '2',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `status`) VALUES
(1, 'Couch', 'couchjanus@gmail.com', '$2y$10$FejWW57CEWM01PXMa0qtFud.Ybkj7BPhaP364w7aehf8LtjAWcJ5q', 1, 1),
(2, 'customer', 'customer@my.com', '$2y$10$FejWW57CEWM01PXMa0qtFud.Ybkj7BPhaP364w7aehf8LtjAWcJ5q', 3, 1),
(3, 'janus', 'janusnic@gmail.com', '$2y$12$/XMCtwYhWk7zCj5LBk4aOuR4I8o42J6DtddYqKEOeZ0OiSls8reSm', 3, 1),
(4, 'cust', 'cust@my.com', '$2y$12$Mi75HV.EpiTyG4LnRHJ5HuppuKjLch3rGTKyy.y9UeynwehLsv7aW', 2, 1),
(5, 'test', 'test@my.com', '$2y$12$rk/zOjVLzkLlHlGxAzVmJOfFQs9La5mx4BKq/kWXzuG.lEY6BDgli', 3, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `metas`
--
ALTER TABLE `metas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2025 at 08:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studyfy_fresh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `subject`, `title`, `content`, `created_at`) VALUES
(1, 'Physics', 'Newton\'s First Law', '<h2>Introduction to Inertia</h2><p>Newton\'s First Law of Motion, also known as the law of inertia, states that an object at rest stays at rest and an object in motion stays in motion with the same speed and in the same direction unless acted upon by an unbalanced force.</p><p>This means that in the absence of a net external force, the velocity of an object is constant. This is a fundamental principle in classical mechanics.</p><h3>Key Concepts:</h3><ul><li><strong>Inertia:</strong> The resistance of any physical object to any change in its state of motion.</li><li><strong>Net Force:</strong> The vector sum of all forces acting on an object.</li></ul>', '2025-06-22 11:36:14'),
(2, 'Chemistry', 'The pH Scale', '<h2>Understanding Acidity and Basicity</h2><p>The pH scale is a logarithmic scale used to specify the acidity or basicity of an aqueous solution. It is a measure of the concentration of hydrogen ions (H+) in the solution.</p><p>Solutions with a pH less than 7 are acidic, while solutions with a pH greater than 7 are basic or alkaline. A pH of 7 is considered neutral (e.g., pure water).</p><h3>Formula:</h3><p>The pH is defined as the negative logarithm (base 10) of the hydrogen ion concentration:</p><p><code>pH = -log[H+]</code></p>', '2025-06-22 11:36:14'),
(3, 'Mathematics', 'The Pythagorean Theorem', '<h2>Right-Angled Triangles</h2><p>The Pythagorean theorem is a fundamental relation in Euclidean geometry among the three sides of a right-angled triangle.</p><p>It states that the area of the square whose side is the hypotenuse (the side opposite the right angle) is equal to the sum of the areas of the squares on the other two sides.</p><h3>Formula:</h3><p>In a right-angled triangle with sides a and b and hypotenuse c, the theorem is expressed as:</p><p><code>a + b = c</code></p>', '2025-06-22 11:36:14'),
(4, 'Physics', 'Electromagnetism Basics', '<h2>Introduction to Electromagnetism</h2><p>Electromagnetism is a branch of physics involving the study of the electromagnetic force, a type of physical interaction that occurs between electrically charged particles.</p><p>The electromagnetic force is carried by electromagnetic fields composed of electric fields and magnetic fields, and it is responsible for electromagnetic radiation such as light.</p>', '2025-06-22 11:53:57'),
(5, 'Chemistry', 'Introduction to Organic Chemistry', '<h2>The Chemistry of Carbon</h2><p>Organic chemistry is the study of the structure, properties, composition, reactions, and preparation of carbon-containing compounds.</p><p>Most organic compounds contain carbon and hydrogen, but they may also include any number of other elements (e.g., nitrogen, oxygen, halogens, phosphorus, silicon, sulfur).</p>', '2025-06-22 11:53:57'),
(6, 'Mathematics', 'Fundamentals of Calculus', '<h2>The Study of Change</h2><p>Calculus is the mathematical study of continuous change. It has two major branches, differential calculus and integral calculus.</p><p>Differential calculus is concerned with instantaneous rates of change and the slopes of curves. Integral calculus is concerned with the accumulation of quantities and the areas under and between curves.</p>', '2025-06-22 11:53:57'),
(7, 'C++', 'Understanding Pointers', '<h2>What is a Pointer?</h2><p>In C++, a pointer is a variable that stores the memory address of another variable. Pointers are used for dynamic memory allocation, building complex data structures, and for passing arguments to functions by reference.</p><p>They must be declared before they can be used, just like a normal variable. The syntax is: <code>type *pointer_name;</code></p>', '2025-06-22 11:53:57'),
(8, 'Java', 'Core OOP Concepts', '<h2>Object-Oriented Programming in Java</h2><p>Java is heavily based on Object-Oriented Programming (OOP). The core concepts are:</p><ul><li><strong>Encapsulation:</strong> Wrapping data (variables) and code acting on the data (methods) together as a single unit.</li><li><strong>Inheritance:</strong> A mechanism wherein one class acquires the properties and behaviors of another.</li><li><strong>Polymorphism:</strong> The ability of a method to do different things based on the object it is acting upon.</li><li><strong>Abstraction:</strong> Hiding the implementation details from the user and only providing functionality.</li></ul>', '2025-06-22 11:53:57'),
(9, 'Physics', 'Newton\'s Second Law (F=ma)', '<h2>Force, Mass, and Acceleration</h2><p>Newton\'s Second Law of Motion states that the acceleration of an object is directly proportional to the net force acting on it and inversely proportional to its mass. The direction of the acceleration is in the direction of the net force.</p><h3>Formula:</h3><p><code>F = ma</code></p><p>Where F is the net force, m is the mass of the object, and a is its acceleration.</p>', '2025-06-22 11:55:31'),
(10, 'Physics', 'Thermodynamics: The Zeroth Law', '<h2>Thermal Equilibrium</h2><p>The Zeroth Law of Thermodynamics states that if two thermodynamic systems are each in thermal equilibrium with a third one, then they are in thermal equilibrium with each other.</p><p>This law provides the basis for the concept of temperature.</p>', '2025-06-22 11:55:31'),
(11, 'Chemistry', 'Understanding Chemical Bonding', '<h2>Ionic vs. Covalent Bonds</h2><p>A chemical bond is a lasting attraction between atoms, ions or molecules that enables the formation of chemical compounds.</p><ul><li><strong>Ionic Bonds:</strong> Formed when one atom transfers electrons to another, creating oppositely charged ions that attract each other. Example: NaCl (Sodium Chloride).</li><li><strong>Covalent Bonds:</strong> Formed when two atoms share one or more pairs of electrons. Example: HO (Water).</li></ul>', '2025-06-22 11:55:31'),
(12, 'Chemistry', 'The Mole Concept', '<h2>Avogadro\'s Number</h2><p>A mole is a unit of measurement for the amount of substance. One mole of any substance contains approximately 6.022 x 10 entities (atoms, molecules, etc.). This number is known as Avogadro\'s constant.</p><p>It provides a bridge between the microscopic world of atoms and the macroscopic world we can measure.</p>', '2025-06-22 11:55:31'),
(13, 'Mathematics', 'Introduction to Linear Algebra', '<h2>Vectors and Matrices</h2><p>Linear algebra is the branch of mathematics concerning linear equations, linear maps, and their representations in vector spaces and through matrices.</p><p>It is a fundamental tool in many areas of science and engineering, from computer graphics to quantum mechanics.</p>', '2025-06-22 11:55:31'),
(14, 'Mathematics', 'Basics of Probability', '<h2>Calculating Likelihood</h2><p>Probability is the branch of mathematics concerning numerical descriptions of how likely an event is to occur. The probability of an event is a number between 0 and 1, where, roughly speaking, 0 indicates impossibility and 1 indicates certainty.</p><h3>Formula:</h3><p><code>P(A) = (Number of Favorable Outcomes) / (Total Number of Outcomes)</code></p>', '2025-06-22 11:55:31'),
(15, 'C++', 'Classes and Objects', '<h2>The Core of OOP in C++</h2><p>A class is a blueprint for creating objects. An object is an instance of a class.</p><p>Classes encapsulate data (attributes) and methods (functions) that operate on the data. For example, a Car class might have attributes like color and rand, and methods like startEngine().</p>', '2025-06-22 11:55:31'),
(16, 'C++', 'The Standard Template Library (STL)', '<h2>Powerful, Reusable Components</h2><p>The STL is a set of C++ template classes to provide common programming data structures and functions such as lists, stacks, arrays, etc. It is a library of container classes, algorithms, and iterators.</p><p>Key components include ector, list, map, and set.</p>', '2025-06-22 11:55:31'),
(17, 'Java', 'Exception Handling', '<h2>The try-catch Block</h2><p>Exception handling in Java is a mechanism to handle runtime errors such as ClassNotFoundException, IOException, SQLException, etc.</p><p>The 	ry block contains the set of statements where an exception can occur. A catch block is used to handle the exception.</p><h3>Syntax:</h3><pre><code>try {\n  // block of code to try\n} catch (Exception e) {\n  // block of code to handle errors\n}</code></pre>', '2025-06-22 11:55:31'),
(18, 'Java', 'The Java Collections Framework', '<h2>Working with Data Structures</h2><p>The Collections Framework provides an architecture to store and manipulate groups of objects.</p><p>Key interfaces include List (for ordered collections, e.g., ArrayList), Set (for unique elements, e.g., HashSet), and Map (for key-value pairs, e.g., HashMap).</p>', '2025-06-22 11:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_option` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(1, 1, 'What is the SI unit of force?', 'Watt', 'Joule', 'Newton', 'Pascal', 'c'),
(2, 1, 'Which of Newton\'s laws is also known as the law of inertia?', 'First Law', 'Second Law', 'Third Law', 'Fourth Law', 'a'),
(3, 1, 'What is the formula for calculating kinetic energy?', 'E = mc^2', 'KE = 1/2 mv^2', 'PE = mgh', 'F = ma', 'b'),
(4, 1, 'Which of these is a vector quantity?', 'Speed', 'Mass', 'Distance', 'Velocity', 'd'),
(5, 2, 'What is the value of Pi (p) to two decimal places?', '3.14', '3.15', '3.12', '3.16', 'a'),
(6, 2, 'What is the square root of 81?', '7', '8', '9', '10', 'c'),
(7, 1, 'What does g represent in the formula PE = mgh?', 'Gravitational Constant', 'General Acceleration', 'Gravitational Acceleration', 'Global Parameter', 'c'),
(8, 1, 'Which color of light has the longest wavelength?', 'Blue', 'Green', 'Yellow', 'Red', 'd'),
(9, 3, 'What is the chemical symbol for Gold?', 'Au', 'Ag', 'G', 'Go', 'a'),
(10, 3, 'Which of these is a noble gas?', 'Oxygen', 'Hydrogen', 'Neon', 'Nitrogen', 'c'),
(11, 3, 'What is the most abundant element in the Earth\'s crust?', 'Iron', 'Silicon', 'Oxygen', 'Aluminum', 'c'),
(12, 4, 'Which keyword is used to define a variable that cannot be changed?', 'const', 'static', 'final', 'let', 'a'),
(13, 4, 'What is the correct way to start a single-line comment in C++?', '//', '/*', '<!--', '#', 'a'),
(14, 4, 'Which of the following is a C++ loop structure?', 'if', 'switch', 'for', 'else', 'c'),
(15, 2, 'What is the area of a circle with a radius of 5 units?', '25p', '10p', '5p', '100p', 'a'),
(16, 2, 'Solve for x: 2x + 5 = 15', 'x = 10', 'x = 5', 'x = 7.5', 'x = 20', 'b'),
(17, 3, 'What does the atomic number of an element represent?', 'Number of Neutrons', 'Number of Protons', 'Number of Electrons', 'Number of Protons + Neutrons', 'b'),
(18, 3, 'Which of the following is considered an acid?', 'NaOH', 'H2O', 'NaCl', 'HCl', 'd'),
(19, 5, 'Which keyword is used to create a new object in Java?', 'new', 'create', 'alloc', 'make', 'a'),
(20, 5, 'What is the entry point for any Java program?', 'start()', 'main()', 'run()', 'init()', 'b'),
(21, 5, 'Which of these is a primitive data type in Java?', 'String', 'Array', 'int', 'Object', 'c'),
(22, 5, 'What does JVM stand for?', 'Java Virtual Machine', 'Java Visual Machine', 'Java Verified Module', 'Just Virtual Machine', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `subject`, `created_at`) VALUES
(1, 'Physics Basics', 'Physics', '2025-06-22 11:43:30'),
(2, 'Math Fundamentals', 'Mathematics', '2025-06-22 11:43:30'),
(3, 'Chemistry 101', 'Chemistry', '2025-06-22 11:54:11'),
(4, 'C++ Fundamentals', 'C++', '2025-06-22 11:54:11'),
(5, 'Java Programming Basics', 'Java', '2025-06-22 11:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `user_id`, `quiz_id`, `score`, `total_questions`, `completed_at`) VALUES
(1, 1, 2, 2, 2, '2025-06-22 11:48:06'),
(2, 1, 3, 1, 5, '2025-06-25 10:25:04'),
(3, 1, 3, 1, 5, '2025-06-25 10:27:09'),
(4, 1, 3, 1, 5, '2025-06-26 10:22:33'),
(5, 1, 4, 1, 3, '2025-06-26 10:22:52'),
(6, 1, 4, 2, 3, '2025-06-26 10:29:24'),
(7, 1, 3, 1, 5, '2025-06-26 11:56:24'),
(8, 1, 5, 3, 4, '2025-06-27 13:41:21');

-- --------------------------------------------------------

--
-- Table structure for table `study_tips`
--

CREATE TABLE `study_tips` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `study_tips`
--

INSERT INTO `study_tips` (`id`, `title`, `content`, `category`, `created_at`) VALUES
(1, 'The Pomodoro Technique', '<p>The Pomodoro Technique is a time management method that uses a timer to break down work into intervals, traditionally 25 minutes in length, separated by short breaks.</p><p>This trains your brain to focus for short periods and helps prevent mental fatigue.</p>', 'Time Management', '2025-06-22 11:51:13'),
(2, 'Active Recall', '<p>Active recall is a learning method where you actively stimulate your memory for a piece of information. Instead of passively reading a text, try to recall the key concepts from scratch.</p><p>A great way to practice this is by using flashcards or trying to explain the topic to someone else.</p>', 'Learning Techniques', '2025-06-22 11:51:13'),
(3, 'Spaced Repetition', '<p>Spaced repetition is a learning technique that incorporates increasing intervals of time between subsequent reviews of previously learned material.</p><p>It is highly effective for memorizing a large amount of information, as it forces your brain to retrieve information just before you are about to forget it.</p>', 'Learning Techniques', '2025-06-22 11:51:13'),
(4, 'The Feynman Technique', '<p>The Feynman Technique is a method for learning and retaining information by explaining it in simple, plain language.</p><p>Steps: 1. Choose a concept. 2. Teach it to a toddler (or explain it very simply). 3. Identify gaps in your understanding. 4. Review and simplify.</p>', 'Learning Techniques', '2025-06-22 11:51:13'),
(5, 'Simulate Exam Conditions', '<p>When doing practice papers or tests, try to simulate the actual exam conditions as closely as possible.</p><p>This means timing yourself, putting away your notes, and working in a quiet environment. This helps reduce anxiety and improves performance on the actual exam day.</p>', 'Exam Prep', '2025-06-22 11:51:13');

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `user_id`, `task`, `is_completed`, `created_at`) VALUES
(1, 1, 'READ CHP 5 OF PHYSICS', 0, '2025-06-25 10:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `to_do`
--

CREATE TABLE `to_do` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `task` varchar(200) NOT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'khan', 'khan@gmail.com', '$2y$10$kmBur1PP71VnLu9PB4tJ9ucmssvLQMYVZ1lu8FMxZYPQwhtqVhnOO', '2025-06-22 11:20:35'),
(2, '78568668', 'yjjj@g', '$2y$10$Juww4as6eWp6nCux9FD1qekrnawzWK/34Lb7UWv6H3ExPrHNLaGUa', '2025-06-26 10:26:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `study_tips`
--
ALTER TABLE `study_tips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `to_do`
--
ALTER TABLE `to_do`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `study_tips`
--
ALTER TABLE `study_tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `to_do`
--
ALTER TABLE `to_do`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_results_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `todos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `to_do`
--
ALTER TABLE `to_do`
  ADD CONSTRAINT `to_do_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

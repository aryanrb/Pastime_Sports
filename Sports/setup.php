<?php
    $connect = mysqli_connect("localhost","root","");
    $createDB = "CREATE DATABASE pastime_Sports";
    mysqli_query($connect,$createDB);

    $connect1 = mysqli_select_db($connect,"pastime_Sports");

    $qry1 = "CREATE TABLE `counter` (
        `count_id` int(11) NOT NULL,
        `count` int(11) NOT NULL
      ) ";
    mysqli_query($connect,$qry1);

    $qry2 = "INSERT INTO `counter` (`count_id`, `count`) VALUES
           (1, 1022)";
    mysqli_query($connect,$qry2);

    $qry3 = "CREATE TABLE `events` (
        `id` int(11) NOT NULL,
        `title` varchar(255) NOT NULL,
        `description` longtext NOT NULL,
        `day` date NOT NULL,
        `time` time NOT NULL,
        `image` varchar(100) NOT NULL,
        `venue` varchar(30) NOT NULL
      )";
    mysqli_query($connect,$qry3);

    $qry4 = "INSERT INTO `events` (`id`, `title`, `description`, `day`, `time`, `image`, `venue`) VALUES
      (3, 'Swimming Challenge', 'We are organizing Swimming Challenge this saturday. So you are requested to help us.', '2018-10-31', '13:30:00', 'Events1.jpg', 'Swimming Park, Bhrikutimandap'),
      (4, 'Cricket tournament organizing', 'Gather in the softwarica hall to participate in the upcoming cricket tournament.', '2018-09-29', '05:00:00', 'Events2.jpg', 'Softwarica Hall'),
      (6, 'Cricket Auction', 'Next Saturday there will be an auction for the upcoming cricket torunament.', '2018-11-16', '08:00:00', 'Events3.jpg', 'TU ground, Kritipur')";
    mysqli_query($connect,$qry4);

    $qry5 = "CREATE TABLE `forumanswer` (
        `ansId` int(11) NOT NULL,
        `accName` int(100) NOT NULL,
        `answer` longtext NOT NULL,
        `qnId` int(11) NOT NULL
      )";
    mysqli_query($connect,$qry5);

    $qry6 = "INSERT INTO `forumanswer` (`ansId`, `accName`, `answer`, `qnId`) VALUES
      (36, 2, 'Sachin Tendulkar is the greatest cricketer of all time.', 32),
      (37, 6, 'The best football club is barcelona and best national football team is brazil.', 34),
      (38, 6, 'I love leonal Messi', 33),
      (39, 6, 'Rohit Sharma is the greatest for me', 32),
      (40, 6, 'Currently Joe root is the captain of england cricket team', 35)";
    mysqli_query($connect,$qry6);

    $qry7 = "CREATE TABLE `forumquestion` (
        `qnId` int(11) NOT NULL,
        `accName` varchar(50) NOT NULL,
        `question` varchar(255) NOT NULL
      )";
    mysqli_query($connect,$qry7);

    $qry8 = "INSERT INTO `forumquestion` (`qnId`, `accName`, `question`) VALUES
      (31, '2', 'What are some mind-blowing facts about cricket?'),
      (32, '1', 'Who is the greatest cricket player of all time?'),
      (33, '2', 'Who is the all time best footballer?'),
      (34, '2', 'Which is the best football team and why?'),
      (35, '2', 'Who is the captain of the England cricket team?')";
    mysqli_query($connect,$qry8);

    $qry9 = "CREATE TABLE `memberprofile` (
        `id` int(11) NOT NULL,
        `fname` varchar(50) NOT NULL,
        `lname` varchar(50) NOT NULL,
        `dob` date NOT NULL,
        `email` varchar(50) NOT NULL,
        `postalAddress` varchar(50) NOT NULL,
        `postCode` int(11) NOT NULL,
        `uname` varchar(50) NOT NULL,
        `password` varchar(50) NOT NULL,
        `type` enum('admin','member','user') NOT NULL
      )";
    mysqli_query($connect,$qry9);

    $qry10 = "INSERT INTO `memberprofile` (`id`, `fname`, `lname`, `dob`, `email`, `postalAddress`, `postCode`, `uname`, `password`, `type`) VALUES
      (1, 'aryan', 'rajbhandari', '2000-09-13', 'rajbhandari.aryanrb@gmail.com', 'Battar, Nuwakot', 356661, 'aryan', 'aryan1', 'admin'),
      (2, 'admond', 'tamang', '1998-02-22', 'tamang@diamond.com', 'Naya Bazzar', 42445, 'diamond', 'diamond', 'member'),
      (6, 'Basu', 'Rajbhandari', '1992-11-02', 'rajb@basu.com', 'balaju', 44166, 'basu', 'password', 'user'),
      (7, 'uttam', 'tamang', '1996-12-31', 'uttam123@gmail.com', 'Nuwakot', 764783, 'uttam123', 'utt12345', 'user'),
      (8, 'Aron', 'Rajbhandari', '2004-11-29', 'aronrajbhandari0@gmial.com', 'nuwakot,nepal', 977, 'Aron Rajbhandari', 'Aronarsenal1', 'user'),
      (9, 'aa', 'bb', '2004-02-06', 'aa@bb.cc', 'balaju', 44166, 'aa', 'aa', 'user')";
    mysqli_query($connect,$qry10);

    $qry11 = "CREATE TABLE `members` (
        `id` int(11) NOT NULL,
        `user` varchar(50) NOT NULL,
        `startDate` date NOT NULL,
        `renewedDate` date NOT NULL,
        `endDate` date NOT NULL,
        `fee` int(11) NOT NULL,
        `status` enum('Active','Requested','Expired') NOT NULL
      )";
    mysqli_query($connect,$qry11);

    $qry12 = "INSERT INTO `members` (`id`, `user`, `startDate`, `renewedDate`, `endDate`, `fee`, `status`) VALUES
      (3, 'diamond', '2018-10-23', '2018-10-24', '2020-10-23', 500, 'Active'),
      (4, 'aa', '2018-10-24', '0000-00-00', '2019-10-24', 5000, 'Requested')";
    mysqli_query($connect,$qry12);

    $qry13 = "CREATE TABLE `sports` (
        `id` int(11) NOT NULL,
        `game` varchar(50) NOT NULL,
        `description` longtext NOT NULL,
        `photo` varchar(100) NOT NULL
      )";
    mysqli_query($connect,$qry13);

    $qry14 = "INSERT INTO `sports` (`id`, `game`, `description`, `photo`) VALUES
      (13, 'Golf', 'Golf is a club-and-ball sport in which players use various clubs to hit balls into a series of holes on a course in as few strokes as possible', 'Sports1.jpg'),
      (14, 'Jousting', 'Jousting, western European mock battle between two horsemen charging each other with leveled lances, each attempting to unhorse the other.', 'Sports2.jpg'),
      (15, 'Horse Polo', 'Horse Polo, game played on horseback between two teams of four players each who use mallets with long, flexible handles to drive a wooden ball down a grass field and between two goal posts.', 'Sports3.jpg')";
    mysqli_query($connect,$qry14);

    $qry15 = "CREATE TABLE `subscriber` (
        `id` int(11) NOT NULL,
        `email` varchar(80) NOT NULL
      )";
    mysqli_query($connect,$qry15);

    $qry16 = "INSERT INTO `subscriber` (`id`, `email`) VALUES
      (1, 'myemail@gmail.com')";
    mysqli_query($connect,$qry16);


    $qry17 = "ALTER TABLE `events`
    ADD PRIMARY KEY (`id`)";
    mysqli_query($connect,$qry17);

    $qry18 = "ALTER TABLE `forumanswer`
    ADD PRIMARY KEY (`ansId`)";
    mysqli_query($connect,$qry18);

    $qry19 = "ALTER TABLE `forumquestion`
    ADD PRIMARY KEY (`qnId`)";
    mysqli_query($connect,$qry19);

    $qry20 = "ALTER TABLE `memberprofile`
    ADD PRIMARY KEY (`id`)";
    mysqli_query($connect,$qr20);

    $qry21 = "ALTER TABLE `members`
    ADD PRIMARY KEY (`id`)";
    mysqli_query($connect,$qry21);

    $qry22 = "ALTER TABLE `sports`
    ADD PRIMARY KEY (`id`)";
    mysqli_query($connect,$qry22);

    $qry23 = "ALTER TABLE `subscriber`
    ADD PRIMARY KEY (`id`)";
    mysqli_query($connect,$qry23);

    $qry24 = "ALTER TABLE `events`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7";
    mysqli_query($connect,$qry24);

    $qry25 = "ALTER TABLE `forumanswer`
    MODIFY `ansId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41";
    mysqli_query($connect,$qry25);

    $qry26 = "ALTER TABLE `forumquestion`
    MODIFY `qnId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36";
    mysqli_query($connect,$qry26);

    $qry27 = "ALTER TABLE `memberprofile`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10";
    mysqli_query($connect,$qry27);

    $qry28 = "ALTER TABLE `members`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5";
    mysqli_query($connect,$qry28);

    $qry29 = "ALTER TABLE `sports`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16";
    mysqli_query($connect,$qry29);

    $qry30 = "ALTER TABLE `subscriber`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2";
    mysqli_query($connect,$qry30);

    header("location: index.php");
?>

DROP TABLE IF EXISTS activity_log;

CREATE TABLE `activity_log` (
  `activitylogid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_recorded` datetime NOT NULL,
  PRIMARY KEY (`activitylogid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO activity_log VALUES("1","1","Update User: Hermoine Granger","2017-09-24 21:08:12");
INSERT INTO activity_log VALUES("2","1","Update User: Hermoine Granger","2017-09-24 21:08:15");
INSERT INTO activity_log VALUES("3","1","Update User: Hermoine Granger","2017-09-24 21:08:19");
INSERT INTO activity_log VALUES("4","1","Update User: Hermoine Granger","2017-09-24 21:10:00");
INSERT INTO activity_log VALUES("5","1","Added Academic Year Setting","2017-09-24 21:12:45");
INSERT INTO activity_log VALUES("6","1","Save Curriculum Setting","2017-09-24 23:40:50");
INSERT INTO activity_log VALUES("7","1","Remove Subject From Curriculum: Research","2017-09-24 23:40:53");
INSERT INTO activity_log VALUES("8","1","Added Teacher: Juan Cruz","2017-09-25 00:51:18");
INSERT INTO activity_log VALUES("9","1","User Logged In: Admin Admin","2017-09-25 08:10:00");
INSERT INTO activity_log VALUES("10","1","Students Registration: Raymond Serion","2017-09-25 08:18:04");
INSERT INTO activity_log VALUES("11","1","Process Enrollment for Student Name Raymond Serion","2017-09-25 08:28:32");
INSERT INTO activity_log VALUES("12","1","Process Academic Details for Student Name Raymond Serion","2017-09-25 08:28:40");
INSERT INTO activity_log VALUES("13","1","Generate Enrollment Form for Student Raymond Serion","2017-09-25 10:03:08");
INSERT INTO activity_log VALUES("1","1","Update User: Hermoine Granger","2017-09-24 21:08:12");
INSERT INTO activity_log VALUES("2","1","Update User: Hermoine Granger","2017-09-24 21:08:15");
INSERT INTO activity_log VALUES("3","1","Update User: Hermoine Granger","2017-09-24 21:08:19");
INSERT INTO activity_log VALUES("4","1","Update User: Hermoine Granger","2017-09-24 21:10:00");
INSERT INTO activity_log VALUES("5","1","Added Academic Year Setting","2017-09-24 21:12:45");
INSERT INTO activity_log VALUES("6","1","Save Curriculum Setting","2017-09-24 23:40:50");
INSERT INTO activity_log VALUES("7","1","Remove Subject From Curriculum: Research","2017-09-24 23:40:53");
INSERT INTO activity_log VALUES("8","1","Added Teacher: Juan Cruz","2017-09-25 00:51:18");
INSERT INTO activity_log VALUES("9","1","User Logged In: Admin Admin","2017-09-25 08:10:00");
INSERT INTO activity_log VALUES("10","1","Students Registration: Raymond Serion","2017-09-25 08:18:04");
INSERT INTO activity_log VALUES("11","1","Process Enrollment for Student Name Raymond Serion","2017-09-25 08:28:32");
INSERT INTO activity_log VALUES("12","1","Process Academic Details for Student Name Raymond Serion","2017-09-25 08:28:40");
INSERT INTO activity_log VALUES("13","1","Generate Enrollment Form for Student Raymond Serion","2017-09-25 10:03:08");
INSERT INTO activity_log VALUES("1","1","Update User: Hermoine Granger","2017-09-24 21:08:12");
INSERT INTO activity_log VALUES("2","1","Update User: Hermoine Granger","2017-09-24 21:08:15");
INSERT INTO activity_log VALUES("3","1","Update User: Hermoine Granger","2017-09-24 21:08:19");
INSERT INTO activity_log VALUES("4","1","Update User: Hermoine Granger","2017-09-24 21:10:00");
INSERT INTO activity_log VALUES("5","1","Added Academic Year Setting","2017-09-24 21:12:45");
INSERT INTO activity_log VALUES("6","1","Save Curriculum Setting","2017-09-24 23:40:50");
INSERT INTO activity_log VALUES("7","1","Remove Subject From Curriculum: Research","2017-09-24 23:40:53");
INSERT INTO activity_log VALUES("8","1","Added Teacher: Juan Cruz","2017-09-25 00:51:18");
INSERT INTO activity_log VALUES("9","1","User Logged In: Admin Admin","2017-09-25 08:10:00");
INSERT INTO activity_log VALUES("10","1","Students Registration: Raymond Serion","2017-09-25 08:18:04");
INSERT INTO activity_log VALUES("11","1","Process Enrollment for Student Name Raymond Serion","2017-09-25 08:28:32");
INSERT INTO activity_log VALUES("12","1","Process Academic Details for Student Name Raymond Serion","2017-09-25 08:28:40");
INSERT INTO activity_log VALUES("13","1","Generate Enrollment Form for Student Raymond Serion","2017-09-25 10:03:08");
INSERT INTO activity_log VALUES("1","1","Update User: Hermoine Granger","2017-09-24 21:08:12");
INSERT INTO activity_log VALUES("2","1","Update User: Hermoine Granger","2017-09-24 21:08:15");
INSERT INTO activity_log VALUES("3","1","Update User: Hermoine Granger","2017-09-24 21:08:19");
INSERT INTO activity_log VALUES("4","1","Update User: Hermoine Granger","2017-09-24 21:10:00");
INSERT INTO activity_log VALUES("5","1","Added Academic Year Setting","2017-09-24 21:12:45");
INSERT INTO activity_log VALUES("6","1","Save Curriculum Setting","2017-09-24 23:40:50");
INSERT INTO activity_log VALUES("7","1","Remove Subject From Curriculum: Research","2017-09-24 23:40:53");
INSERT INTO activity_log VALUES("8","1","Added Teacher: Juan Cruz","2017-09-25 00:51:18");
INSERT INTO activity_log VALUES("9","1","User Logged In: Admin Admin","2017-09-25 08:10:00");
INSERT INTO activity_log VALUES("10","1","Students Registration: Raymond Serion","2017-09-25 08:18:04");
INSERT INTO activity_log VALUES("11","1","Process Enrollment for Student Name Raymond Serion","2017-09-25 08:28:32");
INSERT INTO activity_log VALUES("12","1","Process Academic Details for Student Name Raymond Serion","2017-09-25 08:28:40");
INSERT INTO activity_log VALUES("13","1","Generate Enrollment Form for Student Raymond Serion","2017-09-25 10:03:08");



DROP TABLE IF EXISTS curriculum;

CREATE TABLE `curriculum` (
  `curriculumid` int(11) NOT NULL AUTO_INCREMENT,
  `curriculum_title` varchar(50) NOT NULL,
  `curriculum_description` varchar(150) NOT NULL,
  `hasSpecialization` tinyint(1) NOT NULL DEFAULT '0',
  `isSingleSection` tinyint(1) NOT NULL DEFAULT '0',
  `isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`curriculumid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO curriculum VALUES("1","BEC","BEC","1","0","0");
INSERT INTO curriculum VALUES("2","SPA","SPA","1","1","0");
INSERT INTO curriculum VALUES("3","SPS","SPS","1","1","0");
INSERT INTO curriculum VALUES("1","BEC","BEC","1","0","0");
INSERT INTO curriculum VALUES("2","SPA","SPA","1","1","0");
INSERT INTO curriculum VALUES("3","SPS","SPS","1","1","0");
INSERT INTO curriculum VALUES("1","BEC","BEC","1","0","0");
INSERT INTO curriculum VALUES("2","SPA","SPA","1","1","0");
INSERT INTO curriculum VALUES("3","SPS","SPS","1","1","0");
INSERT INTO curriculum VALUES("1","BEC","BEC","1","0","0");
INSERT INTO curriculum VALUES("2","SPA","SPA","1","1","0");
INSERT INTO curriculum VALUES("3","SPS","SPS","1","1","0");
INSERT INTO curriculum VALUES("1","BEC","BEC","1","0","0");
INSERT INTO curriculum VALUES("2","SPA","SPA","1","1","0");
INSERT INTO curriculum VALUES("3","SPS","SPS","1","1","0");
INSERT INTO curriculum VALUES("1","BEC","BEC","1","0","0");
INSERT INTO curriculum VALUES("2","SPA","SPA","1","1","0");
INSERT INTO curriculum VALUES("3","SPS","SPS","1","1","0");



DROP TABLE IF EXISTS documents;

CREATE TABLE `documents` (
  `documentid` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) NOT NULL,
  `filename` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `filetype` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_uploaded` datetime NOT NULL,
  PRIMARY KEY (`documentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS levels;

CREATE TABLE `levels` (
  `levelid` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(100) NOT NULL,
  PRIMARY KEY (`levelid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO levels VALUES("1","Grade 7");
INSERT INTO levels VALUES("2","Grade 8");
INSERT INTO levels VALUES("3","Grade 9");
INSERT INTO levels VALUES("4","Grade 10");
INSERT INTO levels VALUES("1","Grade 7");
INSERT INTO levels VALUES("2","Grade 8");
INSERT INTO levels VALUES("3","Grade 9");
INSERT INTO levels VALUES("4","Grade 10");



DROP TABLE IF EXISTS sections;

CREATE TABLE `sections` (
  `sectionid` int(11) NOT NULL AUTO_INCREMENT,
  `section_title` varchar(150) NOT NULL,
  `teacherid` int(11) NOT NULL,
  `levelid` int(11) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`sectionid`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

INSERT INTO sections VALUES("1","Revelation","0","1","0");
INSERT INTO sections VALUES("2","Isaiah","0","1","0");
INSERT INTO sections VALUES("3","Genesis","0","1","0");
INSERT INTO sections VALUES("4","Hebrew","0","1","0");
INSERT INTO sections VALUES("5","Timothy","0","1","0");
INSERT INTO sections VALUES("6","Ezekiel","0","1","0");
INSERT INTO sections VALUES("7","Obadiah","0","1","0");
INSERT INTO sections VALUES("8","Uzziah","0","1","0");
INSERT INTO sections VALUES("9","Samuel","0","1","0");
INSERT INTO sections VALUES("10","Nehemiah","0","1","1");
INSERT INTO sections VALUES("11","Exodus","0","1","1");
INSERT INTO sections VALUES("12","Stark","0","2","0");
INSERT INTO sections VALUES("13","Arryn","0","2","0");
INSERT INTO sections VALUES("14","Bolton","0","2","0");
INSERT INTO sections VALUES("15","Greyjoy","0","2","0");
INSERT INTO sections VALUES("16","Lannister","0","2","0");
INSERT INTO sections VALUES("17","Tully","0","2","0");
INSERT INTO sections VALUES("18","Martell","0","2","0");
INSERT INTO sections VALUES("19","Tyrell","0","2","0");
INSERT INTO sections VALUES("20","Tarth","0","2","0");
INSERT INTO sections VALUES("21","Oxford","0","2","0");
INSERT INTO sections VALUES("22","God-Fearing","0","3","0");
INSERT INTO sections VALUES("23","Obedient","0","3","0");
INSERT INTO sections VALUES("24","Outstanding","0","3","0");
INSERT INTO sections VALUES("25","Discipline","0","3","0");
INSERT INTO sections VALUES("26","Virtue","0","3","0");
INSERT INTO sections VALUES("27","Industrious","0","3","0");
INSERT INTO sections VALUES("28","Beatitude","0","3","0");
INSERT INTO sections VALUES("29","Empathy","0","3","0");
INSERT INTO sections VALUES("30","Sensitive","0","3","0");
INSERT INTO sections VALUES("31","Oreads","0","4","0");
INSERT INTO sections VALUES("32","Latona","0","4","0");
INSERT INTO sections VALUES("33","Youth","0","4","0");
INSERT INTO sections VALUES("34","Persephone","0","4","0");
INSERT INTO sections VALUES("35","Minerva","0","4","0");
INSERT INTO sections VALUES("36","Iris","0","4","0");
INSERT INTO sections VALUES("37","Neptune","0","4","0");
INSERT INTO sections VALUES("38","Aphrodite","0","4","0");
INSERT INTO sections VALUES("1","Revelation","0","1","0");
INSERT INTO sections VALUES("2","Isaiah","0","1","0");
INSERT INTO sections VALUES("3","Genesis","0","1","0");
INSERT INTO sections VALUES("4","Hebrew","0","1","0");
INSERT INTO sections VALUES("5","Timothy","0","1","0");
INSERT INTO sections VALUES("6","Ezekiel","0","1","0");
INSERT INTO sections VALUES("7","Obadiah","0","1","0");
INSERT INTO sections VALUES("8","Uzziah","0","1","0");
INSERT INTO sections VALUES("9","Samuel","0","1","0");
INSERT INTO sections VALUES("10","Nehemiah","0","1","1");
INSERT INTO sections VALUES("11","Exodus","0","1","1");
INSERT INTO sections VALUES("12","Stark","0","2","0");
INSERT INTO sections VALUES("13","Arryn","0","2","0");
INSERT INTO sections VALUES("14","Bolton","0","2","0");
INSERT INTO sections VALUES("15","Greyjoy","0","2","0");
INSERT INTO sections VALUES("16","Lannister","0","2","0");
INSERT INTO sections VALUES("17","Tully","0","2","0");
INSERT INTO sections VALUES("18","Martell","0","2","0");
INSERT INTO sections VALUES("19","Tyrell","0","2","0");
INSERT INTO sections VALUES("20","Tarth","0","2","0");
INSERT INTO sections VALUES("21","Oxford","0","2","0");
INSERT INTO sections VALUES("22","God-Fearing","0","3","0");
INSERT INTO sections VALUES("23","Obedient","0","3","0");
INSERT INTO sections VALUES("24","Outstanding","0","3","0");
INSERT INTO sections VALUES("25","Discipline","0","3","0");
INSERT INTO sections VALUES("26","Virtue","0","3","0");
INSERT INTO sections VALUES("27","Industrious","0","3","0");
INSERT INTO sections VALUES("28","Beatitude","0","3","0");
INSERT INTO sections VALUES("29","Empathy","0","3","0");
INSERT INTO sections VALUES("30","Sensitive","0","3","0");
INSERT INTO sections VALUES("31","Oreads","0","4","0");
INSERT INTO sections VALUES("32","Latona","0","4","0");
INSERT INTO sections VALUES("33","Youth","0","4","0");
INSERT INTO sections VALUES("34","Persephone","0","4","0");
INSERT INTO sections VALUES("35","Minerva","0","4","0");
INSERT INTO sections VALUES("36","Iris","0","4","0");
INSERT INTO sections VALUES("37","Neptune","0","4","0");
INSERT INTO sections VALUES("38","Aphrodite","0","4","0");
INSERT INTO sections VALUES("1","Revelation","0","1","0");
INSERT INTO sections VALUES("2","Isaiah","0","1","0");
INSERT INTO sections VALUES("3","Genesis","0","1","0");
INSERT INTO sections VALUES("4","Hebrew","0","1","0");
INSERT INTO sections VALUES("5","Timothy","0","1","0");
INSERT INTO sections VALUES("6","Ezekiel","0","1","0");
INSERT INTO sections VALUES("7","Obadiah","0","1","0");
INSERT INTO sections VALUES("8","Uzziah","0","1","0");
INSERT INTO sections VALUES("9","Samuel","0","1","0");
INSERT INTO sections VALUES("10","Nehemiah","0","1","1");
INSERT INTO sections VALUES("11","Exodus","0","1","1");
INSERT INTO sections VALUES("12","Stark","0","2","0");
INSERT INTO sections VALUES("13","Arryn","0","2","0");
INSERT INTO sections VALUES("14","Bolton","0","2","0");
INSERT INTO sections VALUES("15","Greyjoy","0","2","0");
INSERT INTO sections VALUES("16","Lannister","0","2","0");
INSERT INTO sections VALUES("17","Tully","0","2","0");
INSERT INTO sections VALUES("18","Martell","0","2","0");
INSERT INTO sections VALUES("19","Tyrell","0","2","0");
INSERT INTO sections VALUES("20","Tarth","0","2","0");
INSERT INTO sections VALUES("21","Oxford","0","2","0");
INSERT INTO sections VALUES("22","God-Fearing","0","3","0");
INSERT INTO sections VALUES("23","Obedient","0","3","0");
INSERT INTO sections VALUES("24","Outstanding","0","3","0");
INSERT INTO sections VALUES("25","Discipline","0","3","0");
INSERT INTO sections VALUES("26","Virtue","0","3","0");
INSERT INTO sections VALUES("27","Industrious","0","3","0");
INSERT INTO sections VALUES("28","Beatitude","0","3","0");
INSERT INTO sections VALUES("29","Empathy","0","3","0");
INSERT INTO sections VALUES("30","Sensitive","0","3","0");
INSERT INTO sections VALUES("31","Oreads","0","4","0");
INSERT INTO sections VALUES("32","Latona","0","4","0");
INSERT INTO sections VALUES("33","Youth","0","4","0");
INSERT INTO sections VALUES("34","Persephone","0","4","0");
INSERT INTO sections VALUES("35","Minerva","0","4","0");
INSERT INTO sections VALUES("36","Iris","0","4","0");
INSERT INTO sections VALUES("37","Neptune","0","4","0");
INSERT INTO sections VALUES("38","Aphrodite","0","4","0");
INSERT INTO sections VALUES("1","Revelation","0","1","0");
INSERT INTO sections VALUES("2","Isaiah","0","1","0");
INSERT INTO sections VALUES("3","Genesis","0","1","0");
INSERT INTO sections VALUES("4","Hebrew","0","1","0");
INSERT INTO sections VALUES("5","Timothy","0","1","0");
INSERT INTO sections VALUES("6","Ezekiel","0","1","0");
INSERT INTO sections VALUES("7","Obadiah","0","1","0");
INSERT INTO sections VALUES("8","Uzziah","0","1","0");
INSERT INTO sections VALUES("9","Samuel","0","1","0");
INSERT INTO sections VALUES("10","Nehemiah","0","1","1");
INSERT INTO sections VALUES("11","Exodus","0","1","1");
INSERT INTO sections VALUES("12","Stark","0","2","0");
INSERT INTO sections VALUES("13","Arryn","0","2","0");
INSERT INTO sections VALUES("14","Bolton","0","2","0");
INSERT INTO sections VALUES("15","Greyjoy","0","2","0");
INSERT INTO sections VALUES("16","Lannister","0","2","0");
INSERT INTO sections VALUES("17","Tully","0","2","0");
INSERT INTO sections VALUES("18","Martell","0","2","0");
INSERT INTO sections VALUES("19","Tyrell","0","2","0");
INSERT INTO sections VALUES("20","Tarth","0","2","0");
INSERT INTO sections VALUES("21","Oxford","0","2","0");
INSERT INTO sections VALUES("22","God-Fearing","0","3","0");
INSERT INTO sections VALUES("23","Obedient","0","3","0");
INSERT INTO sections VALUES("24","Outstanding","0","3","0");
INSERT INTO sections VALUES("25","Discipline","0","3","0");
INSERT INTO sections VALUES("26","Virtue","0","3","0");
INSERT INTO sections VALUES("27","Industrious","0","3","0");
INSERT INTO sections VALUES("28","Beatitude","0","3","0");
INSERT INTO sections VALUES("29","Empathy","0","3","0");
INSERT INTO sections VALUES("30","Sensitive","0","3","0");
INSERT INTO sections VALUES("31","Oreads","0","4","0");
INSERT INTO sections VALUES("32","Latona","0","4","0");
INSERT INTO sections VALUES("33","Youth","0","4","0");
INSERT INTO sections VALUES("34","Persephone","0","4","0");
INSERT INTO sections VALUES("35","Minerva","0","4","0");
INSERT INTO sections VALUES("36","Iris","0","4","0");
INSERT INTO sections VALUES("37","Neptune","0","4","0");
INSERT INTO sections VALUES("38","Aphrodite","0","4","0");
INSERT INTO sections VALUES("1","Revelation","0","1","0");
INSERT INTO sections VALUES("2","Isaiah","0","1","0");
INSERT INTO sections VALUES("3","Genesis","0","1","0");
INSERT INTO sections VALUES("4","Hebrew","0","1","0");
INSERT INTO sections VALUES("5","Timothy","0","1","0");
INSERT INTO sections VALUES("6","Ezekiel","0","1","0");
INSERT INTO sections VALUES("7","Obadiah","0","1","0");
INSERT INTO sections VALUES("8","Uzziah","0","1","0");
INSERT INTO sections VALUES("9","Samuel","0","1","0");
INSERT INTO sections VALUES("10","Nehemiah","0","1","1");
INSERT INTO sections VALUES("11","Exodus","0","1","1");
INSERT INTO sections VALUES("12","Stark","0","2","0");
INSERT INTO sections VALUES("13","Arryn","0","2","0");
INSERT INTO sections VALUES("14","Bolton","0","2","0");
INSERT INTO sections VALUES("15","Greyjoy","0","2","0");
INSERT INTO sections VALUES("16","Lannister","0","2","0");
INSERT INTO sections VALUES("17","Tully","0","2","0");
INSERT INTO sections VALUES("18","Martell","0","2","0");
INSERT INTO sections VALUES("19","Tyrell","0","2","0");
INSERT INTO sections VALUES("20","Tarth","0","2","0");
INSERT INTO sections VALUES("21","Oxford","0","2","0");
INSERT INTO sections VALUES("22","God-Fearing","0","3","0");
INSERT INTO sections VALUES("23","Obedient","0","3","0");
INSERT INTO sections VALUES("24","Outstanding","0","3","0");
INSERT INTO sections VALUES("25","Discipline","0","3","0");
INSERT INTO sections VALUES("26","Virtue","0","3","0");
INSERT INTO sections VALUES("27","Industrious","0","3","0");
INSERT INTO sections VALUES("28","Beatitude","0","3","0");
INSERT INTO sections VALUES("29","Empathy","0","3","0");
INSERT INTO sections VALUES("30","Sensitive","0","3","0");
INSERT INTO sections VALUES("31","Oreads","0","4","0");
INSERT INTO sections VALUES("32","Latona","0","4","0");
INSERT INTO sections VALUES("33","Youth","0","4","0");
INSERT INTO sections VALUES("34","Persephone","0","4","0");
INSERT INTO sections VALUES("35","Minerva","0","4","0");
INSERT INTO sections VALUES("36","Iris","0","4","0");
INSERT INTO sections VALUES("37","Neptune","0","4","0");
INSERT INTO sections VALUES("38","Aphrodite","0","4","0");



DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `settingsid` int(11) NOT NULL AUTO_INCREMENT,
  `academicyear` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_principal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enrollment_start_date` date NOT NULL,
  `enrollment_end_date` date NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`settingsid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO settings VALUES("1","2017-2018","Mr. Benjie Magada","2017-09-24","2017-09-30","1");
INSERT INTO settings VALUES("1","2017-2018","Mr. Benjie Magada","2017-09-24","2017-09-30","1");
INSERT INTO settings VALUES("1","2017-2018","Mr. Benjie Magada","2017-09-24","2017-09-30","1");
INSERT INTO settings VALUES("1","2017-2018","Mr. Benjie Magada","2017-09-24","2017-09-30","1");
INSERT INTO settings VALUES("1","2017-2018","Mr. Benjie Magada","2017-09-24","2017-09-30","1");
INSERT INTO settings VALUES("1","2017-2018","Mr. Benjie Magada","2017-09-24","2017-09-30","1");



DROP TABLE IF EXISTS specialization;

CREATE TABLE `specialization` (
  `specializationid` int(11) NOT NULL AUTO_INCREMENT,
  `specialization_description` varchar(150) NOT NULL,
  `curriculumid` int(11) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`specializationid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO specialization VALUES("1","Automotive","1","0");
INSERT INTO specialization VALUES("2","Electrical","1","0");
INSERT INTO specialization VALUES("3","Electronics","1","0");
INSERT INTO specialization VALUES("4","Agriculture","1","0");
INSERT INTO specialization VALUES("5","Cooking","1","0");
INSERT INTO specialization VALUES("6","Dress-Making","1","0");
INSERT INTO specialization VALUES("7","Singing","2","0");
INSERT INTO specialization VALUES("8","Dancing","2","0");
INSERT INTO specialization VALUES("9","Basketball","3","0");
INSERT INTO specialization VALUES("10","Baseball","3","0");
INSERT INTO specialization VALUES("1","Automotive","1","0");
INSERT INTO specialization VALUES("2","Electrical","1","0");
INSERT INTO specialization VALUES("3","Electronics","1","0");
INSERT INTO specialization VALUES("4","Agriculture","1","0");
INSERT INTO specialization VALUES("5","Cooking","1","0");
INSERT INTO specialization VALUES("6","Dress-Making","1","0");
INSERT INTO specialization VALUES("7","Singing","2","0");
INSERT INTO specialization VALUES("8","Dancing","2","0");
INSERT INTO specialization VALUES("9","Basketball","3","0");
INSERT INTO specialization VALUES("10","Baseball","3","0");
INSERT INTO specialization VALUES("1","Automotive","1","0");
INSERT INTO specialization VALUES("2","Electrical","1","0");
INSERT INTO specialization VALUES("3","Electronics","1","0");
INSERT INTO specialization VALUES("4","Agriculture","1","0");
INSERT INTO specialization VALUES("5","Cooking","1","0");
INSERT INTO specialization VALUES("6","Dress-Making","1","0");
INSERT INTO specialization VALUES("7","Singing","2","0");
INSERT INTO specialization VALUES("8","Dancing","2","0");
INSERT INTO specialization VALUES("9","Basketball","3","0");
INSERT INTO specialization VALUES("10","Baseball","3","0");
INSERT INTO specialization VALUES("1","Automotive","1","0");
INSERT INTO specialization VALUES("2","Electrical","1","0");
INSERT INTO specialization VALUES("3","Electronics","1","0");
INSERT INTO specialization VALUES("4","Agriculture","1","0");
INSERT INTO specialization VALUES("5","Cooking","1","0");
INSERT INTO specialization VALUES("6","Dress-Making","1","0");
INSERT INTO specialization VALUES("7","Singing","2","0");
INSERT INTO specialization VALUES("8","Dancing","2","0");
INSERT INTO specialization VALUES("9","Basketball","3","0");
INSERT INTO specialization VALUES("10","Baseball","3","0");



DROP TABLE IF EXISTS student_grades;

CREATE TABLE `student_grades` (
  `studentgradesid` int(11) NOT NULL AUTO_INCREMENT,
  `studentacademicdetailid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `first_grading` decimal(10,2) NOT NULL,
  `second_grading` decimal(10,2) NOT NULL,
  `third_grading` decimal(10,2) NOT NULL,
  `fourth_grading` decimal(10,2) NOT NULL,
  PRIMARY KEY (`studentgradesid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS students;

CREATE TABLE `students` (
  `studentid` int(11) NOT NULL AUTO_INCREMENT,
  `lrn` varchar(12) NOT NULL DEFAULT '0',
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `religion` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `last_school_attended` varchar(255) NOT NULL,
  `last_school_attended_school_year` varchar(9) NOT NULL,
  `last_school_attended_address` varchar(255) NOT NULL,
  `general_average` decimal(10,2) NOT NULL,
  `fathers_name` varchar(255) NOT NULL,
  `fathers_occupation` varchar(150) NOT NULL,
  `mothers_name` varchar(255) NOT NULL,
  `mothers_occupation` varchar(150) NOT NULL,
  `no_of_children_in_the_family` tinyint(2) NOT NULL DEFAULT '0',
  `skills_and_talents` mediumtext NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `dialect` varchar(50) NOT NULL,
  `residential_address` varchar(255) NOT NULL,
  `living_with_parents` tinyint(4) NOT NULL,
  `guardian` varchar(255) NOT NULL,
  `guardian_relationship` varchar(100) NOT NULL,
  `is4Ps` enum('yes','no') NOT NULL DEFAULT 'no',
  `specialization_first` varchar(100) NOT NULL,
  `specialization_first_school` varchar(255) NOT NULL,
  `specialization_second` varchar(100) NOT NULL,
  `specialization_second_school` varchar(255) NOT NULL,
  `isDroppedOut` int(11) NOT NULL DEFAULT '0',
  `noOfTimesDropped` int(11) NOT NULL DEFAULT '0',
  `droppedGradeLevel` varchar(255) NOT NULL,
  `isRepeater` tinyint(4) NOT NULL DEFAULT '0',
  `noOfTimesRepeated` int(11) NOT NULL DEFAULT '0',
  `repeatedGradeLevel` varchar(255) NOT NULL,
  `image` varchar(70) NOT NULL,
  PRIMARY KEY (`studentid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");
INSERT INTO students VALUES("1","123456789011","Raymond","Jumanguin","Serion","male","Born Again Christian","1991-04-19","Bacolod City","DMLMHS","2010-2011","Rizal St. Tres Fuentes, Silay City","80.00","Roberto B. Serion","","Elda J. Serion","","7","Singing, Dancing","","","","1","","","no","Automotive","La Salle","Electronics","San Agustin","0","0","","0","0","","");



DROP TABLE IF EXISTS students_academic_detail;

CREATE TABLE `students_academic_detail` (
  `studentacademicdetailid` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) NOT NULL,
  `academicyear` varchar(9) NOT NULL,
  `levelid` int(11) NOT NULL,
  `sectionid` int(11) NOT NULL,
  `curriculumid` int(11) NOT NULL,
  `specializationid` int(11) NOT NULL DEFAULT '0',
  `date_enrolled` datetime NOT NULL,
  `status` enum('on-date','late') NOT NULL DEFAULT 'on-date',
  `final_average_grade` decimal(10,2) NOT NULL,
  PRIMARY KEY (`studentacademicdetailid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO students_academic_detail VALUES("1","1","2017-2018","1","0","1","1","2017-09-25 08:28:40","on-date","0.00");
INSERT INTO students_academic_detail VALUES("1","1","2017-2018","1","0","1","1","2017-09-25 08:28:40","on-date","0.00");
INSERT INTO students_academic_detail VALUES("1","1","2017-2018","1","0","1","1","2017-09-25 08:28:40","on-date","0.00");
INSERT INTO students_academic_detail VALUES("1","1","2017-2018","1","0","1","1","2017-09-25 08:28:40","on-date","0.00");
INSERT INTO students_academic_detail VALUES("1","1","2017-2018","1","0","1","1","2017-09-25 08:28:40","on-date","0.00");
INSERT INTO students_academic_detail VALUES("1","1","2017-2018","1","0","1","1","2017-09-25 08:28:40","on-date","0.00");
INSERT INTO students_academic_detail VALUES("1","1","2017-2018","1","0","1","1","2017-09-25 08:28:40","on-date","0.00");
INSERT INTO students_academic_detail VALUES("1","1","2017-2018","1","0","1","1","2017-09-25 08:28:40","on-date","0.00");
INSERT INTO students_academic_detail VALUES("1","1","2017-2018","1","0","1","1","2017-09-25 08:28:40","on-date","0.00");
INSERT INTO students_academic_detail VALUES("1","1","2017-2018","1","0","1","1","2017-09-25 08:28:40","on-date","0.00");



DROP TABLE IF EXISTS students_registration;

CREATE TABLE `students_registration` (
  `studentid` int(11) NOT NULL,
  `academicyear` varchar(9) NOT NULL,
  `status` enum('pending','enrolled') NOT NULL DEFAULT 'pending',
  `type` enum('new','transferee','regular','irregular','balik-aral') NOT NULL DEFAULT 'new',
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `height_personnel_verified` varchar(150) NOT NULL,
  `weight_personnel_verified` varchar(150) NOT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO students_registration VALUES("1","2017-2018","enrolled","new","","","","","2017-09-25 08:18:04");
INSERT INTO students_registration VALUES("1","2017-2018","enrolled","new","","","","","2017-09-25 08:18:04");
INSERT INTO students_registration VALUES("1","2017-2018","enrolled","new","","","","","2017-09-25 08:18:04");
INSERT INTO students_registration VALUES("1","2017-2018","enrolled","new","","","","","2017-09-25 08:18:04");
INSERT INTO students_registration VALUES("1","2017-2018","enrolled","new","","","","","2017-09-25 08:18:04");
INSERT INTO students_registration VALUES("1","2017-2018","enrolled","new","","","","","2017-09-25 08:18:04");
INSERT INTO students_registration VALUES("1","2017-2018","enrolled","new","","","","","2017-09-25 08:18:04");
INSERT INTO students_registration VALUES("1","2017-2018","enrolled","new","","","","","2017-09-25 08:18:04");
INSERT INTO students_registration VALUES("1","2017-2018","enrolled","new","","","","","2017-09-25 08:18:04");



DROP TABLE IF EXISTS subject_curriculum;

CREATE TABLE `subject_curriculum` (
  `subjectid` int(11) NOT NULL,
  `curriculumid` int(11) NOT NULL,
  `levelid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO subject_curriculum VALUES("1","1","3");
INSERT INTO subject_curriculum VALUES("3","1","4");
INSERT INTO subject_curriculum VALUES("8","1","1");
INSERT INTO subject_curriculum VALUES("9","1","1");
INSERT INTO subject_curriculum VALUES("10","1","1");
INSERT INTO subject_curriculum VALUES("3","1","1");
INSERT INTO subject_curriculum VALUES("11","1","1");
INSERT INTO subject_curriculum VALUES("12","1","1");
INSERT INTO subject_curriculum VALUES("2","1","2");
INSERT INTO subject_curriculum VALUES("8","1","2");
INSERT INTO subject_curriculum VALUES("9","1","2");
INSERT INTO subject_curriculum VALUES("10","1","2");
INSERT INTO subject_curriculum VALUES("11","1","2");
INSERT INTO subject_curriculum VALUES("12","1","2");
INSERT INTO subject_curriculum VALUES("1","2","1");
INSERT INTO subject_curriculum VALUES("1","2","1");
INSERT INTO subject_curriculum VALUES("2","2","1");
INSERT INTO subject_curriculum VALUES("3","2","1");
INSERT INTO subject_curriculum VALUES("8","2","1");
INSERT INTO subject_curriculum VALUES("9","2","1");
INSERT INTO subject_curriculum VALUES("10","2","1");
INSERT INTO subject_curriculum VALUES("11","2","1");
INSERT INTO subject_curriculum VALUES("12","2","1");
INSERT INTO subject_curriculum VALUES("1","2","2");
INSERT INTO subject_curriculum VALUES("2","2","2");
INSERT INTO subject_curriculum VALUES("3","2","2");
INSERT INTO subject_curriculum VALUES("8","2","2");
INSERT INTO subject_curriculum VALUES("9","2","2");
INSERT INTO subject_curriculum VALUES("10","2","2");
INSERT INTO subject_curriculum VALUES("11","2","2");
INSERT INTO subject_curriculum VALUES("12","2","2");
INSERT INTO subject_curriculum VALUES("1","2","3");
INSERT INTO subject_curriculum VALUES("2","2","3");
INSERT INTO subject_curriculum VALUES("3","2","3");
INSERT INTO subject_curriculum VALUES("8","2","3");
INSERT INTO subject_curriculum VALUES("9","2","3");
INSERT INTO subject_curriculum VALUES("10","2","3");
INSERT INTO subject_curriculum VALUES("11","2","3");
INSERT INTO subject_curriculum VALUES("12","2","3");
INSERT INTO subject_curriculum VALUES("1","2","4");
INSERT INTO subject_curriculum VALUES("2","2","4");
INSERT INTO subject_curriculum VALUES("3","2","4");
INSERT INTO subject_curriculum VALUES("8","2","4");
INSERT INTO subject_curriculum VALUES("9","2","4");
INSERT INTO subject_curriculum VALUES("10","2","4");
INSERT INTO subject_curriculum VALUES("11","2","4");
INSERT INTO subject_curriculum VALUES("12","2","4");
INSERT INTO subject_curriculum VALUES("2","1","3");
INSERT INTO subject_curriculum VALUES("3","1","3");
INSERT INTO subject_curriculum VALUES("8","1","3");
INSERT INTO subject_curriculum VALUES("9","1","3");
INSERT INTO subject_curriculum VALUES("10","1","3");
INSERT INTO subject_curriculum VALUES("11","1","3");
INSERT INTO subject_curriculum VALUES("12","1","3");
INSERT INTO subject_curriculum VALUES("8","1","4");
INSERT INTO subject_curriculum VALUES("2","1","4");
INSERT INTO subject_curriculum VALUES("9","1","4");
INSERT INTO subject_curriculum VALUES("10","1","4");
INSERT INTO subject_curriculum VALUES("11","1","4");
INSERT INTO subject_curriculum VALUES("12","1","4");
INSERT INTO subject_curriculum VALUES("1","3","1");
INSERT INTO subject_curriculum VALUES("2","3","1");
INSERT INTO subject_curriculum VALUES("3","3","1");
INSERT INTO subject_curriculum VALUES("8","3","1");
INSERT INTO subject_curriculum VALUES("9","3","1");
INSERT INTO subject_curriculum VALUES("10","3","1");
INSERT INTO subject_curriculum VALUES("11","3","1");
INSERT INTO subject_curriculum VALUES("12","3","1");
INSERT INTO subject_curriculum VALUES("1","3","2");
INSERT INTO subject_curriculum VALUES("2","3","2");
INSERT INTO subject_curriculum VALUES("8","3","2");
INSERT INTO subject_curriculum VALUES("9","3","2");
INSERT INTO subject_curriculum VALUES("10","3","2");
INSERT INTO subject_curriculum VALUES("11","3","2");
INSERT INTO subject_curriculum VALUES("12","3","2");
INSERT INTO subject_curriculum VALUES("3","3","2");
INSERT INTO subject_curriculum VALUES("1","3","3");
INSERT INTO subject_curriculum VALUES("2","3","3");
INSERT INTO subject_curriculum VALUES("3","3","3");
INSERT INTO subject_curriculum VALUES("8","3","3");
INSERT INTO subject_curriculum VALUES("9","3","3");
INSERT INTO subject_curriculum VALUES("10","3","3");
INSERT INTO subject_curriculum VALUES("11","3","3");
INSERT INTO subject_curriculum VALUES("12","3","3");
INSERT INTO subject_curriculum VALUES("1","3","4");
INSERT INTO subject_curriculum VALUES("2","3","4");
INSERT INTO subject_curriculum VALUES("3","3","4");
INSERT INTO subject_curriculum VALUES("8","3","4");
INSERT INTO subject_curriculum VALUES("9","3","4");
INSERT INTO subject_curriculum VALUES("10","3","4");
INSERT INTO subject_curriculum VALUES("11","3","4");
INSERT INTO subject_curriculum VALUES("12","3","4");
INSERT INTO subject_curriculum VALUES("1","1","1");
INSERT INTO subject_curriculum VALUES("2","1","1");
INSERT INTO subject_curriculum VALUES("1","1","2");
INSERT INTO subject_curriculum VALUES("3","1","2");
INSERT INTO subject_curriculum VALUES("1","1","4");
INSERT INTO subject_curriculum VALUES("1","1","3");
INSERT INTO subject_curriculum VALUES("3","1","4");
INSERT INTO subject_curriculum VALUES("8","1","1");
INSERT INTO subject_curriculum VALUES("9","1","1");
INSERT INTO subject_curriculum VALUES("10","1","1");
INSERT INTO subject_curriculum VALUES("3","1","1");
INSERT INTO subject_curriculum VALUES("11","1","1");
INSERT INTO subject_curriculum VALUES("12","1","1");
INSERT INTO subject_curriculum VALUES("2","1","2");
INSERT INTO subject_curriculum VALUES("8","1","2");
INSERT INTO subject_curriculum VALUES("9","1","2");
INSERT INTO subject_curriculum VALUES("10","1","2");
INSERT INTO subject_curriculum VALUES("11","1","2");
INSERT INTO subject_curriculum VALUES("12","1","2");
INSERT INTO subject_curriculum VALUES("1","2","1");
INSERT INTO subject_curriculum VALUES("1","2","1");
INSERT INTO subject_curriculum VALUES("2","2","1");
INSERT INTO subject_curriculum VALUES("3","2","1");
INSERT INTO subject_curriculum VALUES("8","2","1");
INSERT INTO subject_curriculum VALUES("9","2","1");
INSERT INTO subject_curriculum VALUES("10","2","1");
INSERT INTO subject_curriculum VALUES("11","2","1");
INSERT INTO subject_curriculum VALUES("12","2","1");
INSERT INTO subject_curriculum VALUES("1","2","2");
INSERT INTO subject_curriculum VALUES("2","2","2");
INSERT INTO subject_curriculum VALUES("3","2","2");
INSERT INTO subject_curriculum VALUES("8","2","2");
INSERT INTO subject_curriculum VALUES("9","2","2");
INSERT INTO subject_curriculum VALUES("10","2","2");
INSERT INTO subject_curriculum VALUES("11","2","2");
INSERT INTO subject_curriculum VALUES("12","2","2");
INSERT INTO subject_curriculum VALUES("1","2","3");
INSERT INTO subject_curriculum VALUES("2","2","3");
INSERT INTO subject_curriculum VALUES("3","2","3");
INSERT INTO subject_curriculum VALUES("8","2","3");
INSERT INTO subject_curriculum VALUES("9","2","3");
INSERT INTO subject_curriculum VALUES("10","2","3");
INSERT INTO subject_curriculum VALUES("11","2","3");
INSERT INTO subject_curriculum VALUES("12","2","3");
INSERT INTO subject_curriculum VALUES("1","2","4");
INSERT INTO subject_curriculum VALUES("2","2","4");
INSERT INTO subject_curriculum VALUES("3","2","4");
INSERT INTO subject_curriculum VALUES("8","2","4");
INSERT INTO subject_curriculum VALUES("9","2","4");
INSERT INTO subject_curriculum VALUES("10","2","4");
INSERT INTO subject_curriculum VALUES("11","2","4");
INSERT INTO subject_curriculum VALUES("12","2","4");
INSERT INTO subject_curriculum VALUES("2","1","3");
INSERT INTO subject_curriculum VALUES("3","1","3");
INSERT INTO subject_curriculum VALUES("8","1","3");
INSERT INTO subject_curriculum VALUES("9","1","3");
INSERT INTO subject_curriculum VALUES("10","1","3");
INSERT INTO subject_curriculum VALUES("11","1","3");
INSERT INTO subject_curriculum VALUES("12","1","3");
INSERT INTO subject_curriculum VALUES("8","1","4");
INSERT INTO subject_curriculum VALUES("2","1","4");
INSERT INTO subject_curriculum VALUES("9","1","4");
INSERT INTO subject_curriculum VALUES("10","1","4");
INSERT INTO subject_curriculum VALUES("11","1","4");
INSERT INTO subject_curriculum VALUES("12","1","4");
INSERT INTO subject_curriculum VALUES("1","3","1");
INSERT INTO subject_curriculum VALUES("2","3","1");
INSERT INTO subject_curriculum VALUES("3","3","1");
INSERT INTO subject_curriculum VALUES("8","3","1");
INSERT INTO subject_curriculum VALUES("9","3","1");
INSERT INTO subject_curriculum VALUES("10","3","1");
INSERT INTO subject_curriculum VALUES("11","3","1");
INSERT INTO subject_curriculum VALUES("12","3","1");
INSERT INTO subject_curriculum VALUES("1","3","2");
INSERT INTO subject_curriculum VALUES("2","3","2");
INSERT INTO subject_curriculum VALUES("8","3","2");
INSERT INTO subject_curriculum VALUES("9","3","2");
INSERT INTO subject_curriculum VALUES("10","3","2");
INSERT INTO subject_curriculum VALUES("11","3","2");
INSERT INTO subject_curriculum VALUES("12","3","2");
INSERT INTO subject_curriculum VALUES("3","3","2");
INSERT INTO subject_curriculum VALUES("1","3","3");
INSERT INTO subject_curriculum VALUES("2","3","3");
INSERT INTO subject_curriculum VALUES("3","3","3");
INSERT INTO subject_curriculum VALUES("8","3","3");
INSERT INTO subject_curriculum VALUES("9","3","3");
INSERT INTO subject_curriculum VALUES("10","3","3");
INSERT INTO subject_curriculum VALUES("11","3","3");
INSERT INTO subject_curriculum VALUES("12","3","3");
INSERT INTO subject_curriculum VALUES("1","3","4");
INSERT INTO subject_curriculum VALUES("2","3","4");
INSERT INTO subject_curriculum VALUES("3","3","4");
INSERT INTO subject_curriculum VALUES("8","3","4");
INSERT INTO subject_curriculum VALUES("9","3","4");
INSERT INTO subject_curriculum VALUES("10","3","4");
INSERT INTO subject_curriculum VALUES("11","3","4");
INSERT INTO subject_curriculum VALUES("12","3","4");
INSERT INTO subject_curriculum VALUES("1","1","1");
INSERT INTO subject_curriculum VALUES("2","1","1");
INSERT INTO subject_curriculum VALUES("1","1","2");
INSERT INTO subject_curriculum VALUES("3","1","2");
INSERT INTO subject_curriculum VALUES("1","1","4");
INSERT INTO subject_curriculum VALUES("1","1","3");
INSERT INTO subject_curriculum VALUES("3","1","4");
INSERT INTO subject_curriculum VALUES("8","1","1");
INSERT INTO subject_curriculum VALUES("9","1","1");
INSERT INTO subject_curriculum VALUES("10","1","1");
INSERT INTO subject_curriculum VALUES("3","1","1");
INSERT INTO subject_curriculum VALUES("11","1","1");
INSERT INTO subject_curriculum VALUES("12","1","1");
INSERT INTO subject_curriculum VALUES("2","1","2");
INSERT INTO subject_curriculum VALUES("8","1","2");
INSERT INTO subject_curriculum VALUES("9","1","2");
INSERT INTO subject_curriculum VALUES("10","1","2");
INSERT INTO subject_curriculum VALUES("11","1","2");
INSERT INTO subject_curriculum VALUES("12","1","2");
INSERT INTO subject_curriculum VALUES("1","2","1");
INSERT INTO subject_curriculum VALUES("1","2","1");
INSERT INTO subject_curriculum VALUES("2","2","1");
INSERT INTO subject_curriculum VALUES("3","2","1");
INSERT INTO subject_curriculum VALUES("8","2","1");
INSERT INTO subject_curriculum VALUES("9","2","1");
INSERT INTO subject_curriculum VALUES("10","2","1");
INSERT INTO subject_curriculum VALUES("11","2","1");
INSERT INTO subject_curriculum VALUES("12","2","1");
INSERT INTO subject_curriculum VALUES("1","2","2");
INSERT INTO subject_curriculum VALUES("2","2","2");
INSERT INTO subject_curriculum VALUES("3","2","2");
INSERT INTO subject_curriculum VALUES("8","2","2");
INSERT INTO subject_curriculum VALUES("9","2","2");
INSERT INTO subject_curriculum VALUES("10","2","2");
INSERT INTO subject_curriculum VALUES("11","2","2");
INSERT INTO subject_curriculum VALUES("12","2","2");
INSERT INTO subject_curriculum VALUES("1","2","3");
INSERT INTO subject_curriculum VALUES("2","2","3");
INSERT INTO subject_curriculum VALUES("3","2","3");
INSERT INTO subject_curriculum VALUES("8","2","3");
INSERT INTO subject_curriculum VALUES("9","2","3");
INSERT INTO subject_curriculum VALUES("10","2","3");
INSERT INTO subject_curriculum VALUES("11","2","3");
INSERT INTO subject_curriculum VALUES("12","2","3");
INSERT INTO subject_curriculum VALUES("1","2","4");
INSERT INTO subject_curriculum VALUES("2","2","4");
INSERT INTO subject_curriculum VALUES("3","2","4");
INSERT INTO subject_curriculum VALUES("8","2","4");
INSERT INTO subject_curriculum VALUES("9","2","4");
INSERT INTO subject_curriculum VALUES("10","2","4");
INSERT INTO subject_curriculum VALUES("11","2","4");
INSERT INTO subject_curriculum VALUES("12","2","4");
INSERT INTO subject_curriculum VALUES("2","1","3");
INSERT INTO subject_curriculum VALUES("3","1","3");
INSERT INTO subject_curriculum VALUES("8","1","3");
INSERT INTO subject_curriculum VALUES("9","1","3");
INSERT INTO subject_curriculum VALUES("10","1","3");
INSERT INTO subject_curriculum VALUES("11","1","3");
INSERT INTO subject_curriculum VALUES("12","1","3");
INSERT INTO subject_curriculum VALUES("8","1","4");
INSERT INTO subject_curriculum VALUES("2","1","4");
INSERT INTO subject_curriculum VALUES("9","1","4");
INSERT INTO subject_curriculum VALUES("10","1","4");
INSERT INTO subject_curriculum VALUES("11","1","4");
INSERT INTO subject_curriculum VALUES("12","1","4");
INSERT INTO subject_curriculum VALUES("1","3","1");
INSERT INTO subject_curriculum VALUES("2","3","1");
INSERT INTO subject_curriculum VALUES("3","3","1");
INSERT INTO subject_curriculum VALUES("8","3","1");
INSERT INTO subject_curriculum VALUES("9","3","1");
INSERT INTO subject_curriculum VALUES("10","3","1");
INSERT INTO subject_curriculum VALUES("11","3","1");
INSERT INTO subject_curriculum VALUES("12","3","1");
INSERT INTO subject_curriculum VALUES("1","3","2");
INSERT INTO subject_curriculum VALUES("2","3","2");
INSERT INTO subject_curriculum VALUES("8","3","2");
INSERT INTO subject_curriculum VALUES("9","3","2");
INSERT INTO subject_curriculum VALUES("10","3","2");
INSERT INTO subject_curriculum VALUES("11","3","2");
INSERT INTO subject_curriculum VALUES("12","3","2");
INSERT INTO subject_curriculum VALUES("3","3","2");
INSERT INTO subject_curriculum VALUES("1","3","3");
INSERT INTO subject_curriculum VALUES("2","3","3");
INSERT INTO subject_curriculum VALUES("3","3","3");
INSERT INTO subject_curriculum VALUES("8","3","3");
INSERT INTO subject_curriculum VALUES("9","3","3");
INSERT INTO subject_curriculum VALUES("10","3","3");
INSERT INTO subject_curriculum VALUES("11","3","3");
INSERT INTO subject_curriculum VALUES("12","3","3");
INSERT INTO subject_curriculum VALUES("1","3","4");
INSERT INTO subject_curriculum VALUES("2","3","4");
INSERT INTO subject_curriculum VALUES("3","3","4");
INSERT INTO subject_curriculum VALUES("8","3","4");
INSERT INTO subject_curriculum VALUES("9","3","4");
INSERT INTO subject_curriculum VALUES("10","3","4");
INSERT INTO subject_curriculum VALUES("11","3","4");
INSERT INTO subject_curriculum VALUES("12","3","4");
INSERT INTO subject_curriculum VALUES("1","1","1");
INSERT INTO subject_curriculum VALUES("2","1","1");
INSERT INTO subject_curriculum VALUES("1","1","2");
INSERT INTO subject_curriculum VALUES("3","1","2");
INSERT INTO subject_curriculum VALUES("1","1","4");



DROP TABLE IF EXISTS subjects;

CREATE TABLE `subjects` (
  `subjectid` int(11) NOT NULL AUTO_INCREMENT,
  `subject_title` varchar(150) NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`subjectid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO subjects VALUES("1","Filipino","0","0");
INSERT INTO subjects VALUES("2","English","0","0");
INSERT INTO subjects VALUES("3","MAPEH","0","0");
INSERT INTO subjects VALUES("4","Music","3","0");
INSERT INTO subjects VALUES("5","Arts","3","0");
INSERT INTO subjects VALUES("6","Physical Education","3","0");
INSERT INTO subjects VALUES("7","Health","3","0");
INSERT INTO subjects VALUES("8","TLE","0","0");
INSERT INTO subjects VALUES("9","Science","0","0");
INSERT INTO subjects VALUES("10","Math","0","0");
INSERT INTO subjects VALUES("11","Araling Panlipunan","0","0");
INSERT INTO subjects VALUES("12","Values Education","0","0");
INSERT INTO subjects VALUES("13","Research","0","0");
INSERT INTO subjects VALUES("14","fo","0","1");
INSERT INTO subjects VALUES("1","Filipino","0","0");
INSERT INTO subjects VALUES("2","English","0","0");
INSERT INTO subjects VALUES("3","MAPEH","0","0");
INSERT INTO subjects VALUES("4","Music","3","0");
INSERT INTO subjects VALUES("5","Arts","3","0");
INSERT INTO subjects VALUES("6","Physical Education","3","0");
INSERT INTO subjects VALUES("7","Health","3","0");
INSERT INTO subjects VALUES("8","TLE","0","0");
INSERT INTO subjects VALUES("9","Science","0","0");
INSERT INTO subjects VALUES("10","Math","0","0");
INSERT INTO subjects VALUES("11","Araling Panlipunan","0","0");
INSERT INTO subjects VALUES("12","Values Education","0","0");
INSERT INTO subjects VALUES("13","Research","0","0");
INSERT INTO subjects VALUES("14","fo","0","1");
INSERT INTO subjects VALUES("1","Filipino","0","0");
INSERT INTO subjects VALUES("2","English","0","0");
INSERT INTO subjects VALUES("3","MAPEH","0","0");
INSERT INTO subjects VALUES("4","Music","3","0");
INSERT INTO subjects VALUES("5","Arts","3","0");
INSERT INTO subjects VALUES("6","Physical Education","3","0");
INSERT INTO subjects VALUES("7","Health","3","0");
INSERT INTO subjects VALUES("8","TLE","0","0");
INSERT INTO subjects VALUES("9","Science","0","0");
INSERT INTO subjects VALUES("10","Math","0","0");
INSERT INTO subjects VALUES("11","Araling Panlipunan","0","0");
INSERT INTO subjects VALUES("12","Values Education","0","0");
INSERT INTO subjects VALUES("13","Research","0","0");
INSERT INTO subjects VALUES("14","fo","0","1");
INSERT INTO subjects VALUES("1","Filipino","0","0");
INSERT INTO subjects VALUES("2","English","0","0");
INSERT INTO subjects VALUES("3","MAPEH","0","0");
INSERT INTO subjects VALUES("4","Music","3","0");
INSERT INTO subjects VALUES("5","Arts","3","0");
INSERT INTO subjects VALUES("6","Physical Education","3","0");
INSERT INTO subjects VALUES("7","Health","3","0");
INSERT INTO subjects VALUES("8","TLE","0","0");
INSERT INTO subjects VALUES("9","Science","0","0");
INSERT INTO subjects VALUES("10","Math","0","0");
INSERT INTO subjects VALUES("11","Araling Panlipunan","0","0");
INSERT INTO subjects VALUES("12","Values Education","0","0");
INSERT INTO subjects VALUES("13","Research","0","0");
INSERT INTO subjects VALUES("14","fo","0","1");



DROP TABLE IF EXISTS teacher;

CREATE TABLE `teacher` (
  `teacherid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` enum('Mr','Ms','Mrs','Prof','Dr') COLLATE utf8mb4_unicode_ci NOT NULL,
  `isdeleted` tinyint(1) NOT NULL,
  `isAdviserSPSorSPA` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`teacherid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO teacher VALUES("1","Alex","Matandac","Ferrer","Mr","0","2|4");
INSERT INTO teacher VALUES("2","Juan","De La","Cruz","Mr","0","3|4");
INSERT INTO teacher VALUES("1","Alex","Matandac","Ferrer","Mr","0","2|4");
INSERT INTO teacher VALUES("2","Juan","De La","Cruz","Mr","0","3|4");
INSERT INTO teacher VALUES("1","Alex","Matandac","Ferrer","Mr","0","2|4");
INSERT INTO teacher VALUES("2","Juan","De La","Cruz","Mr","0","3|4");
INSERT INTO teacher VALUES("1","Alex","Matandac","Ferrer","Mr","0","2|4");
INSERT INTO teacher VALUES("2","Juan","De La","Cruz","Mr","0","3|4");
INSERT INTO teacher VALUES("1","Alex","Matandac","Ferrer","Mr","0","2|4");
INSERT INTO teacher VALUES("2","Juan","De La","Cruz","Mr","0","3|4");
INSERT INTO teacher VALUES("1","Alex","Matandac","Ferrer","Mr","0","2|4");
INSERT INTO teacher VALUES("2","Juan","De La","Cruz","Mr","0","3|4");
INSERT INTO teacher VALUES("1","Alex","Matandac","Ferrer","Mr","0","2|4");
INSERT INTO teacher VALUES("2","Juan","De La","Cruz","Mr","0","3|4");



DROP TABLE IF EXISTS teacher_subjects;

CREATE TABLE `teacher_subjects` (
  `teacherid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `levelid` int(11) NOT NULL,
  `school_year` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`teacherid`,`subjectid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(64) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `image` varchar(70) NOT NULL,
  `role` enum('admin','staff') NOT NULL DEFAULT 'staff',
  `access_pages` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO users VALUES("1","admin","8ead58753335bb936bac6033b400c7f6f61f36ebc10660883de78ce070efe75a","Admin","Admin","6f3600c759709c12f4bb5201ffeda2dc61e1f708091c883811ceb9212386c220.jpg","admin","","2017-08-09 21:12:15","2017-09-18 07:40:43","0");
INSERT INTO users VALUES("1","admin","8ead58753335bb936bac6033b400c7f6f61f36ebc10660883de78ce070efe75a","Admin","Admin","6f3600c759709c12f4bb5201ffeda2dc61e1f708091c883811ceb9212386c220.jpg","admin","","2017-08-09 21:12:15","2017-09-18 07:40:43","0");
INSERT INTO users VALUES("1","admin","8ead58753335bb936bac6033b400c7f6f61f36ebc10660883de78ce070efe75a","Admin","Admin","6f3600c759709c12f4bb5201ffeda2dc61e1f708091c883811ceb9212386c220.jpg","admin","","2017-08-09 21:12:15","2017-09-18 07:40:43","0");
INSERT INTO users VALUES("1","admin","8ead58753335bb936bac6033b400c7f6f61f36ebc10660883de78ce070efe75a","Admin","Admin","6f3600c759709c12f4bb5201ffeda2dc61e1f708091c883811ceb9212386c220.jpg","admin","","2017-08-09 21:12:15","2017-09-18 07:40:43","0");
INSERT INTO users VALUES("1","admin","8ead58753335bb936bac6033b400c7f6f61f36ebc10660883de78ce070efe75a","Admin","Admin","6f3600c759709c12f4bb5201ffeda2dc61e1f708091c883811ceb9212386c220.jpg","admin","","2017-08-09 21:12:15","2017-09-18 07:40:43","0");
INSERT INTO users VALUES("1","admin","8ead58753335bb936bac6033b400c7f6f61f36ebc10660883de78ce070efe75a","Admin","Admin","6f3600c759709c12f4bb5201ffeda2dc61e1f708091c883811ceb9212386c220.jpg","admin","","2017-08-09 21:12:15","2017-09-18 07:40:43","0");
INSERT INTO users VALUES("1","admin","8ead58753335bb936bac6033b400c7f6f61f36ebc10660883de78ce070efe75a","Admin","Admin","6f3600c759709c12f4bb5201ffeda2dc61e1f708091c883811ceb9212386c220.jpg","admin","","2017-08-09 21:12:15","2017-09-18 07:40:43","0");
INSERT INTO users VALUES("1","admin","8ead58753335bb936bac6033b400c7f6f61f36ebc10660883de78ce070efe75a","Admin","Admin","6f3600c759709c12f4bb5201ffeda2dc61e1f708091c883811ceb9212386c220.jpg","admin","","2017-08-09 21:12:15","2017-09-18 07:40:43","0");
INSERT INTO users VALUES("1","admin","8ead58753335bb936bac6033b400c7f6f61f36ebc10660883de78ce070efe75a","Admin","Admin","6f3600c759709c12f4bb5201ffeda2dc61e1f708091c883811ceb9212386c220.jpg","admin","","2017-08-09 21:12:15","2017-09-18 07:40:43","0");
INSERT INTO users VALUES("1","admin","8ead58753335bb936bac6033b400c7f6f61f36ebc10660883de78ce070efe75a","Admin","Admin","6f3600c759709c12f4bb5201ffeda2dc61e1f708091c883811ceb9212386c220.jpg","admin","","2017-08-09 21:12:15","2017-09-18 07:40:43","0");
INSERT INTO users VALUES("1","admin","8ead58753335bb936bac6033b400c7f6f61f36ebc10660883de78ce070efe75a","Admin","Admin","6f3600c759709c12f4bb5201ffeda2dc61e1f708091c883811ceb9212386c220.jpg","admin","","2017-08-09 21:12:15","2017-09-18 07:40:43","0");




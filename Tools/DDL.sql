CREATE TABLE course
(
  courseNumber CHAR(10) PRIMARY KEY NOT NULL,
  courseName VARCHAR(20),
  creditHour INT NOT NULL,
  contactHour INT
);
CREATE TABLE employee
(
  EmpId INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  EmpName VARCHAR(20),
  dob DATE DEFAULT '0000-00-00' NOT NULL,
  gender CHAR(1),
  userName VARCHAR(10),
  password VARCHAR(10),
  role VARCHAR(10),
  mobileNumber VARCHAR(10)
);
CREATE UNIQUE INDEX EmpId ON employee (EmpId);

CREATE TABLE student
(
  student_Id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  FirstName VARCHAR(10),
  LastName VARCHAR(10),
  dob DATE,
  gender CHAR(1) NOT NULL,
  UserName VARCHAR(10),
  password VARCHAR(10),
  approved BIT DEFAULT b'0' NOT NULL
);
CREATE TABLE enrollment
(
  student_Id INT DEFAULT 0 NOT NULL,
  courseNumber CHAR(10) DEFAULT '' NOT NULL,
  registrationDate DATE,
  semester INT NOT NULL,
  year INT NOT NULL,
  PRIMARY KEY (student_Id, courseNumber),
  FOREIGN KEY (student_Id) REFERENCES student (student_Id) ON DELETE CASCADE ,
  FOREIGN KEY (courseNumber) REFERENCES course (courseNumber) ON DELETE CASCADE
);


CREATE VIEW Users(username,password,role)
  as
  (SELECT userName,password,role FROM employee)UNION (SELECT UserName,password,'Student'as role FROM student);
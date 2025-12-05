CREATE TABLE APPLICATIONS(
    appnum INT AUTO_INCREMENT PRIMARY KEY,
    appnom VARCHAR(100),
    appversion VARCHAR(50),
    appversion VARCHAR(50),
    appnometablissement VARCHAR(150),
    apptel1 VARCHAR(20),
    appadresmail VARCHAR(150),
);
CREATE TABLE CLIENTS (
    clienum INT AUTO_INCREMENT PRIMARY KEY,
    clienom VARCHAR(100),
    clieprenom VARCHAR(100),
    clietel1 VARCHAR(20),
    clieadresmail VARCHAR(150),
    cliesupp TINYINT default 2
);
CREATE TABLE CLIENTS_APPLICATIONS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    clienum INT,
    appnum INT,
    FOREIGN KEY (clienum) REFERENCES CLIENTS(clienum) FOREIGN KEY (appnum) REFERENCES APPLICATION(appnum)
);
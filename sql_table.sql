CREATE TABLE APPLICATIONS(
    appnum SERIAL PRIMARY KEY,
    appnom VARCHAR(100),
    appversion VARCHAR(50),
    appnometablissement VARCHAR(150),
    apptel1 VARCHAR(20),
    appadresmail VARCHAR(150)
);
CREATE TABLE CLIENTS (
    clienum SERIAL PRIMARY KEY,
    clienom VARCHAR(100),
    clieprenom VARCHAR(100),
    clietel1 VARCHAR(20),
    clieadresmail VARCHAR(150),
    cliesupp SMALLINT default 2
);
CREATE TABLE CLIENTS_APPLICATIONS (
    id SERIAL PRIMARY KEY,
    clienum INT,
    appnum INT,
    FOREIGN KEY (clienum) REFERENCES CLIENTS(clienum),
    FOREIGN KEY (appnum) REFERENCES APPLICATIONS(appnum)
);
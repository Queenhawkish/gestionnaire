#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Members
#------------------------------------------------------------

CREATE TABLE Members(
        id        Int  Auto_increment  NOT NULL ,
        lastname  Varchar (50) NOT NULL ,
        firstname Varchar (50) NOT NULL ,
        email     Varchar (150) NOT NULL ,
        phone     Varchar (10) NOT NULL ,
        password  Varchar (255) NOT NULL
	,CONSTRAINT Members_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Gestionnaire
#------------------------------------------------------------

CREATE TABLE Gestionnaire(
        id       Int  Auto_increment  NOT NULL ,
        email    Varchar (150) NOT NULL ,
        password Varchar (255) NOT NULL
	,CONSTRAINT Gestionnaire_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Reasons
#------------------------------------------------------------

CREATE TABLE Reasons(
        id     Int  Auto_increment  NOT NULL ,
        Reason Varchar (255) NOT NULL ,
        tva    Int NOT NULL
	,CONSTRAINT Reasons_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Decisions
#------------------------------------------------------------

CREATE TABLE Decisions(
        dec_id   Int  Auto_increment  NOT NULL ,
        decision Varchar (50) NOT NULL
	,CONSTRAINT Decisions_PK PRIMARY KEY (dec_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Cost
#------------------------------------------------------------

CREATE TABLE Cost(
        id              Int  Auto_increment  NOT NULL ,
        cost_date       Date NOT NULL ,
        amount_ht       Float NOT NULL ,
        amount_ttc      Float NOT NULL ,
        proof_name      Varchar (50) NOT NULL ,
        proof           Longblob NOT NULL ,
        decision_date   Date ,
        reason_decision Text ,
        id_Members      Int NOT NULL ,
        id_Reasons      Int NOT NULL ,
        dec_id          Int NOT NULL
	,CONSTRAINT Cost_PK PRIMARY KEY (id)

	,CONSTRAINT Cost_Members_FK FOREIGN KEY (id_Members) REFERENCES Members(id)
	,CONSTRAINT Cost_Reasons0_FK FOREIGN KEY (id_Reasons) REFERENCES Reasons(id)
	,CONSTRAINT Cost_Decisions1_FK FOREIGN KEY (dec_id) REFERENCES Decisions(dec_id)
)ENGINE=InnoDB;


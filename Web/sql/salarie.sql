-- Adminer 4.8.1 PostgreSQL 17.2 (Debian 17.2-1.pgdg120+1) dump

DROP TABLE IF EXISTS "salarie";
DROP SEQUENCE IF EXISTS salarie_id_seq;
CREATE SEQUENCE salarie_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."salarie" (
    "id" integer DEFAULT nextval('salarie_id_seq') NOT NULL,
    "nom" character(20) NOT NULL,
    "prenom" character(20) NOT NULL,
    "mail" character(40) NOT NULL,
    CONSTRAINT "salarie_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "salarie" ("id", "nom", "prenom", "mail") VALUES
(1,	'Dupont              ',	'Jean                ',	'jean.dupont@example.com                 '),
(2,	'Martin              ',	'Marie               ',	'marie.martin@example.com                '),
(3,	'Bernard             ',	'Paul                ',	'paul.bernard@example.com                '),
(4,	'Durand              ',	'Sophie              ',	'sophie.durand@example.com               '),
(5,	'Roux                ',	'Luc                 ',	'luc.roux@example.com                    ');

DROP TABLE IF EXISTS "salaries_competences";
CREATE TABLE "public"."salaries_competences" (
    "id_salarie" integer NOT NULL,
    "id_competence" integer NOT NULL,
    "interet" smallint NOT NULL,
    CONSTRAINT "salaries_competences_pkey" PRIMARY KEY ("id_salarie", "id_competence")
) WITH (oids = false);

INSERT INTO "salaries_competences" ("id_salarie", "id_competence", "interet") VALUES
(1,	1,	8),
(1,	2,	6),
(2,	3,	9),
(2,	4,	7),
(3,	5,	10),
(4,	1,	5),
(5,	2,	8),
(5,	3,	7);

ALTER TABLE ONLY "public"."salaries_competences" ADD CONSTRAINT "salaries_competences_id_salarie_fkey" FOREIGN KEY (id_salarie) REFERENCES salarie(id) NOT DEFERRABLE;

-- 2025-02-13 12:54:11.668984+00

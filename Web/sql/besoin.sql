-- Adminer 4.8.1 PostgreSQL 17.2 (Debian 17.2-1.pgdg120+1) dump

DROP TABLE IF EXISTS "besoin";
DROP SEQUENCE IF EXISTS besoin_id_seq;
CREATE SEQUENCE besoin_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."besoin" (
    "id" integer DEFAULT nextval('besoin_id_seq') NOT NULL,
    "libelle" text NOT NULL,
    "client_nom" character(30) NOT NULL,
    "competence_libelle" smallint NOT NULL,
    CONSTRAINT "besoin_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "besoin" ("id", "libelle", "client_nom", "competence_libelle") VALUES
(1,	'Nettoyage de Printemps',	'Dupont                        ',	1),
(2,	'Réparation Électrique',	'Martin                        ',	3),
(3,	'Aménagement Paysager',	'Bernard                       ',	1),
(4,	'Rénovation de Cuisine',	'Durand                        ',	2),
(5,	'Peinture Intérieure',	'Roux                          ',	4);

DROP TABLE IF EXISTS "besoins_services";
CREATE TABLE "public"."besoins_services" (
    "id_besoin" integer NOT NULL,
    "id_service" integer NOT NULL,
    CONSTRAINT "besoins_bervices_pkey" PRIMARY KEY ("id_besoin", "id_service")
) WITH (oids = false);

INSERT INTO "besoins_services" ("id_besoin", "id_service") VALUES
(1,	1),
(2,	2),
(3,	3),
(4,	4),
(5,	5);

ALTER TABLE ONLY "public"."besoins_services" ADD CONSTRAINT "besoins_bervices_id_besoin_fkey" FOREIGN KEY (id_besoin) REFERENCES besoin(id) NOT DEFERRABLE;

-- 2025-02-13 12:53:33.75695+00

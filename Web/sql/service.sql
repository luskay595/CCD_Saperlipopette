-- Adminer 4.8.1 PostgreSQL 17.2 (Debian 17.2-1.pgdg120+1) dump

DROP TABLE IF EXISTS "service";
DROP SEQUENCE IF EXISTS service_id_seq;
CREATE SEQUENCE service_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."service" (
    "id" integer DEFAULT nextval('service_id_seq') NOT NULL,
    "libelle" text NOT NULL,
    "description" text NOT NULL,
    CONSTRAINT "service_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "service" ("id", "libelle", "description") VALUES
(1,	'Nettoyage de Printemps',	'Service complet de nettoyage intérieur et extérieur pour le printemps.'),
(2,	'Réparation Électrique',	'Service de réparation et d''installation de systèmes électriques.'),
(3,	'Aménagement Paysager',	'Service de conception et d''entretien des espaces verts.'),
(4,	'Rénovation de Cuisine',	'Service de rénovation complète de cuisine, y compris la plomberie et l''électricité.'),
(5,	'Peinture Intérieure',	'Service de peinture pour les murs intérieurs avec finitions de qualité.');

-- 2025-02-13 12:53:17.582598+00

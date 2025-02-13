-- Adminer 4.8.1 PostgreSQL 17.2 (Debian 17.2-1.pgdg120+1) dump

DROP TABLE IF EXISTS "competence";
DROP SEQUENCE IF EXISTS competence_id_seq;
CREATE SEQUENCE competence_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."competence" (
    "id" integer DEFAULT nextval('competence_id_seq') NOT NULL,
    "libelle" text NOT NULL,
    "description" text NOT NULL,
    CONSTRAINT "competence_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "competence" ("id", "libelle", "description") VALUES
(1,	'Jardinage',	'Compétence en entretien des espaces verts et plantations.'),
(2,	'Plomberie',	'Compétence en installation et réparation des systèmes de plomberie.'),
(3,	'Électricité',	'Compétence en installation et réparation des systèmes électriques.'),
(4,	'Peinture',	'Compétence en application de peinture et finitions intérieures et extérieures.'),
(5,	'Menuiserie',	'Compétence en fabrication et installation de meubles et structures en bois.');

-- 2025-02-13 12:54:02.969517+00

-- Adminer 4.8.1 PostgreSQL 17.2 (Debian 17.2-1.pgdg120+1) dump

DROP TABLE IF EXISTS "competence";
DROP SEQUENCE IF EXISTS competence_id_seq;
CREATE SEQUENCE competence_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."competence" (
    "id" integer DEFAULT nextval('competence_id_seq') NOT NULL,
    "libelle" text NOT NULL,
    "description" text NOT NULL,
    "type" text NOT NULL,
    CONSTRAINT "competence_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "competence" ("id", "libelle", "description", "type") VALUES
(1,	'Bricolage',	'Compétence en travaux manuels et réparations diverses.',	'BR'),
(2,	'Jardinage',	'Compétence en entretien des espaces verts et plantations.',	'JD'),
(3,	'Ménage',	'Compétence en nettoyage et entretien domestique.',	'MN'),
(4,	'Informatique',	'Compétence en manipulation d’outils informatiques et résolution de problèmes techniques.',	'IF'),
(5,	'Administratif',	'Compétence en accompagnement dans les démarches administratives.',	'AD');

-- 2025-02-13 13:49:53.532395+00

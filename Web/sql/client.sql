-- Adminer 4.8.1 PostgreSQL 17.2 (Debian 17.2-1.pgdg120+1) dump

DROP TABLE IF EXISTS "client";
CREATE TABLE "public"."client" (
    "id" uuid NOT NULL,
    "nom" text NOT NULL
) WITH (oids = false);

INSERT INTO "client" ("id", "nom") VALUES
('123e4567-e89b-12d3-a456-426614174000',	'TechFlow'),
('123e4567-e89b-12d3-a456-426614174001',	'EcoNest'),
('123e4567-e89b-12d3-a456-426614174002',	'InnoVibe'),
('123e4567-e89b-12d3-a456-426614174003',	'Zenith'),
('123e4567-e89b-12d3-a456-426614174004',	'PulseWave');

-- 2025-02-13 12:54:36.588276+00

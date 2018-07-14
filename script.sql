CREATE SEQUENCE if not exists public.album_id_seq
    INCREMENT 1
    START 1
    MINVALUE 0
    MAXVALUE 2147483647
    CACHE 1;
	
CREATE TABLE if not exists public.album
(
    id integer NOT NULL DEFAULT nextval('album_id_seq'::regclass),

    artist character varying(500) NOT NULL,
	title character varying(500) NOT NULL,	
    CONSTRAINT album_pk PRIMARY KEY (id)
);


CREATE SEQUENCE if not exists public.funcionario_id_seq
    INCREMENT 1
    START 1
    MINVALUE 0
    MAXVALUE 2147483647
    CACHE 1;

CREATE TABLE if not exists public.funcionario
(
    id integer NOT NULL DEFAULT nextval('funcionario_id_seq'::regclass),
    nome character varying (500) NOT NULL,
	cpf character varying (500) NOT NULL,
    salario real NOT NULL,	
    CONSTRAINT funcionario_pk PRIMARY KEY(id)
);

CREATE SEQUENCE if not exists public.usuario_id_seq
    INCREMENT 1
    START 1
    MINVALUE 0
    MAXVALUE 2147483647
    CACHE 1;

CREATE TABLE if not exists public.usuario
(
    id integer NOT NULL DEFAULT nextval('usuario_id_seq'::regclass),
    email character varying (500) NOT NULL,
	password character varying (500) NOT NULL,
    CONSTRAINT funcionario_pk PRIMARY KEY(id)
);

INSERT INTO public.album (artist, title)
    VALUES  ('The  Military  Wives',  'In  My  Dreams');
INSERT INTO public.album (artist, title)
    VALUES  ('Adele',  '21');
INSERT INTO public.album (artist, title)
    VALUES  ('Bruce  Springsteen',  'Wrecking Ball (Deluxe)');
INSERT INTO public.album (artist, title)
    VALUES  ('Lana  Del  Rey',  'Born  To  Die');
INSERT INTO public.album (artist, title)
    VALUES  ('Gotye',  'Making  Mirrors');
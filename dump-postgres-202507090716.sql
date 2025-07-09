--
-- PostgreSQL database cluster dump
--

-- Started on 2025-07-09 07:16:01

SET default_transaction_read_only = off;

SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;

--
-- Roles
--

CREATE ROLE postgres;
ALTER ROLE postgres WITH SUPERUSER INHERIT CREATEROLE CREATEDB LOGIN REPLICATION BYPASSRLS;

--
-- User Configurations
--








--
-- Databases
--

--
-- Database "template1" dump
--

\connect template1

--
-- PostgreSQL database dump
--

-- Dumped from database version 15.13 (Debian 15.13-1.pgdg120+1)
-- Dumped by pg_dump version 17.0

-- Started on 2025-07-09 07:16:01

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

-- Completed on 2025-07-09 07:16:01

--
-- PostgreSQL database dump complete
--

--
-- Database "postgres" dump
--

\connect postgres

--
-- PostgreSQL database dump
--

-- Dumped from database version 15.13 (Debian 15.13-1.pgdg120+1)
-- Dumped by pg_dump version 17.0

-- Started on 2025-07-09 07:16:01

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 215 (class 1259 OID 16395)
-- Name: diary; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.diary (
    title character varying NOT NULL,
    write text NOT NULL,
    date date NOT NULL,
    user_id character varying,
    iddiary integer NOT NULL
);


ALTER TABLE public.diary OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 32779)
-- Name: diary_iddiary_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.diary_iddiary_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.diary_iddiary_seq OWNER TO postgres;

--
-- TOC entry 3359 (class 0 OID 0)
-- Dependencies: 216
-- Name: diary_iddiary_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.diary_iddiary_seq OWNED BY public.diary.iddiary;


--
-- TOC entry 214 (class 1259 OID 16388)
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    iduser character varying NOT NULL,
    username character varying NOT NULL,
    password character varying NOT NULL
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- TOC entry 3203 (class 2604 OID 32780)
-- Name: diary iddiary; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diary ALTER COLUMN iddiary SET DEFAULT nextval('public.diary_iddiary_seq'::regclass);


--
-- TOC entry 3352 (class 0 OID 16395)
-- Dependencies: 215
-- Data for Name: diary; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.diary (title, write, date, user_id, iddiary) FROM stdin;
Haloo	Nyoba lagii yaaa	2025-07-05	U001	1
aaaaaaaaaaaaaaa	bbbbbbbbbbbbbbbbbbbb	2025-07-05	U001	2
\.


--
-- TOC entry 3351 (class 0 OID 16388)
-- Dependencies: 214
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (iduser, username, password) FROM stdin;
U001	awlawl	090205
U002	ciuliya	050205
\.


--
-- TOC entry 3360 (class 0 OID 0)
-- Dependencies: 216
-- Name: diary_iddiary_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.diary_iddiary_seq', 2, true);


--
-- TOC entry 3207 (class 2606 OID 32782)
-- Name: diary diary_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diary
    ADD CONSTRAINT diary_pkey PRIMARY KEY (iddiary);


--
-- TOC entry 3205 (class 2606 OID 16394)
-- Name: user user_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pk PRIMARY KEY (iduser);


--
-- TOC entry 3208 (class 2606 OID 16400)
-- Name: diary fk_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diary
    ADD CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES public."user"(iduser) ON DELETE CASCADE;


-- Completed on 2025-07-09 07:16:02

--
-- PostgreSQL database dump complete
--

-- Completed on 2025-07-09 07:16:02

--
-- PostgreSQL database cluster dump complete
--


--
-- PostgreSQL database dump
--

\restrict 00ToPEGftxqKbdO8wbpZjlmNqhEPkZAtIKGSuUd8Ui4dNboOXffNDkKUhdVRTAz

-- Dumped from database version 16.11 (Debian 16.11-1.pgdg13+1)
-- Dumped by pg_dump version 16.11 (Debian 16.11-1.pgdg13+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
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
-- Name: activity_plans; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.activity_plans (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    category_id bigint,
    title character varying(255) NOT NULL,
    description text NOT NULL,
    objectives text,
    planned_date date NOT NULL,
    location character varying(255),
    budget numeric(15,2),
    approved_by bigint,
    approved_at timestamp(0) without time zone,
    rejection_reason text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    status character varying(255) DEFAULT 'draft'::character varying NOT NULL,
    CONSTRAINT activity_plans_status_check CHECK (((status)::text = ANY ((ARRAY['draft'::character varying, 'pending_review'::character varying, 'proposed'::character varying, 'approved'::character varying, 'rejected'::character varying])::text[])))
);


ALTER TABLE public.activity_plans OWNER TO karang_user;

--
-- Name: activity_plans_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.activity_plans_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.activity_plans_id_seq OWNER TO karang_user;

--
-- Name: activity_plans_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.activity_plans_id_seq OWNED BY public.activity_plans.id;


--
-- Name: activity_realizations; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.activity_realizations (
    id bigint NOT NULL,
    activity_plan_id bigint NOT NULL,
    user_id bigint NOT NULL,
    actual_date date NOT NULL,
    actual_location character varying(255),
    participants_count integer DEFAULT 0 NOT NULL,
    attendance_list text,
    report text,
    achievements text,
    obstacles text,
    actual_budget numeric(15,2),
    verified_by bigint,
    verified_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    status character varying(255) DEFAULT 'sedang_berjalan'::character varying NOT NULL,
    CONSTRAINT activity_realizations_status_check CHECK (((status)::text = ANY ((ARRAY['sedang_berjalan'::character varying, 'batal'::character varying, 'final'::character varying])::text[])))
);


ALTER TABLE public.activity_realizations OWNER TO karang_user;

--
-- Name: activity_realizations_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.activity_realizations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.activity_realizations_id_seq OWNER TO karang_user;

--
-- Name: activity_realizations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.activity_realizations_id_seq OWNED BY public.activity_realizations.id;


--
-- Name: categories; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.categories (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    type character varying(255) NOT NULL,
    description text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT categories_type_check CHECK (((type)::text = ANY ((ARRAY['activity'::character varying, 'document'::character varying, 'content'::character varying])::text[])))
);


ALTER TABLE public.categories OWNER TO karang_user;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_id_seq OWNER TO karang_user;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- Name: contents; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.contents (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    category_id bigint,
    title character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    excerpt text,
    body text NOT NULL,
    featured_image character varying(255),
    type character varying(255) DEFAULT 'news'::character varying NOT NULL,
    status character varying(255) DEFAULT 'draft'::character varying NOT NULL,
    published_at timestamp(0) without time zone,
    meta_title character varying(255),
    meta_description text,
    meta_keywords character varying(255),
    views_count integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT contents_status_check CHECK (((status)::text = ANY ((ARRAY['draft'::character varying, 'published'::character varying, 'archived'::character varying])::text[]))),
    CONSTRAINT contents_type_check CHECK (((type)::text = ANY ((ARRAY['news'::character varying, 'announcement'::character varying, 'article'::character varying, 'gallery'::character varying])::text[])))
);


ALTER TABLE public.contents OWNER TO karang_user;

--
-- Name: contents_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.contents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.contents_id_seq OWNER TO karang_user;

--
-- Name: contents_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.contents_id_seq OWNED BY public.contents.id;


--
-- Name: documentation_library; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.documentation_library (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    category_id bigint,
    activity_realization_id bigint,
    title character varying(255) NOT NULL,
    description text,
    type character varying(255) DEFAULT 'photo'::character varying NOT NULL,
    file_path character varying(255) NOT NULL,
    file_name character varying(255) NOT NULL,
    file_type character varying(255) NOT NULL,
    file_size integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT documentation_library_type_check CHECK (((type)::text = ANY ((ARRAY['photo'::character varying, 'video'::character varying, 'document'::character varying])::text[])))
);


ALTER TABLE public.documentation_library OWNER TO karang_user;

--
-- Name: documentation_library_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.documentation_library_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.documentation_library_id_seq OWNER TO karang_user;

--
-- Name: documentation_library_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.documentation_library_id_seq OWNED BY public.documentation_library.id;


--
-- Name: documents; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.documents (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    title character varying(255) NOT NULL,
    description text,
    file_name character varying(255) NOT NULL,
    file_path character varying(255) NOT NULL,
    file_size bigint NOT NULL,
    file_type character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.documents OWNER TO karang_user;

--
-- Name: documents_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.documents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.documents_id_seq OWNER TO karang_user;

--
-- Name: documents_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.documents_id_seq OWNED BY public.documents.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO karang_user;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO karang_user;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: financial_transactions; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.financial_transactions (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    transaction_date date NOT NULL,
    type character varying(255) NOT NULL,
    category character varying(255) NOT NULL,
    amount numeric(15,2) NOT NULL,
    description text NOT NULL,
    notes text,
    evidence_file character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT financial_transactions_type_check CHECK (((type)::text = ANY ((ARRAY['income'::character varying, 'expense'::character varying])::text[])))
);


ALTER TABLE public.financial_transactions OWNER TO karang_user;

--
-- Name: financial_transactions_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.financial_transactions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.financial_transactions_id_seq OWNER TO karang_user;

--
-- Name: financial_transactions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.financial_transactions_id_seq OWNED BY public.financial_transactions.id;


--
-- Name: meetings; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.meetings (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    title character varying(255) NOT NULL,
    meeting_date date NOT NULL,
    meeting_time time(0) without time zone NOT NULL,
    location character varying(255) NOT NULL,
    agenda text NOT NULL,
    notes text,
    status character varying(255) DEFAULT 'scheduled'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT meetings_status_check CHECK (((status)::text = ANY ((ARRAY['scheduled'::character varying, 'completed'::character varying, 'cancelled'::character varying])::text[])))
);


ALTER TABLE public.meetings OWNER TO karang_user;

--
-- Name: meetings_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.meetings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.meetings_id_seq OWNER TO karang_user;

--
-- Name: meetings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.meetings_id_seq OWNED BY public.meetings.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO karang_user;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO karang_user;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: organization_profiles; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.organization_profiles (
    id bigint NOT NULL,
    organization_name character varying(255) NOT NULL,
    about text,
    vision text,
    mission text,
    history text,
    structure json,
    logo character varying(255),
    address text,
    phone character varying(255),
    email character varying(255),
    social_media text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.organization_profiles OWNER TO karang_user;

--
-- Name: organization_profiles_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.organization_profiles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.organization_profiles_id_seq OWNER TO karang_user;

--
-- Name: organization_profiles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.organization_profiles_id_seq OWNED BY public.organization_profiles.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO karang_user;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO karang_user;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.personal_access_tokens_id_seq OWNER TO karang_user;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: roles; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.roles (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    description text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.roles OWNER TO karang_user;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.roles_id_seq OWNER TO karang_user;

--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: karang_user
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    role_id bigint,
    phone character varying(255),
    address text,
    is_active boolean DEFAULT true NOT NULL
);


ALTER TABLE public.users OWNER TO karang_user;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: karang_user
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO karang_user;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: karang_user
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: activity_plans id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.activity_plans ALTER COLUMN id SET DEFAULT nextval('public.activity_plans_id_seq'::regclass);


--
-- Name: activity_realizations id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.activity_realizations ALTER COLUMN id SET DEFAULT nextval('public.activity_realizations_id_seq'::regclass);


--
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- Name: contents id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.contents ALTER COLUMN id SET DEFAULT nextval('public.contents_id_seq'::regclass);


--
-- Name: documentation_library id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.documentation_library ALTER COLUMN id SET DEFAULT nextval('public.documentation_library_id_seq'::regclass);


--
-- Name: documents id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.documents ALTER COLUMN id SET DEFAULT nextval('public.documents_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: financial_transactions id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.financial_transactions ALTER COLUMN id SET DEFAULT nextval('public.financial_transactions_id_seq'::regclass);


--
-- Name: meetings id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.meetings ALTER COLUMN id SET DEFAULT nextval('public.meetings_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: organization_profiles id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.organization_profiles ALTER COLUMN id SET DEFAULT nextval('public.organization_profiles_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: activity_plans; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.activity_plans (id, user_id, category_id, title, description, objectives, planned_date, location, budget, approved_by, approved_at, rejection_reason, created_at, updated_at, status) FROM stdin;
4	1	1	Donor Darah Bersama PMI	Kegiatan donor darah bekerjasama dengan PMI untuk membantu ketersediaan stok darah di rumah sakit dan menolong sesama.	\N	2025-12-06	Balai RW, Jakarta	\N	\N	\N	\N	2026-01-06 11:53:20	2026-01-06 11:53:20	approved
5	1	5	Turnamen Futsal Antar RT	Kompetisi olahraga futsal antar RT untuk mempererat silaturahmi, menumbuhkan sportivitas, dan mengembangkan bakat olahraga pemuda.	\N	2025-11-06	Lapangan Futsal Pemuda	\N	\N	\N	\N	2026-01-06 11:53:20	2026-01-06 11:53:20	approved
6	1	1	Gerakan Bersih Lingkungan	Got ong royong membersihkan lingkungan, pengangkatan sampah di sungai, dan penanaman pohon untuk menjaga kelestarian lingkungan hidup.	\N	2025-12-23	Kawasan Sungai dan Taman Kota	\N	\N	\N	\N	2026-01-06 11:53:20	2026-01-06 11:53:20	approved
3	1	1	GEBYAR RAMADAN PREGAS 2026	Rangkaian kegiatan semarak Ramadan yang berpusat di Musala Ar-Rahman. Agenda meliputi perlombaan islami anak (Adzan, Hafalan Surat, & Pildacil), pembagian takjil gratis, serta santunan anak yatim. Kegiatan ini akan ditutup dengan acara Buka Puasa Bersama (Bukber) antara pemuda, tokoh masyarakat, dan warga untuk menjalin keakraban di bulan suci.	1. Memakmurkan Musala Ar-Rahman dengan kegiatan positif selama Ramadan.\r\n2. Mempererat tali silaturahmi dan ukhuwah islamiyah antarwarga RT 003 & 021.\r\n3. Menumbuhkan rasa percaya diri anak-anak dan kepedulian sosial pemuda.	2026-03-14	Musala Ar-Rahman	15000000.00	\N	\N	\N	2026-01-06 11:53:20	2026-01-12 13:13:30	approved
\.


--
-- Data for Name: activity_realizations; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.activity_realizations (id, activity_plan_id, user_id, actual_date, actual_location, participants_count, attendance_list, report, achievements, obstacles, actual_budget, verified_by, verified_at, created_at, updated_at, status) FROM stdin;
1	3	3	2026-02-14	Musala Ar-Rahman	100	\N	lancar	banyak	tidak ada	13000000.00	\N	\N	2026-01-12 08:00:38	2026-01-12 08:00:38	sedang_berjalan
\.


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.categories (id, name, slug, type, description, created_at, updated_at) FROM stdin;
1	Sosial	sosial	activity	Kegiatan sosial kemasyarakatan	2026-01-06 11:53:19	2026-01-06 11:53:19
2	Pendidikan	pendidikan	activity	Kegiatan pendidikan dan pelatihan	2026-01-06 11:53:19	2026-01-06 11:53:19
3	Olahraga	olahraga	activity	Kegiatan olahraga dan kesehatan	2026-01-06 11:53:19	2026-01-06 11:53:19
4	Budaya	budaya	activity	Kegiatan seni dan budaya	2026-01-06 11:53:19	2026-01-06 11:53:19
5	Lingkungan	lingkungan	activity	Kegiatan peduli lingkungan	2026-01-06 11:53:19	2026-01-06 11:53:19
6	Laporan	laporan	document	Dokumen laporan kegiatan	2026-01-06 11:53:19	2026-01-06 11:53:19
7	Proposal	proposal	document	Dokumen proposal kegiatan	2026-01-06 11:53:19	2026-01-06 11:53:19
8	Surat	surat	document	Surat menyurat organisasi	2026-01-06 11:53:19	2026-01-06 11:53:19
9	Berita	berita	content	Berita organisasi	2026-01-06 11:53:19	2026-01-06 11:53:19
10	Pengumuman	pengumuman	content	Pengumuman penting	2026-01-06 11:53:19	2026-01-06 11:53:19
11	Artikel	artikel	content	Artikel dan opini	2026-01-06 11:53:19	2026-01-06 11:53:19
\.


--
-- Data for Name: contents; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.contents (id, user_id, category_id, title, slug, excerpt, body, featured_image, type, status, published_at, meta_title, meta_description, meta_keywords, views_count, created_at, updated_at) FROM stdin;
7	6	9	Sinergi Lintas Generasi: Karang Taruna Pregas dan Tokoh Masyarakat RT 003 & 021 Matangkan Kegiatan Ramadan	sinergi-lintas-generasi-karang-taruna-pregas-dan-tokoh-masyarakat-rt-003-021-matangkan-kegiatan-ramadan	"Sinergi antara semangat pemuda dan kearifan orang tua adalah kunci utama keberhasilan kegiatan di lingkungan."	GANDUL (11/1/2026) – Semangat menyambut bulan suci mulai terasa di lingkungan Gandul. Malam ini, Pengurus dan Anggota Karang Taruna Pregas menggelar rapat koordinasi bersama Tokoh Masyarakat dari lingkungan RT 003 dan RT 021.\r\n\r\nAgenda utama pertemuan ini secara khusus membahas beberapa rencana kegiatan yang akan dilakukan untuk memeriahkan bulan Ramadan mendatang. Diskusi berjalan interaktif membahas opsi kegiatan, mulai dari perlombaan anak, kegiatan ibadah, hingga aksi sosial.\r\n\r\nDengan konsep lesehan yang hangat, para pemuda juga mendengarkan arahan dan nasehat dari para sesepuh lingkungan agar seluruh agenda tersebut berjalan lancar dan sesuai norma. Sinergi antara semangat muda dan kearifan orang tua ini diharapkan menjadi kunci suksesnya "Gebyar Ramadan" tahun ini.	news-images/GK9zsbaX2JSv4oAs9IyltVYESjAXV0ez1yNEO157.jpg	news	published	2026-01-12 04:47:47	\N	\N	\N	0	2026-01-12 04:46:03	2026-01-12 12:55:07
11	6	9	Eratkan Solidaritas, Karang Taruna Pregas Sukses Gelar Gathering Tahunan 2025	eratkan-solidaritas-karang-taruna-pregas-sukses-gelar-gathering-tahunan-2025	"Agenda rutin tahunan sebagai ajang bonding dan refreshing seluruh anggota Karang Taruna Pregas demi menjaga kekompakan organisasi."	GANDUL (12/1/2026) – Di tengah kesibukan program kerja yang padat, Karang Taruna Persatuan Remaja Gandul Selatan (PREGAS) kembali melaksanakan agenda rutin tahunannya, yakni Family Gathering. Kegiatan yang dinanti-nanti ini telah sukses dilaksanakan pada Minggu, 5 Oktober 2025 lalu.\r\n\r\nGathering tahun ini mengusung konsep kebersamaan di alam terbuka. Seperti terlihat dalam dokumentasi, puluhan anggota dan pengurus tampak antusias mengikuti rangkaian acara yang digelar di sebuah villa dengan suasana yang asri dan sejuk.\r\n\r\n"Kegiatan ini bukan sekadar jalan-jalan, tapi agenda wajib setiap tahun untuk me-recharge semangat kawan-kawan. Kita ingin chemistry antar anggota tetap terjaga, dari yang senior sampai anggota baru lebur jadi satu," ungkap perwakilan panitia pelaksana.\r\n\r\nAcara diisi dengan berbagai games kekompakan, diskusi santai, dan sesi foto bersama yang penuh canda tawa. Melalui kegiatan ini, diharapkan soliditas Karang Taruna Pregas semakin kuat untuk menghadapi tantangan program kerja di masa mendatang.	news-images/nzHo1E1OxG66s0M6453rISXtqVRAyoxp4tV8FlfM.jpg	news	published	2026-01-12 13:08:01	\N	\N	\N	0	2026-01-12 13:08:01	2026-01-12 13:08:01
12	6	1	Aksi Solidaritas: Karang Taruna Pregas Galang Dana untuk Korban Bencana Aceh & Sumatera	aksi-solidaritas-karang-taruna-pregas-galang-dana-untuk-korban-bencana-aceh-sumatera	"Duka mereka adalah luka kita. Merespons bencana alam yang melanda saudara di Aceh dan Sumatera, Karang Taruna Pregas bergerak cepat mengumpulkan kepedulian dari warga Gandul dan sekitarnya."	GANDUL (12/1/2025) – Bencana alam yang menimpa saudara-saudara kita di wilayah Aceh dan Sumatera menyisakan duka yang mendalam bagi seluruh rakyat Indonesia. Panggilan kemanusiaan ini dijawab langsung oleh Karang Taruna Persatuan Remaja Gandul Selatan (PREGAS) dengan menggelar aksi penggalangan dana.\r\n\r\nAksi solidaritas ini telah dilaksanakan secara intensif selama satu pekan penuh, yakni mulai tanggal 7 Desember hingga 14 Desember 2025 yang lalu.\r\n\r\nMengusung semangat "Satu Rasa, Satu Jiwa", para pemuda dan pengurus turun langsung ke jalan dan menyisir lingkungan warga RT 003 serta RT 021. Kegiatan ini merupakan wujud nyata kepedulian sosial generasi muda terhadap musibah yang menimpa sesama, tanpa memandang jarak dan waktu.\r\n\r\n"Kami menyadari bantuan ini mungkin tidak seberapa, namun ini adalah bukti bahwa saudara-saudara di Aceh dan Sumatera tidak sendirian. Warga Gandul Selatan turut mendoakan dan membantu," ujar perwakilan pengurus.\r\n\r\nSeluruh donasi yang terkumpul selama periode tersebut kini telah disalurkan melalui lembaga resmi agar segera sampai kepada para korban yang membutuhkan, baik dalam bentuk logistik maupun kebutuhan pokok lainnya.	news-images/U9ccYqoEEhvFG17kn0fHQ16lRNWy5RNmVoiw58nR.jpg	news	published	2026-01-12 13:08:50	\N	\N	\N	0	2026-01-12 13:08:50	2026-01-12 13:08:50
\.


--
-- Data for Name: documentation_library; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.documentation_library (id, user_id, category_id, activity_realization_id, title, description, type, file_path, file_name, file_type, file_size, created_at, updated_at) FROM stdin;
1	1	\N	\N	Penyemprotan Fogging	\N	photo	documentation/1767746693_WhatsApp Image 2026-01-06 at 22.58.22.jpeg	1767746693_WhatsApp Image 2026-01-06 at 22.58.22.jpeg	image/jpeg	98704	2026-01-07 00:44:53	2026-01-07 00:44:53
2	1	\N	\N	SOTR Ramadhan	\N	photo	documentation/1767746955_WhatsApp Image 2026-01-06 at 22.58.23.jpeg	1767746955_WhatsApp Image 2026-01-06 at 22.58.23.jpeg	image/jpeg	131897	2026-01-07 00:49:15	2026-01-07 00:49:15
3	1	\N	\N	Penyemprotan Disinfektan	\N	photo	documentation/1767750582_WhatsApp Image 2026-01-06 at 22.58.23 (1).jpeg	1767750582_WhatsApp Image 2026-01-06 at 22.58.23 (1).jpeg	image/jpeg	120480	2026-01-07 01:49:42	2026-01-07 01:49:42
4	1	\N	\N	Olahraga Futsal	\N	photo	documentation/1767750601_WhatsApp Image 2026-01-06 at 22.58.24.jpeg	1767750601_WhatsApp Image 2026-01-06 at 22.58.24.jpeg	image/jpeg	162179	2026-01-07 01:50:01	2026-01-07 01:50:01
5	1	\N	\N	Pawai Ramadhan	\N	photo	documentation/1767750619_WhatsApp Image 2026-01-06 at 22.58.24 (1).jpeg	1767750619_WhatsApp Image 2026-01-06 at 22.58.24 (1).jpeg	image/jpeg	49193	2026-01-07 01:50:19	2026-01-07 01:50:19
6	1	\N	\N	Perlombaan Agustusan	\N	photo	documentation/1767750637_WhatsApp Image 2026-01-06 at 22.58.25.jpeg	1767750637_WhatsApp Image 2026-01-06 at 22.58.25.jpeg	image/jpeg	169021	2026-01-07 01:50:37	2026-01-07 01:50:37
8	1	\N	\N	Penggalangan Dana	\N	photo	documentation/1767750669_WhatsApp Image 2026-01-06 at 22.58.26.jpeg	1767750669_WhatsApp Image 2026-01-06 at 22.58.26.jpeg	image/jpeg	67990	2026-01-07 01:51:09	2026-01-07 01:51:09
7	1	\N	\N	Family Gathering	\N	photo	documentation/1767750654_WhatsApp Image 2026-01-06 at 22.58.25 (1).jpeg	1767750654_WhatsApp Image 2026-01-06 at 22.58.25 (1).jpeg	image/jpeg	279743	2026-01-07 01:50:54	2026-01-12 03:15:39
\.


--
-- Data for Name: documents; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.documents (id, user_id, title, description, file_name, file_path, file_size, file_type, created_at, updated_at) FROM stdin;
4	2	[MASTER] SURAT PREGAS	File master, isi surat bisa dirubah/disesuaikan dengan kebutuhan.	Surat Resmi Pregas - Full TTD dan Tembusan.docx	documents/gvPXnrx0BKb6Jqb7aDftSCf0dnlujt8VFvcGCEH3.docx	779334	application/vnd.openxmlformats-officedocument.wordprocessingml.document	2026-01-08 15:40:18	2026-01-09 02:40:21
5	2	[MASTER] PROPOSAL RAMADAN PREGAS	File master, isi proposal bisa dirubah/disesuaikan dengan kebutuhan.	MASTER - PROPOSAL RAMADAN PREGAS 2026.docx	documents/1YTArtGTIfAEs91Nk0KvkQjy8cbR8M1RV7n4nFHq.docx	792002	application/vnd.openxmlformats-officedocument.wordprocessingml.document	2026-01-14 12:09:52	2026-01-14 12:10:45
6	2	[MASTER] LEMBARAN KOSONGAN DENGAN KOP PREGAS	Lembaran kosong dengan tambahan kop pregas di atasnya.	MASTER - LEMBARAN KOSONGAN DENGAN KOP PREGAS.docx	documents/heJVLjm6JjMaPwjgIkL8pdWx52HePIjymsmg6mGr.docx	765877	application/vnd.openxmlformats-officedocument.wordprocessingml.document	2026-01-14 12:14:35	2026-01-14 12:14:35
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: financial_transactions; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.financial_transactions (id, user_id, transaction_date, type, category, amount, description, notes, evidence_file, created_at, updated_at) FROM stdin;
2	5	2025-12-21	income	Penggalangan Dana	2500000.00	Dana yang tersisa dalam pelaksanaan penggalangan dana, dari tanggal 5 Desember 2025 s.d. 20 Desember 2025.	Dana yang masuk dalam keuangan PREGAS diketahui oleh pengurus dan ketua lingkungan	\N	2026-01-12 02:57:38	2026-01-12 02:58:41
4	1	2026-01-12	expense	ttt	500000.00	tttt	tttt	\N	2026-01-12 12:12:50	2026-01-12 12:12:58
5	1	2026-01-12	expense	m	368000.00	n	n	\N	2026-01-12 12:14:08	2026-01-12 12:14:08
\.


--
-- Data for Name: meetings; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.meetings (id, user_id, title, meeting_date, meeting_time, location, agenda, notes, status, created_at, updated_at) FROM stdin;
1	2	Silaturahmi Menyambut Ramadan	2026-01-11	19:30:00	Musala Ar-Rahman	Nomor : 001/005/PREGAS/1/2026\r\nPerihal : Pemaparan Rencana Kegiatan Ramadan dan Jaring Aspirasi	Rapat koordinasi persiapan Gebyar Ramadan telah dilaksanakan pada 11 Januari 2026 dengan keputusan menyetujui konsep kegiatan dan pembentukan panitia pelaksana. Disepakati tindak lanjut minggu ini adalah Bidang Acara segera menyusun detail teknis dan daftar kebutuhan logistik untuk dihitung menjadi RAB final oleh Bendahara, yang selanjutnya akan dituangkan oleh Sekretaris ke dalam proposal resmi dan SK Panitia. Bersamaan dengan proses administrasi tersebut, Bidang Media ditugaskan menyiapkan subdomain pendaftaran online dan Bidang Humas bersiap melakukan sosialisasi kepada warga serta donatur segera setelah dokumen legalitas selesai.	completed	2026-01-08 03:52:01	2026-01-12 02:42:16
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_resets_table	1
3	2019_08_19_000000_create_failed_jobs_table	1
4	2019_12_14_000001_create_personal_access_tokens_table	1
5	2025_12_27_092650_create_roles_table	1
6	2025_12_27_092705_add_role_to_users_table	1
7	2025_12_27_092713_create_categories_table	1
8	2025_12_27_092732_create_activity_plans_table	1
9	2025_12_27_092748_create_activity_realizations_table	1
10	2025_12_27_092754_create_contents_table	1
11	2025_12_27_092800_create_documentation_library_table	1
12	2025_12_27_092809_create_organization_profiles_table	1
13	2026_01_05_073951_update_activity_realizations_status_enum	1
14	2026_01_05_085241_add_pending_review_status_to_activity_plans	1
15	2026_01_07_063124_create_financial_transactions_table	2
16	2026_01_07_063129_create_meetings_table	2
17	2026_01_08_052941_create_documents_table	3
\.


--
-- Data for Name: organization_profiles; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.organization_profiles (id, organization_name, about, vision, mission, history, structure, logo, address, phone, email, social_media, created_at, updated_at) FROM stdin;
1	Karang Taruna Indonesia	Karang Taruna adalah organisasi kepemudaan di Indonesia yang merupakan wadah pengembangan generasi muda yang tumbuh dan berkembang atas dasar kesadaran dan tanggung jawab sosial dari, oleh, dan untuk masyarakat terutama generasi muda. Karang Taruna berperan aktif dalam berbagai kegiatan pembangunan masyarakat dengan mengedepankan kepedulian, kreativitas, dan jiwa kepemimpinan para anggotanya.	Terwujudnya generasi muda yang beriman, bertakwa, berakhlak mulia, sehat, cerdas, terampil, kreatif, inovatif, mandiri, demokratis, dan bertanggung jawab dalam membangun bangsa dan negara Indonesia yang adil, makmur, dan sejahtera.	Menyelenggarakan pembinaan dan pemberdayaan generasi muda melalui berbagai kegiatan sosial, pendidikan, keterampilan, kewirausahaan, olahraga, seni, dan budaya untuk meningkatkan kualitas hidup dan kesejahteraan masyarakat.	Karang Taruna didirikan pada tahun 1960-an sebagai wadah pembinaan dan pengembangan generasi muda. Sejak saat itu, Karang Taruna terus berkembang dan aktif dalam berbagai kegiatan pembangunan masyarakat di seluruh Indonesia.	\N	\N	Jl. Pemuda No. 123, Jakarta Pusat, DKI Jakarta 10110	(021) 123-4567	info@karangtaruna.id	{"facebook":"https:\\/\\/facebook.com\\/karangtaruna","instagram":"https:\\/\\/instagram.com\\/karangtaruna","twitter":"https:\\/\\/twitter.com\\/karangtaruna","youtube":"https:\\/\\/youtube.com\\/@karangtaruna"}	2026-01-06 11:53:20	2026-01-06 11:53:20
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.roles (id, name, slug, description, created_at, updated_at) FROM stdin;
1	Ketua	ketua	Ketua Karang Taruna dengan akses penuh	2026-01-06 11:53:19	2026-01-06 11:53:19
2	Anggota	anggota	Anggota Karang Taruna	2026-01-06 11:53:19	2026-01-06 11:53:19
3	Admin Data	admin-data	Administrator pengelola data	2026-01-06 11:53:19	2026-01-06 11:53:19
4	Masyarakat	masyarakat	Masyarakat umum (akses publik)	2026-01-06 11:53:19	2026-01-06 11:53:19
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: karang_user
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role_id, phone, address, is_active) FROM stdin;
4	WAKIL KETUA UMUM	waketum@pregas.id	\N	$2y$10$Chnv8XEK1FEk.7wI3fQ0nOYBPpXzuXvXom3ig1pwll5rp4p3I1FGq	\N	2026-01-06 11:53:20	2026-01-12 01:31:48	1	081234567893	\N	t
7	KABID ACARA	acara@pregas.id	\N	$2y$10$QLL1MFc5ZmF1JjfPlrRz3ODFPpeIknEzmA2Upv4VZn/kcwzxrPYsu	\N	2026-01-12 01:23:59	2026-01-12 01:35:26	2	\N	\N	t
8	KABID PERLENGKAPAN	perlengkapan@pregas.id	\N	$2y$10$mRVD.K7pIZYdFu.0M3GqY.LSF7EXpC11lAMFoctIoBvJ8nUvqY.5m	\N	2026-01-12 01:39:53	2026-01-12 01:39:53	2	\N	\N	t
1	KETUA UMUM	ketum@pregas.id	\N	$2y$10$ZSSKuQoUaKtvgPNG9QTBZ.bu9ESj0Khm/Cqh0/7XR15mwcApb1fSO	5l6iE9kp3wFwzcCEtmptc6JshPdf1PiyBkO05V8TwdV6fVQjqv87ZbfZ8quK	2026-01-06 11:53:20	2026-01-12 01:30:24	1	081234567890	\N	t
6	KABID HUMAS	humas@pregas.id	\N	$2y$10$UWqOJXPOZFSbHXBaldqwlOlrGDCc.uCTk1JTdiEx3tNMuKcDIhaU.	Aq7ydI6OsAoOrIrC9Btlo2TBuWDIESFqY3r3QF1ZPmp4SQr5TLAXUraCKurb	2026-01-06 11:53:20	2026-01-12 04:35:58	3	081234567895	\N	t
2	SEKRETARIS	sekretaris@pregas.id	\N	$2y$10$ljxyIj6XX1qzDT1LAksSteObB2l8odaZpRYUJwu4LDVAEUlpGknK.	KzPpMQ5OSkKxhrTXJVyGAW75ZMj5tQ988p67cyAsAXsW4x0RMAAPbBCFQzKs	2026-01-06 11:53:20	2026-01-12 01:28:33	3	081234567891	\N	t
3	KABID MEDIA	media@pregas.id	\N	$2y$10$gxjjSYhUj2dnvbZxq621s.CEwo.XVzHJ4mN79z7DuZK5.5E7E7g32	dii4FA7k6Yxby2hYafex3Lhcav00avsJHVT25lmHpByN8aae9U81LZVO68Mg	2026-01-06 11:53:20	2026-01-12 04:16:24	1	081234567892	\N	t
5	BENDAHARA	bendahara@pregas.id	\N	$2y$10$OhgkhdTEjmmYrwFbBo3MXu2IepXpi/XfIG0cw1W9oixz8b1p5YXCO	NeXjX0k3iu5E0YLhuKQX5tJCJ2LX6wnwFsdEfJYM6P1uOCN4WnK4SwgmpVXW	2026-01-06 11:53:20	2026-01-12 04:03:59	2	081234567894	\N	t
\.


--
-- Name: activity_plans_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.activity_plans_id_seq', 6, true);


--
-- Name: activity_realizations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.activity_realizations_id_seq', 1, true);


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.categories_id_seq', 15, true);


--
-- Name: contents_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.contents_id_seq', 12, true);


--
-- Name: documentation_library_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.documentation_library_id_seq', 8, true);


--
-- Name: documents_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.documents_id_seq', 6, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: financial_transactions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.financial_transactions_id_seq', 5, true);


--
-- Name: meetings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.meetings_id_seq', 1, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.migrations_id_seq', 17, true);


--
-- Name: organization_profiles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.organization_profiles_id_seq', 1, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.roles_id_seq', 4, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: karang_user
--

SELECT pg_catalog.setval('public.users_id_seq', 8, true);


--
-- Name: activity_plans activity_plans_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.activity_plans
    ADD CONSTRAINT activity_plans_pkey PRIMARY KEY (id);


--
-- Name: activity_realizations activity_realizations_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.activity_realizations
    ADD CONSTRAINT activity_realizations_pkey PRIMARY KEY (id);


--
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: categories categories_slug_unique; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_slug_unique UNIQUE (slug);


--
-- Name: contents contents_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.contents
    ADD CONSTRAINT contents_pkey PRIMARY KEY (id);


--
-- Name: contents contents_slug_unique; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.contents
    ADD CONSTRAINT contents_slug_unique UNIQUE (slug);


--
-- Name: documentation_library documentation_library_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.documentation_library
    ADD CONSTRAINT documentation_library_pkey PRIMARY KEY (id);


--
-- Name: documents documents_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.documents
    ADD CONSTRAINT documents_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: financial_transactions financial_transactions_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.financial_transactions
    ADD CONSTRAINT financial_transactions_pkey PRIMARY KEY (id);


--
-- Name: meetings meetings_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.meetings
    ADD CONSTRAINT meetings_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: organization_profiles organization_profiles_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.organization_profiles
    ADD CONSTRAINT organization_profiles_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- Name: roles roles_slug_unique; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_slug_unique UNIQUE (slug);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: documents_created_at_index; Type: INDEX; Schema: public; Owner: karang_user
--

CREATE INDEX documents_created_at_index ON public.documents USING btree (created_at);


--
-- Name: documents_user_id_index; Type: INDEX; Schema: public; Owner: karang_user
--

CREATE INDEX documents_user_id_index ON public.documents USING btree (user_id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: karang_user
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: karang_user
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: activity_plans activity_plans_approved_by_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.activity_plans
    ADD CONSTRAINT activity_plans_approved_by_foreign FOREIGN KEY (approved_by) REFERENCES public.users(id) ON DELETE SET NULL;


--
-- Name: activity_plans activity_plans_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.activity_plans
    ADD CONSTRAINT activity_plans_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE SET NULL;


--
-- Name: activity_plans activity_plans_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.activity_plans
    ADD CONSTRAINT activity_plans_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: activity_realizations activity_realizations_activity_plan_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.activity_realizations
    ADD CONSTRAINT activity_realizations_activity_plan_id_foreign FOREIGN KEY (activity_plan_id) REFERENCES public.activity_plans(id) ON DELETE CASCADE;


--
-- Name: activity_realizations activity_realizations_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.activity_realizations
    ADD CONSTRAINT activity_realizations_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: activity_realizations activity_realizations_verified_by_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.activity_realizations
    ADD CONSTRAINT activity_realizations_verified_by_foreign FOREIGN KEY (verified_by) REFERENCES public.users(id) ON DELETE SET NULL;


--
-- Name: contents contents_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.contents
    ADD CONSTRAINT contents_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE SET NULL;


--
-- Name: contents contents_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.contents
    ADD CONSTRAINT contents_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: documentation_library documentation_library_activity_realization_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.documentation_library
    ADD CONSTRAINT documentation_library_activity_realization_id_foreign FOREIGN KEY (activity_realization_id) REFERENCES public.activity_realizations(id) ON DELETE CASCADE;


--
-- Name: documentation_library documentation_library_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.documentation_library
    ADD CONSTRAINT documentation_library_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE SET NULL;


--
-- Name: documentation_library documentation_library_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.documentation_library
    ADD CONSTRAINT documentation_library_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: documents documents_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.documents
    ADD CONSTRAINT documents_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: financial_transactions financial_transactions_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.financial_transactions
    ADD CONSTRAINT financial_transactions_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: meetings meetings_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.meetings
    ADD CONSTRAINT meetings_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: users users_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: karang_user
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE SET NULL;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: pg_database_owner
--

GRANT ALL ON SCHEMA public TO karang_user;


--
-- Name: DEFAULT PRIVILEGES FOR TABLES; Type: DEFAULT ACL; Schema: public; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA public GRANT ALL ON TABLES TO karang_user;


--
-- PostgreSQL database dump complete
--

\unrestrict 00ToPEGftxqKbdO8wbpZjlmNqhEPkZAtIKGSuUd8Ui4dNboOXffNDkKUhdVRTAz


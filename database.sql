PGDMP     9        
            x            controle_colaboradores    12.3    12.3 -    8           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            9           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            :           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            ;           1262    16393    controle_colaboradores    DATABASE     �   CREATE DATABASE controle_colaboradores WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';
 &   DROP DATABASE controle_colaboradores;
                postgres    false            �            1259    16404    cargos    TABLE     h   CREATE TABLE public.cargos (
    id smallint NOT NULL,
    descricao character varying(200) NOT NULL
);
    DROP TABLE public.cargos;
       public         heap    postgres    false            �            1259    16402    cargos_id_seq    SEQUENCE     �   CREATE SEQUENCE public.cargos_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.cargos_id_seq;
       public          postgres    false    205            <           0    0    cargos_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.cargos_id_seq OWNED BY public.cargos.id;
          public          postgres    false    204            �            1259    16435    colaboradores    TABLE     �  CREATE TABLE public.colaboradores (
    id integer NOT NULL,
    nome_completo character varying(300) NOT NULL,
    sexo "char" NOT NULL,
    nome_mae character varying(300) NOT NULL,
    nacionalidade character varying(100) NOT NULL,
    data_nascimento date NOT NULL,
    cargo_id smallint NOT NULL,
    funcao_id smallint NOT NULL,
    remuneracao numeric(17,2) NOT NULL,
    rg bigint NOT NULL,
    orgao_emissor character varying(50) NOT NULL,
    email character varying(300) NOT NULL,
    telefone character varying(20) NOT NULL,
    ctps bigint,
    pis_pasep bigint,
    empresa_id smallint NOT NULL,
    setor_id smallint NOT NULL,
    cpf bigint NOT NULL
);
 !   DROP TABLE public.colaboradores;
       public         heap    postgres    false            �            1259    16433    colaboradores_id_seq    SEQUENCE     �   CREATE SEQUENCE public.colaboradores_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.colaboradores_id_seq;
       public          postgres    false    211            =           0    0    colaboradores_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.colaboradores_id_seq OWNED BY public.colaboradores.id;
          public          postgres    false    210            �            1259    16396    empresas    TABLE     m   CREATE TABLE public.empresas (
    id smallint NOT NULL,
    razao_social character varying(200) NOT NULL
);
    DROP TABLE public.empresas;
       public         heap    postgres    false            �            1259    16394    empresas_id_seq    SEQUENCE     �   CREATE SEQUENCE public.empresas_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.empresas_id_seq;
       public          postgres    false    203            >           0    0    empresas_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.empresas_id_seq OWNED BY public.empresas.id;
          public          postgres    false    202            �            1259    16412    funcoes    TABLE     �   CREATE TABLE public.funcoes (
    id smallint NOT NULL,
    descricao character varying(200) NOT NULL,
    cargo smallint NOT NULL
);
    DROP TABLE public.funcoes;
       public         heap    postgres    false            �            1259    16410    funcoes_id_seq    SEQUENCE     �   CREATE SEQUENCE public.funcoes_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.funcoes_id_seq;
       public          postgres    false    207            ?           0    0    funcoes_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.funcoes_id_seq OWNED BY public.funcoes.id;
          public          postgres    false    206            �            1259    16427    setores    TABLE     d   CREATE TABLE public.setores (
    id smallint NOT NULL,
    nome character varying(200) NOT NULL
);
    DROP TABLE public.setores;
       public         heap    postgres    false            �            1259    16425    setor_id_seq    SEQUENCE     �   CREATE SEQUENCE public.setor_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.setor_id_seq;
       public          postgres    false    209            @           0    0    setor_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.setor_id_seq OWNED BY public.setores.id;
          public          postgres    false    208            �
           2604    16407 	   cargos id    DEFAULT     f   ALTER TABLE ONLY public.cargos ALTER COLUMN id SET DEFAULT nextval('public.cargos_id_seq'::regclass);
 8   ALTER TABLE public.cargos ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    205    204    205            �
           2604    16438    colaboradores id    DEFAULT     t   ALTER TABLE ONLY public.colaboradores ALTER COLUMN id SET DEFAULT nextval('public.colaboradores_id_seq'::regclass);
 ?   ALTER TABLE public.colaboradores ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    211    210    211            �
           2604    16399    empresas id    DEFAULT     j   ALTER TABLE ONLY public.empresas ALTER COLUMN id SET DEFAULT nextval('public.empresas_id_seq'::regclass);
 :   ALTER TABLE public.empresas ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    203    202    203            �
           2604    16415 
   funcoes id    DEFAULT     h   ALTER TABLE ONLY public.funcoes ALTER COLUMN id SET DEFAULT nextval('public.funcoes_id_seq'::regclass);
 9   ALTER TABLE public.funcoes ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    206    207    207            �
           2604    16430 
   setores id    DEFAULT     f   ALTER TABLE ONLY public.setores ALTER COLUMN id SET DEFAULT nextval('public.setor_id_seq'::regclass);
 9   ALTER TABLE public.setores ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    208    209    209            /          0    16404    cargos 
   TABLE DATA           /   COPY public.cargos (id, descricao) FROM stdin;
    public          postgres    false    205   �3       5          0    16435    colaboradores 
   TABLE DATA           �   COPY public.colaboradores (id, nome_completo, sexo, nome_mae, nacionalidade, data_nascimento, cargo_id, funcao_id, remuneracao, rg, orgao_emissor, email, telefone, ctps, pis_pasep, empresa_id, setor_id, cpf) FROM stdin;
    public          postgres    false    211   I4       -          0    16396    empresas 
   TABLE DATA           4   COPY public.empresas (id, razao_social) FROM stdin;
    public          postgres    false    203   )5       1          0    16412    funcoes 
   TABLE DATA           7   COPY public.funcoes (id, descricao, cargo) FROM stdin;
    public          postgres    false    207   i5       3          0    16427    setores 
   TABLE DATA           +   COPY public.setores (id, nome) FROM stdin;
    public          postgres    false    209   �5       A           0    0    cargos_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.cargos_id_seq', 1, true);
          public          postgres    false    204            B           0    0    colaboradores_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.colaboradores_id_seq', 34, true);
          public          postgres    false    210            C           0    0    empresas_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.empresas_id_seq', 1, false);
          public          postgres    false    202            D           0    0    funcoes_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.funcoes_id_seq', 1, false);
          public          postgres    false    206            E           0    0    setor_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.setor_id_seq', 1, false);
          public          postgres    false    208            �
           2606    16409    cargos cargos_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.cargos
    ADD CONSTRAINT cargos_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.cargos DROP CONSTRAINT cargos_pkey;
       public            postgres    false    205            �
           2606    16443     colaboradores colaboradores_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.colaboradores
    ADD CONSTRAINT colaboradores_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.colaboradores DROP CONSTRAINT colaboradores_pkey;
       public            postgres    false    211            �
           2606    16401    empresas empresas_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.empresas
    ADD CONSTRAINT empresas_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.empresas DROP CONSTRAINT empresas_pkey;
       public            postgres    false    203            �
           2606    16419 #   funcoes funcoes_descricao_cargo_key 
   CONSTRAINT     j   ALTER TABLE ONLY public.funcoes
    ADD CONSTRAINT funcoes_descricao_cargo_key UNIQUE (descricao, cargo);
 M   ALTER TABLE ONLY public.funcoes DROP CONSTRAINT funcoes_descricao_cargo_key;
       public            postgres    false    207    207            �
           2606    16417    funcoes funcoes_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.funcoes
    ADD CONSTRAINT funcoes_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.funcoes DROP CONSTRAINT funcoes_pkey;
       public            postgres    false    207            �
           2606    16432    setores setor_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.setores
    ADD CONSTRAINT setor_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.setores DROP CONSTRAINT setor_pkey;
       public            postgres    false    209            �
           2606    16444 &   colaboradores colaboradores_cargo_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.colaboradores
    ADD CONSTRAINT colaboradores_cargo_fkey FOREIGN KEY (cargo_id) REFERENCES public.cargos(id) ON UPDATE CASCADE;
 P   ALTER TABLE ONLY public.colaboradores DROP CONSTRAINT colaboradores_cargo_fkey;
       public          postgres    false    2720    211    205            �
           2606    16454 (   colaboradores colaboradores_empresa_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.colaboradores
    ADD CONSTRAINT colaboradores_empresa_fkey FOREIGN KEY (empresa_id) REFERENCES public.empresas(id) ON UPDATE CASCADE;
 R   ALTER TABLE ONLY public.colaboradores DROP CONSTRAINT colaboradores_empresa_fkey;
       public          postgres    false    211    2718    203            �
           2606    16449 '   colaboradores colaboradores_funcao_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.colaboradores
    ADD CONSTRAINT colaboradores_funcao_fkey FOREIGN KEY (funcao_id) REFERENCES public.funcoes(id) ON UPDATE CASCADE;
 Q   ALTER TABLE ONLY public.colaboradores DROP CONSTRAINT colaboradores_funcao_fkey;
       public          postgres    false    207    211    2724            �
           2606    16459 &   colaboradores colaboradores_setor_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.colaboradores
    ADD CONSTRAINT colaboradores_setor_fkey FOREIGN KEY (setor_id) REFERENCES public.setores(id) ON UPDATE CASCADE;
 P   ALTER TABLE ONLY public.colaboradores DROP CONSTRAINT colaboradores_setor_fkey;
       public          postgres    false    211    2726    209            �
           2606    16420    funcoes funcoes_cargo_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.funcoes
    ADD CONSTRAINT funcoes_cargo_fkey FOREIGN KEY (cargo) REFERENCES public.cargos(id) ON UPDATE CASCADE ON DELETE CASCADE;
 D   ALTER TABLE ONLY public.funcoes DROP CONSTRAINT funcoes_cargo_fkey;
       public          postgres    false    205    207    2720            /   A   x�3�qu��t�WpqUp��3<����|C<���8C#|<�@�~�~��A�\1z\\\ ��1      5   �   x�mαj1�Y~
��َ�dKJ�Rr%pk�A�9�>�ើ6�
��� �|+��"�$=H��>�>���k%e�a_f%��y䙧�
<e�$��|0v�>;D���0�3��v��r��#]`��fm�76<z8��n����V�S9G���Y���{�RQ=e!���J����ݒ�7Oͽ�NK��|!�wR+j��UQޫc���0�R�      -   0   x�3��u�T��+.I�I<����| '����(31G��$%Q�+F��� ;{      1   H   x�3�qu��t�WpqUp��3<����|C<�<9��8C#|<�@��~�~��A�@9#�=... m5x      3      x�3�t	������ �     
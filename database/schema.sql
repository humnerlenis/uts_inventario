CREATE TABLE public.inventario (
    id_inventario serial NOT NULL,
    tipo character varying(300) NOT NULL,
    marca_y_modelo character varying(200),
    serial character varying(200),
    ubicacion character varying(150) NOT NULL,
    color character varying(80),
    observacion text,
    estado character varying(50) NOT NULL,
    caracteristicas character varying(200),
    cantidad integer,
    CONSTRAINT pk_inventario PRIMARY KEY (id_inventario)
);

CREATE INDEX idx_inventario_ubicacion ON public.inventario (ubicacion);

CREATE TABLE IF NOT EXISTS public.dispositivos (
    id serial NOT NULL,
    ip character varying(20) NOT NULL,
    mac character varying(20) NOT NULL,
    interfaz character varying(20) NOT NULL,
    host character varying(20) NOT NULL,
    responsable character varying(100) NOT NULL,
    CONSTRAINT dispositivos_pkey PRIMARY KEY (id)
);

CREATE UNIQUE INDEX IF NOT EXISTS dispositivos_ip_unique
    ON public.dispositivos (ip);

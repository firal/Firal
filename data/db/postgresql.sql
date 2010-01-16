CREATE TABLE users
(
  id integer NOT NULL,
  "name" character varying(100) NOT NULL,
  email character varying(100) NOT NULL,
  "role" character varying(20) NOT NULL,
  "password" character varying(100) NOT NULL,
  CONSTRAINT users_id PRIMARY KEY (id),
  CONSTRAINT users_name UNIQUE (name)
);
CREATE TABLE config
(
  "name" character varying(50) NOT NULL,
  "value" character varying(200) NOT NULL,
  CONSTRAINT configs_name PRIMARY KEY (name)
)
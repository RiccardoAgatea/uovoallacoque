CREATE TABLE ricette (
  id INT AUTO_INCREMENT,
  nome VARCHAR(256) NOT NULL,
  difficolta TINYINT UNSIGNED NOT NULL,
  tempo SMALLINT UNSIGNED NOT NULL,
  -- url dell'immagine, embeddata come <img>:
  img VARCHAR(256) NOT NULL,
  portata TINYINT UNSIGNED NOT NULL,
  ingredienti TEXT NOT NULL,
  procedimento TEXT NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (nome)
);
CREATE TABLE utenti (
  id INT AUTO_INCREMENT,
  -- url della foto dell'utente, embeddata come <img>:
  img VARCHAR(256),
  email VARCHAR(256) NOT NULL,
  passw VARCHAR(256) NOT NULL,
  nickname VARCHAR(256) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (email),
  UNIQUE (nickname)
);
CREATE TABLE voti (
  utente INT,
  ricetta INT,
  voto TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (utente, ricetta),
  FOREIGN KEY (utente) REFERENCES utenti (id),
  FOREIGN KEY (ricetta) REFERENCES ricette (id)
);
CREATE TABLE commenti (
  id INT AUTO_INCREMENT,
  utente INT,
  ricetta INT,
  contenuto VARCHAR(256) NOT NULL,
  dataeora DATETIME,
  PRIMARY KEY (id),
  FOREIGN KEY (utente) REFERENCES utenti (id),
  FOREIGN KEY (ricetta) REFERENCES ricette (id)
);

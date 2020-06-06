CREATE TABLE ricette (
  id INT AUTO_INCREMENT,
  nome VARCHAR(256) NOT NULL,
  difficolta TINYINT UNSIGNED NOT NULL,
  tempo SMALLINT UNSIGNED NOT NULL,
  -- url dell'immagine, embeddata come <img>:
  img VARCHAR(256) NOT NULL DEFAULT "<rootFolder />/img/ricette/default.png",
  portata TINYINT UNSIGNED NOT NULL,
  ingredienti TEXT NOT NULL,
  procedimento TEXT NOT NULL,
  descript VARCHAR(256) NOT NULL,
  keywords VARCHAR(256) NOT NULL,
  author VARCHAR(256) NOT NULL,
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
  ad BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (id),
  UNIQUE (email),
  UNIQUE (nickname)
);
CREATE TABLE voti (
  utente INT,
  ricetta INT,
  voto TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (utente, ricetta),
  FOREIGN KEY (utente) REFERENCES utenti (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (ricetta) REFERENCES ricette (id) ON DELETE CASCADE ON UPDATE CASCADE 
);
CREATE TABLE commenti (
  id INT AUTO_INCREMENT,
  utente INT,
  ricetta INT,
  contenuto VARCHAR(256) NOT NULL,
  dataeora DATETIME,
  modificato BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (id),
  FOREIGN KEY (utente) REFERENCES utenti (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (ricetta) REFERENCES ricette (id) ON DELETE CASCADE ON UPDATE CASCADE
);

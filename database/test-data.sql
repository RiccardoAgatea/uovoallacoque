INSERT INTO ricette (nome, difficolta, tempo, img, portata)
VALUES
  (
    'Carbonara',
    2,
    15,
    "<rootFolder />/img/ricette/default.png",
    1
  ),
  (
    'Omelette',
    3,
    5,
    "<rootFolder />/img/ricette/default.png",
    2
  ),
  (
    'Uovo sodo',
    1,
    8,
    "<rootFolder />/img/ricette/default.png",
    2
  ),
  (
    'Crema pasticcera',
    3,
    15,
    "<rootFolder />/img/ricette/default.png",
    3
  );
INSERT INTO utenti (email, passw, nickname)
VALUES
  (
    "rosalinda.puccipucci@gmail.com",
    "fragola",
    "Tenebrina634"
  ),
  (
    "assunta.incielo@libero.it",
    "pentecoste",
    "SacroCuoreDiMaria"
  ),
  (
    "american.people@gmail.com",
    "idiot",
    "PastaAlSugoConLaPanna"
  );
INSERT INTO voti (utente, ricetta, voto)
VALUES
  (1, 1, 5),
  (1, 2, 3),
  (1, 3, 4),
  (1, 4, 3),
  (2, 1, 3),
  (2, 2, 4),
  (2, 3, 5),
  (2, 4, 2),
  (3, 1, 1),
  (3, 2, 2),
  (3, 3, 3),
  (3, 4, 2);

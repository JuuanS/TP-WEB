INSERT INTO `roles` (`id`, `role_name`) VALUES 
(1,'ADMIN'), (2,'USER');

INSERT INTO `users` (`user_name`,`email`,`password`, `role_id`) VALUES 
('user', 'usuarioprueba@email.com', '123456', 2),
('admin', 'adminprueba@email.com', '123456', 1);

INSERT INTO `movie_status` (`id`,`status_name`) VALUES 
(0, 'NO VISTA'),
(1, 'VISTA'),
(2, 'PARA VER'),
(3, 'ABANDONADA'),
(4, 'NO VOY A VERLA');

INSERT INTO `categories` (`category_name`) VALUES
('Acción'),
('Aventuras'),
('Ciencia Ficción'),
('Comedia'),
('Drama'),
('Fantasía'),
('Musical'),
('Suspenso'),
('Terror');

INSERT INTO `movies` (`movie_title`, `movie_description`, `category_id`) VALUES
('Gladiator', 'En el año 180 el Imperio Romano controla todo el mundo conocido hasta la fecha. Máximo, interpretado por el ya conocido Russell Crowe, es un General romano muy importante para el Emperador Marco Aurelio, pues sólo él ha conseguido victoria tras victoria, destacando por su valentía, dedicación y lealtad al Imperio. Cómodo, el hijo de Marco Aurelio, está celoso del prestigio de Máximo y del amor que le profesa su padre, así que cuando asume el poder de manera inesperada, ordena el arresto y la ejecución del general. Máximo consigue escapar de sus opresores, pero no puede impedir que asesinen a su familia. Posteriormente, es capturado por un mercader de esclavos y se convierte en gladiador, preparándose para su venganza.', 1),
('El Caballero Oscuro', 'Después de derrotar a la Orden de las Sombras y frustrar al jefe de la mafia Carmine Falcone en Batman Begins, Bruce Wayne vuelve a enfundarse el traje del hombre murciélago para combatir el crimen en Gotham.', 1),
('Vengadores: Infinity War', 'Un nuevo peligro acecha procedente de las sombras del cosmos. Thanos, el infame tirano intergaláctico, tiene como objetivo reunir las seis Gemas del Infinito, artefactos de poder inimaginable, y usarlas para imponer su perversa voluntad a toda la existencia. Los Vengadores y sus aliados tendrán que luchar contra el mayor villano al que se han enfrentado nunca, y evitar que se haga con el control de la galaxia. En su nueva e impactante aventura, el destino de la Tierra nunca había sido más incierto, las Gemas del Infinito estarán en juego, unos querrán protegerlas y otros controlarlas, ¿quién ganará?', 1);

INSERT INTO `movies` (`movie_title`, `movie_description`, `category_id`) VALUES
('El Rey León', 'Recuperación del clásico de Disney de 1994, adaptado a las nuevas generaciones gracias a la tecnología 3-D. La productora de animación sigue así el camino que emprendió con La bella y la bestia de adaptar sus cintas más populares a dicha tecnología para que los nuevos espectadores puedan disfrutarla mejor (y sacar de paso rendimiento, ahora que estamos en época de crisis, a las apuestas seguras de su fondo de armario).', 2),
('El Señor de los Anillos: La Comunidad del Anillo', 'La trilogía del Señor de los Anillos se estrenó en 2001 con La Comunidad del Anillo, le siguió Las dos torres en 2002 y acabó con El retorno del Rey en 2003.', 2),
('Star Wars : Episodio V - El imperio contraataca', 'Luke Skywalker junto a R2D2 acuden al planeta Dagobah para que el legendario maestro Yoda, le convierta en un verdadero maestro Jedi. Mientras, el astuto piloto Han Solo, la valiente princesa Leia y el simpático C3PO destruyen la Estrella de la Muerte. Parece que todo ha terminado, pero el terrible Lord Darth Vader ha escapado, sigue vivo y prepara una trampa para las tropas imperiales. Además hará todo lo posible por que el joven Luke se pase al lado oscuro.', 2);

INSERT INTO `movies` (`movie_title`, `movie_description`, `category_id`) VALUES
('Blade Runner', 'Año 2019, la ciudad de Los Ángeles es un lugar oscuro y decadente, un abismo dominado por enormes rascacielos y grandes carteles de neón. Rick Deckard (Harrison Ford) es un blade runner, un agente de policía destinado al retiro de replicantes ilegales. Su misión es dar caza a un grupo de cuatro de estos androides, sofisticados NEXUS 6 superiores en fuerza e inteligencia a los humanos, pero diseñados para vivir una corta existencia de cuatro años. Este grupo, que ha huido de una colonia espacial y ha entrado en la Tierra con intenciones desconocidas, está liderado por el especialmente peligroso e inteligente Roy Batty (Rutger Hauer).', 3),
('Origen', 'Dom Cobb (Leonardo DiCaprio) es el mejor extractor. Su oficio consiste en introducirse en los sueños de sus víctimas y extraerle secretos del mundo de los negocios para luego venderlos con grandes dividendos. Debido a sus arriesgados métodos, grandes consorcios lo tienen en la mirilla, y ningún escondite le ofrece seguridad. No puede regresar a los Estados Unidos donde sus hijos le esperan.', 3),
('Regreso al futuro', 'La cinta transcurre en el año 1985, una época en la que el joven Marty McFly lleva una existencia anónima con su novia Jennifer. Los únicos problemas son su familia en crisis y un director al que le encantaría expulsarle del instituto, por lo que deberá hacer todo lo que esté en su mano para revertir esa situación y aparentar total normalidad. Amigo del excéntrico profesor Emmett Brown, una noche le acompaña a probar su nuevo experimento: viajar en el tiempo usando un DeLorean modificado. Sin duda alguna, se trata de una investigación realmente arriesgada pero que puede aportarles un enorme éxito en el futuro. No obstante, la prueba sale aún peor de lo esperado: unos traficantes de armas llegan y asesinan al científico. Marty se refugia en el coche y aparece transportado hasta 1955.', 3),
('Interstellar', 'Inspirada en la teoría del experto en relatividad Kip Stepehen Thorne sobre la existencia de los agujeros de gusano, y su función como canal para llevar a cabo los viajes en el tiempo. La historia gira en torno a un grupo de intrépidos exploradores que se adentran por uno de esos agujeros y viajan a través del mismo, encontrándose en otra dimensión. Un mundo desconocido se abre ante ellos y deberán luchar por mantenerse unidos si quieren volver de una pieza.', 3);

INSERT INTO `movies` (`movie_title`, `movie_description`, `category_id`) VALUES
('El Resplandor', 'Basada en la novela del maestro del terror Stephen King, El Resplandor tiene como protagonista a Jack Torrance (Jack Nicholson), un hombre casado y con un hijo, Danny (Danny Lloyd). Un día, Jack acepta un puesto como vigilante en un aislado hotel. El trabajo consiste en pasar todo el invierno allí con su familia, cuidando del recinto. La familia se muda allí, pero lo que no sospechan es que sus vidas van a cambiar en cuanto crucen la puerta del hotel.', 9),
('El Exorcista', 'En Iraq, el Padre Merrin queda profundamente turbado por el descubrimiento de una figurilla del demonio Pazuzu y las macabras visiones que ésta provoca. Mientras tanto, en Washington, en la casa de la actriz Chris MacNeil se están produciendo extraños fenómenos: la despiertan extraños sonidos que vienen del granero y su hija Regan se queja de que su cama se mueve. Algunos días más tarde, Regan interrumpe una recepción organizada por Chris amenazando de muerte al realizador Burke Dennings.', 9);
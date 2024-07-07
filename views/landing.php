<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TattoStudioINK</title>
    <link rel="stylesheet" href="../assets/css/landing.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish&display=swap">
</head>
<body>
    <header>
        <a href="#" class="logo">TattoStudioINK</a>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#nosotros">Nosotros</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#tatuadores">Tatuadores</a></li>
                <li>
                    <a href="#">Mi Cuenta &#x25BE;</a>
                    <ul class="dropdown">
                        <li><a href="micuenta.php">Mis Reservas</a></li>
                        <li><a href="#" id="logoutLink" data-bs-toggle="modal" data-bs-target="#logoutModal">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <!-- Modal de confirmación de cierre de sesión -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirmar Cierre de Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas cerrar sesión?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-dark" id="confirmLogout">Salir</button>
                </div>
            </div>
        </div>
    </div>


    <div class="zona1 d-flex justify-content-center ">
        <div class="container text-center ">
            <div class="row mb-4">
                <div class="col">
                    <h1 class="title">TattoStudioINK</h1>
                    <p class="p-custom">
                        "Nacemos desde el amor a la tinta, al arte y todos sus variantes, para poder regarlo por toda
                        Santiago
                        en general. Entregando trabajos de calidad y que perduren en el tiempo."</p>

                </div>
            </div>
            <a class="button-custom" href="#tatuadores">Agenda tu Hora</a>
        </div>
    </div>

    <div id="nosotros" class="zona2  d-flex justify-content-center ">
        <div class="container text-center ">
            <p class="p-custom1">ESTUDIO DE TATUAJES Y PERFORACIONES</p>
            <div class="row g-5">
                <div class="col-sm-6 col-md-8">
                    <p class="title-custom">Sobre Nosotros</p>
                    <p class="p-custom2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Beatae eum facilis
                        distinctio obcaecati
                        tempore asperiores suscipit debitis, exercitationem animi molestiae officiis magnam est ipsa
                        dolore vel magni nulla eaque accusantium iusto, nihil voluptatibus id, ducimus itaque similique.
                        Laudantium culpa consequuntur</p>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="container-icons">
                                    <p class="p-icons">+4500 Tattos</p>
                                    <img src="../assets/img/landing/machine.png" alt="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="container-icons">
                                    <p class="p-icons">+500 Piercings</p>
                                    <img src="../assets/img/landing/piercing.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-6 col-md-4">
                    <img class="imagen-custom p-2" src="../assets/img/landing/about2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>

    <div id="servicios" class="zona3 d-flex justify-content-center ">
        <div class="container text-center ">
            <div class="row">
                <div class="col">
                    <h1 class="title-custom3">Nuestros Servicios</h1>
                    <p class="p-custom3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias voluptatibus porro soluta
                        totam minima velit magni, provident earum. Quia dolorum recusandae voluptatem iure itaque
                        provident cumque adipisci fugiat illum explicabo!</p>
                </div>

                <div class="container px-4 text-center">
                    <div class="row gx-3">
                        <div class="col">
                            <div class="container-icons">
                                <div class="card-giratoria">
                                    <div class="card-inner">
                                        <div class="card-front">
                                            <img src="../assets/img/landing/card-tatto.jpg" alt="Imagen">
                                        </div>
                                        <div class="card-back">
                                            <h2>TATUAJES</h2>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias
                                                voluptatibus porro soluta totam minima velit magni, provident earum.
                                                Quia dolorum recusandae voluptatem iure itaque provident cumque adipisci
                                                fugiat illum explicabo!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="container-icons">
                                <div class="card-giratoria">
                                    <div class="card-inner">
                                        <div class="card-front">
                                            <img src="../assets/img/landing/card-piercing.jpg" alt="Imagen">
                                        </div>
                                        <div class="card-back">
                                            <h2>PIERCINGS</h2>
                                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab, dolorem
                                                mollitia ad temporibus repudiandae cupiditate earum fugit explicabo ex
                                                provident corrupti itaque eos magni nesciunt in? Minus harum inventore
                                                doloribus!
                                                Accusamus, rerum suscipit eligendi ea laboriosam aliquid omnis harum
                                                cumque, nihil earum eaque ducimus officia? Excepturi impedit beatae
                                                alias, ipsa ea voluptates, quam nobis molestiae minima asperiores, ut
                                                quaerat velit?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="tatuadores" class="zona4 d-flex justify-content-center">
        <div class="text-center">
            <div class="col">
                <h1 class="title-custom4">Tatuadores</h1>
            </div>

            <div class="px-1 text-center">
                <div class="row justify-content-between">
                    <!-- Añade la clase justify-content-between aquí -->
                    <?php
                    // Conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "tattoo_studio";
    
                    // Crea la conexión
                    $conn = new mysqli($servername, $username, $password, $database);
    
                    // Verifica la conexión
                    if ($conn->connect_error) {
                        die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
                    }
    
                    /// Realizar la consulta a la base de datos para obtener los datos de los tatuadores
                    $sql = "SELECT id, nombre, estilos, imagen_perfil FROM tatuadores";
                    $resultado = $conn->query($sql);
    
                    // Verificar si se obtuvieron resultados
                    if ($resultado->num_rows > 0) {
                        // Mostrar los datos de los tatuadores
                        while ($row = $resultado->fetch_assoc()) {
                            echo '<div class="col-md-3">'; // Utiliza col-md-3 para que haya 4 columnas en una fila en pantallas medianas
                            echo '<div>';
                            echo '<article class="card__article">';
                            echo '<img src="' . $row["imagen_perfil"] . '" alt="' . $row["nombre"] . '" class="card__img">';
                            echo '<div class="card__data">';
                            echo '<span class="card__description">' . $row["estilos"] . '</span>';
                            echo '<h2 class="card__title">' . $row["nombre"] . '</h2>';
                            echo '<a href="tatuador_detalle.php?id=' . $row["id"] . '" class="button-custom2">Ver Trabajos</a>';
                            echo '</div>';
                            echo '</article>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "No se encontraron tatuadores.";
                    }
    
                    // Cierra la conexión a la base de datos
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="zona3 d-flex justify-content-center ">
        <div class="container text-center ">
            <div class="row">
                <div class="col">
                    <h1 class="title-custom3">Preguntas Frecuentes</h1>

                    <div class="faq-container">
                        <details>
                            <summary>
                                <span class="faq-title">
                                    ¿Qué es TattoStudioInk y cómo funciona?
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="expand-icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 6l6 6l-6 6"></path>
                                </svg>
                            </summary>
                            <div class="faq-content">
                                TattoStudioInk es una plataforma en línea diseñada para facilitar la conexión entre
                                clientes interesados en obtener tatuajes y tatuadores profesionales disponibles en
                                estudios de tatuajes. Funciona como un intermediario digital que permite a los clientes
                                explorar perfiles de tatuadores, solicitar cotizaciones, reservar citas y gestionar sus
                                servicios de tatuaje, todo en un solo lugar.
                            </div>
                        </details>
                        <details>
                            <summary>
                                <span class="faq-title">
                                    ¿Cómo beneficia TattoStudioInk a los clientes?
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="expand-icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 6l6 6l-6 6"></path>
                                </svg>
                            </summary>
                            <div class="faq-content">
                                TattoStudioInk beneficia a los clientes al ofrecerles una forma conveniente de
                                encontrar y comunicarse con tatuadores profesionales, facilitando la búsqueda de
                                información sobre estilos de trabajo, disponibilidad y precios. Además, les permite
                                reservar citas en línea y gestionar sus servicios de manera eficiente, ahorrando tiempo
                                y esfuerzo.
                            </div>
                        </details>
                        <details>
                            <summary>
                                <span class="faq-title">¿Qué diferencia a TattoStudioInk de otras plataformas similares?

                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="expand-icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 6l6 6l-6 6"></path>
                                </svg>
                            </summary>
                            <div class="faq-content">Lo que diferencia a TattoStudioInk es nuestra atención al
                                detalle y nuestro enfoque en la experiencia del usuario. Nuestra plataforma está
                                diseñada para ser intuitiva y fácil de usar, tanto para clientes como para tatuadores.
                                Además, ofrecemos una amplia gama de funcionalidades, como sistema de cotización,
                                reserva de citas y gestión de perfiles, todo en un solo lugar, lo que hace que sea la
                                opción ideal para aquellos que buscan una solución integral para la conexión entre
                                clientes y tatuadores.
                            </div>
                        </details>
                        <details>
                            <summary>
                                <span class="faq-title">¿Qué tipo de información puedo encontrar en los perfiles de los
                                    tatuadores?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="expand-icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 6l6 6l-6 6"></path>
                                </svg>
                            </summary>
                            <div class="faq-content">En los perfiles de los tatuadores, los usuarios pueden encontrar
                                información detallada sobre su experiencia, estilo de trabajo, áreas de especialización
                                y portfolio de trabajos anteriores.</div>
                        </details>
                        <details>
                            <summary>
                                <span class="faq-title">¿Cómo puedo pagar por mis servicios de tatuaje a través de
                                    TattoStudioInk?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="expand-icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 6l6 6l-6 6"></path>
                                </svg>
                            </summary>
                            <div class="faq-content">Ofrecemos varias opciones de pago convenientes para tus servicios
                                de tatuaje. Puedes pagar en línea a través de nuestra plataforma utilizando tarjetas de
                                crédito/débito, servicios de pago en línea seguros como PayPal, y además, recuerda que
                                para confirmar tu reserva, se requiere un pago inicial que corresponde al 15% del costo
                                total del servicio. Además, algunos tatuadores pueden ofrecer la opción de pagar en
                                persona en el estudio el día de tu cita.</div>
                        </details>
                    </div>
                </div>


            </div>
        </div>
    </div>

    
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        document.getElementById('confirmLogout').addEventListener('click', function() {
            window.location.href = '../index.php';
        });
    </script>
    <script>
        class Accordion {
            constructor(el) {
                this.el = el;
                this.summary = el.querySelector("summary");
                this.content = el.querySelector(".faq-content");
                this.expandIcon = this.summary.querySelector(".expand-icon");
                this.animation = null;
                this.isClosing = false;
                this.isExpanding = false;
                this.summary.addEventListener("click", (e) => this.onClick(e));
            }

            onClick(e) {
                e.preventDefault();
                this.el.style.overflow = "hidden";

                if (this.isClosing || !this.el.open) {
                    this.open();
                } else if (this.isExpanding || this.el.open) {
                    this.shrink();
                }
            }

            shrink() {
                this.isClosing = true;

                const startHeight = `${this.el.offsetHeight}px`;
                const endHeight = `${this.summary.offsetHeight}px`;

                if (this.animation) {
                    this.animation.cancel();
                }

                this.animation = this.el.animate({
                    height: [startHeight, endHeight],
                }, {
                    duration: 200,
                    easing: "ease-out",
                });

                this.animation.onfinish = () => {
                    this.expandIcon.setAttribute("src", "assets/plus.svg");
                    return this.onAnimationFinish(false);
                };
                this.animation.oncancel = () => {
                    this.expandIcon.setAttribute("src", "assets/plus.svg");
                    return (this.isClosing = false);
                };
            }

            open() {
                this.el.style.height = `${this.el.offsetHeight}px`;
                this.el.open = true;
                window.requestAnimationFrame(() => this.expand());
            }

            expand() {
                this.isExpanding = true;

                const startHeight = `${this.el.offsetHeight}px`;
                const endHeight = `${this.summary.offsetHeight + this.content.offsetHeight}px`;

                if (this.animation) {
                    this.animation.cancel();
                }

                this.animation = this.el.animate({
                    height: [startHeight, endHeight],
                }, {
                    duration: 200,
                    easing: "ease-out",
                });

                this.animation.onfinish = () => {
                    this.expandIcon.setAttribute("src", "assets/minus.svg");
                    return this.onAnimationFinish(true);
                };
                this.animation.oncancel = () => {
                    this.expandIcon.setAttribute("src", "assets/minus.svg");
                    return (this.isExpanding = false);
                };
            }

            onAnimationFinish(open) {
                this.el.open = open;
                this.animation = null;
                this.isClosing = false;
                this.isExpanding = false;
                this.el.style.height = this.el.style.overflow = "";
            }
        }

        document.querySelectorAll("details").forEach((el) => {
            new Accordion(el);
        });

        window.addEventListener("scroll", function() {
            var header = document.querySelector("header");
            header.classList.toggle("abajo", window.scrollY > 0);
        });
    </script>
</body>
</html>
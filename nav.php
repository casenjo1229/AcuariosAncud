<div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="./index.php"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__widget">
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Inicio</a></li>
                <li><a href="./productos.php">Productos</a></li>
                <li><a href="./blog.php">Blog</a></li>
                <li><a href="./contacto.php">Contacto</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="https://www.facebook.com/acuariosancudchiloe" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i><a class="text-dark" href="mailto:acuariosancudchiloe@acuariosancud.cl">acuariosancudchiloe@acuariosancud.cl</a></li>
            </ul>
        </div>
    </div>

    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> <a class="text-dark" href="mailto:acuariosancudchiloe@acuariosancud.cl">acuariosancudchiloe@acuariosancud.cl</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="https://www.facebook.com/acuariosancudchiloe" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" class="w-25" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9 d-flex justify-content-end">
                    <nav class="header__menu">
                        <ul>
                            <?php
                                switch($_SESSION['pagina']){
                                    case "inicio": echo "
                                                    <li class='active'><a href='./index.php'>Inicio</a></li>
                                                    <li><a href='./productos.php?id=1'>Productos</a></li>
                                                    <li><a href='./blog.php'>Blog</a></li>
                                                    <li><a href='./contacto.php'>Contacto</a></li>
                                                ";
                                        break;
                                    case "productos": echo "
                                                    <li><a href='./index.php'>Inicio</a></li>
                                                    <li class='active'><a href='./productos.php?id=1'>Productos</a></li>
                                                    <li><a href='./blog.php'>Blog</a></li>
                                                    <li><a href='./contacto.php'>Contacto</a></li>
                                                ";
                                        break;
                                    case "blog": echo "
                                                    <li><a href='./index.php'>Inicio</a></li>
                                                    <li><a href='./productos.php?id=1'>Productos</a></li>
                                                    <li class='active'><a href='./blog.php'>Blog</a></li>
                                                    <li><a href='./contacto.php'>Contacto</a></li>
                                                ";
                                        break;
                                    case "contacto": echo "
                                                    <li><a href='./index.php'>Inicio</a></li>
                                                    <li><a href='./productos.php?id=1'>Productos</a></li>
                                                    <li><a href='./blog.php'>Blog</a></li>
                                                    <li class='active'><a href='./contacto.php'>Contacto</a></li>
                                                ";
                                }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>

    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Categorias</span>
                        </div>
                        <ul>
                        <?php 
                            $consulta = "SELECT * FROM familias";
                            $resultado = mysqli_query( conectar(), $consulta );
                            while ($columna = mysqli_fetch_array( $resultado ))
                            {
                                ?>
                                    <li><a href="productos.php?id=<?=$columna['id_familia']?>"><?=$columna['familia']?></a></li>
                                <?php
                            }
                        ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form id="Search">
                                <input type="text" placeholder="¿Que necesitas?" id="buscar">
                                <button type="submit" class="site-btn">Buscar</button>
                            </form>
                        </div>
                        <div class="hero__search__phone d-flex align-items-center">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5><a class="text-dark" href="https://web.whatsapp.com/send?phone=56939110640&text=Hola, quiero consultar por un producto!" target="_blank">+56 9 39110640</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class=" container-fluid  ">
                    <a class="navbar-brand" href=""> Painel de Controle </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="./dashboard.php" class="nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-palette"></i>
                                    <span class="d-lg-none">Dashboard</span>
                                </a>
                            </li>

                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="no-icon">Ações</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST;?>/consulta/#">
                                        <i class="nc-icon nc-cloud-download-93"></i>
                                        Exportar Excel</a>
                                    <div class="divider"></div>
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST;?>/email/sendemail">
                                        <i class="nc-icon nc-send"></i>
                                        Enviar E-mail</a>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-1">
                            <li class="nav-item">
                                <a class="nav-link nav-item" href="http://<?php echo APP_HOST;?>/login/sair">
                                    <i class="nc-icon nc-button-power"></i>
                                    <span class="ml-lg-1"></span>
                                    Sair
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
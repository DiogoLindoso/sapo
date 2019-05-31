            <footer class="footer">
                <div class="container">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
        </div><!--End div main painel-->
    </div><!--End div wrapper-->

<!-- Notificações-->
<?php 
    use App\Lib\Sessao;
    if(Sessao::existeMensagem()){
        echo    "<script>
                    window.addEventListener('load', function(){
                        alerta.showNotification('{$_SESSION['msg']}','{$_SESSION['msg-type']}');
                    });
                </script>";
        Sessao::limparMensagem();
        //unset($_SESSION['msg']);
        //unset($_SESSION['msg-type']);
    }


?>
<!-- Fim Notificações-->



</body>
<!--   Core JS Files   -->
<script src="http://<?php echo APP_HOST; ?>/public/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="http://<?php echo APP_HOST; ?>/public/js/core/popper.min.js" type="text/javascript"></script>
<script src="http://<?php echo APP_HOST; ?>/public/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="http://<?php echo APP_HOST; ?>/public/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->
<!--  Chartist Plugin  -->
<script src="http://<?php echo APP_HOST; ?>/public/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="http://<?php echo APP_HOST; ?>/public/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="http://<?php echo APP_HOST; ?>/public/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="http://<?php echo APP_HOST; ?>/public/js/demo.js"></script>
<!-- Consulta de registros ajax-->
<script src="http://<?php echo APP_HOST; ?>/public/js/consulta_reg_banco.js" type="text/javascript"></script>
<script src="http://<?php echo APP_HOST; ?>/public/js/alerta.js" type="text/javascript"></script>
<script src="http://<?php echo APP_HOST; ?>/public/js/jquery.mask.min.js" type="text/javascript"></script>
<script src="http://<?php echo APP_HOST; ?>/public/js/mask-cpf.js" type="text/javascript"></script>

<script src="http://<?php echo APP_HOST; ?>/public/js/teste-conexao.js" type="text/javascript"></script>
</html>

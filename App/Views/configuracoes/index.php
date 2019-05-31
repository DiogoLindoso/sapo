             <!-- End Navbar -->
             <div class="content">
                <div class="container-fluid">
                    <div class="section">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Seus dados de acesso ao portal Carolina Bori</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="http://<?php echo APP_HOST;?>/configuracoes/salvar">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>CPF</label>
                                                    <input type="text" id="cpf" class="form-control"  placeholder="000.000.000-00" <?php echo 'value="'.$_POST['cpf'].'"'; ?> name="cpf">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label>Senha</label>
                                          
                                                    
                                                    <div class="input-group  p-0">
                                                       
                                                    <input type="password" class="form-control" placeholder="Senha" <?php  echo(isset($_POST['senha'])) ? "value='{$_POST['senha']}'" : ''; ?> name="senha">
                                                        
                                                    <div class="input-group-btn pull-right" href="http://<?php echo APP_HOST;?>/configuracoes/testeconexao">
                                                        <button id="bt-teste" class="btn btn-info btn-fill m-0">Testar Conexão</button>
                                                    </div>
                                                </div>
                                      
                                        </div>
                                            </div><!-- fim div row-->
                                        </div><!-- fim div card-body-->
                                    </div><!-- fim div card-->
                                         
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Email para recebimento dos dados</h5>
                                        </div>
                                        <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Nome</label>
                                                    <input type="text" class="form-control" placeholder="Nome" 
                                                    <?php echo "value={$_POST['nome']}";?> name="nome">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Sobrenome</label>
                                                    <input type="text" class="form-control" placeholder="Sobrenome" <?php echo "value={$_POST['sobrenome']}"; ?> name="sobrenome">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input type="email" name="email" class="form-control" placeholder="Email"<?php echo "value={$_POST['email']}"; ?>>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Salvar</button>

                                        <div class="clearfix"></div>
                                    </form>
                                </div><!-- fim div card-body-->
                            </div><!-- fim div card-->
                        </div>
                    </div><!-- fim section-->
                </div><!-- fim container fluid-->
            </div><!-- fim content-->
 <!--footer-->
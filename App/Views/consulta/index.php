<div class="content">
    <div class="container-fluid">
        <div class="section consulta">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">Consulta</h4>
                    <a href="#">
                        <button id="atualizarDados" class="btn btn-info btn-fill pull-right">
                            Atualizar Dados
                        </button>
                    </a>
                    <p class="card-category">Realizada no Portal Carolina Bori</p>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Curso</th>
                                <th>Nome</th>
                                <th>Prazo para Análise</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(isset($data) && !empty($data)){
                                foreach($data as $processo){
                                    echo"<tr>";
                                        echo"<td>{$processo->tipo}</td>";
                                        echo"<td>{$processo->curso}</td>";
                                        echo"<td>{$processo->nome}</td>";
                                        echo"<td>{$processo->prazo_analize}</td>";
                                    echo"</tr>";
                                }             
                            }else{
                                echo"<tr>";
                                    echo"<td>Vazio</td>";
                                    echo"<td>Vazio</td>";
                                    echo"<td>Vazio</td>";
                                    echo"<td>Vazio</td>";
                                echo"</tr>";
                            }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
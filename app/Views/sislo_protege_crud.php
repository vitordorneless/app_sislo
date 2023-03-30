<div class="card">
    <div class="card-header">
        <h3 class="card-title">Arquivo Senhas Protege!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_protege_crud" name="sislo_protege_crud" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Fixo</label>
                        <input type="text" required="required" id="fixo" name="fixo" autofocus="autofocus" class="form-control" value="<?= $fixo; ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                        <input type="hidden" id="idsislo_protege" name="idsislo_protege" class="form-control" value="<?= $idsislo_protege; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Dependência</label>
                        <input type="text" required="required" id="dependencia" name="dependencia" class="form-control" value="<?= $dependencia; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Validade</label>
                        <input type="text" required="required" id="validade" name="validade" class="form-control" value="<?= $validade; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <h1 class="text text-sm text-center">Mês</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">JAN</label>
                        <input type="text" required="required" id="jan" name="jan" class="form-control" value="<?= $jan; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">FEV</label>
                        <input type="text" required="required" id="fev" name="fev" class="form-control" value="<?= $fev; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">MAR</label>
                        <input type="text" required="required" id="mar" name="mar" class="form-control" value="<?= $mar; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">ABR</label>
                        <input type="text" required="required" id="abr" name="abr" class="form-control" value="<?= $abr; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">MAI</label>
                        <input type="text" required="required" id="mai" name="mai" class="form-control" value="<?= $mai; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">JUN</label>
                        <input type="text" required="required" id="jun" name="jun" class="form-control" value="<?= $jun; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">JUL</label>
                        <input type="text" required="required" id="jul" name="jul" class="form-control" value="<?= $jul; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">AGO</label>
                        <input type="text" required="required" id="ago" name="ago" class="form-control" value="<?= $ago; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">SET</label>
                        <input type="text" required="required" id="set" name="set" class="form-control" value="<?= $set; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">OUT</label>
                        <input type="text" required="required" id="out" name="out" class="form-control" value="<?= $out; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">NOV</label>
                        <input type="text" required="required" id="nov" name="nov" class="form-control" value="<?= $nov; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">DEZ</label>
                        <input type="text" required="required" id="dez" name="dez" class="form-control" value="<?= $dez; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <h1 class="text text-sm text-center">Semana</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">SEG</label>
                        <input type="text" required="required" id="seg" name="seg" class="form-control" value="<?= $seg; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">TER</label>
                        <input type="text" required="required" id="ter" name="ter" class="form-control" value="<?= $ter; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">QUA</label>
                        <input type="text" required="required" id="qua" name="qua" class="form-control" value="<?= $qua; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">QUI</label>
                        <input type="text" required="required" id="qui" name="qui" class="form-control" value="<?= $qui; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">SEX</label>
                        <input type="text" id="sex" name="sex" required="required" class="form-control" value="<?= $sex; ?>">
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label class="text text-sm">SAB</label>
                        <input type="text" id="sab" name="sab" class="form-control" required="required" value="<?= $sab; ?>">
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label class="text text-sm">DOM</label>
                        <input type="text" id="dom" name="dom" class="form-control" required="required" value="<?= $dom; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <h1 class="text text-sm text-center">Dia</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">01</label>
                        <input type="text" id="d01" name="d01" required="required" class="form-control" value="<?= $d01; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">02</label>
                        <input type="text" id="d02" name="d02" required="required" class="form-control" value="<?= $d02; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">03</label>
                        <input type="text" id="d03" name="d03" required="required" class="form-control" value="<?= $d03; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">04</label>
                        <input type="text" id="d04" name="d04" required="required" class="form-control" value="<?= $d04; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">05</label>
                        <input type="text" id="d05" name="d05" required="required" class="form-control" value="<?= $d05; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">06</label>
                        <input type="text" id="d06" name="d06" required="required" class="form-control" value="<?= $d06; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">07</label>
                        <input type="text" id="d07" name="d07" required="required" class="form-control" value="<?= $d07; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">08</label>
                        <input type="text" id="d08" name="d08" required="required" class="form-control" value="<?= $d08; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">09</label>
                        <input type="text" id="d09" name="d09" required="required" class="form-control" value="<?= $d09; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">10</label>
                        <input type="text" id="d10" name="d10" required="required" class="form-control" value="<?= $d10; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">11</label>
                        <input type="text" id="d11" name="d11" required="required" class="form-control" value="<?= $d11; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">12</label>
                        <input type="text" id="d12" name="d12" required="required" class="form-control" value="<?= $d12; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">13</label>
                        <input type="text" id="d13" name="d13" required="required" class="form-control" value="<?= $d13; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">14</label>
                        <input type="text" id="d14" name="d14" required="required" class="form-control" value="<?= $d14; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">15</label>
                        <input type="text" id="d15" name="d15" required="required" class="form-control" value="<?= $d15; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">16</label>
                        <input type="text" id="d16" name="d16" required="required" class="form-control" value="<?= $d16; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">17</label>
                        <input type="text" id="d17" name="d17" required="required" class="form-control" value="<?= $d17; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">18</label>
                        <input type="text" id="d18" name="d18" required="required" class="form-control" value="<?= $d18; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">19</label>
                        <input type="text" id="d19" name="d19" required="required" class="form-control" value="<?= $d19; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">20</label>
                        <input type="text" id="d20" name="d20" required="required" class="form-control" value="<?= $d20; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">21</label>
                        <input type="text" id="d21" name="d21" required="required" class="form-control" value="<?= $d21; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">22</label>
                        <input type="text" id="d22" name="d22" required="required" class="form-control" value="<?= $d22; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">23</label>
                        <input type="text" id="d23" name="d23" required="required" class="form-control" value="<?= $d23; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">24</label>
                        <input type="text" id="d24" name="d24" required="required" class="form-control" value="<?= $d24; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">25</label>
                        <input type="text" id="d25" name="d25" required="required" class="form-control" value="<?= $d25; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">26</label>
                        <input type="text" id="d26" name="d26" required="required" class="form-control" value="<?= $d26; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">27</label>
                        <input type="text" id="d27" name="d27" required="required" class="form-control" value="<?= $d27; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">28</label>
                        <input type="text" id="d28" name="d28" required="required" class="form-control" value="<?= $d28; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">29</label>
                        <input type="text" id="d29" name="d29" required="required" class="form-control" value="<?= $d29; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">30</label>
                        <input type="text" id="d30" name="d30" required="required" class="form-control" value="<?= $d30; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">31</label>
                        <input type="text" id="d31" name="d31" required="required" class="form-control" value="<?= $d31; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-archive"></i>  Atualizar Dados
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>
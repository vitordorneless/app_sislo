<nav class="mt-2" style="font-size: 11px;">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-briefcase"></i>
                <p>
                    Menu
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('candidato_perfil'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Perfil</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('candidato_vagas'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Vagas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('candidato_vagas_aplicadas'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Vagas Aplicadas</p>
                    </a>
                </li>
                
            </ul>
        </li>
    </ul>
</nav>
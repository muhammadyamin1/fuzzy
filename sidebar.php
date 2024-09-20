<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
            <a href="dashboard.php">
                <i class="material-icons">dashboard</i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'variabel.php' ? 'active' : ''; ?>">
            <a href="variabel.php">
                <i class="material-icons">build</i>
                <span>Pengaturan Variabel</span>
            </a>
        </li>
        <li class="<?php echo strpos($_SERVER['PHP_SELF'], 'Tsukamoto.php') !== false || strpos($_SERVER['PHP_SELF'], 'GridK2.php') !== false || strpos($_SERVER['PHP_SELF'], 'GridK3.php') !== false ? 'active' : ''; ?>">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">settings</i>
                <span>Kelola Data</span>
            </a>
            <ul class="ml-menu">
                <li class="<?php echo strpos($_SERVER['PHP_SELF'], 'vPermintaanTsukamoto.php') !== false || basename($_SERVER['PHP_SELF']) == 'vStokTsukamoto.php' || basename($_SERVER['PHP_SELF']) == 'vProduksiTsukamoto.php' ? 'active' : ''; ?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>Fungsi Keanggotaan<br>Fuzzy Tsukamoto</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'vPermintaanTsukamoto.php' ? 'active' : ''; ?>">
                            <a href="vPermintaanTsukamoto.php">
                                <span>Variabel Permintaan</span>
                            </a>
                        </li>
                        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'vStokTsukamoto.php' ? 'active' : ''; ?>">
                            <a href="vStokTsukamoto.php">
                                <span>Variabel Stok</span>
                            </a>
                        </li>
                        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'vProduksiTsukamoto.php' ? 'active' : ''; ?>">
                            <a href="vProduksiTsukamoto.php">
                                <span>Variabel Produksi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo strpos($_SERVER['PHP_SELF'], 'GridK2.php') !== false ? 'active' : ''; ?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>Fungsi Keanggotaan<br>Fuzzy Grid Partition (K=2)</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'vPermintaanGridK2.php' ? 'active' : ''; ?>">
                            <a href="vPermintaanGridK2.php">
                                <span>Variabel Permintaan</span>
                            </a>
                        </li>
                        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'vStokGridK2.php' ? 'active' : ''; ?>">
                            <a href="vStokGridK2.php">
                                <span>Variabel Stok</span>
                            </a>
                        </li>
                        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'vProduksiGridK2.php' ? 'active' : ''; ?>">
                            <a href="vProduksiGridK2.php">
                                <span>Variabel Produksi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo strpos($_SERVER['PHP_SELF'], 'GridK3.php') !== false ? 'active' : ''; ?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>Fungsi Keanggotaan<br>Fuzzy Grid Partition (K=3)</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'vPermintaanGridK3.php' ? 'active' : ''; ?>">
                            <a href="vPermintaanGridK3.php">
                                <span>Variabel Permintaan</span>
                            </a>
                        </li>
                        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'vStokGridK3.php' ? 'active' : ''; ?>">
                            <a href="vStokGridK3.php">
                                <span>Variabel Stok</span>
                            </a>
                        </li>
                        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'vProduksiGridK3.php' ? 'active' : ''; ?>">
                            <a href="vProduksiGridK3.php">
                                <span>Variabel Produksi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo strpos($_SERVER['PHP_SELF'], 'RuleTsukamoto.php') !== false ? 'active' : ''; ?>">
                    <a href="RuleTsukamoto.php">
                        <span>Rule Fuzzy Tsukamoto</span>
                    </a>
                </li>
                <li class="<?php echo strpos($_SERVER['PHP_SELF'], 'RuleGridK2.php') !== false ? 'active' : ''; ?>">
                    <a href="RuleGridK2.php">
                        <span>Rule Fuzzy Grid Partition (K=2)</span>
                    </a>
                </li>
                <li class="<?php echo strpos($_SERVER['PHP_SELF'], 'RuleGridK3.php') !== false ? 'active' : ''; ?>">
                    <a href="RuleGridK3.php">
                        <span>Rule Fuzzy Grid Partition (K=3)</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'analisisMetode.php' ? 'active' : ''; ?>">
            <a href="analisisMetode.php">
                <i class="material-icons">sync</i>
                <span>Analisis Seluruh Metode</span>
            </a>
        </li>
        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : ''; ?>">
            <a href="users.php">
                <i class="material-icons">people</i>
                <span>Kelola Users</span>
            </a>
        </li>
    </ul>
</div>

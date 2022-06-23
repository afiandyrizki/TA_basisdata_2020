<?php
$year = date('Y');
?>
<style>
.blue{
	background-color: #6b8fba;
}

.green{
	background-color: #4a8251;
}

.yellow{
	background-color: #CACD72;
}

.red{
	background-color: #C56262;
}

.states-info .fa{
	font-size: 60px;
}

.states-info .glyphicon{
	font-size: 50px;
}
</style>
<div class="list-jenis">
	<div class="row states-info">

        <a href="?hal=admin-master/user/list-user" style="color: #fff;">
            <div class="col-md-3">
                <div class="panel blue">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-8">
                                <span class="state-title">Customers</span>
                                <h4><?=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM customer"));?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
		
		<a href="?hal=admin-master/kategori/list-kategori" style="color: #fff;">
            <div class="col-md-3">
                <div class="panel green">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </div>
                            <div class="col-xs-8">
                                <span class="state-title">FILM</span>
                                <h4><?=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM film"));?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
		
		<a href="?hal=admin-master/pembelian/pembelian" style="color: #fff;">
            <div class="col-md-3">
                <div class="panel yellow">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-shopping-basket"></i>
                            </div>
                            <div class="col-xs-8">
                                <span class="state-title">Orders</span>
                                <h4><?=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM transaksi"));?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
		
		<a href="?hal=admin-master/barang/info-barang" style="color: #fff;">
            <div class="col-md-3">
                <div class="panel red">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-cubes"></i>
                            </div>
                            <div class="col-xs-8">
                                <span class="state-title">Studio</span>
                                <h4><?=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM studio"));?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
		
    </div>
	
</div>
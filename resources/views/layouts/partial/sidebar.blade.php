<div class="sidebar">
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
{{-- 			<li class="nav-item has-treeview menu-open">
				<a href="#" class="nav-link active">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p>
						Starter Pages
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="#" class="nav-link active">
							<i class="far fa-circle nav-icon"></i>
							<p>Active Page</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Inactive Page</p>
						</a>
					</li>
				</ul>
			</li> --}}
			<li class="nav-item">
				<a href="{{ url('/') }}" class="nav-link">
					<i class="nav-icon fa fa-tachometer-alt"></i>
					<p>
						Dashboard
					</p>
				</a>
			</li>
{{-- 			<li class="nav-item">
				<a href="{{ action('MataKuliahController@index') }}" class="nav-link">
					<i class="nav-icon fa fa-book"></i>
					<p>
						Kurikulum
						<span class="right badge badge-danger">New</span>
					</p>
				</a>
			</li>	 --}}
			<li class="nav-item">
				<a href="{{ action('JadwalController@index') }}" class="nav-link">
					<i class="nav-icon fa fa-calendar"></i>
					<p>
						Jadwal Tutorial
						{{-- <span class="right badge badge-danger">New</span> --}}
					</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{ action('MahasiswaController@index') }}" class="nav-link">
					<i class="nav-icon fa fa-user"></i>
					<p>
						Mahasiswa
						{{-- <span class="right badge badge-danger">New</span> --}}
					</p>
				</a>
			</li>
			{{-- <li class="nav-item">
				<a href="{{ action('ReportController@index') }}" class="nav-link">
					<i class="nav-icon fa fa-file"></i>
					<p>
						Report
					</p>
				</a>
			</li> --}}

			<li class="nav-item has-treeview">
				<a href="#" class="nav-link">
					<i class="nav-icon fas fa-database"></i>
					<p>
						Data Master
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>
				<ul class="nav nav-treeview" style="display: none;">
					<li class="nav-item">
						<a href="{{ action('RefFakultasController@index') }}" class="nav-link">
							<p>Fakultas</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ action('RefJurusanController@index') }}" class="nav-link">
							<p>Jurusan</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ action('TutorController@index') }}" class="nav-link">
							<p>Tutor</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ action('LokasiTutorialController@index') }}" class="nav-link">
							<p>Lokasi Tutorial</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ action('MataKuliahController@index') }}" class="nav-link">
							<p>Matakuliah</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ action('KelasController@index') }}" class="nav-link">
							<p>Kelas</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ action('KeteranganLayananController@index') }}" class="nav-link">
							<p>Keterangan Layanan</p>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</nav>
	<!-- /.sidebar-menu -->
</div>

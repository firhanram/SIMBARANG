<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/dashboard') }}" class="brand-link text-center">
      <img src="{{ asset('admin/img/logo.png')}}" class="brand-image img-circle elevation-3"
      style="opacity: .8">
      <span class="brand-text font-weight-bold">Bintang Footwear</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ url('/dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Dashboard
              </p>
            </a>
          </li>
          {{-- data master --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/kategori') }}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Kategori Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/jenis') }}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Jenis Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/satuan') }}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Satuan Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/supplier') }}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Supplier</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- data transaksi --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-table nav-icon"></i>
              <p>
                Data Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/barang')}}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/barang_masuk')}}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/barang_keluar')}}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Barang Keluar</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- user --}}
          <li class="nav-item">
            <a href="{{ url('/user') }}" class="nav-link">
              <i class="fas fa-address-book nav-icon"></i>
              <p>
               User
              </p>
            </a>
          </li>
          {{-- laporan --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-book nav-icon"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/lap_barang_masuk')}}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/lap_barang_keluar')}}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Barang Keluar</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
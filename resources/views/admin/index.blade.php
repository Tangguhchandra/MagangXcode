<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .status.delivered { background: #28a745; color: #fff; padding: 4px 8px; border-radius: 4px; }
        .status.pending { background: #ffc107; color: #000; padding: 4px 8px; border-radius: 4px; }
        .status.return { background: #dc3545; color: #fff; padding: 4px 8px; border-radius: 4px; }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="caret-back-outline"></ion-icon>
                        </span>
                        <span class="title">XcodeAdmin</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.pendaftar') }}">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">List Pendaftar</span>
                    </a>
                </li>

               

                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    </form>

                </li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="main">
            <!-- Topbar -->
            <div class="topbar">
                <div class="toggle"><ion-icon name="menu-outline"></ion-icon></div>
                <div class="search"><label><input type="text" placeholder="Search here"><ion-icon name="search-outline"></ion-icon></label></div>
                <div class="user"><img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="User"></div>
            </div>

            <!-- Cards -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">{{ $total }}</div>
                        <div class="cardName">Total Pendaftar</div>
                    </div>
                    <div class="iconBx"><ion-icon name="person-add-outline"></ion-icon></div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">{{ $diterima }}</div>
                        <div class="cardName">Diterima</div>
                    </div>
                    <div class="iconBx"><ion-icon name="checkmark-circle-outline"></ion-icon></div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">{{ $pending }}</div>
                        <div class="cardName">Pending</div>
                    </div>
                    <div class="iconBx"><ion-icon name="time-outline"></ion-icon></div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">{{ $ditolak }}</div>
                        <div class="cardName">Ditolak</div>
                    </div>
                    <div class="iconBx"><ion-icon name="close-circle-outline"></ion-icon></div>
                </div>
            </div>

            <!-- Details -->
            <div class="details">
                <!-- Table -->
                <div class="recentPemagang">
                    <div class="cardHeader">
                        <h2>List Pendaftar</h2>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td>Nama</td>
                                <td>Instansi</td>
                                <td>CV</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendaftar as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->instansi }}</td>
                                    <td><a href="{{ asset('storage/' . $item->cv) }}" target="_blank">📄 Lihat CV</a></td>
                                    <td>
                                        <form action="{{ route('admin.updateStatus', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="px-2 py-1 bg-gray-100 rounded">
                                                <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="diterima" {{ $item->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Recent -->
                <div class="recentTerbaru">
                    <div class="cardHeader"><h2>Daftar Terbaru</h2></div>
                    <table>
                        @foreach ($recent as $item)
                            <tr>
                                <td width="60px">
                                    <div class="imgBx"><img src="{{ asset('storage/' . $item->foto) }}" alt="img"></div>
                                </td>
                                <td>
                                    <h4>{{ $item->nama }}<br><span>{{ $item->divisi }}</span></h4>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
  document.querySelectorAll(".navigation li").forEach((item) => {
    item.addEventListener("mouseover", function () {
      document.querySelectorAll(".navigation li").forEach((el) => el.classList.remove("hovered"));
      this.classList.add("hovered");
    });
  });

  let toggle = document.querySelector(".toggle");
  let navigation = document.querySelector(".navigation");
  let main = document.querySelector(".main");

  toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
  };
</script>
</body>
</html>

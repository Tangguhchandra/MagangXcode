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

         <!-- Dashboard -->
         <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
             <a href="{{ route('admin.dashboard') }}">
                 <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                 <span class="title">Dashboard</span>
             </a>
         </li>

         <!-- List Pendaftar -->
         <li class="{{ request()->is('admin/pendaftar*') ? 'active' : '' }}">
             <a href="{{ route('admin.pendaftar') }}">
                 <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                 <span class="title">List Pendaftar</span>
             </a>
         </li>

         <li class="{{ request()->is('admin/trash') ? 'active' : '' }}">
             <a href="{{ route('admin.trash') }}">
                 <span class="icon"><ion-icon name="trash-outline"></ion-icon></span>
                 <span class="title">History Pendaftar</span>
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

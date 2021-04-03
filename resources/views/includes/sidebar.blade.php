 <!-- Sidenav -->
 <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
     <div class="scrollbar-inner">
         <!-- Brand -->
         <div class="sidenav-header  align-items-center">
             <a class="" href="javascript:void(0)">
                 <img src="/assets/img/brand/blue.png" style="width: 200px; margin-top: 10px" alt="...">
             </a>
         </div>
         <div class="navbar-inner">
             <!-- Collapse -->
             <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                 <!-- Divider -->
                 @if (auth()->user()->role_id == 1)

                     <!-- Heading -->
                     <h6 class="navbar-heading p-0 text-muted">
                         <span class="docs-normal">Admin</span>
                     </h6>
                     <hr class="my-2">
                     <!-- Nav items -->
                     <ul class="navbar-nav">
                         <li class="nav-item">
                             <a class="nav-link" href="/dashboard/index">
                                 <i class="ni ni-tv-2 text-primary"></i>
                                 <span class="nav-link-text">Dashboard</span>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a class="nav-link" href="/dashboard/users">
                                 <i class="fas fa-users text-warning"></i>
                                 <span class="nav-link-text">Pendaftar</span>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a class="nav-link" href="/dashboard/pattient">
                                 <i class="ni ni-ambulance text-success"></i>
                                 <span class="nav-link-text">Pasien Rujukan</span>
                             </a>
                         </li>

                     </ul>
                     <!-- Divider -->
                     <!-- Heading -->
                     <h6 class="navbar-heading p-0 mt-3 text-muted">
                         <span class="docs-normal">Master</span>
                     </h6>
                     <hr class="my-2">
                     <!-- Nav items -->
                     <ul class="navbar-nav">
                         <li class="nav-item">
                             <a class="nav-link" href="/master/type_of_vaccination">
                                 <i class="fas fa-syringe text-warning"></i>
                                 <span class="nav-link-text">Jenis Vaksinasi</span>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a class="nav-link" href="/master/hospital">
                                 <i class="fas fa-hospital text-info"></i>
                                 <span class="nav-link-text">Rumah Sakit</span>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a class="nav-link" href="/master/barcode">
                                 <i class="fas fa-qrcode text-warning"></i>
                                 <span class="nav-link-text">Barcode</span>
                             </a>
                         </li>
                     </ul>
                 @endif

                 @if (auth()->user()->role_id == 2)
                     <!-- Heading -->
                     <h6 class="navbar-heading p-0 mt-3 text-muted">
                         <span class="docs-normal">User</span>
                     </h6>
                     <hr class="my-2">
                     <!-- Nav items -->
                     <ul class="navbar-nav">
                         <li class="nav-item disabled">
                             <a class="nav-link" href="/user/refferal_patient/reg">
                                 <i class="ni ni-ambulance text-success"></i>
                                 <span class="nav-link-text">Daftar Rujukan</span>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a class="nav-link" href="/user/profile">
                                 <i class="ni ni-single-02 text-yellow"></i>
                                 <span class="nav-link-text">Profile</span>
                             </a>
                         </li>
                     </ul>

                 @endif

             </div>
         </div>
     </div>
 </nav>

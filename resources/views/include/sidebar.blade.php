  <aside class="sidebar" id="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
          <img id="HR_yazi" alt="" src="{{asset('files/img/HR.png')}}" />
          <style>
              .sidebar-divider {
                  margin: 10px 0 5px 0;
                  border-top: 1px solid #b6b6b6;
                  opacity: 0.6;
              }
          </style>
          <hr class="sidebar-divider">
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('home') }}">
                  <i class="bi bi-grid"></i>
                  <span>Ana səhifə</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('pages.staff.personal-accounting') }}">
                  <i class="bi bi-people-fill"></i>
                  <span>Kadr uçotu</span>
              </a>
          </li>
          <!-- <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('job-acceptance') }}">
                  <i class="bi bi-person-plus"></i>
                  <span>İşə qəbul</span>
              </a>
          </li> -->
          <!-- <li class="nav-item">
              <a class="nav-link collapsed" href="">
                  <i class="bi bi-folder"></i>
                  <span>Arxiv</span>
              </a>
          </li> -->
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('structure') }}">
                  <i class="bi bi-diagram-3-fill"></i>
                  <span>Struktur</span>
              </a>
          </li>
      </ul>
  </aside>
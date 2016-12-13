        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                    <img src="{{ asset('upload/avatars/' . auth::user()->avatar) }}" alt=""> {{ ucwords(auth::user()->FullName) }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ url('user/profile/' . auth::user()->id) }}">Profile</a></li>

                
                    <li>
                      <a href="{{ url('settings') }}">
                        <span>Settings</span> 
                      </a>
                    </li>

                    <li>
                      <a href="{{ url('help') }}">
                        <span>Help</span> 
                      </a>
                    </li>

                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>


                </li>
                

              </ul>
            </nav>
          </div>
        </div>
<nav class="vertical_nav">
    <div class="left_section menu_left" id="js-menu">
        <div class="left_section">
            <ul>
                <li class="menu--item">
                    <a href="{{URL::to('/admin')}}" class="menu--link active" title="Dashboard"
                        data-bs-toggle="tooltip" data-bs-placement="right">
                        <i class="fa-solid fa-gauge menu--icon"></i>
                        <span class="menu--label">Dashboard</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{url('admin/user')}}" class="menu--link team-lock" title="Utilisateurs"
                        data-bs-toggle="tooltip" data-bs-placement="right">
                        <i class="fa-solid fa-user-group menu--icon"></i>
                        <span class="menu--label">Utilisateurs</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
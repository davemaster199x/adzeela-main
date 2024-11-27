<div class="left-side-menu">
    <!--- Sidemenu -->
    <div id="sidebar-menu" class="active">
        <ul class="metismenu in" id="side-menu">
            <li class="menu-title">Navigation</li>
            <li><a href="/dashboard"><i class="mdi mdi-view-dashboard"></i> <span>Dashboard</span></a></li>
            <li>
                <a href="javascript:void(0);" aria-expanded="false"@if(\Request::is('workfile/*')) class="active" @endif @if(\Request::is('workfiles')) class="active" @endif @if(\Request::is('freelancers')) class="active collapsed" @endif @if(\Request::is('freelance/*')) class="collapsed active" @endif @if(\Request::is('workfiles')) class="active" @endif>
                    <i class="mdi mdi-file-document"></i>
                    <span> Freelance Management</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level collapse @if(\Request::is('freelancers')) in @endif @if(\Request::is('freelance/*')) in @endif @if(\Request::is('workfiles')) in @endif @if(\Request::is('workfile/*')) in @endif" aria-expanded="false">
                    <li @if(\Request::is('freelancers')) class="active" @endif @if(\Request::is('freelance/*')) class="active" @endif><a href="{{ route('freelance.users') }}">Freelancers</a></li>
                    <li @if(\Request::is('workfile/*')) class="active" @endif @if(\Request::is('workfiles')) class="active" @endif><a href="{{ route('workfiles.list') }}">Workfiles</a></li>
                </ul>
            </li>
            <li><a href="{{ route('companies.list') }}" @if(\Request::is('companies/*') || \Request::is('company/*')) class="active" @endif><i class="mdi mdi-office-building"></i> <span>Companies</span></a></li>
            <li><a href="{{ route('leads') }}" @if(\Request::is('leads/*') || \Request::is('lead/*')) class="active" @endif><i class="mdi mdi-view-list"></i> <span>Leads</span></a></li>
            <li>
                <a href="javascript:void(0);" aria-expanded="false" @if(\Request::is('caller/*') || \Request::is('callers/*') || \Request::is('manage-caller/*')) class="active" @endif>
                    <i class="mdi mdi-file-document"></i>
                    <span> Caller Management</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level collapse @if(\Request::is('caller/*') || \Request::is('callers/*') || \Request::is('manage-caller/*')) in @endif" aria-expanded="false">
                    <li @if(\Request::is('caller/*') || \Request::is('callers/*')) class="active" @endif><a href="{{ route('callers') }}">Callers</a></li>
                    <li @if(\Request::is('manage-caller/*')) class="active" @endif><a href="{{ route('managecallers') }}">Manage Caller</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>
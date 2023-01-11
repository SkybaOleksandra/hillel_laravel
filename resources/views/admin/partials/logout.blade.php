<div>
    <div class="container-fluid justify-content-start">
        <p>{{ $name }}, ({{ $role }})</p>
    </div>
    <nav class="navbar bg-body-tertiary">
        <form class="container-fluid justify-content-start">
            <a href="{{ route('admin.logout') }}" class="btn btn-primary stretched-link">Logout</a>
        </form>
    </nav>
</div>

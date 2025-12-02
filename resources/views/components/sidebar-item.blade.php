<li class="sidebar-item {{ $active ? 'active' : '' }}">
    <a href="{{ $route ? route($route) : '#' }}" class="sidebar-link">
        <i class="{{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>
</li>

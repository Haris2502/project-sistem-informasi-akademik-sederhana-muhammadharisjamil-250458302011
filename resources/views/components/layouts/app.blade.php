<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - Mazer Admin Dashboard' }}</title>

    <link rel="shortcut icon" href="data:image/svg+xml,%3csvg width='200' height='60' viewBox='0 0 200 60' xmlns='http://www.w3.org/2000/svg'%3e%3cg transform='translate(10, 15)'%3e%3cpath d='M15 10 L0 15 L15 20 L30 15 Z' fill='%230ea5e9'/%3e%3crect x='5' y='7' width='20' height='3' fill='%2306b6d4' rx='1'/%3e%3cline x1='25' y1='8' x2='28' y2='5' stroke='%230ea5e9' stroke-width='1.5'/%3e%3ccircle cx='28' cy='4' r='2' fill='%230ea5e9'/%3e%3cpath d='M3 15 L3 22 Q15 26 27 22 L27 15' stroke='%2306b6d4' stroke-width='1.5' fill='none'/%3e%3c/g%3e%3ctext x='55' y='25' font-family='Arial, sans-serif' font-size='24' font-weight='bold' fill='%230ea5e9'%3eSIAS%3c/text%3e%3ctext x='55' y='40' font-family='Arial, sans-serif' font-size='10' fill='%2364748b'%3eSistem Informasi Akademik%3c/text%3e%3c/svg%3e" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('dist/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/compiled/css/iconly.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
</head>

<body>
    <script src="{{ asset('dist/assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        {{-- Sidebar --}}
        @include('components.layouts.partials.sidebar')

        <div id="main">
            {{-- Header --}}
            @include('components.layouts.partials.header')

            {{-- Content --}}
            <main class="page-content">
                {{ $slot }}
            </main>

            {{-- Footer --}}
            @include('components.layouts.partials.footer')
        </div>
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('dist/assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('dist/assets/compiled/js/app.js') }}"></script>
    <script src="{{ asset('dist/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('dist/assets/static/js/pages/dashboard.js') }}"></script>

    <script>
        // Dark Mode Handler (Global) - Using event delegation
        let themeToggleHandler = null;
        
        function handleThemeToggle(e) {
            if (e.target.id === 'toggle-dark') {
                const newTheme = e.target.checked ? "dark" : "light";
                document.body.classList.remove('dark', 'light');
                document.body.classList.add(newTheme);
                document.documentElement.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
            }
        }
        
        function initDarkMode() {
            const theme = localStorage.getItem('theme') || 'light';
            
            // Apply theme
            document.documentElement.setAttribute('data-bs-theme', theme);
            document.body.classList.remove('dark', 'light');
            document.body.classList.add(theme);
            
            // Update toggle checkbox state
            const toggler = document.getElementById("toggle-dark");
            if (toggler) {
                toggler.checked = theme === "dark";
            }
        }
        
        // Setup global event listener once (event delegation)
        if (!themeToggleHandler) {
            document.addEventListener("input", handleThemeToggle);
            themeToggleHandler = true;
        }
        
        // Initialize on first load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initDarkMode);
        } else {
            initDarkMode();
        }
    
        document.addEventListener('livewire:navigating', () => {
            NProgress.start();
        });

        document.addEventListener('livewire:navigated', () => {
            NProgress.done();
            
            // Re-init Perfect Scrollbar
            const container = document.querySelector('.sidebar-wrapper');
            if (container) {
                new PerfectScrollbar(container, {
                    wheelPropagation: false
                });
            }

            // Re-init Dark Mode
            initDarkMode();

            // Re-init Tooltips/Popovers if any (Bootstrap 5)
            setTimeout(() => {
                // Dispose old instances first
                document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                    const oldTooltip = bootstrap.Tooltip.getInstance(el);
                    if (oldTooltip) oldTooltip.dispose();
                });
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                })
            }, 100);
        });


        // Simple Profile Dropdown Handler (works immediately, no refresh needed)
        let dropdownInitialized = false;
        
        function setupDropdown() {
            if (dropdownInitialized) return;
            
            document.addEventListener('click', function(e) {
                const toggle = document.getElementById('profileDropdownToggle');
                const menu = document.getElementById('profileDropdownMenu');
                
                if (!toggle || !menu) return;
                
                // Click on toggle
                if (toggle.contains(e.target)) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const isOpen = menu.classList.contains('show');
                    menu.classList.toggle('show', !isOpen);
                    toggle.setAttribute('aria-expanded', !isOpen);
                } 
                // Click outside - close dropdown
                else if (!menu.contains(e.target)) {
                    menu.classList.remove('show');
                    if (toggle) toggle.setAttribute('aria-expanded', 'false');
                }
            }, true);
            
            dropdownInitialized = true;
        }
        
        // Setup immediately
        setupDropdown();
    
    
    </script>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus data ini?',
            text: "Data guru akan dihapus secara permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('deleteConfirmed', { id: id });
                Swal.fire({
                    title: 'Terhapus!',
                    text: 'Data guru berhasil dihapus.',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }
</script>

</body>
</html>

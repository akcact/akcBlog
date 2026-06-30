document.addEventListener('DOMContentLoaded', function() {
    // Header Scroll effect
    const header = document.querySelector('.site-header');
    
    function checkScroll() {
        if (window.scrollY > 20) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }
    
    window.addEventListener('scroll', checkScroll);
    checkScroll(); // Check on init

    // Reading progress bar for single view
    window.addEventListener('scroll', function() {
        const progressBar = document.getElementById('reading-progress');
        if (progressBar) {
            const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = height > 0 ? (winScroll / height) * 100 : 0;
            progressBar.style.width = scrolled + '%';
        }
    });

    // Search toggle drawer
    const searchToggle = document.getElementById('search-toggle-btn');
    const searchDrawer = document.getElementById('search-drawer');
    
    if (searchToggle && searchDrawer) {
        searchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Toggle displaying
            const isVisible = window.getComputedStyle(searchDrawer).display !== 'none';
            if (isVisible) {
                searchDrawer.style.display = 'none';
                searchToggle.innerHTML = '<i class="fa-solid fa-magnifying-glass"></i>';
            } else {
                searchDrawer.style.display = 'block';
                searchToggle.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                const searchInput = searchDrawer.querySelector('input[type="search"]');
                if (searchInput) searchInput.focus();
            }
        });
    }
});

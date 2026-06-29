(() => {
  const toggle = document.querySelector('[data-testid="mobile-menu-toggle"]');
  const header = document.querySelector('[data-testid="site-header"]');
  if (toggle && header) {
    toggle.addEventListener('click', () => {
      let menu = header.querySelector('[data-offline-mobile-menu]');
      if (!menu) {
        const links = [...document.querySelectorAll('nav a')].map((link) => link.cloneNode(true));
        menu = document.createElement('div');
        menu.dataset.offlineMobileMenu = 'true';
        menu.style.cssText = 'display:grid;gap:14px;padding:18px 16px 24px;border-top:1px solid #262626;background:#0a0a0a';
        links.forEach((link) => {
          link.style.cssText = 'color:#fff;font:700 13px Inter,Arial,sans-serif;text-transform:uppercase;letter-spacing:.12em';
          menu.appendChild(link);
        });
        header.appendChild(menu);
      } else {
        menu.hidden = !menu.hidden;
      }
      toggle.setAttribute('aria-expanded', String(!menu.hidden));
    });
  }
})();

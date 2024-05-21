<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sticky Menu with Smooth Transition, Icon Toggle, Scrollable Content, and Submenu</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
  <style>
    .menu-extended {
      height: 90vh; /* 90% of the viewport height */
    }
    .menu-collapsed {
      height: 0;
    }
    .transition-height {
      transition: height 0.5s ease-in-out;
    }
    .submenu-collapsed {
      max-height: 0;
      opacity: 0;
      transition: max-height 0.5s ease-in-out, opacity 0.5s ease-in-out;
      overflow: hidden;
    }
    .submenu-expanded {
      max-height: 500px; /* Adjust as needed */
      opacity: 1;
    }
  </style>
</head>
<body class="bg-gray-100">

  <!-- Sticky Menu -->
  <div id="stickyMenu" class="fixed bottom-0 left-0 right-0 overflow-hidden transition-all duration-300 bg-white shadow-lg md:hidden rounded-2xl">
    <button id="menuToggle" class="relative flex items-center justify-center w-full py-4 text-xl font-semibold text-center text-white bg-yellow-500">
      Menu
      <span id="menuIcon" class="absolute right-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-menu-2">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <path d="M4 6l16 0" />
          <path d="M4 12l16 0" />
          <path d="M4 18l16 0" />
        </svg>
      </span>
    </button>
    <div id="menuContent" class="overflow-y-auto bg-yellow-500 menu-collapsed transition-height">
      <ul class="flex flex-col items-start justify-center px-8 text-xl leading-10">
        <li class="w-full py-6 border-b border-gray-100 border-opacity-25 "><a href="#" class="text-white">Reservasi</a></li>
        <li class="w-full py-6 border-b border-gray-100 border-opacity-25 "><a href="#" class="text-white ">About</a></li>
        <li class="justify-between w-full">
          <div class="flex items-center">
            <button class="flex items-center justify-between w-full py-6 text-center text-white border-b border-gray-100 border-opacity-25 submenu-toggle ">
              Services
              <span class="text-right submenu-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-plus">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M12 5l0 14" />
                  <path d="M5 12l14 0" />
                </svg>
              </span>
            </button>
          </div>
          <ul class="pl-4 space-y-2 submenu-collapsed">
            <li class="w-full py-6 border-b border-gray-100 border-opacity-25 "><a href="#" class="text-white ">Service 1</a></li>
            <li class="w-full py-6 border-b border-gray-100 border-opacity-25 "><a href="#" class="text-white">Service 2</a></li>
            <li class="w-full py-6 border-b border-gray-100 border-opacity-25 "><a href="#" class="text-white">Service 3</a></li>
          </ul>
        </li>
        <li class="w-full py-6 border-b border-gray-100 border-opacity-25 "><a href="#" class="text-white">Contact</a></li>
      </ul>
    </div>
  </div>

  <script>
    const menuToggle = document.getElementById('menuToggle');
    const menuContent = document.getElementById('menuContent');
    const menuIcon = document.getElementById('menuIcon');
    const submenuToggles = document.querySelectorAll('.submenu-toggle');

    const menuSvg = `
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-menu-2">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M4 6l16 0" />
        <path d="M4 12l16 0" />
        <path d="M4 18l16 0" />
      </svg>`;
    
    const closeSvg = `
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-x">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M18 6l-12 12" />
        <path d="M6 6l12 12" />
      </svg>`;

    const plusSvg = `
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-plus">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M12 5l0 14" />
        <path d="M5 12l14 0" />
      </svg>`;
    
    const minusSvg = `
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-minus">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M5 12l14 0" />
      </svg>`;

    menuToggle.addEventListener('click', () => {
      if (menuContent.classList.contains('menu-collapsed')) {
        menuContent.classList.remove('menu-collapsed');
        menuContent.classList.add('menu-extended');
        menuIcon.innerHTML = closeSvg;
      } else {
        menuContent.classList.remove('menu-extended');
        menuContent.classList.add('menu-collapsed');
        menuIcon.innerHTML = menuSvg;
      }
    });

    submenuToggles.forEach(toggle => {
      toggle.addEventListener('click', () => {
        const submenu = toggle.closest('li').querySelector('ul');
        const submenuIcon = toggle.querySelector('.submenu-icon');
        if (submenu && submenu.classList.contains('submenu-collapsed')) {
          submenu.classList.remove('submenu-collapsed');
          submenu.classList.add('submenu-expanded');
          submenuIcon.innerHTML = minusSvg;
        } else if (submenu) {
          submenu.classList.remove('submenu-expanded');
          submenu.classList.add('submenu-collapsed');
          submenuIcon.innerHTML = plusSvg;
        }
      });
    });
  </script>

</body>
</html>

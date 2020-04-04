<header x-data="{ isOpen: false }" class="container mx-auto fixed w-screen h-16 top-0 border-b-4 border-indigo-700">
    <nav class="mx-auto px-2 flex items-center justify-between h-full">
        <h1 class="text-3xl">Wordpress Starter</h1>

        <div class="">

            <ul class="hidden sm:flex">
                <li class="pr-4 sm:pr-8"><a class="hover:text-indigo-700" href="<?php echo get_home_url(); ?>">Home</a></li>
                <li class="pr-4 sm:pr-8"><a class="hover:text-indigo-700" href="<?php echo get_home_url(); ?>/sample-page">Sample Page</a></li>
            </ul>

            <div class="relative sm:hidden">
                <button class="flex items-center outline-none" @click="isOpen = !isOpen" @keydown.escape="isOpen = false">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 hover:text-indigo-700">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <ul id="navbar" x-show="isOpen" class="absolute top-0 mt-16 right-0 font-normal bg-white w-screen min-h-screen z-20" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0" x-transition:leave="transition ease-out duration-300" x-transition:leave-start="transform translate-x-0" x-transition:leave-end="transform translate-x-full">
                <li class="w-full flex flex-col justify-center my-2 hover:bg-gray-200 mt-8">
                    <a href="<?php echo get_home_url(); ?>" class="flex flex-col items-center px-3 py-3">

                        <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="text-black">
                            <path d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"></path>
                        </svg>
                        <span class="border-b-2 border-gray-400">Frontpage</span>
                    </a>
                </li>
                <li class="w-full flex flex-col justify-center my-2">
                    <a href="<?php echo get_home_url(); ?>/sample-page" class="flex flex-col items-center px-3 py-3 hover:bg-gray-200">

                        <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="text-black">
                            <path d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10.09 15.59L11.5 17l5-5-5-5-1.41 1.41L12.67 11H3v2h9.67l-2.58 2.59zM19 3H5c-1.11 0-2 .9-2 2v4h2V5h14v14H5v-4H3v4c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"></path>
                        </svg>
                        <span class="border-b-2 border-gray-400">Sample Page</span>
                    </a>
                </li>

            </ul>

        </div>
    </nav>
</header>
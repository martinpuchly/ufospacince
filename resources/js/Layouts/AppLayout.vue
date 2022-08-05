<template>
    <div class="bg-zinc-100 bg-gradient-to-b from-sky-900 to-blue-600 pb-10">
        <div class="container mx-auto flex min-h-screen flex-col rounded-b-3xl bg-slate-100 shadow-lg drop-shadow-2xl">
            <header>
            <nav class="border-gray-200 bg-white bg-gradient-to-b from-sky-900 to-blue-600 px-2 dark:border-gray-700">
                <div class="container mx-auto flex flex-wrap items-center justify-between">
                <a href="#" class="flex items-center">
                    <img src="http://www.ufospacince.sk/sites/default/files/novelogo_2.png" class="my-2 mr-3 h-10 sm:h-14" alt="U.F.O. logo" />
                    <span class="self-center whitespace-nowrap text-2xl font-semibold dark:text-white">U.F.O. Špačince - ultimate frisbee tím</span>
                </a>
                <button data-collapse-toggle="mobile-menu" type="button" class="ml-3 inline-flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-500 md:hidden" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="mobile-menu">
                    <Menu></Menu>
                </div>
                </div>
            </nav>
            </header>
            <main class="flex h-5/6 grow flex-col px-4 sm:flex-row">
            <div class="side_menu basis-1/5">
                <div class="side_menu_block">
                <h1>novinky:</h1>
                <p class="side_menu_new">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                </div>
                <div class="side_menu_block">
                <h1>facebook</h1>
                </div>
            </div>
            <div class="bg-g basis-4/5 pl-4 pr-2 pt-4 pb-6">     
            <div v-if="$page.props.flash.notice" class="flex p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
            <svg aria-hidden="true" class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                {{ $page.props.flash.notice }}
            </div>
            <div v-if="$page.props.flash.error" class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            <svg aria-hidden="true" class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                {{ $page.props.flash.error }}
            </div>
            <div  v-if="$page.props.flash.succeed" class="flex p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            <svg aria-hidden="true" class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                {{ $page.props.flash.succeed }}
            </div>
                <slot />
            </div>
            </main>
            <footer class="mt-2 flex flex-col justify-between border-t-2 px-5 py-2 text-sm">
            <div class="flex justify-evenly">
                <div>
                <ul>
                    Informácie:
                    <li>asdas</li>
                </ul>
                </div>
                <div>b</div>
                <div>c</div>
            </div>
            </footer>
        </div>
        <div class="text-center text-white">
            <small>U.F.O. Špačince, ©2022</small>
        </div>
    </div>

</template>


<script>
import { Link } from '@inertiajs/inertia-vue3'
import Menu from './Shared/Menu.vue'

export default {
    components: {
    Link,
    Menu
    }
}



</script>
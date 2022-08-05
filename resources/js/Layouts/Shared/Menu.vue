<template>
    <ul class="mt-4 flex flex-col rounded-lg border border-gray-100 p-4  md:mt-0 md:flex-row md:space-x-8 md:border-0 md:text-sm md:font-medium">
        <li>
            <a href="#" class="block rounded bg-blue-700 py-2 pr-4 pl-3 text-white md:bg-transparent md:p-0 md:dark:bg-transparent md:dark:text-white" aria-current="page">Home</a>
        </li>
        <li>
            <a href="#" class="block rounded py-2 pr-4 pl-3  hover:bg-gray-100  dark:hover:bg-gray-700 dark:hover:text-white md:border-0 md:p-0 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:bg-transparent md:dark:hover:text-white">Services</a>
        </li>
        <li>
            <a href="#" class="block rounded py-2 pr-4 pl-3  hover:bg-gray-100  dark:hover:bg-gray-700 dark:hover:text-white md:border-0 md:p-0 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:bg-transparent md:dark:hover:text-white">Pricing</a>
        </li>
        <li class="text-white font-bold">
            {{ $page.props.auth.user ? $page.props.auth.user.name : 'no loged' }}
        </li>
    </ul>
</template>
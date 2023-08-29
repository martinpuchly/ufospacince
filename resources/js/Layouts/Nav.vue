<script setup>
</script>

<template>
    <nav class="navbar navbar-color navbar-expand-lg navbar-custom" data-bs-theme="dark">
        <div class="container-fluid">
          <Link class="navbar-brand" :href="route('/')">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16" style="position: relative; top:-.15em;">
            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
          </svg>
          </Link>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <Link class="nav-link" aria-current="page" :href="route('posts')">Články</Link>
              </li>
              <li class="nav-item">
                <Link class="nav-link" :href="route('players')">Tím</Link>
              </li>
              <li class="nav-item">
                <Link class="nav-link" :href="route('trainings')">Tréningy</Link>
              </li>
              <li class="nav-item">
                <Link class="nav-link" :href="route('page', {page_slug: 'ultimate-frisbee'})">Ultimate Frisbee</Link>
              </li>
              <li class="nav-item">
                <Link class="nav-link" :href="route('contact.add')">Kontakt</Link>
              </li>
            </ul>
            <div class="text-secondary">
              <div v-if="$page.props.auth?.user">
                <span>{{ $page.props.auth.user.name }}</span> | 
                <span v-if="$page.props.auth.user.has_admin_link"><Link :href="route('admin')">administrácia</Link> | </span>
                <span><Link :href="route('logout')" method="POST" >odhlásiť</Link></span>
              </div>
              <div v-else>
                  <Link :href="route('login')">prihlásiť</Link>
              </div>
            </div>
          </div>
        </div>
      </nav>

</template>


<script setup>
import { Link } from '@inertiajs/vue3'


</script>
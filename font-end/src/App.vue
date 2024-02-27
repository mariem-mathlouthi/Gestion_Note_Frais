<template>

   <router-view v-slot="{ Component }">
         <transition name="fade"  mode="out-in">
                 <component :is="Component" />
          </transition>
       </router-view>
  <!-- <SidebarView /> -->
  

</template>

<script>
 //import NavbarView from '@/views/NavbarView.vue';
 //import SidebarView from '@/views/SidebarView.vue';


export default {
  name: 'App',
  components: {
    //NavbarView,
    //SidebarView,
    
  }
};
</script>
<style scoped>
@import 'https://fonts.googleapis.com/icon?family=Material+Icons';
.navbar {
  padding: 15px;
}

.navbar-brand {
  font-weight: bold;
  font-size: 1.5rem;
}

.navbar-toggler {
  border: none;
}

.navbar-toggler:focus {
  outline: none;
}

.navbar-nav .nav-link {
  font-weight: bold;
  color: #fff;
  padding: 10px 15px;
  transition: color 0.3s;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active {
  color: #42b983;
}

/* Add a subtle bottom border to the active link */
.navbar-nav .nav-item.active {
  border-bottom: 3px solid #42b983;
}
</style>

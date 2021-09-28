<template>
  <v-app id="app">
    <v-app-bar absolute color="deep-purple accent-4" dark>
      <v-app-bar-nav-icon></v-app-bar-nav-icon>
      <router-link to="/" class="text-decoration-none">
        <v-toolbar-title class="text-white t-white">
          Home
        </v-toolbar-title>
      </router-link>

      <v-spacer></v-spacer>

      <v-item-group>
        <v-item class="pr-1">
          <router-link to="/dashboard" class="text-decoration-none">
            <v-btn color="white" outlined class="text-white ">
              Dashboard
            </v-btn>
          </router-link>
        </v-item>
        <v-item class="pr-1">
          <router-link to="/login" class="text-decoration-none">
            <v-btn color="white" outlined class="text-white ">
              Login
            </v-btn>
          </router-link>
        </v-item>
      </v-item-group>
    </v-app-bar>
    <v-container>
      <router-view></router-view>
    </v-container>  
  </v-app>
</template>

<script>
export default {
  name: "App",
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
.t-white {
  color: white !important;
}
</style>

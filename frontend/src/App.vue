<template>
  <div id="app">
    <nav>
      <ul>
        <li><router-link to="/">Utilisateurs</router-link></li>
        <li><router-link to="/jobs">Jobs</router-link></li>
        
      </ul>
    </nav>
    
    <router-view></router-view>  
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style>
nav {
  margin-bottom: 20px;
}

ul {
  list-style-type: none;
}

li {
  display: inline;
  margin-right: 10px;
}
</style>

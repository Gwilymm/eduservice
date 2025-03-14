<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
</script>

<template>
  <header>
    <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" />

    <div class="wrapper">
      <HelloWorld msg="You did it!" />

      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
      </nav>
    </div>
  </header>

  <RouterView />
</template>

<style>
@font-face {
  font-family: 'HomemadeApple';
  src: url('@/assets/fonts/HomemadeApple-Regular.woff') format("woff");
}

@font-face {
  font-family: 'NeoSansStd';
  src: url('@/assets/fonts/Neo-Sans-Std-Medium.woff') format("woff");
}

body{
  font-family: NeoSansStd;
}
h1 {
  font-family: HomemadeApple;
}
</style>

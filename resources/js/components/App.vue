<template>
   <div id="app">
      <router-link to="/"></router-link>
      <router-view />
   </div>
</template>

<script> 
    export default {
        name: "app",
      //   props: [
      //       'data'
      //   ],
      //   created() {
      //    console.log(document.querySelector('#layout_app').getAttribute('data'));
      //   }
    }
</script>


 